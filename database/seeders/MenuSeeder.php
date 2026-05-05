<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        Menu::truncate();

        // ─── NAVBAR UTAMA ─────────────────────────────────────────────────────
        $beranda = Menu::create(['title'=>'Beranda',   'url'=>'/',          'icon'=>'fas fa-home',    'order'=>1, 'location'=>'main', 'target'=>'_self', 'is_active'=>true]);

        $profil  = Menu::create(['title'=>'Profil',    'url'=>null,         'icon'=>'fas fa-building', 'order'=>2, 'location'=>'main', 'target'=>'_self', 'is_active'=>true]);
        Menu::create(['title'=>'Sejarah Kampus',  'url'=>'/profil/sejarah',   'order'=>1, 'location'=>'main', 'target'=>'_self', 'is_active'=>true, 'parent_id'=>$profil->id]);
        Menu::create(['title'=>'Visi, Misi & Tujuan','url'=>'/profil/visi-misi','order'=>2, 'location'=>'main', 'target'=>'_self', 'is_active'=>true, 'parent_id'=>$profil->id]);
        Menu::create(['title'=>'Struktur Organisasi','url'=>'/profil/struktur', 'order'=>3, 'location'=>'main', 'target'=>'_self', 'is_active'=>true, 'parent_id'=>$profil->id]);
        Menu::create(['title'=>'Pimpinan',        'url'=>'/profil/pimpinan',  'order'=>4, 'location'=>'main', 'target'=>'_self', 'is_active'=>true, 'parent_id'=>$profil->id]);
        Menu::create(['title'=>'Dosen & Staff',   'url'=>'/profil/dosen-staff','order'=>5,'location'=>'main', 'target'=>'_self', 'is_active'=>true, 'parent_id'=>$profil->id]);
        Menu::create(['title'=>'Fasilitas',       'url'=>'/profil/fasilitas', 'order'=>6, 'location'=>'main', 'target'=>'_self', 'is_active'=>true, 'parent_id'=>$profil->id]);
        Menu::create(['title'=>'Akreditasi',      'url'=>'/profil/akreditasi','order'=>7, 'location'=>'main', 'target'=>'_self', 'is_active'=>true, 'parent_id'=>$profil->id]);
        Menu::create(['title'=>'Lokasi & Kontak', 'url'=>'/profil/lokasi',   'order'=>8, 'location'=>'main', 'target'=>'_self', 'is_active'=>true, 'parent_id'=>$profil->id]);

        $akademik= Menu::create(['title'=>'Akademik','url'=>null,          'icon'=>'fas fa-graduation-cap','order'=>3,'location'=>'main','target'=>'_self','is_active'=>true]);
        Menu::create(['title'=>'Program Studi',   'url'=>'/akademik/program-studi','order'=>1,'location'=>'main','target'=>'_self','is_active'=>true,'parent_id'=>$akademik->id]);
        Menu::create(['title'=>'Kurikulum',       'url'=>'/akademik/kurikulum',    'order'=>2,'location'=>'main','target'=>'_self','is_active'=>true,'parent_id'=>$akademik->id]);
        Menu::create(['title'=>'Kalender Akademik','url'=>'/akademik/kalender',    'order'=>3,'location'=>'main','target'=>'_self','is_active'=>true,'parent_id'=>$akademik->id]);
        Menu::create(['title'=>'E-Learning',      'url'=>'/akademik/e-learning',   'order'=>4,'location'=>'main','target'=>'_self','is_active'=>true,'parent_id'=>$akademik->id]);
        Menu::create(['title'=>'Perpustakaan Digital','url'=>'/akademik/perpustakaan','order'=>5,'location'=>'main','target'=>'_self','is_active'=>true,'parent_id'=>$akademik->id]);

        $pmb     = Menu::create(['title'=>'PMB',   'url'=>null,            'icon'=>'fas fa-user-plus','order'=>4,'location'=>'main','target'=>'_self','is_active'=>true]);
        Menu::create(['title'=>'Info PMB',        'url'=>'/pmb',           'order'=>1,'location'=>'main','target'=>'_self','is_active'=>true,'parent_id'=>$pmb->id]);
        Menu::create(['title'=>'Syarat & Ketentuan','url'=>'/pmb/syarat',  'order'=>2,'location'=>'main','target'=>'_self','is_active'=>true,'parent_id'=>$pmb->id]);
        Menu::create(['title'=>'Biaya Pendidikan','url'=>'/pmb/biaya',     'order'=>3,'location'=>'main','target'=>'_self','is_active'=>true,'parent_id'=>$pmb->id]);
        Menu::create(['title'=>'Beasiswa',        'url'=>'/pmb/beasiswa',  'order'=>4,'location'=>'main','target'=>'_self','is_active'=>true,'parent_id'=>$pmb->id]);
        Menu::create(['title'=>'Jadwal PMB',      'url'=>'/pmb/jadwal',    'order'=>5,'location'=>'main','target'=>'_self','is_active'=>true,'parent_id'=>$pmb->id]);
        Menu::create(['title'=>'Daftar Sekarang', 'url'=>'/pmb/daftar',    'order'=>6,'location'=>'main','target'=>'_self','is_active'=>true,'parent_id'=>$pmb->id]);

        Menu::create(['title'=>'Penelitian','url'=>'/penelitian',   'icon'=>'fas fa-flask','order'=>5,'location'=>'main','target'=>'_self','is_active'=>true]);

        $berita  = Menu::create(['title'=>'Berita','url'=>null,           'icon'=>'fas fa-newspaper','order'=>6,'location'=>'main','target'=>'_self','is_active'=>true]);
        Menu::create(['title'=>'Berita & Artikel','url'=>'/berita',       'order'=>1,'location'=>'main','target'=>'_self','is_active'=>true,'parent_id'=>$berita->id]);
        Menu::create(['title'=>'Event & Agenda', 'url'=>'/media/agenda',  'order'=>2,'location'=>'main','target'=>'_self','is_active'=>true,'parent_id'=>$berita->id]);
        Menu::create(['title'=>'Galeri Foto',    'url'=>'/media/galeri',  'order'=>3,'location'=>'main','target'=>'_self','is_active'=>true,'parent_id'=>$berita->id]);
        Menu::create(['title'=>'Video',          'url'=>'/media/video',   'order'=>4,'location'=>'main','target'=>'_self','is_active'=>true,'parent_id'=>$berita->id]);

        $mhs     = Menu::create(['title'=>'Mahasiswa','url'=>null,        'icon'=>'fas fa-users','order'=>7,'location'=>'main','target'=>'_self','is_active'=>true]);
        Menu::create(['title'=>'Organisasi Mahasiswa','url'=>'/kemahasiswaan/organisasi','order'=>1,'location'=>'main','target'=>'_self','is_active'=>true,'parent_id'=>$mhs->id]);
        Menu::create(['title'=>'Prestasi',       'url'=>'/kemahasiswaan/prestasi',  'order'=>2,'location'=>'main','target'=>'_self','is_active'=>true,'parent_id'=>$mhs->id]);
        Menu::create(['title'=>'Alumni',         'url'=>'/kemahasiswaan/alumni',    'order'=>3,'location'=>'main','target'=>'_self','is_active'=>true,'parent_id'=>$mhs->id]);
        Menu::create(['title'=>'Layanan Mahasiswa','url'=>'/kemahasiswaan/layanan', 'order'=>4,'location'=>'main','target'=>'_self','is_active'=>true,'parent_id'=>$mhs->id]);
        Menu::create(['title'=>'Karir & Tracer Study','url'=>'/kemahasiswaan/karir','order'=>5,'location'=>'main','target'=>'_self','is_active'=>true,'parent_id'=>$mhs->id]);

        Menu::create(['title'=>'Kerjasama','url'=>'/kerjasama','icon'=>'fas fa-handshake','order'=>8,'location'=>'main','target'=>'_self','is_active'=>true]);
        Menu::create(['title'=>'Kontak',   'url'=>'/kontak',   'icon'=>'fas fa-envelope','order'=>9,'location'=>'main','target'=>'_self','is_active'=>true]);

        // ─── FOOTER ───────────────────────────────────────────────────────────
        Menu::create(['title'=>'Profil Kampus',       'url'=>'/profil/sejarah',          'order'=>1,'location'=>'footer','target'=>'_self','is_active'=>true]);
        Menu::create(['title'=>'Program Studi',       'url'=>'/akademik/program-studi',  'order'=>2,'location'=>'footer','target'=>'_self','is_active'=>true]);
        Menu::create(['title'=>'Pendaftaran Mahasiswa Baru','url'=>'/pmb/daftar',        'order'=>3,'location'=>'footer','target'=>'_self','is_active'=>true]);
        Menu::create(['title'=>'Penelitian & Pengabdian','url'=>'/penelitian',           'order'=>4,'location'=>'footer','target'=>'_self','is_active'=>true]);
        Menu::create(['title'=>'Berita & Artikel',    'url'=>'/berita',                  'order'=>5,'location'=>'footer','target'=>'_self','is_active'=>true]);
        Menu::create(['title'=>'Alumni',              'url'=>'/kemahasiswaan/alumni',    'order'=>6,'location'=>'footer','target'=>'_self','is_active'=>true]);
    }
}
