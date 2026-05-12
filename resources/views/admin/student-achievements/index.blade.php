@extends('layouts.admin')
@section('title', 'Prestasi Mahasiswa')
@section('page-title', 'Prestasi Mahasiswa')
@section('breadcrumb', 'PMB & Mahasiswa')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div></div>
    <a href="{{ route('admin.student-achievements.create') }}" class="btn btn-primary"><i class="fas fa-plus me-1"></i> Tambah</a>
</div>
<div class="card">
    <div class="card-body">
        <div class="table-wrapper">
        <table class="table datatable">
            <thead><tr><th>#</th><th>Judul Prestasi</th><th>Nama Mahasiswa</th><th>Tingkat</th><th>Penghargaan</th><th>Tahun</th><th>Status</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse($achievements as $a)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ Str::limit($a->title, 50) }}</td>
                    <td>{{ $a->student_name }}</td>
                    <td><span class="badge-status badge-{{ $a->level === 'internasional' ? 'danger' : ($a->level === 'nasional' ? 'warning' : 'info') }}">{{ ucfirst($a->level) }}</span></td>
                    <td>{{ $a->award ?? '-' }}</td>
                    <td>{{ $a->year }}</td>
                    <td>@if($a->is_published)<span class="badge-status badge-success">Tayang</span>@else<span class="badge-status badge-secondary">Draft</span>@endif</td>
                    <td style="white-space:nowrap">
                        <a href="{{ route('admin.student-achievements.edit', $a) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.student-achievements.destroy', $a) }}" method="POST" class="d-inline" onsubmit="return delConfirm(event, this, '{{ addslashes($a->title) }}')">@csrf @method('DELETE')<button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button></form>
                    </td>
                </tr>
                @empty<tr><td colspan="8" class="text-center py-4">Belum ada data prestasi</td></tr>@endforelse
            </tbody>
        </table>
        </div>
        <div class="mt-3">{{ $achievements->links() }}</div>
    </div>
</div>
@endsection
