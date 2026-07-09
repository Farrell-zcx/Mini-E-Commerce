<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>

<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card border-0 shadow-sm p-4">
            <h3 class="fw-bold text-center text-dark mb-4">🔑 LOGIN</h3>

            <form action="/auth/prosesLogin" method="post">
                <?= csrf_field(); ?>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Alamat Email</label>
                    <input type="email" name="email" class="form-control" required placeholder="nama@email.com">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Password</label>
                    <input type="password" name="password" class="form-control" required placeholder="Masukkan password">
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

<?= $this->endSection(); ?>