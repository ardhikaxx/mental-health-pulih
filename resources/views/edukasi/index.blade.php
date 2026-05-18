@extends('layouts.public', ['title' => 'Edukasi - Ruang Pulih'])

@section('content')
<section class="hero">
    <div>
        <h1>Belajar, Peduli,<br>Pulih Bersama.</h1>
        <p>Temukan informasi dan pengetahuan seputar kesehatan mental yang dapat membantu kamu menjalani hidup lebih seimbang.</p>
        <a href="#artikel" class="btn">Jelajahi Edukasi</a>
    </div>
    <img class="hero-img" src="{{ asset('assets/images/banner.png') }}" alt="Edukasi kesehatan mental">
</section>

<form class="search-bar" method="GET" action="{{ route('edukasi.index') }}">
    <i class="fa-solid fa-magnifying-glass" style="font-size:30px;"></i>
    <input name="search" value="{{ $search }}" placeholder="Cari artikel, tips, atau video edukasi...">
    <input type="hidden" name="filter" value="{{ $filter }}">
</form>

<div class="tabs">
    <a class="{{ blank($filter) ? 'active' : '' }}" href="{{ route('edukasi.index', ['search' => $search]) }}">Semua</a>
    <a class="{{ $filter === 'artikel' ? 'active' : '' }}" href="{{ route('edukasi.index', ['filter' => 'artikel', 'search' => $search]) }}">Artikel</a>
    <a class="{{ $filter === 'tips-stres' ? 'active' : '' }}" href="{{ route('edukasi.index', ['filter' => 'tips-stres', 'search' => $search]) }}">Tips Stres</a>
    <a class="{{ $filter === 'video' ? 'active' : '' }}" href="{{ route('edukasi.index', ['filter' => 'video', 'search' => $search]) }}">Video Edukasi</a>
</div>

<h2 id="artikel" class="section-title">Artikel Terbaru</h2>
<div class="grid-3">
    @forelse ($artikels as $artikel)
        <a class="card article-card" href="{{ route('edukasi.show', $artikel->slug) }}">
            <img src="{{ $artikel->thumbnail ? asset('storage/'.$artikel->thumbnail) : asset('assets/images/artikel13.png') }}" alt="{{ $artikel->judul_konten }}">
            <div class="card-body">
                <h3>{{ $artikel->judul_konten }}</h3>
                <p class="muted">{{ \Illuminate\Support\Str::limit(strip_tags($artikel->isi_artikel), 115) }}</p>
                <div class="article-meta">
                    <span>{{ optional($artikel->tanggal_publish ?? $artikel->created_at)->translatedFormat('j M Y') }}</span>
                    <span class="dot"></span>
                    <span>{{ max(3, ceil(str_word_count(strip_tags($artikel->isi_artikel ?? '')) / 180)) }} min baca</span>
                </div>
            </div>
        </a>
    @empty
        <div class="card card-body" style="grid-column:1/-1;">Belum ada artikel publish.</div>
    @endforelse
</div>
<div class="pagination">{{ $artikels->links() }}</div>

@if ($videos->isNotEmpty())
    <h2 class="section-title">Video Edukasi</h2>
    <div class="grid-3">
        @foreach ($videos as $video)
            <a class="card video-card" href="{{ route('edukasi.video', $video->slug) }}">
                <div style="position:relative;">
                    <img src="{{ $video->thumbnail ? asset('storage/'.$video->thumbnail) : asset('assets/images/artikel12.png') }}" alt="{{ $video->judul_konten }}">
                    <span style="position:absolute;left:18px;bottom:16px;background:#005c34;color:#fff;border-radius:999px;padding:8px 14px;"><i class="fa-solid fa-play"></i> Play</span>
                </div>
                <div class="card-body">
                    <h3>{{ $video->judul_konten }}</h3>
                    <p class="muted">{{ $video->kategori->nama_kategori ?? 'Video Edukasi' }} - {{ $video->durasi_video }}</p>
                </div>
            </a>
        @endforeach
    </div>
@endif
@endsection
