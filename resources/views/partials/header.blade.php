<style>
    .topbar { 
        background: #ffffff; border-bottom: 1px solid #e2e8f0; display: flex; 
        align-items: center; justify-content: space-between; padding: 0 32px; height: 72px;
    }
    .topbar-brand { display: flex; align-items: center; gap: 16px; font-size: 20px; font-weight: 800; color: #1a202c; text-decoration: none; }
    .topbar-brand img { width: 40px; height: 40px; border-radius: 12px; object-fit: contain; }
    .topbar-actions { display: flex; align-items: center; gap: 16px; }
    .topbar-btn { 
        background: #f7fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 10px 20px; 
        font-size: 14px; font-weight: 600; color: #4a5568; cursor: pointer; transition: all 0.3s;
    }
    .topbar-btn:hover { background: #fee2e2; border-color: #fecaca; color: #c53030; }
</style>

<header class="topbar">
    <a href="{{ route('dashboard') }}" class="topbar-brand">
        <img src="{{ asset('assets/images/logo.png') }}" alt="Ruang Pulih">
        <span>Ruang Pulih</span>
    </a>
    <div class="topbar-actions">
        <form class="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="topbar-btn" type="submit"><i class="fa-solid fa-right-from-bracket" style="margin-right: 8px;"></i> Logout</button>
        </form>
    </div>
</header>