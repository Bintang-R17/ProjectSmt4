<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h2>Daftar Rujukan</h2>

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Pasien</th>
            <th>Dokter Pengirim</th>
            <th>Keluhan</th>
            <th>Diagnosa</th>
            <th>Tindakan</th>
            <th>Obat</th>
            <th>Dosis</th>
            <th>Catatan</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data_rujukan as $r): ?>
            <tr>
                <td><?= $r['tanggal_rujukan'] ?></td>
                <td><?= htmlspecialchars($r['nama_pasien']) ?></td>
                <td><?= htmlspecialchars($r['nama_dokter']) ?></td>
                <td><?= htmlspecialchars($r['keluhan']) ?></td>
                <td><?= htmlspecialchars($r['diagnosa']) ?></td>
                <td><?= htmlspecialchars($r['tindakan']) ?></td>
                <td><?= htmlspecialchars($r['obat']) ?></td>
                <td><?= htmlspecialchars($r['dosis']) ?></td>
                <td><?= htmlspecialchars($r['catatan']) ?></td>
                <td><?= htmlspecialchars($r['status']) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>