@php
    $authMode = old('auth_mode', $mode ?? 'login');
    $authMode = in_array($authMode, ['login', 'register']) ? $authMode : 'login';

    $authRole = old('role', request('peran', 'murid'));
    $authRole = in_array($authRole, ['murid', 'guru']) ? $authRole : 'murid';
@endphp

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Masuk & Daftar — CodePawth</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
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
                        'soft-blue': '0 10px 26px -6px rgba(37,99,235,.32)',
                        'card-float': '0 18px 44px -10px rgba(30,64,175,.14)'
                    }
                }
            }
        };
    </script>

    <style>
        body {
            background: linear-gradient(180deg, #F4F9FF 0%, #E6F0FF 100%);
            color: #0F172A;
        }

        /* Pilihan Peran Siswa dan Guru */
        .auth-role-choice {
            transition: all .2s ease;
        }

        .auth-role-choice[aria-pressed="true"] {
            border-color: #2563EB;
            background: #EFF6FF;
            color: #1D4ED8;
            box-shadow: 0 0 0 2px rgba(37, 99, 235, .10);
        }

        .auth-role-choice:hover {
            border-color: #93C5FD;
        }

        /* Scroll rapi khusus formulir daftar di desktop */
        @media (min-width: 768px) {
            #register-form-box {
                overflow-y: auto;
                scrollbar-width: thin;
                scrollbar-color: #BFDBFE transparent;
            }

            #register-form-box::-webkit-scrollbar {
                width: 5px;
            }

            #register-form-box::-webkit-scrollbar-thumb {
                background-color: #BFDBFE;
                border-radius: 9999px;
            }
        }
    </style>
</head>

