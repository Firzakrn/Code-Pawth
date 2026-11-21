@extends('layouts.app')

@section('title', 'Belajar Flashcard — Code Pawth')

@push('styles')
    <style>
        .perspective-1000 {
            perspective: 1000px;
        }

        .transform-style-3d {
            transform-style: preserve-3d;
        }

        .backface-hidden {
            backface-visibility: hidden;
            -webkit-backface-visibility: hidden;
        }

        .rotate-y-180 {
            transform: rotateY(180deg);
        }
    </style>
@endpush

@section('content')
    <!-- Dekorasi Awan & Kilau Background -->
    <div class="pointer-events-none absolute inset-0 overflow-hidden z-0" aria-hidden="true">
        <div class="absolute -top-10 left-24 w-60 h-60 rounded-full bg-white/50"></div>
        <svg class="absolute -top-6 -right-10 w-[420px] h-auto" viewBox="0 0 560 300" fill="none">
            <circle cx="430" cy="70" r="145" fill="#DCEAFF" fill-opacity="0.75" />
            <circle cx="310" cy="115" r="95" fill="#E3EFFF" fill-opacity="0.8" />
        </svg>
        <svg class="absolute -bottom-8 -left-10 w-[360px] h-auto" viewBox="0 0 420 220" fill="none">
            <circle cx="60" cy="185" r="110" fill="#D7E7FF" fill-opacity="0.8" />
            <circle cx="175" cy="200" r="95" fill="#E2EEFF" fill-opacity="0.85" />
        </svg>
        <svg class="hidden md:block absolute top-10 left-[46%] w-5 h-5 text-blue-300" viewBox="0 0 24 24"
            fill="currentColor">
            <path d="M12 1L14.5 9.5L23 12L14.5 14.5L12 23L9.5 14.5L1 12L9.5 9.5L12 1Z" />
        </svg>
    </div>

    <!-- Top Navigation Bar -->
    <header class="relative z-10 px-5 sm:px-7 pt-3 pb-1 flex items-center justify-between shrink-0">
        <a id="back-to-map-link" href="{{ url('/level-view') }}"
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
            <span
                class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/90 border border-blue-100 text-xs font-semibold text-slate-600 shadow-2xs">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                Mode Tamu Aktif
            </span>
            <a href="{{ url('/login') }}"
                class="inline-flex items-center gap-1.5 bg-white hover:bg-blue-50 text-blue-600 border border-blue-200/80 text-xs font-bold px-3.5 py-1.5 rounded-full shadow-2xs transition-colors">
                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z"
                        clip-rule="evenodd" />
                </svg>
                <span>Simpan Akun</span>
            </a>
        </div>
    </header>

    <!-- Main Container -->
    <main class="relative z-10 flex-1 min-h-0 flex flex-col px-5 sm:px-7 pb-4 max-w-6xl w-full mx-auto gap-2.5">

        <!-- Header Jenjang + Mascot Penyemangat -->
        <div class="relative flex flex-col md:flex-row md:items-center justify-between gap-2 shrink-0">
            <div
                class="bg-white/95 backdrop-blur-xs rounded-2xl border border-white shadow-soft-card px-4 py-2 flex items-center gap-3.5 max-w-md z-10">
                <div
                    class="w-10 h-10 rounded-xl bg-blue-50 border border-blue-100 flex items-center justify-center overflow-hidden shrink-0">
                    <img src="{{ asset('images/mascot_peek.png') }}" alt="Avatar" class="w-9 h-9 object-contain">
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2">
                        <h1 id="fc-jenjang-label" class="text-base sm:text-lg font-extrabold text-slate-900">SD</h1>
                        <span id="fc-level-pill"
                            class="px-2.5 py-0.5 rounded-full bg-blue-100 text-blue-700 text-[11px] font-bold">
                            Level 1
                        </span>
                    </div>
                    <p id="fc-level-title" class="text-xs text-slate-500 truncate">Kenalan dengan Python</p>
                </div>
            </div>

            <!-- Speech Bubble & Maskot -->
            <div class="hidden md:flex items-center gap-2.5 self-end z-10">
                <div id="fc-mascot-speech"
                    class="bg-white/95 px-3.5 py-2 rounded-2xl rounded-br-xs shadow-soft-card border border-blue-100 text-xs font-bold text-slate-700">
                    Baca semua kartu dulu sebelum evaluasi ya! <span class="text-amber-400">★</span>
                </div>
                <img src="{{ asset('images/mascot_peek.png') }}" alt="Maskot"
                    class="w-16 h-14 object-contain object-bottom drop-shadow-xs">
            </div>
        </div>

        <!-- Bar Progres Kartu -->
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
                        <div id="fc-stage-title" class="text-sm font-extrabold text-slate-900 leading-tight">Mode Flashcard
                        </div>
                        <div class="text-[11px] text-slate-500 font-medium">Klik kartu untuk membalik</div>
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

        <!-- AREA KONTEN UTAMA: KIRI (FLASHCARD) & KANAN (AJAKAN EVALUASI) -->
        <div class="flex-1 min-h-0 grid grid-cols-1 lg:grid-cols-12 gap-4">

            <!-- KOLOM KIRI (8/12): FOLDER TAB BELAJAR & KARTU BOLAK-BALIK -->
            <div class="lg:col-span-8 flex flex-col min-h-0">

                <!-- Tab Folder Atas (Belajar vs Evaluasi) -->
                <div class="flex items-end justify-between px-2 shrink-0">
                    <div class="flex items-center gap-1.5">
                        <!-- Tab Aktif: Belajar -->
                        <div
                            class="inline-flex items-center gap-2 px-5 py-2 rounded-t-2xl bg-blue-600 text-white text-xs sm:text-sm font-extrabold shadow-2xs">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M11.25 4.533A9.707 9.707 0 006 3a9.735 9.735 0 00-3.25.555.75.75 0 00-.5.707v14.25a.75.75 0 001 .707A8.237 8.237 0 016 18.75c1.995 0 3.823.707 5.25 1.886V4.533zM12.75 20.636A8.214 8.214 0 0118 18.75c.966 0 1.89.166 2.75.47a.75.75 0 001-.708V4.262a.75.75 0 00-.5-.707A9.735 9.735 0 0018 3a9.707 9.707 0 00-5.25 1.533v16.103z" />
                            </svg>
                            <span>Belajar</span>
                        </div>

                        <!-- Tab Link: Evaluasi (Redup & Terkunci jika materi belum selesai) -->
                        <a id="tab-evaluasi-link" href="{{ url('/evaluasi') }}" data-locked="true"
                            onclick="if(this.dataset.locked === 'true') { event.preventDefault(); }"
                            title="Selesaikan semua kartu materi terlebih dahulu"
                            class="inline-flex items-center gap-2 px-5 py-2 rounded-t-2xl bg-white/60 text-slate-400 text-xs sm:text-sm font-bold border-t border-x border-white/80 opacity-55 pointer-events-none cursor-not-allowed select-none transition-all duration-300">
                            <span id="tab-evaluasi-icon" class="inline-flex items-center">
                                <svg class="w-4 h-4 text-slate-400" viewBox="0 0 24 24" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                            <span>Evaluasi</span>
                        </a>
                    </div>

                    <!-- Indikator Slide & Mini Nav -->
                    <div class="hidden sm:flex items-center gap-2.5 pb-1.5">
                        <span id="slide-counter-text" class="text-xs font-extrabold text-slate-600">1 / 4</span>
                        <div id="slide-dots" class="flex items-center gap-1"></div>
                    </div>
                </div>

                <!-- Kotak Putih Utama Flashcard -->
                <div
                    class="flex-1 min-h-0 bg-white/95 backdrop-blur-xs rounded-3xl rounded-tl-xl border-2 border-white shadow-soft-card p-4 sm:p-5 flex flex-col justify-between gap-3">

                    <!-- Area Tengah: Tombol Kiri + Kartu 3D Flip + Tombol Kanan -->
                    <div class="flex-1 min-h-0 flex items-center justify-between gap-2 sm:gap-4">

                        <!-- Tombol Sebelumnya -->
                        <button type="button" id="btn-prev-card" onclick="prevCard()"
                            class="w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-white hover:bg-blue-50 text-slate-600 hover:text-blue-600 border border-slate-200 shadow-sm flex items-center justify-center shrink-0 transition-all cursor-pointer disabled:opacity-40 disabled:cursor-not-allowed">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>

                        <!-- KARTU 3D FLIP (DEPAN <-> BELAKANG) -->
                        <div onclick="flipCard()"
                            class="perspective-1000 flex-1 h-full min-h-[210px] cursor-pointer group select-none">
                            <div id="flashcard-inner"
                                class="relative w-full h-full transition-transform duration-500 transform-style-3d">

                                <!-- SISI DEPAN KARTU -->
                                <div
                                    class="backface-hidden absolute inset-0 rounded-2xl bg-gradient-to-br from-[#F4F9FF] via-white to-[#EBF3FF] border-2 border-blue-100/90 shadow-sm p-5 sm:p-6 flex items-center justify-between gap-4 overflow-hidden">

                                    <div
                                        class="pointer-events-none absolute -bottom-10 -right-10 w-36 h-36 rounded-full bg-blue-100/50">
                                    </div>

                                    <div class="relative z-10 flex-1 flex flex-col justify-between h-full">
                                        <div class="flex items-center justify-between gap-2">
                                            <span
                                                class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-600 text-white text-[11px] font-bold shadow-2xs">
                                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="currentColor">
                                                    <path
                                                        d="M11.25 4.533A9.707 9.707 0 006 3a9.735 9.735 0 00-3.25.555.75.75 0 00-.5.707v14.25a.75.75 0 001 .707A8.237 8.237 0 016 18.75c1.995 0 3.823.707 5.25 1.886V4.533zM12.75 20.636A8.214 8.214 0 0118 18.75c.966 0 1.89.166 2.75.47a.75.75 0 001-.708V4.262a.75.75 0 00-.5-.707A9.735 9.735 0 0018 3a9.707 9.707 0 00-5.25 1.533v16.103z" />
                                                </svg>
                                                <span id="card-front-badge-text">Konsep Dasar</span>
                                            </span>
                                            <span
                                                class="inline-flex items-center gap-1 text-[11px] font-bold text-blue-600 bg-blue-50 px-2.5 py-1 rounded-full border border-blue-200/70 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                                                <span>Klik balik</span>
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                    stroke-width="2.4" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                                </svg>
                                            </span>
                                        </div>

                                        <div class="my-auto py-2">
                                            <h2 id="card-front-title"
                                                class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                                                Input
                                            </h2>
                                            <p id="card-front-desc"
                                                class="text-xs sm:text-sm text-slate-600 mt-2 leading-relaxed max-w-md">
                                                Konsep dasar bagaimana program menerima data dari pengguna untuk diproses.
                                            </p>
                                        </div>

                                        <div class="text-[11px] font-semibold text-slate-400">
                                            Sisi Depan • Ketuk kartu untuk melihat fungsi & contohnya
                                        </div>
                                    </div>

                                    <!-- Ilustrasi Maskot di Sisi Depan -->
                                    <div
                                        class="hidden sm:flex relative z-10 w-32 h-32 lg:w-36 lg:h-36 shrink-0 items-center justify-center">
                                        <img src="{{ asset('images/mascot_dashboard.png') }}" alt="Ilustrasi Konsep"
                                            class="w-full h-full object-contain drop-shadow-sm">
                                    </div>
                                </div>

                                <!-- SISI BELAKANG KARTU -->
                                <div
                                    class="backface-hidden rotate-y-180 absolute inset-0 rounded-2xl bg-gradient-to-br from-blue-600 via-blue-600 to-indigo-700 text-white border-2 border-blue-500 shadow-md p-5 sm:p-6 flex flex-col justify-between overflow-hidden">

                                    <div
                                        class="pointer-events-none absolute -top-12 -right-12 w-40 h-40 rounded-full bg-white/10">
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
                                            <span>Fungsi & Penjelasan</span>
                                        </span>
                                        <span
                                            class="inline-flex items-center gap-1 text-[11px] font-bold bg-white text-blue-600 px-2.5 py-1 rounded-full">
                                            <span>Kembali ke depan</span>
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                stroke-width="2.4" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                            </svg>
                                        </span>
                                    </div>

                                    <div class="relative z-10 my-auto space-y-2.5">
                                        <div>
                                            <span
                                                class="text-[10px] uppercase tracking-wider font-extrabold text-blue-200">Fungsi
                                                Utama (Pasangan Evaluasi):</span>
                                            <p id="card-back-match"
                                                class="text-base sm:text-lg font-extrabold text-white leading-snug mt-0.5">
                                                Memasukkan data ke dalam program
                                            </p>
                                        </div>

                                        <div
                                            class="rounded-xl bg-slate-900/45 border border-white/15 px-3.5 py-2.5 font-mono text-xs text-blue-100">
                                            <span id="card-back-code">nama = input("Siapa namamu? ")</span>
                                        </div>
                                    </div>

                                    <div class="relative z-10 text-[11px] text-blue-200 font-medium">
                                        Ingat pasangan konsep & fungsinya untuk tantangan Evaluasi!
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- Tombol Berikutnya -->
                        <button type="button" id="btn-next-card" onclick="nextCard()"
                            class="w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-white hover:bg-blue-50 text-slate-600 hover:text-blue-600 border border-slate-200 shadow-sm flex items-center justify-center shrink-0 transition-all cursor-pointer disabled:opacity-40 disabled:cursor-not-allowed">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>

                    <!-- Kotak Callout Bawah: Intinya! -->
                    <div
                        class="rounded-2xl bg-slate-50 border border-slate-200/70 px-4 py-2.5 flex items-center gap-3 shrink-0">
                        <div
                            class="w-9 h-9 rounded-xl bg-amber-100/80 text-amber-500 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M12 .75a8.25 8.25 0 00-4.135 15.39c.686.398 1.115 1.008 1.134 1.623a.75.75 0 00.577.706c.352.083.71.148 1.074.195.323.041.6-.218.6-.544v-4.661a6.714 6.714 0 01-.937-.171.75.75 0 11.374-1.453 5.261 5.261 0 002.626 0 .75.75 0 11.374 1.452 6.712 6.712 0 01-.937.172v4.66c0 .327.277.586.6.545.364-.047.722-.112 1.074-.195a.75.75 0 00.577-.706c.02-.615.448-1.225 1.134-1.623A8.25 8.25 0 0012 .75z" />
                                <path fill-rule="evenodd"
                                    d="M9.013 19.9a.75.75 0 01.877-.597 11.319 11.319 0 004.22 0 .75.75 0 11.28 1.473 12.819 12.819 0 01-4.78 0 .75.75 0 01-.597-.876zM9.754 22.344a.75.75 0 01.824-.668 13.682 13.682 0 002.844 0 .75.75 0 11.156 1.492 15.156 15.156 0 01-3.156 0 .75.75 0 01-.668-.824z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <span class="block text-xs font-extrabold text-blue-600">Intinya!</span>
                            <p id="card-summary-text" class="text-xs sm:text-sm font-semibold text-slate-700 truncate">
                                Input adalah proses memasukkan data ke dalam program.
                            </p>
                        </div>
                    </div>

                </div>
            </div>

            <!-- KOLOM KANAN (4/12): KARTU AJAKAN EVALUASI (REDUP & TERKUNCI JIKA MATERI BELUM SELESAI) -->
            <div id="eval-side-card"
                class="lg:col-span-4 bg-white/95 backdrop-blur-xs rounded-3xl border-2 border-white shadow-soft-card p-5 flex flex-col justify-between items-center text-center opacity-55 grayscale-[30%] select-none transition-all duration-300">

                <div class="w-full flex items-center justify-between">
                    <span id="eval-side-badge"
                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-100 text-slate-500 border border-slate-200 text-xs font-extrabold transition-colors">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>Evaluasi Terkunci</span>
                    </span>
                </div>

                <div class="my-auto flex flex-col items-center px-2">
                    <div
                        class="w-28 h-28 sm:w-32 sm:h-32 rounded-full bg-gradient-to-b from-blue-50 to-indigo-50 border border-blue-100 flex items-center justify-center p-2 mb-3">
                        <img src="{{ asset('images/mascot_dashboard.png') }}" alt="Maskot Evaluasi"
                            class="w-full h-full object-contain drop-shadow-xs">
                    </div>

                    <h3 class="text-base sm:text-lg font-extrabold text-slate-900 leading-snug">
                        Siap untuk menguji pemahamanmu?
                    </h3>
                    <p id="eval-side-desc" class="text-xs text-slate-500 mt-1.5 leading-relaxed">
                        Selesaikan membaca semua kartu flashcard terlebih dahulu untuk membuka tantangan evaluasi.
                    </p>
                </div>

                <a id="cta-evaluasi-btn" href="{{ url('/evaluasi') }}" data-locked="true"
                    onclick="if(this.dataset.locked === 'true') { event.preventDefault(); }"
                    class="w-full inline-flex items-center justify-center gap-2 bg-slate-300 text-slate-500 font-bold text-sm py-3 px-5 rounded-2xl pointer-events-none cursor-not-allowed transition-all duration-300">
                    <span id="cta-evaluasi-text">Selesaikan Materi (1/4)</span>
                </a>

            </div>

        </div>
    </main>
