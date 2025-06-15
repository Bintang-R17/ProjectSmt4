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



<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: 'Data ini tidak bisa dikembalikan!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'index.php?page=delete-user&id=' + id;
        }
    });
}
</script>

    <script>
        // Sidebar toggle functionality
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        const sidebarToggle = document.getElementById('sidebarToggle');

        // Mobile sidebar toggle
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('show');
        });

        // Desktop sidebar collapse (optional)
        document.addEventListener('keydown', function(e) {
            if (e.ctrlKey && e.key === 'b') {
                sidebar.classList.toggle('collapsed');
                mainContent.classList.toggle('expanded');
            }
        });

        // Navigation active state
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function() {
                document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Close mobile sidebar when clicking outside
        document.addEventListener('click', function(e) {
            if (window.innerWidth <= 768) {
                if (!sidebar.contains(e.target) && !sidebarToggle.contains(e.target)) {
                    sidebar.classList.remove('show');
                }
            }
        });

        // Responsive handling
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                sidebar.classList.remove('show');
            }
        });

        // Simulate real-time updates for notifications
        setInterval(function() {
            const badges = document.querySelectorAll('.badge');
            badges.forEach(badge => {
                if (badge.classList.contains('bg-danger')) {
                    const current = parseInt(badge.textContent);
                    if (Math.random() > 0.8) {
                        badge.textContent = Math.max(0, current + Math.floor(Math.random() * 2) - 1);
                    }
                }
            });
        }, 8000);

        // Quick action buttons functionality
        document.querySelectorAll('.btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                if (this.textContent.includes('Ajukan Konsultasi')) {
                    alert('Fitur ajukan konsultasi akan membuka form untuk membuat permintaan konsultasi baru');
                } else if (this.textContent.includes('Lihat Jadwal')) {
                    alert('Fitur lihat jadwal akan menampilkan semua jadwal konsultasi pasien');
                } else if (this.textContent.includes('Riwayat Medis')) {
                    alert('Fitur riwayat medis akan menampilkan semua rekam medis pasien');
                } else if (this.textContent.includes('Hasil Lab')) {
                    alert('Fitur hasil lab akan menampilkan semua hasil laboratorium pasien');
                }
            });
        });
    </script>
    </body>
</html>