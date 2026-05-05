<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicCalendar;
use Illuminate\Http\Request;

class AcademicCalendarController extends Controller
{
    public function index()
    {
        $calendars = AcademicCalendar::orderByDesc('start_date')->paginate(20);
        return view('admin.academic-calendars.index', compact('calendars'));
    }

    public function create()
    {
        return view('admin.academic-calendars.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'         => 'required|string|max:255',
            'description'   => 'nullable|string',
            'start_date'    => 'required|date',
            'end_date'      => 'nullable|date',
            'semester'      => 'required|in:Ganjil,Genap',
            'academic_year' => 'required|string|max:20',
            'color'         => 'nullable|string|max:20',
            'is_published'  => 'nullable|boolean',
        ]);

        $validated['is_published'] = $request->boolean('is_published');
        AcademicCalendar::create($validated);
        return redirect()->route('admin.academic-calendars.index')->with('success', 'Kalender berhasil ditambahkan!');
    }

    public function edit(AcademicCalendar $academicCalendar)
    {
        return view('admin.academic-calendars.form', ['calendar' => $academicCalendar]);
    }

    public function update(Request $request, AcademicCalendar $academicCalendar)
    {
        $validated = $request->validate([
            'title'         => 'required|string|max:255',
            'description'   => 'nullable|string',
            'start_date'    => 'required|date',
            'end_date'      => 'nullable|date',
            'semester'      => 'required|in:Ganjil,Genap',
            'academic_year' => 'required|string|max:20',
            'color'         => 'nullable|string|max:20',
            'is_published'  => 'nullable|boolean',
        ]);

        $validated['is_published'] = $request->boolean('is_published');
        $academicCalendar->update($validated);
        return redirect()->route('admin.academic-calendars.index')->with('success', 'Kalender berhasil diperbarui!');
    }

    public function destroy(AcademicCalendar $academicCalendar)
    {
        $academicCalendar->delete();
        return redirect()->route('admin.academic-calendars.index')->with('success', 'Kalender berhasil dihapus!');
    }
}
