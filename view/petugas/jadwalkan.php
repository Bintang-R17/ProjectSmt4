<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Petugas - Jadwalkan Konsultasi</title>
  <link rel="stylesheet" href="/../ProjectSmt4/assets/css/jadwal.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>
</head>
<body class="petugas-page">
  <div class="container">
    <h2>Permintaan Konsultasi</h2>
    <?php if (empty($permintaan)) : ?>
      <p><em>Tidak ada permintaan konsultasi saat ini.</em></p>
    <?php endif; ?>

    <?php foreach ($permintaan as $r): 
      $form_id = "form_" . $r['id'];
      $tanggal_id = "tanggal_" . $r['id'];
      $hariKosong = (new JadwalKonsultasi((new Database())->getConnection()))->getHariKosong($r['dokter_id']);
      $hariList = array_column($hariKosong, 'hari');
      $hariKosongJSON = json_encode($hariList);
    ?>
      <form method="POST" class="form-box" id="<?= $form_id ?>">
        <p><strong>Pasien:</strong> <?= htmlspecialchars($r['nama_pasien']) ?></p>
        <p><strong>Dokter:</strong> <?= htmlspecialchars($r['nama_dokter']) ?></p>

        <input type="hidden" name="id_konsultasi" value="<?= $r['id'] ?>">

        <label for="tanggal">Tanggal:</label>
        <input type="text" name="tanggal" id="<?= $tanggal_id ?>" required>

        <label for="jam">Jam:</label>
        <input type="time" name="jam" required>

        <p><small>Hari kosong dokter: <?= implode(", ", $hariList) ?></small></p>
        <button type="submit">Jadwalkan</button>

        <script>
        (function(){
          const hariKosong = <?= $hariKosongJSON ?>;
          const mapHari = {'Minggu': 0,'Senin': 1,'Selasa': 2,'Rabu': 3,'Kamis': 4,'Jumat': 5,'Sabtu': 6};
          const hariKosongIndex = hariKosong.map(h => mapHari[h]);
          flatpickr("#<?= $tanggal_id ?>", {
            dateFormat: "Y-m-d",
            disable: [date => hariKosongIndex.includes(date.getDay())],
            locale: "id"
          });
        })();
        </script>
      </form>
    <?php endforeach; ?>
  </div>
</body>
</html>
