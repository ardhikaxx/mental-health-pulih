@extends('layouts.public', ['title' => 'Verifikasi Email - Ruang Pulih'])

@section('content')
<div class="card card-body" style="max-width:640px;margin:40px auto;">
    <h1 style="font-size:32px;margin-bottom:12px;">Verifikasi Email</h1>
    <p class="muted" style="margin-bottom:18px;">Silakan cek email dan klik tautan verifikasi. Kamu juga bisa meminta tautan baru.</p>
    @if (session('status') === 'verification-link-sent') <div style="background:#dcfce7;color:#166534;padding:12px;border-radius:8px;margin-bottom:12px;">Link verifikasi baru sudah dikirim.</div> @endif
    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button class="btn" type="submit">Kirim Ulang Verifikasi</button>
    </form>
</div>
@endsection
