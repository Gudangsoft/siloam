<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Staff;

class StaffSeeder extends Seeder
{
    public function run(): void
    {
        $staffs = [
            [
                'name'        => 'MERLIN SANTINUS, M.Pd.K',
                'position'    => 'Ketua',
                'category'    => 'pimpinan',
                'birth_place' => 'Muara Siberut',
                'birth_date'  => '1982-05-31',
                'church'      => 'GSKI Metanoia Medan',
                'nuptk'       => '7863759660130152',
                'courses'     => 'SGI, Sejarah Perkembangan, Filsafat PAK, Metode Penelaahan Alkitab di Sekolah dan Jemaat',
                'order'       => 1,
                'is_active'   => true,
            ],
            [
                'name'        => 'RINTO FRANCIUS SIRAIT, S.Pd., M.Th.',
                'position'    => 'Wakil Ketua Bidang Akademik',
                'category'    => 'pimpinan',
                'birth_place' => 'N. Lama',
                'birth_date'  => '1981-04-30',
                'church'      => 'GSKI Voice of Truth Medan',
                'nuptk'       => '3762759660130182',
                'courses'     => 'PP PL 1, PP PL 2, Teologi PL 1, Teologi PL 2, Bahasa Ibrani, Tafsir PL, Teologi Agama-Agama, Dogmatika',
                'order'       => 2,
                'is_active'   => true,
            ],
            [
                'name'        => 'SANTIANA PASARIBU, M.Pd',
                'position'    => 'Wakil Ketua Bidang Keuangan',
                'category'    => 'pimpinan',
                'birth_place' => 'Tanjung Harapan',
                'birth_date'  => '1985-11-10',
                'church'      => 'GGP Filadelfia',
                'nuptk'       => '6442763664230353',
                'courses'     => null,
                'order'       => 3,
                'is_active'   => true,
            ],
            [
                'name'        => 'ASAL PARLINDUNGAN TAMBUNAN, M.Th.',
                'position'    => 'Wakil Ketua Bidang Kemahasiswaan',
                'category'    => 'pimpinan',
                'birth_place' => 'Medan',
                'birth_date'  => '1960-04-15',
                'church'      => 'GKI Sumut',
                'nuptk'       => '9901005538',
                'courses'     => 'Pengantar dan Pembimbing PB, Formasi Spiritual, Bahasa Yunani, Tafsir Perjanjian Baru, Teologi Perjanjian Baru, Homiletika',
                'order'       => 4,
                'is_active'   => true,
            ],
            [
                'name'        => 'TRI MARTHA SINAGA, M.Pd.K',
                'position'    => 'Kaprodi PAK',
                'category'    => 'dosen',
                'birth_place' => 'Medan',
                'birth_date'  => '1983-03-06',
                'church'      => 'GBI Bukit Zaitun',
                'nuptk'       => '0638761662230292',
                'courses'     => 'Perencanaan Pembelajaran PAK, Teori Belajar PAK, PAK Dewasa, Praktik Kependidikan Pelayanan Anak',
                'order'       => 5,
                'is_active'   => true,
            ],
            [
                'name'        => 'JUWITA HERAWATI SAMOSIR, S.Th., M.Pd.K',
                'position'    => 'Dosen Tetap',
                'category'    => 'dosen',
                'birth_place' => 'Medan',
                'birth_date'  => '1968-07-27',
                'church'      => 'GBI Kampung Pon',
                'nuptk'       => '6059746648300033',
                'courses'     => 'PAK Anak, PAK Remaja, Kode Etik dan Profesionalitas Guru, PAK Dalam Masyarakat Majemuk',
                'order'       => 6,
                'is_active'   => true,
            ],
            [
                'name'        => 'AMRI EDWIN SIMANJUNTAK, S.Th., M.Pd.K',
                'position'    => 'Dosen Tetap',
                'category'    => 'dosen',
                'birth_place' => 'P. Lalang',
                'birth_date'  => '1987-07-17',
                'church'      => 'GPDI Maranatha',
                'nuptk'       => '4049765666130283',
                'courses'     => 'MBS, Pembimbing PAK, Sejarah PAK',
                'order'       => 7,
                'is_active'   => true,
            ],
            [
                'name'        => 'MARIANI PASARIBU, M.Pd.',
                'position'    => 'Dosen',
                'category'    => 'dosen',
                'birth_place' => 'Tanjung Harapan',
                'birth_date'  => '1989-07-31',
                'church'      => 'HKBP',
                'nuptk'       => '6063767668230243',
                'courses'     => 'Bahasa Indonesia, Statistika, Sosiologi',
                'order'       => 8,
                'is_active'   => true,
            ],
        ];

        foreach ($staffs as $data) {
            Staff::firstOrCreate(['name' => $data['name']], $data);
        }
    }
}
