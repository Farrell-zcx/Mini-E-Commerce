<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini E-Commerce Pro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">🛒 BREE-COMMERCE</a>
            
            <div class="d-flex align-items-center gap-3">
                <a href="/keranjang" class="btn btn-outline-light position-relative btn-sm px-3 rounded-pill">
                    <i class="bi bi-cart3 fs-6"></i> Keranjang
                    <?php 
                        $session = session()->get('keranjang') ?? [];
                        $totalItem = array_sum(array_column($session, 'jumlah'));
                        if ($totalItem > 0): 
                    ?>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            <?= $totalItem; ?>
                        </span>
                    <?php endif; ?>
                </a>
                
                <a href="/tambah-produk" class="btn btn-success btn-sm fw-bold px-3 rounded-pill">+ Tambah Produk</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <?php if (session()->getFlashdata('pesan')) : ?>
            <div class="alert alert-success alert-dismissible fade show fw-bold shadow-sm" role="alert">
                🚀 <?= session()->getFlashdata('pesan'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger alert-dismissible fade show fw-bold shadow-sm" role="alert">
                ❌ <?= session()->getFlashdata('error'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <h3 class="fw-bold mb-4">Katalog Produk Terbaru</h3>
        
        <div class="row">
            <?php foreach ($daftar_produk as $p) : ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm border-0">
                        <?php if ($p['foto'] && $p['foto'] !== 'default.png') : ?>
                            <img src="/uploads/<?= $p['foto']; ?>" class="card-img-top rounded-top" alt="<?= esc($p['nama_produk']); ?>" style="height: 200px; object-fit: cover;">
                        <?php else : ?>
                            <div class="bg-secondary text-white text-center py-5 rounded-top fw-bold" style="background: linear-gradient(45deg, #343a40, #6c757d); height: 200px; display: flex; align-items: center; justify-content: center;">
                                [ Gambar <?= esc($p['nama_produk']); ?> ]
                            </div>
                        <?php endif; ?>
                        
                        <div class="card-body d-flex flex-column">
                            <span class="badge bg-info text-dark mb-2 align-self-start fw-semibold">
                                <?= esc($p['nama_kategori']); ?>
                            </span>
                            
                            <h5 class="card-title fw-bold text-dark mb-2"><?= esc($p['nama_produk']); ?></h5>
                            <p class="card-text text-muted small flex-grow-1"><?= esc($p['deskripsi']); ?></p>
                            
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="text-danger fw-bold fs-5">Rp <?= number_format($p['harga'], 0, ',', '.'); ?></span>
                                <span class="text-muted small">Stok: <strong><?= esc($p['stok']); ?></strong></span>
                            </div>
                        </div>
                        
                        <div class="card-footer bg-white border-0 pb-3 d-flex flex-column gap-2">
                            <a href="/shop/add-to-cart/<?= $p['id']; ?>" class="btn btn-primary btn-sm fw-bold rounded-pill w-100">
                                <i class="bi bi-cart-plus-fill"></i> Tambah ke Keranjang
                            </a>
                            
                            <div class="d-flex gap-2">
                                <a href="/edit-produk/<?= $p['id']; ?>" class="btn btn-warning btn-sm w-50 fw-bold rounded-pill text-dark">Edit</a>
                                <a href="/shop/delete/<?= $p['id']; ?>" class="btn btn-danger btn-sm w-50 fw-bold rounded-pill" onclick="return confirm('Yakin mau hapus produk ini?')">Hapus</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
