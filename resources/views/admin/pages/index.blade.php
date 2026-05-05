@extends('layouts.admin')
@section('title', 'Halaman Statis')
@section('page-title', 'Kelola Halaman Statis')
@section('breadcrumb', 'Konten Website')
@section('content')
<div class="card">
    <div class="card-body">
        <div class="table-wrapper">
        <table class="table">
            <thead><tr><th>#</th><th>Slug</th><th>Judul</th><th>Update Terakhir</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse($pages as $p)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><code>{{ $p->slug }}</code></td>
                    <td>{{ $p->title }}</td>
                    <td>{{ $p->updated_at->format('d/m/Y H:i') }}</td>
                    <td><a href="{{ route('admin.pages.edit', $p) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit me-1"></i> Edit Konten</a></td>
                </tr>
                @empty<tr><td colspan="5" class="text-center py-4">Belum ada halaman</td></tr>@endforelse
            </tbody>
        </table>
        </div>
    </div>
</div>
@endsection
