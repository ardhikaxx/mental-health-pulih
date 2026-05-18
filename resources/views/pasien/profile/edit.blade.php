@extends('layouts.dashboard', ['title' => 'Profil Pasien'])

@section('content')
<section class="hero-panel">
    <h1>Profil Saya</h1>
    <p>Perbarui data akun dan kontak kamu.</p>
</section>

<div class="main-grid">
    <form class="card" method="POST" action="{{ route('pasien.profile.update') }}">
        @csrf @method('PATCH')
        <div class="section-head"><h2>Informasi Profil</h2></div>
        <div class="form-grid">
            <div class="field"><label>Nama Lengkap</label><input class="input" name="nama_lengkap" value="{{ old('nama_lengkap', $user->nama_lengkap) }}" required></div>
            <div class="field"><label>Email</label><input class="input" type="email" name="email" value="{{ old('email', $user->email) }}" required></div>
            <div class="field"><label>Nomor Telepon</label><input class="input" name="nomor_telepon" value="{{ old('nomor_telepon', $user->nomor_telepon) }}"></div>
            <div class="field"><label>Jenis Kelamin</label><select class="select" name="jenis_kelamin"><option value="">Pilih</option><option value="laki-laki" @selected(old('jenis_kelamin', $user->jenis_kelamin) === 'laki-laki')>Laki-laki</option><option value="perempuan" @selected(old('jenis_kelamin', $user->jenis_kelamin) === 'perempuan')>Perempuan</option></select></div>
        </div>
        <button class="btn" style="margin-top:16px;" type="submit">Simpan Profil</button>
    </form>

    <aside class="card">
        <h2>Hapus Akun</h2>
        <p class="muted" style="margin:8px 0 14px;">Akun yang dihapus tidak dapat digunakan lagi.</p>
        <form method="POST" action="{{ route('pasien.profile.destroy') }}" onsubmit="return confirm('Hapus akun ini?')">
            @csrf @method('DELETE')
            <input class="input" type="password" name="password" placeholder="Password saat ini" required>
            <button class="btn danger full" style="margin-top:12px;" type="submit">Hapus Akun</button>
        </form>
    </aside>
</div>
@endsection
