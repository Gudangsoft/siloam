<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentAchievement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentAchievementController extends Controller
{
    public function index()
    {
        $achievements = StudentAchievement::orderByDesc('year')->paginate(15);
        return view('admin.student-achievements.index', compact('achievements'));
    }

    public function create()
    {
        return view('admin.student-achievements.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'         => 'required|string|max:255',
            'student_name'  => 'required|string|max:255',
            'study_program' => 'nullable|string|max:255',
            'level'         => 'required|in:internasional,nasional,regional,lokal',
            'award'         => 'nullable|string|max:100',
            'description'   => 'nullable|string',
            'year'          => 'required|integer|min:2000|max:2099',
            'image'         => 'nullable|image|max:2048',
            'is_published'  => 'nullable|boolean',
        ]);

        $validated['is_published'] = $request->boolean('is_published');

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('achievements', 'public');
        }

        StudentAchievement::create($validated);
        return redirect()->route('admin.student-achievements.index')->with('success', 'Prestasi berhasil ditambahkan!');
    }

    public function edit(StudentAchievement $achievement)
    {
        return view('admin.student-achievements.form', compact('achievement'));
    }

    public function update(Request $request, StudentAchievement $achievement)
    {
        $validated = $request->validate([
            'title'         => 'required|string|max:255',
            'student_name'  => 'required|string|max:255',
            'study_program' => 'nullable|string|max:255',
            'level'         => 'required|in:internasional,nasional,regional,lokal',
            'award'         => 'nullable|string|max:100',
            'description'   => 'nullable|string',
            'year'          => 'required|integer|min:2000|max:2099',
            'image'         => 'nullable|image|max:2048',
            'is_published'  => 'nullable|boolean',
        ]);

        $validated['is_published'] = $request->boolean('is_published');

        if ($request->hasFile('image')) {
            if ($achievement->image) Storage::disk('public')->delete($achievement->image);
            $validated['image'] = $request->file('image')->store('achievements', 'public');
        }

        $achievement->update($validated);
        return redirect()->route('admin.student-achievements.index')->with('success', 'Prestasi berhasil diperbarui!');
    }

    public function destroy(StudentAchievement $achievement)
    {
        if ($achievement->image) Storage::disk('public')->delete($achievement->image);
        $achievement->delete();
        return redirect()->route('admin.student-achievements.index')->with('success', 'Prestasi berhasil dihapus!');
    }
}
