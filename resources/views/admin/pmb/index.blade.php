@extends('layouts.admin')
@section('title', 'Data PMB')
@section('page-title', 'Penerimaan Mahasiswa Baru')
@section('breadcrumb', 'PMB & Mahasiswa')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-start flex-wrap gap-2">
        <form method="GET" class="d-flex gap-2 flex-wrap">
            <input type="text" name="search" class="form-control" style="max-width:220px" placeholder="Cari nama / nomor..." value="{{ request('search') }}">
            <select name="status" class="form-control" style="max-width:180px" onchange="this.form.submit()">
                <option value="">Semua Status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                <option value="review" {{ request('status') == 'review' ? 'selected' : '' }}>Ditinjau</option>
                <option value="accepted" {{ request('status') == 'accepted' ? 'selected' : '' }}>Diterima</option>
                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
            </select>
            <button type="submit" class="btn btn-secondary"><i class="fas fa-search"></i></button>
        </form>
        <a href="{{ route('admin.pmb.export', array_filter(['status' => request('status'), 'search' => request('search')])) }}"
           class="btn btn-success">
            <i class="fas fa-file-excel me-1"></i> Export Excel
        </a>
    </div>
    <div class="card-body" style="padding:0">
        <div class="table-wrapper">
        <table class="table" style="margin:0">
            <thead><tr><th>#</th><th>No. Registrasi</th><th>Nama Lengkap</th><th>Program Studi</th><th>Email</th><th>Tanggal Daftar</th><th>Status</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse($registrations as $pmb)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><code>{{ $pmb->registration_number }}</code></td>
                    <td>{{ $pmb->full_name }}</td>
                    <td>{{ $pmb->study_program }}</td>
                    <td>{{ $pmb->email }}</td>
                    <td>{{ $pmb->created_at->format('d/m/Y') }}</td>
                    <td>
                        <span class="badge-status badge-{{ $pmb->status === 'accepted' ? 'success' : ($pmb->status === 'rejected' ? 'danger' : ($pmb->status === 'review' ? 'info' : 'warning')) }}">
                            {{ $pmb->status_badge }}
                        </span>
                    </td>
                    <td style="white-space:nowrap">
                        <a href="{{ route('admin.pmb.show', $pmb) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                        <form action="{{ route('admin.pmb.destroy', $pmb) }}" method="POST" class="d-inline" onsubmit="return delConfirm(event, this, '{{ addslashes($pmb->full_name) }}')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty<tr><td colspan="8" class="text-center py-4">Belum ada pendaftar</td></tr>@endforelse
            </tbody>
        </table>
        </div>
    </div>
    <div style="padding:16px 24px">{{ $registrations->appends(request()->all())->links() }}</div>
</div>
@endsection
