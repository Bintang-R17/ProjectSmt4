<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['hari_kosong'])) {
  $id_dokter = 7; // simulasi
  $hari_kosong = $_POST['hari_kosong'];

  mysqli_query($conn, "DELETE FROM hari_kosong WHERE id_dokter = $id_dokter");

  foreach ($hari_kosong as $hari) {
    mysqli_query($conn, "INSERT INTO hari_kosong (id_dokter, hari) VALUES ($id_dokter, '$hari')");
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dokter - Atur Hari Kosong</title>
  <link rel="stylesheet" href="jadwal.css">
</head>
<body class="dokter-page">
  <div class="container">
    <h2>Atur Hari Kosong</h2>
    <form method="POST">
      <div class="checkbox-group">
        <?php
        $hari_list = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        foreach ($hari_list as $h) {
          echo "<label><input type='checkbox' name='hari_kosong[]' value='$h'> $h</label>";
        }
        ?>
      </div>
      <button type="submit">Simpan Hari Kosong</button>
    </form>

    <h3>Jadwal Konsultasi</h3>
    <table>
      <tr><th>Pasien</th><th>Tanggal</th><th>Jam</th></tr>
      <?php
      $jadwal = mysqli_query($conn, "SELECT * FROM jadwal_konsultasi WHERE id_dokter = 7");
      while ($row = mysqli_fetch_assoc($jadwal)) {
        echo "<tr><td>{$row['nama_pasien']}</td><td>{$row['tanggal']}</td><td>{$row['jam']}</td></tr>";
      }
      ?>
    </table>
  </div>
</body>
</html>
