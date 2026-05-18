@extends('layouts.dashboard', ['title' => 'Konsultasi Online'])

@section('content')
<section class="hero-panel">
    <h1>Konsultasi Online</h1>
    <p>Lengkapi data keluhan, lalu pilih psikolog dan jadwal konsultasi.</p>
</section>

<div class="main-grid">
    <form class="card" method="POST" action="{{ route('pasien.konsultasi.store') }}">
        @csrf
        <div class="section-head"><h2>Data Konsultasi</h2></div>
        <div class="form-grid">
            <div class="field"><label>Nama Lengkap</label><input class="input" name="nama_lengkap" value="{{ old('nama_lengkap', auth()->user()->nama_lengkap) }}" required></div>
            <div class="field"><label>Umur</label><input class="input" type="number" min="1" max="120" name="umur" value="{{ old('umur', $pasien->umur) }}" required></div>
            <div class="field"><label>Jenis Kelamin</label><select class="select" name="jenis_kelamin" required><option value="">Pilih</option><option value="laki-laki" @selected(old('jenis_kelamin', auth()->user()->jenis_kelamin) === 'laki-laki')>Laki-laki</option><option value="perempuan" @selected(old('jenis_kelamin', auth()->user()->jenis_kelamin) === 'perempuan')>Perempuan</option></select></div>
            <div class="field"><label>Email</label><input class="input" type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required></div>
            <div class="field span-2"><label>Keluhan</label><textarea class="textarea" name="keluhan" required>{{ old('keluhan') }}</textarea></div>
            <div class="field"><label>Tingkat Urgensi</label><select class="select" name="tingkat_urgensi"><option value="rendah">Rendah</option><option value="sedang">Sedang</option><option value="tinggi">Tinggi</option></select></div>
            <label class="field span-2"><input type="checkbox" name="persetujuan_syarat" value="1" required> Saya menyetujui syarat dan ketentuan serta kebijakan privasi yang berlaku.</label>
        </div>
        <button class="btn" style="margin-top:16px;" type="submit">Lanjut Pilih Psikolog</button>
    </form>

    <aside class="card">
        <h2>Riwayat Terbaru</h2>
        @forelse ($konsultasi as $item)
            <div style="border-bottom:1px solid #e5e5e5;padding:12px 0;">
                <strong>{{ $item->psikolog->user->nama_lengkap ?? '-' }}</strong>
                <p class="muted">{{ optional($item->tanggal_konsultasi)->format('d M Y') }} - {{ $item->status_konsultasi }}</p>
            </div>
        @empty
            <p class="muted" style="margin-top:12px;">Belum ada riwayat konsultasi.</p>
        @endforelse
        <a class="btn secondary full" style="margin-top:16px;" href="{{ route('pasien.konsultasi.riwayat') }}">Lihat Riwayat</a>
    </aside>
</div>
@endsection
