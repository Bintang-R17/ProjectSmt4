<?php
require_once __DIR__ . '/../../config/Database.php';

$db = new Database();
$conn = $db->getConnection();
$userId = $_SESSION['user_id'] ?? null;
$role = $_SESSION['role'] ?? '';

// // Cek user login
// if (!$userId) {
//     header('Location: login.php');
//     exit;
// }

// Pastikan koneksi database berhasil
if (!$conn) {
    die("Database connection failed.");
}

$hasil_lab_id = $_GET['id'] ?? null;
if (!$hasil_lab_id) {
    die("ID hasil lab tidak ditemukan.");
}

// Query untuk mengambil info pasien dan hasil lab
$sqlPasien = "
SELECT  
    hl.id AS hasil_lab_id,
    hl.tanggal,
    hl.catatan,
    jp.nama AS jenis_pemeriksaan,
    u.nama_lengkap AS nama_pasien,
    p.nik,
    p.alamat,
    p.tanggal_lahir
FROM hasil_lab hl
JOIN jenis_pemeriksaan jp ON hl.jenis_id = jp.id
JOIN users u ON hl.user_id = u.id
LEFT JOIN pasien p ON u.id = p.user_id
WHERE hl.id = ?
";

$stmtPasien = $conn->prepare($sqlPasien);
if (!$stmtPasien) {
    die("Prepare failed: " . $conn->error);
}

$stmtPasien->bind_param("i", $hasil_lab_id);
$stmtPasien->execute();
$resultPasien = $stmtPasien->get_result();
$pasienData = $resultPasien->fetch_assoc();

if (!$pasienData) {
    die("Data hasil lab tidak ditemukan.");
}

// Query untuk mengambil detail parameter hasil lab
$sqlParameter = "
SELECT  
    pp.nama_parameter,
    pp.satuan,
    hp.nilai,
    pp.jenis_id,
    jp.nama AS nama_jenis,
    pp.nilai_min,
    pp.nilai_max
FROM hasil_parameter hp
JOIN parameter_pemeriksaan pp ON hp.parameter_id = pp.id
JOIN jenis_pemeriksaan jp ON pp.jenis_id = jp.id
WHERE hp.hasil_lab_id = ?
ORDER BY jp.nama, pp.nama_parameter
";

$stmtParameter = $conn->prepare($sqlParameter);
if (!$stmtParameter) {
    die("Prepare failed: " . $conn->error);
}

$stmtParameter->bind_param("i", $hasil_lab_id);
if (!$stmtParameter->execute()) {
    die("Execute failed: " . $stmtParameter->error);
}

$resultParameter = $stmtParameter->get_result();
if (!$resultParameter) {
    die("Get result failed: " . $stmtParameter->error);
}

