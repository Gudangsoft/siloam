@extends('layouts.admin')
@section('title', 'Form Prestasi')
@section('page-title', isset($achievement) ? 'Edit Prestasi Mahasiswa' : 'Tambah Prestasi Mahasiswa')
@section('breadcrumb', 'Prestasi Mahasiswa')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div></div>
    <a href="{{ route('admin.student-achievements.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
</div>
<div class="card" style="max-width:700px">
    <div class="card-body">
        <form action="{{ isset($achievement) ? route('admin.student-achievements.update', $achievement) : route('admin.student-achievements.store') }}" method="POST" enctype="multipart/form-data">
            @csrf @if(isset($achievement)) @method('PUT') @endif
            <div class="form-group"><label class="form-label">Judul Prestasi <span class="text-danger">*</span></label><input type="text" name="title" class="form-control" value="{{ old('title', $achievement->title ?? '') }}" required></div>
            <div class="row">
                <div class="col-md-6"><div class="form-group"><label class="form-label">Nama Mahasiswa <span class="text-danger">*</span></label><input type="text" name="student_name" class="form-control" value="{{ old('student_name', $achievement->student_name ?? '') }}" required></div></div>
                <div class="col-md-6"><div class="form-group"><label class="form-label">Program Studi</label><input type="text" name="study_program" class="form-control" value="{{ old('study_program', $achievement->study_program ?? '') }}"></div></div>
            </div>
            <div class="row">
                <div class="col-md-4"><div class="form-group"><label class="form-label">Tingkat <span class="text-danger">*</span></label>
                    <select name="level" class="form-control">
                        <option value="internasional" {{ old('level', $achievement->level ?? '') == 'internasional' ? 'selected' : '' }}>Internasional</option>
                        <option value="nasional" {{ old('level', $achievement->level ?? '') == 'nasional' ? 'selected' : '' }}>Nasional</option>
                        <option value="regional" {{ old('level', $achievement->level ?? '') == 'regional' ? 'selected' : '' }}>Regional</option>
                        <option value="lokal" {{ old('level', $achievement->level ?? '') == 'lokal' ? 'selected' : '' }}>Lokal</option>
                    </select></div></div>
                <div class="col-md-4"><div class="form-group"><label class="form-label">Penghargaan</label><input type="text" name="award" class="form-control" value="{{ old('award', $achievement->award ?? '') }}" placeholder="Juara 1, Best Paper..."></div></div>
                <div class="col-md-4"><div class="form-group"><label class="form-label">Tahun <span class="text-danger">*</span></label><input type="number" name="year" class="form-control" value="{{ old('year', $achievement->year ?? date('Y')) }}" min="2000" max="2099" required></div></div>
            </div>
            <div class="form-group"><label class="form-label">Deskripsi</label><textarea name="description" class="form-control" rows="3">{{ old('description', $achievement->description ?? '') }}</textarea></div>
            <div class="form-group"><label class="form-label">Foto</label>
                @if(isset($achievement) && $achievement->image)<div class="mb-2"><img src="{{ Storage::disk('public')->url($achievement->image) }}" style="max-height:100px;border-radius:6px"></div>@endif
                <input type="file" name="image" class="form-control" accept="image/*"></div>
            <div class="form-check mb-3"><input type="checkbox" name="is_published" value="1" {{ old('is_published', $achievement->is_published ?? true) ? 'checked' : '' }}><label>Tayangkan</label></div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Simpan</button>
        </form>
    </div>
</div>
@endsection
