<!DOCTYPE html>
<?php
/**
 * @var array $produk
 * @var array $daftar_kategori
 */
?>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk - BreeCommerce</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=block" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        try {
            tailwind.config = {
                darkMode: "class",
                theme: {
                    extend: {
                        "colors": {
                            "surface-tint": "#98da27",
                            "primary-fixed": "#b2f746",
                            "outline-variant": "#424936",
                            "on-error-container": "#ffdad6",
                            "inverse-on-surface": "#2e3132",
                            "on-tertiary-fixed": "#2f093d",
                            "background": "#111415",
                            "secondary-fixed": "#d9e3f6",
                            "on-background": "#e1e2e4",
                            "error": "#ffb4ab",
                            "surface-dim": "#111415",
                            "inverse-surface": "#e1e2e4",
                            "error-container": "#93000a",
                            "primary": "#ccff80",
                            "on-secondary-container": "#afb9cb",
                            "tertiary-fixed": "#fad7ff",
                            "primary-fixed-dim": "#98da27",
                            "secondary-container": "#404a59",
                            "tertiary": "#fee7ff",
                            "on-primary": "#213600",
                            "on-surface-variant": "#c2cab0",
                            "tertiary-container": "#f3c1ff",
                            "on-primary-fixed-variant": "#334f00",
                            "on-secondary-fixed": "#121c2a",
                            "outline": "#8c947c",
                            "on-tertiary-container": "#734b80",
                            "on-secondary-fixed-variant": "#3d4756",
                            "surface-container": "#1d2022",
                            "on-error": "#690005",
                            "surface": "#111415",
                            "surface-bright": "#37393b",
                            "on-surface": "#e1e2e4",
                            "surface-container-highest": "#323537",
                            "on-tertiary-fixed-variant": "#5e376b",
                            "on-primary-container": "#416400",
                            "surface-container-low": "#191c1e",
                            "inverse-primary": "#446900",
                            "tertiary-fixed-dim": "#e7b6f3",
                            "surface-variant": "#323537",
                            "surface-container-high": "#282a2c",
                            "secondary": "#bdc7d9",
                            "on-primary-fixed": "#121f00",
                            "secondary-fixed-dim": "#bdc7d9",
                            "on-secondary": "#27313f",
                            "surface-container-lowest": "#0c0f10",
                            "primary-container": "#a3e635",
                            "on-tertiary": "#462153"
                        },
                        "spacing": {
                            "stack-md": "24px",
                            "stack-lg": "48px",
                            "gutter": "20px",
                            "container-padding": "24px",
                            "stack-sm": "12px",
                            "base": "8px"
                        }
                    }
                }
            }
        } catch(_e) {}
    </script>
    <style>
        .glass-input {
            background-color: rgba(36, 46, 66, 0.4) !important;
            border: 1px solid rgba(255, 255, 255, 0.08) !important;
            transition: all 0.2s ease-in-out;
        }
        .glass-input:focus {
            border-color: #a3e635 !important;
            background-color: rgba(36, 46, 66, 0.6) !important;
            box-shadow: 0 0 0 2px rgba(163, 230, 53, 0.15) !important;
        }
    </style>
