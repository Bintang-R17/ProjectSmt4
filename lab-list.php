<?php
require_once 'config/database.php';
session_start();

$db = new Database();
$conn = $db->getConnection();

// Cek koneksi
if (!$conn) {
    die("Koneksi database gagal.");
}

// Optional: autentikasi dokter
// $userId = $_SESSION['user_id'] ?? null;
// $role = $_SESSION['role'] ?? '';
// if (!$userId || $role !== 'dokter') {
//     die("Akses ditolak.");
// }

// Query ambil data hasil lab dan pasien (menggunakan struktur baru dengan user_id di hasil_lab)
$sql = "
SELECT 
    hl.id AS hasil_lab_id,
    hl.tanggal,
    hl.catatan,
    jp.nama AS jenis_pemeriksaan,
    u.nama_lengkap AS nama_pasien,
    p.nik,
    p.alamat
FROM hasil_lab hl
JOIN jenis_pemeriksaan jp ON hl.jenis_id = jp.id
JOIN users u ON hl.user_id = u.id
LEFT JOIN pasien p ON u.id = p.user_id
ORDER BY hl.tanggal DESC;    
";

try {
    $result = $conn->query($sql);
    if (!$result) {
        throw new Exception("Error in query: " . $conn->error);
    }
} catch (Exception $e) {
    die("Query error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Hasil Lab</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .table-container {
            max-width: 100%;
            overflow-x: auto;
        }
        .btn-group-sm .btn {
            margin-right: 5px;
        }
    </style>
</head>
<body>
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-list"></i> Daftar Hasil Lab Pasien</h4>
                </div>
                <div class="card-body">
                    <div class="table-container">
                        <table class="table table-bordered table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th width="5%">ID</th>
                                    <th width="20%">Nama Pasien</th>
                                    <th width="15%">NIK</th>
                                    <th width="15%">Jenis Pemeriksaan</th>
                                    <th width="12%">Tanggal</th>
                                    <th width="20%">Catatan</th>
                                    <th width="13%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($result && $result->num_rows > 0): ?>
                                    <?php while ($row = $result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($row['hasil_lab_id']) ?></td>
                                        <td>
                                            <strong><?= htmlspecialchars($row['nama_pasien']) ?></strong>
                                            <?php if (!empty($row['alamat'])): ?>
                                                <br><small class="text-muted"><?= htmlspecialchars($row['alamat']) ?></small>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= htmlspecialchars($row['nik'] ?: '-') ?></td>
                                        <td>
                                            <span class="badge bg-info">
                                                <?= htmlspecialchars($row['jenis_pemeriksaan'] ?: 'Tidak ada') ?>
                                            </span>
                                        </td>
                                        <td><?= date('d/m/Y', strtotime($row['tanggal'])) ?></td>
                                        <td>
                                            <?php if (!empty($row['catatan'])): ?>
                                                <?= htmlspecialchars(substr($row['catatan'], 0, 50)) ?>
                                                <?= strlen($row['catatan']) > 50 ? '...' : '' ?>
                                            <?php else: ?>
                                                <em class="text-muted">Tidak ada catatan</em>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="btn-group-sm">
                                                <a href="analisis-lab.php?id=<?= $row['hasil_lab_id'] ?>" 
                                                   class="btn btn-sm btn-primary" 
                                                   title="Lihat Detail">
                                                    <i class="fas fa-eye"></i> Lihat
                                                </a>
                                                <a href="edit-hasil-lab.php?id=<?= $row['hasil_lab_id'] ?>" 
                                                   class="btn btn-sm btn-warning" 
                                                   title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="print-hasil-lab.php?id=<?= $row['hasil_lab_id'] ?>" 
                                                   class="btn btn-sm btn-success" 
                                                   title="Print" 
                                                   target="_blank">
                                                    <i class="fas fa-print"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="fas fa-inbox fa-3x mb-3"></i>
                                                <p><em>Tidak ada hasil lab ditemukan.</em></p>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <?php if ($result && $result->num_rows > 0): ?>
                    <div class="mt-3">
                        <small class="text-muted">
                            Total: <?= $result->num_rows ?> hasil lab ditemukan
                        </small>
                    </div>
                    <?php endif; ?>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>