@extends('layouts.admin')
@section('title', isset($staff) ? 'Edit Staf: '.$staff->name : 'Tambah Dosen/Staf')
@section('page-title', isset($staff) ? 'Edit Dosen/Staf' : 'Tambah Dosen/Staf')
@section('breadcrumb', 'Profil Kampus')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <p class="text-muted mb-0" style="font-size:13px">
        {{ isset($staff) ? 'Ubah data dosen/staf yang sudah ada.' : 'Tambah data dosen atau staf baru.' }}
    </p>
    <a href="{{ route('admin.staff.index') }}" class="btn btn-secondary btn-sm">
        <i class="fas fa-arrow-left me-1"></i> Kembali
    </a>
</div>

@if($errors->any())
<div class="alert alert-danger mb-4">
    <i class="fas fa-exclamation-triangle me-2"></i>
    @foreach($errors->all() as $e) {{ $e }}<br> @endforeach
</div>
@endif

<form action="{{ isset($staff) ? route('admin.staff.update', $staff) : route('admin.staff.store') }}"
      method="POST" enctype="multipart/form-data" id="staffForm">
    @csrf @if(isset($staff)) @method('PUT') @endif

    <div class="row g-4">

        {{-- ══ KOLOM KIRI ══════════════════════════════════ --}}
        <div class="col-lg-8">

            {{-- ── Data Pribadi ── --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h4><i class="fas fa-user me-2" style="color:var(--primary)"></i>Data Pribadi</h4>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-bold">Nama Lengkap (beserta gelar) <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', $staff->name ?? '') }}"
                                   placeholder="Contoh: RINTO FRANCIUS SIRAIT, S.Pd., M.Th."
                                   required oninput="updatePreview()">
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Tempat Lahir</label>
                            <input type="text" name="birth_place" class="form-control"
                                   value="{{ old('birth_place', $staff->birth_place ?? '') }}"
                                   placeholder="Contoh: N. Lama">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Tanggal Lahir</label>
                            <input type="date" name="birth_date" class="form-control"
                                   value="{{ old('birth_date', isset($staff->birth_date) ? $staff->birth_date->format('Y-m-d') : '') }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Asal Gereja</label>
                            <input type="text" name="church" class="form-control"
                                   value="{{ old('church', $staff->church ?? '') }}"
                                   placeholder="Contoh: GSKI Voice of Truth Medan">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Email</label>
                            <input type="email" name="email" class="form-control"
                                   value="{{ old('email', $staff->email ?? '') }}"
                                   placeholder="nama@domain.com">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Telepon / WhatsApp</label>
                            <input type="text" name="phone" class="form-control"
                                   value="{{ old('phone', $staff->phone ?? '') }}"
                                   placeholder="08xxxxxxxxxx">
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── Jabatan & Kategori ── --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h4><i class="fas fa-id-badge me-2" style="color:var(--primary)"></i>Jabatan & Kategori</h4>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-8">
                            <label class="form-label fw-bold">Jabatan / Posisi <span class="text-danger">*</span></label>
                            <input type="text" name="position" class="form-control @error('position') is-invalid @enderror"
                                   value="{{ old('position', $staff->position ?? '') }}"
                                   placeholder="Contoh: Wakil Ketua Bidang Akademik"
                                   required oninput="updatePreview()">
                            @error('position')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Kategori <span class="text-danger">*</span></label>
                            <select name="category" class="form-select" onchange="updatePreview()">
                                @foreach(['pimpinan'=>'Pimpinan','dosen'=>'Dosen','tendik'=>'Tenaga Kependidikan'] as $val => $lbl)
                                <option value="{{ $val }}"
                                    {{ old('category', $staff->category ?? 'dosen') === $val ? 'selected' : '' }}>
                                    {{ $lbl }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── Nomor Identifikasi ── --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h4><i class="fas fa-fingerprint me-2" style="color:var(--primary)"></i>Nomor Identifikasi</h4>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">NIDN
                                <span class="text-muted" style="font-size:11px;font-weight:400">(Nomor Induk Dosen Nasional)</span>
                            </label>
                            <input type="text" name="nidn" class="form-control"
                                   value="{{ old('nidn', $staff->nidn ?? '') }}"
                                   placeholder="Contoh: 0101018101"
                                   maxlength="20">
                            <div class="form-hint">10 digit — untuk dosen aktif</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">NUPTK
                                <span class="text-muted" style="font-size:11px;font-weight:400">(Nomor Unik Pendidik & Tenaga Kependidikan)</span>
                            </label>
                            <input type="text" name="nuptk" class="form-control"
                                   value="{{ old('nuptk', $staff->nuptk ?? '') }}"
                                   placeholder="Contoh: 3762759660130182"
                                   maxlength="20">
                            <div class="form-hint">16 digit — untuk pendidik & tendik</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── Akademik ── --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h4><i class="fas fa-graduation-cap me-2" style="color:var(--primary)"></i>Informasi Akademik</h4>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Pendidikan Terakhir</label>
                            <input type="text" name="education" class="form-control"
                                   value="{{ old('education', $staff->education ?? '') }}"
                                   placeholder="Contoh: S2 Teologi — Seminari STTII Yogyakarta">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Bidang Keahlian / Spesialisasi</label>
                            <input type="text" name="expertise" class="form-control"
                                   value="{{ old('expertise', $staff->expertise ?? '') }}"
                                   placeholder="Contoh: Perjanjian Lama, Teologi Sistematika">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold">Mata Kuliah yang Diampu</label>
                            <textarea name="courses" class="form-control" rows="3"
                                      placeholder="Contoh: PP PL 1, PP PL 2, Teologi PL 1, Teologi PL 2, Bahasa Ibrani, Tafsir PL, Teologi Agama-Agama, Dogmatika">{{ old('courses', $staff->courses ?? '') }}</textarea>
                            <div class="form-hint">Pisahkan dengan koma. Contoh: Matakuliah 1, Matakuliah 2, Matakuliah 3</div>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold">Biografi / Deskripsi Singkat</label>
                            <textarea name="bio" class="form-control" rows="3"
                                      placeholder="Deskripsi singkat tentang riwayat pelayanan atau pengabdian...">{{ old('bio', $staff->bio ?? '') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- ══ KOLOM KANAN ══════════════════════════════════ --}}
        <div class="col-lg-4">
            <div style="position:sticky;top:80px">

                {{-- Foto --}}
                <div class="card mb-4">
                    <div class="card-header">
                        <h4><i class="fas fa-camera me-2" style="color:var(--primary)"></i>Foto</h4>
                    </div>
                    <div class="card-body text-center">
                        {{-- Preview --}}
                        <div id="photoWrap" style="position:relative;width:140px;height:140px;margin:0 auto 16px">
                            <div class="position-absolute bg-warning rounded"
                                 style="inset:0;transform:translate(6px,6px);border-radius:16px!important;z-index:0"></div>
                            <div class="position-relative rounded overflow-hidden border border-3 border-white shadow"
                                 style="width:140px;height:140px;border-radius:16px;background:#dbeafe;z-index:1;cursor:pointer"
                                 onclick="document.getElementById('photoInput').click()">
                                @if(isset($staff) && $staff->photo)
                                <img id="photoPreview" src="{{ Storage::disk('public')->url($staff->photo) }}"
                                     style="width:100%;height:100%;object-fit:cover">
                                @else
                                <img id="photoPreview" src="" style="width:100%;height:100%;object-fit:cover;display:none">
                                <div id="photoPlaceholder" class="w-100 h-100 d-flex align-items-center justify-content-center flex-column" style="color:#93c5fd">
                                    <i class="fas fa-user-circle fa-4x mb-1"></i>
                                    <small style="font-size:10px">Klik untuk pilih foto</small>
                                </div>
                                @endif
                            </div>
                        </div>

                        <input type="file" id="photoInput" name="photo" accept="image/*"
                               style="display:none" onchange="previewPhoto(this)">
                        <button type="button" class="btn btn-secondary btn-sm mb-2"
                                onclick="document.getElementById('photoInput').click()">
                            <i class="fas fa-upload me-1"></i>
                            {{ isset($staff) && $staff->photo ? 'Ganti Foto' : 'Pilih Foto' }}
                        </button>
                        <div class="form-hint">JPG/PNG/WebP, maks 2MB, rasio 1:1</div>
                    </div>
                </div>

                {{-- Pengaturan --}}
                <div class="card mb-4">
                    <div class="card-header">
                        <h4><i class="fas fa-cog me-2" style="color:var(--primary)"></i>Pengaturan</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-label fw-bold">Urutan Tampil</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-sort-numeric-down"></i></span>
                                <input type="number" name="order" class="form-control"
                                       value="{{ old('order', $staff->order ?? 0) }}" min="0">
                            </div>
                            <div class="form-hint">Angka kecil = tampil lebih dulu</div>
                        </div>
                        <div class="form-check form-switch mt-3" style="padding-left:2.5rem">
                            <input class="form-check-input" type="checkbox" name="is_active"
                                   id="is_active" value="1" style="width:42px;height:22px"
                                   {{ old('is_active', $staff->is_active ?? true) ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold" for="is_active">Tampilkan di Website</label>
                        </div>
                    </div>
                </div>

                {{-- Preview kartu --}}
                <div class="card" style="border:1px solid #bfdbfe;background:#eff6ff">
                    <div class="card-header" style="background:#e0f2fe;border-color:#bae6fd">
                        <h4 style="color:#0369a1"><i class="fas fa-eye me-2"></i>Preview Kartu</h4>
                    </div>
                    <div class="card-body" style="padding:16px">
                        <div style="background:white;border-radius:12px;padding:14px;box-shadow:0 2px 8px rgba(0,0,0,.06);text-align:center">
                            <div style="width:60px;height:60px;border-radius:50%;overflow:hidden;margin:0 auto 8px;background:#dbeafe;border:2px solid white;box-shadow:0 2px 6px rgba(0,0,0,.1)">
                                <img id="previewCardPhoto" src="{{ isset($staff) && $staff->photo ? Storage::disk('public')->url($staff->photo) : '' }}"
                                     style="width:100%;height:100%;object-fit:cover;{{ !isset($staff) || !$staff->photo ? 'display:none' : '' }}">
                                <div id="previewCardIcon" style="{{ isset($staff) && $staff->photo ? 'display:none' : '' }}width:100%;height:100%;display:flex;align-items:center;justify-content:center">
                                    <i class="fas fa-user" style="color:#93c5fd;font-size:24px"></i>
                                </div>
                            </div>
                            <div id="previewName" style="font-weight:700;font-size:13px;color:#1e3a8a;line-height:1.3">
                                {{ $staff->name ?? 'Nama Lengkap' }}
                            </div>
                            <div id="previewPosition" style="font-size:11px;color:#2563eb;margin-top:2px">
                                {{ $staff->position ?? 'Jabatan' }}
                            </div>
                            <span id="previewCategory"
                                  style="display:inline-block;margin-top:4px;font-size:10px;font-weight:600;padding:1px 8px;border-radius:20px;background:#eff6ff;color:#2563eb">
                                {{ ['pimpinan'=>'Pimpinan','dosen'=>'Dosen','tendik'=>'Tendik'][old('category', $staff->category ?? 'dosen')] }}
                            </span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

</form>

{{-- Sticky save bar — di LUAR form utama --}}
<div style="position:sticky;bottom:0;background:white;padding:14px 0;border-top:1px solid var(--border);margin-top:8px;z-index:10">
    <div class="d-flex gap-2 align-items-center">
        <button type="button" class="btn btn-primary btn-lg"
                onclick="document.getElementById('staffForm').submit()">
            <i class="fas fa-save me-2"></i>{{ isset($staff) ? 'Simpan Perubahan' : 'Tambah Staf' }}
        </button>
        <a href="{{ route('admin.staff.index') }}" class="btn btn-secondary btn-lg">Batal</a>
        @if(isset($staff))
        <form action="{{ route('admin.staff.destroy', $staff) }}" method="POST" class="ms-auto"
              onsubmit="return delConfirm(event, this, '{{ addslashes($staff->name) }}')">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-danger btn-lg">
                <i class="fas fa-trash me-1"></i> Hapus
            </button>
        </form>
        @endif
    </div>
</div>

@endsection

@push('scripts')
<script>
function previewPhoto(input) {
    if (!input.files[0]) return;
    const reader = new FileReader();
    reader.onload = e => {
        const prev   = document.getElementById('photoPreview');
        const ph     = document.getElementById('photoPlaceholder');
        const cardPh = document.getElementById('previewCardPhoto');
        const cardIc = document.getElementById('previewCardIcon');
        prev.src = e.target.result;
        prev.style.display = 'block';
        if (ph) ph.style.display = 'none';
        if (cardPh) { cardPh.src = e.target.result; cardPh.style.display = 'block'; }
        if (cardIc) cardIc.style.display = 'none';
    };
    reader.readAsDataURL(input.files[0]);
}

function updatePreview() {
    const name = document.querySelector('[name="name"]').value || 'Nama Lengkap';
    const pos  = document.querySelector('[name="position"]').value || 'Jabatan';
    const cat  = document.querySelector('[name="category"]').value;
    const catMap = { pimpinan:'Pimpinan', dosen:'Dosen', tendik:'Tendik' };

    document.getElementById('previewName').textContent     = name;
    document.getElementById('previewPosition').textContent = pos;
    document.getElementById('previewCategory').textContent = catMap[cat] || cat;
}
</script>
@endpush
