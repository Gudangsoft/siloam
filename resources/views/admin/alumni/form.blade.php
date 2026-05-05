@extends('layouts.admin')
@section('title', isset($alumni) ? 'Edit Alumni' : 'Tambah Alumni')
@section('page-title', isset($alumni) ? 'Edit Data Alumni' : 'Tambah Data Alumni')
@section('breadcrumb', 'Data Alumni')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div></div>
    <a href="{{ route('admin.alumni.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
</div>
<div class="card">
    <div class="card-body">
        <form action="{{ isset($alumni) ? route('admin.alumni.update', $alumni) : route('admin.alumni.store') }}" method="POST" enctype="multipart/form-data">
            @csrf @if(isset($alumni)) @method('PUT') @endif
            @if($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6"><div class="form-group"><label class="form-label">Nama Lengkap <span class="text-danger">*</span></label><input type="text" name="name" class="form-control" value="{{ old('name', $alumni->name ?? '') }}" required></div></div>
                        <div class="col-md-3"><div class="form-group"><label class="form-label">NIM</label><input type="text" name="nim" class="form-control" value="{{ old('nim', $alumni->nim ?? '') }}"></div></div>
                        <div class="col-md-3"><div class="form-group"><label class="form-label">Tahun Lulus <span class="text-danger">*</span></label><input type="text" name="graduation_year" class="form-control" value="{{ old('graduation_year', $alumni->graduation_year ?? '') }}" required></div></div>
                    </div>
                    <div class="form-group"><label class="form-label">Program Studi <span class="text-danger">*</span></label><input type="text" name="study_program" class="form-control" value="{{ old('study_program', $alumni->study_program ?? '') }}" required></div>
                    <div class="row">
                        <div class="col-md-6"><div class="form-group"><label class="form-label">Posisi Saat Ini</label><input type="text" name="current_position" class="form-control" value="{{ old('current_position', $alumni->current_position ?? '') }}"></div></div>
                        <div class="col-md-6"><div class="form-group"><label class="form-label">Institusi / Perusahaan</label><input type="text" name="current_company" class="form-control" value="{{ old('current_company', $alumni->current_company ?? '') }}"></div></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6"><div class="form-group"><label class="form-label">Email</label><input type="email" name="email" class="form-control" value="{{ old('email', $alumni->email ?? '') }}"></div></div>
                        <div class="col-md-6"><div class="form-group"><label class="form-label">Telepon</label><input type="text" name="phone" class="form-control" value="{{ old('phone', $alumni->phone ?? '') }}"></div></div>
                    </div>
                    <div class="form-group"><label class="form-label">Testimoni</label><textarea name="testimonial" class="form-control" rows="3">{{ old('testimonial', $alumni->testimonial ?? '') }}</textarea></div>
                </div>
                <div class="col-md-4">
                    <div class="form-group"><label class="form-label">Foto</label>
                        @if(isset($alumni) && $alumni->photo)<div class="mb-2"><img src="{{ Storage::disk('public')->url($alumni->photo) }}" style="width:100px;height:100px;object-fit:cover;border-radius:50%;display:block;margin:auto"></div>@endif
                        <input type="file" name="photo" class="form-control" accept="image/*"></div>
                    <div class="form-check mb-2"><input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $alumni->is_featured ?? false) ? 'checked' : '' }}><label>Tampilkan sebagai Unggulan</label></div>
                    <div class="form-check mb-3"><input type="checkbox" name="is_published" value="1" {{ old('is_published', $alumni->is_published ?? true) ? 'checked' : '' }}><label>Tampilkan di Website</label></div>
                    <button type="submit" class="btn btn-primary" style="width:100%"><i class="fas fa-save me-1"></i> Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
