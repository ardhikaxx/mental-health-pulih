@extends('layouts.dashboard', ['title' => 'Konsultasi Psikolog'])

@section('content')
<section class="hero-panel">
    <h1>Konsultasi Online</h1>
    <p>Kelola permintaan konsultasi dan sesi chat pasien.</p>
</section>

<div class="grid-3">
    <div class="card stat-card"><div class="stat-icon"><i class="fa-solid fa-inbox"></i></div><div><div class="stat-label">Permintaan Baru</div><div class="stat-value">{{ $stats['baru'] }}</div></div></div>
    <div class="card stat-card"><div class="stat-icon"><i class="fa-solid fa-circle-check"></i></div><div><div class="stat-label">Selesai Hari Ini</div><div class="stat-value">{{ $stats['selesai_hari_ini'] }}</div></div></div>
    <div class="card stat-card"><div class="stat-icon"><i class="fa-solid fa-list-check"></i></div><div><div class="stat-label">Total Sesi</div><div class="stat-value">{{ $stats['semua'] }}</div></div></div>
</div>

<div class="card" style="margin-top:18px;">
    <h2 style="margin-bottom:14px;">Permintaan Konsultasi</h2>
    <div class="grid">
        @forelse ($konsultasi as $item)
            <div class="card" style="box-shadow:none;">
                <div class="section-head">
                    <div>
                        <h2>{{ $item->pasien->user->nama_lengkap ?? '-' }}</h2>
                        <p class="muted">{{ optional($item->tanggal_konsultasi)->format('d M Y') }} {{ substr($item->waktu_mulai, 0, 5) }} - {{ $item->pendaftaran->tingkat_urgensi ?? 'rendah' }}</p>
                    </div>
                    <span class="badge blue">{{ $item->status_konsultasi }}</span>
                </div>
                <p class="muted">{{ $item->pendaftaran->keluhan ?? '-' }}</p>
                <div class="actions" style="margin-top:14px;">
                    @if ($item->status_konsultasi === 'permintaan_baru')
                        <form action="{{ route('psikolog.konsultasi.approve', $item) }}" method="POST">@csrf @method('PATCH')<button class="btn" type="submit">Setuju</button></form>
                        <form action="{{ route('psikolog.konsultasi.reject', $item) }}" method="POST">@csrf @method('PATCH')<input type="hidden" name="catatan_psikolog" value="Jadwal belum dapat diterima."><button class="btn danger" type="submit">Tolak</button></form>
                    @endif
                    @if (in_array($item->status_konsultasi, ['disetujui','terjadwal'], true))
                        <form action="{{ route('psikolog.konsultasi.start', $item) }}" method="POST">@csrf @method('PATCH')<button class="btn" type="submit">Mulai</button></form>
                    @endif
                    @if (in_array($item->status_konsultasi, ['berlangsung','follow_up'], true))
                        <a class="btn secondary" href="{{ route('psikolog.konsultasi.chat', $item) }}">Chat</a>
                    @endif
                </div>
            </div>
        @empty
            <div class="empty">Belum ada permintaan konsultasi.</div>
        @endforelse
    </div>
    <div class="pagination">{{ $konsultasi->links() }}</div>
</div>
@endsection
