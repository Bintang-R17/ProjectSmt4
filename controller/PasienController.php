<?php 

require_once __DIR__ . '/../autoload/autoloads.php';
class PasienController {
    public function registerPasien() {
        require __DIR__ . '/../view/admin/create/pasien.php';
    }

    public function registerProcess() {
    startSession();

    $user_id = $_SESSION['register_user_id'] ?? null;

if (!$user_id) {
    echo "Session user tidak ditemukan.";
    exit;
}

    // Ambil data dari form
    $nik = $_POST['nik'] ?? '';
    $alamat = $_POST['alamat'] ?? '';
    $tanggal_lahir = $_POST['tanggal_lahir'] ?? '';

    // Include model
    require_once __DIR__ . '/../model/pasien.php';
    require_once __DIR__ . '/../config/database.php';

    // Koneksi database
    $database = new Database();
    $db = $database->getConnection();

    // Buat objek model Pasien
    $pasien = new Pasien($db);
    $pasien->user_id = $user_id;
    $pasien->nik = $nik;
    $pasien->alamat = $alamat;
    $pasien->tanggal_lahir = $tanggal_lahir;
    
    // Simpan ke database
    if ($pasien->create()) {
        header('Location: index.php?page=dashboard-admin');
        exit;
    } else {
        echo "Gagal menyimpan data dokter.";
    }
}


    
}
?>