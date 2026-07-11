<!DOCTYPE html>
<?php
/**
 * @var array $daftar_kategori
 */
?>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Tambah Produk Baru - BreeCommerce</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=block" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&amp;family=Manrope:wght@600;700;800&amp;display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        try {
            tailwind.config = {
                darkMode: "class",
                theme: {
                    extend: {
                        "colors": {
                            "inverse-on-surface": "#2e3132",
                            "on-surface": "#F3F4F6",
                            "error": "#ffb4ab",
                            "secondary": "#bdc7d9",
                            "primary-container": "#a3e635",
                            "background": "#1F2937",
                            "on-primary-fixed": "#121f00",
                            "surface-variant": "#323537",
                            "on-tertiary-container": "#734b80",
                            "on-tertiary-fixed-variant": "#5e376b",
                            "on-error-container": "#ffdad6",
                            "on-secondary-fixed-variant": "#3d4756",
                            "on-primary-container": "#416400",
                            "tertiary-container": "#f3c1ff",
                            "primary-fixed-dim": "#98da27",
                            "surface-container-low": "#191c1e",
                            "surface-dim": "#111415",
                            "tertiary-fixed": "#fad7ff",
                            "on-tertiary-fixed": "#2f093d",
                            "on-secondary-container": "#afb9cb",
                            "surface-container": "#1d2022",
                            "surface-container-high": "#282a2c",
                            "inverse-surface": "#e1e2e4",
                            "secondary-fixed-dim": "#bdc7d9",
                            "primary": "#A3E635",
                            "tertiary-fixed-dim": "#e7b6f3",
                            "outline": "#8c947c",
                            "on-primary": "#1F2937",
                            "outline-variant": "#424936",
                            "on-surface-variant": "#D1D5DB",
                            "secondary-container": "#404a59",
                            "surface-container-lowest": "#0c0f10",
                            "surface-tint": "#98da27",
                            "inverse-primary": "#446900",
                            "surface": "#1F2937",
                            "secondary-fixed": "#d9e3f6",
                            "surface-bright": "#37393b",
                            "tertiary": "#fee7ff",
                            "on-primary-fixed-variant": "#334f00",
                            "on-secondary-fixed": "#121c2a",
                            "on-tertiary": "#462153",
                            "error-container": "#93000a",
                            "primary-fixed": "#b2f746",
                            "on-background": "#F3F4F6",
                            "surface-container-highest": "#323537",
                            "on-secondary": "#27313f",
                            "on-error": "#690005"
                        },
                        "spacing": {
                            "gutter": "20px",
                            "stack-sm": "12px",
                            "base": "8px",
                            "stack-lg": "48px",
                            "stack-md": "24px",
                            "container-padding": "24px",
                            "sm": "1rem",
                            "xs": "0.5rem",
                            "lg": "2.5rem",
                            "md": "1.5rem",
                            "xl": "4rem",
                            "margin-mobile": "16px",
                            "margin-desktop": "48px"
                        }
                    }
                }
            }
        } catch(_e) {}
    </script>
