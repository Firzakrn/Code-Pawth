@extends('layouts.materi')

@section('title', 'Praktik Coding Python — Code Pawth')
@section('materi_step', 'coding')
@section('materi_speech', 'Ayo ubah alur flowchart tadi menjadi kode Python!')

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
                        <span id="code-score-display">0</span> / 100
                    </div>
                    <div class="text-[11px] text-slate-500 font-medium">Skor Praktik Kode</div>
                </div>
            </div>

            <div class="w-px h-6 bg-slate-200"></div>

            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.3" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 18l6-6-6-6M8 6l-6 6 6 6" />
                    </svg>
                </div>
                <div>
                    <div id="code-active-step-label" class="text-sm font-extrabold text-slate-900 leading-tight">Langkah 1:
                        Blok Input</div>
                    <div class="text-[11px] text-slate-500 font-medium">Ikuti urutan flowchart dari atas ke bawah</div>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3 flex-1 md:max-w-md">
            <div class="flex-1 h-2.5 bg-slate-100 rounded-full overflow-hidden p-0.5 border border-slate-200/60">
                <div id="code-progress-bar"
                    class="h-full bg-gradient-to-r from-blue-500 to-blue-600 rounded-full transition-all duration-300"
                    style="width: 25%;"></div>
            </div>
            <span id="code-step-counter" class="text-xs font-extrabold text-slate-700 w-12 text-right">1 / 4</span>
        </div>
    </div>
@endsection

@section('materi_tab_right')
    <span
        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/90 border border-blue-100 text-blue-600 text-xs font-extrabold">
        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
        <span>Python 3</span>
    </span>
@endsection

