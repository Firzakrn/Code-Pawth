
@extends('layouts.portal')

@section('title', 'Dashboard Siswa')

@section('content')

<div class="eyebrow">🎒 DASHBOARD SISWA</div>

<h1>
    Halo, {{ auth()->user()->name }}! 👋
</h1>

<p class="muted">
    Mau belajar sendiri atau bersama guru?
    Kamu bebas memilih keduanya!
</p>

<div class="section grid">

    {{-- BELAJAR MANDIRI --}}
    <section class="card soft">

        <span class="emoji">🧩</span>

        <h2>Belajar Mandiri</h2>

        <p>
            Pilih jenjang dan level yang ingin
            kamu pelajari. Tidak memerlukan
            kode kelas dari guru.
        </p>

        <a href="{{ route('level-view') }}"
           class="button">
            Mulai Belajar →
        </a>

    </section>

    {{-- BELAJAR BERSAMA GURU --}}
    <section class="card">

        <span class="emoji">👩‍🏫</span>

        <h2>Belajar Bersama Guru</h2>

        <p>
            Kalau guru memberikan kode kelas,
            kamu bisa memasukkannya di sini.
            Bagian ini tidak wajib.
        </p>

        <form method="POST"
              action="{{ route('murid.kelas.join') }}">

            @csrf

            <div class="field">
                <label for="join_code">
                    Kode Kelas
                </label>

                <input
                    type="text"
                    id="join_code"
                    name="join_code"
                    placeholder="Contoh: ABC1234"
                    value="{{ old('join_code') }}"
                    maxlength="7"
                    required
                >
            </div>

            <button type="submit" class="button secondary">
                Gabung Kelas →
            </button>

        </form>

    </section>

</div>

<section class="section card">

    <h2>Kelas yang Kamu Ikuti</h2>

    @forelse ($classes as $class)

        <div class="class-item">

            <div>
                <strong>{{ $class->name }}</strong>

                <p class="muted">
                    Guru: {{ $class->teacher->name }}
                </p>
            </div>

            <span class="pill">
                Terdaftar
            </span>

        </div>

    @empty

        <p class="muted">
            Belum mengikuti kelas.
            Kamu tetap bisa belajar mandiri
            kapan saja.
        </p>

    @endforelse

</section>

@endsection