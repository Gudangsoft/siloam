@extends('layouts.admin')
@section('title', 'Detail Pesan')
@section('page-title', 'Detail Pesan')
@section('breadcrumb', 'Pesan Masuk')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div></div>
    <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
</div>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header" style="background:var(--primary);color:white">
                <h4 style="color:white;margin:0">{{ $contact->subject }}</h4>
            </div>
            <div class="card-body">
                <dl class="row mb-4">
                    <dt class="col-sm-3">Pengirim</dt><dd class="col-sm-9"><strong>{{ $contact->name }}</strong></dd>
                    <dt class="col-sm-3">Email</dt><dd class="col-sm-9"><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></dd>
                    <dt class="col-sm-3">Telepon</dt><dd class="col-sm-9">{{ $contact->phone ?? '-' }}</dd>
                    <dt class="col-sm-3">Tanggal</dt><dd class="col-sm-9">{{ $contact->created_at->format('d F Y, H:i') }}</dd>
                </dl>
                <div style="border:1px solid var(--border);border-radius:8px;padding:20px;background:#f8fafc">
                    <div style="font-size:12px;color:#94a3b8;margin-bottom:10px;text-transform:uppercase;font-weight:600">Pesan:</div>
                    <p style="white-space:pre-wrap;margin:0">{{ $contact->message }}</p>
                </div>
            </div>
            <div style="padding:16px 24px;border-top:1px solid var(--border);display:flex;gap:10px">
                <a href="mailto:{{ $contact->email }}?subject=Re: {{ $contact->subject }}" class="btn btn-primary">
                    <i class="fas fa-reply me-1"></i> Balas via Email
                </a>
                <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash me-1"></i> Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
