@extends('layouts.app')

@section('title', 'Studio Konten Guru')

@php
    /*
    |--------------------------------------------------------------------------
    | DAFTAR TEMPLATE CODEPAWTH
    |--------------------------------------------------------------------------
    */
    $templates = [
        [
            'id' => 'flashcard',
            'type' => 'materi',
            'title' => 'Flashcard Interaktif',
            'description' => 'Kartu dua sisi untuk mengenalkan konsep, sintaks, dan istilah pemrograman.',
            'mascot' => 'mascot_card.png',
            'levels' => ['SD', 'SMP', 'SMA'],
            'example' => 'Sisi depan: print(). Sisi belakang: Perintah untuk menampilkan teks.',
            'fields' => [
                'Judul dan jenjang materi',
                'Kategori dan ikon kartu',
                'Teks sisi depan',
                'Penjelasan sisi belakang',
                'Tambah atau hapus kartu',
            ],
        ],
        [
            'id' => 'artikel',
            'type' => 'materi',
            'title' => 'Penjelasan Dengan Gambar',
            'description' => 'Materi berbentuk bacaan dengan subjudul, gambar, dan penjelasan.',
            'mascot' => 'mascot_dashboard.png',
            'levels' => ['SD', 'SMP', 'SMA'],
            'example' => 'Materi algoritma dengan penjelasan bertahap dan ilustrasi flowchart.',
            'fields' => [
                'Judul dan jenjang materi',
                'Subjudul setiap bagian',
                'Paragraf penjelasan',
                'Unggah gambar pendukung',
                'Caption gambar',
                'Tambah atau hapus bagian',
            ],
        ],
        [
            'id' => 'foto',
            'type' => 'materi',
            'title' => 'Praktik Coding Python',
            'description' => 'Unggah gambar, poster, atau screenshot, kemudian berikan penjelasan.',
            'mascot' => 'mascot_what.png',
            'levels' => ['SD', 'SMP', 'SMA'],
            'example' => 'Gambar simbol decision beserta fungsi dan contohnya.',
            'fields' => [
                'Judul dan jenjang materi',
                'Unggah foto atau ilustrasi',
                'Penjelasan gambar',
                'Caption foto',
                'Tambah atau hapus gambar',
            ],
        ],
        [
            'id' => 'matching',
            'type' => 'evaluasi',
            'title' => 'Mencocokkan Pasangan',
            'description' => 'Siswa memasangkan istilah, kode, simbol, atau gambar dengan jawaban.',
            'mascot' => 'mascot_loveya.png',
            'levels' => ['SD', 'SMP', 'SMA'],
            'example' => 'Cocokkan simbol flowchart dengan fungsi yang benar.',
            'fields' => [
                'Judul evaluasi',
                'Pertanyaan kolom kiri',
                'Jawaban kolom kanan',
                'Kunci pasangan',
                'Pembahasan dan skor',
            ],
        ],
        [
            'id' => 'pilih-kode',
            'type' => 'evaluasi',
            'title' => 'Pilih Kode yang Benar',
            'description' => 'Pertanyaan dengan beberapa potongan kode yang harus dibandingkan.',
            'mascot' => 'mascot_think.png',
            'levels' => ['SMP', 'SMA'],
            'example' => 'Manakah kode Python yang benar untuk menampilkan Halo?',
            'fields' => ['Pertanyaan', 'Pilihan potongan kode', 'Jawaban benar', 'Penjelasan jawaban', 'Bobot nilai'],
        ],
        [
            'id' => 'flowchart',
            'type' => 'evaluasi',
            'title' => 'Flowchart + Preview Kode',
            'description' => 'Siswa menyusun diagram alur dan melihat hasil kode secara otomatis.',
            'mascot' => 'mascot_class.png',
            'levels' => ['SMP', 'SMA'],
            'example' => 'Susun flowchart untuk menentukan bilangan ganjil atau genap.',
            'fields' => [
                'Judul dan instruksi',
                'Node flowchart',
                'Hubungan dan arah panah',
                'Kunci alur benar',
                'Preview kode Python',
            ],
        ],
        [
            'id' => 'coding-blocks',
            'type' => 'evaluasi',
            'title' => 'Coding Blocks',
            'description' => 'Blok kode yang bisa disusun, dipindahkan, dan diedit nilainya.',
            'mascot' => 'mascot_run.png',
            'levels' => ['SMP', 'SMA'],
            'example' => 'Susun blok variabel, kondisi if, dan perintah output.',
            'fields' => [
                'Instruksi tantangan',
                'Jenis blok',
                'Variabel dan nilai awal',
                'Blok yang bisa diedit',
                'Output yang diharapkan',
            ],
        ],
    ];

    $materialTemplates = array_values(array_filter($templates, fn($item) => $item['type'] === 'materi'));
    $evaluationTemplates = array_values(array_filter($templates, fn($item) => $item['type'] === 'evaluasi'));

    /*
    |--------------------------------------------------------------------------
    | CEK ROUTE EDITOR & DAFTAR MATERI (BACKEND YURI)
    |--------------------------------------------------------------------------
    */
    $hasMaterialEditor = \Illuminate\Support\Facades\Route::has('guru.materi.create');
    $hasMaterialList = \Illuminate\Support\Facades\Route::has('guru.materi.index');
@endphp

