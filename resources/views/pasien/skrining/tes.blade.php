@extends('layouts.dashboard', ['title' => 'Tes Skrining'])

@section('content')
<section class="hero-panel">
    <h1>{{ $skrining->nama_skrining }}</h1>
    <p>{{ $skrining->deskripsi }}</p>
</section>

<form class="main-grid" method="POST" action="{{ route('pasien.skrining.submit', $skrining) }}">
    @csrf
    <div class="grid">
        @foreach ($skrining->pertanyaan as $pertanyaan)
            <div class="card">
                <h2 style="margin-bottom:14px;">{{ $loop->iteration }}. {{ $pertanyaan->pertanyaan }}</h2>
                <div class="grid-2">
                    @foreach ($pertanyaan->jawaban as $jawaban)
                        <label class="card" style="box-shadow:none;cursor:pointer;">
                            <input type="radio" name="jawaban[{{ $pertanyaan->id_pertanyaan }}]" value="{{ $jawaban->id_jawaban }}" required>
                            <strong>{{ $jawaban->teks_jawaban }}</strong>
                        </label>
                    @endforeach
                </div>
            </div>
        @endforeach
        <button class="btn" type="submit">Simpan Hasil</button>
    </div>

    <aside class="grid">
        <div class="card">
            <h2>Informasi Tes</h2>
            <p class="muted" style="margin-top:8px;">Jawab sesuai kondisi yang kamu rasakan. Tidak ada jawaban benar atau salah.</p>
        </div>
        <div class="card">
            <h2>Panduan</h2>
            <p class="muted" style="white-space:pre-line;margin-top:8px;">{{ $skrining->panduan_pengelolaan }}</p>
        </div>
    </aside>
</form>
@endsection
