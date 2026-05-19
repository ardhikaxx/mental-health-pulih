@extends('layouts.dashboard', ['title' => 'Dashboard Psikolog'])

@section('content')
<div class="dashboard-header mb-4">
    <section class="hero-panel">
        <div class="hero-content">
            <p class="hero-greeting">Halo, {{ $psikolog->user->nama_lengkap }}</p>
            <h1>Selamat Datang Kembali</h1>
            <p>Siap untuk membantu pasien hari ini? Pantau jadwal dan kondisi mental pasien Anda di sini.</p>
        </div>
        <div class="hero-today-info">
            <div class="today-item">
                <i class="fa-solid fa-calendar-check"></i>
                <div class="info">
                    <span class="label">Sesi Hari Ini</span>
                    <span class="value">{{ $stats['hari_ini'] }} Sesi</span>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="grid grid-4 mb-5">
    <div class="card stat-card-premium">
        <div class="stat-icon-wrapper blue">
            <i class="fa-solid fa-calendar-day"></i>
        </div>
        <div class="stat-info">
            <span class="stat-label">Konsultasi Hari Ini</span>
            <span class="stat-value">{{ $stats['hari_ini'] }}</span>
        </div>
    </div>
    <div class="card stat-card-premium">
        <div class="stat-icon-wrapper green">
            <i class="fa-solid fa-users"></i>
        </div>
        <div class="stat-info">
            <span class="stat-label">Pasien Aktif</span>
            <span class="stat-value">{{ $stats['pasien'] }}</span>
        </div>
    </div>
    <div class="card stat-card-premium">
        <div class="stat-icon-wrapper purple">
            <i class="fa-solid fa-comment-dots"></i>
        </div>
        <div class="stat-info">
            <span class="stat-label">Chat Aktif</span>
            <span class="stat-value">{{ $stats['chat_aktif'] }}</span>
        </div>
    </div>
    <div class="card stat-card-premium">
        <div class="stat-icon-wrapper red">
            <i class="fa-solid fa-triangle-exclamation"></i>
        </div>
        <div class="stat-info">
            <span class="stat-label">Risiko Tinggi</span>
            <span class="stat-value">{{ $stats['risiko_tinggi'] }}</span>
        </div>
    </div>
</div>

