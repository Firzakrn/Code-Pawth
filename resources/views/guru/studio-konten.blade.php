@extends('layouts.portal')

@section('title', 'Studio Konten Guru')

@section('content')

@php
    $templates = [
        [
            'id' => 'flashcard',
            'type' => 'materi',
            'title' => 'Flashcard Interaktif',
            'description' => 'Kartu dua sisi untuk mengenalkan konsep, sintaks, dan istilah pemrograman.',
            'mascot' => 'mascot_card.png',
            'levels' => ['SD', 'SMP', 'SMA'],
            'example' => 'Depan: print() | Belakang: Perintah untuk menampilkan teks.',
            'fields' => [
                'Judul dan deskripsi materi',
                'Teks sisi depan kartu',
                'Teks sisi belakang kartu',
                'Gambar pendukung (opsional)',
                'Tambah banyak kartu',
            ],
        ],
        [
            'id' => 'artikel',
            'type' => 'materi',
            'title' => 'Tulisan + Gambar',
            'description' => 'Materi berbentuk bacaan dengan subjudul, gambar, dan penjelasan.',
            'mascot' => 'mascot_dashboard.png',
            'levels' => ['SD', 'SMP', 'SMA'],
            'example' => 'Materi algoritma dengan penjelasan bertahap dan gambar flowchart.',
            'fields' => [
                'Judul dan subjudul',
                'Paragraf penjelasan',
                'Unggah gambar',
                'Caption dan catatan penting',
                'Tambah bagian materi',
            ],
        ],
        [
            'id' => 'foto',
            'type' => 'materi',
            'title' => 'Foto + Penjelasan',
            'description' => 'Unggah gambar, poster, atau screenshot, kemudian berikan penjelasan.',
            'mascot' => 'mascot_what.png',
            'levels' => ['SD', 'SMP', 'SMA'],
            'example' => 'Gambar simbol decision dengan penjelasan fungsi dan contohnya.',
            'fields' => [
                'Judul materi',
                'Unggah foto atau ilustrasi',
                'Penjelasan gambar',
                'Caption',
                'Pertanyaan refleksi (opsional)',
            ],
        ],
        [
            'id' => 'matching',
            'type' => 'evaluasi',
            'title' => 'Mencocokkan Pasangan',
            'description' => 'Siswa memasangkan istilah, kode, simbol, atau gambar dengan jawaban.',
            'mascot' => 'mascot_loveya.png',
            'levels' => ['SD', 'SMP', 'SMA'],
            'example' => 'Simbol belah ketupat dipasangkan dengan fungsi keputusan.',
            'fields' => [
                'Judul dan petunjuk',
                'Daftar item kolom kiri',
                'Daftar item kolom kanan',
                'Pasangan jawaban benar',
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
            'fields' => [
                'Pertanyaan',
                'Pilihan potongan kode',
                'Jawaban benar',
                'Penjelasan jawaban',
                'Bobot nilai',
            ],
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
                'Judul dan instruksi tantangan',
                'Node flowchart yang tersedia',
                'Hubungan dan arah panah',
                'Alur jawaban benar',
                'Preview kode Python',
                'Aturan evaluasi',
            ],
        ],
        [
            'id' => 'coding-blocks',
            'type' => 'evaluasi',
            'title' => 'Coding Blocks',
            'description' => 'Blok kode yang bisa disusun, dipindahkan, dan diedit nilainya.',
            'mascot' => 'mascot_run.png',
            'levels' => ['SMP', 'SMA'],
            'example' => 'Susun blok variabel nilai, kondisi if, dan perintah output.',
            'fields' => [
                'Instruksi tantangan',
                'Jenis blok yang tersedia',
                'Variabel dan nilai awal',
                'Bagian blok yang bisa diedit',
                'Output yang diharapkan',
                'Aturan pemeriksaan jawaban',
            ],
        ],
    ];

    $materialTemplates = array_values(array_filter(
        $templates,
        fn ($item) => $item['type'] === 'materi'
    ));

    $evaluationTemplates = array_values(array_filter(
        $templates,
        fn ($item) => $item['type'] === 'evaluasi'
    ));
