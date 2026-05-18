<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Ruang Pulih' }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { background: #f8fbf8; color: #111; font-family: Arial, sans-serif; }
        a { color: inherit; text-decoration: none; }
        .public-wrap { width: min(1820px, calc(100% - 96px)); margin: 0 auto; }
        .public-nav { height: 92px; display: flex; align-items: center; justify-content: space-between; gap: 28px; }
        .brand { display: flex; align-items: center; gap: 16px; min-width: 330px; }
        .brand img { width: 72px; height: 72px; object-fit: contain; }
        .brand-title { font-size: 26px; font-weight: 800; }
        .brand-subtitle { color: #636363; font-size: 14px; font-weight: 700; margin-top: 4px; }
        .public-menu { display: flex; align-items: center; gap: 64px; font-size: 24px; }
        .public-menu a { padding: 10px 28px; border-radius: 10px; }
        .public-menu a.active { background: #b8efd4; }
        .login-link { border: 1px solid #005c34; border-radius: 14px; color: #005c34; display: inline-flex; align-items: center; gap: 10px; font-size: 22px; font-weight: 800; padding: 14px 24px; }
        .fa-inline { margin-right: 8px; }
        .hero { border-radius: 14px; background: linear-gradient(90deg, #cfffe0 0%, #a9edc7 42%, #55cda3 100%); display: grid; grid-template-columns: 1fr 0.9fr; min-height: 320px; overflow: hidden; padding: 54px 64px 0; margin-bottom: 10px; }
        .hero h1 { color: #005c34; font-size: 42px; line-height: 1.15; margin-bottom: 24px; }
        .hero p { color: #111; font-size: 22px; line-height: 1.35; max-width: 720px; }
        .hero-label { color: #005c34; font-size: 17px; font-weight: 800; margin-bottom: 12px; }
        .hero .btn { margin-top: 34px; }
        .hero-img { align-self: end; justify-self: end; width: min(620px, 100%); max-height: 320px; object-fit: contain; }
        .btn { border: 0; border-radius: 10px; background: #005c34; color: #fff; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; gap: 18px; font-size: 19px; font-weight: 700; padding: 16px 28px; }
        .btn-outline { background: #fff; border: 1px solid #9a9a9a; color: #222; }
        .section-title { font-size: 32px; font-weight: 800; margin: 28px 0 18px; }
        .grid-2 { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 24px; }
        .grid-3 { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 42px; }
        .grid-4 { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 22px; }
        .card { background: #fff; border: 1px solid #d7d7d7; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,.08); overflow: hidden; }
        .card-body { padding: 18px; }
        .muted { color: #666; }
        .search-bar { align-items: center; background: #fff; border: 1px solid #999; border-radius: 12px; display: flex; height: 76px; margin: 10px 0 16px; padding: 0 36px; }
        .search-bar input { border: 0; flex: 1; font-size: 25px; outline: 0; padding-left: 20px; }
        .tabs { display: flex; gap: 38px; flex-wrap: wrap; margin: 16px 0 26px; }
        .tabs a { border: 1px solid #999; border-radius: 28px; min-width: 204px; padding: 12px 24px; text-align: center; font-size: 24px; }
        .tabs a.active { background: #005c34; border-color: #005c34; color: #fff; }
        .article-card img, .video-card img { width: 100%; aspect-ratio: 16 / 9; object-fit: cover; display: block; }
        .article-card h3, .video-card h3 { font-size: 24px; line-height: 1.18; margin-bottom: 8px; }
        .article-meta { align-items: center; color: #666; display: flex; gap: 18px; font-size: 18px; margin-top: 16px; }
        .dot { width: 8px; height: 8px; border-radius: 50%; background: #666; display: inline-block; }
        .page-numbers { display: flex; justify-content: center; gap: 10px; margin: 34px 0 10px; }
        .page-numbers a, .page-numbers span { align-items: center; background: #fff; border: 1px solid #c8d7cf; border-radius: 10px; color: #005c34; display: inline-flex; font-size: 18px; font-weight: 800; height: 44px; justify-content: center; min-width: 44px; padding: 0 14px; }
        .page-numbers a:hover { background: #e8f8ef; border-color: #7dcaa4; }
        .page-numbers .active { background: #005c34; border-color: #005c34; color: #fff; box-shadow: 0 8px 18px rgba(0,92,52,.18); }
        .content-page { display: grid; grid-template-columns: minmax(0, 1fr) 340px; gap: 34px; margin-top: 24px; }
        .content-body { font-size: 19px; line-height: 1.7; }
        .content-body p { margin-bottom: 16px; }
        .content-cover { width: 100%; max-height: 460px; object-fit: cover; border-radius: 12px; margin: 16px 0 24px; }
        .footer-space { height: 40px; }
        @media (max-width: 1000px) {
            .public-wrap { width: min(100% - 28px, 900px); }
            .public-nav { height: auto; padding: 16px 0; flex-wrap: wrap; }
            .public-menu { order: 3; width: 100%; gap: 8px; justify-content: space-between; font-size: 17px; }
            .public-menu a { padding: 8px 12px; }
            .brand { min-width: 0; }
            .hero { grid-template-columns: 1fr; padding: 34px 24px 0; }
            .hero h1 { font-size: 34px; }
            .hero p { font-size: 18px; }
            .grid-2, .grid-3, .grid-4, .content-page { grid-template-columns: 1fr; }
            .tabs a { min-width: auto; flex: 1; font-size: 17px; }
            .login-link { font-size: 16px; padding: 10px 14px; }
        }
    </style>
</head>
<body>
    <div class="public-wrap">
        <nav class="public-nav">
            <a href="{{ route('home') }}" class="brand">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Ruang Pulih">
                <span>
                    <span class="brand-title">Ruang Pulih</span>
                    <span class="brand-subtitle">Tempat aman untuk kesehatan mentalmu</span>
                </span>
            </a>

            <div class="public-menu">
                <a class="{{ request()->routeIs('edukasi.*') ? 'active' : '' }}" href="{{ route('edukasi.index') }}"><i class="fa-solid fa-book-open fa-inline"></i>Edukasi</a>
                <a class="{{ request()->routeIs('about.*') ? 'active' : '' }}" href="{{ route('about.index') }}"><i class="fa-solid fa-circle-info fa-inline"></i>About</a>
                <a class="{{ request()->routeIs('bantuan.*') ? 'active' : '' }}" href="{{ route('bantuan.index') }}"><i class="fa-solid fa-headset fa-inline"></i>Bantuan</a>
            </div>

            @auth
                <a class="login-link" href="{{ route('dashboard') }}"><i class="fa-solid fa-table-columns"></i> Dashboard</a>
            @else
                <a class="login-link" href="{{ route('login') }}"><i class="fa-regular fa-circle-user"></i> Login / Daftar</a>
            @endauth
        </nav>

        @yield('content')
        <div class="footer-space"></div>
    </div>
</body>
</html>
