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
        $page = Page::findBySlug('pmb-syarat');
        return view('frontend.pmb.requirements', compact('page'));
    }

    public function fees()
    {
        $page = Page::findBySlug('pmb-biaya');
        return view('frontend.pmb.fees', compact('page'));
    }

    public function scholarships()
    {
        $page         = Page::findBySlug('pmb-beasiswa');
        $scholarships = Scholarship::active()->get();
        return view('frontend.pmb.scholarships', compact('scholarships', 'page'));
    }

    public function schedule()
    {
        $page = Page::findBySlug('pmb-jadwal');
        return view('frontend.pmb.schedule', compact('page'));
    }

    public function register()
    {
        $programs = StudyProgram::active()->get();
        return view('frontend.pmb.register', compact('programs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name'           => 'required|string|max:255',
            'email'               => 'nullable|email|max:100',
            'phone'               => 'required|string|max:20',
            'gender'              => 'required|in:L,P',
            'birth_date'          => 'nullable|date',
            'birth_place'         => 'nullable|string|max:100',
            'citizenship'         => 'nullable|string|max:100',
            'address'             => 'nullable|string',
            'city'                => 'nullable|string|max:100',
            'province'            => 'nullable|string|max:100',
            'high_school_name'    => 'required|string|max:255',
            'major'               => 'nullable|string|max:100',
            'graduation_year'     => 'required|string|max:4',
            'study_program'       => 'required|string|max:255',
            'reason'              => 'required|string|max:2000',
            'service_experience'  => 'required|string|max:2000',
            'registration_path'   => 'nullable|string|max:100',
            'parent_name'         => 'nullable|string|max:255',
            'parent_phone'        => 'nullable|string|max:20',
            'photo'               => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'ijazah_document'     => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:4096',
        ], [
            'full_name.required'          => 'Nama lengkap wajib diisi.',
            'phone.required'              => 'Nomor telepon wajib diisi.',
            'high_school_name.required'   => 'Asal sekolah wajib diisi.',
            'study_program.required'      => 'Program studi wajib dipilih.',
            'reason.required'             => 'Alasan memilih STT Siloam wajib diisi.',
            'service_experience.required' => 'Pengalaman pelayanan wajib diisi.',
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
