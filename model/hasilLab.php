<?php

// Model Hasil Lab
class HasilLab
{
    private $conn;
    private $table = 'hasil_lab';

    public $id;
    public $pasien_id;
    public $tanggal;
    public $jenis_pemeriksaan;
    public $nilai;
    public $satuan;
    public $catatan;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create()
    {
        $query = "INSERT INTO " . $this->table . " 
                 SET pasien_id = :pasien_id, tanggal = :tanggal, jenis_pemeriksaan = :jenis_pemeriksaan, 
                     nilai = :nilai, satuan = :satuan, catatan = :catatan";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':pasien_id', $this->pasien_id);
        $stmt->bindParam(':tanggal', $this->tanggal);
        $stmt->bindParam(':jenis_pemeriksaan', $this->jenis_pemeriksaan);
        $stmt->bindParam(':nilai', $this->nilai);
        $stmt->bindParam(':satuan', $this->satuan);
        $stmt->bindParam(':catatan', $this->catatan);

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
            $this->tanggal = $row['tanggal'];
            $this->jenis_pemeriksaan = $row['jenis_pemeriksaan'];
            $this->nilai = $row['nilai'];
            $this->satuan = $row['satuan'];
            $this->catatan = $row['catatan'];
        }
    }

    public function update()
    {
        $query = "UPDATE " . $this->table . " 
                 SET pasien_id = :pasien_id, tanggal = :tanggal, jenis_pemeriksaan = :jenis_pemeriksaan, 
                     nilai = :nilai, satuan = :satuan, catatan = :catatan 
                 WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':pasien_id', $this->pasien_id);
        $stmt->bindParam(':tanggal', $this->tanggal);
        $stmt->bindParam(':jenis_pemeriksaan', $this->jenis_pemeriksaan);
        $stmt->bindParam(':nilai', $this->nilai);
        $stmt->bindParam(':satuan', $this->satuan);
        $stmt->bindParam(':catatan', $this->catatan);

        return $stmt->execute();
    }

    public function delete()
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }

    // Get hasil lab by pasien
    public function getByPasien($pasien_id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE pasien_id = :pasien_id ORDER BY tanggal DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':pasien_id', $pasien_id);
        $stmt->execute();
        return $stmt;
    }
}

?>