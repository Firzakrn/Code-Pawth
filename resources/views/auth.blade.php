
@php
    $authMode = old('auth_mode', $mode ?? 'login');
    $authMode = in_array($authMode, ['login', 'register']) 
        ? $authMode : 'login';

    $authRole = old('role', request('peran', 'murid'));
    $authRole = in_array($authRole, ['murid', 'guru']) 
        ? $authRole : 'murid';
@endphp

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Masuk & Daftar — CodePawth</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect"
          href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif']
                    },
                    boxShadow: {
                        'soft-blue':
                            '0 10px 26px -6px rgba(37,99,235,.32)',
                        'card-float':
                            '0 18px 44px -10px rgba(30,64,175,.14)'
                    }
                }
            }
        };
    </script>

    <style>
        body {
            background: linear-gradient(
                180deg,
                #F4F9FF 0%,
                #E6F0FF 100%
            );
            color: #0F172A;
        }

        /* Tambahan pilihan Siswa dan Guru */
        .auth-role-choice {
            transition: all .2s ease;
        }

        .auth-role-choice[aria-pressed="true"] {
            border-color: #2563eb;
            background: #eff6ff;
            color: #1d4ed8;
            box-shadow: 0 0 0 2px rgba(37,99,235,.08);
        }

        .auth-role-choice:hover {
            border-color: #93c5fd;
        }

        /* Scroll hanya di formulir daftar */
        @media (min-width: 768px) {
            #register-form-box {
                justify-content: flex-start;
                overflow-y: auto;
                scrollbar-width: thin;
                scrollbar-color: #bfdbfe transparent;
            }
        }

        @media (max-width: 767px) {
            #auth-card {
                height: auto;
            }
        }
    </style>
</head>