// Proses data parameter untuk analisis
$parametersData = [];
while ($row = $resultParameter->fetch_assoc()) {
    $nilai = floatval($row['nilai']);
    $min = isset($row['nilai_min']) ? floatval($row['nilai_min']) : null;
    $max = isset($row['nilai_max']) ? floatval($row['nilai_max']) : null;

    $status = 'Normal';
    $statusClass = 'success';

    if (!is_null($min) && !is_null($max)) {
        if ($nilai < $min) {
            $status = 'Rendah';
            $statusClass = 'warning';
        } elseif ($nilai > $max) {
            $status = 'Tinggi';
            $statusClass = 'danger';
        }
    }

    $parametersData[] = array_merge($row, [
        'status' => $status,
        'status_class' => $statusClass,
        'nilai_numeric' => $nilai
    ]);
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analisis & Rekomendasi Hasil Lab</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .patient-info {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .status-normal { border-left: 4px solid #28a745; }
        .status-warning { border-left: 4px solid #ffc107; }
        .status-danger { border-left: 4px solid #dc3545; }
        .ai-response {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 15px;
            padding: 20px;
        }
        .loading-overlay {
            background: rgba(255,255,255,0.9);
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }
    </style>
</head>
<body>
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-12">
            <!-- Header Informasi Pasien -->
            <div class="card mb-4">
                <div class="card-header patient-info">
                    <div class="row">
                        <div class="col-md-8">
                            <h4 class="mb-1"><i class="fas fa-user-md"></i> <?= htmlspecialchars($pasienData['nama_pasien']) ?></h4>
                            <p class="mb-0">
                                <i class="fas fa-id-card"></i> NIK: <?= htmlspecialchars($pasienData['nik'] ?: 'Tidak tersedia') ?>
                            </p>
                            <?php if (!empty($pasienData['alamat'])): ?>
                                <small><i class="fas fa-map-marker-alt"></i> <?= htmlspecialchars($pasienData['alamat']) ?></small>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-4 text-end">
                            <h5><?= htmlspecialchars($pasienData['jenis_pemeriksaan']) ?></h5>
                            <small>Tanggal: <?= date('d/m/Y', strtotime($pasienData['tanggal'])) ?></small><br>
                            <small>ID Lab: #<?= htmlspecialchars($hasil_lab_id) ?></small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hasil Lab Detail -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-microscope"></i> Detail Hasil Laboratorium</h5>
                </div>
                <div class="card-body">
                    <?php if (!empty($parametersData)): ?>
                        <div class="row">
                            <?php foreach ($parametersData as $param): ?>
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <div class="card h-100 status-<?= $param['status_class'] ?>">
                                        <div class="card-body">
                                            <h6 class="card-title"><?= htmlspecialchars($param['nama_parameter']) ?></h6>
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <span class="h5 mb-0 text-primary"><?= htmlspecialchars($param['nilai']) ?></span>
                                                <span class="text-muted"><?= htmlspecialchars($param['satuan']) ?></span>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <small class="text-muted">
                                                    Normal: 
                                                    <?php if (!is_null($param['nilai_min']) && !is_null($param['nilai_max'])): ?>
                                                        <?= $param['nilai_min'] ?> - <?= $param['nilai_max'] ?>
                                                    <?php else: ?>
                                                        -
                                                    <?php endif; ?>
                                                </small>
                                                <span class="badge bg-<?= $param['status_class'] ?>"><?= $param['status'] ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-4">
                            <i class="fas fa-exclamation-triangle fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Tidak ada data parameter ditemukan untuk hasil lab ini.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Form Konsultasi AI -->
            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-robot"></i> Konsultasi AI Medical</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="catatanTambahan" style="height: 100px;" 
                                          placeholder="Tambahkan keluhan, gejala, atau pertanyaan spesifik..."></textarea>
                                <label for="catatanTambahan">Keluhan atau Pertanyaan Tambahan (Opsional)</label>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <button class="btn btn-success btn-lg w-100" id="btnAnalisisAI">
                                <span id="btnText">
                                    <i class="fas fa-stethoscope"></i> Dapatkan Rekomendasi
                                </span>
                                <span id="btnLoading" class="d-none">
                                    <span class="spinner-border spinner-border-sm"></span>
                                    Menganalisis...
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hasil Analisis AI -->
            <div class="card" id="hasilAnalisisCard" style="display: none;">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="fas fa-lightbulb"></i> Analisis & Rekomendasi Medis</h5>
                </div>
                <div class="card-body position-relative">
                    <div class="loading-overlay d-none" id="loadingOverlay">
                        <div class="text-center">
                            <div class="spinner-border text-primary" role="status"></div>
                            <p class="mt-2">Sedang menganalisis hasil lab...</p>
                        </div>
                    </div>
                    <div class="ai-response" id="hasilAnalisisContent">
                        <!-- Konten hasil analisis akan ditampilkan di sini -->
                    </div>
                    <div class="mt-3 text-center">
                        <small class="text-muted">
                            <i class="fas fa-exclamation-triangle"></i> 
                            <strong>Disclaimer:</strong> Analisis ini hanya untuk referensi. 
                            Konsultasikan dengan dokter untuk diagnosis dan pengobatan yang akurat.
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script>
// Perbaikan bagian JavaScript di frontend
document.getElementById('btnAnalisisAI').addEventListener('click', async function() {
    const btnText = document.getElementById('btnText');
    const btnLoading = document.getElementById('btnLoading');
    const hasilCard = document.getElementById('hasilAnalisisCard');
    const hasilContent = document.getElementById('hasilAnalisisContent');
    const loadingOverlay = document.getElementById('loadingOverlay');
    
    // Tampilkan loading
    btnText.classList.add('d-none');
    btnLoading.classList.remove('d-none');
    this.disabled = true;
    
    // Tampilkan card hasil
    hasilCard.style.display = 'block';
    loadingOverlay.classList.remove('d-none');
    
    try {
        // Persiapkan data untuk dikirim ke LLM
        const pasienInfo = {
            nama: "<?= addslashes($pasienData['nama_pasien']) ?>",
            umur: <?= $umur ?? 'null' ?>,
            jenis_pemeriksaan: "<?= addslashes($pasienData['jenis_pemeriksaan']) ?>",
            tanggal_pemeriksaan: "<?= $pasienData['tanggal'] ?>",
            catatan_lab: "<?= addslashes($pasienData['catatan'] ?: '') ?>"
        };
        
        const parametersInfo = <?= json_encode($parametersData) ?>;
        const catatanTambahan = document.getElementById('catatanTambahan').value.trim();
        
        // Buat prompt untuk LLM
        let prompt = `Analisis hasil laboratorium pasien berikut:\n\n`;
        prompt += `INFORMASI PASIEN:\n`;
        prompt += `- Nama: ${pasienInfo.nama}\n`;
        if (pasienInfo.umur) prompt += `- Umur: ${pasienInfo.umur} tahun\n`;
        prompt += `- Jenis Pemeriksaan: ${pasienInfo.jenis_pemeriksaan}\n`;
        prompt += `- Tanggal: ${pasienInfo.tanggal_pemeriksaan}\n`;
        if (pasienInfo.catatan_lab) prompt += `- Catatan Lab: ${pasienInfo.catatan_lab}\n`;
        
        prompt += `\nHASIL LABORATORIUM:\n`;
        parametersInfo.forEach(param => {
            const nilaiNormal = param.nilai_min && param.nilai_max ? 
                `${param.nilai_min}-${param.nilai_max}` : 'Tidak tersedia';
            prompt += `- ${param.nama_parameter}: ${param.nilai} ${param.satuan} (Normal: ${nilaiNormal}) - Status: ${param.status}\n`;
        });
        
        if (catatanTambahan) {
            prompt += `\nKELUHAN/PERTANYAAN TAMBAHAN:\n${catatanTambahan}\n`;
        }
        
        prompt += `\nMohon berikan analisis profesional yang mencakup:\n`;
        prompt += `1. Interpretasi hasil lab yang abnormal\n`;
        prompt += `2. Kemungkinan kondisi medis yang terkait\n`;
        prompt += `3. Rekomendasi tindakan medis lanjutan\n`;
        prompt += `4. Saran gaya hidup atau pencegahan\n`;
        prompt += `5. Tanda-tanda yang perlu diwaspadai\n\n`;
        prompt += `Gunakan bahasa Indonesia yang mudah dipahami dan sertakan disclaimer medis.`;
        
        console.log('Sending prompt to LLM:', prompt);
        
        // PERBAIKAN: Kirim hasil_lab_id yang benar
        const response = await fetch('analisis_ai.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                message: prompt,
                hasil_lab_id: <?= $hasil_lab_id ?>,  // Ubah dari patient_id ke hasil_lab_id
                analysis_type: 'comprehensive_lab_analysis',
                parameters_data: parametersInfo,  // Kirim juga data parameter
                patient_info: pasienInfo  // Kirim info pasien
            })
        });
        
        const responseText = await response.text();
        console.log('Raw response:', responseText);
        
        let data;
        try {
            data = JSON.parse(responseText);
        } catch (e) {
            throw new Error('Invalid JSON response from server: ' + responseText);
        }
        
        if (data.success && data.content) {
            // Format konten untuk tampilan yang lebih baik
            let formattedContent = data.content
                .replace(/\n\n/g, '</p><p>')
                .replace(/\n/g, '<br>')
                .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
                .replace(/\*(.*?)\*/g, '<em>$1</em>')
                .replace(/(\d+\.)/g, '<strong>$1</strong>');
            
            hasilContent.innerHTML = `
                <div class="mb-3">
                    <h6 class="text-primary"><i class="fas fa-user-md"></i> Analisis Medis AI</h6>
                    <div class="border-start border-primary border-3 ps-3">
                        <p>${formattedContent}</p>
                    </div>
                </div>
                <hr>
                <small class="text-muted">
                    <i class="fas fa-clock"></i> Dianalisis pada: ${data.timestamp || new Date().toLocaleString('id-ID')}
                </small>
            `;
        } else if (data.error) {
            hasilContent.innerHTML = `
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle"></i>
                    <strong>Error:</strong> ${data.error}
                    ${data.details ? `<br><small>Detail: ${data.details}</small>` : ''}
                </div>
            `;
        } else {
            hasilContent.innerHTML = `
                <div class="alert alert-warning">
                    <i class="fas fa-question-circle"></i>
                    <strong>Tidak ada respons dari sistem AI.</strong>
                    <pre>${JSON.stringify(data, null, 2)}</pre>
                </div>
            `;
        }
        
    } catch (error) {
        console.error('Error:', error);
        hasilContent.innerHTML = `
            <div class="alert alert-danger">
                <i class="fas fa-times-circle"></i>
                <strong>Terjadi kesalahan:</strong> ${error.message}<br>
                <small>Silakan coba lagi atau hubungi administrator.</small>
            </div>
        `;
    } finally {
        // Sembunyikan loading
        loadingOverlay.classList.add('d-none');
        btnText.classList.remove('d-none');
        btnLoading.classList.add('d-none');
        this.disabled = false;
    }
});
</script>
</body>
</html>