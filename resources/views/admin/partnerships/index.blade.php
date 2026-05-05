@extends('layouts.admin')
@section('title', 'Kerjasama')
@section('page-title', 'Kerjasama / Mitra')
@section('breadcrumb', 'Penelitian & Kerjasama')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div></div>
    <a href="{{ route('admin.partnerships.create') }}" class="btn btn-primary"><i class="fas fa-plus me-1"></i> Tambah Mitra</a>
</div>
<div class="card">
    <div class="card-body">
        <div class="table-wrapper">
        <table class="table datatable">
            <thead><tr><th>#</th><th>Logo</th><th>Nama Mitra</th><th>Jenis</th><th>Kategori</th><th>MoU</th><th>Status</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse($partnerships as $p)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>@if($p->logo)<img src="{{ Storage::disk('public')->url($p->logo) }}" style="height:35px">@else<span style="color:#94a3b8">-</span>@endif</td>
                    <td>{{ $p->name }}</td>
                    <td><span class="badge-status badge-{{ $p->type === 'nasional' ? 'info' : 'success' }}">{{ ucfirst($p->type) }}</span></td>
                    <td>{{ $p->category ?? '-' }}</td>
                    <td>{{ $p->mou_date ? $p->mou_date->format('d/m/Y') : '-' }}</td>
                    <td>@if($p->is_active)<span class="badge-status badge-success">Aktif</span>@else<span class="badge-status badge-secondary">Nonaktif</span>@endif</td>
                    <td style="white-space:nowrap">
                        <a href="{{ route('admin.partnerships.edit', $p) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.partnerships.destroy', $p) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus?')">@csrf @method('DELETE')<button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button></form>
                    </td>
                </tr>
                @empty<tr><td colspan="8" class="text-center py-4">Belum ada data kerjasama</td></tr>@endforelse
            </tbody>
        </table>
        </div>
        <div class="mt-3">{{ $partnerships->links() }}</div>
    </div>
</div>
@endsection
