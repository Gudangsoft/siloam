<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\Facility;
use App\Models\Page;

class CampusProfileController extends Controller
{
    public function history()
    {
        $page = Page::findBySlug('sejarah');
        return view('frontend.profile.history', compact('page'));
    }

    public function visionMission()
    {
        $page = Page::findBySlug('visi-misi');
        return view('frontend.profile.vision-mission', compact('page'));
    }

    public function structure()
    {
        $page = Page::findBySlug('struktur-organisasi');
        return view('frontend.profile.structure', compact('page'));
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
        $page = Page::findBySlug('akreditasi');
        return view('frontend.profile.accreditation', compact('page'));
    }

    public function location()
    {
        return view('frontend.profile.location');
    }
}
