<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;

class KontenController extends Controller
{
    private array $groups = [
        'Profil Kampus' => [
            ['slug' => 'sejarah',              'title' => 'Sejarah STT Siloam',    'icon' => 'fas fa-landmark',       'url_name' => 'profil.sejarah'],
            ['slug' => 'visi-misi',            'title' => 'Visi & Misi',           'icon' => 'fas fa-bullseye',       'url_name' => 'profil.visi-misi'],
            ['slug' => 'struktur-organisasi',  'title' => 'Struktur Organisasi',   'icon' => 'fas fa-sitemap',        'url_name' => 'profil.struktur'],
            ['slug' => 'akreditasi',           'title' => 'Akreditasi',            'icon' => 'fas fa-certificate',   'url_name' => 'profil.akreditasi'],
        ],
        'Akademik' => [
            ['slug' => 'elearning',    'title' => 'E-Learning',           'icon' => 'fas fa-laptop',     'url_name' => 'akademik.elearning'],
            ['slug' => 'perpustakaan', 'title' => 'Perpustakaan Digital', 'icon' => 'fas fa-book',       'url_name' => 'akademik.perpustakaan'],
        ],
        'PMB' => [
            ['slug' => 'pmb',          'title' => 'Halaman Utama PMB',    'icon' => 'fas fa-door-open',  'url_name' => 'pmb.index'],
            ['slug' => 'pmb-syarat',   'title' => 'Syarat Pendaftaran',   'icon' => 'fas fa-clipboard-list', 'url_name' => 'pmb.persyaratan'],
            ['slug' => 'pmb-biaya',    'title' => 'Biaya Pendidikan',     'icon' => 'fas fa-money-bill', 'url_name' => 'pmb.biaya'],
            ['slug' => 'pmb-beasiswa', 'title' => 'Program Beasiswa',     'icon' => 'fas fa-award',      'url_name' => 'pmb.beasiswa'],
            ['slug' => 'pmb-jadwal',   'title' => 'Jadwal PMB',           'icon' => 'fas fa-calendar',   'url_name' => 'pmb.jadwal'],
        ],
    ];

    public function index()
    {
        $allSlugs = [];
        foreach ($this->groups as $items) {
            foreach ($items as $item) {
                $allSlugs[] = $item['slug'];
            }
        }

        $existingPages = Page::whereIn('slug', $allSlugs)
            ->get()
            ->keyBy('slug');

        return view('admin.konten.index', [
            'groups'        => $this->groups,
            'existingPages' => $existingPages,
        ]);
    }

    public function edit(string $slug)
    {
        $title = $slug;
        foreach ($this->groups as $items) {
            foreach ($items as $item) {
                if ($item['slug'] === $slug) {
                    $title = $item['title'];
                    break 2;
                }
            }
        }

        $page = Page::firstOrCreate(
            ['slug' => $slug],
            ['title' => $title, 'content' => '']
        );

        return redirect()->route('admin.pages.edit', $page);
    }
}
