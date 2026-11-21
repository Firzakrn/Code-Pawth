@extends('layouts.app')

@php
    $jenjangParam = strtoupper(request('jenjang', 'SD'));
    $levelParam = (int) request('level', 1);

    $isAdvancedJenjang = in_array($jenjangParam, ['SMP', 'SMA']);

    $hasFlowchart = request()->has('flowchart')
        ? filter_var(request('flowchart'), FILTER_VALIDATE_BOOLEAN)
        : $isAdvancedJenjang;

    $hasCoding = request()->has('coding') ? filter_var(request('coding'), FILTER_VALIDATE_BOOLEAN) : $isAdvancedJenjang;

    $materiQuery =
        "jenjang={$jenjangParam}&level={$levelParam}&flowchart=" .
        ($hasFlowchart ? '1' : '0') .
        '&coding=' .
        ($hasCoding ? '1' : '0');
    $currentStep = trim($__env->yieldContent('materi_step', 'flashcard'));

    // =========================================================================
    // DATA MATERI TERPUSAT (SIAP MIGRASI KE DATABASE)
    // =========================================================================
    $materiCatalog = [
        'SD-1' => [
            'levelTitle' => 'Kenalan dengan Python',
            'items' => [
                [
                    'id' => 1,
                    'pair_id' => 1,
                    'kategori' => 'front',
                    'judul' => 'Fungsi Output',
                    'main_materi' => 'Perintah dasar Python untuk mencetak informasi ke konsol',
                    'isi_materi' => 'print()',
                    'iconKey' => 'monitor',
                ],
                [
                    'id' => 2,
                    'pair_id' => 1,
                    'kategori' => 'back',
                    'judul' => 'Penjelasan Fungsi',
                    'main_materi' => 'Contoh: print("Halo, CodePawth!")',
                    'isi_materi' => 'Menampilkan teks atau hasil ke layar',
                    'iconKey' => 'monitor',
                ],
                [
                    'id' => 3,
                    'pair_id' => 2,
                    'kategori' => 'front',
                    'judul' => 'Tipe Data Teks',
                    'main_materi' => 'Jenis data yang diapit oleh tanda kutip dua atau satu',
                    'isi_materi' => 'String (str)',
                    'iconKey' => 'text',
                ],
                [
                    'id' => 4,
                    'pair_id' => 2,
                    'kategori' => 'back',
                    'judul' => 'Penjelasan Tipe Data',
                    'main_materi' => 'Contoh: nama = "Budi Santoso"',
                    'isi_materi' => 'Menyimpan data berupa teks atau kalimat',
                    'iconKey' => 'text',
                ],
                [
                    'id' => 5,
                    'pair_id' => 3,
                    'kategori' => 'front',
                    'judul' => 'Tipe Data Angka',
                    'main_materi' => 'Jenis data numerik tanpa koma desimal',
                    'isi_materi' => 'Integer (int)',
                    'iconKey' => 'number',
                ],
                [
                    'id' => 6,
                    'pair_id' => 3,
                    'kategori' => 'back',
                    'judul' => 'Penjelasan Tipe Data',
                    'main_materi' => 'Contoh: umur = 12',
                    'isi_materi' => 'Menyimpan angka bilangan bulat',
                    'iconKey' => 'number',
                ],
                [
                    'id' => 7,
                    'pair_id' => 4,
                    'kategori' => 'front',
                    'judul' => 'Fungsi Masukan',
                    'main_materi' => 'Perintah untuk membaca ketikan dari pengguna',
                    'isi_materi' => 'input()',
                    'iconKey' => 'keyboard',
                ],
                [
                    'id' => 8,
                    'pair_id' => 4,
                    'kategori' => 'back',
                    'judul' => 'Penjelasan Fungsi',
                    'main_materi' => 'Contoh: kota = input("Asal kota: ")',
                    'isi_materi' => 'Menerima masukan data dari pengguna',
                    'iconKey' => 'keyboard',
                ],
            ],
        ],

        'SD-2' => [
            'levelTitle' => 'Variabel & Operasi Hitung',
            'items' => [
                [
                    'id' => 9,
                    'pair_id' => 5,
                    'kategori' => 'front',
                    'judul' => 'Konsep Penyimpanan',
                    'main_materi' => 'Nama pengenal untuk menampung nilai di memori',
                    'isi_materi' => 'Variabel',
                    'iconKey' => 'box',
                ],
                [
                    'id' => 10,
                    'pair_id' => 5,
                    'kategori' => 'back',
                    'judul' => 'Penjelasan Konsep',
                    'main_materi' => 'Contoh: skor = 100',
                    'isi_materi' => 'Tempat menyimpan nilai data sementara',
                    'iconKey' => 'box',
                ],
                [
                    'id' => 11,
                    'pair_id' => 6,
                    'kategori' => 'front',
                    'judul' => 'Aritmatika Dasar',
                    'main_materi' => 'Simbol untuk menggabungkan dua nilai bilangan',
                    'isi_materi' => 'Operator +',
                    'iconKey' => 'plus',
                ],
                [
                    'id' => 12,
                    'pair_id' => 6,
                    'kategori' => 'back',
                    'judul' => 'Penjelasan Operator',
                    'main_materi' => 'Contoh: total = 15 + 5',
                    'isi_materi' => 'Menjumlahkan dua nilai angka',
                    'iconKey' => 'plus',
                ],
                [
                    'id' => 13,
                    'pair_id' => 7,
                    'kategori' => 'front',
                    'judul' => 'Logika Kontrol',
                    'main_materi' => 'Struktur perulangan dengan jumlah langkah tertentu',
                    'isi_materi' => 'for i in range(5):',
                    'iconKey' => 'loop',
                ],
                [
                    'id' => 14,
                    'pair_id' => 7,
                    'kategori' => 'back',
                    'judul' => 'Perulangan',
                    'main_materi' => 'Menjalankan blok kode berulang kali tanpa menulis ulang',
                    'isi_materi' => 'Mengulang suatu langkah secara otomatis',
                    'iconKey' => 'loop',
                ],
                [
                    'id' => 15,
                    'pair_id' => 8,
                    'kategori' => 'front',
                    'judul' => 'Catatan Program',
                    'main_materi' => 'Baris teks yang diabaikan saat program dijalankan',
                    'isi_materi' => 'Komentar (#)',
                    'iconKey' => 'note',
                ],
                [
                    'id' => 16,
                    'pair_id' => 8,
                    'kategori' => 'back',
                    'judul' => 'Penjelasan Catatan',
                    'main_materi' => 'Contoh: # Ini komentar program',
                    'isi_materi' => 'Memberi catatan penjelasan pada kode',
                    'iconKey' => 'note',
                ],
            ],
        ],

        'SMP-1' => [
            'levelTitle' => 'Simbol Dasar Flowchart',
            'items' => [
                [
                    'id' => 101,
                    'pair_id' => 101,
                    'kategori' => 'front',
                    'judul' => 'Simbol Terminator',
                    'main_materi' => 'Simbol berbentuk kapsul di ujung awal dan akhir diagram',
                    'isi_materi' => 'Mulai / Selesai',
                    'iconKey' => 'box',
                ],
                [
                    'id' => 102,
                    'pair_id' => 101,
                    'kategori' => 'back',
                    'judul' => 'Fungsi Terminator',
                    'main_materi' => 'Setiap flowchart wajib diawali dan diakhiri simbol ini',
                    'isi_materi' => 'Menandai titik awal dan akhir aliran flowchart',
                    'iconKey' => 'box',
                ],
                [
                    'id' => 103,
                    'pair_id' => 102,
                    'kategori' => 'front',
                    'judul' => 'Simbol Data',
                    'main_materi' => 'Simbol berbentuk jajar genjang untuk interaksi data',
                    'isi_materi' => 'Input / Output',
                    'iconKey' => 'keyboard',
                ],
                [
                    'id' => 104,
                    'pair_id' => 102,
                    'kategori' => 'back',
                    'judul' => 'Fungsi Simbol Data',
                    'main_materi' => 'Contoh: Input bilangan atau Output Genap',
                    'isi_materi' => 'Menerima masukan data atau menampilkan hasil',
                    'iconKey' => 'keyboard',
                ],
                [
                    'id' => 105,
                    'pair_id' => 103,
                    'kategori' => 'front',
                    'judul' => 'Simbol Pengolahan',
                    'main_materi' => 'Simbol berbentuk persegi panjang pada diagram alir',
                    'isi_materi' => 'Proses',
                    'iconKey' => 'monitor',
                ],
                [
                    'id' => 106,
                    'pair_id' => 103,
                    'kategori' => 'back',
                    'judul' => 'Fungsi Simbol Proses',
                    'main_materi' => 'Contoh: menghitung sisa bagi atau rumus luas',
                    'isi_materi' => 'Menjalankan perhitungan atau pengolahan data',
                    'iconKey' => 'monitor',
                ],
                [
                    'id' => 107,
                    'pair_id' => 104,
                    'kategori' => 'front',
                    'judul' => 'Simbol Decision',
                    'main_materi' => 'Simbol berbentuk belah ketupat untuk percabangan logika',
                    'isi_materi' => 'Kondisi',
                    'iconKey' => 'branch',
                ],
                [
                    'id' => 108,
                    'pair_id' => 104,
                    'kategori' => 'back',
                    'judul' => 'Fungsi Simbol Kondisi',
                    'main_materi' => 'Memiliki dua jalur keluaran berdasarkan syarat',
                    'isi_materi' => 'Menentukan cabang jalur Ya atau Tidak',
                    'iconKey' => 'branch',
                ],
            ],
        ],
        'SMA-1' => [
            'levelTitle' => 'Algoritma & Percabangan Python',
            'items' => [
                [
                    'id' => 201,
                    'pair_id' => 201,
                    'kategori' => 'front',
                    'judul' => 'Konversi Tipe Input',
                    'main_materi' => 'Mengubah teks masukan pengguna menjadi bilangan bulat',
                    'isi_materi' => 'int(input())',
                    'iconKey' => 'keyboard',
                ],
                [
                    'id' => 202,
                    'pair_id' => 201,
                    'kategori' => 'back',
                    'judul' => 'Fungsi Konversi',
                    'main_materi' => 'Diperlukan sebelum melakukan operasi aritmatika atau perbandingan angka',
                    'isi_materi' => 'Membaca input angka bilangan bulat',
                    'iconKey' => 'keyboard',
                ],
                [
                    'id' => 203,
                    'pair_id' => 202,
                    'kategori' => 'front',
                    'judul' => 'Operator Modulus',
                    'main_materi' => 'Menghitung sisa hasil pembagian dua bilangan',
                    'isi_materi' => 'Operator %',
                    'iconKey' => 'number',
                ],
                [
                    'id' => 204,
                    'pair_id' => 202,
                    'kategori' => 'back',
                    'judul' => 'Fungsi Modulus',
                    'main_materi' => 'Contoh: 8 % 2 menghasilkan 0 (habis dibagi)',
                    'isi_materi' => 'Mencari sisa pembagian bilangan',
                    'iconKey' => 'number',
                ],
                [
                    'id' => 205,
                    'pair_id' => 203,
                    'kategori' => 'front',
                    'judul' => 'Percabangan Bersyarat',
                    'main_materi' => 'Struktur pemilihan jalur kode jika kondisi bernilai True',
                    'isi_materi' => 'if ... else:',
                    'iconKey' => 'branch',
                ],
                [
                    'id' => 206,
                    'pair_id' => 203,
                    'kategori' => 'back',
                    'judul' => 'Fungsi Percabangan',
                    'main_materi' => 'Menerjemahkan simbol belah ketupat pada flowchart ke Python',
                    'isi_materi' => 'Menjalankan blok kode sesuai kondisi logika',
                    'iconKey' => 'branch',
                ],
                [
                    'id' => 207,
                    'pair_id' => 204,
                    'kategori' => 'front',
                    'judul' => 'Aturan Indentasi',
                    'main_materi' => 'Spasi menjorok ke dalam setelah tanda titik dua (:)',
                    'isi_materi' => 'Indentasi (4 Spasi)',
                    'iconKey' => 'note',
                ],
                [
                    'id' => 208,
                    'pair_id' => 204,
                    'kategori' => 'back',
                    'judul' => 'Fungsi Indentasi',
                    'main_materi' => 'Menandakan baris kode berada di dalam blok if atau else',
                    'isi_materi' => 'Menentukan cakupan blok perintah Python',
                    'iconKey' => 'note',
                ],
            ],
        ],
    ];

    $deckKey = "{$jenjangParam}-{$levelParam}";
    $fallbackKey = $hasFlowchart ? 'SMP-1' : 'SD-1';
    $activeDeckData = $materiCatalog[$deckKey] ?? $materiCatalog[$fallbackKey];
