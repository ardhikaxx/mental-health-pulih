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