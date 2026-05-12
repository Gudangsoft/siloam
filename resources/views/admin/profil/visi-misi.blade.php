@extends('layouts.admin')
@section('title', 'Edit Visi & Misi')
@section('page-title', 'Visi & Misi')
@section('breadcrumb', 'Profil Kampus › Visi & Misi')

@push('styles')
<style>
    .field-card { background:#fff; border:1.5px solid #e2e8f0; border-radius:14px; padding:24px; margin-bottom:20px; }
    .field-label { font-size:13px; font-weight:700; color:#374151; margin-bottom:8px; display:flex; align-items:center; gap:8px; }
    .field-label .badge { background:#eff6ff; color:#1e40af; font-size:11px; padding:2px 10px; border-radius:20px; font-weight:600; }
    .misi-item { display:flex; gap:12px; align-items:flex-start; }
    .misi-num { flex-shrink:0; width:36px; height:36px; border-radius:10px; display:flex; align-items:center; justify-content:center; font-weight:800; font-size:14px; color:#fff; }
    .preview-box { background:#f8fafc; border:1px solid #e2e8f0; border-radius:10px; padding:16px; font-size:13px; color:#475569; line-height:1.6; min-height:48px; }
</style>
@endpush

@section('content')
<div style="max-width:800px">

    {{-- Header --}}
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px">
        <div>
            <h2 style="font-size:22px;font-weight:800;color:#0f172a;margin:0">Edit Visi &amp; Misi</h2>
            <p style="color:#64748b;font-size:13px;margin-top:4px">Ubah teks Visi dan 4 item Misi STT Siloam Medan</p>
        </div>
        <a href="{{ route('profil.visi-misi') }}" target="_blank"
           class="btn btn-secondary btn-sm">
            <i class="fas fa-external-link-alt"></i> Lihat Halaman
        </a>
    </div>

    <form action="{{ route('admin.profil.visi-misi.update') }}" method="POST">
        @csrf @method('PUT')

        {{-- VISI --}}
        <div class="field-card">
            <div class="field-label">
                <i class="fas fa-eye" style="color:#1e40af"></i>
                VISI
                <span class="badge">1 kalimat</span>
            </div>
            <textarea name="visi" rows="3"
                      class="form-control @error('visi') is-invalid @enderror"
                      placeholder="Masukkan teks Visi...">{{ old('visi', $visi) }}</textarea>
            @error('visi')
            <div style="color:#dc2626;font-size:12px;margin-top:6px"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
            @enderror
            <p class="form-hint">Kalimat utama visi STT Siloam Medan.</p>
        </div>

        {{-- MISI --}}
        <div class="field-card">
            <div class="field-label" style="margin-bottom:16px">
                <i class="fas fa-bullseye" style="color:#4338ca"></i>
                MISI
                <span class="badge" style="background:#eef2ff;color:#4338ca">4 item</span>
            </div>

            @php
            $misiColors = ['#1e40af','#4338ca','#6d28d9','#7c3aed'];
            @endphp

            @foreach($misi as $idx => $item)
            <div class="misi-item" style="margin-bottom:{{ $idx < 3 ? '16px' : '0' }}">
                <div class="misi-num" style="background:{{ $misiColors[$idx] }}">{{ $idx + 1 }}</div>
                <div style="flex:1">
                    <textarea name="misi[{{ $idx }}]" rows="2"
                              class="form-control @error('misi.'.$idx) is-invalid @enderror"
                              placeholder="Misi {{ $idx + 1 }}...">{{ old('misi.'.$idx, $item) }}</textarea>
                    @error('misi.'.$idx)
                    <div style="color:#dc2626;font-size:12px;margin-top:4px">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            @endforeach
        </div>

        {{-- Actions --}}
        <div style="display:flex;gap:12px;align-items:center">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Simpan Perubahan
            </button>
            <a href="{{ route('profil.visi-misi') }}" target="_blank" class="btn btn-secondary">
                <i class="fas fa-eye"></i> Preview
            </a>
        </div>
    </form>
</div>
@endsection
