<?php

namespace Database\Seeders;

use App\Models\HasilSkrining;
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
            ['PHQ-9 (Patient Health Questionnaire)', 'Depresi', 'Kuesioner standar untuk mengukur tingkat keparahan depresi.', 9],
            ['GAD-7 (Generalized Anxiety Disorder)', 'Kecemasan', 'Alat skrining standar untuk mendeteksi gangguan kecemasan umum.', 7],
            ['PSS-10 (Perceived Stress Scale)', 'Stres', 'Skala untuk mengukur persepsi stres seseorang dalam sebulan terakhir.', 10],
        ];

        foreach ($jenisSkrining as [$nama, $penyakit, $deskripsi, $jumlah]) {
            $jenis = JenisSkrining::firstOrCreate([
                'nama_skrining' => $nama,
            ], [
                'jenis_penyakit' => $penyakit,
                'deskripsi' => $deskripsi,
                'status' => 'publish',
                'jumlah_pertanyaan' => $jumlah,
                'panduan_pengelolaan' => "Skor rendah: pantau berkala\nSkor sedang: pertimbangkan konsultasi\nSkor tinggi: disarankan konsultasi psikolog",
                'dibuat_oleh' => $adminUser->id_user,
            ]);

            if ($jenis->pertanyaan()->count() === 0) {
                foreach ($this->pertanyaanUntuk($penyakit, $jumlah) as $index => $teks) {
                    $pertanyaan = PertanyaanSkrining::create([
                        'id_jenis_skrining' => $jenis->id_jenis_skrining,
                        'pertanyaan' => $teks,
                        'urutan' => $index + 1,
                        'status' => 'aktif',
                    ]);

                    foreach ($this->jawabanStandar($penyakit) as $answerIndex => [$label, $nilai]) {
                        JawabanSkrining::create([
                            'id_pertanyaan' => $pertanyaan->id_pertanyaan,
                            'teks_jawaban' => $label,
                            'nilai_jawaban' => $nilai,
                            'urutan' => $answerIndex + 1,
                        ]);
                    }
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
                'Kurang tertarik atau tidak merasa senang melakukan hal apapun',
                'Merasa sedih, murung, atau putus asa',
                'Sulit tidur atau terlalu banyak tidur',
                'Merasa lelah atau kurang bertenaga',
                'Kurang nafsu makan atau makan berlebihan',
                'Merasa buruk tentang diri sendiri',
                'Sulit berkonsentrasi',
                'Bergerak atau berbicara sangat lambat atau gelisah',
                'Terpikir menyakiti diri sendiri',
            ],
            'Kecemasan' => [
                'Merasa gugup, cemas, atau sangat tegang',
                'Tidak mampu menghentikan rasa khawatir',
                'Terlalu khawatir tentang berbagai hal',
                'Kesulitan untuk bersantai',
                'Sangat gelisah sehingga sulit duduk diam',
                'Mudah kesal atau mudah marah',
                'Merasa takut seolah sesuatu buruk akan terjadi',
            ],
            'Stres' => [
                'Seberapa sering kesal karena sesuatu terjadi tidak terduga?',
                'Seberapa sering merasa tidak mampu mengendalikan hal penting?',
                'Seberapa sering merasa gugup dan tertekan?',
                'Seberapa sering yakin mampu menangani masalah pribadi?',
                'Seberapa sering merasa segala sesuatu berjalan sesuai keinginan?',
                'Seberapa sering merasa tidak bisa mengatasi semua hal?',
                'Seberapa sering mampu mengendalikan rasa jengkel?',
                'Seberapa sering merasa menguasai situasi?',
                'Seberapa sering marah karena hal di luar kendali?',
                'Seberapa sering merasa kesulitan menumpuk terlalu tinggi?',
            ],
        ];

        return array_slice($base[$penyakit] ?? $base['Stres'], 0, $jumlah);
    }

    private function jawabanStandar(string $penyakit): array
    {
        if ($penyakit === 'Stres') {
            return [
                ['Tidak pernah', 0],
                ['Hampir tidak pernah', 1],
                ['Kadang-kadang', 2],
                ['Cukup sering', 3],
                ['Sangat sering', 4],
            ];
        }

        return [
            ['Tidak sama sekali', 0],
            ['Beberapa hari', 1],
            ['Lebih dari separuh waktu', 2],
            ['Hampir setiap hari', 3],
        ];
    }
}
