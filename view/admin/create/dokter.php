<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Registrasi Dokter</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">

  <div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4 shadow rounded" style="width: 100%; max-width: 500px;">
      <h3 class="text-center mb-4">
        <i class="fas fa-user-md"></i> Registrasi Dokter
      </h3>

      <form action="/projectSmt4/index.php?page=registerD-process" method="POST" id="dokterForm">
        <div class="mb-3">
          <label for="spesialisasi" class="form-label">Spesialisasi</label>
          <select name="spesialisasi" id="spesialisasi" class="form-select" required onchange="toggleCustomSpesialisasi()">
            <option value="">Pilih Spesialisasi</option>
            <option value="Umum">Dokter Umum</option>
            <option value="Kardiologi">Kardiologi</option>
            <option value="Neurologi">Neurologi</option>
            <option value="Pediatri">Pediatri</option>
            <option value="Orthopedi">Orthopedi</option>
            <option value="Dermatologi">Dermatologi</option>
            <option value="Oftalmologi">Oftalmologi</option>
            <option value="THT">THT</option>
            <option value="Psikiatri">Psikiatri</option>
            <option value="Kandungan">Kandungan & Kebidanan</option>
            <option value="Bedah">Bedah</option>
            <option value="Anestesi">Anestesi</option>
            <option value="Radiologi">Radiologi</option>
            <option value="Patologi">Patologi</option>
            <option value="Lainnya">Lainnya</option>
          </select>
          <div class="form-text">Kosongkan jika Dokter Umum</div>
        </div>

        <div class="mb-3 d-none" id="customSpesialisasiWrapper">
          <label for="customSpesialisasi" class="form-label">Spesialisasi Lain</label>
          <input type="text" class="form-control" name="customSpesialisasi" id="customSpesialisasi" maxlength="100" placeholder="Masukkan spesialisasi lainnya">
        </div>

        <div class="d-grid">
          <button type="submit" class="btn btn-success">
            <i class="fas fa-check"></i> Daftar Sekarang
          </button>
        </div>
      </form>
    </div>
  </div>

  <script>
    function toggleCustomSpesialisasi() {
      const select = document.getElementById('spesialisasi');
      const wrapper = document.getElementById('customSpesialisasiWrapper');
      if (select.value === 'Lainnya') {
        wrapper.classList.remove('d-none');
      } else {
        wrapper.classList.add('d-none');
        document.getElementById('customSpesialisasi').value = '';
      }
    }
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
