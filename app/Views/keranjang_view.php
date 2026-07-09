<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>

<?php
/**
 * @var array  $keranjang  Data isi keranjang belanja dari session
 * @var int    $grandTotal Total belanja yang sudah dihitung di controller
 */
?>

<h3 class="fw-bold mb-4"><i class="bi bi-cart3"></i> Detail Keranjang Belanja</h3>

<?php if (empty($keranjang)): ?>
    <div class="card p-5 text-center border-0 shadow-sm">
        <i class="bi bi-cart-x text-muted display-1"></i>
        <h4 class="mt-3 fw-bold text-muted">Keranjang belanja masih kosong!</h4>
        <a href="/" class="btn btn-primary rounded-pill fw-bold mt-3 px-4">Kembali Berburu Barang</a>
    </div>
<?php else: ?>
    <div class="row">

        <div class="col-md-8 mb-4">
            <div class="card p-3 border-0 shadow-sm">
                <table class="table align-middle">
                    <thead>
                        <tr class="text-muted">
                            <th>Produk</th>
                            <th>Harga</th>
                            <th class="text-center">Jumlah</th>
                            <th>Total</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($keranjang as $id => $item): ?>
                            <tr>
                                <td>
                                    <div class="fw-bold text-dark"><?= esc($item['nama_produk']); ?></div>
                                </td>
                                <td>Rp <?= number_format($item['harga'], 0, ',', '.'); ?></td>
                                <td class="text-center fw-bold"><?= $item['jumlah']; ?>x</td>
                                <td class="fw-bold text-danger">Rp <?= number_format($item['harga'] * $item['jumlah'], 0, ',', '.'); ?></td>
                                <td class="text-center">
                                    <form action="/keranjang/hapus/<?= $id; ?>" method="post" class="d-inline">
                                        <?= csrf_field(); ?>
                                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-circle">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-4 border-0 shadow-sm bg-dark text-white">
                <h5 class="fw-bold mb-3 border-bottom pb-2">Ringkasan Belanja</h5>
                <div class="d-flex justify-content-between mb-4">
                    <span class="text-muted">Total Bayar:</span>
                    <span class="fs-4 fw-bold text-warning">Rp <?= number_format($grandTotal, 0, ',', '.'); ?></span>
                </div>

                <form action="<?= base_url('keranjang/checkout'); ?>" method="post">
                    <?= csrf_field(); ?>
                    <button type="submit" class="btn btn-success w-100 fw-bold fs-5 rounded-pill py-2 shadow">
                        🚀 CHECKOUT SEKARANG
                    </button>
                </form>

                <a href="/" class="btn btn-outline-light w-100 fw-bold rounded-pill mt-2">Lanjut Belanja</a>
            </div>
        </div>

    </div>
<?php endif; ?>

<?= $this->endSection(); ?>