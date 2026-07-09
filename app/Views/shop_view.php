<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>

<?php
/**
 * @var array $daftar_produk Daftar produk dari database
 */
?>

<h3 class="fw-bold mb-4">Katalog Produk Terbaru</h3>

<div class="row">
    <?php foreach ($daftar_produk as $p): ?>
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <?php if ($p['foto'] && $p['foto'] !== 'default.png'): ?>
                    <img src="/uploads/<?= $p['foto']; ?>" class="card-img-top rounded-top" alt="<?= esc($p['nama_produk']); ?>" style="height: 200px; object-fit: cover;">
                <?php else: ?>
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
                    <form action="/keranjang/add/<?= $p['id']; ?>" method="post" class="d-inline">
                        <?= csrf_field(); ?>
                        <button type="submit" class="btn btn-primary btn-sm fw-bold rounded-pill w-100">
                            <i class="bi bi-cart-plus-fill"></i> Tambah ke Keranjang
                        </button>
                    </form>

                    <?php if (session()->get('isLoggedIn')): ?>
                        <div class="d-flex gap-2">
                            <a href="/edit-produk/<?= $p['id']; ?>" class="btn btn-warning btn-sm w-50 fw-bold rounded-pill text-dark">Edit</a>
                            <form action="/produk/delete/<?= $p['id']; ?>" method="post" class="w-50" onsubmit="return confirm('Yakin mau hapus produk ini?')">
                                <?= csrf_field(); ?>
                                <button type="submit" class="btn btn-danger btn-sm w-100 fw-bold rounded-pill">Hapus</button>
                            </form>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?= $this->endSection(); ?>