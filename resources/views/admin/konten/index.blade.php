@extends('layouts.admin')
@section('title', 'Kelola Konten Halaman')
@section('page-title', 'Kelola Konten Halaman')
@section('breadcrumb', 'Konten')
@section('content')

<div class="alert alert-info d-flex align-items-start gap-2 mb-4" style="border-radius:10px">
    <i class="fas fa-info-circle mt-1"></i>
    <div>
        <strong>Cara penggunaan:</strong> Klik <strong>Edit Konten</strong> untuk menambah atau mengubah teks tambahan di halaman tersebut.
        Konten yang ditulis akan muncul di bagian bawah halaman, melengkapi konten otomatis dari sistem.
    </div>
</div>

@foreach($groups as $groupName => $items)
<div class="card mb-4">
    <div class="card-header d-flex align-items-center gap-2 py-3"
         style="background:#f8fafc;border-bottom:1px solid #e2e8f0">
        <span class="fw-bold text-dark">{{ $groupName }}</span>
        <span class="badge bg-secondary ms-1">{{ count($items) }} halaman</span>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead>
                <tr style="font-size:12px;color:#64748b;background:#f8fafc">
                    <th class="px-4 py-2">Halaman</th>
                    <th class="px-4 py-2">Status Konten</th>
                    <th class="px-4 py-2">Terakhir Diubah</th>
                    <th class="px-4 py-2 text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                @php
                    $page = $existingPages->get($item['slug']);
                    $hasContent = $page && !empty(trim(strip_tags($page->content ?? '')));
                @endphp
                <tr>
                    <td class="px-4 py-3">
                        <div class="d-flex align-items-center gap-2">
                            <span class="text-primary" style="width:20px;text-align:center">
                                <i class="{{ $item['icon'] }}"></i>
                            </span>
                            <div>
                                <div class="fw-semibold text-dark">{{ $item['title'] }}</div>
                                <div class="text-muted" style="font-size:11px">/{{ $item['slug'] }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-3">
                        @if($hasContent)
                            <span class="badge bg-success">Ada Konten</span>
                        @elseif($page)
                            <span class="badge bg-warning text-dark">Halaman Ada, Konten Kosong</span>
                        @else
                            <span class="badge bg-light text-secondary border">Belum Dibuat</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-muted" style="font-size:12px">
                        {{ $page ? $page->updated_at->diffForHumans() : '—' }}
                    </td>
                    <td class="px-4 py-3 text-end">
                        <div class="d-flex gap-2 justify-content-end">
                            <a href="{{ route('admin.konten.edit', $item['slug']) }}"
                               class="btn btn-sm btn-warning">
                                <i class="fas fa-edit me-1"></i>Edit Konten
                            </a>
                            <a href="{{ route($item['url_name']) }}" target="_blank"
                               class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-external-link-alt"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endforeach

@endsection
