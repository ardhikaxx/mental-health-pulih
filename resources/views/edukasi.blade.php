@extends('layouts.app')

@section('content')

<style>
    .edukasi-container { width: min(1200px, 100% - 48px); margin: 0 auto; padding: 24px 0 60px; }

    /* Banner styles ... (unchanged) */

    .search-box {
        height: 64px;
        margin: 32px 0 24px;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        display: flex;
        align-items: center;
        padding: 0 24px;
        background: #fff;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }
    .search-box:focus-within { border-color: #005c34; box-shadow: 0 0 0 3px rgba(0, 92, 52, 0.1); }
    .search-box i { color: #a0aec0; font-size: 20px; }
    .search-box input {
        width: 100%; border: none; outline: none; font-size: 16px; margin-left: 16px; color: #4a5568;
    }

    .category { display: flex; gap: 12px; margin-bottom: 32px; flex-wrap: wrap; }
    .category button {
        padding: 10px 24px;
        border-radius: 50px;
        border: 1px solid #e2e8f0;
        background: #fff;
        font-size: 15px;
        font-weight: 600;
        color: #4a5568;
        cursor: pointer;
        transition: all 0.2s;
    }
    .category button:hover { border-color: #005c34; color: #005c34; }
    .category .selected {
        background: #005c34;
        color: #fff;
        border-color: #005c34;
        box-shadow: 0 4px 12px rgba(0, 92, 52, 0.2);
    }
    
    /* ... rest of styles */
</style>

<div class="edukasi-container">
    <div class="banner">...</div>

    <div class="search-box">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="text" placeholder="Cari artikel, tips, atau video edukasi...">
    </div>

    <div class="category">
        <button class="selected">Semua</button>
        <button>Artikel</button>
        <button>Tips Stres</button>
        <button>Video Edukasi</button>
    </div>
    
    <!-- ... -->
</div>

    <div class="card-container">

        @forelse($artikels ?? [] as $artikel)
            <div class="card">
                <img src="{{ asset('storage/' . $artikel->gambar) }}" alt="{{ $artikel->judul }}">

                <div class="card-content">
                    <h3>{{ $artikel->judul }}</h3>
                    <p>{{ Str::limit($artikel->deskripsi, 95) }}</p>

                    <div class="info">
                        <span>{{ $artikel->created_at->translatedFormat('j M Y') }}</span>
                        <span class="dot"></span>
                        <span>{{ $artikel->durasi_baca ?? '5 min baca' }}</span>
                    </div>
                </div>
            </div>
        @empty
            <div class="card">
                <img src="{{ asset('assets/images/artikel13.png') }}" alt="Artikel 1">
                <div class="card-content">
                    <h3>4 Manfaat Support System untuk Kesehatan Mental yang Perlu Diketahui</h3>
                    <p>Dukungan dari orang sekitar dapat menjadi kekuatan besar dalam proses pemulihan.</p>
                    <div class="info">
                        <span>9 Mei 2026</span>
                        <span class="dot"></span>
                        <span>6 min baca</span>
                    </div>
                </div>
            </div>

            <div class="card">
                <img src="{{ asset('assets/images/artikel12.png') }}" alt="Artikel 2">
                <div class="card-content">
                    <h3>Stres - Gejala, Penyebab, dan Pengobatan</h3>
                    <p>Kenali stres lebih dalam dan cara efektif untuk mengelolanya dengan sehat.</p>
                    <div class="info">
                        <span>5 Mei 2026</span>
                        <span class="dot"></span>
                        <span>5 min baca</span>
                    </div>
                </div>
            </div>

            <div class="card">
                <img src="{{ asset('assets/images/artikel11.png') }}" alt="Artikel 3">
                <div class="card-content">
                    <h3>7 Cara Mengatasi Overwhelmed agar Hidup Lebih Tenang</h3>
                    <p>Langkah-langkah sederhana untuk menjaga kesehatan mental saat merasa kewalahan.</p>
                    <div class="info">
                        <span>1 Mei 2026</span>
                        <span class="dot"></span>
                        <span>8 min baca</span>
                    </div>
                </div>
            </div>
        @endforelse

    </div>

</div>

@endsection