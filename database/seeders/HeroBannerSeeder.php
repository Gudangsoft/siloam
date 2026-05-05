<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HeroBanner;

class HeroBannerSeeder extends Seeder
{
    public function run(): void
    {
        $banners = [
            [
                'title'      => 'Melahirkan Pemimpin yang Takut Akan Tuhan',
                'subtitle'   => 'STT Siloam Medan — Pusat Pendidikan Teologi Kristen Terpercaya di Sumatera Utara',
                'button_text'   => 'Daftar Sekarang',
                'button_link'    => '/pmb/daftar',
                'order'      => 1,
                'is_active'  => true,
            ],
            [
                'title'      => 'Pendaftaran Mahasiswa Baru 2025/2026 Dibuka',
                'subtitle'   => 'Raih panggilanmu bersama kami. Jadilah hamba Tuhan yang berkarakter, kompeten, dan berdampak.',
                'button_text'   => 'Lihat Informasi PMB',
                'button_link'    => '/pmb',
                'order'      => 2,
                'is_active'  => true,
            ],
            [
                'title'      => 'Penelitian & Pengabdian Masyarakat',
                'subtitle'   => 'Mendorong penelitian teologis kontekstual yang memberi solusi bagi gereja dan masyarakat.',
                'button_text'   => 'Lihat Penelitian',
                'button_link'    => '/penelitian',
                'order'      => 3,
                'is_active'  => true,
            ],
        ];

        foreach ($banners as $banner) {
            HeroBanner::create($banner);
        }
    }
}
