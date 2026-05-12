<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\Facility;
use App\Models\Page;

class CampusProfileController extends Controller
{
    public function history()
    {
        $page = Page::findOrCreateBySlug('sejarah', 'Sejarah Kampus');
        return view('frontend.profile.history', compact('page'));
    }

    public function visionMission()
    {
        $page = Page::findOrCreateBySlug('visi-misi', 'Visi & Misi');
        return view('frontend.profile.vision-mission', compact('page'));
    }

    public function structure()
    {
        $page    = Page::findOrCreateBySlug('struktur-organisasi', 'Struktur Organisasi');
        $leaders = Staff::active()->byCategory('pimpinan')->get();
        $dosen   = Staff::active()->byCategory('dosen')->get();
        $tendik  = Staff::active()->byCategory('tendik')->get();
        return view('frontend.profile.structure', compact('page', 'leaders', 'dosen', 'tendik'));
    }

    public function leadership()
    {
        $leaders = Staff::active()->byCategory('pimpinan')->get();
        return view('frontend.profile.leadership', compact('leaders'));
    }

    public function lecturers()
    {
        $lecturers = Staff::active()->byCategory('dosen')->get();
        $tendik    = Staff::active()->byCategory('tendik')->get();
        return view('frontend.profile.lecturers', compact('lecturers', 'tendik'));
    }

    public function facilities()
    {
        $facilities = Facility::published()->get();
        return view('frontend.profile.facilities', compact('facilities'));
    }

    public function accreditation()
    {
        $page = Page::findOrCreateBySlug('akreditasi', 'Akreditasi');
        return view('frontend.profile.accreditation', compact('page'));
    }

    public function location()
    {
        return view('frontend.profile.location');
    }
}
