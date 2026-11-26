@extends('layouts.app')

@section('title', 'Dashboard Guru')

@section('content')
    <div class="relative w-full min-h-full overflow-x-hidden">

        <!-- =====================================================================
                     DEKORASI BACKGROUND RAMAI (BLOB, AWAN, PAW KUCING BESAR, & BINTANG)
                ====================================================================== -->
        <div class="pointer-events-none select-none absolute inset-0 overflow-hidden z-0">
            <!-- Blob Besar Pastel -->
            <div class="absolute -top-24 -left-24 w-96 h-96 rounded-full bg-blue-200/45 blur-3xl"></div>
            <div class="absolute top-12 right-1/4 w-[28rem] h-[28rem] rounded-full bg-white/65 blur-2xl"></div>
            <div class="absolute top-1/3 -right-24 w-96 h-96 rounded-full bg-indigo-200/40 blur-3xl"></div>
            <div class="absolute -bottom-24 left-1/3 w-[32rem] h-[32rem] rounded-full bg-sky-200/45 blur-3xl"></div>

            <!-- Pola Awan Besar Atas Kanan -->
            <svg class="absolute -top-6 right-10 w-[440px] h-44 text-white/65" viewBox="0 0 440 160" fill="currentColor">
                <circle cx="90" cy="115" r="55" />
                <circle cx="165" cy="95" r="70" />
                <circle cx="255" cy="100" r="65" />
                <circle cx="335" cy="115" r="50" />
                <rect x="40" y="110" width="340" height="50" rx="25" />
            </svg>

            <!-- Pola Awan Besar Bawah Kiri -->
            <svg class="absolute bottom-6 -left-16 w-[480px] h-48 text-white/60" viewBox="0 0 480 180" fill="currentColor">
                <circle cx="80" cy="130" r="65" />
                <circle cx="175" cy="105" r="80" />
                <circle cx="280" cy="115" r="70" />
                <circle cx="375" cy="135" r="55" />
                <rect x="20" y="125" width="400" height="55" rx="27" />
            </svg>

            <!-- Paw Kucing Besar di Background -->
            <svg class="absolute top-28 left-1/2 -translate-x-1/2 w-32 h-32 text-blue-300/30 -rotate-12" viewBox="0 0 64 64"
                fill="currentColor">
                <ellipse cx="16" cy="22" rx="5.5" ry="7.5" transform="rotate(-18 16 22)" />
                <ellipse cx="27" cy="15" rx="5.5" ry="8" transform="rotate(-6 27 15)" />
                <ellipse cx="39" cy="15" rx="5.5" ry="8" transform="rotate(8 39 15)" />
                <ellipse cx="49" cy="23" rx="5.5" ry="7.5" transform="rotate(20 49 23)" />
                <path
                    d="M32 27c-9.5 0-16 6.8-16 14.2 0 5.2 4.2 8.8 9.2 8.8 2.6 0 4.6-1 6.8-1s4.2 1 6.8 1c5 0 9.2-3.6 9.2-8.8C48 33.8 41.5 27 32 27z" />
            </svg>

            <svg class="hidden md:block absolute top-1/2 right-8 w-36 h-36 text-blue-300/25 rotate-12" viewBox="0 0 64 64"
                fill="currentColor">
                <ellipse cx="16" cy="22" rx="5.5" ry="7.5" transform="rotate(-18 16 22)" />
                <ellipse cx="27" cy="15" rx="5.5" ry="8" transform="rotate(-6 27 15)" />
                <ellipse cx="39" cy="15" rx="5.5" ry="8" transform="rotate(8 39 15)" />
                <ellipse cx="49" cy="23" rx="5.5" ry="7.5" transform="rotate(20 49 23)" />
                <path
                    d="M32 27c-9.5 0-16 6.8-16 14.2 0 5.2 4.2 8.8 9.2 8.8 2.6 0 4.6-1 6.8-1s4.2 1 6.8 1c5 0 9.2-3.6 9.2-8.8C48 33.8 41.5 27 32 27z" />
            </svg>

            <!-- Taburan Bintang-Bintang di Background -->
            <svg class="absolute top-14 left-[44%] w-7 h-7 text-blue-400/55" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 1l2.6 7.4L22 11l-7.4 2.6L12 21l-2.6-7.4L2 11l7.4-2.6L12 1z" />
            </svg>
            <svg class="absolute top-24 right-[26%] w-5 h-5 text-sky-400/60" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 1l2.6 7.4L22 11l-7.4 2.6L12 21l-2.6-7.4L2 11l7.4-2.6L12 1z" />
            </svg>
            <svg class="absolute top-8 right-[18%] w-6 h-6 text-blue-300/70" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 1l2.6 7.4L22 11l-7.4 2.6L12 21l-2.6-7.4L2 11l7.4-2.6L12 1z" />
            </svg>
            <svg class="absolute top-[46%] left-6 w-6 h-6 text-blue-400/45" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 1l2.6 7.4L22 11l-7.4 2.6L12 21l-2.6-7.4L2 11l7.4-2.6L12 1z" />
            </svg>
            <svg class="absolute bottom-20 right-[12%] w-8 h-8 text-blue-400/45" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 1l2.6 7.4L22 11l-7.4 2.6L12 21l-2.6-7.4L2 11l7.4-2.6L12 1z" />
            </svg>
        </div>

        <!-- =====================================================================
                     KONTEN UTAMA DASHBOARD GURU
                ====================================================================== -->
        <div class="relative z-10 w-full max-w-7xl mx-auto px-5 sm:px-8 py-6 space-y-6">

            <!-- HEADER SAPAAN GURU & MASKOT KANAN ATAS -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    {{-- SAPAAN GURU --}}
                    <div
                        class="inline-flex items-center gap-1.5 text-xs font-extrabold uppercase tracking-wider text-blue-600 mb-1">
                        <svg class="w-4 h-4 text-slate-700" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M11.7 2.805a.75.75 0 01.6 0A60.65 60.65 0 0122.83 8.72a.75.75 0 01-.231 1.337 49.949 49.949 0 00-9.902 3.912l-.003.002-.34.18a.75.75 0 01-.707 0A50.009 50.009 0 007.5 12.174v-.224c0-.131.067-.248.172-.311a54.614 54.614 0 014.653-2.52.75.75 0 00-.65-1.352 56.129 56.129 0 00-4.78 2.589 1.858 1.858 0 00-.859 1.228 49.803 49.803 0 00-4.634-1.527.75.75 0 01-.231-1.337A60.653 60.653 0 0111.7 2.805z" />
                            <path
                                d="M13.06 15.473a48.45 48.45 0 017.666-3.282c.134 1.414.22 2.843.255 4.285a.75.75 0 01-.46.71 47.878 47.878 0 00-8.105 4.342.75.75 0 01-.832 0 47.877 47.877 0 00-8.104-4.342.75.75 0 01-.461-.71c.035-1.442.121-2.87.255-4.286A48.4 48.4 0 016 13.18v1.27a1.5 1.5 0 00-.14 2.508c-.09.38-.222.753-.397 1.11.452.213.901.434 1.346.661a6.729 6.729 0 00.551-1.608 1.5 1.5 0 00.14-2.67v-.645a48.549 48.549 0 013.44 1.668 2.25 2.25 0 002.12 0z" />
                        </svg>
                        <span>DASHBOARD GURU</span>
                    </div>

                    <h1
                        class="text-2xl sm:text-3xl font-extrabold tracking-tight text-slate-900 flex items-center gap-2.5">
                        <span>Halo, {{ auth()->user()->name }}!</span>
                        <span
                            class="inline-flex items-center justify-center w-8 h-8 rounded-xl bg-amber-100/90 border border-amber-200 text-amber-500 shrink-0 shadow-2xs">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M9 4.5a.75.75 0 01.721.544l.813 2.846a3.75 3.75 0 002.576 2.576l2.846.813a.75.75 0 010 1.442l-2.846.813a3.75 3.75 0 00-2.576 2.576l-.813 2.846a.75.75 0 01-1.442 0l-.813-2.846a3.75 3.75 0 00-2.576-2.576l-2.846-.813a.75.75 0 010-1.442l2.846-.813A3.75 3.75 0 007.466 7.89l.813-2.846A.75.75 0 019 4.5zM18 1.5a.75.75 0 01.728.568l.258 1.036c.236.94.97 1.674 1.91 1.91l1.036.258a.75.75 0 010 1.456l-1.036.258c-.94.236-1.674.97-1.91 1.91l-.258 1.036a.75.75 0 01-1.456 0l-.258-1.036a2.625 2.625 0 00-1.91-1.91l-1.036-.258a.75.75 0 010-1.456l1.036-.258a2.625 2.625 0 001.91-1.91l.258-1.036A.75.75 0 0118 1.5z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                    </h1>

                    <p class="text-xs sm:text-sm text-slate-600 mt-1.5">
                        Selamat datang di CodePawth!
                        Kelola kelas, buat materi interaktif,
                        dan bagikan aktivitas belajar kepada siswa.
                    </p>
                </div>

                <!-- Speech Bubble + Maskot Kanan Atas -->
                <div class="hidden sm:flex items-center gap-3 self-end md:self-center shrink-0">
                    <div
                        class="inline-flex items-center gap-1.5 bg-white/95 border border-blue-100 rounded-full px-5 py-2.5 shadow-soft-card text-xs font-extrabold text-blue-700">
                        <span>Ayo mulai kelasmu hari ini!</span>
                        <svg class="w-3.5 h-3.5 text-amber-400 shrink-0" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M9 4.5a.75.75 0 01.721.544l.813 2.846a3.75 3.75 0 002.576 2.576l2.846.813a.75.75 0 010 1.442l-2.846.813a3.75 3.75 0 00-2.576 2.576l-.813 2.846a.75.75 0 01-1.442 0l-.813-2.846a3.75 3.75 0 00-2.576-2.576l-2.846-.813a.75.75 0 010-1.442l2.846-.813A3.75 3.75 0 007.466 7.89l.813-2.846A.75.75 0 019 4.5z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <img src="{{ asset('images/mascot_dashboard.png') }}" alt="Maskot CodePawth"
                        class="w-20 h-20 object-contain drop-shadow-xs">
                </div>
            </div>

            <!-- =====================================================================
                         MENU UTAMA (BUAT KELAS BARU & STUDIO KONTEN GURU)
                    ====================================================================== -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                {{-- BUAT KELAS --}}
                <section
                    class="bg-white/95 backdrop-blur-sm rounded-3xl border border-white shadow-soft-card p-6 sm:p-7 relative overflow-hidden">
                    <!-- Dekorasi Awan & Paw Besar Dalam Kartu -->
                    <svg class="pointer-events-none select-none absolute -bottom-6 -right-6 w-56 h-28 text-blue-50/90"
                        viewBox="0 0 220 110" fill="currentColor">
                        <circle cx="55" cy="75" r="40" />
                        <circle cx="110" cy="60" r="48" />
                        <circle cx="165" cy="72" r="42" />
                        <rect x="20" y="70" width="180" height="40" />
                    </svg>
                    <svg class="pointer-events-none select-none absolute bottom-4 right-5 w-24 h-24 text-blue-100/75 rotate-12"
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

                    <!-- Aksen 3 garis biru sudut kanan atas -->
                    <div class="hidden sm:flex items-center gap-1 absolute top-5 right-6 pointer-events-none select-none">
                        <span class="w-1 h-3.5 bg-blue-400/70 rounded-full rotate-12"></span>
                        <span class="w-1 h-4 bg-blue-400/70 rounded-full rotate-45"></span>
                        <span class="w-1 h-3.5 bg-blue-400/70 rounded-full rotate-[75deg]"></span>
                    </div>

                    <div class="relative z-10 flex items-start gap-4 mb-5">
                        <!-- PNG Maskot Kelas -->
                        <img src="{{ asset('images/mascot_add_class.png') }}" alt="Maskot Kelas"
                            class="w-14 h-14 object-contain shrink-0 drop-shadow-2xs">

                        <div>
                            <h2 class="text-lg sm:text-xl font-extrabold text-blue-900">
                                Buat Kelas Baru
                            </h2>
                            <p class="text-xs sm:text-sm text-slate-500 mt-0.5 leading-relaxed">
                                Buat kelas dan bagikan kode agar siswa dapat bergabung dengan kelasmu.
                            </p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('guru.kelas.store') }}" class="relative z-10 space-y-4">
                        @csrf

                        <div>
                            <label for="name" class="block text-xs font-extrabold text-slate-700 mb-1.5">
                                Nama Kelas
                            </label>

                            <input type="text" id="name" name="name" value="{{ old('name') }}"
                                placeholder="Contoh: Coding 7A" maxlength="100" required
                                class="w-full rounded-full bg-slate-50/85 border border-slate-200 px-4 py-2.5 text-sm font-medium text-slate-800 placeholder:text-slate-400 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all">

                            @error('name')
                                <small style="color:#d95d70" class="block font-semibold mt-1 pl-2">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <div>
                            <label for="level" class="block text-xs font-extrabold text-slate-700 mb-1.5">
                                Jenjang Kelas
                            </label>

                            <div class="relative">
                                <select id="level" name="level" required
                                    class="w-full appearance-none rounded-full bg-slate-50/85 border border-slate-200 px-4 py-2.5 pr-10 text-sm font-semibold text-slate-800 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all cursor-pointer">
                                    @foreach (['Umum', 'SD', 'SMP', 'SMA'] as $level)
                                        <option value="{{ $level }}" @selected(old('level', 'Umum') === $level)>
                                            {{ $level }}
                                        </option>
                                    @endforeach
                                </select>
                                <svg class="w-4 h-4 text-slate-600 pointer-events-none absolute right-4 top-1/2 -translate-y-1/2"
                                    fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>

                            @error('level')
                                <small style="color:#d95d70" class="block font-semibold mt-1 pl-2">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <div class="pt-1">
                            <button type="submit"
                                class="inline-flex items-center justify-center gap-1.5 rounded-full bg-blue-600 hover:bg-blue-700 active:scale-[0.99] text-white text-xs sm:text-sm font-bold px-6 py-2.5 shadow-soft-blue transition-all cursor-pointer">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                <span>Buat Kelas</span>
                            </button>
                        </div>
                    </form>
                </section>

                {{-- STUDIO KONTEN GURU --}}
                <section
                    class="bg-white/95 backdrop-blur-sm rounded-3xl border border-white shadow-soft-card p-6 sm:p-7 relative overflow-hidden flex flex-col justify-between">
                    <!-- Dekorasi Awan Besar di Pojok Kanan Bawah Kartu -->
                    <svg class="pointer-events-none select-none absolute -bottom-6 -right-6 w-64 h-36 text-blue-100/65"
                        viewBox="0 0 260 140" fill="currentColor">
                        <circle cx="65" cy="95" r="48" />
                        <circle cx="130" cy="75" r="58" />
                        <circle cx="195" cy="88" r="50" />
                        <rect x="25" y="88" width="210" height="52" />
                    </svg>

                    <!-- Aksen kilau bintang biru sudut kanan atas -->
                    <div class="hidden sm:block absolute top-5 right-6 text-blue-300/85 pointer-events-none select-none">
                        <svg class="w-12 h-12" viewBox="0 0 48 48" fill="currentColor">
                            <path d="M24 4l2.5 7.5L34 14l-7.5 2.5L24 24l-2.5-7.5L14 14l7.5-2.5L24 4z" />
                            <path d="M38 22l1.5 4.5L44 28l-4.5 1.5L38 34l-1.5-4.5L32 28l4.5-1.5L38 22z" opacity="0.7" />
                            <path d="M10 26l1.2 3.3L14.5 30.5l-3.3 1.2L10 35l-1.2-3.3L5.5 30.5l3.3-1.2L10 26z"
                                opacity="0.55" />
                        </svg>
                    </div>

                    <div class="relative z-10">
                        <div class="flex items-start gap-4 mb-4">
                            <!-- PNG Maskot Studio -->
                            <img src="{{ asset('images/mascot_studio.png') }}" alt="Maskot Studio Konten"
                                class="w-14 h-14 object-contain shrink-0 drop-shadow-2xs">

                            <div>
                                <h2 class="text-lg sm:text-xl font-extrabold text-blue-900">
                                    Studio Konten Guru
                                </h2>
                                <p class="text-xs sm:text-sm text-slate-500 mt-0.5 leading-relaxed">
                                    Buat materi dan evaluasi interaktif menggunakan template yang sudah disediakan
                                    CodePawth.
                                </p>
                            </div>
                        </div>

                        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed max-w-md">
                            Pilih template flashcard, artikel, gambar, matching, flowchart, atau coding blocks.
                        </p>
                    </div>

                    <div class="relative z-10 flex flex-wrap items-center gap-3 mt-6 pr-0 sm:pr-24">
                        <a href="{{ route('guru.studio') }}"
                            class="inline-flex items-center gap-2 rounded-full bg-blue-600 hover:bg-blue-700 text-white text-xs sm:text-sm font-bold px-5 py-2.5 shadow-soft-blue transition-all">
                            <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M20.599 1.5c-.376 0-.743.111-1.055.32l-5.08 3.385a18.747 18.747 0 00-3.471 2.987 10.04 10.04 0 014.815 4.815 18.748 18.748 0 002.987-3.472l3.386-5.079A1.902 1.902 0 0020.599 1.5zm-8.3 14.025a18.76 18.76 0 001.896-1.207 8.026 8.026 0 00-4.513-4.513A18.75 18.75 0 008.475 11.7l-.278.5a5.26 5.26 0 013.601 3.602l.502-.278zM6.75 13.5A3.75 3.75 0 003 17.25a1.5 1.5 0 01-1.601 1.497.75.75 0 00-.7 1.123 5.25 5.25 0 009.8-2.62 3.75 3.75 0 00-3.75-3.75z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>Buka Studio Konten</span>
                        </a>

                        <a href="{{ route('level-view') }}"
                            class="inline-flex items-center gap-2 rounded-full bg-slate-50 hover:bg-blue-50 text-slate-700 hover:text-blue-700 border border-slate-200 hover:border-blue-200 text-xs sm:text-sm font-bold px-5 py-2.5 transition-all">
                            <svg class="w-4 h-4 text-blue-600 shrink-0" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M11.25 4.533A9.707 9.707 0 006 3a9.735 9.735 0 00-3.25.555.75.75 0 00-.5.707v14.25a.75.75 0 001 .707A8.237 8.237 0 016 18.75c1.995 0 3.823.707 5.25 1.886V4.533zM12.75 20.636A8.214 8.214 0 0118 18.75c.966 0 1.89.166 2.75.47a.75.75 0 001-.708V4.262a.75.75 0 00-.5-.707A9.735 9.735 0 0018 3a9.707 9.707 0 00-5.25 1.533v16.103z" />
                            </svg>
                            <span>Jelajahi Materi</span>
                        </a>
                    </div>

                    <!-- Maskot Dashboard di Pojok Kanan Bawah Kartu Studio -->
                    <img src="{{ asset('images/mascot_dashboard.png') }}" alt="Maskot Dashboard CodePawth"
                        class="hidden sm:block absolute bottom-2 right-3 w-28 h-28 object-contain pointer-events-none select-none drop-shadow-xs">
                </section>

            </div>

            <!-- =====================================================================
                         DAFTAR KELAS SAYA
                    ====================================================================== -->
            <section
                class="bg-white/95 backdrop-blur-sm rounded-3xl border border-white shadow-soft-card p-6 sm:p-7 relative overflow-hidden">
                <!-- Dekorasi Awan Besar di Bawah Kartu Kelas Saya -->
                <svg class="pointer-events-none select-none absolute -bottom-8 left-1/4 w-[36rem] h-32 text-blue-50/95"
                    viewBox="0 0 560 130" fill="currentColor">
                    <circle cx="80" cy="95" r="50" />
                    <circle cx="170" cy="75" r="62" />
                    <circle cx="275" cy="82" r="55" />
                    <circle cx="375" cy="78" r="58" />
                    <circle cx="470" cy="95" r="48" />
                    <rect x="30" y="88" width="490" height="42" />
                </svg>

                <!-- Dekorasi Jejak Kaki Kucing (Paw Prints) Ukuran Besar di Sudut -->
                <svg class="hidden sm:block w-28 h-28 text-blue-100/80 absolute -bottom-2 left-6 -rotate-12 pointer-events-none select-none"
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
                <svg class="hidden sm:block w-24 h-24 text-blue-100/80 absolute top-3 right-8 rotate-12 pointer-events-none select-none"
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
                <svg class="hidden sm:block w-28 h-28 text-blue-100/80 absolute -bottom-3 right-20 rotate-[18deg] pointer-events-none select-none"
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

                <!-- Taburan Bintang Dalam Kartu -->
                <svg class="hidden sm:block w-6 h-6 text-blue-300/75 absolute top-8 right-36 pointer-events-none"
                    viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 1l2.6 7.4L22 11l-7.4 2.6L12 21l-2.6-7.4L2 11l7.4-2.6L12 1z" />
                </svg>
                <svg class="hidden sm:block w-5 h-5 text-sky-300/80 absolute bottom-10 left-40 pointer-events-none"
                    viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 1l2.6 7.4L22 11l-7.4 2.6L12 21l-2.6-7.4L2 11l7.4-2.6L12 1z" />
                </svg>

                <div class="flex items-start gap-3.5 mb-5 relative z-10">
                    <!-- PNG Maskot Kelas -->
                    <img src="{{ asset('images/mascot_add_class.png') }}" alt="Maskot Kelas Saya"
                        class="w-12 h-12 object-contain shrink-0 drop-shadow-2xs">

                    <div>
                        <h2 class="text-lg sm:text-xl font-extrabold text-blue-900">
                            Kelas Saya
                        </h2>
                        <p class="text-xs sm:text-sm text-slate-500">
                            Kelola kelas yang sudah dibuat dan bagikan kode kepada siswa.
                        </p>
                    </div>
                </div>

                <div class="relative z-10 space-y-3">
                    @forelse ($classes as $class)
                        <div
                            class="rounded-2xl bg-slate-50/85 hover:bg-blue-50/60 border border-slate-200/80 hover:border-blue-200 px-5 py-4 flex flex-col sm:flex-row sm:items-center justify-between gap-3 transition-all">

                            <div>
                                <strong class="text-base font-extrabold text-slate-900">
                                    {{ $class->name }}
                                </strong>

                                <p class="text-xs font-semibold text-slate-500 mt-0.5">
                                    {{ $class->level }}
                                    · {{ $class->students_count }} siswa
                                </p>
                            </div>

                            <div class="flex items-center flex-wrap gap-2.5">
                                <span
                                    class="px-3.5 py-1.5 rounded-full bg-white border border-blue-200 text-xs font-extrabold tracking-wider text-blue-700 shadow-2xs">
                                    {{ $class->join_code }}
                                </span>

                                <button type="button"
                                    class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full bg-white hover:bg-blue-600 text-slate-700 hover:text-white border border-slate-200 hover:border-blue-600 text-xs font-bold transition-all cursor-pointer"
                                    onclick="copyClassCode(@js($class->join_code))">
                                    <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor"
                                        stroke-width="2.2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.666 3.888A2.25 2.25 0 0013.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 01-.75.75H9a.75.75 0 01-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 01-2.25 2.25H6.75A2.25 2.25 0 014.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 011.927-.184" />
                                    </svg>
                                    <span>Salin Kode</span>
                                </button>
                            </div>

                        </div>

                    @empty

                        <div class="text-center py-8 px-4 flex flex-col items-center justify-center">
                            <img src="{{ asset('images/mascot_class.png') }}" alt="Maskot CodePawth"
                                class="w-28 h-28 object-contain mb-3 drop-shadow-xs">

                            <h3 class="text-base sm:text-lg font-extrabold text-blue-950">
                                Belum Ada Kelas
                            </h3>

                            <p class="text-xs sm:text-sm text-slate-500 mt-1">
                                Yuk, buat kelas pertamamu dan mulai belajar bersama siswa!
                            </p>
                        </div>
                    @endforelse
                </div>

            </section>

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        async function copyClassCode(code) {
            try {
                await navigator.clipboard.writeText(code);

                alert('Kode kelas berhasil disalin!');
            } catch (error) {
                window.prompt('Salin kode kelas:', code);
            }
        }
    </script>
@endpush
