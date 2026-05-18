@extends('layouts.dashboard', ['title' => 'Status Konsultasi'])

@section('content')
<section class="hero-panel">
    <h1>Status Konsultasi</h1>
    <p>Permintaan konsultasi dengan {{ $konsultasi->psikolog->user->nama_lengkap }}.</p>
</section>

<div class="card">
    <div class="grid-3">
        <div><div class="stat-label">Tanggal</div><strong>{{ optional($konsultasi->tanggal_konsultasi)->format('d M Y') ?? '-' }}</strong></div>
        <div><div class="stat-label">Waktu</div><strong>{{ substr($konsultasi->waktu_mulai, 0, 5) }} - {{ substr($konsultasi->waktu_selesai, 0, 5) }}</strong></div>
        <div><div class="stat-label">Status</div><span class="badge blue">{{ $konsultasi->status_konsultasi }}</span></div>
    </div>
    @if (in_array($konsultasi->status_konsultasi, ['disetujui', 'terjadwal', 'berlangsung'], true))
        <a class="btn" style="margin-top:20px;" href="{{ route('pasien.konsultasi.chat', $konsultasi) }}">Mulai Konsultasi</a>
    @else
        <p class="muted" style="margin-top:20px;">Tunggu psikolog menyetujui permintaan konsultasi kamu.</p>
    @endif
</div>
@endsection
