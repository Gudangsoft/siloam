@extends('layouts.admin')
@section('title', 'Fasilitas')
@section('page-title', 'Fasilitas Kampus')
@section('breadcrumb', 'Profil Kampus')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div></div>
    <a href="{{ route('admin.facilities.create') }}" class="btn btn-primary"><i class="fas fa-plus me-1"></i> Tambah Fasilitas</a>
</div>
<div class="card">
    <div class="card-body">
        <div class="table-wrapper">
        <table class="table datatable">
            <thead><tr><th>#</th><th>Gambar</th><th>Nama Fasilitas</th><th>Deskripsi</th><th>Urutan</th><th>Status</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse($facilities as $f)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>@if($f->image)<img src="{{ Storage::disk('public')->url($f->image) }}" style="width:60px;height:45px;object-fit:cover;border-radius:4px">@else<span style="color:#94a3b8">-</span>@endif</td>
                    <td>{{ $f->name }}</td>
                    <td>{{ Str::limit($f->description ?? '-', 50) }}</td>
                    <td>{{ $f->order }}</td>
                    <td>@if($f->is_published)<span class="badge-status badge-success">Tayang</span>@else<span class="badge-status badge-secondary">Draft</span>@endif</td>
                    <td style="white-space:nowrap">
                        <a href="{{ route('admin.facilities.edit', $f) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.facilities.destroy', $f) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus?')">@csrf @method('DELETE')<button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button></form>
                    </td>
                </tr>
                @empty<tr><td colspan="7" class="text-center py-4">Belum ada fasilitas</td></tr>@endforelse
            </tbody>
        </table>
        </div>
        <div class="mt-3">{{ $facilities->links() }}</div>
    </div>
</div>
@endsection
