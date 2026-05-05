@extends('layouts.admin')
@section('title', isset($event) ? 'Edit Event' : 'Tambah Event')
@section('page-title', isset($event) ? 'Edit Event' : 'Tambah Event Baru')
@section('breadcrumb', 'Agenda & Kegiatan')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div></div>
    <a href="{{ route('admin.events.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
</div>
@if($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif
<div class="card">
    <div class="card-body">
        <form action="{{ isset($event) ? route('admin.events.update', $event) : route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
            @csrf @if(isset($event)) @method('PUT') @endif
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group"><label class="form-label">Judul Event <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $event->title ?? '') }}" required></div>
                    <div class="form-group"><label class="form-label">Deskripsi</label>
                        <textarea name="description" class="form-control" rows="5">{{ old('description', $event->description ?? '') }}</textarea></div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group"><label class="form-label">Tanggal Mulai <span class="text-danger">*</span></label>
                                <input type="datetime-local" name="start_date" class="form-control" value="{{ old('start_date', isset($event->start_date) ? $event->start_date->format('Y-m-d\TH:i') : '') }}" required></div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group"><label class="form-label">Tanggal Selesai</label>
                                <input type="datetime-local" name="end_date" class="form-control" value="{{ old('end_date', isset($event->end_date) ? $event->end_date->format('Y-m-d\TH:i') : '') }}"></div>
                        </div>
                    </div>
                    <div class="form-group"><label class="form-label">Lokasi</label>
                        <input type="text" name="location" class="form-control" value="{{ old('location', $event->location ?? '') }}"></div>
                    <div class="form-group"><label class="form-label">Penyelenggara</label>
                        <input type="text" name="organizer" class="form-control" value="{{ old('organizer', $event->organizer ?? '') }}"></div>
                </div>
                <div class="col-md-4">
                    <div class="form-group"><label class="form-label">Gambar</label>
                        @if(isset($event) && $event->image)<div class="mb-2"><img src="{{ Storage::disk('public')->url($event->image) }}" style="max-width:100%;border-radius:6px"></div>@endif
                        <input type="file" name="image" class="form-control" accept="image/*">
                        <div class="form-hint">Maks. 2MB</div></div>
                    <div class="form-check mb-3">
                        <input type="checkbox" name="is_published" value="1" {{ old('is_published', $event->is_published ?? true) ? 'checked' : '' }}>
                        <label>Publikasikan</label>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width:100%"><i class="fas fa-save me-1"></i> Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
