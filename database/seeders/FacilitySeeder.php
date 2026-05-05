<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Facility;

class FacilitySeeder extends Seeder
{
    public function run(): void
    {
        $facilities = [
            ['name' => 'Perpustakaan', 'description' => 'Perpustakaan dengan koleksi lebih dari 15.000 judul buku teologi, PAK, dan ilmu sosial, dilengkapi akses jurnal digital internasional.', 'is_published' => true, 'order' => 1],
            ['name' => 'Laboratorium Komputer', 'description' => '40 unit komputer modern dengan koneksi internet cepat untuk mendukung kegiatan akademis dan penelitian mahasiswa.', 'is_published' => true, 'order' => 2],
            ['name' => 'Kapel Doa', 'description' => 'Kapel doa yang terbuka 24 jam untuk seluruh sivitas akademika sebagai tempat beribadah, berdoa, dan bersekutu.', 'is_published' => true, 'order' => 3],
            ['name' => 'Aula Serbaguna', 'description' => 'Aula berkapasitas 500 orang yang digunakan untuk wisuda, seminar, ibadah, dan berbagai acara besar kampus.', 'is_published' => true, 'order' => 4],
            ['name' => 'Asrama Mahasiswa', 'description' => 'Asrama putra dan putri dengan kapasitas 200 mahasiswa, dilengkapi fasilitas lengkap dan pengawasan terpadu.', 'is_published' => true, 'order' => 5],
            ['name' => 'Kantin Kampus', 'description' => 'Kantin bersih dengan berbagai pilihan menu makanan sehat dan terjangkau untuk mahasiswa dan karyawan.', 'is_published' => true, 'order' => 6],
            ['name' => 'Lapangan Olahraga', 'description' => 'Lapangan basket, voli, dan futsal untuk mendukung aktivitas olahraga dan pengembangan fisik mahasiswa.', 'is_published' => true, 'order' => 7],
            ['name' => 'Ruang Musik', 'description' => 'Ruang latihan musik dengan berbagai instrumen gerejawi: piano, organ, gitar, perkusi, dan sistem tata suara profesional.', 'is_published' => true, 'order' => 8],
            ['name' => 'Klinik Kesehatan', 'description' => 'Klinik kampus dengan dokter dan perawat yang siap memberikan pelayanan kesehatan dasar bagi seluruh civitas akademika.', 'is_published' => true, 'order' => 9],
            ['name' => 'Ruang Kelas Modern', 'description' => '20 ruang kelas ber-AC dengan proyektor, whiteboard interaktif, dan sistem audio yang mendukung pembelajaran aktif.', 'is_published' => true, 'order' => 10],
        ];

        foreach ($facilities as $facility) {
            Facility::create($facility);
        }
    }
}
