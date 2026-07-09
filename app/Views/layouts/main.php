<?php
/**
 * Layout utama — Template induk yang digunakan semua halaman.
 *
 * @var string $pageTitle Judul halaman (opsional)
 */
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? 'Mini E-Commerce Pro'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">🛒 BREE-COMMERCE</a>

            <div class="d-flex align-items-center gap-3">
                <?php
                $sessionKeranjang = session()->get('keranjang') ?? [];
                $totalItem = array_sum(array_column($sessionKeranjang, 'jumlah'));
                ?>
                <a href="/keranjang" class="btn btn-outline-light position-relative btn-sm px-3 rounded-pill">
                    <i class="bi bi-cart3 fs-6"></i> Keranjang
                    <?php if ($totalItem > 0): ?>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            <?= $totalItem; ?>
                        </span>
                    <?php endif; ?>
                </a>

                <?php if (session()->get('isLoggedIn')): ?>
                    <span class="text-light small">
                        <i class="bi bi-person-circle"></i> <?= esc(session()->get('nama_lengkap')); ?>
                    </span>
                    <a href="/tambah-produk" class="btn btn-success btn-sm fw-bold px-3 rounded-pill">+ Tambah Produk</a>
                    <a href="/logout" class="btn btn-outline-danger btn-sm rounded-pill">Logout</a>
                <?php else: ?>
                    <a href="/login" class="btn btn-outline-info btn-sm rounded-pill">Login</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <div class="container">
        <?php if (session()->getFlashdata('pesan')): ?>
            <div class="alert alert-success alert-dismissible fade show fw-bold shadow-sm" role="alert">
                🚀 <?= session()->getFlashdata('pesan'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show fw-bold shadow-sm" role="alert">
                ❌ <?= session()->getFlashdata('error'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                <strong>❌ Terdapat kesalahan:</strong>
                <ul class="mb-0 mt-1">
                    <?php foreach (session()->getFlashdata('errors') as $err): ?>
                        <li><?= esc($err); ?></li>
                    <?php endforeach; ?>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?= $this->renderSection('content'); ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        window.setTimeout(function() {
            const activeAlerts = document.querySelectorAll('.alert');
            activeAlerts.forEach(function(alert) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 4000);
    </script>

</body>

</html>
