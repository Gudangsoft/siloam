@extends('layouts.admin')
@section('title', 'Video')
@section('page-title', 'Kelola Video')
@section('breadcrumb', 'Konten Website')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div></div>
    <a href="{{ route('admin.videos.create') }}" class="btn btn-primary"><i class="fas fa-plus me-1"></i> Tambah Video</a>
</div>
<div class="card">
    <div class="card-body">
        <div class="table-wrapper">
        <table class="table datatable">
            <thead><tr><th>#</th><th>Judul</th><th>Kategori</th><th>Unggulan</th><th>Status</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse($videos as $v)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ Str::limit($v->title, 60) }}</td>
                    <td>{{ $v->category }}</td>
                    <td>@if($v->is_featured)<span class="badge-status badge-warning">Ya</span>@else<span style="color:#94a3b8">-</span>@endif</td>
                    <td>@if($v->is_published)<span class="badge-status badge-success">Aktif</span>@else<span class="badge-status badge-secondary">Draft</span>@endif</td>
                    <td style="white-space:nowrap">
                        <a href="{{ route('admin.videos.edit', $v) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.videos.destroy', $v) }}" method="POST" class="d-inline" onsubmit="return delConfirm(event, this, '{{ addslashes($v->title) }}')">@csrf @method('DELETE')<button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button></form>
                    </td>
                </tr>
                @empty<tr><td colspan="6" class="text-center py-4">Belum ada video</td></tr>@endforelse
            </tbody>
        </table>
        </div>
        <div class="mt-3">{{ $videos->links() }}</div>
    </div>
</div>
@endsection
