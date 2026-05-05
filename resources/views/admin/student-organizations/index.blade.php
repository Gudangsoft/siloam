@extends('layouts.admin')
@section('title', 'Organisasi Mahasiswa')
@section('page-title', 'Organisasi Mahasiswa')
@section('breadcrumb', 'PMB & Mahasiswa')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div></div>
    <a href="{{ route('admin.student-organizations.create') }}" class="btn btn-primary"><i class="fas fa-plus me-1"></i> Tambah</a>
</div>
<div class="card">
    <div class="card-body">
        <div class="table-wrapper">
        <table class="table datatable">
            <thead><tr><th>#</th><th>Logo</th><th>Nama</th><th>Singkatan</th><th>Tipe</th><th>Ketua</th><th>Status</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse($organizations as $o)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>@if($o->logo)<img src="{{ Storage::disk('public')->url($o->logo) }}" style="height:35px">@else<span style="color:#94a3b8">-</span>@endif</td>
                    <td>{{ $o->name }}</td>
                    <td>{{ $o->abbreviation ?? '-' }}</td>
                    <td><span class="badge-status badge-info">{{ $o->type }}</span></td>
                    <td>{{ $o->chairman ?? '-' }}</td>
                    <td>@if($o->is_active)<span class="badge-status badge-success">Aktif</span>@else<span class="badge-status badge-secondary">Nonaktif</span>@endif</td>
                    <td style="white-space:nowrap">
                        <a href="{{ route('admin.student-organizations.edit', $o) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.student-organizations.destroy', $o) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus?')">@csrf @method('DELETE')<button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button></form>
                    </td>
                </tr>
                @empty<tr><td colspan="8" class="text-center py-4">Belum ada data</td></tr>@endforelse
            </tbody>
        </table>
        </div>
    </div>
</div>
@endsection
