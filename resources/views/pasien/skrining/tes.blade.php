@extends('layouts.dashboard', ['title' => 'Tes Skrining'])

@section('content')
<section class="hero-panel d-flex justify-content-between align-items-center mb-4 p-4 bg-primary text-white rounded-4 position-relative overflow-hidden" style="background: linear-gradient(135deg, var(--primary-green), var(--secondary-green));">
    <div style="position: relative; z-index: 2;">
        <h1 class="mb-2 fw-bold"><i class="fa-solid fa-file-signature me-2"></i> {{ $skrining->nama_skrining }}</h1>
        <p class="mb-0 opacity-75">{{ $skrining->deskripsi }}</p>
    </div>
    <a href="{{ route('pasien.skrining.pilih') }}" class="btn btn-light bg-opacity-25 text-white border-0 shadow-none fw-bold" style="position: relative; z-index: 2;">
        <i class="fa-solid fa-arrow-left me-1"></i> Batal Tes
    </a>
</section>

<form method="POST" action="{{ route('pasien.skrining.submit', $skrining) }}">
    @csrf
    <div class="row g-4">
        <!-- Main Quiz Area -->
        <div class="col-lg-8">
            <div class="d-flex flex-column gap-4">
                @foreach ($skrining->pertanyaan as $pertanyaan)
                    <div class="card border-0 shadow-sm p-4 rounded-4 question-card">
                        <h5 class="fw-bold mb-4 text-dark" style="line-height: 1.4;">
                            <span class="text-primary me-1">{{ $loop->iteration }}.</span> {{ $pertanyaan->pertanyaan }}
                        </h5>
                        
                        <div class="row g-3">
                            @foreach ($pertanyaan->jawaban as $jawaban)
                                <div class="col-sm-6">
                                    <label class="answer-option d-block h-100 p-3 rounded-4 border border-2 cursor-pointer transition-all bg-light hover-bg-white" style="cursor: pointer;">
                                        <input type="radio" name="jawaban[{{ $pertanyaan->id_pertanyaan }}]" value="{{ $jawaban->id_jawaban }}" class="d-none" required onchange="this.closest('.row').querySelectorAll('.answer-option').forEach(el => { el.classList.remove('border-primary', 'bg-primary', 'bg-opacity-10'); el.classList.add('border-light', 'bg-light'); }); this.closest('.answer-option').classList.remove('border-light', 'bg-light'); this.closest('.answer-option').classList.add('border-primary', 'bg-primary', 'bg-opacity-10');">
                                        <div class="d-flex align-items-center gap-2 h-100">
                                            <div class="radio-custom rounded-circle border border-2 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 20px; height: 20px;">
                                                <div class="radio-dot bg-primary rounded-circle d-none" style="width: 10px; height: 10px;"></div>
                                            </div>
                                            <span class="fw-semibold text-dark">{{ $jawaban->teks_jawaban }}</span>
                                        </div>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
                
                <div class="card border-0 p-3 shadow-sm bg-white sticky-bottom mt-2 d-flex justify-content-end" style="bottom: 20px; z-index: 10;">
                    <button class="btn btn-success shadow-sm px-5 py-2 fw-bold rounded-pill" type="submit" onclick="return confirm('Sudah yakin dengan semua jawaban Anda?')">
                        <i class="fa-solid fa-paper-plane me-2"></i> Kirim & Simpan Hasil Tes
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Info Area -->
        <div class="col-lg-4">
            <div class="d-flex flex-column gap-4 sticky-top" style="top: 20px;">
                <div class="card border-0 shadow-sm p-4 rounded-4 bg-info bg-opacity-10 border-start border-info border-4">
                    <h5 class="fw-bold mb-3 text-info"><i class="fa-solid fa-circle-info me-2"></i> Informasi Tes</h5>
                    <p class="text-dark opacity-75 small mb-0" style="line-height: 1.6;">
                        Jawablah setiap pertanyaan sesuai dengan kondisi yang <strong>benar-benar kamu rasakan</strong> akhir-akhir ini. Tidak ada jawaban yang benar ataupun salah.
                    </p>
                </div>
                
                <div class="card border-0 shadow-sm p-4 rounded-4">
                    <h5 class="fw-bold mb-3 pb-2 border-bottom"><i class="fa-solid fa-book-open text-primary me-2"></i> Panduan Pengisian</h5>
                    <p class="text-muted small mb-0" style="white-space: pre-line; line-height: 1.6;">{{ $skrining->panduan_pengelolaan }}</p>
                </div>
            </div>
        </div>
    </div>
</form>

<style>
    .transition-all { transition: all 0.2s ease; }
    .hover-bg-white:hover { background-color: #fff !important; border-color: #dee2e6 !important; }
    
    .answer-option input:checked ~ div .radio-custom { border-color: var(--primary-green) !important; }
    .answer-option input:checked ~ div .radio-custom .radio-dot { display: block !important; }
    .answer-option input:checked ~ div span { color: var(--primary-green) !important; }
</style>
@endsection
