@extends('layouts.admin')
@section('title', 'Alumni')
@section('page-title', 'Data Alumni')
@section('breadcrumb', 'PMB & Mahasiswa')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div></div>
    <a href="{{ route('admin.alumni.create') }}" class="btn btn-primary"><i class="fas fa-plus me-1"></i> Tambah Alumni</a>
</div>
<div class="card">
    <div class="card-body">
        <div class="table-wrapper">
        <table class="table datatable">
            <thead><tr><th>#</th><th>Foto</th><th>Nama</th><th>Program Studi</th><th>Tahun Lulus</th><th>Posisi Saat Ini</th><th>Status</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse($alumni as $a)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>@if($a->photo)<img src="{{ Storage::disk('public')->url($a->photo) }}" style="width:40px;height:40px;object-fit:cover;border-radius:50%">@else<span style="color:#94a3b8">-</span>@endif</td>
                    <td>{{ $a->name }}@if($a->is_featured) <span class="badge-status badge-warning">Unggulan</span>@endif</td>
                    <td>{{ $a->study_program }}</td>
                    <td>{{ $a->graduation_year }}</td>
                    <td>{{ $a->current_position ?? '-' }}</td>
                    <td>@if($a->is_published)<span class="badge-status badge-success">Aktif</span>@else<span class="badge-status badge-secondary">Nonaktif</span>@endif</td>
                    <td style="white-space:nowrap">
                        <a href="{{ route('admin.alumni.edit', $a) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.alumni.destroy', $a) }}" method="POST" class="d-inline" onsubmit="return delConfirm(event, this, '{{ addslashes($a->name) }}')">@csrf @method('DELETE')<button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button></form>
                    </td>
                </tr>
                @empty<tr><td colspan="8" class="text-center py-4">Belum ada data alumni</td></tr>@endforelse
            </tbody>
        </table>
        </div>
        <div class="mt-3">{{ $alumni->links() }}</div>
    </div>
</div>
@endsection
