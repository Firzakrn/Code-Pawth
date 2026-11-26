@extends('layouts.portal')

@section('title', 'Materi Saya')

@section('content')

<div style="margin-bottom:24px">
    <a
        href="{{ route('guru.studio') }}"
        style="color:#719bc3;font-size:12px;font-weight:800"
    >
        ← Kembali ke Studio Konten
    </a>
</div>

<div class="card soft" style="display:flex;align-items:center;
     justify-content:space-between;gap:20px;margin-bottom:26px">

    <div>
        <div class="eyebrow">📚 PERPUSTAKAAN GURU</div>
        <h1>Materi Saya</h1>

        <p class="muted">
            Kelola semua materi yang pernah dibuat.
        </p>
    </div>

    <img
        src="{{ asset('images/mascot_dashboard.png') }}"
        alt="Maskot CodePawth"
        style="width:120px;height:120px;object-fit:contain"
    >

</div>

<div class="section" style="display:grid;gap:15px">

    @forelse($materials as $material)

        <article class="card">

            <div style="display:flex;justify-content:space-between;
                        gap:15px;flex-wrap:wrap">

                <div>

                    <span class="pill">
                        {{ strtoupper($material->type) }}
                    </span>

                    <span class="pill">
                        {{ $material->level }}
                    </span>

                    <h2 style="margin-top:15px">
                        {{ $material->title }}
                    </h2>

                    <p class="muted">
                        Kelas:
                        {{ $material->learningClass?->name
                            ?? 'Belum memilih kelas' }}
                    </p>

                    <p class="muted">
                        Status:
                        {{ $material->status === 'published'
                            ? '🌟 Diterbitkan'
                            : '📝 Draft' }}
                    </p>

                </div>

                <div style="display:flex;align-items:center;
                            flex-wrap:wrap;gap:10px">

                    <a
                        href="{{ route('guru.materi.edit', $material) }}"
                        class="button"
                    >
                        ✏️ Edit Materi
                    </a>

                    <a
                        href="{{ route('materi.kelas.show', $material) }}"
                        class="button secondary"
                    >
                        👀 Lihat Materi
                    </a>

                </div>

            </div>

        </article>

    @empty

        <div class="card" style="text-align:center;padding:35px">

            <img
                src="{{ asset('images/mascot_peek.png') }}"
                alt="Maskot CodePawth"
                style="width:110px;height:110px;object-fit:contain"
            >

            <h2>Belum Ada Materi</h2>

            <p class="muted">
                Yuk, buat materi pertama menggunakan template!
            </p>

            <a
                href="{{ route('guru.studio') }}"
                class="button"
            >
                🎨 Pilih Template
            </a>

        </div>

    @endforelse

</div>

@endsection