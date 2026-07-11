<!DOCTYPE html>
<html class="dark" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Masuk - Bree-Commerce</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
          darkMode: "class",
          theme: {
            extend: {
              "colors": {
                      "on-primary": "#213600",
                      "primary-container": "#a3e635",
                      "primary": "#ccff80",
                      "error": "#ffb4ab",
                      "background": "#111415",
                      "on-surface": "#e1e2e4",
                      "outline": "#8c947c",
                      "surface": "#111415"
              }
            }
          },
        }
    </script>
    <style>
        body {
            background-color: #111415; color: #e1e2e4; min-height: 100vh;
            display: flex; align-items: center; justify-content: center;
            position: relative; overflow: hidden;
        }
        .bg-blob {
            position: absolute; border-radius: 50%; filter: blur(100px);
            opacity: 0.15; animation: float 20s infinite ease-in-out alternate; z-index: -1;
        }
        .blob-1 { width: 600px; height: 600px; background: #a3e635; top: -100px; left: -100px; }
        .blob-2 { width: 500px; height: 500px; background: #ccff80; bottom: -50px; right: -50px; animation-delay: -10s; }
        @keyframes float {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(50px, 50px) scale(1.1); }
        }
        .glass-panel {
            background: rgba(31, 41, 55, 0.45); backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px); border: 1px solid rgba(243, 244, 246, 0.12);
            border-top-color: rgba(163, 230, 53, 0.5);
        }
        
        /* FIX: Ditambahkan !important agar tidak ditimpa oleh Tailwind Forms Plugin */
        .glass-input {
            background-color: transparent !important;
            border: none !important;
            border-bottom: 1px solid rgba(243, 244, 246, 0.2) !important;
            color: #e1e2e4 !important;
            transition: all 0.3s ease;
        }
        .glass-input:focus {
            outline: none !important;
            border-bottom-color: #a3e635 !important;
            background-color: rgba(255, 255, 255, 0.02) !important;
            box-shadow: none !important;
        }
        
        .input-group { position: relative; margin-bottom: 1.5rem; }
        .floating-label {
            position: absolute; left: 0; top: 50%; transform: translateY(-50%);
            color: rgba(225, 226, 228, 0.6); transition: 0.2s ease all; pointer-events: none; font-size: 16px;
        }
        .glass-input:focus ~ .floating-label,
        .glass-input:not(:placeholder-shown) ~ .floating-label {
            top: -10px; font-size: 13px; color: #a3e635;
        }
        .solid-btn {
            background-color: #a3e635; color: #1F2937; transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .solid-btn:hover {
            transform: translateY(-2px); box-shadow: 0 10px 25px -5px rgba(163, 230, 53, 0.4);
        }
    </style>
</head>
<body class="antialiased w-full h-full p-4 md:p-8">

    <div class="bg-blob blob-1"></div>
    <div class="bg-blob blob-2"></div>

    <main class="w-full max-w-md mx-auto">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-extrabold text-primary tracking-tighter mb-2 font-serif">BREE-COMMERCE</h1>
        </div>

        <?php if (session()->getFlashdata('pesan')) : ?>
            <div class="mb-4 p-4 rounded-lg bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 text-xs font-semibold shadow-lg backdrop-blur-md">
                🚀 <?= session()->getFlashdata('pesan'); ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')) : ?>
            <div class="mb-4 p-4 rounded-lg bg-red-500/10 text-red-400 border border-red-500/20 text-xs font-semibold shadow-lg backdrop-blur-md">
                ❌ <?= session()->getFlashdata('error'); ?>
            </div>
        <?php endif; ?>

        <div class="glass-panel rounded-xl p-8 shadow-2xl relative overflow-hidden">
            <header class="mb-8 text-center">
                <h2 class="text-2xl font-bold text-on-surface mb-2 font-serif">Selamat Datang</h2>
                <p class="text-sm text-gray-400">Silakan masuk menggunakan akun Anda.</p>
            </header>

            <form action="/auth/prosesLogin" class="space-y-6" method="POST">
                <?= csrf_field(); ?>

                <div class="input-group">
                    <input class="glass-input w-full py-3 px-0 text-sm focus:ring-0" id="email" name="email" placeholder=" " value="<?= old('email'); ?>" required type="email"/>
                    <label class="floating-label" for="email">Email</label>
                </div>

                <div class="input-group relative">
                    <input class="glass-input w-full py-3 px-0 pr-10 text-sm focus:ring-0" id="password" name="password" placeholder=" " required type="password"/>
                    <label class="floating-label" for="password">Password</label>
                    <button class="absolute right-0 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-primary transition-colors focus:outline-none" id="togglePassword" type="button">
                        <span class="material-symbols-outlined text-[20px]">visibility</span>
                    </button>
                </div>

                <button class="solid-btn w-full rounded-lg py-3 text-sm font-bold flex justify-center items-center gap-2" type="submit">
                    Masuk Sekarang
                    <span class="material-symbols-outlined text-[20px]">login</span>
                </button>
            </form>

            <div class="mt-8 text-center">
                <p class="text-sm text-gray-400">
                    Belum punya akun? 
                    <a class="text-primary hover:underline font-bold transition-colors ml-1" href="/auth/register">Daftar Sekarang</a>
                </p>
            </div>
        </div>
    </main>

    <script>
        const togglePasswordBtn = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const iconSpan = togglePasswordBtn.querySelector('span');
        togglePasswordBtn.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            iconSpan.textContent = type === 'text' ? 'visibility_off' : 'visibility';
        });
    </script>
</body>
</html>