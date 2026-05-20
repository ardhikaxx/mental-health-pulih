<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Hasil Skrining - Ruang Pulih</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; color: #333; line-height: 1.6; }
        .header { text-align: center; border-bottom: 2px solid #005c34; padding-bottom: 20px; margin-bottom: 30px; }
        .logo { font-size: 28px; font-weight: bold; color: #005c34; margin-bottom: 5px; }
        .subtitle { font-size: 14px; color: #666; }
        
        .section { margin-bottom: 25px; }
        .section-title { font-size: 18px; font-weight: bold; color: #005c34; border-left: 4px solid #005c34; padding-left: 10px; margin-bottom: 15px; }
        
        .info-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .info-table td { padding: 8px 0; vertical-align: top; }
        .info-label { width: 150px; font-weight: bold; color: #555; }
        
        .result-box { background: #f0fdf4; border-radius: 10px; padding: 20px; border: 1px solid #005c34; text-align: center; }
        .score { font-size: 36px; font-weight: bold; color: #005c34; margin: 10px 0; }
        .category { font-size: 20px; font-weight: bold; text-transform: uppercase; color: #005c34; }
        
        .question-list { list-style: none; padding: 0; }
        .question-item { margin-bottom: 15px; padding-bottom: 10px; border-bottom: 1px solid #eee; }
        .question-text { font-weight: bold; font-size: 14px; margin-bottom: 5px; }
        .answer-text { font-size: 13px; color: #666; }
        
        .footer { position: fixed; bottom: 0; width: 100%; text-align: center; font-size: 10px; color: #999; border-top: 1px solid #eee; padding-top: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">Ruang Pulih</div>
        <div class="subtitle">Layanan Kesehatan Mental Digital</div>
        <div style="font-size: 12px; margin-top: 10px;">LAPORAN HASIL SKRINING MANDIRI</div>
    </div>

    <div class="section">
        <div class="section-title">Informasi Pasien</div>
        <table class="info-table">
            <tr>
                <td class="info-label">Nama Lengkap</td>
                <td>: {{ $pasien->user->nama_lengkap }}</td>
            </tr>
            <tr>
                <td class="info-label">Email</td>
                <td>: {{ $pasien->user->email }}</td>
            </tr>
            <tr>
                <td class="info-label">Tanggal Tes</td>
                <td>: {{ $hasil->tanggal_skrining->translatedFormat('d F Y') }}</td>
            </tr>
            <tr>
                <td class="info-label">Jenis Skrining</td>
                <td>: {{ $hasil->jenisSkrining->nama_skrining }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Hasil Analisis</div>
        <div class="result-box">
            <div style="font-size: 14px; color: #555;">Total Skor Anda</div>
            <div class="score">{{ $hasil->total_skor }}</div>
            <div class="category">Kategori: {{ $hasil->kategori_hasil }}</div>
            <p style="margin-top: 15px; font-size: 14px; color: #333;">{{ $hasil->keterangan_hasil }}</p>
        </div>
    </div>

    <div class="section" style="page-break-before: always;">
        <div class="section-title">Detail Jawaban</div>
        <div class="question-list">
            @foreach($hasil->detail as $index => $item)
                <div class="question-item">
                    <div class="question-text">{{ $index + 1 }}. {{ $item->pertanyaan->pertanyaan }}</div>
                    <div class="answer-text">Jawaban: {{ $item->jawaban->teks_jawaban }} (Skor: {{ $item->nilai_jawaban }})</div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="section">
        <div class="section-title">Catatan Penting</div>
        <p style="font-size: 12px; color: #666; font-style: italic;">
            Hasil skrining ini bukan merupakan diagnosis medis final. Skrining mandiri bertujuan untuk memberikan gambaran awal kondisi kesehatan mental Anda. Jika Anda merasa terganggu atau hasil menunjukkan tingkat sedang hingga berat, sangat disarankan untuk melakukan konsultasi lebih lanjut dengan psikolog profesional kami di platform Ruang Pulih.
        </p>
    </div>

    <div class="footer">
        Dicetak secara otomatis melalui Sistem Ruang Pulih pada {{ now()->format('d/m/Y H:i') }}. Laporan ini adalah rahasia.
    </div>
</body>
</html>
