@extends('layouts.admin')
@section('use_summernote', '1')
@section('title', 'Edit Info PMB: ' . $info['title'])
@section('page-title', 'Edit: ' . $info['title'])
@section('breadcrumb', 'PMB & Mahasiswa')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <p class="text-muted mb-0" style="font-size:13px">
        Edit konten halaman <strong>{{ $info['title'] }}</strong>
        — akan ditampilkan di halaman PMB website.
    </p>
    <div class="d-flex gap-2">
        <a href="{{ route($info['route']) }}" target="_blank" class="btn btn-secondary btn-sm">
            <i class="fas fa-external-link-alt me-1"></i>Lihat Halaman
        </a>
        <a href="{{ route('admin.pmb-info.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left me-1"></i>Kembali
        </a>
    </div>
</div>

@if($errors->any())
<div class="alert alert-danger mb-4">
    @foreach($errors->all() as $e){{ $e }}<br>@endforeach
</div>
@endif

<form action="{{ route('admin.pmb-info.update', $slug) }}" method="POST" id="pmb-info-form">
    @csrf @method('PUT')

    <div class="card">
        <div class="card-header">
            <h4>
                <i class="fas {{ $info['icon'] }} me-2" style="color:var(--primary)"></i>
                {{ $info['title'] }}
            </h4>
        </div>
        <div class="card-body">
            <div class="alert mb-4" style="background:#fefce8;border:1px solid #fde68a;color:#92400e;border-radius:10px;padding:12px 16px;font-size:13px">
                <i class="fas fa-lightbulb me-2 text-yellow-500"></i>
                <strong>Tips:</strong> Gunakan editor di bawah untuk mengatur konten halaman ini.
                Jika dikosongkan, halaman akan menampilkan konten default.
            </div>
            <textarea name="content" id="content-editor">{{ old('content', $page->content) }}</textarea>
        </div>
    </div>

</form>

{{-- Sticky save bar — di LUAR form utama --}}
<div style="position:sticky;bottom:0;background:white;padding:14px 0;border-top:1px solid var(--border);margin-top:8px;z-index:10">
    <div class="d-flex gap-2">
        <button type="button" class="btn btn-primary btn-lg"
                onclick="document.getElementById('pmb-info-form').submit()">
            <i class="fas fa-save me-2"></i>Simpan Konten
        </button>
        <a href="{{ route('admin.pmb-info.index') }}" class="btn btn-secondary btn-lg">Batal</a>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs4.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs4.min.css">
<script>
$(document).ready(function() {
    $('#content-editor').summernote({
        height: 450,
        toolbar: [
            ['style',  ['style']],
            ['font',   ['bold','italic','underline','clear']],
            ['color',  ['color']],
            ['para',   ['ul','ol','paragraph']],
            ['table',  ['table']],
            ['insert', ['link','hr']],
            ['view',   ['fullscreen','codeview']],
        ],
        styleTags: ['p','h2','h3','h4','blockquote'],
    });
});
</script>
@endpush
