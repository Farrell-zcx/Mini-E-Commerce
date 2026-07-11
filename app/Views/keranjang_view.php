<!DOCTYPE html>
<?php
/**
 * @var array $keranjang
 * @var int|float $grandTotal
 */
?>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Keranjang Belanja - BreeCommerce</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=block" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
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
                            "background": "#111415",
                            "secondary-fixed": "#d9e3f6",
                            "on-background": "#F3F4F6",
                            "error": "#ffb4ab",
                            "surface-dim": "rgba(0, 0, 0, 0.2)",
                            "primary": "#A3E635",
                            "outline": "rgba(255, 255, 255, 0.1)",
                            "outline-variant": "rgba(255, 255, 255, 0.05)",
                            "on-surface-variant": "#9CA3AF",
                            "surface-container-lowest": "rgba(0, 0, 0, 0.3)",
                            "surface-tint": "#a3e635",
                            "surface": "rgba(255, 255, 255, 0.01)",
                            "surface-bright": "rgba(255, 255, 255, 0.12)",
                            "tertiary": "#a3e635"
                        },
                        "spacing": {
                            "sm": "1rem",
                            "xs": "0.5rem",
                            "base": "8px",
                            "lg": "2.5rem",
                            "md": "1.5rem",
                            "xl": "4rem",
                            "gutter": "20px",
                            "margin-mobile": "16px",
                            "margin-desktop": "48px",
                            "stack-sm": "12px",
                            "stack-lg": "48px",
                            "stack-md": "24px",
                            "container-padding": "24px"
                        }
                    }
                }
            }
        } catch(_e) {}
    </script>
    <style>
        .glass-panel {
            background-color: rgba(36, 46, 66, 0.2) !important;
            border: 1px solid rgba(255, 255, 255, 0.05) !important;
            backdrop-filter: blur(16px);
        }
    </style>
