@extends('layouts.app')

@section('title', 'Pengaturan Akun — Code Pawth')

@php
    $user = auth()->user();
    $isGuest = !$user;

    $userName = $user->name ?? 'Siswa Tamu';
    $userEmail = $user->email ?? 'tamu@codepawth.id';
    $currentJenjang = strtoupper($user->jenjang ?? session('jenjang', 'SMP'));
    $totalBintang = (int) ($user->total_bintang ?? 18);
    $nilaiKelasSekarang = (int) ($user->nilai_kelas ?? 88);
@endphp

@section('content')
    <!-- Dekorasi Awan Background -->
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
    </div>

    <!-- Top Bar -->
    <header class="relative z-10 px-5 sm:px-7 pt-3 pb-1 flex items-center justify-between gap-3 shrink-0">
        <div class="flex items-center gap-2 text-xs sm:text-sm font-bold text-slate-600">
            <span class="w-2 h-2 rounded-full bg-blue-600"></span>
            <span>Pengaturan & Profil Belajar</span>
        </div>

        <div class="flex items-center gap-2.5">
            <span
                class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/90 border border-blue-100 text-xs font-semibold text-slate-600 shadow-2xs">
                <span class="w-2 h-2 rounded-full {{ $isGuest ? 'bg-amber-400' : 'bg-emerald-500' }}"></span>
                {{ $isGuest ? 'Mode Tamu Aktif' : 'Akun Terhubung' }}
            </span>

            <button type="button" onclick="if(typeof openAdditionalDrawer === 'function') openAdditionalDrawer('tentang')"
                class="inline-flex items-center gap-1.5 bg-white hover:bg-blue-50 text-slate-700 hover:text-blue-600 border border-blue-200/80 text-xs font-bold px-3.5 py-1.5 rounded-full shadow-2xs transition-colors cursor-pointer">
                <svg class="w-3.5 h-3.5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2.2"
                    viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="9" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 11v5m0-8h.01" />
                </svg>
                <span>Tentang</span>
            </button>
        </div>
    </header>

    <!-- Main Container -->
    <main
        class="relative z-10 flex-1 min-h-0 overflow-y-auto px-5 sm:px-7 pb-6 pt-2 max-w-6xl w-full mx-auto flex flex-col gap-4">

        <!-- Notifikasi Sukses -->
        @if (session('status'))
            <div
                class="rounded-2xl bg-emerald-50 border border-emerald-200 px-4 py-3 flex items-center gap-2.5 text-xs sm:text-sm font-bold text-emerald-700 shrink-0">
                <svg class="w-5 h-5 text-emerald-500 shrink-0" viewBox="0 0 24 24" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z"
                        clip-rule="evenodd" />
                </svg>
                <span>{{ session('status') }}</span>
            </div>
        @endif

        <div id="settings-toast"
            class="hidden rounded-2xl bg-emerald-50 border border-emerald-200 px-4 py-3 items-center justify-between gap-2.5 text-xs sm:text-sm font-bold text-emerald-700 shrink-0">
            <div class="flex items-center gap-2.5">
                <svg class="w-5 h-5 text-emerald-500 shrink-0" viewBox="0 0 24 24" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z"
                        clip-rule="evenodd" />
                </svg>
                <span id="settings-toast-text">Perubahan profil berhasil disimpan!</span>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 items-start">

            <!-- =================================================================
                     KOLOM KIRI (5/12): KARTU PROFIL, ICON PROFIL, BINTANG & NILAI KELAS
                ================================================================== -->
            <div class="lg:col-span-5 flex flex-col gap-4">

                <!-- Kartu Identitas & Icon Profil -->
                <div
                    class="bg-white/95 backdrop-blur-xs rounded-3xl border-2 border-white shadow-soft-card p-6 text-center relative overflow-hidden">
                    <div class="pointer-events-none absolute -top-12 -right-12 w-36 h-36 rounded-full bg-blue-100/60"></div>
                    <div class="pointer-events-none absolute -top-10 -left-10 w-28 h-28 rounded-full bg-sky-100/50"></div>

                    <!-- Icon Profil Utama -->
                    <div
                        class="relative z-10 mx-auto w-24 h-24 rounded-3xl bg-gradient-to-br from-blue-500 to-blue-700 p-1 shadow-soft-blue">
                        <div id="profile-avatar-box"
                            class="w-full h-full rounded-[20px] bg-[#EBF3FF] flex items-center justify-center text-blue-600">
                            <!-- Default SVG User Profile Icon -->
                            <svg id="profile-avatar-svg" class="w-12 h-12" viewBox="0 0 24 24" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <span
                            class="absolute -bottom-1 -right-1 w-7 h-7 rounded-full bg-emerald-500 border-2 border-white text-white flex items-center justify-center shadow-2xs"
                            title="Status Aktif">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="3"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                        </span>
                    </div>

                    <!-- Pemilih Gaya Icon Profil -->
                    <div class="relative z-10 mt-3 flex items-center justify-center gap-2">
                        <button type="button" onclick="setProfileAvatar('user')" data-avatar="user"
                            title="Ikon Profil Standar"
                            class="avatar-pick-btn w-8 h-8 rounded-xl bg-blue-600 text-white flex items-center justify-center shadow-2xs transition-all cursor-pointer">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <button type="button" onclick="setProfileAvatar('code')" data-avatar="code" title="Ikon Coder"
                            class="avatar-pick-btn w-8 h-8 rounded-xl bg-slate-100 hover:bg-blue-50 text-slate-600 hover:text-blue-600 flex items-center justify-center transition-all cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.4"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 18l6-6-6-6M8 6l-6 6 6 6" />
                            </svg>
                        </button>
                        <button type="button" onclick="setProfileAvatar('grad')" data-avatar="grad"
                            title="Ikon Pelajar"
                            class="avatar-pick-btn w-8 h-8 rounded-xl bg-slate-100 hover:bg-blue-50 text-slate-600 hover:text-blue-600 flex items-center justify-center transition-all cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                            </svg>
                        </button>
                    </div>

                    <!-- Nama & Email -->
                    <div class="relative z-10 mt-3.5 space-y-1">
                        <h2 id="display-profile-name" class="text-lg sm:text-xl font-extrabold text-slate-900">
                            {{ $userName }}
                        </h2>
                        <p id="display-profile-email" class="text-xs sm:text-sm font-medium text-slate-500">
                            {{ $userEmail }}
                        </p>
                        <div class="pt-2">
                            <span id="display-profile-jenjang-badge"
                                class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-50 border border-blue-100 text-blue-700 text-xs font-extrabold">
                                Kelas Aktif: {{ $currentJenjang }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Kartu Statistik: Total Bintang & Nilai Kelas Sekarang -->
                <div class="bg-white/95 backdrop-blur-xs rounded-3xl border-2 border-white shadow-soft-card p-5 space-y-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-sm font-extrabold text-slate-900">Capaian Belajar Kamu</h3>
                        <span class="text-[11px] font-bold text-slate-400">Ringkasan Progres</span>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <!-- Total Bintang -->
                        <div
                            class="rounded-2xl bg-amber-50/80 border border-amber-200/80 p-3.5 flex flex-col justify-between gap-2">
                            <div class="w-9 h-9 rounded-xl bg-amber-100 text-amber-500 flex items-center justify-center">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-xl sm:text-2xl font-extrabold text-slate-900 leading-tight">
                                    <span id="stat-total-stars">{{ $totalBintang }}</span>
                                </div>
                                <div class="text-[11px] font-bold text-amber-700">Total Bintang</div>
                            </div>
                        </div>

                        <!-- Nilai Kelas Sekarang -->
                        <div
                            class="rounded-2xl bg-[#EBF3FF]/90 border border-blue-200/80 p-3.5 flex flex-col justify-between gap-2">
                            <div
                                class="w-9 h-9 rounded-xl bg-blue-600 text-white flex items-center justify-center shadow-2xs">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M11.25 3v4.046a3 3 0 00-4.277 4.204H1.5v-6A2.25 2.25 0 013.75 3h7.5zM12.75 3v4.011a3 3 0 014.239 4.239H22.5v-6A2.25 2.25 0 0020.25 3h-7.5zM22.5 12.75h-8.983a4.125 4.125 0 004.108 3.75.75.75 0 010 1.5 5.623 5.623 0 01-4.875-2.817V21h7.5a2.25 2.25 0 002.25-2.25v-6zM11.25 21v-5.817A5.623 5.623 0 016.375 18a.75.75 0 010-1.5 4.126 4.126 0 004.108-3.75H1.5v6A2.25 2.25 0 003.75 21h7.5z" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-xl sm:text-2xl font-extrabold text-slate-900 leading-tight">
                                    <span id="stat-class-score">{{ $nilaiKelasSekarang }}</span><span
                                        class="text-xs font-bold text-slate-500"> / 100</span>
                                </div>
                                <div id="stat-class-label" class="text-[11px] font-bold text-blue-700">
                                    Nilai Kelas {{ $currentJenjang }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Progress Bar Nilai Kelas -->
                    <div class="rounded-2xl bg-slate-50 border border-slate-100 p-3 space-y-1.5">
                        <div class="flex items-center justify-between text-xs">
                            <span class="font-bold text-slate-600">Ketuntasan Kelas Sekarang</span>
                            <span id="stat-class-predikat" class="font-extrabold text-emerald-600">Sangat Baik</span>
                        </div>
                        <div class="w-full h-2.5 bg-slate-200/80 rounded-full overflow-hidden">
                            <div id="stat-class-bar"
                                class="h-full bg-gradient-to-r from-blue-500 to-blue-600 rounded-full transition-all duration-300"
                                style="width: {{ min(100, max(0, $nilaiKelasSekarang)) }}%;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- =================================================================
                     KOLOM KANAN (7/12): FORM PENGATURAN PROFIL, LOGOUT & HAPUS AKUN
                ================================================================== -->
            <div class="lg:col-span-7 flex flex-col gap-4">

                <!-- Kartu 1: Edit Nama, Email & Kelas Aktif -->
                <div class="bg-white/95 backdrop-blur-xs rounded-3xl border-2 border-white shadow-soft-card p-6 space-y-5">
                    <div class="flex items-center gap-3 border-b border-slate-100 pb-3.5">
                        <div
                            class="w-10 h-10 rounded-2xl bg-blue-50 border border-blue-100 text-blue-600 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z" />
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-base sm:text-lg font-extrabold text-slate-900">Informasi Akun</h1>
                            <p class="text-xs text-slate-500">Perbarui nama tampilan, alamat email, dan jenjang kelas
                                belajar kamu.</p>
                        </div>
                    </div>

                    <form id="profile-settings-form" action="{{ url('/pengaturan') }}" method="POST"
                        onsubmit="handleSaveProfile(event)" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <!-- Input Nama -->
                        <div class="space-y-1.5">
                            <label for="input-user-name" class="block text-xs font-extrabold text-slate-700">
                                Nama Lengkap
                            </label>
                            <div class="relative">
                                <span
                                    class="pointer-events-none absolute inset-y-0 left-3.5 flex items-center text-slate-400">
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </span>
                                <input type="text" id="input-user-name" name="name"
                                    value="{{ old('name', $userName) }}" required placeholder="Masukkan nama kamu"
                                    class="w-full pl-10 pr-4 py-2.5 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:border-blue-500 text-xs sm:text-sm font-semibold text-slate-800 focus:outline-none transition-colors">
                            </div>
                        </div>

                        <!-- Input Email -->
                        <div class="space-y-1.5">
                            <label for="input-user-email" class="block text-xs font-extrabold text-slate-700">
                                Alamat Email
                            </label>
                            <div class="relative">
                                <span
                                    class="pointer-events-none absolute inset-y-0 left-3.5 flex items-center text-slate-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </span>
                                <input type="email" id="input-user-email" name="email"
                                    value="{{ old('email', $userEmail) }}" required placeholder="nama@email.com"
                                    class="w-full pl-10 pr-4 py-2.5 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:border-blue-500 text-xs sm:text-sm font-semibold text-slate-800 focus:outline-none transition-colors">
                            </div>
                        </div>

                        <!-- Pilihan Kelas Sekarang -->
                        <div class="space-y-1.5">
                            <label for="input-user-jenjang" class="block text-xs font-extrabold text-slate-700">
                                Kelas Belajar Sekarang
                            </label>
                            <select id="input-user-jenjang" name="jenjang"
                                class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:border-blue-500 text-xs sm:text-sm font-bold text-slate-800 focus:outline-none cursor-pointer">
                                <option value="SD" {{ $currentJenjang === 'SD' ? 'selected' : '' }}>SD — Dasar
                                    Berpikir Komputasional</option>
                                <option value="SMP" {{ $currentJenjang === 'SMP' ? 'selected' : '' }}>SMP — Logika
                                    Flowchart & Pemrograman</option>
                                <option value="SMA" {{ $currentJenjang === 'SMA' ? 'selected' : '' }}>SMA — Algoritma &
                                    Percabangan Python</option>
                            </select>
                        </div>

                        <div class="pt-2 flex items-center justify-end gap-2.5">
                            <button type="submit"
                                class="inline-flex items-center gap-2 px-6 py-2.5 rounded-full bg-blue-600 hover:bg-blue-700 text-white text-xs sm:text-sm font-extrabold shadow-soft-blue transition-all cursor-pointer">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                                <span>Simpan Perubahan</span>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Kartu 2: Logout & Hapus Akun -->
                <div class="bg-white/95 backdrop-blur-xs rounded-3xl border-2 border-white shadow-soft-card p-6 space-y-4">
                    <h3 class="text-sm font-extrabold text-slate-900">Sesi & Pengelolaan Akun</h3>

                    <!-- Baris Logout -->
                    <div
                        class="rounded-2xl bg-slate-50 border border-slate-200/80 p-4 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                        <div class="flex items-start gap-3">
                            <div
                                class="w-9 h-9 rounded-xl bg-white border border-slate-200 text-slate-700 flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.3"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-xs sm:text-sm font-extrabold text-slate-900">Keluar dari Akun (Logout)
                                </div>
                                <p class="text-[11px] text-slate-500 mt-0.5">
                                    Akhiri sesi aktif saat ini. Progres yang tersimpan di akun tetap aman.
                                </p>
                            </div>
                        </div>

                        <form action="{{ url('/logout') }}" method="POST" onsubmit="handleGuestLogout(event)"
                            class="shrink-0">
                            @csrf
                            <button type="submit"
                                class="w-full sm:w-auto inline-flex items-center justify-center gap-1.5 px-4 py-2 rounded-full bg-white hover:bg-slate-100 text-slate-700 border border-slate-300 text-xs font-extrabold transition-colors cursor-pointer">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.4"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7" />
                                </svg>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>

                    <!-- Baris Hapus Akun -->
                    <div
                        class="rounded-2xl bg-rose-50/70 border border-rose-200/80 p-4 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                        <div class="flex items-start gap-3">
                            <div
                                class="w-9 h-9 rounded-xl bg-rose-100 text-rose-600 flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.3"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-xs sm:text-sm font-extrabold text-rose-700">Hapus Akun Permanen</div>
                                <p class="text-[11px] text-rose-600/80 mt-0.5">
                                    Seluruh data profil, total bintang, dan riwayat nilai kelas akan dihapus permanen.
                                </p>
                            </div>
                        </div>

                        <button type="button" onclick="openDeleteAccountModal()"
                            class="w-full sm:w-auto inline-flex items-center justify-center gap-1.5 px-4 py-2 rounded-full bg-rose-600 hover:bg-rose-700 text-white text-xs font-extrabold shadow-2xs transition-colors cursor-pointer shrink-0">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.4"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7" />
                            </svg>
                            <span>Hapus Akun</span>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <!-- MODAL KONFIRMASI HAPUS AKUN -->
    <div id="delete-account-modal"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/45 backdrop-blur-xs p-4">
        <div
            class="bg-white rounded-3xl max-w-md w-full p-6 sm:p-7 shadow-2xl border border-slate-100 text-center space-y-4">
            <img src="{{ asset('images/mascot_sad.png') }}" alt="Maskot Sedih" class="w-24 h-24 mx-auto object-contain">

            <div>
                <span class="inline-block px-3 py-1 rounded-full bg-rose-100 text-rose-700 text-[11px] font-extrabold">
                    Tindakan Permanen
                </span>
                <h3 class="text-lg sm:text-xl font-extrabold text-slate-900 mt-2">
                    Yakin Ingin Menghapus Akun?
                </h3>
                <p class="text-xs sm:text-sm text-slate-600 mt-1.5 leading-relaxed">
                    Semua capaian <strong>Total Bintang</strong> dan <strong>Nilai Kelas</strong> kamu akan hilang dan tidak
                    dapat dikembalikan lagi.
                </p>
            </div>

            <form action="{{ url('/akun/hapus') }}" method="POST" onsubmit="handleGuestDeleteAccount(event)"
                class="pt-2 flex flex-col sm:flex-row gap-2.5">
                @csrf
                @method('DELETE')

                <button type="button" onclick="closeDeleteAccountModal()"
                    class="flex-1 py-2.5 px-4 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs sm:text-sm transition-colors cursor-pointer">
                    Batal
                </button>

                <button type="submit"
                    class="flex-1 py-2.5 px-4 rounded-full bg-rose-600 hover:bg-rose-700 text-white font-extrabold text-xs sm:text-sm shadow-2xs transition-colors cursor-pointer">
                    Ya, Hapus Akun
                </button>
            </form>
        </div>
    </div>

    <script>
        const IS_GUEST_MODE = @json($isGuest);

        const avatarSvgs = {
            user: `<svg class="w-12 h-12" viewBox="0 0 24 24" fill="currentColor"><path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd"/></svg>`,
            code: `<svg class="w-12 h-12" fill="none" stroke="currentColor" stroke-width="2.3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 18l6-6-6-6M8 6l-6 6 6 6"/></svg>`,
            grad: `<svg class="w-12 h-12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>`
        };

        function setProfileAvatar(type) {
            const box = document.getElementById('profile-avatar-box');
            if (box && avatarSvgs[type]) {
                box.innerHTML = avatarSvgs[type];
                localStorage.setItem('codepawth_avatar', type);
            }

            document.querySelectorAll('.avatar-pick-btn').forEach(btn => {
                const active = btn.dataset.avatar === type;
                btn.className = active ?
                    'avatar-pick-btn w-8 h-8 rounded-xl bg-blue-600 text-white flex items-center justify-center shadow-2xs transition-all cursor-pointer' :
                    'avatar-pick-btn w-8 h-8 rounded-xl bg-slate-100 hover:bg-blue-50 text-slate-600 hover:text-blue-600 flex items-center justify-center transition-all cursor-pointer';
            });
        }

        function handleSaveProfile(e) {
            const nameVal = document.getElementById('input-user-name').value.trim();
            const emailVal = document.getElementById('input-user-email').value.trim();
            const jenjangVal = document.getElementById('input-user-jenjang').value;

            // Jika belum memakai controller backend (Mode Tamu), simpan langsung di browser
            if (IS_GUEST_MODE) {
                e.preventDefault();
                localStorage.setItem('codepawth_guest_name', nameVal);
                localStorage.setItem('codepawth_guest_email', emailVal);
                localStorage.setItem('codepawth_guest_jenjang', jenjangVal);

                syncProfileDisplay(nameVal, emailVal, jenjangVal);

                const toast = document.getElementById('settings-toast');
                toast.classList.remove('hidden');
                toast.classList.add('flex');
                setTimeout(() => {
                    toast.classList.add('hidden');
                    toast.classList.remove('flex');
                }, 3000);
            }
        }

        function syncProfileDisplay(name, email, jenjang) {
            document.getElementById('display-profile-name').textContent = name;
            document.getElementById('display-profile-email').textContent = email;
            document.getElementById('display-profile-jenjang-badge').textContent = `Kelas Aktif: ${jenjang}`;
            document.getElementById('stat-class-label').textContent = `Nilai Kelas ${jenjang}`;
        }

        function openDeleteAccountModal() {
            const modal = document.getElementById('delete-account-modal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeDeleteAccountModal() {
            const modal = document.getElementById('delete-account-modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function handleGuestLogout(e) {
            if (IS_GUEST_MODE) {
                e.preventDefault();
                window.location.href = "{{ url('/') }}";
            }
        }

        function handleGuestDeleteAccount(e) {
            if (IS_GUEST_MODE) {
                e.preventDefault();
                localStorage.removeItem('codepawth_guest_name');
                localStorage.removeItem('codepawth_guest_email');
                localStorage.removeItem('codepawth_guest_jenjang');
                localStorage.removeItem('codepawth_avatar');
                window.location.href = "{{ url('/') }}";
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            const savedAvatar = localStorage.getItem('codepawth_avatar') || 'user';
            setProfileAvatar(savedAvatar);

            if (IS_GUEST_MODE) {
                const savedName = localStorage.getItem('codepawth_guest_name');
                const savedEmail = localStorage.getItem('codepawth_guest_email');
                const savedJenjang = localStorage.getItem('codepawth_guest_jenjang');

                if (savedName) document.getElementById('input-user-name').value = savedName;
                if (savedEmail) document.getElementById('input-user-email').value = savedEmail;
                if (savedJenjang) document.getElementById('input-user-jenjang').value = savedJenjang;

                syncProfileDisplay(
                    savedName || @json($userName),
                    savedEmail || @json($userEmail),
                    savedJenjang || @json($currentJenjang)
                );
            }
        });
    </script>
@endsection
