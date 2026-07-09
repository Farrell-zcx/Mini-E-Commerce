<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - BreeCommerce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card border-0 shadow-sm p-4">
                    <h3 class="fw-bold text-center text-dark mb-4">🔑 LOGIN BREE</h3>

                    <?php if (session()->getFlashdata('pesan')) : ?>
                        <div class="alert alert-success fw-bold small">🎉 <?= session()->getFlashdata('pesan'); ?></div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('error')) : ?>
                        <div class="alert alert-danger fw-bold small">❌ <?= session()->getFlashdata('error'); ?></div>
                    <?php endif; ?>

                    <form action="/auth/prosesLogin" method="post">
                        <?= csrf_field(); ?>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Alamat Email</label>
                            <input type="email" name="email" class="form-control" required placeholder="nama@email.com">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Password</label>
                            <input type="password" name="password" class="form-control" required placeholder="Masukkan password lu">
                        </div>

                        <button type="submit" class="btn btn-success w-100 fw-bold rounded-pill py-2 mt-2">
                            MASUK SEKARANG 🚀
                        </button>
                    </form>

                    <p class="text-center small text-muted mt-4">
                        Belum punya akun? <a href="/register" class="text-decoration-none fw-bold">Daftar di sini</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

</body>
</html>