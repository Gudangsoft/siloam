@extends('layouts.admin')
@section('title', 'Edit Halaman: ' . $page->title)
@section('page-title', 'Edit: ' . $page->title)
@section('breadcrumb', 'Halaman Statis')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div></div>
    <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
</div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.pages.update', $page) }}" method="POST">
            @csrf @method('PUT')
            <div class="form-group"><label class="form-label">Judul Halaman</label><input type="text" name="title" class="form-control" value="{{ old('title', $page->title) }}"></div>
            <div class="form-group"><label class="form-label">Konten</label><textarea name="content" id="pageContent" class="form-control" rows="20">{{ old('content', $page->content) }}</textarea></div>
            <div class="form-group"><label class="form-label">Meta Title (SEO)</label><input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $page->meta_title) }}"></div>
            <div class="form-group"><label class="form-label">Meta Description (SEO)</label><textarea name="meta_description" class="form-control" rows="2">{{ old('meta_description', $page->meta_description) }}</textarea></div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Simpan Perubahan</button>
        </form>
    </div>
</div>
@endsection
@push('scripts')
<script>$(document).ready(function(){ $('#pageContent').summernote({height:400}); });</script>
@endpush
