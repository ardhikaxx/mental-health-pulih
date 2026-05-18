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
                <div class="field"><label>Nama Lengkap</label><input class="input" name="nama_lengkap" value="{{ old('nama_lengkap', $psikolog?->user?->nama_lengkap) }}" required></div>
                <div class="field"><label>Email</label><input class="input" type="email" name="email" value="{{ old('email', $psikolog?->user?->email) }}" required></div>
                <div class="field"><label>Password {{ $psikolog ? '(kosongkan jika tetap)' : '' }}</label><input class="input" type="password" name="password" {{ $psikolog ? '' : 'required' }}></div>
                <div class="field"><label>Nomor Telepon</label><input class="input" name="nomor_telepon" value="{{ old('nomor_telepon', $psikolog?->user?->nomor_telepon) }}"></div>
                <div class="field"><label>Jenis Kelamin</label><select class="select" name="jenis_kelamin"><option value="">Pilih</option><option value="laki-laki" @selected(old('jenis_kelamin', $psikolog?->user?->jenis_kelamin) === 'laki-laki')>Laki-laki</option><option value="perempuan" @selected(old('jenis_kelamin', $psikolog?->user?->jenis_kelamin) === 'perempuan')>Perempuan</option></select></div>
                <div class="field"><label>Spesialisasi</label><input class="input" name="spesialisasi" value="{{ old('spesialisasi', $psikolog?->spesialisasi) }}"></div>
                <div class="field"><label>Nomor SIPA</label><input class="input" name="nomor_sipa" value="{{ old('nomor_sipa', $psikolog?->nomor_sipa) }}" required></div>
                <div class="field"><label>Pendidikan</label><input class="input" name="pendidikan" value="{{ old('pendidikan', $psikolog?->pendidikan) }}"></div>
                <div class="field"><label>Pengalaman (tahun)</label><input class="input" type="number" min="0" name="pengalaman" value="{{ old('pengalaman', $psikolog?->pengalaman) }}"></div>
                <div class="field span-2"><label>Bio</label><textarea class="textarea" name="bio">{{ old('bio', $psikolog?->bio) }}</textarea></div>
            </div>
            <button class="btn" style="margin-top:16px;" type="submit">Simpan</button>
        </form>
    </div>
</div>
