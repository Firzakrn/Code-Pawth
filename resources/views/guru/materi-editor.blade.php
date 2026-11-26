@extends('layouts.app')

@section('title', 'Editor Materi Guru')

@php
    $isEdit = $material !== null;

    $templateNames = [
        'flashcard' => 'Flashcard Interaktif',
        'artikel' => 'Tulisan + Gambar',
        'foto' => 'Foto + Penjelasan',
    ];

    $templateMascots = [
        'flashcard' => 'mascot_card.png',
        'artikel' => 'mascot_dashboard.png',
        'foto' => 'mascot_what.png',
    ];

    $initialCards = old('cards', $material?->content['cards'] ?? []);

    $initialBlocks = old('blocks', $material?->content['blocks'] ?? []);
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
                 KONTEN UTAMA EDITOR MATERI
            ====================================================================== -->
        <div class="relative z-10 w-full max-w-7xl mx-auto px-5 sm:px-8 py-6 space-y-6">

            {{-- NAVIGASI / BREADCRUMB --}}
            <nav class="flex items-center gap-2 text-xs font-bold text-slate-400">
                <a href="{{ route('guru.studio') }}"
                    class="inline-flex items-center gap-1.5 text-blue-600 hover:text-blue-700 transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                    <span>Studio Konten</span>
                </a>
                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2.5"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
                <span class="text-slate-700">{{ $templateNames[$type] }}</span>
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
                            <path
                                d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32l8.4-8.4z" />
                            <path
                                d="M5.25 5.25a3 3 0 00-3 3v10.5a3 3 0 003 3h10.5a3 3 0 003-3V13.5a.75.75 0 00-1.5 0v5.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5V8.25a1.5 1.5 0 011.5-1.5h5.25a.75.75 0 000-1.5H5.25z" />
                        </svg>
                        <span>STUDIO KONTEN GURU</span>
                    </div>

                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-slate-900">
                        {{ $isEdit ? 'Edit' : 'Buat' }}
                        <span class="text-blue-600">{{ $templateNames[$type] }}</span>
                    </h1>

                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed max-w-xl">
                        Isi materi di sebelah kiri dan lihat hasilnya secara langsung di sebelah kanan.
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
                    <img src="{{ asset('images/' . $templateMascots[$type]) }}" alt="Maskot editor CodePawth"
                        class="w-36 h-36 sm:w-44 sm:h-44 object-contain drop-shadow-sm">
                </div>
            </header>

            {{-- FORM UTAMA --}}
            <form id="materialForm" method="POST"
                action="{{ $isEdit ? route('guru.materi.update', $material) : route('guru.materi.store') }}"
                enctype="multipart/form-data">
                @csrf

                @if ($isEdit)
                    @method('PUT')
                @endif

                <input type="hidden" name="type" value="{{ $type }}">

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

                    {{-- =================================================================
                         KOLOM KIRI: FORM EDITOR
                    ================================================================== --}}
                    <div class="lg:col-span-7 space-y-6">

                        {{-- PANEL 1: INFORMASI MATERI --}}
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
                                        Tentukan judul, jenjang, dan kelas tujuan materi.
                                    </p>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <label for="title" class="block text-xs font-extrabold text-slate-700 mb-1.5">
                                        Judul Materi
                                    </label>
                                    <input id="title" name="title" type="text" maxlength="255"
                                        placeholder="Contoh: Kenalan dengan Python"
                                        value="{{ old('title', $material?->title) }}" required
                                        class="w-full rounded-2xl bg-slate-50/85 border border-slate-200 px-4 py-3 text-xs sm:text-sm font-semibold text-slate-800 placeholder:text-slate-400 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all">
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label for="level" class="block text-xs font-extrabold text-slate-700 mb-1.5">
                                            Jenjang
                                        </label>
                                        <div class="relative">
                                            <select id="level" name="level" required
                                                class="w-full appearance-none rounded-2xl bg-slate-50/85 border border-slate-200 px-4 py-3 pr-10 text-xs sm:text-sm font-semibold text-slate-800 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all cursor-pointer">
                                                @foreach (['SD', 'SMP', 'SMA'] as $level)
                                                    <option value="{{ $level }}" @selected(old('level', $material?->level ?? 'SD') === $level)>
                                                        {{ $level }}
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
                                        <label for="learning_class_id"
                                            class="block text-xs font-extrabold text-slate-700 mb-1.5">
                                            Kelas Tujuan
                                        </label>
                                        <div class="relative">
                                            <select id="learning_class_id" name="learning_class_id"
                                                class="w-full appearance-none rounded-2xl bg-slate-50/85 border border-slate-200 px-4 py-3 pr-10 text-xs sm:text-sm font-semibold text-slate-800 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all cursor-pointer">
                                                <option value="">
                                                    Belum memilih kelas
                                                </option>

                                                @foreach ($classes as $class)
                                                    <option value="{{ $class->id }}" @selected((string) old('learning_class_id', $material?->learning_class_id ?? request('class_id')) === (string) $class->id)>
                                                        {{ $class->name }} ({{ $class->level }})
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
                            </div>

                            <div
                                class="rounded-2xl bg-blue-50/75 border border-blue-100 px-4 py-3 flex items-start gap-2.5 text-xs text-slate-600 leading-relaxed">
                                <svg class="w-4 h-4 text-blue-600 shrink-0 mt-0.5" viewBox="0 0 24 24"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 01.67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 11-.671-1.34l.041-.022zM12 9a.75.75 0 100-1.5.75.75 0 000 1.5z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>
                                    Materi yang belum memiliki kelas hanya bisa dilihat oleh Guru. Siswa dapat melihatnya
                                    setelah materi diterbitkan ke kelas.
                                </span>
                            </div>
                        </section>

                        {{-- PANEL 2: ITEM DINAMIS (KARTU / BAGIAN) --}}
                        <section
                            class="bg-white/95 backdrop-blur-sm rounded-3xl border border-white shadow-soft-card p-6 sm:p-7 space-y-4">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-2xl bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-600 shrink-0">
                                    @if ($type === 'flashcard')
                                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                            <path
                                                d="M16.5 6a3 3 0 00-3-3H6a3 3 0 00-3 3v7.5a3 3 0 003 3v-6A4.5 4.5 0 0110.5 6h6z" />
                                            <path
                                                d="M18 7.5a3 3 0 013 3V18a3 3 0 01-3 3h-7.5a3 3 0 01-3-3v-7.5a3 3 0 013-3H18z" />
                                        </svg>
                                    @else
                                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                            <path
                                                d="M11.25 4.533A9.707 9.707 0 006 3a9.735 9.735 0 00-3.25.555.75.75 0 00-.5.707v14.25a.75.75 0 001 .707A8.237 8.237 0 016 18.75c1.995 0 3.823.707 5.25 1.886V4.533zM12.75 20.636A8.214 8.214 0 0118 18.75c.966 0 1.89.166 2.75.47a.75.75 0 001-.708V4.262a.75.75 0 00-.5-.707A9.735 9.735 0 0018 3a9.707 9.707 0 00-5.25 1.533v16.103z" />
                                        </svg>
                                    @endif
                                </div>
                                <div>
                                    <h2 class="text-base sm:text-lg font-extrabold text-slate-900">
                                        {{ $type === 'flashcard' ? 'Isi Kartu Flashcard' : 'Isi Bagian Materi' }}
                                    </h2>
                                    <p class="text-xs text-slate-500">
                                        @if ($type === 'flashcard')
                                            Setiap kartu mempunyai sisi depan dan belakang, sama seperti Flashcard siswa
                                            yang
                                            sudah ada.
                                        @elseif ($type === 'artikel')
                                            Tambahkan judul, paragraf, dan gambar bila diperlukan.
                                        @else
                                            Setiap bagian wajib memiliki gambar beserta penjelasannya.
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <div id="editorItems" class="space-y-4"></div>

                            <button type="button" id="addItem"
                                class="w-full rounded-2xl border-2 border-dashed border-blue-200 bg-blue-50/60 hover:bg-blue-100/70 hover:border-blue-400 text-blue-700 py-3.5 px-4 text-xs font-extrabold inline-flex items-center justify-center gap-2 transition-all cursor-pointer">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.8"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                <span>{{ $type === 'flashcard' ? 'Tambah Kartu' : 'Tambah Bagian Materi' }}</span>
                            </button>
                        </section>

                        {{-- PANEL 3: PENGATURAN PUBLIKASI --}}
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
                                        Simpan sebagai draft atau langsung terbitkan ke kelas.
                                    </p>
                                </div>
                            </div>

                            <div>
                                <label for="status" class="block text-xs font-extrabold text-slate-700 mb-1.5">
                                    Status Materi
                                </label>
                                <div class="relative">
                                    <select name="status" id="status"
                                        class="w-full appearance-none rounded-2xl bg-slate-50/85 border border-slate-200 px-4 py-3 pr-10 text-xs sm:text-sm font-semibold text-slate-800 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all cursor-pointer">
                                        <option value="draft" @selected(old('status', $material?->status ?? 'draft') === 'draft')>
                                            Simpan sebagai Draft
                                        </option>

                                        <option value="published" @selected(old('status', $material?->status ?? 'draft') === 'published')>
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

                    </div>

                    {{-- =================================================================
                         KOLOM KANAN: LIVE PREVIEW
                    ================================================================== --}}
                    <aside class="lg:col-span-5 min-w-0">
                        <section
                            class="lg:sticky lg:top-24 bg-white/95 backdrop-blur-sm rounded-3xl border border-white shadow-soft-card p-6 sm:p-7 space-y-5">

                            <div class="flex items-center justify-between gap-3">
                                <div>
                                    <span class="text-[11px] font-extrabold uppercase tracking-wider text-blue-600">
                                        LIVE PREVIEW
                                    </span>
                                    <h2 class="text-lg sm:text-xl font-extrabold text-slate-900 mt-0.5">
                                        Pratinjau Materi
                                    </h2>
                                </div>

                                <span
                                    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 border border-emerald-200 text-[11px] font-extrabold text-emerald-700 shrink-0">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                    <span>Langsung</span>
                                </span>
                            </div>

                            <div
                                class="flex items-center justify-between gap-3 rounded-2xl bg-slate-50/90 border border-slate-200/80 px-4 py-3">
                                <strong id="previewTitle"
                                    class="text-xs sm:text-sm font-extrabold text-slate-800 break-words">
                                    Judul Materi
                                </strong>
                                <span id="previewLevel"
                                    class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-[11px] font-extrabold shrink-0">
                                    SD
                                </span>
                            </div>

                            @if ($type === 'flashcard')
                                <div class="editor-card-scene" id="cardScene" role="button" tabindex="0"
                                    aria-label="Balik kartu pratinjau">

                                    <div class="editor-card-inner" id="cardInner">

                                        {{-- SISI DEPAN --}}
                                        <div class="editor-card-face editor-card-front">
                                            <div class="editor-card-top">
                                                <span id="cardLabel">
                                                    Konsep Dasar
                                                </span>

                                                <span class="inline-flex items-center gap-1 text-blue-600">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                        stroke-width="2.5" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                                                    </svg>
                                                    <span>Klik balik</span>
                                                </span>
                                            </div>

                                            <div class="editor-card-middle">
                                                <div class="min-w-0">
                                                    <small>SISI DEPAN</small>
                                                    <h3 id="cardFront">print()</h3>
                                                    <p id="cardFrontNote">Perintah dasar Python</p>
                                                </div>

                                                <img src="{{ asset('images/mascot_dashboard.png') }}"
                                                    alt="Maskot Flashcard">
                                            </div>

                                            <small>Ketuk kartu untuk melihat pasangan</small>
                                        </div>

                                        {{-- SISI BELAKANG --}}
                                        <div class="editor-card-face editor-card-back">
                                            <div class="editor-card-top">
                                                <span>Penjelasan Kartu</span>

                                                <span class="inline-flex items-center gap-1 text-blue-100">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                        stroke-width="2.5" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                                                    </svg>
                                                    <span>Balik</span>
                                                </span>
                                            </div>

                                            <div class="editor-card-back-content">
                                                <small>SISI BELAKANG</small>
                                                <h3 id="cardBack">Menampilkan teks</h3>
                                                <p id="cardBackNote">Contoh: print("Halo!")</p>
                                            </div>

                                            <small>Pasangan konsep dan penjelasan</small>
                                        </div>

                                    </div>
                                </div>

                                <div class="flex items-center justify-between gap-3 pt-1">
                                    <button type="button" id="prevCard"
                                        class="inline-flex items-center gap-1.5 rounded-full bg-blue-50 hover:bg-blue-600 text-blue-700 hover:text-white border border-blue-100 px-3.5 py-2 text-[11px] font-extrabold transition-all cursor-pointer disabled:opacity-40 disabled:pointer-events-none">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.75 19.5L8.25 12l7.5-7.5" />
                                        </svg>
                                        <span>Sebelumnya</span>
                                    </button>

                                    <strong id="cardCounter" class="text-xs font-extrabold text-slate-700">1 / 1</strong>

                                    <button type="button" id="nextCard"
                                        class="inline-flex items-center gap-1.5 rounded-full bg-blue-50 hover:bg-blue-600 text-blue-700 hover:text-white border border-blue-100 px-3.5 py-2 text-[11px] font-extrabold transition-all cursor-pointer disabled:opacity-40 disabled:pointer-events-none">
                                        <span>Berikutnya</span>
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                        </svg>
                                    </button>
                                </div>
                            @else
                                <div id="articlePreview"
                                    class="max-h-[560px] overflow-y-auto rounded-2xl bg-slate-50/90 border border-slate-200/80 p-5 space-y-5">
                                </div>
                            @endif

                            <div
                                class="rounded-2xl bg-gradient-to-r from-blue-50 to-indigo-50/80 border border-blue-100 p-3.5 flex items-center gap-3.5">
                                <img src="{{ asset('images/mascot_think.png') }}" alt="Maskot memberikan saran"
                                    class="w-14 h-14 object-contain shrink-0">
                                <p class="text-xs text-slate-600 font-medium leading-relaxed">
                                    Lihat hasil materi di sini sebelum menyimpannya, ya!
                                </p>
                            </div>

                        </section>
                    </aside>

                </div>

            </form>

        </div>
    </div>

    {{-- =====================================================================
         TEMPLATE KARTU FLASHCARD
    ====================================================================== --}}
    <template id="flashcardTemplate">
        <div class="editor-unit rounded-2xl bg-slate-50/90 border border-slate-200/90 p-5 space-y-4" data-unit="card">

            <div class="flex items-center justify-between gap-3">
                <strong class="unit-number text-sm font-extrabold text-blue-700">Kartu</strong>

                <button type="button"
                    class="inline-flex items-center gap-1.5 rounded-full bg-rose-50 hover:bg-rose-600 text-rose-600 hover:text-white border border-rose-200 hover:border-rose-600 px-3 py-1.5 text-[11px] font-extrabold transition-all cursor-pointer"
                    data-remove>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                    </svg>
                    <span>Hapus</span>
                </button>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                <div>
                    <label class="block text-xs font-extrabold text-slate-700 mb-1">Kategori Kartu</label>
                    <input name="cards[__INDEX__][label]" data-key="label" placeholder="Contoh: Fungsi Output"
                        maxlength="100"
                        class="w-full rounded-xl bg-white border border-slate-200 px-3.5 py-2.5 text-xs font-semibold text-slate-800 focus:border-blue-500 outline-none">
                </div>

                <div>
                    <label class="block text-xs font-extrabold text-slate-700 mb-1">Ikon Konsep</label>
                    <div class="relative">
                        <select name="cards[__INDEX__][icon]" data-key="icon"
                            class="w-full appearance-none rounded-xl bg-white border border-slate-200 px-3.5 py-2.5 pr-9 text-xs font-semibold text-slate-800 focus:border-blue-500 outline-none cursor-pointer">
                            <option value="monitor">Output / Monitor</option>
                            <option value="keyboard">Input / Keyboard</option>
                            <option value="text">Teks</option>
                            <option value="number">Angka</option>
                            <option value="box">Variabel</option>
                            <option value="loop">Perulangan</option>
                            <option value="branch">Percabangan</option>
                            <option value="note">Catatan</option>
                        </select>
                        <svg class="w-3.5 h-3.5 text-slate-500 pointer-events-none absolute right-3 top-1/2 -translate-y-1/2"
                            fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="pt-1 flex items-center gap-2 text-[11px] font-extrabold uppercase tracking-wider text-blue-600">
                <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                <span>SISI DEPAN</span>
            </div>

            <div>
                <label class="block text-xs font-extrabold text-slate-700 mb-1">Konsep / Kode</label>
                <input name="cards[__INDEX__][front]" data-key="front" placeholder="Contoh: print()" maxlength="500"
                    required
                    class="w-full rounded-xl bg-white border border-slate-200 px-3.5 py-2.5 text-xs font-semibold text-slate-800 focus:border-blue-500 outline-none">
            </div>

            <div>
                <label class="block text-xs font-extrabold text-slate-700 mb-1">Penjelasan Singkat Depan</label>
                <textarea name="cards[__INDEX__][front_note]" data-key="front_note" rows="2" maxlength="500"
                    placeholder="Perintah dasar Python..."
                    class="w-full rounded-xl bg-white border border-slate-200 px-3.5 py-2.5 text-xs font-semibold text-slate-800 focus:border-blue-500 outline-none"></textarea>
            </div>

            <div class="pt-1 flex items-center gap-2 text-[11px] font-extrabold uppercase tracking-wider text-indigo-600">
                <span class="w-2 h-2 rounded-full bg-indigo-600"></span>
                <span>SISI BELAKANG</span>
            </div>

            <div>
                <label class="block text-xs font-extrabold text-slate-700 mb-1">Jawaban / Pengertian</label>
                <textarea name="cards[__INDEX__][back]" data-key="back" rows="2" maxlength="1000"
                    placeholder="Menampilkan teks ke layar" required
                    class="w-full rounded-xl bg-white border border-slate-200 px-3.5 py-2.5 text-xs font-semibold text-slate-800 focus:border-blue-500 outline-none"></textarea>
            </div>

            <div>
                <label class="block text-xs font-extrabold text-slate-700 mb-1">Contoh / Catatan Tambahan</label>
                <textarea name="cards[__INDEX__][back_note]" data-key="back_note" rows="2" maxlength="500"
                    placeholder='Contoh: print("Halo!")'
                    class="w-full rounded-xl bg-white border border-slate-200 px-3.5 py-2.5 text-xs font-semibold text-slate-800 focus:border-blue-500 outline-none"></textarea>
            </div>

        </div>
    </template>

    {{-- =====================================================================
         TEMPLATE BAGIAN ARTIKEL / FOTO
    ====================================================================== --}}
    <template id="blockTemplate">
        <div class="editor-unit rounded-2xl bg-slate-50/90 border border-slate-200/90 p-5 space-y-4" data-unit="block">

            <div class="flex items-center justify-between gap-3">
                <strong class="unit-number text-sm font-extrabold text-blue-700">Bagian</strong>

                <button type="button"
                    class="inline-flex items-center gap-1.5 rounded-full bg-rose-50 hover:bg-rose-600 text-rose-600 hover:text-white border border-rose-200 hover:border-rose-600 px-3 py-1.5 text-[11px] font-extrabold transition-all cursor-pointer"
                    data-remove>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                    </svg>
                    <span>Hapus</span>
                </button>
            </div>

            <div>
                <label class="block text-xs font-extrabold text-slate-700 mb-1">Judul Bagian</label>
                <input name="blocks[__INDEX__][heading]" data-key="heading" placeholder="Contoh: Apa itu algoritma?"
                    maxlength="255" required
                    class="w-full rounded-xl bg-white border border-slate-200 px-3.5 py-2.5 text-xs font-semibold text-slate-800 focus:border-blue-500 outline-none">
            </div>

            <div>
                <label class="block text-xs font-extrabold text-slate-700 mb-1">Penjelasan Materi</label>
                <textarea name="blocks[__INDEX__][body]" data-key="body" rows="5" maxlength="10000"
                    placeholder="Tulis penjelasan materi di sini..." required
                    class="w-full rounded-xl bg-white border border-slate-200 px-3.5 py-2.5 text-xs font-semibold text-slate-800 focus:border-blue-500 outline-none"></textarea>
            </div>

            <div>
                <label class="block text-xs font-extrabold text-slate-700 mb-1">
                    Gambar
                    <span class="font-medium text-slate-400">
                        (JPG / PNG / WebP, maksimal 4 MB)
                    </span>
                </label>

                <input type="file" name="blocks[__INDEX__][image]" data-key="image_file"
                    accept="image/png,image/jpeg,image/webp"
                    class="block w-full text-xs text-slate-600 file:mr-3 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-extrabold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">

                <input type="hidden" name="blocks[__INDEX__][existing_image]" data-key="existing_image">

                <img class="editor-upload-preview mt-3 max-h-40 rounded-xl border border-slate-200 bg-white object-contain"
                    data-image-preview alt="Pratinjau gambar unggahan" hidden>
            </div>

            <div>
                <label class="block text-xs font-extrabold text-slate-700 mb-1">Caption Gambar</label>
                <input name="blocks[__INDEX__][caption]" data-key="caption" maxlength="255"
                    placeholder="Keterangan gambar (opsional)"
                    class="w-full rounded-xl bg-white border border-slate-200 px-3.5 py-2.5 text-xs font-semibold text-slate-800 focus:border-blue-500 outline-none">
            </div>

        </div>
    </template>
