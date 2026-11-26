@extends('layouts.app')

@section('title', 'Editor Praktik Coding Python')

@php
    $isEdit = $material !== null;

    $defaults = [
        'instruction' => 'Buat program Python sesuai alur flowchart, lalu uji dengan nilai yang tersedia.',
        'variable' => 'bilangan',
        'condition' => 'even',
        'threshold' => 75,
        'yes_output' => 'Genap',
        'no_output' => 'Ganjil',
        'test_input' => 8,
    ];

    $coding = array_merge($defaults, $material?->content['coding'] ?? [], old('coding', []));
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

            <!-- Taburan Bintang-Bintang -->
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

        <!-- =====================================================================
                 KONTEN UTAMA EDITOR CODING PYTHON
            ====================================================================== -->
        <div class="relative z-10 w-full max-w-7xl mx-auto px-5 sm:px-8 py-6 space-y-6">

            {{-- NAVIGASI / BREADCRUMB --}}
            <nav class="flex items-center gap-2 text-xs font-bold text-slate-400">
                <a href="{{ route('guru.studio') }}"
                    class="inline-flex items-center gap-1.5 text-blue-600 hover:text-blue-700 transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                    <span>Kembali ke Studio Konten</span>
                </a>
                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2.5"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
                <span class="text-slate-700">Praktik Coding Python</span>
            </nav>

            {{-- HEADER / HERO --}}
            <header
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

                <div class="relative z-10 max-w-2xl space-y-3">
                    <div
                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-50 border border-blue-100 text-[11px] font-extrabold uppercase tracking-wider text-blue-600">
                        <svg class="w-3.5 h-3.5 text-blue-600" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M14.447 3.027a.75.75 0 01.527.92l-4.5 16.5a.75.75 0 01-1.448-.394l4.5-16.5a.75.75 0 01.921-.526zM16.72 6.22a.75.75 0 011.06 0l5.25 5.25a.75.75 0 010 1.06l-5.25 5.25a.75.75 0 11-1.06-1.06L21.44 12l-4.72-4.72a.75.75 0 010-1.06zm-9.44 0a.75.75 0 010 1.06L2.56 12l4.72 4.72a.75.75 0 11-1.06 1.06L.97 12.53a.75.75 0 010-1.06l5.25-5.25a.75.75 0 011.06 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>STUDIO KONTEN GURU</span>
                    </div>

                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-slate-900">
                        {{ $isEdit ? 'Edit' : 'Buat' }}
                        <span class="text-blue-600">Praktik Coding Python</span>
                    </h1>

                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed max-w-xl">
                        Buat tantangan berdasarkan flowchart. Atur variabel, kondisi, dan output, kemudian lihat kode
                        Python secara langsung.
                    </p>

                    @if ($isEdit)
                        <div class="pt-1">
                            <a href="{{ route('materi.kelas.show', $material) }}" target="_blank" rel="noopener"
                                class="inline-flex items-center gap-2 rounded-full bg-blue-50 hover:bg-blue-600 text-blue-700 hover:text-white border border-blue-100 hover:border-blue-600 px-4 py-2 text-xs font-extrabold transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span>Lihat Tampilan Siswa</span>
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
                                </svg>
                            </a>
                        </div>
                    @endif
                </div>

                <div class="relative z-10 shrink-0">
                    <img src="{{ asset('images/mascot_class.png') }}" alt="Maskot CodePawth belajar coding"
                        class="w-36 h-36 sm:w-44 sm:h-44 object-contain drop-shadow-sm">
                </div>
            </header>

            {{-- FORM UTAMA --}}
            <form method="POST" id="cg-form"
                action="{{ $isEdit ? route('guru.materi.update', $material) : route('guru.materi.store') }}"
                class="space-y-6">
                @csrf

                @if ($isEdit)
                    @method('PUT')
                @endif

                <input type="hidden" name="type" value="coding">

                {{-- INFORMASI MATERI --}}
                <section
                    class="bg-white/95 backdrop-blur-sm rounded-3xl border border-white shadow-soft-card p-6 sm:p-7 space-y-5">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 rounded-2xl bg-blue-50 border border-blue-100 flex items-center justify-center text-blue-600 shrink-0">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.625 1.5c-1.036 0-1.875.84-1.875 1.875v17.25c0 1.035.84 1.875 1.875 1.875h12.75c1.035 0 1.875-.84 1.875-1.875V12.75A3.75 3.75 0 0016.5 9h-1.875a1.875 1.875 0 01-1.875-1.875V5.25A3.75 3.75 0 009 1.5H5.625zM7.5 15a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5A.75.75 0 017.5 15zm.75 2.25a.75.75 0 000 1.5H12a.75.75 0 000-1.5H8.25z"
                                    clip-rule="evenodd" />
                                <path
                                    d="M12.971 1.816A5.23 5.23 0 0114.25 5.25v1.875c0 .207.168.375.375.375H16.5a5.23 5.23 0 013.434 1.279 9.768 9.768 0 00-6.963-6.963z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-base sm:text-lg font-extrabold text-slate-900">
                                Informasi Materi
                            </h2>
                            <p class="text-xs text-slate-500">
                                Tentukan judul praktik, jenjang pendidikan, dan kelas tujuan.
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                        <div class="md:col-span-6">
                            <label for="cg-title" class="block text-xs font-extrabold text-slate-700 mb-1.5">
                                Judul Materi
                            </label>
                            <input type="text" name="title" id="cg-title"
                                value="{{ old('title', $material?->title) }}"
                                placeholder="Contoh: Program Ganjil dan Genap" maxlength="255" required
                                class="w-full rounded-2xl bg-slate-50/85 border border-slate-200 px-4 py-3 text-xs sm:text-sm font-semibold text-slate-800 placeholder:text-slate-400 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all">
                        </div>

                        <div class="md:col-span-2">
                            <label for="cg-level" class="block text-xs font-extrabold text-slate-700 mb-1.5">
                                Jenjang
                            </label>
                            <div class="relative">
                                <select name="level" id="cg-level" required
                                    class="w-full appearance-none rounded-2xl bg-slate-50/85 border border-slate-200 px-4 py-3 pr-9 text-xs sm:text-sm font-semibold text-slate-800 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all cursor-pointer">
                                    @foreach (['SMP', 'SMA'] as $level)
                                        <option value="{{ $level }}" @selected(old('level', $material?->level ?? 'SMP') === $level)>
                                            {{ $level }}
                                        </option>
                                    @endforeach
                                </select>
                                <svg class="w-4 h-4 text-slate-500 pointer-events-none absolute right-3 top-1/2 -translate-y-1/2"
                                    fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>

                        <div class="md:col-span-4">
                            <label for="cg-class" class="block text-xs font-extrabold text-slate-700 mb-1.5">
                                Kelas Tujuan
                            </label>
                            <div class="relative">
                                <select name="learning_class_id" id="cg-class"
                                    class="w-full appearance-none rounded-2xl bg-slate-50/85 border border-slate-200 px-4 py-3 pr-9 text-xs sm:text-sm font-semibold text-slate-800 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all cursor-pointer">
                                    <option value="">Belum memilih kelas</option>

                                    @foreach ($classes as $class)
                                        <option value="{{ $class->id }}" @selected((string) old('learning_class_id', $material?->learning_class_id ?? request('class_id')) === (string) $class->id)>
                                            {{ $class->name }} ({{ $class->level }})
                                        </option>
                                    @endforeach
                                </select>
                                <svg class="w-4 h-4 text-slate-500 pointer-events-none absolute right-3 top-1/2 -translate-y-1/2"
                                    fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    @if ($errors->any())
                        <div class="rounded-2xl bg-rose-50 border border-rose-200 p-4 text-xs text-rose-700"
                            role="alert">
                            <strong class="font-extrabold block mb-1">Periksa kembali isian berikut:</strong>
                            <ul class="list-disc pl-5 space-y-0.5 font-medium">
                                @foreach ($errors->all() as $message)
                                    <li>{{ $message }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </section>

                {{-- WORKSPACE 2 KOLOM --}}
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

                    {{-- =================================================================
                         PANEL KIRI: FLOWCHART DAN FORM GURU
                    ================================================================== --}}
                    <section
                        class="lg:col-span-5 min-w-0 bg-white/95 backdrop-blur-sm rounded-3xl border border-white shadow-soft-card p-6 sm:p-7 space-y-5">

                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-2xl bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-600 shrink-0">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M3 6a3 3 0 013-3h2.25a3 3 0 013 3v2.25a3 3 0 01-3 3H6a3 3 0 01-3-3V6zm9.75 0a3 3 0 013-3H18a3 3 0 013 3v2.25a3 3 0 01-3 3h-2.25a3 3 0 01-3-3V6zM3 15.75a3 3 0 013-3h2.25a3 3 0 013 3V18a3 3 0 01-3 3H6a3 3 0 01-3-3v-2.25zm9.75 0a3 3 0 013-3H18a3 3 0 013 3V18a3 3 0 01-3 3h-2.25a3 3 0 01-3-3v-2.25z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-base sm:text-lg font-extrabold text-slate-900">
                                    Flowchart & Pengaturan Soal
                                </h2>
                                <p class="text-xs text-slate-500">
                                    Diagram berubah mengikuti pengaturan yang diisi Guru.
                                </p>
                            </div>
                        </div>

                        {{-- DIAGRAM FLOWCHART LIVE --}}
                        <div
                            class="flex flex-col items-center p-5 rounded-2xl bg-gradient-to-b from-blue-50/80 to-indigo-50/50 border border-blue-100">

                            <div
                                class="px-7 py-1.5 rounded-full bg-white border border-blue-300 text-[11px] font-extrabold text-blue-700 shadow-2xs">
                                Mulai
                            </div>

                            <div class="w-0.5 h-5 bg-blue-300"></div>

                            <div
                                class="w-full max-w-[250px] p-3 rounded-2xl bg-white border-2 border-blue-200 text-center shadow-2xs">
                                <strong class="block text-[11px] font-extrabold text-slate-800">1 · Input Data</strong>
                                <small id="cg-node-input" class="block mt-1 text-xs font-bold text-blue-600 break-words">
                                    Masukkan bilangan
                                </small>
                            </div>

                            <div class="w-0.5 h-5 bg-blue-300"></div>

                            <div
                                class="w-full max-w-[250px] p-3 rounded-2xl bg-amber-50/90 border-2 border-amber-300 text-center shadow-2xs">
                                <strong class="block text-[11px] font-extrabold text-slate-800">2 · Kondisi IF</strong>
                                <small id="cg-node-condition"
                                    class="block mt-1 text-xs font-extrabold font-mono text-amber-800 break-words">
                                    bilangan % 2 == 0?
                                </small>
                            </div>

                            <div class="grid grid-cols-2 gap-3 w-full max-w-[360px] my-3.5">
                                <div class="min-w-0 text-center">
                                    <span
                                        class="inline-block px-3 py-0.5 mb-2 rounded-full bg-emerald-100 text-emerald-700 text-[10px] font-extrabold">
                                        Ya
                                    </span>

                                    <div
                                        class="w-full min-h-[76px] p-3 rounded-2xl bg-white border-2 border-emerald-200 text-center shadow-2xs">
                                        <strong class="block text-[11px] font-extrabold text-slate-800">3 · Output
                                            Ya</strong>
                                        <small id="cg-node-yes"
                                            class="block mt-1 text-xs font-bold text-emerald-700 break-words">
                                            Genap
                                        </small>
                                    </div>
                                </div>

                                <div class="min-w-0 text-center">
                                    <span
                                        class="inline-block px-3 py-0.5 mb-2 rounded-full bg-rose-100 text-rose-700 text-[10px] font-extrabold">
                                        Tidak
                                    </span>

                                    <div
                                        class="w-full min-h-[76px] p-3 rounded-2xl bg-white border-2 border-rose-200 text-center shadow-2xs">
                                        <strong class="block text-[11px] font-extrabold text-slate-800">4 · Output
                                            Tidak</strong>
                                        <small id="cg-node-no"
                                            class="block mt-1 text-xs font-bold text-rose-700 break-words">
                                            Ganjil
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <div class="w-0.5 h-5 bg-blue-300"></div>

                            <div
                                class="px-7 py-1.5 rounded-full bg-white border border-blue-300 text-[11px] font-extrabold text-blue-700 shadow-2xs">
                                Selesai
                            </div>

                        </div>

                        {{-- FORM PENGATURAN LOGIKA --}}
                        <div class="space-y-4">
                            <div>
                                <label for="cg-instruction" class="block text-xs font-extrabold text-slate-700 mb-1.5">
                                    Instruksi untuk Siswa
                                </label>
                                <textarea name="coding[instruction]" id="cg-instruction" rows="3" maxlength="1000" required
                                    class="w-full rounded-2xl bg-slate-50/85 border border-slate-200 px-4 py-3 text-xs font-semibold text-slate-800 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all">{{ $coding['instruction'] }}</textarea>
                            </div>

                            <div>
                                <label for="cg-variable" class="block text-xs font-extrabold text-slate-700 mb-1.5">
                                    Nama Variabel Python
                                </label>
                                <input name="coding[variable]" id="cg-variable" type="text"
                                    value="{{ $coding['variable'] }}" maxlength="40" pattern="[A-Za-z_][A-Za-z0-9_]*"
                                    placeholder="Contoh: bilangan" required
                                    class="w-full rounded-2xl bg-slate-50/85 border border-slate-200 px-4 py-3 text-xs font-mono font-bold text-slate-800 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all">
                                <small class="block text-[11px] text-slate-400 mt-1.5">
                                    Gunakan nama variabel tanpa spasi, misalnya <code
                                        class="text-blue-600 font-bold">bilangan</code>, <code
                                        class="text-blue-600 font-bold">nilai</code>, atau <code
                                        class="text-blue-600 font-bold">umur</code>.
                                </small>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                                <div>
                                    <label for="cg-condition" class="block text-xs font-extrabold text-slate-700 mb-1.5">
                                        Jenis Kondisi
                                    </label>
                                    <div class="relative">
                                        <select name="coding[condition]" id="cg-condition"
                                            class="w-full appearance-none rounded-2xl bg-slate-50/85 border border-slate-200 px-3.5 py-3 pr-9 text-xs font-semibold text-slate-800 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all cursor-pointer">
                                            <option value="even" @selected($coding['condition'] === 'even')>
                                                Bilangan Genap
                                            </option>

                                            <option value="odd" @selected($coding['condition'] === 'odd')>
                                                Bilangan Ganjil
                                            </option>

                                            <option value="gte" @selected($coding['condition'] === 'gte')>
                                                Lebih Besar / Sama Dengan
                                            </option>

                                            <option value="gt" @selected($coding['condition'] === 'gt')>
                                                Lebih Besar Dari
                                            </option>

                                            <option value="lte" @selected($coding['condition'] === 'lte')>
                                                Lebih Kecil / Sama Dengan
                                            </option>

                                            <option value="lt" @selected($coding['condition'] === 'lt')>
                                                Lebih Kecil Dari
                                            </option>
                                        </select>
                                        <svg class="w-3.5 h-3.5 text-slate-500 pointer-events-none absolute right-3 top-1/2 -translate-y-1/2"
                                            fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </div>
                                </div>

                                <div id="cg-threshold-wrap">
                                    <label for="cg-threshold" class="block text-xs font-extrabold text-slate-700 mb-1.5">
                                        Angka Pembanding
                                    </label>
                                    <input type="number" name="coding[threshold]" id="cg-threshold"
                                        value="{{ $coding['threshold'] }}" min="-1000000" max="1000000" step="1"
                                        class="w-full rounded-2xl bg-slate-50/85 border border-slate-200 px-3.5 py-3 text-xs font-bold text-slate-800 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                                <div>
                                    <label for="cg-yes" class="block text-xs font-extrabold text-slate-700 mb-1.5">
                                        Output Jika Benar (Ya)
                                    </label>
                                    <input name="coding[yes_output]" id="cg-yes" value="{{ $coding['yes_output'] }}"
                                        maxlength="100" placeholder="Contoh: Genap" required
                                        class="w-full rounded-2xl bg-slate-50/85 border border-slate-200 px-3.5 py-3 text-xs font-semibold text-slate-800 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all">
                                </div>

                                <div>
                                    <label for="cg-no" class="block text-xs font-extrabold text-slate-700 mb-1.5">
                                        Output Jika Salah (Tidak)
                                    </label>
                                    <input name="coding[no_output]" id="cg-no" value="{{ $coding['no_output'] }}"
                                        maxlength="100" placeholder="Contoh: Ganjil" required
                                        class="w-full rounded-2xl bg-slate-50/85 border border-slate-200 px-3.5 py-3 text-xs font-semibold text-slate-800 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all">
                                </div>
                            </div>
                        </div>

                    </section>

                    {{-- =================================================================
                         PANEL KANAN: PREVIEW TEMPLATE PYTHON & SIMULASI
                    ================================================================== --}}
                    <aside
                        class="lg:col-span-7 min-w-0 lg:sticky lg:top-24 bg-white/95 backdrop-blur-sm rounded-3xl border border-white shadow-soft-card p-6 sm:p-7 space-y-5">

                        <div class="flex items-center justify-between gap-3">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-2xl bg-sky-50 border border-sky-100 flex items-center justify-center text-sky-600 shrink-0">
                                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M2.25 6a3 3 0 013-3h13.5a3 3 0 013 3v12a3 3 0 01-3 3H5.25a3 3 0 01-3-3V6zm3.97.97a.75.75 0 011.06 0l2.25 2.25a.75.75 0 010 1.06l-2.25 2.25a.75.75 0 01-1.06-1.06l1.72-1.72-1.72-1.72a.75.75 0 010-1.06zm4.28 4.28a.75.75 0 000 1.5h3a.75.75 0 000-1.5h-3z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div>
                                    <h2 class="text-base sm:text-lg font-extrabold text-slate-900">
                                        Pratinjau Praktik Python
                                    </h2>
                                    <p class="text-xs text-slate-500">
                                        Kode kunci jawaban & simulasi eksekusi logika.
                                    </p>
                                </div>
                            </div>

                            <span
                                class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 border border-emerald-200 text-[11px] font-extrabold text-emerald-700 shrink-0">
                                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                <span>Live</span>
                            </span>
                        </div>

                        {{-- KOTAK INSTRUKSI SOAL --}}
                        <div class="rounded-2xl bg-blue-50/80 border border-blue-100 p-4 space-y-1.5">
                            <div class="flex items-center gap-1.5 text-xs font-extrabold text-blue-700">
                                <svg class="w-4 h-4 text-blue-600" viewBox="0 0 24 24" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm11.378-3.917c-.89-.777-2.366-.777-3.255 0a.75.75 0 01-.988-1.129c1.454-1.272 3.776-1.272 5.23 0 1.513 1.324 1.513 3.518 0 4.842a3.75 3.75 0 01-.837.552c-.676.328-1.028.774-1.028 1.152v.75a.75.75 0 01-1.5 0v-.75c0-1.279 1.06-2.107 1.875-2.502.182-.088.351-.199.503-.331.83-.727.83-1.857 0-2.584zM12 18a.75.75 0 100-1.5.75.75 0 000 1.5z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>Instruksi Soal</span>
                            </div>
                            <p id="cg-instruction-preview"
                                class="text-xs sm:text-sm text-slate-700 font-medium leading-relaxed whitespace-pre-wrap">
                            </p>
                        </div>

                        {{-- PREVIEW KODE PYTHON --}}
                        <div class="overflow-hidden rounded-2xl bg-slate-900 border border-slate-800 shadow-md">
                            <div
                                class="flex items-center justify-between gap-2 px-4 py-3 bg-slate-800/90 border-b border-slate-700/80 text-xs text-slate-400">
                                <div class="flex items-center gap-1.5">
                                    <span class="w-2.5 h-2.5 rounded-full bg-rose-400"></span>
                                    <span class="w-2.5 h-2.5 rounded-full bg-amber-300"></span>
                                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-400"></span>
                                    <b class="ml-2 font-mono text-slate-200">main.py</b>
                                </div>
                                <span class="text-[11px] font-semibold text-slate-400">Python 3 · Preview</span>
                            </div>

                            <div class="p-4 sm:p-5 overflow-x-auto font-mono text-xs sm:text-[13px] leading-8">
                                <div class="flex gap-4">
                                    <em class="w-4 shrink-0 text-slate-500 not-italic select-none">1</em>
                                    <code id="cg-line-one" class="text-emerald-300 whitespace-pre"></code>
                                </div>

                                <div class="flex gap-4">
                                    <em class="w-4 shrink-0 text-slate-500 not-italic select-none">2</em>
                                    <code id="cg-line-two" class="text-sky-300 whitespace-pre"></code>
                                </div>

                                <div class="flex gap-4">
                                    <em class="w-4 shrink-0 text-slate-500 not-italic select-none">3</em>
                                    <code id="cg-line-three" class="text-emerald-300 whitespace-pre"></code>
                                </div>

                                <div class="flex gap-4">
                                    <em class="w-4 shrink-0 text-slate-500 not-italic select-none">4</em>
                                    <code id="cg-line-four" class="text-sky-300 whitespace-pre">else:</code>
                                </div>

                                <div class="flex gap-4">
                                    <em class="w-4 shrink-0 text-slate-500 not-italic select-none">5</em>
                                    <code id="cg-line-five" class="text-emerald-300 whitespace-pre"></code>
                                </div>
                            </div>
                        </div>

                        {{-- SIMULASI OUTPUT --}}
                        <div class="rounded-2xl bg-slate-50/90 border border-slate-200/80 p-4 sm:p-5 space-y-3.5">
                            <div class="flex items-center justify-between gap-2">
                                <div class="flex items-center gap-1.5 text-xs font-extrabold text-slate-800">
                                    <svg class="w-4 h-4 text-blue-600" viewBox="0 0 24 24" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M4.5 5.653c0-1.426 1.529-2.33 2.779-1.643l11.54 6.348c1.295.712 1.295 2.573 0 3.285L7.28 19.991c-1.25.687-2.779-.217-2.779-1.643V5.653z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span>Simulasi Output</span>
                                </div>
                                <span class="text-[11px] font-bold text-slate-400">Pratinjau logika</span>
                            </div>

                            <div class="flex flex-wrap items-end gap-3">
                                <div class="w-full sm:w-52">
                                    <label for="cg-test-input" class="block text-xs font-extrabold text-slate-700 mb-1.5">
                                        Nilai Input Uji
                                    </label>
                                    <input type="number" id="cg-test-input" name="coding[test_input]"
                                        value="{{ $coding['test_input'] }}" min="-1000000" max="1000000"
                                        step="1" required
                                        class="w-full rounded-xl bg-white border border-slate-200 px-3.5 py-2.5 text-xs font-bold text-slate-800 focus:border-blue-500 outline-none">
                                </div>

                                <button type="button" id="cg-run"
                                    class="inline-flex items-center gap-2 rounded-full bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 text-xs font-extrabold shadow-soft-blue transition-all cursor-pointer">
                                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M4.5 5.653c0-1.426 1.529-2.33 2.779-1.643l11.54 6.348c1.295.712 1.295 2.573 0 3.285L7.28 19.991c-1.25.687-2.779-.217-2.779-1.643V5.653z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span>Jalankan Simulasi</span>
                                </button>
                            </div>

                            <pre id="cg-terminal"
                                class="min-h-[64px] p-4 rounded-2xl bg-slate-900 text-emerald-300 font-mono text-xs leading-relaxed whitespace-pre-wrap">Klik Jalankan Simulasi untuk melihat hasil.</pre>
                        </div>

                        <div
                            class="rounded-2xl bg-gradient-to-r from-blue-50 to-indigo-50/80 border border-blue-100 p-3.5 flex items-center gap-3.5">
                            <img src="{{ asset('images/mascot_think.png') }}" alt="Maskot memberi petunjuk"
                                class="w-14 h-14 object-contain shrink-0">
                            <p class="text-xs text-slate-600 font-medium leading-relaxed">
                                Guru menentukan kunci jawaban. Saat belajar nanti, siswa mengisi kode Python sendiri
                                melalui template Coding CodePawth.
                            </p>
                        </div>

                    </aside>

                </div>

                {{-- SIMPAN & TERBITKAN --}}
                <section
                    class="bg-white/95 backdrop-blur-sm rounded-3xl border border-white shadow-soft-card p-6 sm:p-7 flex flex-col md:flex-row md:items-center justify-between gap-5">
                    <div class="flex items-start sm:items-center gap-3.5">
                        <div
                            class="w-11 h-11 rounded-2xl bg-blue-50 border border-blue-100 flex items-center justify-center text-blue-600 shrink-0">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M9.315 7.584C12.195 3.883 16.695 1.5 21.75 1.5a.75.75 0 01.75.75c0 5.056-2.383 9.555-6.084 12.436A6.75 6.75 0 019.75 22.5a.75.75 0 01-.75-.75v-4.131A15.838 15.838 0 016.382 15H2.25a.75.75 0 01-.75-.75 6.75 6.75 0 017.815-6.666zM15 6.75a2.25 2.25 0 100 4.5 2.25 2.25 0 000-4.5z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-base sm:text-lg font-extrabold text-slate-900">
                                Simpan & Terbitkan
                            </h2>
                            <p class="text-xs text-slate-500 leading-relaxed">
                                Draft hanya dapat dilihat Guru. Materi terbit dapat dibuka oleh siswa anggota kelas
                                tujuan.
                            </p>
                        </div>
                    </div>

                    <div class="flex flex-wrap items-center gap-3 shrink-0">
                        <div class="relative min-w-[165px]">
                            <select name="status" aria-label="Status materi"
                                class="w-full appearance-none rounded-full bg-slate-50 border border-slate-200 px-4 py-2.5 pr-9 text-xs font-extrabold text-slate-800 focus:bg-white focus:border-blue-500 outline-none cursor-pointer">
                                <option value="draft" @selected(old('status', $material?->status ?? 'draft') === 'draft')>
                                    Simpan Draft
                                </option>

                                <option value="published" @selected(old('status', $material?->status ?? 'draft') === 'published')>
                                    Terbitkan
                                </option>
                            </select>
                            <svg class="w-3.5 h-3.5 text-slate-500 pointer-events-none absolute right-3.5 top-1/2 -translate-y-1/2"
                                fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>

                        <a href="{{ route('guru.studio') }}"
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
                            <span>Simpan Materi</span>
                        </button>
                    </div>
                </section>

            </form>

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            const field = id => document.getElementById(id);

            const operators = {
                even: '% 2 == 0',
                odd: '% 2 != 0',
                gte: '>=',
                gt: '>',
                lte: '<=',
                lt: '<'
            };

            // Baca seluruh pengaturan Guru.
            function getSpec() {

                const variable =
                    field('cg-variable').value.trim() || 'bilangan';

                const condition = field('cg-condition').value;

                const threshold =
                    Number(field('cg-threshold').value || 0);

                const yes = field('cg-yes').value;
                const no = field('cg-no').value;

                const expression = ['even', 'odd'].includes(condition) ?
                    `${variable} ${operators[condition]}` :
                    `${variable} ${operators[condition]} ${threshold}`;

                return {
                    variable,
                    condition,
                    threshold,
                    yes,
                    no,
                    expression
                };
            }

            // Update Flowchart + Preview Python.
            function updatePreview() {

                const data = getSpec();

                const isParity = ['even', 'odd'].includes(data.condition);

                field('cg-threshold-wrap').style.display =
                    isParity ? 'none' : 'block';

                field('cg-node-input').textContent =
                    `Masukkan ${data.variable}`;

                field('cg-node-condition').textContent =
                    data.expression + '?';

                field('cg-node-yes').textContent =
                    data.yes || 'Output jika benar';

                field('cg-node-no').textContent =
                    data.no || 'Output jika salah';

                field('cg-instruction-preview').textContent =
                    field('cg-instruction').value ||
                    'Isi instruksi untuk siswa...';

                field('cg-line-one').textContent =
                    `${data.variable} = int(input())`;

                field('cg-line-two').textContent =
                    `if ${data.expression}:`;

                field('cg-line-three').textContent =
                    `    print(${JSON.stringify(data.yes)})`;

                field('cg-line-four').textContent =
                    'else:';

                field('cg-line-five').textContent =
                    `    print(${JSON.stringify(data.no)})`;

                field('cg-terminal').textContent =
                    'Klik Jalankan Simulasi untuk melihat hasil.';
            }

            // Evaluasi kondisi tanpa mengeksekusi kode Python.
            function evaluate(data, value) {

                switch (data.condition) {
                    case 'even':
                        return value % 2 === 0;

                    case 'odd':
                        return value % 2 !== 0;

                    case 'gte':
                        return value >= data.threshold;

                    case 'gt':
                        return value > data.threshold;

                    case 'lte':
                        return value <= data.threshold;

                    case 'lt':
                        return value < data.threshold;
                }

                return false;
            }

            field('cg-run').addEventListener('click', () => {

                const input = field('cg-test-input');

                if (!input.reportValidity()) return;

                const value = Number(input.value);
                const data = getSpec();

                const output = evaluate(data, value) ?
                    data.yes :
                    data.no;

                field('cg-terminal').textContent =
                    `>>> Input uji: ${value}\n>>> Output: ${output}`;
            });

            // Update otomatis setiap Guru mengubah pengaturan.
            [
                'cg-instruction',
                'cg-variable',
                'cg-condition',
                'cg-threshold',
                'cg-yes',
                'cg-no'
            ].forEach(id => {

                field(id).addEventListener('input', updatePreview);
                field(id).addEventListener('change', updatePreview);
            });

            updatePreview();

        });
    </script>
@endpush
