<?php
require_once __DIR__ . '/../../../autoload/autoloads.php';
include __DIR__ . '/../../partials/layout.php';


if (isset($_SESSION['success'])): ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
Swal.fire({
    icon: 'success',
    title: 'Sukses!',
    text: '<?= $_SESSION['success'] ?>',
    confirmButtonColor: '#3085d6'
});
</script>
<?php unset($_SESSION['success']); ?>
<?php endif; ?>


<h2>Daftar Akun Dokter</h2>
<table class="table table-bordered">
        <div class="list-group-item d-flex align-items-center">
            <button class="btn btn-outline-danger" style="text-decoration: none;"><a href="index.php?page=create-user">
                <i class=""></i> Tambah User</a>
            </button>
        </div>
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
                <a href="#" class="btn btn-danger btn-sm" onclick="confirmDelete(<?= $dokter['id'] ?>)">Hapus</a>
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
                <a href="#" class="btn btn-danger btn-sm" onclick="confirmDelete(<?= $admin['id'] ?>)">Hapus</a>
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
                <a href="#" class="btn btn-danger btn-sm" onclick="confirmDelete(<?= $petugas['id'] ?>)">Hapus</a>
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
                    <a href="#" class="btn btn-danger btn-sm" onclick="confirmDelete(<?= $pasien['id'] ?>)">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>



