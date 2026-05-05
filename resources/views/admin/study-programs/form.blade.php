@extends('layouts.admin')
@section('title', isset($program) ? 'Edit Prodi' : 'Tambah Prodi')
@section('page-title', isset($program) ? 'Edit Program Studi' : 'Tambah Program Studi')
@section('breadcrumb', 'Program Studi')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div></div>
    <a href="{{ route('admin.study-programs.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
</div>
<div class="card">
    <div class="card-body">
        <form action="{{ isset($program) ? route('admin.study-programs.update', $program) : route('admin.study-programs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf @if(isset($program)) @method('PUT') @endif
            @if($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6"><div class="form-group"><label class="form-label">Nama Program Studi <span class="text-danger">*</span></label><input type="text" name="name" class="form-control" value="{{ old('name', $program->name ?? '') }}" required></div></div>
                        <div class="col-md-3"><div class="form-group"><label class="form-label">Jenjang <span class="text-danger">*</span></label><select name="degree" class="form-control"><option value="S1" {{ old('degree', $program->degree ?? '') == 'S1' ? 'selected' : '' }}>S1</option><option value="S2" {{ old('degree', $program->degree ?? '') == 'S2' ? 'selected' : '' }}>S2</option><option value="D3" {{ old('degree', $program->degree ?? '') == 'D3' ? 'selected' : '' }}>D3</option></select></div></div>
                        <div class="col-md-3"><div class="form-group"><label class="form-label">Akreditasi</label><input type="text" name="accreditation" class="form-control" value="{{ old('accreditation', $program->accreditation ?? '') }}" placeholder="A, B, C, Baik..."></div></div>
                    </div>
                    <div class="form-group"><label class="form-label">Deskripsi Program</label><textarea name="description" class="form-control" rows="3">{{ old('description', $program->description ?? '') }}</textarea></div>
                    <div class="form-group"><label class="form-label">Visi</label><textarea name="vision" class="form-control" rows="3">{{ old('vision', $program->vision ?? '') }}</textarea></div>
                    <div class="form-group"><label class="form-label">Misi</label><textarea name="mission" class="form-control" rows="4">{{ old('mission', $program->mission ?? '') }}</textarea></div>
                    <div class="form-group"><label class="form-label">Tujuan Program</label><textarea name="objectives" class="form-control" rows="3">{{ old('objectives', $program->objectives ?? '') }}</textarea></div>
                    <div class="form-group"><label class="form-label">Prospek Karir Lulusan</label><textarea name="career_prospects" class="form-control" rows="3">{{ old('career_prospects', $program->career_prospects ?? '') }}</textarea></div>
                    <div class="row">
                        <div class="col-md-6"><div class="form-group"><label class="form-label">Nama Kaprodi</label><input type="text" name="head_name" class="form-control" value="{{ old('head_name', $program->head_name ?? '') }}"></div></div>
                        <div class="col-md-3"><div class="form-group"><label class="form-label">Urutan</label><input type="number" name="order" class="form-control" value="{{ old('order', $program->order ?? 0) }}"></div></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group"><label class="form-label">Gambar</label>
                        @if(isset($program) && $program->image)<div class="mb-2"><img src="{{ Storage::disk('public')->url($program->image) }}" style="max-width:100%;border-radius:6px"></div>@endif
                        <input type="file" name="image" class="form-control" accept="image/*">
                    </div>
                    <div class="form-check mb-3"><input type="checkbox" name="is_active" value="1" {{ old('is_active', $program->is_active ?? true) ? 'checked' : '' }}><label>Program Studi Aktif</label></div>
                    <button type="submit" class="btn btn-primary" style="width:100%"><i class="fas fa-save me-1"></i> Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
