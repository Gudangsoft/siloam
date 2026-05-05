@extends('layouts.admin')
@section('title', isset($partnership) ? 'Edit Kerjasama' : 'Tambah Kerjasama')
@section('page-title', isset($partnership) ? 'Edit Data Kerjasama' : 'Tambah Data Kerjasama')
@section('breadcrumb', 'Kerjasama / Mitra')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div></div>
    <a href="{{ route('admin.partnerships.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
</div>
<div class="card">
    <div class="card-body">
        <form action="{{ isset($partnership) ? route('admin.partnerships.update', $partnership) : route('admin.partnerships.store') }}" method="POST" enctype="multipart/form-data">
            @csrf @if(isset($partnership)) @method('PUT') @endif
            @if($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group"><label class="form-label">Nama Institusi / Mitra <span class="text-danger">*</span></label><input type="text" name="name" class="form-control" value="{{ old('name', $partnership->name ?? '') }}" required></div>
                    <div class="row">
                        <div class="col-md-4"><div class="form-group"><label class="form-label">Jenis <span class="text-danger">*</span></label><select name="type" class="form-control"><option value="nasional" {{ old('type', $partnership->type ?? '') == 'nasional' ? 'selected' : '' }}>Nasional</option><option value="internasional" {{ old('type', $partnership->type ?? '') == 'internasional' ? 'selected' : '' }}>Internasional</option></select></div></div>
                        <div class="col-md-4"><div class="form-group"><label class="form-label">Kategori</label><input type="text" name="category" class="form-control" value="{{ old('category', $partnership->category ?? '') }}" placeholder="MoU, MoA, Kolaborasi..."></div></div>
                    </div>
                    <div class="form-group"><label class="form-label">Deskripsi Kerjasama</label><textarea name="description" class="form-control" rows="4">{{ old('description', $partnership->description ?? '') }}</textarea></div>
                    <div class="form-group"><label class="form-label">Website Mitra</label><input type="url" name="website" class="form-control" value="{{ old('website', $partnership->website ?? '') }}"></div>
                    <div class="row">
                        <div class="col-md-6"><div class="form-group"><label class="form-label">Tanggal MoU</label><input type="date" name="mou_date" class="form-control" value="{{ old('mou_date', $partnership->mou_date ?? '') }}"></div></div>
                        <div class="col-md-6"><div class="form-group"><label class="form-label">Berakhir MoU</label><input type="date" name="mou_expiry" class="form-control" value="{{ old('mou_expiry', $partnership->mou_expiry ?? '') }}"></div></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group"><label class="form-label">Logo Mitra</label>
                        @if(isset($partnership) && $partnership->logo)<div class="mb-2"><img src="{{ Storage::disk('public')->url($partnership->logo) }}" style="max-height:80px"></div>@endif
                        <input type="file" name="logo" class="form-control" accept="image/*"></div>
                    <div class="form-group"><label class="form-label">Urutan Tampil</label><input type="number" name="order" class="form-control" value="{{ old('order', $partnership->order ?? 0) }}"></div>
                    <div class="form-check mb-3"><input type="checkbox" name="is_active" value="1" {{ old('is_active', $partnership->is_active ?? true) ? 'checked' : '' }}><label>Kerjasama Aktif</label></div>
                    <button type="submit" class="btn btn-primary" style="width:100%"><i class="fas fa-save me-1"></i> Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
