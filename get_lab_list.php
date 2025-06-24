<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'config/database.php';
session_start();

$db = new Database();
$conn = $db->getConnection();

// Cek koneksi
if (!$conn) {
    echo json_encode(['error' => 'Koneksi database gagal']);
    exit;
}

// Optional: Validasi user
$userId = $_SESSION['user_id'] ?? null;
$role = $_SESSION['role'] ?? '';

// if (!$userId) {
//     echo json_encode(['error' => 'User tidak terautentikasi']);
//     exit;
// }

$sql = "
SELECT 
    hl.id AS hasil_lab_id,
    hl.tanggal,
    hl.catatan,
    jp.nama AS jenis_pemeriksaan,
    p.id AS pasien_id,
    p.nik,
    p.alamat,
    u.nama_lengkap AS nama_pasien
FROM hasil_lab hl
JOIN jenis_pemeriksaan jp ON hl.jenis_id = jp.id
JOIN pasien p ON hl.pasien_id = p.id
JOIN users u ON p.user_id = u.id
";


// Prepare SQL
$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo json_encode([
        'error' => 'Gagal prepare SQL',
        'details' => $conn->error  // tampilkan error SQL yang sebenarnya
    ]);
    exit;
}

$stmt->execute();
$result = $stmt->get_result();

// Cek result
if (!$result) {
    echo json_encode([
        'error' => 'Gagal mengambil hasil',
        'details' => $stmt->error
    ]);
    exit;
}

// Ambil data
$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Kirim JSON
header('Content-Type: application/json');
echo json_encode($data);
