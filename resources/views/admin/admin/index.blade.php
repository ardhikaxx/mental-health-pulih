@extends('layouts.dashboard', ['title' => 'Manajemen Admin'])

@section('content')
<section class="hero-panel">
    <h1>Manajemen Admin</h1>
    <p>Kelola akun administrator Ruang Pulih.</p>
</section>

<div class="card">
    <div class="section-head">
        <form class="filters" method="GET">
            <input class="input" style="max-width:340px;" name="search" value="{{ $search }}" placeholder="Cari nama admin...">
            <button class="btn" type="submit">Cari</button>
        </form>
        <a class="btn" href="#tambah-admin">Tambah Admin</a>
    </div>

    <div class="table-wrap">
        <table>
            <thead><tr><th>No</th><th>Nama Admin</th><th>Email</th><th>Jenis Kelamin</th><th>Telepon</th><th>Aksi</th></tr></thead>
            <tbody>
            @forelse ($admins as $admin)
                <tr>
                    <td>{{ $admins->firstItem() + $loop->index }}</td>
                    <td>{{ $admin->user->nama_lengkap }}</td>
                    <td>{{ $admin->user->email }}</td>
                    <td>{{ $admin->user->jenis_kelamin ?? '-' }}</td>
                    <td>{{ $admin->user->nomor_telepon ?? '-' }}</td>
                    <td class="actions">
                        <a class="btn secondary" href="{{ route('admin.admin.show', $admin) }}">Detail</a>
                        <a class="btn muted" href="#edit-admin-{{ $admin->id_admin }}">Edit</a>
                        @if ($admin->id_user !== auth()->id())
                            <form action="{{ route('admin.admin.destroy', $admin) }}" method="POST" onsubmit="return confirm('Nonaktifkan admin ini?')">
                                @csrf @method('DELETE')
                                <button class="btn danger" type="submit">Hapus</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="empty">Belum ada admin.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="pagination">{{ $admins->links() }}</div>
</div>

@include('admin.admin.partials.form-modal', ['id' => 'tambah-admin', 'title' => 'Tambah Admin', 'action' => route('admin.admin.store'), 'method' => 'POST', 'admin' => null])
@foreach ($admins as $admin)
    @include('admin.admin.partials.form-modal', ['id' => 'edit-admin-'.$admin->id_admin, 'title' => 'Edit Admin', 'action' => route('admin.admin.update', $admin), 'method' => 'PUT', 'admin' => $admin])
@endforeach
@endsection
