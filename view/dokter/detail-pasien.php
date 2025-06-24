<?php
$currentLabId = null;

foreach ($labData as $index => $row):
    $isNewLab = $currentLabId !== $row['hasil_lab_id'];

    if ($isNewLab):
        if ($index !== 0) {
            echo '</table>';
            echo '<a href="index.php?page=detail-hasil-lab&id=' . $currentLabId . '" class="btn btn-sm btn-primary">Lihat Detail</a><br><br>';
        }

        $currentLabId = $row['hasil_lab_id'];
?>
    <h3><?= $row['jenis_pemeriksaan'] ?> - <?= $row['tanggal'] ?></h3>
    <p>Catatan: <?= $row['catatan'] ?></p>
    <table border="1" cellpadding="6">
        <tr>
            <th>Parameter</th>
            <th>Nilai</th>
            <th>Normal</th>
        </tr>
<?php
    endif;
?>
    <tr>
        <td><?= $row['nama_parameter'] ?></td>
        <td><?= $row['nilai'] ?> <?= $row['satuan'] ?></td>
        <td><?= $row['nilai_min'] ?> - <?= $row['nilai_max'] ?> <?= $row['satuan'] ?></td>
    </tr>
<?php endforeach; ?>

<?php if ($currentLabId): ?>
    </table>
    <a href="index.php?page=detail-hasil-lab&id=<?= $currentLabId ?>" class="btn btn-sm btn-primary">Lihat Detail</a>
<?php endif; ?>

<br><br>
<a href="index.php?page=list-hasil-lab&user_id=<?= $userId ?>" class="btn btn-outline-secondary">
  <i class="fas fa-arrow-left"></i> Kembali ke Riwayat Lab
</a>
