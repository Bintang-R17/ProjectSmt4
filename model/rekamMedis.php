<?php

class RekamMedis
{
    private $conn;
    private $table = 'rekam_medis';

    public $id;
    public $pasien_id;
    public $dokter_id;
    public $tanggal;
    public $keluhan;
    public $diagnosa;
    public $tindakan;
    public $resep_obat;
    public $hasil_lab;
    public $anjuran;
    public $rujukan;
    public $created_at;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create()
    {
        $query = "INSERT INTO " . $this->table . " 
                 SET pasien_id = :pasien_id, dokter_id = :dokter_id, tanggal = :tanggal, 
                     keluhan = :keluhan, diagnosa = :diagnosa, tindakan = :tindakan, 
                     resep_obat = :resep_obat, hasil_lab = :hasil_lab, anjuran = :anjuran, 
                     rujukan = :rujukan, created_at = NOW()";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':pasien_id', $this->pasien_id);
        $stmt->bindParam(':dokter_id', $this->dokter_id);
        $stmt->bindParam(':tanggal', $this->tanggal);
        $stmt->bindParam(':keluhan', $this->keluhan);
        $stmt->bindParam(':diagnosa', $this->diagnosa);
        $stmt->bindParam(':tindakan', $this->tindakan);
        $stmt->bindParam(':resep_obat', $this->resep_obat);
        $stmt->bindParam(':hasil_lab', $this->hasil_lab);
        $stmt->bindParam(':anjuran', $this->anjuran);
        $stmt->bindParam(':rujukan', $this->rujukan);

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
            $this->tanggal = $row['tanggal'];
            $this->keluhan = $row['keluhan'];
            $this->diagnosa = $row['diagnosa'];
            $this->tindakan = $row['tindakan'];
            $this->resep_obat = $row['resep_obat'];
            $this->hasil_lab = $row['hasil_lab'];
            $this->anjuran = $row['anjuran'];
            $this->rujukan = $row['rujukan'];
            $this->created_at = $row['created_at'];
        }
    }

    public function update()
    {
        $query = "UPDATE " . $this->table . " 
                 SET pasien_id = :pasien_id, dokter_id = :dokter_id, tanggal = :tanggal, 
                     keluhan = :keluhan, diagnosa = :diagnosa, tindakan = :tindakan, 
                     resep_obat = :resep_obat, hasil_lab = :hasil_lab, anjuran = :anjuran, 
                     rujukan = :rujukan 
                 WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':pasien_id', $this->pasien_id);
        $stmt->bindParam(':dokter_id', $this->dokter_id);
        $stmt->bindParam(':tanggal', $this->tanggal);
        $stmt->bindParam(':keluhan', $this->keluhan);
        $stmt->bindParam(':diagnosa', $this->diagnosa);
        $stmt->bindParam(':tindakan', $this->tindakan);
        $stmt->bindParam(':resep_obat', $this->resep_obat);
        $stmt->bindParam(':hasil_lab', $this->hasil_lab);
        $stmt->bindParam(':anjuran', $this->anjuran);
        $stmt->bindParam(':rujukan', $this->rujukan);

        return $stmt->execute();
    }

    public function delete()
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }

    // Get rekam medis by pasien
    public function getByPasien($pasien_id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE pasien_id = :pasien_id ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':pasien_id', $pasien_id);
        $stmt->execute();
        return $stmt;
    }
}



?>