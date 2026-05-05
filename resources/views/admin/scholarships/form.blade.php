@extends('layouts.admin')
@section('title', isset($scholarship) ? 'Edit Beasiswa' : 'Tambah Beasiswa')
@section('page-title', isset($scholarship) ? 'Edit Beasiswa' : 'Tambah Beasiswa')
@section('breadcrumb', 'Beasiswa')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div></div>
    <a href="{{ route('admin.scholarships.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
</div>
<div class="card" style="max-width:700px">
    <div class="card-body">
        <form action="{{ isset($scholarship) ? route('admin.scholarships.update', $scholarship) : route('admin.scholarships.store') }}" method="POST">
            @csrf @if(isset($scholarship)) @method('PUT') @endif
            @if($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif
            <div class="form-group"><label class="form-label">Nama Beasiswa <span class="text-danger">*</span></label><input type="text" name="name" class="form-control" value="{{ old('name', $scholarship->name ?? '') }}" required></div>
            <div class="form-group"><label class="form-label">Penyelenggara <span class="text-danger">*</span></label><input type="text" name="provider" class="form-control" value="{{ old('provider', $scholarship->provider ?? '') }}" required></div>
            <div class="form-group"><label class="form-label">Deskripsi</label><textarea name="description" class="form-control" rows="3">{{ old('description', $scholarship->description ?? '') }}</textarea></div>
            <div class="form-group"><label class="form-label">Syarat & Ketentuan</label><textarea name="requirements" class="form-control" rows="4">{{ old('requirements', $scholarship->requirements ?? '') }}</textarea></div>
            <div class="row">
                <div class="col-md-6"><div class="form-group"><label class="form-label">Nominal / Nilai Beasiswa</label><input type="text" name="amount" class="form-control" value="{{ old('amount', $scholarship->amount ?? '') }}" placeholder="contoh: Rp 2.000.000/bulan"></div></div>
                <div class="col-md-6"><div class="form-group"><label class="form-label">Batas Pendaftaran</label><input type="date" name="deadline" class="form-control" value="{{ old('deadline', $scholarship->deadline ?? '') }}"></div></div>
            </div>
            <div class="form-group"><label class="form-label">Kontak / Info Lebih Lanjut</label><input type="text" name="contact" class="form-control" value="{{ old('contact', $scholarship->contact ?? '') }}"></div>
            <div class="form-group"><label class="form-label">Link Website</label><input type="url" name="link" class="form-control" value="{{ old('link', $scholarship->link ?? '') }}"></div>
            <div class="form-check mb-3"><input type="checkbox" name="is_active" value="1" {{ old('is_active', $scholarship->is_active ?? true) ? 'checked' : '' }}><label>Beasiswa Aktif</label></div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Simpan</button>
        </form>
    </div>
</div>
@endsection
