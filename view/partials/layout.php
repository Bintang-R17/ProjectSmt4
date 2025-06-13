<?php
switch ($_SESSION['role']) {
    case 'admin':
        include __DIR__ . '/navbar/navbarAdmin.php';
        include __DIR__ . '/template/admin.php';
        break;
    case 'dokter':
        include __DIR__ . '/navbar/navbarDokter.php';
        include __DIR__ . '/template/dokter.php';
        break;
    case 'petugas':
        include __DIR__ . '/navbar/navbarPetugas.php';
        include __DIR__ . '/template/petugas.php';
        break;
    case 'pasien':
        include __DIR__ . '/navbar/navbarPasien.php';
        include __DIR__ . '/template/pasien.php';
        break;
}
?>