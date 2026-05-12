<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Identitas
            ['key' => 'app_name',             'value' => 'Nama Kampus Anda'],
            ['key' => 'tagline',              'value' => 'Tagline Kampus Anda'],
            ['key' => 'meta_description',     'value' => ''],
            ['key' => 'footer_text',          'value' => ''],
            ['key' => 'admin_panel_subtitle', 'value' => 'Panel Administrasi Website Resmi'],
            ['key' => 'welcome_message',      'value' => ''],

            // Pimpinan
            ['key' => 'rector_name',    'value' => ''],
            ['key' => 'rector_title',   'value' => 'Ketua'],
            ['key' => 'rector_message', 'value' => ''],

            // Kontak
            ['key' => 'address',     'value' => ''],
            ['key' => 'phone',       'value' => ''],
            ['key' => 'email',       'value' => ''],
            ['key' => 'whatsapp',    'value' => ''],
            ['key' => 'maps_embed',  'value' => ''],

            // Media Sosial
            ['key' => 'facebook',  'value' => ''],
            ['key' => 'instagram', 'value' => ''],
            ['key' => 'youtube',   'value' => ''],

            // Statistik
            ['key' => 'total_students',  'value' => '0'],
            ['key' => 'total_alumni',    'value' => '0'],
            ['key' => 'total_lecturers', 'value' => '0'],
        ];

        foreach ($settings as $setting) {
            Setting::firstOrCreate(['key' => $setting['key']], ['value' => $setting['value']]);
        }
    }
}
