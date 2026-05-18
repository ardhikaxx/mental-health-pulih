@extends('layouts.dashboard', ['title' => 'Manajemen Psikolog'])

@section('content')
<section class="hero-panel">
    <h1>Manajemen Psikolog</h1>
    <p>Kelola data psikolog, spesialisasi, SIPA, dan jadwal default konsultasi.</p>
</section>

<div class="card">
    <div class="section-head">
        <form class="filters" method="GET">
            <input class="input" style="max-width:320px;" name="search" value="{{ $search }}" placeholder="Cari nama atau SIPA...">
            <select class="select" style="max-width:240px;" name="spesialisasi">
                <option value="">Semua spesialisasi</option>
                @foreach ($spesialisasiList as $item)
                    <option value="{{ $item }}" @selected($spesialisasi === $item)>{{ $item }}</option>
                @endforeach
            </select>
            <button class="btn" type="submit">Filter</button>
        </form>
        <a class="btn" href="#tambah-psikolog">Tambah Psikolog</a>
    </div>

    <div class="table-wrap">
        <table>
            <thead><tr><th>No</th><th>Nama</th><th>Email</th><th>Spesialisasi</th><th>Telepon</th><th>SIPA</th><th>Aksi</th></tr></thead>
            <tbody>
            @forelse ($psikologs as $psikolog)
                <tr>
                    <td>{{ $psikologs->firstItem() + $loop->index }}</td>
                    <td>{{ $psikolog->user->nama_lengkap }}</td>
                    <td>{{ $psikolog->user->email }}</td>
                    <td>{{ $psikolog->spesialisasi ?? '-' }}</td>
                    <td>{{ $psikolog->user->nomor_telepon ?? '-' }}</td>
                    <td>{{ $psikolog->nomor_sipa }}</td>
                    <td class="actions">
                        <a class="btn secondary" href="{{ route('admin.psikolog.show', $psikolog) }}">Detail</a>
                        <a class="btn muted" href="#edit-psikolog-{{ $psikolog->id_psikolog }}">Edit</a>
                        <form action="{{ route('admin.psikolog.destroy', $psikolog) }}" method="POST" onsubmit="return confirm('Nonaktifkan psikolog ini?')">
                            @csrf @method('DELETE')
                            <button class="btn danger" type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="empty">Belum ada data psikolog.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="pagination">{{ $psikologs->links() }}</div>
</div>

@include('admin.psikolog.partials.form-modal', ['id' => 'tambah-psikolog', 'title' => 'Tambah Psikolog', 'action' => route('admin.psikolog.store'), 'method' => 'POST', 'psikolog' => null])

@foreach ($psikologs as $psikolog)
    @include('admin.psikolog.partials.form-modal', ['id' => 'edit-psikolog-'.$psikolog->id_psikolog, 'title' => 'Edit Psikolog', 'action' => route('admin.psikolog.update', $psikolog), 'method' => 'PUT', 'psikolog' => $psikolog])
@endforeach
@endsection
