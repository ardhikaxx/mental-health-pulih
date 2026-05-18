@extends('layouts.dashboard', ['title' => 'Dashboard Admin'])

@section('content')
<section class="hero-panel">
    <h1>Selamat Datang, Admin!</h1>
    <p>Kelola konten dan pantau aktivitas di Ruang Pulih.</p>
</section>

<div class="main-grid">
    <div class="grid">
        <div class="grid-4">
            <div class="card stat-card"><div class="stat-icon"><i class="fa-solid fa-newspaper"></i></div><div><div class="stat-label">Total Artikel</div><div class="stat-value">{{ $stats['artikel'] }}</div></div></div>
            <div class="card stat-card"><div class="stat-icon"><i class="fa-solid fa-circle-play"></i></div><div><div class="stat-label">Total Video</div><div class="stat-value">{{ $stats['video'] }}</div></div></div>
            <div class="card stat-card"><div class="stat-icon"><i class="fa-solid fa-users"></i></div><div><div class="stat-label">Total Pasien</div><div class="stat-value">{{ $stats['pasien'] }}</div></div></div>
            <div class="card stat-card"><div class="stat-icon"><i class="fa-solid fa-comments"></i></div><div><div class="stat-label">Total Konsultasi</div><div class="stat-value">{{ $stats['konsultasi'] }}</div></div></div>
        </div>

        <div class="card">
            <div class="section-head">
                <h2>Artikel Edukasi Terbaru</h2>
                <a class="btn" href="{{ route('admin.edukasi.index') }}#tambah-artikel"><i class="fa-solid fa-plus"></i> Tambah Artikel</a>
            </div>
            <div class="table-wrap">
                <table>
                    <thead><tr><th>No</th><th>Judul Artikel</th><th>Kategori</th><th>Tanggal</th><th>Status</th><th>Aksi</th></tr></thead>
                    <tbody>
                    @forelse ($artikels as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->judul_konten }}</td>
                            <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>
                            <td>{{ $item->created_at->format('d M Y') }}</td>
                            <td><span class="badge {{ $item->status === 'publish' ? 'green' : 'gray' }}">{{ $item->status }}</span></td>
                            <td><a class="btn secondary" href="{{ route('admin.edukasi.show', $item) }}">Detail</a></td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="empty">Belum ada artikel.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="section-head">
                <h2>Video Edukasi Terbaru</h2>
                <a class="btn" href="{{ route('admin.edukasi.index') }}#tambah-video"><i class="fa-solid fa-plus"></i> Tambah Video</a>
            </div>
            <div class="table-wrap">
                <table>
                    <thead><tr><th>No</th><th>Judul Video</th><th>Durasi</th><th>Tanggal</th><th>Status</th><th>Aksi</th></tr></thead>
                    <tbody>
                    @forelse ($videos as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->judul_konten }}</td>
                            <td>{{ $item->durasi_video ?? '-' }}</td>
                            <td>{{ $item->created_at->format('d M Y') }}</td>
                            <td><span class="badge {{ $item->status === 'publish' ? 'green' : 'gray' }}">{{ $item->status }}</span></td>
                            <td><a class="btn secondary" href="{{ route('admin.edukasi.show', $item) }}">Detail</a></td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="empty">Belum ada video.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <aside class="grid">
        <div class="card">
            <h2 style="margin-bottom:16px;">Aksi Cepat</h2>
            <div class="grid">
                <a class="btn secondary full" href="{{ route('admin.edukasi.index') }}#tambah-artikel">Tambah Artikel Baru</a>
                <a class="btn secondary full" href="{{ route('admin.edukasi.index') }}#tambah-video">Tambah Video Baru</a>
                <a class="btn secondary full" href="{{ route('admin.skrining.index') }}">Kelola Skrining</a>
                <a class="btn secondary full" href="{{ route('admin.psikolog.index') }}">Kelola Psikolog</a>
            </div>
        </div>
        <div class="card">
            <h2 style="margin-bottom:16px;">Aktivitas Terbaru</h2>
            <p class="muted">Gunakan menu manajemen untuk melihat dan mengelola aktivitas sistem.</p>
        </div>
    </aside>
</div>
@endsection
