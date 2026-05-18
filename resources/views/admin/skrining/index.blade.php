@extends('layouts.dashboard', ['title' => 'Manajemen Skrining'])

@section('content')
<section class="hero-panel">
    <h1>Manajemen Skrining</h1>
    <p>Kelola jenis skrining, panduan, pertanyaan, dan jawaban skoring.</p>
</section>

<div class="card">
    <div class="section-head">
        <form class="filters" method="GET">
            <input class="input" style="max-width:340px;" name="search" value="{{ $search }}" placeholder="Cari jenis penyakit...">
            <button class="btn" type="submit">Cari</button>
        </form>
        <div class="actions">
            <a class="btn secondary" href="#panduan">Panduan Pengelolaan</a>
            <a class="btn" href="#tambah-skrining">Tambah Penyakit</a>
        </div>
    </div>

    <div class="table-wrap">
        <table>
            <thead><tr><th>No</th><th>Jenis Skrining</th><th>Penyakit</th><th>Deskripsi</th><th>Pertanyaan</th><th>Status</th><th>Aksi</th></tr></thead>
            <tbody>
            @forelse ($skrining as $item)
                <tr>
                    <td>{{ $skrining->firstItem() + $loop->index }}</td>
                    <td>{{ $item->nama_skrining }}</td>
                    <td>{{ $item->jenis_penyakit }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($item->deskripsi, 80) }}</td>
                    <td>{{ $item->pertanyaan_count }}</td>
                    <td><span class="badge {{ $item->status === 'publish' ? 'green' : 'gray' }}">{{ $item->status }}</span></td>
                    <td class="actions">
                        <a class="btn secondary" href="{{ route('admin.skrining.pertanyaan.edit', $item) }}">Pertanyaan</a>
                        <a class="btn muted" href="#edit-skrining-{{ $item->id_jenis_skrining }}">Edit</a>
                        <form action="{{ route('admin.skrining.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus skrining ini?')">
                            @csrf @method('DELETE')
                            <button class="btn danger" type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="empty">Belum ada jenis skrining.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="pagination">{{ $skrining->links() }}</div>
</div>

<div class="modal" id="panduan">
    <div class="modal-card">
        <div class="modal-head"><h2>Panduan Pengelolaan Skrining</h2><a class="btn muted" href="#">Tutup</a></div>
        <p class="muted" style="line-height:1.7;">Buat jenis skrining terlebih dahulu, lalu kelola pertanyaan dan jawaban bernilai angka. Setiap pasien hanya dapat mengirim satu hasil per jenis skrining dalam satu hari. Gunakan status publish hanya untuk skrining yang sudah lengkap.</p>
    </div>
</div>

@include('admin.skrining.partials.form-modal', ['id' => 'tambah-skrining', 'title' => 'Tambah Jenis Skrining', 'action' => route('admin.skrining.store'), 'method' => 'POST', 'item' => null])
@foreach ($skrining as $item)
    @include('admin.skrining.partials.form-modal', ['id' => 'edit-skrining-'.$item->id_jenis_skrining, 'title' => 'Edit Jenis Skrining', 'action' => route('admin.skrining.update', $item), 'method' => 'PUT', 'item' => $item])
@endforeach
@endsection
