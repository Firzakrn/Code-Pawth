@extends('layouts.materi')

@section('title', 'Belajar Flashcard — Code Pawth')
@section('materi_step', 'flashcard')
@section('materi_speech', 'Balik setiap kartu untuk menghafal pasangannya!')

@section('materi_stats')
    <div
        class="bg-white/95 backdrop-blur-xs rounded-2xl border border-white shadow-soft-card px-5 py-2 sm:px-6 flex flex-col md:flex-row items-stretch md:items-center justify-between gap-3 shrink-0">
        <div class="flex items-center gap-5 sm:gap-7">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-xl bg-amber-50 flex items-center justify-center text-amber-400">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    <div class="text-sm font-extrabold text-slate-900 leading-tight">
                        <span id="fc-cards-viewed">1</span> / <span id="fc-cards-total">4</span>
                    </div>
                    <div class="text-[11px] text-slate-500 font-medium">Kartu Dipelajari</div>
                </div>
            </div>

            <div class="w-px h-6 bg-slate-200"></div>

            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                        <path
                            d="M11.25 4.533A9.707 9.707 0 006 3a9.735 9.735 0 00-3.25.555.75.75 0 00-.5.707v14.25a.75.75 0 001 .707A8.237 8.237 0 016 18.75c1.995 0 3.823.707 5.25 1.886V4.533zM12.75 20.636A8.214 8.214 0 0118 18.75c.966 0 1.89.166 2.75.47a.75.75 0 001-.708V4.262a.75.75 0 00-.5-.707A9.735 9.735 0 0018 3a9.707 9.707 0 00-5.25 1.533v16.103z" />
                    </svg>
                </div>
                <div>
                    <div class="text-sm font-extrabold text-slate-900 leading-tight">Mode Flashcard</div>
                    <div id="fc-stage-sub" class="text-[11px] text-slate-500 font-medium">Isi materi depan &amp; belakang
                        jadi soal evaluasi</div>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3 flex-1 md:max-w-md">
            <div class="flex-1 h-2.5 bg-slate-100 rounded-full overflow-hidden p-0.5 border border-slate-200/60">
                <div id="fc-progress-bar"
                    class="h-full bg-gradient-to-r from-blue-500 to-blue-600 rounded-full transition-all duration-300"
                    style="width: 25%;"></div>
            </div>
            <span id="fc-progress-percent" class="text-xs font-extrabold text-slate-700 w-10 text-right">25%</span>
        </div>
    </div>
@endsection

@section('materi_tab_right')
    <span id="slide-counter-text" class="text-xs font-extrabold text-slate-600">1 / 4</span>
    <div id="slide-dots" class="flex items-center gap-1"></div>
@endsection

