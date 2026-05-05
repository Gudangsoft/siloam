@extends('layouts.admin')
@section('title', isset($video) ? 'Edit Video' : 'Tambah Video')
@section('page-title', isset($video) ? 'Edit Video' : 'Tambah Video')
@section('breadcrumb', 'Video')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div></div>
    <a href="{{ route('admin.videos.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
</div>
<div class="card" style="max-width:700px">
    <div class="card-body">
        <form action="{{ isset($video) ? route('admin.videos.update', $video) : route('admin.videos.store') }}" method="POST">
            @csrf @if(isset($video)) @method('PUT') @endif
            @if($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif
            <div class="form-group"><label class="form-label">Judul Video <span class="text-danger">*</span></label><input type="text" name="title" class="form-control" value="{{ old('title', $video->title ?? '') }}" required></div>
            <div class="form-group"><label class="form-label">URL YouTube <span class="text-danger">*</span></label><input type="url" name="youtube_url" class="form-control" value="{{ old('youtube_url', $video->youtube_url ?? '') }}" placeholder="https://www.youtube.com/watch?v=..." required></div>
            <div class="form-group"><label class="form-label">Kategori</label><input type="text" name="category" class="form-control" value="{{ old('category', $video->category ?? 'umum') }}"></div>
            <div class="form-group"><label class="form-label">Deskripsi</label><textarea name="description" class="form-control" rows="3">{{ old('description', $video->description ?? '') }}</textarea></div>
            <div class="form-check mb-2"><input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $video->is_featured ?? false) ? 'checked' : '' }}><label>Video Unggulan</label></div>
            <div class="form-check mb-3"><input type="checkbox" name="is_published" value="1" {{ old('is_published', $video->is_published ?? true) ? 'checked' : '' }}><label>Publikasikan</label></div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Simpan</button>
        </form>
    </div>
</div>
@endsection
