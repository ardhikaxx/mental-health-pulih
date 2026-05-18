<?php

namespace Database\Seeders;

use App\Models\HasilSkrining;
use App\Models\DetailHasilSkrining;
use App\Models\JawabanSkrining;
use App\Models\JadwalPsikolog;
use App\Models\JenisSkrining;
use App\Models\KategoriEdukasi;
use App\Models\KontenEdukasi;
use App\Models\Konsultasi;
use App\Models\PendaftaranKonsultasi;
use App\Models\PertanyaanPemantauan;
use App\Models\PertanyaanSkrining;
use App\Models\RingkasanPasien;
use App\Models\TbAdmin;
use App\Models\TbPasien;
use App\Models\TbPsikolog;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $adminUser = User::firstOrCreate([
            'email' => 'admin@ruangpulih.test',
        ], [
            'nama_lengkap' => 'Admin Ruang Pulih',
            'password' => Hash::make('password'),
            'nomor_telepon' => '081200000001',
            'jenis_kelamin' => 'perempuan',
            'role' => 'admin',
            'status_akun' => 'aktif',
        ]);

        $admin = TbAdmin::firstOrCreate([
            'id_user' => $adminUser->id_user,
        ]);

        $psikologData = [
            ['Siti Aisa Nur', 'siti.psikolog@ruangpulih.test', 'Kecemasan dan stres', 'SIPA-2026-001', 'S.Psi., M.Psi', 5],
            ['Christella E. S.Psi., M.Psi', 'christella@ruangpulih.test', 'Depresi dan trauma', 'SIPA-2026-002', 'S.Psi., M.Psi', 7],
            ['Annida Aulia', 'annida.psikolog@ruangpulih.test', 'Remaja dan keluarga', 'SIPA-2026-003', 'S.Psi., M.Psi', 4],
        ];

        $psikologs = collect($psikologData)->map(function ($data) use ($admin) {
            [$nama, $email, $spesialisasi, $sipa, $pendidikan, $pengalaman] = $data;

            $user = User::firstOrCreate([
                'email' => $email,
            ], [
                'nama_lengkap' => $nama,
                'password' => Hash::make('password'),
                'nomor_telepon' => '0812'.random_int(10000000, 99999999),
                'jenis_kelamin' => 'perempuan',
                'role' => 'psikolog',
                'status_akun' => 'aktif',
            ]);

            return TbPsikolog::firstOrCreate([
                'id_user' => $user->id_user,
            ], [
                'spesialisasi' => $spesialisasi,
                'nomor_sipa' => $sipa,
                'pendidikan' => $pendidikan,
                'pengalaman' => $pengalaman,
                'bio' => 'Berpengalaman membantu pasien memahami kondisi mental dan membangun strategi pemulihan yang realistis.',
                'status_psikolog' => 'aktif',
                'dibuat_oleh' => $admin->id_admin,
            ]);
        });

        $pasienData = [
            ['Leonita Yulyta Agustin', 'leonita@ruangpulih.test', 22, 'perempuan'],
            ['Annida Tri Aulia', 'annida@ruangpulih.test', 21, 'perempuan'],
            ['Kafi Khaula Yukisa Zailina', 'kafi@ruangpulih.test', 23, 'perempuan'],
            ['Siti Aisa Nur Apriliana', 'sitiaisa@ruangpulih.test', 22, 'perempuan'],
        ];

        $pasiens = collect($pasienData)->map(function ($data) {
            [$nama, $email, $umur, $gender] = $data;

            $user = User::firstOrCreate([
                'email' => $email,
            ], [
                'nama_lengkap' => $nama,
                'password' => Hash::make('password'),
                'nomor_telepon' => '0813'.random_int(10000000, 99999999),
                'jenis_kelamin' => $gender,
                'role' => 'pasien',
                'status_akun' => 'aktif',
            ]);

            return TbPasien::firstOrCreate([
                'id_user' => $user->id_user,
            ], [
                'umur' => $umur,
                'tanggal_daftar' => now()->subDays(random_int(3, 30))->toDateString(),
                'status_pasien' => 'aktif',
            ]);
        });

        $kategori = collect([
            ['Kesehatan Mental', 'Informasi umum kesehatan mental'],
            ['Tips Stres', 'Panduan mengelola stres'],
            ['Self Improvement', 'Pengembangan diri dan kebiasaan sehat'],
            ['Trauma', 'Edukasi trauma dan pemulihan'],
            ['Gaya Hidup', 'Kebiasaan harian pendukung kesehatan mental'],
        ])->map(fn ($item) => KategoriEdukasi::firstOrCreate([
            'nama_kategori' => $item[0],
        ], [
            'deskripsi' => $item[1],
            'status' => 'aktif',
        ]))->keyBy('nama_kategori');

        $konten = [
            ['artikel', '4 Manfaat Support System untuk Kesehatan Mental yang Perlu Diketahui', 'Kesehatan Mental', 'Dukungan dari orang sekitar dapat menjadi kekuatan besar dalam proses pemulihan. Support system membantu seseorang merasa didengar, diterima, dan tidak sendirian ketika menghadapi masa sulit.', null, null, 'publish'],
            ['artikel', 'Stres - Gejala, Penyebab, dan Pengobatan', 'Tips Stres', 'Kenali stres lebih dalam dan cara efektif untuk mengelolanya dengan sehat. Stres yang dikelola dengan tepat dapat membantu tubuh kembali seimbang.', null, null, 'publish'],
            ['artikel', '7 Cara Mengatasi Overwhelmed agar Hidup Lebih Tenang', 'Self Improvement', 'Langkah-langkah sederhana untuk menjaga kesehatan mental saat merasa kewalahan, mulai dari mengatur prioritas hingga latihan pernapasan.', null, null, 'publish'],
            ['artikel', 'Memahami Trauma dan Proses Penyembuhan', 'Trauma', 'Trauma dapat diproses secara bertahap melalui dukungan aman, validasi emosi, dan bantuan profesional bila diperlukan.', null, null, 'draft'],
            ['video', 'Teknik Pernapasan untuk Mengatasi Kecemasan', 'Tips Stres', null, 'https://youtu.be/0LqWXlBfBxE?si=BgaJ7UxrHzvmoyrO', '08:30', 'publish'],
            ['video', 'Meditasi Mindfulness untuk Pemula', 'Gaya Hidup', null, 'https://youtu.be/WTqhSiqch5k?si=cbSCcZK0YXsnl31R', '15:45', 'publish'],
        ];

        foreach ($konten as [$tipe, $judul, $namaKategori, $isi, $url, $durasi, $status]) {
            KontenEdukasi::updateOrCreate([
                'slug' => Str::slug($judul),
            ], [
                'id_kategori' => $kategori[$namaKategori]->id_kategori,
                'id_penulis' => $adminUser->id_user,
                'tipe_konten' => $tipe,
                'judul_konten' => $judul,
                'isi_artikel' => $isi,
                'url_video' => $url,
                'durasi_video' => $durasi,
                'status' => $status,
                'tanggal_publish' => $status === 'publish' ? now()->subDays(random_int(1, 14)) : null,
            ]);
        }

        $jenisSkrining = [
            ['Anxiety disorders', 'Anxiety disorders', 'Skrining awal untuk mengenali gejala kecemasan berlebih, kekhawatiran sulit dikendalikan, dan gejala fisik yang menyertai kecemasan.', 10],
            ['Depresi', 'Depresi', 'Skrining awal untuk mengenali gejala depresi seperti suasana hati rendah, kehilangan minat, perubahan tidur, dan rasa tidak berharga.', 10],
            ['Skizofrenia', 'Skizofrenia', 'Skrining awal untuk mengenali gejala psikosis seperti halusinasi, kecurigaan berlebih, pikiran tidak teratur, dan penarikan sosial.', 10],
            ['BPD', 'BPD', 'Skrining awal untuk mengenali pola emosi intens, ketakutan ditinggalkan, relasi tidak stabil, dan perilaku impulsif.', 10],
            ['PTSD', 'PTSD', 'Skrining awal untuk mengenali gejala pascatrauma seperti ingatan mengganggu, menghindari pemicu, kewaspadaan tinggi, dan perubahan suasana hati.', 10],
            ['Bipolar', 'Bipolar', 'Skrining awal untuk mengenali perubahan suasana hati ekstrem, periode energi meningkat, impulsivitas, dan episode suasana hati rendah.', 10],
        ];

        $namaSkriningAktif = collect($jenisSkrining)->pluck(0)->all();
        $skriningLama = JenisSkrining::whereNotIn('nama_skrining', $namaSkriningAktif)->pluck('id_jenis_skrining');

        if ($skriningLama->isNotEmpty()) {
            $hasilLama = HasilSkrining::whereIn('id_jenis_skrining', $skriningLama)->pluck('id_hasil_skrining');
            DetailHasilSkrining::whereIn('id_hasil_skrining', $hasilLama)->delete();
            HasilSkrining::whereIn('id_hasil_skrining', $hasilLama)->delete();
            JenisSkrining::whereIn('id_jenis_skrining', $skriningLama)->delete();
        }

        foreach ($jenisSkrining as [$nama, $penyakit, $deskripsi, $jumlah]) {
            $jenis = JenisSkrining::updateOrCreate([
                'nama_skrining' => $nama,
            ], [
                'jenis_penyakit' => $penyakit,
                'deskripsi' => $deskripsi,
                'status' => 'publish',
                'jumlah_pertanyaan' => $jumlah,
                'panduan_pengelolaan' => "Skor rendah: pantau berkala\nSkor sedang: pertimbangkan konsultasi\nSkor tinggi: disarankan konsultasi psikolog",
                'dibuat_oleh' => $adminUser->id_user,
            ]);

            $hasilSkrining = HasilSkrining::where('id_jenis_skrining', $jenis->id_jenis_skrining)->pluck('id_hasil_skrining');
            DetailHasilSkrining::whereIn('id_hasil_skrining', $hasilSkrining)->delete();
            HasilSkrining::whereIn('id_hasil_skrining', $hasilSkrining)->delete();
            $jenis->pertanyaan()->delete();

            foreach ($this->pertanyaanUntuk($penyakit, $jumlah) as $index => $teks) {
                $pertanyaan = PertanyaanSkrining::create([
                    'id_jenis_skrining' => $jenis->id_jenis_skrining,
                    'pertanyaan' => $teks,
                    'urutan' => $index + 1,
                    'status' => 'aktif',
                ]);

                foreach ($this->jawabanStandar() as $answerIndex => [$label, $nilai]) {
                    JawabanSkrining::create([
                        'id_pertanyaan' => $pertanyaan->id_pertanyaan,
                        'teks_jawaban' => $label,
                        'nilai_jawaban' => $nilai,
                        'urutan' => $answerIndex + 1,
                    ]);
                }
            }
        }

        foreach ([
            'Apakah kamu merasa sedih hari ini?',
            'Apakah kamu merasa cemas atau khawatir?',
            'Apakah kamu merasa tidak berharga atau putus asa?',
            'Apakah kamu pernah mendengar suara yang orang lain tidak dengar?',
        ] as $index => $teks) {
            PertanyaanPemantauan::firstOrCreate([
                'pertanyaan' => $teks,
            ], [
                'urutan' => $index + 1,
                'status' => 'aktif',
            ]);
        }

        $slots = [
            ['08:00', '09:00'],
            ['09:00', '10:00'],
            ['10:00', '11:00'],
            ['13:00', '14:00'],
            ['14:00', '15:00'],
        ];

        foreach ($psikologs as $psikolog) {
            for ($day = 0; $day <= 10; $day++) {
                $date = now()->addDays($day);

                if ($date->isSunday()) {
                    continue;
                }

                foreach ($slots as [$mulai, $selesai]) {
                    JadwalPsikolog::firstOrCreate([
                        'id_psikolog' => $psikolog->id_psikolog,
                        'tanggal' => $date->toDateString(),
                        'jam_mulai' => $mulai,
                    ], [
                        'jam_selesai' => $selesai,
                        'status_jadwal' => 'tersedia',
                    ]);
                }
            }
        }

        $samplePasien = $pasiens->first();
        $samplePsikolog = $psikologs->first();
        $sampleJadwal = JadwalPsikolog::where('id_psikolog', $samplePsikolog->id_psikolog)->where('status_jadwal', 'tersedia')->first();

        if ($samplePasien && $samplePsikolog && $sampleJadwal) {
            $pendaftaran = PendaftaranKonsultasi::firstOrCreate([
                'id_pasien' => $samplePasien->id_pasien,
                'email' => $samplePasien->user->email,
                'keluhan' => 'Merasa cemas dan sulit tidur beberapa hari terakhir.',
            ], [
                'nama_lengkap' => $samplePasien->user->nama_lengkap,
                'umur' => $samplePasien->umur ?? 22,
                'jenis_kelamin' => $samplePasien->user->jenis_kelamin ?? 'perempuan',
                'tingkat_urgensi' => 'sedang',
                'persetujuan_syarat' => true,
                'status_pendaftaran' => 'disetujui',
            ]);

            Konsultasi::firstOrCreate([
                'id_pendaftaran_konsultasi' => $pendaftaran->id_pendaftaran_konsultasi,
            ], [
                'id_pasien' => $samplePasien->id_pasien,
                'id_psikolog' => $samplePsikolog->id_psikolog,
                'id_jadwal' => $sampleJadwal->id_jadwal,
                'tanggal_konsultasi' => $sampleJadwal->tanggal,
                'waktu_mulai' => $sampleJadwal->jam_mulai,
                'waktu_selesai' => $sampleJadwal->jam_selesai,
                'status_konsultasi' => 'disetujui',
            ]);
            $sampleJadwal->update(['status_jadwal' => 'terpakai']);
        }

        foreach ($pasiens as $index => $pasien) {
            RingkasanPasien::firstOrCreate([
                'id_pasien' => $pasien->id_pasien,
            ], [
                'kondisi_terakhir' => ['Stres Ringan', 'Cemas Sedang', 'Cemas Tinggi'][$index] ?? 'Stabil',
                'skor_terakhir' => [32, 58, 72][$index] ?? 20,
                'perubahan' => $index === 0 ? 'membaik' : 'memburuk',
                'prioritas' => $index === 2 ? 'tinggi' : 'sedang',
                'keterangan' => 'Data contoh untuk pemantauan psikolog.',
                'tanggal_update' => now()->subDays($index)->toDateString(),
            ]);
        }

        $jenisPertama = JenisSkrining::first();
        if ($jenisPertama && $samplePasien) {
            HasilSkrining::firstOrCreate([
                'id_pasien' => $samplePasien->id_pasien,
                'id_jenis_skrining' => $jenisPertama->id_jenis_skrining,
                'tanggal_skrining' => today()->subDay()->toDateString(),
            ], [
                'total_skor' => 12,
                'kategori_hasil' => 'sedang',
                'keterangan_hasil' => 'Data contoh hasil skrining.',
            ]);
        }
    }

    private function pertanyaanUntuk(string $penyakit, int $jumlah): array
    {
        $base = [
            'Depresi' => [
                'Kurang tertarik atau tidak merasa senang melakukan aktivitas yang biasanya disukai',
                'Merasa sedih, kosong, murung, atau putus asa',
                'Sulit tidur, sering terbangun, atau tidur terlalu banyak',
                'Merasa lelah, tidak bertenaga, atau sulit memulai aktivitas',
                'Nafsu makan berkurang atau meningkat secara jelas',
                'Merasa gagal, tidak berharga, atau terlalu menyalahkan diri sendiri',
                'Sulit berkonsentrasi saat belajar, bekerja, atau berbicara',
                'Bergerak atau berbicara lebih lambat dari biasanya, atau justru sangat gelisah',
                'Merasa masa depan tidak punya harapan',
                'Terpikir untuk menyakiti diri sendiri atau merasa lebih baik jika tidak ada',
            ],
            'Anxiety disorders' => [
                'Merasa gugup, cemas, atau sangat tegang tanpa alasan yang jelas',
                'Sulit menghentikan atau mengendalikan rasa khawatir',
                'Terlalu khawatir terhadap banyak hal dalam kehidupan sehari-hari',
                'Sulit merasa rileks walaupun sedang tidak menghadapi masalah besar',
                'Merasa gelisah sampai sulit duduk diam',
                'Mudah panik atau merasa akan kehilangan kendali',
                'Jantung berdebar, napas terasa pendek, atau tubuh gemetar saat cemas',
                'Menghindari situasi tertentu karena takut cemas atau panik muncul',
                'Mudah kesal, tegang, atau sensitif saat merasa khawatir',
                'Merasa takut seolah sesuatu yang buruk akan terjadi',
            ],
            'Skizofrenia' => [
                'Mendengar suara yang tidak didengar orang lain',
                'Melihat, mencium, atau merasakan sesuatu yang tidak dialami orang lain',
                'Merasa ada orang yang ingin mencelakai, mengawasi, atau mengikuti',
                'Merasa pikiran dikendalikan, disisipkan, atau dibaca oleh orang lain',
                'Sulit menyusun pikiran sehingga ucapan terasa meloncat-loncat',
                'Sulit membedakan pengalaman nyata dan tidak nyata',
                'Menarik diri dari keluarga, teman, atau aktivitas sosial',
                'Ekspresi emosi terasa datar atau sulit menunjukkan perasaan',
                'Sulit menjaga kebersihan diri, rutinitas, atau tanggung jawab harian',
                'Merasa sangat yakin pada sesuatu meski orang lain memberi bukti sebaliknya',
            ],
            'BPD' => [
                'Sangat takut ditinggalkan atau diabaikan oleh orang terdekat',
                'Hubungan dengan orang lain sering berubah dari sangat dekat menjadi sangat buruk',
                'Suasana hati berubah cepat dan terasa sangat intens',
                'Sulit mengendalikan marah atau sering merasa marah berlebihan',
                'Merasa kosong, hampa, atau tidak tahu siapa diri sendiri',
                'Melakukan hal impulsif yang berisiko saat emosi sedang kuat',
                'Pikiran untuk menyakiti diri sendiri muncul saat merasa tertekan',
                'Sulit menenangkan diri setelah konflik atau penolakan',
                'Merasa curiga atau tidak nyata saat sedang sangat stres',
                'Penilaian terhadap diri sendiri sering berubah drastis',
            ],
            'PTSD' => [
                'Ingatan tentang peristiwa traumatis muncul tiba-tiba dan mengganggu',
                'Mengalami mimpi buruk yang berkaitan dengan pengalaman traumatis',
                'Merasa seolah peristiwa traumatis terjadi kembali',
                'Menghindari tempat, orang, percakapan, atau aktivitas yang mengingatkan pada trauma',
                'Sulit mengingat bagian penting dari peristiwa traumatis',
                'Merasa bersalah, malu, takut, atau marah sejak peristiwa tersebut',
                'Kehilangan minat pada aktivitas atau merasa jauh dari orang lain',
                'Mudah terkejut, selalu waspada, atau merasa tidak aman',
                'Sulit tidur atau sulit berkonsentrasi setelah pengalaman traumatis',
                'Mudah tersulut emosi atau melakukan tindakan berisiko setelah trauma',
            ],
            'Bipolar' => [
                'Mengalami periode sangat berenergi atau sangat aktif lebih dari biasanya',
                'Merasa sangat percaya diri, hebat, atau mampu melakukan banyak hal sekaligus',
                'Tidur jauh lebih sedikit tetapi tetap merasa bertenaga',
                'Berbicara lebih cepat atau lebih banyak dari biasanya',
                'Pikiran terasa berlomba-lomba atau sulit dihentikan',
                'Mudah terdistraksi dan sulit menyelesaikan kegiatan',
                'Melakukan keputusan impulsif seperti belanja berlebihan atau mengambil risiko besar',
                'Mengalami periode suasana hati sangat rendah setelah masa energi tinggi',
                'Perubahan suasana hati mengganggu hubungan, pekerjaan, atau sekolah',
                'Orang sekitar pernah menilai perubahan energi atau suasana hati kamu tidak biasa',
            ],
        ];

        return array_slice($base[$penyakit] ?? $base['Depresi'], 0, $jumlah);
    }

    private function jawabanStandar(): array
    {
        return [
            ['Tidak pernah', 0],
            ['Jarang', 1],
            ['Kadang-kadang', 2],
            ['Sering', 3],
            ['Sangat sering', 4],
        ];
    }
}
