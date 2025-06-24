<?php
switch ($_SESSION['role']) {
    case 'admin':
        include __DIR__ . '/template/admin/header.php';
        include __DIR__ . '/navbar/navbarAdmin.php';
        include __DIR__ . '/template/admin/footer.php';
        break;
    case 'dokter':
        include __DIR__ . '/template/dokter/header.php';
        // include __DIR__ . '/navbar/navbarDokter.php';
        include __DIR__ . '/template/dokter/footer.php';

        break;
    case 'petugas':
        include __DIR__ . '/template/petugas/header.php';
        include __DIR__ . '/navbar/navbarPetugas.php';
        include __DIR__ . '/template/petugas/footer.php';
        break;
    case 'pasien':
        include __DIR__ . '/template/pasien/header.php';
        include __DIR__ . '/navbar/navbarPasien.php';
        include __DIR__ . '/template/pasien/footer.php';
        break;
}
?>