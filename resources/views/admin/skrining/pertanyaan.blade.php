@extends('layouts.dashboard', ['title' => 'Kelola Pertanyaan Skrining'])

@section('content')
<section class="hero-panel">
    <h1>{{ $skrining->nama_skrining }}</h1>
    <p>Kelola pertanyaan dan pilihan jawaban untuk {{ $skrining->jenis_penyakit }}.</p>
</section>

<form class="card" action="{{ route('admin.skrining.pertanyaan.update', $skrining) }}" method="POST">
    @csrf @method('PUT')
    <div class="section-head">
        <h2>Daftar Pertanyaan</h2>
        <button class="btn secondary" type="button" onclick="addQuestion()">Tambah Pertanyaan</button>
    </div>

    <div id="question-list" class="grid">
        @forelse ($skrining->pertanyaan as $qIndex => $pertanyaan)
            @include('admin.skrining.partials.question-row', ['qIndex' => $qIndex, 'pertanyaan' => $pertanyaan])
        @empty
            @include('admin.skrining.partials.question-row', ['qIndex' => 0, 'pertanyaan' => null])
        @endforelse
    </div>

    <button class="btn" style="margin-top:18px;" type="submit">Simpan Pertanyaan</button>
</form>

<template id="question-template">
    @include('admin.skrining.partials.question-row', ['qIndex' => '__INDEX__', 'pertanyaan' => null])
</template>

@push('scripts')
<script>
let questionIndex = document.querySelectorAll('.question-row').length;
function addQuestion() {
    const html = document.getElementById('question-template').innerHTML.replaceAll('__INDEX__', questionIndex);
    document.getElementById('question-list').insertAdjacentHTML('beforeend', html);
    questionIndex++;
}
function addAnswer(button) {
    const wrap = button.closest('.question-row').querySelector('.answer-list');
    const qIndex = button.closest('.question-row').dataset.index;
    const aIndex = wrap.querySelectorAll('.answer-row').length;
    wrap.insertAdjacentHTML('beforeend', `<div class="answer-row form-grid"><input type="hidden" name="pertanyaan[${qIndex}][jawaban][${aIndex}][id]"><div class="field"><label>Teks Jawaban</label><input class="input" name="pertanyaan[${qIndex}][jawaban][${aIndex}][teks]" required></div><div class="field"><label>Nilai</label><input class="input" type="number" min="0" name="pertanyaan[${qIndex}][jawaban][${aIndex}][nilai]" required></div></div>`);
}
</script>
@endpush
@endsection
