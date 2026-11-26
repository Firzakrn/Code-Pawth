@extends('layouts.app')

@section('title', 'Peta Level — Code Pawth')

@push('styles')
    <style>
        @keyframes peekFloat {

            0%,
            100% {
                transform: translate(-50%, 0px);
            }

            50% {
                transform: translate(-50%, -4px);
            }
        }

        .animate-peek-top {
            animation: peekFloat 2.6s ease-in-out infinite;
        }

        @keyframes runStep {

            0%,
            100% {
                transform: translateY(0px) rotate(-3deg);
            }

            50% {
                transform: translateY(-6px) rotate(3deg);
            }
        }

        .animate-run-step {
            animation: runStep 0.26s ease-in-out infinite;
        }

        .pedestal-active {
            background: linear-gradient(180deg, #60A5FA 0%, #2563EB 100%);
            box-shadow: 0 8px 0 #1D4ED8, 0 15px 22px rgba(37, 99, 235, 0.32);
        }

        .pedestal-done {
            background: linear-gradient(180deg, #3B82F6 0%, #1D4ED8 100%);
            box-shadow: 0 8px 0 #1E40AF, 0 14px 20px rgba(30, 64, 175, 0.24);
        }

        .pedestal-locked {
            background: linear-gradient(180deg, #CBD5E1 0%, #94A3B8 100%);
            box-shadow: 0 8px 0 #64748B, 0 12px 18px rgba(100, 116, 139, 0.18);
        }
    </style>
@endpush

@section('content')
    @php
        $initialJenjang = strtoupper(request('jenjang', 'SD'));
        $initialLevels = $demoLevels[$initialJenjang] ?? [];
    @endphp

    <!-- Definisi SVG Paw Print Biru Natural -->
    <svg class="hidden" aria-hidden="true">
        <defs>
            <g id="natural-blue-paw">
                <path
                    d="M50 56C37 56 28 65 28 74C28 81 34 85 41 84C45 83.5 47.5 82.5 50 82.5C52.5 82.5 55 83.5 59 84C66 85 72 81 72 74C72 65 63 56 50 56Z"
                    fill="currentColor" />
                <ellipse cx="23" cy="51" rx="7.5" ry="10.5" transform="rotate(-24 23 51)"
                    fill="currentColor" />
                <ellipse cx="39" cy="39" rx="8" ry="11.5" transform="rotate(-9 39 39)"
                    fill="currentColor" />
                <ellipse cx="61" cy="39" rx="8" ry="11.5" transform="rotate(9 61 39)"
                    fill="currentColor" />
                <ellipse cx="77" cy="51" rx="7.5" ry="10.5" transform="rotate(24 77 51)"
                    fill="currentColor" />
            </g>
        </defs>
    </svg>

    <!-- DEKORASI BLOB MEMBENTUK AWAN DI BACKGROUND UTAMA -->
    <div class="pointer-events-none absolute inset-0 overflow-hidden z-0" aria-hidden="true">
        <div class="absolute -top-12 left-20 w-64 h-64 rounded-full bg-white/55"></div>
        <div class="absolute top-4 left-60 w-44 h-44 rounded-full bg-blue-200/35"></div>
        <div class="absolute -top-6 left-[42%] w-36 h-36 rounded-full bg-white/45"></div>

        <!-- Gugusan Blob Awan Kanan Atas -->
        <svg class="absolute -top-6 -right-10 w-[400px] sm:w-[500px] h-auto" viewBox="0 0 560 300" fill="none">
            <circle cx="430" cy="70" r="145" fill="#DCEAFF" fill-opacity="0.75" />
            <circle cx="310" cy="115" r="95" fill="#E3EFFF" fill-opacity="0.8" />
            <circle cx="515" cy="165" r="115" fill="#D5E5FF" fill-opacity="0.7" />
            <path
                d="M230 230C260 175 320 155 375 170C410 130 480 125 530 165C565 190 580 230 570 265H215C215 250 220 240 230 230Z"
                fill="#CFE1FF" fill-opacity="0.65" />
        </svg>

        <!-- Gugusan Awan Bulat Pojok Kiri Bawah -->
        <svg class="absolute -bottom-8 -left-10 w-[380px] h-auto" viewBox="0 0 420 220" fill="none">
            <circle cx="60" cy="185" r="110" fill="#D7E7FF" fill-opacity="0.8" />
            <circle cx="175" cy="200" r="95" fill="#E2EEFF" fill-opacity="0.85" />
            <circle cx="280" cy="215" r="80" fill="#D7E7FF" fill-opacity="0.7" />
        </svg>

        <!-- Gugusan Awan Bulat Pojok Kanan Bawah -->
        <svg class="absolute -bottom-8 -right-8 w-[380px] h-auto" viewBox="0 0 420 220" fill="none">
            <circle cx="360" cy="180" r="115" fill="#D7E7FF" fill-opacity="0.8" />
            <circle cx="240" cy="198" r="95" fill="#E2EEFF" fill-opacity="0.85" />
            <circle cx="135" cy="215" r="75" fill="#D7E7FF" fill-opacity="0.7" />
        </svg>

        <svg class="hidden md:block absolute top-10 left-[48%] w-5 h-5 text-blue-300" viewBox="0 0 24 24"
            fill="currentColor">
            <path d="M12 1L14.5 9.5L23 12L14.5 14.5L12 23L9.5 14.5L1 12L9.5 9.5L12 1Z" />
        </svg>
    </div>

    <!-- Top Navigation Bar -->
    <header class="relative z-10 px-5 sm:px-7 pt-3.5 pb-1 flex items-center justify-between shrink-0">
        <!-- User / Guest Status -->
        <div class="flex items-center gap-2.5">
            @if ($canSaveProgress ?? false)
                <span
                    class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/90 border border-blue-100 text-xs font-semibold text-slate-600 shadow-2xs">
                    <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                    {{ Auth::user()->name }}
                </span>
            @else
                <span
                    class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/90 border border-blue-100 text-xs font-semibold text-slate-600 shadow-2xs">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    Mode Tamu Aktif
                </span>
                <a href="{{ route('login') }}"
                    class="inline-flex items-center gap-1.5 bg-white hover:bg-blue-50 text-blue-600 border border-blue-200/80 text-xs font-bold px-3.5 py-1.5 rounded-full shadow-2xs transition-colors">
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>Simpan Akun</span>
                </a>
            @endif
        </div>
    </header>

    <!-- Main Container -->
    <main class="relative z-10 flex-1 min-h-0 flex flex-col px-5 sm:px-7 pb-4 max-w-6xl w-full mx-auto gap-3">

        <!-- Banner Header Jenjang + Mascot Kanan Atas -->
        <div class="relative flex flex-col md:flex-row md:items-center justify-between gap-3 shrink-0 z-30">

            <!-- Kartu Jenjang + Dropdown Ganti Jenjang -->
            <div id="jenjang-dropdown-wrapper" class="relative max-w-md w-full z-30">
                <button type="button" id="jenjang-dropdown-trigger" onclick="toggleJenjangDropdown()"
                    aria-expanded="false" aria-haspopup="listbox"
                    class="w-full text-left bg-white/95 hover:bg-white backdrop-blur-xs rounded-2xl border border-white hover:border-blue-200 shadow-soft-card px-4 py-2.5 flex items-center gap-3.5 transition-all cursor-pointer">
                    <div
                        class="w-11 h-11 rounded-xl bg-blue-50 border border-blue-100 flex items-center justify-center overflow-hidden shrink-0">
                        <img src="{{ asset('images/mascot_class.png') }}" alt="Avatar Jenjang"
                            class="w-10 h-10 object-contain">
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2">
                            <h1 id="banner-jenjang-title" class="text-lg sm:text-xl font-extrabold text-slate-900">
                                {{ $initialJenjang }}</h1>
                            <span id="banner-level-count"
                                class="px-2 py-0.5 rounded-full bg-blue-100 text-blue-700 text-[10px] font-bold">
                                {{ count($initialLevels) }} Level
                            </span>
                        </div>
                        <p id="banner-jenjang-subtitle" class="text-xs text-slate-500 truncate">
                            {{ count($initialLevels) }} level materi demo tersedia.
                        </p>
                    </div>
                    <span
                        class="p-1.5 rounded-lg text-slate-400 group-hover:text-blue-600 hover:bg-blue-50 transition-colors">
                        <svg id="jenjang-dropdown-chevron" class="w-4 h-4 transition-transform duration-200"
                            fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </span>
                </button>

                <!-- Menu Dropdown Jenjang -->
                <div id="jenjang-dropdown-menu" role="listbox"
                    class="hidden absolute left-0 right-0 mt-2 bg-white rounded-2xl border border-blue-100 shadow-xl p-1.5 z-50 space-y-1">
                    @php
                        $jenjangMeta = [
                            'SD' => 'Dasar Logika & Konsep Pemrograman',
                            'SMP' => 'Algoritma, Flowchart & Dasar Kode',
                            'SMA' => 'Flowchart ke Pemrograman Python',
                        ];
                    @endphp
                    @foreach (['SD', 'SMP', 'SMA'] as $jKey)
                        @php
                            $jCount = count($demoLevels[$jKey] ?? []);
                        @endphp
                        <button type="button" role="option" data-jenjang-option="{{ $jKey }}"
                            onclick="selectJenjangFromDropdown('{{ $jKey }}')"
                            class="jenjang-option-btn w-full text-left px-3.5 py-2.5 rounded-xl flex items-center justify-between gap-3 transition-colors cursor-pointer hover:bg-blue-50/80 text-slate-700">
                            <div class="min-w-0">
                                <div class="flex items-center gap-2">
                                    <span class="font-extrabold text-sm">{{ $jKey }}</span>
                                    <span
                                        class="px-2 py-0.5 rounded-full bg-slate-100 text-slate-600 text-[10px] font-bold jenjang-option-badge">
                                        {{ $jCount }} Level
                                    </span>
                                </div>
                                <p class="text-[11px] text-slate-500 truncate">{{ $jenjangMeta[$jKey] }}</p>
                            </div>
                            <svg class="w-4 h-4 text-blue-600 shrink-0 hidden jenjang-option-check" viewBox="0 0 24 24"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Speech Bubble & Maskot Kanan Atas -->
            <div class="hidden md:flex items-center gap-2.5 self-end z-10">
                <div
                    class="bg-white/95 px-3.5 py-2 rounded-2xl rounded-br-xs shadow-soft-card border border-blue-100 text-xs sm:text-sm font-bold text-slate-700">
                    Ayo selesaikan semua levelnya! <span class="text-amber-400">★</span>
                </div>
                <img src="{{ asset('images/mascot_cheers.png') }}" alt="Maskot Penyemangat"
                    class="w-28 h-24 object-contain object-bottom drop-shadow-xs">
            </div>
        </div>

        <!-- Bar Progres & Bintang -->
        <div
            class="relative z-20 bg-white/95 backdrop-blur-xs rounded-2xl border border-white shadow-soft-card px-5 py-2.5 sm:px-6 flex flex-col md:flex-row items-stretch md:items-center justify-between gap-3 shrink-0">

            <div class="flex items-center gap-5 sm:gap-7">
                <!-- Total Bintang -->
                <div class="flex items-center gap-2.5">
                    <div class="w-9 h-9 rounded-xl bg-amber-50 flex items-center justify-center text-amber-400">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-sm sm:text-base font-extrabold text-slate-900 leading-tight">
                            <span id="total-stars">0</span> / <span id="max-stars">{{ count($initialLevels) * 3 }}</span>
                        </div>
                        <div class="text-[11px] text-slate-500 font-medium">Total Bintang</div>
                    </div>
                </div>

                <div class="w-px h-7 bg-slate-200"></div>

                <!-- Level Saat Ini -->
                <div class="flex items-center gap-2.5">
                    <div class="w-9 h-9 rounded-xl bg-amber-50 flex items-center justify-center text-amber-500">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.166 2.621v.858c-1.035.148-2.059.33-3.071.543a.75.75 0 00-.584.859 6.753 6.753 0 006.138 5.6 6.73 6.73 0 002.743 1.346A6.707 6.707 0 019.279 15H8.54c-1.036 0-1.875.84-1.875 1.875V19.5h-.75a2.25 2.25 0 00-2.25 2.25c0 .414.336.75.75.75h15a.75.75 0 00.75-.75 2.25 2.25 0 00-2.25-2.25h-.75v-2.625c0-1.036-.84-1.875-1.875-1.875h-.739a6.706 6.706 0 01-1.112-3.173 6.73 6.73 0 002.743-1.347 6.753 6.753 0 006.139-5.6.75.75 0 00-.585-.858 47.077 47.077 0 00-3.07-.543V2.62a.75.75 0 00-.658-.744 49.22 49.22 0 00-6.093-.377c-2.063 0-4.096.128-6.093.377a.75.75 0 00-.657.744zm0 2.629c0 1.196.312 2.32.857 3.294A5.266 5.266 0 013.16 5.337a45.6 45.6 0 012.006-.343v.256zm13.5 0v-.256c.674.1 1.343.214 2.006.343a5.265 5.265 0 01-2.863 3.207 6.72 6.72 0 00.857-3.294z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <div id="active-level-title"
                            class="text-sm sm:text-base font-extrabold text-slate-900 leading-tight">Level 1</div>
                        <div class="text-[11px] text-slate-500 font-medium">Penjelajah Pemula</div>
                    </div>
                </div>
            </div>

            <!-- Progress Bar Horizontal -->
            <div class="flex items-center gap-3 flex-1 md:max-w-md">
                <div class="flex-1 h-3 bg-slate-100 rounded-full overflow-hidden p-0.5 border border-slate-200/60">
                    <div id="progress-bar-fill"
                        class="h-full bg-gradient-to-r from-blue-500 to-blue-600 rounded-full transition-all duration-500"
                        style="width: 0%;"></div>
                </div>
                <span id="progress-percent"
                    class="text-xs sm:text-sm font-extrabold text-slate-700 w-10 text-right">0%</span>
            </div>
        </div>

        <!-- KANVAS PETA LEVEL DINAMIS -->
        <div
            class="flex-1 min-h-[340px] lg:min-h-0 flex flex-col relative bg-gradient-to-b from-[#EAF2FF] via-[#E5F0FF] to-[#DCEBFF] rounded-3xl border-2 border-white shadow-soft-card p-4 sm:p-5 overflow-hidden select-none">

            <!-- Corak Awan & Paw Print Biru Besar Natural -->
            <div class="pointer-events-none absolute inset-0 overflow-hidden z-0" aria-hidden="true">
                <svg class="absolute -top-6 -left-6 w-60 h-32 text-white/60" viewBox="0 0 260 140" fill="currentColor">
                    <circle cx="40" cy="30" r="55" />
                    <circle cx="105" cy="20" r="45" />
                    <circle cx="165" cy="10" r="35" />
                </svg>

                <svg class="absolute -top-6 -right-6 w-64 h-32 text-white/55" viewBox="0 0 280 140" fill="currentColor">
                    <circle cx="240" cy="25" r="60" />
                    <circle cx="170" cy="15" r="45" />
                    <circle cx="110" cy="5" r="32" />
                </svg>

                <!-- Paw Print Biru Besar -->
                <svg class="absolute top-12 left-5 w-16 h-16 sm:w-20 sm:h-20 text-blue-300/45 -rotate-[22deg]"
                    viewBox="0 0 100 100">
                    <use href="#natural-blue-paw" />
                </svg>
                <svg class="absolute bottom-10 left-12 w-20 h-20 sm:w-24 sm:h-24 text-blue-300/50 rotate-[18deg]"
                    viewBox="0 0 100 100">
                    <use href="#natural-blue-paw" />
                </svg>
                <svg class="absolute top-10 right-[31%] w-16 h-16 sm:w-20 sm:h-20 text-blue-300/45 rotate-[25deg]"
                    viewBox="0 0 100 100">
                    <use href="#natural-blue-paw" />
                </svg>
                <svg class="absolute bottom-10 right-36 w-20 h-20 sm:w-24 sm:h-24 text-blue-300/50 -rotate-[16deg]"
                    viewBox="0 0 100 100">
                    <use href="#natural-blue-paw" />
                </svg>

                <!-- Awan Berlapis Bawah -->
                <svg class="absolute bottom-0 left-0 w-full h-24 text-white/50" viewBox="0 0 1200 150"
                    preserveAspectRatio="none" fill="currentColor">
                    <circle cx="60" cy="135" r="75" />
                    <circle cx="170" cy="145" r="65" />
                    <circle cx="290" cy="130" r="80" />
                    <circle cx="430" cy="148" r="60" />
                    <circle cx="570" cy="132" r="85" />
                    <circle cx="720" cy="145" r="70" />
                    <circle cx="860" cy="128" r="82" />
                    <circle cx="1010" cy="142" r="68" />
                    <circle cx="1140" cy="130" r="80" />
                </svg>
                <svg class="absolute -bottom-1 left-0 w-full h-14 text-white/75" viewBox="0 0 1200 100"
                    preserveAspectRatio="none" fill="currentColor">
                    <path
                        d="M0,45 C140,95 280,10 430,55 C580,100 720,15 880,55 C1020,90 1120,25 1200,50 L1200,100 L0,100 Z" />
                </svg>
            </div>

            <!-- Container Peta Level -->
            <div id="level-map-area" class="relative w-full flex-1 min-h-0">

                <!-- Garis Jalur SVG Dinamis -->
                <svg id="dynamic-path-svg" class="absolute inset-0 w-full h-full pointer-events-none z-0"
                    viewBox="0 0 1000 360" preserveAspectRatio="none">
                    <path id="path-base" d="" fill="none" stroke="#B8D4FE" stroke-width="10"
                        stroke-linecap="round" />
                    <path id="path-dash" d="" fill="none" stroke="#FFFFFF" stroke-width="3" stroke-dasharray="10 10"
                        stroke-linecap="round" />
                </svg>

                <!-- SPRITE MASKOT BERLARI -->
                <div id="running-mascot-wrapper"
                    class="hidden absolute z-30 pointer-events-none -translate-x-1/2 -translate-y-1/2">
                    <img id="running-mascot-img" src="{{ asset('images/mascot_run.png') }}" alt="Maskot Berlari"
                        class="w-16 h-16 sm:w-20 sm:h-20 object-contain animate-run-step drop-shadow-md transition-transform duration-200">
                </div>

                <!-- TEMPAT RENDER BULATAN LEVEL -->
                <div id="levels-container" class="relative w-full h-full z-10"></div>

                <!-- PETI HARTA KARUN (SELESAI!) DI POJOK KANAN BAWAH -->
                <div id="level-map-finish"
                    class="hidden absolute right-2 sm:right-4 bottom-0 sm:bottom-1 flex flex-col items-center z-10 pointer-events-none">
                    <div
                        class="w-14 h-14 sm:w-16 sm:h-16 rounded-2xl bg-amber-100/85 border-2 border-amber-300 flex items-center justify-center shadow-sm">
                        <svg class="w-9 h-9 sm:w-10 sm:h-10" viewBox="0 0 64 64" fill="none">
                            <rect x="10" y="24" width="44" height="28" rx="5" fill="#2563EB"
                                stroke="#1E3A8A" stroke-width="3" />
                            <path d="M10 26C10 18 16 14 32 14C48 14 54 18 54 26H10Z" fill="#3B82F6" stroke="#1E3A8A"
                                stroke-width="3" />
                            <rect x="16" y="14" width="6" height="38" fill="#FBBF24" />
                            <rect x="42" y="14" width="6" height="38" fill="#FBBF24" />
                            <rect x="27" y="24" width="10" height="12" rx="3" fill="#FBBF24"
                                stroke="#B45309" stroke-width="2.5" />
                            <circle cx="32" cy="30" r="2" fill="#78350F" />
                        </svg>
                    </div>
                    <span
                        class="-mt-1.5 px-3 py-0.5 rounded-full bg-blue-600 text-white text-[11px] font-extrabold shadow-xs">
                        Selesai!
                    </span>
                </div>

            </div>
        </div>
    </main>

    <!-- =====================================================================
             SLIDE-OVER DRAWER DARI KANAN (DETAIL INFO LEVEL, PROGRES & NILAI)
        ====================================================================== -->
    <div id="drawer-backdrop" onclick="closeLevelDrawer()"
        class="fixed inset-0 bg-slate-900/30 backdrop-blur-[2px] z-40 hidden opacity-0 transition-opacity duration-300">
    </div>

    <aside id="level-drawer"
        class="fixed top-0 right-0 h-full w-full max-w-md bg-white shadow-2xl border-l border-slate-100 z-50 transform translate-x-full transition-transform duration-300 ease-out flex flex-col justify-between">

        <div class="p-6 overflow-y-auto space-y-5">

            <!-- Top Bar Drawer -->
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span id="drawer-level-badge"
                        class="px-3 py-1 rounded-full bg-blue-50 text-blue-600 text-xs font-extrabold tracking-wide">
                        Pilih level
                    </span>
                    <span id="drawer-status-badge"
                        class="px-3 py-1 rounded-full bg-emerald-50 text-emerald-600 text-xs font-bold">
                        -
                    </span>
                </div>

                <button type="button" onclick="closeLevelDrawer()"
                    class="w-9 h-9 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 flex items-center justify-center transition-colors cursor-pointer">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Header Materi + Maskot -->
            <div
                class="flex items-start gap-4 bg-gradient-to-r from-blue-50/90 to-indigo-50/60 p-4 rounded-2xl border border-blue-100">
                <img src="{{ asset('images/mascot_what.png') }}" alt="Maskot Level"
                    class="w-14 h-14 object-contain shrink-0">
                <div>
                    <span id="drawer-language-tag"
                        class="text-[11px] font-bold uppercase tracking-wider text-blue-600">Modul</span>
                    <h2 id="drawer-title" class="text-lg font-extrabold text-slate-900 mt-0.5 leading-snug">
                        Judul Level
                    </h2>
                </div>
            </div>

            <!-- Penjelasan Topik Pembahasan -->
            <div>
                <h3 class="text-xs font-extrabold uppercase tracking-wider text-slate-400 mb-2">Apa yang Dibahas di Level
                    Ini?</h3>
                <p id="drawer-description" class="text-sm text-slate-600 leading-relaxed"></p>
                <ul id="drawer-topics" class="mt-3 space-y-2 text-sm text-slate-700"></ul>
            </div>

            <!-- Kartu Statistik Nilai & Progres -->
            <div class="bg-slate-50 rounded-2xl p-4 border border-slate-200/80 space-y-3.5">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-extrabold uppercase tracking-wider text-slate-500">Progres & Evaluasi</span>
                    <span class="text-xs font-bold text-blue-600">Syarat Lulus: ≥ 80%</span>
                </div>

                <div class="grid grid-cols-3 gap-2.5 text-center">
                    <div class="bg-white p-2.5 rounded-xl border border-slate-100 shadow-2xs">
                        <span class="block text-[11px] text-slate-400 font-semibold">Nilai Terbaik</span>
                        <span id="drawer-score" class="block text-lg font-extrabold text-slate-900 mt-0.5">-</span>
                    </div>
                    <div class="bg-white p-2.5 rounded-xl border border-slate-100 shadow-2xs">
                        <span class="block text-[11px] text-slate-400 font-semibold">Bintang</span>
                        <span id="drawer-stars" class="block text-base font-extrabold text-amber-400 mt-0.5">☆☆☆</span>
                    </div>
                    <div class="bg-white p-2.5 rounded-xl border border-slate-100 shadow-2xs">
                        <span class="block text-[11px] text-slate-400 font-semibold">Progres</span>
                        <span id="drawer-progress-text"
                            class="block text-lg font-extrabold text-blue-600 mt-0.5">0%</span>
                    </div>
                </div>

                <div>
                    <div class="flex justify-between text-xs font-semibold text-slate-500 mb-1.5">
                        <span>Ketuntasan Kartu & Kuis</span>
                        <span id="drawer-cards-count">-</span>
                    </div>
                    <div class="w-full h-2.5 bg-slate-200/80 rounded-full overflow-hidden">
                        <div id="drawer-progress-bar" class="h-full bg-blue-600 rounded-full transition-all duration-300"
                            style="width: 0%;"></div>
                    </div>
                </div>

                <div class="flex items-start gap-2 bg-white p-3 rounded-xl border border-blue-100 text-xs text-slate-600">
                    <span class="text-blue-600 font-bold shrink-0">Sistem Adaptif:</span>
                    <span id="drawer-adaptive-note"></span>
                </div>
            </div>
        </div>

        <!-- Footer Tombol Aksi Drawer -->
        <div class="p-5 border-t border-slate-100 bg-slate-50/70">
            <a id="drawer-cta-btn" href="#"
                class="w-full inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-bold text-base py-3 px-6 rounded-2xl shadow-soft-blue transition-all">
                <span id="drawer-cta-text">Mulai Belajar</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                </svg>
            </a>
        </div>
    </aside>
@endsection

@push('scripts')
    <script>
        const serverProgress = @json($serverProgress ?? []);
        const canSaveProgress = @json($canSaveProgress ?? false);

        const demoLevels = @json($demoLevels ?? []);

        const urlParams = new URLSearchParams(window.location.search);
        const initialUrlJenjang = (urlParams.get('jenjang') || '').toUpperCase();
        const initialUrlLevel = Number(urlParams.get('level') || 0);
        let hasConsumedUrlLevel = false;

        let activeJenjang = initialUrlJenjang || 'SD';
        if (!demoLevels[activeJenjang]?.length) {
            activeJenjang = Object.keys(demoLevels).find(jenjang => demoLevels[jenjang].length > 0) || 'SD';
        }

        let levelsData = [];
        let currentMascotLevel = 1;
        let isMascotRunning = false;

        // =====================================================================
        // DROPDOWN JENJANG DI KARTU HEADER
        // =====================================================================
        function toggleJenjangDropdown(forceState) {
            const menu = document.getElementById('jenjang-dropdown-menu');
            const trigger = document.getElementById('jenjang-dropdown-trigger');
            const chevron = document.getElementById('jenjang-dropdown-chevron');
            if (!menu || !trigger) return;

            const shouldOpen = typeof forceState === 'boolean' ? forceState : menu.classList.contains('hidden');
            menu.classList.toggle('hidden', !shouldOpen);
            trigger.setAttribute('aria-expanded', String(shouldOpen));
            if (chevron) chevron.classList.toggle('rotate-180', shouldOpen);
        }

        function selectJenjangFromDropdown(jenjang) {
            toggleJenjangDropdown(false);
            switchJenjang(jenjang);

            // Perbarui query parameter ?jenjang= di URL tanpa reload halaman
            const nextUrl = new URL(window.location.href);
            nextUrl.searchParams.set('jenjang', jenjang);
            window.history.replaceState({}, '', nextUrl.toString());
        }

        document.addEventListener('click', (event) => {
            const wrapper = document.getElementById('jenjang-dropdown-wrapper');
            if (wrapper && !wrapper.contains(event.target)) {
                toggleJenjangDropdown(false);
            }
        });

        // =====================================================================
        // BACA PROGRES MODE TAMU DARI LOCALSTORAGE
        // =====================================================================
        function getGuestLocalProgress(jenjang) {
            const jUpper = String(jenjang).toUpperCase();
            const jLower = String(jenjang).toLowerCase();
            const resultMap = new Map();

            const registerEntry = (lvlId, rawObj) => {
                const idNum = Number(lvlId);
                if (!Number.isFinite(idNum) || idNum <= 0 || !rawObj || typeof rawObj !== 'object') return;

                const score = Number(rawObj.score ?? rawObj.bestScore ?? rawObj.nilai ?? 0);
                const stars = Number(rawObj.stars ?? rawObj.bintang ?? (score >= 95 ? 3 : (score >= 80 ? 2 : 0)));
                const isDone = Boolean(
                    rawObj.completed ||
                    rawObj.done ||
                    rawObj.status === 'done' ||
                    score >= 80 ||
                    stars >= 2
                );

                if (isDone) {
                    const prev = resultMap.get(idNum);
                    resultMap.set(idNum, {
                        jenjang: jUpper,
                        level_id: idNum,
                        score: Math.max(prev?.score ?? 0, score || 80),
                        stars: Math.max(prev?.stars ?? 0, stars || 2),
                    });
                }
            };

            // 1. Cek format objek terpusat (misal: codepawth_guest_progress / codepawth_progress)
            const candidateStoreKeys = [
                'codepawth_guest_progress',
                'codepawth_progress',
                'codepawth_demo_progress',
            ];

            for (const storeKey of candidateStoreKeys) {
                try {
                    const raw = localStorage.getItem(storeKey);
                    if (!raw) continue;
                    const parsed = JSON.parse(raw);
                    if (!parsed || typeof parsed !== 'object') continue;

                    if (Array.isArray(parsed)) {
                        parsed.forEach(item => {
                            if (String(item?.jenjang || '').toUpperCase() === jUpper) {
                                registerEntry(item.level_id ?? item.levelId ?? item.level, item);
                            }
                        });
                    } else {
                        // Bentuk { SD: { "1": { score, stars, completed } } }
                        const byJenjang = parsed[jUpper] ?? parsed[jLower];
                        if (byJenjang && typeof byJenjang === 'object') {
                            Object.entries(byJenjang).forEach(([lvlKey, val]) => {
                                registerEntry(lvlKey, val);
                            });
                        }
                        // Bentuk { "SD-1": { ... } } atau { "SD_1": { ... } }
                        Object.entries(parsed).forEach(([k, val]) => {
                            const match = k.match(new RegExp(`^${jUpper}[-_](\\d+)$`, 'i'));
                            if (match) registerEntry(match[1], val);
                        });
                    }
                } catch (_) {
                    // Abaikan JSON tidak valid
                }
            }

            // 2. Cek format per-level key (misal: codepawth_progress_SD_1, codepawth_eval_SD_1, dll.)
            for (let i = 0; i < localStorage.length; i++) {
                const key = localStorage.key(i);
                if (!key) continue;
                const match = key.match(new RegExp(`codepawth.*${jUpper}[-_](\\d+)`, 'i'));
                if (!match) continue;

                try {
                    const raw = localStorage.getItem(key);
                    const parsed = JSON.parse(raw);
                    if (parsed && typeof parsed === 'object') {
                        registerEntry(match[1], parsed);
                    } else if (raw === 'true' || raw === 'done' || Number(raw) >= 80) {
                        const numScore = Number(raw) >= 80 ? Number(raw) : 80;
                        registerEntry(match[1], {
                            score: numScore,
                            completed: true
                        });
                    }
                } catch (_) {
                    const raw = localStorage.getItem(key);
                    if (raw === 'true' || raw === 'done') {
                        registerEntry(match[1], {
                            score: 80,
                            completed: true
                        });
                    }
                }
            }

            return Array.from(resultMap.values());
        }

        // Hitung koordinat berkelok secara otomatis berdasarkan jumlah level
        function assignDynamicCoordinates(rawLevels) {
            const count = rawLevels.length;
            return rawLevels.map((lvl, idx) => {
                let x = 50;
                let y = 50;

                if (count === 1) {
                    x = 48;
                    y = 52;
                } else {
                    const startX = 11;
                    const endX = 86;
                    x = startX + (idx * (endX - startX)) / (count - 1);
                    y = (idx % 2 === 0) ? 37 : 73;
                }

                return {
                    ...lvl,
                    x,
                    y
                };
            });
        }

        function loadJenjangState(jenjang) {
            const baseLevels = demoLevels[jenjang] || [];
            const levelProgress = canSaveProgress ?
                serverProgress.filter(item => String(item.jenjang).toUpperCase() === jenjang) :
                getGuestLocalProgress(jenjang);

            const completedIds = new Set(levelProgress.map(item => Number(item.level_id)));

            levelsData = assignDynamicCoordinates(baseLevels.map((level, index) => {
                const progress = levelProgress.find(item => Number(item.level_id) === level.id);
                const previousCompleted = completedIds.has(level.id - 1);

                if (progress) {
                    return {
                        ...level,
                        status: 'done',
                        score: Number(progress.score),
                        stars: Number(progress.stars),
                        progress: 100
                    };
                }

                if (index === 0) {
                    return {
                        ...level,
                        status: 'active',
                        score: 0,
                        stars: 0,
                        progress: 0
                    };
                }

                return {
                    ...level,
                    status: previousCompleted ? 'active' : 'locked',
                    score: 0,
                    stars: 0,
                    progress: 0
                };
            }));

            const requestedLevelObj = (!hasConsumedUrlLevel && jenjang === initialUrlJenjang && initialUrlLevel > 0)
                ? levelsData.find(l => l.id === initialUrlLevel && l.status !== 'locked')
                : null;

            if (requestedLevelObj) {
                currentMascotLevel = requestedLevelObj.id;
                hasConsumedUrlLevel = true;
            } else {
                const lastDoneLevel = [...levelsData].reverse().find(l => l.status === 'done');
                const firstActiveLevel = levelsData.find(l => l.status === 'active');
                currentMascotLevel = lastDoneLevel?.id ?? firstActiveLevel?.id ?? (levelsData[0]?.id ?? 1);
            }

            // Update header banner jenjang
            document.getElementById('banner-jenjang-title').textContent = jenjang;
            document.getElementById('banner-level-count').textContent = `${levelsData.length} Level`;
            document.getElementById('banner-jenjang-subtitle').textContent = levelsData.length ?
                `${levelsData.length} level materi demo tersedia.` :
                'Materi demo untuk jenjang ini belum tersedia.';

            // Highlight item aktif di dropdown jenjang
            document.querySelectorAll('.jenjang-option-btn').forEach(btn => {
                const optJenjang = btn.getAttribute('data-jenjang-option');
                const checkIcon = btn.querySelector('.jenjang-option-check');
                const badge = btn.querySelector('.jenjang-option-badge');
                const isSelected = optJenjang === jenjang;

                btn.classList.toggle('bg-blue-50', isSelected);
                btn.classList.toggle('text-blue-700', isSelected);
                btn.classList.toggle('text-slate-700', !isSelected);
                if (checkIcon) checkIcon.classList.toggle('hidden', !isSelected);
                if (badge) {
                    badge.classList.toggle('bg-blue-600', isSelected);
                    badge.classList.toggle('text-white', isSelected);
                    badge.classList.toggle('bg-slate-100', !isSelected);
                    badge.classList.toggle('text-slate-600', !isSelected);
                }
            });

            renderLevelMap();
        }

        function switchJenjang(jenjang) {
            activeJenjang = jenjang;
            closeLevelDrawer();
            loadJenjangState(jenjang);
        }

        // Sinkronkan kotak status Jenjang & Level di Sidebar luar
        function syncSidebarInfo(jenjang, currentLvl, totalLvl) {
            const pct = totalLvl > 0 ? Math.min(100, Math.round((currentLvl / totalLvl) * 100)) : 0;

            const mapText = {
                'sidebar-jenjang-text': jenjang,
                'sidebar-jenjang-mini': jenjang,
                'sidebar-current-lvl': currentLvl,
                'sidebar-current-lvl-mini': currentLvl,
                'sidebar-total-lvl': totalLvl,
                'sidebar-total-lvl-mini': totalLvl,
                'sidebar-lvl-percent': `${pct}%`
            };

            Object.entries(mapText).forEach(([id, val]) => {
                const el = document.getElementById(id);
                if (el) el.textContent = val;
            });

            const barEl = document.getElementById('sidebar-lvl-bar');
            if (barEl) barEl.style.width = `${pct}%`;

            const collapsedBox = document.getElementById('sidebar-status-collapsed');
            if (collapsedBox) collapsedBox.title = `Jenjang ${jenjang} • Level ${currentLvl} dari ${totalLvl}`;
        }

        // Gambar garis jalur SVG penghubung antar titik level secara dinamis
        function renderDynamicPath() {
            const pathBase = document.getElementById('path-base');
            const pathDash = document.getElementById('path-dash');
            if (!levelsData.length) return;

            const points = levelsData.map(lvl => ({
                x: lvl.x * 10,
                y: lvl.y * 3.6
            }));

            let d = `M ${points[0].x} ${points[0].y}`;
            for (let i = 0; i < points.length - 1; i++) {
                const p1 = points[i];
                const p2 = points[i + 1];
                const midX = (p1.x + p2.x) / 2;
                d += ` C ${midX} ${p1.y}, ${midX} ${p2.y}, ${p2.x} ${p2.y}`;
            }

            // Sambungkan titik level terakhir ke peti harta karun di pojok kanan bawah
            const last = points[points.length - 1];
            d += ` C ${last.x + 55} ${last.y}, 940 230, 935 280`;

            pathBase.setAttribute('d', d);
            pathDash.setAttribute('d', d);
        }

        function renderLevelMap() {
            renderDynamicPath();

            const container = document.getElementById('levels-container');
            container.innerHTML = '';

            let totalStars = 0;
            let completedCount = 0;

            const isDense = levelsData.length > 6;
            const circleSizeClass = isDense ? 'w-14 h-14 sm:w-16 sm:h-16' : 'w-16 h-16 sm:w-20 sm:h-20';
            const fontSizeClass = isDense ? 'text-lg sm:text-xl' : 'text-xl sm:text-2xl';

            levelsData.forEach((lvl) => {
                totalStars += (lvl.stars || 0);
                if (lvl.status === 'done') completedCount++;

                const isLocked = lvl.status === 'locked';
                const isDone = lvl.status === 'done';
                const isMascotHere = (lvl.id === currentMascotLevel && !isMascotRunning);

                const pedestalClass = isDone ?
                    'pedestal-done' :
                    (lvl.status === 'active' ? 'pedestal-active' : 'pedestal-locked');

                const nodeEl = document.createElement('button');
                nodeEl.type = 'button';
                nodeEl.onclick = () => handleLevelClick(lvl.id);
                nodeEl.style.left = `${lvl.x}%`;
                nodeEl.style.top = `${lvl.y}%`;
                nodeEl.className =
                    `group absolute -translate-x-1/2 -translate-y-1/2 flex flex-col items-center focus:outline-none cursor-pointer transition-transform duration-200 hover:scale-105`;

                nodeEl.innerHTML = `
                <!-- PENANDA POSISI SEKARANG: mascot_peek.png DI ATAS BULATAN -->
                ${isMascotHere ? `
                        <div class="absolute bottom-[86%] left-1/2 -translate-x-1/2 w-max z-20 pointer-events-none animate-peek-top flex flex-col items-center">
                            <div class="flex items-center gap-0.5 -mb-1">
                                ${[1, 2, 3].map(s => `
                                <svg class="w-3.5 h-3.5 ${s <= lvl.stars ? 'text-amber-400 drop-shadow-2xs' : 'text-slate-300/90'}" viewBox="0 0 24 24" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd"/>
                                </svg>
                            `).join('')}
                            </div>
                            <img 
                                src="{{ asset('images/mascot_peek.png') }}" 
                                alt="Posisi Maskot Sekarang" 
                                style="width: 95px; height: 75px;"
                                class="shrink-0 object-contain object-bottom drop-shadow-sm"
                            >
                        </div>
                    ` : `
                        <div class="mb-1 flex items-center gap-0.5">
                            ${[1, 2, 3].map(s => `
                            <svg class="w-3.5 h-3.5 ${s <= lvl.stars ? 'text-amber-400 drop-shadow-2xs' : 'text-slate-300/90'}" viewBox="0 0 24 24" fill="currentColor">
                                <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd"/>
                            </svg>
                        `).join('')}
                        </div>
                    `}

                <!-- BULATAN PEDESTAL 3D DENGAN ANGKA LEVEL DI DALAMNYA -->
                <div class="relative ${circleSizeClass} rounded-full ${pedestalClass} p-1.5 flex items-center justify-center transition-all ${isMascotHere ? 'ring-4 ring-blue-300/70' : ''}">
                    <div class="w-full h-full rounded-full ${isLocked ? 'bg-slate-100' : 'bg-white'} flex items-center justify-center shadow-inner">
                        <span class="${fontSizeClass} font-extrabold tracking-tight ${isLocked ? 'text-slate-400' : 'text-blue-600'}">
                            ${lvl.id}
                        </span>
                    </div>

                    ${isDone ? `
                            <span class="absolute -bottom-1 -right-1 w-6 h-6 rounded-full bg-emerald-500 border-2 border-white text-white flex items-center justify-center shadow-sm">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                </svg>
                            </span>
                        ` : ''}

                    ${isLocked ? `
                            <span class="absolute -bottom-1 -right-1 w-6 h-6 rounded-full bg-slate-500 border-2 border-white text-white flex items-center justify-center shadow-sm">
                                <svg class="w-3 h-3" viewBox="0 0 24 24" fill="currentColor">
                                    <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z" clip-rule="evenodd"/>
                                </svg>
                            </span>
                        ` : ''}
                </div>
            `;

                container.appendChild(nodeEl);
            });

            const totalCount = levelsData.length || 1;
            const percent = Math.round((completedCount / totalCount) * 100);
            const finishMarker = document.getElementById('level-map-finish');
            finishMarker?.classList.toggle(
                'hidden',
                levelsData.length === 0 || completedCount < levelsData.length
            );
            document.getElementById('total-stars').textContent = totalStars;
            document.getElementById('max-stars').textContent = levelsData.length * 3;
            document.getElementById('active-level-title').textContent = `Level ${currentMascotLevel}`;
            document.getElementById('progress-bar-fill').style.width = `${Math.max(percent, completedCount > 0 ? 10 : 5)}%`;
            document.getElementById('progress-percent').textContent = `${percent}%`;

            syncSidebarInfo(activeJenjang, currentMascotLevel, levelsData.length);
        }

        function handleLevelClick(targetId) {
            const targetLevel = levelsData.find(l => l.id === targetId);
            const currentLevelObj = levelsData.find(l => l.id === currentMascotLevel);
            if (!targetLevel) return;

            if (targetLevel.status !== 'locked' && targetId !== currentMascotLevel && currentLevelObj) {
                animateMascotRun(currentLevelObj, targetLevel, () => {
                    currentMascotLevel = targetId;
                    renderLevelMap();
                    openLevelDrawer(targetId);
                });
            } else {
                openLevelDrawer(targetId);
            }
        }

        function animateMascotRun(fromLvl, toLvl, onComplete) {
            isMascotRunning = true;
            renderLevelMap();

            const runnerWrap = document.getElementById('running-mascot-wrapper');
            const runnerImg = document.getElementById('running-mascot-img');

            runnerImg.style.transform = (toLvl.x < fromLvl.x) ? 'scaleX(-1)' : 'scaleX(1)';

            runnerWrap.style.transition = 'none';
            runnerWrap.style.left = `${fromLvl.x}%`;
            runnerWrap.style.top = `${fromLvl.y}%`;
            runnerWrap.classList.remove('hidden');

            void runnerWrap.offsetWidth;

            runnerWrap.style.transition =
                'left 0.85s cubic-bezier(0.34, 1.25, 0.64, 1), top 0.85s cubic-bezier(0.34, 1.25, 0.64, 1)';
            runnerWrap.style.left = `${toLvl.x}%`;
            runnerWrap.style.top = `${toLvl.y}%`;

            setTimeout(() => {
                runnerWrap.classList.add('hidden');
                isMascotRunning = false;
                if (typeof onComplete === 'function') onComplete();
            }, 860);
        }

        function openLevelDrawer(levelId) {
            const lvl = levelsData.find(l => l.id === levelId);
            if (!lvl) return;

            document.getElementById('drawer-level-badge').textContent = `JENJANG ${activeJenjang} • LEVEL ${lvl.id}`;
            document.getElementById('drawer-language-tag').textContent = lvl.language;
            document.getElementById('drawer-title').textContent = lvl.title;
            document.getElementById('drawer-description').textContent = lvl.description;

            const statusBadge = document.getElementById('drawer-status-badge');
            if (lvl.status === 'done') {
                statusBadge.textContent = '✓ Selesai';
                statusBadge.className = 'px-3 py-1 rounded-full bg-emerald-50 text-emerald-600 text-xs font-bold';
            } else if (lvl.status === 'active') {
                statusBadge.textContent = '● Siap Dikerjakan';
                statusBadge.className = 'px-3 py-1 rounded-full bg-blue-50 text-blue-600 text-xs font-bold';
            } else {
                statusBadge.textContent = '🔒 Terkunci';
                statusBadge.className = 'px-3 py-1 rounded-full bg-slate-100 text-slate-500 text-xs font-bold';
            }

            const topicsList = document.getElementById('drawer-topics');
            topicsList.innerHTML = (lvl.topics || []).map(t => `
            <li class="flex items-start gap-2.5">
                <span class="w-5 h-5 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-xs font-bold shrink-0 mt-0.5">✓</span>
                <span>${t}</span>
            </li>
        `).join('');

            document.getElementById('drawer-score').textContent = lvl.score > 0 ? `${lvl.score}` : '-';
            document.getElementById('drawer-stars').textContent = '★'.repeat(lvl.stars || 0) + '☆'.repeat(3 - (lvl.stars ||
                0));
            document.getElementById('drawer-progress-text').textContent = `${lvl.progress || 0}%`;
            document.getElementById('drawer-cards-count').textContent = lvl.cardsDone || '-';
            document.getElementById('drawer-progress-bar').style.width = `${lvl.progress || 0}%`;
            document.getElementById('drawer-adaptive-note').textContent = lvl.adaptiveNote || '';

            const ctaBtn = document.getElementById('drawer-cta-btn');
            const ctaText = document.getElementById('drawer-cta-text');

            if (lvl.status === 'locked') {
                ctaBtn.href = 'javascript:void(0)';
                ctaBtn.className =
                    'w-full inline-flex items-center justify-center gap-2 bg-slate-200 text-slate-500 font-bold text-sm py-3 px-6 rounded-2xl cursor-not-allowed';
                ctaText.textContent = `Selesaikan Level ${lvl.id - 1} Dulu (Min. Nilai 80)`;
            } else {
                ctaBtn.href = `${lvl.url}?jenjang=${activeJenjang}&level=${lvl.id}`;
                ctaBtn.className =
                    'w-full inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-bold text-base py-3 px-6 rounded-2xl shadow-soft-blue transition-all';
                ctaText.textContent = lvl.status === 'done' ?
                    `Latihan Ulang Level ${lvl.id}` :
                    `Mulai Belajar Level ${lvl.id}`;
            }

            const backdrop = document.getElementById('drawer-backdrop');
            const drawer = document.getElementById('level-drawer');

            backdrop.classList.remove('hidden');
            requestAnimationFrame(() => {
                backdrop.classList.remove('opacity-0');
                drawer.classList.remove('translate-x-full');
            });
        }

        function closeLevelDrawer() {
            const backdrop = document.getElementById('drawer-backdrop');
            const drawer = document.getElementById('level-drawer');

            backdrop.classList.add('opacity-0');
            drawer.classList.add('translate-x-full');

            setTimeout(() => {
                backdrop.classList.add('hidden');
            }, 300);
        }

        document.addEventListener('DOMContentLoaded', () => {
            loadJenjangState(activeJenjang);
        });
    </script>
@endpush
