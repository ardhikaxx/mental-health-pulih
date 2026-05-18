@extends('layouts.dashboard', ['title' => 'Dashboard Psikolog'])

@section('content')
<section class="hero-panel">
    <p>Halo, {{ $psikolog->user->nama_lengkap }}</p>
    <h1>Selamat Datang</h1>
    <p>Pantau kondisi pasien dan kelola konsultasi hari ini.</p>
</section>

<div class="grid-4">
    <div class="card stat-card"><div class="stat-icon"><i class="fa-solid fa-calendar-day"></i></div><div><div class="stat-label">Konsultasi Hari Ini</div><div class="stat-value">{{ $stats['hari_ini'] }}</div></div></div>
    <div class="card stat-card"><div class="stat-icon"><i class="fa-solid fa-users"></i></div><div><div class="stat-label">Pasien Aktif</div><div class="stat-value">{{ $stats['pasien'] }}</div></div></div>
    <div class="card stat-card"><div class="stat-icon"><i class="fa-solid fa-comment-dots"></i></div><div><div class="stat-label">Chat Aktif</div><div class="stat-value">{{ $stats['chat_aktif'] }}</div></div></div>
    <div class="card stat-card"><div class="stat-icon"><i class="fa-solid fa-triangle-exclamation"></i></div><div><div class="stat-label">Risiko Tinggi</div><div class="stat-value">{{ $stats['risiko_tinggi'] }}</div></div></div>
</div>

<div class="main-grid" style="margin-top:18px;">
    <div class="grid">
        <div class="card">
            <div class="section-head"><h2>Jadwal Konsultasi Hari Ini</h2><a class="btn secondary" href="{{ route('psikolog.konsultasi.index') }}">Lihat Semua</a></div>
            <div class="table-wrap">
                <table>
                    <thead><tr><th>Waktu</th><th>Pasien</th><th>Jenis</th><th>Status</th><th>Aksi</th></tr></thead>
                    <tbody>
                    @forelse ($jadwalHariIni as $item)
                        <tr><td>{{ substr($item->waktu_mulai, 0, 5) }}</td><td>{{ $item->pasien->user->nama_lengkap ?? '-' }}</td><td>{{ $item->jenis_konsultasi }}</td><td><span class="badge blue">{{ $item->status_konsultasi }}</span></td><td><a class="btn secondary" href="{{ route('psikolog.konsultasi.chat', $item) }}">Chat</a></td></tr>
                    @empty
                        <tr><td colspan="5" class="empty">Tidak ada jadwal hari ini.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="section-head"><h2>Ringkasan Pasien Terbaru</h2><a class="btn secondary" href="{{ route('psikolog.pemantauan.index') }}">Lihat Semua</a></div>
            <div class="table-wrap">
                <table>
                    <thead><tr><th>Pasien</th><th>Kondisi Terakhir</th><th>Skor</th><th>Perubahan</th></tr></thead>
                    <tbody>
                    @forelse ($ringkasan as $item)
                        <tr><td>{{ $item->pasien->user->nama_lengkap ?? '-' }}</td><td>{{ $item->kondisi_terakhir }}</td><td>{{ $item->skor_terakhir }}</td><td><span class="badge {{ $item->perubahan === 'memburuk' ? 'red' : 'green' }}">{{ $item->perubahan }}</span></td></tr>
                    @empty
                        <tr><td colspan="4" class="empty">Belum ada ringkasan.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <aside class="grid">
        <div class="card">
            <h2>Notifikasi</h2>
            @forelse ($notifikasi as $item)
                <div style="border-bottom:1px solid #e5e5e5;padding:10px 0;"><strong>{{ $item->judul_notifikasi }}</strong><p class="muted">{{ $item->isi_notifikasi }}</p></div>
            @empty
                <p class="muted" style="margin-top:10px;">Belum ada notifikasi.</p>
            @endforelse
        </div>
        <div class="card">
            <h2>Pasien Perlu Perhatian</h2>
            @forelse ($perhatian as $item)
                <div style="display:flex;justify-content:space-between;border-bottom:1px solid #e5e5e5;padding:10px 0;"><strong>{{ $item->pasien->user->nama_lengkap ?? '-' }}</strong><span class="badge {{ $item->prioritas === 'tinggi' ? 'red' : 'yellow' }}">{{ $item->prioritas }}</span></div>
            @empty
                <p class="muted" style="margin-top:10px;">Tidak ada prioritas.</p>
            @endforelse
        </div>
    </aside>
</div>
@endsection
