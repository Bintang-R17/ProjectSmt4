<?php
// models/Petugas.php
require_once __DIR__ . '/../autoload/autoloads.php';

class Petugas extends User {
    private $table_name = "petugas";

    public $id;
    public $user_id;
    public $kontak;

    public function __construct($db) {
        parent::__construct(); 
    }

    // CREATE
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET user_id=?, kontak=?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("is", $this->user_id, $this->kontak);

        if($stmt->execute()) {
            $this->id = $this->conn->insert_id;
            return true;
        }
        return false;
    }

    // READ ALL
    public function readAll() {
        $query = "SELECT p.*, u.username, u.nama_lengkap 
                  FROM " . $this->table_name . " p
                  LEFT JOIN users u ON p.user_id = u.id 
                  ORDER BY p.id DESC";
        $result = $this->conn->query($query);
        return $result;
    }

    // READ ONE
    public function readOne() {
        $query = "SELECT p.*, u.username, u.nama_lengkap 
                  FROM " . $this->table_name . " p
                  LEFT JOIN users u ON p.user_id = u.id 
                  WHERE p.id = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        if($row) {
            $this->user_id = $row['user_id'];
            $this->kontak = $row['kontak'];
            return $row;
        }
        return false;
    }

    // UPDATE
    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                kontak=? 
                WHERE id=?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si",  $this->kontak, $this->id);

        return $stmt->execute();
    }

    // DELETE
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id);
        
        return $stmt->execute();
    }

    // GET BY USER ID
    public function getByUserId($user_id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE user_id = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        if($row) {
            $this->id = $row['id'];
            $this->user_id = $row['user_id'];
            $this->kontak = $row['kontak'];
            return true;
        }
        return false;
    }

    // SEARCH
    public function search($keyword) {
        $query = "SELECT p.*, u.username, u.nama_lengkap 
                  FROM " . $this->table_name . " p
                  LEFT JOIN users u ON p.user_id = u.id 
                  WHERE u.nama_lengkap LIKE ? OR p.kontak LIKE ?
                  ORDER BY p.id DESC";
        $stmt = $this->conn->prepare($query);
        $search_term = "%{$keyword}%";
        $stmt->bind_param("sss", $search_term, $search_term, $search_term);
        $stmt->execute();
        
        return $stmt->get_result();
    }
}
?>