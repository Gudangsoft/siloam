@extends('layouts.admin')
@section('title', isset($staff) ? 'Edit Staf' : 'Tambah Staf')
@section('page-title', isset($staff) ? 'Edit Dosen/Staf' : 'Tambah Dosen/Staf')
@section('breadcrumb', 'Profil Kampus')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div></div>
    <a href="{{ route('admin.staff.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
</div>
@if($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif
<div class="card">
    <div class="card-body">
        <form action="{{ isset($staff) ? route('admin.staff.update', $staff) : route('admin.staff.store') }}" method="POST" enctype="multipart/form-data">
            @csrf @if(isset($staff)) @method('PUT') @endif
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6"><div class="form-group"><label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $staff->name ?? '') }}" required></div></div>
                        <div class="col-md-6"><div class="form-group"><label class="form-label">Jabatan <span class="text-danger">*</span></label>
                            <input type="text" name="position" class="form-control" value="{{ old('position', $staff->position ?? '') }}" required></div></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6"><div class="form-group"><label class="form-label">Kategori <span class="text-danger">*</span></label>
                            <select name="category" class="form-control">
                                <option value="pimpinan" {{ old('category', $staff->category ?? '') == 'pimpinan' ? 'selected' : '' }}>Pimpinan</option>
                                <option value="dosen" {{ old('category', $staff->category ?? '') == 'dosen' ? 'selected' : '' }}>Dosen</option>
                                <option value="tendik" {{ old('category', $staff->category ?? '') == 'tendik' ? 'selected' : '' }}>Tenaga Kependidikan</option>
                            </select></div></div>
                        <div class="col-md-6"><div class="form-group"><label class="form-label">NIDN</label>
                            <input type="text" name="nidn" class="form-control" value="{{ old('nidn', $staff->nidn ?? '') }}"></div></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6"><div class="form-group"><label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $staff->email ?? '') }}"></div></div>
                        <div class="col-md-6"><div class="form-group"><label class="form-label">Telepon</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone', $staff->phone ?? '') }}"></div></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6"><div class="form-group"><label class="form-label">Pendidikan Terakhir</label>
                            <input type="text" name="education" class="form-control" value="{{ old('education', $staff->education ?? '') }}"></div></div>
                        <div class="col-md-6"><div class="form-group"><label class="form-label">Bidang Keahlian</label>
                            <input type="text" name="expertise" class="form-control" value="{{ old('expertise', $staff->expertise ?? '') }}"></div></div>
                    </div>
                    <div class="form-group"><label class="form-label">Biografi</label>
                        <textarea name="bio" class="form-control" rows="4">{{ old('bio', $staff->bio ?? '') }}</textarea></div>
                    <div class="row">
                        <div class="col-md-4"><div class="form-group"><label class="form-label">Urutan Tampil</label>
                            <input type="number" name="order" class="form-control" value="{{ old('order', $staff->order ?? 0) }}"></div></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group"><label class="form-label">Foto</label>
                        @if(isset($staff) && $staff->photo)<div class="mb-2"><img src="{{ Storage::disk('public')->url($staff->photo) }}" style="width:120px;height:120px;object-fit:cover;border-radius:50%;display:block;margin:0 auto"></div>@endif
                        <input type="file" name="photo" class="form-control" accept="image/*">
                        <div class="form-hint">Maks. 2MB. Rasio 1:1</div></div>
                    <div class="form-check mb-3">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $staff->is_active ?? true) ? 'checked' : '' }}>
                        <label>Status Aktif</label>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width:100%"><i class="fas fa-save me-1"></i> Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
