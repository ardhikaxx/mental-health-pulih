@extends('layouts.dashboard', ['title' => 'Pilih Tes Skrining'])

@section('content')
<section class="hero-panel d-flex flex-column flex-lg-row justify-content-between align-items-lg-center mb-4 gap-4 p-4 bg-primary text-white rounded-4 position-relative overflow-hidden" style="background: linear-gradient(135deg, var(--primary-green), var(--secondary-green));">
    <div style="position: relative; z-index: 2;">
        <h1 class="mb-2 fw-bold"><i class="fa-solid fa-list-check me-2"></i> Pilih Tes Skrining</h1>
        <p class="mb-0 opacity-75">Pilih tes yang sesuai dengan kondisi yang ingin kamu kenali.</p>
    </div>
    <div class="d-flex gap-2" style="position: relative; z-index: 2;">
        <a href="{{ route('pasien.skrining.riwayat') }}" class="btn btn-light bg-opacity-25 text-primary border-0 shadow-none fw-bold">
            <i class="fa-solid fa-clock-rotate-left me-1"></i> Riwayat
        </a>
        <a href="{{ route('pasien.skrining.index') }}" class="btn btn-light bg-opacity-25 text-primary border-0 shadow-none fw-bold">
            <i class="fa-solid fa-arrow-left me-1"></i> Kembali
        </a>
    </div>
</section>

<div class="row g-4">
    @forelse ($jenis as $item)
        <div class="col-md-6 col-lg-4">
            <div class="card border border-light-subtle h-100 p-4 rounded-4 shadow-sm transition-hover d-flex flex-column">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 50px; height: 50px;">
                        <i class="fa-solid fa-clipboard-list fs-4"></i>
                    </div>
                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2 fw-bold shadow-sm border border-success border-opacity-25">
                        {{ $item->jumlah_pertanyaan ?: $item->pertanyaan_count }} Pertanyaan
                    </span>
                </div>
                
                <h5 class="fw-bold text-dark mb-2">{{ $item->nama_skrining }}</h5>
                <p class="text-muted small mb-4 flex-grow-1" style="line-height: 1.6;">{{ $item->deskripsi }}</p>
                
                <a class="btn btn-primary w-100 shadow-sm fw-bold rounded-pill mt-auto" href="{{ route('pasien.skrining.tes', $item) }}">
                    Mulai Tes <i class="fa-solid fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="card border-0 shadow-sm p-5 text-center text-muted">
                <i class="fa-solid fa-folder-open fs-1 opacity-25 mb-3"></i>
                <h5 class="fw-bold">Belum Ada Tes Skrining</h5>
                <p class="mb-0">Saat ini belum ada tes skrining yang dipublikasikan oleh sistem.</p>
            </div>
        </div>
    @endforelse
</div>

<style>
    .transition-hover { transition: all 0.3s ease; }
    .transition-hover:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.08) !important; border-color: var(--primary-green) !important; }
</style>
@endsection
