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
                <div class="field"><label>Nama Skrining</label><input class="input" name="nama_skrining" value="{{ old('nama_skrining', $item?->nama_skrining) }}" required></div>
                <div class="field"><label>Jenis Penyakit</label><input class="input" name="jenis_penyakit" value="{{ old('jenis_penyakit', $item?->jenis_penyakit) }}" required></div>
                <div class="field span-2"><label>Deskripsi</label><textarea class="textarea" name="deskripsi">{{ old('deskripsi', $item?->deskripsi) }}</textarea></div>
                <div class="field span-2"><label>Panduan Pengelolaan</label><textarea class="textarea" name="panduan_pengelolaan">{{ old('panduan_pengelolaan', $item?->panduan_pengelolaan) }}</textarea></div>
                <div class="field"><label>Status</label><select class="select" name="status"><option value="draft" @selected(old('status', $item?->status ?? 'draft') === 'draft')>Draft</option><option value="publish" @selected(old('status', $item?->status) === 'publish')>Publish</option></select></div>
            </div>
            <button class="btn" style="margin-top:16px;" type="submit">Simpan</button>
        </form>
    </div>
</div>
