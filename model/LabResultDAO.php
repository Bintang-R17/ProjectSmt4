<?php

/**
 * Lab Results Data Access Object
 * Mengelola akses data hasil laboratorium
 */
class LabResultsDAO {
    private $conn;
    
    public function __construct($connection) {
        $this->conn = $connection;
    }
    
    /**
     * Mengambil hasil lab berdasarkan ID
     * 
     * @param int $hasil_lab_id ID hasil lab
     * @return array Data hasil lab
     * @throws Exception Jika query gagal
     */
    public function getLabResultById($hasil_lab_id) {
        $sql = "
        SELECT 
            pp.nama_parameter,
            pp.satuan,
            hp.nilai,
            pp.jenis_id,
            jp.nama AS nama_jenis,
            pp.nilai_min,
            pp.nilai_max
        FROM hasil_parameter hp
        JOIN parameter_pemeriksaan pp ON hp.parameter_id = pp.id
        JOIN jenis_pemeriksaan jp ON pp.jenis_id = jp.id
        WHERE hp.hasil_lab_id = ?
        ORDER BY jp.nama, pp.nama_parameter
        ";

        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $this->conn->error);
        }

        $stmt->bind_param("i", $hasil_lab_id);
        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }

        $result = $stmt->get_result();
        if (!$result) {
            throw new Exception("Get result failed: " . $stmt->error);
        }
        
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        
        return $data;
    }
    
    /**
     * Mengambil informasi pasien berdasarkan ID hasil lab
     * 
     * @param int $hasil_lab_id ID hasil lab
     * @return array|null Data pasien atau null jika tidak ditemukan
     * @throws Exception Jika query gagal
     */
    public function getAllLabResultsWithParameters($user_id) {
    $sql = "SELECT 
    hl.id AS hasil_lab_id,
    hl.tanggal,
    hl.catatan,
    jp.nama AS jenis_pemeriksaan,
    
    pp.nama_parameter,
    pp.satuan,
    hp.nilai,
    pp.nilai_min,
    pp.nilai_max,

    u.nama_lengkap AS nama_pasien,
    p.nik,
    p.alamat,
    p.tanggal_lahir

FROM hasil_lab hl
JOIN jenis_pemeriksaan jp ON hl.jenis_id = jp.id
JOIN hasil_parameter hp ON hl.id = hp.hasil_lab_id
JOIN parameter_pemeriksaan pp ON hp.parameter_id = pp.id
JOIN users u ON hl.user_id = u.id
LEFT JOIN pasien p ON u.id = p.user_id

WHERE hl.user_id = ?
ORDER BY hl.tanggal DESC, hasil_lab_id, pp.nama_parameter;
";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    return $data;
}

    
    /**
     * Mengambil semua hasil lab untuk user tertentu
     * 
     * @param int $user_id ID user
     * @param int $limit Limit data
     * @param int $offset Offset data
     * @return array Data hasil lab
     * @throws Exception Jika query gagal
     */
    public function getLabResultsByUserId($user_id, $limit = 10, $offset = 0) {
        $sql = "
        SELECT 
            hl.id,
            hl.tanggal,
            hl.catatan,
            jp.nama AS jenis_pemeriksaan,
            COUNT(hp.id) as jumlah_parameter
        FROM hasil_lab hl
        JOIN jenis_pemeriksaan jp ON hl.jenis_id = jp.id
        LEFT JOIN hasil_parameter hp ON hl.id = hp.hasil_lab_id
        WHERE hl.user_id = ?
        GROUP BY hl.id, hl.tanggal, hl.catatan, jp.nama
        ORDER BY hl.tanggal DESC
        LIMIT ? OFFSET ?
        ";

        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $this->conn->error);
        }

        $stmt->bind_param("iii", $user_id, $limit, $offset);
        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }

        $result = $stmt->get_result();
        if (!$result) {
            throw new Exception("Get result failed: " . $stmt->error);
        }
        
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        
        $stmt->close();
        return $data;
    }
    
    /**
     * Menyimpan hasil lab baru
     * 
     * @param array $labData Data hasil lab
     * @return int ID hasil lab yang baru disimpan
     * @throws Exception Jika penyimpanan gagal
     */
    public function saveLabResult($labData) {
        $sql = "INSERT INTO hasil_lab (user_id, jenis_id, tanggal, catatan) VALUES (?, ?, ?, ?)";
        
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $this->conn->error);
        }
        
        $stmt->bind_param("iiss", 
            $labData['user_id'], 
            $labData['jenis_id'], 
            $labData['tanggal'], 
            $labData['catatan']
        );
        
        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }
        
        $insert_id = $this->conn->insert_id;
        $stmt->close();
        
        return $insert_id;
    }
    
    /**
     * Menyimpan parameter hasil lab
     * 
     * @param int $hasil_lab_id ID hasil lab
     * @param array $parameters Array parameter
     * @return bool True jika berhasil
     * @throws Exception Jika penyimpanan gagal
     */
    public function saveLabParameters($hasil_lab_id, $parameters) {
        $sql = "INSERT INTO hasil_parameter (hasil_lab_id, parameter_id, nilai) VALUES (?, ?, ?)";
        
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $this->conn->error);
        }
        
        foreach ($parameters as $param) {
            $stmt->bind_param("iis", $hasil_lab_id, $param['parameter_id'], $param['nilai']);
            if (!$stmt->execute()) {
                throw new Exception("Execute failed for parameter: " . $stmt->error);
            }
        }
        
        $stmt->close();
        return true;
    }
    
    /**
     * Validasi akses user ke hasil lab
     * 
     * @param int $hasil_lab_id ID hasil lab
     * @param int $user_id ID user
     * @return bool True jika user memiliki akses
     */
    public function validateUserAccess($hasil_lab_id, $user_id) {
        $sql = "SELECT id FROM hasil_lab WHERE id = ? AND user_id = ?";
        
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            return false;
        }
        
        $stmt->bind_param("ii", $hasil_lab_id, $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $hasAccess = $result->num_rows > 0;
        $stmt->close();
        
        return $hasAccess;
    }
}

?>