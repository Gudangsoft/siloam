<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Staff;

class StaffSeeder extends Seeder
{
    public function run(): void
    {
        $staffs = [
            ['name' => 'Dr. Samuel Siahaan, M.Th.',    'position' => 'Ketua STT',                       'category' => 'Pimpinan',    'education' => 'S3 Teologi - UKSW Salatiga',  'email' => 'ketua@sttsiloam.ac.id',   'order' => 1,  'is_active' => true],
            ['name' => 'Dr. Ruth Sinambela, M.Th.',     'position' => 'Wakil Ketua I Bidang Akademik',   'category' => 'Pimpinan',    'education' => 'S3 Teologi - STT Cipanas',    'email' => 'waket1@sttsiloam.ac.id',  'order' => 2,  'is_active' => true],
            ['name' => 'Drs. Johanes Napitupulu, M.M.', 'position' => 'Wakil Ketua II Bidang Keuangan',  'category' => 'Pimpinan',    'education' => 'S2 Manajemen - USU Medan',    'email' => 'waket2@sttsiloam.ac.id',  'order' => 3,  'is_active' => true],
            ['name' => 'Pdt. Daniel Situmorang, M.Th.', 'position' => 'Wakil Ketua III Kemahasiswaan',   'category' => 'Pimpinan',    'education' => 'S2 Teologi - STTL Yogyakarta','email' => 'waket3@sttsiloam.ac.id',  'order' => 4,  'is_active' => true],
            ['name' => 'Pdt. Dr. Markus Tambunan',      'position' => 'Dosen Teologi Sistematika',       'category' => 'Akademik',    'education' => 'S3 Teologi Sistematika',      'email' => 'markus@sttsiloam.ac.id',  'order' => 5,  'is_active' => true],
            ['name' => 'Pdt. Elisabet Hutabarat, M.Th.','position' => 'Dosen Perjanjian Baru',           'category' => 'Akademik',    'education' => 'S2 Biblika - STTII Yogyakarta','email' => 'elisabet@sttsiloam.ac.id','order' => 6,  'is_active' => true],
            ['name' => 'Drs. Hendra Simanjuntak, M.Pd.','position' => 'Dosen Pendidikan Agama Kristen',  'category' => 'Akademik',    'education' => 'S2 Pendidikan - UNIMED',      'email' => 'hendra@sttsiloam.ac.id',  'order' => 7,  'is_active' => true],
            ['name' => 'Dra. Maria Simbolon, M.Th.',    'position' => 'Dosen Konseling Pastoral',        'category' => 'Akademik',    'education' => 'S2 Teologi - UKDW Yogyakarta','email' => 'maria@sttsiloam.ac.id',   'order' => 8,  'is_active' => true],
            ['name' => 'Bapak Riko Pangaribuan, S.Th.', 'position' => 'Kepala Bagian Akademik',          'category' => 'Administrasi','education' => 'S1 Teologi',                  'email' => 'akademik@sttsiloam.ac.id','order' => 9,  'is_active' => true],
            ['name' => 'Ibu Nona Siburian, S.E.',       'position' => 'Kepala Bagian Keuangan',          'category' => 'Administrasi','education' => 'S1 Ekonomi - USU',            'email' => 'keuangan@sttsiloam.ac.id','order' => 10, 'is_active' => true],
        ];

        foreach ($staffs as $staff) {
            Staff::create($staff);
        }
    }
}
