<?php

namespace App\Exports;

use App\Models\PmbRegistration;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class PmbRegistrationExport implements FromQuery, WithHeadings, WithMapping, WithStyles, WithTitle, ShouldAutoSize
{
    public function __construct(
        private ?string $status = null,
        private ?string $search = null,
    ) {}

    public function query()
    {
        $query = PmbRegistration::orderByDesc('created_at');

        if ($this->status) {
            $query->where('status', $this->status);
        }

        if ($this->search) {
            $like = '%' . $this->search . '%';
            $query->where(fn($q) => $q->where('full_name', 'like', $like)
                ->orWhere('registration_number', 'like', $like)
                ->orWhere('email', 'like', $like));
        }

        return $query;
    }

    public function title(): string
    {
        return 'Data Pendaftar PMB';
    }

    public function headings(): array
    {
        return [
            'No. Registrasi',
            'Nama Lengkap',
            'Jenis Kelamin',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Email',
            'Telepon',
            'Alamat',
            'Kota',
            'Provinsi',
            'Asal Sekolah',
            'Jurusan',
            'Tahun Lulus',
            'Program Studi',
            'Jalur Pendaftaran',
            'Nama Orang Tua',
            'Telepon Orang Tua',
            'Status',
            'Tanggal Daftar',
            'Catatan',
        ];
    }

    public function map($row): array
    {
        $statusMap = [
            'pending'  => 'Menunggu',
            'review'   => 'Ditinjau',
            'accepted' => 'Diterima',
            'rejected' => 'Ditolak',
        ];

        return [
            $row->registration_number,
            $row->full_name,
            $row->gender === 'L' ? 'Laki-laki' : 'Perempuan',
            $row->birth_place ?? '',
            $row->birth_date?->format('d/m/Y') ?? '',
            $row->email ?? '',
            $row->phone,
            $row->address ?? '',
            $row->city ?? '',
            $row->province ?? '',
            $row->high_school_name,
            $row->major ?? '',
            $row->graduation_year,
            $row->study_program,
            $row->registration_path ?? '',
            $row->parent_name ?? '',
            $row->parent_phone ?? '',
            $statusMap[$row->status] ?? $row->status,
            $row->created_at->format('d/m/Y H:i'),
            $row->notes ?? '',
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '1e3a8a']],
            ],
        ];
    }
}
