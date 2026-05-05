<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Alumni;

class AlumniSeeder extends Seeder
{
    public function run(): void
    {
        $alumni = [
            [
                'name'             => 'Pdt. Dr. Herry Simanullang',
                'nim'              => '9403001',
                'study_program'    => 'Teologi S1',
                'graduation_year'  => '1998',
                'current_position' => 'Pendeta Senior',
                'current_company'  => 'GKPI Rayon Medan',
                'email'            => 'herry.simanullang@gkpi.or.id',
                'testimonial'      => 'STT Siloam Medan membentuk saya menjadi hamba Tuhan yang tidak hanya pintar berbicara, tetapi juga rendah hati melayani. Saya sangat bersyukur atas didikan yang saya terima di sini.',
                'is_featured'      => true,
                'is_published'     => true,
            ],
            [
                'name'             => 'Pdt. Margareth Sihombing, M.Th.',
                'nim'              => '9503015',
                'study_program'    => 'Teologi S1',
                'graduation_year'  => '1999',
                'current_position' => 'Direktur Eksekutif',
                'current_company'  => 'Yayasan Misi Sumatera',
                'email'            => 'margareth@misisu.org',
                'testimonial'      => 'Pendidikan di STT Siloam Medan memberikan saya fondasi teologi yang kuat dan hati yang tulus untuk melayani. Kini saya bisa melayani ratusan ribu jemaat melalui pelayanan misi.',
                'is_featured'      => true,
                'is_published'     => true,
            ],
            [
                'name'             => 'Prof. Dr. Binsar Pakpahan',
                'nim'              => '9803042',
                'study_program'    => 'Teologi S1',
                'graduation_year'  => '2002',
                'current_position' => 'Profesor Teologi',
                'current_company'  => 'Universitas Kristen Indonesia',
                'email'            => 'binsar.pakpahan@uki.ac.id',
                'testimonial'      => 'Dari kampus inilah saya mulai mencintai studi teologi secara akademis. Dosen-dosen yang luar biasa menginspirasi saya untuk terus belajar hingga meraih gelar profesor.',
                'is_featured'      => true,
                'is_published'     => true,
            ],
            [
                'name'             => 'Pdt. Fransiska Naibaho',
                'nim'              => '0103078',
                'study_program'    => 'Pendidikan Agama Kristen S1',
                'graduation_year'  => '2005',
                'current_position' => 'Kepala Sekolah',
                'current_company'  => 'SD Kristen Immanuel Medan',
                'is_featured'      => false,
                'is_published'     => true,
            ],
            [
                'name'             => 'Daniel Turnip, M.Mus.',
                'nim'              => '0503099',
                'study_program'    => 'Musik Gerejawi S1',
                'graduation_year'  => '2009',
                'current_position' => 'Worship Director',
                'current_company'  => 'GBI Medan Selatan',
                'testimonial'      => 'Program Musik Gerejawi di STT Siloam Medan sangat komprehensif. Saya belajar bukan hanya teknik bermusik, tetapi bagaimana membawa jemaat ke hadirat Tuhan melalui penyembahan.',
                'is_featured'      => true,
                'is_published'     => true,
            ],
            [
                'name'             => 'Ruth Simbolon, M.Th.',
                'nim'              => '1003120',
                'study_program'    => 'Teologi S1',
                'graduation_year'  => '2014',
                'current_position' => 'Misionaris',
                'current_company'  => 'Lembaga Misi Lintas Budaya Indonesia',
                'testimonial'      => 'STT Siloam Medan membekali saya dengan keberanian dan pengetahuan untuk melayani lintas budaya. Kini saya melayani di pedalaman Kalimantan dengan sukacita.',
                'is_featured'      => true,
                'is_published'     => true,
            ],
        ];

        foreach ($alumni as $a) {
            Alumni::create($a);
        }
    }
}
