@extends('layouts.dashboard', ['title' => 'Pilih Jadwal'])

@section('content')
<section class="hero-panel">
    <h1>{{ $psikolog->user->nama_lengkap }}</h1>
    <p>{{ $psikolog->spesialisasi ?? 'Psikolog' }} - pilih jadwal konsultasi yang tersedia.</p>
</section>

<form class="main-grid" method="POST" action="{{ route('pasien.konsultasi.jadwal.store', $psikolog) }}">
    @csrf
    <div class="grid">
        @forelse ($jadwal as $tanggal => $slots)
            <div class="card">
                <h2 style="margin-bottom:14px;">{{ \Carbon\Carbon::parse($tanggal)->format('d M Y') }}</h2>
                <div class="grid-3">
                    @foreach ($slots as $slot)
                        <label class="card" style="box-shadow:none;cursor:pointer;text-align:center;">
                            <input type="radio" name="id_jadwal" value="{{ $slot->id_jadwal }}" required>
                            <strong>{{ substr($slot->jam_mulai, 0, 5) }} - {{ substr($slot->jam_selesai, 0, 5) }}</strong>
                        </label>
                    @endforeach
                </div>
            </div>
        @empty
            <div class="card"><div class="empty">Belum ada jadwal tersedia.</div></div>
        @endforelse
        @if ($jadwal->isNotEmpty())
            <button class="btn" type="submit">Simpan Jadwal</button>
        @endif
    </div>

    <aside class="card">
        <h2>Info Psikolog</h2>
        <p class="muted" style="margin-top:10px;">{{ $psikolog->bio ?? 'Belum ada bio.' }}</p>
    </aside>
</form>
@endsection
