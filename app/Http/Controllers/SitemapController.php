<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Page;
use App\Models\Research;
use App\Models\StudyProgram;
use App\Models\Event;

class SitemapController extends Controller
{
    public function index()
    {
        $news     = News::published()->orderByDesc('published_at')->get(['slug', 'updated_at']);
        $pages    = Page::whereNotNull('content')->where('content', '!=', '')->get(['slug', 'updated_at']);
        $programs = StudyProgram::active()->get(['slug', 'updated_at']);
        $research = Research::where('is_published', true)->get(['slug', 'updated_at']);
        $events   = Event::where('is_published', true)->orderByDesc('start_date')->get(['slug', 'updated_at']);

        $staticRoutes = [
            ['url' => route('home'),                   'priority' => '1.0',  'freq' => 'daily'],
            ['url' => route('profil.sejarah'),         'priority' => '0.7',  'freq' => 'monthly'],
            ['url' => route('profil.visi-misi'),       'priority' => '0.7',  'freq' => 'monthly'],
            ['url' => route('profil.struktur'),        'priority' => '0.6',  'freq' => 'monthly'],
            ['url' => route('profil.pimpinan'),        'priority' => '0.6',  'freq' => 'monthly'],
            ['url' => route('profil.dosen-staff'),     'priority' => '0.6',  'freq' => 'monthly'],
            ['url' => route('profil.fasilitas'),       'priority' => '0.6',  'freq' => 'monthly'],
            ['url' => route('profil.akreditasi'),      'priority' => '0.6',  'freq' => 'monthly'],
            ['url' => route('profil.lokasi'),          'priority' => '0.5',  'freq' => 'yearly'],
            ['url' => route('akademik.programs'),      'priority' => '0.8',  'freq' => 'monthly'],
            ['url' => route('akademik.kalender'),      'priority' => '0.6',  'freq' => 'weekly'],
            ['url' => route('akademik.elearning'),     'priority' => '0.5',  'freq' => 'monthly'],
            ['url' => route('akademik.perpustakaan'),  'priority' => '0.5',  'freq' => 'monthly'],
            ['url' => route('pmb.index'),              'priority' => '0.9',  'freq' => 'weekly'],
            ['url' => route('pmb.syarat'),             'priority' => '0.8',  'freq' => 'monthly'],
            ['url' => route('pmb.biaya'),              'priority' => '0.8',  'freq' => 'monthly'],
            ['url' => route('pmb.beasiswa'),           'priority' => '0.7',  'freq' => 'monthly'],
            ['url' => route('pmb.jadwal'),             'priority' => '0.8',  'freq' => 'weekly'],
            ['url' => route('berita.index'),           'priority' => '0.8',  'freq' => 'daily'],
            ['url' => route('media.galeri'),           'priority' => '0.6',  'freq' => 'weekly'],
            ['url' => route('media.video'),            'priority' => '0.5',  'freq' => 'weekly'],
            ['url' => route('media.agenda'),           'priority' => '0.6',  'freq' => 'weekly'],
            ['url' => route('kemahasiswaan.alumni'),   'priority' => '0.6',  'freq' => 'monthly'],
            ['url' => route('kerjasama.index'),        'priority' => '0.5',  'freq' => 'monthly'],
            ['url' => route('kontak.index'),           'priority' => '0.7',  'freq' => 'yearly'],
            ['url' => route('penelitian.index'),       'priority' => '0.6',  'freq' => 'weekly'],
        ];

        return response()->view('sitemap', compact('staticRoutes', 'news', 'pages', 'programs', 'research', 'events'))
            ->header('Content-Type', 'application/xml');
    }
}
