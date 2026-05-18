@extends('layouts.dashboard', ['title' => 'Hasil Skrining'])

@section('content')
<section class="hero-panel">
    <h1>Hasil Skrining</h1>
    <p>{{ $hasil->jenisSkrining->nama_skrining }} pada {{ $hasil->tanggal_skrining->format('d M Y') }}</p>
</section>

<div class="grid-3">
    <div class="card"><div class="stat-label">Total Skor</div><div class="stat-value">{{ $hasil->total_skor }}</div></div>
    <div class="card"><div class="stat-label">Kategori</div><span class="badge {{ $hasil->kategori_hasil === 'berat' ? 'red' : 'yellow' }}">{{ $hasil->kategori_hasil }}</span></div>
    <div class="card"><div class="stat-label">Rekomendasi</div><a class="btn secondary" href="{{ route('pasien.konsultasi.index') }}">Konsultasi</a></div>
</div>

<div class="card" style="margin-top:18px;">
    <h2>Keterangan Hasil</h2>
    <p class="muted" style="margin-top:8px;">{{ $hasil->keterangan_hasil }}</p>
</div>

<div class="card" style="margin-top:18px;">
    <h2 style="margin-bottom:14px;">Detail Jawaban</h2>
    <div class="table-wrap">
        <table>
            <thead><tr><th>Pertanyaan</th><th>Jawaban</th><th>Nilai</th></tr></thead>
            <tbody>
            @foreach ($hasil->detail as $detail)
                <tr><td>{{ $detail->pertanyaan->pertanyaan }}</td><td>{{ $detail->jawaban->teks_jawaban }}</td><td>{{ $detail->nilai_jawaban }}</td></tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
