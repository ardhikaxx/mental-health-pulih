<div class="modal" id="{{ $id }}">
    <div class="modal-card">
        <div class="modal-head">
            <h2>{{ $title }}</h2>
            <a class="btn muted" href="#">Tutup</a>
        </div>
        <form action="{{ $action }}" method="POST">
            @csrf
            @if ($method !== 'POST') @method($method) @endif
            <div class="form-grid">
                <div class="field"><label>Nama Lengkap</label><input class="input" name="nama_lengkap" value="{{ old('nama_lengkap', $admin?->user?->nama_lengkap) }}" required></div>
                <div class="field"><label>Email</label><input class="input" type="email" name="email" value="{{ old('email', $admin?->user?->email) }}" required></div>
                <div class="field"><label>Password {{ $admin ? '(kosongkan jika tetap)' : '' }}</label><input class="input" type="password" name="password" {{ $admin ? '' : 'required' }}></div>
                <div class="field"><label>Nomor Telepon</label><input class="input" name="nomor_telepon" value="{{ old('nomor_telepon', $admin?->user?->nomor_telepon) }}"></div>
                <div class="field"><label>Jenis Kelamin</label><select class="select" name="jenis_kelamin"><option value="">Pilih</option><option value="laki-laki" @selected(old('jenis_kelamin', $admin?->user?->jenis_kelamin) === 'laki-laki')>Laki-laki</option><option value="perempuan" @selected(old('jenis_kelamin', $admin?->user?->jenis_kelamin) === 'perempuan')>Perempuan</option></select></div>
            </div>
            <button class="btn" style="margin-top:16px;" type="submit">Simpan</button>
        </form>
    </div>
</div>
