@extends('layouts.portal')

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

    $initialCards = old(
        'cards',
        $material?->content['cards'] ?? []
    );

    $initialBlocks = old(
        'blocks',
        $material?->content['blocks'] ?? []
    );
@endphp

@section('content')

<div class="editor-page">

    {{-- NAVIGASI --}}
    <div class="editor-breadcrumb">
        <a href="{{ route('guru.studio') }}">
            ← Studio Konten
        </a>
        <span>/</span>
        <strong>{{ $templateNames[$type] }}</strong>
    </div>

    {{-- HEADER --}}
    <header class="editor-hero">

        <div>
            <span class="editor-eyebrow">
                🎨 STUDIO KONTEN GURU
            </span>

            <h1>
                {{ $isEdit ? 'Edit' : 'Buat' }}
                {{ $templateNames[$type] }}
            </h1>

            <p>
                Isi materi di sebelah kiri dan lihat
                hasilnya secara langsung di sebelah kanan.
            </p>

            @if($isEdit)
                <a
                    href="{{ route('materi.kelas.show', $material) }}"
                    target="_blank"
                    rel="noopener"
                    class="editor-preview-link"
                >
                    👀 Lihat Tampilan Siswa ↗
                </a>
            @endif
        </div>

        <img
            src="{{ asset('images/' . $templateMascots[$type]) }}"
            alt="Maskot editor CodePawth"
        >

    </header>

    {{-- FORM --}}
    <form
        id="materialForm"
        method="POST"
        action="{{ $isEdit
            ? route('guru.materi.update', $material)
            : route('guru.materi.store') }}"
        enctype="multipart/form-data"
    >
        @csrf

        @if($isEdit)
            @method('PUT')
        @endif

        <input
            type="hidden"
            name="type"
            value="{{ $type }}"
        >

        <div class="editor-columns">

            {{-- KOLOM KIRI --}}
            <div class="editor-left">

                <section class="editor-panel">

                    <div class="editor-panel-title">
                        <span>📝</span>
                        <h2>Informasi Materi</h2>
                    </div>

                    <div class="editor-field">
                        <label for="title">
                            Judul Materi
                        </label>

                        <input
                            id="title"
                            name="title"
                            type="text"
                            maxlength="255"
                            placeholder="Contoh: Kenalan dengan Python"
                            value="{{ old('title', $material?->title) }}"
                            required
                        >
                    </div>

                    <div class="editor-field-row">

                        <div class="editor-field">
                            <label for="level">
                                Jenjang
                            </label>

                            <select
                                id="level"
                                name="level"
                                required
                            >
                                @foreach(['SD', 'SMP', 'SMA'] as $level)
                                    <option
                                        value="{{ $level }}"
                                        @selected(
                                            old('level', $material?->level ?? 'SD') === $level
                                        )
                                    >
                                        {{ $level }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="editor-field">
                            <label for="learning_class_id">
                                Kelas Tujuan
                            </label>

                            <select
                                id="learning_class_id"
                                name="learning_class_id"
                            >
                                <option value="">
                                    Belum memilih kelas
                                </option>

                                @foreach($classes as $class)
                                    <option
                                        value="{{ $class->id }}"
                                        @selected(
                                            (string) old(
                                                'learning_class_id',
                                                $material?->learning_class_id
                                                    ?? request('class_id')
                                            ) === (string) $class->id
                                        )
                                    >
                                        {{ $class->name }}
                                        ({{ $class->level }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <p class="editor-hint">
                        Materi yang belum memiliki kelas hanya bisa
                        dilihat oleh Guru. Siswa dapat melihatnya
                        setelah materi diterbitkan ke kelas.
                    </p>

                </section>

                {{-- ITEM DINAMIS --}}
                <section class="editor-panel">

                    <div class="editor-panel-title">
                        <span>
                            {{ $type === 'flashcard' ? '🃏' : '📚' }}
                        </span>

                        <h2>
                            {{ $type === 'flashcard'
                                ? 'Isi Kartu Flashcard'
                                : 'Isi Bagian Materi' }}
                        </h2>
                    </div>

                    @if($type === 'flashcard')
                        <p class="editor-hint">
                            Setiap kartu mempunyai sisi depan dan
                            belakang, sama seperti Flashcard siswa
                            yang sudah ada.
                        </p>
                    @elseif($type === 'artikel')
                        <p class="editor-hint">
                            Tambahkan judul, paragraf, dan gambar
                            bila diperlukan.
                        </p>
                    @else
                        <p class="editor-hint">
                            Setiap bagian wajib memiliki gambar
                            beserta penjelasannya.
                        </p>
                    @endif

                    <div id="editorItems"></div>

                    <button
                        type="button"
                        id="addItem"
                        class="editor-add-btn"
                    >
                        + {{ $type === 'flashcard'
                            ? 'Tambah Kartu'
                            : 'Tambah Bagian Materi' }}
                    </button>

                </section>

                {{-- PENGATURAN PUBLIKASI --}}
                <section class="editor-panel">

                    <div class="editor-panel-title">
                        <span>🚀</span>
                        <h2>Pengaturan Publikasi</h2>
                    </div>

                    <div class="editor-field">
                        <label for="status">
                            Status Materi
                        </label>

                        <select name="status" id="status">
                            <option
                                value="draft"
                                @selected(
                                    old(
                                        'status',
                                        $material?->status ?? 'draft'
                                    ) === 'draft'
                                )
                            >
                                📝 Simpan sebagai Draft
                            </option>

                            <option
                                value="published"
                                @selected(
                                    old(
                                        'status',
                                        $material?->status ?? 'draft'
                                    ) === 'published'
                                )
                            >
                                🌟 Terbitkan ke Kelas
                            </option>
                        </select>
                    </div>

                    <div class="editor-actions">

                        <a
                            href="{{ route('guru.studio') }}"
                            class="editor-cancel-btn"
                        >
                            Kembali
                        </a>

                        <button
                            type="submit"
                            class="editor-save-btn"
                        >
                            💾 Simpan Materi
                        </button>

                    </div>

                </section>

            </div>

            {{-- KOLOM KANAN: LIVE PREVIEW --}}
            <aside class="editor-right">

                <section class="editor-panel editor-preview-panel">

                    <div class="editor-preview-heading">
                        <div>
                            <span class="editor-eyebrow">
                                LIVE PREVIEW
                            </span>

                            <h2>Pratinjau Materi</h2>
                        </div>

                        <span class="editor-live-badge">
                            ● Langsung
                        </span>
                    </div>

                    <div class="editor-preview-info">
                        <strong id="previewTitle">
                            Judul Materi
                        </strong>

                        <span id="previewLevel">SD</span>
                    </div>

                    @if($type === 'flashcard')

                        <div class="editor-card-scene"
                             id="cardScene"
                             role="button"
                             tabindex="0"
                             aria-label="Balik kartu pratinjau">

                            <div class="editor-card-inner"
                                 id="cardInner">

                                <div class="editor-card-face editor-card-front">

                                    <div class="editor-card-top">
                                        <span id="cardLabel">
                                            Konsep Dasar
                                        </span>

                                        <span>🔄 Klik balik</span>
                                    </div>

                                    <div class="editor-card-middle">

                                        <div>
                                            <small>SISI DEPAN</small>
                                            <h3 id="cardFront">
                                                print()
                                            </h3>

                                            <p id="cardFrontNote">
                                                Perintah dasar Python
                                            </p>
                                        </div>

                                        <img
                                            src="{{ asset('images/mascot_dashboard.png') }}"
                                            alt="Maskot Flashcard"
                                        >

                                    </div>

                                    <small>
                                        Ketuk kartu untuk melihat pasangan
                                    </small>

                                </div>

                                <div class="editor-card-face editor-card-back">

                                    <div class="editor-card-top">
                                        <span>Penjelasan Kartu</span>
                                        <span>🔄 Balik</span>
                                    </div>

                                    <div class="editor-card-back-content">
                                        <small>SISI BELAKANG</small>

                                        <h3 id="cardBack">
                                            Menampilkan teks
                                        </h3>

                                        <p id="cardBackNote">
                                            Contoh: print("Halo!")
                                        </p>
                                    </div>

                                    <small>
                                        Pasangan konsep dan penjelasan
                                    </small>

                                </div>

                            </div>
                        </div>

                        <div class="editor-card-nav">
                            <button type="button" id="prevCard">
                                ← Sebelumnya
                            </button>

                            <strong id="cardCounter">1 / 1</strong>

                            <button type="button" id="nextCard">
                                Berikutnya →
                            </button>
                        </div>

                    @else

                        <div
                            id="articlePreview"
                            class="editor-article-preview"
                        ></div>

                    @endif

                    <div class="editor-mascot-note">
                        <img
                            src="{{ asset('images/mascot_think.png') }}"
                            alt="Maskot memberikan saran"
                        >

                        <p>
                            Lihat hasil materi di sini sebelum
                            menyimpannya, ya!
                        </p>
                    </div>

                </section>

            </aside>

        </div>

    </form>

</div>

{{-- TEMPLATE KARTU FLASHCARD --}}
<template id="flashcardTemplate">
    <div class="editor-unit" data-unit="card">

        <div class="editor-unit-heading">
            <strong class="unit-number">Kartu</strong>

            <button
                type="button"
                class="editor-remove"
                data-remove
            >
                🗑 Hapus
            </button>
        </div>

        <div class="editor-field-row">
            <div class="editor-field">
                <label>Kategori Kartu</label>

                <input
                    name="cards[__INDEX__][label]"
                    data-key="label"
                    placeholder="Contoh: Fungsi Output"
                    maxlength="100"
                >
            </div>

            <div class="editor-field">
                <label>Ikon Konsep</label>

                <select
                    name="cards[__INDEX__][icon]"
                    data-key="icon"
                >
                    <option value="monitor">Output / Monitor</option>
                    <option value="keyboard">Input / Keyboard</option>
                    <option value="text">Teks</option>
                    <option value="number">Angka</option>
                    <option value="box">Variabel</option>
                    <option value="loop">Perulangan</option>
                    <option value="branch">Percabangan</option>
                    <option value="note">Catatan</option>
                </select>
            </div>
        </div>

        <div class="editor-subheading">🔵 SISI DEPAN</div>

        <div class="editor-field">
            <label>Konsep / Kode</label>

            <input
                name="cards[__INDEX__][front]"
                data-key="front"
                placeholder="Contoh: print()"
                maxlength="500"
                required
            >
        </div>

        <div class="editor-field">
            <label>Penjelasan Singkat Depan</label>

            <textarea
                name="cards[__INDEX__][front_note]"
                data-key="front_note"
                rows="2"
                maxlength="500"
                placeholder="Perintah dasar Python..."
            ></textarea>
        </div>

        <div class="editor-subheading">💙 SISI BELAKANG</div>

        <div class="editor-field">
            <label>Jawaban / Pengertian</label>

            <textarea
                name="cards[__INDEX__][back]"
                data-key="back"
                rows="2"
                maxlength="1000"
                placeholder="Menampilkan teks ke layar"
                required
            ></textarea>
        </div>

        <div class="editor-field">
            <label>Contoh / Catatan Tambahan</label>

            <textarea
                name="cards[__INDEX__][back_note]"
                data-key="back_note"
                rows="2"
                maxlength="500"
                placeholder='Contoh: print("Halo!")'
            ></textarea>
        </div>

    </div>
</template>

{{-- TEMPLATE BAGIAN ARTIKEL / FOTO --}}
<template id="blockTemplate">
    <div class="editor-unit" data-unit="block">

        <div class="editor-unit-heading">
            <strong class="unit-number">Bagian</strong>

            <button
                type="button"
                class="editor-remove"
                data-remove
            >
                🗑 Hapus
            </button>
        </div>

        <div class="editor-field">
            <label>Judul Bagian</label>

            <input
                name="blocks[__INDEX__][heading]"
                data-key="heading"
                placeholder="Contoh: Apa itu algoritma?"
                maxlength="255"
                required
            >
        </div>

        <div class="editor-field">
            <label>Penjelasan Materi</label>

            <textarea
                name="blocks[__INDEX__][body]"
                data-key="body"
                rows="5"
                maxlength="10000"
                placeholder="Tulis penjelasan materi di sini..."
                required
            ></textarea>
        </div>

        <div class="editor-field">
            <label>
                Gambar
                <span class="editor-optional">
                    (JPG / PNG / WebP, maksimal 4 MB)
                </span>
            </label>

            <input
                type="file"
                name="blocks[__INDEX__][image]"
                data-key="image_file"
                accept="image/png,image/jpeg,image/webp"
            >

            <input
                type="hidden"
                name="blocks[__INDEX__][existing_image]"
                data-key="existing_image"
            >

            <img
                class="editor-upload-preview"
                data-image-preview
                alt="Pratinjau gambar unggahan"
                hidden
            >
        </div>

        <div class="editor-field">
            <label>Caption Gambar</label>

            <input
                name="blocks[__INDEX__][caption]"
                data-key="caption"
                maxlength="255"
                placeholder="Keterangan gambar (opsional)"
            >
        </div>

    </div>
</template>

@endsection

@push('styles')
<style>
    .editor-page {
        max-width: 1180px;
        margin: 0 auto;
    }

    .editor-breadcrumb {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 12px;
        color: #91a3b7;
        margin-bottom: 22px;
    }

    .editor-breadcrumb a {
        color: #5c8ebb;
        font-weight: 800;
    }

    .editor-hero {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        padding: 28px 35px;
        border: 1px solid #d7e8fa;
        background: linear-gradient(115deg, #e5f2ff, #f7fbff);
        border-radius: 25px;
        margin-bottom: 25px;
        overflow: hidden;
    }

    .editor-eyebrow {
        color: #709ac4;
        font-size: 11px;
        letter-spacing: 1px;
        font-weight: 800;
    }

    .editor-hero h1 {
        margin: 9px 0;
        font-size: clamp(24px, 3vw, 34px);
    }

    .editor-hero p {
        color: #7893ac;
        font-size: 13px;
        line-height: 1.8;
    }

    .editor-hero img {
        width: 175px;
        height: 165px;
        object-fit: contain;
    }

    .editor-preview-link {
        display: inline-block;
        margin-top: 12px;
        color: #457eb5;
        font-size: 12px;
        font-weight: 800;
    }

    .editor-columns {
        display: grid;
        grid-template-columns: minmax(0, 1.05fr) minmax(0, 1fr);
        gap: 20px;
        align-items: start;
    }

    .editor-left {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .editor-panel {
        background: white;
        border: 1px solid #e0ebf6;
        border-radius: 22px;
        padding: 24px;
        box-shadow: 0 9px 30px rgba(90,130,170,.04);
    }

    .editor-panel-title {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
    }

    .editor-panel-title > span {
        width: 40px;
        height: 40px;
        display: grid;
        place-items: center;
        background: #eaf4ff;
        border-radius: 12px;
        font-size: 20px;
    }

    .editor-panel-title h2 {
        margin: 0;
        font-size: 17px;
    }

    .editor-field {
        margin-bottom: 16px;
    }

    .editor-field label {
        display: block;
        margin-bottom: 8px;
        font-size: 12px;
        font-weight: 800;
        color: #496582;
    }

    .editor-field input,
    .editor-field select,
    .editor-field textarea {
        display: block;
        width: 100%;
        padding: 12px 14px;
        border: 1px solid #d9e7f5;
        border-radius: 12px;
        background: #f9fcff;
        color: #344b65;
        font: inherit;
        font-size: 12px;
        line-height: 1.7;
        outline: none;
    }

    .editor-field input:focus,
    .editor-field select:focus,
    .editor-field textarea:focus {
        background: white;
        border-color: #81add6;
        box-shadow: 0 0 0 3px #e8f3ff;
    }

    .editor-field textarea {
        resize: vertical;
    }

    .editor-field-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    .editor-hint,
    .editor-optional {
        color: #91a2b3;
        font-size: 11px;
        line-height: 1.7;
    }

    .editor-optional {
        font-weight: 400;
    }

    .editor-unit {
        padding: 18px;
        margin: 15px 0;
        background: #f8fbff;
        border: 1px solid #dceaf7;
        border-radius: 17px;
    }

    .editor-unit-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
        margin-bottom: 16px;
    }

    .editor-unit-heading strong {
        color: #527fa9;
        font-size: 13px;
    }

    .editor-remove {
        border: 0;
        background: #fff0f2;
        color: #c75c6e;
        border-radius: 9px;
        padding: 8px 11px;
        font-size: 11px;
        font-family: inherit;
        font-weight: 800;
        cursor: pointer;
    }

    .editor-subheading {
        margin: 18px 0 13px;
        color: #648bb3;
        font-size: 11px;
        font-weight: 800;
    }

    .editor-add-btn {
        width: 100%;
        padding: 14px;
        margin-top: 12px;
        border: 2px dashed #b9d6ee;
        border-radius: 12px;
        background: #f1f8ff;
        color: #618db7;
        font-family: inherit;
        font-size: 12px;
        font-weight: 800;
        cursor: pointer;
    }

    .editor-add-btn:hover {
        background: #e2f0ff;
    }

    .editor-actions {
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-end;
        gap: 11px;
        margin-top: 23px;
    }

    .editor-cancel-btn,
    .editor-save-btn {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        padding: 13px 18px;
        border-radius: 12px;
        font: inherit;
        font-size: 12px;
        font-weight: 800;
        cursor: pointer;
        text-decoration: none;
        border: none;
    }

    .editor-cancel-btn {
        background: #eef5fb;
        color: #6285a5;
    }

    .editor-save-btn {
        background: #719bc3;
        color: white;
    }

    .editor-save-btn:hover {
        background: #5d8cb9;
    }

    .editor-right {
        min-width: 0;
    }

    .editor-preview-panel {
        position: sticky;
        top: 98px;
    }

    .editor-preview-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
        margin-bottom: 21px;
    }

    .editor-preview-heading h2 {
        margin: 7px 0 0;
        font-size: 19px;
    }

    .editor-live-badge {
        padding: 7px 10px;
        background: #e9f9f0;
        color: #32a778;
        font-size: 10px;
        font-weight: 800;
        border-radius: 20px;
        white-space: nowrap;
    }

    .editor-preview-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        padding: 13px;
        border: 1px solid #e0ebf6;
        border-radius: 12px;
        background: #f8fbff;
        margin-bottom: 19px;
    }

    .editor-preview-info strong {
        font-size: 13px;
        overflow-wrap: anywhere;
    }

    .editor-preview-info span {
        padding: 5px 10px;
        background: #dbeaff;
        border-radius: 20px;
        color: #5581ae;
        font-size: 11px;
        font-weight: 800;
    }

    /* FLASHCARD 3D */

    .editor-card-scene {
        height: 300px;
        perspective: 1100px;
        cursor: pointer;
        border-radius: 21px;
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
        border-radius: 20px;
        border: 2px solid #d8e9ff;
        padding: 20px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        backface-visibility: hidden;
        -webkit-backface-visibility: hidden;
        overflow: hidden;
    }

    .editor-card-front {
        background: linear-gradient(140deg, #f4f9ff, white, #e9f2ff);
    }

    .editor-card-back {
        background: linear-gradient(140deg, #2563eb, #4338ca);
        color: white;
        border-color: #3b82f6;
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
        padding: 7px 11px;
        border-radius: 20px;
        background: #2563eb;
        color: white;
    }

    .editor-card-back .editor-card-top span:first-child {
        padding: 7px 11px;
        border-radius: 20px;
        background: rgba(255,255,255,.16);
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
        color: #5795ec;
    }

    .editor-card-back-content small {
        color: #c8d6ff;
    }

    .editor-card-middle h3,
    .editor-card-back-content h3 {
        font-size: 24px;
        margin: 10px 0;
        overflow-wrap: anywhere;
    }

    .editor-card-middle p,
    .editor-card-back-content p {
        font-size: 12px;
        line-height: 1.7;
        overflow-wrap: anywhere;
    }

    .editor-card-scene .editor-card-face > small {
        font-size: 10px;
        color: #8fa5c1;
    }

    .editor-card-back > small {
        color: #c8d6ff !important;
    }

    .editor-card-back-content {
        margin: auto 0;
    }

    .editor-card-nav {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 9px;
        margin-top: 15px;
    }

    .editor-card-nav button {
        border: 1px solid #d4e6f5;
        border-radius: 11px;
        background: #f0f7ff;
        color: #5882aa;
        font: inherit;
        font-weight: 800;
        font-size: 10px;
        padding: 10px 12px;
        cursor: pointer;
    }

    .editor-card-nav button:disabled {
        opacity: .4;
        cursor: not-allowed;
    }

    .editor-card-nav strong {
        font-size: 12px;
        white-space: nowrap;
    }

    /* PREVIEW ARTIKEL DAN FOTO */

    .editor-article-preview {
        max-height: 620px;
        overflow-y: auto;
        padding: 20px;
        border-radius: 17px;
        background: #f8fbff;
        border: 1px solid #e1edf7;
    }

    .editor-preview-block {
        margin-bottom: 24px;
        padding-bottom: 20px;
        border-bottom: 1px solid #e0eaf5;
    }

    .editor-preview-block:last-child {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: 0;
    }

    .editor-preview-block h3 {
        font-size: 16px;
        margin-bottom: 10px;
    }

    .editor-preview-block p {
        white-space: pre-wrap;
        overflow-wrap: anywhere;
        color: #657d95;
        font-size: 12px;
        line-height: 1.9;
    }

    .editor-preview-block img {
        width: 100%;
        max-height: 230px;
        margin-top: 12px;
        border-radius: 13px;
        object-fit: contain;
        background: white;
    }

    .editor-preview-block small {
        display: block;
        margin-top: 7px;
        color: #9aabc0;
    }

    .editor-upload-preview {
        display: block;
        margin-top: 10px;
        max-width: 100%;
        max-height: 160px;
        object-fit: contain;
        border-radius: 12px;
    }

    .editor-upload-preview[hidden] {
        display: none;
    }

    .editor-mascot-note {
        display: flex;
        align-items: center;
        gap: 12px;
        background: #edf6ff;
        border-radius: 15px;
        padding: 12px;
        margin-top: 22px;
    }

    .editor-mascot-note img {
        width: 60px;
        height: 60px;
        object-fit: contain;
        flex-shrink: 0;
    }

    .editor-mascot-note p {
        margin: 0;
        color: #6789aa;
        font-size: 11px;
        line-height: 1.7;
    }

    @media(max-width: 950px) {
        .editor-columns {
            grid-template-columns: 1fr;
        }

        .editor-preview-panel {
            position: static;
        }
    }

    @media(max-width: 550px) {
        .editor-hero {
            padding: 23px;
        }

        .editor-hero img {
            width: 90px;
            height: 100px;
        }

        .editor-field-row {
            grid-template-columns: 1fr;
        }

        .editor-panel {
            padding: 18px;
        }

        .editor-card-middle img {
            width: 70px;
            height: 70px;
        }

        .editor-card-middle h3 {
            font-size: 20px;
        }
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
                type === 'flashcard'
                    ? `Kartu ${index + 1}`
                    : `Bagian ${index + 1}`;
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

                preview.src = oldPath
                    ? storageBase + '/' + oldPath
                    : '';

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