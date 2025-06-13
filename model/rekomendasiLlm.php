<?php

class LlmRekomendasi
{
    private $conn;
    private $table = 'llm_rekomendasi';

    public $id;
    public $spk_hasil_id;
    public $diet;
    public $solusi;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create()
    {
        $query = "INSERT INTO " . $this->table . " 
                 SET spk_hasil_id = :spk_hasil_id, diet = :diet, solusi = :solusi";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':spk_hasil_id', $this->spk_hasil_id);
        $stmt->bindParam(':diet', $this->diet);
        $stmt->bindParam(':solusi', $this->solusi);

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
            $this->spk_hasil_id = $row['spk_hasil_id'];
            $this->diet = $row['diet'];
            $this->solusi = $row['solusi'];
        }
    }

    public function update()
    {
        $query = "UPDATE " . $this->table . " 
                 SET spk_hasil_id = :spk_hasil_id, diet = :diet, solusi = :solusi 
                 WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':spk_hasil_id', $this->spk_hasil_id);
        $stmt->bindParam(':diet', $this->diet);
        $stmt->bindParam(':solusi', $this->solusi);

        return $stmt->execute();
    }

    public function delete()
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }

    // Get rekomendasi by spk hasil
    public function getBySpkHasil($spk_hasil_id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE spk_hasil_id = :spk_hasil_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':spk_hasil_id', $spk_hasil_id);
        $stmt->execute();
        return $stmt;
    }
}


?>