@extends('layouts.app')

@section('title', 'Editor Worksheet Flowchart — Code Pawth')

@php
    $worksheet = $worksheet ?? null;
    $isEdit = $worksheet !== null;

    $classList =
        $classes ??
        collect([
            (object) ['id' => 1, 'name' => 'Kelas 8A - Informatika', 'level' => 'SMP'],
            (object) ['id' => 2, 'name' => 'Kelas 8B - Logika & Algoritma', 'level' => 'SMP'],
            (object) ['id' => 3, 'name' => 'Kelas 10A - Dasar Pemrograman', 'level' => 'SMA'],
        ]);

    $defaultQuestions = [
        [
            'question' => 'Lengkapi flowchart berikut untuk menentukan apakah sebuah bilangan genap atau ganjil!',
            'slots' => [
                'step1' => ['expected' => 'input', 'filledSub' => 'Input bilangan', 'lockedHint' => false],
                'decision' => ['expected' => 'kondisi', 'filledSub' => 'bilangan % 2 == 0?', 'lockedHint' => false],
                'branchYes' => ['expected' => 'output', 'filledSub' => 'Output: Genap', 'lockedHint' => false],
                'branchNo' => ['expected' => 'output', 'filledSub' => 'Output: Ganjil', 'lockedHint' => false],
            ],
        ],
        [
            'question' => 'Lengkapi flowchart untuk mengecek apakah nilai siswa lulus (nilai >= 75) atau mengulang!',
            'slots' => [
                'step1' => ['expected' => 'input', 'filledSub' => 'Input nilai siswa', 'lockedHint' => false],
                'decision' => ['expected' => 'kondisi', 'filledSub' => 'nilai >= 75?', 'lockedHint' => false],
                'branchYes' => ['expected' => 'output', 'filledSub' => 'Output: Lulus', 'lockedHint' => false],
                'branchNo' => ['expected' => 'output', 'filledSub' => 'Output: Mengulang', 'lockedHint' => false],
            ],
        ],
    ];

    $initialQuestions = old('questions', $worksheet?->content['questions'] ?? $defaultQuestions);

    $studioUrl = \Illuminate\Support\Facades\Route::has('guru.studio') ? route('guru.studio') : url('/guru/studio');

    $hasSaveRoute = $isEdit
        ? \Illuminate\Support\Facades\Route::has('guru.flowchart.update')
        : \Illuminate\Support\Facades\Route::has('guru.flowchart.store');

    $formAction = $hasSaveRoute
        ? ($isEdit
            ? route('guru.flowchart.update', $worksheet)
            : route('guru.flowchart.store'))
        : '#dummy-save';
@endphp