@section('materi_content')
    <!-- Style 3D Flip langsung di dalam konten agar tidak bergantung pada @stack('styles') -->
    <style>
        .fc-scene {
            perspective: 1100px;
        }

        .fc-card-3d {
            position: relative;
            width: 100%;
            height: 100%;
            transition: transform 0.55s cubic-bezier(0.22, 1, 0.36, 1);
            transform-style: preserve-3d;
            -webkit-transform-style: preserve-3d;
        }

        .fc-card-3d.is-flipped {
            transform: rotateY(180deg);
        }

        .fc-face {
            position: absolute;
            inset: 0;
            backface-visibility: hidden;
            -webkit-backface-visibility: hidden;
        }

        .fc-face-back {
            transform: rotateY(180deg);
        }
    </style>

    <div class="flex-1 min-h-0 grid grid-cols-1 lg:grid-cols-12 gap-4">

        <!-- KOLOM KIRI (8/12): KARTU BOLAK-BALIK -->
        <div
            class="lg:col-span-8 flex-1 min-h-0 bg-white/95 backdrop-blur-xs rounded-3xl rounded-tl-xl border-2 border-white shadow-soft-card p-4 sm:p-5 flex flex-col justify-between gap-3">

            <div class="flex-1 min-h-0 flex items-center justify-between gap-2 sm:gap-4">

                <!-- Tombol Sebelumnya -->
                <button type="button" id="btn-prev-card" onclick="prevCard()" aria-label="Kartu Sebelumnya"
                    class="w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-white hover:bg-blue-50 text-slate-600 hover:text-blue-600 border border-slate-200 shadow-sm flex items-center justify-center shrink-0 transition-all cursor-pointer disabled:opacity-40 disabled:cursor-not-allowed">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>

                <!-- KARTU 3D FLIP -->
                <div onclick="flipCard()" class="fc-scene flex-1 h-full min-h-[220px] cursor-pointer group select-none">
                    <div id="flashcard-inner" class="fc-card-3d">

                        <!-- SISI DEPAN KARTU (kategori: 'front') -->
                        <div
                            class="fc-face rounded-2xl bg-gradient-to-br from-[#F4F9FF] via-white to-[#EBF3FF] border-2 border-blue-100/90 shadow-sm p-5 sm:p-6 flex items-center justify-between gap-4 overflow-hidden">
                            <div
                                class="pointer-events-none absolute -bottom-10 -right-10 w-36 h-36 rounded-full bg-blue-100/50">
                            </div>

                            <div class="relative z-10 flex-1 flex flex-col justify-between h-full min-w-0">
                                <div class="flex items-center justify-between gap-2">
                                    <span
                                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-600 text-white text-[11px] font-bold shadow-2xs">
                                        <span id="front-icon-badge" class="inline-flex items-center"></span>
                                        <span id="front-judul-badge">Konsep Dasar</span>
                                    </span>
                                    <span
                                        class="inline-flex items-center gap-1.5 text-[11px] font-bold text-blue-600 bg-blue-50 px-2.5 py-1 rounded-full border border-blue-200/70 group-hover:bg-blue-600 group-hover:text-white transition-colors shrink-0">
                                        <span>Klik balik</span>
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.4"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                        </svg>
                                    </span>
                                </div>

                                <div class="my-auto py-2 space-y-1.5">
                                    <span
                                        class="inline-block text-[10px] font-extrabold uppercase tracking-wider text-blue-500">
                                        Sisi Depan (Domain Evaluasi)
                                    </span>
                                    <h2 id="front-isi-materi"
                                        class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight break-words">
                                        print()
                                    </h2>
                                    <p id="front-main-materi" class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                                        Perintah dasar Python untuk mencetak informasi ke konsol
                                    </p>
                                </div>

                                <div class="text-[11px] font-semibold text-slate-400">
                                    Ketuk kartu untuk melihat sisi belakangnya
                                </div>
                            </div>

                            <!-- Ilustrasi Maskot di Sisi Depan -->
                            <div
                                class="hidden sm:flex relative z-10 w-32 h-32 lg:w-36 lg:h-36 shrink-0 items-center justify-center">
                                <img src="{{ asset('images/mascot_dashboard.png') }}" alt="Ilustrasi Konsep"
                                    class="w-full h-full object-contain drop-shadow-sm">
                            </div>
                        </div>

                        <!-- SISI BELAKANG KARTU (kategori: 'back') -->
                        <div
                            class="fc-face fc-face-back rounded-2xl bg-gradient-to-br from-blue-600 via-blue-600 to-indigo-700 text-white border-2 border-blue-500 shadow-md p-5 sm:p-6 flex flex-col justify-between overflow-hidden">
                            <div class="pointer-events-none absolute -top-12 -right-12 w-40 h-40 rounded-full bg-white/10">
                            </div>

                            <div class="relative z-10 flex items-center justify-between gap-2">
                                <span
                                    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/20 text-white text-[11px] font-bold">
                                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="currentColor">
                                        <path
                                            d="M12 .75a8.25 8.25 0 00-4.135 15.39c.686.398 1.115 1.008 1.134 1.623a.75.75 0 00.577.706c.352.083.71.148 1.074.195.323.041.6-.218.6-.544v-4.661a6.714 6.714 0 01-.937-.171.75.75 0 11.374-1.453 5.261 5.261 0 002.626 0 .75.75 0 11.374 1.452 6.712 6.712 0 01-.937.172v4.66c0 .327.277.586.6.545.364-.047.722-.112 1.074-.195a.75.75 0 00.577-.706c.02-.615.448-1.225 1.134-1.623A8.25 8.25 0 0012 .75z" />
                                        <path fill-rule="evenodd"
                                            d="M9.013 19.9a.75.75 0 01.877-.597 11.319 11.319 0 004.22 0 .75.75 0 11.28 1.473 12.819 12.819 0 01-4.78 0 .75.75 0 01-.597-.876zM9.754 22.344a.75.75 0 01.824-.668 13.682 13.682 0 002.844 0 .75.75 0 11.156 1.492 15.156 15.156 0 01-3.156 0 .75.75 0 01-.668-.824z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span id="back-judul-badge">Sisi Belakang Kartu</span>
                                </span>
                                <span
                                    class="inline-flex items-center gap-1.5 text-[11px] font-bold bg-white text-blue-600 px-2.5 py-1 rounded-full shrink-0">
                                    <span>Kembali ke depan</span>
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.4"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                </span>
                            </div>

                            <div class="relative z-10 my-auto space-y-2.5">
                                <div>
                                    <span class="text-[10px] uppercase tracking-wider font-extrabold text-blue-200">
                                        Pasangan Kodomain di Evaluasi:
                                    </span>
                                    <p id="back-isi-materi"
                                        class="text-lg sm:text-xl font-extrabold text-white leading-snug mt-0.5">
                                        Menampilkan teks atau hasil ke layar
                                    </p>
                                </div>

                                <div
                                    class="rounded-xl bg-slate-900/40 border border-white/15 px-3.5 py-2.5 text-xs text-blue-100 font-medium">
                                    <span id="back-main-materi">Contoh: print("Halo, CodePawth!")</span>
                                </div>
                            </div>

                            <div class="relative z-10 text-[11px] text-blue-200 font-medium">
                                Cocokkan sisi depan dan belakang ini saat Evaluasi
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Tombol Berikutnya -->
                <button type="button" id="btn-next-card" onclick="nextCard()" aria-label="Kartu Berikutnya"
                    class="w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-white hover:bg-blue-50 text-slate-600 hover:text-blue-600 border border-slate-200 shadow-sm flex items-center justify-center shrink-0 transition-all cursor-pointer disabled:opacity-40 disabled:cursor-not-allowed">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>

            <!-- Kotak Callout Bawah: Pasangan Kartu -->
            <div class="rounded-2xl bg-slate-50 border border-slate-200/70 px-4 py-2.5 flex items-center gap-3 shrink-0">
                <div class="w-9 h-9 rounded-xl bg-amber-100/80 text-amber-500 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                        <path
                            d="M12 .75a8.25 8.25 0 00-4.135 15.39c.686.398 1.115 1.008 1.134 1.623a.75.75 0 00.577.706c.352.083.71.148 1.074.195.323.041.6-.218.6-.544v-4.661a6.714 6.714 0 01-.937-.171.75.75 0 11.374-1.453 5.261 5.261 0 002.626 0 .75.75 0 11.374 1.452 6.712 6.712 0 01-.937.172v4.66c0 .327.277.586.6.545.364-.047.722-.112 1.074-.195a.75.75 0 00.577-.706c.02-.615.448-1.225 1.134-1.623A8.25 8.25 0 0012 .75z" />
                        <path fill-rule="evenodd"
                            d="M9.013 19.9a.75.75 0 01.877-.597 11.319 11.319 0 004.22 0 .75.75 0 11.28 1.473 12.819 12.819 0 01-4.78 0 .75.75 0 01-.597-.876zM9.754 22.344a.75.75 0 01.824-.668 13.682 13.682 0 002.844 0 .75.75 0 11.156 1.492 15.156 15.156 0 01-3.156 0 .75.75 0 01-.668-.824z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="min-w-0">
                    <span class="block text-xs font-extrabold text-blue-600">Pasangan Kartu</span>
                    <p id="card-pair-preview" class="text-xs sm:text-sm font-semibold text-slate-700 truncate">
                        Balik kartu untuk melihat pasangan dari konsep ini.
                    </p>
                </div>
            </div>

        </div>

        <!-- KOLOM KANAN (4/12): KARTU AJAKAN TAHAP BERIKUTNYA -->
        <div id="next-stage-card"
            class="lg:col-span-4 bg-white/95 backdrop-blur-xs rounded-3xl border-2 border-white shadow-soft-card p-5 flex flex-col justify-between items-center text-center opacity-55 grayscale-[30%] select-none transition-all duration-300">

            <div class="w-full flex items-center justify-between">
                <span id="next-stage-badge"
                    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-100 text-slate-500 border border-slate-200 text-xs font-extrabold transition-colors">
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>Tahap Berikutnya Terkunci</span>
                </span>
            </div>

            <div class="my-auto flex flex-col items-center px-2">
                <div
                    class="w-28 h-28 sm:w-32 sm:h-32 rounded-full bg-gradient-to-b from-blue-50 to-indigo-50 border border-blue-100 flex items-center justify-center p-2 mb-3">
                    <img src="{{ asset('images/mascot_dashboard.png') }}" alt="Maskot"
                        class="w-full h-full object-contain drop-shadow-xs">
                </div>

                <h3 id="next-stage-heading" class="text-base sm:text-lg font-extrabold text-slate-900 leading-snug">
                    Siap untuk tahap berikutnya?
                </h3>
                <p id="next-stage-desc" class="text-xs text-slate-500 mt-1.5 leading-relaxed">
                    Pelajari semua kartu flashcard terlebih dahulu untuk membuka tahap selanjutnya.
                </p>
            </div>

            <a id="cta-next-stage-btn" href="#" data-locked="true"
                onclick="if(this.dataset.locked === 'true') { event.preventDefault(); }"
                class="w-full inline-flex items-center justify-center gap-2 bg-slate-300 text-slate-500 font-bold text-sm py-3 px-5 rounded-2xl pointer-events-none cursor-not-allowed transition-all duration-300">
                <span id="cta-next-stage-text">Selesaikan Materi (1/4)</span>
            </a>

        </div>

    </div>
