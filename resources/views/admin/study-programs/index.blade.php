@extends('layouts.admin')
@section('title', 'Program Studi')
@section('page-title', 'Program Studi')
@section('breadcrumb', 'Profil Kampus')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div></div>
    <a href="{{ route('admin.study-programs.create') }}" class="btn btn-primary"><i class="fas fa-plus me-1"></i> Tambah Prodi</a>
</div>
<div class="card">
    <div class="card-body">
        <div class="table-wrapper">
        <table class="table datatable">
            <thead><tr><th>#</th><th>Nama Program Studi</th><th>Jenjang</th><th>Akreditasi</th><th>Kaprodi</th><th>Urutan</th><th>Status</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse($programs as $p)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><strong>{{ $p->name }}</strong></td>
                    <td><span class="badge-status badge-info">{{ $p->degree }}</span></td>
                    <td>{{ $p->accreditation ?? '-' }}</td>
                    <td>{{ $p->head_name ?? '-' }}</td>
                    <td>{{ $p->order }}</td>
                    <td>@if($p->is_active)<span class="badge-status badge-success">Aktif</span>@else<span class="badge-status badge-secondary">Nonaktif</span>@endif</td>
                    <td style="white-space:nowrap">
                        <a href="{{ route('admin.study-programs.edit', $p) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.study-programs.destroy', $p) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus prodi?')">@csrf @method('DELETE')<button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button></form>
                    </td>
                </tr>
                @empty<tr><td colspan="8" class="text-center py-4">Belum ada program studi</td></tr>@endforelse
            </tbody>
        </table>
        </div>
    </div>
</div>
@endsection
