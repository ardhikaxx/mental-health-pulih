@extends('layouts.public', ['title' => 'Tentang - Ruang Pulih'])

@section('content')
<section class="hero">
    <div>
        <div class="hero-label">Tentang Ruang Pulih</div>
        <h1>Tempat aman untuk kesehatan mentalmu.</h1>
        <p>Ruang Pulih hadir untuk menemani kamu dalam perjalanan memahami, menjaga, dan memulihkan kesehatan mental. Karena kamu tidak sendirian, dan setiap langkah kecil menuju pulih itu berarti.</p>
    </div>
    <img class="hero-img" src="{{ asset('assets/images/banner.png') }}" alt="Tentang Ruang Pulih">
</section>

<h2 class="section-title">Apa itu Ruang Pulih?</h2>
<div class="card card-body" style="background:#f1f5f3;">
    <p style="font-size:20px; line-height:1.65;">Ruang Pulih hadir sebagai ruang aman dan terpercaya untuk semua orang yang ingin hidup lebih seimbang secara mental dan emosional. Kami percaya bahwa setiap orang berhak mendapatkan informasi yang tepat, dukungan yang tulus, dan lingkungan yang positif untuk bertumbuh.</p>
</div>

<h2 class="section-title">Nilai Utama</h2>
<div class="grid-3">
    @foreach ([
        ['fa-shield-halved', 'Aman & Privat', 'Kerahasiaanmu adalah prioritas kami. Semua data dan informasi pribadi dilindungi dengan aman.'],
        ['fa-book-open-reader', 'Edukasi Terpercaya', 'Konten dibuat dengan pendekatan edukatif dan mudah dipahami.'],
        ['fa-heart', 'Dukungan untuk Semua', 'Untuk siapa pun, kapan pun. Kamu tidak sendirian, kami ada untuk mendukungmu.'],
    ] as [$icon, $judul, $teks])
        <div class="card card-body">
            <div style="align-items:center;background:#b8efd4;border-radius:50%;color:#005c34;display:flex;font-size:24px;height:54px;justify-content:center;margin-bottom:16px;width:54px;"><i class="fa-solid {{ $icon }}"></i></div>
            <h3 style="font-size:24px;color:#005c34;margin-bottom:10px;">{{ $judul }}</h3>
            <p class="muted" style="font-size:18px;line-height:1.5;">{{ $teks }}</p>
        </div>
    @endforeach
</div>

<h2 class="section-title">Fitur yang Tersedia</h2>
<div class="grid-4">
    @foreach ([
        ['fa-clipboard-list', 'Skrining Kesehatan Mental', 'Kenali kondisi mentalmu melalui tes skrining yang mudah dan cepat.'],
        ['fa-comments', 'Konsultasi Online', 'Bicarakan perasaanmu dengan psikolog profesional secara aman.'],
        ['fa-chart-line', 'Pemantauan Kondisi Mental', 'Pantau perkembangan emosimu dari waktu ke waktu.'],
        ['fa-newspaper', 'Edukasi & Informasi', 'Akses berbagai artikel, tips, dan video edukasi.'],
    ] as [$icon, $judul, $teks])
        <div class="card card-body">
            <div style="align-items:center;background:#b8efd4;border-radius:50%;color:#005c34;display:flex;font-size:22px;height:48px;justify-content:center;margin-bottom:14px;width:48px;"><i class="fa-solid {{ $icon }}"></i></div>
            <h3 style="font-size:20px;color:#005c34;margin-bottom:10px;">{{ $judul }}</h3>
            <p class="muted">{{ $teks }}</p>
        </div>
    @endforeach
</div>

<h2 class="section-title">Visi & Misi</h2>
<div class="grid-2">
    <div class="card card-body">
        <h3 style="font-size:24px;color:#005c34;margin-bottom:12px;"><i class="fa-solid fa-eye"></i> Visi</h3>
        <p class="muted" style="font-size:18px;line-height:1.55;">Menjadi platform terdepan dalam mendukung kesehatan mental masyarakat Indonesia melalui teknologi dan edukasi yang mudah diakses oleh semua.</p>
    </div>
    <div class="card card-body">
        <h3 style="font-size:24px;color:#005c34;margin-bottom:12px;"><i class="fa-solid fa-bullseye"></i> Misi</h3>
        <p class="muted" style="font-size:18px;line-height:1.55;">Meningkatkan literasi kesehatan mental, menyediakan akses dukungan yang mudah, dan membangun komunitas yang peduli.</p>
    </div>
</div>

<div class="card card-body" style="background:#e8f5f0;margin-top:28px;text-align:center;">
    <h2 style="font-size:30px;color:#005c34;margin-bottom:10px;">Kesehatan mental adalah bagian penting dari hidup yang berkualitas.</h2>
    <p class="muted" style="font-size:18px;">Yuk, mulai perjalanan pulihmu bersama Ruang Pulih hari ini.</p>
</div>
@endsection
