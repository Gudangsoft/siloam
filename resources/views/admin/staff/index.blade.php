@extends('layouts.admin')
@section('title', 'Dosen & Staf')
@section('page-title', 'Dosen & Staf')
@section('breadcrumb', 'Profil Kampus')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div></div>
    <a href="{{ route('admin.staff.create') }}" class="btn btn-primary"><i class="fas fa-plus me-1"></i> Tambah</a>
</div>
<div class="card">
    <div class="card-body">
        <div class="table-wrapper">
        <table id="dataTable" class="table datatable">
            <thead><tr><th>#</th><th>Foto</th><th>Nama</th><th>Jabatan</th><th>Kategori</th><th>NIDN</th><th>Status</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse($staff as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>@if($item->photo)<img src="{{ Storage::disk('public')->url($item->photo) }}" style="width:40px;height:40px;object-fit:cover;border-radius:50%">@else<div style="width:40px;height:40px;background:#e2e8f0;border-radius:50%;display:flex;align-items:center;justify-content:center"><i class="fas fa-user" style="color:#94a3b8"></i></div>@endif</td>
                    <td><strong>{{ $item->name }}</strong></td>
                    <td>{{ $item->position }}</td>
                    <td><span class="badge-status badge-{{ $item->category === 'pimpinan' ? 'danger' : ($item->category === 'dosen' ? 'info' : 'secondary') }}">{{ ucfirst($item->category) }}</span></td>
                    <td>{{ $item->nidn ?? '-' }}</td>
                    <td>@if($item->is_active)<span class="badge-status badge-success">Aktif</span>@else<span class="badge-status badge-secondary">Nonaktif</span>@endif</td>
                    <td style="white-space:nowrap">
                        <a href="{{ route('admin.staff.edit', $item) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.staff.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return delConfirm(event, this, '{{ addslashes($item->name) }}')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty<tr><td colspan="8" class="text-center py-4">Belum ada data</td></tr>@endforelse
            </tbody>
        </table>
        </div>
        <div class="mt-3">{{ $staff->links() }}</div>
    </div>
</div>
@endsection
