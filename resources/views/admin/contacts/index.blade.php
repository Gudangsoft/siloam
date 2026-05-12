@extends('layouts.admin')
@section('title', 'Pesan Masuk')
@section('page-title', 'Pesan Masuk / Kontak')
@section('breadcrumb', 'Lainnya')
@section('content')
<div class="card">
    <div class="card-body">
        <div class="table-wrapper">
        <table id="dataTable" class="table datatable">
            <thead><tr><th>#</th><th>Nama</th><th>Email</th><th>Subjek</th><th>Tanggal</th><th>Status</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse($contacts as $item)
                <tr style="{{ !$item->is_read ? 'font-weight:600' : '' }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ Str::limit($item->subject, 50) }}</td>
                    <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                    <td>@if($item->is_read)<span class="badge-status badge-success">Dibaca</span>@else<span class="badge-status badge-warning">Belum Dibaca</span>@endif</td>
                    <td style="white-space:nowrap">
                        <a href="{{ route('admin.contacts.show', $item) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                        <form action="{{ route('admin.contacts.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return delConfirm(event, this, 'pesan dari {{ addslashes($item->name) }}')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty<tr><td colspan="7" class="text-center py-4">Tidak ada pesan</td></tr>@endforelse
            </tbody>
        </table>
        </div>
        <div class="mt-3">{{ $contacts->links() }}</div>
    </div>
</div>
@endsection
@push('scripts')
<script>$(document).ready(function(){ if($('#dataTable').length){ $('#dataTable').DataTable({paging:false, order:[[4,'desc']]}); } });</script>
@endpush
