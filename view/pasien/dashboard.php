<?php include __DIR__ . '/../partials/layout.php';?>
<body>
    <!-- Toggle Button -->
    <button class="btn btn-toggle d-md-none" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Top Navbar -->
        <div class="top-navbar">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-0">Dashboard Pasien</h3>
                    <small class="text-muted">Selamat datang, [Nama Pasien]</small>
                </div>
                <div>
                    <button class="btn btn-outline-success me-2">
                        <i class="fas fa-bell"></i>
                        <span class="badge bg-danger">2</span>
                    </button>
                    <button class="btn btn-success">
                        <i class="fas fa-user"></i> Profile
                    </button>
                </div>
            </div>
        </div>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <!-- Statistics Cards -->
            <div class="row mb-4">
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="stats-card">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="stats-number">3</div>
                                <div class="text-muted">Jadwal Mendatang</div>
                            </div>
                            <i class="fas fa-calendar-check fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="stats-card warning">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="stats-number">1</div>
                                <div class="text-muted">Konsultasi Menunggu</div>
                            </div>
                            <i class="fas fa-clock fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="stats-card success">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="stats-number">12</div>
                                <div class="text-muted">Riwayat Konsultasi</div>
                            </div>
                            <i class="fas fa-history fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="stats-card danger">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="stats-number">2</div>
                                <div class="text-muted">Hasil Lab Baru</div>
                            </div>
                            <i class="fas fa-flask fa-2x text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Features -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="feature-section">
                        <h4 class="mb-4">
                            <i class="fas fa-clipboard-list text-success"></i>
                            Fitur Utama
                        </h4>
                        
                        <div class="feature-item">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-calendar-plus text-success me-3"></i>
                                <div>
                                    <h6 class="mb-1">Lihat jadwal konsultasi pribadi</h6>
                                    <small class="text-muted">dari <code>jadwal_konsultasi</code> berdasarkan <code>pasien_id</code></small>
                                </div>
                            </div>
                        </div>

                        <div class="feature-item">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-plus-circle text-primary me-3"></i>
                                <div>
                                    <h6 class="mb-1">Ajukan konsultasi baru</h6>
                                    <small class="text-muted">input ke <code>konsultasi</code> dengan status <span class="badge bg-warning">menunggu</span></small>
                                </div>
                            </div>
                        </div>

                        <div class="feature-item">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-file-medical-alt text-info me-3"></i>
                                <div>
                                    <h6 class="mb-1">Lihat riwayat rekam medis</h6>
                                    <small class="text-muted">dari <code>rekam_medis</code> berdasarkan <code>pasien_id</code></small>
                                </div>
                            </div>
                        </div>

                        <div class="feature-item">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-vial text-danger me-3"></i>
                                <div>
                                    <h6 class="mb-1">Lihat hasil lab & hasil prediksi SPK + rekomendasi LLM</h6>
                                    <small class="text-muted">dari <code>hasil_lab</code>, <code>spk_hasil</code>, dan <code>llm_rekomendasi</code></small>
                                </div>
                            </div>
                        </div>

                        <div class="feature-item">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-bell text-warning me-3"></i>
                                <div>
                                    <h6 class="mb-1">Notifikasi hasil konsultasi & rekomendasi</h6>
                                    <small class="text-muted">update status konsultasi dan hasil rekomendasi</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Appointments -->
                    <div class="feature-section">
                        <h4 class="mb-4">
                            <i class="fas fa-calendar-alt text-success"></i>
                            Jadwal Konsultasi Terbaru
                        </h4>
                        
                        <div class="appointment-card pending">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">Dr. Ahmad Susanto</h6>
                                    <small class="text-muted">
                                        <i class="fas fa-calendar"></i> 15 Juni 2025, 10:00 WIB
                                    </small>
                                    <br>
                                    <span class="badge bg-warning">Terjadwal</span>
                                </div>
                                <button class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i> Detail
                                </button>
                            </div>
                        </div>

                        <div class="appointment-card">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">Dr. Sarah Wijaya</h6>
                                    <small class="text-muted">
                                        <i class="fas fa-calendar"></i> 18 Juni 2025, 14:30 WIB
                                    </small>
                                    <br>
                                    <span class="badge bg-info">Terjadwal</span>
                                </div>
                                <button class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i> Detail
                                </button>
                            </div>
                        </div>

                        <div class="appointment-card completed">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">Dr. Budi Hartono</h6>
                                    <small class="text-muted">
                                        <i class="fas fa-calendar"></i> 10 Juni 2025, 09:00 WIB
                                    </small>
                                    <br>
                                    <span class="badge bg-success">Selesai</span>
                                </div>
                                <button class="btn btn-sm btn-outline-success">
                                    <i class="fas fa-file-alt"></i> Lihat Hasil
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="feature-section">
                        <h4 class="mb-4">
                            <i class="fas fa-sitemap text-success"></i>
                            Alur Data Pasien
                        </h4>
                        
                        <div class="data-flow">
                            <div>users.id (pasien)</div>
                            <div class="data-flow-item">jadwal_konsultasi.pasien_id</div>
                            <div class="data-flow-item ms-4">konsultasi.pasien_id</div>
                            <div class="data-flow-item ms-6">rekam_medis.pasien_id</div>
                            <div class="data-flow-item ms-8">hasil_lab.pasien_id</div>
                            <div class="data-flow-item ms-10">spk_hasil</div>
                            <div class="data-flow-item ms-12">llm_rekomendasi</div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="feature-section">
                        <h4 class="mb-4">
                            <i class="fas fa-bolt text-warning"></i>
                            Quick Actions
                        </h4>
                        <div class="d-grid gap-2">
                            <button class="btn btn-success">
                                <i class="fas fa-plus"></i> Ajukan Konsultasi
                            </button>
                            <button class="btn btn-primary">
                                <i class="fas fa-calendar"></i> Lihat Jadwal
                            </button>
                            <button class="btn btn-info">
                                <i class="fas fa-file-medical"></i> Riwayat Medis
                            </button>
                            <button class="btn btn-warning">
                                <i class="fas fa-vial"></i> Hasil Lab
                            </button>
                        </div>
                    </div>

                    <!-- Notifications -->
                    <div class="feature-section">
                        <h4 class="mb-4">
                            <i class="fas fa-bell text-info"></i>
                            Notifikasi Terbaru
                        </h4>
                        <div class="list-group list-group-flush">
                            <div class="list-group-item d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <small>Hasil konsultasi sudah tersedia</small>
                            </div>
                            <div class="list-group-item d-flex align-items-center">
                                <i class="fas fa-flask text-danger me-2"></i>
                                <small>Hasil lab baru tersedia</small>
                            </div>
                            <div class="list-group-item d-flex align-items-center">
                                <i class="fas fa-calendar-alt text-warning me-2"></i>
                                <small>Jadwal konsultasi besok</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    