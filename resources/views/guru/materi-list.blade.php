@extends('layouts.app')

@section('title', 'Materi Saya')

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
                 KONTEN UTAMA MATERI SAYA
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
                <span class="text-slate-700">Materi Saya</span>
            </nav>

            {{-- HERO HEADER --}}
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

                <div class="relative z-10 max-w-2xl space-y-3">
                    <div
                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-50 border border-blue-100 text-[11px] font-extrabold uppercase tracking-wider text-blue-600">
                        <svg class="w-3.5 h-3.5 text-blue-600" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M11.25 4.533A9.707 9.707 0 006 3a9.735 9.735 0 00-3.25.555.75.75 0 00-.5.707v14.25a.75.75 0 001 .707A8.237 8.237 0 016 18.75c1.995 0 3.823.707 5.25 1.886V4.533zM12.75 20.636A8.214 8.214 0 0118 18.75c.966 0 1.89.166 2.75.47a.75.75 0 001-.708V4.262a.75.75 0 00-.5-.707A9.735 9.735 0 0018 3a9.707 9.707 0 00-5.25 1.533v16.103z" />
                        </svg>
                        <span>PERPUSTAKAAN GURU</span>
                    </div>

                    <h1 class="text-2xl sm:text-4xl font-extrabold tracking-tight text-slate-900">
                        Materi <span class="text-blue-600">Saya</span>
                    </h1>

                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed max-w-xl">
                        Kelola semua materi yang pernah dibuat, atur penugasan kelas, atau lanjutkan penyusunan draft.
                    </p>

                    <div class="pt-1">
                        <a href="{{ route('guru.studio') }}"
                            class="inline-flex items-center gap-2 rounded-full bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 text-xs font-extrabold shadow-soft-blue transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            <span>Buat Materi Baru</span>
                        </a>
                    </div>
                </div>

                <div class="relative z-10 shrink-0">
                    <img src="{{ asset('images/mascot_dashboard.png') }}" alt="Maskot CodePawth"
                        class="w-32 h-32 sm:w-40 sm:h-40 object-contain drop-shadow-sm">
                </div>
            </section>

            {{-- DAFTAR MATERI --}}
            <div class="space-y-4">
                @forelse ($materials as $material)
                    <article
                        class="group bg-white/95 backdrop-blur-sm rounded-3xl border border-white shadow-soft-card p-5 sm:p-6 transition-all duration-200 hover:-translate-y-0.5 hover:shadow-lg">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-5">

                            <div class="space-y-2.5 min-w-0">
                                {{-- BADGES JENIS, JENJANG & STATUS --}}
                                <div class="flex flex-wrap items-center gap-2">
                                    <span
                                        class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-blue-50 border border-blue-100 text-[10px] font-extrabold uppercase tracking-wider text-blue-700">
                                        {{ strtoupper($material->type) }}
                                    </span>

                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full bg-indigo-50 border border-indigo-100 text-[10px] font-extrabold text-indigo-700">
                                        {{ $material->level }}
                                    </span>

                                    @if ($material->status === 'published')
                                        <span
                                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 border border-emerald-200 text-[10px] font-extrabold text-emerald-700">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            <span>Diterbitkan</span>
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-50 border border-amber-200 text-[10px] font-extrabold text-amber-700">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                            <span>Draft</span>
                                        </span>
                                    @endif
                                </div>

                                {{-- JUDUL MATERI --}}
                                <h2 class="text-base sm:text-lg font-extrabold text-slate-900 break-words">
                                    {{ $material->title }}
                                </h2>

                                {{-- INFO KELAS --}}
                                <div class="flex items-center gap-2 text-xs font-semibold text-slate-500">
                                    <svg class="w-4 h-4 text-slate-400 shrink-0" viewBox="0 0 24 24" fill="currentColor">
                                        <path
                                            d="M4.5 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM14.25 8.625a3.375 3.375 0 116.75 0 3.375 3.375 0 01-6.75 0zM1.5 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM17.25 19.128l-.001.144a2.25 2.25 0 01-.233.96 10.088 10.088 0 005.06-1.01.75.75 0 00.42-.643 4.875 4.875 0 00-6.957-4.611 8.586 8.586 0 011.71 5.157v.003z" />
                                    </svg>
                                    <span>
                                        Kelas:
                                        <strong class="text-slate-700 font-bold">
                                            {{ $material->learningClass?->name ?? 'Belum memilih kelas' }}
                                        </strong>
                                    </span>
                                </div>
                            </div>

                            {{-- TOMBOL AKSI --}}
                            <div class="flex flex-wrap items-center gap-2.5 shrink-0">
                                <a href="{{ route('guru.materi.edit', $material) }}"
                                    class="inline-flex items-center gap-1.5 rounded-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 text-xs font-extrabold shadow-soft-blue transition-all">
                                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="currentColor">
                                        <path
                                            d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32l8.4-8.4z" />
                                    </svg>
                                    <span>Edit Materi</span>
                                </a>

                                <a href="{{ route('materi.kelas.show', $material) }}"
                                    class="inline-flex items-center gap-1.5 rounded-full bg-blue-50 hover:bg-blue-100 text-blue-700 border border-blue-100 px-4 py-2.5 text-xs font-extrabold transition-all">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span>Lihat Materi</span>
                                </a>
                            </div>

                        </div>
                    </article>
                @empty
                    <div
                        class="bg-white/95 backdrop-blur-sm rounded-3xl border border-dashed border-blue-200 p-10 sm:p-12 text-center space-y-3">
                        <img src="{{ asset('images/mascot_peek.png') }}" alt="Maskot CodePawth"
                            class="w-28 h-28 object-contain mx-auto mb-2 drop-shadow-xs">

                        <h2 class="text-lg sm:text-xl font-extrabold text-slate-900">
                            Belum Ada Materi
                        </h2>

                        <p class="text-xs sm:text-sm text-slate-500 max-w-md mx-auto leading-relaxed">
                            Yuk, buat materi pertama menggunakan template interaktif di Studio Konten!
                        </p>

                        <div class="pt-2">
                            <a href="{{ route('guru.studio') }}"
                                class="inline-flex items-center gap-2 rounded-full bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 text-xs font-extrabold shadow-soft-blue transition-all">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M11.644 1.59a.75.75 0 01.712 0l9.75 5.25a.75.75 0 010 1.32l-9.75 5.25a.75.75 0 01-.712 0l-9.75-5.25a.75.75 0 010-1.32l9.75-5.25z" />
                                    <path
                                        d="M3.265 10.602l7.668 4.129a2.25 2.25 0 002.134 0l7.668-4.13 1.37.739a.75.75 0 010 1.32l-9.75 5.25a.75.75 0 01-.71 0l-9.75-5.25a.75.75 0 010-1.32l1.37-.738z" />
                                </svg>
                                <span>Pilih Template</span>
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
@endsection
