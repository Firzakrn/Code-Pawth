@extends('layouts.app')

@section('title', 'Rekap Nilai Siswa — CodePawth')

@section('content')

@php
    // Fallback data contoh agar tampilan langsung jalan sebelum backend dihubungkan
    $classList = $classes ?? collect([
        (object) ['id' => 1, 'name' => 'Coding 7A', 'level' => 'SMP'],
        (object) ['id' => 2, 'name' => 'Algoritma Dasar 8B', 'level' => 'SMP'],
        (object) ['id' => 3, 'name' => 'Logika Pemrograman 5A', 'level' => 'SD'],
    ]);

    $gradeRecords = $records ?? collect([
        (object) [
            'id' => 101,
            'student_name' => 'Alya Putri Ramadhani',
            'student_code' => 'CP-2026-001',
            'class_id' => 1,
            'class_name' => 'Coding 7A',
            'level' => 'SMP',
            'evaluation_type' => 'Coding Blocks',
            'evaluation_title' => 'Logika Percabangan If-Else',
            'score' => 92,
            'completed_levels' => '5 / 5 Level',
            'submitted_at' => '25 Nov 2026, 09:40',
            'breakdown' => [
                ['label' => 'Flashcard Sintaks Dasar', 'score' => 95],
                ['label' => 'Flowchart Ganjil Genap', 'score' => 90],
                ['label' => 'Tantangan Coding Blocks', 'score' => 91],
            ],
        ],
        (object) [
            'id' => 102,
            'student_name' => 'Bima Sakti Nugroho',
            'student_code' => 'CP-2026-002',
            'class_id' => 1,
            'class_name' => 'Coding 7A',
            'level' => 'SMP',
            'evaluation_type' => 'Flowchart + Preview Kode',
            'evaluation_title' => 'Diagram Alur Bilangan Ganjil Genap',
            'score' => 84,
            'completed_levels' => '4 / 5 Level',
            'submitted_at' => '25 Nov 2026, 10:12',
            'breakdown' => [
                ['label' => 'Flashcard Sintaks Dasar', 'score' => 88],
                ['label' => 'Flowchart Ganjil Genap', 'score' => 80],
                ['label' => 'Tantangan Coding Blocks', 'score' => 84],
            ],
        ],
        (object) [
            'id' => 103,
            'student_name' => 'Citra Dewi Lestari',
            'student_code' => 'CP-2026-003',
            'class_id' => 2,
            'class_name' => 'Algoritma Dasar 8B',
            'level' => 'SMP',
            'evaluation_type' => 'Pilih Kode yang Benar',
            'evaluation_title' => 'Output & Variabel Python',
            'score' => 68,
            'completed_levels' => '3 / 5 Level',
            'submitted_at' => '24 Nov 2026, 14:25',
            'breakdown' => [
                ['label' => 'Mencocokkan Simbol', 'score' => 75],
                ['label' => 'Pilih Kode Python', 'score' => 60],
                ['label' => 'Latihan Variabel', 'score' => 69],
            ],
        ],
        (object) [
            'id' => 104,
            'student_name' => 'Dimas Pratama Putra',
            'student_code' => 'CP-2026-004',
            'class_id' => 3,
            'class_name' => 'Logika Pemrograman 5A',
            'level' => 'SD',
            'evaluation_type' => 'Mencocokkan Pasangan',
            'evaluation_title' => 'Mengenal Simbol Flowchart',
            'score' => 96,
            'completed_levels' => '5 / 5 Level',
            'submitted_at' => '25 Nov 2026, 08:15',
            'breakdown' => [
                ['label' => 'Flashcard Urutan Langkah', 'score' => 100],
                ['label' => 'Mencocokkan Simbol', 'score' => 92],
            ],
        ],
        (object) [
            'id' => 105,
            'student_name' => 'Eka Wulandari',
            'student_code' => 'CP-2026-005',
            'class_id' => 2,
            'class_name' => 'Algoritma Dasar 8B',
            'level' => 'SMP',
            'evaluation_type' => 'Coding Blocks',
            'evaluation_title' => 'Perulangan Sederhana',
            'score' => 78,
            'completed_levels' => '4 / 5 Level',
            'submitted_at' => '24 Nov 2026, 16:05',
            'breakdown' => [
                ['label' => 'Mencocokkan Simbol', 'score' => 82],
                ['label' => 'Pilih Kode Python', 'score' => 74],
                ['label' => 'Coding Blocks Loop', 'score' => 78],
            ],
        ],
    ]);

    $totalStudents = $gradeRecords->count();
    $averageScore = $totalStudents > 0 ? round($gradeRecords->avg('score'), 1) : 0;
    $passedCount = $gradeRecords->where('score', '>=', 75)->count();
    $needsGuidanceCount = $gradeRecords->where('score', '<', 75)->count();
