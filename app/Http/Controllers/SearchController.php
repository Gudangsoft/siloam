<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\News;
use App\Models\Page;
use App\Models\Research;
use App\Models\Staff;
use App\Models\StudyProgram;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $q = trim($request->get('q', ''));

        if (strlen($q) < 2) {
            return view('frontend.search.results', [
                'q'        => $q,
                'results'  => collect(),
                'total'    => 0,
                'tooShort' => true,
            ]);
        }

        $like = '%' . $q . '%';

        $news = News::published()
            ->where(fn($query) => $query->where('title', 'like', $like)->orWhere('excerpt', 'like', $like)->orWhere('content', 'like', $like))
            ->orderByDesc('published_at')
            ->limit(8)
            ->get()
            ->map(fn($n) => [
                'type'    => 'Berita',
                'icon'    => 'fa-newspaper',
                'color'   => '#2563eb',
                'title'   => $n->title,
                'excerpt' => $n->excerpt ?: \Str::limit(strip_tags($n->content), 160),
                'url'     => route('berita.show', $n->slug),
                'date'    => $n->published_at?->translatedFormat('d M Y'),
                'badge'   => $n->category,
            ]);

        $programs = StudyProgram::active()
            ->where(fn($query) => $query->where('name', 'like', $like)->orWhere('description', 'like', $like)->orWhere('degree', 'like', $like))
            ->limit(5)
            ->get()
            ->map(fn($p) => [
                'type'    => 'Program Studi',
                'icon'    => 'fa-graduation-cap',
                'color'   => '#7c3aed',
                'title'   => $p->name,
                'excerpt' => \Str::limit(strip_tags($p->description ?? ''), 160),
                'url'     => route('akademik.program-detail', $p->slug),
                'date'    => null,
                'badge'   => $p->degree,
            ]);

        $staff = Staff::active()
            ->where(fn($query) => $query->where('name', 'like', $like)->orWhere('position', 'like', $like)->orWhere('expertise', 'like', $like))
            ->limit(5)
            ->get()
            ->map(fn($s) => [
                'type'    => 'Dosen / Staf',
                'icon'    => 'fa-user-tie',
                'color'   => '#059669',
                'title'   => $s->name,
                'excerpt' => $s->position . ($s->expertise ? ' · ' . $s->expertise : ''),
                'url'     => route('profil.dosen-staff'),
                'date'    => null,
                'badge'   => ucfirst($s->category),
            ]);

        $research = Research::where('is_published', true)
            ->where(fn($query) => $query->where('title', 'like', $like)->orWhere('abstract', 'like', $like))
            ->limit(4)
            ->get()
            ->map(fn($r) => [
                'type'    => 'Penelitian',
                'icon'    => 'fa-flask',
                'color'   => '#d97706',
                'title'   => $r->title,
                'excerpt' => \Str::limit(strip_tags($r->abstract ?? ''), 160),
                'url'     => route('penelitian.show', $r->slug),
                'date'    => $r->updated_at?->translatedFormat('d M Y'),
                'badge'   => null,
            ]);

        $pages = Page::where(fn($query) => $query->where('title', 'like', $like)->orWhere('content', 'like', $like))
            ->limit(4)
            ->get()
            ->map(fn($p) => [
                'type'    => 'Halaman',
                'icon'    => 'fa-file-alt',
                'color'   => '#64748b',
                'title'   => $p->title,
                'excerpt' => \Str::limit(strip_tags($p->content ?? ''), 160),
                'url'     => url('/halaman/' . $p->slug),
                'date'    => null,
                'badge'   => null,
            ]);

        $results = $news->concat($programs)->concat($staff)->concat($research)->concat($pages);

        return view('frontend.search.results', [
            'q'        => $q,
            'results'  => $results,
            'total'    => $results->count(),
            'tooShort' => false,
        ]);
    }
}