<div class="grid grid-3" style="grid-template-columns: 2fr 1fr;">
    <div class="main-content-area grid" style="gap: 30px;">
        <!-- Jadwal Hari Ini -->
        <div class="card">
            <div class="section-header">
                <h2>Jadwal Konsultasi Hari Ini</h2>
                <a href="{{ route('psikolog.konsultasi.index') }}" class="btn btn-secondary">
                    <span>Lihat Semua Jadwal</span>
                </a>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Waktu</th>
                            <th>Pasien</th>
                            <th>Jenis</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($jadwalHariIni as $item)
                            <tr>
                                <td style="font-weight: 700; color: var(--primary-green);">
                                    <i class="fa-regular fa-clock" style="margin-right: 5px;"></i>
                                    {{ substr($item->waktu_mulai, 0, 5) }}
                                </td>
                                <td>
                                    <div class="user-cell">
                                        <div class="user-avatar-small"><i class="fa-solid fa-user"></i></div>
                                        <span>{{ $item->pasien->user->nama_lengkap ?? '-' }}</span>
                                    </div>
                                </td>
                                <td>{{ $item->jenis_konsultasi }}</td>
                                <td>
                                    <span class="badge badge-info">
                                        {{ ucfirst($item->status_konsultasi) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('psikolog.konsultasi.chat', $item) }}" class="btn btn-primary" style="padding: 8px 16px; border-radius: 10px;">
                                        <i class="fa-solid fa-comments"></i>
                                        <span>Mulai Chat</span>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="text-align: center; padding: 40px; color: var(--text-muted);">
                                    <i class="fa-regular fa-calendar-xmark" style="font-size: 40px; display: block; margin-bottom: 10px; opacity: 0.3;"></i>
                                    Tidak ada jadwal konsultasi untuk hari ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Ringkasan Pasien -->
        <div class="card">
            <div class="section-header">
                <h2>Ringkasan Kondisi Pasien</h2>
                <a href="{{ route('psikolog.pemantauan.index') }}" class="btn btn-secondary">
                    <span>Lihat Pemantauan</span>
                </a>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Pasien</th>
                            <th>Kondisi Terakhir</th>
                            <th>Skor</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($ringkasan as $item)
                            <tr>
                                <td style="font-weight: 700;">{{ $item->pasien->user->nama_lengkap ?? '-' }}</td>
                                <td>{{ $item->kondisi_terakhir }}</td>
                                <td style="font-weight: 800; font-size: 16px;">{{ $item->skor_terakhir }}</td>
                                <td>
                                    <span class="badge {{ $item->perubahan === 'memburuk' ? 'badge-danger' : 'badge-success' }}">
                                        <i class="fa-solid {{ $item->perubahan === 'memburuk' ? 'fa-arrow-down' : 'fa-arrow-up' }}" style="margin-right: 4px;"></i>
                                        {{ ucfirst($item->perubahan) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" style="text-align: center; padding: 40px; color: var(--text-muted);">
                                    Belum ada ringkasan pemantauan pasien.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="sidebar-content-area grid" style="gap: 30px;">
        <!-- Pasien Perlu Perhatian -->
        <div class="card" style="border-left: 5px solid #ef4444;">
            <h3 class="card-title" style="color: #ef4444;">Perlu Perhatian Segera</h3>
            <div class="attention-list">
                @forelse ($perhatian as $item)
                    <div class="attention-item">
                        <div class="attention-info">
                            <strong>{{ $item->pasien->user->nama_lengkap ?? '-' }}</strong>
                            <p>Skor skrining meningkat drastis</p>
                        </div>
                        <span class="badge {{ $item->prioritas === 'tinggi' ? 'badge-danger' : 'badge-warning' }}">
                            {{ ucfirst($item->prioritas) }}
                        </span>
                    </div>
                @empty
                    <p class="empty-text">Tidak ada pasien dengan prioritas tinggi saat ini.</p>
                @endforelse
            </div>
        </div>

        <!-- Notifikasi -->
        <div class="card">
            <h3 class="card-title">Notifikasi Terbaru</h3>
            <div class="notification-feed">
                @forelse ($notifikasi as $item)
                    <div class="notif-item">
                        <div class="notif-icon"><i class="fa-solid fa-bell"></i></div>
                        <div class="notif-body">
                            <strong>{{ $item->judul_notifikasi }}</strong>
                            <p>{{ $item->isi_notifikasi }}</p>
                            <span class="notif-time">Baru saja</span>
                        </div>
                    </div>
                @empty
                    <p class="empty-text">Belum ada notifikasi baru.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

<style>
    .mb-4 { margin-bottom: 24px; }
    .mb-5 { margin-bottom: 40px; }

    .hero-greeting { font-size: 18px; font-weight: 600; opacity: 0.9; margin-bottom: 5px; }
    .hero-today-info {
        background: rgba(255, 255, 255, 0.15);
        padding: 20px 30px;
        border-radius: 20px;
        backdrop-filter: blur(10px);
    }
    .today-item { display: flex; align-items: center; gap: 15px; }
    .today-item i { font-size: 32px; opacity: 0.8; }
    .today-item .label { font-size: 13px; font-weight: 700; text-transform: uppercase; opacity: 0.8; }
    .today-item .value { font-size: 24px; font-weight: 800; display: block; }

    /* Stat Cards */
    .stat-card-premium {
        display: flex;
        align-items: center;
        gap: 20px;
        padding: 25px;
    }
    .stat-icon-wrapper {
        width: 60px;
        height: 60px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }
    .stat-icon-wrapper.blue { background: #eff6ff; color: #3b82f6; }
    .stat-icon-wrapper.green { background: #f0fdf4; color: #22c55e; }
    .stat-icon-wrapper.purple { background: #f5f3ff; color: #8b5cf6; }
    .stat-icon-wrapper.red { background: #fef2f2; color: #ef4444; }

    .stat-info { display: flex; flex-direction: column; }
    .stat-label { font-size: 14px; font-weight: 600; color: var(--text-muted); margin-bottom: 4px; }
    .stat-value { font-size: 28px; font-weight: 800; color: var(--text-main); line-height: 1; }

    /* User Cell */
    .user-cell { display: flex; align-items: center; gap: 12px; }
    .user-avatar-small {
        width: 32px;
        height: 32px;
        background: #f1f5f9;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        color: #94a3b8;
    }

    /* Attention List */
    .attention-list { display: grid; gap: 15px; }
    .attention-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 15px;
        background: #fff;
        border-radius: 16px;
        border: 1px solid #f1f5f9;
        transition: all 0.2s;
    }
    .attention-item:hover { transform: translateX(5px); box-shadow: 0 4px 10px rgba(239, 68, 68, 0.05); }
    .attention-info strong { font-size: 14px; display: block; margin-bottom: 2px; }
    .attention-info p { font-size: 12px; color: var(--text-muted); }

    /* Notification Feed */
    .notification-feed { display: grid; gap: 20px; }
    .notif-item { display: flex; gap: 15px; }
    .notif-icon {
        width: 36px;
        height: 36px;
        background: #f8fafc;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary-green);
        flex-shrink: 0;
    }
    .notif-body strong { font-size: 14px; display: block; margin-bottom: 2px; }
    .notif-body p { font-size: 13px; color: var(--text-muted); line-height: 1.4; margin-bottom: 4px; }
    .notif-time { font-size: 11px; color: #94a3b8; font-weight: 600; }

    .empty-text { color: var(--text-muted); font-size: 14px; font-style: italic; text-align: center; padding: 10px 0; }

    @media (max-width: 1200px) {
        .grid-3 { grid-template-columns: 1fr !important; }
    }
    @media (max-width: 768px) {
        .hero-panel { flex-direction: column; align-items: flex-start; gap: 24px; }
        .hero-today-info { width: 100%; }
    }
</style>
@endsection
