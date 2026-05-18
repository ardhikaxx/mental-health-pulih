@extends('layouts.dashboard', ['title' => 'Detail Edukasi'])

@section('content')
<section class="hero-panel">
    <h1>{{ $edukasi->judul_konten }}</h1>
    <p>{{ ucfirst($edukasi->tipe_konten) }} - {{ $edukasi->kategori->nama_kategori ?? '-' }} - {{ $edukasi->status }}</p>
</section>

<div class="card">
    @if ($edukasi->thumbnail)
        <img src="{{ asset('storage/'.$edukasi->thumbnail) }}" alt="{{ $edukasi->judul_konten }}" style="width:100%;max-height:380px;object-fit:cover;border-radius:10px;margin-bottom:18px;">
    @endif
    <p class="muted" style="margin-bottom:16px;">Penulis: {{ $edukasi->penulis->nama_lengkap ?? '-' }} | Publish: {{ optional($edukasi->tanggal_publish)->format('d M Y H:i') ?? '-' }}</p>
    @if ($edukasi->tipe_konten === 'artikel')
        <div style="line-height:1.7;">{!! nl2br(e($edukasi->isi_artikel)) !!}</div>
    @else
        <p><strong>URL Video:</strong> <a href="{{ $edukasi->url_video }}" target="_blank">{{ $edukasi->url_video }}</a></p>
        <p><strong>Durasi:</strong> {{ $edukasi->durasi_video }}</p>
    @endif
</div>
@endsection
