<style>
    .sidebar { 
        background: #ffffff; border-right: 1px solid #e2e8f0; padding: 24px; 
        position: sticky; top: 0; height: calc(100vh - 80px); overflow-y: auto;
    }
    .profile-box { 
        text-align: center; padding: 32px 20px; margin-bottom: 32px;
        background: linear-gradient(145deg, #f8fafc, #edf2f7); border-radius: 20px;
        box-shadow: inset 0 2px 4px rgba(0,0,0,0.02);
    }
    .profile-avatar { 
        width: 72px; height: 72px; background: #ffffff; color: #005c34; border-radius: 50%;
        display: flex; align-items: center; justify-content: center; font-size: 36px; 
        margin: 0 auto 16px; border: 2px solid #e6fffa; box-shadow: 0 4px 12px rgba(0,92,52,0.1);
    }
    .profile-name { font-size: 17px; font-weight: 800; color: #1a202c; }
    .profile-role { font-size: 13px; color: #718096; margin-top: 6px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; }
    
    .nav-section { 
        font-size: 11px; font-weight: 800; color: #a0aec0; text-transform: uppercase;
        margin: 32px 0 16px; letter-spacing: 0.1em; padding-left: 16px;
    }
    .side-link { 
        display: flex; align-items: center; gap: 16px; padding: 14px 20px;
        border-radius: 16px; font-size: 15px; font-weight: 700; color: #4a5568;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); text-decoration: none; margin-bottom: 6px;
    }
    .side-link:hover { background: #f0fff4; color: #005c34; transform: translateX(4px); }
    .side-link.active { background: #005c34; color: #ffffff; box-shadow: 0 4px 12px rgba(0,92,52,0.2); }
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