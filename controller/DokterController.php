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


    
}
?>