<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            SettingSeeder::class,
            PageSeeder::class,
            HeroBannerSeeder::class,
            StaffSeeder::class,
            StudyProgramSeeder::class,
            NewsSeeder::class,
            EventSeeder::class,
            ResearchSeeder::class,
            FacilitySeeder::class,
            GallerySeeder::class,
            PartnershipSeeder::class,
            ScholarshipSeeder::class,
            StudentOrganizationSeeder::class,
            StudentAchievementSeeder::class,
            AlumniSeeder::class,
        ]);
    }
}
