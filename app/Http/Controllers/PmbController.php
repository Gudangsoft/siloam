<?php

namespace App\Http\Controllers;

use App\Models\PmbRegistration;
use App\Models\StudyProgram;
use App\Models\Scholarship;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PmbController extends Controller
{
    public function index()
    {
        $page = Page::findBySlug('pmb');
        return view('frontend.pmb.index', compact('page'));
    }

    public function requirements()
    {
        return view('frontend.pmb.requirements');
    }

    public function fees()
    {
        return view('frontend.pmb.fees');
    }

    public function scholarships()
    {
        $scholarships = Scholarship::active()->get();
        return view('frontend.pmb.scholarships', compact('scholarships'));
    }

    public function schedule()
    {
        return view('frontend.pmb.schedule');
    }

    public function register()
    {
        $programs = StudyProgram::active()->get();
        return view('frontend.pmb.register', compact('programs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name'         => 'required|string|max:255',
            'email'             => 'required|email|unique:pmb_registrations,email',
            'phone'             => 'required|string|max:20',
            'gender'            => 'required|in:L,P',
            'birth_date'        => 'required|date',
            'birth_place'       => 'required|string|max:100',
            'address'           => 'required|string',
            'city'              => 'required|string|max:100',
            'province'          => 'required|string|max:100',
            'high_school_name'  => 'required|string|max:255',
            'graduation_year'   => 'required|string|max:4',
            'study_program'     => 'required|string|max:255',
            'registration_path' => 'nullable|string|max:100',
            'parent_name'       => 'required|string|max:255',
            'parent_phone'      => 'required|string|max:20',
            'photo'             => 'nullable|image|max:2048',
            'ijazah_document'   => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:4096',
        ], [
            'full_name.required'        => 'Nama lengkap wajib diisi.',
            'email.required'            => 'Email wajib diisi.',
            'email.unique'              => 'Email sudah terdaftar sebelumnya.',
            'phone.required'            => 'Nomor telepon wajib diisi.',
            'study_program.required'    => 'Program studi wajib dipilih.',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('pmb/photos', 'public');
        }

        if ($request->hasFile('ijazah_document')) {
            $validated['ijazah_document'] = $request->file('ijazah_document')->store('pmb/documents', 'public');
        }

        $registration = PmbRegistration::create($validated);

        return redirect()->route('pmb.success', $registration->registration_number)
            ->with('success', 'Pendaftaran berhasil! Nomor registrasi Anda: ' . $registration->registration_number);
    }

    public function success(string $number)
    {
        $registration = PmbRegistration::where('registration_number', $number)->firstOrFail();
        return view('frontend.pmb.success', compact('registration'));
    }
}
