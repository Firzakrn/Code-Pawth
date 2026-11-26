@extends('layouts.portal')

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
    | CEK ROUTE EDITOR
    |--------------------------------------------------------------------------
    | Jangan langsung memanggil route() jika belum terdaftar,
    | karena akan menyebabkan RouteNotFoundException.
    */

    $hasMaterialEditor = \Illuminate\Support\Facades\Route::has('guru.materi.create');

    $hasMaterialList = \Illuminate\Support\Facades\Route::has('guru.materi.index');
@endphp

@section('content')

    <div class="studio-page">

        {{-- BREADCRUMB --}}
        <div class="studio-breadcrumb">

            <a href="{{ route('guru.dashboard') }}">
                Dashboard Guru
            </a>

            <span>›</span>

            <strong>Studio Konten</strong>

        </div>

        {{-- HERO --}}
        <section class="studio-hero">

            <div class="studio-hero-copy">

                <span class="studio-eyebrow">
                    ✨ RUANG KREATIF PENGAJAR
                </span>

                <h1>
                    Studio Konten <span>Guru</span>
                </h1>

                <p>
                    Pilih template, siapkan materi, dan rancang
                    aktivitas belajar yang seru untuk siswa.
                    Tidak perlu membuat desain dari awal!
                </p>

                <div class="studio-hero-tags">
                    <span>📚 3 Template Materi</span>
                    <span>🧩 4 Template Evaluasi</span>
                    <span>🎓 SD – SMA</span>
                </div>

                @if ($hasMaterialList)
                    <a href="{{ route('guru.materi.index') }}" class="studio-my-materials">
                        📂 Lihat Materi Saya →
                    </a>
                @endif

            </div>

            <div class="studio-hero-mascot">

                <img src="{{ asset('images/mascot_class.png') }}" alt="Maskot CodePawth">

            </div>

        </section>

        {{-- PILIH KELAS --}}
        <section class="studio-class-panel">

            <div class="studio-class-heading">

                <div class="studio-class-icon">🏫</div>

                <div>
                    <h2>Untuk kelas mana?</h2>

                    <p>
                        Kamu bisa memilih kelas sekarang
                        atau menentukannya nanti saat mengisi materi.
                    </p>
                </div>

            </div>

            <div class="studio-class-control">

                <label for="studioClass">
                    Kelas Tujuan
                </label>

                <select id="studioClass">

                    <option value="">
                        Belum memilih kelas
                    </option>

                    @foreach ($classes as $class)
                        <option value="{{ $class->id }}">
                            {{ $class->name }} — {{ $class->level }}
                        </option>
                    @endforeach

                </select>

                @if ($classes->isEmpty())
                    <p class="studio-small-note">
                        Belum ada kelas.
                        <a href="{{ route('guru.dashboard') }}">
                            Buat kelas terlebih dahulu
                        </a>.
                    </p>
                @endif

            </div>

        </section>

        {{-- INFORMASI JIKA ROUTE BELUM ADA --}}
        @unless ($hasMaterialEditor)
            <div class="studio-warning">
                <span>⚠️</span>

                <div>
                    <strong>Editor materi belum terhubung.</strong>

                    <p>
                        Template tetap bisa dilihat.
                        Untuk mulai membuat materi, daftarkan
                        route guru.materi.create dan siapkan
                        halaman materi-editor.blade.php.
                    </p>
                </div>
            </div>
        @endunless

        {{-- HEADER TEMPLATE --}}
        <div class="studio-section-intro">

            <div>
                <span class="studio-eyebrow">
                    PERPUSTAKAAN TEMPLATE
                </span>

                <h2>Mau membuat apa hari ini?</h2>

                <p>
                    Pilih template yang sesuai dengan kebutuhan
                    pembelajaranmu.
                </p>
            </div>

            <img src="{{ asset('images/mascot_peeking.png') }}" alt="Maskot mengintip" class="studio-peek-mascot">

        </div>

        {{-- FILTER --}}
        <div class="studio-toolbar">

            <div class="studio-filter-buttons">

                <button type="button" class="studio-filter active" data-filter="semua" aria-pressed="true">
                    Semua
                </button>

                <button type="button" class="studio-filter" data-filter="materi" aria-pressed="false">
                    📖 Materi
                </button>

                <button type="button" class="studio-filter" data-filter="evaluasi" aria-pressed="false">
                    📝 Evaluasi
                </button>

            </div>

            <div class="studio-toolbar-right">

                <select id="studioLevel">
                    <option value="semua">Semua Jenjang</option>
                    <option value="SD">SD</option>
                    <option value="SMP">SMP</option>
                    <option value="SMA">SMA</option>
                </select>

                <input type="search" id="studioSearch" placeholder="Cari template...">

            </div>

        </div>

        {{-- TEMPLATE MATERI --}}
        <section id="studioMaterials" class="studio-group">

            <div class="studio-group-heading">

                <div>
                    <span class="studio-eyebrow">
                        01 / MATERI
                    </span>

                    <h2>Template Materi</h2>

                    <p>
                        Buat konten pembelajaran yang menarik
                        dan mudah dipahami.
                    </p>
                </div>

                <span class="studio-count">
                    3 Template
                </span>

            </div>

            <div class="studio-grid studio-grid-material">

                @foreach ($materialTemplates as $template)
                    @php
                        $editorUrl = $hasMaterialEditor
                            ? route('guru.materi.create', [
                                'type' => $template['id'],
                            ])
                            : '';
                    @endphp

                    <article class="studio-template" data-id="{{ $template['id'] }}" data-type="{{ $template['type'] }}"
                        data-levels="{{ implode(',', $template['levels']) }}" data-title="{{ $template['title'] }}"
                        data-description="{{ $template['description'] }}" data-example="{{ $template['example'] }}"
                        data-fields="{{ implode('|', $template['fields']) }}"
                        data-mascot="{{ asset('images/' . $template['mascot']) }}" data-editor-url="{{ $editorUrl }}">

                        <div class="studio-template-art">

                            <span class="studio-template-type">
                                📖 MATERI
                            </span>

                            <img src="{{ asset('images/' . $template['mascot']) }}" alt="Maskot {{ $template['title'] }}"
                                loading="lazy">

                        </div>

                        <div class="studio-template-body">

                            <div class="studio-level-tags">

                                @foreach ($template['levels'] as $level)
                                    <span>{{ $level }}</span>
                                @endforeach

                            </div>

                            <h3>{{ $template['title'] }}</h3>

                            <p>{{ $template['description'] }}</p>

                            <button type="button" class="studio-template-button">
                                Lihat & Pilih Template
                                <span>→</span>
                            </button>

                        </div>

                    </article>
                @endforeach

            </div>

        </section>

        {{-- TEMPLATE EVALUASI --}}
        <section id="studioEvaluations" class="studio-group">

            <div class="studio-group-heading">

                <div>
                    <span class="studio-eyebrow">
                        02 / EVALUASI
                    </span>

                    <h2>Template Soal & Evaluasi</h2>

                    <p>
                        Rancang aktivitas untuk menguji
                        logika dan kemampuan coding siswa.
                    </p>
                </div>

                <span class="studio-count">
                    4 Template
                </span>

            </div>

            <div class="studio-grid studio-grid-evaluation">

                @foreach ($evaluationTemplates as $template)
                    <article class="studio-template" data-id="{{ $template['id'] }}" data-type="{{ $template['type'] }}"
                        data-levels="{{ implode(',', $template['levels']) }}" data-title="{{ $template['title'] }}"
                        data-description="{{ $template['description'] }}" data-example="{{ $template['example'] }}"
                        data-fields="{{ implode('|', $template['fields']) }}"
                        data-mascot="{{ asset('images/' . $template['mascot']) }}" data-editor-url="">

                        <div class="studio-template-art">

                            <span class="studio-template-type">
                                📝 EVALUASI
                            </span>

                            <img src="{{ asset('images/' . $template['mascot']) }}" alt="Maskot {{ $template['title'] }}"
                                loading="lazy">

                        </div>

                        <div class="studio-template-body">

                            <div class="studio-level-tags">

                                @foreach ($template['levels'] as $level)
                                    <span>{{ $level }}</span>
                                @endforeach

                            </div>

                            <h3>{{ $template['title'] }}</h3>

                            <p>{{ $template['description'] }}</p>

                            <button type="button" class="studio-template-button">
                                Lihat Detail Template
                                <span>→</span>
                            </button>

                        </div>

                    </article>
                @endforeach

            </div>

        </section>

        {{-- TEMPLATE TIDAK DITEMUKAN --}}
        <div id="studioEmpty" class="studio-empty" hidden>

            <img src="{{ asset('images/mascot_peek.png') }}" alt="Maskot mencari template">

            <h3>Template belum ditemukan</h3>

            <p>
                Coba ubah pencarian atau pilihan jenjang.
            </p>

        </div>

        {{-- TIPS MASKOT --}}
        <section class="studio-tips">

            <div class="studio-tips-heading">

                <span class="studio-eyebrow">
                    TIPS DARI MASKOT CODEPAWTH
                </span>

                <h2>Bikin belajar jadi lebih menyenangkan!</h2>

            </div>

            <div class="studio-tips-grid">

                <div class="studio-tip">

                    <img src="{{ asset('images/mascot_cheers.png') }}" alt="Maskot bersemangat">

                    <strong>Mulai dari yang mudah</strong>

                    <p>
                        Gunakan Flashcard untuk mengenalkan
                        konsep baru.
                    </p>

                </div>

                <div class="studio-tip">

                    <img src="{{ asset('images/mascot_happy.png') }}" alt="Maskot senang">

                    <strong>Berikan apresiasi</strong>

                    <p>
                        Rayakan setiap pencapaian siswa.
                    </p>

                </div>

                <div class="studio-tip">

                    <img src="{{ asset('images/mascot_loveya.png') }}" alt="Maskot penyemangat">

                    <strong>Beri petunjuk ramah</strong>

                    <p>
                        Bantu siswa memahami kesalahan.
                    </p>

                </div>

                <div class="studio-tip">

                    <img src="{{ asset('images/mascot_angry.png') }}" alt="Maskot tantangan">

                    <strong>Jadikan bug tantangan</strong>

                    <p>
                        Ajak siswa menemukan dan memperbaiki error.
                    </p>

                </div>

            </div>

        </section>

    </div>

    {{-- MODAL DETAIL TEMPLATE --}}
    <dialog id="studioModal" class="studio-modal">

        <div class="studio-modal-header">

            <img id="studioModalMascot" src="{{ asset('images/mascot_card.png') }}" alt="Maskot template">

            <div>

                <span class="studio-eyebrow" id="studioModalType">
                    TEMPLATE
                </span>

                <h2 id="studioModalTitle"></h2>

            </div>

            <button type="button" id="studioModalClose" class="studio-modal-close" aria-label="Tutup">
                ✕
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
        /* =========================================
           STUDIO KONTEN - CODEPAWTH
        ========================================= */

        .studio-page {
            max-width: 1180px;
            margin: 0 auto;
        }

        .studio-page *,
        .studio-modal * {
            box-sizing: border-box;
        }

        /* PENTING: MEMPERBAIKI FILTER HIDDEN */
        .studio-page [hidden] {
            display: none !important;
        }

        .studio-breadcrumb {
            display: flex;
            align-items: center;
            gap: 9px;
            margin-bottom: 22px;
            font-size: 12px;
            color: #8b9fb4;
        }

        .studio-breadcrumb a {
            color: #719bc3;
            font-weight: 700;
            text-decoration: none;
        }

        .studio-eyebrow {
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1px;
            color: #719bc3;
        }

        /* =========================================
           HERO
        ========================================= */

        .studio-hero {
            position: relative;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            min-height: 245px;
            padding: 34px 40px;
            border: 1px solid #d5e8fa;
            border-radius: 27px;
            background: linear-gradient(115deg,
                    #e4f1ff,
                    #f4f9ff);
            overflow: hidden;
        }

        .studio-hero-copy {
            position: relative;
            z-index: 2;
            max-width: 690px;
        }

        .studio-hero h1 {
            margin: 12px 0;
            font-size: clamp(27px, 3vw, 38px);
            font-weight: 800;
            letter-spacing: -1px;
            color: #344b65;
        }

        .studio-hero h1 span {
            color: #719bc3;
        }

        .studio-hero p {
            max-width: 610px;
            margin: 0;
            font-size: 13px;
            line-height: 1.8;
            color: #718ba5;
        }

        .studio-hero-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 9px;
            margin-top: 22px;
        }

        .studio-hero-tags span {
            padding: 9px 12px;
            border-radius: 30px;
            background: rgba(255, 255, 255, .85);
            color: #5d82a8;
            font-size: 11px;
            font-weight: 800;
        }

        .studio-my-materials {
            display: inline-flex;
            margin-top: 20px;
            padding: 11px 17px;
            border-radius: 12px;
            background: #719bc3;
            color: white;
            font-size: 12px;
            font-weight: 800;
            text-decoration: none;
        }

        .studio-my-materials:hover {
            background: #5a8bb9;
        }

        .studio-hero-mascot {
            display: flex;
            justify-content: center;
            align-items: flex-end;
            width: 215px;
            height: 190px;
            flex-shrink: 0;
        }

        .studio-hero-mascot img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        /* =========================================
           PILIH KELAS
        ========================================= */

        .studio-class-panel {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 24px;
            margin-top: 22px;
            padding: 21px 25px;
            background: white;
            border: 1px solid #e0ecf7;
            border-radius: 20px;
        }

        .studio-class-heading {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .studio-class-icon {
            display: grid;
            place-items: center;
            width: 52px;
            height: 52px;
            flex-shrink: 0;
            background: #eaf4ff;
            border-radius: 15px;
            font-size: 25px;
        }

        .studio-class-heading h2 {
            margin: 0 0 5px;
            font-size: 16px;
        }

        .studio-class-heading p {
            margin: 0;
            font-size: 12px;
            line-height: 1.7;
            color: #849ab0;
        }

        .studio-class-control {
            width: min(100%, 295px);
            flex-shrink: 0;
        }

        .studio-class-control label {
            display: block;
            margin-bottom: 7px;
            font-size: 11px;
            font-weight: 800;
        }

        .studio-class-control select,
        .studio-toolbar-right select,
        .studio-toolbar-right input {
            width: 100%;
            padding: 11px 12px;
            border: 1px solid #d9e8f5;
            border-radius: 11px;
            background: #f9fcff;
            color: #344b65;
            font: inherit;
            font-size: 12px;
            outline: none;
        }

        .studio-small-note {
            margin: 8px 0 0;
            font-size: 11px;
            line-height: 1.6;
            color: #849ab0;
        }

        .studio-small-note a {
            color: #497eae;
            font-weight: 800;
        }

        .studio-warning {
            display: flex;
            gap: 12px;
            margin-top: 17px;
            padding: 15px 18px;
            border: 1px solid #f5dbad;
            background: #fff9ed;
            border-radius: 13px;
            color: #916d33;
        }

        .studio-warning strong {
            font-size: 12px;
        }

        .studio-warning p {
            margin: 5px 0 0;
            font-size: 11px;
            line-height: 1.7;
        }

        /* =========================================
           HEADER & FILTER
        ========================================= */

        .studio-section-intro {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin: 49px 0 20px;
        }

        .studio-section-intro h2 {
            margin: 9px 0 7px;
            font-size: 26px;
        }

        .studio-section-intro p,
        .studio-group-heading p {
            margin: 0;
            font-size: 13px;
            line-height: 1.8;
            color: #849ab0;
        }

        .studio-peek-mascot {
            width: 95px;
            height: 90px;
            object-fit: contain;
        }

        .studio-toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 28px;
        }

        .studio-filter-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 7px;
            padding: 5px;
            border-radius: 14px;
            background: #eaf3fc;
        }

        .studio-filter {
            border: 0;
            border-radius: 10px;
            padding: 11px 17px;
            background: transparent;
            color: #6f8ca8;
            font: inherit;
            font-size: 12px;
            font-weight: 800;
            cursor: pointer;
            transition: .2s ease;
        }

        .studio-filter.active {
            background: #719bc3;
            color: white;
            box-shadow: 0 5px 12px rgba(113, 155, 195, .19);
        }

        .studio-toolbar-right {
            display: flex;
            gap: 10px;
        }

        .studio-toolbar-right select {
            width: 145px;
        }

        .studio-toolbar-right input {
            width: 205px;
        }

        /* =========================================
           TEMPLATE GROUP
        ========================================= */

        .studio-group {
            margin-top: 32px;
            margin-bottom: 42px;
        }

        .studio-group-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 19px;
        }

        .studio-group-heading h2 {
            margin: 8px 0 6px;
            font-size: 22px;
        }

        .studio-count {
            padding: 9px 13px;
            border-radius: 30px;
            background: #eaf4ff;
            color: #719bc3;
            font-size: 11px;
            font-weight: 800;
            white-space: nowrap;
        }

        .studio-grid {
            display: grid;
            gap: 18px;
        }

        .studio-grid-material {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }

        .studio-grid-evaluation {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        /* =========================================
           KARTU TEMPLATE
        ========================================= */

        .studio-template {
            display: flex;
            flex-direction: column;
            min-width: 0;
            overflow: hidden;
            border: 1px solid #e1ecf6;
            border-radius: 22px;
            background: white;
            transition: .2s ease;
        }

        .studio-template:hover {
            transform: translateY(-4px);
            border-color: #b8d4eb;
            box-shadow: 0 14px 30px rgba(87, 130, 170, .09);
        }

        .studio-template-art {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: flex-end;
            height: 166px;
            background: linear-gradient(145deg, #eaf4ff, #f7faff);
            overflow: hidden;
        }

        .studio-template:nth-child(even) .studio-template-art {
            background: linear-gradient(145deg, #eff1ff, #f8faff);
        }

        .studio-template-art img {
            width: 152px;
            height: 135px;
            object-fit: contain;
            object-position: center bottom;
            transition: transform .25s ease;
        }

        .studio-template:hover .studio-template-art img {
            transform: translateY(-5px) scale(1.04);
        }

        .studio-template-type {
            position: absolute;
            top: 15px;
            left: 15px;
            z-index: 1;
            padding: 7px 10px;
            border-radius: 30px;
            background: white;
            color: #6489b0;
            font-size: 10px;
            font-weight: 800;
        }

        .studio-template-body {
            display: flex;
            flex-direction: column;
            flex: 1;
            padding: 22px;
        }

        .studio-level-tags {
            display: flex;
            gap: 6px;
            margin-bottom: 14px;
        }

        .studio-level-tags span {
            padding: 5px 9px;
            border-radius: 7px;
            background: #eef5fb;
            color: #7193b4;
            font-size: 10px;
            font-weight: 800;
        }

        .studio-template h3 {
            margin: 0 0 9px;
            font-size: 17px;
            color: #344b65;
        }

        .studio-template-body>p {
            flex: 1;
            margin: 0 0 21px;
            color: #8499ad;
            font-size: 12px;
            line-height: 1.8;
        }

        .studio-template-button {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #d5e7f8;
            border-radius: 11px;
            background: #eaf4ff;
            color: #537fac;
            font: inherit;
            font-size: 12px;
            font-weight: 800;
            cursor: pointer;
            transition: .2s ease;
        }

        .studio-template-button:hover {
            background: #719bc3;
            color: white;
            border-color: #719bc3;
        }

        /* =========================================
           TEMPLATE KOSONG
        ========================================= */

        .studio-empty {
            margin: 25px 0;
            padding: 40px 20px;
            border: 1px dashed #c9dfef;
            border-radius: 20px;
            text-align: center;
        }

        .studio-empty img {
            width: 90px;
            height: 90px;
            object-fit: contain;
        }

        .studio-empty h3 {
            margin: 10px 0;
        }

        .studio-empty p {
            color: #849ab0;
            font-size: 12px;
        }

        /* =========================================
           TIPS MASKOT
        ========================================= */

        .studio-tips {
            margin-top: 35px;
            padding: 28px;
            border: 1px solid #dbeafa;
            border-radius: 24px;
            background: #eaf4ff;
        }

        .studio-tips-heading {
            text-align: center;
            margin-bottom: 25px;
        }

        .studio-tips-heading h2 {
            margin: 10px 0 0;
            font-size: 22px;
        }

        .studio-tips-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 14px;
        }

        .studio-tip {
            padding: 16px;
            background: rgba(255, 255, 255, .85);
            border-radius: 17px;
            text-align: center;
        }

        .studio-tip img {
            display: block;
            width: 95px;
            height: 95px;
            margin: 0 auto 12px;
            object-fit: contain;
        }

        .studio-tip strong {
            display: block;
            margin-bottom: 7px;
            font-size: 12px;
        }

        .studio-tip p {
            margin: 0;
            color: #8a9fb2;
            font-size: 11px;
            line-height: 1.7;
        }

        /* =========================================
           MODAL DETAIL
        ========================================= */

        .studio-modal {
            width: min(540px, calc(100% - 30px));
            max-height: 85vh;
            padding: 0;
            overflow-y: auto;
            border: 1px solid #dce9f6;
            border-radius: 23px;
            background: white;
            color: #344b65;
            font-family: 'Plus Jakarta Sans', sans-serif;
            box-shadow: 0 25px 70px rgba(48, 74, 103, .15);
        }

        .studio-modal::backdrop {
            background: rgba(36, 54, 80, .5);
            backdrop-filter: blur(4px);
        }

        .studio-modal-header {
            position: relative;
            display: flex;
            align-items: center;
            gap: 17px;
            padding: 22px 24px;
            background: #edf6ff;
        }

        .studio-modal-header img {
            width: 90px;
            height: 85px;
            object-fit: contain;
            flex-shrink: 0;
        }

        .studio-modal-header h2 {
            margin: 8px 25px 0 0;
            font-size: 21px;
        }

        .studio-modal-close {
            position: absolute;
            top: 15px;
            right: 15px;
            padding: 8px 11px;
            border: 0;
            border-radius: 9px;
            background: white;
            color: #5c7c9c;
            cursor: pointer;
        }

        .studio-modal-content {
            padding: 23px 26px;
        }

        .studio-modal-content>p {
            color: #7e94ab;
            font-size: 13px;
            line-height: 1.8;
        }

        .studio-modal-content h3 {
            margin: 23px 0 10px;
            font-size: 13px;
        }

        .studio-example {
            padding: 14px;
            border-radius: 12px;
            background: #f0f7ff;
            color: #537ca5;
            font-size: 12px;
            line-height: 1.8;
        }

        .studio-modal-content ul {
            padding-left: 20px;
            color: #6f879f;
            font-size: 12px;
            line-height: 2.1;
        }

        .studio-modal-content .studio-modal-note {
            padding: 12px;
            border-radius: 11px;
            background: #fff9e9;
            color: #967949;
            font-size: 11px;
        }

        .studio-modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            padding: 15px 25px 22px;
        }

        .studio-modal-actions button {
            padding: 12px 16px;
            border: 0;
            border-radius: 11px;
            font: inherit;
            font-size: 12px;
            font-weight: 800;
            cursor: pointer;
        }

        .studio-modal-cancel {
            background: #edf3fa;
            color: #64829f;
        }

        .studio-modal-select {
            background: #719bc3;
            color: white;
        }

        .studio-modal-select:disabled {
            background: #d5e0eb;
            color: #8da1b5;
            cursor: not-allowed;
        }

        /* =========================================
           RESPONSIVE
        ========================================= */

        @media(max-width:1000px) {
            .studio-grid-material {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .studio-tips-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media(max-width:720px) {
            .studio-hero {
                padding: 25px;
            }

            .studio-hero-mascot {
                width: 105px;
                height: 120px;
            }

            .studio-class-panel {
                flex-direction: column;
                align-items: stretch;
            }

            .studio-class-control {
                width: 100%;
            }

            .studio-grid-material,
            .studio-grid-evaluation {
                grid-template-columns: 1fr;
            }

            .studio-toolbar-right {
                width: 100%;
            }

            .studio-toolbar-right select,
            .studio-toolbar-right input {
                flex: 1;
                min-width: 0;
            }
        }

        @media(max-width:480px) {
            .studio-hero-mascot {
                display: none;
            }

            .studio-peek-mascot {
                width: 60px;
                height: 65px;
            }

            .studio-tips-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .studio-tip {
                padding: 11px;
            }

            .studio-tip img {
                width: 65px;
                height: 65px;
            }
        }

        @media(prefers-reduced-motion:reduce) {

            .studio-template,
            .studio-template-art img {
                transition: none;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            /*
            |--------------------------------------------------------------------------
            | ELEMENT HALAMAN
            |--------------------------------------------------------------------------
            */

            const cards = Array.from(
                document.querySelectorAll('.studio-template')
            );

            const filters = Array.from(
                document.querySelectorAll('.studio-filter')
            );

            const classSelect = document.getElementById('studioClass');
            const levelFilter = document.getElementById('studioLevel');
            const searchInput = document.getElementById('studioSearch');

            const materialsSection = document.getElementById(
                'studioMaterials'
            );

            const evaluationsSection = document.getElementById(
                'studioEvaluations'
            );

            const emptyState = document.getElementById(
                'studioEmpty'
            );

            const modal = document.getElementById('studioModal');

            const modalMascot = document.getElementById(
                'studioModalMascot'
            );

            const modalType = document.getElementById(
                'studioModalType'
            );

            const modalTitle = document.getElementById(
                'studioModalTitle'
            );

            const modalDescription = document.getElementById(
                'studioModalDescription'
            );

            const modalExample = document.getElementById(
                'studioModalExample'
            );

            const modalFields = document.getElementById(
                'studioModalFields'
            );

            const modalNote = document.getElementById(
                'studioModalNote'
            );

            const chooseButton = document.getElementById(
                'studioChoose'
            );

            let activeType = 'semua';
            let currentCard = null;

            /*
            |--------------------------------------------------------------------------
            | 1. FILTER TEMPLATE
            |--------------------------------------------------------------------------
            */

            function applyFilters() {

                const level = levelFilter.value;

                const keyword = searchInput.value
                    .trim()
                    .toLowerCase();

                let materialCount = 0;
                let evaluationCount = 0;

                cards.forEach(card => {

                    const type = card.dataset.type;
                    const levels = card.dataset.levels.split(',');

                    const searchableText = (
                        card.dataset.title + ' ' +
                        card.dataset.description
                    ).toLowerCase();

                    const matchType =
                        activeType === 'semua' ||
                        activeType === type;

                    const matchLevel =
                        level === 'semua' ||
                        levels.includes(level);

                    const matchSearch =
                        searchableText.includes(keyword);

                    const visible =
                        matchType &&
                        matchLevel &&
                        matchSearch;

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

                emptyState.hidden =
                    (materialCount + evaluationCount) > 0;
            }

            filters.forEach(button => {

                button.addEventListener('click', function() {

                    activeType = button.dataset.filter;

                    filters.forEach(item => {

                        const selected = item === button;

                        item.classList.toggle(
                            'active',
                            selected
                        );

                        item.setAttribute(
                            'aria-pressed',
                            String(selected)
                        );
                    });

                    applyFilters();
                });
            });

            levelFilter.addEventListener('change', applyFilters);

            searchInput.addEventListener('input', applyFilters);

            /*
            |--------------------------------------------------------------------------
            | 2. BUKA MODAL TEMPLATE
            |--------------------------------------------------------------------------
            */

            function openTemplate(card) {

                currentCard = card;

                const type = card.dataset.type;
                const editorUrl = card.dataset.editorUrl;

                modalMascot.src = card.dataset.mascot;

                modalMascot.alt =
                    'Maskot ' + card.dataset.title;

                modalType.textContent =
                    type === 'materi' ?
                    '📖 TEMPLATE MATERI' :
                    '📝 TEMPLATE EVALUASI';

                modalTitle.textContent =
                    card.dataset.title;

                modalDescription.textContent =
                    card.dataset.description;

                modalExample.textContent =
                    card.dataset.example;

                // Bersihkan daftar sebelum memuat data baru.
                modalFields.replaceChildren();

                const fields = card.dataset.fields.split('|');

                fields.forEach(field => {

                    const li = document.createElement('li');

                    li.textContent = field;

                    modalFields.appendChild(li);
                });

                /*
                | Tentukan apakah template dapat digunakan.
                */


                if (type === 'evaluasi') {

                    chooseButton.disabled = true;

                    chooseButton.textContent =
                        'Editor Evaluasi Belum Tersedia';

                    modalNote.textContent =
                        'Template evaluasi ini bisa dilihat, tetapi editor ' +
                        'pembuatan soal belum tersedia.';

                } else if (card.dataset.id === 'coding' && editorUrl) {

                    // Khusus Praktik Coding Python.
                    chooseButton.disabled = false;

                    chooseButton.textContent =
                        'Lihat Contoh Praktik Coding →';

                    modalNote.textContent =
                        'Buka latihan Coding Python asli CodePawth, ' +
                        'lengkap dengan mini flowchart, editor, ' +
                        'simulasi output, dan skor. ' +
                        'Editor soal khusus Guru belum dibuat.';

                } else if (!editorUrl) {

                    chooseButton.disabled = true;

                    chooseButton.textContent =
                        'Editor Materi Belum Terhubung';

                    modalNote.textContent =
                        'Route editor materi belum tersedia. ' +
                        'Periksa route guru.materi.create.';

                } else {

                    // Flashcard dan Tulisan + Gambar.
                    chooseButton.disabled = false;

                    chooseButton.textContent =
                        'Gunakan Template Ini →';

                    modalNote.textContent =
                        'Buka editor Guru untuk mengisi materi, ' +
                        'melihat pratinjau, dan menyimpan hasilnya.';

                }


                modal.showModal();
            }

            /*
            |--------------------------------------------------------------------------
            | 3. KLIK KARTU TEMPLATE
            |--------------------------------------------------------------------------
            */

            cards.forEach(card => {

                const button = card.querySelector(
                    '.studio-template-button'
                );

                button.addEventListener('click', function() {

                    openTemplate(card);

                });
            });

            /*
            |--------------------------------------------------------------------------
            | 4. PILIH TEMPLATE MATERI
            |--------------------------------------------------------------------------
            */


            chooseButton.addEventListener('click', function() {

                if (!currentCard) return;

                const templateId = currentCard.dataset.id;
                const templateType = currentCard.dataset.type;
                const editorUrl = currentCard.dataset.editorUrl;

                // Evaluasi belum memiliki editor.
                if (templateType !== 'materi') {
                    return;
                }

                if (!editorUrl) {
                    return;
                }

                // =====================================
                // TEMPLATE PRAKTIK CODING PYTHON
                // =====================================

                if (templateId === 'coding') {

                    // Buka contoh Coding Python bawaan.
                    // Tidak memakai editor Guru atau class_id.
                    window.location.assign(editorUrl);

                    return;
                }

                // =====================================
                // TEMPLATE FLASHCARD DAN ARTIKEL
                // =====================================

                const url = new URL(
                    editorUrl,
                    window.location.origin
                );

                // Kirim kelas yang dipilih ke editor Guru.
                if (classSelect.value) {

                    url.searchParams.set(
                        'class_id',
                        classSelect.value
                    );

                }

                window.location.assign(url.toString());

            });

            /*
            |--------------------------------------------------------------------------
            | 5. TUTUP MODAL
            |--------------------------------------------------------------------------
            */

            document.getElementById('studioModalClose')
                .addEventListener('click', function() {
                    modal.close();
                });

            document.getElementById('studioCancel')
                .addEventListener('click', function() {
                    modal.close();
                });

            modal.addEventListener('click', function(event) {

                if (event.target === modal) {
                    modal.close();
                }
            });

            /*
            |--------------------------------------------------------------------------
            | 6. JALANKAN FILTER AWAL
            |--------------------------------------------------------------------------
            */

            applyFilters();

        });
    </script>
@endpush
