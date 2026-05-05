@extends('layouts.admin')
@section('title', isset($news) ? 'Edit Berita' : 'Tambah Berita')
@section('page-title', isset($news) ? 'Edit Berita' : 'Tambah Berita Baru')
@section('breadcrumb', 'Berita & Artikel')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div></div>
    <a href="{{ route('admin.news.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
</div>
@if($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif
<form action="{{ isset($news) ? route('admin.news.update', $news) : route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($news)) @method('PUT') @endif
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h4>Konten Berita</h4></div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">Judul Berita <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $news->title ?? '') }}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Ringkasan (Excerpt)</label>
                        <textarea name="excerpt" class="form-control" rows="3">{{ old('excerpt', $news->excerpt ?? '') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Konten Lengkap <span class="text-danger">*</span></label>
                        <textarea name="content" id="content" class="form-control" rows="15">{{ old('content', $news->content ?? '') }}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header"><h4>Pengaturan</h4></div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">Kategori <span class="text-danger">*</span></label>
                        <select name="category" class="form-control">
                            <option value="berita" {{ old('category', $news->category ?? '') == 'berita' ? 'selected' : '' }}>Berita</option>
                            <option value="artikel" {{ old('category', $news->category ?? '') == 'artikel' ? 'selected' : '' }}>Artikel</option>
                            <option value="pengumuman" {{ old('category', $news->category ?? '') == 'pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Penulis</label>
                        <input type="text" name="author" class="form-control" value="{{ old('author', $news->author ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Gambar Utama</label>
                        @if(isset($news) && $news->image)
                            <div class="mb-2"><img src="{{ Storage::disk('public')->url($news->image) }}" style="max-width:100%;border-radius:6px"></div>
                        @endif
                        <input type="file" name="image" class="form-control" accept="image/*">
                        <div class="form-hint">Maks. 2MB. Format: JPG, PNG</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tanggal Publish</label>
                        <input type="datetime-local" name="published_at" class="form-control" value="{{ old('published_at', isset($news->published_at) ? $news->published_at->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i')) }}">
                    </div>
                    <div class="form-check mb-2">
                        <input type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published', $news->is_published ?? true) ? 'checked' : '' }}>
                        <label for="is_published">Tayangkan Sekarang</label>
                    </div>
                    <div class="form-check mb-3">
                        <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured', $news->is_featured ?? false) ? 'checked' : '' }}>
                        <label for="is_featured">Tandai sebagai Unggulan</label>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width:100%"><i class="fas fa-save me-1"></i> {{ isset($news) ? 'Perbarui' : 'Simpan' }}</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
@push('scripts')
<script>
$(document).ready(function(){
    $('#content').summernote({height:400, toolbar:[['style',['bold','italic','underline','clear']],['font',['strikethrough']],['para',['ul','ol','paragraph']],['insert',['link','picture','hr']],['view',['fullscreen','codeview']]]});
});
</script>
@endpush
