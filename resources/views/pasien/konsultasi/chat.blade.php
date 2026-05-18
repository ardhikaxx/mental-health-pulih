@extends('layouts.dashboard', ['title' => 'Chat Konsultasi'])

@section('content')
<section class="hero-panel">
    <h1>Chat Konsultasi</h1>
    <p>Dengan {{ $konsultasi->psikolog->user->nama_lengkap }} - {{ $konsultasi->status_konsultasi }}</p>
</section>

<div class="card">
    <div class="chat-box">
        @forelse ($konsultasi->chat as $chat)
            <div class="chat-message {{ $chat->id_pengirim === auth()->id() ? 'me' : 'other' }}">
                <strong>{{ $chat->pengirim->nama_lengkap }}</strong>
                <p>{{ $chat->pesan }}</p>
                @if ($chat->file_lampiran)
                    <a href="{{ asset('storage/'.$chat->file_lampiran) }}" target="_blank">Lampiran</a>
                @endif
                <small>{{ optional($chat->waktu_kirim)->format('H:i') }}</small>
            </div>
        @empty
            <div class="empty">Belum ada pesan.</div>
        @endforelse
    </div>
    <form class="filters" style="margin-top:14px;" method="POST" enctype="multipart/form-data" action="{{ route('pasien.konsultasi.chat.send', $konsultasi) }}">
        @csrf
        <input class="input" name="pesan" placeholder="Tulis pesan...">
        <input class="input" style="max-width:260px;" type="file" name="file_lampiran">
        <button class="btn" type="submit">Kirim</button>
    </form>
</div>
@endsection
