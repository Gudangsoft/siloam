@extends('layouts.admin')
@section('title', 'Form Organisasi Mahasiswa')
@section('page-title', isset($organization) ? 'Edit Organisasi' : 'Tambah Organisasi')
@section('breadcrumb', 'Organisasi Mahasiswa')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div></div>
    <a href="{{ route('admin.student-organizations.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
</div>
<div class="card" style="max-width:700px">
    <div class="card-body">
        <form action="{{ isset($organization) ? route('admin.student-organizations.update', $organization) : route('admin.student-organizations.store') }}" method="POST" enctype="multipart/form-data">
            @csrf @if(isset($organization)) @method('PUT') @endif
            <div class="form-group"><label class="form-label">Nama Organisasi <span class="text-danger">*</span></label><input type="text" name="name" class="form-control" value="{{ old('name', $organization->name ?? '') }}" required></div>
            <div class="row">
                <div class="col-md-4"><div class="form-group"><label class="form-label">Singkatan</label><input type="text" name="abbreviation" class="form-control" value="{{ old('abbreviation', $organization->abbreviation ?? '') }}"></div></div>
                <div class="col-md-4"><div class="form-group"><label class="form-label">Tipe <span class="text-danger">*</span></label><select name="type" class="form-control"><option value="BEM">BEM</option><option value="UKM">UKM</option><option value="HIMA">HIMA</option><option value="lainnya">Lainnya</option></select></div></div>
            </div>
            <div class="form-group"><label class="form-label">Deskripsi</label><textarea name="description" class="form-control" rows="3">{{ old('description', $organization->description ?? '') }}</textarea></div>
            <div class="row">
                <div class="col-md-6"><div class="form-group"><label class="form-label">Ketua</label><input type="text" name="chairman" class="form-control" value="{{ old('chairman', $organization->chairman ?? '') }}"></div></div>
                <div class="col-md-6"><div class="form-group"><label class="form-label">Pembimbing</label><input type="text" name="advisor" class="form-control" value="{{ old('advisor', $organization->advisor ?? '') }}"></div></div>
            </div>
            <div class="form-group"><label class="form-label">Email Organisasi</label><input type="email" name="email" class="form-control" value="{{ old('email', $organization->email ?? '') }}"></div>
            <div class="form-group"><label class="form-label">Logo</label>
                @if(isset($organization) && $organization->logo)<div class="mb-2"><img src="{{ Storage::disk('public')->url($organization->logo) }}" style="height:60px"></div>@endif
                <input type="file" name="logo" class="form-control" accept="image/*"></div>
            <div class="form-check mb-3"><input type="checkbox" name="is_active" value="1" {{ old('is_active', $organization->is_active ?? true) ? 'checked' : '' }}><label>Aktif</label></div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Simpan</button>
        </form>
    </div>
</div>
@endsection
