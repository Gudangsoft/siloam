<?php

namespace App\Http\Controllers;

use App\Models\StudyProgram;
use App\Models\AcademicCalendar;
use App\Models\Page;

class AcademicController extends Controller
{
    public function programs()
    {
        $programs = StudyProgram::active()->get();
        return view('frontend.academic.programs', compact('programs'));
    }

    public function programDetail(StudyProgram $program)
    {
        return view('frontend.academic.program-detail', compact('program'));
    }

    public function calendar()
    {
        $currentYear   = date('Y') . '/' . (date('Y') + 1);
        $calendars     = AcademicCalendar::published()
            ->where('academic_year', $currentYear)
            ->orderBy('start_date')
            ->get();

        $years = AcademicCalendar::where('is_published', true)
            ->distinct()
            ->orderByDesc('academic_year')
            ->pluck('academic_year');

        return view('frontend.academic.calendar', compact('calendars', 'years', 'currentYear'));
    }

    public function curriculum()
    {
        $programs = StudyProgram::active()->get();
        return view('frontend.academic.curriculum', compact('programs'));
    }

    public function elearning()
    {
        $page = Page::findBySlug('elearning');
        return view('frontend.academic.elearning', compact('page'));
    }

    public function library()
    {
        $page = Page::findBySlug('perpustakaan');
        return view('frontend.academic.library', compact('page'));
    }
}
