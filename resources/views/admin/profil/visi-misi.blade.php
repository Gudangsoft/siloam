@extends('layouts.admin')
@section('title', 'Edit Visi, Misi & Tujuan')
@section('page-title', 'Visi, Misi & Tujuan')
@section('breadcrumb', 'Profil Kampus › Visi, Misi & Tujuan')

@push('styles')
<style>
    .field-card { background:#fff; border:1.5px solid #e2e8f0; border-radius:14px; padding:24px; margin-bottom:20px; }
    .section-title { font-size:13px; font-weight:700; color:#374151; display:flex; align-items:center; gap:8px; margin-bottom:16px; }
    .section-badge { font-size:11px; padding:2px 10px; border-radius:20px; font-weight:600; }
    .item-row { display:flex; gap:10px; align-items:flex-start; margin-bottom:10px; }
    .item-num {
        flex-shrink:0; width:34px; height:34px; border-radius:9px;
        display:flex; align-items:center; justify-content:center;
        font-weight:800; font-size:13px; color:#fff;
        margin-top:6px;
    }
    .btn-remove {
        flex-shrink:0; width:34px; height:34px; border-radius:9px;
        display:flex; align-items:center; justify-content:center;
        background:#fee2e2; color:#dc2626; border:none; cursor:pointer;
        font-size:14px; margin-top:6px; transition:background .15s;
    }
    .btn-remove:hover { background:#fecaca; }
    .btn-add-item {
        display:inline-flex; align-items:center; gap:6px;
        padding:8px 16px; border-radius:8px; border:1.5px dashed;
        font-size:13px; font-weight:600; cursor:pointer;
        background:transparent; transition:all .15s; margin-top:4px;
    }
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

    <form action="{{ route('admin.profil.visi-misi.update') }}" method="POST" id="vmForm">
        @csrf @method('PUT')

        {{-- ── VISI ── --}}
        <div class="field-card">
            <div class="section-title">
                <i class="fas fa-eye" style="color:#1e40af"></i>
                VISI
                <span class="section-badge" style="background:#eff6ff;color:#1e40af">1 kalimat</span>
            </div>
            <textarea name="visi" rows="3"
                      class="form-control @error('visi') is-invalid @enderror"
                      placeholder="Masukkan teks Visi...">{{ old('visi', $visi) }}</textarea>
            @error('visi')<div style="color:#dc2626;font-size:12px;margin-top:6px"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>@enderror
        </div>

        {{-- ── MISI ── --}}
        <div class="field-card">
            <div class="section-title">
                <i class="fas fa-bullseye" style="color:#4338ca"></i>
                MISI
                <span class="section-badge" style="background:#eef2ff;color:#4338ca" id="misiCount">{{ count($misi) }} item</span>
            </div>

            <div id="misiList">
                @foreach($misi as $idx => $item)
                <div class="item-row" data-row>
                    <div class="item-num" style="background:#4338ca">{{ $idx + 1 }}</div>
                    <textarea name="misi[]" rows="2" class="form-control"
                              placeholder="Misi {{ $idx + 1 }}...">{{ old('misi.'.$idx, $item) }}</textarea>
                    <button type="button" class="btn-remove" onclick="removeRow(this,'misi')" title="Hapus">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                @endforeach
            </div>
            @error('misi')<div style="color:#dc2626;font-size:12px;margin-bottom:8px">{{ $message }}</div>@enderror

            <button type="button" class="btn-add-item"
                    style="border-color:#4338ca;color:#4338ca"
                    onclick="addRow('misi')">
                <i class="fas fa-plus"></i> Tambah Misi
            </button>
        </div>

        {{-- ── TUJUAN ── --}}
        <div class="field-card">
            <div class="section-title">
                <i class="fas fa-flag-checkered" style="color:#065f46"></i>
                TUJUAN
                <span class="section-badge" style="background:#ecfdf5;color:#065f46" id="tujuanCount">{{ count($tujuan) }} item</span>
            </div>

            <div id="tujuanList">
                @foreach($tujuan as $idx => $item)
                <div class="item-row" data-row>
                    <div class="item-num" style="background:#059669">{{ $idx + 1 }}</div>
                    <textarea name="tujuan[]" rows="2" class="form-control"
                              placeholder="Tujuan {{ $idx + 1 }}...">{{ old('tujuan.'.$idx, $item) }}</textarea>
                    <button type="button" class="btn-remove" onclick="removeRow(this,'tujuan')" title="Hapus">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                @endforeach
            </div>
            @error('tujuan')<div style="color:#dc2626;font-size:12px;margin-bottom:8px">{{ $message }}</div>@enderror

            <button type="button" class="btn-add-item"
                    style="border-color:#059669;color:#059669"
                    onclick="addRow('tujuan')">
                <i class="fas fa-plus"></i> Tambah Tujuan
            </button>
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

@push('scripts')
<script>
const colors = { misi: '#4338ca', tujuan: '#059669' };

function renumber(type) {
    const list  = document.getElementById(type + 'List');
    const rows  = list.querySelectorAll('[data-row]');
    const badge = document.getElementById(type + 'Count');
    rows.forEach((row, i) => {
        row.querySelector('.item-num').textContent = i + 1;
        row.querySelector('textarea').placeholder  = (type === 'misi' ? 'Misi ' : 'Tujuan ') + (i + 1) + '...';
    });
    badge.textContent = rows.length + ' item';
}

function addRow(type) {
    const list  = document.getElementById(type + 'List');
    const count = list.querySelectorAll('[data-row]').length + 1;
    const color = colors[type];
    const label = type === 'misi' ? 'Misi' : 'Tujuan';

    const div = document.createElement('div');
    div.className = 'item-row';
    div.setAttribute('data-row', '');
    div.innerHTML = `
        <div class="item-num" style="background:${color}">${count}</div>
        <textarea name="${type}[]" rows="2" class="form-control" placeholder="${label} ${count}..."></textarea>
        <button type="button" class="btn-remove" onclick="removeRow(this,'${type}')" title="Hapus">
            <i class="fas fa-times"></i>
        </button>`;
    list.appendChild(div);
    div.querySelector('textarea').focus();
    renumber(type);
}

function removeRow(btn, type) {
    const list = document.getElementById(type + 'List');
    if (list.querySelectorAll('[data-row]').length <= 1) {
        alert('Minimal harus ada 1 item.');
        return;
    }
    btn.closest('[data-row]').remove();
    renumber(type);
}
</script>
@endpush
