@extends('layouts.admin')
@section('title', 'Kelola Berita')
@section('page-title', 'Berita & Artikel')
@section('breadcrumb', 'Kelola Berita')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div></div>
    <a href="{{ route('admin.news.create') }}" class="btn btn-primary"><i class="fas fa-plus me-1"></i> Tambah Berita</a>
</div>
<div class="card">
    <div class="card-body">
        <div class="table-wrapper">
        <table id="newsTable" class="table datatable">
            <thead><tr><th>#</th><th>Gambar</th><th>Judul</th><th>Kategori</th><th>Penulis</th><th>Status</th><th>Tanggal</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse($news as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>@if($item->image)<img src="{{ Storage::disk('public')->url($item->image) }}" style="width:60px;height:45px;object-fit:cover;border-radius:4px">@else<span class="text-muted">-</span>@endif</td>
                    <td>{{ Str::limit($item->title, 60) }}</td>
                    <td><span class="badge-status badge-{{ $item->category === 'berita' ? 'info' : ($item->category === 'pengumuman' ? 'warning' : 'secondary') }}">{{ ucfirst($item->category) }}</span>@if($item->is_featured) <span class="badge-status badge-danger">Unggulan</span>@endif</td>
                    <td>{{ $item->author ?? '-' }}</td>
                    <td>@if($item->is_published)<span class="badge-status badge-success">Tayang</span>@else<span class="badge-status badge-secondary">Draft</span>@endif</td>
                    <td>{{ $item->created_at->format('d/m/Y') }}</td>
                    <td style="white-space:nowrap">
                        <a href="{{ route('admin.news.edit', $item) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.news.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return delConfirm(event, this, '{{ addslashes($item->title) }}')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty<tr><td colspan="8" class="text-center py-4">Belum ada berita</td></tr>@endforelse
            </tbody>
        </table>
        </div>
    </div>
</div>
@endsection
