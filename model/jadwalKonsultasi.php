<?php

class JadwalKonsultasi
{
    private $conn;
    private $table = 'jadwal_konsultasi';

    public $id;
    public $dokter_id;
    public $pasien_id;
    public $waktu;
    public $status;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create()
    {
        $query = "INSERT INTO " . $this->table . " 
                 SET dokter_id = :dokter_id, pasien_id = :pasien_id, waktu = :waktu, status = :status";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':dokter_id', $this->dokter_id);
        $stmt->bindParam(':pasien_id', $this->pasien_id);
        $stmt->bindParam(':waktu', $this->waktu);
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
            $this->dokter_id = $row['dokter_id'];
            $this->pasien_id = $row['pasien_id'];
            $this->waktu = $row['waktu'];
            $this->status = $row['status'];
        }
    }

    public function update()
    {
        $query = "UPDATE " . $this->table . " 
                 SET dokter_id = :dokter_id, pasien_id = :pasien_id, waktu = :waktu, status = :status 
                 WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':dokter_id', $this->dokter_id);
        $stmt->bindParam(':pasien_id', $this->pasien_id);
        $stmt->bindParam(':waktu', $this->waktu);
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

    // Get jadwal by dokter
    public function getByDokter($dokter_id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE dokter_id = :dokter_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':dokter_id', $dokter_id);
        $stmt->execute();
        return $stmt;
    }

    // Get jadwal by pasien
    public function getByPasien($pasien_id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE pasien_id = :pasien_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':pasien_id', $pasien_id);
        $stmt->execute();
        return $stmt;
    }
}

?>