@extends('layouts.public', ['title' => 'Lupa Password - Ruang Pulih'])

@section('content')
<div class="card card-body" style="max-width:640px;margin:40px auto;">
    <h1 style="font-size:32px;margin-bottom:12px;">Reset Kata Sandi</h1>
    <p class="muted" style="margin-bottom:18px;">Masukkan email akun untuk menerima tautan reset kata sandi.</p>
    @if (session('status')) <div style="background:#dcfce7;color:#166534;padding:12px;border-radius:8px;margin-bottom:12px;">{{ session('status') }}</div> @endif
    @if ($errors->any()) <div style="background:#fee2e2;color:#991b1b;padding:12px;border-radius:8px;margin-bottom:12px;">{{ $errors->first() }}</div> @endif
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <input class="search-bar" style="width:100%;height:56px;margin:0 0 14px;" type="email" name="email" placeholder="Email" required autofocus>
        <button class="btn" type="submit">Kirim Link Reset</button>
    </form>
</div>
@endsection
