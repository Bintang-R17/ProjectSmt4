<?php include __DIR__ . '/../partials/layout.php';?>
    <!-- Main Content -->
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-12">
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2 class="text-danger"><i class="fas fa-user-shield"></i> Dashboard Admin</h2>
                        <p class="text-muted">Kelola sistem dan monitoring seluruh aktivitas</p>
                    </div>
                    <div>
                        <span class="badge bg-success fs-6 me-2">System Online</span>
                        <span class="badge bg-info fs-6">All Services Active</span>
                    </div>
                </div>

                <!-- System Statistics -->
                <div class="row mb-4">
                    <div class="col-lg-3 col-md-6 mb-3">
                        <div class="card border-primary h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-users-cog fa-3x text-primary mb-3"></i>
                                <h4 class="text-primary">45</h4>
                                <p class="card-text">Total Users</p>
                                <small class="text-muted">Admin, Dokter, Petugas, Pasien</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <div class="card border-success h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-user-md fa-3x text-success mb-3"></i>
                                <h4 class="text-success">12</h4>
                                <p class="card-text">Dokter Aktif</p>
                                <small class="text-muted">Online saat ini</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <div class="card border-warning h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-chart-line fa-3x text-warning mb-3"></i>
                                <h4 class="text-warning">350</h4>
                                <p class="card-text">Konsultasi Bulan Ini</p>
                                <small class="text-success">↑ 15% dari bulan lalu</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <div class="card border-info h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-server fa-3x text-info mb-3"></i>
                                <h4 class="text-info">98%</h4>
                                <p class="card-text">System Health</p>
                                <small class="text-muted">Excellent performance</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Features -->
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header bg-danger text-white">
                                <h5 class="mb-0"><i class="fas fa-cogs"></i> Fitur Admin</h5>
                            </div>
                            <div class="card-body">
                                <div class="list-group list-group-flush">
                                    <div class="list-group-item d-flex align-items-center">
                                        <div class="me-3">
                                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                                <i class="fas fa-users"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">Kelola semua user (admin, dokter, petugas, pasien)</h6>
                                            <small class="text-muted">Manajemen user, role system, dan hak akses</small>
                                        </div>
                                        <button class="btn btn-outline-primary"><a href="index.php?page=manage-user">
                                            <i class="fas fa-arrow-right"></i> Kelola</a>
                                        </button>
                                    </div>
                                    
                                    <div class="list-group-item d-flex align-items-center">
                                        <div class="me-3">
                                            <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                                <i class="fas fa-chart-bar"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">Lihat statistik semua data</h6>
                                            <small class="text-muted">jumlah pasien, konsultasi hari ini, dokter aktif, dsb</small>
                                        </div>
                                        <button class="btn btn-outline-success">
                                            <i class="fas fa-arrow-right"></i> Statistik
                                        </button>
                                    </div>
                                    
                                    <div class="list-group-item d-flex align-items-center">
                                        <div class="me-3">
                                            <div class="bg-warning text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                                <i class="fas fa-download"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">Backup database</h6>
                                            <small class="text-muted">Backup dan restore system data secara berkala</small>
                                        </div>
                                        <button class="btn btn-outline-warning">
                                            <i class="fas fa-arrow-right"></i> Backup
                                        </button>
                                    </div>
                                    
                                    <div class="list-group-item d-flex align-items-center">
                                        <div class="me-3">
                                            <div class="bg-info text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                                <i class="fas fa-history"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">Lihat log aktivitas sistem (tambahan)</h6>
                                            <small class="text-muted">Monitor aktivitas, audit trail, dan security logs</small>
                                        </div>
                                        <button class="btn btn-outline-info">
                                            <i class="fas fa-arrow-right"></i> Log
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4">
                        <!-- System Access -->
                        <div class="card mb-4">
                            <div class="card-header bg-dark text-white">
                                <h5 class="mb-0"><i class="fas fa-code"></i> Alur Data Admin</h5>
                            </div>
                            <div class="card-body">
                                <div class="bg-dark text-light p-3 rounded">
                                    <div style="font-family: monospace; font-size: 0.85em;">
                                        <div><span class="text-info">users.role</span> = <span class="text-success">'admin'</span></div>
                                        <div class="ms-3">
                                            <span class="text-warning">└─</span> <span class="text-primary">akses semua tabel:</span>
                                        </div>
                                        <div class="ms-5 text-light">
                                            <div><span class="text-warning">•</span> users</div>
                                            <div><span class="text-warning">•</span> dokter</div>
                                            <div><span class="text-warning">•</span> petugas</div>
                                            <div><span class="text-warning">•</span> pasien</div>
                                            <div><span class="text-warning">•</span> konsultasi</div>
                                            <div><span class="text-warning">•</span> hasil_lab</div>
                                            <div><span class="text-warning">•</span> rekam_medis</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Admin Tools -->
                        <div class="card">
                            <div class="card-header bg-warning text-dark">
                                <h5 class="mb-0"><i class="fas fa-tools"></i> Admin Tools</h5>
                            </div>
                            <div class="card-body d-grid gap-2">
                                <button class="btn btn-primary">
                                    <i class="fas fa-user-plus"></i> Tambah User Baru
                                </button>
                                <button class="btn btn-success">
                                    <i class="fas fa-chart-pie"></i> Generate Report
                                </button>
                                <button class="btn btn-warning">
                                    <i class="fas fa-database"></i> Database Backup
                                </button>