<body
    class="min-h-screen md:h-screen md:overflow-hidden
             flex flex-col justify-between relative
             selection:bg-blue-600 selection:text-white">

    {{-- DEKORASI AWAN, PAW BESAR, & BINTANG --}}
    <div class="pointer-events-none select-none fixed inset-0 overflow-hidden z-0" aria-hidden="true">

        <!-- Awan Kanan Atas -->
        <svg class="absolute -top-8 -right-8 w-[320px] sm:w-[440px] h-auto" viewBox="0 0 600 420" fill="none">
            <path d="M170 -20C205 68 285 98 380 112C475 126 565 172 620 275V-20H170Z" fill="#DCEAFF"
                fill-opacity=".85" />
            <circle cx="535" cy="65" r="95" fill="#CFE1FF" fill-opacity=".5" />
        </svg>

        <!-- Awan Kiri Bawah -->
        <svg class="absolute -bottom-10 -left-10 w-[300px] sm:w-[420px] h-auto" viewBox="0 0 540 320" fill="none">
            <path d="M-20 75C65 92 110 152 175 198C240 244 320 250 390 340H-20V75Z" fill="#DCEAFF" fill-opacity=".9" />
            <path d="M-20 142C45 154 85 204 140 238C195 272 255 278 310 340H-20V142Z" fill="#CFE1FF"
                fill-opacity=".75" />
        </svg>

        <!-- Paw Kucing Besar Dekoratif -->
        <svg class="hidden sm:block absolute top-[14%] left-[8%] w-28 h-28 text-blue-300/30 -rotate-12"
            viewBox="0 0 64 64" fill="currentColor">
            <ellipse cx="16" cy="22" rx="5.5" ry="7.5" transform="rotate(-18 16 22)" />
            <ellipse cx="27" cy="15" rx="5.5" ry="8" transform="rotate(-6 27 15)" />
            <ellipse cx="39" cy="15" rx="5.5" ry="8" transform="rotate(8 39 15)" />
            <ellipse cx="49" cy="23" rx="5.5" ry="7.5" transform="rotate(20 49 23)" />
            <path
                d="M32 27c-9.5 0-16 6.8-16 14.2 0 5.2 4.2 8.8 9.2 8.8 2.6 0 4.6-1 6.8-1s4.2 1 6.8 1c5 0 9.2-3.6 9.2-8.8C48 33.8 41.5 27 32 27z" />
        </svg>

        <!-- Bintang SVG -->
        <svg class="absolute top-[22%] left-[15%] w-6 h-6 text-blue-400/50" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 1l2.6 7.4L22 11l-7.4 2.6L12 21l-2.6-7.4L2 11l7.4-2.6L12 1z" />
        </svg>
        <svg class="absolute bottom-[18%] right-[10%] w-8 h-8 text-blue-400/45" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 1l2.6 7.4L22 11l-7.4 2.6L12 21l-2.6-7.4L2 11l7.4-2.6L12 1z" />
        </svg>
    </div>

    {{-- HEADER --}}
    <header
        class="relative z-20 w-full max-w-5xl mx-auto px-5 sm:px-8 pt-4 pb-1 flex items-center justify-between shrink-0">
        <a href="{{ route('home') }}"
            class="inline-flex items-center gap-2 text-slate-600 hover:text-blue-600 text-sm font-bold transition-colors">
            <span
                class="w-8 h-8 rounded-full bg-white border border-slate-200 flex items-center justify-center shadow-2xs">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
            </span>
            <span>Kembali</span>
        </a>

        <a href="{{ route('home') }}" class="flex items-center gap-2">
            <div class="w-8 h-8 rounded-xl bg-blue-600 text-white flex items-center justify-center shadow-soft-blue">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.6" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 18l6-6-6-6M8 6l-6 6 6 6" />
                </svg>
            </div>
            <span class="text-lg font-extrabold tracking-tight text-slate-900">
                Code<span class="text-blue-600">Pawth</span>
            </span>
        </a>
    </header>

    {{-- KARTU LOGIN & REGISTRASI --}}
    <main class="relative z-10 flex-1 min-h-0 flex items-center justify-center px-4 sm:px-6 py-2">

        <div id="auth-card"
            class="relative w-full max-w-[880px] md:h-[520px]
                    bg-white rounded-[28px] shadow-card-float
                    border border-white overflow-hidden">

            {{-- =========================================
                 FORM REGISTRASI - KIRI
            ========================================== --}}
            <div id="register-form-box"
                class="w-full md:w-1/2 md:absolute md:top-0 md:left-0 md:h-full
                        p-6 sm:px-9 sm:py-7
                        flex flex-col justify-start
                        transition-all duration-700 ease-in-out
                        max-md:hidden md:opacity-0 md:pointer-events-none md:-translate-x-4">

                <div class="mb-4">
                    <span
                        class="inline-block px-2.5 py-0.5 rounded-full bg-blue-50 text-blue-600 text-[10px] font-extrabold uppercase tracking-wider mb-1.5">
                        Akun Baru
                    </span>

                    <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">
                        Buat Akun
                    </h2>

                    <p class="text-xs text-slate-500 mt-0.5">
                        Simpan progres belajar dan bintangmu secara permanen.
                    </p>
                </div>

                <form method="POST" action="{{ route('register.submit') }}" class="space-y-3" id="auth-register-form">
                    @csrf

                    <input type="hidden" name="role" id="register-role" value="{{ $authRole }}">
                    <input type="hidden" name="auth_mode" value="register">

                    {{-- PILIH PERAN --}}
                    <div>
                        <p class="text-[11px] font-bold text-slate-700 mb-1.5">
                            Daftar sebagai
                        </p>

                        <div class="flex gap-2" role="group" aria-label="Daftar sebagai">
                            <button type="button"
                                class="auth-role-choice flex-1 inline-flex items-center justify-center gap-1.5 rounded-xl border-2 border-slate-200 bg-white py-2 px-2 text-xs font-bold text-slate-700 cursor-pointer"
                                data-role="murid" aria-pressed="false" onclick="setAuthRole('murid')">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor"
                                    stroke-width="2.2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 14l9-5-9-5-9 5 9 5z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                </svg>
                                <span>Siswa</span>
                            </button>

                            <button type="button"
                                class="auth-role-choice flex-1 inline-flex items-center justify-center gap-1.5 rounded-xl border-2 border-slate-200 bg-white py-2 px-2 text-xs font-bold text-slate-700 cursor-pointer"
                                data-role="guru" aria-pressed="false" onclick="setAuthRole('guru')">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor"
                                    stroke-width="2.2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342" />
                                </svg>
                                <span>Guru</span>
                            </button>
                        </div>
                    </div>

                    {{-- ERROR REGISTRASI --}}
                    @if ($errors->any() && $authMode === 'register')
                        <div class="rounded-xl bg-rose-50 border border-rose-200 text-rose-700 p-3 text-xs"
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
                        <label for="reg-name" class="block text-xs font-bold text-slate-700 mb-1">
                            Nama Lengkap
                        </label>
                        <input type="text" id="reg-name" name="name" value="{{ old('name') }}" required
                            maxlength="255" autocomplete="name" placeholder="Masukkan namamu"
                            class="w-full px-3.5 py-2 rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-800 focus:bg-white focus:border-blue-500 outline-none transition-all">
                    </div>

                    {{-- EMAIL --}}
                    <div>
                        <label for="reg-email" class="block text-xs font-bold text-slate-700 mb-1">
                            Email
                        </label>
                        <input type="email" id="reg-email" name="email" value="{{ old('email') }}" required
                            maxlength="255" autocomplete="email" placeholder="nama@email.com"
                            class="w-full px-3.5 py-2 rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-800 focus:bg-white focus:border-blue-500 outline-none transition-all">
                    </div>

                    {{-- NOMOR HP --}}
                    <div>
                        <label for="reg-phone" class="block text-xs font-bold text-slate-700 mb-1">
                            Nomor HP <span class="font-normal text-slate-400">(opsional)</span>
                        </label>
                        <input type="tel" id="reg-phone" name="phone" value="{{ old('phone') }}"
                            maxlength="20" autocomplete="tel" placeholder="08xxxxxxxxxx"
                            class="w-full px-3.5 py-2 rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-800 focus:bg-white focus:border-blue-500 outline-none transition-all">
                    </div>

                    {{-- KHUSUS GURU --}}
                    <div id="register-school-field" class="hidden">
                        <label for="reg-school" class="block text-xs font-bold text-slate-700 mb-1">
                            Sekolah / Instansi <span class="font-normal text-slate-400">(opsional)</span>
                        </label>
                        <input type="text" id="reg-school" name="school" value="{{ old('school') }}"
                            maxlength="255" placeholder="Sekolah atau tutor mandiri"
                            class="w-full px-3.5 py-2 rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-800 focus:bg-white focus:border-blue-500 outline-none transition-all">
                    </div>

                    {{-- PASSWORD --}}
                    <div>
                        <label for="reg-password" class="block text-xs font-bold text-slate-700 mb-1">
                            Password
                        </label>
                        <div class="relative">
                            <input type="password" id="reg-password" name="password" required minlength="8"
                                autocomplete="new-password" placeholder="Minimal 8 karakter"
                                class="w-full px-3.5 pr-11 py-2 rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-800 focus:bg-white focus:border-blue-500 outline-none transition-all">

                            <button type="button" onclick="togglePasswordVisibility('reg-password', this)"
                                aria-label="Tampilkan atau sembunyikan password"
                                class="absolute inset-y-0 right-0 px-3 flex items-center text-slate-400 hover:text-blue-600 cursor-pointer">
                                <svg class="eye-open w-4 h-4" fill="none" stroke="currentColor"
                                    stroke-width="2.2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <svg class="eye-closed w-4 h-4 hidden" fill="none" stroke="currentColor"
                                    stroke-width="2.2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- KONFIRMASI --}}
                    <div>
                        <label for="reg-password-confirmation" class="block text-xs font-bold text-slate-700 mb-1">
                            Konfirmasi Password
                        </label>
                        <input type="password" id="reg-password-confirmation" name="password_confirmation" required
                            minlength="8" autocomplete="new-password" placeholder="Ulangi password"
                            class="w-full px-3.5 py-2 rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-800 focus:bg-white focus:border-blue-500 outline-none transition-all">
                    </div>

                    {{-- INFORMASI SISWA --}}
                    <div id="student-code-note"
                        class="flex items-start gap-2 text-[11px] text-blue-700 bg-blue-50 border border-blue-100 px-3 py-2 rounded-xl leading-relaxed">
                        <svg class="w-4 h-4 text-blue-600 shrink-0 mt-0.5" fill="none" stroke="currentColor"
                            stroke-width="2.2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                        </svg>
                        <span>
                            Siswa bebas belajar mandiri tanpa kode kelas. Kode baru dibutuhkan jika ingin bergabung
                            dengan kelas guru.
                        </span>
                    </div>

                    {{-- SUBMIT --}}
                    <button type="submit"
                        class="w-full mt-1 bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm py-2.5 rounded-xl shadow-soft-blue hover:-translate-y-0.5 transition-all duration-200 cursor-pointer">
                        Daftar Sekarang
                    </button>
                </form>

                <p class="md:hidden text-center text-xs text-slate-500 mt-4">
                    Sudah punya akun?
                    <button type="button" onclick="setAuthMode('login')" class="text-blue-600 font-bold">
                        Masuk di sini
                    </button>
                </p>
            </div>

            {{-- =========================================
                 FORM LOGIN - KANAN
            ========================================== --}}
            <div id="login-form-box"
                class="w-full md:w-1/2 md:absolute md:top-0 md:right-0 md:h-full
                        p-6 sm:px-9 sm:py-7
                        flex flex-col justify-center
                        transition-all duration-700 ease-in-out
                        md:opacity-100 md:translate-x-0">

                <div class="mb-5">
                    <span
                        class="inline-block px-2.5 py-0.5 rounded-full bg-blue-50 text-blue-600 text-[10px] font-extrabold uppercase tracking-wider mb-1.5">
                        Selamat Datang Kembali
                    </span>

                    <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">
                        Masuk ke Akun
                    </h2>

                    <p class="text-xs text-slate-500 mt-1">
                        Masukkan email dan password untuk melanjutkan jejak belajarmu.
                    </p>
                </div>

                <form method="POST" action="{{ route('login.submit') }}" class="space-y-3.5" id="auth-login-form">
                    @csrf

                    <input type="hidden" name="role" id="login-role" value="{{ $authRole }}">
                    <input type="hidden" name="auth_mode" value="login">

                    {{-- PILIH PERAN --}}
                    <div>
                        <p class="text-[11px] font-bold text-slate-700 mb-1.5">
                            Masuk sebagai
                        </p>

                        <div class="flex gap-2" role="group" aria-label="Masuk sebagai">
                            <button type="button"
                                class="auth-role-choice flex-1 inline-flex items-center justify-center gap-1.5 rounded-xl border-2 border-slate-200 bg-white py-2 px-2 text-xs font-bold text-slate-700 cursor-pointer"
                                data-role="murid" aria-pressed="false" onclick="setAuthRole('murid')">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor"
                                    stroke-width="2.2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 14l9-5-9-5-9 5 9 5z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                </svg>
                                <span>Siswa</span>
                            </button>

                            <button type="button"
                                class="auth-role-choice flex-1 inline-flex items-center justify-center gap-1.5 rounded-xl border-2 border-slate-200 bg-white py-2 px-2 text-xs font-bold text-slate-700 cursor-pointer"
                                data-role="guru" aria-pressed="false" onclick="setAuthRole('guru')">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor"
                                    stroke-width="2.2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342" />
                                </svg>
                                <span>Guru</span>
                            </button>
                        </div>
                    </div>

                    {{-- ERROR LOGIN --}}
                    @if ($errors->any() && $authMode === 'login')
                        <div class="rounded-xl bg-rose-50 border border-rose-200 text-rose-700 p-3 text-xs"
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
                        <label for="login-email" class="block text-xs font-bold text-slate-700 mb-1">
                            Email
                        </label>
                        <input type="email" id="login-email" name="email" value="{{ old('email') }}" required
                            autocomplete="email" placeholder="nama@email.com"
                            class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-800 focus:bg-white focus:border-blue-500 outline-none transition-all">
                    </div>

                    {{-- PASSWORD --}}
                    <div>
                        <label for="login-password" class="block text-xs font-bold text-slate-700 mb-1">
                            Password
                        </label>
                        <div class="relative">
                            <input type="password" id="login-password" name="password" required
                                autocomplete="current-password" placeholder="Masukkan password"
                                class="w-full px-3.5 pr-11 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-800 focus:bg-white focus:border-blue-500 outline-none transition-all">

                            <button type="button" onclick="togglePasswordVisibility('login-password', this)"
                                aria-label="Tampilkan atau sembunyikan password"
                                class="absolute inset-y-0 right-0 px-3 flex items-center text-slate-400 hover:text-blue-600 cursor-pointer">
                                <svg class="eye-open w-4 h-4" fill="none" stroke="currentColor"
                                    stroke-width="2.2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <svg class="eye-closed w-4 h-4 hidden" fill="none" stroke="currentColor"
                                    stroke-width="2.2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full mt-1 bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm py-2.5 rounded-xl shadow-soft-blue hover:-translate-y-0.5 transition-all duration-200 cursor-pointer">
                        Masuk
                    </button>
                </form>

                <p class="md:hidden text-center text-xs text-slate-500 mt-4">
                    Belum punya akun?
                    <button type="button" onclick="setAuthMode('register')" class="text-blue-600 font-bold">
                        Daftar sekarang
                    </button>
                </p>
            </div>

            {{-- =========================================
                 PANEL BIRU SLIDER
            ========================================== --}}
            <div id="sliding-overlay"
                class="hidden md:flex flex-col justify-between
                        absolute top-0 left-0 w-1/2 h-full
                        bg-gradient-to-br from-blue-600 via-blue-600 to-indigo-700
                        text-white p-8 z-20
                        transition-transform duration-700 ease-in-out translate-x-0
                        overflow-hidden">

                {{-- DEKORASI PANEL --}}
                <div class="pointer-events-none absolute -top-14 -left-14 w-44 h-44 rounded-full bg-white/10"></div>
                <div class="pointer-events-none absolute -bottom-16 -right-12 w-52 h-52 rounded-full bg-blue-400/20">
                </div>
                <svg class="pointer-events-none select-none absolute bottom-28 left-6 w-20 h-20 text-white/10 -rotate-12"
                    viewBox="0 0 64 64" fill="currentColor">
                    <ellipse cx="16" cy="22" rx="5.5" ry="7.5"
                        transform="rotate(-18 16 22)" />
                    <ellipse cx="27" cy="15" rx="5.5" ry="8"
                        transform="rotate(-6 27 15)" />
                    <ellipse cx="39" cy="15" rx="5.5" ry="8"
                        transform="rotate(8 39 15)" />
                    <ellipse cx="49" cy="23" rx="5.5" ry="7.5"
                        transform="rotate(20 49 23)" />
                    <path
                        d="M32 27c-9.5 0-16 6.8-16 14.2 0 5.2 4.2 8.8 9.2 8.8 2.6 0 4.6-1 6.8-1s4.2 1 6.8 1c5 0 9.2-3.6 9.2-8.8C48 33.8 41.5 27 32 27z" />
                </svg>

                {{-- TEKS LOGIN --}}
                <div class="relative z-10 mt-1">
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
                            daftar dulu!
                        </p>

                        <button type="button" onclick="setAuthMode('register')"
                            class="mt-5 inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-white text-blue-600 hover:bg-blue-50 font-extrabold text-xs sm:text-sm shadow-md hover:-translate-y-0.5 transition-all cursor-pointer">
                            <span>Belum, Daftar Akun</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                            </svg>
                        </button>
                    </div>

                    {{-- TEKS REGISTER --}}
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
                            Kalau kamu sudah punya akun, geser kembali ke halaman masuk untuk melanjutkan perjalanan
                            belajarmu!
                        </p>

                        <button type="button" onclick="setAuthMode('login')"
                            class="mt-5 inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-white text-blue-600 hover:bg-blue-50 font-extrabold text-xs sm:text-sm shadow-md hover:-translate-y-0.5 transition-all cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                            </svg>
                            <span>Sudah, Masuk di Sini</span>
                        </button>
                    </div>
                </div>

                {{-- MASKOT --}}
                <div id="overlay-mascot-box" style="left: calc(100% - 174px);"
                    class="absolute -bottom-1 w-44 h-44 pointer-events-none z-20 transition-all duration-700 ease-in-out flex items-end justify-end">

                    <img id="overlay-mascot-img" src="{{ asset('images/mascot_peeking.png') }}"
                        alt="Maskot CodePawth"
                        class="w-full h-full object-contain object-right-bottom transition-transform duration-700 ease-in-out scale-x-100 drop-shadow-[0_10px_18px_rgba(15,23,42,0.28)]">
                </div>
            </div>

        </div>
    </main>

    {{-- FOOTER --}}
    <footer class="relative z-10 text-center py-2 text-[11px] text-slate-400 shrink-0">
        CodePawth — Platform Belajar Pemrograman Adaptif
    </footer>

    {{-- JAVASCRIPT SLIDER --}}
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
                // Geser panel biru ke kanan
                overlay.classList.remove('translate-x-0');
                overlay.classList.add('translate-x-full');

                // Maskot berpindah ke sisi kiri panel dan dibalik
                mascotBox.style.left = '-2px';
                mascotImg.classList.remove('scale-x-100');
                mascotImg.classList.add('-scale-x-100');

                // Teks panel
                contentLogin.classList.add('hidden', 'opacity-0');
                contentRegister.classList.remove('hidden');
                requestAnimationFrame(() => {
                    contentRegister.classList.remove('opacity-0', 'translate-y-2');
                });

                // Tampilkan form registrasi, sembunyikan form login tanpa bentrok di desktop
                registerFormBox.classList.remove('max-md:hidden');
                loginFormBox.classList.add('max-md:hidden');

                requestAnimationFrame(() => {
                    registerFormBox.classList.remove('md:opacity-0', 'md:pointer-events-none', 'md:-translate-x-4');
                    registerFormBox.classList.add('md:opacity-100', 'md:translate-x-0');

                    loginFormBox.classList.add('md:opacity-0', 'md:pointer-events-none', 'md:translate-x-4');
                    loginFormBox.classList.remove('md:opacity-100', 'md:translate-x-0');
                });

            } else {
                // Panel kembali ke kiri
                overlay.classList.add('translate-x-0');
                overlay.classList.remove('translate-x-full');

                // Posisi maskot semula
                mascotBox.style.left = 'calc(100% - 174px)';
                mascotImg.classList.add('scale-x-100');
                mascotImg.classList.remove('-scale-x-100');

                // Teks login
                contentRegister.classList.add('hidden', 'opacity-0', 'translate-y-2');
                contentLogin.classList.remove('hidden');
                requestAnimationFrame(() => {
                    contentLogin.classList.remove('opacity-0');
                });

                // Tampilkan form login, sembunyikan form registrasi
                loginFormBox.classList.remove('max-md:hidden');
                registerFormBox.classList.add('max-md:hidden');

                requestAnimationFrame(() => {
                    loginFormBox.classList.remove('md:opacity-0', 'md:pointer-events-none', 'md:translate-x-4');
                    loginFormBox.classList.add('md:opacity-100', 'md:translate-x-0');

                    registerFormBox.classList.add('md:opacity-0', 'md:pointer-events-none', 'md:-translate-x-4');
                    registerFormBox.classList.remove('md:opacity-100', 'md:translate-x-0');
                });
            }
        }

        function togglePasswordVisibility(inputId, btn) {
            const input = document.getElementById(inputId);
            if (!input) return;

            const isHidden = input.type === 'password';
            input.type = isHidden ? 'text' : 'password';

            if (btn) {
                btn.querySelector('.eye-open')?.classList.toggle('hidden', isHidden);
                btn.querySelector('.eye-closed')?.classList.toggle('hidden', !isHidden);
            }
        }

        function setAuthRole(role) {
            if (!['murid', 'guru'].includes(role)) {
                return;
            }

            document.getElementById('login-role').value = role;
            document.getElementById('register-role').value = role;

            document.querySelectorAll('.auth-role-choice').forEach(button => {
                button.setAttribute('aria-pressed', button.dataset.role === role ? 'true' : 'false');
            });

            // Field sekolah hanya untuk Guru
            document.getElementById('register-school-field').classList.toggle('hidden', role !== 'guru');

            // Informasi belajar mandiri hanya untuk Siswa
            document.getElementById('student-code-note').classList.toggle('hidden', role !== 'murid');
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
