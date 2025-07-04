<?php

class Konsultasi
{
    private $conn;
    private $table = 'konsultasi';

    public $id;
    public $pasien_id;
    public $dokter_id;
    public $keluhan;
    public $tanggal_konsultasi;
    public $status;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create()
    {
        $query = "INSERT INTO " . $this->table . " 
                 SET pasien_id = :pasien_id, dokter_id = :dokter_id, keluhan = :keluhan, 
                     tanggal_konsultasi = :tanggal_konsultasi, status = :status";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':pasien_id', $this->pasien_id);
        $stmt->bindParam(':dokter_id', $this->dokter_id);
        $stmt->bindParam(':keluhan', $this->keluhan);
        $stmt->bindParam(':tanggal_konsultasi', $this->tanggal_konsultasi);
        $stmt->bindParam(':status', $this->status);

        return $stmt->execute();
    }

    public function readAll()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readOne()
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        $row = $result->fetch_assoc(); // jika pakai ->get_result()
        if ($row) {
            $this->pasien_id = $row['pasien_id'];
            $this->dokter_id = $row['dokter_id'];
            $this->keluhan = $row['keluhan'];
            $this->tanggal_konsultasi = $row['tanggal_konsultasi'];
            $this->status = $row['status'];
        }
    }

    public function update()
    {
        $query = "UPDATE " . $this->table . " 
                 SET pasien_id = :pasien_id, dokter_id = :dokter_id, keluhan = :keluhan, 
                     tanggal_konsultasi = :tanggal_konsultasi, status = :status 
                 WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':pasien_id', $this->pasien_id);
        $stmt->bindParam(':dokter_id', $this->dokter_id);
        $stmt->bindParam(':keluhan', $this->keluhan);
        $stmt->bindParam(':tanggal_konsultasi', $this->tanggal_konsultasi);
        $stmt->bindParam(':status', $this->status);

        return $stmt->execute();
    }

    public function delete()
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }
    public function getMenunggu() {
    $sql = "
        SELECT 
            k.id, 
            up.username AS username_pasien,
            up.nama_lengkap AS nama_pasien, 
            ud.nama_lengkap AS nama_dokter,
            k.dokter_id,
            k.pasien_id
        FROM konsultasi k
        JOIN pasien p ON p.id = k.pasien_id
        JOIN users up ON up.id = p.user_id
        JOIN dokter d ON d.id = k.dokter_id
        JOIN users ud ON ud.id = d.user_id
        WHERE k.status = 'menunggu'
    ";

    $result = mysqli_query($this->conn, $sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}


    public function getDetail($id) {
    $sql = "SELECT k.*, u.username AS nama_pasien, p.id AS id_pasien
            FROM konsultasi k
            JOIN pasien p ON k.pasien_id = p.id
            JOIN users u ON u.id = p.user_id
            WHERE k.id = $id
            ";
    $result = mysqli_query($this->conn, $sql);
    return mysqli_fetch_assoc($result);
}


    public function updateStatus($id, $status) {
        echo "Status = '$status' (len: " . strlen($status) . ")<br>";
        $stmt = $this->conn->prepare("UPDATE konsultasi SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $status, $id);
        $stmt->execute();
    }

    public function requestJadwal($id_pasien, $id_dokter) {
        $stmt = $this->conn->prepare("INSERT INTO konsultasi (pasien_id, dokter_id, status) VALUES (?, ?, 'menunggu')");
        $stmt->bind_param("ii", $id_pasien, $id_dokter);
        $stmt->execute();   
    }
}

?>