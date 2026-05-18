@extends('layouts.dashboard', ['title' => 'Detail Pemantauan Pasien'])

@section('content')
<section class="hero-panel">
    <h1>{{ $pasien->user->nama_lengkap }}</h1>
    <p>Skor terakhir: {{ $ringkasan->skor_terakhir ?? 0 }} - {{ $ringkasan->kondisi_terakhir ?? 'Belum ada ringkasan' }}</p>
</section>

<div class="main-grid">
    <div class="card">
        <h2>Grafik Perkembangan</h2>
        <div class="chart-bars">
            @forelse ($pemantauan as $item)
                <div class="bar" title="{{ $item->tanggal_pemantauan->format('d M') }}: {{ $item->total_skor }}" style="height:{{ max(8, $item->total_skor * 12) }}px;"></div>
            @empty
                <p class="muted">Belum ada pemantauan.</p>
            @endforelse
        </div>
    </div>
    <aside class="card">
        <h2>Riwayat Skrining</h2>
        @forelse ($skrining as $item)
            <div style="border-bottom:1px solid #e5e5e5;padding:10px 0;"><strong>{{ $item->jenisSkrining->nama_skrining }}</strong><p class="muted">{{ $item->tanggal_skrining->format('d M Y') }} - skor {{ $item->total_skor }}</p></div>
        @empty
            <p class="muted" style="margin-top:10px;">Belum ada skrining.</p>
        @endforelse
    </aside>
</div>
@endsection
