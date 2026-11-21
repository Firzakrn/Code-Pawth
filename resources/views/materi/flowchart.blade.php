@extends('layouts.materi')

@section('title', 'Menyusun Flowchart — Code Pawth')
@section('materi_step', 'flowchart')
@section('materi_speech', 'Ayo selesaikan worksheet flowchart-nya!')

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
                        <span id="flow-total-score">0</span> / 10
                    </div>
                    <div class="text-[11px] text-slate-500 font-medium">Total Skor</div>
                </div>
            </div>

            <div class="w-px h-6 bg-slate-200"></div>

            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-xl bg-amber-50 flex items-center justify-center text-amber-500">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M5.166 2.621v.858c-1.035.148-2.059.33-3.071.543a.75.75 0 00-.584.859 6.753 6.753 0 006.138 5.6 6.73 6.73 0 002.743 1.346A6.707 6.707 0 019.279 15H8.54c-1.036 0-1.875.84-1.875 1.875V19.5h-.75a2.25 2.25 0 00-2.25 2.25c0 .414.336.75.75.75h15a.75.75 0 00.75-.75 2.25 2.25 0 00-2.25-2.25h-.75v-2.625c0-1.036-.84-1.875-1.875-1.875h-.739a6.706 6.706 0 01-1.112-3.173 6.73 6.73 0 002.743-1.347 6.753 6.753 0 006.139-5.6.75.75 0 00-.585-.858 47.077 47.077 0 00-3.07-.543V2.62a.75.75 0 00-.658-.744 49.22 49.22 0 00-6.093-.377c-2.063 0-4.096.128-6.093.377a.75.75 0 00-.657.744z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    <div id="flow-temp-score" class="text-sm font-extrabold text-slate-900 leading-tight">0</div>
                    <div class="text-[11px] text-slate-500 font-medium">Skor Sementara</div>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3 flex-1 md:max-w-md">
            <div class="flex-1 h-2.5 bg-slate-100 rounded-full overflow-hidden p-0.5 border border-slate-200/60">
                <div id="flow-progress-bar"
                    class="h-full bg-gradient-to-r from-blue-500 to-blue-600 rounded-full transition-all duration-300"
                    style="width: 0%;"></div>
            </div>
            <span id="flow-soal-counter" class="text-xs font-extrabold text-slate-700 w-10 text-right">0 / 1</span>
        </div>
    </div>
@endsection

@section('materi_tab_right')
    <span class="text-xs font-extrabold text-slate-600">Tahap 2 dari 3</span>
@endsection

