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

<style>
    /* Compact & Premium UI */
    .search-bar { 
        align-items: center; 
        background: #fff; 
        border: 1px solid #e2e8f0; 
        border-radius: 12px; 
        display: flex; 
        height: 44px; 
        margin: 24px 0; 
        padding: 0 16px; 
        transition: all 0.2s;
    }
    .search-bar:focus-within { border-color: #005c34; box-shadow: 0 0 0 2px rgba(0, 92, 52, 0.08); }
    .search-bar input { border: 0; flex: 1; font-size: 14px; outline: 0; padding-left: 12px; }
    .search-bar i { color: #cbd5e0; font-size: 16px; }

    .tabs { display: flex; gap: 8px; flex-wrap: wrap; margin: 16px 0 28px; }
    .tabs a { 
        border: 1px solid #e2e8f0; 
        border-radius: 20px; 
        padding: 6px 16px; 
        text-align: center; 
        font-size: 13px; 
        font-weight: 500;
        background: #f7fafc;
        transition: all 0.2s;
    }
    .tabs a:hover { background: #edf2f7; border-color: #cbd5e0; }
    .tabs a.active { background: #005c34; border-color: #005c34; color: #fff; }

    /* Compact & Premium Cards */
    .card { background: #fff; border: 1px solid #e2e8f0; border-radius: 12px; transition: all 0.2s; overflow: hidden; display: block; }
    .card:hover { border-color: #cbd5e0; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
    .card img { width: 100%; aspect-ratio: 16/9; object-fit: cover; }
    .card-body { padding: 16px; }
    .card-body h3 { font-size: 15px; font-weight: 700; color: #2d3748; margin-bottom: 8px; line-height: 1.3; }
    .card-body p { font-size: 13px; color: #718096; line-height: 1.5; margin-bottom: 12px; }
    .article-meta { display: flex; align-items: center; gap: 8px; font-size: 12px; color: #a0aec0; }
    .dot { width: 4px; height: 4px; background: #cbd5e0; border-radius: 50%; }
</style>

<form class="search-bar" method="GET" action="{{ route('edukasi.index') }}">
    <i class="fa-solid fa-magnifying-glass"></i>
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
@if ($artikels->lastPage() > 1)
    <nav class="page-numbers" aria-label="Halaman artikel">
        @for ($page = 1; $page <= $artikels->lastPage(); $page++)
            @if ($page === $artikels->currentPage())
                <span class="active" aria-current="page">{{ $page }}</span>
            @else
                <a href="{{ $artikels->appends(request()->except('artikel_page'))->url($page) }}">{{ $page }}</a>
            @endif
        @endfor
    </nav>
@endif

@if ($videos->isNotEmpty())
    <h2 class="section-title">Video Edukasi</h2>
    <div class="grid-3">
        @foreach ($videos as $video)
            <a class="card video-card" href="{{ route('edukasi.video', $video->slug) }}">
                <div style="position:relative;">
                    <img src="{{ $video->thumbnail ? asset('storage/'.$video->thumbnail) : asset('assets/images/artikel12.png') }}" alt="{{ $video->judul_konten }}">
                    <span style="position:absolute;left:10px;bottom:10px;background:rgba(0,92,52,0.9);color:#fff;border-radius:6px;padding:4px 8px;font-size:11px;font-weight:600;"><i class="fa-solid fa-play" style="font-size:10px;margin-right:4px;"></i> Play</span>
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
