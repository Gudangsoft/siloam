@extends('layouts.admin')
@section('title', 'Event & Agenda')
@section('page-title', 'Agenda & Kegiatan')
@section('breadcrumb', 'Kelola Event')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div></div>
    <a href="{{ route('admin.events.create') }}" class="btn btn-primary"><i class="fas fa-plus me-1"></i> Tambah Event</a>
</div>
<div class="card">
    <div class="card-body">
        <div class="table-wrapper">
        <table id="dataTable" class="table datatable">
            <thead><tr><th>#</th><th>Gambar</th><th>Judul</th><th>Lokasi</th><th>Mulai</th><th>Selesai</th><th>Status</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse($events as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>@if($item->image)<img src="{{ Storage::disk('public')->url($item->image) }}" style="width:50px;height:38px;object-fit:cover;border-radius:4px">@else<span class="text-muted">-</span>@endif</td>
                    <td>{{ Str::limit($item->title, 50) }}</td>
                    <td>{{ $item->location ?? '-' }}</td>
                    <td>{{ $item->start_date->format('d/m/Y H:i') }}</td>
                    <td>{{ $item->end_date ? $item->end_date->format('d/m/Y') : '-' }}</td>
                    <td>@if($item->is_published)<span class="badge-status badge-success">Aktif</span>@else<span class="badge-status badge-secondary">Nonaktif</span>@endif</td>
                    <td style="white-space:nowrap">
                        <a href="{{ route('admin.events.edit', $item) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.events.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus event ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty<tr><td colspan="8" class="text-center py-4">Belum ada event</td></tr>@endforelse
            </tbody>
        </table>
        </div>
        <div class="mt-3">{{ $events->links() }}</div>
    </div>
</div>
@endsection
