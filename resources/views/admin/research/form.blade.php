@extends('layouts.admin')
@section('title', isset($research) ? 'Edit Penelitian' : 'Tambah Penelitian')
@section('page-title', isset($research) ? 'Edit Data Penelitian' : 'Tambah Data Penelitian')
@section('breadcrumb', 'Penelitian & Pengabdian')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div></div>
    <a href="{{ route('admin.research.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
</div>
<div class="card">
    <div class="card-body">
        <form action="{{ isset($research) ? route('admin.research.update', $research) : route('admin.research.store') }}" method="POST" enctype="multipart/form-data">
            @csrf @if(isset($research)) @method('PUT') @endif
            @if($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group"><label class="form-label">Judul <span class="text-danger">*</span></label><input type="text" name="title" class="form-control" value="{{ old('title', $research->title ?? '') }}" required></div>
                    <div class="form-group"><label class="form-label">Abstrak / Ringkasan</label><textarea name="abstract" class="form-control" rows="5">{{ old('abstract', $research->abstract ?? '') }}</textarea></div>
                    <div class="form-group"><label class="form-label">Link / URL (opsional)</label><input type="url" name="link" class="form-control" value="{{ old('link', $research->link ?? '') }}"></div>
                </div>
                <div class="col-md-4">
                    <div class="form-group"><label class="form-label">Tipe <span class="text-danger">*</span></label>
                        <select name="type" class="form-control">
                            <option value="penelitian" {{ old('type', $research->type ?? '') == 'penelitian' ? 'selected' : '' }}>Penelitian</option>
                            <option value="pengabdian" {{ old('type', $research->type ?? '') == 'pengabdian' ? 'selected' : '' }}>Pengabdian Masyarakat</option>
                            <option value="jurnal" {{ old('type', $research->type ?? '') == 'jurnal' ? 'selected' : '' }}>Jurnal Ilmiah</option>
                            <option value="publikasi" {{ old('type', $research->type ?? '') == 'publikasi' ? 'selected' : '' }}>Publikasi</option>
                            <option value="hibah" {{ old('type', $research->type ?? '') == 'hibah' ? 'selected' : '' }}>Hibah Penelitian</option>
                        </select>
                    </div>
                    <div class="form-group"><label class="form-label">Peneliti / Penulis</label><input type="text" name="researcher" class="form-control" value="{{ old('researcher', $research->researcher ?? '') }}"></div>
                    <div class="form-group"><label class="form-label">Tahun</label><input type="text" name="year" class="form-control" value="{{ old('year', $research->year ?? date('Y')) }}"></div>
                    <div class="form-group"><label class="form-label">Sumber Pendanaan</label><input type="text" name="funding_source" class="form-control" value="{{ old('funding_source', $research->funding_source ?? '') }}"></div>
                    <div class="form-group"><label class="form-label">Upload Dokumen (PDF)</label><input type="file" name="document" class="form-control" accept=".pdf"></div>
                    <div class="form-check mb-3"><input type="checkbox" name="is_published" value="1" {{ old('is_published', $research->is_published ?? true) ? 'checked' : '' }}><label>Publikasikan</label></div>
                    <button type="submit" class="btn btn-primary" style="width:100%"><i class="fas fa-save me-1"></i> Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
