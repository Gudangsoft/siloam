@extends('layouts.admin')
@section('title', 'Penelitian & Pengabdian')
@section('page-title', 'Penelitian & Pengabdian')
@section('breadcrumb', 'Penelitian & Kerjasama')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div></div>
    <a href="{{ route('admin.research.create') }}" class="btn btn-primary"><i class="fas fa-plus me-1"></i> Tambah</a>
</div>
<div class="card">
    <div class="card-body">
        <div class="table-wrapper">
        <table class="table datatable">
            <thead><tr><th>#</th><th>Judul</th><th>Tipe</th><th>Peneliti</th><th>Tahun</th><th>Status</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse($research as $r)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ Str::limit($r->title, 60) }}</td>
                    <td><span class="badge-status badge-info">{{ ucfirst($r->type) }}</span></td>
                    <td>{{ $r->researcher ?? '-' }}</td>
                    <td>{{ $r->year ?? '-' }}</td>
                    <td>@if($r->is_published)<span class="badge-status badge-success">Tayang</span>@else<span class="badge-status badge-secondary">Draft</span>@endif</td>
                    <td style="white-space:nowrap">
                        <a href="{{ route('admin.research.edit', $r) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.research.destroy', $r) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus?')">@csrf @method('DELETE')<button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button></form>
                    </td>
                </tr>
                @empty<tr><td colspan="7" class="text-center py-4">Belum ada data</td></tr>@endforelse
            </tbody>
        </table>
        </div>
        <div class="mt-3">{{ $research->links() }}</div>
    </div>
</div>
@endsection
