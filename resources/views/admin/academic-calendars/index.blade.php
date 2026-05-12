@extends('layouts.admin')
@section('title', 'Kalender Akademik')
@section('page-title', 'Kalender Akademik')
@section('breadcrumb', 'Profil Kampus')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div></div>
    <a href="{{ route('admin.academic-calendars.create') }}" class="btn btn-primary"><i class="fas fa-plus me-1"></i> Tambah Kegiatan</a>
</div>
<div class="card">
    <div class="card-body">
        <div class="table-wrapper">
        <table class="table datatable">
            <thead><tr><th>#</th><th>Kegiatan</th><th>Semester</th><th>Tahun Akademik</th><th>Tanggal Mulai</th><th>Tanggal Selesai</th><th>Status</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse($calendars as $c)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><span style="display:inline-block;width:10px;height:10px;border-radius:50%;background:{{ $c->color }};margin-right:8px"></span>{{ $c->title }}</td>
                    <td>{{ $c->semester }}</td>
                    <td>{{ $c->academic_year }}</td>
                    <td>{{ $c->start_date->format('d/m/Y') }}</td>
                    <td>{{ $c->end_date ? $c->end_date->format('d/m/Y') : '-' }}</td>
                    <td>@if($c->is_published)<span class="badge-status badge-success">Tayang</span>@else<span class="badge-status badge-secondary">Draft</span>@endif</td>
                    <td style="white-space:nowrap">
                        <a href="{{ route('admin.academic-calendars.edit', $c) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.academic-calendars.destroy', $c) }}" method="POST" class="d-inline" onsubmit="return delConfirm(event, this, '{{ addslashes($c->title) }}')">@csrf @method('DELETE')<button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button></form>
                    </td>
                </tr>
                @empty<tr><td colspan="8" class="text-center py-4">Belum ada jadwal</td></tr>@endforelse
            </tbody>
        </table>
        </div>
        <div class="mt-3">{{ $calendars->links() }}</div>
    </div>
</div>
@endsection
