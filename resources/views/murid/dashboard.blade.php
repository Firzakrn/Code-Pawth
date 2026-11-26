@extends('layouts.app')

@section('title', 'Dashboard Siswa — CodePawth')

@section('content')

    @php
        $user = auth()->user();
        $userName = $user->name ?? 'Siswa CodePawth';
        $firstName = explode(' ', trim($userName))[0];
        $currentJenjang = strtoupper($user->jenjang ?? session('jenjang', 'SMP'));
        $totalBintang = (int) ($user->total_bintang ?? 18);
        $joinedClasses = $classes ?? collect();
    @endphp

    <div class="relative w-full min-h-full overflow-x-hidden">

        <!-- =====================================================================
                             DEKORASI BACKGROUND (BLOB, AWAN, PAW KUCING BESAR, & BINTANG)
                        ====================================================================== -->
        <div class="pointer-events-none select-none absolute inset-0 overflow-hidden z-0" aria-hidden="true">
            <!-- Blob Besar Pastel -->
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

            <!-- Awan Besar Tengah Kiri -->
            <svg class="absolute top-[46%] -left-20 w-[460px] h-44 text-white/55" viewBox="0 0 460 160" fill="currentColor">
                <circle cx="80" cy="120" r="60" />
                <circle cx="170" cy="95" r="75" />
                <circle cx="270" cy="105" r="65" />
                <circle cx="360" cy="125" r="50" />
                <rect x="20" y="115" width="380" height="45" rx="22" />
            </svg>

            <!-- Paw Kucing Besar di Background -->
            <svg class="absolute top-36 left-[46%] w-32 h-32 text-blue-300/30 -rotate-12" viewBox="0 0 64 64"
                fill="currentColor">
                <ellipse cx="16" cy="22" rx="5.5" ry="7.5" transform="rotate(-18 16 22)" />
                <ellipse cx="27" cy="15" rx="5.5" ry="8" transform="rotate(-6 27 15)" />
                <ellipse cx="39" cy="15" rx="5.5" ry="8" transform="rotate(8 39 15)" />
                <ellipse cx="49" cy="23" rx="5.5" ry="7.5" transform="rotate(20 49 23)" />
                <path
                    d="M32 27c-9.5 0-16 6.8-16 14.2 0 5.2 4.2 8.8 9.2 8.8 2.6 0 4.6-1 6.8-1s4.2 1 6.8 1c5 0 9.2-3.6 9.2-8.8C48 33.8 41.5 27 32 27z" />
            </svg>
            <svg class="hidden md:block absolute bottom-20 right-10 w-36 h-36 text-blue-300/25 rotate-12"
                viewBox="0 0 64 64" fill="currentColor">
                <ellipse cx="16" cy="22" rx="5.5" ry="7.5" transform="rotate(-18 16 22)" />
                <ellipse cx="27" cy="15" rx="5.5" ry="8" transform="rotate(-6 27 15)" />
                <ellipse cx="39" cy="15" rx="5.5" ry="8" transform="rotate(8 39 15)" />
                <ellipse cx="49" cy="23" rx="5.5" ry="7.5" transform="rotate(20 49 23)" />
                <path
                    d="M32 27c-9.5 0-16 6.8-16 14.2 0 5.2 4.2 8.8 9.2 8.8 2.6 0 4.6-1 6.8-1s4.2 1 6.8 1c5 0 9.2-3.6 9.2-8.8C48 33.8 41.5 27 32 27z" />
            </svg>

            <!-- Taburan Bintang -->
            <svg class="absolute top-14 left-[42%] w-7 h-7 text-blue-400/55" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 1l2.6 7.4L22 11l-7.4 2.6L12 21l-2.6-7.4L2 11l7.4-2.6L12 1z" />
            </svg>
            <svg class="absolute top-24 right-[26%] w-5 h-5 text-sky-400/60" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 1l2.6 7.4L22 11l-7.4 2.6L12 21l-2.6-7.4L2 11l7.4-2.6L12 1z" />
            </svg>
            <svg class="absolute bottom-28 left-10 w-8 h-8 text-blue-400/45" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 1l2.6 7.4L22 11l-7.4 2.6L12 21l-2.6-7.4L2 11l7.4-2.6L12 1z" />
            </svg>
        </div>

        <!-- =====================================================================
                             KONTEN UTAMA DASHBOARD SISWA
                        ====================================================================== -->
        <div class="relative z-10 w-full max-w-7xl mx-auto px-5 sm:px-8 py-6 space-y-6">

            {{-- NOTIFIKASI SUKSES / ERROR VALIDASI --}}
            @if (session('success') || session('status'))
                <div
                    class="rounded-2xl bg-emerald-50 border border-emerald-200 px-4 py-3 flex items-center gap-2.5 text-xs sm:text-sm font-bold text-emerald-700 shadow-2xs">
                    <svg class="w-5 h-5 text-emerald-500 shrink-0" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>{{ session('success') ?? session('status') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div
                    class="rounded-2xl bg-rose-50 border border-rose-200 px-4 py-3 flex items-center gap-2.5 text-xs sm:text-sm font-bold text-rose-700 shadow-2xs">
                    <svg class="w-5 h-5 text-rose-500 shrink-0" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-1.72 6.97a.75.75 0 10-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 101.06 1.06L12 13.06l1.72 1.72a.75.75 0 101.06-1.06L13.06 12l1.72-1.72a.75.75 0 10-1.06-1.06L12 10.94l-1.72-1.72z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            {{-- =====================================================================
             1. HERO BANNER GREETING SISWA
        ====================================================================== --}}
            <section
                class="relative overflow-hidden rounded-3xl bg-white/95 backdrop-blur-sm border border-white shadow-soft-card p-6 sm:p-8 flex flex-col md:flex-row items-center justify-between gap-6">
                <!-- Dekorasi Awan & Paw Dalam Hero -->
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
                                d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>DASHBOARD SISWA</span>
                    </div>

                    <h1 class="text-2xl sm:text-4xl font-extrabold tracking-tight text-slate-900">
                        Halo, <span class="text-blue-600">{{ $firstName }}!</span>
                    </h1>

                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed max-w-xl">
                        Mau belajar sendiri atau bersama guru? Kamu bebas memilih keduanya! Eksplorasi peta level interaktif
                        atau masukkan kode kelas dari gurumu.
                    </p>

                    <!-- Badges Ringkasan Cepat Siswa -->
                    <div class="flex flex-wrap items-center gap-2.5 pt-2">
                        <span
                            class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-amber-50/90 border border-amber-200/80 text-xs font-extrabold text-amber-700">
                            <svg class="w-3.5 h-3.5 text-amber-500" viewBox="0 0 24 24" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>{{ $totalBintang }} Bintang</span>
                        </span>

                        <span
                            class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-blue-50/90 border border-blue-100 text-xs font-extrabold text-blue-700">
                            <svg class="w-3.5 h-3.5 text-blue-600" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M11.7 2.805a.75.75 0 01.6 0A60.65 60.65 0 0122.83 8.72a.75.75 0 01-.231 1.337 49.949 49.949 0 00-9.902 3.912l-.003.002-.34.18a.75.75 0 01-.707 0A50.009 50.009 0 007.5 12.174v-.224c0-.131.067-.248.172-.311a54.614 54.614 0 014.653-2.52.75.75 0 00-.65-1.352 56.129 56.129 0 00-4.78 2.589 1.858 1.858 0 00-.859 1.228 49.803 49.803 0 00-4.634-1.527.75.75 0 01-.231-1.337A60.653 60.653 0 0111.7 2.805z" />
                            </svg>
                            <span>Jenjang {{ $currentJenjang }}</span>
                        </span>

                        <span
                            class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-indigo-50/90 border border-indigo-100 text-xs font-extrabold text-indigo-700">
                            <svg class="w-3.5 h-3.5 text-indigo-600" fill="none" stroke="currentColor"
                                stroke-width="2.4" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347" />
                            </svg>
                            <span>{{ $joinedClasses->count() }} Kelas Aktif</span>
                        </span>
                    </div>
                </div>

                <div class="relative z-10 shrink-0">
                    <img src="{{ asset('images/mascot_dashboard.png') }}" alt="Maskot CodePawth menyapa siswa"
                        class="w-36 h-36 sm:w-44 sm:h-44 object-contain drop-shadow-sm">
                </div>
            </section>

            {{-- =====================================================================
             2. DUA MODE BELAJAR (BELAJAR MANDIRI & BELAJAR BERSAMA GURU)
        ====================================================================== --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                {{-- KARTU 1: BELAJAR MANDIRI --}}
                <section
                    class="relative overflow-hidden bg-gradient-to-br from-blue-600 via-blue-600 to-indigo-600 text-white rounded-3xl shadow-soft-blue p-6 sm:p-8 flex flex-col justify-between gap-6">
                    <!-- Dekorasi Awan & Paw Putih Transparan -->
                    <svg class="pointer-events-none select-none absolute -bottom-6 -left-6 w-64 h-28 text-white/10"
                        viewBox="0 0 280 120" fill="currentColor">
                        <circle cx="55" cy="85" r="42" />
                        <circle cx="115" cy="65" r="52" />
                        <circle cx="185" cy="75" r="46" />
                        <rect x="20" y="80" width="220" height="40" />
                    </svg>
                    <svg class="pointer-events-none select-none absolute top-4 right-5 w-24 h-24 text-white/10 rotate-12"
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

                    <div class="relative z-10 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div class="space-y-2.5 max-w-md">
                            <span
                                class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/15 border border-white/25 text-[11px] font-extrabold uppercase tracking-wider text-blue-50">
                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M11.644 1.59a.75.75 0 01.712 0l9.75 5.25a.75.75 0 010 1.32l-9.75 5.25a.75.75 0 01-.712 0l-9.75-5.25a.75.75 0 010-1.32l9.75-5.25z" />
                                    <path
                                        d="M3.265 10.602l7.668 4.129a2.25 2.25 0 002.134 0l7.668-4.13 1.37.739a.75.75 0 010 1.32l-9.75 5.25a.75.75 0 01-.71 0l-9.75-5.25a.75.75 0 010-1.32l1.37-.738z" />
                                </svg>
                                <span>TANPA KODE KELAS</span>
                            </span>

                            <h2 class="text-xl sm:text-2xl font-extrabold text-white">
                                Belajar Mandiri
                            </h2>

                            <p class="text-xs sm:text-sm text-blue-100 leading-relaxed">
                                Pilih jenjang dan level yang ingin kamu pelajari. Tidak memerlukan kode kelas dari
                                guru—langsung selesaikan tantangan dan kumpulkan bintang!
                            </p>
                        </div>

                        <img src="{{ asset('images/mascot_run.png') }}" alt="Maskot Belajar Mandiri"
                            class="w-28 h-28 sm:w-32 sm:h-32 object-contain shrink-0 self-center sm:self-end drop-shadow-md">
                    </div>

                    <div class="relative z-10 flex flex-wrap items-center gap-3 pt-2">
                        <a href="{{ route('level-view') }}"
                            class="inline-flex items-center justify-center gap-2 rounded-full bg-white hover:bg-blue-50 text-blue-700 font-extrabold text-xs sm:text-sm px-6 py-3 shadow-md transition-all">
                            <span>Mulai Belajar</span>
                            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2.6"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                            </svg>
                        </a>

                        <a href="{{ route('knowledge-card') }}"
                            class="inline-flex items-center justify-center gap-1.5 rounded-full bg-white/15 hover:bg-white/25 text-white border border-white/30 font-bold text-xs sm:text-sm px-5 py-3 transition-all">
                            <span>Knowledge Card</span>
                        </a>
                    </div>
                </section>

                {{-- KARTU 2: BELAJAR BERSAMA GURU (GABUNG KELAS) --}}
                <section
                    class="relative overflow-hidden bg-white/95 backdrop-blur-sm rounded-3xl border border-white shadow-soft-card p-6 sm:p-8 flex flex-col justify-between gap-5">
                    <!-- Dekorasi Paw Besar di Sudut -->
                    <svg class="pointer-events-none select-none absolute -bottom-5 right-6 w-28 h-28 text-blue-100/75 rotate-12"
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

                    <div class="relative z-10 flex items-start justify-between gap-4">
                        <div class="space-y-1.5">
                            <span
                                class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-indigo-50 border border-indigo-100 text-[11px] font-extrabold uppercase tracking-wider text-indigo-600">
                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M4.5 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM14.25 8.625a3.375 3.375 0 116.75 0 3.375 3.375 0 01-6.75 0zM1.5 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122z" />
                                </svg>
                                <span>OPSIONAL</span>
                            </span>

                            <h2 class="text-xl sm:text-2xl font-extrabold text-slate-900">
                                Belajar Bersama Guru
                            </h2>

                            <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
                                Kalau guru memberikan kode kelas, kamu bisa memasukkannya di sini. Bagian ini tidak wajib.
                            </p>
                        </div>

                        <img src="{{ asset('images/mascot_join.png') }}" alt="Maskot Gabung Kelas"
                            class="w-24 h-24 sm:w-32 sm:h-32 object-contain shrink-0 drop-shadow-2xs">
                    </div>

                    <form method="POST" action="{{ route('murid.kelas.join') }}" class="relative z-10 space-y-3">
                        @csrf

                        <div>
                            <label for="join_code" class="block text-xs font-extrabold text-slate-700 mb-1.5">
                                Kode Kelas
                            </label>

                            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2.5">
                                <input type="text" id="join_code" name="join_code" placeholder="Contoh: ABC1234"
                                    value="{{ old('join_code') }}" maxlength="10" required
                                    class="flex-1 rounded-full bg-slate-50/90 border border-slate-200 px-4 py-2.5 text-xs sm:text-sm font-extrabold uppercase tracking-wider text-slate-800 placeholder:font-semibold placeholder:normal-case placeholder:tracking-normal placeholder:text-slate-400 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all">

                                <button type="submit"
                                    class="inline-flex items-center justify-center gap-2 rounded-full bg-blue-600 hover:bg-blue-700 text-white text-xs sm:text-sm font-extrabold px-6 py-2.5 shadow-soft-blue transition-all cursor-pointer shrink-0">
                                    <span>Gabung Kelas</span>
                                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor"
                                        stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </form>
                </section>

            </div>

            {{-- =====================================================================
             3. DAFTAR KELAS YANG KAMU IKUTI
        ====================================================================== --}}
            <section
                class="relative overflow-hidden bg-white/95 backdrop-blur-sm rounded-3xl border border-white shadow-soft-card p-6 sm:p-7">
                <!-- Dekorasi Paw Besar -->
                <svg class="hidden sm:block pointer-events-none select-none absolute -bottom-4 right-8 w-28 h-28 text-blue-100/75 rotate-12"
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

                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-5 relative z-10">
                    <div class="flex items-center gap-3.5">
                        <img src="{{ asset('images/mascot_card.png') }}" alt="Maskot Daftar Kelas"
                            class="w-12 h-12 object-contain shrink-0 drop-shadow-2xs">
                        <div>
                            <h2 class="text-lg sm:text-xl font-extrabold text-blue-900">
                                Kelas yang Kamu Ikuti
                            </h2>
                            <p class="text-xs sm:text-sm text-slate-500">
                                Daftar kelas tempat kamu belajar dan mengerjakan tantangan dari guru.
                            </p>
                        </div>
                    </div>

                    <span
                        class="self-start sm:self-center px-3.5 py-1.5 rounded-full bg-blue-50 border border-blue-100 text-xs font-extrabold text-blue-700">
                        {{ $joinedClasses->count() }} Kelas Terdaftar
                    </span>
                </div>

                <div class="relative z-10">
                    @if ($joinedClasses->isNotEmpty())
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ($joinedClasses as $class)
                                @php
                                    $isDemoClass = ($class->code ?? '') === 'DEMO-PAWTH';
                                @endphp
                                <div
                                    class="group rounded-2xl bg-slate-50/80 hover:bg-white border border-slate-200/80 hover:border-blue-300 p-5 transition-all hover:shadow-md flex flex-col justify-between gap-4">
                                    <div class="space-y-2">
                                        <div class="flex items-center justify-between gap-2">
                                            <span
                                                class="px-3 py-1 rounded-full {{ $isDemoClass ? 'bg-sky-50 text-sky-700 border-sky-200' : 'bg-blue-50 text-blue-700 border-blue-100' }} border text-[11px] font-extrabold">
                                                {{ $isDemoClass ? 'Kelas Demo Mandiri' : 'Jenjang ' . ($class->level ?? 'Umum') }}
                                            </span>

                                            <span
                                                class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-emerald-50 border border-emerald-200 text-[11px] font-extrabold text-emerald-700">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                                Terdaftar
                                            </span>
                                        </div>

                                        <h3 class="text-base font-extrabold text-slate-900 pt-1">
                                            {{ $class->name }}
                                        </h3>

                                        <p class="text-xs font-medium text-slate-500">
                                            Guru: <strong
                                                class="text-slate-700">{{ $class->teacher->name ?? 'Tim CodePawth' }}</strong>
                                        </p>
                                    </div>

                                    <div class="pt-3 border-t border-slate-200/70 flex items-center justify-between gap-2">
                                        <div class="text-[11px] font-bold text-slate-400">
                                            Kode: <span
                                                class="font-extrabold text-blue-600">{{ $class->code ?? '—' }}</span>
                                        </div>

                                        <a href="{{ route('level-view') }}"
                                            class="inline-flex items-center gap-1 text-xs font-extrabold text-blue-600 hover:text-blue-700 transition-colors">
                                            <span>Masuk Belajar</span>
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                stroke-width="2.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div
                            class="rounded-2xl border border-dashed border-blue-200 bg-blue-50/40 p-8 sm:p-10 text-center space-y-2.5">
                            <img src="{{ asset('images/mascot_peeking.png') }}" alt="Maskot Belum Ada Kelas"
                                class="w-24 h-24 object-contain mx-auto mb-1">
                            <h3 class="text-base font-extrabold text-slate-900">
                                Belum mengikuti kelas
                            </h3>
                            <p class="text-xs sm:text-sm text-slate-500 max-w-md mx-auto leading-relaxed">
                                Kamu tetap bisa belajar mandiri kapan saja lewat peta level, atau masukkan kode kelas dari
                                gurumu pada kolom di atas.
                            </p>
                            <div class="pt-2">
                                <a href="{{ route('level-view') }}"
                                    class="inline-flex items-center gap-2 rounded-full bg-blue-600 hover:bg-blue-700 text-white text-xs font-extrabold px-5 py-2.5 shadow-soft-blue transition-all">
                                    <span>Mulai Belajar Mandiri</span>
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </section>

        </div>
    </div>

@endsection
