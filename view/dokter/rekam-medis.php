<h2>Rekam Medis Pasien</h2>

<table border="1" cellpadding="8" cellspacing="0">
  <thead>
    <tr>
      <th>Tanggal</th>
      <th>Jam</th>
      <th>Pasien</th>
      <th>Keluhan</th>
      <th>Diagnosa</th>
      <th>Tindakan</th>
      <th>Obat</th>
      <th>Dosis</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($rekam_medis as $hasil): ?>
<tr>
    <td><?= $hasil['tanggal'] ?></td>
    <td><?= $hasil['jam'] ?></td>
    <td><?= $hasil['nama_pasien'] ?></td>
    <td><?= $hasil['keluhan'] ?></td>
    <td><?= $hasil['diagnosa'] ?></td>
    <td><?= $hasil['tindakan'] ?></td>
    <td><?= $hasil['obat'] ?></td>
    <td><?= $hasil['dosis'] ?></td>
    <td>
        <a href="index.php?page=form-rujukan&id_hasil=<?= $hasil['id'] ?>&pasien_id=<?= $hasil['pasien_id'] ?>">Kirim</a>
    </td>
</tr>
<?php endforeach; ?>


  </tbody>
</table>
