<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StudentOrganization;

class StudentOrganizationSeeder extends Seeder
{
    public function run(): void
    {
        $orgs = [
            [
                'name'        => 'Senat Mahasiswa (SEMA)',
                'type'        => 'intra',
                'description' => 'Senat Mahasiswa adalah lembaga legislatif mahasiswa tertinggi di STT Siloam Medan yang berfungsi sebagai perwakilan suara mahasiswa.',
                'is_active'   => true,
            ],
            [
                'name'        => 'Badan Eksekutif Mahasiswa (BEM)',
                'type'        => 'intra',
                'description' => 'BEM adalah lembaga eksekutif mahasiswa yang menjalankan program kerja dan kegiatan kemahasiswaan di STT Siloam Medan.',
                'is_active'   => true,
            ],
            [
                'name'        => 'Persekutuan Doa Kampus',
                'type'        => 'rohani',
                'description' => 'Persekutuan Doa Kampus mengadakan pertemuan doa rutin, ibadah bersama, dan program rohani untuk pertumbuhan iman mahasiswa.',
                'is_active'   => true,
            ],
            [
                'name'        => 'Tim Paduan Suara Mahasiswa',
                'type'        => 'seni',
                'description' => 'Tim Paduan Suara Mahasiswa bertugas memuliakan Tuhan melalui pelayanan musik dan pujian dalam berbagai acara kampus dan gereja.',
                'is_active'   => true,
            ],
            [
                'name'        => 'Unit Kegiatan Mahasiswa Olahraga',
                'type'        => 'olahraga',
                'description' => 'UKM Olahraga memfasilitasi pengembangan minat dan bakat mahasiswa di bidang olahraga: basket, voli, futsal, dan badminton.',
                'is_active'   => true,
            ],
            [
                'name'        => 'Tim Misi Kampus',
                'type'        => 'pelayanan',
                'description' => 'Tim Misi Kampus melaksanakan program penginjilan, pelayanan gereja pedesaan, dan misi jangka pendek ke daerah-daerah terpencil.',
                'is_active'   => true,
            ],
        ];

        foreach ($orgs as $org) {
            StudentOrganization::create($org);
        }
    }
}
