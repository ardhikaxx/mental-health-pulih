@extends('layouts.dashboard', ['title' => 'Pemantauan Pasien'])

@section('content')
<section class="hero-panel">
    <h1>Pemantauan Kondisi Mental</h1>
    <p>Pantau ringkasan kondisi pasien yang pernah berkonsultasi.</p>
</section>

<div class="grid-4">
    <div class="card stat-card"><div class="stat-icon"><i class="fa-solid fa-user-group"></i></div><div><div class="stat-label">Pasien Dipantau</div><div class="stat-value">{{ $stats['dipantau'] }}</div></div></div>
    <div class="card stat-card"><div class="stat-icon"><i class="fa-solid fa-arrow-trend-up"></i></div><div><div class="stat-label">Membaik</div><div class="stat-value">{{ $stats['membaik'] }}</div></div></div>
    <div class="card stat-card"><div class="stat-icon"><i class="fa-solid fa-arrow-trend-down"></i></div><div><div class="stat-label">Memburuk</div><div class="stat-value">{{ $stats['memburuk'] }}</div></div></div>
    <div class="card stat-card"><div class="stat-icon"><i class="fa-solid fa-scale-balanced"></i></div><div><div class="stat-label">Stabil</div><div class="stat-value">{{ $stats['stabil'] }}</div></div></div>
</div>

<div class="card" style="margin-top:18px;">
    <div class="table-wrap">
        <table>
            <thead><tr><th>Nama Pasien</th><th>Skor Terakhir</th><th>Perubahan</th><th>Status</th><th>Tanggal Update</th><th>Aksi</th></tr></thead>
            <tbody>
            @forelse ($ringkasan as $item)
                <tr><td>{{ $item->pasien->user->nama_lengkap ?? '-' }}</td><td>{{ $item->skor_terakhir }}</td><td><span class="badge {{ $item->perubahan === 'memburuk' ? 'red' : 'green' }}">{{ $item->perubahan }}</span></td><td>{{ $item->kondisi_terakhir }}</td><td>{{ optional($item->tanggal_update)->format('d M Y') }}</td><td><a class="btn secondary" href="{{ route('psikolog.pemantauan.show', $item->pasien) }}">Detail</a></td></tr>
            @empty
                <tr><td colspan="6" class="empty">Belum ada pasien dipantau.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="pagination">{{ $ringkasan->links() }}</div>
</div>
@endsection
