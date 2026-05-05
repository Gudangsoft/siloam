@extends('layouts.admin')
@section('title', 'Form Kalender Akademik')
@section('page-title', isset($calendar) ? 'Edit Jadwal Akademik' : 'Tambah Jadwal Akademik')
@section('breadcrumb', 'Kalender Akademik')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div></div>
    <a href="{{ route('admin.academic-calendars.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
</div>
<div class="card" style="max-width:700px">
    <div class="card-body">
        <form action="{{ isset($calendar) ? route('admin.academic-calendars.update', $calendar) : route('admin.academic-calendars.store') }}" method="POST">
            @csrf @if(isset($calendar)) @method('PUT') @endif
            <div class="form-group"><label class="form-label">Nama Kegiatan <span class="text-danger">*</span></label><input type="text" name="title" class="form-control" value="{{ old('title', $calendar->title ?? '') }}" required></div>
            <div class="form-group"><label class="form-label">Deskripsi</label><textarea name="description" class="form-control" rows="2">{{ old('description', $calendar->description ?? '') }}</textarea></div>
            <div class="row">
                <div class="col-md-6"><div class="form-group"><label class="form-label">Tanggal Mulai <span class="text-danger">*</span></label><input type="date" name="start_date" class="form-control" value="{{ old('start_date', $calendar->start_date ?? '') }}" required></div></div>
                <div class="col-md-6"><div class="form-group"><label class="form-label">Tanggal Selesai</label><input type="date" name="end_date" class="form-control" value="{{ old('end_date', $calendar->end_date ?? '') }}"></div></div>
            </div>
            <div class="row">
                <div class="col-md-4"><div class="form-group"><label class="form-label">Semester <span class="text-danger">*</span></label><select name="semester" class="form-control"><option value="Ganjil" {{ old('semester', $calendar->semester ?? '') == 'Ganjil' ? 'selected' : '' }}>Ganjil</option><option value="Genap" {{ old('semester', $calendar->semester ?? '') == 'Genap' ? 'selected' : '' }}>Genap</option></select></div></div>
                <div class="col-md-4"><div class="form-group"><label class="form-label">Tahun Akademik <span class="text-danger">*</span></label><input type="text" name="academic_year" class="form-control" value="{{ old('academic_year', $calendar->academic_year ?? date('Y').'/'.((int)date('Y')+1)) }}" placeholder="2024/2025"></div></div>
                <div class="col-md-4"><div class="form-group"><label class="form-label">Warna Label</label><input type="color" name="color" class="form-control" value="{{ old('color', $calendar->color ?? '#3b82f6') }}" style="height:42px"></div></div>
            </div>
            <div class="form-check mb-3"><input type="checkbox" name="is_published" value="1" {{ old('is_published', $calendar->is_published ?? true) ? 'checked' : '' }}><label>Tampilkan di Website</label></div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Simpan</button>
        </form>
    </div>
</div>
@endsection
