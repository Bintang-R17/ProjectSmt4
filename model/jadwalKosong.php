<?php
class HariKosong {
    private $conn;
    public $id_dokter;
    public $hari;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function simpanHariKosong($hari_list) {
        $stmt = $this->conn->prepare("DELETE FROM hari_kosong WHERE id_dokter = ?");
        $stmt->bind_param("i", $this->id_dokter);
        $stmt->execute();

        $stmt = $this->conn->prepare("INSERT INTO hari_kosong (id_dokter, hari) VALUES (?, ?)");
        foreach ($hari_list as $hari) {
            $stmt->bind_param("is", $this->id_dokter, $hari);
            $stmt->execute();
        }
    }
}
