@extends('layouts.dashboard', ['title' => 'Dashboard Pasien'])

@section('content')
<div class="dashboard-header mb-4">
    <section class="hero-panel">
        <div class="hero-content">
            <p class="hero-greeting">Selamat Pagi, {{ auth()->user()->nama_lengkap }}</p>
            <h1>Bagaimana Perasaanmu Hari Ini?</h1>
            <p>Setiap langkah kecil sangat berarti. Yuk, luangkan waktu sejenak untuk mengecek kondisi mentalmu.</p>
        </div>
        <div class="hero-quote-box">
            <i class="fa-solid fa-quote-left"></i>
            <p>"Kesehatan mental bukan tujuan, melainkan sebuah proses."</p>
        </div>
    </section>
</div>

<div class="grid grid-3" style="grid-template-columns: 2fr 1fr;">
    <div class="main-content-area grid" style="gap: 30px;">
        <!-- Mood Selector -->
        <div class="card mood-tracker-card">
            <div class="section-header">
                <div>
                    <h2>Mood Tracker</h2>
                    <p style="color: var(--text-muted); font-size: 14px;">Catat suasana hatimu hari ini untuk memantau progresmu.</p>
                </div>
            </div>
            
            <form method="POST" action="{{ route('pasien.dashboard.mood') }}" class="mood-form">
                @csrf
                <div class="mood-options">
                    @foreach ([
                        ['Sangat Baik', 'sangatbaik.png', 'excellent'],
                        ['Baik', 'baik.png', 'good'],
                        ['Biasa Saja', 'biasasaja.png', 'neutral'],
                        ['Tidak Baik', 'tidakbaik.png', 'bad'],
                        ['Sangat Buruk', 'sangatburuk.png', 'awful'],
                    ] as [$mood, $img, $class])
                        <label class="mood-item {{ $class }} {{ $moodHariIni?->mood === $mood ? 'selected' : '' }}">
                            <input type="radio" name="mood" value="{{ $mood }}" @checked($moodHariIni?->mood === $mood) required>
                            <div class="mood-emoji-wrapper">
                                <img src="{{ asset('assets/images/'.$img) }}" alt="{{ $mood }}">
                            </div>
                            <span class="mood-label">{{ $mood }}</span>
                        </label>
                    @endforeach
                </div>
                
                <div class="form-group mt-4">
                    <label class="form-label">Apa yang membuatmu merasa demikian? (Opsional)</label>
                    <textarea class="form-control" name="catatan" rows="3" placeholder="Tuliskan sedikit tentang harimu...">{{ $moodHariIni?->catatan }}</textarea>
                </div>
                
                <div style="display: flex; justify-content: flex-end;">
                    <button class="btn btn-primary" type="submit">
                        <i class="fa-solid fa-heart-pulse"></i>
                        <span>Simpan Mood Hari Ini</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Activity Timeline -->
        <div class="card">
            <div class="section-header">
                <h2>Riwayat Aktivitas</h2>
                <span class="badge badge-info">Terbaru</span>
            </div>
            <div class="timeline-container">
                @forelse ($aktivitas as $item)
                    <div class="timeline-item">
                        <div class="timeline-time">
                            <span class="hour">{{ optional($item->tanggal_aktivitas)->format('H:i') }}</span>
                            <span class="date">{{ optional($item->tanggal_aktivitas)->format('d M') }}</span>
                        </div>
                        <div class="timeline-point"></div>
                        <div class="timeline-content">
                            <div class="activity-type">{{ str_replace('_', ' ', $item->jenis_aktivitas) }}</div>
                            <p class="activity-desc">{{ $item->keterangan }}</p>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <i class="fa-solid fa-wind"></i>
                        <p>Belum ada aktivitas yang tercatat.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="sidebar-content-area grid" style="gap: 30px;">
        <!-- Wellness Tips -->
        <div class="card wellness-card">
            <div class="wellness-icon"><i class="fa-solid fa-leaf"></i></div>
            <h3 class="card-title">Tips Kesehatan Mental</h3>
            <p class="wellness-text">Luangkan waktu 10 menit untuk bernapas dalam dan bersyukur atas 3 hal kecil yang terjadi hari ini.</p>
            <div class="wellness-footer">
                <i class="fa-solid fa-sparkles"></i>
                <span>Tetap Semangat!</span>
            </div>
        </div>

        <!-- Notifications -->
        <div class="card">
            <h3 class="card-title">Pesan & Notifikasi</h3>
            <div class="notification-list">
                @forelse ($notifikasi as $item)
                    <div class="notif-card">
                        <div class="notif-header">
                            <span class="notif-title">{{ $item->judul_notifikasi }}</span>
                            <span class="notif-dot"></span>
                        </div>
                        <p class="notif-desc">{{ $item->isi_notifikasi }}</p>
                    </div>
                @empty
                    <p class="empty-text">Tidak ada notifikasi baru untuk Anda.</p>
                @endforelse
            </div>
        </div>

        <!-- Support Card -->
        <div class="card support-card">
            <div class="support-content">
                <h3>Butuh Bantuan?</h3>
                <p>Psikolog kami siap mendengarkan dan membantumu.</p>
                <a href="{{ route('pasien.konsultasi.index') }}" class="btn btn-secondary w-full" style="background: #fff; color: var(--primary-green);">
                    <span>Mulai Konsultasi</span>
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    .mb-4 { margin-bottom: 24px; }
    .mt-4 { margin-top: 24px; }
    .w-full { width: 100%; }

    .hero-greeting { font-size: 18px; font-weight: 600; opacity: 0.9; margin-bottom: 5px; }
    .hero-quote-box {
        max-width: 300px;
        background: rgba(255, 255, 255, 0.1);
        padding: 20px;
        border-radius: 20px;
        font-style: italic;
        position: relative;
    }
    .hero-quote-box i { position: absolute; top: 10px; left: 10px; opacity: 0.2; font-size: 24px; }
    .hero-quote-box p { font-size: 14px; margin: 0; position: relative; z-index: 1; }

    /* Mood Tracker */
    .mood-options {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 15px;
        margin: 25px 0;
    }
    .mood-item {
        cursor: pointer;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 12px;
        padding: 20px 10px;
        border-radius: 20px;
        border: 2px solid transparent;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        background: #f8fafc;
    }
    .mood-item input { display: none; }
    .mood-emoji-wrapper {
        width: 60px;
        height: 60px;
        transition: transform 0.3s;
    }
    .mood-emoji-wrapper img { width: 100%; height: 100%; object-fit: contain; }
    .mood-label { font-size: 13px; font-weight: 700; color: var(--text-muted); transition: color 0.3s; }

    .mood-item:hover { transform: translateY(-5px); background: #fff; border-color: #e2e8f0; }
    .mood-item:hover .mood-emoji-wrapper { transform: scale(1.1); }

    .mood-item.selected { background: #fff; transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.05); }
    .mood-item.selected.excellent { border-color: #22c55e; }
    .mood-item.selected.good { border-color: #86efac; }
    .mood-item.selected.neutral { border-color: #fcd34d; }
    .mood-item.selected.bad { border-color: #f87171; }
    .mood-item.selected.awful { border-color: #ef4444; }
    .mood-item.selected .mood-label { color: var(--text-main); }

    /* Timeline */
    .timeline-container { display: grid; gap: 0; position: relative; padding-left: 20px; }
    .timeline-container::before {
        content: '';
        position: absolute;
        left: 85px;
        top: 0;
        bottom: 0;
        width: 2px;
        background: #f1f5f9;
    }
    .timeline-item { display: flex; gap: 30px; padding: 20px 0; }
    .timeline-time { width: 60px; display: flex; flex-direction: column; text-align: right; }
    .timeline-time .hour { font-weight: 800; color: var(--text-main); font-size: 15px; }
    .timeline-time .date { font-size: 12px; color: var(--text-muted); font-weight: 600; }
    
    .timeline-point {
        width: 14px;
        height: 14px;
        background: #fff;
        border: 3px solid var(--primary-green);
        border-radius: 50%;
        margin-top: 5px;
        position: relative;
        z-index: 1;
    }
    .timeline-content { flex: 1; }
    .activity-type { font-weight: 700; font-size: 15px; margin-bottom: 4px; text-transform: capitalize; }
    .activity-desc { font-size: 14px; color: var(--text-muted); line-height: 1.5; }

    /* Side Cards */
    .wellness-card { background: var(--light-green); border: none; }
    .wellness-icon { font-size: 32px; color: var(--primary-green); margin-bottom: 15px; }
    .wellness-text { font-size: 15px; color: #064e3b; font-weight: 500; margin-bottom: 20px; }
    .wellness-footer { display: flex; align-items: center; gap: 8px; font-size: 13px; color: var(--primary-green); font-weight: 700; }

    .notif-card {
        padding: 15px;
        background: #f8fafc;
        border-radius: 16px;
        margin-bottom: 12px;
    }
    .notif-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 5px; }
    .notif-title { font-weight: 700; font-size: 14px; }
    .notif-dot { width: 8px; height: 8px; background: #3b82f6; border-radius: 50%; }
    .notif-desc { font-size: 13px; color: var(--text-muted); line-height: 1.4; }

    .support-card { background: linear-gradient(135deg, var(--primary-green), var(--secondary-green)); color: #fff; border: none; }
    .support-card h3 { font-size: 20px; font-weight: 800; margin-bottom: 10px; }
    .support-card p { opacity: 0.9; font-size: 14px; margin-bottom: 20px; }

    .empty-state { text-align: center; padding: 40px 0; color: var(--text-muted); }
    .empty-state i { font-size: 40px; margin-bottom: 10px; opacity: 0.2; }

    @media (max-width: 1200px) {
        .grid-3 { grid-template-columns: 1fr !important; }
    }
    @media (max-width: 768px) {
        .hero-panel { flex-direction: column; align-items: flex-start; gap: 24px; }
        .hero-quote-box { max-width: 100%; }
        .mood-options { grid-template-columns: repeat(3, 1fr); }
    }
    @media (max-width: 480px) {
        .mood-options { grid-template-columns: repeat(2, 1fr); }
    }
</style>
@endsection
