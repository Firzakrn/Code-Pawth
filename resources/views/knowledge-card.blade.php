@extends('layouts.app')

@section('title', 'Knowledge Card — Code Pawth')

@section('content')
    <style>
        .kc-scene {
            perspective: 1100px;
        }

        .kc-card-3d {
            display: grid;
            width: 100%;
            height: 100%;
            transition: transform 0.55s cubic-bezier(0.22, 1, 0.36, 1);
            transform-style: preserve-3d;
            -webkit-transform-style: preserve-3d;
        }

        .kc-card-3d.is-flipped {
            transform: rotateY(180deg);
        }

        .kc-face {
            grid-area: 1 / 1;
            backface-visibility: hidden;
            -webkit-backface-visibility: hidden;
        }

        .kc-face-back {
            transform: rotateY(180deg);
        }
    </style>

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

    <!-- DEKORASI BLOB AWAN, PAW PRINT & KILAU BACKGROUND -->
    <div class="pointer-events-none absolute inset-0 overflow-hidden z-0" aria-hidden="true">
        <div class="absolute -top-12 left-20 w-64 h-64 rounded-full bg-white/60"></div>
        <div class="absolute top-4 left-64 w-44 h-44 rounded-full bg-blue-200/40"></div>
        <div class="absolute -top-6 left-[42%] w-36 h-36 rounded-full bg-white/50"></div>

        <!-- Gugusan Blob Awan Kanan Atas -->
        <svg class="absolute -top-6 -right-10 w-[400px] sm:w-[500px] h-auto" viewBox="0 0 560 300" fill="none">
            <circle cx="430" cy="70" r="145" fill="#DCEAFF" fill-opacity="0.78" />
            <circle cx="310" cy="115" r="95" fill="#E3EFFF" fill-opacity="0.82" />
            <circle cx="515" cy="165" r="115" fill="#D5E5FF" fill-opacity="0.72" />
            <path
                d="M230 230C260 175 320 155 375 170C410 130 480 125 530 165C565 190 580 230 570 265H215C215 250 220 240 230 230Z"
                fill="#CFE1FF" fill-opacity="0.65" />
        </svg>

        <!-- Gugusan Awan Bulat Pojok Kiri Bawah -->
        <svg class="absolute -bottom-8 -left-10 w-[380px] h-auto" viewBox="0 0 420 220" fill="none">
            <circle cx="60" cy="185" r="110" fill="#D7E7FF" fill-opacity="0.82" />
            <circle cx="175" cy="200" r="95" fill="#E2EEFF" fill-opacity="0.85" />
            <circle cx="280" cy="215" r="80" fill="#D7E7FF" fill-opacity="0.72" />
        </svg>

        <!-- Gugusan Awan Bulat Pojok Kanan Bawah -->
        <svg class="absolute -bottom-8 -right-8 w-[380px] h-auto" viewBox="0 0 420 220" fill="none">
            <circle cx="360" cy="180" r="115" fill="#D7E7FF" fill-opacity="0.82" />
            <circle cx="240" cy="198" r="95" fill="#E2EEFF" fill-opacity="0.85" />
            <circle cx="135" cy="215" r="75" fill="#D7E7FF" fill-opacity="0.72" />
        </svg>

        <!-- Jejak Paw Biru Ramai -->
        <svg class="absolute top-14 left-6 w-16 h-16 sm:w-20 sm:h-20 text-blue-300/45 -rotate-[22deg]"
            viewBox="0 0 100 100">
            <use href="#natural-blue-paw" />
        </svg>
        <svg class="absolute top-28 right-10 w-16 h-16 sm:w-20 sm:h-20 text-blue-300/45 rotate-[24deg]"
            viewBox="0 0 100 100">
            <use href="#natural-blue-paw" />
        </svg>
        <svg class="absolute top-1/2 left-4 w-14 h-14 sm:w-16 sm:h-16 text-blue-300/40 rotate-[16deg]"
            viewBox="0 0 100 100">
            <use href="#natural-blue-paw" />
        </svg>
        <svg class="absolute bottom-14 left-16 w-20 h-20 sm:w-24 sm:h-24 text-blue-300/50 rotate-[18deg]"
            viewBox="0 0 100 100">
            <use href="#natural-blue-paw" />
        </svg>
        <svg class="absolute bottom-12 right-24 w-20 h-20 sm:w-24 sm:h-24 text-blue-300/50 -rotate-[18deg]"
            viewBox="0 0 100 100">
            <use href="#natural-blue-paw" />
        </svg>

        <!-- Kilau Bintang -->
        <svg class="hidden md:block absolute top-10 left-[46%] w-5 h-5 text-blue-300" viewBox="0 0 24 24"
            fill="currentColor">
            <path d="M12 1L14.5 9.5L23 12L14.5 14.5L12 23L9.5 14.5L1 12L9.5 9.5L12 1Z" />
        </svg>
        <svg class="hidden md:block absolute top-36 left-[28%] w-4 h-4 text-blue-300/80" viewBox="0 0 24 24"
            fill="currentColor">
            <path d="M12 1L14.5 9.5L23 12L14.5 14.5L12 23L9.5 14.5L1 12L9.5 9.5L12 1Z" />
        </svg>
    </div>

    <!-- Top Navigation Bar -->
    <header class="relative z-10 px-5 sm:px-7 pt-3 pb-1 flex items-center justify-between shrink-0">
        <a href="{{ url('/level-view') }}"
            class="inline-flex items-center gap-2 text-slate-700 hover:text-blue-600 font-bold text-sm transition-colors group">
            <span
                class="w-7 h-7 rounded-full bg-white shadow-2xs border border-slate-200/80 flex items-center justify-center group-hover:border-blue-300 group-hover:-translate-x-0.5 transition-all">
                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" stroke-width="2.5"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </span>
            <span>Peta Level</span>
        </a>

        <div class="flex items-center gap-2.5">
            @if ($canSaveProgress ?? false)
                <span
                    class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/90 border border-blue-100 text-xs font-semibold text-slate-600 shadow-2xs">
                    <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                    {{ Auth::user()->name }}
                </span>
            @elseif (Auth::check())
                <span
                    class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/90 border border-indigo-100 text-xs font-semibold text-indigo-700 shadow-2xs">
                    <span class="w-2 h-2 rounded-full bg-indigo-500"></span>
                    Pratinjau Guru ({{ Auth::user()->name }})
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

            <!-- Tombol Tutup / Tampilkan Header -->
            <button type="button" id="btn-toggle-kc-header" onclick="toggleKcHeader()" title="Tutup / Tampilkan Header"
                class="inline-flex items-center gap-1.5 bg-white/90 hover:bg-white text-slate-600 hover:text-blue-600 border border-blue-100 text-xs font-bold px-3 py-1.5 rounded-full shadow-2xs transition-colors cursor-pointer">
                <svg id="icon-toggle-kc-header" class="w-3.5 h-3.5 transition-transform duration-200" fill="none"
                    stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
                </svg>
                <span id="text-toggle-kc-header" class="hidden sm:inline">Tutup Header</span>
            </button>
        </div>
    </header>

    <!-- Main Container -->
    <main class="relative z-10 flex-1 min-h-0 flex flex-col px-5 sm:px-7 pb-4 max-w-6xl w-full mx-auto gap-2.5">

        <!-- BAGIAN HEADER YANG BISA DITUTUP -->
        <div id="kc-collapsible-header" class="flex flex-col gap-2.5 shrink-0">
            <!-- Banner Header Knowledge Card + Level Kamu + Maskot -->
            <div class="relative flex flex-col md:flex-row md:items-center justify-between gap-2 shrink-0">
                <!-- Kartu Judul Utama -->
                <div
                    class="bg-white/95 backdrop-blur-xs rounded-2xl border border-white shadow-soft-card px-4 py-2 flex items-center gap-3.5 max-w-xl z-10">
                    <div
                        class="w-10 h-10 rounded-xl bg-blue-50 border border-blue-100 flex items-center justify-center overflow-hidden shrink-0">
                        <img src="{{ asset('images/mascot_think.png') }}" alt="Knowledge Card"
                            class="w-9 h-9 object-contain">
                    </div>
                    <div class="flex-1 min-w-0">
                        <h1 class="text-base sm:text-lg font-extrabold text-slate-900 tracking-tight leading-tight">
                            Knowledge Card
                        </h1>
                        <p class="text-xs text-slate-500 mt-0.5 leading-snug">
                            Pelajari semua pelajaran dari <span class="font-bold text-emerald-600">Kelas Gurumu</span>
                            maupun <span class="font-bold text-blue-600">Kelas CodePawth</span>!
                        </p>
                    </div>
                </div>

                <!-- Kanan Atas: Badge Level Kamu + Maskot -->
                <div class="flex items-center justify-between md:justify-end gap-3 z-10">
                    <div
                        class="bg-white/95 backdrop-blur-xs rounded-2xl border border-amber-200/80 shadow-soft-card px-3.5 py-1.5 flex items-center gap-2.5">
                        <div
                            class="w-8 h-8 rounded-xl bg-amber-50 border border-amber-200/80 flex items-center justify-center text-amber-500 shrink-0">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.166 2.621v.858c-1.035.148-2.059.33-3.071.543a.75.75 0 00-.584.859 6.753 6.753 0 006.138 5.6 6.73 6.73 0 002.743 1.346A6.707 6.707 0 019.279 15H8.54c-1.036 0-1.875.84-1.875 1.875V19.5h-.75a2.25 2.25 0 00-2.25 2.25c0 .414.336.75.75.75h15a.75.75 0 00.75-.75 2.25 2.25 0 00-2.25-2.25h-.75v-2.625c0-1.036-.84-1.875-1.875-1.875h-.739a6.706 6.706 0 01-1.112-3.173 6.73 6.73 0 002.743-1.347 6.753 6.753 0 006.139-5.6.75.75 0 00-.585-.858 47.077 47.077 0 00-3.07-.543V2.62a.75.75 0 00-.658-.744 49.22 49.22 0 00-6.093-.377c-2.063 0-4.096.128-6.093.377a.75.75 0 00-.657.744zm0 2.629c0 1.196.312 2.32.857 3.294A5.266 5.266 0 013.16 5.337a45.6 45.6 0 012.006-.343v.256zm13.5 0v-.256c.674.1 1.343.214 2.006.343a5.265 5.265 0 01-2.863 3.207 6.72 6.72 0 00.857-3.294z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div>
                            <div class="text-[10px] font-extrabold uppercase tracking-wider text-amber-600 leading-none">
                                Level Kamu
                            </div>
                            <div id="kc-user-level-title"
                                class="text-sm font-extrabold text-slate-900 leading-tight mt-0.5">
                                Level 1
                            </div>
                            <div id="kc-user-level-sub" class="text-[10px] font-semibold text-slate-500">
                                0 level dituntaskan
                            </div>
                        </div>
                    </div>

                    <img src="{{ asset('images/mascot_card.png') }}" alt="Maskot"
                        class="hidden sm:block w-14 h-14 object-contain object-bottom drop-shadow-xs shrink-0">
                </div>
            </div>
        </div>

        <!-- Bar Pencarian & Filter Sumber Kelas (Meredup saat header ditutup, terang kembali saat disentuh/diklik) -->
        <div id="kc-search-panel" onmousedown="activateKcSearchPanel()" onfocusin="activateKcSearchPanel()"
            class="bg-white/95 backdrop-blur-xs rounded-2xl border border-white shadow-soft-card p-3 sm:px-4 flex flex-col gap-2.5 shrink-0 transition-opacity duration-300">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-2 items-center">

                <!-- Pencarian Kata Kunci -->
                <div class="lg:col-span-5 relative">
                    <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.3"
                            viewBox="0 0 24 24">
                            <circle cx="11" cy="11" r="7" />
                            <path stroke-linecap="round" d="M20 20l-3.5-3.5" />
                        </svg>
                    </span>
                    <input type="text" id="kc-search-input" oninput="filterKnowledgeCards()"
                        placeholder="Cari konsep, sintaks, atau penjelasan..."
                        class="w-full pl-9 pr-8 py-1.5 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:border-blue-500 text-xs sm:text-sm text-slate-800 placeholder-slate-400 focus:outline-none transition-colors">
                    <button type="button" id="kc-clear-search" onclick="clearKcSearch()" title="Hapus pencarian"
                        class="hidden absolute inset-y-0 right-2.5 items-center text-slate-400 hover:text-slate-600 cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.4"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Filter Sumber Kelas: Semua / Kelas CodePawth / Kelas Gurumu -->
                <div class="lg:col-span-4 flex items-center gap-1.5 flex-wrap">
                    <span class="text-[10px] font-extrabold text-slate-400 uppercase tracking-wider mr-0.5">Sumber:</span>
                    <button type="button" data-source="ALL" onclick="selectKcSource('ALL')"
                        class="kc-source-btn px-2.5 py-1 rounded-full text-xs font-extrabold bg-blue-600 text-white shadow-2xs transition-all cursor-pointer">
                        Semua
                    </button>
                    <button type="button" data-source="codepawth" onclick="selectKcSource('codepawth')"
                        class="kc-source-btn px-2.5 py-1 rounded-full text-xs font-bold bg-slate-100 hover:bg-blue-50 text-slate-600 hover:text-blue-600 transition-all cursor-pointer">
                        Kelas CodePawth
                    </button>
                    <button type="button" data-source="joined" onclick="selectKcSource('joined')"
                        class="kc-source-btn px-2.5 py-1 rounded-full text-xs font-bold bg-slate-100 hover:bg-emerald-50 text-slate-600 hover:text-emerald-600 transition-all cursor-pointer">
                        Kelas Gurumu
                    </button>
                </div>

                <!-- Filter Level / Kelas -->
                <div class="lg:col-span-3">
                    <select id="kc-level-select" onchange="filterKnowledgeCards()" aria-label="Filter Level Materi"
                        class="w-full px-3 py-1.5 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:border-blue-500 text-xs font-bold text-slate-700 focus:outline-none cursor-pointer">
                        <option value="ALL">Semua Level</option>
                    </select>
                </div>
            </div>

            <div class="flex items-center justify-between pt-2 border-t border-slate-100 text-xs">
                <span class="text-slate-500 font-medium">
                    Menampilkan <strong id="kc-visible-count" class="text-slate-900">0</strong> kartu Flashcard
                </span>

                <button type="button" onclick="toggleFlipAllCards()"
                    class="inline-flex items-center gap-1.5 text-blue-600 hover:text-blue-700 font-extrabold transition-colors cursor-pointer">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.3"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    <span id="text-flip-all-kc">Balik Semua Kartu</span>
                </button>
            </div>
        </div>

        <!-- Area Konten Scrollable -->
        <div id="kc-cards-scroll-area" onscroll="dimKcSearchIfHeaderHidden()"
            class="flex-1 min-h-0 overflow-y-auto pr-1 pb-4">
            <!-- Daftar Section Divider per Sumber Kelas & Level -->
            <div id="kc-cards-grid" class="flex flex-col gap-6 pt-5"></div>

            <!-- Empty State -->
            <div id="kc-empty-state"
                class="hidden bg-white/95 rounded-3xl border-2 border-white shadow-soft-card p-8 text-center flex-col items-center justify-center gap-3 mt-2">
                <img src="{{ asset('images/mascot_sad.png') }}" alt="Tidak Ditemukan"
                    class="w-20 h-20 object-contain mx-auto">
                <div>
                    <h3 class="text-base font-extrabold text-slate-900">Kartu Flashcard Tidak Ditemukan</h3>
                    <p class="text-xs text-slate-500 mt-1">
                        Coba kata kunci lain atau atur ulang filter sumber kelas dan level materi.
                    </p>
                </div>
                <button type="button" onclick="resetAllKcFilters()"
                    class="px-5 py-2 rounded-full bg-blue-600 hover:bg-blue-700 text-white text-xs font-extrabold shadow-soft-blue transition-all cursor-pointer">
                    Reset Filter & Pencarian
                </button>
            </div>
        </div>

    </main>