</head>
<body class="bg-[#111415] text-on-background min-h-screen flex flex-col font-body-md antialiased relative">
    
    <div class="absolute inset-0 bg-gradient-to-br from-primary/10 to-transparent pointer-events-none z-[-1]"></div>

    <header class="bg-white/5 backdrop-blur-md font-headline-md text-headline-md w-full sticky top-0 z-50 border-b border-white/10 shadow-sm">
        <div class="flex justify-between items-center h-16 px-margin-desktop w-full max-w-[1440px] mx-auto">
            <a href="<?= base_url('/'); ?>" class="flex items-center gap-xs">
                <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">storefront</span>
                <span class="font-headline-md text-headline-md font-bold text-on-surface">BREE-COMMERCE</span>
            </a>

            <div class="flex items-center gap-md">
                <div class="hidden md:flex items-center gap-xs">
                    <a href="<?= base_url('shop/keranjang'); ?>" class="p-xs text-on-surface-variant hover:text-on-surface hover:bg-white/5 rounded-full transition-colors duration-200 relative group">
                        <span class="material-symbols-outlined">shopping_cart</span>
                    </a>
                    <div class="flex items-center gap-xs px-sm py-xs hover:bg-white/5 rounded-lg cursor-pointer transition-colors duration-200">
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">account_circle</span>
                        <span class="font-label-md text-label-md text-on-surface"><?= esc(session()->get('nama_lengkap') ?? 'alberto'); ?></span>
                    </div>
                </div>
                <div class="flex items-center gap-sm">
                    <a href="<?= base_url('logout'); ?>" class="hidden md:flex items-center justify-center h-10 px-md rounded border border-white/20 text-on-surface-variant hover:text-on-surface hover:bg-white/5 transition-colors duration-200 font-label-md text-label-md">
                        Logout
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main class="flex-1 w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-desktop py-lg relative z-10">
        <div class="max-w-3xl mx-auto bg-white/10 backdrop-blur-lg rounded-xl border border-white/20 overflow-hidden shadow-2xl">
            
            <div class="bg-white/5 px-lg py-md border-b border-white/10 flex items-center gap-sm">
                <div class="w-8 h-8 rounded-full bg-primary/20 flex items-center justify-center">
                    <span class="material-symbols-outlined text-primary">add</span>
                </div>
                <h1 class="font-headline-md text-headline-md text-on-surface">Tambah Produk Baru</h1>
            </div>

            <form action="/produk/simpan" method="post" enctype="multipart/form-data" class="p-lg space-y-md">
                <?= csrf_field(); ?>

                <div class="space-y-xs">
                    <label class="font-label-md text-label-md text-on-surface block" for="category">Pilih Kategori</label>
                    <div class="flex gap-sm">
                        <div class="relative flex-1">
                            <select name="kategori_id" class="w-full h-12 bg-black/20 border border-white/20 rounded-lg px-md text-on-surface font-body-md appearance-none focus:ring-0 transition-shadow" id="category" required>
                                <option class="text-on-surface-variant bg-[#111415]" disabled selected value="">-- Pilih Kategori Produk --</option>
                                <?php foreach ($daftar_kategori as $k): ?>
                                    <option class="bg-[#111415]" value="<?= $k['id']; ?>"><?= esc($k['nama_kategori']); ?></option>
                                <?php endforeach; ?>
                            </select>
                            <span class="material-symbols-outlined absolute right-md top-1/2 -translate-y-1/2 text-on-surface pointer-events-none">expand_more</span>
                        </div>
                        <button id="btnOpenKategori" class="h-12 px-md bg-white/10 hover:bg-white/20 text-on-surface border border-white/20 rounded-lg font-label-md text-label-md flex items-center gap-xs transition-colors whitespace-nowrap shadow-sm" type="button">
                            <span class="material-symbols-outlined text-sm">add</span> Kategori
                        </button>
                    </div>
                </div>

                <div class="space-y-xs">
                    <label class="font-label-md text-label-md text-on-surface block" for="product_name">Nama Produk</label>
                    <input name="nama_produk" class="w-full h-12 bg-black/20 border border-white/20 rounded-lg px-md text-on-surface font-body-md focus:ring-0 transition-shadow placeholder:text-on-surface-variant/50" id="product_name" placeholder="Contoh: Velixir Icarus EDP" type="text" value="<?= old('nama_produk'); ?>" required>
                </div>

                <div class="space-y-xs">
                    <label class="font-label-md text-label-md text-on-surface block" for="description">Deskripsi</label>
                    <textarea name="deskripsi" class="w-full bg-black/20 border border-white/20 rounded-lg p-md text-on-surface font-body-md focus:ring-0 transition-shadow resize-y placeholder:text-on-surface-variant/50" id="description" placeholder="Detail spesifikasi produk..." rows="4" required><?= old('deskripsi'); ?></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-md">
                    <div class="space-y-xs">
                        <label class="font-label-md text-label-md text-on-surface block" for="price">Harga (Rp)</label>
                        <input name="harga" class="w-full h-12 bg-black/20 border border-white/20 rounded-lg px-md text-on-surface font-body-md focus:ring-0 transition-shadow" id="price" min="0" type="number" value="<?= old('harga') ?? 0; ?>" required>
                    </div>
                    <div class="space-y-xs">
                        <label class="font-label-md text-label-md text-on-surface block" for="stock">Jumlah Stok</label>
                        <input name="stok" class="w-full h-12 bg-black/20 border border-white/20 rounded-lg px-md text-on-surface font-body-md focus:ring-0 transition-shadow" id="stock" min="0" type="number" value="<?= old('stok') ?? 0; ?>" required>
                    </div>
                </div>

                <div class="space-y-xs">
                    <label class="font-label-md text-label-md text-on-surface block">Foto Produk</label>
                    <div class="flex items-center gap-sm">
                        <div class="relative w-full md:w-auto flex-1 md:flex-none flex items-center bg-black/20 border border-white/20 rounded-lg overflow-hidden h-12 focus-within:ring-1 focus-within:ring-primary focus-within:border-primary transition-shadow">
                            <input name="foto" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" id="product_photo" type="file">
                            <div class="h-full px-md flex items-center border-r border-white/20 font-label-md text-label-md text-on-surface whitespace-nowrap bg-white/20">
                                Choose File
                            </div>
                            <div class="px-md font-body-md text-on-surface-variant/70 truncate flex-1" id="file_name_display">
                                No file chosen
                            </div>
                        </div>
                    </div>
                    <p class="font-label-sm text-label-sm text-on-surface-variant/70 mt-1">Format gambar: JPG, JPEG, atau PNG. Max 2MB.</p>
                </div>

                <div class="pt-lg flex items-center justify-between border-t border-white/10 mt-lg">
                    <a href="<?= base_url('/'); ?>" class="h-12 px-lg rounded-lg border border-white/20 bg-transparent text-on-surface font-label-md text-label-md hover:bg-white/10 transition-colors flex items-center justify-center">
                        Kembali
                    </a>
                    <button class="h-12 px-lg rounded-lg bg-primary text-on-primary font-label-md text-label-md font-bold hover:bg-primary/90 shadow-lg shadow-primary/20 transition-colors" type="submit">
                        Simpan Produk
                    </button>
                </div>
            </form>
        </div>
    </main>

    <footer class="bg-white/5 backdrop-blur-md w-full border-t border-white/10 mt-auto">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-gutter px-margin-desktop py-lg max-w-[1440px] mx-auto">
            <div class="md:col-span-1 flex flex-col gap-sm">
                <span class="font-headline-md text-headline-md font-bold text-on-surface">BREE-COMMERCE</span>
                <p class="font-body-md text-body-md text-on-surface-variant">© 2026 Bree-Commerce. All rights reserved.</p>
            </div>
            <div class="md:col-span-3 flex flex-wrap justify-end gap-md md:gap-xl items-center">
                <a class="font-label-sm text-label-sm text-on-surface-variant hover:text-primary transition-colors" href="#">Privacy Policy</a>
                <a class="font-label-sm text-label-sm text-on-surface-variant hover:text-primary transition-colors" href="#">Terms of Service</a>
                <a class="font-label-sm text-label-sm text-on-surface-variant hover:text-primary transition-colors" href="#">Help Center</a>
                <a class="font-label-sm text-label-sm text-on-surface-variant hover:text-primary transition-colors" href="#">Contact Us</a>
            </div>
        </div>
    </footer>

    <div id="modalTambahKategori" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm px-4">
        <div class="bg-[#1F2937] border border-white/10 rounded-xl max-w-md w-full overflow-hidden shadow-2xl transform transition-transform">
            <div class="bg-white/5 px-6 py-4 border-b border-white/10 flex justify-between items-center">
                <h5 class="font-headline-md text-base font-bold text-on-surface">⚡ Tambah Kategori Baru</h5>
                <button id="btnCloseModalX" type="button" class="text-gray-400 hover:text-white transition-colors">
                    <span class="material-symbols-outlined text-xl">close</span>
                </button>
            </div>
            <form action="/kategori/simpan" method="post" class="m-0 p-0">
                <?= csrf_field(); ?>
                <div class="p-6 space-y-4">
                    <div class="space-y-2">
                        <label class="text-xs font-semibold text-gray-400 block tracking-wide uppercase">Nama Kategori Baru</label>
                        <input type="text" name="nama_kategori" class="w-full h-12 bg-black/20 border border-white/20 rounded-lg px-md text-on-surface font-body-md focus:ring-0 transition-shadow placeholder:text-on-surface-variant/50" placeholder="Contoh: Otomotif / Hobi / Pakaian" required>
                    </div>
                </div>
                <div class="bg-white/5 px-6 py-4 flex justify-end gap-3 border-t border-white/10">
                    <button id="btnCancelModal" type="button" class="px-4 py-2 rounded-lg border border-white/20 bg-transparent text-on-surface font-label-md text-label-md hover:bg-white/10 transition-colors">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 rounded-lg bg-primary text-on-primary font-label-md text-label-md font-bold hover:bg-primary/90 transition-colors">
                        Simpan Kategori
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const fileInput = document.getElementById('product_photo');
        const fileNameDisplay = document.getElementById('file_name_display');

        fileInput.addEventListener('change', function(e) {
            if(e.target.files.length > 0) {
                fileNameDisplay.textContent = e.target.files[0].name;
                fileNameDisplay.classList.remove('text-on-surface-variant/70');
                fileNameDisplay.classList.add('text-on-surface');
            } else {
                fileNameDisplay.textContent = 'No file chosen';
                fileNameDisplay.classList.remove('text-on-surface');
                fileNameDisplay.classList.add('text-on-surface-variant/70');
            }
        });

        const btnOpenKategori = document.getElementById('btnOpenKategori');
        const modalKategori = document.getElementById('modalTambahKategori');
        const btnCloseModalX = document.getElementById('btnCloseModalX');
        const btnCancelModal = document.getElementById('btnCancelModal');

        btnOpenKategori.addEventListener('click', () => modalKategori.classList.remove('hidden'));
        btnCloseModalX.addEventListener('click', () => modalKategori.classList.add('hidden'));
        btnCancelModal.addEventListener('click', () => modalKategori.classList.add('hidden'));
    </script>
</body>
</html>