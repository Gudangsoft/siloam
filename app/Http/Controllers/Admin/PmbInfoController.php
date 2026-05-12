<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PmbInfoController extends Controller
{
    private array $pages = [
        'pmb-syarat'   => ['title' => 'Syarat & Ketentuan',  'icon' => 'fa-list-check',    'route' => 'pmb.syarat'],
        'pmb-biaya'    => ['title' => 'Biaya Pendidikan',    'icon' => 'fa-money-bill-wave','route' => 'pmb.biaya'],
        'pmb-beasiswa' => ['title' => 'Beasiswa',            'icon' => 'fa-award',          'route' => 'pmb.beasiswa'],
        'pmb-jadwal'   => ['title' => 'Jadwal PMB',          'icon' => 'fa-calendar-days',  'route' => 'pmb.jadwal'],
        'pmb'          => ['title' => 'Halaman Info PMB',    'icon' => 'fa-graduation-cap', 'route' => 'pmb.index'],
    ];

    public function index()
    {
        $items = collect($this->pages)->map(function ($info, $slug) {
            $page = Page::where('slug', $slug)->first();
            return array_merge($info, [
                'slug'       => $slug,
                'has_content'=> $page && $page->content,
                'updated_at' => $page?->updated_at,
            ]);
        });
        return view('admin.pmb-info.index', compact('items'));
    }

    public function edit(string $slug)
    {
        abort_unless(array_key_exists($slug, $this->pages), 404);
        $info = $this->pages[$slug];
        $page = Page::firstOrCreate(
            ['slug' => $slug],
            ['title' => $info['title'], 'is_active' => true]
        );
        return view('admin.pmb-info.edit', compact('page', 'info', 'slug'));
    }

    public function update(Request $request, string $slug)
    {
        abort_unless(array_key_exists($slug, $this->pages), 404);
        $request->validate(['content' => 'nullable|string']);
        $page = Page::firstOrCreate(
            ['slug' => $slug],
            ['title' => $this->pages[$slug]['title'], 'is_active' => true]
        );
        $page->update(['content' => $request->input('content')]);
        return redirect()->route('admin.pmb-info.index')
            ->with('success', 'Konten "' . $this->pages[$slug]['title'] . '" berhasil disimpan!');
    }
}
