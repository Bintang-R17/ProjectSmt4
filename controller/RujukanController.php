<?php
require_once __DIR__ . '/../autoload/autoloads.php';

class RujukanController {
    private $rujukanModel;

    public function __construct() {
        $db = (new Database())->getConnection();
        $this->rujukanModel = new Rujukan($db);
    }
    
    public function createForm() {
    startSession();

    $id_hasil = $_GET['id_hasil'] ?? null;
    $pasien_id = $_GET['pasien_id'] ?? null;
    $dokter_id = $_SESSION['dokter_id'] ?? null;

    // Validasi parameter
    if (!$dokter_id) {
        echo "Parameter 'dokter_id' (dari session) tidak ditemukan.<br>";
        return;
    }
    if (!$pasien_id) {
        echo "Parameter 'pasien_id' (dari URL) tidak ditemukan.<br>";
        return;
    }
    if (!$id_hasil) {
        echo "Parameter 'id_hasil' (dari URL) tidak ditemukan.<br>";
        return;
    }

    // Lolos validasi, teruskan ke form
    require __DIR__ . '/../view/dokter/form-rujukan.php';
}

    public function store() {
    $db = (new Database())->getConnection();

    $pasien_id = $_POST['pasien_id'] ?? null;
    $hasil_id = $_POST['hasil_id'] ?? null;
    $dokter_id = $_SESSION['dokter_id'] ?? null;
    $catatan = $_POST['catatan'] ?? '';
    $alasan = $_POST['alasan'] ?? ''; // <- tambahkan ini

    if (!$pasien_id || !$dokter_id || !$hasil_id) {
        echo "Parameter tidak lengkap.<br>";
        echo "dokter_id: $dokter_id<br>";
        echo "hasil_id: $hasil_id<br>";
        echo "pasien_id: $pasien_id<br>";
        return;
    }

    $query = "
        INSERT INTO rujukan (
            id_dokter_pengirim, 
            id_pasien, 
            hasil_pemeriksaan_id, 
            catatan, 
            alasan,
            tanggal_rujukan
        ) VALUES (?, ?, ?, ?, ?, CURDATE())
    ";

    $stmt = $db->prepare($query);
    if (!$stmt) {
        echo "Gagal menyiapkan query: " . $db->error;
        return;
    }

    $stmt->bind_param("iiiss", $dokter_id, $pasien_id, $hasil_id, $catatan, $alasan);

    if ($stmt->execute()) {
        echo "✅ Rujukan berhasil dikirim.";
    } else {
        echo "❌ Gagal menyimpan rujukan: " . $stmt->error;
    }
}

    public function listRujukanPetugas() {
    $db = (new Database())->getConnection();
    $model = new Rujukan($db);

    $data_rujukan = $model->getAllWithDetail();

    require __DIR__ . '/../view/petugas/list-rujukan.php';
}


}
