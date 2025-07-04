<h2>Form Rujukan Pasien</h2>

<form method="POST" action="index.php?page=rujukan-proses">
    <input type="hidden" name="dokter_id" value="<?= htmlspecialchars($user_id) ?>">
<input type="hidden" name="pasien_id" value="<?= htmlspecialchars($pasien_id) ?>">
<input type="hidden" name="hasil_id" value="<?= htmlspecialchars($id_hasil) ?>">


    <label>Dokter Tujuan:</label>


    <label>Alasan Rujukan:</label><br>
    <textarea name="alasan" required></textarea><br>

    <label>Catatan Tambahan:</label><br>
    <textarea name="catatan"></textarea><br>

    <button type="submit">Kirim Rujukan</button>
</form>
