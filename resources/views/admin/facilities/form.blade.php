@extends('layouts.admin')
@section('title', 'Form Fasilitas')
@section('page-title', isset($facility) ? 'Edit Fasilitas' : 'Tambah Fasilitas')
@section('breadcrumb', 'Fasilitas Kampus')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div></div>
    <a href="{{ route('admin.facilities.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
</div>
<div class="card" style="max-width:600px">
    <div class="card-body">
        <form action="{{ isset($facility) ? route('admin.facilities.update', $facility) : route('admin.facilities.store') }}" method="POST" enctype="multipart/form-data">
            @csrf @if(isset($facility)) @method('PUT') @endif
            <div class="form-group"><label class="form-label">Nama Fasilitas <span class="text-danger">*</span></label><input type="text" name="name" class="form-control" value="{{ old('name', $facility->name ?? '') }}" required></div>
            <div class="form-group"><label class="form-label">Deskripsi</label><textarea name="description" class="form-control" rows="3">{{ old('description', $facility->description ?? '') }}</textarea></div>
            <div class="form-group"><label class="form-label">Icon (Font Awesome class)</label><input type="text" name="icon" class="form-control" value="{{ old('icon', $facility->icon ?? '') }}" placeholder="fas fa-building"></div>
            <div class="form-group"><label class="form-label">Gambar</label>
                @if(isset($facility) && $facility->image)<div class="mb-2"><img src="{{ Storage::disk('public')->url($facility->image) }}" style="max-height:100px;border-radius:6px"></div>@endif
                <input type="file" name="image" class="form-control" accept="image/*"></div>
            <div class="form-group"><label class="form-label">Urutan</label><input type="number" name="order" class="form-control" value="{{ old('order', $facility->order ?? 0) }}"></div>
            <div class="form-check mb-3"><input type="checkbox" name="is_published" value="1" {{ old('is_published', $facility->is_published ?? true) ? 'checked' : '' }}><label>Tampilkan di Website</label></div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Simpan</button>
        </form>
    </div>
</div>
@endsection
