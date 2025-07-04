<?php
class Rujukan {
    private $conn;
    private $table = 'rujukan';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($data) {
        $query = "INSERT INTO {$this->table} 
            (id_pasien, id_dokter_pengirim, hasil_pemeriksaan_id, tanggal_rujukan, alasan, catatan, status, created_at) 
            VALUES (?, ?, ?, ?, CURDATE(), ?, ?, 'dikirim', NOW())";

        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            $data['id_pasien'],
            $data['id_dokter_pengirim'],
            $data['hasil_pemeriksaan_id'],
            $data['alasan'],
            $data['catatan']
        ]);
    }

    public function getAllDokter($excludeId) {
        $query = "SELECT d.id, u.nama_lengkap 
                  FROM dokter d
                  JOIN users u ON d.user_id = u.id
                  WHERE d.id != ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$excludeId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllWithDetail() {
    $query = "
        SELECT r.*, 
               u.nama_lengkap AS nama_pasien,
               d.nama_lengkap AS nama_dokter,
               h.keluhan, h.diagnosa, h.tindakan, h.obat, h.dosis
        FROM rujukan r
        JOIN pasien p ON r.id_pasien = p.id
        JOIN users u ON p.user_id = u.id
        JOIN dokter dr ON r.id_dokter_pengirim = dr.id
        JOIN users d ON dr.user_id = d.id
        JOIN hasil_pemeriksaan h ON r.hasil_pemeriksaan_id = h.id
        ORDER BY r.created_at DESC
    ";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_all(MYSQLI_ASSOC);
}


}
