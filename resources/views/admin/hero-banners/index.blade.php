@extends('layouts.admin')
@section('title', 'Hero Banner')
@section('page-title', 'Hero Banner / Slider')
@section('breadcrumb', 'Konten Website')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div></div>
    <a href="{{ route('admin.hero-banners.create') }}" class="btn btn-primary"><i class="fas fa-plus me-1"></i> Tambah Banner</a>
</div>
<div class="card">
    <div class="card-body">
        <div class="table-wrapper">
        <table class="table">
            <thead><tr><th>#</th><th>Gambar</th><th>Judul</th><th>Subtitle</th><th>Urutan</th><th>Status</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse($banners as $b)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>@if($b->image)<img src="{{ Storage::disk('public')->url($b->image) }}" style="width:80px;height:50px;object-fit:cover;border-radius:4px">@else<span style="color:#94a3b8">-</span>@endif</td>
                    <td>{{ Str::limit($b->title, 40) }}</td>
                    <td>{{ Str::limit($b->subtitle ?? '-', 40) }}</td>
                    <td>{{ $b->order }}</td>
                    <td>@if($b->is_active)<span class="badge-status badge-success">Aktif</span>@else<span class="badge-status badge-secondary">Nonaktif</span>@endif</td>
                    <td style="white-space:nowrap">
                        <a href="{{ route('admin.hero-banners.edit', $b) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.hero-banners.destroy', $b) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus banner?')">@csrf @method('DELETE')<button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button></form>
                    </td>
                </tr>
                @empty<tr><td colspan="7" class="text-center py-4">Belum ada banner</td></tr>@endforelse
            </tbody>
        </table>
        </div>
    </div>
</div>
@endsection
