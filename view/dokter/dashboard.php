<?php
// Simulasi data jika tidak pakai koneksi database
$jadwal_hari_ini = 3;
$total_pasien = 45;
$rekam_medis_bulan_ini = 20;
$hasil_lab_baru = 7;  
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard Dokter</title>
  <link rel="stylesheet" href="/projectsmt4/assets/css/dashboard.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>
<body class="dokter">
  <!-- Sidebar -->
  <div class="sidebar dokter">
    <h2><i class=""></i> Menu </h2>
    <ul>
      <li><a href="#"><i class="fas fa-home"></i> Dashboard</a></li>
      <li><a href="index.php?page=list-pasien"><i class="fas fa-users"></i> Daftar Pasien</a></li>
      <li><a href="index.php?page=list-jadwal"><i class="fas fa-calendar-alt"></i> Jadwal Konsultasi</a></li>
      <li><a href="index.php?page=list-jadwal"><i class="fas fa-paper-plane"></i> Kirim Rujukan </a></li>
      <li><a href="index.php?page=list-jadwal"><i class="fas fa-user-shield "></i> Hubungi Petugas </a></li>
      <li><a href="index.php?page=logout"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
    </ul>
  </div>
  
  <!-- Main Content -->
  <div class="main-content">

    <!-- Header -->
    <header class="navbar navbar-dokter">
      <div class="welcome">
        <h1><i class=""></i> Dashboard</h1>
      </div>
      <div class="profile">
        <i class="fas fa-bell"></i>
        <div class="dropdown">
          <i class="fas fa-user-circle"></i> Dokter
          <div class="dropdown-content">
            <a href="#">Profil</a>
            <a href="#">Pengaturan</a>
            <a href="index.php?page=logout">Logout</a>
          </div>
        </div>
      </div>
    </header>

    <!-- Status Bar -->
    <!-- <div class="status-bar">
      <span class="online">Sistem Aktif</span>
      <span class="active">Semua Layanan Tersedia</span>
    </div> -->

    <!-- Statistik -->
    <section class="stats">
      <div class="card blue">
        <h3><i class="fas fa-calendar-check"></i> Jadwal Hari Ini</h3>
        <p><?= $jadwal_hari_ini ?> Konsultasi</p>
      </div>
      <div class="card green">
        <h3><i class="fas fa-user-injured"></i> Total Pasien</h3>
        <p><?= $total_pasien ?> Pasien</p>
      </div>
      <div class="card yellow">
        <h3><i class="fas fa-file-medical"></i> Rekam Medis Bulan Ini</h3>
        <p><?= $rekam_medis_bulan_ini ?> Entry</p>
      </div>
    </section>

    <!-- Menu Fitur -->
    <section class="features dokter">
      <h2><i class="fas fa-stethoscope"></i> Fitur Dokter</h2>
      <div class="feature-grid">
        <!-- <div class="feature-item">
          <i class="fas fa-users"></i>
          <h4>Lihat Daftar Pasien</h4>
          <button onclick="location.href='index.php?page=list-pasien'">Lihat</button>
        </div>
        <div class="feature-item">
          <i class="fas fa-calendar-alt"></i>
          <h4>Jadwal Konsultasi</h4>
          <button onclick="location.href='index.php?page=list-jadwal'">Lihat</button>
        </div>
        <div class="feature-item">
          <i class="fas fa-paper-plane"></i>
          <h4>Kirim Rujukan</h4>
          <button onclick="location.href='rujukan.php'">Kirim</button>
        </div>
        <div class="feature-item">
          <i class="fas fa-user-shield"></i>
          <h4>Hubungi Petugas</h4>
          <button onclick="location.href='hubungi_dokter.php'">Hubungi</button>
        </div> -->
      </div>
    </section>

    <!-- Tools Dokter -->
    <!-- <section class="tools dokter">
      <h2><i class="fas fa-toolbox"></i> Dokter Tools</h2>
      <button class="tool-btn blue">
        <i class="fas fa-plus-circle"></i> Tambah Catatan Medis
      </button>
      <button class="tool-btn green">
        <i class="fas fa-flask"></i> Lihat Hasil Lab
      </button>
      <button class="tool-btn yellow">
        <i class="fas fa-print"></i> Cetak Riwayat
      </button>
    </section> -->

  </div>
</body>
</html>