@endsection

@push('styles')
    <style>
        [hidden] {
            display: none !important;
        }

        /* FLASHCARD 3D FLIP PREVIEW */
        .editor-card-scene {
            height: 300px;
            perspective: 1100px;
            cursor: pointer;
            border-radius: 22px;
        }

        .editor-card-inner {
            position: relative;
            width: 100%;
            height: 100%;
            transform-style: preserve-3d;
            transition: transform .55s ease;
        }

        .editor-card-inner.is-flipped {
            transform: rotateY(180deg);
        }

        .editor-card-face {
            position: absolute;
            inset: 0;
            border-radius: 22px;
            border: 2px solid #DBEAFE;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            backface-visibility: hidden;
            -webkit-backface-visibility: hidden;
            overflow: hidden;
        }

        .editor-card-front {
            background: linear-gradient(140deg, #EFF6FF, #FFFFFF, #E0E7FF);
        }

        .editor-card-back {
            background: linear-gradient(140deg, #2563EB, #4338CA);
            color: #FFFFFF;
            border-color: #3B82F6;
            transform: rotateY(180deg);
        }

        .editor-card-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            font-size: 10px;
            font-weight: 800;
        }

        .editor-card-front .editor-card-top span:first-child {
            padding: 6px 12px;
            border-radius: 9999px;
            background: #2563EB;
            color: #FFFFFF;
        }

        .editor-card-back .editor-card-top span:first-child {
            padding: 6px 12px;
            border-radius: 9999px;
            background: rgba(255, 255, 255, .18);
        }

        .editor-card-middle {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .editor-card-middle img {
            width: 110px;
            height: 110px;
            object-fit: contain;
            flex-shrink: 0;
        }

        .editor-card-middle small,
        .editor-card-back-content small {
            font-weight: 800;
            font-size: 10px;
            letter-spacing: 0.06em;
            color: #2563EB;
        }

        .editor-card-back-content small {
            color: #C7D2FE;
        }

        .editor-card-middle h3,
        .editor-card-back-content h3 {
            font-size: 22px;
            font-weight: 800;
            margin: 8px 0;
            overflow-wrap: anywhere;
        }

        .editor-card-middle p,
        .editor-card-back-content p {
            font-size: 12px;
            line-height: 1.65;
            overflow-wrap: anywhere;
        }

        .editor-card-scene .editor-card-face>small {
            font-size: 10px;
            font-weight: 600;
            color: #64748B;
        }

        .editor-card-back>small {
            color: #C7D2FE !important;
        }

        .editor-card-back-content {
            margin: auto 0;
        }

        /* PREVIEW ARTIKEL DAN FOTO */
        .editor-preview-block {
            padding-bottom: 18px;
            border-bottom: 1px solid #E2E8F0;
        }

        .editor-preview-block:last-child {
            padding-bottom: 0;
            border-bottom: 0;
        }

        .editor-preview-block h3 {
            font-size: 15px;
            font-weight: 800;
            color: #0F172A;
            margin-bottom: 8px;
        }

        .editor-preview-block p {
            white-space: pre-wrap;
            overflow-wrap: anywhere;
            color: #475569;
            font-size: 12px;
            line-height: 1.8;
        }

        .editor-preview-block img {
            width: 100%;
            max-height: 230px;
            margin-top: 10px;
            margin-bottom: 10px;
            border-radius: 14px;
            border: 1px solid #E2E8F0;
            object-fit: contain;
            background: #FFFFFF;
        }

        .editor-preview-block small {
            display: block;
            margin-top: 6px;
            font-size: 11px;
            font-weight: 600;
            color: #64748B;
        }

        @media(prefers-reduced-motion: reduce) {
            .editor-card-inner {
                transition: none;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            const type = @json($type);
            const initialCards = @json(array_values($initialCards));
            const initialBlocks = @json(array_values($initialBlocks));
            const storageBase = @json(asset('storage'));

            const items = document.getElementById('editorItems');
            const form = document.getElementById('materialForm');

            let nextIndex = 0;
            let activeCard = 0;
            let flipped = false;

            const fileUrls = new WeakMap();

            function getImageUrl(file) {
                if (!fileUrls.has(file)) {
                    fileUrls.set(file, URL.createObjectURL(file));
                }
                return fileUrls.get(file);
            }

            // =====================================
            // TAMBAH KARTU FLASHCARD
            // =====================================

            function addCard(data = {}) {
                const index = nextIndex++;

                const template = document.getElementById(
                    'flashcardTemplate'
                );

                const fragment = template.content.cloneNode(true);
                const unit = fragment.querySelector('.editor-unit');

                unit.querySelectorAll('[name]').forEach(field => {
                    field.name = field.name.replace('__INDEX__', index);
                });

                const keys = [
                    'label',
                    'front',
                    'front_note',
                    'back',
                    'back_note',
                    'icon'
                ];

                keys.forEach(key => {
                    const field = unit.querySelector(
                        `[data-key="${key}"]`
                    );

                    if (field && data[key] !== undefined) {
                        field.value = data[key];
                    }
                });

                items.appendChild(unit);
                refreshNumbers();
                renderPreview();
            }

            // =====================================
            // TAMBAH BLOK ARTIKEL / FOTO
            // =====================================

            function addBlock(data = {}) {
                const index = nextIndex++;

                const template = document.getElementById(
                    'blockTemplate'
                );

                const fragment = template.content.cloneNode(true);
                const unit = fragment.querySelector('.editor-unit');

                unit.querySelectorAll('[name]').forEach(field => {
                    field.name = field.name.replace('__INDEX__', index);
                });

                ['heading', 'body', 'caption'].forEach(key => {
                    const field = unit.querySelector(
                        `[data-key="${key}"]`
                    );

                    if (field && data[key] !== undefined) {
                        field.value = data[key];
                    }
                });

                const oldImage =
                    data.image || data.existing_image || '';

                const hiddenImage = unit.querySelector(
                    '[data-key="existing_image"]'
                );

                hiddenImage.value = oldImage;

                const preview = unit.querySelector(
                    '[data-image-preview]'
                );

                if (oldImage) {
                    preview.src = storageBase + '/' + oldImage;
                    preview.hidden = false;
                }

                if (type === 'foto') {
                    unit.querySelector(
                        '[data-key="image_file"]'
                    ).setAttribute('aria-required', 'true');
                }

                items.appendChild(unit);
                refreshNumbers();
                renderPreview();
            }

            // =====================================
            // NOMOR BAGIAN
            // =====================================

            function refreshNumbers() {
                const units = [...items.querySelectorAll(
                    '.editor-unit'
                )];

                units.forEach((unit, index) => {
                    unit.querySelector('.unit-number').textContent =
                        type === 'flashcard' ?
                        `Kartu ${index + 1}` :
                        `Bagian ${index + 1}`;
                });
            }

            // =====================================
            // DATA PREVIEW
            // =====================================

            function getUnitsData() {
                return [...items.querySelectorAll(
                    '.editor-unit'
                )].map(unit => {

                    const data = {};

                    unit.querySelectorAll('[data-key]').forEach(field => {
                        data[field.dataset.key] = field.value;
                    });

                    const input = unit.querySelector(
                        '[data-key="image_file"]'
                    );

                    if (input?.files?.[0]) {
                        data.previewImage = getImageUrl(input.files[0]);
                    } else if (data.existing_image) {
                        data.previewImage =
                            storageBase + '/' + data.existing_image;
                    }

                    return data;
                });
            }

            // =====================================
            // FLASHCARD LIVE PREVIEW
            // =====================================

            function renderFlashcardPreview(cards) {
                if (!cards.length) return;

                activeCard = Math.max(
                    0,
                    Math.min(activeCard, cards.length - 1)
                );

                const card = cards[activeCard];

                document.getElementById('cardLabel').textContent =
                    card.label || 'Konsep Dasar';

                document.getElementById('cardFront').textContent =
                    card.front || 'Isi sisi depan...';

                document.getElementById('cardFrontNote').textContent =
                    card.front_note || 'Penjelasan singkat';

                document.getElementById('cardBack').textContent =
                    card.back || 'Isi sisi belakang...';

                document.getElementById('cardBackNote').textContent =
                    card.back_note || 'Contoh penggunaan';

                document.getElementById('cardCounter').textContent =
                    `${activeCard + 1} / ${cards.length}`;

                document.getElementById('prevCard').disabled =
                    activeCard === 0;

                document.getElementById('nextCard').disabled =
                    activeCard === cards.length - 1;

                document.getElementById('cardInner')
                    .classList.toggle('is-flipped', flipped);
            }

            // =====================================
            // ARTIKEL / FOTO LIVE PREVIEW
            // =====================================

            function renderArticlePreview(blocks) {
                const container = document.getElementById(
                    'articlePreview'
                );

                container.replaceChildren();

                blocks.forEach(block => {

                    const section = document.createElement('section');
                    section.className = 'editor-preview-block';

                    const heading = document.createElement('h3');
                    heading.textContent =
                        block.heading || 'Judul Bagian';

                    section.appendChild(heading);

                    if (block.previewImage) {
                        const image = document.createElement('img');
                        image.src = block.previewImage;
                        image.alt = block.caption || 'Gambar materi';

                        section.appendChild(image);
                    }

                    const paragraph = document.createElement('p');
                    paragraph.textContent =
                        block.body || 'Penjelasan materi...';

                    section.appendChild(paragraph);

                    if (block.caption) {
                        const caption = document.createElement('small');
                        caption.textContent = block.caption;
                        section.appendChild(caption);
                    }

                    container.appendChild(section);
                });
            }

            // =====================================
            // UPDATE PREVIEW
            // =====================================

            function renderPreview() {
                document.getElementById('previewTitle').textContent =
                    document.getElementById('title').value ||
                    'Judul Materi';

                document.getElementById('previewLevel').textContent =
                    document.getElementById('level').value;

                const data = getUnitsData();

                if (type === 'flashcard') {
                    renderFlashcardPreview(data);
                } else {
                    renderArticlePreview(data);
                }
            }

            // =====================================
            // EVENT
            // =====================================

            document.getElementById('addItem')
                .addEventListener('click', () => {

                    if (items.children.length >= (
                            type === 'flashcard' ? 50 : 20
                        )) {
                        alert('Batas jumlah bagian sudah tercapai.');
                        return;
                    }

                    if (type === 'flashcard') {
                        addCard();
                    } else {
                        addBlock();
                    }
                });

            items.addEventListener('click', event => {
                const button = event.target.closest('[data-remove]');

                if (!button) return;

                if (items.children.length <= 1) {
                    alert('Minimal harus ada satu bagian materi.');
                    return;
                }

                button.closest('.editor-unit').remove();

                activeCard = 0;
                flipped = false;

                refreshNumbers();
                renderPreview();
            });

            items.addEventListener('input', renderPreview);

            items.addEventListener('change', event => {

                if (event.target.matches(
                        '[data-key="image_file"]'
                    )) {
                    const unit = event.target.closest('.editor-unit');
                    const preview = unit.querySelector(
                        '[data-image-preview]'
                    );

                    const file = event.target.files?.[0];

                    if (file) {
                        preview.src = getImageUrl(file);
                        preview.hidden = false;
                    } else {
                        const oldPath = unit.querySelector(
                            '[data-key="existing_image"]'
                        ).value;

                        preview.src = oldPath ?
                            storageBase + '/' + oldPath :
                            '';

                        preview.hidden = !oldPath;
                    }
                }

                renderPreview();
            });

            ['title', 'level'].forEach(id => {
                document.getElementById(id)
                    .addEventListener('input', renderPreview);
            });

            if (type === 'flashcard') {

                function flipPreview() {
                    flipped = !flipped;
                    document.getElementById('cardInner')
                        .classList.toggle('is-flipped', flipped);
                }

                const scene = document.getElementById('cardScene');

                scene.addEventListener('click', flipPreview);

                scene.addEventListener('keydown', event => {
                    if (event.key === 'Enter' || event.key === ' ') {
                        event.preventDefault();
                        flipPreview();
                    }
                });

                document.getElementById('prevCard')
                    .addEventListener('click', () => {
                        if (activeCard > 0) {
                            activeCard--;
                            flipped = false;
                            renderPreview();
                        }
                    });

                document.getElementById('nextCard')
                    .addEventListener('click', () => {
                        if (activeCard < items.children.length - 1) {
                            activeCard++;
                            flipped = false;
                            renderPreview();
                        }
                    });
            }

            // =====================================
            // MUAT DATA LAMA ATAU DEFAULT
            // =====================================

            if (type === 'flashcard') {

                if (initialCards.length) {
                    initialCards.forEach(card => addCard(card));
                } else {
                    addCard({
                        label: 'Fungsi Output',
                        icon: 'monitor',
                        front: 'print()',
                        front_note: 'Perintah dasar Python',
                        back: 'Menampilkan teks atau hasil ke layar',
                        back_note: 'Contoh: print("Halo, CodePawth!")',
                    });
                }

            } else {

                if (initialBlocks.length) {
                    initialBlocks.forEach(block => addBlock(block));
                } else {
                    addBlock();
                }
            }

            // Pemeriksaan sederhana sebelum dikirim
            form.addEventListener('submit', event => {
                if (!form.reportValidity()) {
                    event.preventDefault();
                    return;
                }

                if (type === 'foto') {
                    const units = items.querySelectorAll('.editor-unit');

                    for (const unit of units) {
                        const file = unit.querySelector(
                            '[data-key="image_file"]'
                        ).files?.[0];

                        const old = unit.querySelector(
                            '[data-key="existing_image"]'
                        ).value;

                        if (!file && !old) {
                            event.preventDefault();
                            alert('Setiap bagian Foto + Penjelasan wajib memiliki gambar.');
                            return;
                        }
                    }
                }
            });

            renderPreview();
        });
    </script>
@endpush
