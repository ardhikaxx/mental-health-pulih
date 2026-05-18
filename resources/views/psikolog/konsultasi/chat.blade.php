@extends('layouts.dashboard', ['title' => 'Chat Konsultasi'])

@section('content')
<section class="hero-panel">
    <h1>Chat Konsultasi</h1>
    <p>Dengan {{ $konsultasi->pasien->user->nama_lengkap }} - {{ $konsultasi->status_konsultasi }}</p>
</section>

<div class="main-grid">
    <div class="card">
        <div class="chat-box">
            @forelse ($konsultasi->chat as $chat)
                <div class="chat-message {{ $chat->id_pengirim === auth()->id() ? 'me' : 'other' }}">
                    <strong>{{ $chat->pengirim->nama_lengkap }}</strong>
                    <p>{{ $chat->pesan }}</p>
                    @if ($chat->file_lampiran)<a href="{{ asset('storage/'.$chat->file_lampiran) }}" target="_blank">Lampiran</a>@endif
                    <small>{{ optional($chat->waktu_kirim)->format('H:i') }}</small>
                </div>
            @empty
                <div class="empty">Belum ada pesan.</div>
            @endforelse
        </div>
        <form class="filters" style="margin-top:14px;" method="POST" enctype="multipart/form-data" action="{{ route('psikolog.konsultasi.chat.send', $konsultasi) }}">
            @csrf
            <input class="input" name="pesan" placeholder="Tulis pesan...">
            <input class="input" style="max-width:260px;" type="file" name="file_lampiran">
            <button class="btn" type="submit">Kirim</button>
        </form>
    </div>
    <aside class="card">
        <h2>Catatan Sesi</h2>
        <form method="POST" action="{{ route('psikolog.konsultasi.finish', $konsultasi) }}">
            @csrf @method('PATCH')
            <textarea class="textarea" name="catatan_psikolog">{{ $konsultasi->catatan_psikolog }}</textarea>
            <select class="select" name="status_konsultasi" style="margin-top:10px;">
                <option value="selesai">Selesai</option>
                <option value="follow_up">Follow Up</option>
            </select>
            <button class="btn full" style="margin-top:10px;" type="submit">Simpan Status</button>
        </form>
    </aside>
</div>
@endsection
