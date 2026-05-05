<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StudentAchievement;

class StudentAchievementSeeder extends Seeder
{
    public function run(): void
    {
        $achievements = [
            [
                'title'         => 'Juara 1 Lomba Debat Teologi Tingkat Nasional',
                'student_name'  => 'Joshua Situmorang',
                'study_program' => 'Teologi S1',
                'level'         => 'nasional',
                'award'         => 'Juara 1',
                'description'   => 'Meraih juara 1 dalam Lomba Debat Teologi Nasional yang diselenggarakan oleh Asosiasi Sekolah Teologi Indonesia di Jakarta.',
                'year'          => 2024,
                'is_published'  => true,
            ],
            [
                'title'         => 'Juara 2 Paduan Suara Rohani Tingkat Internasional',
                'student_name'  => 'Tim Paduan Suara STT Siloam',
                'study_program' => 'Musik Gerejawi S1',
                'level'         => 'internasional',
                'award'         => 'Juara 2',
                'description'   => 'Tim Paduan Suara meraih juara 2 dalam kompetisi paduan suara gerejawi internasional di Singapura.',
                'year'          => 2024,
                'is_published'  => true,
            ],
            [
                'title'         => 'Pemenang Karya Tulis Ilmiah Teologi Terbaik',
                'student_name'  => 'Deborah Sinaga',
                'study_program' => 'Teologi S1',
                'level'         => 'nasional',
                'award'         => 'Juara 1',
                'description'   => 'Karya tulis berjudul "Teologi Feminis dalam Konteks Budaya Batak" terpilih sebagai karya terbaik dalam Lomba KTI Nasional.',
                'year'          => 2023,
                'is_published'  => true,
            ],
            [
                'title'         => 'Mahasiswa Berprestasi STT Siloam Medan',
                'student_name'  => 'Andreas Napitupulu',
                'study_program' => 'PAK S1',
                'level'         => 'lokal',
                'award'         => 'Mahasiswa Berprestasi',
                'description'   => 'Terpilih sebagai Mahasiswa Berprestasi Utama STT Siloam Medan dengan IPK 3.92 dan rekam jejak pelayanan yang luar biasa.',
                'year'          => 2023,
                'is_published'  => true,
            ],
            [
                'title'         => 'Juara 3 Lomba Khotbah Pemuda Tingkat Regional',
                'student_name'  => 'Grace Tambunan',
                'study_program' => 'Teologi S1',
                'level'         => 'regional',
                'award'         => 'Juara 3',
                'description'   => 'Meraih juara 3 dalam lomba khotbah pemuda Kristen tingkat regional Sumatera.',
                'year'          => 2023,
                'is_published'  => true,
            ],
        ];

        foreach ($achievements as $achievement) {
            StudentAchievement::create($achievement);
        }
    }
}
