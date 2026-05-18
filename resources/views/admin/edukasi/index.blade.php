@extends('layouts.dashboard', ['title' => 'Manajemen Edukasi'])

@section('content')
<section class="hero-panel">
    <h1>Manajemen Edukasi</h1>
    <p>Kelola artikel dan video edukasi untuk halaman publik Ruang Pulih.</p>
</section>

<div class="card">
    <div class="section-head">
        <form class="filters" method="GET">
            <input class="input" style="max-width:340px;" name="search" value="{{ $search }}" placeholder="Cari judul konten...">
            <select class="select" style="max-width:210px;" name="tipe_konten">
                <option value="">Semua tipe</option>
                <option value="artikel" @selected($tipe === 'artikel')>Artikel</option>
                <option value="video" @selected($tipe === 'video')>Video</option>
            </select>
            <button class="btn" type="submit">Filter</button>
        </form>
        <div class="actions">
            <a class="btn" href="#tambah-artikel">Tambah Artikel</a>
            <a class="btn secondary" href="#tambah-video">Tambah Video</a>
        </div>
    </div>

    <div class="table-wrap">
        <table>
            <thead><tr><th>No</th><th>Judul Konten</th><th>Tipe</th><th>Kategori</th><th>Penulis</th><th>Tanggal</th><th>Status</th><th>Aksi</th></tr></thead>
            <tbody>
            @forelse ($kontens as $konten)
                <tr>
                    <td>{{ $kontens->firstItem() + $loop->index }}</td>
                    <td>{{ $konten->judul_konten }}</td>
                    <td>{{ $konten->tipe_konten }}</td>
                    <td>{{ $konten->kategori->nama_kategori ?? '-' }}</td>
                    <td>{{ $konten->penulis->nama_lengkap ?? '-' }}</td>
                    <td>{{ $konten->created_at->format('d M Y') }}</td>
                    <td><span class="badge {{ $konten->status === 'publish' ? 'green' : 'gray' }}">{{ $konten->status }}</span></td>
                    <td class="actions">
                        <a class="btn secondary" href="{{ route('admin.edukasi.show', $konten) }}">Detail</a>
                        <a class="btn muted" href="#edit-konten-{{ $konten->id_konten }}">Edit</a>
                        <form action="{{ route('admin.edukasi.destroy', $konten) }}" method="POST" onsubmit="return confirm('Hapus konten ini?')">
                            @csrf @method('DELETE')
                            <button class="btn danger" type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="8" class="empty">Belum ada konten edukasi.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="pagination">{{ $kontens->links() }}</div>
</div>

@include('admin.edukasi.partials.form-modal', ['id' => 'tambah-artikel', 'title' => 'Tambah Artikel', 'action' => route('admin.edukasi.store'), 'method' => 'POST', 'konten' => null, 'tipeDefault' => 'artikel'])
@include('admin.edukasi.partials.form-modal', ['id' => 'tambah-video', 'title' => 'Tambah Video', 'action' => route('admin.edukasi.store'), 'method' => 'POST', 'konten' => null, 'tipeDefault' => 'video'])
@foreach ($kontens as $konten)
    @include('admin.edukasi.partials.form-modal', ['id' => 'edit-konten-'.$konten->id_konten, 'title' => 'Edit Konten', 'action' => route('admin.edukasi.update', $konten), 'method' => 'PUT', 'konten' => $konten, 'tipeDefault' => $konten->tipe_konten])
@endforeach
@endsection