@section('materi_content')
    <div
        class="flex-1 min-h-0 bg-white/95 backdrop-blur-xs rounded-3xl rounded-tl-xl border-2 border-white shadow-soft-card p-4 sm:p-5 grid grid-cols-1 lg:grid-cols-12 gap-4 overflow-y-auto">

        <!-- PANEL KIRI (5/12): SOAL, PETUNJUK & BLOK TERSEDIA (Bisa di-scroll) -->
        <div class="lg:col-span-5 flex flex-col justify-between gap-3 lg:min-h-0 lg:overflow-y-auto lg:pr-1">
            <div class="space-y-3">
                <div>
                    <span
                        class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-blue-50 text-blue-600 border border-blue-100 text-xs font-extrabold">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M11.25 3v4.046a3 3 0 00-4.277 4.204H1.5v-6A2.25 2.25 0 013.75 3h7.5zM12.75 3v4.011a3 3 0 014.239 4.239H22.5v-6A2.25 2.25 0 0020.25 3h-7.5zM22.5 12.75h-8.983a4.125 4.125 0 004.108 3.75.75.75 0 010 1.5 5.623 5.623 0 01-4.875-2.817V21h7.5a2.25 2.25 0 002.25-2.25v-6zM11.25 21v-5.817A5.623 5.623 0 016.375 18a.75.75 0 010-1.5 4.126 4.126 0 004.108-3.75H1.5v6A2.25 2.25 0 003.75 21h7.5z" />
                        </svg>
                        <span>Soal <span class="text-slate-900">1</span> dari 1</span>
                    </span>
                </div>

                <h2 id="flow-question-text" class="text-base sm:text-lg font-extrabold text-slate-900 leading-snug">
                    Lengkapi <span class="text-blue-600">flowchart</span> berikut untuk menentukan apakah sebuah bilangan
                    genap atau ganjil!
                </h2>

                <div class="rounded-2xl bg-[#F0F6FF] border border-blue-100 px-4 py-3 flex items-start gap-3">
                    <div
                        class="w-8 h-8 rounded-xl bg-amber-100/80 text-amber-500 flex items-center justify-center shrink-0 mt-0.5">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M12 .75a8.25 8.25 0 00-4.135 15.39c.686.398 1.115 1.008 1.134 1.623a.75.75 0 00.577.706c.352.083.71.148 1.074.195.323.041.6-.218.6-.544v-4.661a6.714 6.714 0 01-.937-.171.75.75 0 11.374-1.453 5.261 5.261 0 002.626 0 .75.75 0 11.374 1.452 6.712 6.712 0 01-.937.172v4.66c0 .327.277.586.6.545.364-.047.722-.112 1.074-.195a.75.75 0 00.577-.706c.02-.615.448-1.225 1.134-1.623A8.25 8.25 0 0012 .75z" />
                            <path fill-rule="evenodd"
                                d="M9.013 19.9a.75.75 0 01.877-.597 11.319 11.319 0 004.22 0 .75.75 0 11.28 1.473 12.819 12.819 0 01-4.78 0 .75.75 0 01-.597-.876zM9.754 22.344a.75.75 0 01.824-.668 13.682 13.682 0 002.844 0 .75.75 0 11.156 1.492 15.156 15.156 0 01-3.156 0 .75.75 0 01-.668-.824z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-xs font-extrabold text-blue-600">Petunjuk:</div>
                        <p class="text-xs text-slate-600 mt-0.5 leading-relaxed">
                            Seret atau klik blok di bawah lalu klik kotak kosong di kanan untuk melengkapi flowchart.
                        </p>
                    </div>
                </div>

                <div class="space-y-2 pt-1">
                    <div class="text-xs font-extrabold text-slate-800">Blok Tersedia:</div>
                    <div id="block-palette" class="grid grid-cols-2 gap-2.5"></div>
                </div>
            </div>

            <div class="text-[11px] text-slate-400 font-medium pt-1">
                Klik slot yang sudah terisi jika ingin mengganti atau menghapus bloknya.
            </div>
        </div>

        <!-- PANEL KANAN (7/12): KANVAS DIAGRAM FLOWCHART (Bisa di-scroll penuh atas-bawah) -->
        <div class="lg:col-span-7 relative rounded-2xl bg-[#F4F8FF] border border-blue-100/90 lg:min-h-0 overflow-y-auto">
            <div class="min-h-full p-4 flex flex-col justify-between items-center gap-4">

                <!-- Diagram Flowchart -->
                <div class="relative z-10 w-full max-w-lg flex flex-col items-center pt-1">

                    <!-- 1. MULAI -->
                    <div
                        class="px-11 py-2 rounded-full bg-[#E5EFFF] border-2 border-blue-400 text-slate-900 font-extrabold text-sm shadow-2xs">
                        Mulai
                    </div>

                    <div class="flex flex-col items-center">
                        <div class="w-0.5 h-3.5 bg-blue-500"></div>
                        <svg class="w-3 h-2.5 text-blue-500 -mt-1" viewBox="0 0 12 10" fill="currentColor">
                            <path d="M6 10L0 0h12z" />
                        </svg>
                    </div>

                    <!-- 2. SLOT 1 (INPUT) -->
                    <div id="slot-step1" data-slot="step1" ondragover="event.preventDefault()"
                        ondrop="handleDropSlot(event, 'step1')" onclick="handleSlotClick('step1')"
                        class="w-60 sm:w-64 min-h-[46px] rounded-2xl border-2 border-dashed border-blue-300 bg-white/95 hover:border-blue-500 px-3.5 py-2 flex items-center justify-between gap-2 cursor-pointer transition-all shadow-2xs">
                    </div>

                    <div class="flex flex-col items-center">
                        <div class="w-0.5 h-3.5 bg-blue-500"></div>
                        <svg class="w-3 h-2.5 text-blue-500 -mt-1" viewBox="0 0 12 10" fill="currentColor">
                            <path d="M6 10L0 0h12z" />
                        </svg>
                    </div>

                    <!-- 3. CABANG DECISION -->
                    <div class="w-full grid grid-cols-12 items-center">
                        <div class="col-span-4 flex flex-col items-center">
                            <div class="w-full flex items-center justify-end">
                                <div class="w-1/2"></div>
                                <div class="relative flex items-center flex-1">
                                    <div class="w-full h-0.5 bg-blue-500"></div>
                                    <span
                                        class="absolute left-1/2 -translate-x-1/2 px-2.5 py-0.5 rounded-full bg-[#E8F1FF] border border-blue-300 text-[11px] font-extrabold text-slate-700">
                                        Ya
                                    </span>
                                </div>
                            </div>
                            <div class="w-full flex">
                                <div class="w-1/2 flex flex-col items-center">
                                    <div class="w-0.5 h-7 bg-blue-500 -mt-[1px]"></div>
                                    <svg class="w-3 h-2.5 text-blue-500 -mt-1" viewBox="0 0 12 10" fill="currentColor">
                                        <path d="M6 10L0 0h12z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="col-span-4 flex items-center justify-center py-1">
                            <div id="slot-decision" data-slot="decision" ondragover="event.preventDefault()"
                                ondrop="handleDropSlot(event, 'decision')" onclick="handleSlotClick('decision')"
                                class="w-24 h-24 sm:w-[104px] sm:h-[104px] rotate-45 rounded-xl border-2 border-blue-400 bg-[#EBF3FF] hover:border-blue-600 shadow-2xs flex items-center justify-center cursor-pointer transition-all">
                                <div id="slot-decision-inner" class="-rotate-45 text-center px-1">
                                    <span class="text-lg font-extrabold text-blue-600">?</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-span-4 flex flex-col items-center">
                            <div class="w-full flex items-center justify-start">
                                <div class="relative flex items-center flex-1">
                                    <div class="w-full h-0.5 bg-blue-500"></div>
                                    <span
                                        class="absolute left-1/2 -translate-x-1/2 px-2.5 py-0.5 rounded-full bg-[#E8F1FF] border border-blue-300 text-[11px] font-extrabold text-slate-700">
                                        Tidak
                                    </span>
                                </div>
                                <div class="w-1/2"></div>
                            </div>
                            <div class="w-full flex justify-end">
                                <div class="w-1/2 flex flex-col items-center">
                                    <div class="w-0.5 h-7 bg-blue-500 -mt-[1px]"></div>
                                    <svg class="w-3 h-2.5 text-blue-500 -mt-1" viewBox="0 0 12 10" fill="currentColor">
                                        <path d="M6 10L0 0h12z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 4. SLOT CABANG YA & TIDAK -->
                    <div class="w-full grid grid-cols-2 gap-3 sm:gap-6">
                        <div id="slot-branchYes" data-slot="branchYes" ondragover="event.preventDefault()"
                            ondrop="handleDropSlot(event, 'branchYes')" onclick="handleSlotClick('branchYes')"
                            class="min-h-[46px] rounded-2xl border-2 border-dashed border-blue-300 bg-white/95 hover:border-blue-500 px-3 py-2 flex items-center justify-between gap-1.5 cursor-pointer transition-all shadow-2xs">
                        </div>

                        <div id="slot-branchNo" data-slot="branchNo" ondragover="event.preventDefault()"
                            ondrop="handleDropSlot(event, 'branchNo')" onclick="handleSlotClick('branchNo')"
                            class="min-h-[46px] rounded-2xl border-2 border-dashed border-blue-300 bg-white/95 hover:border-blue-500 px-3 py-2 flex items-center justify-between gap-1.5 cursor-pointer transition-all shadow-2xs">
                        </div>
                    </div>

                    <!-- Garis Penggabung Bawah ke Selesai -->
                    <div class="w-full grid grid-cols-2">
                        <div class="flex flex-col items-end">
                            <div class="w-1/2 h-3.5 border-l-2 border-b-2 border-blue-500 rounded-bl-md"></div>
                        </div>
                        <div class="flex flex-col items-start">
                            <div class="w-1/2 h-3.5 border-r-2 border-b-2 border-blue-500 rounded-br-md"></div>
                        </div>
                    </div>
                    <div class="flex flex-col items-center">
                        <div class="w-0.5 h-3 bg-blue-500"></div>
                        <svg class="w-3 h-2.5 text-blue-500 -mt-1" viewBox="0 0 12 10" fill="currentColor">
                            <path d="M6 10L0 0h12z" />
                        </svg>
                    </div>

                    <!-- 5. SELESAI -->
                    <div
                        class="px-11 py-2 rounded-full bg-[#E5EFFF] border-2 border-blue-400 text-slate-900 font-extrabold text-sm shadow-2xs">
                        Selesai
                    </div>

                </div>

                <!-- Bar Tombol Bawah -->
                <div class="relative z-10 w-full flex items-center justify-end gap-2 pt-1 shrink-0">
                    <button type="button" onclick="resetFlowchart()"
                        class="px-4 py-2 rounded-full bg-white hover:bg-slate-50 text-slate-600 border border-slate-200 text-xs font-bold transition-colors cursor-pointer">
                        Reset
                    </button>
                    <button type="button" id="btn-check-flow" onclick="checkFlowchart()" disabled
                        class="inline-flex items-center gap-1.5 px-5 py-2.5 rounded-full bg-blue-600 hover:bg-blue-700 disabled:bg-blue-300 text-white text-xs sm:text-sm font-extrabold shadow-soft-blue disabled:shadow-none transition-all cursor-pointer disabled:cursor-not-allowed">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>Periksa Jawaban</span>
                    </button>
                </div>

            </div>
        </div>

    </div>

    <!-- MODAL HASIL WORKSHEET FLOWCHART -> LANJUT KE EVALUASI -->
    <div id="flow-result-modal"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/40 backdrop-blur-xs p-4">
        <div
            class="bg-white rounded-3xl max-w-md w-full p-6 sm:p-7 shadow-2xl border border-slate-100 text-center space-y-4">
            <img id="flow-modal-mascot" src="{{ asset('images/mascot_happy.png') }}" alt="Maskot Hasil"
                class="w-24 h-24 mx-auto object-contain">

            <div id="flow-modal-stars" class="flex items-center justify-center gap-1.5 text-amber-400"></div>

            <div>
                <h3 id="flow-modal-title" class="text-xl font-extrabold text-slate-900">Flowchart Tepat!</h3>
                <p id="flow-modal-desc" class="text-xs sm:text-sm text-slate-600 mt-1.5 leading-relaxed">
                    Susunan algoritma flowchart sudah benar! Sekarang lanjut ke tahap Evaluasi untuk menuntaskan level ini.
                </p>
            </div>

            <div class="bg-slate-50 rounded-2xl p-3.5 border border-slate-200/80 flex items-center justify-around">
                <div>
                    <span class="block text-[11px] text-slate-400 font-semibold">Total Skor</span>
                    <span id="flow-modal-score" class="text-xl font-extrabold text-blue-600">10 / 10</span>
                </div>
                <div class="w-px h-8 bg-slate-200"></div>
                <div>
                    <span class="block text-[11px] text-slate-400 font-semibold">Blok Benar</span>
                    <span id="flow-modal-correct" class="text-xl font-extrabold text-emerald-600">4 / 4</span>
                </div>
            </div>

            <div class="pt-2 flex flex-col sm:flex-row gap-2.5">
                <button type="button" onclick="closeFlowModal(); resetFlowchart();"
                    class="flex-1 py-2.5 px-4 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs sm:text-sm transition-colors cursor-pointer">
                    Ulangi Flowchart
                </button>
                <a id="flow-continue-btn" href="{{ url('/materi/evaluasi') }}"
                    class="flex-1 py-2.5 px-4 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs sm:text-sm shadow-soft-blue transition-all inline-flex items-center justify-center gap-1.5">
                    <span id="flow-continue-text">Lanjut ke Evaluasi</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const flowchartBlocks = [{
                type: 'input',
                label: 'Input',
                svg: `<svg class="w-5 h-4 text-blue-600 shrink-0" viewBox="0 0 28 20" fill="none" stroke="currentColor" stroke-width="2"><polygon points="6,2 26,2 22,18 2,18" fill="#EBF3FF"/></svg>`
            },
            {
                type: 'output',
                label: 'Output',
                svg: `<svg class="w-5 h-4 text-blue-600 shrink-0" viewBox="0 0 28 20" fill="none" stroke="currentColor" stroke-width="2"><polygon points="6,2 26,2 22,18 2,18" fill="#EBF3FF"/></svg>`
            },
            {
                type: 'kondisi',
                label: 'Kondisi',
                svg: `<svg class="w-5 h-5 text-blue-600 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12,2 22,12 12,22 2,12" fill="#EBF3FF"/></svg>`
            },
            {
                type: 'proses',
                label: 'Proses',
                svg: `<svg class="w-5 h-4 text-blue-600 shrink-0" viewBox="0 0 28 20" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="24" height="16" rx="2" fill="#EBF3FF"/></svg>`
            },
            {
                type: 'terminator',
                label: 'Mulai / Selesai',
                svg: `<svg class="w-6 h-4 text-blue-600 shrink-0" viewBox="0 0 30 20" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="26" height="16" rx="8" fill="#EBF3FF"/></svg>`
            }
        ];

        const smpFlowchartCatalog = {
            1: {
                questionHtml: 'Lengkapi <span class="text-blue-600">flowchart</span> berikut untuk menentukan apakah sebuah bilangan genap atau ganjil!',
                slots: {
                    step1: {
                        expected: 'input',
                        filledSub: 'Input bilangan'
                    },
                    decision: {
                        expected: 'kondisi',
                        filledSub: 'bilangan % 2 == 0?'
                    },
                    branchYes: {
                        expected: 'output',
                        filledSub: 'Output: Genap'
                    },
                    branchNo: {
                        expected: 'output',
                        filledSub: 'Output: Ganjil'
                    }
                }
            },
            2: {
                questionHtml: 'Lengkapi <span class="text-blue-600">flowchart</span> untuk mengecek apakah nilai siswa lulus (nilai ≥ 75) atau mengulang!',
                slots: {
                    step1: {
                        expected: 'input',
                        filledSub: 'Input nilai siswa'
                    },
                    decision: {
                        expected: 'kondisi',
                        filledSub: 'nilai >= 75?'
                    },
                    branchYes: {
                        expected: 'output',
                        filledSub: 'Output: Lulus'
                    },
                    branchNo: {
                        expected: 'output',
                        filledSub: 'Output: Mengulang'
                    }
                }
            }
        };

        const {
            levelId,
            evaluasiUrl
        } = window.MATERI_CTX;
        const activeChallenge = smpFlowchartCatalog[levelId] || smpFlowchartCatalog[1];

        let selectedBlockType = null;
        let slotAnswers = {
            step1: null,
            decision: null,
            branchYes: null,
            branchNo: null
        };
        let isChecked = false;
        let slotValidation = {};

        function renderPalette() {
            const wrap = document.getElementById('block-palette');
            wrap.innerHTML = flowchartBlocks.map((blk, idx) => {
                const isSelected = selectedBlockType === blk.type;
                const spanFull = idx === flowchartBlocks.length - 1 ? 'col-span-2 sm:col-span-1' : '';
                return `
                <button 
                    type="button"
                    draggable="true"
                    ondragstart="handleDragBlock(event, '${blk.type}')"
                    onclick="selectPaletteBlock('${blk.type}')"
                    class="${spanFull} flex items-center gap-2.5 px-3.5 py-2.5 rounded-full border-2 text-xs font-extrabold transition-all cursor-pointer select-none ${
                        isSelected
                            ? 'border-blue-600 bg-blue-50 text-blue-700 ring-3 ring-blue-500/20'
                            : 'border-blue-200 bg-white hover:border-blue-400 hover:bg-blue-50/40 text-slate-800'
                    }"
                >
                    ${blk.svg}
                    <span class="truncate">${blk.label}</span>
                </button>
            `;
            }).join('');
        }

        function renderSlots() {
            const rectSlots = ['step1', 'branchYes', 'branchNo'];

            rectSlots.forEach(slotKey => {
                const el = document.getElementById(`slot-${slotKey}`);
                const chosenType = slotAnswers[slotKey];
                const blk = flowchartBlocks.find(b => b.type === chosenType);
                const meta = activeChallenge.slots[slotKey];

                let borderClass = 'border-dashed border-blue-300 bg-white/95 hover:border-blue-500';
                if (isChecked) {
                    borderClass = slotValidation[slotKey] ?
                        'border-solid border-emerald-400 bg-emerald-50/90' :
                        'border-solid border-rose-400 bg-rose-50/90';
                } else if (blk) {
                    borderClass = 'border-solid border-blue-500 bg-white';
                }

                el.className =
                    `${slotKey === 'step1' ? 'w-60 sm:w-64' : 'w-full'} min-h-[46px] rounded-2xl border-2 ${borderClass} px-3 py-2 flex items-center justify-between gap-2 cursor-pointer transition-all shadow-2xs`;

                if (!blk) {
                    el.innerHTML = `
                    <span class="text-slate-400 text-xs font-bold tracking-tighter">⋮⋮</span>
                    <span class="text-[11px] font-semibold text-slate-400 truncate">
                        ${selectedBlockType ? 'Klik untuk pasang blok' : 'Letakkan blok di sini'}
                    </span>
                    <span class="w-3"></span>
                `;
                } else {
                    el.innerHTML = `
                    <div class="flex items-center gap-2 min-w-0">
                        ${blk.svg}
                        <div class="min-w-0 text-left">
                            <div class="text-xs font-extrabold text-slate-900 leading-tight">${blk.label}</div>
                            <div class="text-[10px] font-semibold text-blue-600 truncate">${meta.filledSub}</div>
                        </div>
                    </div>
                    ${isChecked
                        ? (slotValidation[slotKey]
                            ? '<svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" stroke-width="2.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>'
                            : '<svg class="w-4 h-4 text-rose-600 shrink-0" fill="none" stroke="currentColor" stroke-width="2.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>')
                        : '<span class="text-[10px] font-bold text-slate-400 hover:text-rose-500 shrink-0">✕</span>'
                    }
                `;
                }
            });

            const decEl = document.getElementById('slot-decision');
            const decInner = document.getElementById('slot-decision-inner');
            const decType = slotAnswers.decision;
            const decBlk = flowchartBlocks.find(b => b.type === decType);
            const decMeta = activeChallenge.slots.decision;

            let decStyle = 'border-blue-400 bg-[#EBF3FF] hover:border-blue-600';
            if (isChecked) {
                decStyle = slotValidation.decision ?
                    'border-emerald-500 bg-emerald-50' :
                    'border-rose-500 bg-rose-50';
            } else if (decBlk) {
                decStyle = 'border-blue-600 bg-white';
            }

            decEl.className =
                `w-24 h-24 sm:w-[104px] sm:h-[104px] rotate-45 rounded-xl border-2 ${decStyle} shadow-2xs flex items-center justify-center cursor-pointer transition-all`;

            if (!decBlk) {
                decInner.innerHTML = `<span class="text-lg font-extrabold text-blue-600">?</span>`;
            } else {
                decInner.innerHTML = `
                <div class="text-[11px] font-extrabold text-slate-900 leading-tight">${decBlk.label}</div>
                <div class="text-[9px] font-bold text-blue-600 leading-tight mt-0.5">${decMeta.filledSub}</div>
            `;
            }

            const allFilled = Object.values(slotAnswers).every(v => v !== null);
            document.getElementById('btn-check-flow').disabled = !allFilled || isChecked;
        }

        function selectPaletteBlock(type) {
            if (isChecked) return;
            selectedBlockType = (selectedBlockType === type) ? null : type;
            renderPalette();
            renderSlots();
        }

        function handleDragBlock(event, type) {
            if (isChecked) return;
            selectedBlockType = type;
            event.dataTransfer.setData('text/plain', type);
        }

        function handleDropSlot(event, slotKey) {
            event.preventDefault();
            if (isChecked) return;
            const type = event.dataTransfer.getData('text/plain') || selectedBlockType;
            if (!type) return;

            slotAnswers[slotKey] = type;
            selectedBlockType = null;
            renderPalette();
            renderSlots();
        }

        function handleSlotClick(slotKey) {
            if (isChecked) return;
            if (selectedBlockType) {
                slotAnswers[slotKey] = selectedBlockType;
                selectedBlockType = null;
                renderPalette();
                renderSlots();
            } else if (slotAnswers[slotKey]) {
                slotAnswers[slotKey] = null;
                renderSlots();
            }
        }

        function renderStarIcons(stars) {
            const starSvg = (filled) => `
            <svg class="w-7 h-7 ${filled ? 'text-amber-400' : 'text-slate-200'}" viewBox="0 0 24 24" fill="currentColor">
                <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd"/>
            </svg>
        `;
            return [1, 2, 3].map(i => starSvg(i <= stars)).join('');
        }

        function checkFlowchart() {
            isChecked = true;
            slotValidation = {};

            const slotKeys = Object.keys(activeChallenge.slots);
            let correctCount = 0;

            slotKeys.forEach(key => {
                const isCorrect = slotAnswers[key] === activeChallenge.slots[key].expected;
                slotValidation[key] = isCorrect;
                if (isCorrect) correctCount++;
            });

            const scoreOutOf10 = Math.round((correctCount / slotKeys.length) * 10);
            const stars = scoreOutOf10 === 10 ? 3 : (scoreOutOf10 >= 8 ? 2 : (scoreOutOf10 >= 5 ? 1 : 0));

            document.getElementById('flow-total-score').textContent = scoreOutOf10;
            document.getElementById('flow-temp-score').textContent = scoreOutOf10;
            document.getElementById('flow-progress-bar').style.width = scoreOutOf10 >= 8 ? '100%' : '50%';
            document.getElementById('flow-soal-counter').textContent = scoreOutOf10 >= 8 ? '1 / 1' : '0 / 1';

            renderSlots();

            document.getElementById('flow-modal-stars').innerHTML = renderStarIcons(stars);
            document.getElementById('flow-modal-score').textContent = `${scoreOutOf10} / 10`;
            document.getElementById('flow-modal-correct').textContent = `${correctCount} / ${slotKeys.length}`;

            const continueBtn = document.getElementById('flow-continue-btn');
            const continueText = document.getElementById('flow-continue-text');
            const flowMascotImg = document.getElementById('flow-modal-mascot');

            if (scoreOutOf10 >= 8) {
                window.unlockMateriTab('nav-tab-evaluasi', 'nav-tab-evaluasi-icon', 'Lanjut ke Evaluasi');
                if (flowMascotImg) flowMascotImg.src = "{{ asset('images/mascot_happy.png') }}";
                document.getElementById('flow-modal-title').textContent = 'Flowchart Tepat!';
                document.getElementById('flow-modal-desc').textContent = 'Susunan blok flowchart sudah benar! Sekarang lanjut ke tahap Evaluasi untuk menuntaskan level ini.';
                continueBtn.href = evaluasiUrl;
                continueBtn.onclick = null;
                continueText.textContent = 'Lanjut ke Evaluasi';
            } else {
                if (flowMascotImg) flowMascotImg.src = "{{ asset('images/mascot_angry.png') }}";
                document.getElementById('flow-modal-title').textContent = 'Belum Tepat!';
                document.getElementById('flow-modal-desc').textContent = 'Periksa kembali simbol yang berwarna merah, lalu susun ulang flowchart-nya.';
                continueBtn.href = '#';
                continueText.textContent = 'Perbaiki Jawaban';
                continueBtn.onclick = (e) => {
                    e.preventDefault();
                    closeFlowModal();
                    resetFlowchart();
                };
            }

            const modal = document.getElementById('flow-result-modal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeFlowModal() {
            const modal = document.getElementById('flow-result-modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function resetFlowchart() {
            slotAnswers = {
                step1: null,
                decision: null,
                branchYes: null,
                branchNo: null
            };
            selectedBlockType = null;
            isChecked = false;
            slotValidation = {};

            document.getElementById('flow-total-score').textContent = '0';
            document.getElementById('flow-temp-score').textContent = '0';
            document.getElementById('flow-progress-bar').style.width = '0%';
            document.getElementById('flow-soal-counter').textContent = '0 / 1';

            renderPalette();
            renderSlots();
        }

        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('flow-question-text').innerHTML = activeChallenge.questionHtml;
            document.getElementById('flow-continue-btn').href = evaluasiUrl;

            renderPalette();
            renderSlots();
        });
    </script>
@endpush
