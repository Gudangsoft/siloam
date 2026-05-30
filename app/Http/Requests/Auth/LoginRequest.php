<?php

namespace App\Http\Requests\Auth;

use App\Models\LoginAttempt;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email'    => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * @throws ValidationException
     */
    public function authenticate(): void
    {
        // Honeypot: field _hp harus selalu kosong; jika terisi = bot
        if ($this->filled('_hp')) {
            Log::warning('[Security] Honeypot triggered', [
                'ip' => $this->ip(),
                'ua' => $this->userAgent(),
                'email' => $this->input('email'),
            ]);
            $this->logAttempt(false, 'honeypot');
            // Tunda respons agar bot tidak tahu bahwa permintaan ditolak
            sleep(2);
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        // Rate limit berdasarkan IP saja (15 percobaan / 15 menit)
        $this->ensureIpNotRateLimited();

        // Rate limit berdasarkan email + IP (5 percobaan)
        $this->ensureIsNotRateLimited();

        if (! Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());
            RateLimiter::hit($this->ipThrottleKey(), 900); // decay 15 menit

            $remaining = RateLimiter::remaining($this->throttleKey(), 5);
            $this->logAttempt(false);

            if ($remaining > 0) {
                throw ValidationException::withMessages([
                    'email' => "Email atau password salah. Tersisa {$remaining} percobaan lagi.",
                ]);
            }

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
        RateLimiter::clear($this->ipThrottleKey());
        $this->logAttempt(true);
    }

    /**
     * @throws ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * @throws ValidationException
     */
    public function ensureIpNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->ipThrottleKey(), 15)) {
            return;
        }

        $seconds = RateLimiter::availableIn($this->ipThrottleKey());

        Log::warning('[Security] IP login rate limited', [
            'ip'      => $this->ip(),
            'seconds' => $seconds,
        ]);

        throw ValidationException::withMessages([
            'email' => "Terlalu banyak percobaan dari jaringan Anda. Coba lagi dalam " . ceil($seconds / 60) . " menit.",
        ]);
    }

    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')) . '|' . $this->ip());
    }

    public function ipThrottleKey(): string
    {
        return 'login-ip:' . $this->ip();
    }

    private function logAttempt(bool $successful, ?string $blockedReason = null): void
    {
        try {
            LoginAttempt::create([
                'email'          => Str::lower($this->string('email')),
                'ip_address'     => $this->ip(),
                'user_agent'     => substr((string) ($this->userAgent() ?? ''), 0, 512),
                'successful'     => $successful,
                'blocked_reason' => $blockedReason,
                'attempted_at'   => now(),
            ]);
        } catch (\Throwable $e) {
            Log::error('[Security] Gagal menyimpan log login: ' . $e->getMessage());
        }
    }
}