@section('content')
    <div class="relative w-full min-h-full overflow-x-hidden">

        <!-- =====================================================================
                             DEKORASI BACKGROUND (BLOB, AWAN, PAW KUCING BESAR, & BINTANG)
                        ====================================================================== -->
        <div class="pointer-events-none select-none absolute inset-0 overflow-hidden z-0">
            <!-- Blob Besar Pastel -->
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

            <svg class="hidden md:block absolute top-[55%] right-6 w-36 h-36 text-blue-300/25 rotate-12" viewBox="0 0 64 64"
                fill="currentColor">
                <ellipse cx="16" cy="22" rx="5.5" ry="7.5" transform="rotate(-18 16 22)" />
                <ellipse cx="27" cy="15" rx="5.5" ry="8" transform="rotate(-6 27 15)" />
                <ellipse cx="39" cy="15" rx="5.5" ry="8" transform="rotate(8 39 15)" />
                <ellipse cx="49" cy="23" rx="5.5" ry="7.5" transform="rotate(20 49 23)" />
                <path
                    d="M32 27c-9.5 0-16 6.8-16 14.2 0 5.2 4.2 8.8 9.2 8.8 2.6 0 4.6-1 6.8-1s4.2 1 6.8 1c5 0 9.2-3.6 9.2-8.8C48 33.8 41.5 27 32 27z" />
            </svg>

            <!-- Taburan Bintang-Bintang -->
            <svg class="absolute top-12 left-[42%] w-7 h-7 text-blue-400/55" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 1l2.6 7.4L22 11l-7.4 2.6L12 21l-2.6-7.4L2 11l7.4-2.6L12 1z" />
            </svg>
            <svg class="absolute top-24 right-[28%] w-5 h-5 text-sky-400/60" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 1l2.6 7.4L22 11l-7.4 2.6L12 21l-2.6-7.4L2 11l7.4-2.6L12 1z" />
            </svg>
            <svg class="absolute top-[38%] right-[12%] w-7 h-7 text-blue-400/45" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 1l2.6 7.4L22 11l-7.4 2.6L12 21l-2.6-7.4L2 11l7.4-2.6L12 1z" />
            </svg>
            <svg class="absolute bottom-32 left-10 w-8 h-8 text-blue-400/45" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 1l2.6 7.4L22 11l-7.4 2.6L12 21l-2.6-7.4L2 11l7.4-2.6L12 1z" />
            </svg>
        </div>

        <!-- =====================================================================
                             KONTEN UTAMA STUDIO KONTEN GURU
                        ====================================================================== -->
        <div class="relative z-10 w-full max-w-7xl mx-auto px-5 sm:px-8 py-6 space-y-6">

            {{-- BREADCRUMB --}}
            <nav class="flex items-center gap-2 text-xs font-bold text-slate-400">
                <a href="{{ route('guru.dashboard') }}" class="text-blue-600 hover:text-blue-700 transition-colors">
                    Dashboard Guru
                </a>
                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2.5"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
                <span class="text-slate-700">Studio Konten</span>
            </nav>

            {{-- HERO SECTION --}}
            <section
                class="relative overflow-hidden rounded-3xl bg-white/95 backdrop-blur-sm border border-white shadow-soft-card p-6 sm:p-8 flex flex-col md:flex-row items-center justify-between gap-6">
                <!-- Dekorasi Awan & Paw Besar Dalam Hero -->
                <svg class="pointer-events-none select-none absolute -bottom-8 right-10 w-96 h-36 text-blue-50/90"
                    viewBox="0 0 380 140" fill="currentColor">
                    <circle cx="70" cy="95" r="48" />
                    <circle cx="145" cy="75" r="60" />
                    <circle cx="225" cy="85" r="55" />
                    <circle cx="300" cy="100" r="45" />
                    <rect x="30" y="90" width="310" height="50" />
                </svg>
                <svg class="pointer-events-none select-none absolute top-4 right-64 w-24 h-24 text-blue-100/75 -rotate-12"
                    viewBox="0 0 64 64" fill="currentColor">
                    <ellipse cx="16" cy="22" rx="5.5" ry="7.5"
                        transform="rotate(-18 16 22)" />
                    <ellipse cx="27" cy="15" rx="5.5" ry="8"
                        transform="rotate(-6 27 15)" />
                    <ellipse cx="39" cy="15" rx="5.5" ry="8" transform="rotate(8 39 15)" />
                    <ellipse cx="49" cy="23" rx="5.5" ry="7.5"
                        transform="rotate(20 49 23)" />
                    <path
                        d="M32 27c-9.5 0-16 6.8-16 14.2 0 5.2 4.2 8.8 9.2 8.8 2.6 0 4.6-1 6.8-1s4.2 1 6.8 1c5 0 9.2-3.6 9.2-8.8C48 33.8 41.5 27 32 27z" />
                </svg>
                <!-- Bintang Sudut -->
                <svg class="hidden sm:block pointer-events-none select-none absolute top-5 right-6 w-10 h-10 text-blue-300/80"
                    viewBox="0 0 48 48" fill="currentColor">
                    <path d="M24 4l2.5 7.5L34 14l-7.5 2.5L24 24l-2.5-7.5L14 14l7.5-2.5L24 4z" />
                    <path d="M38 22l1.5 4.5L44 28l-4.5 1.5L38 34l-1.5-4.5L32 28l4.5-1.5L38 22z" opacity="0.65" />
                </svg>

                <div class="relative z-10 max-w-2xl space-y-3">
                    <div
                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-50 border border-blue-100 text-[11px] font-extrabold uppercase tracking-wider text-blue-600">
                        <svg class="w-3.5 h-3.5 text-amber-400" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M9 4.5a.75.75 0 01.721.544l.813 2.846a3.75 3.75 0 002.576 2.576l2.846.813a.75.75 0 010 1.442l-2.846.813a3.75 3.75 0 00-2.576 2.576l-.813 2.846a.75.75 0 01-1.442 0l-.813-2.846a3.75 3.75 0 00-2.576-2.576l-2.846-.813a.75.75 0 010-1.442l2.846-.813A3.75 3.75 0 007.466 7.89l.813-2.846A.75.75 0 019 4.5z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>RUANG KREATIF PENGAJAR</span>
                    </div>

                    <h1 class="text-2xl sm:text-4xl font-extrabold tracking-tight text-slate-900">
                        Studio Konten <span class="text-blue-600">Guru</span>
                    </h1>

                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed max-w-xl">
                        Pilih template, siapkan materi, dan rancang
                        aktivitas belajar yang seru untuk siswa.
                        Tidak perlu membuat desain dari awal!
                    </p>

                    <div class="flex flex-wrap items-center gap-2.5 pt-2">
                        <span
                            class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-blue-50/90 border border-blue-100 text-xs font-extrabold text-blue-700">
                            <svg class="w-3.5 h-3.5 text-blue-600" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M11.25 4.533A9.707 9.707 0 006 3a9.735 9.735 0 00-3.25.555.75.75 0 00-.5.707v14.25a.75.75 0 001 .707A8.237 8.237 0 016 18.75c1.995 0 3.823.707 5.25 1.886V4.533zM12.75 20.636A8.214 8.214 0 0118 18.75c.966 0 1.89.166 2.75.47a.75.75 0 001-.708V4.262a.75.75 0 00-.5-.707A9.735 9.735 0 0018 3a9.707 9.707 0 00-5.25 1.533v16.103z" />
                            </svg>
                            <span>3 Template Materi</span>
                        </span>

                        <span
                            class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-indigo-50/90 border border-indigo-100 text-xs font-extrabold text-indigo-700">
                            <svg class="w-3.5 h-3.5 text-indigo-600" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M11.644 1.59a.75.75 0 01.712 0l9.75 5.25a.75.75 0 010 1.32l-9.75 5.25a.75.75 0 01-.712 0l-9.75-5.25a.75.75 0 010-1.32l9.75-5.25z" />
                                <path
                                    d="M3.265 10.602l7.668 4.129a2.25 2.25 0 002.134 0l7.668-4.13 1.37.739a.75.75 0 010 1.32l-9.75 5.25a.75.75 0 01-.71 0l-9.75-5.25a.75.75 0 010-1.32l1.37-.738z" />
                            </svg>
                            <span>4 Template Evaluasi</span>
                        </span>

                        <span
                            class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-sky-50/90 border border-sky-100 text-xs font-extrabold text-sky-700">
                            <svg class="w-3.5 h-3.5 text-sky-600" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M11.7 2.805a.75.75 0 01.6 0A60.65 60.65 0 0122.83 8.72a.75.75 0 01-.231 1.337 49.949 49.949 0 00-9.902 3.912l-.003.002-.34.18a.75.75 0 01-.707 0A50.009 50.009 0 007.5 12.174v-.224c0-.131.067-.248.172-.311a54.614 54.614 0 014.653-2.52.75.75 0 00-.65-1.352 56.129 56.129 0 00-4.78 2.589 1.858 1.858 0 00-.859 1.228 49.803 49.803 0 00-4.634-1.527.75.75 0 01-.231-1.337A60.653 60.653 0 0111.7 2.805z" />
                            </svg>
                            <span>SD – SMA</span>
                        </span>
                    </div>

                    @if ($hasMaterialList)
                        <div class="pt-2">
                            <a href="{{ route('guru.materi.index') }}"
                                class="inline-flex items-center gap-2 rounded-full bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 text-xs font-extrabold shadow-soft-blue transition-all">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M19.5 21a3 3 0 003-3v-4.5a3 3 0 00-3-3h-15a3 3 0 00-3 3V18a3 3 0 003 3h15zM1.5 10.146V6a3 3 0 013-3h5.379a2.25 2.25 0 011.59.659l2.122 2.121c.14.141.331.22.53.22H19.5a3 3 0 013 3v1.146A4.483 4.483 0 0019.5 9h-15a4.483 4.483 0 00-3 1.146z" />
                                </svg>
                                <span>Lihat Materi Saya</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                </svg>
                            </a>
                        </div>
                    @endif
                </div>

                <div class="relative z-10 shrink-0">
                    <img src="{{ asset('images/guru_konten.png') }}" alt="Maskot CodePawth sedang menggunakan laptop"
                        class="w-36 h-36 sm:w-44 sm:h-44 object-contain drop-shadow-sm">
                </div>
            </section>

            {{-- PILIH KELAS --}}
            <section
                class="bg-white/95 backdrop-blur-sm rounded-3xl border border-white shadow-soft-card p-5 sm:p-6 flex flex-col md:flex-row md:items-center justify-between gap-5 relative overflow-hidden">
                <svg class="pointer-events-none select-none absolute -bottom-4 left-1/2 w-24 h-24 text-blue-100/65 rotate-12"
                    viewBox="0 0 64 64" fill="currentColor">
                    <ellipse cx="16" cy="22" rx="5.5" ry="7.5"
                        transform="rotate(-18 16 22)" />
                    <ellipse cx="27" cy="15" rx="5.5" ry="8"
                        transform="rotate(-6 27 15)" />
                    <ellipse cx="39" cy="15" rx="5.5" ry="8" transform="rotate(8 39 15)" />
                    <ellipse cx="49" cy="23" rx="5.5" ry="7.5"
                        transform="rotate(20 49 23)" />
                    <path
                        d="M32 27c-9.5 0-16 6.8-16 14.2 0 5.2 4.2 8.8 9.2 8.8 2.6 0 4.6-1 6.8-1s4.2 1 6.8 1c5 0 9.2-3.6 9.2-8.8C48 33.8 41.5 27 32 27z" />
                </svg>

                <div class="relative z-10 flex items-center gap-4">
                    <img src="{{ asset('images/guru_think.png') }}" alt="Maskot Kelas"
                        class="w-14 h-14 object-contain shrink-0 drop-shadow-2xs">

                    <div>
                        <h2 class="text-base sm:text-lg font-extrabold text-blue-900">
                            Untuk kelas mana?
                        </h2>
                        <p class="text-xs sm:text-sm text-slate-500 mt-0.5 leading-relaxed">
                            Kamu bisa memilih kelas sekarang
                            atau menentukannya nanti saat mengisi materi.
                        </p>
                    </div>
                </div>

                <div class="relative z-10 w-full md:w-80 shrink-0">
                    <label for="studioClass" class="block text-xs font-extrabold text-slate-700 mb-1.5">
                        Kelas Tujuan
                    </label>

                    <div class="relative">
                        <select id="studioClass"
                            class="w-full appearance-none rounded-full bg-slate-50/85 border border-slate-200 px-4 py-2.5 pr-10 text-xs sm:text-sm font-semibold text-slate-800 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all cursor-pointer">
                            <option value="">
                                Belum memilih kelas
                            </option>

                            @foreach ($classes as $class)
                                <option value="{{ $class->id }}">
                                    {{ $class->name }} — {{ $class->level }}
                                </option>
                            @endforeach
                        </select>
                        <svg class="w-4 h-4 text-slate-600 pointer-events-none absolute right-4 top-1/2 -translate-y-1/2"
                            fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>

                    @if ($classes->isEmpty())
                        <p class="text-[11px] font-medium text-slate-500 mt-2 pl-2">
                            Belum ada kelas.
                            <a href="{{ route('guru.dashboard') }}" class="text-blue-600 font-extrabold hover:underline">
                                Buat kelas terlebih dahulu
                            </a>.
                        </p>
                    @endif
                </div>
            </section>

            {{-- INFORMASI JIKA ROUTE EDITOR BELUM ADA --}}
            @unless ($hasMaterialEditor)
                <div
                    class="rounded-3xl bg-amber-50/95 border border-amber-200 p-4 sm:p-5 flex items-start gap-3.5 text-amber-900 shadow-2xs">
                    <svg class="w-5 h-5 text-amber-500 shrink-0 mt-0.5" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z"
                            clip-rule="evenodd" />
                    </svg>
                    <div>
                        <strong class="block text-xs sm:text-sm font-extrabold">Editor materi belum terhubung.</strong>
                        <p class="text-xs text-amber-800/90 mt-0.5 leading-relaxed">
                            Template tetap bisa dilihat. Untuk mulai membuat materi, daftarkan route
                            <code class="font-mono font-bold">guru.materi.create</code> dan siapkan halaman
                            <code class="font-mono font-bold">materi-editor.blade.php</code>.
                        </p>
                    </div>
                </div>
            @endunless

            {{-- INTRO PILIH TEMPLATE --}}
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 pt-3">
                <div>
                    <span class="text-[11px] font-extrabold uppercase tracking-wider text-blue-600">
                        PERPUSTAKAAN TEMPLATE
                    </span>

                    <h2 class="text-xl sm:text-2xl font-extrabold text-slate-900 mt-1">
                        Mau membuat apa hari ini?
                    </h2>

                    <p class="text-xs sm:text-sm text-slate-600 mt-1">
                        Pilih template yang sesuai dengan kebutuhan pembelajaranmu.
                    </p>
                </div>

                <img src="{{ asset('images/guru_peek.png') }}" alt="Maskot mengintip pilihan template"
                    class="w-24 h-24 object-contain self-end shrink-0 drop-shadow-xs">
            </div>

            {{-- TOOLBAR FILTER --}}
            <div
                class="bg-white/95 backdrop-blur-sm rounded-3xl border border-white shadow-soft-card p-3.5 sm:p-4 flex flex-col lg:flex-row lg:items-center justify-between gap-3">
                <div class="flex flex-wrap items-center gap-2" aria-label="Filter jenis template">
                    <button type="button"
                        class="studio-filter inline-flex items-center gap-1.5 rounded-full px-4 py-2 text-xs font-extrabold transition-all cursor-pointer bg-blue-600 text-white shadow-soft-blue"
                        data-filter="semua" aria-pressed="true">
                        <span>Semua</span>
                    </button>

                    <button type="button"
                        class="studio-filter inline-flex items-center gap-1.5 rounded-full px-4 py-2 text-xs font-extrabold transition-all cursor-pointer bg-slate-50 text-slate-600 hover:bg-blue-50 hover:text-blue-600"
                        data-filter="materi" aria-pressed="false">
                        <svg class="w-3.5 h-3.5 shrink-0" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M11.25 4.533A9.707 9.707 0 006 3a9.735 9.735 0 00-3.25.555.75.75 0 00-.5.707v14.25a.75.75 0 001 .707A8.237 8.237 0 016 18.75c1.995 0 3.823.707 5.25 1.886V4.533zM12.75 20.636A8.214 8.214 0 0118 18.75c.966 0 1.89.166 2.75.47a.75.75 0 001-.708V4.262a.75.75 0 00-.5-.707A9.735 9.735 0 0018 3a9.707 9.707 0 00-5.25 1.533v16.103z" />
                        </svg>
                        <span>Materi</span>
                    </button>

                    <button type="button"
                        class="studio-filter inline-flex items-center gap-1.5 rounded-full px-4 py-2 text-xs font-extrabold transition-all cursor-pointer bg-slate-50 text-slate-600 hover:bg-blue-50 hover:text-blue-600"
                        data-filter="evaluasi" aria-pressed="false">
                        <svg class="w-3.5 h-3.5 shrink-0" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M7.502 6h7.128A3.375 3.375 0 0118 9.375v9.375a3 3 0 003-3V6.108c0-1.505-1.125-2.811-2.664-2.94a48.972 48.972 0 00-.673-.05A3 3 0 0015 1.5h-1.5a3 3 0 00-2.663 1.618c-.225.015-.45.032-.673.05C8.662 3.295 7.554 4.542 7.502 6zM13.5 3A1.5 1.5 0 0012 4.5h4.5A1.5 1.5 0 0015 3h-1.5z"
                                clip-rule="evenodd" />
                            <path fill-rule="evenodd"
                                d="M3 9.375C3 8.339 3.84 7.5 4.875 7.5h9.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 013 20.625V9.375z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>Evaluasi</span>
                    </button>
                </div>

                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2.5">
                    <div class="relative">
                        <select id="studioLevel" aria-label="Filter jenjang"
                            class="w-full sm:w-44 appearance-none rounded-full bg-slate-50 border border-slate-200 px-4 py-2 pr-9 text-xs font-bold text-slate-700 focus:bg-white focus:border-blue-500 outline-none cursor-pointer">
                            <option value="semua">Semua Jenjang</option>
                            <option value="SD">SD</option>
                            <option value="SMP">SMP</option>
                            <option value="SMA">SMA</option>
                        </select>
                        <svg class="w-3.5 h-3.5 text-slate-500 pointer-events-none absolute right-3.5 top-1/2 -translate-y-1/2"
                            fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>

                    <div class="relative">
                        <svg class="w-4 h-4 text-slate-400 pointer-events-none absolute left-3.5 top-1/2 -translate-y-1/2"
                            fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                        <input type="search" id="studioSearch" placeholder="Cari template..."
                            aria-label="Cari template"
                            class="w-full sm:w-60 rounded-full bg-slate-50 border border-slate-200 pl-9 pr-4 py-2 text-xs font-semibold text-slate-800 placeholder:text-slate-400 focus:bg-white focus:border-blue-500 outline-none">
                    </div>
                </div>
            </div>

            {{-- =====================================================================
             01 / TEMPLATE MATERI
        ====================================================================== --}}
            <section id="studioMaterials" class="space-y-4 pt-2">
                <div class="flex items-end justify-between gap-4">
                    <div>
                        <span class="text-[11px] font-extrabold uppercase tracking-wider text-blue-600">
                            01 / MATERI
                        </span>
                        <h2 class="text-xl sm:text-2xl font-extrabold text-slate-900 mt-0.5">
                            Template Materi
                        </h2>
                        <p class="text-xs sm:text-sm text-slate-500 mt-0.5">
                            Buat konten pembelajaran yang menarik dan mudah dipahami.
                        </p>
                    </div>

                    <span
                        class="px-3.5 py-1.5 rounded-full bg-white border border-blue-100 text-xs font-extrabold text-blue-700 shadow-2xs shrink-0">
                        3 Template
                    </span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($materialTemplates as $template)
                        @php
                            $editorUrl = $hasMaterialEditor
                                ? route('guru.materi.create', [
                                    'type' => $template['id'],
                                ])
                                : '';
                        @endphp

                        <article
                            class="studio-template group bg-white/95 backdrop-blur-sm rounded-3xl border border-white shadow-soft-card overflow-hidden flex flex-col transition-all duration-200 hover:-translate-y-1 hover:shadow-lg"
                            data-id="{{ $template['id'] }}" data-type="{{ $template['type'] }}"
                            data-levels="{{ implode(',', $template['levels']) }}" data-title="{{ $template['title'] }}"
                            data-description="{{ $template['description'] }}" data-example="{{ $template['example'] }}"
                            data-fields="{{ implode('|', $template['fields']) }}"
                            data-mascot="{{ asset('images/' . $template['mascot']) }}"
                            data-editor-url="{{ $editorUrl }}">
                            <div
                                class="relative h-44 bg-gradient-to-br from-blue-50 via-sky-50 to-indigo-50/70 flex items-end justify-center overflow-hidden pt-4">
                                <!-- Dekorasi Awan & Bintang di Kartu -->
                                <svg class="pointer-events-none select-none absolute -bottom-3 left-0 w-full h-16 text-white/80"
                                    viewBox="0 0 320 60" fill="currentColor">
                                    <circle cx="50" cy="45" r="28" />
                                    <circle cx="115" cy="35" r="34" />
                                    <circle cx="195" cy="38" r="32" />
                                    <circle cx="265" cy="46" r="26" />
                                    <rect x="0" y="42" width="320" height="20" />
                                </svg>
                                <svg class="pointer-events-none select-none absolute top-4 right-5 w-5 h-5 text-blue-300/80"
                                    viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 1l2.6 7.4L22 11l-7.4 2.6L12 21l-2.6-7.4L2 11l7.4-2.6L12 1z" />
                                </svg>

                                <span
                                    class="absolute top-3.5 left-3.5 z-10 inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/95 border border-blue-100 text-[10px] font-extrabold uppercase tracking-wider text-blue-700 shadow-2xs">
                                    <svg class="w-3 h-3 text-blue-600" viewBox="0 0 24 24" fill="currentColor">
                                        <path
                                            d="M11.25 4.533A9.707 9.707 0 006 3a9.735 9.735 0 00-3.25.555.75.75 0 00-.5.707v14.25a.75.75 0 001 .707A8.237 8.237 0 016 18.75c1.995 0 3.823.707 5.25 1.886V4.533zM12.75 20.636A8.214 8.214 0 0118 18.75c.966 0 1.89.166 2.75.47a.75.75 0 001-.708V4.262a.75.75 0 00-.5-.707A9.735 9.735 0 0018 3a9.707 9.707 0 00-5.25 1.533v16.103z" />
                                    </svg>
                                    <span>MATERI</span>
                                </span>

                                <img src="{{ asset('images/' . $template['mascot']) }}"
                                    alt="Maskot template {{ $template['title'] }}" loading="lazy"
                                    class="relative z-10 w-36 h-32 object-contain object-bottom transition-transform duration-300 group-hover:-translate-y-1 group-hover:scale-105">
                            </div>

                            <div class="p-5 sm:p-6 flex-1 flex flex-col">
                                <div class="flex flex-wrap gap-1.5 mb-3">
                                    @foreach ($template['levels'] as $level)
                                        <span
                                            class="px-2.5 py-0.5 rounded-full bg-blue-50 border border-blue-100 text-[10px] font-extrabold text-blue-700">
                                            {{ $level }}
                                        </span>
                                    @endforeach
                                </div>

                                <h3 class="text-base sm:text-lg font-extrabold text-slate-900 mb-1.5">
                                    {{ $template['title'] }}
                                </h3>

                                <p class="text-xs sm:text-sm text-slate-500 leading-relaxed flex-1 mb-5">
                                    {{ $template['description'] }}
                                </p>

                                <button type="button"
                                    class="studio-template-button w-full inline-flex items-center justify-between gap-2 rounded-full bg-blue-50 hover:bg-blue-600 text-blue-700 hover:text-white border border-blue-100 hover:border-blue-600 px-4 py-2.5 text-xs font-extrabold transition-all cursor-pointer">
                                    <span>Lihat & Pilih Template</span>
                                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor"
                                        stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                    </svg>
                                </button>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>

            {{-- =====================================================================
             02 / TEMPLATE SOAL & EVALUASI
        ====================================================================== --}}
            <section id="studioEvaluations" class="space-y-4 pt-4">
                <div class="flex items-end justify-between gap-4">
                    <div>
                        <span class="text-[11px] font-extrabold uppercase tracking-wider text-indigo-600">
                            02 / EVALUASI
                        </span>

                        <h2 class="text-xl sm:text-2xl font-extrabold text-slate-900 mt-0.5">
                            Template Soal & Evaluasi
                        </h2>

                        <p class="text-xs sm:text-sm text-slate-500 mt-0.5">
                            Rancang aktivitas untuk menguji logika dan kemampuan coding siswa.
                        </p>
                    </div>

                    <span
                        class="px-3.5 py-1.5 rounded-full bg-white border border-indigo-100 text-xs font-extrabold text-indigo-700 shadow-2xs shrink-0">
                        4 Template
                    </span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach ($evaluationTemplates as $template)
                        <article
                            class="studio-template group bg-white/95 backdrop-blur-sm rounded-3xl border border-white shadow-soft-card overflow-hidden flex flex-col transition-all duration-200 hover:-translate-y-1 hover:shadow-lg"
                            data-id="{{ $template['id'] }}" data-type="{{ $template['type'] }}"
                            data-levels="{{ implode(',', $template['levels']) }}" data-title="{{ $template['title'] }}"
                            data-description="{{ $template['description'] }}" data-example="{{ $template['example'] }}"
                            data-fields="{{ implode('|', $template['fields']) }}"
                            data-mascot="{{ asset('images/' . $template['mascot']) }}" data-editor-url="">
                            <div
                                class="relative h-44 bg-gradient-to-br from-indigo-50 via-blue-50 to-sky-50/70 flex items-end justify-center overflow-hidden pt-4">
                                <!-- Dekorasi Awan & Paw Besar -->
                                <svg class="pointer-events-none select-none absolute -bottom-3 left-0 w-full h-16 text-white/80"
                                    viewBox="0 0 360 60" fill="currentColor">
                                    <circle cx="60" cy="45" r="28" />
                                    <circle cx="135" cy="35" r="34" />
                                    <circle cx="220" cy="38" r="32" />
                                    <circle cx="300" cy="46" r="26" />
                                    <rect x="0" y="42" width="360" height="20" />
                                </svg>
                                <svg class="pointer-events-none select-none absolute top-3 right-5 w-16 h-16 text-indigo-200/50 rotate-12"
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

                                <span
                                    class="absolute top-3.5 left-3.5 z-10 inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/95 border border-indigo-100 text-[10px] font-extrabold uppercase tracking-wider text-indigo-700 shadow-2xs">
                                    <svg class="w-3 h-3 text-indigo-600" viewBox="0 0 24 24" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M7.502 6h7.128A3.375 3.375 0 0118 9.375v9.375a3 3 0 003-3V6.108c0-1.505-1.125-2.811-2.664-2.94a48.972 48.972 0 00-.673-.05A3 3 0 0015 1.5h-1.5a3 3 0 00-2.663 1.618c-.225.015-.45.032-.673.05C8.662 3.295 7.554 4.542 7.502 6zM13.5 3A1.5 1.5 0 0012 4.5h4.5A1.5 1.5 0 0015 3h-1.5z"
                                            clip-rule="evenodd" />
                                        <path fill-rule="evenodd"
                                            d="M3 9.375C3 8.339 3.84 7.5 4.875 7.5h9.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 013 20.625V9.375z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span>EVALUASI</span>
                                </span>

                                <img src="{{ asset('images/' . $template['mascot']) }}"
                                    alt="Maskot template {{ $template['title'] }}" loading="lazy"
                                    class="relative z-10 w-36 h-32 object-contain object-bottom transition-transform duration-300 group-hover:-translate-y-1 group-hover:scale-105">
                            </div>

                            <div class="p-5 sm:p-6 flex-1 flex flex-col">
                                <div class="flex flex-wrap gap-1.5 mb-3">
                                    @foreach ($template['levels'] as $level)
                                        <span
                                            class="px-2.5 py-0.5 rounded-full bg-indigo-50 border border-indigo-100 text-[10px] font-extrabold text-indigo-700">
                                            {{ $level }}
                                        </span>
                                    @endforeach
                                </div>

                                <h3 class="text-base sm:text-lg font-extrabold text-slate-900 mb-1.5">
                                    {{ $template['title'] }}
                                </h3>

                                <p class="text-xs sm:text-sm text-slate-500 leading-relaxed flex-1 mb-5">
                                    {{ $template['description'] }}
                                </p>

                                <button type="button"
                                    class="studio-template-button w-full inline-flex items-center justify-between gap-2 rounded-full bg-blue-50 hover:bg-blue-600 text-blue-700 hover:text-white border border-blue-100 hover:border-blue-600 px-4 py-2.5 text-xs font-extrabold transition-all cursor-pointer">
                                    <span>Lihat Detail Template</span>
                                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor"
                                        stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                    </svg>
                                </button>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>

            {{-- PESAN FILTER KOSONG --}}
            <div id="studioEmpty" hidden
                class="bg-white/95 rounded-3xl border border-dashed border-blue-200 p-10 text-center space-y-2">
                <img src="{{ asset('images/mascot_peek.png') }}" alt="Maskot Pencarian Kosong"
                    class="w-24 h-24 object-contain mx-auto mb-2">
                <h3 class="text-base sm:text-lg font-extrabold text-slate-900">
                    Template belum ditemukan
                </h3>
                <p class="text-xs sm:text-sm text-slate-500">
                    Coba ubah pencarian atau pilihan jenjang.
                </p>
            </div>

            {{-- =====================================================================
             PANDUAN MASKOT
        ====================================================================== --}}
            <section
                class="relative overflow-hidden bg-white/95 backdrop-blur-sm rounded-3xl border border-white shadow-soft-card p-6 sm:p-8 mt-4">
                <!-- Dekorasi Paw Besar & Bintang -->
                <svg class="pointer-events-none select-none absolute -bottom-4 -left-4 w-28 h-28 text-blue-100/75 -rotate-12"
                    viewBox="0 0 64 64" fill="currentColor">
                    <ellipse cx="16" cy="22" rx="5.5" ry="7.5"
                        transform="rotate(-18 16 22)" />
                    <ellipse cx="27" cy="15" rx="5.5" ry="8"
                        transform="rotate(-6 27 15)" />
                    <ellipse cx="39" cy="15" rx="5.5" ry="8" transform="rotate(8 39 15)" />
                    <ellipse cx="49" cy="23" rx="5.5" ry="7.5"
                        transform="rotate(20 49 23)" />
                    <path
                        d="M32 27c-9.5 0-16 6.8-16 14.2 0 5.2 4.2 8.8 9.2 8.8 2.6 0 4.6-1 6.8-1s4.2 1 6.8 1c5 0 9.2-3.6 9.2-8.8C48 33.8 41.5 27 32 27z" />
                </svg>
                <svg class="pointer-events-none select-none absolute top-5 right-8 w-8 h-8 text-blue-300/75"
                    viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 1l2.6 7.4L22 11l-7.4 2.6L12 21l-2.6-7.4L2 11l7.4-2.6L12 1z" />
                </svg>

                <div class="relative z-10 text-center max-w-xl mx-auto mb-6">
                    <span class="text-[11px] font-extrabold uppercase tracking-wider text-blue-600">
                        TIPS DARI MASKOT CODEPAWTH
                    </span>

                    <h2 class="text-xl sm:text-2xl font-extrabold text-slate-900 mt-1">
                        Bikin belajar jadi lebih menyenangkan!
                    </h2>
                </div>

                <div class="relative z-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="rounded-2xl bg-blue-50/70 border border-blue-100/80 p-5 text-center">
                        <img src="{{ asset('images/mascot_cheers.png') }}" alt="Maskot bersemangat" loading="lazy"
                            class="w-24 h-24 object-contain mx-auto mb-3 drop-shadow-2xs">
                        <strong class="block text-sm font-extrabold text-slate-900 mb-1">
                            Mulai dari yang mudah
                        </strong>
                        <p class="text-xs text-slate-500 leading-relaxed">
                            Gunakan Flashcard untuk mengenalkan konsep baru.
                        </p>
                    </div>

                    <div class="rounded-2xl bg-sky-50/70 border border-sky-100/80 p-5 text-center">
                        <img src="{{ asset('images/mascot_happy.png') }}" alt="Maskot membawa piala" loading="lazy"
                            class="w-24 h-24 object-contain mx-auto mb-3 drop-shadow-2xs">
                        <strong class="block text-sm font-extrabold text-slate-900 mb-1">
                            Berikan apresiasi
                        </strong>
                        <p class="text-xs text-slate-500 leading-relaxed">
                            Rayakan setiap pencapaian siswa.
                        </p>
                    </div>

                    <div class="rounded-2xl bg-indigo-50/70 border border-indigo-100/80 p-5 text-center">
                        <img src="{{ asset('images/mascot_loveya.png') }}" alt="Maskot dengan simbol hati"
                            loading="lazy" class="w-24 h-24 object-contain mx-auto mb-3 drop-shadow-2xs">
                        <strong class="block text-sm font-extrabold text-slate-900 mb-1">
                            Beri petunjuk ramah
                        </strong>
                        <p class="text-xs text-slate-500 leading-relaxed">
                            Bantu siswa memahami kesalahan.
                        </p>
                    </div>

                    <div class="rounded-2xl bg-blue-50/70 border border-blue-100/80 p-5 text-center">
                        <img src="{{ asset('images/mascot_angry.png') }}" alt="Maskot sedang kesal" loading="lazy"
                            class="w-24 h-24 object-contain mx-auto mb-3 drop-shadow-2xs">
                        <strong class="block text-sm font-extrabold text-slate-900 mb-1">
                            Jadikan bug tantangan
                        </strong>
                        <p class="text-xs text-slate-500 leading-relaxed">
                            Ajak siswa menemukan dan memperbaiki error.
                        </p>
                    </div>
                </div>
            </section>

        </div>
    </div>

    {{-- =====================================================================
     MODAL DETAIL TEMPLATE
====================================================================== --}}
    <dialog id="studioModal" class="studio-modal">
        <div class="studio-modal-header">
            <img id="studioModalMascot" src="{{ asset('images/mascot_card.png') }}" alt="Maskot template">

            <div>
                <span class="studio-eyebrow" id="studioModalType">
                    TEMPLATE
                </span>

                <h2 id="studioModalTitle"></h2>
            </div>

            <button type="button" id="studioModalClose" class="studio-modal-close" aria-label="Tutup detail">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="studio-modal-content">
            <p id="studioModalDescription"></p>

            <h3>Contoh Penggunaan</h3>
            <div id="studioModalExample" class="studio-example"></div>

            <h3>Komponen yang Bisa Diisi Guru</h3>
            <ul id="studioModalFields"></ul>

            <p id="studioModalNote" class="studio-modal-note"></p>
        </div>

        <div class="studio-modal-actions">
            <button type="button" class="studio-modal-cancel" id="studioCancel">
                Kembali
            </button>

            <button type="button" class="studio-modal-select" id="studioChoose">
                Gunakan Template →
            </button>
        </div>
    </dialog>
