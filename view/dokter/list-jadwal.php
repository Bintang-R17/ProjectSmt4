<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dokter - Atur Hari Kosong</title>
  <link rel="stylesheet" href="/../ProjectSmt4/assets/css/jadwal.css">
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
      <tr><th>Pasien</th><th>Tanggal</th><th>Jam</th><th>Status</th><th>Aksi</th></tr>
      <?php foreach ($jadwal as $row): ?>
        <tr>
          <td><?= htmlspecialchars($row['nama_pasien']) ?></td>
          <td><?= $row['tanggal'] ?></td>
          <td><?= $row['jam'] ?></td>
          <td><?= $row['status'] ?></td>
          <td><a href="index.php?page=periksa&id=<?= $row['id'] ?>">Periksa</a>

</td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>
</body>
</html>
