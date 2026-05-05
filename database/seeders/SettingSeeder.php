<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'site_name',          'value' => 'STT Siloam Medan',                          'type' => 'text',     'group' => 'general', 'label' => 'Nama Website'],
            ['key' => 'site_tagline',        'value' => 'Melahirkan Pemimpin yang Takut Akan Tuhan', 'type' => 'text',     'group' => 'general', 'label' => 'Tagline'],
            ['key' => 'site_description',    'value' => 'Sekolah Tinggi Teologi Siloam Medan adalah perguruan tinggi teologi Kristen yang berkomitmen menghasilkan pelayan Tuhan yang kompeten dan berkarakter.', 'type' => 'textarea', 'group' => 'general', 'label' => 'Deskripsi Singkat'],
            ['key' => 'site_email',          'value' => 'info@sttsiloam.ac.id',                      'type' => 'text',     'group' => 'contact', 'label' => 'Email Utama'],
            ['key' => 'site_phone',          'value' => '+62 61 8888 1234',                           'type' => 'text',     'group' => 'contact', 'label' => 'Telepon'],
            ['key' => 'site_whatsapp',       'value' => '6261888812345',                              'type' => 'text',     'group' => 'contact', 'label' => 'WhatsApp'],
            ['key' => 'site_address',        'value' => 'Jl. Siloam No. 1, Medan, Sumatera Utara',   'type' => 'textarea', 'group' => 'contact', 'label' => 'Alamat'],
            ['key' => 'site_facebook',       'value' => 'https://facebook.com/sttsiloammedan',        'type' => 'text',     'group' => 'social',  'label' => 'Facebook URL'],
            ['key' => 'site_instagram',      'value' => 'https://instagram.com/sttsiloammedan',       'type' => 'text',     'group' => 'social',  'label' => 'Instagram URL'],
            ['key' => 'site_youtube',        'value' => 'https://youtube.com/@sttsiloammedan',        'type' => 'text',     'group' => 'social',  'label' => 'YouTube URL'],
            ['key' => 'site_twitter',        'value' => 'https://twitter.com/sttsiloammedan',         'type' => 'text',     'group' => 'social',  'label' => 'Twitter URL'],
            ['key' => 'stats_students',      'value' => '850',                                        'type' => 'text',     'group' => 'stats',   'label' => 'Jumlah Mahasiswa'],
            ['key' => 'stats_alumni',        'value' => '3200',                                       'type' => 'text',     'group' => 'stats',   'label' => 'Jumlah Alumni'],
            ['key' => 'stats_lecturers',     'value' => '45',                                         'type' => 'text',     'group' => 'stats',   'label' => 'Jumlah Dosen'],
            ['key' => 'stats_programs',      'value' => '6',                                          'type' => 'text',     'group' => 'stats',   'label' => 'Program Studi'],
            ['key' => 'stats_years',         'value' => '30',                                         'type' => 'text',     'group' => 'stats',   'label' => 'Tahun Berdiri (Lama)'],
            ['key' => 'pmb_open',            'value' => '1',                                          'type' => 'boolean',  'group' => 'pmb',     'label' => 'PMB Dibuka'],
            ['key' => 'pmb_year',            'value' => '2025/2026',                                  'type' => 'text',     'group' => 'pmb',     'label' => 'Tahun Akademik PMB'],
            ['key' => 'pmb_deadline',        'value' => '2025-08-31',                                 'type' => 'text',     'group' => 'pmb',     'label' => 'Batas Pendaftaran PMB'],
            ['key' => 'footer_text',         'value' => '© 2025 STT Siloam Medan. Hak Cipta Dilindungi.',  'type' => 'text', 'group' => 'general', 'label' => 'Teks Footer'],
            ['key' => 'maps_embed',          'value' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3982.0!2d98.66!3d3.59!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sMedan!5e0!3m2!1sid!2sid!4v1600000000000', 'type' => 'textarea', 'group' => 'contact', 'label' => 'Google Maps Embed URL'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
