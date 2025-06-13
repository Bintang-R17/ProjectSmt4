<?php

// Model SPK Hasil (Sistem Pendukung Keputusan)
class SpkHasil
{
    private $conn;
    private $table = 'spk_hasil';

    public $id;
    public $hasil_lab_id;
    public $prediksi;
    public $confidence;
    public $created_at;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create()
    {
        $query = "INSERT INTO " . $this->table . " 
                 SET hasil_lab_id = :hasil_lab_id, prediksi = :prediksi, confidence = :confidence, 
                     created_at = NOW()";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':hasil_lab_id', $this->hasil_lab_id);
        $stmt->bindParam(':prediksi', $this->prediksi);
        $stmt->bindParam(':confidence', $this->confidence);

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
            $this->hasil_lab_id = $row['hasil_lab_id'];
            $this->prediksi = $row['prediksi'];
            $this->confidence = $row['confidence'];
            $this->created_at = $row['created_at'];
        }
    }

    public function update()
    {
        $query = "UPDATE " . $this->table . " 
                 SET hasil_lab_id = :hasil_lab_id, prediksi = :prediksi, confidence = :confidence 
                 WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':hasil_lab_id', $this->hasil_lab_id);
        $stmt->bindParam(':prediksi', $this->prediksi);
        $stmt->bindParam(':confidence', $this->confidence);

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