</head>
<body class="bg-[#111415] text-[#F3F4F6] font-body-md antialiased min-h-screen flex flex-col relative overflow-x-hidden">
    
    <div class="fixed top-[-10%] left-[-10%] w-[40%] h-[40%] bg-[#A3E635]/10 rounded-full blur-[120px] pointer-events-none z-[-1]"></div>
    <div class="fixed bottom-[-10%] right-[-10%] w-[30%] h-[30%] bg-[#A3E635]/5 rounded-full blur-[100px] pointer-events-none z-[-1]"></div>

    <header class="bg-[#1A2232] font-headline-md text-headline-md w-full sticky top-0 z-50 border-b border-white/5 shadow-md">
        <div class="flex justify-between items-center h-16 px-margin-desktop w-full max-w-[1440px] mx-auto">
            <a href="<?= base_url('keranjang'); ?>" class="p-xs text-on-surface-variant hover:text-on-surface hover:bg-white/5 rounded-full transition-colors duration-200 relative group">
              <span class="material-symbols-outlined">shopping_cart</span>
            </a>
            
            <div class="flex items-center gap-md">
                <div class="flex items-center gap-2 text-gray-400 p-2">
                    <span class="material-symbols-outlined text-[20px]">account_circle</span>
                    <span class="text-sm font-medium hidden sm:block text-gray-300"><?= esc(session()->get('nama_lengkap') ?? 'alberto'); ?></span>
                </div>
                <a href="<?= base_url('logout'); ?>" class="border border-white/10 text-on-surface-variant px-4 py-1.5 rounded-full text-xs font-semibold hover:bg-white/5 hover:text-on-surface transition-colors">
                    Logout
                </a>
            </div>
        </div>
    </header>

    <main class="flex-grow w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-desktop py-xl relative z-10">
        
        <div class="flex items-center gap-sm mb-lg">
            <span class="material-symbols-outlined text-display-lg text-primary">shopping_cart</span>
            <h1 class="text-3xl font-bold text-on-surface font-serif">Keranjang Belanja</h1>
        </div>

        <?php if (empty($keranjang)): ?>
            <div class="max-w-xl mx-auto glass-panel rounded-xl p-12 text-center shadow-2xl flex flex-col items-center justify-center gap-4">
                <span class="material-symbols-outlined text-6xl text-gray-500">remove_shopping_cart</span>
                <h2 class="text-xl font-bold text-gray-300">Keranjang belanja lu masih kosong, Bree!</h2>
                <p class="text-sm text-gray-400 max-w-sm">Yuk kembali ke halaman utama dan amankan barang hobi premium incaran lu sekarang.</p>
                <a href="<?= base_url('/'); ?>" class="mt-2 px-6 py-3 bg-[#A3E635] text-gray-950 font-bold rounded-full text-sm hover:bg-[#84cc16] transition-all shadow-md shadow-[#A3E635]/10">
                    Kembali Berburu Barang 🚀
                </a>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter">
                
                <div class="lg:col-span-8 space-y-md">
                    <div class="glass-panel rounded-xl p-md overflow-x-auto shadow-2xl">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-white/5">
                                    <th class="py-sm px-xs font-label-md text-label-md text-gray-400 w-[55%]">Produk</th>
                                    <th class="py-sm px-xs font-label-md text-label-md text-gray-400">Harga</th>
                                    <th class="py-sm px-xs font-label-md text-label-md text-gray-400 text-center">Jumlah</th>
                                    <th class="py-sm px-xs font-label-md text-label-md text-gray-400">Total</th>
                                    <th class="py-sm px-xs font-label-md text-label-md text-gray-400 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                <?php foreach ($keranjang as $id => $item): ?>
                                    <tr class="hover:bg-white/[0.02] transition-colors group">
                                        <td class="py-md px-xs">
                                            <div class="flex items-center gap-md">
                                                <div class="w-16 h-16 bg-[#1A2232] rounded-lg overflow-hidden flex-shrink-0 border border-white/5 group-hover:border-primary/30 transition-colors flex items-center justify-center">
                                                    <img src="<?= base_url('uploads/' . ($item['foto'] ?? 'default.png')); ?>" alt="<?= esc($item['nama_produk']); ?>" class="w-full h-full object-cover">
                                                </div>
                                                <span class="text-sm font-semibold text-on-surface line-clamp-2 pr-2">
                                                    <?= esc($item['nama_produk']); ?>
                                                </span>
                                            </div>
                                        </td>
                                        <td class="py-md px-xs text-sm text-gray-400">
                                            Rp <?= number_format($item['harga'], 0, ',', '.'); ?>
                                        </td>
                                        <td class="py-md px-xs text-center font-bold text-sm text-gray-300">
                                            <?= $item['jumlah']; ?>x
                                        </td>
                                        <td class="py-md px-xs text-sm font-semibold text-[#A3E635]">
                                            Rp <?= number_format($item['harga'] * $item['jumlah'], 0, ',', '.'); ?>
                                        </td>
                                        <td class="py-md px-xs text-center">
                                            <form action="/keranjang/hapus/<?= $id; ?>" method="post" class="inline-block m-0 p-0">
                                                <?= csrf_field(); ?>
                                                <button type="submit" class="p-2 rounded-full text-gray-400 hover:text-red-400 hover:bg-red-500/10 transition-colors" title="Hapus item" onclick="return confirm('Hapus barang <?= esc($item['nama_produk']); ?> dari keranjang, Bree?')">
                                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="lg:col-span-4">
                    <div class="glass-panel sticky top-24 rounded-xl p-6 flex flex-col gap-md shadow-2xl">
                        <h2 class="text-lg font-bold text-on-surface border-b border-white/5 pb-3 uppercase tracking-wider">Ringkasan Belanja</h2>
                        
                        <div class="flex justify-between items-center py-2">
                            <span class="text-sm text-gray-400">Total Harga (<?= count($keranjang); ?> Barang)</span>
                            <span class="text-xl font-bold text-[#A3E635]">Rp <?= number_format($grandTotal, 0, ',', '.'); ?></span>
                        </div>
                        
                        <div class="mt-4 flex flex-col gap-2">
                            <form action="<?= base_url('keranjang/checkout'); ?>" method="post" class="w-full m-0 p-0">
                                <?= csrf_field(); ?>
                                <button type="submit" class="w-full bg-[#A3E635] text-gray-950 h-12 rounded-lg text-sm font-bold hover:bg-[#84cc16] hover:shadow-[0_0_20px_rgba(163,230,53,0.3)] transition-all flex items-center justify-center gap-2">
                                    <span class="material-symbols-outlined text-[18px]">rocket_launch</span>
                                    CHECKOUT SEKARANG (CO)
                                </button>
                            </form>
                            
                            <a href="<?= base_url('/'); ?>" class="w-full border border-white/10 text-gray-300 h-12 rounded-lg text-sm font-semibold hover:bg-white/5 transition-colors flex items-center justify-center bg-black/10">
                                Lanjut Belanja
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        <?php endif; ?>

    </main>

    <footer class="bg-white/5 backdrop-blur-md w-full border-t border-white/10 mt-auto">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-gutter px-margin-desktop py-lg max-w-[1440px] mx-auto">
            <div class="md:col-span-1 flex flex-col gap-sm">
                <span class="text-md font-bold text-on-surface tracking-wide font-serif">BREE-COMMERCE</span>
                <p class="text-xs text-gray-500">© 2026 Bree-Commerce. All rights reserved.</p>
            </div>
            <div class="md:col-span-3 flex flex-wrap justify-end gap-md md:gap-xl items-center text-xs text-gray-400">
                <a class="hover:text-primary transition-colors" href="#">Privacy Policy</a>
                <a class="hover:text-primary transition-colors" href="#">Terms of Service</a>
                <a class="hover:text-primary transition-colors" href="#">Help Center</a>
                <a class="hover:text-primary transition-colors" href="#">Contact Us</a>
            </div>
        </div>
    </footer>

</body>
</html>