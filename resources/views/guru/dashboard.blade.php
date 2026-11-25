
@extends('layouts.portal')

@section('title', 'Dashboard Guru')

@section('content')

{{-- SAPAAN GURU --}}
<div class="eyebrow">
    👩‍🏫 DASHBOARD GURU
</div>

<h1>
    Halo, {{ auth()->user()->name }}! 👋
</h1>

<p class="muted">
    Selamat datang di CodePawth!
    Kelola kelas, buat materi interaktif,
    dan bagikan aktivitas belajar kepada siswa.
</p>

{{-- MENU UTAMA --}}
<div class="section grid">

    {{-- BUAT KELAS --}}
    <section class="card soft">

        <span class="emoji">🏫</span>

        <h2>Buat Kelas Baru</h2>

        <p class="muted">
            Buat kelas dan bagikan kode agar siswa
            dapat bergabung dengan kelasmu.
        </p>

        <form
            method="POST"
            action="{{ route('guru.kelas.store') }}"
        >
            @csrf

            <div class="field">

                <label for="name">
                    Nama Kelas
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Contoh: Coding 7A"
                    maxlength="100"
                    required
                >

                @error('name')
                    <small style="color:#d95d70">
                        {{ $message }}
                    </small>
                @enderror

            </div>

            <div class="field">

                <label for="level">
                    Jenjang Kelas
                </label>

                <select
                    id="level"
                    name="level"
                    required
                >

                    @foreach (['Umum', 'SD', 'SMP', 'SMA'] as $level)

                        <option
                            value="{{ $level }}"
                            @selected(old('level', 'Umum') === $level)
                        >
                            {{ $level }}
                        </option>

                    @endforeach

                </select>

                @error('level')
                    <small style="color:#d95d70">
                        {{ $message }}
                    </small>
                @enderror

            </div>

            <button
                type="submit"
                class="button"
            >
                + Buat Kelas
            </button>

        </form>

    </section>

    {{-- STUDIO KONTEN GURU --}}
    <section class="card">

        <span class="emoji">🎨</span>

        <h2>Studio Konten Guru</h2>

        <p class="muted">
            Buat materi dan evaluasi interaktif
            menggunakan template yang sudah
            disediakan CodePawth.
        </p>

        <p class="muted">
            Pilih template flashcard, artikel,
            gambar, matching, flowchart,
            atau coding blocks.
        </p>

        <div style="
            display:flex;
            flex-wrap:wrap;
            gap:10px;
            margin-top:20px;
        ">

            <a
                href="{{ route('guru.studio') }}"
                class="button"
            >
                🎨 Buka Studio Konten
            </a>

            <a
                href="{{ route('level-view') }}"
                class="button secondary"
            >
                📚 Jelajahi Materi
            </a>

        </div>

    </section>

</div>

{{-- DAFTAR KELAS --}}
<section class="section card">

    <h2>🏫 Kelas Saya</h2>

    <p class="muted">
        Kelola kelas yang sudah dibuat
        dan bagikan kode kepada siswa.
    </p>

    @forelse ($classes as $class)

        <div class="class-item">

            <div>

                <strong>
                    {{ $class->name }}
                </strong>

                <p class="muted">
                    {{ $class->level }}
                    · {{ $class->students_count }} siswa
                </p>

            </div>

            <div style="
                display:flex;
                align-items:center;
                flex-wrap:wrap;
                gap:10px;
            ">

                <span class="pill">
                    {{ $class->join_code }}
                </span>

                <button
                    type="button"
                    class="button secondary"
                    onclick="copyClassCode(@js($class->join_code))"
                >
                    📋 Salin Kode
                </button>

            </div>

        </div>

    @empty

        <div style="
            text-align:center;
            padding:35px 15px;
        ">

            <img
                src="{{ asset('images/mascot_class.png') }}"
                alt="Maskot CodePawth"
                style="
                    width:120px;
                    height:120px;
                    object-fit:contain;
                    margin-bottom:10px;
                "
            >

            <h3>Belum Ada Kelas</h3>

            <p class="muted">
                Yuk, buat kelas pertamamu
                dan mulai belajar bersama siswa!
            </p>

        </div>

    @endforelse

</section>

@endsection

@push('scripts')

<script>
    async function copyClassCode(code) {
        try {
            await navigator.clipboard.writeText(code);

            alert('Kode kelas berhasil disalin!');
        } catch (error) {
            window.prompt('Salin kode kelas:', code);
        }
    }
</script>

@endpush