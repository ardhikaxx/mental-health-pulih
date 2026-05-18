@extends('layouts.dashboard', ['title' => 'Pemantauan Kondisi Mental'])

@section('content')
<section class="hero-panel">
    <h1>Pemantauan Kondisi Mental</h1>
    <p>Isi pertanyaan harian untuk memantau kondisi mentalmu.</p>
</section>

@if ($hariIni)
    <div class="card">
        <h2>Pemantauan hari ini sudah tersimpan.</h2>
        <p class="muted" style="margin:8px 0 16px;">Kamu dapat melihat hasil dan perkembangan kondisi mental hari ini.</p>
        <a class="btn" href="{{ route('pasien.pemantauan.hasil', $hariIni) }}">Lihat Hasil</a>
    </div>
@else
    <form class="card" method="POST" action="{{ route('pasien.pemantauan.store') }}">
        @csrf
        <div class="grid">
            @foreach ($pertanyaan as $item)
                <div>
                    <h2 style="margin-bottom:12px;">{{ $loop->iteration }}. {{ $item->pertanyaan }}</h2>
                    <div class="grid-4">
                        @foreach ([0 => ['Tidak', ':)'], 1 => ['Ringan', ':|'], 2 => ['Sedang', ':('], 3 => ['Berat', ':(']] as $nilai => [$label, $emoji])
                            <label class="card" style="box-shadow:none;text-align:center;cursor:pointer;">
                                <input type="radio" name="jawaban[{{ $item->id_pertanyaan_pemantauan }}]" value="{{ $nilai }}" required>
                                <input type="hidden" name="emoji[{{ $item->id_pertanyaan_pemantauan }}]" value="{{ $emoji }}">
                                <strong>{{ $label }}</strong>
                            </label>
                        @endforeach
                    </div>
                </div>
            @endforeach
            <div class="field">
                <label>Keterangan tambahan</label>
                <textarea class="textarea" name="keterangan"></textarea>
            </div>
            <button class="btn" type="submit">Kirim Pemantauan</button>
        </div>
    </form>
@endif
@endsection
