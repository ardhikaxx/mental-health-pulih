<div class="question-row card" data-index="{{ $qIndex }}" style="box-shadow:none;">
    <input type="hidden" name="pertanyaan[{{ $qIndex }}][id]" value="{{ $pertanyaan?->id_pertanyaan }}">
    <div class="field">
        <label>Pertanyaan</label>
        <textarea class="textarea" name="pertanyaan[{{ $qIndex }}][teks]" required>{{ $pertanyaan?->pertanyaan }}</textarea>
    </div>
    <div class="answer-list grid" style="margin-top:12px;">
        @php $answers = $pertanyaan?->jawaban ?? collect(); @endphp
        @forelse ($answers as $aIndex => $jawaban)
            <div class="answer-row form-grid">
                <input type="hidden" name="pertanyaan[{{ $qIndex }}][jawaban][{{ $aIndex }}][id]" value="{{ $jawaban->id_jawaban }}">
                <div class="field"><label>Teks Jawaban</label><input class="input" name="pertanyaan[{{ $qIndex }}][jawaban][{{ $aIndex }}][teks]" value="{{ $jawaban->teks_jawaban }}" required></div>
                <div class="field"><label>Nilai</label><input class="input" type="number" min="0" name="pertanyaan[{{ $qIndex }}][jawaban][{{ $aIndex }}][nilai]" value="{{ $jawaban->nilai_jawaban }}" required></div>
            </div>
        @empty
            @foreach ([0, 1] as $aIndex)
                <div class="answer-row form-grid">
                    <input type="hidden" name="pertanyaan[{{ $qIndex }}][jawaban][{{ $aIndex }}][id]">
                    <div class="field"><label>Teks Jawaban</label><input class="input" name="pertanyaan[{{ $qIndex }}][jawaban][{{ $aIndex }}][teks]" required></div>
                    <div class="field"><label>Nilai</label><input class="input" type="number" min="0" name="pertanyaan[{{ $qIndex }}][jawaban][{{ $aIndex }}][nilai]" required></div>
                </div>
            @endforeach
        @endforelse
    </div>
    <button class="btn secondary" style="margin-top:12px;" type="button" onclick="addAnswer(this)">Tambah Jawaban</button>
</div>
