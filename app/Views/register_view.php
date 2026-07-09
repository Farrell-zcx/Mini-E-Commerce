<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>

<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card border-0 shadow-sm p-4">
            <h3 class="fw-bold text-center text-dark mb-4">🛒 REGISTER</h3>

            <form action="/auth/simpanRegister" method="post">
                <?= csrf_field(); ?>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="form-control" required placeholder="Contoh: Andi Wijaya" value="<?= old('nama_lengkap'); ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Alamat Email</label>
                    <input type="email" name="email" class="form-control" required placeholder="nama@email.com" value="<?= old('email'); ?>">
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

<?= $this->endSection(); ?>