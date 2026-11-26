
@extends('layouts.portal')

@section('title', $material->title)

@php
    /*
    |--------------------------------------------------------------------------
    | PENGATURAN MATERI
    |--------------------------------------------------------------------------
    */

    $type = $material->type;

    $isArticle = $type === 'artikel';
    $isPhoto = $type === 'foto';
    $isCoding = $type === 'coding';

    $isTeacher = auth()->user()?->role === 'guru';

    $materialTypes = [
        'artikel' => [
            'label' => 'Tulisan + Gambar',
            'icon' => '📖',
            'mascot' => 'mascot_dashboard.png',
            'description' => 'Baca penjelasan dan perhatikan gambar untuk memahami materi.',
        ],
        'foto' => [
            'label' => 'Foto + Penjelasan',
            'icon' => '🖼️',
            'mascot' => 'mascot_what.png',
            'description' => 'Amati setiap gambar dan pahami penjelasan yang diberikan.',
        ],
        'coding' => [
            'label' => 'Praktik Coding Python',
            'icon' => '💻',
            'mascot' => 'mascot_class.png',
            'description' => 'Belajar menerjemahkan flowchart menjadi kode Python.',
        ],
    ];

    $currentType = $materialTypes[$type] ?? [
        'label' => 'Materi Pembelajaran',
        'icon' => '📚',
        'mascot' => 'mascot_think.png',
        'description' => 'Pelajari materi yang diberikan Guru.',
    ];

    $blocks = $material->content['blocks'] ?? [];

    $backUrl = $isTeacher
        ? ($isCoding
            ? route('guru.studio')
            : route('guru.materi.edit', $material))
        : route('murid.dashboard');
@endphp

@section('content')

