<?php
/**
 * @var array $daftar_kategori Daftar semua kategori
 */
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-dark text-white fw-bold">➕ Tambah Produk Baru</div>
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

                        <form action="/shop/simpan" method="post" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Pilih Kategori</label>
                                <div class="input-group">
                                    <select name="kategori_id" class="form-select" required>
                                        <option value="">-- Pilih Kategori Produk --</option>
                                        <?php foreach ($daftar_kategori as $k) : ?>
                                            <option value="<?= $k['id']; ?>"><?= esc($k['nama_kategori']); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <button class="btn btn-primary fw-bold" type="button" data-bs-toggle="modal" data-bs-target="#modalTambahKategori">
                                        ➕ Kategori
                                    </button>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Nama Produk</label>
                                <input type="text" name="nama_produk" class="form-control" placeholder="Contoh: Velixir Icarus EDP" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control" rows="3" placeholder="Detail spesifikasi produk..." required></textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Harga (Rp)</label>
                                    <input type="number" name="harga" class="form-control" placeholder="0" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Jumlah Stok</label>
                                    <input type="number" name="stok" class="form-control" placeholder="0" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Foto Produk</label>
                                <input type="file" name="foto" class="form-control" accept="image/*">
                                <div class="form-text text-muted">Format gambar: JPG, JPEG, atau PNG. Max 2MB.</div>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="/" class="btn btn-secondary fw-bold rounded-pill px-4">Kembali</a>
                                <button type="submit" class="btn btn-success fw-bold rounded-pill px-4">Simpan Produk</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="modalTambahKategori" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalKategoriLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title fw-bold" id="modalKategoriLabel">Tambah Kategori Baru</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/shop/simpan-kategori" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Kategori Baru</label>
                        <input type="text" name="nama_kategori" class="form-control" placeholder="Contoh: Otomotif / Hobi / Pakaian" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary fw-bold" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success fw-bold">Simpan Kategori </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    window.setTimeout(function() {
        const activeAlerts = document.querySelectorAll('.alert');
        activeAlerts.forEach(function(alert) {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 3000);
</script>

</body>
</html>