@endphp

<div class="studio-page">

    {{-- HEADER --}}
    <div class="studio-breadcrumb">
        <a href="{{ route('guru.dashboard') }}">
            Dashboard Guru
        </a>
        <span>›</span>
        <strong>Studio Konten</strong>
    </div>

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

        </div>

        <div class="studio-hero-mascot">
            <img
                src="{{ asset('images/mascot_class.png') }}"
                alt="Maskot CodePawth sedang menggunakan laptop"
            >
        </div>

    </section>

    {{-- PILIH KELAS --}}
    <section class="studio-class-panel">

        <div class="studio-class-heading">
            <div class="studio-class-icon">🏫</div>

            <div>
                <h2>Untuk kelas mana?</h2>
                <p>
                    Opsional untuk sekarang. Kamu tetap bisa
                    menjelajahi template tanpa memilih kelas.
                </p>
            </div>
        </div>

        <div class="studio-class-control">

            <label for="studioClass">Kelas tujuan</label>

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
                        Buat kelas di Dashboard Guru
                    </a>.
                </p>
            @endif

        </div>

    </section>

    {{-- INTRO PILIH TEMPLATE --}}
    <div class="studio-section-intro">

        <div>
            <span class="studio-eyebrow">PERPUSTAKAAN TEMPLATE</span>

            <h2>Mau membuat apa hari ini?</h2>

            <p>
                Pilih jenis konten yang ingin kamu siapkan.
                Semua template dapat disesuaikan dengan materi
                pembelajaran.
            </p>
        </div>

        <img
            src="{{ asset('images/mascot_peeking.png') }}"
            alt="Maskot mengintip pilihan template"
            class="studio-peek-mascot"
        >

    </div>

    {{-- FILTER --}}
    <div class="studio-toolbar">

        <div class="studio-filter-buttons"
             aria-label="Filter jenis template">

            <button type="button"
                    class="studio-filter active"
                    data-filter="semua"
                    aria-pressed="true">
                Semua
            </button>

            <button type="button"
                    class="studio-filter"
                    data-filter="materi"
                    aria-pressed="false">
                📖 Materi
            </button>

            <button type="button"
                    class="studio-filter"
                    data-filter="evaluasi"
                    aria-pressed="false">
                📝 Evaluasi
            </button>

        </div>

        <div class="studio-toolbar-right">

            <select id="studioLevel"
                    aria-label="Filter jenjang">
                <option value="semua">Semua Jenjang</option>
                <option value="SD">SD</option>
                <option value="SMP">SMP</option>
                <option value="SMA">SMA</option>
            </select>

            <input
                type="search"
                id="studioSearch"
                placeholder="Cari template..."
                aria-label="Cari template"
            >

        </div>

    </div>

    {{-- TEMPLATE YANG DIPILIH --}}
    <div id="studioSelected" class="studio-selected" hidden>
        <div>
            <span>✓ TEMPLATE DIPILIH</span>
            <strong id="studioSelectedName"></strong>
            <p id="studioSelectedClass"></p>
        </div>

        <button type="button" id="studioClearSelection">
            Batalkan
        </button>
    </div>

    {{-- MATERI --}}
    <section id="studioMaterials" class="studio-group">

        <div class="studio-group-heading">
            <div>
                <span class="studio-eyebrow">01 / MATERI</span>
                <h2>Template Materi</h2>
                <p>
                    Buat konten pembelajaran yang menarik
                    dan mudah dipahami.
                </p>
            </div>

            <span class="studio-count">3 Template</span>
        </div>

        <div class="studio-grid studio-grid-material">

            @foreach ($materialTemplates as $template)

                <article
                    class="studio-template"
                    data-id="{{ $template['id'] }}"
                    data-type="{{ $template['type'] }}"
                    data-levels="{{ implode(',', $template['levels']) }}"
                    data-title="{{ $template['title'] }}"
                    data-description="{{ $template['description'] }}"
                    data-example="{{ $template['example'] }}"
                    data-fields="{{ implode('|', $template['fields']) }}"
                    data-mascot="{{ asset('images/' . $template['mascot']) }}"
                >

                    <div class="studio-template-art">
                        <span class="studio-template-type">
                            📖 MATERI
                        </span>

                        <img
                            src="{{ asset('images/' . $template['mascot']) }}"
                            alt="Maskot template {{ $template['title'] }}"
                            loading="lazy"
                        >
                    </div>

                    <div class="studio-template-body">

                        <div class="studio-level-tags">
                            @foreach ($template['levels'] as $level)
                                <span>{{ $level }}</span>
                            @endforeach
                        </div>

                        <h3>{{ $template['title'] }}</h3>

                        <p>{{ $template['description'] }}</p>

                        <button
                            type="button"
                            class="studio-template-button">
                            Lihat & Pilih Template
                            <span>→</span>
                        </button>

                    </div>

                </article>

            @endforeach

        </div>

    </section>

    {{-- EVALUASI --}}
    <section id="studioEvaluations" class="studio-group">

        <div class="studio-group-heading">

            <div>
                <span class="studio-eyebrow">02 / EVALUASI</span>

                <h2>Template Soal & Evaluasi</h2>

                <p>
                    Rancang tantangan yang menguji pemahaman,
                    logika, dan kemampuan coding siswa.
                </p>
            </div>

            <span class="studio-count">4 Template</span>

        </div>

        <div class="studio-grid studio-grid-evaluation">

            @foreach ($evaluationTemplates as $template)

                <article
                    class="studio-template"
                    data-id="{{ $template['id'] }}"
                    data-type="{{ $template['type'] }}"
                    data-levels="{{ implode(',', $template['levels']) }}"
                    data-title="{{ $template['title'] }}"
                    data-description="{{ $template['description'] }}"
                    data-example="{{ $template['example'] }}"
                    data-fields="{{ implode('|', $template['fields']) }}"
                    data-mascot="{{ asset('images/' . $template['mascot']) }}"
                >

                    <div class="studio-template-art">
                        <span class="studio-template-type">
                            📝 EVALUASI
                        </span>

                        <img
                            src="{{ asset('images/' . $template['mascot']) }}"
                            alt="Maskot template {{ $template['title'] }}"
                            loading="lazy"
                        >
                    </div>

                    <div class="studio-template-body">

                        <div class="studio-level-tags">
                            @foreach ($template['levels'] as $level)
                                <span>{{ $level }}</span>
                            @endforeach
                        </div>

                        <h3>{{ $template['title'] }}</h3>

                        <p>{{ $template['description'] }}</p>

                        <button
                            type="button"
                            class="studio-template-button">
                            Lihat & Pilih Template
                            <span>→</span>
                        </button>

                    </div>

                </article>

            @endforeach

        </div>

    </section>

    {{-- PESAN FILTER KOSONG --}}
    <div id="studioEmpty" class="studio-empty" hidden>
        <span>🔎</span>
        <h3>Template belum ditemukan</h3>
        <p>Coba ubah pencarian atau pilihan jenjang.</p>
    </div>

    {{-- PANDUAN MASKOT --}}
    <section class="studio-tips">

        <div class="studio-tips-heading">
            <span class="studio-eyebrow">
                TIPS DARI MASKOT CODEPAWTH
            </span>

            <h2>Bikin belajar jadi lebih menyenangkan!</h2>
        </div>

        <div class="studio-tips-grid">

            <div class="studio-tip">
                <img
                    src="{{ asset('images/mascot_cheers.png') }}"
                    alt="Maskot bersemangat"
                    loading="lazy"
                >
                <strong>Mulai dari yang mudah</strong>
                <p>Gunakan flashcard untuk konsep baru.</p>
            </div>

            <div class="studio-tip">
                <img
                    src="{{ asset('images/mascot_happy.png') }}"
                    alt="Maskot membawa piala"
                    loading="lazy"
                >
                <strong>Berikan apresiasi</strong>
                <p>Rayakan pencapaian setiap siswa.</p>
            </div>

            <div class="studio-tip">
                <img
                    src="{{ asset('images/mascot_loveya.png') }}"
                    alt="Maskot dengan simbol hati"
                    loading="lazy"
                >
                <strong>Beri petunjuk ramah</strong>
                <p>Bantu siswa memahami kesalahannya.</p>
            </div>

            <div class="studio-tip">
                <img
                    src="{{ asset('images/mascot_angry.png') }}"
                    alt="Maskot sedang kesal"
                    loading="lazy"
                >
                <strong>Jadikan bug tantangan</strong>
                <p>Ajak siswa mencari dan memperbaiki error.</p>
            </div>

        </div>

    </section>

