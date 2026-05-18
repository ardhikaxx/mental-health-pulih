@extends('layouts.public', ['title' => 'Konfirmasi Password - Ruang Pulih'])

@section('content')
<div class="card card-body" style="max-width:560px;margin:40px auto;">
    <h1 style="font-size:32px;margin-bottom:12px;">Konfirmasi Password</h1>
    <p class="muted" style="margin-bottom:18px;">Masukkan password untuk melanjutkan.</p>
    @if ($errors->any()) <div style="background:#fee2e2;color:#991b1b;padding:12px;border-radius:8px;margin-bottom:12px;">{{ $errors->first() }}</div> @endif
    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf
        <input class="search-bar" style="width:100%;height:56px;margin:0 0 14px;" type="password" name="password" placeholder="Password" required>
        <button class="btn" type="submit">Konfirmasi</button>
    </form>
</div>
@endsection
