<?php

/**
 * Session Manager Class
 * Mengelola session dan riwayat percakapan
 */
class SessionManager {
    private $maxConversationHistory;
    
    public function __construct($maxHistory = 20) {
        $this->maxConversationHistory = $maxHistory;
        $this->initializeSession();
    }
    
    /**
     * Inisialisasi session jika belum ada
     */
    private function initializeSession() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
    
    /**
     * Mengambil riwayat percakapan dari session
     * 
     * @return array Riwayat percakapan
     */
    public function getConversation() {
        return $_SESSION['conversation'] ?? [];
    }
    
    /**
     * Menambahkan percakapan ke session
     * 
     * @param string $userMessage Pesan dari user
     * @param string $aiResponse Response dari AI
     */
    public function addToConversation($userMessage, $aiResponse) {
        if (!isset($_SESSION['conversation'])) {
            $_SESSION['conversation'] = [];
        }
        
        $_SESSION['conversation'][] = ["role" => "user", "content" => $userMessage];
        $_SESSION['conversation'][] = ["role" => "assistant", "content" => $aiResponse];
        
        // Batasi history conversation
        $_SESSION['conversation'] = array_slice($_SESSION['conversation'], -$this->maxConversationHistory);
    }
    
    /**
     * Menghapus riwayat percakapan
     */
    public function clearConversation() {
        unset($_SESSION['conversation']);
    }
    
    /**
     * Mengambil data user dari session
     * 
     * @return array|null Data user atau null jika tidak login
     */
    public function getUserData() {
        return [
            'user_id' => $_SESSION['user_id'] ?? null,
            'role' => $_SESSION['role'] ?? null,
            'nama_lengkap' => $_SESSION['nama_lengkap'] ?? null
        ];
    }
    
    /**
     * Menyimpan data user ke session
     * 
     * @param array $userData Data user
     */
    public function setUserData($userData) {
        foreach ($userData as $key => $value) {
            $_SESSION[$key] = $value;
        }
    }
    
    /**
     * Mengecek apakah user sudah login
     * 
     * @return bool True jika sudah login
     */
    public function isLoggedIn() {
        return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
    }
    
    /**
     * Logout user
     */
    public function logout() {
        session_destroy();
    }
    
    /**
     * Mengambil session ID
     * 
     * @return string Session ID
     */
    public function getSessionId() {
        return session_id();
    }
    
    /**
     * Set maksimal history percakapan
     * 
     * @param int $maxHistory Maksimal history
     */
    public function setMaxConversationHistory($maxHistory) {
        $this->maxConversationHistory = $maxHistory;
    }
}

?>