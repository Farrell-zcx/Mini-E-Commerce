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
                    <div class="card-body p-4">
                        
                        <form action="/shop/simpan" method="post" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Pilih Kategori</label>
                                <select name="kategori_id" class="form-select" required>
                                    <option value="">-- Pilih Kategori Produk --</option>
                                    <?php foreach($daftar_kategori as $kat): ?>
                                        <option value="<?= $kat['id']; ?>"><?= esc($kat['nama_kategori']); ?></option>
                                    <?php endforeach; ?>
                                </select>
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

</body>
</html>