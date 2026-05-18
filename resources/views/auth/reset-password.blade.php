@extends('layouts.public', ['title' => 'Reset Password - Ruang Pulih'])

@section('content')
<div class="card card-body" style="max-width:640px;margin:40px auto;">
    <h1 style="font-size:32px;margin-bottom:18px;">Buat Kata Sandi Baru</h1>
    @if ($errors->any()) <div style="background:#fee2e2;color:#991b1b;padding:12px;border-radius:8px;margin-bottom:12px;">{{ $errors->first() }}</div> @endif
    <form method="POST" action="{{ route('password.store') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        <input class="search-bar" style="width:100%;height:56px;margin:0 0 14px;" type="email" name="email" value="{{ old('email', $request->email) }}" placeholder="Email" required>
        <input class="search-bar" style="width:100%;height:56px;margin:0 0 14px;" type="password" name="password" placeholder="Password baru" required>
        <input class="search-bar" style="width:100%;height:56px;margin:0 0 14px;" type="password" name="password_confirmation" placeholder="Konfirmasi password" required>
        <button class="btn" type="submit">Reset Password</button>
    </form>
</div>
@endsection
