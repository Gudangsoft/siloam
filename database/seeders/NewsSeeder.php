<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\News;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        $articles = [
            [
                'title'       => 'STT Siloam Medan Raih Akreditasi B dari BAN-PT',
                'slug'        => 'stt-siloam-medan-raih-akreditasi-b-dari-ban-pt',
                'category'    => 'akademik',
                'excerpt'     => 'STT Siloam Medan berhasil meraih akreditasi B dari Badan Akreditasi Nasional Perguruan Tinggi (BAN-PT) untuk Program Studi Teologi.',
                'content'     => '<p>STT Siloam Medan berhasil meraih akreditasi B dari Badan Akreditasi Nasional Perguruan Tinggi (BAN-PT) untuk Program Studi Teologi. Pencapaian ini merupakan buah dari kerja keras seluruh sivitas akademika dalam meningkatkan mutu pendidikan secara berkelanjutan.</p><p>Ketua STT, Dr. Samuel Siahaan, menyampaikan rasa syukur atas pencapaian ini. "Akreditasi B ini adalah motivasi bagi kami untuk terus meningkatkan kualitas. Kami berkomitmen meraih akreditasi A dalam waktu dekat," ungkapnya.</p><p>Proses akreditasi meliputi penilaian terhadap kurikulum, kualitas dosen, sarana prasarana, tata kelola, serta capaian pembelajaran mahasiswa.</p>',
                'is_published' => true,
                'is_featured'  => true,
                'published_at' => now()->subDays(5),
                'author'       => 'Admin STT Siloam',
            ],
            [
                'title'       => 'Wisuda Ke-28: 85 Sarjana Teologi Siap Melayani',
                'slug'        => 'wisuda-ke-28-85-sarjana-teologi-siap-melayani',
                'category'    => 'kampus',
                'excerpt'     => 'STT Siloam Medan menggelar wisuda ke-28 dengan meluluskan 85 mahasiswa dari berbagai program studi.',
                'content'     => '<p>STT Siloam Medan dengan penuh sukacita menggelar acara Wisuda ke-28 yang berlangsung khidmat dan meriah di Aula Utama Kampus. Sebanyak 85 mahasiswa diwisuda dari Program Studi Teologi (S1), Pendidikan Agama Kristen (S1), dan Musik Gerejawi (S1).</p><p>Dalam sambutan wisudanya, Ketua STT menegaskan bahwa pendidikan teologi bukan sekadar perolehan gelar akademis, melainkan persiapan untuk melayani dengan segenap hati dan kemampuan terbaik.</p><p>Para wisudawan berasal dari berbagai daerah di Indonesia, termasuk Sumatera Utara, Kalimantan, Papua, dan Nusa Tenggara.</p>',
                'is_published' => true,
                'is_featured'  => true,
                'published_at' => now()->subDays(12),
                'author'       => 'Admin STT Siloam',
            ],
            [
                'title'       => 'Seminar Nasional Teologi Kontekstual di Tengah Tantangan Zaman',
                'slug'        => 'seminar-nasional-teologi-kontekstual',
                'category'    => 'akademik',
                'excerpt'     => 'STT Siloam Medan menyelenggarakan Seminar Nasional bertema "Teologi Kontekstual di Tengah Tantangan Zaman Modern".',
                'content'     => '<p>STT Siloam Medan sukses menyelenggarakan Seminar Nasional dengan tema "Teologi Kontekstual di Tengah Tantangan Zaman Modern". Seminar ini menghadirkan pembicara dari berbagai universitas dan lembaga teologi terkemuka di Indonesia.</p><p>Seminar membahas berbagai isu kontemporer yang dihadapi gereja, termasuk digitalisasi pelayanan, teologi ekologi, dan tantangan pluralisme agama.</p>',
                'is_published' => true,
                'is_featured'  => false,
                'published_at' => now()->subDays(20),
                'author'       => 'Admin STT Siloam',
            ],
            [
                'title'       => 'Program KKN Terpadu Mahasiswa di Daerah 3T',
                'slug'        => 'program-kkn-terpadu-mahasiswa-daerah-3t',
                'category'    => 'kemahasiswaan',
                'excerpt'     => 'Sebanyak 60 mahasiswa STT Siloam Medan mengikuti KKN Terpadu di daerah 3T (Terdepan, Terluar, Tertinggal).',
                'content'     => '<p>Sebanyak 60 mahasiswa STT Siloam Medan mengikuti program Kuliah Kerja Nyata (KKN) Terpadu selama 40 hari di berbagai daerah 3T di Sumatera Utara. Program ini merupakan wujud nyata pengabdian mahasiswa kepada masyarakat.</p><p>Kegiatan KKN meliputi pelayanan gereja, pembinaan pemuda, pengajaran Sekolah Minggu, konseling keluarga, dan program kesehatan masyarakat.</p>',
                'is_published' => true,
                'is_featured'  => false,
                'published_at' => now()->subDays(30),
                'author'       => 'Admin STT Siloam',
            ],
            [
                'title'       => 'Kerjasama STT Siloam Medan dengan Universitas di Korea Selatan',
                'slug'        => 'kerjasama-stt-siloam-medan-universitas-korea-selatan',
                'category'    => 'kerjasama',
                'excerpt'     => 'STT Siloam Medan menandatangani MoU dengan Hannam University Korea Selatan untuk program pertukaran mahasiswa dan penelitian bersama.',
                'content'     => '<p>STT Siloam Medan resmi menjalin kerjasama internasional dengan Hannam University, Korea Selatan melalui penandatanganan Memorandum of Understanding (MoU). Perjanjian ini mencakup program pertukaran mahasiswa, penelitian bersama, dan pertukaran dosen.</p><p>Dengan kerjasama ini, mahasiswa STT Siloam Medan berkesempatan untuk menjalani satu semester studi di Korea Selatan dan mendapatkan pengalaman akademis internasional.</p>',
                'is_published' => true,
                'is_featured'  => false,
                'published_at' => now()->subDays(45),
                'author'       => 'Admin STT Siloam',
            ],
            [
                'title'       => 'Pembangunan Gedung Perpustakaan Digital Dimulai',
                'slug'        => 'pembangunan-gedung-perpustakaan-digital-dimulai',
                'category'    => 'kampus',
                'excerpt'     => 'STT Siloam Medan memulai pembangunan gedung perpustakaan digital modern yang akan menjadi pusat sumber belajar civitas akademika.',
                'content'     => '<p>STT Siloam Medan secara resmi memulai pembangunan Gedung Perpustakaan Digital yang akan menjadi pusat sumber belajar modern bagi seluruh civitas akademika. Gedung berlantai 4 ini dirancang untuk menampung koleksi fisik dan digital yang luas.</p><p>Perpustakaan ini akan dilengkapi dengan ruang baca modern, area co-working, laboratorium komputer, dan akses ke lebih dari 50.000 judul e-book dan jurnal internasional.</p>',
                'is_published' => true,
                'is_featured'  => false,
                'published_at' => now()->subDays(60),
                'author'       => 'Admin STT Siloam',
            ],
        ];

        foreach ($articles as $article) {
            News::create($article);
        }
    }
}