@section('materi_content')
    <div
        class="flex-1 min-h-0 bg-white/95 backdrop-blur-xs rounded-3xl rounded-tl-xl border-2 border-white shadow-soft-card p-4 sm:p-5 grid grid-cols-1 lg:grid-cols-12 gap-4 overflow-y-auto">

        <!-- =====================================================================
                     PANEL KIRI (5/12): MINI-FLOWCHART REFERENSI & PANDUAN BARIS AKTIF
                ====================================================================== -->
        <div class="lg:col-span-5 flex flex-col justify-between gap-3 lg:min-h-0 lg:overflow-y-auto lg:pr-1">
            <div class="space-y-3">
                <div class="flex items-center justify-between gap-2">
                    <span
                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-50 text-blue-600 border border-blue-100 text-xs font-extrabold">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.3"
                            viewBox="0 0 24 24">
                            <rect x="7" y="3" width="10" height="5" rx="1.5" />
                            <polygon points="12,11 17,15 12,19 7,15" />
                            <path stroke-linecap="round" d="M12 8v3" />
                        </svg>
                        <span>Alur Flowchart Kamu</span>
                    </span>
                    <span class="text-[11px] font-semibold text-slate-400">Klik blok untuk fokus</span>
                </div>

                <!-- MINI-FLOWCHART INTERAKTIF (Sinkron dengan Editor Python) -->
                <div class="rounded-2xl bg-[#F4F8FF] border border-blue-100 p-3.5 flex flex-col items-center">

                    <!-- Mulai -->
                    <div
                        class="px-6 py-1 rounded-full bg-white border border-blue-300 text-slate-700 font-extrabold text-[11px]">
                        Mulai
                    </div>
                    <div class="w-0.5 h-2.5 bg-blue-400"></div>

                    <!-- Node 1: INPUT -->
                    <button type="button" id="mini-node-step1" onclick="focusCodeStep('step1')"
                        class="w-full max-w-[240px] px-3.5 py-2 rounded-xl border-2 border-blue-600 bg-white ring-3 ring-blue-500/20 flex items-center justify-between gap-2 text-left transition-all cursor-pointer">
                        <div class="flex items-center gap-2 min-w-0">
                            <span
                                class="w-5 h-5 rounded-md bg-blue-600 text-white text-[10px] font-extrabold flex items-center justify-center shrink-0">1</span>
                            <div class="min-w-0">
                                <div class="text-[11px] font-extrabold text-slate-900">Input Data</div>
                                <div id="mini-desc-step1" class="text-[10px] font-semibold text-blue-600 truncate">bilangan
                                    = int(input())</div>
                            </div>
                        </div>
                        <span id="mini-status-step1" class="w-2 h-2 rounded-full bg-blue-600 shrink-0"></span>
                    </button>

                    <div class="w-0.5 h-2.5 bg-blue-400"></div>

                    <!-- Node 2: KONDISI (IF) -->
                    <button type="button" id="mini-node-decision" onclick="focusCodeStep('decision')"
                        class="w-full max-w-[240px] px-3.5 py-2 rounded-xl border-2 border-blue-200 bg-white/90 hover:border-blue-400 flex items-center justify-between gap-2 text-left transition-all cursor-pointer">
                        <div class="flex items-center gap-2 min-w-0">
                            <span
                                class="w-5 h-5 rounded-md bg-blue-100 text-blue-700 text-[10px] font-extrabold flex items-center justify-center shrink-0">2</span>
                            <div class="min-w-0">
                                <div class="text-[11px] font-extrabold text-slate-900">Kondisi (if)</div>
                                <div id="mini-desc-decision" class="text-[10px] font-semibold text-slate-500 truncate">
                                    bilangan % 2 == 0</div>
                            </div>
                        </div>
                        <span id="mini-status-decision" class="w-2 h-2 rounded-full bg-slate-300 shrink-0"></span>
                    </button>

                    <!-- Cabang Ya & Tidak -->
                    <div class="w-full max-w-[260px] grid grid-cols-2 gap-2 pt-2">
                        <!-- Node 3: CABANG YA -->
                        <div class="flex flex-col items-center">
                            <span
                                class="px-2 py-0.5 rounded-full bg-emerald-50 border border-emerald-200 text-emerald-700 text-[10px] font-extrabold mb-1">
                                Ya
                            </span>
                            <button type="button" id="mini-node-branchYes" onclick="focusCodeStep('branchYes')"
                                class="w-full px-2.5 py-2 rounded-xl border-2 border-blue-200 bg-white/90 hover:border-blue-400 text-left transition-all cursor-pointer">
                                <div class="flex items-center justify-between gap-1">
                                    <span class="text-[10px] font-extrabold text-slate-800">3. Output Ya</span>
                                    <span id="mini-status-branchYes" class="w-2 h-2 rounded-full bg-slate-300"></span>
                                </div>
                                <div id="mini-desc-branchYes"
                                    class="text-[10px] font-semibold text-slate-500 truncate mt-0.5">print("Genap")</div>
                            </button>
                        </div>

                        <!-- Node 4: CABANG TIDAK (ELSE) -->
                        <div class="flex flex-col items-center">
                            <span
                                class="px-2 py-0.5 rounded-full bg-amber-50 border border-amber-200 text-amber-700 text-[10px] font-extrabold mb-1">
                                Tidak (else)
                            </span>
                            <button type="button" id="mini-node-branchNo" onclick="focusCodeStep('branchNo')"
                                class="w-full px-2.5 py-2 rounded-xl border-2 border-blue-200 bg-white/90 hover:border-blue-400 text-left transition-all cursor-pointer">
                                <div class="flex items-center justify-between gap-1">
                                    <span class="text-[10px] font-extrabold text-slate-800">4. Output Tidak</span>
                                    <span id="mini-status-branchNo" class="w-2 h-2 rounded-full bg-slate-300"></span>
                                </div>
                                <div id="mini-desc-branchNo"
                                    class="text-[10px] font-semibold text-slate-500 truncate mt-0.5">print("Ganjil")</div>
                            </button>
                        </div>
                    </div>

                    <div class="w-0.5 h-2.5 bg-blue-400 mt-1.5"></div>
                    <div
                        class="px-6 py-1 rounded-full bg-white border border-blue-300 text-slate-700 font-extrabold text-[11px]">
                        Selesai
                    </div>
                </div>

                <!-- KARTU PETUNJUK SINTAKS AKTIF -->
                <div class="rounded-2xl bg-[#F0F6FF] border border-blue-100 p-3.5 space-y-2">
                    <div class="flex items-center justify-between">
                        <span id="hint-step-badge" class="text-xs font-extrabold text-blue-700">
                            Langkah 1 • Simbol Input
                        </span>
                        <button type="button" onclick="autoFillCurrentStep()"
                            class="text-[11px] font-extrabold text-blue-600 hover:underline cursor-pointer">
                            Isi Contoh Baris Ini
                        </button>
                    </div>
                    <p id="hint-step-desc" class="text-xs text-slate-600 leading-relaxed">
                        Ubah blok <strong>Input bilangan</strong> menjadi perintah <code>int(input())</code> agar program
                        membaca angka dari pengguna.
                    </p>
                </div>
            </div>

            <!-- Tombol Sisipkan Token Cepat (Anti-Typo untuk Siswa) -->
            <div class="space-y-1.5 pt-1">
                <div class="text-[11px] font-extrabold text-slate-500">Sisipkan Cepat ke Baris Aktif:</div>
                <div id="quick-token-bar" class="flex flex-wrap gap-1.5"></div>
            </div>
        </div>

        <!-- =====================================================================
                     PANEL KANAN (7/12): EDITOR PYTHON TERPANDU & TERMINAL OUTPUT
                ====================================================================== -->
        <div class="lg:col-span-7 flex flex-col justify-between gap-3 lg:min-h-0">

            <!-- Kotak Editor Kode Python -->
            <div
                class="flex-1 min-h-[250px] rounded-2xl bg-[#0F172A] border border-slate-800 shadow-inner flex flex-col overflow-hidden">

                <!-- Header Tab Editor -->
                <div
                    class="px-4 py-2.5 bg-[#1E293B] border-b border-slate-700/80 flex items-center justify-between gap-2 shrink-0">
                    <div class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-rose-400"></span>
                        <span class="w-2.5 h-2.5 rounded-full bg-amber-400"></span>
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-400"></span>
                        <span class="ml-2 text-xs font-bold text-slate-200 tracking-wide">main.py</span>
                    </div>

                    <div class="flex items-center gap-2">
                        <span class="text-[11px] font-semibold text-slate-400">Uji Input:</span>
                        <input type="number" id="sim-input-value" value="8"
                            class="w-16 px-2 py-0.5 rounded-lg bg-slate-900 border border-slate-700 text-xs font-extrabold text-amber-300 text-center focus:outline-none focus:border-blue-400">
                    </div>
                </div>

                <!-- Area Penulisan Kode Terstruktur (Sinkron 1-on-1 dengan Flowchart) -->
                <div class="flex-1 p-4 font-mono text-xs sm:text-sm text-slate-100 space-y-2.5 overflow-y-auto">

                    <!-- Baris 1: INPUT -->
                    <div id="code-row-step1" onclick="focusCodeStep('step1')"
                        class="rounded-xl p-2 bg-blue-500/15 border border-blue-400/50 transition-all">
                        <div class="text-[11px] text-slate-400 mb-1 flex items-center justify-between">
                            <span><span class="text-slate-500 mr-2">1</span># Blok 1: Input data dari flowchart</span>
                            <span id="badge-row-step1" class="text-[10px] font-sans font-bold text-blue-300">Aktif</span>
                        </div>
                        <div class="flex items-center gap-2 pl-4">
                            <span class="text-sky-300 font-bold shrink-0" id="var-prefix-step1">bilangan =</span>
                            <input type="text" id="input-code-step1" onfocus="focusCodeStep('step1')"
                                oninput="handleCodeInput()" placeholder="ketik: int(input())" autocomplete="off"
                                spellcheck="false"
                                class="flex-1 bg-slate-900/90 border border-slate-700 focus:border-blue-400 rounded-lg px-2.5 py-1 text-emerald-300 placeholder-slate-600 focus:outline-none">
                        </div>
                    </div>

                    <!-- Baris 2: KONDISI (IF) -->
                    <div id="code-row-decision" onclick="focusCodeStep('decision')"
                        class="rounded-xl p-2 bg-slate-800/40 border border-transparent hover:border-slate-700 transition-all">
                        <div class="text-[11px] text-slate-400 mb-1 flex items-center justify-between">
                            <span><span class="text-slate-500 mr-2">2</span># Blok 2: Kondisi belah ketupat</span>
                            <span id="badge-row-decision"
                                class="text-[10px] font-sans font-bold text-slate-500">Menunggu</span>
                        </div>
                        <div class="flex items-center gap-2 pl-4">
                            <span class="text-purple-400 font-bold shrink-0">if</span>
                            <input type="text" id="input-code-decision" onfocus="focusCodeStep('decision')"
                                oninput="handleCodeInput()" placeholder="ketik: bilangan % 2 == 0" autocomplete="off"
                                spellcheck="false"
                                class="flex-1 bg-slate-900/90 border border-slate-700 focus:border-blue-400 rounded-lg px-2.5 py-1 text-amber-300 placeholder-slate-600 focus:outline-none">
                            <span class="text-purple-400 font-bold">:</span>
                        </div>
                    </div>

                    <!-- Baris 3: CABANG YA -->
                    <div id="code-row-branchYes" onclick="focusCodeStep('branchYes')"
                        class="rounded-xl p-2 bg-slate-800/40 border border-transparent hover:border-slate-700 transition-all">
                        <div class="text-[11px] text-slate-400 mb-1 flex items-center justify-between">
                            <span><span class="text-slate-500 mr-2">3</span># Blok 3: Jalur Ya (menjorok 4 spasi)</span>
                            <span id="badge-row-branchYes"
                                class="text-[10px] font-sans font-bold text-slate-500">Menunggu</span>
                        </div>
                        <div class="flex items-center gap-2 pl-9">
                            <span class="text-slate-600 select-none text-xs">····</span>
                            <input type="text" id="input-code-branchYes" onfocus="focusCodeStep('branchYes')"
                                oninput="handleCodeInput()" placeholder='ketik: print("Genap")' autocomplete="off"
                                spellcheck="false"
                                class="flex-1 bg-slate-900/90 border border-slate-700 focus:border-blue-400 rounded-lg px-2.5 py-1 text-emerald-300 placeholder-slate-600 focus:outline-none">
                        </div>
                    </div>

                    <!-- Baris 4: ELSE + CABANG TIDAK -->
                    <div id="code-row-branchNo" onclick="focusCodeStep('branchNo')"
                        class="rounded-xl p-2 bg-slate-800/40 border border-transparent hover:border-slate-700 transition-all">
                        <div class="text-[11px] text-slate-400 mb-1 flex items-center justify-between">
                            <span><span class="text-slate-500 mr-2">4</span># Blok 4: Jalur Tidak (else)</span>
                            <span id="badge-row-branchNo"
                                class="text-[10px] font-sans font-bold text-slate-500">Menunggu</span>
                        </div>
                        <div class="pl-4 text-purple-400 font-bold mb-1">else:</div>
                        <div class="flex items-center gap-2 pl-9">
                            <span class="text-slate-600 select-none text-xs">····</span>
                            <input type="text" id="input-code-branchNo" onfocus="focusCodeStep('branchNo')"
                                oninput="handleCodeInput()" placeholder='ketik: print("Ganjil")' autocomplete="off"
                                spellcheck="false"
                                class="flex-1 bg-slate-900/90 border border-slate-700 focus:border-blue-400 rounded-lg px-2.5 py-1 text-emerald-300 placeholder-slate-600 focus:outline-none">
                        </div>
                    </div>

                </div>
            </div>

            <!-- KONSOL OUTPUT SIMULASI PYTHON -->
            <div class="rounded-2xl bg-slate-900 border border-slate-800 px-4 py-3 flex flex-col gap-1.5 shrink-0">
                <div class="flex items-center justify-between">
                    <span
                        class="text-[11px] font-extrabold uppercase tracking-wider text-slate-400 flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-emerald-400" fill="none" stroke="currentColor"
                            stroke-width="2.4" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 9l3 3-3 3m5 0h3" />
                        </svg>
                        <span>Output Konsol</span>
                    </span>
                    <span id="console-status-badge" class="text-[11px] font-bold text-slate-500">Siap dijalankan</span>
                </div>
                <pre id="python-console-output"
                    class="font-mono text-xs text-slate-300 whitespace-pre-wrap leading-relaxed min-h-[38px]">Klik "Jalankan Kode" untuk menguji program Python kamu...</pre>
            </div>

            <!-- Bar Tombol Bawah -->
            <div class="flex items-center justify-between gap-2 pt-0.5 shrink-0">
                <button type="button" onclick="resetCodingEditor()"
                    class="px-4 py-2 rounded-full bg-white hover:bg-slate-50 text-slate-600 border border-slate-200 text-xs font-bold transition-colors cursor-pointer">
                    Reset Kode
                </button>

                <div class="flex items-center gap-2">
                    <button type="button" onclick="runPythonSimulation(false)"
                        class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-full bg-emerald-600 hover:bg-emerald-700 text-white text-xs sm:text-sm font-extrabold shadow-2xs transition-all cursor-pointer">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M4.5 5.653c0-1.426 1.529-2.33 2.779-1.643l11.54 6.348c1.295.712 1.295 2.573 0 3.285L7.28 19.991c-1.25.687-2.779-.217-2.779-1.643V5.653z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>Jalankan Kode</span>
                    </button>

                    <button type="button" id="btn-submit-code" onclick="runPythonSimulation(true)"
                        class="inline-flex items-center gap-1.5 px-5 py-2.5 rounded-full bg-blue-600 hover:bg-blue-700 text-white text-xs sm:text-sm font-extrabold shadow-soft-blue transition-all cursor-pointer">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>Periksa & Lanjut</span>
                    </button>
                </div>
            </div>

        </div>
    </div>

    <!-- MODAL HASIL CODING -> LANJUT KE EVALUASI -->
    <div id="code-result-modal"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/40 backdrop-blur-xs p-4">
        <div
            class="bg-white rounded-3xl max-w-md w-full p-6 sm:p-7 shadow-2xl border border-slate-100 text-center space-y-4">
            <img id="code-modal-mascot" src="{{ asset('images/mascot_happy.png') }}" alt="Maskot Hasil"
                class="w-24 h-24 mx-auto object-contain">

            <div id="code-modal-stars" class="flex items-center justify-center gap-1.5 text-amber-400"></div>

            <div>
                <h3 id="code-modal-title" class="text-xl font-extrabold text-slate-900">Kode Python Berhasil!</h3>
                <p id="code-modal-desc" class="text-xs sm:text-sm text-slate-600 mt-1.5 leading-relaxed">
                    Program Python kamu berjalan sesuai alur flowchart! Sekarang lanjut ke tahap Evaluasi.
                </p>
            </div>

            <div class="bg-slate-50 rounded-2xl p-3.5 border border-slate-200/80 flex items-center justify-around">
                <div>
                    <span class="block text-[11px] text-slate-400 font-semibold">Skor Kode</span>
                    <span id="code-modal-score" class="text-xl font-extrabold text-blue-600">100</span>
                </div>
                <div class="w-px h-8 bg-slate-200"></div>
                <div>
                    <span class="block text-[11px] text-slate-400 font-semibold">Blok Tepat</span>
                    <span id="code-modal-correct" class="text-xl font-extrabold text-emerald-600">4 / 4</span>
                </div>
            </div>

            <div class="pt-2 flex flex-col sm:flex-row gap-2.5">
                <button type="button" onclick="closeCodeModal()"
                    class="flex-1 py-2.5 px-4 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs sm:text-sm transition-colors cursor-pointer">
                    Periksa Kode Lagi
                </button>
                <a id="code-continue-btn" href="{{ url('/materi/evaluasi') }}"
                    class="flex-1 py-2.5 px-4 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs sm:text-sm shadow-soft-blue transition-all inline-flex items-center justify-center gap-1.5">
                    <span id="code-continue-text">Lanjut ke Evaluasi</span>
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
        // =========================================================================
        // KATALOG CODING YANG TERHUBUNG LANGSUNG DENGAN DATA FLOWCHART SEBELUMNYA
        // =========================================================================
        const codingCatalog = {
            1: {
                varPrefix: 'bilangan =',
                defaultTestInput: 8,
                steps: {
                    step1: {
                        label: 'Langkah 1: Blok Input',
                        miniDesc: 'Input bilangan',
                        hintTitle: 'Langkah 1 • Terjemahkan Simbol Input',
                        hintHtml: 'Di flowchart kamu memasang blok <strong>Input bilangan</strong>. Di Python, gunakan <code>int(input())</code> untuk menerima bilangan bulat.',
                        sample: 'int(input())',
                        placeholder: 'ketik: int(input())',
                        tokens: ['int(input())', 'input()'],
                        validate: (val) => /^int\s*\(\s*input\s*\(\s*\)\s*\)$/.test(val.trim())
                    },
                    decision: {
                        label: 'Langkah 2: Blok Kondisi',
                        miniDesc: 'bilangan % 2 == 0?',
                        hintTitle: 'Langkah 2 • Terjemahkan Simbol Kondisi (if)',
                        hintHtml: 'Simbol belah ketupat mengecek sisa bagi 2. Tulis syarat <code>bilangan % 2 == 0</code> setelah kata kunci <code>if</code>.',
                        sample: 'bilangan % 2 == 0',
                        placeholder: 'ketik: bilangan % 2 == 0',
                        tokens: ['bilangan', '% 2', '== 0'],
                        validate: (val) => /^bilangan\s*%\s*2\s*==\s*0$/.test(val.trim())
                    },
                    branchYes: {
                        label: 'Langkah 3: Cabang Ya',
                        miniDesc: 'Output: Genap',
                        hintTitle: 'Langkah 3 • Terjemahkan Jalur Ya',
                        hintHtml: 'Jika kondisi benar (Ya), tampilkan teks <strong>Genap</strong> menggunakan perintah <code>print("Genap")</code>.',
                        sample: 'print("Genap")',
                        placeholder: 'ketik: print("Genap")',
                        tokens: ['print(', '"Genap"', ')'],
                        validate: (val) => /^print\s*\(\s*["']Genap["']\s*\)$/i.test(val.trim())
                    },
                    branchNo: {
                        label: 'Langkah 4: Cabang Tidak',
                        miniDesc: 'Output: Ganjil',
                        hintTitle: 'Langkah 4 • Terjemahkan Jalur Tidak (else)',
                        hintHtml: 'Jika kondisi salah (Tidak), tampilkan teks <strong>Ganjil</strong> menggunakan perintah <code>print("Ganjil")</code>.',
                        sample: 'print("Ganjil")',
                        placeholder: 'ketik: print("Ganjil")',
                        tokens: ['print(', '"Ganjil"', ')'],
                        validate: (val) => /^print\s*\(\s*["']Ganjil["']\s*\)$/i.test(val.trim())
                    }
                },
                evaluateOutput: (num) => (Number(num) % 2 === 0 ? 'Genap' : 'Ganjil')
            },
            2: {
                varPrefix: 'nilai =',
                defaultTestInput: 85,
                steps: {
                    step1: {
                        label: 'Langkah 1: Blok Input',
                        miniDesc: 'Input nilai siswa',
                        hintTitle: 'Langkah 1 • Terjemahkan Simbol Input',
                        hintHtml: 'Ubah blok <strong>Input nilai siswa</strong> menjadi <code>int(input())</code> agar nilai angka dapat dibandingkan.',
                        sample: 'int(input())',
                        placeholder: 'ketik: int(input())',
                        tokens: ['int(input())', 'input()'],
                        validate: (val) => /^int\s*\(\s*input\s*\(\s*\)\s*\)$/.test(val.trim())
                    },
                    decision: {
                        label: 'Langkah 2: Blok Kondisi',
                        miniDesc: 'nilai >= 75?',
                        hintTitle: 'Langkah 2 • Terjemahkan Simbol Kondisi (if)',
                        hintHtml: 'Tulis syarat kelulusan <code>nilai >= 75</code> setelah kata kunci <code>if</code>.',
                        sample: 'nilai >= 75',
                        placeholder: 'ketik: nilai >= 75',
                        tokens: ['nilai', '>=', '75'],
                        validate: (val) => /^nilai\s*>=\s*75$/.test(val.trim())
                    },
                    branchYes: {
                        label: 'Langkah 3: Cabang Ya',
                        miniDesc: 'Output: Lulus',
                        hintTitle: 'Langkah 3 • Terjemahkan Jalur Ya',
                        hintHtml: 'Jika nilai memenuhi syarat (Ya), cetak <code>print("Lulus")</code>.',
                        sample: 'print("Lulus")',
                        placeholder: 'ketik: print("Lulus")',
                        tokens: ['print(', '"Lulus"', ')'],
                        validate: (val) => /^print\s*\(\s*["']Lulus["']\s*\)$/i.test(val.trim())
                    },
                    branchNo: {
                        label: 'Langkah 4: Cabang Tidak',
                        miniDesc: 'Output: Mengulang',
                        hintTitle: 'Langkah 4 • Terjemahkan Jalur Tidak (else)',
                        hintHtml: 'Jika nilai di bawah 75 (Tidak), cetak <code>print("Mengulang")</code>.',
                        sample: 'print("Mengulang")',
                        placeholder: 'ketik: print("Mengulang")',
                        tokens: ['print(', '"Mengulang"', ')'],
                        validate: (val) => /^print\s*\(\s*["']Mengulang["']\s*\)$/i.test(val.trim())
                    }
                },
                evaluateOutput: (num) => (Number(num) >= 75 ? 'Lulus' : 'Mengulang')
            }
        };

        const {
            levelId,
            evaluasiUrl
        } = window.MATERI_CTX;
        const seededCoding = window.MATERI_CTX.codingMaterial;
        const activeCoding = seededCoding ? {
            varPrefix: seededCoding.varPrefix,
            defaultTestInput: seededCoding.defaultTestInput,
            steps: {
                step1: {
                    label: seededCoding.step1_label,
                    miniDesc: seededCoding.step1_miniDesc,
                    hintTitle: seededCoding.step1_hintTitle,
                    hintHtml: seededCoding.step1_hintHtml,
                    sample: seededCoding.step1_sample,
                    placeholder: seededCoding.step1_placeholder,
                    tokens: seededCoding.step1_tokens,
                    validate: value => new RegExp(seededCoding.step1_validate_regex, 'i').test(value.trim())
                },
                decision: {
                    label: seededCoding.decision_label,
                    miniDesc: seededCoding.decision_miniDesc,
                    hintTitle: seededCoding.decision_hintTitle,
                    hintHtml: seededCoding.decision_hintHtml,
                    sample: seededCoding.decision_sample,
                    placeholder: seededCoding.decision_placeholder,
                    tokens: seededCoding.decision_tokens,
                    validate: value => new RegExp(seededCoding.decision_validate_regex, 'i').test(value.trim())
                },
                branchYes: {
                    label: seededCoding.branchYes_label,
                    miniDesc: seededCoding.branchYes_miniDesc,
                    hintTitle: seededCoding.branchYes_hintTitle,
                    hintHtml: seededCoding.branchYes_hintHtml,
                    sample: seededCoding.branchYes_sample,
                    placeholder: seededCoding.branchYes_placeholder,
                    tokens: seededCoding.branchYes_tokens,
                    validate: value => new RegExp(seededCoding.branchYes_validate_regex, 'i').test(value.trim())
                },
                branchNo: {
                    label: seededCoding.branchNo_label,
                    miniDesc: seededCoding.branchNo_miniDesc,
                    hintTitle: seededCoding.branchNo_hintTitle,
                    hintHtml: seededCoding.branchNo_hintHtml,
                    sample: seededCoding.branchNo_sample,
                    placeholder: seededCoding.branchNo_placeholder,
                    tokens: seededCoding.branchNo_tokens,
                    validate: value => new RegExp(seededCoding.branchNo_validate_regex, 'i').test(value.trim())
                }
            },
            evaluateOutput: value => {
                const operand = seededCoding.outputRule.operand;
                const numericValue = Number(value);
                let conditionIsMet;

                switch (seededCoding.outputRule.operator) {
                    case 'modulo-zero':
                        conditionIsMet = numericValue % operand === 0;
                        break;
                    case '>=':
                        conditionIsMet = numericValue >= operand;
                        break;
                    case '<=':
                        conditionIsMet = numericValue <= operand;
                        break;
                    case '>':
                        conditionIsMet = numericValue > operand;
                        break;
                    case '<':
                        conditionIsMet = numericValue < operand;
                        break;
                    default:
                        throw new Error('Kondisi coding demo tidak dikenali.');
                }

                return conditionIsMet
                    ? seededCoding.expected_output_yes
                    : seededCoding.expected_output_no;
            }
        } : (codingCatalog[levelId] || codingCatalog[1]);
        const stepOrder = ['step1', 'decision', 'branchYes', 'branchNo'];
        let activeStepKey = 'step1';

        function focusCodeStep(stepKey) {
            activeStepKey = stepKey;
            const stepMeta = activeCoding.steps[stepKey];
            const stepIdx = stepOrder.indexOf(stepKey) + 1;

            document.getElementById('code-active-step-label').textContent = stepMeta.label;
            document.getElementById('code-step-counter').textContent = `${stepIdx} / 4`;
            document.getElementById('code-progress-bar').style.width = `${stepIdx * 25}%`;

            document.getElementById('hint-step-badge').textContent = stepMeta.hintTitle;
            document.getElementById('hint-step-desc').innerHTML = stepMeta.hintHtml;

            // Render token cepat untuk langkah aktif
            const tokenBar = document.getElementById('quick-token-bar');
            tokenBar.innerHTML = stepMeta.tokens.map(tok => `
            <button
                type="button"
                onclick='insertQuickToken(${JSON.stringify(tok)})'
                class="px-2.5 py-1 rounded-lg bg-white hover:bg-blue-50 text-blue-700 border border-blue-200 font-mono text-xs font-bold shadow-2xs transition-colors cursor-pointer"
            >
                + ${tok}
            </button>
        `).join('');

            // Sorot Mini-Flowchart (kiri) & Baris Editor (kanan)
            stepOrder.forEach(key => {
                const miniNode = document.getElementById(`mini-node-${key}`);
                const codeRow = document.getElementById(`code-row-${key}`);
                const badgeRow = document.getElementById(`badge-row-${key}`);
                const isCurrent = key === stepKey;

                if (miniNode) {
                    miniNode.className = miniNode.className
                        .replace(/border-blue-600|border-blue-200|ring-3|ring-blue-500\/20/g, '')
                        .trim();
                    if (isCurrent) {
                        miniNode.classList.add('border-blue-600', 'ring-3', 'ring-blue-500/20');
                    } else {
                        miniNode.classList.add('border-blue-200');
                    }
                }

                if (codeRow) {
                    if (isCurrent) {
                        codeRow.className =
                            'rounded-xl p-2 bg-blue-500/15 border border-blue-400/50 transition-all';
                        if (badgeRow) {
                            badgeRow.textContent = 'Sedang diketik';
                            badgeRow.className = 'text-[10px] font-sans font-bold text-blue-300';
                        }
                    } else {
                        codeRow.className =
                            'rounded-xl p-2 bg-slate-800/40 border border-transparent hover:border-slate-700 transition-all';
                        if (badgeRow) {
                            const val = document.getElementById(`input-code-${key}`)?.value.trim();
                            badgeRow.textContent = val ? 'Terisi' : 'Menunggu';
                            badgeRow.className = val ?
                                'text-[10px] font-sans font-bold text-emerald-400' :
                                'text-[10px] font-sans font-bold text-slate-500';
                        }
                    }
                }
            });
        }

        function insertQuickToken(token) {
            const inputEl = document.getElementById(`input-code-${activeStepKey}`);
            if (!inputEl) return;

            const current = inputEl.value;
            const needsSpace = current.length > 0 && !current.endsWith(' ') && !current.endsWith('(') && !token.startsWith(
                ')');
            inputEl.value = current + (needsSpace ? ' ' : '') + token;
            inputEl.focus();
            handleCodeInput();
        }

        function autoFillCurrentStep() {
            const inputEl = document.getElementById(`input-code-${activeStepKey}`);
            if (!inputEl) return;
            inputEl.value = activeCoding.steps[activeStepKey].sample;
            inputEl.focus();
            handleCodeInput();
        }

        function handleCodeInput() {
            let validCount = 0;
            stepOrder.forEach(key => {
                const val = document.getElementById(`input-code-${key}`)?.value || '';
                const isValid = activeCoding.steps[key].validate(val);
                const dot = document.getElementById(`mini-status-${key}`);
                if (isValid) {
                    validCount++;
                    if (dot) dot.className = 'w-2 h-2 rounded-full bg-emerald-500 shrink-0';
                } else if (val.trim().length > 0) {
                    if (dot) dot.className = 'w-2 h-2 rounded-full bg-amber-400 shrink-0';
                } else {
                    if (dot) dot.className = 'w-2 h-2 rounded-full bg-slate-300 shrink-0';
                }
            });

            const score = Math.round((validCount / stepOrder.length) * 100);
            document.getElementById('code-score-display').textContent = score;
        }

        function renderStarIcons(stars) {
            const starSvg = (filled) => `
            <svg class="w-7 h-7 ${filled ? 'text-amber-400' : 'text-slate-200'}" viewBox="0 0 24 24" fill="currentColor">
                <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd"/>
            </svg>
        `;
            return [1, 2, 3].map(i => starSvg(i <= stars)).join('');
        }

        function runPythonSimulation(openResultModal = false) {
            const consoleOut = document.getElementById('python-console-output');
            const statusBadge = document.getElementById('console-status-badge');
            const testVal = document.getElementById('sim-input-value').value || activeCoding.defaultTestInput;

            let validCount = 0;
            const errors = [];

            stepOrder.forEach((key, idx) => {
                const val = document.getElementById(`input-code-${key}`)?.value || '';
                if (activeCoding.steps[key].validate(val)) {
                    validCount++;
                } else {
                    errors.push(
                        `Baris ${idx + 1} (${activeCoding.steps[key].label}): periksa sintaks -> contoh: ${activeCoding.steps[key].sample}`
                    );
                }
            });

            const score = Math.round((validCount / stepOrder.length) * 100);
            document.getElementById('code-score-display').textContent = score;

            if (errors.length === 0) {
                const outputText = activeCoding.evaluateOutput(testVal);
                statusBadge.textContent = 'Sukses (Exit Code 0)';
                statusBadge.className = 'text-[11px] font-bold text-emerald-400';
                consoleOut.className =
                    'font-mono text-xs text-emerald-300 whitespace-pre-wrap leading-relaxed min-h-[38px]';
                consoleOut.textContent = `>>> Input uji: ${testVal}\n>>> Output: ${outputText}`;
            } else {
                statusBadge.textContent = 'Syntax / Logic Check';
                statusBadge.className = 'text-[11px] font-bold text-rose-400';
                consoleOut.className = 'font-mono text-xs text-rose-300 whitespace-pre-wrap leading-relaxed min-h-[38px]';
                consoleOut.textContent = `Traceback (most recent call last):\n  ${errors[0]}`;
            }

            if (!openResultModal) return;

            const stars = score === 100 ? 3 : (score >= 75 ? 2 : (score >= 50 ? 1 : 0));
            const modalMascot = document.getElementById('code-modal-mascot');
            const continueBtn = document.getElementById('code-continue-btn');
            const continueText = document.getElementById('code-continue-text');

            document.getElementById('code-modal-stars').innerHTML = renderStarIcons(stars);
            document.getElementById('code-modal-score').textContent = score;
            document.getElementById('code-modal-correct').textContent = `${validCount} / 4`;

            if (score === 100) {
                window.unlockMateriTab('nav-tab-evaluasi', 'nav-tab-evaluasi-icon', 'Lanjut ke Evaluasi');
                if (modalMascot) modalMascot.src = "{{ asset('images/mascot_happy.png') }}";
                document.getElementById('code-modal-title').textContent = 'Kode Python Tepat!';
                document.getElementById('code-modal-desc').textContent =
                    'Semua blok flowchart berhasil diterjemahkan ke kode Python dengan benar. Lanjut ke tahap Evaluasi!';
                continueBtn.href = evaluasiUrl;
                continueBtn.onclick = null;
                continueText.textContent = 'Lanjut ke Evaluasi';
            } else {
                if (modalMascot) modalMascot.src = "{{ asset('images/mascot_angry.png') }}";
                document.getElementById('code-modal-title').textContent = 'Kode Belum Lengkap!';
                document.getElementById('code-modal-desc').textContent =
                    'Periksa kembali pesan pada konsol output agar ke-4 blok flowchart sesuai dengan kode Python.';
                continueBtn.href = '#';
                continueText.textContent = 'Perbaiki Kode';
                continueBtn.onclick = (e) => {
                    e.preventDefault();
                    closeCodeModal();
                };
            }

            const modal = document.getElementById('code-result-modal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeCodeModal() {
            const modal = document.getElementById('code-result-modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function resetCodingEditor() {
            stepOrder.forEach(key => {
                const el = document.getElementById(`input-code-${key}`);
                if (el) el.value = '';
            });
            document.getElementById('python-console-output').className =
                'font-mono text-xs text-slate-300 whitespace-pre-wrap leading-relaxed min-h-[38px]';
            document.getElementById('python-console-output').textContent =
                'Klik "Jalankan Kode" untuk menguji program Python kamu...';
            document.getElementById('console-status-badge').textContent = 'Siap dijalankan';
            document.getElementById('console-status-badge').className = 'text-[11px] font-bold text-slate-500';
            handleCodeInput();
            focusCodeStep('step1');
        }

        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('var-prefix-step1').textContent = activeCoding.varPrefix;
            document.getElementById('sim-input-value').value = activeCoding.defaultTestInput;
            document.getElementById('code-continue-btn').href = evaluasiUrl;

            stepOrder.forEach(key => {
                const stepData = activeCoding.steps[key];
                const descEl = document.getElementById(`mini-desc-${key}`);
                const inputEl = document.getElementById(`input-code-${key}`);
                if (descEl) descEl.textContent = stepData.miniDesc;
                if (inputEl) inputEl.placeholder = stepData.placeholder;
            });

            focusCodeStep('step1');
        });
    </script>
@endpush
