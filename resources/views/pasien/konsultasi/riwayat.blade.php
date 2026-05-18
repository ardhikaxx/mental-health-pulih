@extends('layouts.dashboard', ['title' => 'Riwayat Konsultasi'])

@section('content')
<section class="hero-panel">
    <h1>Riwayat Konsultasi</h1>
    <p>Daftar konsultasi yang pernah kamu ajukan.</p>
</section>

<div class="card">
    <div class="table-wrap">
        <table>
            <thead><tr><th>Tanggal</th><th>Psikolog</th><th>Waktu</th><th>Status</th><th>Aksi</th></tr></thead>
            <tbody>
            @forelse ($konsultasi as $item)
                <tr>
                    <td>{{ optional($item->tanggal_konsultasi)->format('d M Y') ?? '-' }}</td>
                    <td>{{ $item->psikolog->user->nama_lengkap ?? '-' }}</td>
                    <td>{{ substr($item->waktu_mulai, 0, 5) }} - {{ substr($item->waktu_selesai, 0, 5) }}</td>
                    <td><span class="badge blue">{{ $item->status_konsultasi }}</span></td>
                    <td><a class="btn secondary" href="{{ route('pasien.konsultasi.menunggu', $item) }}">Detail</a></td>
                </tr>
            @empty
                <tr><td colspan="5" class="empty">Belum ada konsultasi.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="pagination">{{ $konsultasi->links() }}</div>
</div>
@endsection
