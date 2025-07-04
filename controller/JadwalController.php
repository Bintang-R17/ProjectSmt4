<?php

require_once __DIR__ . '/../autoload/autoloads.php';


class JadwalController {
    public function index() {
    $db = (new Database())->getConnection();
    $konsultasiModel = new Konsultasi($db);
    $jadwalModel = new JadwalKonsultasi($db);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_konsultasi = $_POST['id_konsultasi'] ?? null;
        $tanggal = $_POST['tanggal'] ?? '';
        $jam = $_POST['jam'] ?? '';

        $dataKons = $konsultasiModel->getDetail($id_konsultasi);
        if ($dataKons) {
            $jadwalModel->buatJadwal(
                $dataKons['dokter_id'],
                $dataKons['id_pasien'],      
                $dataKons['nama_pasien'],
                $tanggal,
                $jam
            );
            $konsultasiModel->updateStatus($id_konsultasi, 'terjadwal');
            
        }
    }

    // Ambil daftar permintaan konsultasi menunggu
    $permintaan = $konsultasiModel->getMenunggu();

    require __DIR__ . '/../view/petugas/jadwalkan.php';
}

public function updateStatus() {
    $db = (new Database())->getConnection();
    $konsultasiModel = new Konsultasi($db);

    $id_konsultasi = isset($_GET['id']) ? (int)$_GET['id'] : 0;

    if ($id_konsultasi > 0) {
        $konsultasiModel->updateStatus($id_konsultasi, 'selesai');
        echo "<script>alert('Status berhasil diperbarui ke selesai!'); window.location.href='?page=jadwal';</script>";
    } else {
        echo "<p style='color:red;'>ID konsultasi tidak valid.</p>";
    }
}

public function formPemeriksaan() {
    $id_konsultasi = $_GET['id'] ?? null;
    if (!$id_konsultasi) {
        echo "ID tidak ditemukan.";
        return;
    }

    require __DIR__ . '/../view/dokter/form-pemeriksaan.php';
}

public function simpanPemeriksaan() {
    $db = (new Database())->getConnection();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $konsultasi_id = $_POST['konsultasi_id'] ?? null;
        $keluhan = $_POST['keluhan'] ?? '';
        $diagnosa = $_POST['diagnosa'] ?? '';
        $tindakan = $_POST['tindakan'] ?? '';
        $obat = $_POST['obat'] ?? '';
        $dosis = $_POST['dosis'] ?? '';

        // 1. Simpan hasil pemeriksaan
        $stmt = $db->prepare("INSERT INTO hasil_pemeriksaan (konsultasi_id, keluhan, diagnosa, tindakan, obat, dosis) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssss", $konsultasi_id, $keluhan, $diagnosa, $tindakan, $obat, $dosis);
        $stmt->execute();

        // 2. Ubah status di jadwal_konsultasi jadi 'selesai'
        $update = $db->prepare("UPDATE jadwal_konsultasi SET status = 'selesai' WHERE id = ?");
        $update->bind_param("i", $konsultasi_id);
        $update->execute();

        // 3. Redirect atau notifikasi
        header("Location: index.php?page=list-jadwal");
        exit;
    }
}

public function rekamMedisPasien($pasien_id) {
    $db = (new Database())->getConnection();
    $hasilModel = new HasilPemeriksaan($db);

    // gunakan method khusus untuk ambil hasil berdasarkan pasien
    $rekam_medis = $hasilModel->getByPasienId($pasien_id);

    require __DIR__ . '/../view/dokter/rekam-medis.php';
}


    public function listJadwal() {
        $id_dokter = 7; // simulasi id dokter login
        
        $database = new Database();
        $db = $database->getConnection();

        // Proses POST jika ada
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['hari_kosong'])) {
            $hariModel = new HariKosong($db);
            $hariModel->id_dokter = $id_dokter;
            $hariModel->simpanHariKosong($_POST['hari_kosong']);
        }

        // Ambil jadwal
        $jadwalModel = new JadwalKonsultasi($db);
        $jadwalModel->id_dokter = $id_dokter;
        $jadwal = $jadwalModel->getJadwal();

        // Tampilkan view
        require __DIR__ . '/../view/dokter/list-jadwal.php';
    }
    public function mintaKonsultasi() {
    $db = (new Database())->getConnection();
    $dokterModel = new Dokter($db);
    $konsultasiModel = new Konsultasi($db);

    // Pastikan session aktif
    startSession();

    // Debug session user_id
    echo '<pre>';
    print_r($_SESSION);
    echo '</pre>';

    $user_id = $_SESSION['user_id'] ?? null;

    if (!$user_id) {
        die("User belum login.");
    }

    // Cek apakah user sudah punya entri di tabel pasien
    $query = mysqli_query($db, "SELECT id FROM pasien WHERE user_id = $user_id");
    $data = mysqli_fetch_assoc($query);

    if (!$data) {
        die("Pasien tidak ditemukan. Silakan lengkapi data diri terlebih dahulu.");
    }

    $id_pasien = $data['id'];

    // Proses kirim request konsultasi
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_dokter = $_POST['id_dokter'] ?? null;
        if ($id_dokter) {
            $konsultasiModel->requestJadwal($id_pasien, $id_dokter);
            echo "<script>alert('Permintaan konsultasi berhasil dikirim!');</script>";
        }
    }

    // Tampilkan daftar dokter
    $list_dokter = $dokterModel->readAll();
    require __DIR__ . '/../view/pasien/request-jadwal.php';
}

}
