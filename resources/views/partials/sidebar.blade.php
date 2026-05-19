<style>
    .sidebar { 
        background: #ffffff; border-right: 1px solid #e2e8f0; padding: 24px; 
        position: sticky; top: 0; height: calc(100vh - 72px); overflow-y: auto;
    }
    .profile-box { 
        text-align: center; padding: 24px 16px; margin-bottom: 24px;
        background: #f8fafc; border-radius: 16px;
    }
    .profile-avatar { 
        width: 64px; height: 64px; background: #e6fffa; color: #005c34; border-radius: 50%;
        display: flex; align-items: center; justify-content: center; font-size: 32px; margin: 0 auto 12px;
    }
    .profile-name { font-size: 16px; font-weight: 700; color: #1a202c; }
    .profile-role { font-size: 13px; color: #718096; margin-top: 4px; }
    
    .nav-section { 
        font-size: 11px; font-weight: 800; color: #a0aec0; text-transform: uppercase;
        margin: 24px 0 12px; letter-spacing: 0.05em; padding-left: 12px;
    }
    .side-link { 
        display: flex; align-items: center; gap: 14px; padding: 12px 16px;
        border-radius: 12px; font-size: 14px; font-weight: 600; color: #4a5568;
        transition: all 0.3s; text-decoration: none; margin-bottom: 4px;
    }
    .side-link:hover { background: #f0fff4; color: #005c34; }
    .side-link.active { background: #005c34; color: #ffffff; }
    .side-icon { width: 20px; text-align: center; font-size: 16px; }
</style>

<aside class="sidebar">
    <div class="profile-box">
        <div class="profile-avatar"><i class="fa-solid fa-user-circle"></i></div>
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