<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $events = [
            [
                'title'        => 'Pendaftaran Mahasiswa Baru Tahun Akademik 2025/2026',
                'description'  => 'Pendaftaran Mahasiswa Baru STT Siloam Medan untuk Tahun Akademik 2025/2026 dibuka mulai Februari hingga Agustus 2025. Tersedia jalur reguler dan beasiswa.',
                'start_date'   => now()->addDays(5)->toDateString(),
                'end_date'     => now()->addDays(90)->toDateString(),
                'location'     => 'Kampus STT Siloam Medan & Online',
                'is_published' => true,
            ],
            [
                'title'        => 'Retreat Spiritual Mahasiswa Semester Ganjil 2025',
                'description'  => 'Retreat rohani tahunan untuk seluruh mahasiswa STT Siloam Medan. Tema: "Diperkuat dalam Tuhan". Pembicara: Pdt. Dr. Yohanes Sinaga.',
                'start_date'   => now()->addDays(15)->toDateString(),
                'end_date'     => now()->addDays(17)->toDateString(),
                'location'     => 'Wisma Siloam, Berastagi',
                'is_published' => true,
            ],
            [
                'title'        => 'Seminar Nasional Teologi dan Budaya',
                'description'  => 'Seminar nasional dengan tema "Injil dan Kearifan Lokal: Dialog Teologi dalam Konteks Budaya Batak". Terbuka untuk umum.',
                'start_date'   => now()->addDays(30)->toDateString(),
                'end_date'     => now()->addDays(30)->toDateString(),
                'location'     => 'Aula Utama STT Siloam Medan',
                'is_published' => true,
            ],
            [
                'title'        => 'Ujian Akhir Semester Genap 2024/2025',
                'description'  => 'Ujian Akhir Semester (UAS) Genap Tahun Akademik 2024/2025 akan dilaksanakan sesuai jadwal yang telah ditetapkan.',
                'start_date'   => now()->addDays(45)->toDateString(),
                'end_date'     => now()->addDays(52)->toDateString(),
                'location'     => 'Kampus STT Siloam Medan',
                'is_published' => true,
            ],
            [
                'title'        => 'Wisuda ke-29 STT Siloam Medan',
                'description'  => 'Upacara Wisuda ke-29 STT Siloam Medan bagi lulusan Tahun Akademik 2024/2025.',
                'start_date'   => now()->addDays(120)->toDateString(),
                'end_date'     => now()->addDays(120)->toDateString(),
                'location'     => 'Gedung Serbaguna Kampus STT Siloam Medan',
                'is_published' => true,
            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}