<body class="min-h-screen md:h-screen md:overflow-hidden
             flex flex-col justify-between relative
             selection:bg-blue-600 selection:text-white">

    {{-- DEKORASI AWAN --}}
    <div class="pointer-events-none fixed inset-0
                overflow-hidden z-0"
         aria-hidden="true">

        <svg class="absolute -top-8 -right-8
                    w-[320px] sm:w-[440px] h-auto"
             viewBox="0 0 600 420" fill="none">
            <path
                d="M170 -20C205 68 285 98 380 112C475 126 565 172 620 275V-20H170Z"
                fill="#DCEAFF"
                fill-opacity=".85"/>
            <circle cx="535" cy="65" r="95"
                    fill="#CFE1FF" fill-opacity=".5"/>
        </svg>

        <svg class="absolute -bottom-10 -left-10
                    w-[300px] sm:w-[420px] h-auto"
             viewBox="0 0 540 320" fill="none">
            <path
                d="M-20 75C65 92 110 152 175 198C240 244 320 250 390 340H-20V75Z"
                fill="#DCEAFF" fill-opacity=".9"/>
            <path
                d="M-20 142C45 154 85 204 140 238C195 272 255 278 310 340H-20V142Z"
                fill="#CFE1FF" fill-opacity=".75"/>
        </svg>

        <div class="absolute top-[18%] left-[12%]
                    text-blue-300 text-2xl">
            ✦
        </div>

        <div class="absolute bottom-[18%] right-[10%]
                    text-blue-300 text-3xl">
            ✧
        </div>
    </div>

    {{-- HEADER --}}
    <header class="relative z-20 w-full max-w-5xl mx-auto
                   px-5 sm:px-8 pt-3.5 pb-1
                   flex items-center justify-between shrink-0">

        <a href="{{ route('home') }}"
           class="inline-flex items-center gap-2
                  text-slate-600 hover:text-blue-600
                  text-sm font-bold transition-colors">

            <span class="w-8 h-8 rounded-full bg-white
                         border border-slate-200
                         flex items-center justify-center">
                ←
            </span>

            <span>Kembali</span>
        </a>

        <a href="{{ route('home') }}"
           class="flex items-center gap-2">

            <div class="w-8 h-8 rounded-xl bg-blue-600
                        text-white flex items-center
                        justify-center font-extrabold">
                &lt;/&gt;
            </div>

            <span class="text-lg font-extrabold
                         tracking-tight text-slate-900">
                Code<span class="text-blue-600">Pawth</span>
            </span>
        </a>
    </header>

    {{-- KARTU LOGIN ASLI --}}
    <main class="relative z-10 flex-1 min-h-0
                 flex items-center justify-center
                 px-4 sm:px-6 py-2">

        <div id="auth-card"
             class="relative w-full max-w-[850px] md:h-[465px]
                    bg-white rounded-[28px] shadow-card-float
                    border border-white overflow-hidden">

            {{-- =========================================
                 FORM REGISTRASI - KIRI
            ========================================== --}}
            <div id="register-form-box"
                 class="w-full md:w-1/2 md:absolute
                        md:top-0 md:left-0 md:h-full
                        p-6 sm:px-9 sm:py-6
                        flex flex-col justify-center
                        transition-all duration-700 ease-in-out
                        hidden md:flex md:opacity-0
                        md:pointer-events-none md:-translate-x-4">

                <div class="mb-4">
                    <span class="inline-block px-2.5 py-0.5
                                 rounded-full bg-blue-50 text-blue-600
                                 text-[10px] font-extrabold
                                 uppercase tracking-wider mb-1.5">
                        Akun Baru
                    </span>

                    <h2 class="text-2xl font-extrabold
                               text-slate-900 tracking-tight">
                        Buat Akun
                    </h2>

                    <p class="text-xs text-slate-500 mt-0.5">
                        Simpan progres belajar dan bintangmu
                        secara permanen.
                    </p>
                </div>

                <form method="POST"
                      action="{{ route('register.submit') }}"
                      class="space-y-3"
                      id="auth-register-form">

                    @csrf

                    <input type="hidden"
                           name="role"
                           id="register-role"
                           value="{{ $authRole }}">

                    <input type="hidden"
                           name="auth_mode"
                           value="register">

                    {{-- PILIH PERAN --}}
                    <div>
                        <p class="text-[11px] font-bold
                                  text-slate-700 mb-1.5">
                            Daftar sebagai
                        </p>

                        <div class="flex gap-2"
                             role="group"
                             aria-label="Daftar sebagai">

                            <button type="button"
                                    class="auth-role-choice flex-1
                                           rounded-xl border-2
                                           border-slate-200 bg-white
                                           py-2 px-2 text-xs font-bold
                                           text-slate-700"
                                    data-role="murid"
                                    aria-pressed="false"
                                    onclick="setAuthRole('murid')">
                                🎒 Siswa
                            </button>

                            <button type="button"
                                    class="auth-role-choice flex-1
                                           rounded-xl border-2
                                           border-slate-200 bg-white
                                           py-2 px-2 text-xs font-bold
                                           text-slate-700"
                                    data-role="guru"
                                    aria-pressed="false"
                                    onclick="setAuthRole('guru')">
                                👩‍🏫 Guru
                            </button>
                        </div>
                    </div>

                    {{-- ERROR REGISTRASI --}}
                    @if ($errors->any() && $authMode === 'register')
                        <div class="rounded-xl bg-rose-50
                                    border border-rose-200
                                    text-rose-700 p-3 text-xs"
                             role="alert">
                            <strong>Periksa kembali datamu:</strong>

                            <ul class="list-disc pl-4 mt-1">
                                @foreach ($errors->all() as $message)
                                    <li>{{ $message }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- NAMA --}}
                    <div>
                        <label for="reg-name"
                               class="block text-xs font-bold
                                      text-slate-700 mb-1">
                            Nama Lengkap
                        </label>

                        <input type="text"
                               id="reg-name"
                               name="name"
                               value="{{ old('name') }}"
                               required
                               maxlength="255"
                               autocomplete="name"
                               placeholder="Masukkan namamu"
                               class="w-full px-3.5 py-2 rounded-xl
                                      bg-slate-50 border border-slate-200
                                      text-sm text-slate-800
                                      focus:bg-white focus:border-blue-500
                                      outline-none transition-all">
                    </div>

                    {{-- EMAIL --}}
                    <div>
                        <label for="reg-email"
                               class="block text-xs font-bold
                                      text-slate-700 mb-1">
                            Email
                        </label>

                        <input type="email"
                               id="reg-email"
                               name="email"
                               value="{{ old('email') }}"
                               required
                               maxlength="255"
                               autocomplete="email"
                               placeholder="nama@email.com"
                               class="w-full px-3.5 py-2 rounded-xl
                                      bg-slate-50 border border-slate-200
                                      text-sm text-slate-800
                                      focus:bg-white focus:border-blue-500
                                      outline-none transition-all">
                    </div>

                    {{-- NOMOR HP --}}
                    <div>
                        <label for="reg-phone"
                               class="block text-xs font-bold
                                      text-slate-700 mb-1">
                            Nomor HP
                            <span class="font-normal text-slate-400">
                                (opsional)
                            </span>
                        </label>

                        <input type="tel"
                               id="reg-phone"
                               name="phone"
                               value="{{ old('phone') }}"
                               maxlength="20"
                               autocomplete="tel"
                               placeholder="08xxxxxxxxxx"
                               class="w-full px-3.5 py-2 rounded-xl
                                      bg-slate-50 border border-slate-200
                                      text-sm text-slate-800
                                      focus:bg-white focus:border-blue-500
                                      outline-none transition-all">
                    </div>

                    {{-- KHUSUS GURU --}}
                    <div id="register-school-field" class="hidden">
                        <label for="reg-school"
                               class="block text-xs font-bold
                                      text-slate-700 mb-1">
                            Sekolah / Instansi
                            <span class="font-normal text-slate-400">
                                (opsional)
                            </span>
                        </label>

                        <input type="text"
                               id="reg-school"
                               name="school"
                               value="{{ old('school') }}"
                               maxlength="255"
                               placeholder="Sekolah atau tutor mandiri"
                               class="w-full px-3.5 py-2 rounded-xl
                                      bg-slate-50 border border-slate-200
                                      text-sm text-slate-800
                                      focus:bg-white focus:border-blue-500
                                      outline-none transition-all">
                    </div>

                    {{-- PASSWORD --}}
                    <div>
                        <label for="reg-password"
                               class="block text-xs font-bold
                                      text-slate-700 mb-1">
                            Password
                        </label>

                        <div class="relative">
                            <input type="password"
                                   id="reg-password"
                                   name="password"
                                   required
                                   minlength="8"
                                   autocomplete="new-password"
                                   placeholder="Minimal 8 karakter"
                                   class="w-full px-3.5 pr-11 py-2
                                          rounded-xl bg-slate-50
                                          border border-slate-200
                                          text-sm text-slate-800
                                          focus:bg-white
                                          focus:border-blue-500
                                          outline-none transition-all">

                            <button type="button"
                                    onclick="togglePasswordVisibility('reg-password')"
                                    class="absolute inset-y-0 right-0
                                           px-3 text-slate-400
                                           hover:text-blue-600">
                                👁
                            </button>
                        </div>
                    </div>

                    {{-- KONFIRMASI --}}
                    <div>
                        <label for="reg-password-confirmation"
                               class="block text-xs font-bold
                                      text-slate-700 mb-1">
                            Konfirmasi Password
                        </label>

                        <input type="password"
                               id="reg-password-confirmation"
                               name="password_confirmation"
                               required
                               minlength="8"
                               autocomplete="new-password"
                               placeholder="Ulangi password"
                               class="w-full px-3.5 py-2 rounded-xl
                                      bg-slate-50 border border-slate-200
                                      text-sm text-slate-800
                                      focus:bg-white focus:border-blue-500
                                      outline-none transition-all">
                    </div>

                    {{-- INFORMASI SISWA --}}
                    <p id="student-code-note"
                       class="text-[11px] text-blue-700
                              bg-blue-50 px-2.5 py-2 rounded-xl">
                        💙 Siswa bebas belajar mandiri tanpa kode
                        kelas. Kode baru dibutuhkan jika ingin
                        bergabung dengan kelas guru.
                    </p>

                    {{-- SUBMIT --}}
                    <button type="submit"
                            class="w-full mt-1 bg-blue-600
                                   hover:bg-blue-700 text-white
                                   font-bold text-sm py-2.5
                                   rounded-xl shadow-soft-blue
                                   hover:-translate-y-0.5
                                   transition-all duration-200">
                        Daftar Sekarang
                    </button>
                </form>

                <p class="md:hidden text-center text-xs
                          text-slate-500 mt-4">
                    Sudah punya akun?
                    <button type="button"
                            onclick="setAuthMode('login')"
                            class="text-blue-600 font-bold">
                        Masuk di sini
                    </button>
                </p>
            </div>

            {{-- =========================================
                 FORM LOGIN - KANAN
            ========================================== --}}
            <div id="login-form-box"
                 class="w-full md:w-1/2 md:absolute
                        md:top-0 md:right-0 md:h-full
                        p-6 sm:px-9 sm:py-6
                        flex flex-col justify-center
                        transition-all duration-700 ease-in-out
                        md:opacity-100 md:translate-x-0">

                <div class="mb-5">
                    <span class="inline-block px-2.5 py-0.5
                                 rounded-full bg-blue-50 text-blue-600
                                 text-[10px] font-extrabold
                                 uppercase tracking-wider mb-1.5">
                        Selamat Datang Kembali
                    </span>

                    <h2 class="text-2xl font-extrabold
                               text-slate-900 tracking-tight">
                        Masuk ke Akun
                    </h2>

                    <p class="text-xs text-slate-500 mt-1">
                        Masukkan email dan password untuk
                        melanjutkan jejak belajarmu.
                    </p>
                </div>

                <form method="POST"
                      action="{{ route('login.submit') }}"
                      class="space-y-3.5"
                      id="auth-login-form">

                    @csrf

                    <input type="hidden"
                           name="role"
                           id="login-role"
                           value="{{ $authRole }}">

                    <input type="hidden"
                           name="auth_mode"
                           value="login">

                    {{-- PILIH PERAN --}}
                    <div>
                        <p class="text-[11px] font-bold
                                  text-slate-700 mb-1.5">
                            Masuk sebagai
                        </p>

                        <div class="flex gap-2"
                             role="group"
                             aria-label="Masuk sebagai">

                            <button type="button"
                                    class="auth-role-choice flex-1
                                           rounded-xl border-2
                                           border-slate-200 bg-white
                                           py-2 px-2 text-xs font-bold
                                           text-slate-700"
                                    data-role="murid"
                                    aria-pressed="false"
                                    onclick="setAuthRole('murid')">
                                🎒 Siswa
                            </button>

                            <button type="button"
                                    class="auth-role-choice flex-1
                                           rounded-xl border-2
                                           border-slate-200 bg-white
                                           py-2 px-2 text-xs font-bold
                                           text-slate-700"
                                    data-role="guru"
                                    aria-pressed="false"
                                    onclick="setAuthRole('guru')">
                                👩‍🏫 Guru
                            </button>
                        </div>
                    </div>

                    {{-- ERROR LOGIN --}}
                    @if ($errors->any() && $authMode === 'login')
                        <div class="rounded-xl bg-rose-50
                                    border border-rose-200
                                    text-rose-700 p-3 text-xs"
                             role="alert">
                            <strong>Login gagal:</strong>

                            <ul class="list-disc pl-4 mt-1">
                                @foreach ($errors->all() as $message)
                                    <li>{{ $message }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- EMAIL --}}
                    <div>
                        <label for="login-email"
                               class="block text-xs font-bold
                                      text-slate-700 mb-1">
                            Email
                        </label>

                        <input type="email"
                               id="login-email"
                               name="email"
                               value="{{ old('email') }}"
                               required
                               autocomplete="email"
                               placeholder="nama@email.com"
                               class="w-full px-3.5 py-2.5 rounded-xl
                                      bg-slate-50 border border-slate-200
                                      text-sm text-slate-800
                                      focus:bg-white focus:border-blue-500
                                      outline-none transition-all">
                    </div>

                    {{-- PASSWORD --}}
                    <div>
                        <label for="login-password"
                               class="block text-xs font-bold
                                      text-slate-700 mb-1">
                            Password
                        </label>

                        <div class="relative">
                            <input type="password"
                                   id="login-password"
                                   name="password"
                                   required
                                   autocomplete="current-password"
                                   placeholder="Masukkan password"
                                   class="w-full px-3.5 pr-11 py-2.5
                                          rounded-xl bg-slate-50
                                          border border-slate-200
                                          text-sm text-slate-800
                                          focus:bg-white
                                          focus:border-blue-500
                                          outline-none transition-all">

                            <button type="button"
                                    onclick="togglePasswordVisibility('login-password')"
                                    class="absolute inset-y-0 right-0
                                           px-3 text-slate-400
                                           hover:text-blue-600">
                                👁
                            </button>
                        </div>
                    </div>

                    <button type="submit"
                            class="w-full mt-1 bg-blue-600
                                   hover:bg-blue-700 text-white
                                   font-bold text-sm py-2.5
                                   rounded-xl shadow-soft-blue
                                   hover:-translate-y-0.5
                                   transition-all duration-200">
                        Masuk
                    </button>
                </form>

                <p class="md:hidden text-center text-xs
                          text-slate-500 mt-4">
                    Belum punya akun?
                    <button type="button"
                            onclick="setAuthMode('register')"
                            class="text-blue-600 font-bold">
                        Daftar sekarang
                    </button>
                </p>
            </div>

            {{-- =========================================
                 PANEL BIRU SLIDER ASLI
            ========================================== --}}
            <div id="sliding-overlay"
                 class="hidden md:flex flex-col justify-between
                        absolute top-0 left-0 w-1/2 h-full
                        bg-gradient-to-br from-blue-600
                        via-blue-600 to-indigo-700
                        text-white p-8 z-20
                        transition-transform duration-700
                        ease-in-out translate-x-0
                        overflow-hidden">

                {{-- DEKORASI PANEL --}}
                <div class="pointer-events-none absolute
                            -top-14 -left-14 w-44 h-44
                            rounded-full bg-white/10">
                </div>

                <div class="pointer-events-none absolute
                            -bottom-16 -right-12 w-52 h-52
                            rounded-full bg-blue-400/20">
                </div>

                {{-- TEKS LOGIN --}}
                <div class="relative z-10 mt-1">

                    <div id="overlay-content-login"
                         class="transition-all duration-500
                                opacity-100 translate-y-0">

                        <span class="inline-flex items-center gap-1.5
                                     px-3 py-1 rounded-full bg-white/15
                                     border border-white/20
                                     text-blue-100 text-[11px]
                                     font-bold mb-3">
                            CodePawth Member
                        </span>

                        <h3 class="text-xl lg:text-[23px]
                                   font-extrabold leading-snug">
                            Apakah kamu sudah pernah menggunakan
                            CodePawth?
                        </h3>

                        <p class="text-xs lg:text-[13px]
                                  text-blue-100/90 mt-2.5
                                  leading-relaxed">
                            Jika sudah, langsung masukkan email
                            dan password di sebelah kanan.
                            Belum punya akun? Yuk daftar dulu!
                        </p>

                        <button type="button"
                                onclick="setAuthMode('register')"
                                class="mt-5 inline-flex items-center
                                       gap-2 px-5 py-2 rounded-full
                                       bg-white text-blue-600
                                       hover:bg-blue-50 font-extrabold
                                       text-xs sm:text-sm shadow-md
                                       hover:-translate-y-0.5
                                       transition-all">
                            Belum, Daftar Akun →
                        </button>
                    </div>

                    {{-- TEKS REGISTER --}}
                    <div id="overlay-content-register"
                         class="hidden transition-all duration-500
                                opacity-0 translate-y-2">

                        <span class="inline-flex items-center gap-1.5
                                     px-3 py-1 rounded-full bg-white/15
                                     border border-white/20
                                     text-blue-100 text-[11px]
                                     font-bold mb-3">
                            Mulai Perjalananmu
                        </span>

                        <h3 class="text-xl lg:text-[23px]
                                   font-extrabold leading-snug">
                            Sudah pernah belajar di
                            CodePawth sebelumnya?
                        </h3>

                        <p class="text-xs lg:text-[13px]
                                  text-blue-100/90 mt-2.5
                                  leading-relaxed">
                            Kalau kamu sudah punya akun, geser
                            kembali ke halaman masuk untuk
                            melanjutkan perjalanan belajarmu!
                        </p>

                        <button type="button"
                                onclick="setAuthMode('login')"
                                class="mt-5 inline-flex items-center
                                       gap-2 px-5 py-2 rounded-full
                                       bg-white text-blue-600
                                       hover:bg-blue-50 font-extrabold
                                       text-xs sm:text-sm shadow-md
                                       hover:-translate-y-0.5
                                       transition-all">
                            ← Sudah, Masuk di Sini
                        </button>
                    </div>
                </div>

                {{-- MASKOT ASLI --}}
                <div id="overlay-mascot-box"
                     style="left: calc(100% - 174px);"
                     class="absolute -bottom-1 w-44 h-44
                            pointer-events-none z-20
                            transition-all duration-700
                            ease-in-out flex items-end justify-end">

                    <img id="overlay-mascot-img"
                         src="{{ asset('images/mascot_peeking.png') }}"
                         alt="Maskot CodePawth"
                         class="w-full h-full object-contain
                                object-right-bottom
                                transition-transform duration-700
                                ease-in-out scale-x-100
                                drop-shadow-[0_10px_18px_rgba(15,23,42,0.28)]">
                </div>
            </div>

        </div>
    </main>

    {{-- FOOTER --}}
    <footer class="relative z-10 text-center
                   py-2 text-[11px] text-slate-400 shrink-0">
        CodePawth — Platform Belajar Pemrograman Adaptif
    </footer>

    {{-- JAVASCRIPT SLIDER ASLI --}}
    <script>
        function setAuthMode(mode) {

            const isRegister = mode === 'register';

            const overlay = document.getElementById(
                'sliding-overlay'
            );

            const loginFormBox = document.getElementById(
                'login-form-box'
            );

            const registerFormBox = document.getElementById(
                'register-form-box'
            );

            const contentLogin = document.getElementById(
                'overlay-content-login'
            );

            const contentRegister = document.getElementById(
                'overlay-content-register'
            );

            const mascotBox = document.getElementById(
                'overlay-mascot-box'
            );

            const mascotImg = document.getElementById(
                'overlay-mascot-img'
            );

            if (isRegister) {

                // Geser panel biru ke kanan
                overlay.classList.remove('translate-x-0');
                overlay.classList.add('translate-x-full');

                // Maskot berpindah dan dibalik
                mascotBox.style.left = '-2px';

                mascotImg.classList.remove('scale-x-100');
                mascotImg.classList.add('-scale-x-100');

                // Teks panel
                contentLogin.classList.add(
                    'hidden', 'opacity-0'
                );

                contentRegister.classList.remove('hidden');

                requestAnimationFrame(() => {
                    contentRegister.classList.remove(
                        'opacity-0', 'translate-y-2'
                    );
                });

                // Form registrasi
                registerFormBox.classList.remove('hidden');

                requestAnimationFrame(() => {
                    registerFormBox.classList.remove(
                        'md:opacity-0',
                        'md:pointer-events-none',
                        'md:-translate-x-4'
                    );

                    registerFormBox.classList.add(
                        'md:opacity-100',
                        'md:translate-x-0'
                    );
                });

                loginFormBox.classList.add(
                    'hidden',
                    'md:opacity-0',
                    'md:pointer-events-none',
                    'md:translate-x-4'
                );

                loginFormBox.classList.remove(
                    'md:opacity-100',
                    'md:translate-x-0'
                );

            } else {

                // Panel kembali ke kiri
                overlay.classList.add('translate-x-0');
                overlay.classList.remove('translate-x-full');

                // Posisi maskot semula
                mascotBox.style.left =
                    'calc(100% - 174px)';

                mascotImg.classList.add('scale-x-100');
                mascotImg.classList.remove('-scale-x-100');

                // Teks login
                contentRegister.classList.add(
                    'hidden',
                    'opacity-0',
                    'translate-y-2'
                );

                contentLogin.classList.remove('hidden');

                requestAnimationFrame(() => {
                    contentLogin.classList.remove('opacity-0');
                });

                // Form login
                loginFormBox.classList.remove('hidden');

                requestAnimationFrame(() => {
                    loginFormBox.classList.remove(
                        'md:opacity-0',
                        'md:pointer-events-none',
                        'md:translate-x-4'
                    );

                    loginFormBox.classList.add(
                        'md:opacity-100',
                        'md:translate-x-0'
                    );
                });

                registerFormBox.classList.add(
                    'hidden',
                    'md:opacity-0',
                    'md:pointer-events-none',
                    'md:-translate-x-4'
                );

                registerFormBox.classList.remove(
                    'md:opacity-100',
                    'md:translate-x-0'
                );
            }
        }

        function togglePasswordVisibility(inputId) {
            const input = document.getElementById(inputId);

            if (!input) return;

            input.type = input.type === 'password'
                ? 'text'
                : 'password';
        }

        function setAuthRole(role) {

            if (!['murid', 'guru'].includes(role)) {
                return;
            }

            document.getElementById('login-role').value = role;
            document.getElementById('register-role').value = role;

            document.querySelectorAll(
                '.auth-role-choice'
            ).forEach(button => {

                button.setAttribute(
                    'aria-pressed',
                    button.dataset.role === role
                        ? 'true'
                        : 'false'
                );
            });

            // Field sekolah hanya untuk Guru
            document.getElementById(
                'register-school-field'
            ).classList.toggle(
                'hidden',
                role !== 'guru'
            );

            // Informasi belajar mandiri hanya untuk Siswa
            document.getElementById(
                'student-code-note'
            ).classList.toggle(
                'hidden',
                role !== 'murid'
            );
        }

        // Atur pilihan peran saat pertama dibuka
        setAuthRole(@json($authRole));

        // URL /daftar langsung membuka mode registrasi
        @if ($authMode === 'register')
            setAuthMode('register');
        @endif
    </script>

</body>
</html>