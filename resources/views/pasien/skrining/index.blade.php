@extends('layouts.dashboard', ['title' => 'Daftar Skrining'])

@section('content')
<section class="hero-panel">
    <h1>Skrining Kesehatan Mental</h1>
    <p>Lengkapi identitas dan riwayat kesehatan sebelum memilih tes skrining.</p>
</section>

<form class="card" method="POST" action="{{ route('pasien.skrining.store') }}">
    @csrf
    <div class="section-head"><h2>Identitas Diri</h2></div>
    <div class="form-grid">
        <div class="field"><label>Nama Lengkap</label><input class="input" name="nama_lengkap" value="{{ old('nama_lengkap', auth()->user()->nama_lengkap) }}" required></div>
        <div class="field"><label>Umur</label><input class="input" type="number" name="umur" value="{{ old('umur', $pasien->umur) }}" min="1" max="120" required></div>
        <div class="field"><label>Jenis Kelamin</label><select class="select" name="jenis_kelamin" required><option value="">Pilih</option><option value="laki-laki" @selected(old('jenis_kelamin', auth()->user()->jenis_kelamin) === 'laki-laki')>Laki-laki</option><option value="perempuan" @selected(old('jenis_kelamin', auth()->user()->jenis_kelamin) === 'perempuan')>Perempuan</option></select></div>
        <div class="field"><label>Email</label><input class="input" type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required></div>
    </div>

    <div class="section-head" style="margin-top:24px;"><h2>Riwayat Kesehatan</h2></div>
    <div class="form-grid">
        <div class="field"><label>Pernah mengalami gangguan mental?</label><select class="select" name="pernah_gangguan_mental" required><option value="0">Tidak</option><option value="1">Ya</option></select></div>
        <div class="field"><label>Jenis gangguan</label><input class="input" name="jenis_gangguan" placeholder="contoh: depresi, kecemasan"></div>
        <div class="field"><label>Sedang konsumsi obat?</label><select class="select" name="sedang_konsumsi_obat" required><option value="0">Tidak</option><option value="1">Ya</option></select></div>
        <div class="field"><label>Nama obat dan dosis</label><input class="input" name="nama_obat_dosis" placeholder="sebutkan nama obat dan dosis"></div>
        <div class="field span-2"><label>Riwayat penyakit fisik</label><textarea class="textarea" name="riwayat_penyakit_fisik" placeholder="contoh: hipertensi, diabetes, asma"></textarea></div>
        <div class="field span-2"><label>Catatan tambahan</label><textarea class="textarea" name="catatan_tambahan" placeholder="tuliskan hal lain yang menurut anda penting"></textarea></div>
    </div>
    <button class="btn" style="margin-top:16px;" type="submit">Daftar Skrining</button>
</form>
@endsection
