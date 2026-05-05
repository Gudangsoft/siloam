@extends('layouts.admin')
@section('title', isset($gallery) ? 'Edit Foto' : 'Upload Foto')
@section('page-title', isset($gallery) ? 'Edit Foto Galeri' : 'Upload Foto Galeri')
@section('breadcrumb', 'Galeri Foto')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div></div>
    <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
</div>
<div class="card" style="max-width:600px">
    <div class="card-body">
        <form action="{{ isset($gallery) ? route('admin.gallery.update', $gallery) : route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
            @csrf @if(isset($gallery)) @method('PUT') @endif
            @if($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif
            <div class="form-group"><label class="form-label">Judul Foto <span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $gallery->title ?? '') }}" required></div>
            <div class="form-group"><label class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description', $gallery->description ?? '') }}</textarea></div>
            <div class="form-group"><label class="form-label">Kategori</label>
                <input type="text" name="category" class="form-control" value="{{ old('category', $gallery->category ?? 'umum') }}" placeholder="umum, kampus, kegiatan, wisuda..."></div>
            <div class="form-group"><label class="form-label">File Foto @if(!isset($gallery))<span class="text-danger">*</span>@endif</label>
                @if(isset($gallery) && $gallery->image)<div class="mb-2"><img src="{{ Storage::disk('public')->url($gallery->image) }}" style="max-height:150px;border-radius:6px"></div>@endif
                <input type="file" name="image" class="form-control" accept="image/*" @if(!isset($gallery)) required @endif>
                <div class="form-hint">Maks. 4MB. Format: JPG, PNG, WebP</div></div>
            <div class="row">
                <div class="col-md-4"><div class="form-group"><label class="form-label">Urutan</label>
                    <input type="number" name="order" class="form-control" value="{{ old('order', $gallery->order ?? 0) }}"></div></div>
            </div>
            <div class="form-check mb-3">
                <input type="checkbox" name="is_published" value="1" {{ old('is_published', $gallery->is_published ?? true) ? 'checked' : '' }}>
                <label>Tampilkan di Website</label>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Simpan</button>
        </form>
    </div>
</div>
@endsection
