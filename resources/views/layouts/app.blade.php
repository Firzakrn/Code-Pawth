<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Code Pawth — Platform Belajar Pemrograman Adaptif')</title>

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    boxShadow: {
                        'soft-card': '0 8px 24px -6px rgba(30, 64, 175, 0.08)',
                        'soft-blue': '0 10px 24px -6px rgba(37, 99, 235, 0.32)',
                    }
                }
            }
        }
    </script>

    <style>
        body {
            background: linear-gradient(180deg, #ECF4FF 0%, #E3EEFF 100%);
            color: #0F172A;
        }
    </style>

    @stack('styles')
</head>

@php
    $user = auth()->user();
    // Sesuaikan pengecekan role guru dengan struktur database-mu (misal: role === 'guru')
    $isGuru =
        $user &&
        (in_array(strtolower($user->role ?? ''), ['guru', 'teacher', 'pengajar']) ||
            ($user->is_guru ?? false) ||
            request()->routeIs('guru.*'));
@endphp

<body class="min-h-screen lg:h-screen lg:overflow-hidden flex flex-col lg:flex-row relative">
    @includeIf('additional')

    <!-- =====================================================================
         SIDEBAR NAVIGASI DINAMIS (SISWA / TAMU VS GURU)
    ====================================================================== -->
    <aside id="app-sidebar"
        class="w-full lg:w-64 bg-white/95 backdrop-blur-md border-b lg:border-b-0 lg:border-r border-slate-200/80 flex flex-col justify-between shrink-0 z-30 relative transition-all duration-300 ease-in-out">

        <!-- TOMBOL FLOATING DI TEPI KANAN SIDEBAR -->
        <button type="button" id="sidebar-toggle-btn" onclick="toggleSidebar()" title="Kecilkan Menu"
            class="hidden lg:flex absolute -right-3.5 top-5 z-40 w-7 h-7 rounded-full bg-white hover:bg-blue-600 text-slate-600 hover:text-white border border-slate-200 hover:border-blue-600 shadow-md items-center justify-center transition-all duration-200 cursor-pointer">
            <svg id="sidebar-collapse-icon" class="w-3.5 h-3.5 transition-transform duration-300" fill="none"
                stroke="currentColor" stroke-width="2.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
        </button>

        <!-- Bagian Atas: Logo, Status Role/Jenjang, & Menu -->
        <div class="relative z-10">
            <!-- Header Logo -->
            <div id="sidebar-header" class="px-5 py-4 flex items-center justify-between gap-2">
                <a href="{{ $isGuru ? route('guru.dashboard') : url('/') }}" title="Beranda CodePawth"
                    class="flex items-center gap-2.5 group min-w-0">
                    <div
                        class="w-9 h-9 rounded-xl bg-blue-50 border border-blue-100 flex items-center justify-center text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors shrink-0">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                            stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="16 18 22 12 16 6"></polyline>
                            <polyline points="8 6 2 12 8 18"></polyline>
                            <line x1="14" y1="4" x2="10" y2="20"></line>
                        </svg>
                    </div>
                    <span class="sidebar-label text-xl font-extrabold tracking-tight text-slate-900 truncate">
                        Code<span class="text-blue-600">Pawth</span>
                    </span>
                </a>

                <!-- Tombol Menu Mobile -->
                <button type="button" onclick="document.getElementById('mobile-nav').classList.toggle('hidden')"
                    class="lg:hidden p-2 rounded-lg text-slate-500 hover:bg-slate-100 cursor-pointer">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>

            <!-- Kotak Status (Berbeda antara Guru vs Siswa/Tamu) -->
            <div class="px-3.5 pb-3">
                @if ($isGuru)
                    <!-- STATUS MODE PENGAJAR (KHUSUS GURU) -->
                    <div id="sidebar-status-expanded"
                        class="rounded-2xl bg-gradient-to-br from-blue-50 to-indigo-50/80 border border-blue-200/70 p-3.5 shadow-2xs">
                        <div class="flex items-center justify-between gap-2">
                            <span
                                class="inline-flex items-center gap-1.5 text-[11px] font-extrabold uppercase tracking-wider text-blue-600">
                                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                Mode Pengajar
                            </span>
                            <span
                                class="px-2 py-0.5 rounded-full bg-white text-[10px] font-extrabold text-blue-700 border border-blue-100">
                                GURU
                            </span>
                        </div>

                        <div class="mt-2 flex items-center justify-between">
                            <div>
                                <p class="text-xs font-bold text-slate-500">Kelas Dikelola</p>
                                <p class="text-sm font-extrabold text-slate-900">
                                    {{ isset($classes) ? $classes->count() : $user->teachingClasses()->count() }} Kelas
                                    Aktif
                                </p>
                            </div>
                            <div
                                class="w-8 h-8 rounded-xl bg-white border border-blue-100 flex items-center justify-center text-blue-600 shadow-2xs">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Tampilan Ringkas Guru Saat Collapsed -->
                    <div id="sidebar-status-collapsed"
                        class="hidden rounded-2xl bg-blue-50 border border-blue-200/80 py-2.5 px-1 text-center"
                        title="Mode Pengajar (Guru)">
                        <span class="block text-[10px] font-extrabold text-blue-600 uppercase">GURU</span>
                        <span class="block text-xs font-extrabold text-slate-800 mt-0.5">
                            {{ isset($classes) ? $classes->count() : $user->teachingClasses()->count() }} Kls
                        </span>
                    </div>
                @else
                    <!-- STATUS JENJANG & LEVEL (SISWA / TAMU) -->
                    <div id="sidebar-status-expanded"
                        class="rounded-2xl bg-gradient-to-br from-blue-50 to-indigo-50/70 border border-blue-200/70 p-3.5 shadow-2xs">
                        <div class="flex items-center justify-between gap-2">
                            <span
                                class="inline-flex items-center gap-1.5 text-[11px] font-extrabold uppercase tracking-wider text-blue-600">
                                <span class="w-2 h-2 rounded-full bg-blue-600 animate-pulse"></span>
                                Jenjang <span id="sidebar-jenjang-text">SD</span>
                            </span>
                            <a href="{{ url('/') }}#jenjang-section" title="Ganti Jenjang"
                                class="text-[11px] font-bold text-slate-400 hover:text-blue-600 transition-colors">
                                Ganti
                            </a>
                        </div>

                        <div class="mt-1.5 flex items-baseline justify-between">
                            <div class="text-sm font-extrabold text-slate-900">
                                Level <span id="sidebar-current-lvl">2</span>
                                <span class="font-semibold text-slate-500 text-xs">dari <span
                                        id="sidebar-total-lvl">5</span></span>
                            </div>
                            <span id="sidebar-lvl-percent" class="text-[11px] font-bold text-blue-600">40%</span>
                        </div>

                        <div class="mt-2 w-full h-1.5 bg-white rounded-full overflow-hidden border border-blue-100">
                            <div id="sidebar-lvl-bar"
                                class="h-full bg-blue-600 rounded-full transition-all duration-300"
                                style="width: 40%;"></div>
                        </div>
                    </div>

                    <!-- Tampilan Ringkas Siswa Saat Collapsed -->
                    <div id="sidebar-status-collapsed"
                        class="hidden rounded-2xl bg-blue-50 border border-blue-200/80 py-2.5 px-1 text-center"
                        title="Jenjang SD • Level 2 dari 5">
                        <span id="sidebar-jenjang-mini"
                            class="block text-[11px] font-extrabold text-blue-600 uppercase">SD</span>
                        <span class="block text-xs font-extrabold text-slate-800 mt-0.5">
                            <span id="sidebar-current-lvl-mini">2</span>/<span id="sidebar-total-lvl-mini">5</span>
                        </span>
                    </div>
                @endif
            </div>

            <!-- Menu Navigasi -->
            <nav id="mobile-nav" class="hidden lg:block px-3.5 pb-3 space-y-1 text-sm font-semibold">

                @if ($isGuru)
                    <!-- ================= MENU KHUSUS GURU ================= -->
                    <!-- 1. Beranda (Dashboard Guru) -->
                    <a href="{{ route('guru.dashboard') }}"
                        data-nav-active="{{ request()->routeIs('guru.dashboard') ? 'true' : 'false' }}"
                        title="Beranda Guru"
                        class="sidebar-nav-item flex items-center gap-3 px-3.5 py-2.5 rounded-2xl transition-colors {{ request()->routeIs('guru.dashboard') ? 'bg-blue-50/95 text-blue-600 shadow-2xs' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                        <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.061 1.06l8.69-8.69z" />
                            <path
                                d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.43z" />
                        </svg>
                        <span class="sidebar-label truncate">Beranda</span>
                    </a>

                    <!-- 2. Studio Konten (Menggantikan Knowledge Card untuk Guru) -->
                    <a href="{{ route('guru.studio') }}"
                        data-nav-active="{{ request()->routeIs('guru.studio*') ? 'true' : 'false' }}"
                        title="Studio Konten"
                        class="sidebar-nav-item flex items-center gap-3 px-3.5 py-2.5 rounded-2xl transition-colors {{ request()->routeIs('guru.studio*') ? 'bg-blue-50/95 text-blue-600 shadow-2xs' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                        <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M20.599 1.5c-.376 0-.743.111-1.055.32l-5.08 3.385a18.747 18.747 0 00-3.471 2.987 10.04 10.04 0 014.815 4.815 18.748 18.748 0 002.987-3.472l3.386-5.079A1.902 1.902 0 0020.599 1.5zm-8.3 14.025a18.76 18.76 0 001.896-1.207 8.026 8.026 0 00-4.513-4.513A18.75 18.75 0 008.475 11.7l-.278.5a5.26 5.26 0 013.601 3.602l.502-.278zM6.75 13.5A3.75 3.75 0 003 17.25a1.5 1.5 0 01-1.601 1.497.75.75 0 00-.7 1.123 5.25 5.25 0 009.8-2.62 3.75 3.75 0 00-3.75-3.75z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="sidebar-label truncate">Studio Konten</span>
                    </a>

                    <!-- 3. Rekap Nilai (Fitur Eksklusif Guru) -->
                    <a href="{{ Route::has('guru.rekap-nilai') ? route('guru.rekap-nilai') : url('/guru/rekap-nilai') }}"
                        data-nav-active="{{ request()->routeIs('guru.rekap-nilai*') || request()->is('guru/rekap-nilai*') ? 'true' : 'false' }}"
                        title="Rekap Nilai Siswa"
                        class="sidebar-nav-item flex items-center justify-between gap-2 px-3.5 py-2.5 rounded-2xl transition-colors {{ request()->routeIs('guru.rekap-nilai*') || request()->is('guru/rekap-nilai*') ? 'bg-blue-50/95 text-blue-600 shadow-2xs' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                        <div class="flex items-center gap-3 min-w-0">
                            <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M2.25 13.5a8.25 8.25 0 018.25-8.25.75.75 0 01.75.75v6.75H18a.75.75 0 01.75.75 8.25 8.25 0 01-16.5 0z"
                                    clip-rule="evenodd" />
                                <path fill-rule="evenodd"
                                    d="M12.75 3a.75.75 0 01.75-.75 8.25 8.25 0 018.25 8.25.75.75 0 01-.75.75h-7.5a.75.75 0 01-.75-.75V3z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="sidebar-label truncate">Rekap Nilai</span>
                        </div>
                        <span
                            class="sidebar-label px-1.5 py-0.5 text-[9px] font-extrabold uppercase tracking-wider rounded-md bg-blue-100 text-blue-700 shrink-0">
                            Guru
                        </span>
                    </a>
                @else
                    <!-- ================= MENU SISWA / TAMU ================= -->
                    <!-- 1. Beranda (Peta Level) -->
                    <a href="{{ url('/level-view') }}"
                        data-nav-active="{{ request()->is('level-view*') ? 'true' : 'false' }}"
                        title="Beranda (Peta Level)"
                        class="sidebar-nav-item flex items-center gap-3 px-3.5 py-2.5 rounded-2xl transition-colors {{ request()->is('level-view*') ? 'bg-blue-50/95 text-blue-600 shadow-2xs' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                        <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.061 1.06l8.69-8.69z" />
                            <path
                                d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.43z" />
                        </svg>
                        <span class="sidebar-label truncate">Beranda</span>
                    </a>

                    <!-- 2. Knowledge Card -->
                    <a href="{{ url('/knowledge-card') }}"
                        data-nav-active="{{ request()->is('knowledge-card*') ? 'true' : 'false' }}"
                        title="Knowledge Card"
                        class="sidebar-nav-item flex items-center gap-3 px-3.5 py-2.5 rounded-2xl transition-colors {{ request()->is('knowledge-card*') ? 'bg-blue-50/95 text-blue-600 shadow-2xs' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                        <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M11.25 4.533A9.707 9.707 0 006 3a9.735 9.735 0 00-3.25.555.75.75 0 00-.5.707v14.25a.75.75 0 001 .707A8.237 8.237 0 016 18.75c1.995 0 3.823.707 5.25 1.886V4.533zM12.75 20.636A8.214 8.214 0 0118 18.75c.966 0 1.89.166 2.75.47a.75.75 0 001-.708V4.262a.75.75 0 00-.5-.707A9.735 9.735 0 0018 3a9.707 9.707 0 00-5.25 1.533v16.103z" />
                        </svg>
                        <span class="sidebar-label truncate">Knowledge Card</span>
                    </a>
                @endif

                <!-- ================= MENU UMUM (SEMUA ROLE) ================= -->
                <!-- Pengaturan -->
                <a href="{{ url('/pengaturan') }}"
                    data-nav-active="{{ request()->is('pengaturan*') ? 'true' : 'false' }}" title="Pengaturan"
                    class="sidebar-nav-item flex items-center gap-3 px-3.5 py-2.5 rounded-2xl transition-colors {{ request()->is('pengaturan*') ? 'bg-blue-50/95 text-blue-600 shadow-2xs' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                    <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M11.078 2.25c-.917 0-1.699.663-1.85 1.567L9.05 4.889c-.02.12-.115.26-.297.348a7.493 7.493 0 00-.986.57c-.166.115-.334.126-.45.083L6.3 5.508a1.875 1.875 0 00-2.282.819l-.922 1.597a1.875 1.875 0 00.432 2.385l.84.692c.095.078.17.229.154.43a7.598 7.598 0 000 1.139c.015.2-.059.352-.153.43l-.841.692a1.875 1.875 0 00-.432 2.385l.922 1.597a1.875 1.875 0 002.282.818l1.019-.382c.115-.043.283-.031.45.082.312.214.641.405.985.57.182.088.277.228.297.35l.178 1.071c.151.904.933 1.567 1.85 1.567h1.844c.916 0 1.699-.663 1.85-1.567l.178-1.072c.02-.12.114-.26.297-.349.344-.165.673-.356.985-.57.167-.114.335-.125.45-.082l1.02.382a1.875 1.875 0 002.28-.819l.923-1.597a1.875 1.875 0 00-.432-2.385l-.84-.692c-.095-.078-.17-.229-.154-.43a7.614 7.614 0 000-1.139c-.016-.2.059-.352.153-.43l.84-.692c.708-.582.891-1.59.433-2.385l-.922-1.597a1.875 1.875 0 00-2.282-.818l-1.02.382c-.114.043-.282.031-.449-.083a7.49 7.49 0 00-.985-.57c-.183-.087-.277-.227-.297-.348l-.179-1.072a1.875 1.875 0 00-1.85-1.567h-1.843zM12 15.75a3.75 3.75 0 100-7.5 3.75 3.75 0 000 7.5z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="sidebar-label truncate">Pengaturan</span>
                </a>

                <!-- Bantuan -->
                <button type="button" onclick="openAdditionalDrawer('bantuan')" title="Bantuan"
                    class="w-full sidebar-nav-item flex items-center gap-3 px-3.5 py-2.5 rounded-2xl text-slate-600 hover:bg-slate-50 hover:text-blue-600 transition-colors cursor-pointer">
                    <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm11.378-3.917c-.89-.777-2.366-.777-3.255 0a.75.75 0 01-.988-1.129c1.454-1.272 3.776-1.272 5.23 0 1.513 1.324 1.513 3.518 0 4.842a3.75 3.75 0 01-.837.552c-.676.328-1.028.774-1.028 1.152v.75a.75.75 0 01-1.5 0v-.75c0-1.279 1.06-2.107 1.875-2.502.182-.088.351-.199.503-.331.83-.727.83-1.857 0-2.584zM12 18a.75.75 0 100-1.5.75.75 0 000 1.5z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="sidebar-label truncate">Bantuan</span>
                </button>
            </nav>
        </div>

        <!-- Bagian Bawah: Footer Normal vs Footer Mini -->
        <div class="hidden lg:block select-none">
            <div id="sidebar-footer-expanded"
                class="flex flex-col items-center justify-end relative pt-4 pb-4 px-3 overflow-hidden">
                <svg class="absolute bottom-0 left-0 w-full h-40 pointer-events-none z-0" viewBox="0 0 260 180"
                    preserveAspectRatio="xMidYMax slice" fill="none">
                    <circle cx="35" cy="115" r="55" fill="#DCEAFF" />
                    <circle cx="115" cy="95" r="65" fill="#E4EFFF" />
                    <circle cx="205" cy="110" r="60" fill="#DCEAFF" />
                    <rect x="0" y="110" width="260" height="70" fill="#E4EFFF" />
                    <circle cx="25" cy="148" r="45" fill="#F4F8FF" />
                    <circle cx="95" cy="138" r="52" fill="#FFFFFF" />
                    <circle cx="170" cy="142" r="48" fill="#F4F8FF" />
                    <circle cx="235" cy="150" r="42" fill="#FFFFFF" />
                    <rect x="0" y="145" width="260" height="35" fill="#FFFFFF" />
                </svg>

                <img src="{{ asset('images/mascot_loveya.png') }}" alt="Maskot Code Pawth"
                    class="relative z-10 w-24 h-24 object-contain -mb-1.5 drop-shadow-xs">

                <div
                    class="relative z-10 bg-white/95 rounded-full px-4 py-2 shadow-sm border border-blue-100/80 text-center">
                    <p class="text-[11px] font-bold text-slate-700 leading-snug">
                        @if ($isGuru)
                            Semangat mengajar,<br>
                            <span class="text-blue-600">Inspirator Kode!</span>
                        @else
                            Semangat belajar,<br>
                            <span class="text-blue-600">Future Coder!</span>
                        @endif
                    </p>
                </div>
            </div>

            <div id="sidebar-footer-collapsed" class="hidden flex-col items-center justify-center pb-4 px-2">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-b from-blue-50 to-blue-100/80 border border-blue-200/70 flex items-center justify-center p-1 shadow-2xs"
                    title="{{ $isGuru ? 'Semangat mengajar, Inspirator Kode!' : 'Semangat belajar, Future Coder!' }}">
                    <img src="{{ asset('images/mascot_loveya.png') }}" alt="Maskot Mini"
                        class="w-10 h-10 object-contain">
                </div>
            </div>
        </div>
    </aside>

    <!-- =====================================================================
         AREA KONTEN UTAMA
    ====================================================================== -->
    <div class="flex-1 flex flex-col min-w-0 min-h-0 relative overflow-y-auto">
        @yield('content')
    </div>

    <!-- Script Global Sidebar (Collapse) -->
    <script>
        function applySidebarState(isCollapsed) {
            const sidebar = document.getElementById('app-sidebar');
            const header = document.getElementById('sidebar-header');
            const toggleBtn = document.getElementById('sidebar-toggle-btn');
            const collapseIcon = document.getElementById('sidebar-collapse-icon');
            const statusExpanded = document.getElementById('sidebar-status-expanded');
            const statusCollapsed = document.getElementById('sidebar-status-collapsed');
            const footerExpanded = document.getElementById('sidebar-footer-expanded');
            const footerCollapsed = document.getElementById('sidebar-footer-collapsed');
            const labels = document.querySelectorAll('.sidebar-label');
            const navItems = document.querySelectorAll('.sidebar-nav-item');

            if (!sidebar) return;

            if (isCollapsed) {
                sidebar.classList.remove('lg:w-64');
                sidebar.classList.add('lg:w-[80px]');
                header?.classList.remove('px-5', 'justify-between');
                header?.classList.add('px-2', 'justify-center');
                collapseIcon?.classList.add('rotate-180');
                if (toggleBtn) toggleBtn.title = 'Perbesar Menu';
                statusExpanded?.classList.add('hidden');
                statusCollapsed?.classList.remove('hidden');
                footerExpanded?.classList.add('hidden');
                footerCollapsed?.classList.remove('hidden');
                footerCollapsed?.classList.add('flex');
                labels.forEach(el => el.classList.add('lg:hidden'));
                navItems.forEach(el => el.classList.add('lg:justify-center', 'lg:px-0'));
            } else {
                sidebar.classList.add('lg:w-64');
                sidebar.classList.remove('lg:w-[80px]');
                header?.classList.add('px-5', 'justify-between');
                header?.classList.remove('px-2', 'justify-center');
                collapseIcon?.classList.remove('rotate-180');
                if (toggleBtn) toggleBtn.title = 'Kecilkan Menu';
                statusExpanded?.classList.remove('hidden');
                statusCollapsed?.classList.add('hidden');
                footerExpanded?.classList.remove('hidden');
                footerCollapsed?.classList.add('hidden');
                footerCollapsed?.classList.remove('flex');
                labels.forEach(el => el.classList.remove('lg:hidden'));
                navItems.forEach(el => el.classList.remove('lg:justify-center', 'lg:px-0'));
            }
        }

        function toggleSidebar() {
            const currentlyCollapsed = localStorage.getItem('codepawth_sidebar_collapsed') === 'true';
            const nextState = !currentlyCollapsed;
            localStorage.setItem('codepawth_sidebar_collapsed', nextState);
            applySidebarState(nextState);
        }

        document.addEventListener('DOMContentLoaded', () => {
            const isCollapsed = localStorage.getItem('codepawth_sidebar_collapsed') === 'true';
            applySidebarState(isCollapsed);
        });
    </script>

    @stack('scripts')
</body>

</html>
