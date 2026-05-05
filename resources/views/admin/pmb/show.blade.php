@extends('layouts.admin')
@section('title', 'Detail PMB - ' . $pmb->full_name)
@section('page-title', 'Detail Pendaftaran PMB')
@section('breadcrumb', 'PMB & Mahasiswa')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div></div>
    <a href="{{ route('admin.pmb.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
</div>
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><h4>Data Pribadi Pendaftar</h4></div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-4">No. Registrasi</dt><dd class="col-sm-8"><code>{{ $pmb->registration_number }}</code></dd>
                    <dt class="col-sm-4">Nama Lengkap</dt><dd class="col-sm-8">{{ $pmb->full_name }}</dd>
                    <dt class="col-sm-4">Email</dt><dd class="col-sm-8">{{ $pmb->email }}</dd>
                    <dt class="col-sm-4">Telepon</dt><dd class="col-sm-8">{{ $pmb->phone }}</dd>
                    <dt class="col-sm-4">Jenis Kelamin</dt><dd class="col-sm-8">{{ $pmb->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</dd>
                    <dt class="col-sm-4">Tempat, Tgl Lahir</dt><dd class="col-sm-8">{{ $pmb->birth_place }}, {{ $pmb->birth_date->format('d/m/Y') }}</dd>
                    <dt class="col-sm-4">Alamat</dt><dd class="col-sm-8">{{ $pmb->address }}, {{ $pmb->city }}, {{ $pmb->province }}</dd>
                    <dt class="col-sm-4">Asal Sekolah</dt><dd class="col-sm-8">{{ $pmb->high_school_name }} ({{ $pmb->graduation_year }})</dd>
                    <dt class="col-sm-4">Program Studi</dt><dd class="col-sm-8"><strong>{{ $pmb->study_program }}</strong></dd>
                    <dt class="col-sm-4">Jalur Pendaftaran</dt><dd class="col-sm-8">{{ $pmb->registration_path ?? '-' }}</dd>
                    <dt class="col-sm-4">Nama Orang Tua</dt><dd class="col-sm-8">{{ $pmb->parent_name }}</dd>
                    <dt class="col-sm-4">Telp Orang Tua</dt><dd class="col-sm-8">{{ $pmb->parent_phone }}</dd>
                </dl>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        @if($pmb->photo)
        <div class="card mb-3">
            <div class="card-header"><h4>Foto Pendaftar</h4></div>
            <div class="card-body text-center">
                <img src="{{ Storage::disk('public')->url($pmb->photo) }}" style="max-width:200px;border-radius:8px">
            </div>
        </div>
        @endif
        <div class="card">
            <div class="card-header"><h4>Status & Keputusan</h4></div>
            <div class="card-body">
                <p class="mb-3">Status saat ini: <span class="badge-status badge-{{ $pmb->status === 'accepted' ? 'success' : ($pmb->status === 'rejected' ? 'danger' : ($pmb->status === 'review' ? 'info' : 'warning')) }}">{{ $pmb->status_badge }}</span></p>
                <form action="{{ route('admin.pmb.update-status', $pmb) }}" method="POST">
                    @csrf
                    <div class="form-group"><label class="form-label">Ubah Status</label>
                        <select name="status" class="form-control">
                            <option value="pending" {{ $pmb->status == 'pending' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                            <option value="review" {{ $pmb->status == 'review' ? 'selected' : '' }}>Sedang Ditinjau</option>
                            <option value="accepted" {{ $pmb->status == 'accepted' ? 'selected' : '' }}>Diterima</option>
                            <option value="rejected" {{ $pmb->status == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>
                    <div class="form-group"><label class="form-label">Catatan</label>
                        <textarea name="notes" class="form-control" rows="3">{{ $pmb->notes }}</textarea></div>
                    <button type="submit" class="btn btn-primary" style="width:100%"><i class="fas fa-save me-1"></i> Perbarui Status</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
