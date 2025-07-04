<?php
// models/Pasien.php
require_once __DIR__ . '/../autoload/autoloads.php';

class Pasien extends User {
    private $table_name = "pasien";

    public $id;
    public $user_id;
    public $nik;
    public $alamat;
    public $tanggal_lahir;

    public function __construct($db) {
    parent::__construct(); // 
    }

    // CREATE
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET user_id=?, nik=?, alamat=?, tanggal_lahir=?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("isss", 
            $this->user_id, 
            $this->nik, 
            $this->alamat, 
            $this->tanggal_lahir
        );

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
    public function readOne($id = null) {
        $id = $id ?? $this->id;
        $query = "SELECT p.*, u.nama_lengkap FROM pasien p 
                JOIN users u ON p.user_id = u.id 
                WHERE p.id = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc(); // return array
    }


    // UPDATE
    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET nik=?, alamat=?, tanggal_lahir=? 
                  WHERE id=?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssi", 
            $this->nik, 
            $this->alamat, 
            $this->tanggal_lahir, 
            $this->id
        );

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
            $this->nik = $row['nik'];
            $this->alamat = $row['alamat'];
            $this->tanggal_lahir = $row['tanggal_lahir'];
            return true;
        }
        return false;
    }

    // GET BY NIK
    public function getByNik($nik) {
        $query = "SELECT p.*, u.username, u.nama_lengkap 
                  FROM " . $this->table_name . " p
                  LEFT JOIN users u ON p.user_id = u.id 
                  WHERE p.nik = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $nik);
        $stmt->execute();
        
        return $stmt->get_result();
    }

    // SEARCH
    public function search($keyword) {
        $query = "SELECT p.*, u.username, u.nama_lengkap 
                  FROM " . $this->table_name . " p
                  LEFT JOIN users u ON p.user_id = u.id 
                  WHERE p.nik LIKE ? OR u.nama_lengkap LIKE ? OR p.alamat LIKE ?
                  ORDER BY p.id DESC";
        $stmt = $this->conn->prepare($query);
        $search_term = "%{$keyword}%";
        $stmt->bind_param("sss", $search_term, $search_term, $search_term);
        $stmt->execute();
        
        return $stmt->get_result();
    }

    // models/Pasien.php

public function getLabDetailsWithParametersByUserId($user_id) {
    $query = "
        SELECT 
            hl.id AS hasil_lab_id,
            hl.tanggal,
            hl.catatan,
            jp.nama AS jenis_pemeriksaan,
            hp.nama_parameter,
            hp.nilai,
            hp.nilai_min,
            hp.nilai_max,
            hp.satuan
        FROM pasien p
        JOIN hasil_lab hl ON hl.pasien_id = p.id
        JOIN jenis_pemeriksaan jp ON hl.jenis_id = jp.id
        JOIN hasil_parameter hp ON hp.hasil_lab_id = hl.id
        WHERE p.user_id = ?
        ORDER BY hl.tanggal DESC, hl.id, hp.nama_parameter
    ";

    $stmt = $this->conn->prepare($query);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_all(MYSQLI_ASSOC);
}

}
?>