@endsection

@push('scripts')
    <script>
        const fcSvgIcons = {
            monitor: `<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2"/><path stroke-linecap="round" d="M8 21h8m-4-4v4"/></svg>`,
            keyboard: `<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><rect x="2" y="5" width="20" height="14" rx="2"/><path stroke-linecap="round" d="M6 9h.01M10 9h.01M14 9h.01M18 9h.01M8 15h8"/></svg>`,
            text: `<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 7V5h16v2M12 5v14m-3 0h6"/></svg>`,
            number: `<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/></svg>`,
            box: `<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8l-9-5-9 5v8l9 5 9-5V8z"/><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l9 5 9-5M12 13v8"/></svg>`,
            plus: `<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.4" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m-7-7h14"/></svg>`,
            loop: `<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>`,
            branch: `<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><circle cx="6" cy="6" r="2.5"/><circle cx="18" cy="18" r="2.5"/><circle cx="18" cy="6" r="2.5"/><path stroke-linecap="round" d="M6 8.5v7A2.5 2.5 0 008.5 18h7M6 8.5A2.5 2.5 0 018.5 6h7"/></svg>`,
            note: `<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h4m4 5H7a2 2 0 01-2-2V5a2 2 0 012-2h7l5 5v11a2 2 0 01-2 2z"/></svg>`,
            default: `<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>`
        };

        // Ambil pasangan kartu (front + back) langsung dari layout materi
        const pairedCards = window.getPairedMateriCards();
        const {
            hasFlowchart,
            flowchartUrl,
            evaluasiUrl
        } = window.MATERI_CTX;

        let currentIndex = 0;
        let isFlipped = false;
        let visitedSet = new Set([0]);

        function updateNextStepLockState(isCompleted) {
            const sideCard = document.getElementById('next-stage-card');
            const sideBadge = document.getElementById('next-stage-badge');
            const sideHeading = document.getElementById('next-stage-heading');
            const sideDesc = document.getElementById('next-stage-desc');
            const ctaBtn = document.getElementById('cta-next-stage-btn');
            const ctaText = document.getElementById('cta-next-stage-text');
            const mascotSpeech = document.getElementById('materi-mascot-speech');

            const nextUrl = hasFlowchart ? flowchartUrl : evaluasiUrl;
            const nextTabId = hasFlowchart ? 'nav-tab-flowchart' : 'nav-tab-evaluasi';
            const nextIconId = hasFlowchart ? 'nav-tab-flowchart-icon' : 'nav-tab-evaluasi-icon';
            const nextLabel = hasFlowchart ? 'Mulai Susun Flowchart' : 'Mulai Evaluasi';

            if (isCompleted) {
                window.unlockMateriTab(nextTabId, nextIconId, nextLabel);

                sideCard.classList.remove('opacity-55', 'grayscale-[30%]', 'select-none');
                sideBadge.className =
                    'inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-indigo-50 text-indigo-600 border border-indigo-100 text-xs font-extrabold transition-colors';
                sideBadge.innerHTML = `
                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="currentColor">
                    <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd"/>
                </svg>
                <span>${hasFlowchart ? 'Flowchart Siap!' : 'Evaluasi Siap!'}</span>
            `;

                sideHeading.textContent = hasFlowchart ?
                    'Siap menyusun diagram Flowchart?' :
                    'Siap menguji pemahamanmu?';

                sideDesc.textContent = hasFlowchart ?
                    'Susun blok simbol flowchart sesuai alur logika, lalu lanjut ke Evaluasi!' :
                    'Cocokkan isi materi depan (Domain) dengan sisi belakangnya (Kodomain)!';

                ctaBtn.href = nextUrl;
                ctaBtn.dataset.locked = 'false';
                ctaBtn.className =
                    'w-full inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm py-3 px-5 rounded-2xl shadow-soft-blue hover:-translate-y-0.5 transition-all duration-300 cursor-pointer';
                ctaBtn.innerHTML = `
                <span>${nextLabel}</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                </svg>
            `;

                if (mascotSpeech) {
                    mascotSpeech.textContent = hasFlowchart ?
                        'Kartu selesai! Lanjut susun Flowchart dulu ya!' :
                        'Semua kartu sudah dipelajari! Ayo lanjut Evaluasi!';
                }
            } else {
                window.lockMateriTab(nextTabId, nextIconId, 'Selesaikan semua kartu Flashcard terlebih dahulu');
                sideCard.classList.add('opacity-55', 'grayscale-[30%]', 'select-none');
                ctaBtn.dataset.locked = 'true';
                ctaBtn.className =
                    'w-full inline-flex items-center justify-center gap-2 bg-slate-300 text-slate-500 font-bold text-sm py-3 px-5 rounded-2xl pointer-events-none cursor-not-allowed transition-all duration-300';
                if (ctaText) ctaText.textContent = `Selesaikan Materi (${visitedSet.size}/${pairedCards.length})`;
            }
        }

        function renderFlashcard() {
            if (!pairedCards.length) return;

            const pair = pairedCards[currentIndex];
            const front = pair.front;
            const back = pair.back;

            visitedSet.add(currentIndex);
            isFlipped = false;

            const inner = document.getElementById('flashcard-inner');
            inner.classList.remove('is-flipped');

            // Isi sisi depan (kategori: 'front')
            document.getElementById('front-icon-badge').innerHTML = fcSvgIcons[front.iconKey] || fcSvgIcons.default;
            document.getElementById('front-judul-badge').textContent = front.judul;
            document.getElementById('front-isi-materi').textContent = front.isi_materi;
            document.getElementById('front-main-materi').textContent = front.main_materi;

            // Isi sisi belakang (kategori: 'back')
            document.getElementById('back-judul-badge').textContent = back.judul;
            document.getElementById('back-isi-materi').textContent = back.isi_materi;
            document.getElementById('back-main-materi').textContent = back.main_materi;

            // Callout pasangan bawah
            document.getElementById('card-pair-preview').textContent = 'Klik kartu untuk membalik dan melihat pasangannya.';

            // Navigasi & Indikator Slide
            document.getElementById('slide-counter-text').textContent = `${currentIndex + 1} / ${pairedCards.length}`;
            document.getElementById('btn-prev-card').disabled = (currentIndex === 0);
            document.getElementById('btn-next-card').disabled = (currentIndex === pairedCards.length - 1);

            document.getElementById('slide-dots').innerHTML = pairedCards.map((_, idx) => `
            <button type="button" onclick="goToCard(${idx})" aria-label="Kartu ${idx + 1}" class="h-2 rounded-full transition-all cursor-pointer ${idx === currentIndex ? 'w-5 bg-blue-600' : 'w-2 bg-slate-300 hover:bg-blue-300'}"></button>
        `).join('');

            // Progres
            const pct = Math.round((visitedSet.size / pairedCards.length) * 100);
            document.getElementById('fc-cards-viewed').textContent = visitedSet.size;
            document.getElementById('fc-cards-total').textContent = pairedCards.length;
            document.getElementById('fc-progress-bar').style.width = `${pct}%`;
            document.getElementById('fc-progress-percent').textContent = `${pct}%`;

            updateNextStepLockState(visitedSet.size >= pairedCards.length);
        }

        function flipCard() {
            const pair = pairedCards[currentIndex];
            if (!pair) return;

            isFlipped = !isFlipped;
            const inner = document.getElementById('flashcard-inner');
            const pairPreview = document.getElementById('card-pair-preview');

            if (isFlipped) {
                inner.classList.add('is-flipped');
                pairPreview.textContent = `${pair.front.isi_materi}  →  ${pair.back.isi_materi}`;
            } else {
                inner.classList.remove('is-flipped');
                pairPreview.textContent = 'Klik kartu untuk membalik dan melihat pasangannya.';
            }
        }

        function prevCard() {
            if (currentIndex > 0) {
                currentIndex--;
                renderFlashcard();
            }
        }

        function nextCard() {
            if (currentIndex < pairedCards.length - 1) {
                currentIndex++;
                renderFlashcard();
            }
        }

        function goToCard(idx) {
            if (idx >= 0 && idx < pairedCards.length) {
                currentIndex = idx;
                renderFlashcard();
            }
        }

        // Dukungan keyboard (Panah Kiri/Kanan untuk geser, Spasi/Enter untuk balik kartu)
        document.addEventListener('keydown', (e) => {
            if (['INPUT', 'TEXTAREA'].includes(document.activeElement.tagName)) return;
            if (e.key === 'ArrowLeft') prevCard();
            if (e.key === 'ArrowRight') nextCard();
            if (e.key === ' ') {
                e.preventDefault();
                flipCard();
            }
        });

        document.addEventListener('DOMContentLoaded', () => {
            if (hasFlowchart) {
                document.getElementById('fc-stage-sub').textContent = 'Urutan: Flashcard → Flowchart → Evaluasi';
            }
            renderFlashcard();
        });
    </script>
@endpush
