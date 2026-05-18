@extends('layouts.dashboard', ['title' => 'Pilih Tes Skrining'])

@section('content')
<section class="hero-panel">
    <h1>Pilih Tes Skrining</h1>
    <p>Pilih tes yang sesuai dengan kondisi yang ingin kamu kenali.</p>
</section>

<div class="grid-3">
    @forelse ($jenis as $item)
        <div class="card">
            <h2>{{ $item->nama_skrining }}</h2>
            <p class="muted" style="margin:10px 0 16px;">{{ $item->deskripsi }}</p>
            <span class="badge green">{{ $item->jumlah_pertanyaan ?: $item->pertanyaan_count }} pertanyaan</span>
            <a class="btn full" style="margin-top:18px;" href="{{ route('pasien.skrining.tes', $item) }}">Mulai Tes</a>
        </div>
    @empty
        <div class="card" style="grid-column:1/-1;"><div class="empty">Belum ada tes skrining yang dipublish.</div></div>
    @endforelse
</div>
@endsection
