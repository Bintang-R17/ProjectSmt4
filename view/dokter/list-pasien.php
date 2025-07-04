<?php
// Diasumsikan $data_pasien sudah di-query dari controller
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Pasien</title>

    <!-- Tautkan CSS eksternal -->
    <link rel="stylesheet" href="/ProjectSmt4/assets/css/pasien-style.css">

    <!-- (Opsional) Tambahkan Font Awesome jika ingin ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<div class="container">
    <h2>Daftar Pasien</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Lengkap</th>
                <th>Username</th>
                <th>Alamat</th>
                <th>Tanggal Lahir</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $data_pasien->fetch_assoc()) : ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['nama_lengkap']) ?></td>
                    <td><?= htmlspecialchars($row['username']) ?></td>
                    <td><?= htmlspecialchars($row['alamat']) ?></td>
                    <td><?= $row['tanggal_lahir'] ?></td>
                    <td>
                        <a class="aksi-link" href="index.php?page=detail-pasien&id=<?= $row['user_id'] ?>">
                            <i class="fas fa-vial"></i> Hasil Lab
                        </a> |
                        <a class="aksi-link" href="index.php?page=rekam-medis-pasien&id=<?= $row['id'] ?>">
                            <i class="fas fa-notes-medical"></i> Rekam Medis
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>
