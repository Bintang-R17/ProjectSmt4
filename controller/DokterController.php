<?php 
require_once __DIR__ . '/../autoload/autoloads.php';
class DokterController {
    public function registerDokter() {
        require __DIR__ . '/../view/admin/create/dokter.php';
    }

    public function registerProcess() {
    startSession();

    $user_id = $_SESSION['register_user_id'] ?? null;

if (!$user_id) {
    echo "Session user tidak ditemukan.";
    exit;
}

    // Ambil data dari form
    $spesialisasi = $_POST['spesialisasi'] ?? '';

    // Koneksi database
    $database = new Database();
    $db = $database->getConnection();

    // Buat objek model Dokter
    $dokter = new Dokter($db);
    $dokter->user_id = $user_id;
    $dokter->nik = $spesialisasi;
    
    // Simpan ke database
    if ($dokter->create()) {
            // setelah data berhasil ditambahkan
            $_SESSION['success'] = "Data berhasil ditambahkan!";
            header("Location: index.php?page=manage-user");
            exit();
    } else {
        echo "Gagal menyimpan data dokter.";
    }
}

    public function listPasien() {
        $db = new Database();
        $conn = $db->getConnection();
        
        $pasienModel = new Pasien($db);
        $data_pasien = $pasienModel->readAll();

        include __DIR__ . '/../view/dokter/list-pasien.php'; // arahkan ke view list
    }


public function listHasilLabPasien($user_id) {

    // Koneksi ke database
    $database = new Database();
    $db = $database->getConnection();

    // Ambil info pasien (opsional untuk ditampilkan di atas)
    $pasienModel = new Pasien($db);
    $pasien = $pasienModel->getByUserId($user_id); // kamu bisa sesuaikan method-nya

    // Ambil semua hasil lab + parameter
    $labDAO = new LabResultsDAO($db);
    $labData = $labDAO->getAllLabResultsWithParameters($user_id); // method ini kamu sudah punya atau bisa copy dari jawaban sebelumnya

    // Kirim ke view
    require __DIR__ . '/../view/dokter/detail-pasien.php';
}


public function detailPasienByUserId($user_id) {
    require_once __DIR__ . '/../model/Pasien.php';

    $db = (new Database())->getConnection();
    $pasienModel = new Pasien($db);

    // Ambil hasil lab dengan join (via model)
    $labData = $pasienModel->getLabDetailsWithParametersByUserId($user_id);

    // Ambil data pasien untuk header (opsional)
    $pasienData = $pasienModel->getByUserId($user_id) ? $pasienModel : null;

    require __DIR__ . '/../view/dokter/detail-pasien.php';
}









    
}
?>