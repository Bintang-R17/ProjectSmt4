<?php
$antrian_hari_ini = 8;
$pasien_baru = 5;
$jumlah_rujukan = 2;
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard Petugas</title>
  <link rel="stylesheet" href="http://localhost/projectSmt4/assets/css/dashboard.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>
<body class="petugas">
  <div class="sidebar petugas">
    <h2><i class="fas fa-user-shield"></i> Dashboard Petugas</h2>
    <ul>
      <li><a href="#"><i class="fas fa-home"></i> Dashboard</a></li>
      <li><a href="#"><i class="fas fa-users"></i> Data Pasien</a></li>
      <li><a href="index.php?page=logout"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
    </ul>
  </div>

  <div class="main-content">
    <header class="navbar navbar-petugas">
      <div class="welcome">
        <h1>Dashboard Petugas</h1>
        <p>Selamat datang kembali, semoga sehat selalu! ✨</p>
      </div>
      <div class="profile">
        <i class="fas fa-bell"></i>
        <div class="dropdown">
          <i class="fas fa-user-circle"></i> Petugas
          <div class="dropdown-content">
            <a href="#">Profile</a>
            <a href="#">Pengaturan</a>
            <a href="#">Logout</a>
          </div>
        </div>
      </div>
    </header>

    <!-- Status Bar -->
    <div class="status-bar">
      <span class="online">System Online</span>
      <span class="active">All Services Active</span>
    </div>

    <!-- Statistik -->
    <section class="stats">
      <div class="card blue">
        <h3><i class="fas fa-clipboard-list"></i> Antrian Hari Ini</h3>
        <p><?= $antrian_hari_ini ?> Pasien</p>
      </div>
      <div class="card green">
        <h3><i class="fas fa-user-plus"></i> Pasien Baru</h3>
        <p><?= $pasien_baru ?> Terdaftar</p>
      </div>
      <div class="card yellow">
        <h3><i class="fas fa-paper-plane"></i> Rujukan</h3>
        <p><?= $jumlah_rujukan ?> Dikirim</p>
      </div>
    </section>

    <!-- Menu Petugas -->
    <section class="features">
      <h2><i class="fas fa-briefcase-medical"></i> Menu Petugas</h2>
      <div class="feature-grid">
        <div class="feature-item">
          <i class="fas fa-user-plus"></i>
          <h4>Tambah Pasien</h4>
          <button onclick="location.href='tambah_pasien.php'">Tambah</button>
        </div>
        <div class="feature-item">
          <i class="fas fa-list-alt"></i>
          <h4>Kelola Antrian</h4>
          <button onclick="location.href='antrian.php'">Lihat</button>
        </div>
        <div class="feature-item">
          <i class="fas fa-paper-plane"></i>
          <h4>Kelola Rujukan</h4>
          <button onclick="location.href='rujukan.php'">Kelola</button>
        </div>
        <div class="feature-item">
          <i class="fas fa-print"></i>
          <h4>Cetak Data Pasien</h4>
          <button onclick="location.href='cetak_pasien.php'">Cetak</button>
        </div>
        <div class="feature-item">
          <i class="fas fa-history"></i>
          <h4>Riwayat Pendaftaran</h4>
          <button onclick="location.href='riwayat_pendaftaran.php'">Lihat</button>
        </div>
        <div class="feature-item">
          <i class="fas fa-user-md"></i>
          <h4>Hubungi Dokter</h4>
          <button onclick="location.href='hubungi_dokter.php'">Hubungi</button>
        </div>
        <div class="feature-item">
          <i class="fas fa-file-export"></i>
          <h4>Export Data</h4>
          <button onclick="location.href='export.php'">Export</button>
        </div>
        <div class="feature-item">
          <i class="fas fa-calendar-alt"></i>
          <h4>Kelola Jadwal</h4>
          <button onclick="location.href='index.php?page=jadwal_konsultasi'">Kelola</button>
        </div>
      </div>
    </section>
  </div>
</body>
</html>
