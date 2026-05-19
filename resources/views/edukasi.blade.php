@extends('layouts.app')

@section('content')

<style>
    .edukasi-container { width: min(1200px, 100% - 48px); margin: 0 auto; padding: 24px 0 60px; }

    /* Search Box Premium */
    .search-box {
        height: 72px;
        margin: 40px 0 32px;
        background: #fff;
        border-radius: 20px;
        display: flex;
        align-items: center;
        padding: 0 32px;
        border: 2px solid transparent;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.08), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    }
    .search-box:focus-within {
        border-color: #005c34;
        box-shadow: 0 0 0 4px rgba(0, 92, 52, 0.15);
        transform: translateY(-2px);
    }
    .search-box i { color: #005c34; font-size: 22px; }
    .search-box input {
        width: 100%; border: none; outline: none; font-size: 18px; margin-left: 20px; color: #2d3748;
    }
    .search-box input::placeholder { color: #a0aec0; }

    /* Filter Pills Premium */
    .category { display: flex; gap: 16px; margin-bottom: 40px; flex-wrap: wrap; }
    .category button {
        padding: 12px 28px;
        border-radius: 50px;
        border: 2px solid #edf2f7;
        background: #fff;
        font-size: 16px;
        font-weight: 600;
        color: #718096;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex; align-items: center;
    }
    .category button:hover {
        border-color: #005c34;
        color: #005c34;
        background: #f0fdf4;
    }
    .category .selected {
        background: linear-gradient(135deg, #005c34 0%, #007a45 100%);
        color: #fff;
        border: none;
        box-shadow: 0 4px 15px rgba(0, 92, 52, 0.3);
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