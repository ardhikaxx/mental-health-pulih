<style>
    .topbar { 
        background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(12px);
        border-bottom: 1px solid #e2e8f0; display: flex; 
        align-items: center; justify-content: space-between; padding: 0 40px; height: 80px;
    }
    .topbar-brand { display: flex; align-items: center; gap: 20px; font-size: 22px; font-weight: 800; color: #1a202c; text-decoration: none; }
    .topbar-brand img { width: 48px; height: 48px; border-radius: 14px; object-fit: contain; box-shadow: 0 4px 12px rgba(0,92,52,0.1); }
    .topbar-actions { display: flex; align-items: center; gap: 20px; }
    .topbar-btn { 
        background: #fff; border: 1px solid #e2e8f0; border-radius: 14px; padding: 12px 24px; 
        font-size: 14px; font-weight: 700; color: #4a5568; cursor: pointer; transition: all 0.4s ease;
        display: flex; align-items: center; gap: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.02);
    }
    .topbar-btn:hover { background: #fee2e2; border-color: #fecaca; color: #c53030; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(239, 68, 68, 0.1); }
</style>

<header class="topbar">
    <a href="{{ route('dashboard') }}" class="topbar-brand">
        <img src="{{ asset('assets/images/logo.png') }}" alt="Ruang Pulih">
        <span>Ruang Pulih</span>
    </a>
    <div class="topbar-actions">
        <form class="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="topbar-btn" type="submit"><i class="fa-solid fa-right-from-bracket"></i> Logout</button>
        </form>
    </div>
</header>