@extends('layouts.public', ['title' => 'Tentang - Ruang Pulih'])

@section('content')
<style>
    .about-wrapper { margin: 64px 0; }
    .section-title { font-size: 36px; font-weight: 800; color: #1a202c; margin-bottom: 48px; text-align: center; }
    
    .about-card { 
        background: #ffffff; border: 1px solid #e2e8f0; border-radius: 24px; padding: 40px; 
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1); 
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.03); 
    }
    .about-card:hover { transform: translateY(-8px); box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1); border-color: #005c3422; }
    
    .icon-box { 
        width: 64px; height: 64px; background: linear-gradient(135deg, #e6fffa 0%, #b2f5ea 100%); 
        border-radius: 20px; color: #005c34; display: flex; align-items: center; justify-content: center; 
        font-size: 28px; margin-bottom: 28px;
    }
    .card-title { font-size: 22px; font-weight: 700; color: #1a202c; margin-bottom: 16px; }
    .card-text { font-size: 16px; color: #4a5568; line-height: 1.7; }
    
    .grid-3 { display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 32px; }
    .grid-4 { display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 24px; }
    .grid-2 { display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 32px; }

    .cta-banner { 
        background: linear-gradient(135deg, #005c34 0%, #007a45 100%); 
        color: #ffffff; margin-top: 80px; text-align: center; padding: 64px 40px; border-radius: 32px;
    }
</style>

<section class="hero">
    <div>
        <div class="hero-label">Tentang Ruang Pulih</div>
        <h1>Tempat aman untuk kesehatan mentalmu.</h1>
        <p>Ruang Pulih hadir untuk menemani kamu dalam perjalanan memahami, menjaga, dan memulihkan kesehatan mental. Karena kamu tidak sendirian, dan setiap langkah kecil menuju pulih itu berarti.</p>
    </div>
    <img class="hero-img" src="{{ asset('assets/images/banner.png') }}" alt="Tentang Ruang Pulih">
</section>

<div class="about-wrapper">
    <h2 class="section-title">Apa itu Ruang Pulih?</h2>
    <div class="about-card" style="background:#f8fafc; text-align:center; padding: 64px;">
        <p style="font-size:22px; line-height:1.75; color:#2d3748; max-width: 800px; margin: 0 auto; font-weight: 500;">Ruang Pulih hadir sebagai ruang aman dan terpercaya untuk semua orang yang ingin hidup lebih seimbang secara mental dan emosional. Kami percaya bahwa setiap orang berhak mendapatkan informasi yang tepat, dukungan yang tulus, dan lingkungan yang positif untuk bertumbuh.</p>
    </div>

    <h2 class="section-title">Nilai Utama</h2>
    <div class="grid-3">
        @foreach ([
            ['fa-shield-halved', 'Aman & Privat', 'Kerahasiaanmu adalah prioritas kami. Semua data dan informasi pribadi dilindungi dengan aman.'],
            ['fa-book-open-reader', 'Edukasi Terpercaya', 'Konten dibuat dengan pendekatan edukatif dan mudah dipahami.'],
            ['fa-heart', 'Dukungan untuk Semua', 'Untuk siapa pun, kapan pun. Kamu tidak sendirian, kami ada untuk mendukungmu.'],
        ] as [$icon, $judul, $teks])
            <div class="about-card">
                <div class="icon-box"><i class="fa-solid {{ $icon }}"></i></div>
                <h3 class="card-title">{{ $judul }}</h3>
                <p class="card-text">{{ $teks }}</p>
            </div>
        @endforeach
    </div>

    <h2 class="section-title">Fitur Kami</h2>
    <div class="grid-4">
        @foreach ([
            ['fa-clipboard-list', 'Skrining Kesehatan Mental', 'Tes skrining yang mudah dan cepat.'],
            ['fa-comments', 'Konsultasi Online', 'Bicara dengan psikolog profesional.'],
            ['fa-chart-line', 'Pemantauan Kondisi', 'Pantau perkembangan emosimu.'],
            ['fa-newspaper', 'Edukasi & Informasi', 'Artikel, tips, dan video edukasi.'],
        ] as [$icon, $judul, $teks])
            <div class="about-card" style="padding: 28px;">
                <div class="icon-box" style="width:52px; height:52px; font-size:20px; margin-bottom:20px;"><i class="fa-solid {{ $icon }}"></i></div>
                <h3 class="card-title" style="font-size:18px;">{{ $judul }}</h3>
                <p class="card-text" style="font-size:14px; line-height:1.6;">{{ $teks }}</p>
            </div>
        @endforeach
    </div>

    <h2 class="section-title">Visi & Misi</h2>
    <div class="grid-2">
        <div class="about-card">
            <h3 class="card-title" style="color:#005c34;"><i class="fa-solid fa-eye" style="margin-right:10px;"></i> Visi</h3>
            <p class="card-text">Menjadi platform terdepan dalam mendukung kesehatan mental masyarakat Indonesia melalui teknologi dan edukasi yang mudah diakses oleh semua.</p>
        </div>
        <div class="about-card">
            <h3 class="card-title" style="color:#005c34;"><i class="fa-solid fa-bullseye" style="margin-right:10px;"></i> Misi</h3>
            <p class="card-text">Meningkatkan literasi kesehatan mental, menyediakan akses dukungan yang mudah, dan membangun komunitas yang peduli.</p>
        </div>
    </div>

    <div class="cta-banner">
        <h2 style="font-size:36px; margin-bottom:16px; font-weight:800;">Kesehatan mental adalah bagian penting dari hidup yang berkualitas.</h2>
        <p style="font-size:20px; color:#c6f6d5; max-width: 600px; margin: 0 auto;">Yuk, mulai perjalanan pulihmu bersama Ruang Pulih hari ini. Kamu tidak sendirian.</p>
    </div>
</div>
@endsection
