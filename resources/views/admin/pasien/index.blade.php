@extends('layouts.dashboard', ['title' => 'Manajemen Pasien'])

@section('content')
<section class="hero-panel">
    <h1>Manajemen Pasien</h1>
    <p>Pantau data pasien, riwayat skrining, konsultasi, dan pemantauan kondisi mental.</p>
</section>

<div class="card">
    <form class="filters" method="GET">
        <input class="input" style="max-width:340px;" name="search" value="{{ $search }}" placeholder="Cari nama pasien...">
        <select class="select" style="max-width:240px;" name="jenis_kelamin">
            <option value="">Semua jenis kelamin</option>
            <option value="laki-laki" @selected($gender === 'laki-laki')>Laki-laki</option>
            <option value="perempuan" @selected($gender === 'perempuan')>Perempuan</option>
        </select>
        <button class="btn" type="submit">Filter</button>
    </form>

    <div class="table-wrap">
        <table>
            <thead><tr><th>No</th><th>Nama Pasien</th><th>Email</th><th>Tanggal Daftar</th><th>Telepon</th><th>Jenis Kelamin</th><th>Aksi</th></tr></thead>
            <tbody>
            @forelse ($pasiens as $pasien)
                <tr>
                    <td>{{ $pasiens->firstItem() + $loop->index }}</td>
                    <td>{{ $pasien->user->nama_lengkap }}</td>
                    <td>{{ $pasien->user->email }}</td>
                    <td>{{ optional($pasien->tanggal_daftar)->format('d M Y') ?? '-' }}</td>
                    <td>{{ $pasien->user->nomor_telepon ?? '-' }}</td>
                    <td>{{ $pasien->user->jenis_kelamin ?? '-' }}</td>
                    <td><a class="btn secondary" href="{{ route('admin.pasien.show', $pasien) }}">Detail</a></td>
                </tr>
            @empty
                <tr><td colspan="7" class="empty">Data pasien belum tersedia.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="pagination">{{ $pasiens->links() }}</div>
</div>
@endsection
