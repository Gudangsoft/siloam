<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoginAttempt extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'email',
        'ip_address',
        'user_agent',
        'successful',
        'blocked_reason',
        'attempted_at',
    ];

    protected $casts = [
        'successful' => 'boolean',
        'attempted_at' => 'datetime',
    ];

    public static function isSuspiciousIp(string $ip, int $threshold = 20, int $minutes = 60): bool
    {
        return static::where('ip_address', $ip)
            ->where('successful', false)
            ->where('attempted_at', '>=', now()->subMinutes($minutes))
            ->count() >= $threshold;
    }

    public static function recentFailures(string $ip, int $minutes = 30): int
    {
        return static::where('ip_address', $ip)
            ->where('successful', false)
            ->where('attempted_at', '>=', now()->subMinutes($minutes))
            ->count();
    }
}
