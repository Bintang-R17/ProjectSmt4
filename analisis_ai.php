<?php

/**
 * AI API Service Class
 */
class GroqAIService {
    private $apiKey;
    private $apiUrl;
    
    public function __construct() {
        $this->apiKey = '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';
        $this->apiUrl = 'https://api.groq.com/openai/v1/chat/completions';
    }
    
    public function analyzeLabResults($userMessage, $conversationHistory = []) {
        $messages = $this->buildMessages($conversationHistory);
        $messages[] = ["role" => "user", "content" => $userMessage];
        
        $payload = [
            "model" => "meta-llama/llama-4-scout-17b-16e-instruct",
            "messages" => $messages,
            "temperature" => 0.7,
            "max_tokens" => 1000
        ];
        
        return $this->makeApiCall($payload);
    }
    
    private function buildMessages($conversationHistory) {
        $messages = [
            ["role" => "system", "content" => "Kamu adalah asisten medis cerdas. Berdasarkan hasil lab yang diberikan, berikan analisis kemungkinan penyakit atau kondisi pasien dan saran tindakan medis awal. Jangan memberikan diagnosis pasti, hanya analisis dan saran profesional.
            Berikut adalah hasil pemeriksaan hematologi pasien:
            Buatkan analisis untuk *masing-masing parameter* berikut statusnya (Normal/Rendah/Tinggi), interpretasi, dan rekomendasi medis jika ada."]
        ];
        
        foreach ($conversationHistory as $msg) {
            $messages[] = $msg;
        }
        
        return $messages;
    }
    
    private function makeApiCall($payload) {
        $ch = curl_init($this->apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
            "Authorization: Bearer " . $this->apiKey
        ]);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_errno($ch)) {
            $error = curl_error($ch);
            curl_close($ch);
            throw new Exception('CURL Error: ' . $error);
        }

        curl_close($ch);
        
        if ($httpCode !== 200) {
            throw new Exception('API Error: HTTP ' . $httpCode . ' - ' . $response);
        }
        
        return json_decode($response, true);
    }
}

/**
 * Session Manager Class
 */
class SessionManager {
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
    
    public function getConversation() {
        return $_SESSION['conversation'] ?? [];
    }
    
    public function addToConversation($userMessage, $aiResponse) {
        if (!isset($_SESSION['conversation'])) {
            $_SESSION['conversation'] = [];
        }
        
        $_SESSION['conversation'][] = ["role" => "user", "content" => $userMessage];
        $_SESSION['conversation'][] = ["role" => "assistant", "content" => $aiResponse];
        
        // Batasi history conversation (keep last 20 messages)
        $_SESSION['conversation'] = array_slice($_SESSION['conversation'], -20);
    }
}

/**
 * Lab Results Data Access Object
 */
class LabResultsDAO {
    private $conn;
    
    public function __construct($connection) {
        $this->conn = $connection;
    }
    
    public function getLabResultById($hasil_lab_id) {
        $sql = "
        SELECT 
            pp.nama_parameter,
            pp.satuan,
            hp.nilai,
            pp.jenis_id,
            jp.nama AS nama_jenis,
            pp.nilai_min,
            pp.nilai_max
        FROM hasil_parameter hp
        JOIN parameter_pemeriksaan pp ON hp.parameter_id = pp.id
        JOIN jenis_pemeriksaan jp ON pp.jenis_id = jp.id
        WHERE hp.hasil_lab_id = ?
        ORDER BY jp.nama, pp.nama_parameter
        ";

        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $this->conn->error);
        }

        $stmt->bind_param("i", $hasil_lab_id);
        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }

        $result = $stmt->get_result();
        if (!$result) {
            throw new Exception("Get result failed: " . $stmt->error);
        }
        
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        
        return $data;
    }
}

/**
 * Medical Analysis Controller - DIPERBAIKI
 */
class MedicalAnalysisController {
    private $aiService;
    private $sessionManager;
    private $labResultsDAO;
    
