<?php

namespace App\Http\Controllers;

use App\Mail\ContactNotification;
use App\Models\Contact;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        // Generate math captcha and store answer in session
        $a = rand(2, 9);
        $b = rand(1, 9);
        session(['captcha_answer' => $a + $b]);

        return view('frontend.contact.index', compact('a', 'b'));
    }

    public function store(Request $request)
    {
        // Validate captcha first
        $captchaAnswer = session('captcha_answer');
        if (!$captchaAnswer || (int) $request->input('captcha') !== (int) $captchaAnswer) {
            return back()
                ->withInput()
                ->withErrors(['captcha' => 'Jawaban verifikasi salah. Silakan coba lagi.']);
        }

        // Clear captcha so it can't be reused
        session()->forget('captcha_answer');

        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email:rfc|max:100',
            'phone'   => 'nullable|string|max:20|regex:/^[0-9\+\-\(\)\s]+$/',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10|max:3000',
        ], [
            'name.required'    => 'Nama wajib diisi.',
            'email.required'   => 'Email wajib diisi.',
            'email.email'      => 'Format email tidak valid.',
            'phone.regex'      => 'Format nomor telepon tidak valid.',
            'subject.required' => 'Subjek wajib diisi.',
            'message.required' => 'Pesan wajib diisi.',
            'message.min'      => 'Pesan minimal 10 karakter.',
            'message.max'      => 'Pesan maksimal 3000 karakter.',
        ]);

        // Save to database
        $contact = Contact::create($validated);

        // Send email notification (non-blocking — log error if fails)
        $adminEmail = Setting::where('key', 'email')->value('value');
        if ($adminEmail) {
            try {
                Mail::to($adminEmail)->send(new ContactNotification($contact));
            } catch (\Exception $e) {
                Log::error('Contact email failed: ' . $e->getMessage());
            }
        }

        return back()->with('success', 'Pesan Anda berhasil dikirim! Kami akan segera menghubungi Anda.');
    }
}
