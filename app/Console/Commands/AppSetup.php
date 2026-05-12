<?php

namespace App\Console\Commands;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class AppSetup extends Command
{
    protected $signature = 'app:setup';
    protected $description = 'Wizard setup awal: isi identitas kampus dan buat akun admin pertama';

    public function handle(): int
    {
        $this->info('');
        $this->info('╔══════════════════════════════════════════╗');
        $this->info('║        Setup Awal Website Kampus         ║');
        $this->info('╚══════════════════════════════════════════╝');
        $this->info('');

        // ── Identitas Kampus ──────────────────────────────────────
        $this->comment('[ Identitas Kampus ]');

        $appName = $this->ask('Nama kampus / institusi', 'Nama Kampus');
        $tagline = $this->ask('Tagline (kosongkan untuk lewati)', '');
        $email   = $this->ask('Email resmi kampus (kosongkan untuk lewati)', '');
        $phone   = $this->ask('Nomor telepon (kosongkan untuk lewati)', '');
        $address = $this->ask('Alamat lengkap (kosongkan untuk lewati)', '');

        $this->info('');

        // ── Akun Admin ────────────────────────────────────────────
        $this->comment('[ Akun Admin ]');

        $createAdmin = false;
        if (User::count() === 0) {
            $this->info('Belum ada akun admin. Buat sekarang.');
            $createAdmin = true;
        } else {
            $createAdmin = $this->confirm('Sudah ada ' . User::count() . ' akun. Buat akun admin baru?', false);
        }

        $adminName     = null;
        $adminEmail    = null;
        $adminPassword = null;

        if ($createAdmin) {
            $adminName  = $this->ask('Nama admin', 'Administrator');
            $adminEmail = $this->ask('Email admin', 'admin@' . strtolower(str_replace(' ', '', $appName)) . '.ac.id');

            do {
                $adminPassword = $this->secret('Password admin (min. 8 karakter)');
                if (strlen($adminPassword) < 8) {
                    $this->error('Password minimal 8 karakter.');
                }
            } while (strlen($adminPassword) < 8);
        }

        // ── Konfirmasi ────────────────────────────────────────────
        $this->info('');
        $this->comment('[ Ringkasan ]');
        $this->table(
            ['Key', 'Value'],
            [
                ['Nama Kampus', $appName],
                ['Tagline',     $tagline ?: '(kosong)'],
                ['Email',       $email   ?: '(kosong)'],
                ['Telepon',     $phone   ?: '(kosong)'],
                ['Alamat',      $address ?: '(kosong)'],
                ['Admin',       $createAdmin ? "$adminName <$adminEmail>" : '(tidak dibuat)'],
            ]
        );

        if (!$this->confirm('Lanjutkan?', true)) {
            $this->warn('Setup dibatalkan.');
            return self::FAILURE;
        }

        // ── Simpan Settings ───────────────────────────────────────
        $data = [
            'app_name' => $appName,
            'tagline'  => $tagline,
            'email'    => $email,
            'phone'    => $phone,
            'address'  => $address,
        ];

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        // ── Buat Admin ────────────────────────────────────────────
        if ($createAdmin) {
            User::create([
                'name'     => $adminName,
                'email'    => $adminEmail,
                'password' => Hash::make($adminPassword),
            ]);
            $this->info("Akun admin <$adminEmail> berhasil dibuat.");
        }

        $this->info('');
        $this->info('✔ Setup selesai! Buka website untuk mulai menggunakan.');
        $this->info('  Login admin: ' . url('/admin/login'));
        $this->info('');

        return self::SUCCESS;
    }
}