@endsection

@push('scripts')
    <script>
        const KC_DATA = {
            decks: @json($knowledgeCardDecks ?? []),
            serverProgress: @json($serverProgress ?? []),
            flashcardBaseUrl: @json(url('/materi/flashcard')),
            levelViewUrl: @json(url('/level-view')),
            cardMascotUrl: @json(asset('images/mascot_dashboard.png')),
            mascotAssets: [
                @json(asset('images/mascot_peek.png')),
                @json(asset('images/mascot_what.png')),
                @json(asset('images/mascot_run.png'))
            ]
        };

        const kcSvgIcons = {
            monitor: `<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2"/><path stroke-linecap="round" d="M8 21h8m-4-4v4"/></svg>`,
            keyboard: `<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><rect x="2" y="5" width="20" height="14" rx="2"/><path stroke-linecap="round" d="M6 9h.01M10 9h.01M14 9h.01M18 9h.01M8 15h8"/></svg>`,
            text: `<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 7V5h16v2M12 5v14m-3 0h6"/></svg>`,
            number: `<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/></svg>`,
            box: `<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8l-9-5-9 5v8l9 5 9-5V8z"/><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l9 5 9-5M12 13v8"/></svg>`,
            plus: `<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.4" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m-7-7h14"/></svg>`,
            note: `<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h4m4 5H7a2 2 0 01-2-2V5a2 2 0 012-2h7l5 5v11a2 2 0 01-2 2z"/></svg>`,
            branch: `<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><circle cx="6" cy="6" r="2.5"/><circle cx="18" cy="18" r="2.5"/><circle cx="18" cy="6" r="2.5"/><path stroke-linecap="round" d="M6 8.5v7A2.5 2.5 0 008.5 18h7M6 8.5A2.5 2.5 0 018.5 6h7"/></svg>`,
            loop: `<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>`,
            default: `<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>`
        };

        const ALL_KC_CARDS = [];
        const ALL_LEVEL_OPTIONS = [];
        let selectedSource = 'ALL';
        let flippedSet = new Set();
        let allFlipped = false;

        // Kontrol opasitas bar pencarian saat header ditutup/dibuka
        function setSearchPanelDimmed(isDimmed) {
            const searchPanel = document.getElementById('kc-search-panel');
            if (!searchPanel) return;
            if (isDimmed) {
                searchPanel.classList.add('opacity-45', 'hover:opacity-100');
                searchPanel.classList.remove('opacity-100');
            } else {
                searchPanel.classList.remove('opacity-45', 'hover:opacity-100');
                searchPanel.classList.add('opacity-100');
            }
        }

        window.activateKcSearchPanel = function() {
            setSearchPanelDimmed(false);
        };

        window.dimKcSearchIfHeaderHidden = function() {
            const isHeaderHidden = localStorage.getItem('codepawth_kc_header_hidden') === 'true';
            const searchInput = document.getElementById('kc-search-input');
            if (isHeaderHidden && document.activeElement !== searchInput) {
                setSearchPanelDimmed(true);
            }
        };

        // Toggle Tutup / Tampilkan Header
        window.applyKcHeaderState = function(isHidden) {
            const headerPanel = document.getElementById('kc-collapsible-header');
            const icon = document.getElementById('icon-toggle-kc-header');
            const text = document.getElementById('text-toggle-kc-header');
            if (!headerPanel) return;

            if (isHidden) {
                headerPanel.classList.add('hidden');
                if (icon) icon.classList.add('rotate-180');
                if (text) text.textContent = 'Tampilkan Header';
                setSearchPanelDimmed(true);
            } else {
                headerPanel.classList.remove('hidden');
                if (icon) icon.classList.remove('rotate-180');
                if (text) text.textContent = 'Tutup Header';
                setSearchPanelDimmed(false);
            }
        };

        window.toggleKcHeader = function() {
            const nextState = localStorage.getItem('codepawth_kc_header_hidden') !== 'true';
            localStorage.setItem('codepawth_kc_header_hidden', String(nextState));
            window.applyKcHeaderState(nextState);
        };

        function getUnlockedDeckKeys() {
            const unlocked = new Set();

            if (Array.isArray(KC_DATA.serverProgress)) {
                KC_DATA.serverProgress.forEach(item => {
                    const code = String(item?.class_code || 'DEMOPWT').toUpperCase();
                    const j = String(item?.jenjang || '').toUpperCase();
                    const l = Number(item?.level_id ?? item?.level ?? 0);
                    if (j && l > 0) {
                        unlocked.add(`${code}-${j}-${l}`);
                    }
                });
            }

            try {
                const raw = localStorage.getItem('codepawth_guest_progress');
                if (raw) {
                    const parsed = JSON.parse(raw);
                    if (parsed && typeof parsed === 'object') {
                        Object.entries(parsed).forEach(([jenjangKey, levelsObj]) => {
                            const jUpper = String(jenjangKey).toUpperCase();
                            if (levelsObj && typeof levelsObj === 'object') {
                                Object.entries(levelsObj).forEach(([lvlKey, info]) => {
                                    const isDone = Boolean(
                                        info?.completed ||
                                        info?.done ||
                                        Number(info?.score ?? 0) >= 80
                                    );
                                    if (isDone) {
                                        unlocked.add(`DEMOPWT-${jUpper}-${Number(lvlKey)}`);
                                    }
                                });
                            }
                        });
                    }
                }
            } catch (_) {}

            return unlocked;
        }

        function buildCardsFromMateriDecks() {
            const unlockedKeys = getUnlockedDeckKeys();

            Object.entries(KC_DATA.decks).forEach(([deckKey, deck]) => {
                const sourceType = deck.sourceType || 'codepawth';
                const classCode = String(deck.classCode || 'DEMOPWT').toUpperCase();
                const className = deck.className || 'Kelas CodePawth';
                const jenjang = String(deck.jenjang || 'SD').toUpperCase();
                const level = Number(deck.level || 1);
                const normalizedKey = `${classCode}-${jenjang}-${level}`;

                if (!unlockedKeys.has(normalizedKey)) {
                    return;
                }

                const levelTitle = deck.levelTitle || `Level ${level}`;
                const hasFlowchart = Boolean(deck.hasFlowchart ?? ['SMP', 'SMA'].includes(jenjang));
                const hasCoding = Boolean(deck.hasCoding ?? (jenjang === 'SMA'));
                const queryStr =
                    `jenjang=${jenjang}&level=${level}&flowchart=${hasFlowchart ? '1' : '0'}&coding=${hasCoding ? '1' : '0'}`;
                const flashcardUrl = `${KC_DATA.flashcardBaseUrl}?${queryStr}`;

                ALL_LEVEL_OPTIONS.push({
                    key: deckKey,
                    sourceType,
                    classCode,
                    className,
                    jenjang,
                    level,
                    levelTitle
                });

                const items = Array.isArray(deck.items) ? deck.items : [];
                const fronts = items.filter(i => i.kategori === 'front');
                const backs = items.filter(i => i.kategori === 'back');

                fronts.forEach(front => {
                    const pairId = front.pair_id ?? front.id;
                    const matchedBack = backs.find(b => (b.pair_id ?? b.id) === pairId) || {};

                    ALL_KC_CARDS.push({
                        deckKey,
                        sourceType,
                        classCode,
                        className,
                        jenjang,
                        level,
                        levelTitle,
                        materiUrl: flashcardUrl,
                        pairId: `fc-${pairId}`,
                        iconKey: front.iconKey || 'default',
                        frontJudul: front.judul || 'Konsep Dasar',
                        frontIsi: front.isi_materi || '',
                        frontMain: front.main_materi || '',
                        backJudul: matchedBack.judul || 'Sisi Belakang Kartu',
                        backIsi: matchedBack.isi_materi || '-',
                        backMain: matchedBack.main_materi || ''
                    });
                });
            });

            const sourceOrder = {
                codepawth: 1,
                joined: 2
            };
            const jenjangOrder = {
                SD: 1,
                SMP: 2,
                SMA: 3
            };
            ALL_LEVEL_OPTIONS.sort((a, b) => {
                const sDiff = (sourceOrder[a.sourceType] || 9) - (sourceOrder[b.sourceType] || 9);
                if (sDiff !== 0) return sDiff;
                const jDiff = (jenjangOrder[a.jenjang] || 99) - (jenjangOrder[b.jenjang] || 99);
                if (jDiff !== 0) return jDiff;
                return a.level - b.level;
            });

            const completedCount = ALL_LEVEL_OPTIONS.length;
            const highestLevel = completedCount > 0 ?
                Math.max(...ALL_LEVEL_OPTIONS.map(opt => Number(opt.level || 1))) :
                1;

            const levelTitleEl = document.getElementById('kc-user-level-title');
            const levelSubEl = document.getElementById('kc-user-level-sub');
            if (levelTitleEl) {
                levelTitleEl.textContent = completedCount > 0 ? `Level ${highestLevel}` : 'Level 1 (Pemula)';
            }
            if (levelSubEl) {
                levelSubEl.textContent = completedCount > 0 ?
                    `${completedCount} level sudah dituntaskan` :
                    'Belum ada level tuntas';
            }
        }

        function escapeHtml(str) {
            return String(str ?? '')
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;');
        }

        function populateLevelDropdown() {
            const selectEl = document.getElementById('kc-level-select');
            const filteredLevels = selectedSource === 'ALL' ?
                ALL_LEVEL_OPTIONS :
                ALL_LEVEL_OPTIONS.filter(opt => opt.sourceType === selectedSource);

            selectEl.innerHTML = `<option value="ALL">Semua Level (${filteredLevels.length})</option>` +
                filteredLevels.map(opt => {
                    const labelPrefix = opt.sourceType === 'joined' ?
                        `${opt.className} • Level ${opt.level}` :
                        `CodePawth (${opt.jenjang}) • Level ${opt.level}`;
                    return `<option value="${escapeHtml(opt.key)}">${escapeHtml(labelPrefix)} — ${escapeHtml(opt.levelTitle)}</option>`;
                }).join('');
        }

        function selectKcSource(source) {
            selectedSource = source;
            document.querySelectorAll('.kc-source-btn').forEach(btn => {
                const isActive = btn.dataset.source === source;
                btn.className = isActive ?
                    'kc-source-btn px-2.5 py-1 rounded-full text-xs font-extrabold bg-blue-600 text-white shadow-2xs transition-all cursor-pointer' :
                    'kc-source-btn px-2.5 py-1 rounded-full text-xs font-bold bg-slate-100 hover:bg-blue-50 text-slate-600 hover:text-blue-600 transition-all cursor-pointer';
            });
            populateLevelDropdown();
            filterKnowledgeCards();
        }

        function clearKcSearch() {
            const input = document.getElementById('kc-search-input');
            input.value = '';
            input.focus();
            filterKnowledgeCards();
        }

        function resetAllKcFilters() {
            document.getElementById('kc-search-input').value = '';
            selectKcSource('ALL');
        }

        function toggleSingleCardFlip(cardUid) {
            const inner = document.getElementById(`kc-flipper-${cardUid}`);
            if (!inner) return;
            if (flippedSet.has(cardUid)) {
                flippedSet.delete(cardUid);
                inner.classList.remove('is-flipped');
            } else {
                flippedSet.add(cardUid);
                inner.classList.add('is-flipped');
            }
        }

        function toggleFlipAllCards() {
            allFlipped = !allFlipped;
            const label = document.getElementById('text-flip-all-kc');
            if (label) {
                label.textContent = allFlipped ? 'Kembalikan Semua Sisi Depan' : 'Balik Semua Kartu';
            }
            document.querySelectorAll('[data-kc-uid]').forEach(el => {
                const uid = el.dataset.kcUid;
                if (allFlipped) {
                    flippedSet.add(uid);
                    el.classList.add('is-flipped');
                } else {
                    flippedSet.delete(uid);
                    el.classList.remove('is-flipped');
                }
            });
        }

        function filterKnowledgeCards() {
            const searchInput = document.getElementById('kc-search-input');
            const clearBtn = document.getElementById('kc-clear-search');
            const levelSelect = document.getElementById('kc-level-select');
            const query = (searchInput.value || '').trim().toLowerCase();
            const selectedDeck = levelSelect.value;

            if (query.length > 0) {
                clearBtn.classList.remove('hidden');
                clearBtn.classList.add('flex');
            } else {
                clearBtn.classList.add('hidden');
                clearBtn.classList.remove('flex');
            }

            const filtered = ALL_KC_CARDS.filter(card => {
                if (selectedSource !== 'ALL' && card.sourceType !== selectedSource) return false;
                if (selectedDeck !== 'ALL' && card.deckKey !== selectedDeck) return false;

                if (query.length > 0) {
                    const haystack = [
                        card.className,
                        card.jenjang,
                        `level ${card.level}`,
                        card.levelTitle,
                        card.frontJudul,
                        card.frontIsi,
                        card.frontMain,
                        card.backJudul,
                        card.backIsi,
                        card.backMain
                    ].join(' ').toLowerCase();

                    return haystack.includes(query);
                }
                return true;
            });

            renderKnowledgeCards(filtered);
        }

        function renderKnowledgeCards(cards) {
            const grid = document.getElementById('kc-cards-grid');
            const emptyState = document.getElementById('kc-empty-state');
            document.getElementById('kc-visible-count').textContent = cards.length;

            if (cards.length === 0) {
                grid.innerHTML = '';
                const emptyTitle = emptyState.querySelector('h3');
                const emptyDesc = emptyState.querySelector('p');
                const emptyBtn = emptyState.querySelector('button');

                if (ALL_KC_CARDS.length === 0) {
                    if (emptyTitle) emptyTitle.textContent = 'Belum Ada Kartu Flashcard Terbuka';
                    if (emptyDesc) emptyDesc.textContent =
                        'Selesaikan pelajaran dari Kelas Gurumu atau Kelas CodePawth agar kartu Flashcard-nya terbuka di sini.';
                    if (emptyBtn) {
                        emptyBtn.textContent = 'Mulai Belajar di Peta Level';
                        emptyBtn.onclick = () => {
                            window.location.href = KC_DATA.levelViewUrl;
                        };
                    }
                } else {
                    if (emptyTitle) emptyTitle.textContent = 'Kartu Flashcard Tidak Ditemukan';
                    if (emptyDesc) emptyDesc.textContent =
                        'Coba kata kunci lain atau pilih sumber kelas yang berbeda.';
                    if (emptyBtn) {
                        emptyBtn.textContent = 'Reset Filter & Pencarian';
                        emptyBtn.onclick = resetAllKcFilters;
                    }
                }

                emptyState.classList.remove('hidden');
                emptyState.classList.add('flex');
                return;
            }

            emptyState.classList.add('hidden');
            emptyState.classList.remove('flex');

            const sourceOrder = {
                codepawth: 1,
                joined: 2
            };
            const jenjangOrder = {
                SD: 1,
                SMP: 2,
                SMA: 3
            };

            const sourceThemes = {
                codepawth: {
                    sectionBg: 'from-[#F4F8FF] via-white to-[#EEF5FF]',
                    sectionBorder: 'border-blue-200/80',
                    header: 'from-[#DCEAFF] via-[#EAF3FF] to-[#D6E7FF]',
                    pill: 'bg-blue-600 text-white border-blue-600',
                    dot: 'bg-blue-600',
                    starColor: 'text-amber-400'
                },
                joined: {
                    sectionBg: 'from-[#F1FCF6] via-white to-[#EAF9F1]',
                    sectionBorder: 'border-emerald-200/80',
                    header: 'from-[#D4F6E5] via-[#E6FBF0] to-[#CCF3DF]',
                    pill: 'bg-emerald-600 text-white border-emerald-600',
                    dot: 'bg-emerald-600',
                    starColor: 'text-amber-400'
                }
            };

            const groupMap = new Map();
            cards.forEach(card => {
                if (!groupMap.has(card.deckKey)) {
                    groupMap.set(card.deckKey, {
                        key: card.deckKey,
                        sourceType: card.sourceType,
                        className: card.className,
                        jenjang: card.jenjang,
                        level: Number(card.level),
                        levelTitle: card.levelTitle,
                        cards: []
                    });
                }
                groupMap.get(card.deckKey).cards.push(card);
            });

            const sortedGroups = Array.from(groupMap.values()).sort((a, b) => {
                const sDiff = (sourceOrder[a.sourceType] || 9) - (sourceOrder[b.sourceType] || 9);
                if (sDiff !== 0) return sDiff;
                const jDiff = (jenjangOrder[a.jenjang] || 99) - (jenjangOrder[b.jenjang] || 99);
                if (jDiff !== 0) return jDiff;
                return a.level - b.level;
            });

            grid.innerHTML = sortedGroups.map((group, groupIdx) => {
                const theme = sourceThemes[group.sourceType] || sourceThemes.codepawth;
                const mascotSrc = KC_DATA.mascotAssets[groupIdx % KC_DATA.mascotAssets.length];
                const totalDots = Math.min(Math.max(group.cards.length, 3), 5);

                const dotsHtml = Array.from({
                    length: totalDots
                }, (_, idx) => `
                    <span class="w-2 h-2 rounded-full ${idx === 0 ? theme.dot : 'bg-white/90 border border-blue-200'}"></span>
                `).join('');

                const badgeHeaderText = group.sourceType === 'joined' ?
                    `${group.className} • ${group.jenjang}` :
                    `Kelas CodePawth • ${group.jenjang}`;

                const cardsHtml = group.cards.map(card => {
                    const uid = `${card.deckKey}-${card.pairId}`;
                    const isFlipped = flippedSet.has(uid);
                    const iconHtml = kcSvgIcons[card.iconKey] || kcSvgIcons.default;

                    return `
                    <div onclick="toggleSingleCardFlip('${escapeHtml(uid)}')"
                        class="kc-scene min-h-[175px] cursor-pointer group select-none">
                        <div id="kc-flipper-${escapeHtml(uid)}" data-kc-uid="${escapeHtml(uid)}"
                            class="kc-card-3d ${isFlipped ? 'is-flipped' : ''}">

                            <!-- SISI DEPAN KARTU (Persis Gaya Flashcard Utama - Landscape Compact) -->
                            <div
                                class="kc-face rounded-2xl bg-gradient-to-br from-[#F4F9FF] via-white to-[#EBF3FF] border-2 border-blue-100/90 group-hover:border-blue-300 shadow-2xs p-4 flex items-center justify-between gap-3 overflow-hidden transition-colors">
                                <div class="pointer-events-none absolute -bottom-8 -right-8 w-28 h-28 rounded-full bg-blue-100/50"></div>

                                <div class="relative z-10 flex-1 flex flex-col justify-between h-full min-w-0 gap-2.5">
                                    <!-- Baris Badge Kategori & Tombol Klik Balik -->
                                    <div class="flex items-center justify-between gap-2">
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-blue-600 text-white text-[10px] font-bold shadow-2xs truncate">
                                            <span class="inline-flex items-center shrink-0">${iconHtml}</span>
                                            <span class="truncate">${escapeHtml(card.frontJudul)}</span>
                                        </span>
                                        <span class="inline-flex items-center gap-1 text-[10px] font-bold text-blue-600 bg-blue-50 px-2 py-0.5 rounded-full border border-blue-200/70 group-hover:bg-blue-600 group-hover:text-white transition-colors shrink-0">
                                            <span>Klik balik</span>
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.4" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                            </svg>
                                        </span>
                                    </div>

                                    <!-- Konten Utama Landscape -->
                                    <div class="my-auto space-y-1">
                                        <span class="inline-block text-[9px] font-extrabold uppercase tracking-wider text-blue-500">
                                            Sisi Depan • ${escapeHtml(card.jenjang)} Level ${card.level}
                                        </span>
                                        <h3 class="text-lg sm:text-xl font-extrabold text-slate-900 tracking-tight break-words leading-snug">
                                            ${escapeHtml(card.frontIsi)}
                                        </h3>
                                        <p class="text-xs text-slate-600 leading-relaxed line-clamp-2">
                                            ${escapeHtml(card.frontMain)}
                                        </p>
                                    </div>

                                    <!-- Footer Mini -->
                                    <div class="flex items-center justify-between gap-2 pt-0.5">
                                        <span class="text-[10px] font-semibold text-slate-400 truncate">
                                            Ketuk kartu untuk melihat artinya
                                        </span>
                                        <a href="${escapeHtml(card.materiUrl)}" onclick="event.stopPropagation()"
                                            class="inline-flex items-center gap-0.5 text-[11px] font-extrabold text-blue-600 hover:text-blue-700 shrink-0">
                                            <span>Buka Materi</span>
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>

                                <!-- Ilustrasi Maskot di Sisi Kanan Kartu Landscape -->
                                <div class="hidden sm:flex relative z-10 w-20 h-20 shrink-0 items-center justify-center">
                                    <img src="${KC_DATA.cardMascotUrl}" alt="Ilustrasi Konsep"
                                        class="w-full h-full object-contain drop-shadow-2xs">
                                </div>
                            </div>

                            <!-- SISI BELAKANG KARTU (Persis Gaya Flashcard Utama - Biru Indigo) -->
                            <div
                                class="kc-face kc-face-back rounded-2xl bg-gradient-to-br from-blue-600 via-blue-600 to-indigo-700 text-white border-2 border-blue-500 shadow-sm p-4 flex flex-col justify-between gap-2.5 overflow-hidden">
                                <div class="pointer-events-none absolute -top-10 -right-10 w-32 h-32 rounded-full bg-white/10"></div>

                                <div class="relative z-10 flex items-center justify-between gap-2">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-white/20 text-white text-[10px] font-bold truncate">
                                        <svg class="w-3 h-3 shrink-0" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 .75a8.25 8.25 0 00-4.135 15.39c.686.398 1.115 1.008 1.134 1.623a.75.75 0 00.577.706c.352.083.71.148 1.074.195.323.041.6-.218.6-.544v-4.661a6.714 6.714 0 01-.937-.171.75.75 0 11.374-1.453 5.261 5.261 0 002.626 0 .75.75 0 11.374 1.452 6.712 6.712 0 01-.937.172v4.66c0 .327.277.586.6.545.364-.047.722-.112 1.074-.195a.75.75 0 00.577-.706c.02-.615.448-1.225 1.134-1.623A8.25 8.25 0 0012 .75z"/>
                                            <path fill-rule="evenodd" d="M9.013 19.9a.75.75 0 01.877-.597 11.319 11.319 0 004.22 0 .75.75 0 11.28 1.473 12.819 12.819 0 01-4.78 0 .75.75 0 01-.597-.876zM9.754 22.344a.75.75 0 01.824-.668 13.682 13.682 0 002.844 0 .75.75 0 11.156 1.492 15.156 15.156 0 01-3.156 0 .75.75 0 01-.668-.824z" clip-rule="evenodd"/>
                                        </svg>
                                        <span class="truncate">${escapeHtml(card.backJudul)}</span>
                                    </span>
                                    <span class="inline-flex items-center gap-1 text-[10px] font-bold bg-white text-blue-600 px-2 py-0.5 rounded-full shrink-0">
                                        <span>Kembali</span>
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.4" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                        </svg>
                                    </span>
                                </div>

                                <div class="relative z-10 my-auto space-y-1.5">
                                    <div>
                                        <span class="text-[9px] uppercase tracking-wider font-extrabold text-blue-200">
                                            Pasangan dari ${escapeHtml(card.frontIsi)}:
                                        </span>
                                        <p class="text-sm sm:text-base font-extrabold text-white leading-snug mt-0.5">
                                            ${escapeHtml(card.backIsi)}
                                        </p>
                                    </div>

                                    <div class="rounded-xl bg-slate-900/40 border border-white/15 px-3 py-1.5 text-[11px] text-blue-100 font-medium leading-relaxed">
                                        ${escapeHtml(card.backMain)}
                                    </div>
                                </div>

                                <div class="relative z-10 flex items-center justify-between gap-2 text-[10px] text-blue-200 font-medium">
                                    <span>Ketuk untuk kembali ke depan</span>
                                    <a href="${escapeHtml(card.materiUrl)}" onclick="event.stopPropagation()"
                                        class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-white/20 hover:bg-white/30 text-white font-bold transition-colors">
                                        <span>Latihan</span>
                                        <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                    `;
                }).join('');

                return `
                <section class="relative bg-gradient-to-b ${theme.sectionBg} rounded-3xl border-2 border-white ring-1 ${theme.sectionBorder} shadow-soft-card">
                    <!-- DEKORASI AWAN, BINTANG & PAW DI DALAM KOTAKAN SECTION LEVEL -->
                    <div class="pointer-events-none absolute inset-0 overflow-hidden rounded-3xl" aria-hidden="true">
                        <svg class="absolute -bottom-3 -right-4 w-44 h-24 opacity-80" viewBox="0 0 200 100" fill="none">
                            <circle cx="155" cy="75" r="42" fill="#DCEAFF" fill-opacity="0.75"/>
                            <circle cx="110" cy="82" r="32" fill="#E6F0FF" fill-opacity="0.85"/>
                            <circle cx="72" cy="88" r="24" fill="#DCEAFF" fill-opacity="0.7"/>
                        </svg>
                        <svg class="absolute -bottom-3 -left-4 w-40 h-20 opacity-75" viewBox="0 0 180 90" fill="none">
                            <circle cx="35" cy="70" r="38" fill="#DCEAFF" fill-opacity="0.75"/>
                            <circle cx="78" cy="78" r="28" fill="#E6F0FF" fill-opacity="0.85"/>
                        </svg>
                        <svg class="absolute bottom-3 right-8 w-12 h-12 text-blue-300/35 -rotate-12" viewBox="0 0 100 100">
                            <use href="#natural-blue-paw"/>
                        </svg>
                        <svg class="absolute top-14 left-5 w-4 h-4 text-amber-300/80" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 1L14.5 9.5L23 12L14.5 14.5L12 23L9.5 14.5L1 12L9.5 9.5L12 1Z"/>
                        </svg>
                        <svg class="hidden sm:block absolute bottom-6 left-1/3 w-3.5 h-3.5 text-blue-300/70" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 1L14.5 9.5L23 12L14.5 14.5L12 23L9.5 14.5L1 12L9.5 9.5L12 1Z"/>
                        </svg>
                    </div>

                    <!-- HEADER SECTION DIVIDER LEVEL -->
                    <div class="relative bg-gradient-to-r ${theme.header} rounded-t-3xl px-4 sm:px-5 py-3 border-b border-white/80 flex items-center justify-between gap-3">
                        <div class="pointer-events-none absolute inset-0 overflow-hidden rounded-t-3xl" aria-hidden="true">
                            <div class="absolute -top-6 left-36 w-24 h-24 rounded-full bg-white/45"></div>
                            <div class="absolute -bottom-8 right-32 w-28 h-28 rounded-full bg-white/40"></div>
                            <svg class="absolute top-2 right-36 w-4 h-4 text-amber-400/85" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 1L14.5 9.5L23 12L14.5 14.5L12 23L9.5 14.5L1 12L9.5 9.5L12 1Z"/>
                            </svg>
                            <svg class="hidden sm:block absolute bottom-2 left-1/2 w-3.5 h-3.5 text-white" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 1L14.5 9.5L23 12L14.5 14.5L12 23L9.5 14.5L1 12L9.5 9.5L12 1Z"/>
                            </svg>
                        </div>

                        <div class="relative z-10 flex items-center gap-2.5 flex-wrap min-w-0 pr-20 sm:pr-28">
                            <div class="w-8 h-8 rounded-xl bg-white border border-amber-200 flex items-center justify-center ${theme.starColor} shrink-0 shadow-2xs">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd"/>
                                </svg>
                            </div>

                            <span class="px-2.5 py-0.5 rounded-full border ${theme.pill} text-xs font-extrabold tracking-wide shrink-0 shadow-2xs">
                                ${escapeHtml(badgeHeaderText)}
                            </span>

                            <h2 class="text-base sm:text-lg font-extrabold text-slate-900 shrink-0">
                                Level ${group.level}
                            </h2>

                            <span class="px-3 py-0.5 rounded-full bg-white/95 border border-white text-xs font-bold text-slate-700 shadow-2xs truncate max-w-full">
                                ${escapeHtml(group.levelTitle)}
                            </span>
                        </div>

                        <div class="relative z-10 flex items-center gap-3 shrink-0">
                            <div class="hidden sm:flex items-center gap-1.5 mr-20">
                                ${dotsHtml}
                            </div>
                        </div>

                        <img
                            src="${mascotSrc}"
                            alt="Maskot Level ${group.level}"
                            class="pointer-events-none absolute -top-4 right-3 sm:right-5 w-16 h-14 sm:w-20 sm:h-16 object-contain object-bottom drop-shadow-xs z-20"
                        >
                    </div>

                    <!-- Grid Kartu Flashcard Landscape Compact (2 Kolom) -->
                    <div class="relative z-10 p-4 sm:p-5 grid grid-cols-1 lg:grid-cols-2 gap-4">
                        ${cardsHtml}
                    </div>
                </section>
                `;
            }).join('');
        }

        document.addEventListener('DOMContentLoaded', () => {
            const savedHidden = localStorage.getItem('codepawth_kc_header_hidden') === 'true';
            window.applyKcHeaderState(savedHidden);

            buildCardsFromMateriDecks();
            populateLevelDropdown();
            filterKnowledgeCards();
        });
    </script>
@endpush