@endsection

@push('styles')
    <style>
        [hidden] {
            display: none !important;
        }

        .studio-eyebrow {
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.08em;
            color: #2563EB;
        }

        /* MODAL */
        .studio-modal {
            width: min(540px, calc(100% - 30px));
            max-height: min(85vh, 740px);
            padding: 0;
            border: 1px solid #DBEAFE;
            border-radius: 24px;
            background: #FFFFFF;
            color: #0F172A;
            font-family: 'Plus Jakarta Sans', sans-serif;
            box-shadow: 0 25px 70px rgba(30, 64, 175, 0.18);
            overflow-y: auto;
        }

        .studio-modal::backdrop {
            background: rgba(15, 23, 42, 0.5);
            backdrop-filter: blur(4px);
        }

        .studio-modal-header {
            position: relative;
            display: flex;
            gap: 16px;
            align-items: center;
            padding: 22px 24px;
            background: linear-gradient(135deg, #EFF6FF 0%, #E0E7FF 100%);
        }

        .studio-modal-header img {
            width: 88px;
            height: 84px;
            object-fit: contain;
            flex-shrink: 0;
        }

        .studio-modal-header h2 {
            font-size: 20px;
            font-weight: 800;
            color: #0F172A;
            margin: 6px 28px 0 0;
        }

        .studio-modal-close {
            position: absolute;
            top: 16px;
            right: 16px;
            border: 1px solid #E2E8F0;
            border-radius: 9999px;
            width: 34px;
            height: 34px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #475569;
            background: #FFFFFF;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .studio-modal-close:hover {
            background: #2563EB;
            border-color: #2563EB;
            color: #FFFFFF;
        }

        .studio-modal-content {
            padding: 22px 26px;
        }

        .studio-modal-content>p {
            color: #475569;
            font-size: 13px;
            line-height: 1.75;
        }

        .studio-modal-content h3 {
            font-size: 13px;
            font-weight: 800;
            color: #1E3A8A;
            margin: 20px 0 10px;
        }

        .studio-example {
            background: #EFF6FF;
            border: 1px solid #DBEAFE;
            border-radius: 14px;
            padding: 13px 15px;
            color: #1D4ED8;
            font-size: 12px;
            font-weight: 600;
            line-height: 1.7;
        }

        .studio-modal-content ul {
            list-style-type: disc;
            padding-left: 20px;
            color: #475569;
            font-size: 12px;
            line-height: 2;
        }

        .studio-modal-content .studio-modal-note {
            margin-top: 18px;
            padding: 12px 14px;
            background: #FFFBEB;
            border: 1px solid #FDE68A;
            border-radius: 14px;
            color: #92400E;
            font-size: 11px;
            font-weight: 600;
        }

        .studio-modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            padding: 12px 26px 22px;
        }

        .studio-modal-actions button {
            border-radius: 9999px;
            padding: 10px 18px;
            font: inherit;
            font-weight: 700;
            font-size: 12px;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .studio-modal-cancel {
            background: #F8FAFC;
            border: 1px solid #E2E8F0;
            color: #475569;
        }

        .studio-modal-cancel:hover {
            background: #EFF6FF;
            color: #1D4ED8;
        }

        .studio-modal-select {
            border: 0;
            background: #2563EB;
            color: #FFFFFF;
            box-shadow: 0 8px 20px -4px rgba(37, 99, 235, 0.35);
        }

        .studio-modal-select:hover:not(:disabled) {
            background: #1D4ED8;
        }

        .studio-modal-select:disabled {
            background: #CBD5E1;
            color: #64748B;
            box-shadow: none;
            cursor: not-allowed;
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const cards = Array.from(document.querySelectorAll('.studio-template'));
            const filters = Array.from(document.querySelectorAll('.studio-filter'));

            const classSelect = document.getElementById('studioClass');
            const levelFilter = document.getElementById('studioLevel');
            const searchInput = document.getElementById('studioSearch');

            const materialsSection = document.getElementById('studioMaterials');
            const evaluationsSection = document.getElementById('studioEvaluations');
            const emptyState = document.getElementById('studioEmpty');

            const modal = document.getElementById('studioModal');
            const modalMascot = document.getElementById('studioModalMascot');
            const modalType = document.getElementById('studioModalType');
            const modalTitle = document.getElementById('studioModalTitle');
            const modalDescription = document.getElementById('studioModalDescription');
            const modalExample = document.getElementById('studioModalExample');
            const modalFields = document.getElementById('studioModalFields');
            const modalNote = document.getElementById('studioModalNote');
            const chooseButton = document.getElementById('studioChoose');

            let activeType = 'semua';
            let currentCard = null;

            // ==========================================
            // 1. FILTER TEMPLATE
            // ==========================================
            function applyFilters() {
                const level = levelFilter.value;
                const keyword = searchInput.value.trim().toLowerCase();

                let materialCount = 0;
                let evaluationCount = 0;

                cards.forEach(card => {
                    const type = card.dataset.type;
                    const levels = card.dataset.levels.split(',');

                    const searchableText = (
                        card.dataset.title + ' ' + card.dataset.description
                    ).toLowerCase();

                    const matchType = activeType === 'semua' || activeType === type;
                    const matchLevel = level === 'semua' || levels.includes(level);
                    const matchSearch = searchableText.includes(keyword);

                    const visible = matchType && matchLevel && matchSearch;
                    card.hidden = !visible;

                    if (visible) {
                        if (type === 'materi') {
                            materialCount++;
                        } else {
                            evaluationCount++;
                        }
                    }
                });

                materialsSection.hidden = materialCount === 0;
                evaluationsSection.hidden = evaluationCount === 0;
                emptyState.hidden = (materialCount + evaluationCount) > 0;
            }

            filters.forEach(button => {
                button.addEventListener('click', function() {
                    activeType = this.dataset.filter;

                    filters.forEach(item => {
                        const active = item === this;

                        item.classList.toggle('active', active);
                        item.classList.toggle('bg-blue-600', active);
                        item.classList.toggle('text-white', active);
                        item.classList.toggle('shadow-soft-blue', active);
                        item.classList.toggle('bg-slate-50', !active);
                        item.classList.toggle('text-slate-600', !active);

                        item.setAttribute('aria-pressed', String(active));
                    });

                    applyFilters();
                });
            });

            levelFilter.addEventListener('change', applyFilters);
            searchInput.addEventListener('input', applyFilters);

            // ==========================================
            // 2. BUKA MODAL TEMPLATE (LOGIC BACKEND YURI)
            // ==========================================
            function openTemplate(card) {
                currentCard = card;

                const type = card.dataset.type;
                const editorUrl = card.dataset.editorUrl;

                modalMascot.src = card.dataset.mascot;
                modalMascot.alt = 'Maskot ' + card.dataset.title;

                modalType.textContent = type === 'materi' ? 'TEMPLATE MATERI' : 'TEMPLATE EVALUASI';
                modalTitle.textContent = card.dataset.title;
                modalDescription.textContent = card.dataset.description;
                modalExample.textContent = card.dataset.example;

                modalFields.replaceChildren();
                const fields = card.dataset.fields.split('|');
                fields.forEach(field => {
                    const li = document.createElement('li');
                    li.textContent = field;
                    modalFields.appendChild(li);
                });

                if (type === 'evaluasi') {
                    chooseButton.disabled = true;
                    chooseButton.textContent = 'Editor Evaluasi Belum Tersedia';
                    modalNote.textContent =
                        'Template evaluasi ini bisa dilihat, tetapi editor pembuatan soal belum tersedia.';
                } else if (card.dataset.id === 'coding' && editorUrl) {
                    chooseButton.disabled = false;
                    chooseButton.textContent = 'Lihat Contoh Praktik Coding →';
                    modalNote.textContent =
                        'Buka latihan Coding Python asli CodePawth, lengkap dengan mini flowchart, editor, simulasi output, dan skor. Editor soal khusus Guru belum dibuat.';
                } else if (!editorUrl) {
                    chooseButton.disabled = true;
                    chooseButton.textContent = 'Editor Materi Belum Terhubung';
                    modalNote.textContent =
                        'Route editor materi belum tersedia. Periksa route guru.materi.create.';
                } else {
                    chooseButton.disabled = false;
                    chooseButton.textContent = 'Gunakan Template Ini →';
                    modalNote.textContent =
                        'Buka editor Guru untuk mengisi materi, melihat pratinjau, dan menyimpan hasilnya.';
                }

                modal.showModal();
            }

            cards.forEach(card => {
                const button = card.querySelector('.studio-template-button');
                button.addEventListener('click', function() {
                    openTemplate(card);
                });
            });

            // ==========================================
            // 3. ARAHKAN KE EDITOR MATERI (LOGIC BACKEND YURI)
            // ==========================================
            chooseButton.addEventListener('click', function() {
                if (!currentCard) return;

                const templateId = currentCard.dataset.id;
                const templateType = currentCard.dataset.type;
                const editorUrl = currentCard.dataset.editorUrl;

                if (templateType !== 'materi' || !editorUrl) {
                    return;
                }

                if (templateId === 'coding') {
                    window.location.assign(editorUrl);
                    return;
                }

                const url = new URL(editorUrl, window.location.origin);

                if (classSelect.value) {
                    url.searchParams.set('class_id', classSelect.value);
                }

                window.location.assign(url.toString());
            });

            // ==========================================
            // 4. TUTUP MODAL & FILTER AWAL
            // ==========================================
            document.getElementById('studioModalClose').addEventListener('click', () => modal.close());
            document.getElementById('studioCancel').addEventListener('click', () => modal.close());

            modal.addEventListener('click', function(event) {
                if (event.target === modal) {
                    modal.close();
                }
            });

            applyFilters();
        });
    </script>
@endpush
