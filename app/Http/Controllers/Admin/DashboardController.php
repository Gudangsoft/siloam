<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use App\Models\Contact;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\News;
use App\Models\PmbRegistration;
use App\Models\Research;
use App\Models\Staff;
use App\Models\StudyProgram;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'news'          => News::count(),
            'events'        => Event::count(),
            'staff'         => Staff::where('is_active', true)->count(),
            'pmb_total'     => PmbRegistration::count(),
            'pmb_pending'   => PmbRegistration::where('status', 'pending')->count(),
            'pmb_accepted'  => PmbRegistration::where('status', 'accepted')->count(),
            'contacts'      => Contact::where('is_read', false)->count(),
            'research'      => Research::count(),
            'alumni'        => Alumni::count(),
            'study_programs'=> StudyProgram::where('is_active', true)->count(),
            'gallery'       => Gallery::count(),
        ];

        $pmb_by_program = PmbRegistration::selectRaw('study_program, count(*) as total')
            ->groupBy('study_program')->orderByDesc('total')->take(5)->get();

        $pmb_by_status = PmbRegistration::selectRaw('status, count(*) as total')
            ->groupBy('status')->get()->keyBy('status');

        $latest_news     = News::latest('published_at')->take(6)->get();
        $latest_pmb      = PmbRegistration::latest()->take(8)->get();
        $unread_contacts = Contact::where('is_read', false)->latest()->take(5)->get();
        $upcoming_events = Event::where('start_date', '>=', now())->orderBy('start_date')->take(5)->get();

        return view('admin.dashboard', compact(
            'stats', 'pmb_by_program', 'pmb_by_status',
            'latest_news', 'latest_pmb', 'unread_contacts', 'upcoming_events'
        ));
    }
}
