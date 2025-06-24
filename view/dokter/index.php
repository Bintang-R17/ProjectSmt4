<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Dokter SPA</title>
  <link rel="stylesheet" href="css/dashboard.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>
<body class="dokter">
  <div class="sidebar dokter">
    <h2><i class="fas fa-user-md"></i> Dashboard Dokter</h2>
    <ul>
      <li><a href="#/dashboard"><i class="fas fa-home"></i> Dashboard</a></li>
      <li><a href="#/pasien"><i class="fas fa-users"></i> Daftar Pasien</a></li>
    </ul>
  </div>

  <div class="main-content">
    <header class="navbar navbar-dokter">
      <div class="welcome">
        <h1><i class="fas fa-user-md"></i> Dashboard Dokter</h1>
        <p>Selamat datang kembali, Dokter!</p>
      </div>
      <div class="profile">
        <i class="fas fa-bell"></i>
        <div class="dropdown">
          <i class="fas fa-user-circle"></i> Dokter
          <div class="dropdown-content">
            <a href="#">Profil</a>
            <a href="#">Pengaturan</a>
            <a href="#">Logout</a>
          </div>
        </div>
      </div>
    </header>

    <div class="status-bar">
      <span class="online">Sistem Aktif</span>
      <span class="active">Semua Layanan Tersedia</span>
    </div>

    <div id="app"><!-- konten halaman akan ditampilkan di sini --></div>
  </div>

  <script src="js/app.js"></script>
</body>
</html>
