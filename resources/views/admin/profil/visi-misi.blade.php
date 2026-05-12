@extends('layouts.admin')
@section('title', 'Edit Visi, Misi & Tujuan')
@section('page-title', 'Visi, Misi & Tujuan')
@section('breadcrumb', 'Profil Kampus › Visi, Misi & Tujuan')

@push('styles')
<style>
    .field-card { background:#fff; border:1.5px solid #e2e8f0; border-radius:14px; padding:24px; margin-bottom:20px; }
    .section-title { font-size:13px; font-weight:700; color:#374151; display:flex; align-items:center; gap:8px; margin-bottom:16px; }
    .section-badge { font-size:11px; padding:2px 10px; border-radius:20px; font-weight:600; }
    .item-row { display:flex; gap:12px; align-items:flex-start; margin-bottom:14px; }
    .item-row:last-child { margin-bottom:0; }
    .item-num { flex-shrink:0; width:36px; height:36px; border-radius:10px; display:flex; align-items:center; justify-content:center; font-weight:800; font-size:14px; color:#fff; }
</style>
@endpush

@section('content')
<div style="max-width:820px">

    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px">
        <div>
            <h2 style="font-size:22px;font-weight:800;color:#0f172a;margin:0">Edit Visi, Misi &amp; Tujuan</h2>
            <p style="color:#64748b;font-size:13px;margin-top:4px">Halaman <strong>/profil/visi-misi</strong></p>
        </div>
        <a href="{{ route('profil.visi-misi') }}" target="_blank" class="btn btn-secondary btn-sm">
            <i class="fas fa-external-link-alt"></i> Lihat Halaman
        </a>
    </div>

    <form action="{{ route('admin.profil.visi-misi.update') }}" method="POST">
        @csrf @method('PUT')

        {{-- VISI --}}
        <div class="field-card">
            <div class="section-title">
                <i class="fas fa-eye" style="color:#1e40af"></i> VISI
                <span class="section-badge" style="background:#eff6ff;color:#1e40af">1 kalimat</span>
            </div>
            <textarea name="visi" rows="3"
                      class="form-control @error('visi') is-invalid @enderror"
                      placeholder="Masukkan teks Visi...">{{ old('visi', $visi) }}</textarea>
            @error('visi')<div style="color:#dc2626;font-size:12px;margin-top:6px"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>@enderror
        </div>

        {{-- MISI --}}
        <div class="field-card">
            <div class="section-title">
                <i class="fas fa-bullseye" style="color:#4338ca"></i> MISI
                <span class="section-badge" style="background:#eef2ff;color:#4338ca">4 item</span>
            </div>
            @php $misiColors = ['#1e40af','#4338ca','#6d28d9','#7c3aed']; @endphp
            @foreach($misi as $idx => $item)
            <div class="item-row">
                <div class="item-num" style="background:{{ $misiColors[$idx] }}">{{ $idx+1 }}</div>
                <div style="flex:1">
                    <textarea name="misi[{{ $idx }}]" rows="2"
                              class="form-control @error('misi.'.$idx) is-invalid @enderror"
                              placeholder="Misi {{ $idx+1 }}...">{{ old('misi.'.$idx, $item) }}</textarea>
                    @error('misi.'.$idx)<div style="color:#dc2626;font-size:12px;margin-top:4px">{{ $message }}</div>@enderror
                </div>
            </div>
            @endforeach
        </div>

        {{-- TUJUAN --}}
        <div class="field-card">
            <div class="section-title">
                <i class="fas fa-flag-checkered" style="color:#065f46"></i> TUJUAN
                <span class="section-badge" style="background:#ecfdf5;color:#065f46">5 item</span>
            </div>
            @php $tujuanColors = ['#065f46','#047857','#059669','#10b981','#34d399']; @endphp
            @foreach($tujuan as $idx => $item)
            <div class="item-row">
                <div class="item-num" style="background:{{ $tujuanColors[$idx] }}">{{ $idx+1 }}</div>
                <div style="flex:1">
                    <textarea name="tujuan[{{ $idx }}]" rows="2"
                              class="form-control @error('tujuan.'.$idx) is-invalid @enderror"
                              placeholder="Tujuan {{ $idx+1 }}...">{{ old('tujuan.'.$idx, $item) }}</textarea>
                    @error('tujuan.'.$idx)<div style="color:#dc2626;font-size:12px;margin-top:4px">{{ $message }}</div>@enderror
                </div>
            </div>
            @endforeach
        </div>

        <div style="display:flex;gap:12px">
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
