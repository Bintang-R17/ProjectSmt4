
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registrasi Petugas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

  <div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4 shadow rounded" style="width: 100%; max-width: 500px;">
      <h3 class="text-center mb-4">Form Registrasi Petugas</h3>

      <form action="/projectSmt4/index.php?page=registerP-process" method="POST">

        <div class="mb-3">
          <label for="kontak" class="form-label">Nomor Kontak</label>
          <input type="tel" name="kontak" id="kontak" class="form-control" maxlength="20" placeholder="Contoh: 08123456789" required>
          <div class="form-text">Nomor telepon atau WhatsApp yang dapat dihubungi</div>
        </div>

        <div class="mb-3">
          <label for="alamat" class="form-label">Alamat (Opsional)</label>
          <textarea name="alamat" id="alamat" class="form-control" rows="3" maxlength="200" placeholder="Masukkan alamat lengkap"></textarea>
        </div>

        <div class="d-grid">
          <button type="submit" class="btn btn-success">Daftar Sekarang</button>
        </div>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
