<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk & Daftar — Code Pawth</title>

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    boxShadow: {
                        'soft-blue': '0 10px 26px -6px rgba(37, 99, 235, 0.32)',
                        'card-float': '0 18px 44px -10px rgba(30, 64, 175, 0.14)',
                    }
                }
            }
        }
    </script>

    <style>
        body {
            background: linear-gradient(180deg, #F4F9FF 0%, #E6F0FF 100%);
            color: #0F172A;
        }
    </style>
</head>

<body
    class="min-h-screen md:h-screen md:overflow-hidden flex flex-col justify-between relative selection:bg-blue-600 selection:text-white">

    <!-- =====================================================================
         DEKORASI BACKGROUND AWAN & SPARKLES
    ====================================================================== -->
    <div class="pointer-events-none fixed inset-0 overflow-hidden z-0" aria-hidden="true">
        <!-- Blob Awan Pojok Kanan Atas -->
        <svg class="absolute -top-8 -right-8 w-[320px] sm:w-[440px] h-auto" viewBox="0 0 600 420" fill="none">
            <path d="M170 -20C205 68 285 98 380 112C475 126 565 172 620 275V-20H170Z" fill="#DCEAFF"
                fill-opacity="0.85" />
            <circle cx="535" cy="65" r="95" fill="#CFE1FF" fill-opacity="0.5" />
        </svg>

        <!-- Blob Awan Pojok Kiri Bawah -->
        <svg class="absolute -bottom-10 -left-10 w-[300px] sm:w-[420px] h-auto" viewBox="0 0 540 320" fill="none">
            <path d="M-20 75C65 92 110 152 175 198C240 244 320 250 390 340H-20V75Z" fill="#DCEAFF" fill-opacity="0.9" />
            <path d="M-20 142C45 154 85 204 140 238C195 272 255 278 310 340H-20V142Z" fill="#CFE1FF"
                fill-opacity="0.75" />
        </svg>

        <!-- Sparkles -->
        <svg class="hidden md:block absolute top-[18%] left-[12%] w-5 h-5 text-blue-400/70" viewBox="0 0 24 24"
            fill="currentColor">
            <path d="M12 1L14.5 9.5L23 12L14.5 14.5L12 23L9.5 14.5L1 12L9.5 9.5L12 1Z" />
        </svg>
        <svg class="hidden md:block absolute bottom-[18%] right-[10%] w-6 h-6 text-blue-400/70" viewBox="0 0 24 24"
            fill="currentColor">
            <path d="M12 1L14.5 9.5L23 12L14.5 14.5L12 23L9.5 14.5L1 12L9.5 9.5L12 1Z" />
        </svg>
    </div>

    <!-- =====================================================================
         TOP BAR: KEMBALI KE BERANDA & LOGO (RINGKAS UNTUK ZOOM 100%)
    ====================================================================== -->
    <header
        class="relative z-20 w-full max-w-5xl mx-auto px-5 sm:px-8 pt-3.5 pb-1 flex items-center justify-between shrink-0">
        <a href="{{ url('/') }}"
            class="inline-flex items-center gap-2 text-slate-600 hover:text-blue-600 text-sm font-bold transition-colors group">
            <span
                class="w-8 h-8 rounded-full bg-white border border-slate-200/80 shadow-2xs flex items-center justify-center group-hover:border-blue-300 group-hover:-translate-x-0.5 transition-all">
                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" stroke-width="2.5"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </span>
            <span>Kembali</span>
        </a>

        <a href="{{ url('/') }}" class="flex items-center gap-2">
            <div class="w-8 h-8 rounded-xl bg-blue-600 text-white flex items-center justify-center shadow-2xs">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                    stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="16 18 22 12 16 6"></polyline>
                    <polyline points="8 6 2 12 8 18"></polyline>
                    <line x1="14" y1="4" x2="10" y2="20"></line>
                </svg>
            </div>
            <span class="text-lg font-extrabold tracking-tight text-slate-900">
                Code<span class="text-blue-600">Pawth</span>
            </span>
        </a>
    </header>

    <!-- =====================================================================
         MAIN SLIDER CARD (PROPORSIONAL UNTUK CHROME ZOOM 100%)
    ====================================================================== -->
    <main class="relative z-10 flex-1 min-h-0 flex items-center justify-center px-4 sm:px-6 py-2">

        <div id="auth-card"
            class="relative w-full max-w-[850px] md:h-[465px] bg-white rounded-[28px] shadow-card-float border border-white overflow-hidden">

            <!-- ===============================================================
                 1. FORM REGISTER (POSISI KIRI — MUNCUL SAAT SLIDER GESER KE KANAN)
            ================================================================ -->
            <div id="register-form-box"
                class="w-full md:w-1/2 md:absolute md:top-0 md:left-0 md:h-full p-6 sm:px-9 sm:py-6 flex flex-col justify-center transition-all duration-700 ease-in-out hidden md:flex md:opacity-0 md:pointer-events-none md:-translate-x-4">

                <div class="mb-4">
                    <span
                        class="inline-block px-2.5 py-0.5 rounded-full bg-blue-50 text-blue-600 text-[10px] font-extrabold uppercase tracking-wider mb-1.5">
                        Akun Baru
                    </span>
                    <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Buat Akun</h2>
                    <p class="text-xs text-slate-500 mt-0.5">Simpan progres belajar dan bintangmu secara permanen.</p>
                </div>

                <form onsubmit="handleAuthSubmit(event, 'register')" class="space-y-3">
                    <!-- Input Nama -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Nama Lengkap</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                            <input type="text" id="reg-name" required placeholder="Masukkan namamu"
                                class="w-full pl-10 pr-4 py-2 rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-800 placeholder:text-slate-400 focus:bg-white focus:border-blue-500 focus:ring-3 focus:ring-blue-500/15 outline-none transition-all">
                        </div>
                    </div>

                    <!-- Input Email -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Email</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M1.5 8.67v8.58a3 3 0 003 3h15a3 3 0 003-3V8.67l-8.928 5.493a3 3 0 01-3.144 0L1.5 8.67z" />
                                    <path
                                        d="M22.5 6.908V6.75a3 3 0 00-3-3h-15a3 3 0 00-3 3v.158l9.714 5.978a1.5 1.5 0 001.572 0L22.5 6.908z" />
                                </svg>
                            </span>
                            <input type="email" id="reg-email" required placeholder="nama@email.com"
                                class="w-full pl-10 pr-4 py-2 rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-800 placeholder:text-slate-400 focus:bg-white focus:border-blue-500 focus:ring-3 focus:ring-blue-500/15 outline-none transition-all">
                        </div>
                    </div>

                    <!-- Input Password -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Password</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                            <input type="password" id="reg-password" required placeholder="Minimal 6 karakter"
                                class="w-full pl-10 pr-10 py-2 rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-800 placeholder:text-slate-400 focus:bg-white focus:border-blue-500 focus:ring-3 focus:ring-blue-500/15 outline-none transition-all">
                            <button type="button" onclick="togglePasswordVisibility('reg-password')"
                                class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-blue-600 cursor-pointer">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full mt-1 bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm py-2.5 rounded-xl shadow-soft-blue hover:-translate-y-0.5 transition-all duration-200 cursor-pointer">
                        Daftar Sekarang
                    </button>
                </form>

                <!-- Switcher Khusus Mobile -->
                <p class="md:hidden text-center text-xs text-slate-500 mt-4">
                    Sudah pernah menggunakan CodePawth?
                    <button type="button" onclick="setAuthMode('login')"
                        class="text-blue-600 font-bold hover:underline ml-1">Masuk di sini</button>
                </p>
            </div>

            <!-- ===============================================================
                 2. FORM MASUK / LOGIN (POSISI KANAN — TAMPILAN AWAL)
            ================================================================ -->
            <div id="login-form-box"
                class="w-full md:w-1/2 md:absolute md:top-0 md:right-0 md:h-full p-6 sm:px-9 sm:py-6 flex flex-col justify-center transition-all duration-700 ease-in-out md:opacity-100 md:translate-x-0">

                <div class="mb-5">
                    <span
                        class="inline-block px-2.5 py-0.5 rounded-full bg-blue-50 text-blue-600 text-[10px] font-extrabold uppercase tracking-wider mb-1.5">
                        Selamat Datang Kembali
                    </span>
                    <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Masuk ke Akun</h2>
                    <p class="text-xs text-slate-500 mt-1">Masukkan email dan password untuk melanjutkan jejak
                        belajarmu.</p>
                </div>

                <form onsubmit="handleAuthSubmit(event, 'login')" class="space-y-3.5">
                    <!-- Input Email -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Email</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M1.5 8.67v8.58a3 3 0 003 3h15a3 3 0 003-3V8.67l-8.928 5.493a3 3 0 01-3.144 0L1.5 8.67z" />
                                    <path
                                        d="M22.5 6.908V6.75a3 3 0 00-3-3h-15a3 3 0 00-3 3v.158l9.714 5.978a1.5 1.5 0 001.572 0L22.5 6.908z" />
                                </svg>
                            </span>
                            <input type="email" id="login-email" required placeholder="nama@email.com"
                                class="w-full pl-10 pr-4 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-800 placeholder:text-slate-400 focus:bg-white focus:border-blue-500 focus:ring-3 focus:ring-blue-500/15 outline-none transition-all">
                        </div>
                    </div>

                    <!-- Input Password -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Password</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                            <input type="password" id="login-password" required placeholder="Masukkan password"
                                class="w-full pl-10 pr-10 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-800 placeholder:text-slate-400 focus:bg-white focus:border-blue-500 focus:ring-3 focus:ring-blue-500/15 outline-none transition-all">
                            <button type="button" onclick="togglePasswordVisibility('login-password')"
                                class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-blue-600 cursor-pointer">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full mt-1 bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm py-2.5 rounded-xl shadow-soft-blue hover:-translate-y-0.5 transition-all duration-200 cursor-pointer">
                        Masuk
                    </button>
                </form>

                <!-- Switcher Khusus Mobile -->
                <p class="md:hidden text-center text-xs text-slate-500 mt-4">
                    Belum punya akun CodePawth?
                    <button type="button" onclick="setAuthMode('register')"
                        class="text-blue-600 font-bold hover:underline ml-1">Daftar sekarang</button>
                </p>
            </div>

            <!-- ===============================================================
                 3. PANEL SLIDER BIRU + MASKOT PEEKING BESAR & FLIP (DESKTOP)
            ================================================================ -->
            <div id="sliding-overlay"
                class="hidden md:flex flex-col justify-between absolute top-0 left-0 w-1/2 h-full bg-gradient-to-br from-blue-600 via-blue-600 to-indigo-700 text-white p-8 z-20 transition-transform duration-700 ease-in-out translate-x-0 overflow-hidden">

                <!-- Dekorasi Lingkaran Awan Lembut -->
                <div class="pointer-events-none absolute -top-14 -left-14 w-44 h-44 rounded-full bg-white/10"></div>
                <div class="pointer-events-none absolute -bottom-16 -right-12 w-52 h-52 rounded-full bg-blue-400/20">
                </div>
                <svg class="pointer-events-none absolute top-7 right-7 w-5 h-5 text-blue-200/60" viewBox="0 0 24 24"
                    fill="currentColor">
                    <path d="M12 1L14.5 9.5L23 12L14.5 14.5L12 23L9.5 14.5L1 12L9.5 9.5L12 1Z" />
                </svg>

                <!-- Konten Teks Dinamis -->
                <div class="relative z-10 mt-1">
                    <!-- Teks saat Panel di Kiri (Mode Login Aktif) -->
                    <div id="overlay-content-login" class="transition-all duration-500 opacity-100 translate-y-0">
                        <span
                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/15 border border-white/20 text-blue-100 text-[11px] font-bold mb-3">
                            CodePawth Member
                        </span>
                        <h3 class="text-xl lg:text-[23px] font-extrabold leading-snug">
                            Apakah kamu sudah pernah menggunakan CodePawth?
                        </h3>
                        <p class="text-xs lg:text-[13px] text-blue-100/90 mt-2.5 leading-relaxed">
                            Jika sudah, langsung masukkan email dan password di sebelah kanan. Belum punya akun? Yuk
                            daftar dulu biar progres belajarmu tersimpan!
                        </p>

                        <button type="button" onclick="setAuthMode('register')"
                            class="mt-5 inline-flex items-center gap-2 px-5 py-2 rounded-full bg-white text-blue-600 hover:bg-blue-50 font-extrabold text-xs sm:text-sm shadow-md hover:-translate-y-0.5 transition-all cursor-pointer">
                            <span>Belum, Daftar Akun</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </button>
                    </div>

                    <!-- Teks saat Panel di Kanan (Mode Register Aktif) -->
                    <div id="overlay-content-register"
                        class="hidden transition-all duration-500 opacity-0 translate-y-2">
                        <span
                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/15 border border-white/20 text-blue-100 text-[11px] font-bold mb-3">
                            Mulai Perjalananmu
                        </span>
                        <h3 class="text-xl lg:text-[23px] font-extrabold leading-snug">
                            Sudah pernah belajar di CodePawth sebelumnya?
                        </h3>
                        <p class="text-xs lg:text-[13px] text-blue-100/90 mt-2.5 leading-relaxed">
                            Kalau kamu sudah punya akun, geser kembali ke halaman masuk untuk melanjutkan level dan
                            koleksi Knowledge Card milikmu!
                        </p>

                        <button type="button" onclick="setAuthMode('login')"
                            class="mt-5 inline-flex items-center gap-2 px-5 py-2 rounded-full bg-white text-blue-600 hover:bg-blue-50 font-extrabold text-xs sm:text-sm shadow-md hover:-translate-y-0.5 transition-all cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                            </svg>
                            <span>Sudah, Masuk di Sini</span>
                        </button>
                    </div>
                </div>

                <!-- MASKOT PEEKING DIPERBESAR (w-44 h-44) & MENEMPEL PAS DI TEPI PEMBATAS -->
                <div id="overlay-mascot-box" style="left: calc(100% - 174px);"
                    class="absolute -bottom-1 w-44 h-44 pointer-events-none z-20 transition-all duration-700 ease-in-out flex items-end justify-end">
                    <img id="overlay-mascot-img" src="{{ asset('images/mascot_peeking.png') }}"
                        alt="Maskot Code Pawth"
                        class="w-full h-full object-contain object-right-bottom drop-shadow-[0_10px_18px_rgba(15,23,42,0.28)] transition-transform duration-700 ease-in-out scale-x-100">
                </div>

            </div>

        </div>
    </main>

    <!-- Footer Kecil -->
    <footer class="relative z-10 text-center py-2 text-[11px] text-slate-400 shrink-0">
        Code Pawth — Platform Belajar Pemrograman Adaptif
    </footer>

    <!-- =====================================================================
         VANILLA JS: SLIDER ANIMATION & FLIP MASKOT
    ====================================================================== -->
    <script>
        function setAuthMode(mode) {
            const isRegister = mode === 'register';

            const overlay = document.getElementById('sliding-overlay');
            const loginFormBox = document.getElementById('login-form-box');
            const registerFormBox = document.getElementById('register-form-box');

            const contentLogin = document.getElementById('overlay-content-login');
            const contentRegister = document.getElementById('overlay-content-register');

            const mascotBox = document.getElementById('overlay-mascot-box');
            const mascotImg = document.getElementById('overlay-mascot-img');

            if (isRegister) {
                // 1. Geser Panel Biru ke Kanan
                overlay.classList.remove('translate-x-0');
                overlay.classList.add('translate-x-full');

                // 2. Pindahkan Maskot ke Pojok Kiri Bawah Panel Biru & Flip Horizontal
                mascotBox.style.left = '-2px';
                mascotImg.classList.remove('scale-x-100');
                mascotImg.classList.add('-scale-x-100');

                // 3. Ganti Teks Overlay
                contentLogin.classList.add('hidden', 'opacity-0');
                contentRegister.classList.remove('hidden');
                requestAnimationFrame(() => {
                    contentRegister.classList.remove('opacity-0', 'translate-y-2');
                });

                // 4. Tampilkan Form Register (Kiri) & Sembunyikan Form Login (Kanan)
                registerFormBox.classList.remove('hidden');
                requestAnimationFrame(() => {
                    registerFormBox.classList.remove('md:opacity-0', 'md:pointer-events-none', 'md:-translate-x-4');
                    registerFormBox.classList.add('md:opacity-100', 'md:translate-x-0');
                });

                loginFormBox.classList.add('hidden', 'md:opacity-0', 'md:pointer-events-none', 'md:translate-x-4');
                loginFormBox.classList.remove('md:opacity-100', 'md:translate-x-0');
            } else {
                // 1. Geser Panel Biru Kembali ke Kiri
                overlay.classList.add('translate-x-0');
                overlay.classList.remove('translate-x-full');

                // 2. Kembalikan Maskot ke Pojok Kanan Bawah Panel Biru & Normal (Tidak Flip)
                mascotBox.style.left = 'calc(100% - 174px)';
                mascotImg.classList.add('scale-x-100');
                mascotImg.classList.remove('-scale-x-100');

                // 3. Ganti Teks Overlay
                contentRegister.classList.add('hidden', 'opacity-0', 'translate-y-2');
                contentLogin.classList.remove('hidden');
                requestAnimationFrame(() => {
                    contentLogin.classList.remove('opacity-0');
                });

                // 4. Tampilkan Form Login (Kanan) & Sembunyikan Form Register (Kiri)
                loginFormBox.classList.remove('hidden');
                requestAnimationFrame(() => {
                    loginFormBox.classList.remove('md:opacity-0', 'md:pointer-events-none', 'md:translate-x-4');
                    loginFormBox.classList.add('md:opacity-100', 'md:translate-x-0');
                });

                registerFormBox.classList.add('hidden', 'md:opacity-0', 'md:pointer-events-none', 'md:-translate-x-4');
                registerFormBox.classList.remove('md:opacity-100', 'md:translate-x-0');
            }
        }

        function togglePasswordVisibility(inputId) {
            const input = document.getElementById(inputId);
            if (!input) return;
            input.type = input.type === 'password' ? 'text' : 'password';
        }

        function handleAuthSubmit(event, type) {
            event.preventDefault();
            if (type === 'register') {
                const nameVal = document.getElementById('reg-name').value.trim();
                if (nameVal) {
                    localStorage.setItem('codepawth_user_name', nameVal);
                }
            }
            window.location.href = "{{ url('/level-view') }}";
        }
    </script>
</body>

</html>