@endphp

<div class="relative w-full min-h-full overflow-x-hidden">

    <!-- =====================================================================
         DEKORASI BACKGROUND (BLOB, AWAN, PAW KUCING BESAR, & BINTANG)
    ====================================================================== -->
    <div class="pointer-events-none select-none absolute inset-0 overflow-hidden z-0">
        <div class="absolute -top-24 -left-24 w-96 h-96 rounded-full bg-blue-200/45 blur-3xl"></div>
        <div class="absolute top-16 right-1/4 w-[28rem] h-[28rem] rounded-full bg-white/65 blur-2xl"></div>
        <div class="absolute top-1/3 -right-24 w-96 h-96 rounded-full bg-indigo-200/40 blur-3xl"></div>
        <div class="absolute -bottom-24 left-1/3 w-[32rem] h-[32rem] rounded-full bg-sky-200/45 blur-3xl"></div>

        <!-- Awan Besar Atas Kanan -->
        <svg class="absolute -top-6 right-8 w-[440px] h-44 text-white/65" viewBox="0 0 440 160" fill="currentColor">
            <circle cx="90" cy="115" r="55" />
            <circle cx="165" cy="95" r="70" />
            <circle cx="255" cy="100" r="65" />
            <circle cx="335" cy="115" r="50" />
            <rect x="40" y="110" width="340" height="50" rx="25" />
        </svg>

        <!-- Paw Kucing Besar di Background -->
        <svg class="absolute top-36 left-[46%] w-32 h-32 text-blue-300/30 -rotate-12" viewBox="0 0 64 64" fill="currentColor">
            <ellipse cx="16" cy="22" rx="5.5" ry="7.5" transform="rotate(-18 16 22)" />
            <ellipse cx="27" cy="15" rx="5.5" ry="8" transform="rotate(-6 27 15)" />
            <ellipse cx="39" cy="15" rx="5.5" ry="8" transform="rotate(8 39 15)" />
            <ellipse cx="49" cy="23" rx="5.5" ry="7.5" transform="rotate(20 49 23)" />
            <path d="M32 27c-9.5 0-16 6.8-16 14.2 0 5.2 4.2 8.8 9.2 8.8 2.6 0 4.6-1 6.8-1s4.2 1 6.8 1c5 0 9.2-3.6 9.2-8.8C48 33.8 41.5 27 32 27z" />
        </svg>
        <svg class="hidden md:block absolute bottom-16 right-8 w-36 h-36 text-blue-300/25 rotate-12" viewBox="0 0 64 64" fill="currentColor">
            <ellipse cx="16" cy="22" rx="5.5" ry="7.5" transform="rotate(-18 16 22)" />
            <ellipse cx="27" cy="15" rx="5.5" ry="8" transform="rotate(-6 27 15)" />
            <ellipse cx="39" cy="15" rx="5.5" ry="8" transform="rotate(8 39 15)" />
            <ellipse cx="49" cy="23" rx="5.5" ry="7.5" transform="rotate(20 49 23)" />
            <path d="M32 27c-9.5 0-16 6.8-16 14.2 0 5.2 4.2 8.8 9.2 8.8 2.6 0 4.6-1 6.8-1s4.2 1 6.8 1c5 0 9.2-3.6 9.2-8.8C48 33.8 41.5 27 32 27z" />
        </svg>

        <!-- Bintang-Bintang -->
        <svg class="absolute top-14 left-[42%] w-7 h-7 text-blue-400/55" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 1l2.6 7.4L22 11l-7.4 2.6L12 21l-2.6-7.4L2 11l7.4-2.6L12 1z" />
        </svg>
        <svg class="absolute top-24 right-[26%] w-5 h-5 text-sky-400/60" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 1l2.6 7.4L22 11l-7.4 2.6L12 21l-2.6-7.4L2 11l7.4-2.6L12 1z" />
        </svg>
        <svg class="absolute bottom-28 left-8 w-8 h-8 text-blue-400/45" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 1l2.6 7.4L22 11l-7.4 2.6L12 21l-2.6-7.4L2 11l7.4-2.6L12 1z" />
        </svg>
    </div>

    <!-- =====================================================================
         KONTEN UTAMA REKAP NILAI
    ====================================================================== -->
    <div class="relative z-10 w-full max-w-7xl mx-auto px-5 sm:px-8 py-6 space-y-6">

        {{-- BREADCRUMB --}}
        <nav class="flex items-center gap-2 text-xs font-bold text-slate-400">
            <a href="{{ route('guru.dashboard') }}" class="text-blue-600 hover:text-blue-700 transition-colors">
                Dashboard Guru
            </a>
            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
            </svg>
            <span class="text-slate-700">Rekap Nilai</span>
        </nav>

        {{-- HERO SECTION --}}
        <section class="relative overflow-hidden rounded-3xl bg-white/95 backdrop-blur-sm border border-white shadow-soft-card p-6 sm:p-8 flex flex-col md:flex-row items-center justify-between gap-6">
            <!-- Dekorasi Awan & Paw Dalam Hero -->
            <svg class="pointer-events-none select-none absolute -bottom-8 right-10 w-96 h-36 text-blue-50/90" viewBox="0 0 380 140" fill="currentColor">
                <circle cx="70" cy="95" r="48" />
                <circle cx="145" cy="75" r="60" />
                <circle cx="225" cy="85" r="55" />
                <circle cx="300" cy="100" r="45" />
                <rect x="30" y="90" width="310" height="50" />
            </svg>
            <svg class="pointer-events-none select-none absolute top-4 right-64 w-24 h-24 text-blue-100/75 -rotate-12" viewBox="0 0 64 64" fill="currentColor">
                <ellipse cx="16" cy="22" rx="5.5" ry="7.5" transform="rotate(-18 16 22)" />
                <ellipse cx="27" cy="15" rx="5.5" ry="8" transform="rotate(-6 27 15)" />
                <ellipse cx="39" cy="15" rx="5.5" ry="8" transform="rotate(8 39 15)" />
                <ellipse cx="49" cy="23" rx="5.5" ry="7.5" transform="rotate(20 49 23)" />
                <path d="M32 27c-9.5 0-16 6.8-16 14.2 0 5.2 4.2 8.8 9.2 8.8 2.6 0 4.6-1 6.8-1s4.2 1 6.8 1c5 0 9.2-3.6 9.2-8.8C48 33.8 41.5 27 32 27z" />
            </svg>

            <div class="relative z-10 max-w-2xl space-y-3">
                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-50 border border-blue-100 text-[11px] font-extrabold uppercase tracking-wider text-blue-600">
                    <svg class="w-3.5 h-3.5 text-blue-600" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M2.25 13.5a8.25 8.25 0 018.25-8.25.75.75 0 01.75.75v6.75H18a.75.75 0 01.75.75 8.25 8.25 0 01-16.5 0z" clip-rule="evenodd" />
                        <path fill-rule="evenodd" d="M12.75 3a.75.75 0 01.75-.75 8.25 8.25 0 018.25 8.25.75.75 0 01-.75.75h-7.5a.75.75 0 01-.75-.75V3z" clip-rule="evenodd" />
                    </svg>
                    <span>FITUR EKSKLUSIF GURU</span>
                </div>

                <h1 class="text-2xl sm:text-4xl font-extrabold tracking-tight text-slate-900">
                    Rekap Nilai <span class="text-blue-600">Siswa</span>
                </h1>

                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed max-w-xl">
                    Pantau perkembangan belajar, skor evaluasi interaktif, dan tingkat ketuntasan setiap siswa di kelasmu secara menyeluruh.
                </p>

                <div class="flex flex-wrap items-center gap-3 pt-2">
                    <button type="button" id="exportGradesCsv"
                        class="inline-flex items-center gap-2 rounded-full bg-blue-600 hover:bg-blue-700 text-white text-xs sm:text-sm font-bold px-5 py-2.5 shadow-soft-blue transition-all cursor-pointer">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2.3" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                        </svg>
                        <span>Unduh Rekap (CSV)</span>
                    </button>

                    <a href="{{ route('guru.studio') }}"
                        class="inline-flex items-center gap-2 rounded-full bg-slate-50 hover:bg-blue-50 text-slate-700 hover:text-blue-700 border border-slate-200 hover:border-blue-200 text-xs sm:text-sm font-bold px-5 py-2.5 transition-all">
                        <svg class="w-4 h-4 text-blue-600 shrink-0" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd" d="M20.599 1.5c-.376 0-.743.111-1.055.32l-5.08 3.385a18.747 18.747 0 00-3.471 2.987 10.04 10.04 0 014.815 4.815 18.748 18.748 0 002.987-3.472l3.386-5.079A1.902 1.902 0 0020.599 1.5z" clip-rule="evenodd" />
                        </svg>
                        <span>Buat Evaluasi Baru</span>
                    </a>
                </div>
            </div>

            <div class="relative z-10 shrink-0">
                <img
                    src="{{ asset('images/mascot_happy.png') }}"
                    alt="Maskot CodePawth membawa piala"
                    class="w-36 h-36 sm:w-44 sm:h-44 object-contain drop-shadow-sm"
                >
            </div>
        </section>

        {{-- =====================================================================
             4 KARTU RINGKASAN STATISTIK
        ====================================================================== --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Total Siswa Dinilai -->
            <div class="bg-white/95 backdrop-blur-sm rounded-3xl border border-white shadow-soft-card p-5 flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-blue-50 border border-blue-100 flex items-center justify-center text-blue-600 shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-bold text-slate-500">Siswa Dinilai</p>
                    <p class="text-2xl font-extrabold text-slate-900 mt-0.5">{{ $totalStudents }}</p>
                </div>
            </div>

            <!-- Rata-rata Skor -->
            <div class="bg-white/95 backdrop-blur-sm rounded-3xl border border-white shadow-soft-card p-5 flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-600 shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-bold text-slate-500">Rata-Rata Nilai</p>
                    <p class="text-2xl font-extrabold text-slate-900 mt-0.5">{{ $averageScore }}</p>
                </div>
            </div>

            <!-- Siswa Tuntas -->
            <div class="bg-white/95 backdrop-blur-sm rounded-3xl border border-white shadow-soft-card p-5 flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-600 shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.4" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-bold text-slate-500">Tuntas (≥ 75)</p>
                    <p class="text-2xl font-extrabold text-emerald-600 mt-0.5">{{ $passedCount }} Siswa</p>
                </div>
            </div>

            <!-- Perlu Bimbingan -->
            <div class="bg-white/95 backdrop-blur-sm rounded-3xl border border-white shadow-soft-card p-5 flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-amber-50 border border-amber-100 flex items-center justify-center text-amber-600 shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-bold text-slate-500">Perlu Bimbingan</p>
                    <p class="text-2xl font-extrabold text-amber-600 mt-0.5">{{ $needsGuidanceCount }} Siswa</p>
                </div>
            </div>
        </div>

        {{-- =====================================================================
             TOOLBAR FILTER REKAP NILAI
        ====================================================================== --}}
        <div class="bg-white/95 backdrop-blur-sm rounded-3xl border border-white shadow-soft-card p-4 flex flex-col lg:flex-row lg:items-center justify-between gap-3">
            <div class="flex flex-wrap items-center gap-2.5">
                <!-- Filter Kelas -->
                <div class="relative">
                    <select id="gradeClassFilter"
                        aria-label="Filter kelas"
                        class="appearance-none rounded-full bg-slate-50 border border-slate-200 px-4 py-2 pr-9 text-xs font-bold text-slate-700 focus:bg-white focus:border-blue-500 outline-none cursor-pointer">
                        <option value="semua">Semua Kelas</option>
                        @foreach ($classList as $cls)
                            <option value="{{ $cls->id }}" @selected(request('class_id') == $cls->id)>
                                {{ $cls->name }} ({{ $cls->level }})
                            </option>
                        @endforeach
                    </select>
                    <svg class="w-3.5 h-3.5 text-slate-500 pointer-events-none absolute right-3.5 top-1/2 -translate-y-1/2"
                        fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>

                <!-- Filter Jenis Evaluasi -->
                <div class="relative">
                    <select id="gradeTypeFilter"
                        aria-label="Filter jenis evaluasi"
                        class="appearance-none rounded-full bg-slate-50 border border-slate-200 px-4 py-2 pr-9 text-xs font-bold text-slate-700 focus:bg-white focus:border-blue-500 outline-none cursor-pointer">
                        <option value="semua">Semua Jenis Evaluasi</option>
                        <option value="Mencocokkan Pasangan">Mencocokkan Pasangan</option>
                        <option value="Pilih Kode yang Benar">Pilih Kode yang Benar</option>
                        <option value="Flowchart + Preview Kode">Flowchart + Preview Kode</option>
                        <option value="Coding Blocks">Coding Blocks</option>
                    </select>
                    <svg class="w-3.5 h-3.5 text-slate-500 pointer-events-none absolute right-3.5 top-1/2 -translate-y-1/2"
                        fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>

                <!-- Filter Status -->
                <div class="relative">
                    <select id="gradeStatusFilter"
                        aria-label="Filter status ketuntasan"
                        class="appearance-none rounded-full bg-slate-50 border border-slate-200 px-4 py-2 pr-9 text-xs font-bold text-slate-700 focus:bg-white focus:border-blue-500 outline-none cursor-pointer">
                        <option value="semua">Semua Status</option>
                        <option value="tuntas">Tuntas (≥ 75)</option>
                        <option value="bimbingan">Perlu Bimbingan (&lt; 75)</option>
                    </select>
                    <svg class="w-3.5 h-3.5 text-slate-500 pointer-events-none absolute right-3.5 top-1/2 -translate-y-1/2"
                        fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </div>

            <!-- Pencarian Nama Siswa -->
            <div class="relative">
                <svg class="w-4 h-4 text-slate-400 pointer-events-none absolute left-3.5 top-1/2 -translate-y-1/2"
                    fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
                <input
                    type="search"
                    id="gradeSearchInput"
                    placeholder="Cari nama atau kode siswa..."
                    aria-label="Cari siswa"
                    class="w-full lg:w-64 rounded-full bg-slate-50 border border-slate-200 pl-9 pr-4 py-2 text-xs font-semibold text-slate-800 placeholder:text-slate-400 focus:bg-white focus:border-blue-500 outline-none"
                >
            </div>
        </div>

        {{-- =====================================================================
             TABEL REKAP NILAI SISWA
        ====================================================================== --}}
        <section class="bg-white/95 backdrop-blur-sm rounded-3xl border border-white shadow-soft-card p-6 sm:p-7 relative overflow-hidden">
            <!-- Dekorasi Paw Besar di Sudut -->
            <svg class="hidden sm:block pointer-events-none select-none absolute -bottom-4 right-8 w-28 h-28 text-blue-100/75 rotate-12" viewBox="0 0 64 64" fill="currentColor">
                <ellipse cx="16" cy="22" rx="5.5" ry="7.5" transform="rotate(-18 16 22)" />
                <ellipse cx="27" cy="15" rx="5.5" ry="8" transform="rotate(-6 27 15)" />
                <ellipse cx="39" cy="15" rx="5.5" ry="8" transform="rotate(8 39 15)" />
                <ellipse cx="49" cy="23" rx="5.5" ry="7.5" transform="rotate(20 49 23)" />
                <path d="M32 27c-9.5 0-16 6.8-16 14.2 0 5.2 4.2 8.8 9.2 8.8 2.6 0 4.6-1 6.8-1s4.2 1 6.8 1c5 0 9.2-3.6 9.2-8.8C48 33.8 41.5 27 32 27z" />
            </svg>

            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-5 relative z-10">
                <div class="flex items-center gap-3.5">
                    <img
                        src="{{ asset('images/mascot_kelas.png') }}"
                        alt="Maskot Daftar Nilai"
                        class="w-12 h-12 object-contain shrink-0 drop-shadow-2xs">

                    <div>
                        <h2 class="text-lg sm:text-xl font-extrabold text-blue-900">
                            Daftar Capaian & Nilai Siswa
                        </h2>
                        <p class="text-xs sm:text-sm text-slate-500">
                            Klik tombol detail pada baris siswa untuk melihat rincian skor tiap aktivitas.
                        </p>
                    </div>
                </div>

                <span id="gradeVisibleBadge"
                    class="self-start sm:self-center px-3.5 py-1.5 rounded-full bg-blue-50 border border-blue-100 text-xs font-extrabold text-blue-700">
                    Menampilkan {{ $totalStudents }} data
                </span>
            </div>

            <div class="relative z-10 overflow-x-auto rounded-2xl border border-slate-200/80">
                <table id="gradesTable" class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-blue-50/80 border-b border-slate-200/80 text-[11px] font-extrabold uppercase tracking-wider text-slate-600">
                            <th class="py-3.5 px-4">Siswa</th>
                            <th class="py-3.5 px-4">Kelas</th>
                            <th class="py-3.5 px-4">Evaluasi</th>
                            <th class="py-3.5 px-4">Progres</th>
                            <th class="py-3.5 px-4">Skor</th>
                            <th class="py-3.5 px-4">Status</th>
                            <th class="py-3.5 px-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-xs sm:text-sm">
                        @forelse ($gradeRecords as $row)
                            @php
                                $isPassed = $row->score >= 75;
                            @endphp
                            <tr class="grade-row bg-white hover:bg-blue-50/40 transition-colors"
                                data-class-id="{{ $row->class_id }}"
                                data-type="{{ $row->evaluation_type }}"
                                data-status="{{ $isPassed ? 'tuntas' : 'bimbingan' }}"
                                data-search="{{ strtolower($row->student_name . ' ' . $row->student_code . ' ' . $row->class_name . ' ' . $row->evaluation_title) }}"
                                data-student-name="{{ $row->student_name }}"
                                data-student-code="{{ $row->student_code }}"
                                data-class-label="{{ $row->class_name }} ({{ $row->level }})"
                                data-eval-title="{{ $row->evaluation_title }}"
                                data-eval-type="{{ $row->evaluation_type }}"
                                data-score="{{ $row->score }}"
                                data-submitted="{{ $row->submitted_at }}"
                                data-breakdown='@json($row->breakdown ?? [])'>

                                <td class="py-3.5 px-4">
                                    <div class="font-extrabold text-slate-900">{{ $row->student_name }}</div>
                                    <div class="text-[11px] font-semibold text-slate-400">{{ $row->student_code }}</div>
                                </td>

                                <td class="py-3.5 px-4">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-slate-100 text-slate-700 text-xs font-bold">
                                        {{ $row->class_name }}
                                        <span class="text-[10px] font-extrabold text-blue-600">• {{ $row->level }}</span>
                                    </span>
                                </td>

                                <td class="py-3.5 px-4">
                                    <div class="font-bold text-slate-800">{{ $row->evaluation_title }}</div>
                                    <div class="text-[11px] font-semibold text-blue-600">{{ $row->evaluation_type }}</div>
                                </td>

                                <td class="py-3.5 px-4 font-bold text-slate-600 whitespace-nowrap">
                                    {{ $row->completed_levels }}
                                </td>

                                <td class="py-3.5 px-4 whitespace-nowrap">
                                    <span class="inline-flex items-center justify-center min-w-[3rem] px-3 py-1 rounded-full text-xs font-extrabold {{ $isPassed ? 'bg-blue-50 text-blue-700 border border-blue-200' : 'bg-amber-50 text-amber-700 border border-amber-200' }}">
                                        {{ $row->score }}
                                    </span>
                                </td>

                                <td class="py-3.5 px-4 whitespace-nowrap">
                                    @if ($isPassed)
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 border border-emerald-200 text-emerald-700 text-[11px] font-extrabold">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            Tuntas
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-50 border border-amber-200 text-amber-700 text-[11px] font-extrabold">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                            Perlu Bimbingan
                                        </span>
                                    @endif
                                </td>

                                <td class="py-3.5 px-4 text-right whitespace-nowrap">
                                    <button type="button"
                                        class="open-grade-detail inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-blue-50 hover:bg-blue-600 text-blue-700 hover:text-white border border-blue-100 hover:border-blue-600 text-xs font-extrabold transition-all cursor-pointer">
                                        <span>Detail</span>
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-12 px-4 text-center">
                                    <img src="{{ asset('images/mascot_what.png') }}" alt="Belum Ada Nilai"
                                        class="w-24 h-24 object-contain mx-auto mb-3">
                                    <h3 class="text-base font-extrabold text-slate-900">Belum Ada Data Nilai</h3>
                                    <p class="text-xs text-slate-500 mt-1">
                                        Nilai akan muncul otomatis setelah siswa menyelesaikan evaluasi di kelasmu.
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Empty State Saat Filter Tidak Menemukan Data -->
            <div id="gradeFilterEmpty" hidden class="py-10 px-4 text-center relative z-10">
                <img src="{{ asset('images/mascot_what.png') }}" alt="Data Tidak Ditemukan"
                    class="w-24 h-24 object-contain mx-auto mb-3">
                <h3 class="text-base font-extrabold text-slate-900">Data siswa tidak ditemukan</h3>
                <p class="text-xs text-slate-500 mt-1">
                    Coba ubah filter kelas, status, atau kata kunci pencarian.
                </p>
            </div>
        </section>

    </div>
</div>

{{-- =====================================================================
     MODAL DETAIL NILAI SISWA
====================================================================== --}}
<dialog id="gradeDetailModal" class="grade-modal">
    <div class="grade-modal-header">
        <img src="{{ asset('images/mascot_cheers.png') }}" alt="Maskot Detail Nilai">
        <div>
            <span class="text-[11px] font-extrabold uppercase tracking-wider text-blue-600">
                RINCIAN CAPAIAN SISWA
            </span>
            <h2 id="modalStudentName" class="text-lg sm:text-xl font-extrabold text-slate-900 mt-0.5"></h2>
            <p id="modalStudentMeta" class="text-xs font-semibold text-slate-500 mt-0.5"></p>
        </div>

        <button type="button" id="closeGradeModal" aria-label="Tutup"
            class="absolute top-4 right-4 w-8 h-8 rounded-full bg-white border border-slate-200 text-slate-500 hover:bg-blue-600 hover:text-white flex items-center justify-center transition-colors cursor-pointer">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <div class="p-6 space-y-4">
        <div class="rounded-2xl bg-blue-50/80 border border-blue-100 p-4 flex items-center justify-between gap-4">
            <div>
                <p class="text-[11px] font-extrabold uppercase tracking-wider text-blue-600" id="modalEvalType"></p>
                <p class="text-sm font-extrabold text-slate-900 mt-0.5" id="modalEvalTitle"></p>
                <p class="text-[11px] font-medium text-slate-500 mt-1" id="modalSubmittedAt"></p>
            </div>
            <div class="text-right shrink-0">
                <span class="block text-[10px] font-extrabold uppercase text-slate-400">Skor Akhir</span>
                <span id="modalFinalScore" class="text-2xl font-extrabold text-blue-600"></span>
            </div>
        </div>

        <div>
            <h3 class="text-xs font-extrabold uppercase tracking-wider text-slate-500 mb-2.5">
                Rincian Skor Aktivitas
            </h3>
            <div id="modalBreakdownList" class="space-y-2"></div>
        </div>
    </div>

    <div class="px-6 pb-5 flex justify-end">
        <button type="button" id="closeGradeModalFooter"
            class="rounded-full bg-blue-600 hover:bg-blue-700 text-white text-xs font-extrabold px-5 py-2.5 shadow-soft-blue transition-all cursor-pointer">
            Tutup Rincian
        </button>
    </div>
</dialog>

@endsection

@push('styles')
<style>
    .grade-modal {
        width: min(520px, calc(100% - 30px));
        padding: 0;
        border: 1px solid #DBEAFE;
        border-radius: 24px;
        background: #FFFFFF;
        color: #0F172A;
        font-family: 'Plus Jakarta Sans', sans-serif;
        box-shadow: 0 25px 70px rgba(30, 64, 175, 0.18);
        overflow-y: auto;
    }

    .grade-modal::backdrop {
        background: rgba(15, 23, 42, 0.5);
        backdrop-filter: blur(4px);
    }

    .grade-modal-header {
        position: relative;
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 20px 24px;
        background: linear-gradient(135deg, #EFF6FF 0%, #E0E7FF 100%);
    }

    .grade-modal-header img {
        width: 78px;
        height: 78px;
        object-fit: contain;
        flex-shrink: 0;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const classFilter = document.getElementById('gradeClassFilter');
    const typeFilter = document.getElementById('gradeTypeFilter');
    const statusFilter = document.getElementById('gradeStatusFilter');
    const searchInput = document.getElementById('gradeSearchInput');
    const rows = Array.from(document.querySelectorAll('.grade-row'));
    const emptyBanner = document.getElementById('gradeFilterEmpty');
    const visibleBadge = document.getElementById('gradeVisibleBadge');

    function filterGrades() {
        const selectedClass = classFilter.value;
        const selectedType = typeFilter.value;
        const selectedStatus = statusFilter.value;
        const keyword = searchInput.value.trim().toLowerCase();

        let visibleCount = 0;

        rows.forEach(row => {
            const matchClass = selectedClass === 'semua' || row.dataset.classId === selectedClass;
            const matchType = selectedType === 'semua' || row.dataset.type === selectedType;
            const matchStatus = selectedStatus === 'semua' || row.dataset.status === selectedStatus;
            const matchKeyword = row.dataset.search.includes(keyword);

            const isVisible = matchClass && matchType && matchStatus && matchKeyword;
            row.hidden = !isVisible;

            if (isVisible) visibleCount++;
        });

        if (visibleBadge) {
            visibleBadge.textContent = `Menampilkan ${visibleCount} data`;
        }

        if (emptyBanner) {
            emptyBanner.hidden = rows.length === 0 || visibleCount > 0;
        }
    }

    classFilter?.addEventListener('change', filterGrades);
    typeFilter?.addEventListener('change', filterGrades);
    statusFilter?.addEventListener('change', filterGrades);
    searchInput?.addEventListener('input', filterGrades);

    // Modal Detail
    const modal = document.getElementById('gradeDetailModal');
    const breakdownList = document.getElementById('modalBreakdownList');

    document.querySelectorAll('.open-grade-detail').forEach(btn => {
        btn.addEventListener('click', function () {
            const row = this.closest('.grade-row');
            if (!row || !modal) return;

            document.getElementById('modalStudentName').textContent = row.dataset.studentName;
            document.getElementById('modalStudentMeta').textContent = `${row.dataset.studentCode} • ${row.dataset.classLabel}`;
            document.getElementById('modalEvalType').textContent = row.dataset.evalType;
            document.getElementById('modalEvalTitle').textContent = row.dataset.evalTitle;
            document.getElementById('modalSubmittedAt').textContent = `Dikerjakan: ${row.dataset.submitted}`;
            document.getElementById('modalFinalScore').textContent = row.dataset.score;

            breakdownList.replaceChildren();
            const items = JSON.parse(row.dataset.breakdown || '[]');

            items.forEach(item => {
                const div = document.createElement('div');
                div.className = 'flex items-center justify-between rounded-xl bg-slate-50 border border-slate-200/80 px-4 py-2.5 text-xs';

                const label = document.createElement('span');
                label.className = 'font-bold text-slate-700';
                label.textContent = item.label;

                const score = document.createElement('span');
                score.className = 'font-extrabold text-blue-600';
                score.textContent = item.score;

                div.appendChild(label);
                div.appendChild(score);
                breakdownList.appendChild(div);
            });

            modal.showModal();
        });
    });

    document.getElementById('closeGradeModal')?.addEventListener('click', () => modal.close());
    document.getElementById('closeGradeModalFooter')?.addEventListener('click', () => modal.close());
    modal?.addEventListener('click', (e) => {
        if (e.target === modal) modal.close();
    });

    // Ekspor CSV dari baris yang tampil
    document.getElementById('exportGradesCsv')?.addEventListener('click', function () {
        const csvRows = [
            ['Nama Siswa', 'Kode Siswa', 'Kelas', 'Evaluasi', 'Jenis', 'Skor', 'Status']
        ];

        rows.filter(r => !r.hidden).forEach(r => {
            csvRows.push([
                `"${r.dataset.studentName}"`,
                `"${r.dataset.studentCode}"`,
                `"${r.dataset.classLabel}"`,
                `"${r.dataset.evalTitle}"`,
                `"${r.dataset.evalType}"`,
                r.dataset.score,
                r.dataset.status === 'tuntas' ? 'Tuntas' : 'Perlu Bimbingan'
            ]);
        });

        const csvContent = 'data:text/csv;charset=utf-8,' + csvRows.map(e => e.join(',')).join('\n');
        const link = document.createElement('a');
        link.setAttribute('href', encodeURI(csvContent));
        link.setAttribute('download', 'rekap-nilai-codepawth.csv');
        document.body.appendChild(link);
        link.click();
        link.remove();
    });

    filterGrades();
});
</script>
@endpush