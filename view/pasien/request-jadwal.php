<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Pasien - Minta Konsultasi</title>
  <link rel="stylesheet" href="jadwal.css">
</head>
<body class="pasien-page">
  <div class="container">
    <h2>Minta Konsultasi</h2>
    <form method="POST">
      <label for="id_dokter">Pilih Dokter:</label>
      <select name="id_dokter" required>
        <option value="">-- Pilih Dokter --</option>
        <?php foreach ($list_dokter as $d): ?>
          <option value="<?= $d['id'] ?>"><?= htmlspecialchars($d['nama_lengkap']) ?></option>
        <?php endforeach; ?>
      </select>
      <button type="submit">Kirim Request</button>
    </form>
  </div>
</body>
</html>
