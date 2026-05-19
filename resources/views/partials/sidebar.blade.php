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