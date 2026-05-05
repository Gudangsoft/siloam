<?php

namespace App\Http\Controllers;

use App\Models\StudentOrganization;
use App\Models\StudentAchievement;
use App\Models\Alumni;

class StudentAffairsController extends Controller
{
    public function organizations()
    {
        $organizations = StudentOrganization::active()->get();
        return view('frontend.student.organizations', compact('organizations'));
    }

    public function achievements()
    {
        $achievements = StudentAchievement::published()
            ->orderByDesc('year')
            ->paginate(15);
        return view('frontend.student.achievements', compact('achievements'));
    }

    public function alumni()
    {
        $alumni   = Alumni::published()->orderByDesc('graduation_year')->paginate(16);
        $featured = Alumni::published()->featured()->take(3)->get();
        return view('frontend.student.alumni', compact('alumni', 'featured'));
    }

    public function services()
    {
        return view('frontend.student.services');
    }

    public function career()
    {
        return view('frontend.student.career');
    }
}
