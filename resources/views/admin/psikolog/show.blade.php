@extends('layouts.dashboard', ['title' => 'Detail Psikolog'])

@section('content')
<section class="hero-panel">
    <h1>{{ $psikolog->user->nama_lengkap }}</h1>
    <p>{{ $psikolog->spesialisasi ?? 'Psikolog' }} - SIPA {{ $psikolog->nomor_sipa }}</p>
</section>

<div class="grid-3">
    <div class="card"><div class="stat-label">Email</div><strong>{{ $psikolog->user->email }}</strong></div>
    <div class="card"><div class="stat-label">Telepon</div><strong>{{ $psikolog->user->nomor_telepon ?? '-' }}</strong></div>
    <div class="card"><div class="stat-label">Pengalaman</div><strong>{{ $psikolog->pengalaman ?? 0 }} tahun</strong></div>
</div>

<div class="card" style="margin-top:18px;">
    <h2 style="margin-bottom:10px;">Bio</h2>
    <p class="muted">{{ $psikolog->bio ?? 'Belum ada bio.' }}</p>
</div>

<div class="card" style="margin-top:18px;">
    <h2 style="margin-bottom:14px;">Jadwal Mendatang</h2>
    <div class="table-wrap">
        <table>
            <thead><tr><th>Tanggal</th><th>Jam</th><th>Status</th></tr></thead>
            <tbody>
            @forelse ($psikolog->jadwal as $slot)
                <tr><td>{{ $slot->tanggal->format('d M Y') }}</td><td>{{ substr($slot->jam_mulai, 0, 5) }} - {{ substr($slot->jam_selesai, 0, 5) }}</td><td><span class="badge green">{{ $slot->status_jadwal }}</span></td></tr>
            @empty
                <tr><td colspan="3" class="empty">Belum ada jadwal.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
