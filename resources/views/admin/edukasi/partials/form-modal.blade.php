@php $tipeValue = old('tipe_konten', $konten->tipe_konten ?? $tipeDefault); @endphp
<div class="modal" id="{{ $id }}">
    <div class="modal-card">
        <div class="modal-head">
            <h2>{{ $title }}</h2>
            <a class="btn muted" href="#">Tutup</a>
        </div>
        <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if ($method !== 'POST') @method($method) @endif
            <div class="form-grid">
                <div class="field"><label>Tipe Konten</label><select class="select" name="tipe_konten"><option value="artikel" @selected($tipeValue === 'artikel')>Artikel</option><option value="video" @selected($tipeValue === 'video')>Video</option></select></div>
                <div class="field"><label>Kategori</label><select class="select" name="id_kategori" required>@foreach ($kategori as $kat)<option value="{{ $kat->id_kategori }}" @selected(old('id_kategori', $konten?->id_kategori) == $kat->id_kategori)>{{ $kat->nama_kategori }}</option>@endforeach</select></div>
                <div class="field span-2"><label>Judul</label><input class="input" name="judul_konten" value="{{ old('judul_konten', $konten?->judul_konten) }}" required></div>
                <div class="field span-2"><label>Isi Artikel</label><textarea class="textarea" name="isi_artikel">{{ old('isi_artikel', $konten?->isi_artikel) }}</textarea></div>
                <div class="field"><label>URL Video</label><input class="input" type="url" name="url_video" value="{{ old('url_video', $konten?->url_video) }}"></div>
                <div class="field"><label>Durasi Video</label><input class="input" name="durasi_video" placeholder="08:30" value="{{ old('durasi_video', $konten?->durasi_video) }}"></div>
                <div class="field"><label>Thumbnail</label><input class="input" type="file" name="thumbnail" accept=".jpg,.jpeg,.png"></div>
                <div class="field"><label>Status</label><select class="select" name="status"><option value="draft" @selected(old('status', $konten?->status ?? 'draft') === 'draft')>Draft</option><option value="publish" @selected(old('status', $konten?->status) === 'publish')>Publish</option></select></div>
            </div>
            <button class="btn" style="margin-top:16px;" type="submit">Simpan Konten</button>
        </form>
    </div>
</div>
