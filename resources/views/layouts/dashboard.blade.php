<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard Ruang Pulih' }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { background: #f5fbf7; color: #101010; font-family: Arial, sans-serif; }
        a { color: inherit; text-decoration: none; }
        button, input, select, textarea { font: inherit; }
        .shell { min-height: 100vh; padding: 18px; }
        .topbar { align-items: center; background: #4e946d; border-radius: 10px; display: flex; height: 78px; justify-content: space-between; padding: 0 24px; }
        .topbar-brand { align-items: center; color: #fff; display: flex; gap: 16px; font-size: 32px; font-weight: 800; }
        .topbar-brand img { background: #fff; border-radius: 50%; height: 56px; object-fit: contain; padding: 4px; width: 56px; }
        .topbar-actions { align-items: center; display: flex; gap: 14px; }
        .topbar-btn { background: #b8efd4; border: 1px solid #1f5e43; border-radius: 10px; padding: 12px 24px; }
        .logout-form { display: inline; }
        .layout { display: grid; grid-template-columns: 320px minmax(0, 1fr); gap: 18px; margin-top: 14px; }
        .sidebar { background: #58d0a7; border-radius: 12px; min-height: calc(100vh - 128px); overflow: hidden; padding: 18px; position: sticky; top: 14px; }
        .profile-box { align-items: center; background: rgba(255,255,255,.14); border-radius: 12px; display: flex; flex-direction: column; gap: 8px; min-height: 145px; justify-content: center; margin-bottom: 18px; text-align: center; }
        .profile-avatar { align-items: center; background: #0b0b0b; border-radius: 50%; color: #55cda3; display: flex; font-size: 30px; height: 58px; justify-content: center; width: 58px; }
        .profile-name { font-size: 22px; font-weight: 800; }
        .profile-role { font-size: 15px; }
        .nav-section { color: #175138; font-size: 13px; font-weight: 800; margin: 20px 10px 8px; text-transform: uppercase; }
        .side-link { align-items: center; border-radius: 10px; display: flex; gap: 12px; margin-bottom: 8px; padding: 13px 14px; }
        .side-link.active, .side-link:hover { background: #cfffdd; }
        .side-icon { width: 24px; text-align: center; }
        .content { min-width: 0; }
        .hero-panel { background: linear-gradient(90deg, #2e8b57, #5dd5b1); border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,.16); color: #fff; margin-bottom: 18px; min-height: 150px; padding: 36px; }
        .hero-panel h1 { font-size: 38px; margin-bottom: 8px; }
        .hero-panel p { font-size: 20px; }
        .grid { display: grid; gap: 16px; }
        .grid-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        .grid-3 { grid-template-columns: repeat(3, minmax(0, 1fr)); }
        .grid-4 { grid-template-columns: repeat(4, minmax(0, 1fr)); }
        .main-grid { display: grid; gap: 18px; grid-template-columns: minmax(0, 1fr) 340px; }
        .card { background: #fff; border: 1px solid #dfdfdf; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,.12); padding: 20px; }
        .stat-card { align-items: center; display: flex; gap: 16px; min-height: 96px; }
        .stat-icon { align-items: center; background: #aeecc8; border-radius: 10px; display: flex; font-size: 24px; height: 56px; justify-content: center; width: 56px; }
        .stat-value { font-size: 30px; font-weight: 800; line-height: 1; }
        .stat-label { font-size: 14px; font-weight: 700; margin-bottom: 8px; }
        .section-head { align-items: center; display: flex; justify-content: space-between; gap: 14px; margin-bottom: 14px; }
        .section-head h2 { font-size: 22px; }
        .btn { align-items: center; background: #1e6b46; border: 0; border-radius: 8px; color: #fff; cursor: pointer; display: inline-flex; gap: 8px; justify-content: center; padding: 10px 14px; }
        .btn.secondary { background: #e9f8ef; color: #135c3b; }
        .btn.danger { background: #ef4444; }
        .btn.muted { background: #e5e7eb; color: #333; }
        .btn.full { width: 100%; }
        .filters { display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 14px; }
        .input, .select, .textarea { border: 1px solid #cfcfcf; border-radius: 8px; outline: 0; padding: 11px 12px; width: 100%; }
        .textarea { min-height: 110px; resize: vertical; }
        .form-grid { display: grid; gap: 12px; grid-template-columns: repeat(2, minmax(0, 1fr)); }
        .form-grid .span-2 { grid-column: 1 / -1; }
        .field label { display: block; font-weight: 800; margin-bottom: 6px; }
        .table-wrap { overflow-x: auto; }
        table { border-collapse: collapse; width: 100%; }
        th { background: #bfe1d5; color: #185d3d; font-size: 13px; text-align: left; text-transform: uppercase; }
        th, td { border-bottom: 1px solid #cfebe0; padding: 12px; vertical-align: top; }
        td { font-size: 14px; }
        .badge { border-radius: 7px; display: inline-block; font-size: 13px; font-weight: 800; padding: 5px 10px; }
        .badge.green { background: #c8f7d0; color: #0f6b37; }
        .badge.yellow { background: #f7e8b5; color: #6c5300; }
        .badge.red { background: #ffd6db; color: #c8102e; }
        .badge.blue { background: #dbeafe; color: #1d4ed8; }
        .badge.gray { background: #e5e7eb; color: #4b5563; }
        .actions { display: flex; flex-wrap: wrap; gap: 7px; }
        .alert { border-radius: 8px; margin-bottom: 14px; padding: 12px 14px; }
        .alert.success { background: #dcfce7; color: #166534; }
        .alert.error { background: #fee2e2; color: #991b1b; }
        .alert.info { background: #dbeafe; color: #1e40af; }
        .modal { align-items: center; background: rgba(0,0,0,.42); display: none; inset: 0; justify-content: center; padding: 24px; position: fixed; z-index: 20; }
        .modal:target { display: flex; }
        .modal-card { background: #fff; border-radius: 10px; max-height: 90vh; max-width: 840px; overflow: auto; padding: 24px; width: 100%; }
        .modal-head { align-items: center; display: flex; justify-content: space-between; margin-bottom: 14px; }
        .empty { color: #777; padding: 18px 0; text-align: center; }
        .timeline { display: grid; gap: 12px; }
        .timeline-row { display: grid; gap: 14px; grid-template-columns: 76px minmax(0, 1fr) 24px; }
        .chat-box { background: #f7fbf8; border: 1px solid #dce9e1; border-radius: 10px; display: grid; gap: 10px; max-height: 520px; overflow: auto; padding: 16px; }
        .chat-message { border-radius: 10px; max-width: 70%; padding: 10px 12px; }
        .chat-message.me { background: #55cda3; justify-self: end; }
        .chat-message.other { background: #fff; border: 1px solid #d6d6d6; }
        .chart-bars { align-items: end; display: flex; gap: 8px; height: 180px; padding-top: 16px; }
        .bar { background: #55cda3; border-radius: 6px 6px 0 0; flex: 1; min-width: 18px; }
        .pagination { margin-top: 14px; }
        @media (max-width: 1100px) {
            .layout, .main-grid { grid-template-columns: 1fr; }
            .sidebar { min-height: auto; position: static; }
            .grid-4, .grid-3, .grid-2, .form-grid { grid-template-columns: 1fr; }
            .topbar { height: auto; flex-wrap: wrap; gap: 12px; padding: 16px; }
        }
    </style>
</head>
<body>
@php
    $user = auth()->user();
    $role = $user?->role ?? 'pasien';
    $menus = [
        'admin' => [
            ['label' => 'Home', 'route' => 'admin.dashboard', 'match' => 'admin.dashboard', 'section' => null, 'icon' => 'fa-house'],
            ['label' => 'Edukasi', 'route' => 'admin.edukasi.index', 'match' => 'admin.edukasi.*', 'section' => 'Management Konten', 'icon' => 'fa-newspaper'],
            ['label' => 'Pasien', 'route' => 'admin.pasien.index', 'match' => 'admin.pasien.*', 'section' => 'Management User', 'icon' => 'fa-users'],
            ['label' => 'Psikolog', 'route' => 'admin.psikolog.index', 'match' => 'admin.psikolog.*', 'section' => null, 'icon' => 'fa-user-doctor'],
            ['label' => 'Admin', 'route' => 'admin.admin.index', 'match' => 'admin.admin.*', 'section' => null, 'icon' => 'fa-user-shield'],
            ['label' => 'Skrining', 'route' => 'admin.skrining.index', 'match' => 'admin.skrining.*', 'section' => 'Layanan', 'icon' => 'fa-clipboard-question'],
        ],
        'psikolog' => [
            ['label' => 'Home', 'route' => 'psikolog.dashboard', 'match' => 'psikolog.dashboard', 'section' => null, 'icon' => 'fa-house'],
            ['label' => 'Konsultasi Online', 'route' => 'psikolog.konsultasi.index', 'match' => 'psikolog.konsultasi.*', 'section' => null, 'icon' => 'fa-comments'],
            ['label' => 'Pemantauan Kondisi Mental', 'route' => 'psikolog.pemantauan.index', 'match' => 'psikolog.pemantauan.*', 'section' => null, 'icon' => 'fa-chart-line'],
        ],
        'pasien' => [
            ['label' => 'Home', 'route' => 'pasien.dashboard', 'match' => 'pasien.dashboard', 'section' => null, 'icon' => 'fa-house'],
            ['label' => 'Skrining Kesehatan Mental', 'route' => 'pasien.skrining.index', 'match' => 'pasien.skrining.*', 'section' => null, 'icon' => 'fa-clipboard-list'],
            ['label' => 'Konsultasi Online', 'route' => 'pasien.konsultasi.index', 'match' => 'pasien.konsultasi.*', 'section' => null, 'icon' => 'fa-comment-dots'],
            ['label' => 'Pemantauan Kondisi Mental', 'route' => 'pasien.pemantauan.index', 'match' => 'pasien.pemantauan.*', 'section' => null, 'icon' => 'fa-chart-simple'],
            ['label' => 'Profil', 'route' => 'pasien.profile.edit', 'match' => 'pasien.profile.*', 'section' => null, 'icon' => 'fa-user'],
        ],
    ];
    $printedSection = null;
@endphp
<div class="shell">
    <header class="topbar">
        <a href="{{ route('dashboard') }}" class="topbar-brand">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Ruang Pulih">
            <span>Ruang Pulih</span>
        </a>
        <div class="topbar-actions">
            <a class="topbar-btn" href="{{ route('about.index') }}"><i class="fa-solid fa-circle-info"></i> About</a>
            <a class="topbar-btn" href="{{ route('bantuan.index') }}"><i class="fa-solid fa-headset"></i> Bantuan</a>
            <form class="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="topbar-btn" type="submit"><i class="fa-solid fa-right-from-bracket"></i> Logout</button>
            </form>
        </div>
    </header>

    <div class="layout">
        <aside class="sidebar">
            <div class="profile-box">
                <div class="profile-avatar"><i class="fa-solid fa-circle-user"></i></div>
                <div class="profile-name">{{ $user?->nama_lengkap ?? 'Pengguna' }}</div>
                <div class="profile-role">{{ ucfirst($role) }}</div>
            </div>

            @foreach ($menus[$role] ?? $menus['pasien'] as $menu)
                @if ($menu['section'] && $printedSection !== $menu['section'])
                    <div class="nav-section">{{ $menu['section'] }}</div>
                    @php $printedSection = $menu['section']; @endphp
                @endif
                <a class="side-link {{ request()->routeIs($menu['match']) ? 'active' : '' }}" href="{{ route($menu['route']) }}">
                    <span class="side-icon"><i class="fa-solid {{ $menu['icon'] }}"></i></span>
                    <span>{{ $menu['label'] }}</span>
                </a>
            @endforeach
        </aside>

        <main class="content">
            @if (session('success'))
                <div class="alert success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert error">{{ session('error') }}</div>
            @endif
            @if (session('info'))
                <div class="alert info">{{ session('info') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert error">{{ $errors->first() }}</div>
            @endif

            @yield('content')
        </main>
    </div>
</div>
@stack('scripts')
</body>
</html>
