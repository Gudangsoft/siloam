@extends('layouts.admin')
@section('title', 'Edit Halaman: ' . $page->title)
@section('page-title', 'Edit Halaman')
@section('breadcrumb', 'Halaman Statis')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <p class="text-muted mb-0" style="font-size:13px">
        URL publik: <a href="{{ url('/halaman/' . $page->slug) }}" target="_blank" class="text-primary">
            /halaman/{{ $page->slug }}
        </a>
    </p>
    <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary btn-sm">
        <i class="fas fa-arrow-left me-1"></i> Kembali
    </a>
</div>

@if($errors->any())
<div class="alert alert-danger mb-4">
    <i class="fas fa-exclamation-triangle me-2"></i>
    @foreach($errors->all() as $e) {{ $e }}<br> @endforeach
</div>
@endif

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.pages.update', $page) }}" method="POST">
            @csrf @method('PUT')

            <div class="row g-3 mb-3">
                <div class="col-md-8">
                    <label class="form-label fw-bold">Judul Halaman <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                           value="{{ old('title', $page->title) }}" oninput="autoSlug(this.value)" required>
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Slug (URL) <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text text-muted" style="font-size:12px">/halaman/</span>
                        <input type="text" name="slug" id="slugInput"
                               class="form-control @error('slug') is-invalid @enderror"
                               value="{{ old('slug', $page->slug) }}"
                               placeholder="contoh-halaman" required>
                    </div>
                    @error('slug')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    <div class="form-hint">Huruf kecil, angka, dan tanda hubung saja</div>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label fw-bold">Konten</label>
                <textarea name="content" id="pageContent" class="form-control" rows="20">{{ old('content', $page->content) }}</textarea>
            </div>

            <div class="row g-3 mt-1">
                <div class="col-md-6">
                    <label class="form-label">Meta Title <span style="color:#94a3b8;font-size:12px">(SEO)</span></label>
                    <input type="text" name="meta_title" class="form-control"
                           value="{{ old('meta_title', $page->meta_title) }}"
                           placeholder="Judul yang muncul di Google...">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Meta Description <span style="color:#94a3b8;font-size:12px">(SEO)</span></label>
                    <textarea name="meta_description" class="form-control" rows="2"
                              placeholder="Deskripsi singkat untuk mesin pencari...">{{ old('meta_description', $page->meta_description) }}</textarea>
                </div>
            </div>

            <div class="d-flex gap-2 mt-4 pt-3 border-top">
                <button type="submit" class="btn btn-warning btn-lg">
                    <i class="fas fa-save me-1"></i> Simpan Perubahan
                </button>
                <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary btn-lg">Batal</a>
                <button type="button" class="btn btn-danger btn-lg ms-auto"
                        onclick="if(confirm('Hapus halaman ini? Semua link menu yang mengarah ke halaman ini akan rusak.')) document.getElementById('deletePageForm').submit()">
                    <i class="fas fa-trash me-1"></i> Hapus Halaman
                </button>
            </div>
        </form>

        {{-- Form hapus di LUAR form utama --}}
        <form id="deletePageForm" action="{{ route('admin.pages.destroy', $page) }}" method="POST" class="d-none">
            @csrf @method('DELETE')
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#pageContent').summernote({ height: 400 });
});
function autoSlug(title) {
    // Only auto-fill slug if user hasn't manually edited it
    const slugEl = document.getElementById('slugInput');
    if (slugEl.dataset.manual) return;
    slugEl.value = title.toLowerCase()
        .replace(/[^a-z0-9\s\-]/g, '')
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-')
        .replace(/^-|-$/g, '');
}
document.getElementById('slugInput').addEventListener('input', function() {
    this.dataset.manual = '1';
});
</script>
@endpush
