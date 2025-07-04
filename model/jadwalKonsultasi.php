    <?php

    class JadwalKonsultasi
    {
        private $conn;
        private $table = 'jadwal_konsultasi';

        public $id;
        public $id_dokter;
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

            $stmt->bindParam(':dokter_id', $this->id_dokter);
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

        public function readOne($id) {
            $query = "SELECT * FROM jadwal_konsultasi WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc(); 
        }


        public function update()
        {
            $query = "UPDATE " . $this->table . " 
                    SET dokter_id = :dokter_id, pasien_id = :pasien_id, waktu = :waktu, status = :status 
                    WHERE id = :id";

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':dokter_id', $this->id_dokter);
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

        public function getJadwal() {
        $stmt = $this->conn->prepare("SELECT * FROM jadwal_konsultasi WHERE id_dokter = ?");
        $stmt->bind_param("i", $this->id_dokter);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
            public function buatJadwal($id_dokter, $id_pasien, $nama_pasien, $tanggal, $jam) {
        $stmt = $this->conn->prepare("INSERT INTO jadwal_konsultasi (id_dokter, id_pasien, nama_pasien, tanggal, jam) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iisss", $id_dokter, $id_pasien, $nama_pasien, $tanggal, $jam);
        $stmt->execute();
    }

    public function getRekamMedis() {
    $query = "
        SELECT 
            jk.id AS id_jadwal,
            jk.tanggal,
            jk.jam,
            u.nama_lengkap AS nama_pasien,
            hp.keluhan,
            hp.diagnosa,
            hp.tindakan,
            hp.obat,
            hp.dosis
        FROM hasil_pemeriksaan hp
        JOIN jadwal_konsultasi jk ON hp.konsultasi_id = jk.id
        JOIN pasien p ON jk.id_pasien = p.id
        JOIN users u ON p.user_id = u.id
        WHERE jk.status = 'selesai'
        ORDER BY jk.tanggal DESC, jk.jam DESC
    ";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

    public function getRekamMedisByUser($user_id) {
    $query = "
        SELECT 
            jk.id AS id_jadwal,
            jk.tanggal,
            jk.jam,
            u.nama_lengkap AS nama_pasien,
            hp.keluhan,
            hp.diagnosa,
            hp.tindakan,
            hp.obat,
            hp.dosis
        FROM hasil_pemeriksaan hp
        JOIN jadwal_konsultasi jk ON hp.konsultasi_id = jk.id
        JOIN pasien p ON jk.id_pasien = p.id
        JOIN users u ON p.user_id = u.id
        WHERE jk.status = 'selesai' AND u.id = ?
        ORDER BY jk.tanggal DESC, jk.jam DESC
    ";

    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

    public function getHariKosong($id_dokter) {
        $result = mysqli_query($this->conn, "SELECT hari FROM hari_kosong WHERE id_dokter = $id_dokter");
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    
    }

    ?>