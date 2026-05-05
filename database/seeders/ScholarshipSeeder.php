<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Scholarship;

class ScholarshipSeeder extends Seeder
{
    public function run(): void
    {
        $scholarships = [
            [
                'name'         => 'Beasiswa Panggilan Pelayanan',
                'provider'     => 'Internal STT Siloam',
                'description'  => 'Beasiswa penuh untuk calon mahasiswa yang memiliki panggilan kuat dan keterbatasan ekonomi. Mencakup biaya pendidikan, asrama, dan biaya hidup selama studi.',
                'requirements' => 'Memiliki surat rekomendasi kuat dari gereja, IPK minimal 3.0, keterbatasan ekonomi dibuktikan dengan surat keterangan.',
                'amount'       => 'Biaya pendidikan penuh + uang saku Rp 500.000/bulan',
                'is_active'    => true,
            ],
            [
                'name'         => 'Beasiswa Prestasi Akademik',
                'provider'     => 'Internal STT Siloam',
                'description'  => 'Beasiswa untuk mahasiswa berprestasi akademik tinggi. Diberikan mulai semester 3 berdasarkan capaian IPK.',
                'requirements' => 'IPK minimal 3.5, aktif dalam kegiatan kampus, tidak sedang menerima beasiswa lain.',
                'amount'       => 'Pengurangan SPP 50% per semester',
                'is_active'    => true,
            ],
            [
                'name'         => 'Beasiswa Bidikmisi Kemenag',
                'provider'     => 'Kementerian Agama RI',
                'description'  => 'Beasiswa dari Kementerian Agama RI untuk mahasiswa dari keluarga kurang mampu secara ekonomi namun berprestasi.',
                'requirements' => 'Lulusan SMA/SMK dari keluarga kurang mampu, nilai rapor rata-rata minimal 7.5, surat keterangan tidak mampu.',
                'amount'       => 'Biaya pendidikan + biaya hidup sesuai ketentuan Kemenag',
                'is_active'    => true,
            ],
            [
                'name'         => 'Beasiswa Kerjasama GKPI',
                'provider'     => 'GKPI',
                'description'  => 'Beasiswa dari Gereja Kristen Protestan Indonesia (GKPI) untuk kader gereja yang terpanggil melayani.',
                'requirements' => 'Anggota/kader gereja GKPI, rekomendasi dari Majelis/Pendeta, komitmen melayani di GKPI setelah lulus.',
                'amount'       => 'Biaya pendidikan penuh',
                'is_active'    => true,
            ],
        ];

        foreach ($scholarships as $s) {
            Scholarship::create($s);
        }
    }
}
