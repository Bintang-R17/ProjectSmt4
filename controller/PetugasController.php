<?php 

require_once __DIR__ . '/../autoload/autoloads.php';
class PetugasController {
    public function registerPetugas() {
        require __DIR__ . '/../view/admin/create/petugas.php';
    }

    public function registerProcess() {
    startSession();

    $user_id = $_SESSION['register_user_id'] ?? null;

if (!$user_id) {
    echo "Session user tidak ditemukan.";
    exit;
}

    // Ambil data dari form
    $kontak = $_POST['kontak'] ?? '';

    // Koneksi database
    $database = new Database();
    $db = $database->getConnection();

    // Buat objek model petugas
    $petugas = new Petugas($db);
    $petugas->user_id = $user_id;
    $petugas->kontak = $kontak;
    // $petugas->alamat = $alamat; // jika field ini juga ada di tabel dan model
    
    // Simpan ke database
    if ($petugas->create()) {
        header('Location: index.php?page=dashboard-admin');
        exit;
    } else {
        echo "Gagal menyimpan data petugas.";
    }
}


    
}
?>