<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code Pawth — Platform Belajar Pemrograman Adaptif</title>

    <!-- Google Fonts: Plus Jakarta Sans (Sesuai karakter tipografi referensi) -->
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
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#EFF6FF',
                            100: '#DBEAFE',
                            200: '#BFDBFE',
                            500: '#3B82F6',
                            600: '#2563EB',
                            700: '#1D4ED8',
                            900: '#0F172A',
                        }
                    },
                    boxShadow: {
                        'soft-blue': '0 12px 32px -8px rgba(37, 99, 235, 0.28)',
                        'card-float': '0 14px 40px -10px rgba(30, 64, 175, 0.10)',
                    }
                }
            }
        }
    </script>

    <style>
        body {
            background-color: #F9FBFF;
            color: #0F172A;
            overflow-x: hidden;
        }

        @keyframes floatSlow {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .animate-mascot {
            animation: floatSlow 4.5s ease-in-out infinite;
        }
    </style>
</head>

<body class="relative min-h-screen flex flex-col justify-between selection:bg-blue-600 selection:text-white">

    <!-- =====================================================================
         DEKORASI BACKGROUND (SVG BLOBS, SPARKLES & DOTS TANPA FILE GAMBAR)
    ====================================================================== -->
    <div class="pointer-events-none fixed inset-0 overflow-hidden z-0" aria-hidden="true">

        <!-- Blob Pojok Kanan Atas -->
        <svg class="absolute -top-10 -right-10 w-[340px] sm:w-[480px] lg:w-[600px] h-auto" viewBox="0 0 600 420"
            fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M180 -20C215 65 290 95 385 110C480 125 565 170 620 270V-20H180Z" fill="#E3EEFF"
                fill-opacity="0.85" />
            <path d="M270 -20C300 45 365 65 445 80C525 95 585 135 620 210V-20H270Z" fill="#D2E4FF" fill-opacity="0.7" />
        </svg>

        <!-- Blob Pojok Kiri Bawah -->
        <svg class="absolute -bottom-12 -left-12 w-[300px] sm:w-[440px] lg:w-[540px] h-auto" viewBox="0 0 540 320"
            fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M-20 80C65 95 110 155 175 200C240 245 320 250 390 340H-20V80Z" fill="#E3EEFF" fill-opacity="0.9" />
            <path d="M-20 145C45 155 85 205 140 240C195 275 255 280 310 340H-20V145Z" fill="#CFE1FF"
                fill-opacity="0.75" />
        </svg>

        <!-- Blob & Grid Titik Pojok Kanan Bawah -->
        <svg class="absolute -bottom-8 -right-8 w-[260px] sm:w-[360px] h-auto" viewBox="0 0 360 240" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path d="M380 40C290 60 250 125 190 165C130 205 70 215 20 260H380V40Z" fill="#E6F0FF" fill-opacity="0.85" />
            <!-- Grid Dots 5x2 -->
            <g fill="#BDD6FE">
                <circle cx="220" cy="185" r="3.5" />
                <circle cx="242" cy="185" r="3.5" />
                <circle cx="264" cy="185" r="3.5" />
                <circle cx="286" cy="185" r="3.5" />
                <circle cx="308" cy="185" r="3.5" />
                <circle cx="220" cy="205" r="3.5" />
                <circle cx="242" cy="205" r="3.5" />
                <circle cx="264" cy="205" r="3.5" />
                <circle cx="286" cy="205" r="3.5" />
                <circle cx="308" cy="205" r="3.5" />
            </g>
        </svg>

        <!-- Aksen Kilau (Sparkles) Melayang -->
        <svg class="hidden md:block absolute top-[34%] left-[49%] w-5 h-5 text-blue-400/70" viewBox="0 0 24 24"
            fill="currentColor">
            <path d="M12 1L14.5 9.5L23 12L14.5 14.5L12 23L9.5 14.5L1 12L9.5 9.5L12 1Z" />
        </svg>
        <svg class="hidden md:block absolute top-[21%] right-[7%] w-5 h-5 text-blue-400/70" viewBox="0 0 24 24"
            fill="currentColor">
            <path d="M12 1L14.5 9.5L23 12L14.5 14.5L12 23L9.5 14.5L1 12L9.5 9.5L12 1Z" />
        </svg>
        <svg class="hidden sm:block absolute bottom-[27%] left-[2.5%] w-6 h-6 text-blue-400/70" viewBox="0 0 24 24"
            fill="currentColor">
            <path d="M12 1L14.5 9.5L23 12L14.5 14.5L12 23L9.5 14.5L1 12L9.5 9.5L12 1Z" />
        </svg>
    </div>

    <!-- =====================================================================
         NAVBAR
    ====================================================================== -->
    <header class="relative z-20 w-full max-w-7xl mx-auto px-5 sm:px-8 lg:px-12 pt-5 pb-3">
        <nav class="flex items-center justify-between">

            <!-- Brand Logo: Code Pawth -->
            <a href="{{ url('/') }}" class="flex items-center gap-2.5 group">
                <div
                    class="w-10 h-10 rounded-xl bg-blue-50 border border-blue-100 flex items-center justify-center text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-200">
                    <!-- Icon Code Bracket -->
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                        stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="16 18 22 12 16 6"></polyline>
                        <polyline points="8 6 2 12 8 18"></polyline>
                        <line x1="14" y1="4" x2="10" y2="20"></line>
                    </svg>
                </div>
                <span class="text-xl sm:text-2xl font-extrabold tracking-tight text-slate-900">
                    Code<span class="text-blue-600">Pawth</span>
                </span>
            </a>

            <!-- Menu Tengah (Desktop) -->
            <div class="hidden md:flex items-center gap-9 text-[15px] font-semibold">
                <a href="{{ url('/') }}" class="relative py-2 text-blue-600 flex items-center gap-1.5">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                        <path
                            d="M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.061 1.06l8.69-8.69z" />
                        <path
                            d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.43z" />
                    </svg>
                    <span class="sr-only">Beranda</span>
                    <span class="absolute bottom-0 left-0 right-0 h-[3px] rounded-full bg-blue-600"></span>
                </a>
                <a href="#tentang" class="py-2 text-slate-600 hover:text-blue-600 transition-colors">Tentang</a>
                <a href="#jenjang-section" class="py-2 text-slate-600 hover:text-blue-600 transition-colors">Alur
                    Belajar</a>
                <a href="#bantuan" class="py-2 text-slate-600 hover:text-blue-600 transition-colors">Bantuan</a>
            </div>

            <!-- Tombol Masuk / Status Progres -->
            <div class="flex items-center gap-3">
                @auth
                    <a href="{{ url('/profile') }}"
                        class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-5 py-2.5 rounded-full shadow-soft-blue transition-all duration-200">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>{{ Auth::user()->name }}</span>
                    </a>
                @else
                    <a href=""
                        class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-6 py-2.5 rounded-full shadow-soft-blue hover:-translate-y-0.5 transition-all duration-200">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>Masuk</span>
                    </a>
                @endauth
            </div>
        </nav>
    </header>

    <!-- =====================================================================
         MAIN HERO SECTION
    ====================================================================== -->
    <main
        class="relative z-10 w-full max-w-7xl mx-auto px-5 sm:px-8 lg:px-12 pt-4 pb-10 lg:py-6 flex-1 flex flex-col justify-center">

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-6 items-center">

            <!-- Kolom Kiri: Copywriting & CTA -->
            <div class="lg:col-span-6 text-left space-y-5 sm:space-y-6">

                <!-- Pill Badge -->
                <div
                    class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-blue-100/80 border border-blue-200/60 text-blue-600 text-xs sm:text-sm font-semibold">
                    <svg class="w-4 h-4 text-blue-600 shrink-0" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2L14.2 9.8L22 12L14.2 14.2L12 22L9.8 14.2L2 12L9.8 9.8L12 2Z" />
                    </svg>
                    <span>Platform Belajar Pemrograman Adaptif</span>
                </div>

                <!-- Headline Utama dengan 3 Garis Aksen Biru -->
                <h1
                    class="text-4xl sm:text-5xl lg:text-[52px] font-extrabold text-slate-900 leading-[1.15] tracking-tight">
                    Rintis Jejak <span class="text-blue-600">Coding</span><br>
                    dengan Langkah
                    <span class="relative inline-block">
                        Seru!
                        <!-- 3 Garis Aksen Pop-out di Pojok Kanan Atas Kata Terakhir -->
                        <svg class="hidden sm:block absolute -top-5 -right-8 w-8 h-8 text-blue-600"
                            viewBox="0 0 36 36" fill="none" stroke="currentColor" stroke-width="3.5"
                            stroke-linecap="round">
                            <line x1="6" y1="14" x2="14" y2="4" />
                            <line x1="13" y1="20" x2="25" y2="11" />
                            <line x1="16" y1="28" x2="29" y2="24" />
                        </svg>
                    </span>
                </h1>

                <!-- Subheadline -->
                <p class="text-slate-600 text-base sm:text-lg leading-relaxed max-w-xl font-normal">
                    Kuasai logika pemrograman secara bertahap lewat kartu pengetahuan interaktif, penyusunan <span
                        class="font-medium text-slate-700">flowchart</span>, hingga tantangan ngoding—langsung mulai
                    tanpa perlu daftar akun.
                </p>

                <!-- Action Buttons -->
                <div class="pt-1 flex flex-wrap items-center gap-5 sm:gap-7">
                    <button type="button" onclick="openOnboardingModal()"
                        class="inline-flex items-center gap-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold text-base px-8 py-3.5 rounded-full shadow-soft-blue hover:-translate-y-0.5 transition-all duration-200 cursor-pointer">
                        <span>Mulai Belajar</span>
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </button>

                    <a href="#jenjang-section"
                        class="inline-flex items-center gap-2 text-slate-700 hover:text-blue-600 font-semibold text-base transition-colors group">
                        <span>Lihat Jenjang Belajar</span>
                        <svg class="w-4 h-4 text-blue-600 group-hover:translate-y-0.5 transition-transform"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                            stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </a>
                </div>

                <!-- Indikator Guest Progress (Muncul otomatis via JS jika user sudah pernah main) -->
                <div id="guest-progress-banner" class="hidden pt-1">
                    <div
                        class="inline-flex items-center gap-2.5 px-4 py-2 rounded-xl bg-white border border-blue-100 shadow-sm text-xs sm:text-sm text-slate-600">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span>Progres tersimpan di perangkat ini: <strong id="guest-current-stage"
                                class="text-blue-600">Jenjang SD</strong></span>
                        <a href="" class="text-blue-600 font-bold hover:underline ml-1">Simpan
                            ke Akun &rarr;</a>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Maskot Dashboard PNG -->
            <div class="lg:col-span-6 flex items-center justify-center lg:justify-end relative">
                <!-- Glow lembut di belakang maskot agar menyatu dengan background -->
                <div class="absolute w-72 h-72 sm:w-96 sm:h-96 bg-blue-200/35 rounded-full blur-3xl -z-10"></div>

                <img src="{{ asset('images/mascot_dashboard.png') }}" alt="Maskot Code Pawth"
                    class="w-full max-w-[440px] sm:max-w-[520px] lg:max-w-[570px] h-auto object-contain animate-mascot drop-shadow-[0_18px_28px_rgba(37,99,235,0.12)]">
            </div>
        </div>

        <!-- =================================================================
             BOTTOM FLOATING CARD: PILIH JENJANGMU
        ================================================================== -->
        <section id="jenjang-section" class="mt-8 lg:mt-6">
            <div
                class="bg-white/95 backdrop-blur-md rounded-2xl sm:rounded-[22px] border border-slate-100 shadow-card-float px-6 py-5 sm:px-8 sm:py-6 flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-6">

                <!-- Kiri: Judul & Deskripsi -->
                <div class="flex items-center gap-4 lg:w-[32%] shrink-0">
                    <div
                        class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                        <!-- Icon Stack Layers -->
                        <svg class="w-7 h-7" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M11.644 1.59a.75.75 0 01.712 0l9.75 5.25a.75.75 0 010 1.32l-9.75 5.25a.75.75 0 01-.712 0l-9.75-5.25a.75.75 0 010-1.32l9.75-5.25z" />
                            <path
                                d="M3.265 10.602l7.668 4.129a2.25 2.25 0 002.134 0l7.668-4.13 1.37.739a.75.75 0 010 1.32l-9.75 5.25a.75.75 0 01-.71 0l-9.75-5.25a.75.75 0 010-1.32l1.37-.738z" />
                            <path
                                d="M10.933 19.231l-7.668-4.13-1.37.739a.75.75 0 000 1.32l9.75 5.25c.224.12.486.12.71 0l9.75-5.25a.75.75 0 000-1.32l-1.37-.738-7.668 4.13a2.25 2.25 0 01-2.134-.001z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg sm:text-xl font-extrabold text-slate-900">Pilih Jenjangmu</h2>
                        <p class="text-xs sm:text-sm text-slate-500 mt-0.5">Sesuaikan jalur belajar adaptif dengan
                            levelmu</p>
                    </div>
                </div>

                <!-- Garis Pemisah Vertikal (Desktop) -->
                <div class="hidden lg:block w-px h-12 bg-slate-200/80"></div>

                <!-- Kanan: 3 Tombol Jenjang (SD, SMP, SMA) -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3.5 sm:gap-4 flex-1">

                    <!-- Jenjang SD -->
                    <a href="{{ url('/learn/sd') }}"
                        class="group flex items-center justify-between px-5 py-3.5 rounded-xl bg-slate-50/70 hover:bg-blue-50/80 border border-slate-200/80 hover:border-blue-300 transition-all duration-200">
                        <div class="flex items-center gap-3.5">
                            <div
                                class="w-9 h-9 rounded-lg bg-blue-100/70 text-blue-600 group-hover:bg-blue-600 group-hover:text-white flex items-center justify-center transition-colors">
                                <!-- Icon Buku Terbuka -->
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                                    <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                                </svg>
                            </div>
                            <div>
                                <span
                                    class="block font-bold text-slate-800 group-hover:text-blue-700 text-base">SD</span>
                                <span class="block text-[11px] text-slate-500">Dasar & Kartu Kode</span>
                            </div>
                        </div>
                        <svg class="w-4 h-4 text-blue-500 group-hover:translate-x-1 transition-transform"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                            stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </a>

                    <!-- Jenjang SMP -->
                    <a href="{{ url('/learn/smp') }}"
                        class="group flex items-center justify-between px-5 py-3.5 rounded-xl bg-slate-50/70 hover:bg-blue-50/80 border border-slate-200/80 hover:border-blue-300 transition-all duration-200">
                        <div class="flex items-center gap-3.5">
                            <div
                                class="w-9 h-9 rounded-lg bg-blue-100/70 text-blue-600 group-hover:bg-blue-600 group-hover:text-white flex items-center justify-center transition-colors">
                                <!-- Icon Topi Toga / Akademik -->
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M11.7 2.805a.75.75 0 01.6 0A60.65 60.65 0 0122.83 8.72a.75.75 0 01-.231 1.337 49.949 49.949 0 00-9.902 3.912l-.003.002-.34.18a.75.75 0 01-.707 0A50.009 50.009 0 007.5 12.174v-.224c0-.131.067-.248.172-.311a54.614 54.614 0 014.653-2.52.75.75 0 00-.65-1.352 56.129 56.129 0 00-4.78 2.589 1.858 1.858 0 00-.859 1.228 49.803 49.803 0 00-4.634-1.527.75.75 0 01-.231-1.337A60.653 60.653 0 0111.7 2.805z" />
                                    <path
                                        d="M13.06 15.473a48.45 48.45 0 017.666-3.282c.134 1.414.22 2.843.255 4.285a.75.75 0 01-.46.71 47.878 47.878 0 00-8.105 4.342.75.75 0 01-.832 0 47.877 47.877 0 00-8.104-4.342.75.75 0 01-.461-.71c.035-1.442.121-2.87.255-4.286A48.4 48.4 0 016 13.18v1.27a1.5 1.5 0 00-.14 2.508c-.09.38-.222.753-.397 1.11.452.213.901.434 1.346.661a6.729 6.729 0 00.551-1.608 1.5 1.5 0 00.14-2.67v-.645a48.549 48.549 0 013.44 1.668 2.25 2.25 0 002.12 0z" />
                                </svg>
                            </div>
                            <div>
                                <span
                                    class="block font-bold text-slate-800 group-hover:text-blue-700 text-base">SMP</span>
                                <span class="block text-[11px] text-slate-500">Logika Flowchart</span>
                            </div>
                        </div>
                        <svg class="w-4 h-4 text-blue-500 group-hover:translate-x-1 transition-transform"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                            stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </a>

                    <!-- Jenjang SMA -->
                    <a href="{{ url('/learn/sma') }}"
                        class="group flex items-center justify-between px-5 py-3.5 rounded-xl bg-slate-50/70 hover:bg-blue-50/80 border border-slate-200/80 hover:border-blue-300 transition-all duration-200">
                        <div class="flex items-center gap-3.5">
                            <div
                                class="w-9 h-9 rounded-lg bg-blue-100/70 text-blue-600 group-hover:bg-blue-600 group-hover:text-white flex items-center justify-center transition-colors">
                                <!-- Icon Bintang -->
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div>
                                <span
                                    class="block font-bold text-slate-800 group-hover:text-blue-700 text-base">SMA</span>
                                <span class="block text-[11px] text-slate-500">Praktik Ngoding</span>
                            </div>
                        </div>
                        <svg class="w-4 h-4 text-blue-500 group-hover:translate-x-1 transition-transform"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                            stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </a>

                </div>
            </div>
        </section>
    </main>

    <!-- =====================================================================
         MODAL SMART ONBOARDING ("BARU DI PEMROGRAMAN?")
    ====================================================================== -->
    <div id="onboarding-modal"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/40 backdrop-blur-xs p-4">
        <div
            class="bg-white rounded-3xl max-w-md w-full p-6 sm:p-7 shadow-2xl border border-slate-100 transform transition-all">
            <div class="flex items-center justify-between mb-4">
                <span
                    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-50 text-blue-600 text-xs font-bold">
                    🐾 Mulai Petualanganmu
                </span>
                <button type="button" onclick="closeOnboardingModal()"
                    class="text-slate-400 hover:text-slate-600 p-1 rounded-lg cursor-pointer">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>

            <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900">Baru di dunia pemrograman?</h3>
            <p class="text-sm text-slate-600 mt-2 leading-relaxed">
                Kami akan menyesuaikan titik mulai belajarmu. Tidak perlu daftar akun sekarang—progresmu otomatis
                tersimpan!
            </p>

            <div class="mt-6 space-y-3">
                <!-- Pilihan 1: Baru belajar -> Langsung ke Level SD -->
                <a href="{{ url('/learn/sd') }}"
                    class="flex items-center justify-between w-full p-4 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white shadow-soft-blue transition-all group">
                    <div>
                        <span class="block font-bold text-base">Ya, saya baru mulai!</span>
                        <span class="block text-xs text-blue-100 mt-0.5">Mulai dari Jenjang SD (Pengenalan Python, C++,
                            Java)</span>
                    </div>
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform shrink-0" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2.5">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </a>

                <!-- Pilihan 2: Sudah pernah belajar -> Pilih Jenjang -->
                <button type="button"
                    onclick="closeOnboardingModal(); document.getElementById('jenjang-section').scrollIntoView({behavior: 'smooth'});"
                    class="flex items-center justify-between w-full p-4 rounded-2xl bg-slate-50 hover:bg-blue-50/70 border border-slate-200 hover:border-blue-300 text-left transition-all group cursor-pointer">
                    <div>
                        <span class="block font-bold text-slate-800 group-hover:text-blue-700 text-base">Sudah pernah
                            belajar dasar</span>
                        <span class="block text-xs text-slate-500 mt-0.5">Pilih langsung ke Jenjang SMP atau SMA</span>
                    </div>
                    <svg class="w-5 h-5 text-slate-400 group-hover:text-blue-600 group-hover:translate-x-1 transition-all shrink-0"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- =====================================================================
         VANILLA JS: MODAL & DETEKSI PROGRES GUEST (LOCALSTORAGE)
    ====================================================================== -->
    <script>
        const modal = document.getElementById('onboarding-modal');

        function openOnboardingModal() {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeOnboardingModal() {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // Tutup modal jika klik area gelap di luar box
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                closeOnboardingModal();
            }
        });

        // Cek apakah user sudah punya progres tersimpan di localStorage
        document.addEventListener('DOMContentLoaded', () => {
            try {
                const savedProgress = JSON.parse(localStorage.getItem('codepawth_progress'));
                if (savedProgress && savedProgress.currentLevel) {
                    const banner = document.getElementById('guest-progress-banner');
                    const stageLabel = document.getElementById('guest-current-stage');
                    stageLabel.textContent = savedProgress.currentLevel;
                    banner.classList.remove('hidden');
                }
            } catch (err) {
                console.warn('Gagal membaca progres lokal:', err);
            }
        });
    </script>
</body>

</html>
