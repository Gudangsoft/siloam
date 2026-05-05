<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\HeroBanner;
use App\Models\News;
use App\Models\Event;
use App\Models\StudyProgram;
use App\Models\Staff;
use App\Models\Setting;

class HomeController extends Controller
{
    public function index()
    {
        $banners       = HeroBanner::active()->get();
        $featured_news = News::published()->where('is_featured', true)->latest()->take(3)->get();
        $latest_news   = News::published()->latest()->take(6)->get();
        $events        = Event::published()->upcoming()->orderBy('start_date')->take(4)->get();
        $programs      = StudyProgram::active()->take(4)->get();
        $gallery       = Gallery::published()->take(8)->get();
        $leaders       = Staff::active()->byCategory('pimpinan')->take(3)->get();

        $stats = [
            'students'  => Setting::get('total_students', '500+'),
            'alumni'    => Setting::get('total_alumni', '1000+'),
            'lecturers' => Setting::get('total_lecturers', '50+'),
            'programs'  => StudyProgram::active()->count(),
        ];

        return view('frontend.home', compact(
            'banners', 'featured_news', 'latest_news', 'events', 'programs', 'gallery', 'leaders', 'stats'
        ));
    }
}
