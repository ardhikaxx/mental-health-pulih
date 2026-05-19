<style>
    .sidebar { 
        background: #005c34; border-right: 1px solid #004a29; padding: 24px; 
        position: sticky; top: 0; height: 100vh; overflow-y: hidden;
    }
    .profile-box { 
        text-align: center; padding: 32px 20px; margin-bottom: 32px;
        background: rgba(255, 255, 255, 0.1); border-radius: 20px;
    }
    .profile-avatar { 
        width: 72px; height: 72px; background: #ffffff; color: #005c34; border-radius: 50%;
        display: flex; align-items: center; justify-content: center; font-size: 36px; 
        margin: 0 auto 16px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .profile-name { font-size: 17px; font-weight: 800; color: #ffffff; }
    .profile-role { font-size: 13px; color: #c6f6d5; margin-top: 6px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; }
    
    .nav-section { 
        font-size: 11px; font-weight: 800; color: #b2f5ea; text-transform: uppercase;
        margin: 32px 0 16px; letter-spacing: 0.1em; padding-left: 16px;
    }
    .side-link { 
        display: flex; align-items: center; gap: 16px; padding: 14px 20px;
        border-radius: 16px; font-size: 15px; font-weight: 700; color: #e6fffa;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); text-decoration: none; margin-bottom: 6px;
    }
    .side-link:hover { background: rgba(255, 255, 255, 0.15); color: #ffffff; transform: translateX(4px); }
    .side-link.active { background: #ffffff; color: #005c34; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
    .side-icon { width: 22px; text-align: center; font-size: 18px; }
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