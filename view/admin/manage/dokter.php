<?php
require_once __DIR__ . '/../../../autoload/autoloads.php';
include __DIR__ . '/../../partials/layout.php';

$database = new Database();
$db = $database->getConnection();
$user = new User();

$dokterList = $user->getByRole('dokter');
$adminList = $user->getByRole('admin');
$petugasList = $user->getByRole('petugas');
$pasienList = $user->getByRole('pasien');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Akun</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="p-5">

<h2>Daftar Akun Dokter</h2>
<table class="table table-bordered">
    <thead>
        <tr><th>ID</th><th>Username</th><th>Nama</th><th>Aksi</th></tr>
    </thead>
    <tbody>
    <?php foreach ($dokterList as $dokter): ?>
        <tr>
            <td><?= $dokter['id'] ?></td>
            <td><?= $dokter['username'] ?></td>
            <td><?= $dokter['nama_lengkap'] ?></td>
            <td>
                <a href="index.php?page=edit-user&id=<?= $dokter['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="index.php?page=delete-user&id=<?= $dokter['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<h2>Daftar Akun Admin</h2>
<table class="table table-bordered">
    <thead>
        <tr><th>ID</th><th>Username</th><th>Nama</th><th>Aksi</th></tr>
    </thead>
    <tbody>
    <?php foreach ($adminList as $admin): ?>
        <tr>
            <td><?= $admin['id'] ?></td>
            <td><?= $admin['username'] ?></td>
            <td><?= $admin['nama_lengkap'] ?></td>
            <td>
                <a href="index.php?page=edit-user&id=<?= $admin['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="index.php?page=delete-user&id=<?= $admin['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>


<h2>Daftar Akun Petugas</h2>
<table class="table table-bordered">
    <thead><tr><th>ID</th><th>Username</th><th>Nama</th><th>Aksi</th></tr></thead>
    <tbody>
    <?php foreach ($petugasList as $petugas): ?>
        <tr>
            <td><?= $petugas['id'] ?></td>
            <td><?= $petugas['username'] ?></td>
            <td><?= $petugas['nama_lengkap'] ?></td>
            <td>
                <a href="index.php?page=edit-user&id=<?= $petugas['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="index.php?page=delete-user&id=<?= $petugas['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
            </td>        
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<h2>Daftar Akun Pasien</h2>
<table class="table table-bordered">
    <thead><tr><th>ID</th><th>Username</th><th>Nama</th><th>Aksi</th></tr></thead>
    <tbody>
        <?php foreach ($pasienList as $pasien): ?>
            <tr>
                <td><?= $pasien['id'] ?></td>
                <td><?= $pasien['username'] ?></td>
                <td><?= $pasien['nama_lengkap'] ?></td>
                <td>
                    <a href="index.php?page=edit-user&id=<?= $pasien['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="index.php?page=delete-user&id=<?= $pasien['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>