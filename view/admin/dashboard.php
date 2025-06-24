<?php
$total_user = 45;
$total_dokter_aktif = 12;
$total_konsultasi_bulan_ini = 350;
$system_health = "98%";
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard Admin</title>
  <link rel="stylesheet" href="http://localhost/projectSmt4/assets/css/dashboard.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js" />
</head>
<body class="admin">
  <div class="sidebar admin">
    <h2><i class="fas fa-user-shield"></i> Admin Panel</h2>
    <ul>
      <li><a href="#"><i class="fas fa-home"></i> Dashboard</a></li>
      <li><a href="#"><i class="fas fa-users"></i> User Management</a></li>
      <li><a href="#"><i class="fas fa-chart-bar"></i> Statistics</a></li>
      <li><a href="#"><i class="fas fa-cogs"></i> System</a></li>
      <li><a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
    </ul>
  </div>

  <div class="main-content admin">
    <header class="navbar navbar-admin">
      <div class="welcome">
        <h1>Dashboard Admin</h1>
        <p>Selamat datang kembali, semoga sehat selalu! ✨</p>
      </div>
      <div class="profile">
        <i class="fas fa-bell"></i>
        <div class="dropdown">
          <i class="fas fa-user-circle"></i> Admin
          <div class="dropdown-content">
            <a href="#">Profil</a>
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
        <h3><i class="fas fa-users-cog"></i> Total Users</h3>
        <p><?= $total_user ?> Users</p>
        <small>Admin, Dokter, Petugas, Pasien</small>
      </div>
      <div class="card green">
        <h3><i class="fas fa-user-md"></i> Dokter Aktif</h3>
        <p><?= $total_dokter_aktif ?> Dokter</p>
        <small>Online saat ini</small>
      </div>
      <div class="card yellow">
        <h3><i class="fas fa-chart-line"></i> Konsultasi Bulan Ini</h3>
        <p><?= $total_konsultasi_bulan_ini ?> Konsultasi</p>
        <small>↑ 15% dari bulan lalu</small>
      </div>
      <div class="card cyan">
  <h3><i class="fas fa-server"></i> System Health</h3>
  <p><?= $system_health ?></p>
  <div class="health-bar">
    <div class="health-fill" style="width: <?= str_replace('%', '', $system_health) ?>%;"></div>
  </div>
  <small>Excellent performance</small>
</div>

    </section>

    <!-- Chart Statistik -->
    <section class="chart">
      <canvas id="konsultasiChart" height="100"></canvas>
    </section>

    <!-- Fitur Admin -->
    <section class="features">
      <h2><i class="fas fa-cogs"></i> Fitur Admin</h2>
      <div class="feature-grid">
        <div class="feature-item">
          <i class="fas fa-users-cog"></i>
          <h4>Kelola semua user</h4>
          <button onclick="location.href='kelola_user.php'">Kelola</button>
        </div>
        <div class="feature-item">
          <i class="fas fa-chart-pie"></i>
          <h4>Lihat statistik semua data</h4>
          <button onclick="location.href='statistik.php'">Statistik</button>
        </div>
        <div class="feature-item">
          <i class="fas fa-database"></i>
          <h4>Backup database</h4>
          <button onclick="location.href='backup.php'">Backup</button>
        </div>
        <div class="feature-item">
          <i class="fas fa-clipboard-list"></i>
          <h4>Log aktivitas sistem</h4>
          <button onclick="location.href='log.php'">Lihat Log</button>
        </div>
      </div>
    </section>

    <!-- Admin Tools -->
    <section class="tools spaced">
      <h2><i class="fas fa-tools"></i> Admin Tools</h2>
      <button class="tool-btn blue"><i class="fas fa-user-plus"></i> Tambah User Baru</button>
      <button class="tool-btn green"><i class="fas fa-file-alt"></i> Generate Report</button>
      <button class="tool-btn yellow"><i class="fas fa-database"></i> Database Backup</button>
    </section>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    const ctx = document.getElementById('konsultasiChart').getContext('2d');
    new Chart(ctx, {
      type: 'line',
      data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
        datasets: [{
          label: 'Jumlah Konsultasi',
          data: [100, 150, 180, 220, 260, 350],
          backgroundColor: 'rgba(0, 123, 255, 0.2)',
          borderColor: '#007bff',
          borderWidth: 2
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: { display: true },
        },
        scales: {
          y: { beginAtZero: true }
        }
      }
    });
  </script>
</body>
</html>