@endphp

@section('content')
    <!-- Dekorasi Awan & Kilau Background -->
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
        <svg class="hidden md:block absolute top-10 left-[46%] w-5 h-5 text-blue-300" viewBox="0 0 24 24"
            fill="currentColor">
            <path d="M12 1L14.5 9.5L23 12L14.5 14.5L12 23L9.5 14.5L1 12L9.5 9.5L12 1Z" />
        </svg>
    </div>

    <!-- Top Navigation Bar (Format Awal) -->
    <header class="relative z-10 px-5 sm:px-7 pt-3 pb-1 flex items-center justify-between shrink-0">
        <a id="materi-back-map" href="{{ url('/level-view') }}?jenjang={{ $jenjangParam }}"
            class="inline-flex items-center gap-2 text-slate-700 hover:text-blue-600 font-bold text-sm transition-colors group">
            <span
                class="w-7 h-7 rounded-full bg-white shadow-2xs border border-slate-200/80 flex items-center justify-center group-hover:border-blue-300 group-hover:-translate-x-0.5 transition-all">
                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" stroke-width="2.5"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </span>
            <span>Peta Level</span>
        </a>

        <div class="flex items-center gap-2.5">
            <span
                class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/90 border border-blue-100 text-xs font-semibold text-slate-600 shadow-2xs">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                Mode Tamu Aktif
            </span>
            <a href="{{ url('/login') }}"
                class="inline-flex items-center gap-1.5 bg-white hover:bg-blue-50 text-blue-600 border border-blue-200/80 text-xs font-bold px-3.5 py-1.5 rounded-full shadow-2xs transition-colors">
                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z"
                        clip-rule="evenodd" />
                </svg>
                <span>Simpan Akun</span>
            </a>

            <!-- Tombol Sembunyikan / Tampilkan Header Materi -->
            <button type="button" id="btn-toggle-materi-header" onclick="toggleMateriHeader()"
                title="Sembunyikan / Tampilkan Header"
                class="inline-flex items-center gap-1.5 bg-white/90 hover:bg-white text-slate-600 hover:text-blue-600 border border-blue-100 text-xs font-bold px-3 py-1.5 rounded-full shadow-2xs transition-colors cursor-pointer">
                <svg id="icon-toggle-materi-header" class="w-3.5 h-3.5 transition-transform duration-200" fill="none"
                    stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
                </svg>
                <span id="text-toggle-materi-header" class="hidden sm:inline">Sembunyikan Header</span>
            </button>
        </div>
    </header>

    <!-- Main Container -->
    <main
        class="relative z-10 flex-1 min-h-0 flex flex-col px-5 sm:px-7 pb-4 max-w-6xl w-full mx-auto gap-2.5 overflow-y-auto">

        <!-- BAGIAN HEADER YANG BISA DISEMBUNYIKAN (Format Awal: Kartu Jenjang + Maskot + Bar Skor) -->
        <div id="materi-collapsible-header" class="flex flex-col gap-2.5 shrink-0">
            <!-- Header Jenjang + Mascot Penyemangat -->
            <div class="relative flex flex-col md:flex-row md:items-center justify-between gap-2 shrink-0">
                <div
                    class="bg-white/95 backdrop-blur-xs rounded-2xl border border-white shadow-soft-card px-4 py-2 flex items-center gap-3.5 max-w-md z-10">
                    <div
                        class="w-10 h-10 rounded-xl bg-blue-50 border border-blue-100 flex items-center justify-center overflow-hidden shrink-0">
                        <img src="{{ asset('images/mascot_think.png') }}" alt="Avatar" class="w-9 h-9 object-contain">
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2">
                            <h1 id="materi-jenjang-label" class="text-base sm:text-lg font-extrabold text-slate-900">
                                {{ $jenjangParam }}</h1>
                            <span id="materi-level-pill"
                                class="px-2.5 py-0.5 rounded-full bg-blue-100 text-blue-700 text-[11px] font-bold">
                                Level {{ $levelParam }}
                            </span>
                        </div>
                        <p id="materi-level-subtitle" class="text-xs text-slate-500 truncate">
                            {{ $activeDeckData['levelTitle'] }}</p>
                    </div>
                </div>

                <div class="hidden md:flex items-center gap-2.5 self-end z-10">
                    <div id="materi-mascot-speech"
                        class="bg-white/95 px-3.5 py-2 rounded-2xl rounded-br-xs shadow-soft-card border border-blue-100 text-xs font-bold text-slate-700">
                        @yield('materi_speech', 'Ayo selesaikan tahap belajar ini!')
                    </div>
                    <img src="{{ asset('images/mascot_card.png') }}" alt="Maskot"
                        class="w-16 h-14 object-contain object-bottom drop-shadow-xs">
                </div>
            </div>

            <!-- Bar Skor / Progres -->
            @yield('materi_stats')
        </div>

        <!-- KOTAKAN TAB FOLDER TERPUSAT (SD: Flashcard -> Evaluasi | SMP: Flashcard -> Flowchart -> Evaluasi) -->
        <div class="flex-1 min-h-0 flex flex-col">
            <div class="flex items-end justify-between px-2 shrink-0">
                <div class="flex items-center gap-1.5">

                    <!-- TAB 1: FLASHCARD -->
                    @if ($currentStep === 'flashcard')
                        <div
                            class="inline-flex items-center gap-2 px-4 sm:px-5 py-2 rounded-t-2xl bg-blue-600 text-white text-xs sm:text-sm font-extrabold shadow-2xs">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M11.25 4.533A9.707 9.707 0 006 3a9.735 9.735 0 00-3.25.555.75.75 0 00-.5.707v14.25a.75.75 0 001 .707A8.237 8.237 0 016 18.75c1.995 0 3.823.707 5.25 1.886V4.533zM12.75 20.636A8.214 8.214 0 0118 18.75c.966 0 1.89.166 2.75.47a.75.75 0 001-.708V4.262a.75.75 0 00-.5-.707A9.735 9.735 0 0018 3a9.707 9.707 0 00-5.25 1.533v16.103z" />
                            </svg>
                            <span>Flashcard</span>
                        </div>
                    @else
                        <a href="{{ url('/materi/flashcard') }}?{{ $materiQuery }}"
                            class="inline-flex items-center gap-2 px-4 sm:px-5 py-2 rounded-t-2xl bg-white/90 hover:bg-white text-slate-700 hover:text-blue-600 text-xs sm:text-sm font-bold border-t border-x border-white transition-all">
                            <svg class="w-4 h-4 text-emerald-500" viewBox="0 0 24 24" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>Flashcard</span>
                        </a>
                    @endif

                    <!-- TAB 2: FLOWCHART (Kondisional berdasarkan boolean $hasFlowchart) -->
                    @if ($hasFlowchart)
                        @if ($currentStep === 'flowchart')
                            <div
                                class="inline-flex items-center gap-2 px-4 sm:px-5 py-2 rounded-t-2xl bg-blue-600 text-white text-xs sm:text-sm font-extrabold shadow-2xs">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.2"
                                    viewBox="0 0 24 24">
                                    <rect x="7" y="3" width="10" height="5" rx="1.5" />
                                    <polygon points="12,11 17,15 12,19 7,15" />
                                    <path stroke-linecap="round" d="M12 8v3" />
                                </svg>
                                <span>Flowchart</span>
                            </div>
                        @elseif(in_array($currentStep, ['coding', 'evaluasi']))
                            <a href="{{ url('/materi/flowchart') }}?{{ $materiQuery }}"
                                class="inline-flex items-center gap-2 px-4 sm:px-5 py-2 rounded-t-2xl bg-white/90 hover:bg-white text-slate-700 hover:text-blue-600 text-xs sm:text-sm font-bold border-t border-x border-white transition-all">
                                <svg class="w-4 h-4 text-emerald-500" viewBox="0 0 24 24" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>Flowchart</span>
                            </a>
                        @else
                            <a id="nav-tab-flowchart" href="{{ url('/materi/flowchart') }}?{{ $materiQuery }}"
                                data-locked="true"
                                onclick="if(this.dataset.locked === 'true') { event.preventDefault(); }"
                                title="Selesaikan semua kartu Flashcard terlebih dahulu"
                                class="inline-flex items-center gap-2 px-4 sm:px-5 py-2 rounded-t-2xl bg-white/60 text-slate-400 text-xs sm:text-sm font-bold border-t border-x border-white/80 opacity-55 pointer-events-none cursor-not-allowed select-none transition-all duration-300">
                                <span id="nav-tab-flowchart-icon" class="inline-flex items-center">
                                    <svg class="w-4 h-4 text-slate-400" viewBox="0 0 24 24" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </span>
                                <span>Flowchart</span>
                            </a>
                        @endif
                    @endif

                    <!-- TAB 3: CODING PYTHON (Muncul setelah Flowchart untuk SMP & SMA) -->
                    @if ($hasCoding ?? $hasFlowchart)
                        @if ($currentStep === 'coding')
                            <div
                                class="inline-flex items-center gap-2 px-4 sm:px-5 py-2 rounded-t-2xl bg-blue-600 text-white text-xs sm:text-sm font-extrabold shadow-2xs">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.3"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16 18l6-6-6-6M8 6l-6 6 6 6" />
                                </svg>
                                <span>Coding</span>
                            </div>
                        @elseif($currentStep === 'evaluasi')
                            <a href="{{ url('/materi/coding') }}?{{ $materiQuery }}"
                                class="inline-flex items-center gap-2 px-4 sm:px-5 py-2 rounded-t-2xl bg-white/90 hover:bg-white text-slate-700 hover:text-blue-600 text-xs sm:text-sm font-bold border-t border-x border-white transition-all">
                                <svg class="w-4 h-4 text-emerald-500" viewBox="0 0 24 24" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>Coding</span>
                            </a>
                        @else
                            <a id="nav-tab-coding" href="{{ url('/materi/coding') }}?{{ $materiQuery }}"
                                data-locked="true"
                                onclick="if(this.dataset.locked === 'true') { event.preventDefault(); }"
                                title="Selesaikan Flowchart terlebih dahulu"
                                class="inline-flex items-center gap-2 px-4 sm:px-5 py-2 rounded-t-2xl bg-white/60 text-slate-400 text-xs sm:text-sm font-bold border-t border-x border-white/80 opacity-55 pointer-events-none cursor-not-allowed select-none transition-all duration-300">
                                <span id="nav-tab-coding-icon" class="inline-flex items-center">
                                    <svg class="w-4 h-4 text-slate-400" viewBox="0 0 24 24" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </span>
                                <span>Coding</span>
                            </a>
                        @endif
                    @endif

                    <!-- TAB 4: EVALUASI -->
                    @if ($currentStep === 'evaluasi')
                        <div
                            class="inline-flex items-center gap-2 px-4 sm:px-5 py-2 rounded-t-2xl bg-blue-600 text-white text-xs sm:text-sm font-extrabold shadow-2xs">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M11.25 3v4.046a3 3 0 00-4.277 4.204H1.5v-6A2.25 2.25 0 013.75 3h7.5zM12.75 3v4.011a3 3 0 014.239 4.239H22.5v-6A2.25 2.25 0 0020.25 3h-7.5zM22.5 12.75h-8.983a4.125 4.125 0 004.108 3.75.75.75 0 010 1.5 5.623 5.623 0 01-4.875-2.817V21h7.5a2.25 2.25 0 002.25-2.25v-6zM11.25 21v-5.817A5.623 5.623 0 016.375 18a.75.75 0 010-1.5 4.126 4.126 0 004.108-3.75H1.5v6A2.25 2.25 0 003.75 21h7.5z" />
                            </svg>
                            <span>Evaluasi</span>
                        </div>
                    @else
                        <a id="nav-tab-evaluasi" href="{{ url('/materi/evaluasi') }}?{{ $materiQuery }}"
                            data-locked="true" onclick="if(this.dataset.locked === 'true') { event.preventDefault(); }"
                            title="{{ $hasFlowchart ? 'Selesaikan Coding terlebih dahulu' : 'Selesaikan semua kartu Flashcard terlebih dahulu' }}"
                            class="inline-flex items-center gap-2 px-4 sm:px-5 py-2 rounded-t-2xl bg-white/60 text-slate-400 text-xs sm:text-sm font-bold border-t border-x border-white/80 opacity-55 pointer-events-none cursor-not-allowed select-none transition-all duration-300">
                            <span id="nav-tab-evaluasi-icon" class="inline-flex items-center">
                                <svg class="w-4 h-4 text-slate-400" viewBox="0 0 24 24" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                            <span>Evaluasi</span>
                        </a>
                    @endif

                </div>
                <div class="hidden sm:flex items-center gap-2.5 pb-1.5">
                    @yield('materi_tab_right')
                </div>
            </div>

            <!-- Isi Utama Halaman Materi -->
            <div class="flex-1 min-h-0 flex flex-col">
                @yield('materi_content')
            </div>
        </div>

    </main>

    <!-- =========================================================================
                                         INISIALISASI GLOBAL CONTEXT, DATA & TOGGLE HEADER
                                    ========================================================================== -->
    <script>
        window.MATERI_CTX = {
            jenjang: @json($jenjangParam),
            levelId: @json($levelParam),
            hasFlowchart: @json($hasFlowchart),
            query: @json($materiQuery),
            currentStep: @json($currentStep),
            flashcardUrl: @json(url('/materi/flashcard') . '?' . $materiQuery),
            flowchartUrl: @json(url('/materi/flowchart') . '?' . $materiQuery),
            evaluasiUrl: @json(url('/materi/evaluasi') . '?' . $materiQuery),
            levelViewUrl: @json(url('/level-view') . '?jenjang=' . $jenjangParam)
        };

        window.MATERI_DECK = @json($activeDeckData);

        window.getPairedMateriCards = function() {
            const items = Array.isArray(window.MATERI_DECK?.items) ? window.MATERI_DECK.items : [];
            const fronts = items.filter(item => item.kategori === 'front');
            const backs = items.filter(item => item.kategori === 'back');

            return fronts.map(frontItem => {
                const pairKey = frontItem.pair_id ?? frontItem.id;
                const matchedBack = backs.find(b => (b.pair_id ?? b.id) === pairKey) || {
                    id: frontItem.id,
                    pair_id: pairKey,
                    kategori: 'back',
                    judul: 'Penjelasan',
                    main_materi: '',
                    isi_materi: '-',
                    iconKey: frontItem.iconKey || 'default'
                };
                return {
                    pair_id: pairKey,
                    front: frontItem,
                    back: matchedBack
                };
            });
        };

        window.unlockMateriTab = function(tabId, iconId, titleText) {
            const tabEl = document.getElementById(tabId);
            const iconEl = document.getElementById(iconId);
            if (!tabEl) return;

            tabEl.dataset.locked = 'false';
            tabEl.title = titleText || 'Lanjut';
            tabEl.className =
                'inline-flex items-center gap-2 px-4 sm:px-5 py-2 rounded-t-2xl bg-white/90 hover:bg-white text-slate-700 hover:text-blue-600 text-xs sm:text-sm font-bold border-t border-x border-white transition-all duration-300 cursor-pointer';

            if (iconEl) {
                iconEl.innerHTML = `
                    <svg class="w-4 h-4 text-emerald-500" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd"/>
                    </svg>
                `;
            }
        };

        window.lockMateriTab = function(tabId, iconId, titleText) {
            const tabEl = document.getElementById(tabId);
            const iconEl = document.getElementById(iconId);
            if (!tabEl) return;

            tabEl.dataset.locked = 'true';
            tabEl.title = titleText || 'Terkunci';
            tabEl.className =
                'inline-flex items-center gap-2 px-4 sm:px-5 py-2 rounded-t-2xl bg-white/60 text-slate-400 text-xs sm:text-sm font-bold border-t border-x border-white/80 opacity-55 pointer-events-none cursor-not-allowed select-none transition-all duration-300';

            if (iconEl) {
                iconEl.innerHTML = `
                    <svg class="w-4 h-4 text-slate-400" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z" clip-rule="evenodd"/>
                    </svg>
                `;
            }
        };

        window.applyMateriHeaderState = function(isHidden) {
            const headerPanel = document.getElementById('materi-collapsible-header');
            const icon = document.getElementById('icon-toggle-materi-header');
            const text = document.getElementById('text-toggle-materi-header');
            if (!headerPanel) return;

            if (isHidden) {
                headerPanel.classList.add('hidden');
                if (icon) icon.classList.add('rotate-180');
                if (text) text.textContent = 'Tampilkan Header';
            } else {
                headerPanel.classList.remove('hidden');
                if (icon) icon.classList.remove('rotate-180');
                if (text) text.textContent = 'Sembunyikan Header';
            }

            window.dispatchEvent(new Event('resize'));
        };

        window.toggleMateriHeader = function() {
            const nextState = localStorage.getItem('codepawth_materi_header_hidden') !== 'true';
            localStorage.setItem('codepawth_materi_header_hidden', String(nextState));
            window.applyMateriHeaderState(nextState);
        };

        document.addEventListener('DOMContentLoaded', () => {
            const sideJenjang = document.getElementById('sidebar-jenjang-text');
            const sideLvl = document.getElementById('sidebar-current-lvl');
            if (sideJenjang) sideJenjang.textContent = window.MATERI_CTX.jenjang;
            if (sideLvl) sideLvl.textContent = window.MATERI_CTX.levelId;

            const savedHidden = localStorage.getItem('codepawth_materi_header_hidden') === 'true';
            window.applyMateriHeaderState(savedHidden);
        });
    </script>
    <script>
        window.MATERI_CTX = Object.assign(window.MATERI_CTX || {}, {
            catalog: @json($materiCatalog)
        });
    </script>

    @include('additional')
    @stack('scripts')
@endsection
