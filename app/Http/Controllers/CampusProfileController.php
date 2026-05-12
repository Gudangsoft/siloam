<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\Facility;
use App\Models\Page;

class CampusProfileController extends Controller
{
    public function history()
    {
        $page = Page::firstOrCreate(['slug' => 'sejarah'], ['title' => 'Sejarah STT Siloam', 'content' => '']);
        return view('frontend.profile.history', compact('page'));
    }

    public function visionMission()
    {
        $page = Page::firstOrCreate(['slug' => 'visi-misi'], ['title' => 'Visi & Misi', 'content' => '']);
        return view('frontend.profile.vision-mission', compact('page'));
    }

    public function structure()
    {
        $page    = Page::firstOrCreate(['slug' => 'struktur-organisasi'], ['title' => 'Struktur Organisasi', 'content' => '']);
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
        $page = Page::firstOrCreate(['slug' => 'akreditasi'], ['title' => 'Akreditasi', 'content' => '']);
        return view('frontend.profile.accreditation', compact('page'));
    }

    public function location()
    {
        return view('frontend.profile.location');
    }
}
