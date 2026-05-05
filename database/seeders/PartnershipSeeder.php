<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Partnership;

class PartnershipSeeder extends Seeder
{
    public function run(): void
    {
        $partnerships = [
            ['name' => 'Hannam University', 'type' => 'internasional', 'category' => 'universitas', 'description' => 'Kerjasama pertukaran mahasiswa dan penelitian bersama di bidang teologi.', 'mou_date' => '2023-01-15', 'is_active' => true],
            ['name' => 'Asia Theological Association (ATA)', 'type' => 'internasional', 'category' => 'asosiasi', 'description' => 'Keanggotaan aktif dalam asosiasi teologi se-Asia untuk penjaminan mutu dan networking.', 'mou_date' => '2018-03-10', 'is_active' => true],
            ['name' => 'Universitas HKBP Nommensen', 'type' => 'nasional', 'category' => 'universitas', 'description' => 'Kerjasama akademik dan pengabdian masyarakat di wilayah Sumatera Utara.', 'mou_date' => '2022-06-20', 'is_active' => true],
            ['name' => 'Pemerintah Kota Medan', 'type' => 'nasional', 'category' => 'pemerintah', 'description' => 'Kerjasama dalam program pemberdayaan masyarakat dan pendidikan karakter.', 'mou_date' => '2021-09-01', 'is_active' => true],
            ['name' => 'GKPI (Gereja Kristen Protestan Indonesia)', 'type' => 'nasional', 'category' => 'gereja', 'description' => 'Kerjasama penempatan alumni dan pembinaan jemaat.', 'mou_date' => '2019-04-05', 'is_active' => true],
            ['name' => 'Sekolah Tinggi Teologi Cipanas', 'type' => 'nasional', 'category' => 'universitas', 'description' => 'Kerjasama pertukaran dosen dan pengembangan kurikulum teologi.', 'mou_date' => '2020-11-12', 'is_active' => true],
        ];

        foreach ($partnerships as $p) {
            Partnership::create($p);
        }
    }
}
