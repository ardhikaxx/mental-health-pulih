<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="{{ $id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: var(--radius-lg);">
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold" id="{{ $id }}Label">{{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ $action }}" method="POST">
                    @csrf
                    @if ($method !== 'POST') @method($method) @endif
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama Skrining</label>
                            <input class="form-control bg-light border-0" name="nama_skrining" value="{{ old('nama_skrining', $item?->nama_skrining) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Jenis Penyakit</label>
                            <input class="form-control bg-light border-0" name="jenis_penyakit" value="{{ old('jenis_penyakit', $item?->jenis_penyakit) }}" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Deskripsi</label>
                            <textarea class="form-control bg-light border-0" name="deskripsi" rows="3">{{ old('deskripsi', $item?->deskripsi) }}</textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Panduan Pengelolaan</label>
                            <textarea class="form-control bg-light border-0" name="panduan_pengelolaan" rows="3">{{ old('panduan_pengelolaan', $item?->panduan_pengelolaan) }}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Status</label>
                            <select class="form-select bg-light border-0" name="status">
                                <option value="draft" @selected(old('status', $item?->status ?? 'draft') === 'draft')>Draft</option>
                                <option value="publish" @selected(old('status', $item?->status) === 'publish')>Publish</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-4 text-end">
                        <button type="button" class="btn btn-secondary me-2 border-0 bg-light text-dark" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-primary px-4 shadow-sm" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
