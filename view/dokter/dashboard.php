<?php include __DIR__ . '/../partials/layout.php';?>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Top Navbar -->
        <div class="top-navbar">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-0">Dashboard Dokter</h3>
                    <small class="text-muted">Selamat datang, Dr. [Nama Dokter]</small>
                </div>
                <div>
                    <button class="btn btn-outline-primary me-2">
                        <i class="fas fa-bell"></i>
                        <span class="badge bg-danger">3</span>
                    </button>
                    <button class="btn btn-primary">
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
                                <div class="stats-number">12</div>
                                <div class="text-muted">Jadwal Hari Ini</div>
                            </div>
                            <i class="fas fa-calendar-day fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="stats-card warning">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="stats-number">8</div>
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
                                <div class="stats-number">25</div>
                                <div class="text-muted">Rekam Medis Baru</div>
                            </div>
                            <i class="fas fa-file-medical-alt fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="stats-card danger">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="stats-number">5</div>
                                <div class="text-muted">Hasil Lab Pending</div>
                            </div>
                            <i class="fas fa-vial fa-2x text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Features -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="feature-section">
                        <h4 class="mb-4">
                            <i class="fas fa-clipboard-list text-primary"></i>
                            Fitur Utama
                        </h4>
                        
                        <div class="feature-item">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-calendar-alt text-primary me-3"></i>
                                <div>
                                    <h6 class="mb-1">Lihat daftar jadwal konsultasi hari ini</h6>
                                    <small class="text-muted">dari <code>jadwal_konsultasi</code></small>
                                </div>
                            </div>
                        </div>

                        <div class="feature-item">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-users text-warning me-3"></i>
                                <div>
                                    <h6 class="mb-1">Lihat daftar pasien yang berkonsultasi</h6>
                                    <small class="text-muted">dari <code>konsultasi</code> (status: <span class="badge bg-warning">menunggu</span> / <span class="badge bg-success">selesai</span>)</small>
                                </div>
                            </div>
                        </div>

                        <div class="feature-item">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-file-medical text-success me-3"></i>
                                <div>
                                    <h6 class="mb-1">Isi dan lihat rekam medis pasien</h6>
                                    <small class="text-muted">dari <code>rekam_medis</code></small>
                                </div>
                            </div>
                        </div>

                        <div class="feature-item">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-flask text-danger me-3"></i>
                                <div>
                                    <h6 class="mb-1">Lihat hasil lab pasien</h6>
                                    <small class="text-muted">dari <code>hasil_lab</code></small>
                                </div>
                            </div>
                        </div>

                        <div class="feature-item">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-robot text-info me-3"></i>
                                <div>
                                    <h6 class="mb-1">Lihat prediksi dan rekomendasi dari LLM & SPK</h6>
                                    <small class="text-muted">dari <code>spk_hasil</code> dan <code>llm_rekomendasi</code></small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="feature-section">
                        <h4 class="mb-4">
                            <i class="fas fa-sitemap text-secondary"></i>
                            Alur Data
                        </h4>
                        
                        <div class="data-flow">
                            <div>dokter.id</div>
                            <div class="data-flow-item">jadwal_konsultasi.dokter_id</div>
                            <div class="data-flow-item ms-4">pasien_id</div>
                            <div class="data-flow-item ms-5">konsultasi</div>
                            <div class="data-flow-item ms-6">rekam_medis</div>
                            <div class="data-flow-item ms-7">hasil_lab</div>
                            <div class="data-flow-item ms-8">spk_hasil</div>
                            <div class="data-flow-item ms-9">llm_rekomendasi</div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="feature-section">
                        <h4 class="mb-4">
                            <i class="fas fa-bolt text-warning"></i>
                            Quick Actions
                        </h4>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary">
                                <i class="fas fa-plus"></i> Tambah Jadwal
                            </button>
                            <button class="btn btn-success">
                                <i class="fas fa-edit"></i> Update Rekam Medis
                            </button>
                            <button class="btn btn-info">
                                <i class="fas fa-search"></i> Cari Pasien
                            </button>
                            <button class="btn btn-warning">
                                <i class="fas fa-chart-line"></i> Lihat Statistik
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    