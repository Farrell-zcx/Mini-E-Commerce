<?php
/**
 * @var CodeIgniter\View\View $this
 * @var array<int, array{id: int, nama_produk: string, deskripsi: string, harga: float, stok: int, foto: string, nama_kategori: string}> $daftar_produk
 */

// IDE helper — fungsi-fungsi CI4 yang dipakai di view ini
if (false) {
    /** @var \CodeIgniter\Session\Session $session */
    function session(): \CodeIgniter\Session\Session {}
    function esc(string $data, string $context = 'html'): string {}
    function csrf_field(): string {}
    function base_url(string $uri = ''): string {}
    function old(string $key, $default = null) {}
}
?>
<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>

<!-- Notifikasi Alert Sukses Dinamis (Flashdata) -->
<?php if (session()->getFlashdata('pesan')) : ?>
    <div class="alert mb-8 p-4 rounded-lg bg-emerald-500/15 text-emerald-400 border border-emerald-500/20 shadow-md">
        <span class="font-medium">🚀 <?= session()->getFlashdata('pesan'); ?></span>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')) : ?>
    <div class="alert mb-8 p-4 rounded-lg bg-red-500/15 text-red-400 border border-red-500/20 shadow-md">
        <span class="font-medium">❌ <?= session()->getFlashdata('error'); ?></span>
    </div>
<?php endif; ?>

<div class="mb-8">
    <h1 class="text-3xl font-bold text-[#F3F4F6] tracking-tight font-serif">Produk Tersedia</h1>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php foreach ($daftar_produk as $p): ?>
        <article class="bg-[#242E42]/40 backdrop-blur-md rounded-xl overflow-hidden border border-white/5 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl hover:border-white/10 group flex flex-col h-full">
            
            <!-- Foto Produk -->
            <div class="relative h-64 overflow-hidden bg-[#1A2232] flex items-center justify-center">
                <?php if ($p['foto'] && $p['foto'] !== 'default.png'): ?>
                    <img src="/uploads/<?= $p['foto']; ?>" alt="<?= esc($p['nama_produk']); ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                <?php else: ?>
                    <div class="w-full h-full bg-gradient-to-br from-slate-700 to-slate-800 text-slate-400 text-center flex items-center justify-center font-bold px-4 text-sm">
                        [ Gambar <?= esc($p['nama_produk']); ?> ]
                    </div>
                <?php endif; ?>
            </div>

            <!-- Detail Spesifikasi Barang -->
            <div class="p-6 flex flex-col flex-grow">
                <!-- Badge Kategori Produk -->
                <div class="mb-3">
                    <span class="inline-block bg-[#A3E635]/10 text-[#A3E635] text-xs px-2.5 py-1 rounded-full border border-[#A3E635]/20 font-semibold tracking-wide">
                        <?= esc($p['nama_kategori']); ?>
                    </span>
                </div>

                <!-- Judul Barang -->
                <h2 class="text-xl font-bold text-[#F3F4F6] mb-2 tracking-tight group-hover:text-[#ccff80] transition-colors">
                    <?= esc($p['nama_produk']); ?>
                </h2>
                
                <!-- Deskripsi Pendek -->
                <p class="text-sm text-gray-400 mb-6 flex-grow line-clamp-3 leading-relaxed">
                    <?= esc($p['deskripsi']); ?>
                </p>

                <!-- Info Harga dan Informasi Sisa Stok -->
                <div class="flex justify-between items-center mb-6">
                    <span class="text-xl font-bold text-[#A3E635]">
                        Rp <?= number_format($p['harga'], 0, ',', '.'); ?>
                    </span>
                    <span class="text-xs text-gray-500">
                        Stok: <span class="text-gray-300 font-semibold"><?= esc($p['stok']); ?></span>
                    </span>
                </div>

                <!-- Kendali Tombol Modifikasi & Keranjang Aman (POST) -->
                <div class="flex flex-col gap-2 mt-auto">
                    <!-- Form POST Tambah ke Keranjang (Proteksi CSRF) -->
                    <form action="/keranjang/add/<?= $p['id']; ?>" method="post" class="w-full m-0 p-0">
                        <?= csrf_field(); ?>
                        <button type="submit" class="w-full bg-[#A3E635] text-gray-950 hover:bg-[#84cc16] transition-colors text-sm font-bold py-3 rounded-lg flex justify-center items-center gap-2 shadow-md shadow-[#A3E635]/10">
                            <span class="material-symbols-outlined text-[18px]">shopping_cart</span>
                            Tambah ke Keranjang
                        </button>
                    </form>

                    <!-- Tombol Istimewa Akses Admin (Sudah Disamakan Ukurannya Sempurna) -->
                    <?php if (session()->get('isLoggedIn')): ?>
                        <div class="grid grid-cols-2 gap-2 mt-1">
                            
                            <!-- Tombol Edit -->
                            <a href="/edit-produk/<?= $p['id']; ?>" class="w-full bg-white/5 text-gray-300 hover:bg-white/10 border border-white/5 transition-colors text-xs py-2.5 rounded-lg font-semibold flex items-center justify-center text-center">
                                Edit
                            </a>
                            
                            <!-- Form Tombol Hapus (Symmetrical Stretch) -->
                            <form action="/produk/delete/<?= $p['id']; ?>" method="post" class="w-full flex m-0 p-0">
                                <?= csrf_field(); ?>
                                <button type="submit" class="w-full bg-red-500/10 text-red-400 hover:bg-red-500/20 border border-red-500/10 transition-colors text-xs py-2.5 rounded-lg font-semibold flex items-center justify-center" onclick="return confirm('Yakin mau hapus produk ini?')">
                                    Hapus
                                </button>
                            </form>
                            
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </article>
    <?php endforeach; ?>
</div>

<!-- Fade out Alert Otomatis 3 Detik hilang -->
<script>
    window.setTimeout(function() {
        const activeAlerts = document.querySelectorAll('.alert');
        activeAlerts.forEach(function(alert) {
            alert.style.transition = "opacity 0.5s ease";
            alert.style.opacity = "0";
            setTimeout(() => alert.remove(), 500);
        });
    }, 3000);
</script>

<?= $this->endSection(); ?>