    public function __construct() {
        $this->aiService = new GroqAIService();
        $this->sessionManager = new SessionManager();
        
        // Initialize database connection
        require_once 'config/database.php';
        $db = new Database();
        $conn = $db->getConnection();
        
        if (!$conn instanceof mysqli) {
            throw new Exception("Database connection is not established.");
        }
        
        $this->labResultsDAO = new LabResultsDAO($conn);
    }
    
    public function handleApiRequest() {
        header('Content-Type: application/json');
        
        try {
            // Log input untuk debugging
            $rawInput = file_get_contents("php://input");
            error_log("Raw input: " . $rawInput);
            
            $input = json_decode($rawInput, true);
            
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception('Invalid JSON input: ' . json_last_error_msg());
            }
            
            $userMessage = $input['message'] ?? '';
            $hasil_lab_id = $input['hasil_lab_id'] ?? null;  // PERBAIKAN: Ambil hasil_lab_id
            $parametersData = $input['parameters_data'] ?? [];
            $patientInfo = $input['patient_info'] ?? [];

            if (!$userMessage) {
                $this->sendErrorResponse('Pesan kosong');
                return;
            }
            
            // Log data yang diterima
            error_log("Received data - hasil_lab_id: " . $hasil_lab_id);
            error_log("Parameters count: " . count($parametersData));
            
            // PERBAIKAN: Validasi dan gunakan hasil_lab_id jika diperlukan
            if ($hasil_lab_id) {
                // Ambil data lab hasil dari database untuk validasi
                $labData = $this->labResultsDAO->getLabResultById($hasil_lab_id);
                error_log("Lab data retrieved: " . count($labData) . " parameters");
                
                // Tambahkan informasi lab ke dalam pesan jika perlu
                if (empty($parametersData) && !empty($labData)) {
                    $parametersData = $labData;
                }
            }

            $conversationHistory = $this->sessionManager->getConversation();
            $responseData = $this->aiService->analyzeLabResults($userMessage, $conversationHistory);

            if (isset($responseData['choices'][0]['message']['content'])) {
                $aiResponse = $responseData['choices'][0]['message']['content'];
                
                $this->sessionManager->addToConversation($userMessage, $aiResponse);
                
                $this->sendSuccessResponse($aiResponse, [
                    'hasil_lab_id' => $hasil_lab_id,
                    'parameters_count' => count($parametersData)
                ]);
            } else {
                $this->sendErrorResponse('No content in response', $responseData);
            }
            
        } catch (Exception $e) {
            error_log("Error in MedicalAnalysisController: " . $e->getMessage());
            error_log("Stack trace: " . $e->getTraceAsString());
            $this->sendErrorResponse($e->getMessage());
        }
    }
    
    public function getLabResults($hasil_lab_id = null) {
        try {
            $hasil_lab_id = $hasil_lab_id ?? $_GET['id'] ?? 1;
            return $this->labResultsDAO->getLabResultById($hasil_lab_id);
        } catch (Exception $e) {
            error_log("Error getting lab results: " . $e->getMessage());
            throw $e;
        }
    }
    
    private function sendSuccessResponse($content, $additionalData = []) {
        $response = [
            'success' => true,
            'content' => $content,
            'timestamp' => date('Y-m-d H:i:s')
        ];
        
        // Tambahkan data tambahan jika ada
        $response = array_merge($response, $additionalData);
        
        echo json_encode($response);
    }
    
    private function sendErrorResponse($message, $additionalData = null) {
        $response = [
            'success' => false,
            'error' => $message
        ];
        
        if ($additionalData) {
            $response['details'] = $additionalData;
        }
        
        echo json_encode($response);
    }
}

// Usage example - DIPERBAIKI:
try {
    $controller = new MedicalAnalysisController();
    
    // Handle API request
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller->handleApiRequest();
        exit; // PENTING: Pastikan script berhenti setelah handle request
    }
    
    // Get lab results
    if (isset($_GET['action']) && $_GET['action'] === 'get_lab_results') {
        $results = $controller->getLabResults();
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'data' => $results
        ]);
        exit;
    }
    
} catch (Exception $e) {
    error_log("Fatal error in analisis_ai.php: " . $e->getMessage());
    header('Content-Type: application/json');
    echo json_encode([
        'success' => false,
        'error' => 'Internal server error: ' . $e->getMessage()
    ]);
}

?>