<div class="lesson-page">

    {{-- ==========================================
         NAVIGASI
    =========================================== --}}

    <div class="lesson-navigation">

        <a href="{{ $backUrl }}" class="lesson-back">
            <span>←</span>
            <span>Kembali</span>
        </a>

        <div class="lesson-breadcrumb">
            <span>CodePawth</span>
            <span>›</span>
            <strong>Materi Pembelajaran</strong>
        </div>

    </div>


    {{-- ==========================================
         HEADER MATERI
    =========================================== --}}

    <header class="lesson-header">

        <div class="lesson-header-content">

            <span class="lesson-eyebrow">
                ✨ BELAJAR BERSAMA CODEPAWTH
            </span>

            <h1>{{ $material->title }}</h1>

            <p class="lesson-description">
                {{ $currentType['description'] }}
            </p>

            <div class="lesson-header-tags">

                <span class="lesson-tag">
                    🎓 {{ $material->level }}
                </span>

                <span class="lesson-tag">
                    {{ $currentType['icon'] }}
                    {{ $currentType['label'] }}
                </span>

                @if($material->learningClass)
                    <span class="lesson-tag">
                        🏫 {{ $material->learningClass->name }}
                    </span>
                @endif

                @if($isTeacher && $material->status === 'draft')
                    <span class="lesson-tag lesson-draft">
                        📝 Draft
                    </span>
                @endif

            </div>

        </div>

        <img
            src="{{ asset('images/' . $currentType['mascot']) }}"
            alt="Maskot CodePawth"
            class="lesson-header-mascot"
        >

    </header>


    {{-- ==========================================
         MATERI PRAKTIK CODING
    =========================================== --}}

    @if($isCoding)

        <section class="lesson-coding-panel">

            <div class="lesson-coding-visual">

                <img
                    src="{{ asset('images/mascot_class.png') }}"
                    alt="Maskot sedang belajar coding"
                >

            </div>

            <div class="lesson-coding-content">

                <span class="lesson-eyebrow">
                    💻 PRAKTIK PEMROGRAMAN
                </span>

                <h2>Ayo Praktik Coding Python!</h2>

                <p>
                    Pelajari hubungan antara flowchart
                    dan kode Python melalui latihan
                    interaktif CodePawth.
                </p>

                <div class="lesson-coding-features">

                    <span>🔷 Mini Flowchart</span>
                    <span>⌨️ Editor Python</span>
                    <span>▶️ Simulasi Output</span>
                    <span>⭐ Evaluasi Kode</span>

                </div>

                <a
                    href="{{ route('materi.coding', [
                        'jenjang' => $material->level,
                        'level' => 1
                    ]) }}"
                    class="lesson-primary-button"
                >
                    ▶ Buka Contoh Praktik Coding
                </a>

                <p class="lesson-coding-note">
                    Halaman ini membuka latihan Coding bawaan
                    CodePawth. Pengaturan soal Coding buatan Guru
                    belum terhubung ke database.
                </p>

            </div>

        </section>


    {{-- ==========================================
         MATERI ARTIKEL / FOTO
    =========================================== --}}

    @elseif($isArticle || $isPhoto)

        <div class="lesson-layout">

            {{-- KONTEN UTAMA --}}
            <div class="lesson-content">

                @forelse($blocks as $index => $block)

                    <article
                        class="lesson-block"
                        id="lesson-section-{{ $index + 1 }}"
                    >

                        <div class="lesson-block-heading">

                            <span class="lesson-part">
                                BAGIAN {{ $index + 1 }}
                            </span>

                            <span class="lesson-block-number">
                                {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                            </span>

                        </div>

                        <h2>
                            {{ $block['heading'] ?? 'Materi Pembelajaran' }}
                        </h2>

                        {{-- GAMBAR MATERI --}}
                        @if(!empty($block['image']))

                            <figure class="lesson-image-box">

                                <img
                                    src="{{ asset('storage/' . $block['image']) }}"
                                    alt="{{ $block['caption'] ?? $block['heading'] ?? 'Gambar materi' }}"
                                    loading="lazy"
                                >

                                @if(!empty($block['caption']))

                                    <figcaption>
                                        {{ $block['caption'] }}
                                    </figcaption>

                                @endif

                            </figure>

                        @endif

                        {{-- PENJELASAN --}}
                        <div class="lesson-text">
                            {{ $block['body'] ?? '' }}
                        </div>

                        {{-- PETUNJUK --}}
                        @if($isPhoto)

                            <div class="lesson-hint">

                                <span>💡</span>

                                <p>
                                    Perhatikan gambar di atas,
                                    lalu baca kembali penjelasannya
                                    sampai kamu memahaminya.
                                </p>

                            </div>

                        @endif

                    </article>

                @empty

                    <div class="lesson-empty">

                        <img
                            src="{{ asset('images/mascot_think.png') }}"
                            alt="Maskot sedang berpikir"
                        >

                        <h2>Belum Ada Isi Materi</h2>

                        <p>
                            Guru belum menambahkan bagian materi
                            pada halaman ini.
                        </p>

                    </div>

                @endforelse


                {{-- SELESAI MEMBACA --}}
                @if(count($blocks) > 0)

                    <section class="lesson-finish">

                        <img
                            src="{{ asset('images/mascot_cheers.png') }}"
                            alt="Maskot merayakan pembelajaran"
                        >

                        <div>

                            <span class="lesson-eyebrow">
                                ✨ KEREN BANGET!
                            </span>

                            <h2>Yeay, sampai di akhir materi! 🎉</h2>

                            <p>
                                Kamu sudah sampai di bagian
                                terakhir. Kalau ada yang belum
                                dipahami, kamu bisa membaca
                                ulang materinya.
                            </p>

                            <a
                                href="{{ $backUrl }}"
                                class="lesson-finish-button"
                            >
                                ← Kembali
                            </a>

                        </div>

                    </section>

                @endif

            </div>


            {{-- SIDEBAR --}}
            <aside class="lesson-sidebar">

                <div class="lesson-sidebar-card">

                    <img
                        src="{{ asset('images/mascot_think.png') }}"
                        alt="Maskot memberikan petunjuk"
                    >

                    <h3>Petunjuk Belajar</h3>

                    <p>
                        Baca materi secara berurutan,
                        perhatikan gambar, dan pahami
                        setiap penjelasan dari Guru.
                    </p>

                    <div class="lesson-sidebar-divider"></div>

                    <div class="lesson-sidebar-heading">

                        <strong>📚 Daftar Bagian</strong>

                        <span>
                            {{ count($blocks) }} Bagian
                        </span>

                    </div>

                    <ol class="lesson-outline">

                        @foreach($blocks as $index => $block)

                            <li>
                                <a href="#lesson-section-{{ $index + 1 }}">

                                    <span class="lesson-outline-number">
                                        {{ $index + 1 }}
                                    </span>

                                    <span>
                                        {{ $block['heading'] ?? 'Bagian Materi' }}
                                    </span>

                                </a>
                            </li>

                        @endforeach

                    </ol>

                </div>

            </aside>

        </div>


    {{-- ==========================================
         TIPE MATERI BELUM DIDUKUNG
    =========================================== --}}

    @else

        <div class="lesson-empty">

            <img
                src="{{ asset('images/mascot_think.png') }}"
                alt="Maskot CodePawth"
            >

            <h2>Jenis Materi Belum Tersedia</h2>

            <p>
                Template ini memiliki halaman pembelajaran
                tersendiri atau belum didukung pada halaman baca.
            </p>

            <a
                href="{{ $backUrl }}"
                class="lesson-primary-button"
            >
                Kembali
            </a>

        </div>

    @endif

</div>

@endsection


@push('styles')

<style>
    /* =========================================
       HALAMAN MATERI GURU - CODEPAWTH
    ========================================= */

    .lesson-page {
        max-width: 1120px;
        margin: 0 auto;
        padding-bottom: 45px;
    }

    .lesson-page * {
        box-sizing: border-box;
    }

    /* NAVIGASI */

    .lesson-navigation {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        margin-bottom: 23px;
    }

    .lesson-back {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        padding: 10px 14px;
        border-radius: 11px;
        background: white;
        border: 1px solid #dfebf7;
        color: #648fb9;
        font-size: 12px;
        font-weight: 800;
        text-decoration: none;
    }

    .lesson-back:hover {
        background: #edf6ff;
    }

    .lesson-back span:first-child {
        font-size: 17px;
    }

    .lesson-breadcrumb {
        display: flex;
        gap: 8px;
        color: #91a4b6;
        font-size: 11px;
    }

    .lesson-breadcrumb strong {
        color: #6289b1;
    }

    /* HEADER */

    .lesson-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 25px;
        padding: 34px 38px;
        margin-bottom: 27px;
        border: 1px solid #d6e9fa;
        border-radius: 25px;
        background: linear-gradient(
            110deg,
            #e5f2ff,
            #f7fbff
        );
        overflow: hidden;
    }

    .lesson-header-content {
        flex: 1;
        min-width: 0;
    }

    .lesson-eyebrow {
        color: #719bc3;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 1px;
    }

    .lesson-header h1 {
        margin: 12px 0;
        color: #344b65;
        font-size: clamp(25px, 3vw, 36px);
        font-weight: 800;
        line-height: 1.3;
        overflow-wrap: anywhere;
    }

    .lesson-description {
        max-width: 610px;
        color: #7894ac;
        font-size: 13px;
        line-height: 1.8;
    }

    .lesson-header-mascot {
        width: 175px;
        height: 175px;
        object-fit: contain;
        flex-shrink: 0;
    }

    .lesson-header-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 9px;
        margin-top: 20px;
    }

    .lesson-tag {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 9px 13px;
        border-radius: 30px;
        background: white;
        color: #6289b1;
        font-size: 11px;
        font-weight: 800;
    }

    .lesson-draft {
        color: #a17b36;
        background: #fff7dc;
    }

    /* LAYOUT */

    .lesson-layout {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 280px;
        gap: 23px;
        align-items: start;
    }

    .lesson-content {
        min-width: 0;
    }

    .lesson-block {
        padding: 32px;
        margin-bottom: 22px;
        background: white;
        border: 1px solid #e0ecf7;
        border-radius: 22px;
        scroll-margin-top: 105px;
    }

    .lesson-block-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .lesson-part {
        display: inline-flex;
        padding: 7px 12px;
        border-radius: 30px;
        background: #eaf4ff;
        color: #7099c3;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: .6px;
    }

    .lesson-block-number {
        color: #d0deed;
        font-size: 23px;
        font-weight: 800;
    }

    .lesson-block h2 {
        margin: 15px 0 22px;
        color: #344b65;
        font-size: 23px;
        line-height: 1.4;
        overflow-wrap: anywhere;
    }

    /* GAMBAR */

    .lesson-image-box {
        margin: 0 0 24px;
        padding: 15px;
        border: 1px solid #e1edfa;
        border-radius: 17px;
        background: #f4f9ff;
        text-align: center;
    }

    .lesson-image-box img {
        display: block;
        width: 100%;
        max-height: 460px;
        object-fit: contain;
        border-radius: 13px;
        background: white;
    }

    .lesson-image-box figcaption {
        margin-top: 12px;
        color: #8fa2b4;
        font-size: 11px;
        line-height: 1.6;
    }

    /* PENJELASAN */

    .lesson-text {
        white-space: pre-wrap;
        overflow-wrap: anywhere;
        color: #586e84;
        font-size: 14px;
        line-height: 2;
    }

    .lesson-hint {
        display: flex;
        gap: 12px;
        padding: 15px;
        margin-top: 22px;
        border: 1px solid #dceafa;
        border-radius: 13px;
        background: #f1f8ff;
    }

    .lesson-hint > span {
        font-size: 20px;
    }

    .lesson-hint p {
        margin: 0;
        color: #7692ad;
        font-size: 12px;
        line-height: 1.8;
    }

    /* SIDEBAR */

    .lesson-sidebar-card {
        position: sticky;
        top: 100px;
        padding: 24px;
        border: 1px solid #dfebf8;
        border-radius: 21px;
        background: white;
    }

    .lesson-sidebar-card > img {
        display: block;
        width: 125px;
        height: 125px;
        object-fit: contain;
        margin: 0 auto 15px;
    }

    .lesson-sidebar-card h3 {
        margin: 0 0 12px;
        text-align: center;
        color: #344b65;
        font-size: 17px;
    }

    .lesson-sidebar-card > p {
        margin: 0;
        color: #8096ad;
        text-align: center;
        font-size: 12px;
        line-height: 1.8;
    }

    .lesson-sidebar-divider {
        height: 1px;
        margin: 20px 0;
        background: #e9f0f7;
    }

    .lesson-sidebar-heading {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }

    .lesson-sidebar-heading strong {
        font-size: 12px;
        color: #344b65;
    }

    .lesson-sidebar-heading > span {
        color: #92a7bc;
        font-size: 10px;
    }

    .lesson-outline {
        list-style: none;
        padding: 0;
        margin: 15px 0 0;
    }

    .lesson-outline li {
        margin-bottom: 8px;
    }

    .lesson-outline a {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px;
        border-radius: 11px;
        background: #f6faff;
        color: #6486a6;
        font-size: 11px;
        line-height: 1.6;
        text-decoration: none;
        overflow-wrap: anywhere;
    }

    .lesson-outline a:hover {
        background: #e5f2ff;
        color: #477fb2;
    }

    .lesson-outline-number {
        display: grid;
        place-items: center;
        width: 25px;
        height: 25px;
        flex-shrink: 0;
        border-radius: 8px;
        background: #e0eeff;
        color: #719bc3;
        font-size: 10px;
        font-weight: 800;
    }

    /* SELESAI */

    .lesson-finish {
        display: flex;
        align-items: center;
        gap: 22px;
        padding: 25px;
        border: 1px solid #d6e9fa;
        border-radius: 21px;
        background: #eaf4ff;
    }

    .lesson-finish img {
        width: 115px;
        height: 115px;
        object-fit: contain;
        flex-shrink: 0;
    }

    .lesson-finish h2 {
        margin: 8px 0;
        color: #344b65;
        font-size: 20px;
    }

    .lesson-finish p {
        color: #7894ac;
        font-size: 12px;
        line-height: 1.8;
    }

    .lesson-finish-button,
    .lesson-primary-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 12px 18px;
        margin-top: 12px;
        border: none;
        border-radius: 12px;
        background: #719bc3;
        color: white;
        font-size: 12px;
        font-weight: 800;
        text-decoration: none;
        transition: .2s ease;
    }

    .lesson-finish-button:hover,
    .lesson-primary-button:hover {
        background: #5d8cb9;
    }

    /* PRAKTIK CODING */

    .lesson-coding-panel {
        display: grid;
        grid-template-columns: 230px minmax(0, 1fr);
        align-items: center;
        gap: 25px;
        padding: 36px;
        border: 1px solid #dbeafa;
        border-radius: 24px;
        background: white;
    }

    .lesson-coding-visual {
        display: grid;
        place-items: center;
        min-height: 240px;
        border-radius: 20px;
        background: #eaf4ff;
    }

    .lesson-coding-visual img {
        width: 190px;
        height: 190px;
        object-fit: contain;
    }

    .lesson-coding-content h2 {
        margin: 10px 0;
        font-size: 24px;
    }

    .lesson-coding-content > p {
        color: #7894ac;
        font-size: 13px;
        line-height: 1.8;
    }

    .lesson-coding-features {
        display: flex;
        flex-wrap: wrap;
        gap: 9px;
        margin: 20px 0;
    }

    .lesson-coding-features span {
        padding: 9px 12px;
        border-radius: 10px;
        background: #eff6ff;
        color: #618ab2;
        font-size: 11px;
        font-weight: 800;
    }

    .lesson-coding-content .lesson-coding-note {
        font-size: 11px;
        color: #9aabc0;
    }

    /* KONDISI KOSONG */

    .lesson-empty {
        padding: 40px 25px;
        border: 1px dashed #c9deef;
        border-radius: 21px;
        background: white;
        text-align: center;
    }

    .lesson-empty img {
        width: 125px;
        height: 125px;
        object-fit: contain;
    }

    .lesson-empty h2 {
        margin: 15px 0 8px;
        font-size: 20px;
    }

    .lesson-empty p {
        color: #849ab0;
        font-size: 12px;
        line-height: 1.8;
    }

    /* RESPONSIVE */

    @media(max-width: 850px) {
        .lesson-layout {
            grid-template-columns: 1fr;
        }

        .lesson-sidebar-card {
            position: static;
        }

        .lesson-coding-panel {
            grid-template-columns: 1fr;
        }
    }

    @media(max-width: 550px) {
        .lesson-header {
            padding: 24px;
        }

        .lesson-header-mascot {
            width: 95px;
            height: 95px;
        }

        .lesson-header h1 {
            font-size: 24px;
        }

        .lesson-navigation {
            flex-wrap: wrap;
        }

        .lesson-block {
            padding: 22px;
        }

        .lesson-finish {
            padding: 20px;
            gap: 12px;
        }

        .lesson-finish img {
            width: 75px;
            height: 75px;
        }

        .lesson-coding-panel {
            padding: 20px;
        }
    }
</style>

@endpush