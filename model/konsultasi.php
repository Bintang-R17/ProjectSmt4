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
}

?>