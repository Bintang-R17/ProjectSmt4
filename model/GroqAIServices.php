<?php

/**
 * Groq AI Service Class
 * Menangani komunikasi dengan Groq API untuk analisis medis
 */
class GroqAIService {
    private $apiKey;
    private $apiUrl;
    
    public function __construct() {
        $this->apiKey = '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';
        $this->apiUrl = 'https://api.groq.com/openai/v1/chat/completions';
    }
    
    /**
     * Menganalisis hasil lab menggunakan AI
     * 
     * @param string $userMessage Pesan dari user
     * @param array $conversationHistory Riwayat percakapan
     * @return array Response dari API
     * @throws Exception Jika terjadi error
     */
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
    
    /**
     * Membangun array messages untuk API call
     * 
     * @param array $conversationHistory Riwayat percakapan
     * @return array Messages array
     */
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
    
    /**
     * Melakukan API call ke Groq
     * 
     * @param array $payload Data yang akan dikirim
     * @return array Response dari API
     * @throws Exception Jika terjadi error
     */
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
    
    /**
     * Validasi API key
     * 
     * @return bool True jika API key valid
     */
    public function validateApiKey() {
        return !empty($this->apiKey);
    }
    
    /**
     * Set custom API key
     * 
     * @param string $apiKey API key baru
     */
    public function setApiKey($apiKey) {
        $this->apiKey = $apiKey;
    }
}

?>