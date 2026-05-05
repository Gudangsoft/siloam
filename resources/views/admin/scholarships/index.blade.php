@extends('layouts.admin')
@section('title', 'Beasiswa')
@section('page-title', 'Beasiswa')
@section('breadcrumb', 'PMB & Mahasiswa')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div></div>
    <a href="{{ route('admin.scholarships.create') }}" class="btn btn-primary"><i class="fas fa-plus me-1"></i> Tambah Beasiswa</a>
</div>
<div class="card">
    <div class="card-body">
        <div class="table-wrapper">
        <table class="table datatable">
            <thead><tr><th>#</th><th>Nama Beasiswa</th><th>Penyelenggara</th><th>Nominal</th><th>Deadline</th><th>Status</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse($scholarships as $s)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $s->name }}</td>
                    <td>{{ $s->provider }}</td>
                    <td>{{ $s->amount ?? '-' }}</td>
                    <td>{{ $s->deadline ? $s->deadline->format('d/m/Y') : '-' }}</td>
                    <td>@if($s->is_active)<span class="badge-status badge-success">Aktif</span>@else<span class="badge-status badge-secondary">Nonaktif</span>@endif</td>
                    <td style="white-space:nowrap">
                        <a href="{{ route('admin.scholarships.edit', $s) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.scholarships.destroy', $s) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus?')">@csrf @method('DELETE')<button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button></form>
                    </td>
                </tr>
                @empty<tr><td colspan="7" class="text-center py-4">Belum ada beasiswa</td></tr>@endforelse
            </tbody>
        </table>
        </div>
        <div class="mt-3">{{ $scholarships->links() }}</div>
    </div>
</div>
@endsection
