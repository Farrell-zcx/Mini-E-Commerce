<?php 
/**
 * @var CodeIgniter\View\View $this
 */
// KODE SAKTI: Menghitung total seluruh kuantitas barang di session keranjang secara real-time
$totalCartItems = 0;
if (session()->has('keranjang') && is_array(session()->get('keranjang'))) {
    foreach (session()->get('keranjang') as $item) {
        $totalCartItems += $item['jumlah'] ?? 1;
    }
}
?>
<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bree-Commerce</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=block" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        try {
            tailwind.config = {
                darkMode: "class",
                theme: {
                    extend: {
                        colors: {
                            "primary": "#ccff80",
                            "primary-container": "#a3e635",
                            "background": "#1a2232",
                            "surface": "#242e42"
                        }
                    }
                }
            }
        } catch (_e) {}
    </script>
</head>
<body class="bg-[#1F2937] text-[#F3F4F6] antialiased selection:bg-[#A3E635] selection:text-gray-900 flex flex-col min-h-screen">

    <header class="bg-[#1A2232] border-b border-white/5 shadow-md sticky top-0 z-50">
        <div class="flex justify-between items-center h-16 px-4 md:px-8 w-full max-w-[1440px] mx-auto">
            
            <div class="flex items-center gap-6">
                <a href="<?= base_url('/'); ?>" class="text-lg font-bold text-[#F3F4F6] flex items-center gap-2 tracking-wide font-serif">
                    <span class="material-symbols-outlined text-[22px]" style="font-variation-settings: 'FILL' 1;">storefront</span>
                    BREE-COMMERCE
                </a>
            </div>

            <div class="flex items-center gap-3">
                <?php if (session()->get('isLoggedIn')) : ?>
                    <a href="<?= base_url('produk/tambah'); ?>" class="bg-[#A3E635] text-gray-950 px-4 py-2 rounded-lg hover:bg-[#84cc16] transition-colors text-sm font-semibold shadow-sm">
                        + Tambah Produk
                    </a>
                <?php endif; ?>

                <a href="<?= base_url('keranjang'); ?>" class="flex items-center gap-2 text-sm text-gray-300 border border-white/10 px-4 py-2 rounded-lg hover:bg-white/5 transition-colors relative group">
                    <span class="material-symbols-outlined text-[18px]">shopping_cart</span>
                    <span class="hidden md:inline">Keranjang</span>
                    
                    <?php if ($totalCartItems > 0) : ?>
                        <span class="absolute -top-2 -right-2 bg-red-500 text-white font-bold text-[10px] w-5 h-5 flex items-center justify-center rounded-full shadow-md shadow-red-500/20 animate-pulse">
                            <?= $totalCartItems; ?>
                        </span>
                    <?php endif; ?>
                </a>

                <?php if (session()->get('isLoggedIn')) : ?>
                    <div class="flex items-center gap-1.5 text-sm text-gray-300 px-1">
                        <span class="material-symbols-outlined text-[20px]">account_circle</span>
                        <span class="hidden md:inline text-gray-200"><?= esc(session()->get('nama_lengkap') ?? 'alberto'); ?></span>
                    </div>
                    <a href="<?= base_url('logout'); ?>" class="text-sm text-red-400 border border-red-500/20 px-4 py-2 rounded-lg hover:bg-red-500/10 transition-colors ml-1">
                        Logout
                    </a>
                <?php else : ?>
                    <a href="<?= base_url('login'); ?>" class="text-sm text-gray-300 border border-white/10 px-4 py-2 rounded-lg hover:bg-white/5 transition-colors">
                        Login
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <main class="flex-grow w-full max-w-[1440px] mx-auto px-4 md:px-8 py-12">
        <?= $this->renderSection('content'); ?>
    </main>

    <footer class="bg-[#1A2232] border-t border-white/5 mt-auto">
        <div class="max-w-[1440px] mx-auto px-4 md:px-8 py-10 flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <span class="text-base font-bold text-[#F3F4F6] tracking-wide font-serif">BREE-COMMERCE</span>
                <p class="text-xs text-gray-500 mt-1">© 2026 Bree-Commerce. All rights reserved.</p>
            </div>
            <div class="flex gap-6 text-xs text-gray-400">
                <a href="#" class="hover:text-white transition-colors">Privacy Policy</a>
                <a href="#" class="hover:text-white transition-colors">Terms of Service</a>
                <a href="#" class="hover:text-white transition-colors">Help Center</a>
                <a href="#" class="hover:text-white transition-colors">Contact Us</a>
            </div>
        </div>
    </footer>

</body>
</html>