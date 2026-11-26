@extends('layouts.portal')

@section('title', 'Editor Praktik Coding Python')

@php
    $isEdit = $material !== null;

    $defaults = [
        'instruction' => 'Buat program Python sesuai alur flowchart, lalu uji dengan nilai yang tersedia.',
        'variable' => 'bilangan',
        'condition' => 'even',
        'threshold' => 75,
        'yes_output' => 'Genap',
        'no_output' => 'Ganjil',
        'test_input' => 8,
    ];

    $coding = array_merge(
        $defaults,
        $material?->content['coding'] ?? [],
        old('coding', [])
    );
@endphp

@section('content')

<div class="cg-page">

    <a href="{{ route('guru.studio') }}" class="cg-back">
        ← Kembali ke Studio Konten
    </a>

    {{-- HEADER --}}
    <header class="cg-hero">
        <div>
            <span class="cg-eyebrow">
                💻 STUDIO KONTEN GURU
            </span>

            <h1>
                {{ $isEdit ? 'Edit' : 'Buat' }}
                Praktik Coding Python
            </h1>

            <p>
                Buat tantangan berdasarkan flowchart.
                Atur variabel, kondisi, dan output,
                kemudian lihat kode Python secara langsung.
            </p>

            @if($isEdit)
                <a href="{{ route('materi.kelas.show', $material) }}"
                   class="cg-preview-link" target="_blank" rel="noopener">
                    👀 Lihat Tampilan Siswa ↗
                </a>
            @endif
        </div>

        <img src="{{ asset('images/mascot_class.png') }}"
             alt="Maskot CodePawth belajar coding">
    </header>

    <form
        method="POST"
        id="cg-form"
        action="{{ $isEdit
            ? route('guru.materi.update', $material)
            : route('guru.materi.store') }}"
    >
        @csrf

        @if($isEdit)
            @method('PUT')
        @endif

        <input type="hidden" name="type" value="coding">

        {{-- INFORMASI MATERI --}}
        <section class="cg-panel cg-settings">

            <div class="cg-panel-title">
                <span>📝</span>
                <h2>Informasi Materi</h2>
            </div>

            <div class="cg-fields cg-three">

                <label>
                    Judul Materi

                    <input
                        type="text"
                        name="title"
                        id="cg-title"
                        value="{{ old('title', $material?->title) }}"
                        placeholder="Contoh: Program Ganjil dan Genap"
                        maxlength="255"
                        required
                    >
                </label>

                <label>
                    Jenjang

                    <select name="level" id="cg-level" required>
                        @foreach(['SMP', 'SMA'] as $level)
                            <option value="{{ $level }}"
                                @selected(old('level', $material?->level ?? 'SMP') === $level)>
                                {{ $level }}
                            </option>
                        @endforeach
                    </select>
                </label>

                <label>
                    Kelas Tujuan

                    <select name="learning_class_id" id="cg-class">
                        <option value="">Belum memilih kelas</option>

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
                                {{ $class->name }} ({{ $class->level }})
                            </option>
                        @endforeach
                    </select>
                </label>

            </div>

            @if($errors->any())
                <div class="cg-errors" role="alert">
                    <strong>Periksa kembali isian berikut:</strong>

                    <ul>
                        @foreach($errors->all() as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        </section>

        <div class="cg-workspace">

            {{-- ====================================
                 PANEL KIRI: FLOWCHART DAN FORM GURU
            ===================================== --}}
            <section class="cg-panel cg-builder">

                <div class="cg-panel-title">
                    <span>🔷</span>
                    <h2>Flowchart & Pengaturan Soal</h2>
                </div>

                <p class="cg-hint">
                    Diagram ini berubah mengikuti jawaban
                    dan pengaturan yang diisi Guru.
                </p>

                <div class="cg-flow">

                    <div class="cg-oval">Mulai</div>

                    <div class="cg-line"></div>

                    <div class="cg-node">
                        <strong>1 · Input Data</strong>
                        <small id="cg-node-input">
                            Masukkan bilangan
                        </small>
                    </div>

                    <div class="cg-line"></div>

                    <div class="cg-node cg-decision">
                        <strong>2 · Kondisi IF</strong>

                        <small id="cg-node-condition">
                            bilangan % 2 == 0?
                        </small>
                    </div>

                    <div class="cg-branches">

                        <div>
                            <span class="cg-yes">Ya</span>

                            <div class="cg-node">
                                <strong>3 · Output Ya</strong>

                                <small id="cg-node-yes">
                                    Genap
                                </small>
                            </div>
                        </div>

                        <div>
                            <span class="cg-no">Tidak</span>

                            <div class="cg-node">
                                <strong>4 · Output Tidak</strong>

                                <small id="cg-node-no">
                                    Ganjil
                                </small>
                            </div>
                        </div>

                    </div>

                    <div class="cg-line"></div>

                    <div class="cg-oval">Selesai</div>

                </div>

                {{-- FORM PENGATURAN --}}
                <div class="cg-fields">

                    <label>
                        Instruksi untuk Siswa

                        <textarea
                            name="coding[instruction]"
                            id="cg-instruction"
                            rows="3"
                            maxlength="1000"
                            required
                        >{{ $coding['instruction'] }}</textarea>
                    </label>

                    <label>
                        Nama Variabel Python

                        <input
                            name="coding[variable]"
                            id="cg-variable"
                            type="text"
                            value="{{ $coding['variable'] }}"
                            maxlength="40"
                            pattern="[A-Za-z_][A-Za-z0-9_]*"
                            placeholder="Contoh: bilangan"
                            required
                        >

                        <small>
                            Gunakan nama variabel tanpa spasi,
                            misalnya bilangan, nilai, atau umur.
                        </small>
                    </label>

                    <div class="cg-fields cg-two">

                        <label>
                            Jenis Kondisi

                            <select
                                name="coding[condition]"
                                id="cg-condition"
                            >
                                <option value="even"
                                    @selected($coding['condition'] === 'even')>
                                    Bilangan Genap
                                </option>

                                <option value="odd"
                                    @selected($coding['condition'] === 'odd')>
                                    Bilangan Ganjil
                                </option>

                                <option value="gte"
                                    @selected($coding['condition'] === 'gte')>
                                    Lebih Besar / Sama Dengan
                                </option>

                                <option value="gt"
                                    @selected($coding['condition'] === 'gt')>
                                    Lebih Besar Dari
                                </option>

                                <option value="lte"
                                    @selected($coding['condition'] === 'lte')>
                                    Lebih Kecil / Sama Dengan
                                </option>

                                <option value="lt"
                                    @selected($coding['condition'] === 'lt')>
                                    Lebih Kecil Dari
                                </option>
                            </select>
                        </label>

                        <label id="cg-threshold-wrap">
                            Angka Pembanding

                            <input
                                type="number"
                                name="coding[threshold]"
                                id="cg-threshold"
                                value="{{ $coding['threshold'] }}"
                                min="-1000000"
                                max="1000000"
                                step="1"
                            >
                        </label>

                    </div>

                    <div class="cg-fields cg-two">

                        <label>
                            Output Jika Benar (Ya)

                            <input
                                name="coding[yes_output]"
                                id="cg-yes"
                                value="{{ $coding['yes_output'] }}"
                                maxlength="100"
                                placeholder="Contoh: Genap"
                                required
                            >
                        </label>

                        <label>
                            Output Jika Salah (Tidak)

                            <input
                                name="coding[no_output]"
                                id="cg-no"
                                value="{{ $coding['no_output'] }}"
                                maxlength="100"
                                placeholder="Contoh: Ganjil"
                                required
                            >
                        </label>

                    </div>

                </div>

            </section>

            {{-- ====================================
                 PANEL KANAN: PREVIEW TEMPLATE PYTHON
            ===================================== --}}
            <aside class="cg-panel cg-preview">

                <div class="cg-panel-title">
                    <span>⌨️</span>
                    <h2>Pratinjau Praktik Python</h2>
                </div>

                <div class="cg-instruction">
                    <strong>🎯 Instruksi Soal</strong>
                    <p id="cg-instruction-preview"></p>
                </div>

                {{-- PREVIEW KODE --}}
                <div class="cg-editor">

                    <div class="cg-tab">

                        <div>
                            <i></i><i></i><i></i>
                            <b>main.py</b>
                        </div>

                        <span>Python 3 · Preview</span>

                    </div>

                    <div class="cg-code">

                        <div>
                            <em>1</em>
                            <code id="cg-line-one"></code>
                        </div>

                        <div>
                            <em>2</em>
                            <code id="cg-line-two"></code>
                        </div>

                        <div>
                            <em>3</em>
                            <code id="cg-line-three"></code>
                        </div>

                        <div>
                            <em>4</em>
                            <code id="cg-line-four">else:</code>
                        </div>

                        <div>
                            <em>5</em>
                            <code id="cg-line-five"></code>
                        </div>

                    </div>

                </div>

                {{-- SIMULASI --}}
                <div class="cg-test">

                    <div class="cg-test-top">
                        <strong>▶ Simulasi Output</strong>
                        <span>Pratinjau logika</span>
                    </div>

                    <label>
                        Nilai Input Uji

                        <input
                            type="number"
                            id="cg-test-input"
                            name="coding[test_input]"
                            value="{{ $coding['test_input'] }}"
                            min="-1000000"
                            max="1000000"
                            step="1"
                            required
                        >
                    </label>

                    <button type="button" id="cg-run">
                        ▶ Jalankan Simulasi
                    </button>

                    <pre id="cg-terminal">Klik Jalankan Simulasi untuk melihat hasil.</pre>

                </div>

                <div class="cg-note">

                    <img
                        src="{{ asset('images/mascot_think.png') }}"
                        alt="Maskot memberi petunjuk"
                    >

                    <p>
                        Guru menentukan kunci jawaban.
                        Saat belajar nanti, siswa mengisi
                        kode Python sendiri melalui
                        template Coding CodePawth.
                    </p>

                </div>

            </aside>

        </div>

        {{-- SIMPAN --}}
        <section class="cg-panel cg-publish">

            <div>
                <h2>🚀 Simpan & Terbitkan</h2>

                <p>
                    Draft hanya dapat dilihat Guru.
                    Materi terbit dapat dibuka oleh
                    siswa anggota kelas tujuan.
                </p>
            </div>

            <div class="cg-publish-actions">

                <select name="status" aria-label="Status materi">

                    <option value="draft"
                        @selected(old('status', $material?->status ?? 'draft') === 'draft')>
                        📝 Simpan Draft
                    </option>

                    <option value="published"
                        @selected(old('status', $material?->status ?? 'draft') === 'published')>
                        🌟 Terbitkan
                    </option>

                </select>

                <button type="submit">
                    💾 Simpan Materi
                </button>

            </div>

        </section>

    </form>

</div>

@endsection

@push('styles')
<style>
    .cg-page {
        max-width: 1180px;
        margin: auto;
        padding-bottom: 40px;
    }

    .cg-page * {
        box-sizing: border-box;
    }

    .cg-back,
    .cg-preview-link {
        display: inline-block;
        color: #628eb9;
        font-size: 12px;
        font-weight: 800;
        margin-bottom: 20px;
    }

    .cg-hero {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        padding: 28px 34px;
        margin-bottom: 20px;
        background: linear-gradient(115deg, #e5f2ff, #f7fbff);
        border: 1px solid #d7e8fa;
        border-radius: 25px;
    }

    .cg-eyebrow {
        color: #709ac4;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: .8px;
    }

    .cg-hero h1 {
        font-size: clamp(23px, 3vw, 32px);
        margin: 10px 0;
        color: #344b65;
    }

    .cg-hero p,
    .cg-hint {
        color: #7893ac;
        font-size: 12px;
        line-height: 1.8;
    }

    .cg-hero img {
        width: 145px;
        height: 145px;
        object-fit: contain;
    }

    .cg-panel {
        min-width: 0;
        padding: 24px;
        background: white;
        border: 1px solid #dceaf8;
        border-radius: 22px;
    }

    .cg-settings {
        margin-bottom: 20px;
    }

    .cg-panel-title {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 15px;
    }

    .cg-panel-title span {
        padding: 9px;
        border-radius: 11px;
        background: #eaf4ff;
        font-size: 20px;
    }

    .cg-panel-title h2 {
        margin: 0;
        color: #344b65;
        font-size: 17px;
    }

    .cg-workspace {
        display: grid;
        grid-template-columns: minmax(0, 5fr) minmax(0, 7fr);
        gap: 20px;
        align-items: start;
    }

    .cg-fields {
        display: grid;
        gap: 14px;
    }

    .cg-three {
        grid-template-columns: 2fr 1fr 1.6fr;
    }

    .cg-two {
        grid-template-columns: 1fr 1fr;
    }

    .cg-fields label,
    .cg-test label {
        display: block;
        color: #496582;
        font-size: 12px;
        font-weight: 800;
    }

    .cg-fields label small {
        display: block;
        color: #91a2b3;
        font-weight: 400;
        margin-top: 5px;
    }

    .cg-fields input,
    .cg-fields select,
    .cg-fields textarea,
    .cg-test input,
    .cg-publish select {
        display: block;
        width: 100%;
        padding: 11px 12px;
        margin-top: 8px;
        border: 1px solid #d8e7f5;
        border-radius: 11px;
        background: #f9fcff;
        color: #344b65;
        font-family: inherit;
        font-size: 12px;
        line-height: 1.5;
    }

    .cg-fields textarea {
        resize: vertical;
    }

    .cg-fields input:focus,
    .cg-fields select:focus,
    .cg-fields textarea:focus {
        outline: 2px solid #c6e0fc;
    }

    /* FLOWCHART */

    .cg-flow {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 18px 12px;
        margin: 18px 0 21px;
        border: 1px solid #dceaff;
        border-radius: 17px;
        background: #f2f7ff;
    }

    .cg-oval {
        padding: 7px 30px;
        border: 1px solid #9fc3ee;
        border-radius: 40px;
        background: white;
        color: #5379a8;
        font-size: 11px;
        font-weight: 800;
    }

    .cg-line {
        width: 2px;
        height: 20px;
        background: #7ca7de;
    }

    .cg-node {
        width: min(100%, 245px);
        padding: 11px;
        border: 2px solid #bfd9f9;
        border-radius: 12px;
        background: white;
        text-align: center;
    }

    .cg-node strong,
    .cg-node small {
        display: block;
    }

    .cg-node strong {
        color: #344b65;
        font-size: 11px;
    }

    .cg-node small {
        margin-top: 6px;
        color: #628eb9;
        font-size: 11px;
        overflow-wrap: anywhere;
    }

    .cg-decision {
        border-color: #f0cb88;
        background: #fff9ec;
    }

    .cg-branches {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        width: 100%;
        max-width: 360px;
        margin: 13px 0;
    }

    .cg-branches > div {
        min-width: 0;
        text-align: center;
    }

    .cg-branches .cg-node {
        width: 100%;
        min-height: 75px;
    }

    .cg-yes,
    .cg-no {
        display: inline-block;
        padding: 3px 12px;
        margin-bottom: 7px;
        border-radius: 20px;
        font-size: 10px;
        font-weight: 800;
    }

    .cg-yes {
        background: #e8faf0;
        color: #219667;
    }

    .cg-no {
        background: #fff1e2;
        color: #bb7d36;
    }

    /* PREVIEW PYTHON */

    .cg-instruction {
        padding: 13px;
        margin-bottom: 14px;
        border-radius: 13px;
        background: #eff6ff;
        color: #537ba2;
    }

    .cg-instruction strong {
        font-size: 11px;
    }

    .cg-instruction p {
        margin: 6px 0 0;
        font-size: 12px;
        line-height: 1.7;
        white-space: pre-wrap;
    }

    .cg-editor {
        overflow: hidden;
        border-radius: 17px;
        background: #0f172a;
        color: #e2e8f0;
    }

    .cg-tab {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        padding: 11px 14px;
        background: #1e293b;
        color: #94a3b8;
        font-size: 11px;
    }

    .cg-tab div {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .cg-tab i {
        width: 9px;
        height: 9px;
        border-radius: 50%;
        background: #fda4af;
    }

    .cg-tab i:nth-child(2) {
        background: #fcd34d;
    }

    .cg-tab i:nth-child(3) {
        background: #6ee7b7;
    }

    .cg-tab b {
        margin-left: 10px;
        color: #e2e8f0;
    }

    .cg-code {
        padding: 18px 14px;
        overflow-x: auto;
        font-family: Consolas, monospace;
        font-size: 13px;
        line-height: 2.1;
        white-space: pre;
    }

    .cg-code > div {
        display: flex;
        gap: 16px;
    }

    .cg-code em {
        width: 16px;
        flex-shrink: 0;
        color: #64748b;
        font-style: normal;
    }

    .cg-code code {
        color: #a7f3d0;
        white-space: pre;
    }

    /* SIMULASI */

    .cg-test {
        padding: 16px;
        margin-top: 16px;
        border: 1px solid #dbeafa;
        border-radius: 15px;
        background: #f6faff;
    }

    .cg-test-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
        margin-bottom: 11px;
    }

    .cg-test-top strong {
        font-size: 12px;
    }

    .cg-test-top span {
        color: #8ea4bb;
        font-size: 10px;
    }

    .cg-test label {
        max-width: 230px;
    }

    .cg-test button,
    .cg-publish button {
        margin-top: 13px;
        padding: 12px 15px;
        border: 0;
        border-radius: 11px;
        background: #719bc3;
        color: white;
        font-family: inherit;
        font-size: 12px;
        font-weight: 800;
        cursor: pointer;
    }

    .cg-test button:hover,
    .cg-publish button:hover {
        background: #5a87b4;
    }

    .cg-test pre {
        min-height: 62px;
        padding: 14px;
        margin: 14px 0 0;
        border-radius: 12px;
        background: #0f172a;
        color: #a7f3d0;
        font-family: Consolas, monospace;
        font-size: 12px;
        white-space: pre-wrap;
    }

    .cg-note {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 11px;
        margin-top: 16px;
        border-radius: 14px;
        background: #eff6ff;
    }

    .cg-note img {
        width: 64px;
        height: 64px;
        object-fit: contain;
    }

    .cg-note p {
        color: #7192b0;
        font-size: 11px;
        line-height: 1.7;
    }

    /* PUBLIKASI */

    .cg-publish {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
        margin-top: 20px;
    }

    .cg-publish h2 {
        margin: 0 0 6px;
        font-size: 18px;
    }

    .cg-publish p {
        margin: 0;
        color: #7893ac;
        font-size: 12px;
        line-height: 1.6;
    }

    .cg-publish-actions {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .cg-publish select {
        min-width: 145px;
        margin: 0;
    }

    .cg-publish button {
        margin: 0;
        white-space: nowrap;
    }

    .cg-errors {
        padding: 13px;
        margin-top: 15px;
        border-radius: 12px;
        background: #fff0f3;
        color: #a52e4b;
        font-size: 12px;
    }

    .cg-errors ul {
        margin: 7px 0 0;
        padding-left: 20px;
    }

    @media (max-width: 950px) {
        .cg-workspace {
            grid-template-columns: 1fr;
        }

        .cg-three {
            grid-template-columns: 1fr 1fr;
        }

        .cg-hero img {
            width: 100px;
            height: 100px;
        }
    }

    @media (max-width: 550px) {
        .cg-three,
        .cg-two {
            grid-template-columns: 1fr;
        }

        .cg-hero {
            padding: 20px;
        }

        .cg-hero img {
            display: none;
        }

        .cg-publish {
            display: block;
        }

        .cg-publish-actions {
            margin-top: 15px;
            flex-wrap: wrap;
        }

        .cg-panel {
            padding: 18px;
        }
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {

    const field = id => document.getElementById(id);

    const operators = {
        even: '% 2 == 0',
        odd: '% 2 != 0',
        gte: '>=',
        gt: '>',
        lte: '<=',
        lt: '<'
    };

    // Baca seluruh pengaturan Guru.
    function getSpec() {

        const variable =
            field('cg-variable').value.trim() || 'bilangan';

        const condition = field('cg-condition').value;

        const threshold =
            Number(field('cg-threshold').value || 0);

        const yes = field('cg-yes').value;
        const no = field('cg-no').value;

        const expression = ['even', 'odd'].includes(condition)
            ? `${variable} ${operators[condition]}`
            : `${variable} ${operators[condition]} ${threshold}`;

        return {
            variable,
            condition,
            threshold,
            yes,
            no,
            expression
        };
    }

    // Update Flowchart + Preview Python.
    function updatePreview() {

        const data = getSpec();

        const isParity =
            ['even', 'odd'].includes(data.condition);

        field('cg-threshold-wrap').style.display =
            isParity ? 'none' : 'block';

        field('cg-node-input').textContent =
            `Masukkan ${data.variable}`;

        field('cg-node-condition').textContent =
            data.expression + '?';

        field('cg-node-yes').textContent =
            data.yes || 'Output jika benar';

        field('cg-node-no').textContent =
            data.no || 'Output jika salah';

        field('cg-instruction-preview').textContent =
            field('cg-instruction').value ||
            'Isi instruksi untuk siswa...';

        field('cg-line-one').textContent =
            `${data.variable} = int(input())`;

        field('cg-line-two').textContent =
            `if ${data.expression}:`;

        field('cg-line-three').textContent =
            `    print(${JSON.stringify(data.yes)})`;

        field('cg-line-four').textContent =
            'else:';

        field('cg-line-five').textContent =
            `    print(${JSON.stringify(data.no)})`;

        field('cg-terminal').textContent =
            'Klik Jalankan Simulasi untuk melihat hasil.';
    }

    // Evaluasi kondisi tanpa mengeksekusi kode Python.
    function evaluate(data, value) {

        switch (data.condition) {
            case 'even':
                return value % 2 === 0;

            case 'odd':
                return value % 2 !== 0;

            case 'gte':
                return value >= data.threshold;

            case 'gt':
                return value > data.threshold;

            case 'lte':
                return value <= data.threshold;

            case 'lt':
                return value < data.threshold;
        }

        return false;
    }

    field('cg-run').addEventListener('click', () => {

        const input = field('cg-test-input');

        if (!input.reportValidity()) return;

        const value = Number(input.value);
        const data = getSpec();

        const output = evaluate(data, value)
            ? data.yes
            : data.no;

        field('cg-terminal').textContent =
            `>>> Input uji: ${value}\n>>> Output: ${output}`;
    });

    // Update otomatis setiap Guru mengubah pengaturan.
    [
        'cg-instruction',
        'cg-variable',
        'cg-condition',
        'cg-threshold',
        'cg-yes',
        'cg-no'
    ].forEach(id => {

        field(id).addEventListener('input', updatePreview);
        field(id).addEventListener('change', updatePreview);
    });

    updatePreview();

});
</script>
@endpush