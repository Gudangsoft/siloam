<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Research;

class ResearchSeeder extends Seeder
{
    public function run(): void
    {
        $researches = [
            [
                'title'        => 'Teologi Inkarnasi sebagai Landasan Pelayanan Kontekstual di Sumatera Utara',
                'type'         => 'penelitian',
                'researcher'   => 'Dr. Samuel Siahaan, M.Th.',
                'abstract'     => 'Penelitian ini mengkaji relevansi teologi inkarnasi Kristus sebagai fondasi teologis bagi model pelayanan kontekstual yang efektif di tengah konteks budaya Batak-Melayu di Sumatera Utara.',
                'year'         => 2024,
                'is_published' => true,
            ],
            [
                'title'        => 'Efektivitas Metode Pengajaran Berbasis Narasi dalam PAK untuk Anak Usia Dini',
                'type'         => 'penelitian',
                'researcher'   => 'Drs. Hendra Simanjuntak, M.Pd.',
                'abstract'     => 'Penelitian ini mengevaluasi efektivitas metode pengajaran berbasis narasi Alkitab dalam Pendidikan Agama Kristen bagi anak usia dini di gereja-gereja di Medan.',
                'year'         => 2024,
                'is_published' => true,
            ],
            [
                'title'        => 'Model Konseling Pastoral bagi Keluarga Kristen yang Menghadapi Konflik',
                'type'         => 'penelitian',
                'researcher'   => 'Dra. Maria Simbolon, M.Th.',
                'abstract'     => 'Penelitian ini mengembangkan model konseling pastoral berbasis Alkitab yang efektif untuk membantu keluarga Kristen dalam menyelesaikan konflik rumah tangga.',
                'year'         => 2023,
                'is_published' => true,
            ],
            [
                'title'        => 'Pelayanan Literasi Digital bagi Lansia di Gereja-Gereja Medan',
                'type'         => 'pengabdian',
                'researcher'   => 'Tim LPPM STT Siloam Medan',
                'abstract'     => 'Program pengabdian masyarakat ini memberikan pelatihan literasi digital kepada kelompok lansia di gereja-gereja Kota Medan untuk mendukung partisipasi mereka dalam ibadah online.',
                'year'         => 2024,
                'is_published' => true,
            ],
            [
                'title'        => 'Pemberdayaan Ekonomi Jemaat melalui Koperasi Berbasis Gereja',
                'type'         => 'pengabdian',
                'researcher'   => 'Drs. Johanes Napitupulu, M.M.',
                'abstract'     => 'Program pengabdian ini mendampingi tiga gereja lokal dalam membentuk dan mengelola koperasi jemaat sebagai upaya pemberdayaan ekonomi umat.',
                'year'         => 2023,
                'is_published' => true,
            ],
            [
                'title'        => 'Studi tentang Spiritualitas Pemuda Kristen di Era Media Sosial',
                'type'         => 'penelitian',
                'researcher'   => 'Pdt. Daniel Situmorang, M.Th.',
                'abstract'     => 'Penelitian ini mengkaji pengaruh media sosial terhadap kehidupan spiritual pemuda Kristen dan mengidentifikasi strategi pembinaan iman yang relevan di era digital.',
                'year'         => 2023,
                'is_published' => true,
            ],
        ];

        foreach ($researches as $research) {
            Research::create($research);
        }
    }
}
