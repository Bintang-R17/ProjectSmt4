<?php function renderParameterCard($param) { ?>
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
                        Normal: <?= $param['nilai_min'] ?? '-' ?> - <?= $param['nilai_max'] ?? '-' ?>
                    </small>
                    <span class="badge bg-<?= $param['status_class'] ?>"><?= $param['status'] ?></span>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
