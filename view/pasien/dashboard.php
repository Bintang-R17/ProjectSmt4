<?php
$jadwal_konsultasi = 2;
$rekam_medis_saya = 5;
$hasil_lab_saya = 1;
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard Pasien</title>
  <link rel="stylesheet" href="/projectsmt4/assets/css/dashboard.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>
<body class="pasien">
  <!-- Sidebar -->
  	<div class="sidebar pasien">
    <h2><i class="fas fa-user"></i> Dashboard Pasien</h2>
    <ul>
      <li><a href="#"><i class="fas fa-home"></i> Dashboard</a></li>
      <li><a href="#"><i class="fas fa-calendar-check"></i> Jadwal Saya</a></li>
      <li><a href="#"><i class="fas fa-file-medical"></i> Rekam Medis</a></li>
      <li><a href="#"><i class="fas fa-vials"></i> Hasil Lab</a></li>
      <li><a href="logout.php" onclick="return confirm('Yakin ingin logout?')"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
    </ul>
  </div>

  <!-- Main Content -->
  <div class="main-content">

    <!-- Header -->
    <header class="navbar navbar-pasien">
      <div class="welcome">
        <h1><i class="fas fa-user"></i> Dashboard Pasien</h1>
        <p>Selamat datang! Semoga sehat selalu 🌿</p>
      </div>
      <div class="profile">
        <i class="fas fa-bell"></i>
        <div class="dropdown">
          <i class="fas fa-user-circle"></i> Pasien
          <div class="dropdown-content">
            <a href="#">Profil</a>
            <a href="#">Pengaturan</a>
            <a href="index.php?page=logout" onclick="return confirm('Yakin ingin logout?')">Logout</a>
          </div>
        </div>
      </div>
    </header>

    <!-- Status Bar -->
    <div class="status-bar">
      <span class="online">Sistem Aktif</span>
      <span class="active">Layanan Tersedia</span>
    </div>

    <!-- Statistik -->
    <section class="stats">
      <div class="card green">
        <h3><i class="fas fa-calendar-check"></i> Jadwal Konsultasi</h3>
        <p><?= $jadwal_konsultasi ?> Konsultasi</p>
      </div>
      <div class="card blue">
        <h3><i class="fas fa-file-medical"></i> Rekam Medis</h3>
        <p><?= $rekam_medis_saya ?> Data</p>
      </div>
      <div class="card yellow">
        <h3><i class="fas fa-vials"></i> Hasil Lab</h3>
        <p><?= $hasil_lab_saya ?> Baru</p>
      </div>
    </section>

    <!-- Menu Fitur -->
    <section class="features">
      <h2><i class="fas fa-stethoscope"></i> Menu Pasien</h2>
      <div class="feature-grid">
        <div class="feature-item">
          <i class="fas fa-calendar-alt"></i>
          <h4>Jadwal Saya</h4>
          <button onclick="location.href='jadwal_saya.php'">Lihat</button>
        </div>
        <div class="feature-item">
          <i class="fas fa-calendar-alt"></i>
          <h4>Request Jadwal</h4>
          <button onclick="location.href='index.php?page=request-jadwal'">Lihat</button>
        </div>
        <div class="feature-item">
          <i class="fas fa-file-medical"></i>
          <h4>Rekam Medis</h4>
          <button onclick="location.href='rekam_saya.php'">Lihat</button>
        </div>
        <div class="feature-item">
          <i class="fas fa-vial"></i>
          <h4>Hasil Lab</h4>
          <button onclick="location.href='lab_saya.php'">Lihat</button>
        </div>
      </div>
    </section>

    <!-- Tools -->
    <section class="tools">
      <h2><i class="fas fa-toolbox"></i> Alat Bantu Pasien</h2>
      <button class="tool-btn blue">
        <i class="fas fa-edit"></i> Perbarui Profil
      </button>
      <button class="tool-btn green">
        <i class="fas fa-envelope-open-text"></i> Kirim Pesan
      </button>
      <button class="tool-btn yellow">
        <i class="fas fa-file-pdf"></i> Cetak Rekam Medis
      </button>
    </section>

  </div>
</body>
</html>
