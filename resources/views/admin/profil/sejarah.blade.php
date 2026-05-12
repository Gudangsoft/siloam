@extends('layouts.admin')
@section('title', 'Edit Sejarah Kampus')
@section('page-title', 'Sejarah Kampus')
@section('breadcrumb', 'Profil Kampus › Sejarah')

@section('content')
<div style="max-width:900px">

    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px">
        <div>
            <h2 style="font-size:22px;font-weight:800;color:#0f172a;margin:0">Edit Sejarah Kampus</h2>
            <p style="color:#64748b;font-size:13px;margin-top:4px">Konten yang ditampilkan di halaman <strong>/profil/sejarah</strong></p>
        </div>
        <a href="{{ route('profil.sejarah') }}" target="_blank" class="btn btn-secondary btn-sm">
            <i class="fas fa-external-link-alt"></i> Lihat Halaman
        </a>
    </div>

    <form action="{{ route('admin.profil.sejarah.update') }}" method="POST">
        @csrf @method('PUT')

        <div class="card">
            <div class="card-header">
                <h4><i class="fas fa-landmark me-2" style="color:#1e40af"></i> Konten Sejarah</h4>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Isi Sejarah Kampus</label>
                    <textarea id="editor" name="content" class="form-control" rows="20">{{ old('content', $page->content) }}</textarea>
                    <p class="form-hint">Gunakan editor di atas untuk memformat teks, tambah gambar, tabel, dll.</p>
                </div>
            </div>
        </div>

        <div style="display:flex;gap:12px;margin-top:20px">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Simpan Perubahan
            </button>
            <a href="{{ route('profil.sejarah') }}" target="_blank" class="btn btn-secondary">
                <i class="fas fa-eye"></i> Preview
            </a>
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
        ['font',   ['bold','italic','underline','strikethrough','clear']],
        ['para',   ['ul','ol','paragraph']],
        ['insert', ['link','picture','hr']],
        ['view',   ['fullscreen','codeview']],
    ],
});
</script>
@endpush
