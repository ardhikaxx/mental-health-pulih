@extends('layouts.dashboard', ['title' => 'Detail Admin'])

@section('content')
<section class="hero-panel">
    <h1>{{ $admin->user->nama_lengkap }}</h1>
    <p>{{ $admin->user->email }}</p>
</section>

<div class="grid-3">
    <div class="card"><div class="stat-label">Jenis Kelamin</div><strong>{{ $admin->user->jenis_kelamin ?? '-' }}</strong></div>
    <div class="card"><div class="stat-label">Nomor Telepon</div><strong>{{ $admin->user->nomor_telepon ?? '-' }}</strong></div>
    <div class="card"><div class="stat-label">Status Akun</div><span class="badge green">{{ $admin->user->status_akun }}</span></div>
</div>
@endsection
