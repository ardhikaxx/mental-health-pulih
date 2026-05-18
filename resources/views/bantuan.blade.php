@extends('layouts.public', ['title' => 'Bantuan - Ruang Pulih'])

@section('content')
<section class="hero">
    <div>
        <h1>Bantuan untukmu</h1>
        <p>Kami siap membantumu kapan pun kamu membutuhkan bantuan. Pilih jenis bantuan yang sesuai dengan kebutuhanmu.</p>
    </div>
    <img class="hero-img" src="{{ asset('assets/images/banner.png') }}" alt="Bantuan Ruang Pulih">
</section>

@php
    $cards = [
        ['fa-phone-volume', 'Bantuan Darurat', 'Bantuan cepat untuk kondisi emosional darurat atau dukungan segera.', ['Kontak layanan darurat']],
        ['fa-shield-halved', 'Keamanan Akun', 'Membantu menjaga keamanan akun agar tetap aman.', ['Ganti kata sandi', 'Verifikasi akun', 'Aktivitas login mencurigakan']],
        ['fa-key', 'Reset Kata Sandi', 'Bantuan untuk memulihkan akses akun jika lupa kata sandi.', ['Lupa password', 'Reset melalui email']],
        ['fa-circle-question', 'Pusat Bantuan', 'Kumpulan informasi untuk menggunakan aplikasi dengan mudah.', ['FAQ', 'Informasi akun']],
        ['fa-bug', 'Laporkan Masalah', 'Laporkan kendala atau aktivitas yang tidak sesuai di dalam aplikasi.', ['Laporkan bug aplikasi', 'Konten tidak pantas', 'Penyalahgunaan akun']],
        ['fa-message', 'Saran & Masukan', 'Berikan masukan untuk meningkatkan kualitas aplikasi.', ['Kritik & saran', 'Penilaian layanan']],
    ];
@endphp

<div class="grid-3" style="margin-top:26px;">
    @foreach ($cards as [$icon, $judul, $teks, $items])
        <div class="card card-body">
            <div style="align-items:center;background:#b8efd4;border-radius:50%;color:#005c34;display:flex;font-size:26px;height:62px;justify-content:center;margin-bottom:18px;width:62px;"><i class="fa-solid {{ $icon }}"></i></div>
            <h2 style="font-size:24px;color:#005c34;margin-bottom:10px;">{{ $judul }}</h2>
            <p class="muted" style="font-size:17px;line-height:1.45;min-height:74px;">{{ $teks }}</p>
            <hr style="border:0;border-top:1px solid #e5e5e5;margin:18px 0;">
            @foreach ($items as $item)
                <div style="padding:5px 0;"><i class="fa-solid fa-check" style="color:#005c34;margin-right:8px;"></i>{{ $item }}</div>
            @endforeach
            <a href="{{ $judul === 'Reset Kata Sandi' ? route('login') : '#' }}" class="btn" style="margin-top:18px;border-radius:50%;width:44px;height:44px;padding:0;float:right;"><i class="fa-solid fa-arrow-right"></i></a>
        </div>
    @endforeach
</div>
@endsection
