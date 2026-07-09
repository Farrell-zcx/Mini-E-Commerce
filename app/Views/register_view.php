<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - BreeCommerce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card border-0 shadow-sm p-4">
                    <h3 class="fw-bold text-center text-dark mb-4">🛒 REGISTER BREE</h3>

                    <?php if (session()->getFlashdata('error')) : ?>
                        <div class="alert alert-danger fw-bold small"><?= session()->getFlashdata('error'); ?></div>
                    <?php endif; ?>

                    <form action="/auth/simpanRegister" method="post">
                        <?= csrf_field(); ?>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" class="form-control" required placeholder="Contoh: Andi Wijaya">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Alamat Email</label>
                            <input type="email" name="email" class="form-control" required placeholder="nama@email.com">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Password</label>
                            <input type="password" name="password" class="form-control" required placeholder="Minimal 6 karakter">
                        </div>

                        <button type="submit" class="btn btn-primary w-100 fw-bold rounded-pill py-2 mt-2">
                            DAFTAR SEKARANG 🚀
                        </button>
                    </form>

                    <p class="text-center small text-muted mt-4">
                        Sudah punya akun? <a href="/login" class="text-decoration-none fw-bold">Login di sini</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

</body>
</html>