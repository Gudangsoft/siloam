@extends('layouts.admin')
@section('title', isset($gallery) ? 'Edit Foto' : 'Upload Foto')
@section('page-title', isset($gallery) ? 'Edit Foto Galeri' : 'Upload Foto Baru')
@section('breadcrumb', 'Galeri Foto')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <p class="text-muted mb-0" style="font-size:13px">
        {{ isset($gallery) ? 'Ubah detail foto yang sudah diupload.' : 'Upload satu foto dengan detail lengkap.' }}
    </p>
    <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary btn-sm">
        <i class="fas fa-arrow-left me-1"></i> Kembali ke Galeri
    </a>
</div>

@if($errors->any())
<div class="alert alert-danger mb-4">
    <i class="fas fa-exclamation-triangle me-2"></i>
    @foreach($errors->all() as $e) {{ $e }}<br> @endforeach
</div>
@endif

<form action="{{ isset($gallery) ? route('admin.gallery.update', $gallery) : route('admin.gallery.store') }}"
      method="POST" enctype="multipart/form-data" id="galleryForm">
    @csrf
    @if(isset($gallery)) @method('PUT') @endif

    <div class="row g-4">

        {{-- ── KIRI: Form ──────────────────────────── --}}
        <div class="col-lg-7">

            {{-- Upload Photo --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h4><i class="fas fa-image me-2" style="color:var(--primary)"></i>
                        {{ isset($gallery) ? 'Ganti Foto' : 'Pilih Foto' }}
                    </h4>
                </div>
                <div class="card-body">
                    {{-- Drop zone --}}
                    <div id="dropZone"
                         style="border:2px dashed var(--border);border-radius:14px;padding:32px 20px;text-align:center;cursor:pointer;transition:all .25s;background:#fafafa;position:relative"
                         ondragover="event.preventDefault();this.style.borderColor='var(--primary)';this.style.background='#eff6ff'"
                         ondragleave="this.style.borderColor='var(--border)';this.style.background='#fafafa'"
                         ondrop="handleDrop(event)"
                         onclick="document.getElementById('imageInput').click()">

                        {{-- Existing image --}}
                        @if(isset($gallery) && $gallery->image)
                        <img id="previewImg"
                             src="{{ $gallery->image_url }}"
                             style="max-height:220px;max-width:100%;border-radius:10px;margin-bottom:12px;display:block;margin-left:auto;margin-right:auto;box-shadow:0 4px 12px rgba(0,0,0,.1)">
                        <div style="font-size:12px;color:#94a3b8">
                            <i class="fas fa-edit me-1"></i>Klik atau drag foto baru untuk mengganti
                        </div>
                        @else
                        <div id="dropPlaceholder">
                            <i class="fas fa-cloud-upload-alt fa-3x mb-3 d-block" style="color:#cbd5e1"></i>
                            <div style="font-size:15px;font-weight:600;color:#64748b">Drag & drop foto ke sini</div>
                            <div style="font-size:13px;color:#94a3b8;margin-top:4px">atau klik untuk memilih</div>
                        </div>
                        <img id="previewImg" src="" alt=""
                             style="display:none;max-height:220px;max-width:100%;border-radius:10px;box-shadow:0 4px 12px rgba(0,0,0,.1);margin:0 auto">
                        @endif
                    </div>
                    <input type="file" id="imageInput" name="image" accept="image/*" style="display:none"
                           onchange="previewImage(this)"
                           @if(!isset($gallery)) required @endif>
                    <div class="form-hint mt-2">
                        <i class="fas fa-info-circle me-1"></i>
                        Format JPG, PNG, atau WebP. Ukuran maks. 5MB.
                    </div>
                </div>
            </div>

            {{-- Detail --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h4><i class="fas fa-tag me-2" style="color:var(--primary)"></i>Detail Foto</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label fw-bold">Judul Foto <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                               value="{{ old('title', $gallery->title ?? '') }}"
                               placeholder="Contoh: Wisuda Angkatan 2024"
                               oninput="updatePreview()" required>
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label fw-bold">Kategori</label>
                        <div class="input-group">
                            <select id="categorySelect" class="form-select"
                                    onchange="syncCategory(this.value)">
                                @php
                                $cats = ['umum','kampus','kegiatan','wisuda','ibadah','prestasi','seminar'];
                                $current = old('category', $gallery->category ?? 'umum');
                                @endphp
                                @foreach($cats as $cat)
                                <option value="{{ $cat }}" {{ $current === $cat ? 'selected' : '' }}>
                                    {{ ucfirst($cat) }}
                                </option>
                                @endforeach
                                <option value="_custom" {{ !in_array($current, $cats) ? 'selected' : '' }}>
                                    + Kategori lain...
                                </option>
                            </select>
                            <input type="text" name="category" id="categoryInput"
                                   class="form-control"
                                   value="{{ $current }}"
                                   placeholder="Ketik kategori..."
                                   style="{{ in_array($current, $cats) ? 'max-width:0;padding:0;border:0;overflow:hidden' : '' }}">
                        </div>
                        <div class="form-hint">Kategori digunakan untuk filter di halaman galeri.</div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Deskripsi <span style="color:#94a3b8;font-size:12px">(opsional)</span></label>
                        <textarea name="description" class="form-control" rows="3"
                                  placeholder="Deskripsi singkat tentang foto ini...">{{ old('description', $gallery->description ?? '') }}</textarea>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Urutan</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-sort-numeric-down"></i></span>
                                <input type="number" name="order" class="form-control"
                                       value="{{ old('order', $gallery->order ?? 0) }}" min="0">
                            </div>
                            <div class="form-hint">Angka kecil = muncul duluan</div>
                        </div>
                        <div class="col-md-8 d-flex align-items-end pb-1">
                            <div class="form-check form-switch mb-0">
                                <input class="form-check-input" type="checkbox" name="is_published"
                                       id="is_published" value="1" style="width:42px;height:22px"
                                       onchange="updatePreview()"
                                       {{ old('is_published', $gallery->is_published ?? true) ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold" for="is_published">
                                    Tampilkan di Website
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- ── KANAN: Preview ──────────────────────── --}}
        <div class="col-lg-5">
            <div style="position:sticky;top:80px">

                {{-- Preview card --}}
                <div class="card mb-4">
                    <div class="card-header">
                        <h4><i class="fas fa-eye me-2" style="color:var(--primary)"></i>Preview Kartu</h4>
                    </div>
                    <div class="card-body p-0">
                        <div style="background:#f8fafc;padding:16px">
                            <div style="border-radius:12px;overflow:hidden;background:white;box-shadow:0 4px 12px rgba(0,0,0,.08)">
                                <div style="height:160px;background:#e2e8f0;overflow:hidden;position:relative">
                                    <img id="previewCardImg" src="{{ isset($gallery) ? $gallery->image_url : '' }}"
                                         style="width:100%;height:100%;object-fit:cover;{{ !isset($gallery) ? 'display:none' : '' }}">
                                    <div id="previewCardPlaceholder"
                                         style="{{ isset($gallery) ? 'display:none' : '' }}width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:#94a3b8;flex-direction:column;gap:6px">
                                        <i class="fas fa-image" style="font-size:32px"></i>
                                        <span style="font-size:12px">Foto belum dipilih</span>
                                    </div>
                                </div>
                                <div style="padding:12px 14px">
                                    <div style="font-size:13px;font-weight:600;color:#1e3a8a;margin-bottom:4px" id="previewTitle">
                                        {{ isset($gallery) ? $gallery->title : 'Judul Foto' }}
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <span id="previewCat"
                                              style="background:#eff6ff;color:#2563eb;border-radius:20px;padding:2px 10px;font-size:10px;font-weight:600">
                                            {{ $current }}
                                        </span>
                                        <span id="previewStatus"
                                              style="font-size:10px;font-weight:600;color:{{ old('is_published', $gallery->is_published ?? true) ? '#16a34a' : '#94a3b8' }}">
                                            <i class="fas {{ old('is_published', $gallery->is_published ?? true) ? 'fa-eye' : 'fa-eye-slash' }}"></i>
                                            {{ old('is_published', $gallery->is_published ?? true) ? 'Ditampilkan' : 'Disembunyikan' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tips --}}
                <div class="card" style="border:1px solid #bfdbfe;background:#eff6ff">
                    <div class="card-body" style="padding:14px 16px">
                        <div style="font-size:13px;font-weight:700;color:var(--primary);margin-bottom:8px">
                            <i class="fas fa-lightbulb me-1"></i> Tips Foto Galeri
                        </div>
                        <ul style="font-size:12px;color:#374151;padding-left:16px;margin:0;line-height:1.9">
                            <li>Gunakan rasio <strong>4:3</strong> atau <strong>16:9</strong> agar rapi</li>
                            <li>Resolusi minimal <strong>800×600 px</strong></li>
                            <li>Nama file sebaiknya deskriptif (hindari "IMG_001.jpg")</li>
                            <li>Untuk upload banyak foto sekaligus, gunakan fitur <strong>Upload Massal</strong> di halaman galeri</li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>

    </div>

    {{-- Sticky save bar --}}
    <div style="position:sticky;bottom:0;background:white;padding:14px 0;border-top:1px solid var(--border);margin-top:8px;z-index:10">
        <div class="d-flex gap-2 align-items-center">
            <button type="submit" class="btn btn-primary btn-lg">
                <i class="fas fa-save me-2"></i>{{ isset($gallery) ? 'Simpan Perubahan' : 'Upload Foto' }}
            </button>
            <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary btn-lg">Batal</a>
            @if(isset($gallery))
            <form action="{{ route('admin.gallery.destroy', $gallery) }}" method="POST" class="ms-auto"
                  onsubmit="return confirm('Hapus foto ini secara permanen?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger btn-lg">
                    <i class="fas fa-trash me-1"></i> Hapus
                </button>
            </form>
            @endif
        </div>
    </div>

</form>
@endsection

@push('scripts')
<script>
function handleDrop(e) {
    e.preventDefault();
    document.getElementById('dropZone').style.borderColor = 'var(--border)';
    document.getElementById('dropZone').style.background = '#fafafa';
    const file = e.dataTransfer.files[0];
    if (file && file.type.startsWith('image/')) {
        const dt = new DataTransfer();
        dt.items.add(file);
        document.getElementById('imageInput').files = dt.files;
        previewImage(document.getElementById('imageInput'));
    }
}

function previewImage(input) {
    if (!input.files || !input.files[0]) return;
    const reader = new FileReader();
    reader.onload = e => {
        const img  = document.getElementById('previewImg');
        const cImg = document.getElementById('previewCardImg');
        const cPh  = document.getElementById('previewCardPlaceholder');
        const ph   = document.getElementById('dropPlaceholder');
        img.src = e.target.result;
        img.style.display = 'block';
        if (ph) ph.style.display = 'none';
        if (cImg) { cImg.src = e.target.result; cImg.style.display = 'block'; }
        if (cPh)  cPh.style.display = 'none';
    };
    reader.readAsDataURL(input.files[0]);
}

function syncCategory(val) {
    const inp = document.getElementById('categoryInput');
    if (val === '_custom') {
        inp.style.maxWidth = '';
        inp.style.padding  = '';
        inp.style.border   = '';
        inp.style.overflow = '';
        inp.value = '';
        inp.focus();
        document.getElementById('previewCat').textContent = '';
    } else {
        inp.style.maxWidth  = '0';
        inp.style.padding   = '0';
        inp.style.border    = '0';
        inp.style.overflow  = 'hidden';
        inp.value = val;
        document.getElementById('previewCat').textContent = val;
    }
}

function updatePreview() {
    const title  = document.getElementById('galleryForm').querySelector('[name="title"]').value;
    const active = document.getElementById('is_published').checked;
    document.getElementById('previewTitle').textContent = title || 'Judul Foto';
    const ps = document.getElementById('previewStatus');
    ps.innerHTML = `<i class="fas ${active ? 'fa-eye' : 'fa-eye-slash'}"></i> ${active ? 'Ditampilkan' : 'Disembunyikan'}`;
    ps.style.color = active ? '#16a34a' : '#94a3b8';
}
</script>
@endpush
