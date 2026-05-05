<?php

namespace App\Http\Controllers;

use App\Models\Research;
use Illuminate\Http\Request;

class ResearchController extends Controller
{
    public function index(Request $request)
    {
        $type  = $request->get('tipe', 'semua');
        $query = Research::published()->latest();

        if ($type !== 'semua') {
            $query->where('type', $type);
        }

        $research  = $query->paginate(12);
        $journals  = Research::published()->byType('jurnal')->latest()->take(5)->get();
        $count     = [
            'penelitian' => Research::published()->byType('penelitian')->count(),
            'pengabdian' => Research::published()->byType('pengabdian')->count(),
            'jurnal'     => Research::published()->byType('jurnal')->count(),
            'publikasi'  => Research::published()->byType('publikasi')->count(),
        ];

        return view('frontend.research.index', compact('research', 'journals', 'count', 'type'));
    }

    public function show(Research $research)
    {
        return view('frontend.research.show', compact('research'));
    }
}
