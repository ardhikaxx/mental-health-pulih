@extends('layouts.dashboard', ['title' => 'Dashboard Pasien'])

@section('content')
<section class="hero-panel">
    <p>Halo, {{ auth()->user()->nama_lengkap }}</p>
    <h1>Bagaimana Perasaanmu Hari Ini?</h1>
    <p>Yuk, jaga kesehatan mentalmu setiap hari.</p>
</section>

<div class="main-grid">
    <div class="grid">
        <div class="card">
            <h2>Bagaimana mood kamu hari ini?</h2>
            <p class="muted" style="margin:6px 0 18px;">Pilih mood yang paling kamu rasakan saat ini.</p>
            <form method="POST" action="{{ route('pasien.dashboard.mood') }}">
                @csrf
                <div class="grid-5" style="display:grid;grid-template-columns:repeat(5,minmax(0,1fr));gap:16px;">
                    @foreach ([
                        ['Sangat Baik', ':)', 'sangatbaik.png'],
                        ['Baik', ':)', 'baik.png'],
                        ['Biasa Saja', ':|', 'biasasaja.png'],
                        ['Tidak Baik', ':(', 'tidakbaik.png'],
                        ['Sangat Buruk', ':(', 'sangatburuk.png'],
                    ] as [$mood, $emoji, $img])
                        <label class="card" style="box-shadow:none;text-align:center;cursor:pointer;padding:12px;">
                            <input type="radio" name="mood" value="{{ $mood }}" @checked($moodHariIni?->mood === $mood) required>
                            <input type="hidden" name="emoji_mood" value="{{ $emoji }}">
                            <img src="{{ asset('assets/images/'.$img) }}" alt="{{ $mood }}" style="height:64px;object-fit:contain;margin:8px auto;display:block;">
                            <strong>{{ $mood }}</strong>
                        </label>
                    @endforeach
                </div>
                <textarea class="textarea" name="catatan" placeholder="Catatan mood hari ini (opsional)" style="margin-top:14px;">{{ $moodHariIni?->catatan }}</textarea>
                <button class="btn" style="margin-top:12px;" type="submit">Simpan Mood</button>
            </form>
        </div>

        <div class="card">
            <h2>Riwayat Aktivitas Singkat</h2>
            <p class="muted" style="margin:6px 0 16px;">Aktivitas terbaru kamu di Ruang Pulih.</p>
            <div class="timeline">
                @forelse ($aktivitas as $item)
                    <div class="timeline-row">
                        <span class="muted">{{ optional($item->tanggal_aktivitas)->format('H:i') }}</span>
                        <div><strong>{{ str_replace('_', ' ', $item->jenis_aktivitas) }}</strong><br><span class="muted">{{ $item->keterangan }}</span></div>
                        <span>&gt;</span>
                    </div>
                @empty
                    <div class="empty">Belum ada aktivitas.</div>
                @endforelse
            </div>
        </div>
    </div>

    <aside class="grid">
        <div class="card">
            <h2>Notifikasi</h2>
            @forelse ($notifikasi as $item)
                <div style="border-bottom:1px solid #e5e5e5;padding:12px 0;">
                    <strong>{{ $item->judul_notifikasi }}</strong>
                    <p class="muted">{{ $item->isi_notifikasi }}</p>
                </div>
            @empty
                <p class="muted" style="margin-top:12px;">Belum ada notifikasi.</p>
            @endforelse
        </div>
        <div class="card" style="background:#eefaf3;">
            <h2 style="color:#005c34;">Kesehatan mental adalah prioritas, bukan pilihan.</h2>
            <p class="muted" style="margin-top:12px;">Jangan lupa istirahat dan berikan waktu untuk dirimu sendiri.</p>
        </div>
        <div class="card">
            <h2>Tips Hari Ini</h2>
            <p class="muted" style="margin-top:8px;">Luangkan waktu 10 menit untuk bernapas dalam dan bersyukur atas hal kecil.</p>
        </div>
    </aside>
</div>
@endsection
