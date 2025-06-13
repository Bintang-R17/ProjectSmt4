<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Form Pasien</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h2>Form Data Pasien</h2>
  <form action="index.php?page=registerPasien-process" method="POST">
    
    <!-- user_id -->
    

    <!-- nik -->
    <div class="mb-3">
      <label for="nik" class="form-label">NIK</label>
      <input type="text" class="form-control" id="nik" name="nik" maxlength="20" required>
    </div>

    <!-- alamat -->
    <div class="mb-3">
      <label for="alamat" class="form-label">Alamat</label>
      <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
    </div>

    <!-- tanggal_lahir -->
    <div class="mb-3">
      <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
      <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
    </div>

    <!-- Tombol Simpan -->
    <button type="submit" class="btn btn-primary">Simpan</button>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
