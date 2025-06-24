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
        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }
        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }
    </style>
</head>
<body>
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-12">
            <!-- Loading State -->
            <div id="loadingState" class="text-center py-5">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-2">Memuat data hasil lab...</p>
            </div>

            <!-- Main Content (Hidden by default) -->
            <div id="mainContent" style="display: none;">
                <!-- Header Informasi Pasien -->
                <div class="card mb-4">
                    <div class="card-header patient-info">
                        <div class="row">
                            <div class="col-md-8">
                                <h4 class="mb-1"><i class="fas fa-user-md"></i> <span id="namaPasien">-</span></h4>
                                <p class="mb-0">
                                    <i class="fas fa-id-card"></i> NIK: <span id="nikPasien">-</span>
                                </p>
                                <small><i class="fas fa-map-marker-alt"></i> <span id="alamatPasien">-</span></small>
                            </div>
                            <div class="col-md-4 text-end">
                                <h5 id="jenisPemeriksaan">-</h5>
                                <small>Tanggal: <span id="tanggalPemeriksaan">-</span></small><br>
                                <small>ID Lab: #<span id="labId">-</span></small>
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
                        <div id="parametersContainer" class="row">
                            <!-- Parameters will be loaded here -->
                        </div>
                        <div id="noParametersMessage" class="text-center py-4" style="display: none;">
                            <i class="fas fa-exclamation-triangle fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Tidak ada data parameter ditemukan untuk hasil lab ini.</p>
                        </div>
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
                    <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="fas fa-lightbulb"></i> Analisis & Rekomendasi Medis</h5>
                        <button class="btn btn-outline-light btn-sm" id="btnClearConversation" title="Clear Conversation">
                            <i class="fas fa-trash"></i>
                        </button>
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

            <!-- Error State -->
            <div id="errorState" class="alert alert-danger" style="display: none;">
                <i class="fas fa-exclamation-triangle"></i>
                <strong>Error:</strong> <span id="errorMessage">Terjadi kesalahan saat memuat data</span>
                <br>
                <button class="btn btn-outline-danger btn-sm mt-2" onclick="location.reload()">
                    <i class="fas fa-refresh"></i> Muat Ulang
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/api-client.js"></script>
<script src="../assets/js/lab-analysis.js"></script>
</body>
</html>