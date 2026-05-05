<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'slug'             => 'sejarah',
                'title'            => 'Sejarah STT Siloam Medan',
                'content'          => '<p>STT Siloam Medan didirikan pada tahun 1994 oleh para pendiri visioner yang memiliki kerinduan untuk membina generasi pemimpin gerejawi yang kuat di Sumatera Utara dan sekitarnya.</p><p>Berawal dari sebuah sekolah Alkitab kecil dengan 15 mahasiswa perdana, STT Siloam Medan telah berkembang menjadi institusi teologi terkemuka dengan ratusan mahasiswa aktif dari berbagai penjuru Indonesia.</p><p>Selama perjalanan tiga dekade lebih, STT Siloam Medan telah meluluskan lebih dari 3.000 alumni yang kini melayani di berbagai penjuru dunia sebagai pendeta, misionaris, konselor, dan pemimpin kristen.</p>',
                'meta_title'       => 'Sejarah STT Siloam Medan',
                'meta_description' => 'Pelajari perjalanan sejarah STT Siloam Medan sejak 1994 hingga menjadi institusi teologi terkemuka.',
            ],
            [
                'slug'             => 'visi-misi',
                'title'            => 'Visi & Misi',
                'content'          => '<h3>Visi</h3><p>Menjadi pusat keunggulan pendidikan teologi Kristen yang melahirkan pemimpin transformasional berkarakter Kristus untuk melayani gereja dan masyarakat.</p><h3>Misi</h3><ul><li>Menyelenggarakan pendidikan teologi yang berkualitas, relevan, dan berstandar akademik tinggi.</li><li>Membangun karakter mahasiswa yang berintegritas, beriman, dan berdedikasi dalam pelayanan.</li><li>Mengembangkan penelitian teologis yang kontributif bagi pengembangan ilmu dan praksis kekristenan.</li><li>Menjalin kemitraan strategis dengan gereja, lembaga, dan institusi dalam dan luar negeri.</li><li>Mengabdi kepada masyarakat melalui program pelayanan dan pemberdayaan komunitas.</li></ul><h3>Tujuan</h3><p>Menghasilkan lulusan yang kompeten secara akademis, matang secara rohani, dan siap melayani di berbagai konteks pelayanan gerejawi dan sosial.</p>',
                'meta_title'       => 'Visi dan Misi STT Siloam Medan',
                'meta_description' => 'Visi dan misi STT Siloam Medan dalam mendidik dan membina pemimpin Kristen yang berkualitas.',
            ],
            [
                'slug'             => 'struktur-organisasi',
                'title'            => 'Struktur Organisasi',
                'content'          => '<p>STT Siloam Medan dikelola oleh tim pimpinan yang berpengalaman dan berkomitmen terhadap mutu pendidikan teologi.</p><h3>Pimpinan Institusi</h3><ul><li><strong>Ketua STT:</strong> Dr. Samuel Siahaan, M.Th.</li><li><strong>Wakil Ketua I Bidang Akademik:</strong> Dr. Ruth Sinambela, M.Th.</li><li><strong>Wakil Ketua II Bidang Keuangan & Administrasi:</strong> Drs. Johanes Napitupulu, M.M.</li><li><strong>Wakil Ketua III Bidang Kemahasiswaan:</strong> Pdt. Daniel Situmorang, M.Th.</li></ul><h3>Lembaga dan Unit</h3><ul><li>Lembaga Penjaminan Mutu Internal (LPMI)</li><li>Lembaga Penelitian dan Pengabdian Masyarakat (LPPM)</li><li>Unit Perpustakaan</li><li>Unit Teknologi Informasi</li></ul>',
                'meta_title'       => 'Struktur Organisasi STT Siloam Medan',
                'meta_description' => 'Struktur organisasi dan tata kelola STT Siloam Medan.',
            ],
            [
                'slug'             => 'akreditasi',
                'title'            => 'Akreditasi & Legalitas',
                'content'          => '<p>STT Siloam Medan beroperasi berdasarkan izin pendirian yang sah dari Kementerian Agama Republik Indonesia dan telah memperoleh akreditasi dari lembaga akreditasi nasional.</p><h3>Status Akreditasi</h3><ul><li><strong>Akreditasi Institusi:</strong> B (Baik Sekali) dari BAN-PT</li><li><strong>Program Studi Teologi (S1):</strong> B dari BAN-PT</li><li><strong>Program Studi Pendidikan Agama Kristen (S1):</strong> B dari BAN-PT</li></ul><h3>Legalitas</h3><ul><li>SK Pendirian: Dirjen Bimas Kristen Kemenag RI No. DJ.III/Kep/HK.00.5/xxx/1994</li><li>SK Izin Operasional: Terdaftar di Kemenag RI</li><li>NPSN: 12345678</li></ul>',
                'meta_title'       => 'Akreditasi STT Siloam Medan',
                'meta_description' => 'Informasi akreditasi dan legalitas STT Siloam Medan.',
            ],
            [
                'slug'             => 'lokasi-kampus',
                'title'            => 'Lokasi & Fasilitas Kampus',
                'content'          => '<p>Kampus STT Siloam Medan berlokasi strategis di kota Medan, Sumatera Utara, dengan fasilitas modern yang mendukung proses pembelajaran.</p><h3>Alamat Kampus</h3><p>Jl. Siloam No. 1, Medan Timur, Kota Medan, Sumatera Utara 20234</p><h3>Jam Operasional</h3><ul><li>Senin – Jumat: 08.00 – 17.00 WIB</li><li>Sabtu: 08.00 – 13.00 WIB</li></ul>',
                'meta_title'       => 'Lokasi Kampus STT Siloam Medan',
                'meta_description' => 'Lokasi dan petunjuk arah menuju kampus STT Siloam Medan.',
            ],
            [
                'slug'             => 'tentang-pmb',
                'title'            => 'Tentang Penerimaan Mahasiswa Baru',
                'content'          => '<p>STT Siloam Medan membuka Penerimaan Mahasiswa Baru (PMB) setiap tahun akademik bagi calon mahasiswa yang memiliki panggilan melayani dan berminat mendalami ilmu teologi.</p><h3>Persyaratan Umum</h3><ul><li>Memiliki ijazah SMA/SMK/sederajat</li><li>Memiliki surat rekomendasi dari gereja/pendeta</li><li>Telah lahir baru dan memiliki kerinduan melayani</li><li>Berkelakuan baik (SKCK)</li></ul>',
                'meta_title'       => 'Penerimaan Mahasiswa Baru STT Siloam Medan',
                'meta_description' => 'Informasi lengkap penerimaan mahasiswa baru STT Siloam Medan.',
            ],
        ];

        foreach ($pages as $page) {
            Page::updateOrCreate(['slug' => $page['slug']], $page);
        }
    }
}
