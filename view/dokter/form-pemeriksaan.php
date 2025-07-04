<form method="POST" action="?page=simpan-pemeriksaan">
  <input type="hidden" name="konsultasi_id" value="<?= htmlspecialchars($_GET['id']) ?>">

  <label>Keluhan:</label><br>
  <textarea name="keluhan" required></textarea><br><br>

  <label>Diagnosa:</label><br>
  <textarea name="diagnosa" required></textarea><br><br>

  <label>Tindakan/Kelanjutan:</label><br>
  <textarea name="tindakan" required></textarea><br><br>

  <label>Obat:</label><br>
  <input type="text" name="obat" required><br><br>

  <label>Dosis:</label><br>
  <input type="text" name="dosis" required><br><br>

  <button type="submit">Simpan Pemeriksaan</button>
</form>