@endsection

@push('scripts')
    <script>
        // Katalog Kartu (Single Source of Truth untuk Flashcard & Evaluasi Mencocokkan)
        const flashcardDeckCatalog = {
            'SD-1': {
                levelTitle: 'Kenalan dengan Python',
                cards: [{
                        id: 'c1',
                        category: 'Konsep Dasar',
                        frontTitle: 'print()',
                        frontDesc: 'Perintah utama di Python untuk memunculkan tulisan atau angka ke layar.',
                        backMatchText: 'Menampilkan teks atau hasil ke layar',
                        backCode: 'print("Halo, CodePawth!")',
                        summary: 'Fungsi print() digunakan untuk menampilkan output tulisan atau angka ke layar.',
                        iconKey: 'monitor'
                    },
                    {
                        id: 'c2',
                        category: 'Tipe Data',
                        frontTitle: 'String (str)',
                        frontDesc: 'Jenis data berupa kumpulan huruf atau kalimat yang diapit tanda kutip.',
                        backMatchText: 'Menyimpan data berupa teks atau kalimat',
                        backCode: 'nama = "Budi Santoso"',
                        summary: 'String adalah tipe data teks yang selalu ditulis di dalam tanda kutip (" ").',
                        iconKey: 'text'
                    },
                    {
                        id: 'c3',
                        category: 'Tipe Data',
                        frontTitle: 'Integer (int)',
                        frontDesc: 'Jenis data berupa bilangan bulat tanpa koma yang bisa dihitung.',
                        backMatchText: 'Menyimpan angka bilangan bulat',
                        backCode: 'umur = 12',
                        summary: 'Integer digunakan untuk menyimpan angka bulat seperti 10, 25, atau 100.',
                        iconKey: 'number'
                    },
                    {
                        id: 'c4',
                        category: 'Interaksi',
                        frontTitle: 'input()',
                        frontDesc: 'Perintah untuk meminta pengguna mengetikkan sesuatu lewat keyboard.',
                        backMatchText: 'Menerima masukan data dari pengguna',
                        backCode: 'kota = input("Asal kota: ")',
                        summary: 'Fungsi input() membuat program bisa menerima data yang diketik pengguna.',
                        iconKey: 'keyboard'
                    }
                ]
            },
            'SD-2': {
                levelTitle: 'Variabel & Operasi Hitung',
                cards: [{
                        id: 'v1',
                        category: 'Konsep Dasar',
                        frontTitle: 'Variabel',
                        frontDesc: 'Wadah bernama di memori komputer untuk menyimpan suatu nilai data.',
                        backMatchText: 'Tempat menyimpan nilai data sementara',
                        backCode: 'skor = 100',
                        summary: 'Variabel ibarat kotak berlabel yang menyimpan nilai agar bisa dipakai lagi.',
                        iconKey: 'box'
                    },
                    {
                        id: 'v2',
                        category: 'Operator',
                        frontTitle: 'Operator +',
                        frontDesc: 'Simbol matematika untuk menjumlahkan dua angka atau menggabungkan teks.',
                        backMatchText: 'Menjumlahkan dua nilai angka',
                        backCode: 'total = 15 + 5  # Hasil: 20',
                        summary: 'Tanda tambah (+) menjumlahkan nilai numerik di sisi kiri dan kanannya.',
                        iconKey: 'plus'
                    },
                    {
                        id: 'v3',
                        category: 'Operator',
                        frontTitle: 'Operator *',
                        frontDesc: 'Di pemrograman, perkalian tidak memakai huruf x melainkan tanda bintang.',
                        backMatchText: 'Mengalikan dua nilai bilangan',
                        backCode: 'luas = 4 * 5  # Hasil: 20',
                        summary: 'Gunakan tanda bintang (*) untuk melakukan operasi perkalian di Python.',
                        iconKey: 'multiply'
                    },
                    {
                        id: 'v4',
                        category: 'Catatan Kode',
                        frontTitle: 'Komentar (#)',
                        frontDesc: 'Baris catatan untuk programmer yang tidak akan dijalankan oleh komputer.',
                        backMatchText: 'Memberi catatan penjelasan pada kode',
                        backCode: '# Ini adalah komentar program',
                        summary: 'Teks setelah tanda pagar (#) diabaikan komputer dan berguna sebagai catatan.',
                        iconKey: 'note'
                    }
                ]
            },
            'DEFAULT': {
                levelTitle: 'Mengenal Algoritma: Input dan Output',
                cards: [{
                        id: 'd1',
                        category: 'Konsep Dasar',
                        frontTitle: 'Input',
                        frontDesc: 'Tahap awal algoritma saat data mentah diberikan ke dalam sistem.',
                        backMatchText: 'Memasukkan data ke dalam program',
                        backCode: 'data = input("Masukkan angka: ")',
                        summary: 'Input adalah proses memasukkan data ke dalam program.',
                        iconKey: 'keyboard'
                    },
                    {
                        id: 'd2',
                        category: 'Konsep Dasar',
                        frontTitle: 'Output',
                        frontDesc: 'Tahap akhir saat informasi hasil olahan ditampilkan kepada pengguna.',
                        backMatchText: 'Menampilkan hasil dari program',
                        backCode: 'print("Hasil akhir:", hasil)',
                        summary: 'Output adalah informasi atau hasil yang dikeluarkan oleh program.',
                        iconKey: 'monitor'
                    },
                    {
                        id: 'd3',
                        category: 'Logika Kontrol',
                        frontTitle: 'Percabangan',
                        frontDesc: 'Struktur logika if-else untuk menentukan aksi berdasarkan syarat tertentu.',
                        backMatchText: 'Membuat pilihan berdasarkan kondisi',
                        backCode: 'if nilai >= 80:\n    print("Lulus")',
                        summary: 'Percabangan memilih jalur eksekusi kode berdasarkan kondisi benar atau salah.',
                        iconKey: 'branch'
                    },
                    {
                        id: 'd4',
                        category: 'Logika Kontrol',
                        frontTitle: 'Perulangan',
                        frontDesc: 'Struktur loop (for/while) untuk mengeksekusi perintah berkali-kali secara otomatis.',
                        backMatchText: 'Mengulang suatu langkah secara otomatis',
                        backCode: 'for i in range(5):\n    print(i)',
                        summary: 'Perulangan menjalankan blok kode yang sama berulang kali tanpa menulis ulang.',
                        iconKey: 'loop'
                    }
                ]
            }
        };

        const params = new URLSearchParams(window.location.search);
        const activeJenjang = (params.get('jenjang') || 'SD').toUpperCase();
        const activeLevelId = parseInt(params.get('level') || '1', 10);

        const deckKey = `${activeJenjang}-${activeLevelId}`;
        const currentDeck = flashcardDeckCatalog[deckKey] || flashcardDeckCatalog.DEFAULT;
        const cards = currentDeck.cards;

        let currentIndex = 0;
        let isFlipped = false;
        let visitedSet = new Set([0]);

        function updateEvaluasiLockState(isCompleted) {
            const tabEval = document.getElementById('tab-evaluasi-link');
            const tabIcon = document.getElementById('tab-evaluasi-icon');
            const sideCard = document.getElementById('eval-side-card');
            const sideBadge = document.getElementById('eval-side-badge');
            const sideDesc = document.getElementById('eval-side-desc');
            const ctaBtn = document.getElementById('cta-evaluasi-btn');
            const ctaText = document.getElementById('cta-evaluasi-text');
            const mascotSpeech = document.getElementById('fc-mascot-speech');

            if (isCompleted) {
                tabEval.dataset.locked = 'false';
                tabEval.title = 'Mulai Evaluasi';
                tabEval.className =
                    'inline-flex items-center gap-2 px-5 py-2 rounded-t-2xl bg-white/85 hover:bg-white text-slate-600 hover:text-blue-600 text-xs sm:text-sm font-bold border-t border-x border-white transition-all duration-300 cursor-pointer';
                tabIcon.innerHTML = `
                <svg class="w-4 h-4 text-emerald-500" viewBox="0 0 24 24" fill="currentColor">
                    <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd"/>
                </svg>
            `;

                sideCard.classList.remove('opacity-55', 'grayscale-[30%]', 'select-none');
                sideBadge.className =
                    'inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-indigo-50 text-indigo-600 border border-indigo-100 text-xs font-extrabold transition-colors';
                sideBadge.innerHTML = `
                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="currentColor">
                    <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd"/>
                </svg>
                <span>Evaluasi Siap!</span>
            `;
                sideDesc.textContent =
                    'Cocokkan konsep di sisi depan kartu dengan fungsinya di sisi belakang untuk membuka level berikutnya!';

                ctaBtn.dataset.locked = 'false';
                ctaBtn.className =
                    'w-full inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm py-3 px-5 rounded-2xl shadow-soft-blue hover:-translate-y-0.5 transition-all duration-300 cursor-pointer';
                ctaBtn.innerHTML = `
                <span>Mulai Evaluasi</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                </svg>
            `;

                if (mascotSpeech) {
                    mascotSpeech.innerHTML =
                        'Semua materi selesai! Yuk lanjut ke Evaluasi! <span class="text-amber-400">★</span>';
                }
            } else {
                tabEval.dataset.locked = 'true';
                tabEval.title = 'Selesaikan semua kartu materi terlebih dahulu';
                tabEval.className =
                    'inline-flex items-center gap-2 px-5 py-2 rounded-t-2xl bg-white/60 text-slate-400 text-xs sm:text-sm font-bold border-t border-x border-white/80 opacity-55 pointer-events-none cursor-not-allowed select-none transition-all duration-300';
                tabIcon.innerHTML = `
                <svg class="w-4 h-4 text-slate-400" viewBox="0 0 24 24" fill="currentColor">
                    <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z" clip-rule="evenodd"/>
                </svg>
            `;

                sideCard.classList.add('opacity-55', 'grayscale-[30%]', 'select-none');
                ctaBtn.dataset.locked = 'true';
                ctaBtn.className =
                    'w-full inline-flex items-center justify-center gap-2 bg-slate-300 text-slate-500 font-bold text-sm py-3 px-5 rounded-2xl pointer-events-none cursor-not-allowed transition-all duration-300';
                if (ctaText) {
                    ctaText.textContent = `Selesaikan Materi (${visitedSet.size}/${cards.length})`;
                }
            }
        }

        function renderFlashcard() {
            const card = cards[currentIndex];
            visitedSet.add(currentIndex);

            isFlipped = false;
            document.getElementById('flashcard-inner').classList.remove('rotate-y-180');

            document.getElementById('card-front-badge-text').textContent = card.category;
            document.getElementById('card-front-title').textContent = card.frontTitle;
            document.getElementById('card-front-desc').textContent = card.frontDesc;

            document.getElementById('card-back-match').textContent = card.backMatchText;
            document.getElementById('card-back-code').textContent = card.backCode;
            document.getElementById('card-summary-text').textContent = card.summary;

            document.getElementById('slide-counter-text').textContent = `${currentIndex + 1} / ${cards.length}`;
            document.getElementById('btn-prev-card').disabled = (currentIndex === 0);
            document.getElementById('btn-next-card').disabled = (currentIndex === cards.length - 1);

            const dotsWrap = document.getElementById('slide-dots');
            dotsWrap.innerHTML = cards.map((_, idx) => `
            <button type="button" onclick="goToCard(${idx})" class="h-2 rounded-full transition-all cursor-pointer ${idx === currentIndex ? 'w-5 bg-blue-600' : 'w-2 bg-slate-300 hover:bg-blue-300'}"></button>
        `).join('');

            const pct = Math.round((visitedSet.size / cards.length) * 100);
            document.getElementById('fc-cards-viewed').textContent = visitedSet.size;
            document.getElementById('fc-cards-total').textContent = cards.length;
            document.getElementById('fc-progress-bar').style.width = `${pct}%`;
            document.getElementById('fc-progress-percent').textContent = `${pct}%`;

            const isCompleted = visitedSet.size >= cards.length;
            updateEvaluasiLockState(isCompleted);
        }

        function flipCard() {
            isFlipped = !isFlipped;
            const inner = document.getElementById('flashcard-inner');
            if (isFlipped) {
                inner.classList.add('rotate-y-180');
            } else {
                inner.classList.remove('rotate-y-180');
            }
        }

        function prevCard() {
            if (currentIndex > 0) {
                currentIndex--;
                renderFlashcard();
            }
        }

        function nextCard() {
            if (currentIndex < cards.length - 1) {
                currentIndex++;
                renderFlashcard();
            }
        }

        function goToCard(idx) {
            currentIndex = idx;
            renderFlashcard();
        }

        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('fc-jenjang-label').textContent = activeJenjang;
            document.getElementById('fc-level-pill').textContent = `Level ${activeLevelId}`;
            document.getElementById('fc-level-title').textContent = currentDeck.levelTitle;

            const backUrl = `{{ url('/level-view') }}?jenjang=${activeJenjang}`;
            const evalUrl = `{{ url('/evaluasi') }}?jenjang=${activeJenjang}&level=${activeLevelId}`;

            document.getElementById('back-to-map-link').href = backUrl;
            document.getElementById('tab-evaluasi-link').href = evalUrl;
            document.getElementById('cta-evaluasi-btn').href = evalUrl;

            localStorage.setItem('codepawth_active_eval_deck', JSON.stringify({
                jenjang: activeJenjang,
                levelId: activeLevelId,
                levelTitle: currentDeck.levelTitle,
                cards: cards
            }));

            const sideJenjang = document.getElementById('sidebar-jenjang-text');
            const sideLvl = document.getElementById('sidebar-current-lvl');
            if (sideJenjang) sideJenjang.textContent = activeJenjang;
            if (sideLvl) sideLvl.textContent = activeLevelId;

            renderFlashcard();
        });
    </script>
@endpush
