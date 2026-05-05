<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PmbRegistration extends Model
{
    protected $fillable = [
        'registration_number', 'full_name', 'email', 'phone', 'gender',
        'birth_date', 'birth_place', 'address', 'city', 'province',
        'high_school_name', 'graduation_year', 'study_program', 'registration_path',
        'parent_name', 'parent_phone', 'photo', 'ijazah_document', 'status', 'notes',
    ];

    protected $casts = ['birth_date' => 'date'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (!$model->registration_number) {
                $model->registration_number = 'PMB-' . date('Y') . '-' . str_pad(static::count() + 1, 4, '0', STR_PAD_LEFT);
            }
        });
    }

    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'Menunggu Verifikasi',
            'review' => 'Sedang Ditinjau',
            'accepted' => 'Diterima',
            'rejected' => 'Ditolak',
            default => $this->status,
        };
    }
}