</div>

{{-- MODAL DETAIL TEMPLATE --}}
<dialog id="studioModal" class="studio-modal">

    <div class="studio-modal-header">

        <img id="studioModalMascot"
             src=""
             alt="Maskot template">

        <div>
            <span class="studio-eyebrow" id="studioModalType">
                TEMPLATE
            </span>

            <h2 id="studioModalTitle"></h2>
        </div>

        <button type="button"
                id="studioModalClose"
                class="studio-modal-close"
                aria-label="Tutup detail">
            ✕
        </button>

    </div>

    <div class="studio-modal-content">

        <p id="studioModalDescription"></p>

        <h3>Contoh Penggunaan</h3>
        <div id="studioModalExample" class="studio-example"></div>

        <h3>Komponen yang akan diisi guru</h3>
        <ul id="studioModalFields"></ul>

        <p class="studio-modal-note">
            Ini adalah pratinjau template.
            Editor dan penyimpanan konten akan dibuat
            pada tahap pengembangan berikutnya.
        </p>

    </div>

    <div class="studio-modal-actions">

        <button type="button"
                class="studio-modal-cancel"
                id="studioCancel">
            Kembali
        </button>

        <button type="button"
                class="studio-modal-select"
                id="studioChoose">
            Pilih Template Ini ✓
        </button>

    </div>

