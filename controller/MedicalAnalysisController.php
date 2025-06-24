<?php

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
            } 
            
        } catch (Exception $e) {
            error_log("Error in MedicalAnalysisController: " . $e->getMessage());
            error_log("Stack trace: " . $e->getTraceAsString());
            
        }
    }

    public function showLabResultDetail($hasil_lab_id) {
    try {
        $labDetail = $this->labResultsDAO->getLabResultById($hasil_lab_id); // sudah kamu punya
        require __DIR__ . '/../view/dokter/detail-hasil-lab.php'; // buat file ini nanti
    } catch (Exception $e) {
        error_log("Error fetching lab detail: " . $e->getMessage());
        echo "Gagal menampilkan detail hasil lab.";
    }
}

}

?>