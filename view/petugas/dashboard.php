<?php include __DIR__ . '/../partials/layout.php';?>

    <!-- Main Content -->
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-12">
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2 class="text-info"><i class="fas fa-user-nurse"></i> Dashboard Petugas</h2>
                        <p class="text-muted">Kelola data pasien dan koordinasi layanan medis</p>
                    </div>
                    <div>
                        <span class="badge bg-success fs-6">Online</span>
                    </div>
                </div>

                <!-- Statistics Cards -->
                <div class="row mb-4">
                    <div class="col-lg-3 col-md-6 mb-3">
                        <div class="card border-primary h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-users fa-3x text-primary mb-3"></i>
                                <h4 class="text-primary">125</h4>
                                <p class="card-text">Total Pasien</p>
                                <small class="text-muted">Data keseluruhan</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <div class="card border-warning h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-flask fa-3x text-warning mb-3"></i>
                                <h4 class="text-warning">8</h4>
                                <p class="card-text">Hasil Lab Pending</p>
                                <small class="text-muted">Menunggu input</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <div class="card border-success h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-calendar-check fa-3x text-success mb-3"></i>
                                <h4 class="text-success">15</h4>
                                <p class="card-text">Jadwal Hari Ini</p>
                                <small class="text-muted">Konsultasi terjadwal</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <div class="card border-danger h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-comments fa-3x text-danger mb-3"></i>
                                <h4 class="text-danger">5</h4>
                                <p class="card-text">Konsultasi Aktif</p>
                                <small class="text-muted">Sedang berlangsung</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Features -->
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header bg-info text-white">
                                <h5 class="mb-0"><i class="fas fa-clipboard-list"></i> Fitur Utama</h5>
                            </div>
                            <div class="card-body">
                                <div class="list-group list-group-flush">
                                    <div class="list-group-item d-flex align-items-center">
                                        <div class="me-3">
                                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                                <i class="fas fa-plus-circle"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">Tambah / edit / hapus data pasien</h6>
                                            <small class="text-muted">Kelola informasi lengkap pasien dalam sistem</small>
                                        </div>
                                        <button class="btn btn-outline-primary">
                                            <i class="fas fa-arrow-right"></i> Kelola
                                        </button>
                                    </div>
                                    
                                    <div class="list-group-item d-flex align-items-center">
                                        <div class="me-3">
                                            <div class="bg-warning text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                                <i class="fas fa-flask"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">Input hasil lab pasien</h6>
                                            <small class="text-muted">dari tabel <code class="bg-light px-1">hasil_lab</code></small>
                                        </div>
                                        <button class="btn btn-outline-warning">
                                            <i class="fas fa-arrow-right"></i> Input
                                        </button>
                                    </div>
                                    
                                    <div class="list-group-item d-flex align-items-center">
                                        <div class="me-3">
                                            <div class="bg-info text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                                <i class="fas fa-list"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">Lihat daftar semua pasien & status konsultasi</h6>
                                            <small class="text-muted">Monitoring real-time status konsultasi pasien</small>
                                        </div>
                                        <button class="btn btn-outline-info">
                                            <i class="fas fa-arrow-right"></i> Lihat
                                        </button>
                                    </div>
                                    
                                    <div class="list-group-item d-flex align-items-center">
                                        <div class="me-3">
                                            <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                                <i class="fas fa-calendar-alt"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">Kelola jadwal konsultasi pasien dengan dokter</h6>
                                            <small class="text-muted">Atur dan koordinasi jadwal antara pasien dan dokter</small>
                                        </div>
                                        <button class="btn btn-outline-success">
                                            <i class="fas fa-arrow-right"></i> Atur
                                        </button>
                                    </div>
                                    
                                    <div class="list-group-item d-flex align-items-center">
                                        <div class="me-3">
                                            <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                                <i class="fas fa-comments"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">Input awal konsultasi bila diperlukan</h6>
                                            <small class="text-muted">Membantu mempersiapkan proses konsultasi</small>
                                        </div>
                                        <button class="btn btn-outline-secondary">
                                            <i class="fas fa-arrow-right"></i> Input
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4">
                        <!-- Data Flow -->
                        <div class="card mb-4">
                            <div class="card-header bg-dark text-white">
                                <h5 class="mb-0"><i class="fas fa-sitemap"></i> Alur Data</h5>
                            </div>
                            <div class="card-body">
                                <div class="bg-dark text-light p-3 rounded">
                                    <div style="font-family: monospace; font-size: 0.9em;">
                                        <div class="text-info">users.id</div>
                                        <div class="ms-3">
                                            <span class="text-warning">└─</span> <span class="text-success">petugas.user_id</span>
                                        </div>
                                        <div class="ms-5">
                                            <span class="text-warning">└─</span> <span class="text-primary">pasien</span>
                                        </div>
                                        <div class="ms-5">
                                            <span class="text-warning">└─</span> <span class="text-warning">hasil_lab</span>
                                        </div>
                                        <div class="ms-5">
                                            <span class="text-warning">└─</span> <span class="text-info">jadwal_konsultasi</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Quick Actions -->
                        <div class="card">
                            <div class="card-header bg-warning text-dark">
                                <h5 class="mb-0"><i class="fas fa-bolt"></i> Quick Actions</h5>
                            </div>
                            <div class="card-body d-grid gap-2">
                                <button class="btn btn-primary">
                                    <i class="fas fa-user-plus"></i> Tambah Pasien Baru
                                </button>
                                <button class="btn btn-warning">
                                    <i class="fas fa-vial"></i> Input Hasil Lab
                                </button>
                                <button class="btn btn-success">
                                    <i class="fas fa-calendar-plus"></i> Buat Jadwal Konsultasi
                                </button>
                                <button class="btn btn-info">
                                    <i class="fas fa-search"></i> Cari Data Pasien
                                </button>
                                <button class="btn btn-secondary">
                                    <i class="fas fa-print"></i> Cetak Laporan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activities -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-secondary text-white">
                                <h5 class="mb-0"><i class="fas fa-clock"></i> Aktivitas Terbaru</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Waktu</th>
                                                <th>Aktivitas</th>
                                                <th>Pasien</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>10:30</td>
                                                <td><i class="fas fa-plus text-primary"></i> Menambah data pasien baru</td>
                                                <td>Ahmad Subagio</td>
                                                <td><span class="badge bg-success">Selesai</span></td>
                                            </tr>
                                            <tr>
                                                <td>10:15</td>
                                                <td><i class="fas fa-flask text-warning"></i> Input hasil lab</td>
                                                <td>Siti Rahayu</td>
                                                <td><span class="badge bg-success">Selesai</span></td>
                                            </tr>
                                            <tr>
                                                <td>09:45</td>
                                                <td><i class="fas fa-calendar text-info"></i> Membuat jadwal konsultasi</td>
                                                <td>Budi Santoso</td>
                                                <td><span class="badge bg-warning">Pending</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
