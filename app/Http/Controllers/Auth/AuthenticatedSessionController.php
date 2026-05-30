<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $this->notifySuccessfulLogin($request);

        return redirect()->intended(route('admin.dashboard'));
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    private function notifySuccessfulLogin(Request $request): void
    {
        $user = Auth::user();
        $ip   = $request->ip();
        $ua   = $request->userAgent() ?? '-';
        $time = now()->setTimezone('Asia/Jakarta')->format('d M Y H:i:s') . ' WIB';

        Log::info("[Security] Login admin berhasil: {$user->email} dari IP {$ip}", [
            'user_agent' => $ua,
        ]);

        // Kirim notifikasi ke email admin (aktif setelah SMTP dikonfigurasi di .env)
        try {
            $body = implode("\n", [
                "Login ke panel admin berhasil terdeteksi.",
                "",
                "Detail:",
                "  Email  : {$user->email}",
                "  IP     : {$ip}",
                "  Waktu  : {$time}",
                "  Browser: {$ua}",
                "",
                "Jika ini BUKAN Anda, segera ganti password dan hubungi administrator.",
            ]);

            Mail::raw($body, function ($message) use ($user, $ip) {
                $message->to($user->email)
                        ->subject("[STT Siloam] Login Admin dari IP {$ip}");
            });
        } catch (\Throwable $e) {
            Log::warning('[Security] Gagal kirim notifikasi login: ' . $e->getMessage());
        }
    }
}
