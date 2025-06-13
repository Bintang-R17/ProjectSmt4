<?php
// models/Dokter.php
require_once __DIR__ . '/../autoload/autoloads.php';
class Dokter extends User {
    private $table_name = "dokter";

    public $id;
    public $user_id;
    public $nik;

    public function __construct($db) {
        parent::__construct(); // Inherit koneksi dari User
    }

    /** CREATE data dokter */
    public function create() {
        $query = "INSERT INTO {$this->table_name} (user_id, spesialisasi) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        if (!$stmt) return false;

        $stmt->bind_param("is", $this->user_id, $this->nik);
        if ($stmt->execute()) {
            $this->id = $this->conn->insert_id;
            return true;
        }
        return false;
    }

    /** READ semua data dokter + info user */
    public function readAll() {
        $query = "SELECT d.*, u.username, u.nama_lengkap 
                  FROM {$this->table_name} d
                  LEFT JOIN users u ON d.user_id = u.id 
                  ORDER BY d.id DESC";
        return $this->conn->query($query);
    }

    /** READ satu dokter berdasarkan ID */
    public function readOne() {
        $query = "SELECT d.*, u.username, u.nama_lengkap 
                  FROM {$this->table_name} d
                  LEFT JOIN users u ON d.user_id = u.id 
                  WHERE d.id = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        if (!$stmt) return false;

        $stmt->bind_param("i", $this->id);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            $this->user_id = $row['user_id'];
            $this->nik = $row['spesialisasi'];
            return $row;
        }
        return false;
    }

    /** UPDATE spesialisasi dokter */
    public function update() {
        $query = "UPDATE {$this->table_name} SET spesialisasi = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        if (!$stmt) return false;

        $stmt->bind_param("si", $this->nik, $this->id);
        return $stmt->execute();
    }

    /** DELETE dokter */
    public function delete() {
        $query = "DELETE FROM {$this->table_name} WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        if (!$stmt) return false;

        $stmt->bind_param("i", $this->id);
        return $stmt->execute();
    }

    /** GET dokter berdasarkan user_id */
    public function getByUserId($user_id) {
        $query = "SELECT * FROM {$this->table_name} WHERE user_id = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        if (!$stmt) return false;

        $stmt->bind_param("i", $user_id);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            $this->id = $row['id'];
            $this->user_id = $row['user_id'];
            $this->nik = $row['spesialisasi'];
            return true;
        }
        return false;
    }

    /** GET semua dokter berdasarkan spesialisasi */
    public function getBySpesialisasi($spesialisasi) {
        $query = "SELECT d.*, u.username, u.nama_lengkap 
                  FROM {$this->table_name} d
                  LEFT JOIN users u ON d.user_id = u.id 
                  WHERE d.spesialisasi = ?";
        $stmt = $this->conn->prepare($query);
        if (!$stmt) return false;

        $stmt->bind_param("s", $spesialisasi);
        $stmt->execute();
        return $stmt->get_result();
    }

    /** SEARCH dokter berdasarkan nama atau spesialisasi */
    public function search($keyword) {
        $query = "SELECT d.*, u.username, u.nama_lengkap 
                  FROM {$this->table_name} d
                  LEFT JOIN users u ON d.user_id = u.id 
                  WHERE d.spesialisasi LIKE ? OR u.nama_lengkap LIKE ?
                  ORDER BY d.id DESC";
        $stmt = $this->conn->prepare($query);
        if (!$stmt) return false;

        $search_term = "%{$keyword}%";
        $stmt->bind_param("ss", $search_term, $search_term);
        $stmt->execute();
        return $stmt->get_result();
    }

    /** GET semua jenis spesialisasi */
    public function getAllSpesialisasi() {
        $query = "SELECT DISTINCT spesialisasi FROM {$this->table_name} ORDER BY spesialisasi";
        return $this->conn->query($query);
    }
}
