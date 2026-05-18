@extends('layouts.dashboard', ['title' => 'Pilih Psikolog'])

@section('content')
<section class="hero-panel">
    <h1>Pilih Psikolog</h1>
    <p>Cari psikolog berdasarkan nama atau spesialisasi.</p>
</section>

<div class="card">
    <form class="filters" method="GET">
        <input class="input" style="max-width:420px;" name="search" value="{{ $search }}" placeholder="Cari psikolog atau spesialisasi...">
        <button class="btn" type="submit">Cari</button>
    </form>
</div>

<div class="grid-3" style="margin-top:18px;">
    @forelse ($psikologs as $psikolog)
        <div class="card">
            <h2>{{ $psikolog->user->nama_lengkap }}</h2>
            <p class="muted" style="margin:8px 0;">{{ $psikolog->spesialisasi ?? 'Psikolog' }} - {{ $psikolog->pengalaman ?? 0 }} tahun</p>
            <p class="muted">{{ \Illuminate\Support\Str::limit($psikolog->bio, 120) }}</p>
            <a class="btn full" style="margin-top:18px;" href="{{ route('pasien.konsultasi.jadwal', $psikolog) }}">Pilih</a>
        </div>
    @empty
        <div class="card" style="grid-column:1/-1;"><div class="empty">Psikolog tidak ditemukan.</div></div>
    @endforelse
</div>
<div class="pagination">{{ $psikologs->links() }}</div>
@endsection
