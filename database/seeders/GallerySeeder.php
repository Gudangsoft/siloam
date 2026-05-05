<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gallery;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['title' => 'Wisuda ke-28',                  'category' => 'wisuda',      'is_published' => true, 'order' => 1],
            ['title' => 'Kegiatan Retreat Mahasiswa',    'category' => 'kegiatan',    'is_published' => true, 'order' => 2],
            ['title' => 'Seminar Nasional Teologi',      'category' => 'seminar',     'is_published' => true, 'order' => 3],
            ['title' => 'Kampus STT Siloam Medan',       'category' => 'kampus',      'is_published' => true, 'order' => 4],
            ['title' => 'KKN Mahasiswa di Daerah 3T',   'category' => 'kegiatan',    'is_published' => true, 'order' => 5],
            ['title' => 'Ibadah Kapel Kampus',           'category' => 'rohani',      'is_published' => true, 'order' => 6],
            ['title' => 'Perpustakaan Digital',          'category' => 'fasilitas',   'is_published' => true, 'order' => 7],
            ['title' => 'Pertandingan Olahraga Kampus',  'category' => 'olahraga',    'is_published' => true, 'order' => 8],
        ];

        foreach ($items as $item) {
            Gallery::create($item);
        }
    }
}
