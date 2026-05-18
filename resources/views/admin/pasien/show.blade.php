@extends('layouts.dashboard', ['title' => 'Detail Pasien'])

@section('content')
<section class="hero-panel">
    <h1>{{ $pasien->user->nama_lengkap }}</h1>
    <p>{{ $pasien->user->email }} - {{ $pasien->user->nomor_telepon ?? 'Nomor telepon belum diisi' }}</p>
</section>

<div class="grid-3">
    <div class="card"><div class="stat-label">Umur</div><div class="stat-value">{{ $pasien->umur ?? '-' }}</div></div>
    <div class="card"><div class="stat-label">Jenis Kelamin</div><div class="stat-value" style="font-size:24px;">{{ $pasien->user->jenis_kelamin ?? '-' }}</div></div>
    <div class="card"><div class="stat-label">Status</div><span class="badge green">{{ $pasien->status_pasien }}</span></div>
</div>

<div class="grid" style="margin-top:18px;">
    <div class="card">
        <h2 style="margin-bottom:14px;">Riwayat Skrining</h2>
        <div class="table-wrap">
            <table>
                <thead><tr><th>Tanggal</th><th>Jenis</th><th>Skor</th><th>Kategori</th></tr></thead>
                <tbody>
                @forelse ($hasil as $item)
                    <tr><td>{{ $item->tanggal_skrining->format('d M Y') }}</td><td>{{ $item->jenisSkrining->nama_skrining }}</td><td>{{ $item->total_skor }}</td><td><span class="badge yellow">{{ $item->kategori_hasil }}</span></td></tr>
                @empty
                    <tr><td colspan="4" class="empty">Belum ada skrining.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <h2 style="margin-bottom:14px;">Riwayat Konsultasi</h2>
        <div class="table-wrap">
            <table>
                <thead><tr><th>Tanggal</th><th>Psikolog</th><th>Status</th></tr></thead>
                <tbody>
                @forelse ($konsultasi as $item)
                    <tr><td>{{ optional($item->tanggal_konsultasi)->format('d M Y') ?? '-' }}</td><td>{{ $item->psikolog->user->nama_lengkap ?? '-' }}</td><td><span class="badge blue">{{ $item->status_konsultasi }}</span></td></tr>
                @empty
                    <tr><td colspan="3" class="empty">Belum ada konsultasi.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <h2 style="margin-bottom:14px;">Pemantauan Mental</h2>
        <div class="table-wrap">
            <table>
                <thead><tr><th>Tanggal</th><th>Skor</th><th>Kondisi</th></tr></thead>
                <tbody>
                @forelse ($pemantauan as $item)
                    <tr><td>{{ $item->tanggal_pemantauan->format('d M Y') }}</td><td>{{ $item->total_skor }}</td><td><span class="badge {{ $item->kondisi_mental === 'parah' ? 'red' : 'green' }}">{{ $item->kondisi_mental }}</span></td></tr>
                @empty
                    <tr><td colspan="3" class="empty">Belum ada pemantauan.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
