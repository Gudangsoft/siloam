@extends('layouts.admin')
@section('title', 'Info PMB')
@section('page-title', 'Info PMB')
@section('breadcrumb', 'PMB & Mahasiswa')
@section('content')

@if(session('success'))
<div class="alert alert-success mb-4"><i class="fas fa-check-circle me-2"></i>{{ session('success') }}</div>
@endif

<div class="row g-4">
    @foreach($items as $item)
    <div class="col-md-6 col-xl-4">
        <div class="card h-100" style="border-left:4px solid var(--primary)">
            <div class="card-body">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div style="width:44px;height:44px;background:var(--primary-soft);border-radius:12px;display:flex;align-items:center;justify-content:center">
                        <i class="fas {{ $item['icon'] }}" style="color:var(--primary);font-size:18px"></i>
                    </div>
                    <div>
                        <h4 class="mb-0" style="font-size:15px">{{ $item['title'] }}</h4>
                        <small class="text-muted">slug: <code>{{ $item['slug'] }}</code></small>
                    </div>
                </div>
                <div class="mb-3">
                    @if($item['has_content'])
                    <span class="badge-status badge-success"><i class="fas fa-check me-1"></i>Konten tersedia</span>
                    @else
                    <span class="badge-status badge-warning"><i class="fas fa-exclamation me-1"></i>Belum ada konten</span>
                    @endif
                    @if($item['updated_at'])
                    <div class="text-muted" style="font-size:11px;margin-top:4px">
                        Diperbarui: {{ $item['updated_at']->format('d/m/Y H:i') }}
                    </div>
                    @endif
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.pmb-info.edit', $item['slug']) }}" class="btn btn-primary btn-sm flex-grow-1">
                        <i class="fas fa-edit me-1"></i>Edit Konten
                    </a>
                    <a href="{{ route($item['route']) }}" target="_blank" class="btn btn-secondary btn-sm" title="Lihat di website">
                        <i class="fas fa-external-link-alt"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="alert mt-4" style="background:#eff6ff;border:1px solid #bfdbfe;color:#1e40af;border-radius:12px;padding:14px 18px">
    <i class="fas fa-info-circle me-2"></i>
    <strong>Cara kerja:</strong> Edit konten di sini untuk menampilkan informasi di halaman PMB website. Jika konten kosong, halaman akan menampilkan konten default.
</div>
@endsection