</head>
<body class="bg-[#111415] text-[#e1e2e4] font-body-md min-h-screen flex flex-col antialiased">

    <!-- TopNavBar (FIXED: Warna bg-[#1A2232] dan border-white/5 Sudah Sesuai Katalog Utama) -->
    <header class="bg-[#1A2232] flex justify-between items-center h-16 px-container-padding w-full max-w-[1440px] mx-auto border-b border-white/5 shadow-md relative z-50">
        <div class="flex items-center gap-gutter">
            <a href="<?= base_url('/'); ?>" class="flex items-center gap-2">
                <span class="material-symbols-outlined text-primary-container text-2xl" style="font-variation-settings: 'FILL' 1;">storefront</span>
                <span class="text-lg font-bold text-on-surface tracking-tight font-serif">BREE-COMMERCE</span>
            </a>
        </div>
        
        <div class="flex items-center gap-4">
            <!-- Info Akun User Aktif -->
            <div class="flex items-center gap-2 text-gray-400 p-2">
                <span class="material-symbols-outlined text-[20px]">account_circle</span>
                <span class="text-sm font-medium hidden sm:block text-gray-300"><?= esc(session()->get('nama_lengkap') ?? 'alberto'); ?></span>
            </div>
            <a href="<?= base_url('logout'); ?>" class="hidden sm:block text-error border border-error px-4 py-1.5 rounded-full text-xs font-semibold hover:bg-error/10 transition-colors">
                Logout
            </a>
        </div>
    </header>

    <!-- Main Content Canvas -->
    <main class="flex-grow w-full max-w-[1280px] mx-auto px-container-padding py-stack-lg relative z-10 grid grid-cols-1 md:grid-cols-12 gap-gutter">
        
        <!-- Form Container Form Update Proyek Lu -->
        <form action="<?= base_url('produk/update/' . $produk['id']); ?>" method="post" enctype="multipart/form-data" class="md:col-span-8 md:col-start-3 bg-[#242E42]/20 backdrop-blur-md rounded-xl overflow-hidden shadow-2xl relative border border-white/5 h-fit">
            <?= csrf_field(); ?>
            
            <!-- Decorative Accent Line Neon Green -->
            <div class="absolute top-0 left-0 w-full h-1 bg-primary-container"></div>
            
            <!-- Card Header -->
            <div class="bg-[#323537]/80 px-6 py-4 flex items-center gap-3 border-b border-white/5">
                <span class="material-symbols-outlined text-primary-container">edit</span>
                <h1 class="text-sm font-bold text-on-surface m-0 tracking-wide uppercase">Edit Produk</h1>
            </div>
            
            <!-- Form Body Content -->
            <div class="p-6 space-y-6">
                
                <!-- 1. Dropdown Kategori (Bersih & Rapi Tanpa Tombol Tambah) -->
                <div class="space-y-2">
                    <label for="category" class="text-xs font-semibold text-gray-400 block tracking-wide uppercase">Pilih Kategori</label>
                    <div class="relative w-full">
                        <select id="category" name="kategori_id" class="glass-input w-full rounded-md px-4 py-3 text-on-surface appearance-none focus:ring-0" required>
                            <?php foreach ($daftar_kategori as $kat): ?>
                                <option value="<?= $kat['id']; ?>" <?= $kat['id'] == $produk['kategori_id'] ? 'selected' : ''; ?> class="bg-[#1A2232]">
                                    <?= esc($kat['nama_kategori']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-400">
                            <span class="material-symbols-outlined text-sm">expand_more</span>
                        </div>
                    </div>
                </div>
                
                <!-- 2. Input Nama Produk -->
                <div class="space-y-2">
                    <label for="product_name" class="text-xs font-semibold text-gray-400 block tracking-wide uppercase">Nama Produk</label>
                    <input type="text" id="product_name" name="nama_produk" value="<?= esc($produk['nama_produk']); ?>" placeholder="Contoh: Velixir Icarus EDP" class="glass-input w-full rounded-md px-4 py-3 text-on-surface focus:ring-0" required>
                </div>
                
                <!-- 3. Input Deskripsi Barang -->
                <div class="space-y-2">
                    <label for="description" class="text-xs font-semibold text-gray-400 block tracking-wide uppercase">Deskripsi</label>
                    <textarea id="description" name="deskripsi" rows="4" placeholder="Detail spesifikasi produk..." class="glass-input w-full rounded-md px-4 py-3 text-on-surface focus:ring-0 resize-y" required><?= esc($produk['deskripsi']); ?></textarea>
                </div>
                
                <!-- 4. Baris Input Harga & Stok -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label for="price" class="text-xs font-semibold text-gray-400 block tracking-wide uppercase">Harga (Rp)</label>
                        <input type="number" id="price" name="harga" value="<?= esc($produk['harga']); ?>" class="glass-input w-full rounded-md px-4 py-3 text-on-surface focus:ring-0" required>
                    </div>
                    <div class="space-y-2">
                        <label for="stock" class="text-xs font-semibold text-gray-400 block tracking-wide uppercase">Jumlah Stok</label>
                        <input type="number" id="stock" name="stok" value="<?= esc($produk['stok']); ?>" class="glass-input w-full rounded-md px-4 py-3 text-on-surface focus:ring-0" required>
                    </div>
                </div>
                
                <!-- 5. Upload Berkas Foto & Tombol Choose File Putih Terang -->
                <div class="space-y-2">
                    <label class="text-xs font-semibold text-gray-400 block tracking-wide uppercase">Ganti Foto Produk</label>
                    <div class="flex items-center gap-4">
                        
                        <!-- Mini Current Thumbnail -->
                        <div class="w-20 h-20 rounded-lg overflow-hidden border border-white/5 shrink-0 bg-[#1A2232] flex items-center justify-center">
                            <img src="<?= base_url('uploads/' . ($produk['foto'] ?: 'default.png')); ?>" alt="Current product photo" class="w-full h-full object-cover">
                        </div>
                        
                        <!-- Boks Input File Custom -->
                        <div class="flex-grow">
                            <div class="flex items-center w-full relative">
                                <input class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" id="photo" type="file" name="foto" accept="image/*">
                                <div class="glass-input flex w-full rounded-md overflow-hidden">
                                    <div class="bg-white/20 text-white px-4 py-3 border-r border-white/10 text-sm flex items-center font-bold tracking-wide transition-colors">
                                        Choose File
                                    </div>
                                    <div id="file-name-preview" class="px-4 py-3 text-gray-400 text-sm flex-grow bg-transparent flex items-center truncate">
                                        <?= esc($produk['foto']); ?>
                                    </div>
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 mt-2">Format gambar: JPG, JPEG, atau PNG. Max 2MB. Biarkan kosong jika tidak diganti.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Actions Footer Buttons -->
            <div class="bg-[#323537]/40 px-6 py-4 flex justify-between items-center border-t border-white/5 mt-4">
                <a href="<?= base_url('/'); ?>" class="bg-transparent border border-white/10 hover:bg-white/5 text-on-surface px-6 py-2.5 rounded-full text-xs font-bold transition-colors inline-block">
                    Batal
                </a>
                <button type="submit" class="bg-[#A3E635] text-gray-950 hover:bg-[#84cc16] px-6 py-2.5 rounded-full text-xs font-bold transition-colors shadow-lg shadow-primary-container/20">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </main>

    <!-- JS Live Update Text File Nama -->
    <script>
        document.getElementById('photo').addEventListener('change', function(e) {
            const fileName = e.target.files[0] ? e.target.files[0].name : "<?= esc($produk['foto']); ?>";
            document.getElementById('file-name-preview').innerText = fileName;
        });
    </script>
</body>
</html>