</dialog>

@endsection

@push('styles')
<style>

    .studio-page {
        max-width: 1180px;
        margin: 0 auto;
    }

    .studio-page * {
        box-sizing: border-box;
    }

    .studio-breadcrumb {
        display: flex;
        gap: 9px;
        align-items: center;
        color: #8b9fb4;
        font-size: 12px;
        margin-bottom: 22px;
    }

    .studio-breadcrumb a {
        color: #719bc3;
        font-weight: 700;
    }

    .studio-breadcrumb strong {
        color: #344b65;
    }

    .studio-eyebrow {
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 1px;
        color: #719bc3;
    }

    /* HERO */

    .studio-hero {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: space-between;
        min-height: 245px;
        overflow: hidden;
        border: 1px solid #d5e8fa;
        border-radius: 27px;
        padding: 34px 40px;
        background: linear-gradient(
            115deg,
            #e4f1ff,
            #f4f9ff
        );
    }

    .studio-hero-copy {
        position: relative;
        z-index: 2;
        max-width: 690px;
    }

    .studio-hero h1 {
        margin: 12px 0;
        color: #344b65;
        font-size: clamp(27px, 3vw, 38px);
        font-weight: 800;
        letter-spacing: -1px;
    }

    .studio-hero h1 span {
        color: #719bc3;
    }

    .studio-hero p {
        max-width: 610px;
        margin: 0;
        color: #718ba5;
        font-size: 13px;
        line-height: 1.8;
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
        background: rgba(255,255,255,.85);
        color: #5d82a8;
        font-size: 11px;
        font-weight: 800;
    }

    .studio-hero-mascot {
        display: flex;
        align-items: flex-end;
        justify-content: center;
        flex-shrink: 0;
        width: 215px;
        height: 190px;
    }

    .studio-hero-mascot img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        filter: drop-shadow(0 10px 14px rgba(93,130,170,.12));
    }

    /* PANEL KELAS */

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
        background: #eaf4ff;
        border-radius: 15px;
        font-size: 25px;
        flex-shrink: 0;
    }

    .studio-class-heading h2 {
        margin: 0 0 5px;
        font-size: 16px;
    }

    .studio-class-heading p {
        margin: 0;
        color: #849ab0;
        font-size: 12px;
        line-height: 1.7;
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
        border: 1px solid #d9e8f5;
        border-radius: 11px;
        padding: 11px 12px;
        color: #344b65;
        background: #f9fcff;
        font: inherit;
        font-size: 12px;
        outline: none;
    }

    .studio-small-note {
        font-size: 11px;
        line-height: 1.6;
        color: #849ab0;
        margin: 8px 0 0;
    }

    .studio-small-note a {
        color: #497eae;
        font-weight: 800;
    }

    /* PILIH TEMPLATE */

    .studio-section-intro {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin: 49px 0 20px;
    }

    .studio-section-intro h2 {
        font-size: 26px;
        margin: 9px 0 7px;
    }

    .studio-section-intro p,
    .studio-group-heading p {
        color: #849ab0;
        line-height: 1.8;
        font-size: 13px;
        margin: 0;
    }

    .studio-peek-mascot {
        height: 90px;
        width: 95px;
        object-fit: contain;
    }

    .studio-toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        margin-bottom: 28px;
        flex-wrap: wrap;
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
        background: transparent;
        color: #6f8ca8;
        font-family: inherit;
        font-size: 12px;
        font-weight: 800;
        padding: 11px 17px;
        cursor: pointer;
        transition: .2s ease;
    }

    .studio-filter:hover {
        color: #426f9d;
    }

    .studio-filter.active {
        background: #719bc3;
        color: white;
        box-shadow: 0 5px 12px rgba(113,155,195,.19);
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

    /* GROUP */

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
        background: #eaf4ff;
        color: #719bc3;
        border-radius: 30px;
        padding: 9px 13px;
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

    .studio-template {
        display: flex;
        flex-direction: column;
        min-width: 0;
        overflow: hidden;
        border: 1px solid #e1ecf6;
        border-radius: 22px;
        background: white;
        transition: transform .2s ease,
                    border-color .2s ease,
                    box-shadow .2s ease;
    }

    .studio-template:hover {
        transform: translateY(-4px);
        border-color: #b8d4eb;
        box-shadow: 0 14px 30px rgba(87,130,170,.09);
    }

    .studio-template.is-selected {
        border: 2px solid #719bc3;
    }

    .studio-template-art {
        position: relative;
        display: flex;
        justify-content: center;
        align-items: flex-end;
        height: 166px;
        background: linear-gradient(
            145deg,
            #eaf4ff,
            #f7faff
        );
        overflow: hidden;
    }

    .studio-template:nth-child(even) .studio-template-art {
        background: linear-gradient(
            145deg,
            #eff1ff,
            #f8faff
        );
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
        padding: 7px 10px;
        background: white;
        border-radius: 30px;
        color: #6489b0;
        font-size: 10px;
        font-weight: 800;
        z-index: 1;
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
        font-size: 17px;
        margin: 0 0 9px;
        color: #344b65;
    }

    .studio-template-body > p {
        flex: 1;
        font-size: 12px;
        line-height: 1.8;
        color: #8499ad;
        margin: 0 0 21px;
    }

    .studio-template-button {
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
        padding: 12px 15px;
        border: 1px solid #d5e7f8;
        border-radius: 11px;
        background: #eaf4ff;
        color: #537fac;
        font-family: inherit;
        font-size: 12px;
        font-weight: 800;
        cursor: pointer;
        transition: .2s ease;
    }

    .studio-template-button:hover {
        background: #719bc3;
        border-color: #719bc3;
        color: white;
    }

    /* PILIHAN TERAKHIR */

    .studio-selected {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 23px;
        padding: 16px 19px;
        border: 1px solid #bcd9ef;
        border-radius: 15px;
        background: #edf6ff;
    }

    .studio-selected[hidden] {
        display: none;
    }

    .studio-selected span {
        display: block;
        color: #719bc3;
        font-size: 10px;
        font-weight: 800;
        margin-bottom: 5px;
    }

    .studio-selected strong {
        font-size: 14px;
    }

    .studio-selected p {
        margin: 5px 0 0;
        color: #7991a9;
        font-size: 11px;
    }

    .studio-selected button {
        border: 1px solid #cfdfed;
        border-radius: 10px;
        padding: 10px 14px;
        background: white;
        color: #537ca5;
        font-family: inherit;
        font-weight: 800;
        cursor: pointer;
    }

    /* TIPS MASKOT */

    .studio-tips {
        padding: 28px;
        border-radius: 24px;
        background: #eaf4ff;
        border: 1px solid #dbeafa;
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
        background: rgba(255,255,255,.85);
        border-radius: 17px;
        padding: 16px;
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
        font-size: 11px;
        color: #8a9fb2;
        line-height: 1.7;
    }

    .studio-empty {
        text-align: center;
        padding: 50px 20px;
        border: 1px dashed #c9dfef;
        border-radius: 20px;
        margin: 25px 0;
    }

    .studio-empty[hidden] {
        display: none;
    }

    .studio-empty span {
        font-size: 35px;
    }

    /* MODAL */

    .studio-modal {
        width: min(540px, calc(100% - 30px));
        max-height: min(85vh, 740px);
        padding: 0;
        border: 1px solid #dce9f6;
        border-radius: 23px;
        background: white;
        color: #344b65;
        font-family: 'Plus Jakarta Sans', sans-serif;
        box-shadow: 0 25px 70px rgba(48,74,103,.15);
        overflow-y: auto;
    }

    .studio-modal::backdrop {
        background: rgba(36,54,80,.5);
        backdrop-filter: blur(4px);
    }

    .studio-modal-header {
        position: relative;
        display: flex;
        gap: 17px;
        align-items: center;
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
        font-size: 21px;
        margin: 8px 25px 0 0;
    }

    .studio-modal-close {
        position: absolute;
        top: 15px;
        right: 15px;
        border: 0;
        border-radius: 9px;
        padding: 8px 11px;
        color: #5c7c9c;
        background: white;
        cursor: pointer;
    }

    .studio-modal-content {
        padding: 23px 26px;
    }

    .studio-modal-content > p {
        color: #7e94ab;
        font-size: 13px;
        line-height: 1.8;
    }

    .studio-modal-content h3 {
        font-size: 13px;
        margin: 23px 0 10px;
    }

    .studio-example {
        background: #f0f7ff;
        border-radius: 12px;
        padding: 14px;
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
        background: #fff9e9;
        border-radius: 11px;
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
        border-radius: 11px;
        border: 0;
        padding: 12px 16px;
        font: inherit;
        font-weight: 800;
        font-size: 12px;
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

    /* RESPONSIVE */

    @media (max-width: 1000px) {
        .studio-grid-material {
            grid-template-columns: repeat(2, minmax(0,1fr));
        }

        .studio-tips-grid {
            grid-template-columns: repeat(2, minmax(0,1fr));
        }
    }

    @media (max-width: 720px) {
        .studio-hero {
            padding: 25px;
            min-height: 0;
        }

        .studio-hero-mascot {
            width: 105px;
            height: 120px;
            align-self: flex-end;
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

    @media (max-width: 480px) {
        .studio-hero {
            display: block;
        }

        .studio-hero-mascot {
            display: none;
        }

        .studio-peek-mascot {
            width: 60px;
            height: 65px;
        }

        .studio-tips-grid {
            grid-template-columns: 1fr 1fr;
        }

        .studio-tip {
            padding: 11px;
        }

        .studio-tip img {
            width: 65px;
            height: 65px;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .studio-page *,
        .studio-page *::before,
        .studio-page *::after {
            transition: none !important;
        }
    }

</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const cards = Array.from(
        document.querySelectorAll('.studio-template')
    );

    const filters = Array.from(
        document.querySelectorAll('.studio-filter')
    );

    const levelFilter = document.getElementById('studioLevel');
    const searchInput = document.getElementById('studioSearch');
    const classSelect = document.getElementById('studioClass');

    const materialsSection =
        document.getElementById('studioMaterials');

    const evaluationsSection =
        document.getElementById('studioEvaluations');

    const emptyState = document.getElementById('studioEmpty');

    const modal = document.getElementById('studioModal');

    const modalMascot =
        document.getElementById('studioModalMascot');

    const modalType =
        document.getElementById('studioModalType');

    const modalTitle =
        document.getElementById('studioModalTitle');

    const modalDescription =
        document.getElementById('studioModalDescription');

    const modalExample =
        document.getElementById('studioModalExample');

    const modalFields =
        document.getElementById('studioModalFields');

    const selectedBar =
        document.getElementById('studioSelected');

    const selectedName =
        document.getElementById('studioSelectedName');

    const selectedClass =
        document.getElementById('studioSelectedClass');

    let activeType = 'semua';
    let currentCard = null;
    let chosenCard = null;

    // ==========================
    // FILTER TEMPLATE
    // ==========================

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

            const searchText = (
                card.dataset.title + ' ' +
                card.dataset.description
            ).toLowerCase();

            const typeMatches =
                activeType === 'semua' ||
                activeType === type;

            const levelMatches =
                level === 'semua' ||
                levels.includes(level);

            const searchMatches =
                searchText.includes(keyword);

            const visible =
                typeMatches &&
                levelMatches &&
                searchMatches;

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
            materialCount + evaluationCount > 0;
    }

    filters.forEach(button => {

        button.addEventListener('click', function () {

            activeType = this.dataset.filter;

            filters.forEach(item => {
                const active = item === this;

                item.classList.toggle('active', active);

                item.setAttribute(
                    'aria-pressed',
                    String(active)
                );
            });

            applyFilters();
        });
    });

    levelFilter.addEventListener('change', applyFilters);
    searchInput.addEventListener('input', applyFilters);

    // ==========================
    // DETAIL TEMPLATE
    // ==========================

    function openTemplate(card) {

        currentCard = card;

        modalMascot.src = card.dataset.mascot;

        modalMascot.alt =
            'Maskot ' + card.dataset.title;

        modalType.textContent =
            card.dataset.type === 'materi'
                ? '📖 TEMPLATE MATERI'
                : '📝 TEMPLATE EVALUASI';

        modalTitle.textContent =
            card.dataset.title;

        modalDescription.textContent =
            card.dataset.description;

        modalExample.textContent =
            card.dataset.example;

        modalFields.replaceChildren();

        const fields = card.dataset.fields.split('|');

        fields.forEach(field => {
            const li = document.createElement('li');
            li.textContent = field;
            modalFields.appendChild(li);
        });

        modal.showModal();
    }

    cards.forEach(card => {

        const button = card.querySelector(
            '.studio-template-button'
        );

        button.addEventListener('click', function () {
            openTemplate(card);
        });
    });

    // ==========================
    // PILIH TEMPLATE
    // ==========================

    function updateSelectedClass() {

        if (!chosenCard) return;

        const chosenOption =
            classSelect.options[classSelect.selectedIndex];

        selectedClass.textContent = classSelect.value
            ? 'Kelas tujuan: ' + chosenOption.textContent.trim()
            : 'Belum memilih kelas · Bisa ditentukan nanti';
    }

    document.getElementById('studioChoose')
        .addEventListener('click', function () {

            if (!currentCard) return;

            chosenCard = currentCard;

            cards.forEach(card => {
                card.classList.toggle(
                    'is-selected',
                    card === chosenCard
                );
            });

            selectedName.textContent =
                chosenCard.dataset.title;

            selectedBar.hidden = false;

            updateSelectedClass();

            modal.close();

            selectedBar.scrollIntoView({
                behavior: window.matchMedia(
                    '(prefers-reduced-motion: reduce)'
                ).matches ? 'auto' : 'smooth',
                block: 'center'
            });
        });

    classSelect.addEventListener(
        'change',
        updateSelectedClass
    );

    document.getElementById('studioClearSelection')
        .addEventListener('click', function () {

            chosenCard = null;

            cards.forEach(card => {
                card.classList.remove('is-selected');
            });

            selectedBar.hidden = true;
        });

    // ==========================
    // TUTUP MODAL
    // ==========================

    document.getElementById('studioModalClose')
        .addEventListener('click', () => modal.close());

    document.getElementById('studioCancel')
        .addEventListener('click', () => modal.close());

    modal.addEventListener('click', function (event) {
        if (event.target === modal) {
            modal.close();
        }
    });

    applyFilters();

});
</script>
@endpush