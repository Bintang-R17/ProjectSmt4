<?php 

class HasilPemeriksaan {
    private $conn;
    private $table = "hasil_pemeriksaan";

    public $id;
    public $id_rekam_medis;
    public $hasil;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getByPasienId($pasien_id) {
    $query = "
        SELECT h.*, 
               DATE(k.tanggal) AS tanggal,
               TIME(k.jam) AS jam,
               u.nama_lengkap AS nama_pasien,
               p.id AS pasien_id
        FROM hasil_pemeriksaan h
        JOIN jadwal_konsultasi k ON h.konsultasi_id = k.id
        JOIN pasien p ON k.id_pasien = p.id
        JOIN users u ON p.user_id = u.id
        WHERE p.id = ?
        ORDER BY k.tanggal DESC
    ";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $pasien_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}


    // Ambil satu hasil berdasarkan id (untuk form rujukan)
    public function getById($id) {
        $query = "SELECT * FROM hasil_pemeriksaan WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

}