@section('content')
    <div class="relative w-full min-h-full overflow-x-hidden">

        <!-- DEKORASI BACKGROUND (BLOB, AWAN, PAW KUCING & BINTANG) -->
        <div class="pointer-events-none select-none absolute inset-0 overflow-hidden z-0">
            <div class="absolute -top-24 -left-24 w-96 h-96 rounded-full bg-blue-200/45 blur-3xl"></div>
            <div class="absolute top-16 right-1/4 w-[28rem] h-[28rem] rounded-full bg-white/65 blur-2xl"></div>
            <div class="absolute top-1/3 -right-24 w-96 h-96 rounded-full bg-indigo-200/40 blur-3xl"></div>
            <div class="absolute bottom-1/4 -left-24 w-[26rem] h-[26rem] rounded-full bg-sky-200/40 blur-3xl"></div>
            <div class="absolute -bottom-24 right-1/4 w-[32rem] h-[32rem] rounded-full bg-blue-200/45 blur-3xl"></div>

            <!-- Awan Besar Atas Kanan -->
            <svg class="absolute -top-6 right-8 w-[440px] h-44 text-white/65" viewBox="0 0 440 160" fill="currentColor">
                <circle cx="90" cy="115" r="55" />
                <circle cx="165" cy="95" r="70" />
                <circle cx="255" cy="100" r="65" />
                <circle cx="335" cy="115" r="50" />
                <rect x="40" y="110" width="340" height="50" rx="25" />
            </svg>

            <!-- Awan Besar Tengah Kiri -->
            <svg class="absolute top-[42%] -left-20 w-[460px] h-44 text-white/55" viewBox="0 0 460 160" fill="currentColor">
                <circle cx="80" cy="120" r="60" />
                <circle cx="170" cy="95" r="75" />
                <circle cx="270" cy="105" r="65" />
                <circle cx="360" cy="125" r="50" />
                <rect x="20" y="115" width="380" height="45" rx="22" />
            </svg>

            <!-- Paw Kucing Besar di Background -->
            <svg class="absolute top-32 left-[48%] w-32 h-32 text-blue-300/30 -rotate-12" viewBox="0 0 64 64"
                fill="currentColor">
                <ellipse cx="16" cy="22" rx="5.5" ry="7.5" transform="rotate(-18 16 22)" />
                <ellipse cx="27" cy="15" rx="5.5" ry="8" transform="rotate(-6 27 15)" />
                <ellipse cx="39" cy="15" rx="5.5" ry="8" transform="rotate(8 39 15)" />
                <ellipse cx="49" cy="23" rx="5.5" ry="7.5" transform="rotate(20 49 23)" />
                <path
                    d="M32 27c-9.5 0-16 6.8-16 14.2 0 5.2 4.2 8.8 9.2 8.8 2.6 0 4.6-1 6.8-1s4.2 1 6.8 1c5 0 9.2-3.6 9.2-8.8C48 33.8 41.5 27 32 27z" />
            </svg>

            <!-- Bintang Dekoratif -->
            <svg class="absolute top-12 left-[42%] w-7 h-7 text-blue-400/55" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 1l2.6 7.4L22 11l-7.4 2.6L12 21l-2.6-7.4L2 11l7.4-2.6L12 1z" />
            </svg>
            <svg class="absolute top-24 right-[28%] w-5 h-5 text-sky-400/60" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 1l2.6 7.4L22 11l-7.4 2.6L12 21l-2.6-7.4L2 11l7.4-2.6L12 1z" />
            </svg>
            <svg class="absolute bottom-32 left-10 w-8 h-8 text-blue-400/45" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 1l2.6 7.4L22 11l-7.4 2.6L12 21l-2.6-7.4L2 11l7.4-2.6L12 1z" />
            </svg>
        </div>

        <!-- KONTEN UTAMA -->
        <div class="relative z-10 w-full max-w-7xl mx-auto px-5 sm:px-8 py-6 space-y-6">

            <!-- BREADCRUMB -->
            <nav class="flex items-center justify-between gap-3 flex-wrap">
                <div class="flex items-center gap-2 text-xs font-bold text-slate-400">
                    <a href="{{ $studioUrl }}"
                        class="inline-flex items-center gap-1.5 text-blue-600 hover:text-blue-700 transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                        </svg>
                        <span>Studio Konten</span>
                    </a>
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2.5"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                    <span class="text-slate-700">Worksheet Flowchart</span>
                </div>

                @if (!$hasSaveRoute)
                    <span
                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-50 border border-amber-200 text-[11px] font-extrabold text-amber-700">
                        <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                        <span>Mode Pratinjau Dummy Aktif</span>
                    </span>
                @endif
            </nav>

            <!-- HERO HEADER -->
            <header
                class="relative overflow-hidden rounded-3xl bg-white/95 backdrop-blur-sm border border-white shadow-soft-card p-6 sm:p-8 flex flex-col md:flex-row items-center justify-between gap-6">
                <svg class="pointer-events-none select-none absolute -bottom-8 right-10 w-96 h-36 text-blue-50/90"
                    viewBox="0 0 380 140" fill="currentColor">
                    <circle cx="70" cy="95" r="48" />
                    <circle cx="145" cy="75" r="60" />
                    <circle cx="225" cy="85" r="55" />
                    <circle cx="300" cy="100" r="45" />
                    <rect x="30" y="90" width="310" height="50" />
                </svg>

                <div class="relative z-10 max-w-2xl space-y-3">
                    <div
                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-50 border border-blue-100 text-[11px] font-extrabold uppercase tracking-wider text-blue-600">
                        <svg class="w-3.5 h-3.5 text-blue-600" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M11.25 3v4.046a3 3 0 00-4.277 4.204H1.5v-6A2.25 2.25 0 013.75 3h7.5zM12.75 3v4.011a3 3 0 014.239 4.239H22.5v-6A2.25 2.25 0 0020.25 3h-7.5zM22.5 12.75h-8.983a4.125 4.125 0 004.108 3.75.75.75 0 010 1.5 5.623 5.623 0 01-4.875-2.817V21h7.5a2.25 2.25 0 002.25-2.25v-6zM11.25 21v-5.817A5.623 5.623 0 016.375 18a.75.75 0 010-1.5 4.126 4.126 0 004.108-3.75H1.5v6A2.25 2.25 0 003.75 21h7.5z" />
                        </svg>
                        <span>STUDIO KONTEN GURU</span>
                    </div>

                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-slate-900">
                        {{ $isEdit ? 'Edit' : 'Buat' }}
                        <span class="text-blue-600">Worksheet Flowchart</span>
                    </h1>

                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed max-w-xl">
                        Susun studi kasus algoritma, atur simbol kunci jawaban pada tiap cabang diagram di sebelah kiri,
                        dan uji coba langsung worksheet siswa di sebelah kanan.
                    </p>
                </div>

                <div class="relative z-10 shrink-0">
                    <img src="{{ asset('images/mascot_think.png') }}" alt="Maskot Editor Flowchart"
                        class="w-36 h-36 sm:w-44 sm:h-44 object-contain drop-shadow-sm">
                </div>
            </header>

            <!-- FORM UTAMA -->
            <form id="flowchartWorksheetForm" method="POST" action="{{ $formAction }}"
                data-dummy-mode="{{ $hasSaveRoute ? 'false' : 'true' }}">
                @csrf
                @if ($isEdit)
                    @method('PUT')
                @endif

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

                    <!-- ===============================================================
                             KOLOM KIRI (7/12): FORM KONFIGURASI WORKSHEET FLOWCHART
                        ================================================================ -->
                    <div class="lg:col-span-7 space-y-6">

                        <!-- PANEL 1: INFORMASI WORKSHEET -->
                        <section
                            class="bg-white/95 backdrop-blur-sm rounded-3xl border border-white shadow-soft-card p-6 sm:p-7 space-y-5">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-2xl bg-blue-50 border border-blue-100 flex items-center justify-center text-blue-600 shrink-0">
                                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5.625 1.5c-1.036 0-1.875.84-1.875 1.875v17.25c0 1.035.84 1.875 1.875 1.875h12.75c1.035 0 1.875-.84 1.875-1.875V12.75A3.75 3.75 0 0016.5 9h-1.875a1.875 1.875 0 01-1.875-1.875V5.25A3.75 3.75 0 009 1.5H5.625z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div>
                                    <h2 class="text-base sm:text-lg font-extrabold text-slate-900">
                                        Informasi Worksheet
                                    </h2>
                                    <p class="text-xs text-slate-500">
                                        Atur judul latihan flowchart, jenjang sasaran, dan kelas tujuan.
                                    </p>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <label for="wsTitle" class="block text-xs font-extrabold text-slate-700 mb-1.5">
                                        Judul Worksheet Flowchart
                                    </label>
                                    <input id="wsTitle" name="title" type="text" maxlength="255"
                                        placeholder="Contoh: Logika Percabangan Genap & Ganjil"
                                        value="{{ old('title', $worksheet?->title ?? 'Logika Percabangan Dasar') }}"
                                        required
                                        class="w-full rounded-2xl bg-slate-50/85 border border-slate-200 px-4 py-3 text-xs sm:text-sm font-semibold text-slate-800 placeholder:text-slate-400 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all">
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label for="wsLevel" class="block text-xs font-extrabold text-slate-700 mb-1.5">
                                            Jenjang
                                        </label>
                                        <div class="relative">
                                            <select id="wsLevel" name="level" required
                                                class="w-full appearance-none rounded-2xl bg-slate-50/85 border border-slate-200 px-4 py-3 pr-10 text-xs sm:text-sm font-semibold text-slate-800 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all cursor-pointer">
                                                @foreach (['SD', 'SMP', 'SMA'] as $lvl)
                                                    <option value="{{ $lvl }}" @selected(old('level', $worksheet?->level ?? 'SMP') === $lvl)>
                                                        {{ $lvl }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <svg class="w-4 h-4 text-slate-500 pointer-events-none absolute right-3.5 top-1/2 -translate-y-1/2"
                                                fill="none" stroke="currentColor" stroke-width="2.5"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </div>
                                    </div>

                                    <div>
                                        <label for="wsClassId" class="block text-xs font-extrabold text-slate-700 mb-1.5">
                                            Kelas Tujuan
                                        </label>
                                        <div class="relative">
                                            <select id="wsClassId" name="learning_class_id"
                                                class="w-full appearance-none rounded-2xl bg-slate-50/85 border border-slate-200 px-4 py-3 pr-10 text-xs sm:text-sm font-semibold text-slate-800 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all cursor-pointer">
                                                <option value="">Belum memilih kelas</option>
                                                @foreach ($classList as $cls)
                                                    <option value="{{ $cls->id }}" @selected((string) old('learning_class_id', $worksheet?->learning_class_id ?? 1) === (string) $cls->id)>
                                                        {{ $cls->name }} ({{ $cls->level }})
                                                    </option>
                                                @endforeach
                                            </select>
                                            <svg class="w-4 h-4 text-slate-500 pointer-events-none absolute right-3.5 top-1/2 -translate-y-1/2"
                                                fill="none" stroke="currentColor" stroke-width="2.5"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label for="wsHint" class="block text-xs font-extrabold text-slate-700 mb-1.5">
                                        Petunjuk Pengerjaan Siswa
                                    </label>
                                    <input id="wsHint" name="instruction" type="text" maxlength="255"
                                        value="{{ old('instruction', $worksheet?->content['instruction'] ?? 'Seret atau klik blok di bawah lalu klik kotak kosong di kanan untuk melengkapi flowchart.') }}"
                                        class="w-full rounded-2xl bg-slate-50/85 border border-slate-200 px-4 py-2.5 text-xs font-semibold text-slate-800 focus:bg-white focus:border-blue-500 outline-none transition-all">
                                </div>
                            </div>
                        </section>

                        <!-- PANEL 2: EDITOR SOAL & SLOT FLOWCHART -->
                        <section
                            class="bg-white/95 backdrop-blur-sm rounded-3xl border border-white shadow-soft-card p-6 sm:p-7 space-y-4">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 rounded-2xl bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-600 shrink-0">
                                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                            <path
                                                d="M11.25 3v4.046a3 3 0 00-4.277 4.204H1.5v-6A2.25 2.25 0 013.75 3h7.5zM12.75 3v4.011a3 3 0 014.239 4.239H22.5v-6A2.25 2.25 0 0020.25 3h-7.5zM22.5 12.75h-8.983a4.125 4.125 0 004.108 3.75.75.75 0 010 1.5 5.623 5.623 0 01-4.875-2.817V21h7.5a2.25 2.25 0 002.25-2.25v-6zM11.25 21v-5.817A5.623 5.623 0 016.375 18a.75.75 0 010-1.5 4.126 4.126 0 004.108-3.75H1.5v6A2.25 2.25 0 003.75 21h7.5z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h2 class="text-base sm:text-lg font-extrabold text-slate-900">
                                            Susunan Soal Flowchart
                                        </h2>
                                        <p class="text-xs text-slate-500">
                                            Tentukan simbol kunci jawaban & teks pada keempat bagian flowchart.
                                        </p>
                                    </div>
                                </div>

                                <!-- Preset Contoh Cepat -->
                                <div class="flex items-center gap-1.5 flex-wrap">
                                    <span class="text-[10px] font-extrabold text-slate-400 uppercase">Contoh:</span>
                                    <button type="button" onclick="applyPresetToActive('evenOdd')"
                                        class="px-2.5 py-1 rounded-full bg-blue-50 hover:bg-blue-100 text-blue-700 text-[11px] font-bold transition-colors cursor-pointer">
                                        Genap/Ganjil
                                    </button>
                                    <button type="button" onclick="applyPresetToActive('passGrade')"
                                        class="px-2.5 py-1 rounded-full bg-indigo-50 hover:bg-indigo-100 text-indigo-700 text-[11px] font-bold transition-colors cursor-pointer">
                                        Lulus Nilai
                                    </button>
                                    <button type="button" onclick="applyPresetToActive('tempCheck')"
                                        class="px-2.5 py-1 rounded-full bg-sky-50 hover:bg-sky-100 text-sky-700 text-[11px] font-bold transition-colors cursor-pointer">
                                        Cek Suhu
                                    </button>
                                </div>
                            </div>

                            <!-- Daftar Unit Soal Flowchart -->
                            <div id="flowQuestionItems" class="space-y-4"></div>

                            <button type="button" id="btnAddFlowQuestion"
                                class="w-full rounded-2xl border-2 border-dashed border-blue-200 bg-blue-50/60 hover:bg-blue-100/70 hover:border-blue-400 text-blue-700 py-3.5 px-4 text-xs font-extrabold inline-flex items-center justify-center gap-2 transition-all cursor-pointer">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.8"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                <span>Tambah Soal Flowchart</span>
                            </button>
                        </section>

                        <!-- PANEL 3: PENGATURAN PUBLIKASI -->
                        <section
                            class="bg-white/95 backdrop-blur-sm rounded-3xl border border-white shadow-soft-card p-6 sm:p-7 space-y-5">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-2xl bg-sky-50 border border-sky-100 flex items-center justify-center text-sky-600 shrink-0">
                                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M9.315 7.584C12.195 3.883 16.695 1.5 21.75 1.5a.75.75 0 01.75.75c0 5.056-2.383 9.555-6.084 12.436A6.75 6.75 0 019.75 22.5a.75.75 0 01-.75-.75v-4.131A15.838 15.838 0 016.382 15H2.25a.75.75 0 01-.75-.75 6.75 6.75 0 017.815-6.666zM15 6.75a2.25 2.25 0 100 4.5 2.25 2.25 0 000-4.5z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div>
                                    <h2 class="text-base sm:text-lg font-extrabold text-slate-900">
                                        Pengaturan Publikasi
                                    </h2>
                                    <p class="text-xs text-slate-500">
                                        Simpan sebagai draft atau langsung terbitkan ke kelas tujuan.
                                    </p>
                                </div>
                            </div>

                            <div>
                                <label for="wsStatus" class="block text-xs font-extrabold text-slate-700 mb-1.5">
                                    Status Worksheet
                                </label>
                                <div class="relative">
                                    <select name="status" id="wsStatus"
                                        class="w-full appearance-none rounded-2xl bg-slate-50/85 border border-slate-200 px-4 py-3 pr-10 text-xs sm:text-sm font-semibold text-slate-800 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all cursor-pointer">
                                        <option value="draft" @selected(old('status', $worksheet?->status ?? 'draft') === 'draft')>
                                            Simpan sebagai Draft
                                        </option>
                                        <option value="published" @selected(old('status', $worksheet?->status ?? 'draft') === 'published')>
                                            Terbitkan ke Kelas
                                        </option>
                                    </select>
                                    <svg class="w-4 h-4 text-slate-500 pointer-events-none absolute right-3.5 top-1/2 -translate-y-1/2"
                                        fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>

                            <div class="flex flex-wrap items-center justify-end gap-3 pt-2">
                                <a href="{{ $studioUrl }}"
                                    class="rounded-full bg-slate-100 hover:bg-slate-200 text-slate-700 px-5 py-2.5 text-xs font-extrabold transition-all">
                                    Kembali
                                </a>

                                <button type="submit"
                                    class="inline-flex items-center gap-2 rounded-full bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 text-xs font-extrabold shadow-soft-blue transition-all cursor-pointer">
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 011.04-.208z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span>Simpan Worksheet</span>
                                </button>
                            </div>
                        </section>

                    </div>

                    <!-- ===============================================================
                             KOLOM KANAN (5/12): LIVE PREVIEW INTERAKTIF WORKSHEET SISWA
                        ================================================================ -->
                    <aside class="lg:col-span-5 min-w-0">
                        <section
                            class="lg:sticky lg:top-6 bg-white/95 backdrop-blur-sm rounded-3xl border border-white shadow-soft-card p-5 sm:p-6 space-y-4">

                            <!-- Header Live Preview -->
                            <div class="flex items-center justify-between gap-2">
                                <div>
                                    <span class="text-[11px] font-extrabold uppercase tracking-wider text-blue-600">
                                        LIVE PREVIEW WORKSHEET
                                    </span>
                                    <h2 class="text-base sm:text-lg font-extrabold text-slate-900 mt-0.5">
                                        Pratinjau Tampilan Siswa
                                    </h2>
                                </div>

                                <span
                                    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 border border-emerald-200 text-[11px] font-extrabold text-emerald-700 shrink-0">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                    <span>Langsung</span>
                                </span>
                            </div>

                            <!-- Info Judul & Jenjang -->
                            <div
                                class="flex items-center justify-between gap-3 rounded-2xl bg-slate-50/90 border border-slate-200/80 px-4 py-2.5">
                                <strong id="previewWsTitle"
                                    class="text-xs sm:text-sm font-extrabold text-slate-800 truncate">
                                    Logika Percabangan Dasar
                                </strong>
                                <span id="previewWsLevel"
                                    class="px-3 py-0.5 rounded-full bg-blue-100 text-blue-700 text-[11px] font-extrabold shrink-0">
                                    SMP
                                </span>
                            </div>

                            <!-- Switcher Mode: Kunci Jawaban vs Uji Coba Siswa -->
                            <div class="grid grid-cols-2 gap-1.5 p-1 rounded-2xl bg-slate-100 border border-slate-200/70">
                                <button type="button" id="btnModeAnswerKey" onclick="setPreviewMode('key')"
                                    class="py-1.5 px-3 rounded-xl text-xs font-extrabold bg-white text-blue-600 shadow-2xs transition-all cursor-pointer">
                                    Kunci Jawaban
                                </button>
                                <button type="button" id="btnModeStudentTest" onclick="setPreviewMode('student')"
                                    class="py-1.5 px-3 rounded-xl text-xs font-bold text-slate-600 hover:text-slate-900 transition-all cursor-pointer">
                                    Uji Coba Siswa
                                </button>
                            </div>

                            <!-- Kotak Pertanyaan Soal Aktif -->
                            <div class="rounded-2xl bg-[#F0F6FF] border border-blue-100 p-3.5 space-y-1.5">
                                <div class="flex items-center justify-between gap-2">
                                    <span
                                        class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-white border border-blue-100 text-[10px] font-extrabold text-blue-600">
                                        Soal <span id="previewSoalBadge">1</span>
                                    </span>
                                    <span id="previewModeHint" class="text-[10px] font-bold text-blue-600">
                                        Menampilkan kunci jawaban lengkap
                                    </span>
                                </div>
                                <p id="previewQuestionText" class="text-xs font-extrabold text-slate-800 leading-relaxed">
                                    Lengkapi flowchart berikut...
                                </p>
                            </div>

                            <!-- KANVAS DIAGRAM FLOWCHART -->
                            <div class="rounded-2xl bg-[#F4F8FF] border border-blue-100/90 p-4 flex flex-col items-center">

                                <!-- 1. MULAI -->
                                <div
                                    class="px-8 py-1.5 rounded-full bg-[#E5EFFF] border-2 border-blue-400 text-slate-900 font-extrabold text-xs shadow-2xs">
                                    Mulai
                                </div>

                                <div class="flex flex-col items-center">
                                    <div class="w-0.5 h-3 bg-blue-500"></div>
                                    <svg class="w-2.5 h-2 text-blue-500 -mt-0.5" viewBox="0 0 12 10" fill="currentColor">
                                        <path d="M6 10L0 0h12z" />
                                    </svg>
                                </div>

                                <!-- 2. SLOT 1 (LANGKAH AWAL) -->
                                <div id="pv-slot-step1" ondragover="event.preventDefault()"
                                    ondrop="handlePreviewDrop(event, 'step1')" onclick="handlePreviewSlotClick('step1')"
                                    class="w-56 min-h-[42px] rounded-2xl border-2 border-blue-500 bg-white px-3 py-1.5 flex items-center justify-between gap-2 transition-all shadow-2xs">
                                </div>

                                <div class="flex flex-col items-center">
                                    <div class="w-0.5 h-3 bg-blue-500"></div>
                                    <svg class="w-2.5 h-2 text-blue-500 -mt-0.5" viewBox="0 0 12 10" fill="currentColor">
                                        <path d="M6 10L0 0h12z" />
                                    </svg>
                                </div>

                                <!-- 3. CABANG DECISION -->
                                <div class="w-full grid grid-cols-12 items-center">
                                    <!-- Kiri: Garis + Ya -->
                                    <div class="col-span-4 flex flex-col items-center">
                                        <div class="w-full flex items-center justify-end">
                                            <div class="w-1/2"></div>
                                            <div class="relative flex items-center flex-1">
                                                <div class="w-full h-0.5 bg-blue-500"></div>
                                                <span
                                                    class="absolute left-1/2 -translate-x-1/2 px-2 py-0.5 rounded-full bg-[#E8F1FF] border border-blue-300 text-[10px] font-extrabold text-slate-700">
                                                    Ya
                                                </span>
                                            </div>
                                        </div>
                                        <div class="w-full flex">
                                            <div class="w-1/2 flex flex-col items-center">
                                                <div class="w-0.5 h-6 bg-blue-500 -mt-[1px]"></div>
                                                <svg class="w-2.5 h-2 text-blue-500 -mt-0.5" viewBox="0 0 12 10"
                                                    fill="currentColor">
                                                    <path d="M6 10L0 0h12z" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Tengah: Belah Ketupat Decision -->
                                    <div class="col-span-4 flex items-center justify-center py-1">
                                        <div id="pv-slot-decision" ondragover="event.preventDefault()"
                                            ondrop="handlePreviewDrop(event, 'decision')"
                                            onclick="handlePreviewSlotClick('decision')"
                                            class="w-20 h-20 rotate-45 rounded-xl border-2 border-blue-600 bg-white shadow-2xs flex items-center justify-center transition-all">
                                            <div id="pv-slot-decision-inner" class="-rotate-45 text-center px-1"></div>
                                        </div>
                                    </div>

                                    <!-- Kanan: Garis + Tidak -->
                                    <div class="col-span-4 flex flex-col items-center">
                                        <div class="w-full flex items-center justify-start">
                                            <div class="relative flex items-center flex-1">
                                                <div class="w-full h-0.5 bg-blue-500"></div>
                                                <span
                                                    class="absolute left-1/2 -translate-x-1/2 px-2 py-0.5 rounded-full bg-[#E8F1FF] border border-blue-300 text-[10px] font-extrabold text-slate-700">
                                                    Tidak
                                                </span>
                                            </div>
                                            <div class="w-1/2"></div>
                                        </div>
                                        <div class="w-full flex justify-end">
                                            <div class="w-1/2 flex flex-col items-center">
                                                <div class="w-0.5 h-6 bg-blue-500 -mt-[1px]"></div>
                                                <svg class="w-2.5 h-2 text-blue-500 -mt-0.5" viewBox="0 0 12 10"
                                                    fill="currentColor">
                                                    <path d="M6 10L0 0h12z" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- 4. SLOT CABANG YA & TIDAK -->
                                <div class="w-full grid grid-cols-2 gap-2.5">
                                    <div id="pv-slot-branchYes" ondragover="event.preventDefault()"
                                        ondrop="handlePreviewDrop(event, 'branchYes')"
                                        onclick="handlePreviewSlotClick('branchYes')"
                                        class="min-h-[42px] rounded-2xl border-2 border-blue-500 bg-white px-2.5 py-1.5 flex items-center justify-between gap-1 transition-all shadow-2xs">
                                    </div>

                                    <div id="pv-slot-branchNo" ondragover="event.preventDefault()"
                                        ondrop="handlePreviewDrop(event, 'branchNo')"
                                        onclick="handlePreviewSlotClick('branchNo')"
                                        class="min-h-[42px] rounded-2xl border-2 border-blue-500 bg-white px-2.5 py-1.5 flex items-center justify-between gap-1 transition-all shadow-2xs">
                                    </div>
                                </div>

                                <!-- Garis Penggabung Bawah ke Selesai -->
                                <div class="w-full grid grid-cols-2">
                                    <div class="flex flex-col items-end">
                                        <div class="w-1/2 h-3 border-l-2 border-b-2 border-blue-500 rounded-bl-md"></div>
                                    </div>
                                    <div class="flex flex-col items-start">
                                        <div class="w-1/2 h-3 border-r-2 border-b-2 border-blue-500 rounded-br-md"></div>
                                    </div>
                                </div>
                                <div class="flex flex-col items-center">
                                    <div class="w-0.5 h-2.5 bg-blue-500"></div>
                                    <svg class="w-2.5 h-2 text-blue-500 -mt-0.5" viewBox="0 0 12 10" fill="currentColor">
                                        <path d="M6 10L0 0h12z" />
                                    </svg>
                                </div>

                                <!-- 5. SELESAI -->
                                <div
                                    class="px-8 py-1.5 rounded-full bg-[#E5EFFF] border-2 border-blue-400 text-slate-900 font-extrabold text-xs shadow-2xs">
                                    Selesai
                                </div>
                            </div>

                            <!-- Palet Blok Siswa (Muncul saat Mode Uji Coba Siswa) -->
                            <div id="studentTestPaletteBox"
                                class="hidden space-y-2 rounded-2xl bg-slate-50 border border-slate-200/80 p-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-[11px] font-extrabold text-slate-700">Blok Tersedia (Klik /
                                        Seret):</span>
                                    <button type="button" onclick="resetStudentTestSlots()"
                                        class="text-[11px] font-extrabold text-blue-600 hover:text-blue-700 cursor-pointer">
                                        Reset Uji Coba
                                    </button>
                                </div>
                                <div id="pv-block-palette" class="flex flex-wrap gap-1.5"></div>
                                <div id="pv-test-feedback" class="hidden text-[11px] font-bold px-3 py-1.5 rounded-xl">
                                </div>
                            </div>

                            <!-- Navigasi Antar Soal -->
                            <div class="flex items-center justify-between gap-3 pt-1">
                                <button type="button" id="btnPrevFlowSoal"
                                    class="inline-flex items-center gap-1.5 rounded-full bg-blue-50 hover:bg-blue-600 text-blue-700 hover:text-white border border-blue-100 px-3.5 py-2 text-[11px] font-extrabold transition-all cursor-pointer disabled:opacity-40 disabled:pointer-events-none">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.75 19.5L8.25 12l7.5-7.5" />
                                    </svg>
                                    <span>Sebelumnya</span>
                                </button>

                                <strong id="flowSoalCounter" class="text-xs font-extrabold text-slate-700">1 / 2</strong>

                                <button type="button" id="btnNextFlowSoal"
                                    class="inline-flex items-center gap-1.5 rounded-full bg-blue-50 hover:bg-blue-600 text-blue-700 hover:text-white border border-blue-100 px-3.5 py-2 text-[11px] font-extrabold transition-all cursor-pointer disabled:opacity-40 disabled:pointer-events-none">
                                    <span>Berikutnya</span>
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                    </svg>
                                </button>
                            </div>

                        </section>
                    </aside>

                </div>
            </form>

        </div>
    </div>

    <!-- MODAL KONFIRMASI SIMPAN DUMMY -->
    <div id="dummySaveModal"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/40 backdrop-blur-xs p-4">
        <div
            class="bg-white rounded-3xl max-w-md w-full p-6 sm:p-7 shadow-2xl border border-slate-100 text-center space-y-4">
            <img src="{{ asset('images/mascot_happy.png') }}" alt="Maskot Berhasil"
                class="w-24 h-24 mx-auto object-contain">

            <div>
                <span
                    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 border border-emerald-200 text-[11px] font-extrabold text-emerald-700 mb-2">
                    Pratinjau Dummy Berhasil Disimpan
                </span>
                <h3 id="dummyModalTitle" class="text-xl font-extrabold text-slate-900">
                    Worksheet Siap Digunakan!
                </h3>
                <p id="dummyModalDesc" class="text-xs sm:text-sm text-slate-600 mt-1.5 leading-relaxed">
                    Data worksheet flowchart berhasil divalidasi.
                </p>
            </div>

            <div class="bg-slate-50 rounded-2xl p-3.5 border border-slate-200/80 text-left space-y-1.5">
                <div class="text-[11px] font-extrabold text-slate-500 uppercase">Ringkasan Worksheet:</div>
                <div id="dummyModalSummary" class="text-xs font-bold text-slate-800 space-y-1"></div>
            </div>

            <button type="button" onclick="closeDummySaveModal()"
                class="w-full py-2.5 px-4 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white font-extrabold text-xs sm:text-sm shadow-soft-blue transition-all cursor-pointer">
                Tutup & Lanjut Edit
            </button>
        </div>
    </div>

    <!-- TEMPLATE SATU SOAL WORKSHEET FLOWCHART -->
    <template id="flowQuestionTemplate">
        <div class="flow-unit rounded-2xl bg-slate-50/90 border-2 border-slate-200/80 p-5 space-y-4 transition-colors"
            data-flow-unit>

            <div class="flex items-center justify-between gap-3">
                <div class="flex items-center gap-2">
                    <strong class="flow-unit-number text-sm font-extrabold text-blue-700">Soal 1</strong>
                    <button type="button" data-focus-preview
                        class="px-2.5 py-1 rounded-full bg-blue-50 hover:bg-blue-600 text-blue-600 hover:text-white text-[10px] font-extrabold transition-colors cursor-pointer">
                        Lihat di Preview
                    </button>
                </div>

                <button type="button" data-remove-flow
                    class="inline-flex items-center gap-1.5 rounded-full bg-rose-50 hover:bg-rose-600 text-rose-600 hover:text-white border border-rose-200 hover:border-rose-600 px-3 py-1.5 text-[11px] font-extrabold transition-all cursor-pointer">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                    </svg>
                    <span>Hapus</span>
                </button>
            </div>

            <!-- Pertanyaan / Instruksi Studi Kasus -->
            <div>
                <label class="block text-xs font-extrabold text-slate-700 mb-1">
                    Pertanyaan / Studi Kasus Flowchart
                </label>
                <textarea name="questions[__INDEX__][question]" data-field="question" rows="2" maxlength="500" required
                    placeholder="Contoh: Lengkapi flowchart berikut untuk menentukan apakah sebuah bilangan genap atau ganjil!"
                    class="w-full rounded-xl bg-white border border-slate-200 px-3.5 py-2.5 text-xs font-semibold text-slate-800 focus:border-blue-500 outline-none"></textarea>
            </div>

            <!-- Grid 4 Slot Konfigurasi Flowchart -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5 pt-1">

                <!-- SLOT 1: LANGKAH AWAL -->
                <div class="rounded-2xl bg-white border border-slate-200/90 p-3.5 space-y-2.5">
                    <div class="flex items-center justify-between gap-2">
                        <span class="text-[11px] font-extrabold text-blue-600 uppercase tracking-wide">
                            1. Langkah Awal
                        </span>
                        <label
                            class="inline-flex items-center gap-1.5 text-[10px] font-bold text-slate-500 cursor-pointer">
                            <input type="checkbox" name="questions[__INDEX__][slots][step1][lockedHint]"
                                data-slot-hint="step1" value="1" class="rounded border-slate-300 text-blue-600">
                            <span>Petunjuk Terbuka</span>
                        </label>
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-600 mb-1">Simbol Kunci Jawaban</label>
                        <select name="questions[__INDEX__][slots][step1][expected]" data-slot-expected="step1"
                            class="w-full rounded-xl bg-slate-50 border border-slate-200 px-3 py-2 text-xs font-bold text-slate-800 focus:border-blue-500 outline-none cursor-pointer">
                            <option value="input">Input (Jajar Genjang)</option>
                            <option value="proses">Proses (Persegi Panjang)</option>
                            <option value="output">Output (Jajar Genjang)</option>
                            <option value="kondisi">Kondisi (Belah Ketupat)</option>
                            <option value="terminator">Mulai / Selesai</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-600 mb-1">Teks Isi Blok</label>
                        <input type="text" name="questions[__INDEX__][slots][step1][filledSub]" data-slot-sub="step1"
                            placeholder="Contoh: Input bilangan" required
                            class="w-full rounded-xl bg-slate-50 border border-slate-200 px-3 py-2 text-xs font-semibold text-slate-800 focus:bg-white focus:border-blue-500 outline-none">
                    </div>
                </div>

                <!-- SLOT 2: PERCABANGAN / KONDISI -->
                <div class="rounded-2xl bg-white border border-slate-200/90 p-3.5 space-y-2.5">
                    <div class="flex items-center justify-between gap-2">
                        <span class="text-[11px] font-extrabold text-indigo-600 uppercase tracking-wide">
                            2. Percabangan (Diamond)
                        </span>
                        <label
                            class="inline-flex items-center gap-1.5 text-[10px] font-bold text-slate-500 cursor-pointer">
                            <input type="checkbox" name="questions[__INDEX__][slots][decision][lockedHint]"
                                data-slot-hint="decision" value="1" class="rounded border-slate-300 text-blue-600">
                            <span>Petunjuk Terbuka</span>
                        </label>
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-600 mb-1">Simbol Kunci Jawaban</label>
                        <select name="questions[__INDEX__][slots][decision][expected]" data-slot-expected="decision"
                            class="w-full rounded-xl bg-slate-50 border border-slate-200 px-3 py-2 text-xs font-bold text-slate-800 focus:border-blue-500 outline-none cursor-pointer">
                            <option value="kondisi">Kondisi (Belah Ketupat)</option>
                            <option value="proses">Proses (Persegi Panjang)</option>
                            <option value="input">Input (Jajar Genjang)</option>
                            <option value="output">Output (Jajar Genjang)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-600 mb-1">Ekspresi Kondisi</label>
                        <input type="text" name="questions[__INDEX__][slots][decision][filledSub]"
                            data-slot-sub="decision" placeholder="Contoh: bilangan % 2 == 0?" required
                            class="w-full rounded-xl bg-slate-50 border border-slate-200 px-3 py-2 text-xs font-semibold text-slate-800 focus:bg-white focus:border-blue-500 outline-none">
                    </div>
                </div>

                <!-- SLOT 3: CABANG YA (KIRI) -->
                <div class="rounded-2xl bg-white border border-slate-200/90 p-3.5 space-y-2.5">
                    <div class="flex items-center justify-between gap-2">
                        <span class="text-[11px] font-extrabold text-emerald-600 uppercase tracking-wide">
                            3. Cabang "Ya" (Kiri)
                        </span>
                        <label
                            class="inline-flex items-center gap-1.5 text-[10px] font-bold text-slate-500 cursor-pointer">
                            <input type="checkbox" name="questions[__INDEX__][slots][branchYes][lockedHint]"
                                data-slot-hint="branchYes" value="1" class="rounded border-slate-300 text-blue-600">
                            <span>Petunjuk Terbuka</span>
                        </label>
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-600 mb-1">Simbol Kunci Jawaban</label>
                        <select name="questions[__INDEX__][slots][branchYes][expected]" data-slot-expected="branchYes"
                            class="w-full rounded-xl bg-slate-50 border border-slate-200 px-3 py-2 text-xs font-bold text-slate-800 focus:border-blue-500 outline-none cursor-pointer">
                            <option value="output">Output (Jajar Genjang)</option>
                            <option value="proses">Proses (Persegi Panjang)</option>
                            <option value="input">Input (Jajar Genjang)</option>
                            <option value="kondisi">Kondisi (Belah Ketupat)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-600 mb-1">Teks Isi Blok "Ya"</label>
                        <input type="text" name="questions[__INDEX__][slots][branchYes][filledSub]"
                            data-slot-sub="branchYes" placeholder="Contoh: Output: Genap" required
                            class="w-full rounded-xl bg-slate-50 border border-slate-200 px-3 py-2 text-xs font-semibold text-slate-800 focus:bg-white focus:border-blue-500 outline-none">
                    </div>
                </div>

                <!-- SLOT 4: CABANG TIDAK (KANAN) -->
                <div class="rounded-2xl bg-white border border-slate-200/90 p-3.5 space-y-2.5">
                    <div class="flex items-center justify-between gap-2">
                        <span class="text-[11px] font-extrabold text-amber-600 uppercase tracking-wide">
                            4. Cabang "Tidak" (Kanan)
                        </span>
                        <label
                            class="inline-flex items-center gap-1.5 text-[10px] font-bold text-slate-500 cursor-pointer">
                            <input type="checkbox" name="questions[__INDEX__][slots][branchNo][lockedHint]"
                                data-slot-hint="branchNo" value="1" class="rounded border-slate-300 text-blue-600">
                            <span>Petunjuk Terbuka</span>
                        </label>
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-600 mb-1">Simbol Kunci Jawaban</label>
                        <select name="questions[__INDEX__][slots][branchNo][expected]" data-slot-expected="branchNo"
                            class="w-full rounded-xl bg-slate-50 border border-slate-200 px-3 py-2 text-xs font-bold text-slate-800 focus:border-blue-500 outline-none cursor-pointer">
                            <option value="output">Output (Jajar Genjang)</option>
                            <option value="proses">Proses (Persegi Panjang)</option>
                            <option value="input">Input (Jajar Genjang)</option>
                            <option value="kondisi">Kondisi (Belah Ketupat)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-600 mb-1">Teks Isi Blok "Tidak"</label>
                        <input type="text" name="questions[__INDEX__][slots][branchNo][filledSub]"
                            data-slot-sub="branchNo" placeholder="Contoh: Output: Ganjil" required
                            class="w-full rounded-xl bg-slate-50 border border-slate-200 px-3 py-2 text-xs font-semibold text-slate-800 focus:bg-white focus:border-blue-500 outline-none">
                    </div>
                </div>

            </div>
        </div>
    </template>
@endsection

@push('scripts')
    <script>
        const FLOW_BLOCKS = [{
                type: 'input',
                label: 'Input',
                svg: `<svg class="w-4 h-3.5 text-blue-600 shrink-0" viewBox="0 0 28 20" fill="none" stroke="currentColor" stroke-width="2"><polygon points="6,2 26,2 22,18 2,18" fill="#EBF3FF"/></svg>`
            },
            {
                type: 'output',
                label: 'Output',
                svg: `<svg class="w-4 h-3.5 text-blue-600 shrink-0" viewBox="0 0 28 20" fill="none" stroke="currentColor" stroke-width="2"><polygon points="6,2 26,2 22,18 2,18" fill="#EBF3FF"/></svg>`
            },
            {
                type: 'kondisi',
                label: 'Kondisi',
                svg: `<svg class="w-4 h-4 text-blue-600 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12,2 22,12 12,22 2,12" fill="#EBF3FF"/></svg>`
            },
            {
                type: 'proses',
                label: 'Proses',
                svg: `<svg class="w-4 h-3.5 text-blue-600 shrink-0" viewBox="0 0 28 20" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="24" height="16" rx="2" fill="#EBF3FF"/></svg>`
            },
            {
                type: 'terminator',
                label: 'Mulai / Selesai',
                svg: `<svg class="w-5 h-3.5 text-blue-600 shrink-0" viewBox="0 0 30 20" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="26" height="16" rx="8" fill="#EBF3FF"/></svg>`
            }
        ];

        const FLOW_PRESETS = {
            evenOdd: {
                question: 'Lengkapi flowchart berikut untuk menentukan apakah sebuah bilangan genap atau ganjil!',
                slots: {
                    step1: {
                        expected: 'input',
                        filledSub: 'Input bilangan',
                        lockedHint: false
                    },
                    decision: {
                        expected: 'kondisi',
                        filledSub: 'bilangan % 2 == 0?',
                        lockedHint: false
                    },
                    branchYes: {
                        expected: 'output',
                        filledSub: 'Output: Genap',
                        lockedHint: false
                    },
                    branchNo: {
                        expected: 'output',
                        filledSub: 'Output: Ganjil',
                        lockedHint: false
                    }
                }
            },
            passGrade: {
                question: 'Lengkapi flowchart untuk mengecek apakah nilai siswa lulus (nilai >= 75) atau mengulang!',
                slots: {
                    step1: {
                        expected: 'input',
                        filledSub: 'Input nilai siswa',
                        lockedHint: false
                    },
                    decision: {
                        expected: 'kondisi',
                        filledSub: 'nilai >= 75?',
                        lockedHint: false
                    },
                    branchYes: {
                        expected: 'output',
                        filledSub: 'Output: Lulus',
                        lockedHint: false
                    },
                    branchNo: {
                        expected: 'output',
                        filledSub: 'Output: Mengulang',
                        lockedHint: false
                    }
                }
            },
            tempCheck: {
                question: 'Lengkapi flowchart sensor ruangan untuk menyalakan kipas jika suhu > 30°C!',
                slots: {
                    step1: {
                        expected: 'input',
                        filledSub: 'Baca suhu ruang',
                        lockedHint: false
                    },
                    decision: {
                        expected: 'kondisi',
                        filledSub: 'suhu > 30?',
                        lockedHint: false
                    },
                    branchYes: {
                        expected: 'proses',
                        filledSub: 'Nyalakan Kipas',
                        lockedHint: false
                    },
                    branchNo: {
                        expected: 'proses',
                        filledSub: 'Matikan Kipas',
                        lockedHint: false
                    }
                }
            }
        };

        const INITIAL_QUESTIONS = @json(array_values($initialQuestions));

        let nextQuestionIdx = 0;
        let activeQuestionIdx = 0;
        let previewMode = 'key'; // 'key' | 'student'
        let selectedTestBlock = null;
        let studentTestAnswers = {
            step1: null,
            decision: null,
            branchYes: null,
            branchNo: null
        };

        const questionContainer = document.getElementById('flowQuestionItems');

        function addFlowQuestion(data = {}) {
            const index = nextQuestionIdx++;
            const template = document.getElementById('flowQuestionTemplate');
            const fragment = template.content.cloneNode(true);
            const unit = fragment.querySelector('.flow-unit');

            unit.querySelectorAll('[name]').forEach(el => {
                el.name = el.name.replace('__INDEX__', index);
            });

            const qField = unit.querySelector('[data-field="question"]');
            if (qField) qField.value = data.question || '';

            const slotKeys = ['step1', 'decision', 'branchYes', 'branchNo'];
            slotKeys.forEach(slotKey => {
                const slotData = data.slots?.[slotKey] || {};
                const expSelect = unit.querySelector(`[data-slot-expected="${slotKey}"]`);
                const subInput = unit.querySelector(`[data-slot-sub="${slotKey}"]`);
                const hintCheck = unit.querySelector(`[data-slot-hint="${slotKey}"]`);

                if (expSelect && slotData.expected) expSelect.value = slotData.expected;
                if (subInput && slotData.filledSub !== undefined) subInput.value = slotData.filledSub;
                if (hintCheck) hintCheck.checked = Boolean(slotData.lockedHint);
            });

            questionContainer.appendChild(unit);
            refreshQuestionNumbers();
            renderFlowPreview();
        }

        function refreshQuestionNumbers() {
            const units = [...questionContainer.querySelectorAll('.flow-unit')];
            units.forEach((unit, idx) => {
                unit.querySelector('.flow-unit-number').textContent = `Soal ${idx + 1}`;
                if (idx === activeQuestionIdx) {
                    unit.classList.add('border-blue-300', 'bg-blue-50/30');
                    unit.classList.remove('border-slate-200/80', 'bg-slate-50/90');
                } else {
                    unit.classList.remove('border-blue-300', 'bg-blue-50/30');
                    unit.classList.add('border-slate-200/80', 'bg-slate-50/90');
                }
            });
        }

        function getQuestionsData() {
            return [...questionContainer.querySelectorAll('.flow-unit')].map(unit => {
                const slots = {};
                ['step1', 'decision', 'branchYes', 'branchNo'].forEach(slotKey => {
                    slots[slotKey] = {
                        expected: unit.querySelector(`[data-slot-expected="${slotKey}"]`)?.value ||
                            'input',
                        filledSub: unit.querySelector(`[data-slot-sub="${slotKey}"]`)?.value || '',
                        lockedHint: Boolean(unit.querySelector(`[data-slot-hint="${slotKey}"]`)
                            ?.checked)
                    };
                });

                return {
                    question: unit.querySelector('[data-field="question"]')?.value || '',
                    slots
                };
            });
        }

        window.applyPresetToActive = function(presetKey) {
            const preset = FLOW_PRESETS[presetKey];
            const units = [...questionContainer.querySelectorAll('.flow-unit')];
            const unit = units[activeQuestionIdx];
            if (!preset || !unit) return;

            unit.querySelector('[data-field="question"]').value = preset.question;
            ['step1', 'decision', 'branchYes', 'branchNo'].forEach(slotKey => {
                const slot = preset.slots[slotKey];
                unit.querySelector(`[data-slot-expected="${slotKey}"]`).value = slot.expected;
                unit.querySelector(`[data-slot-sub="${slotKey}"]`).value = slot.filledSub;
                unit.querySelector(`[data-slot-hint="${slotKey}"]`).checked = Boolean(slot.lockedHint);
            });

            resetStudentTestSlots();
            renderFlowPreview();
        };

        window.setPreviewMode = function(mode) {
            previewMode = mode;
            const btnKey = document.getElementById('btnModeAnswerKey');
            const btnStudent = document.getElementById('btnModeStudentTest');
            const paletteBox = document.getElementById('studentTestPaletteBox');
            const hintLabel = document.getElementById('previewModeHint');

            if (mode === 'key') {
                btnKey.className =
                    'py-1.5 px-3 rounded-xl text-xs font-extrabold bg-white text-blue-600 shadow-2xs transition-all cursor-pointer';
                btnStudent.className =
                    'py-1.5 px-3 rounded-xl text-xs font-bold text-slate-600 hover:text-slate-900 transition-all cursor-pointer';
                paletteBox.classList.add('hidden');
                hintLabel.textContent = 'Menampilkan kunci jawaban lengkap';
            } else {
                btnStudent.className =
                    'py-1.5 px-3 rounded-xl text-xs font-extrabold bg-white text-blue-600 shadow-2xs transition-all cursor-pointer';
                btnKey.className =
                    'py-1.5 px-3 rounded-xl text-xs font-bold text-slate-600 hover:text-slate-900 transition-all cursor-pointer';
                paletteBox.classList.remove('hidden');
                hintLabel.textContent = 'Klik blok di bawah lalu pasang ke kotak kosong';
                resetStudentTestSlots();
            }

            renderFlowPreview();
        };

        window.resetStudentTestSlots = function() {
            selectedTestBlock = null;
            studentTestAnswers = {
                step1: null,
                decision: null,
                branchYes: null,
                branchNo: null
            };
            const fb = document.getElementById('pv-test-feedback');
            if (fb) fb.classList.add('hidden');
            renderStudentPalette();
            renderFlowPreview();
        };

        function renderStudentPalette() {
            const wrap = document.getElementById('pv-block-palette');
            if (!wrap) return;
            wrap.innerHTML = FLOW_BLOCKS.map(blk => {
                const active = selectedTestBlock === blk.type;
                return `
                    <button type="button" draggable="true"
                        ondragstart="handlePreviewDrag(event, '${blk.type}')"
                        onclick="selectPreviewPaletteBlock('${blk.type}')"
                        class="inline-flex items-center gap-1.5 px-2.5 py-1.5 rounded-full border text-[11px] font-extrabold transition-all cursor-pointer ${
                            active
                                ? 'border-blue-600 bg-blue-600 text-white'
                                : 'border-blue-200 bg-white hover:border-blue-400 text-slate-700'
                        }">
                        ${blk.svg}
                        <span>${blk.label}</span>
                    </button>
                `;
            }).join('');
        }

        window.selectPreviewPaletteBlock = function(type) {
            selectedTestBlock = selectedTestBlock === type ? null : type;
            renderStudentPalette();
            renderFlowPreview();
        };

        window.handlePreviewDrag = function(e, type) {
            selectedTestBlock = type;
            e.dataTransfer.setData('text/plain', type);
        };

        window.handlePreviewDrop = function(e, slotKey) {
            e.preventDefault();
            if (previewMode !== 'student') return;
            const type = e.dataTransfer.getData('text/plain') || selectedTestBlock;
            if (!type) return;
            studentTestAnswers[slotKey] = type;
            selectedTestBlock = null;
            renderStudentPalette();
            renderFlowPreview();
        };

        window.handlePreviewSlotClick = function(slotKey) {
            if (previewMode !== 'student') return;
            const questions = getQuestionsData();
            const q = questions[activeQuestionIdx];
            if (!q || q.slots[slotKey]?.lockedHint) return;

            if (selectedTestBlock) {
                studentTestAnswers[slotKey] = selectedTestBlock;
                selectedTestBlock = null;
                renderStudentPalette();
                renderFlowPreview();
            } else if (studentTestAnswers[slotKey]) {
                studentTestAnswers[slotKey] = null;
                renderFlowPreview();
            }
        };

        function evaluateStudentTest(q) {
            const fb = document.getElementById('pv-test-feedback');
            if (!fb) return;

            const keys = ['step1', 'decision', 'branchYes', 'branchNo'];
            const allFilled = keys.every(k => q.slots[k].lockedHint || studentTestAnswers[k] !== null);

            if (!allFilled) {
                fb.classList.add('hidden');
                return;
            }

            let correct = 0;
            keys.forEach(k => {
                const chosen = q.slots[k].lockedHint ? q.slots[k].expected : studentTestAnswers[k];
                if (chosen === q.slots[k].expected) correct++;
            });

            fb.classList.remove('hidden');
            if (correct === keys.length) {
                fb.className =
                    'text-[11px] font-extrabold px-3 py-2 rounded-xl bg-emerald-50 text-emerald-700 border border-emerald-200';
                fb.textContent = `Semua slot tepat (${correct}/${keys.length})! Kunci jawaban worksheet sudah valid.`;
            } else {
                fb.className =
                    'text-[11px] font-extrabold px-3 py-2 rounded-xl bg-amber-50 text-amber-700 border border-amber-200';
                fb.textContent = `${correct} dari ${keys.length} slot sesuai kunci jawaban. Klik slot untuk mengganti.`;
            }
        }

        function renderFlowPreview() {
            const titleVal = document.getElementById('wsTitle')?.value || 'Worksheet Flowchart';
            const levelVal = document.getElementById('wsLevel')?.value || 'SMP';
            document.getElementById('previewWsTitle').textContent = titleVal;
            document.getElementById('previewWsLevel').textContent = levelVal;

            const questions = getQuestionsData();
            if (!questions.length) return;

            activeQuestionIdx = Math.max(0, Math.min(activeQuestionIdx, questions.length - 1));
            refreshQuestionNumbers();

            const q = questions[activeQuestionIdx];
            document.getElementById('previewSoalBadge').textContent = `${activeQuestionIdx + 1}`;
            document.getElementById('previewQuestionText').textContent =
                q.question || 'Tulis pertanyaan studi kasus flowchart di sebelah kiri...';
            document.getElementById('flowSoalCounter').textContent =
                `${activeQuestionIdx + 1} / ${questions.length}`;
            document.getElementById('btnPrevFlowSoal').disabled = activeQuestionIdx === 0;
            document.getElementById('btnNextFlowSoal').disabled = activeQuestionIdx === questions.length - 1;

            // Render 3 Rect Slots (step1, branchYes, branchNo)
            ['step1', 'branchYes', 'branchNo'].forEach(slotKey => {
                const el = document.getElementById(`pv-slot-${slotKey}`);
                const slotCfg = q.slots[slotKey];
                const isHintOpen = slotCfg.lockedHint;
                const activeType = previewMode === 'key' ?
                    slotCfg.expected :
                    (isHintOpen ? slotCfg.expected : studentTestAnswers[slotKey]);

                const blk = FLOW_BLOCKS.find(b => b.type === activeType);
                const widthCls = slotKey === 'step1' ? 'w-56' : 'w-full';

                if (!blk) {
                    el.className =
                        `${widthCls} min-h-[42px] rounded-2xl border-2 border-dashed border-blue-300 bg-white/95 hover:border-blue-500 px-2.5 py-1.5 flex items-center justify-between gap-1.5 cursor-pointer transition-all shadow-2xs`;
                    el.innerHTML = `
                        <span class="text-slate-400 text-[10px] font-bold">⋮⋮</span>
                        <span class="text-[10px] font-semibold text-slate-400 truncate">
                            ${selectedTestBlock ? 'Klik pasang blok' : 'Kotak kosong siswa'}
                        </span>
                        <span class="w-2"></span>
                    `;
                } else {
                    const isCorrectTest = previewMode === 'student' && !isHintOpen && activeType === slotCfg
                        .expected;
                    const borderCls = previewMode === 'student' && !isHintOpen ?
                        (isCorrectTest ? 'border-emerald-400 bg-emerald-50/70' :
                        'border-amber-400 bg-amber-50/60') :
                        'border-blue-500 bg-white';

                    el.className =
                        `${widthCls} min-h-[42px] rounded-2xl border-2 border-solid ${borderCls} px-2.5 py-1.5 flex items-center justify-between gap-1.5 ${previewMode === 'student' && !isHintOpen ? 'cursor-pointer' : ''} transition-all shadow-2xs`;

                    el.innerHTML = `
                        <div class="flex items-center gap-1.5 min-w-0">
                            ${blk.svg}
                            <div class="min-w-0 text-left">
                                <div class="text-[11px] font-extrabold text-slate-900 leading-tight truncate">${blk.label}</div>
                                <div class="text-[9px] font-semibold text-blue-600 truncate">${slotCfg.filledSub || 'Teks isi blok'}</div>
                            </div>
                        </div>
                        ${isHintOpen
                            ? '<span class="px-1.5 py-0.5 rounded bg-blue-50 text-[8px] font-extrabold text-blue-600 shrink-0">Petunjuk</span>'
                            : (previewMode === 'student'
                                ? '<span class="text-[10px] font-bold text-slate-400 shrink-0">✕</span>'
                                : '')
                        }
                    `;
                }
            });

            // Render Decision Diamond Slot
            const decEl = document.getElementById('pv-slot-decision');
            const decInner = document.getElementById('pv-slot-decision-inner');
            const decCfg = q.slots.decision;
            const decType = previewMode === 'key' ?
                decCfg.expected :
                (decCfg.lockedHint ? decCfg.expected : studentTestAnswers.decision);
            const decBlk = FLOW_BLOCKS.find(b => b.type === decType);

            if (!decBlk) {
                decEl.className =
                    'w-20 h-20 rotate-45 rounded-xl border-2 border-dashed border-blue-400 bg-[#EBF3FF] hover:border-blue-600 shadow-2xs flex items-center justify-center cursor-pointer transition-all';
                decInner.innerHTML = '<span class="text-base font-extrabold text-blue-600">?</span>';
            } else {
                decEl.className =
                    'w-20 h-20 rotate-45 rounded-xl border-2 border-solid border-blue-600 bg-white shadow-2xs flex items-center justify-center transition-all';
                decInner.innerHTML = `
                    <div class="text-[10px] font-extrabold text-slate-900 leading-tight">${decBlk.label}</div>
                    <div class="text-[8px] font-bold text-blue-600 leading-tight mt-0.5 line-clamp-2">${decCfg.filledSub || 'Kondisi?'}</div>
                `;
            }

            if (previewMode === 'student') {
                evaluateStudentTest(q);
            }
        }

        window.closeDummySaveModal = function() {
            const modal = document.getElementById('dummySaveModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        };

        document.addEventListener('DOMContentLoaded', () => {
            if (INITIAL_QUESTIONS.length) {
                INITIAL_QUESTIONS.forEach(item => addFlowQuestion(item));
            } else {
                addFlowQuestion(FLOW_PRESETS.evenOdd);
            }

            renderStudentPalette();

            document.getElementById('btnAddFlowQuestion').addEventListener('click', () => {
                if (questionContainer.children.length >= 15) {
                    alert('Maksimal 15 soal flowchart dalam satu worksheet.');
                    return;
                }
                addFlowQuestion({
                    question: '',
                    slots: {
                        step1: {
                            expected: 'input',
                            filledSub: '',
                            lockedHint: false
                        },
                        decision: {
                            expected: 'kondisi',
                            filledSub: '',
                            lockedHint: false
                        },
                        branchYes: {
                            expected: 'output',
                            filledSub: '',
                            lockedHint: false
                        },
                        branchNo: {
                            expected: 'output',
                            filledSub: '',
                            lockedHint: false
                        }
                    }
                });
                activeQuestionIdx = questionContainer.children.length - 1;
                resetStudentTestSlots();
                renderFlowPreview();
            });

            questionContainer.addEventListener('click', e => {
                const unit = e.target.closest('.flow-unit');
                if (!unit) return;

                const units = [...questionContainer.querySelectorAll('.flow-unit')];
                const idx = units.indexOf(unit);

                if (e.target.closest('[data-remove-flow]')) {
                    if (units.length <= 1) {
                        alert('Minimal harus ada 1 soal flowchart.');
                        return;
                    }
                    unit.remove();
                    activeQuestionIdx = Math.max(0, activeQuestionIdx - 1);
                    resetStudentTestSlots();
                    renderFlowPreview();
                    return;
                }

                if (idx !== -1 && idx !== activeQuestionIdx) {
                    activeQuestionIdx = idx;
                    resetStudentTestSlots();
                    renderFlowPreview();
                }
            });

            questionContainer.addEventListener('input', renderFlowPreview);
            questionContainer.addEventListener('change', renderFlowPreview);

            ['wsTitle', 'wsLevel'].forEach(id => {
                document.getElementById(id).addEventListener('input', renderFlowPreview);
                document.getElementById(id).addEventListener('change', renderFlowPreview);
            });

            document.getElementById('btnPrevFlowSoal').addEventListener('click', () => {
                if (activeQuestionIdx > 0) {
                    activeQuestionIdx--;
                    resetStudentTestSlots();
                    renderFlowPreview();
                }
            });

            document.getElementById('btnNextFlowSoal').addEventListener('click', () => {
                if (activeQuestionIdx < questionContainer.children.length - 1) {
                    activeQuestionIdx++;
                    resetStudentTestSlots();
                    renderFlowPreview();
                }
            });

            // Penanganan Simpan Dummy
            const form = document.getElementById('flowchartWorksheetForm');
            form.addEventListener('submit', e => {
                if (!form.reportValidity()) {
                    e.preventDefault();
                    return;
                }

                if (form.dataset.dummyMode === 'true') {
                    e.preventDefault();
                    const title = document.getElementById('wsTitle').value;
                    const level = document.getElementById('wsLevel').value;
                    const statusText = document.getElementById('wsStatus').selectedOptions[0]?.text ||
                        'Draft';
                    const questions = getQuestionsData();

                    document.getElementById('dummyModalTitle').textContent = title;
                    document.getElementById('dummyModalDesc').textContent =
                        'Worksheet flowchart dummy berhasil dirangkum dan siap diterbitkan ke siswa.';
                    document.getElementById('dummyModalSummary').innerHTML = `
                        <div>• Jenjang Sasaran: <span class="text-blue-600">${level}</span></div>
                        <div>• Jumlah Soal Flowchart: <span class="text-blue-600">${questions.length} Soal</span></div>
                        <div>• Status Publikasi: <span class="text-emerald-600">${statusText}</span></div>
                    `;

                    const modal = document.getElementById('dummySaveModal');
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                }
            });
        });
    </script>
@endpush
