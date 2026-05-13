@extends('layouts.admin')
@section('use_summernote', '1')
@section('title', 'Edit E-Learning')
@section('page-title', 'E-Learning')
@section('breadcrumb', 'Akademik › E-Learning')

@section('content')
<div style="max-width:900px">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px">
        <div>
            <h2 style="font-size:22px;font-weight:800;color:#0f172a;margin:0">Edit Konten E-Learning</h2>
            <p style="color:#64748b;font-size:13px;margin-top:4px">Halaman <strong>/akademik/elearning</strong></p>
        </div>
        <a href="{{ route('akademik.elearning') }}" target="_blank" class="btn btn-secondary btn-sm">
            <i class="fas fa-external-link-alt"></i> Lihat Halaman
        </a>
    </div>

    <form action="{{ route('admin.akademik.elearning.update') }}" method="POST">
        @csrf @method('PUT')
        <div class="card">
            <div class="card-header">
                <h4><i class="fas fa-laptop me-2" style="color:#1e40af"></i> Konten E-Learning</h4>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Isi Halaman E-Learning</label>
                    <textarea id="editor" name="content" class="form-control" rows="20">{{ old('content', $defaultContent) }}</textarea>
                    <p class="form-hint">Tambahkan informasi, link akses, panduan, atau konten lainnya.</p>
                </div>
            </div>
        </div>
        <div style="display:flex;gap:12px;margin-top:20px">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
            <a href="{{ route('akademik.elearning') }}" target="_blank" class="btn btn-secondary"><i class="fas fa-eye"></i> Preview</a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
$('#editor').summernote({
    height: 400,
    lang: 'id-ID',
    toolbar: [
        ['style',  ['style']],
        ['font',   ['bold','italic','underline','clear']],
        ['para',   ['ul','ol','paragraph']],
        ['insert', ['link','picture','hr']],
        ['view',   ['fullscreen','codeview']],
    ],
});
</script>
@endpush
