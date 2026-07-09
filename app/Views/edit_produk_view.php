<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-dark text-white fw-bold">📝 Edit Produk: <?= esc($produk['nama_produk']); ?></div>
                    <div class="card-body p-4">
                        
                        <form action="<?= base_url('shop/update/' . $produk['id']); ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field(); ?>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Pilih Kategori</label>
                                <select name="kategori_id" class="form-select" required>
                                    <?php foreach($daftar_kategori as $kat): ?>
                                        <option value="<?= $kat['id']; ?>" <?= $kat['id'] == $produk['kategori_id'] ? 'selected' : ''; ?>>
                                            <?= esc($kat['nama_kategori']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Nama Produk</label>
                                <input type="text" name="nama_produk" class="form-control" value="<?= esc($produk['nama_produk']); ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control" rows="3" required><?= esc($produk['deskripsi']); ?></textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Harga (Rp)</label>
                                    <input type="number" name="harga" class="form-control" value="<?= esc($produk['harga']); ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Jumlah Stok</label>
                                    <input type="number" name="stok" class="form-control" value="<?= esc($produk['stok']); ?>" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Ganti Foto Produk</label>

                                <?php if ($produk['foto'] && $produk['foto'] !== 'default.png') : ?>
                                    <div class="mb-2">
                                        <img src="<?= base_url('uploads/' . esc($produk['foto'])); ?>" alt="Foto saat ini" class="img-thumbnail" style="max-height: 120px; object-fit: cover;">
                                    </div>
                                <?php endif; ?>

                                <input type="file" name="foto" class="form-control" accept="image/*">
                                <div class="form-text text-muted mb-2">Biarkan kosong jika tidak ingin mengubah foto produk.</div>
                                <span class="badge bg-secondary text-white">File saat ini: <?= esc($produk['foto']); ?></span>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="/" class="btn btn-secondary fw-bold rounded-pill px-4">Batal</a>
                                <button type="submit" class="btn btn-warning fw-bold text-dark rounded-pill px-4">Simpan Perubahan</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>