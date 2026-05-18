@extends('layouts.dashboard', ['title' => 'Hasil Pemantauan'])

@section('content')
<section class="hero-panel">
    <h1>Hasil Pemantauan Hari Ini</h1>
    <p>{{ $pemantauan->tanggal_pemantauan->format('d M Y') }}</p>
</section>

<div class="grid-3">
    <div class="card"><div class="stat-label">Kondisi Mental</div><div class="stat-value"><i class="fa-solid {{ $pemantauan->kondisi_mental === 'parah' ? 'fa-face-frown' : ($pemantauan->kondisi_mental === 'sedang' ? 'fa-face-meh' : 'fa-face-smile') }}"></i></div><span class="badge {{ $pemantauan->kondisi_mental === 'parah' ? 'red' : 'green' }}">{{ $pemantauan->kondisi_mental }}</span></div>
    <div class="card"><div class="stat-label">Skor</div><div class="stat-value"><i class="fa-solid fa-gauge-high" style="font-size:24px;"></i> {{ $pemantauan->total_skor }}</div></div>
    <div class="card"><div class="stat-label">Aksi</div>@if ($pemantauan->kondisi_mental === 'parah')<a class="btn" href="{{ route('pasien.konsultasi.index') }}"><i class="fa-solid fa-user-doctor"></i> Konsultasi Psikolog</a>@else<span class="badge green"><i class="fa-solid fa-clock"></i> Pantau berkala</span>@endif</div>
</div>

<div class="main-grid" style="margin-top:18px;">
    <div class="card">
        <h2 style="margin-bottom:14px;">Ringkasan Jawaban</h2>
        <div class="table-wrap">
            <table>
                <thead><tr><th>Pertanyaan</th><th>Nilai</th></tr></thead>
                <tbody>
                @foreach ($pemantauan->jawaban as $jawaban)
                    <tr><td>{{ $jawaban->pertanyaan->pertanyaan }}</td><td>{{ $jawaban->nilai_jawaban }}</td></tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <aside class="card">
        <h2>Grafik Perkembangan</h2>
        <div class="chart-bars">
            @forelse ($riwayat as $item)
                <div class="bar" title="{{ $item->tanggal_pemantauan->format('d M') }}: {{ $item->total_skor }}" style="height:{{ max(8, $item->total_skor * 12) }}px;"></div>
            @empty
                <p class="muted">Belum ada riwayat.</p>
            @endforelse
        </div>
    </aside>
</div>
@endsection
