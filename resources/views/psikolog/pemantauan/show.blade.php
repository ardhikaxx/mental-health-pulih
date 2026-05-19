@extends('layouts.dashboard', ['title' => 'Detail Pemantauan Pasien'])

@section('content')
<section class="hero-panel d-flex justify-content-between align-items-center mb-4">
    <div style="position: relative; z-index: 2;">
        <h1 class="mb-2"><i class="fa-solid fa-user-circle me-2"></i> {{ $pasien->user->nama_lengkap }}</h1>
        <div class="d-flex align-items-center gap-2 mt-2">
            <span class="badge bg-light bg-opacity-25 text-white px-3 py-2 rounded-pill">Skor Terakhir: <strong>{{ $ringkasan->skor_terakhir ?? 0 }}</strong></span>
            <span class="badge bg-light bg-opacity-25 text-white px-3 py-2 rounded-pill text-capitalize">{{ $ringkasan->kondisi_terakhir ?? 'Belum ada ringkasan' }}</span>
        </div>
    </div>
    <a href="{{ route('psikolog.pemantauan.index') }}" class="btn btn-light shadow-sm fw-bold" style="position: relative; z-index: 2;">
        <i class="fa-solid fa-arrow-left me-1"></i> Kembali
    </a>
</section>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm p-4 h-100">
            <h5 class="fw-bold mb-4 pb-3 border-bottom"><i class="fa-solid fa-chart-bar text-primary me-2"></i> Grafik Perkembangan</h5>
            <div class="chart-bars d-flex align-items-end gap-2 mt-4" style="height: 300px;">
                @forelse ($pemantauan as $item)
                    <div class="bar-container flex-grow-1 d-flex flex-column align-items-center group" title="Skor: {{ $item->total_skor }}">
                        <div class="bar bg-primary rounded-top-3 w-100 opacity-75 hover-opacity-100 transition-all" style="height:{{ max(8, $item->total_skor * 12) }}px; max-height: 100%; min-width: 20px;"></div>
                        <small class="text-muted mt-2" style="font-size: 0.7rem; transform: rotate(-45deg); white-space: nowrap; margin-top: 15px !important;">{{ $item->tanggal_pemantauan->format('d M') }}</small>
                    </div>
                @empty
                    <div class="w-100 h-100 d-flex align-items-center justify-content-center flex-column text-muted">
                        <i class="fa-solid fa-chart-bar fs-1 opacity-25 mb-3"></i>
                        <p class="mb-0 fst-italic">Belum ada pemantauan.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm p-4 h-100">
            <h5 class="fw-bold mb-4 pb-3 border-bottom"><i class="fa-solid fa-clipboard-list text-primary me-2"></i> Riwayat Skrining</h5>
            <div class="d-flex flex-column gap-3">
                @forelse ($skrining as $item)
                    <div class="p-3 bg-light rounded-4 border">
                        <strong class="d-block text-dark mb-1">{{ $item->jenisSkrining->nama_skrining }}</strong>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted"><i class="fa-regular fa-calendar me-1"></i> {{ $item->tanggal_skrining->format('d M Y') }}</small>
                            <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill">Skor: {{ $item->total_skor }}</span>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-4 text-muted">
                        <i class="fa-solid fa-file-excel fs-3 opacity-25 mb-2 d-block"></i>
                        <small class="fst-italic">Belum ada skrining.</small>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<style>
    .hover-opacity-100:hover { opacity: 1 !important; cursor: pointer; }
    .transition-all { transition: all 0.3s ease; }
</style>
@endsection
