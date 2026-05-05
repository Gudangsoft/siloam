@extends('layouts.admin')
@section('title', 'Tambah Menu')
@section('page-title', 'Tambah Menu Baru')
@section('breadcrumb', 'Menu Dinamis')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <p class="text-muted mb-0" style="font-size:13px">Isi form di bawah lalu klik Simpan.</p>
    </div>
    <a href="{{ route('admin.menus.index') }}" class="btn btn-secondary btn-sm">
        <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar
    </a>
</div>

@if($errors->any())
<div class="alert alert-danger mb-4">
    <i class="fas fa-exclamation-triangle me-2"></i>
    @foreach($errors->all() as $e) {{ $e }}<br> @endforeach
</div>
@endif

<form action="{{ route('admin.menus.store') }}" method="POST" id="menuForm">
@csrf
<div class="row g-4">

    {{-- ══════════ KOLOM KIRI ══════════ --}}
    <div class="col-lg-8">

        {{-- ── STEP 1: Tipe Link ── --}}
        <div class="card mb-4">
            <div class="card-header">
                <h4><span style="background:var(--primary);color:#fff;border-radius:50%;width:24px;height:24px;display:inline-flex;align-items:center;justify-content:center;font-size:12px;margin-right:8px">1</span>Jenis Link Menu</h4>
            </div>
            <div class="card-body">
                <div class="row g-3" id="linkTypeGroup">
                    {{-- Tanpa Link --}}
                    <div class="col-6 col-md-3">
                        <label class="link-type-card w-100" data-type="none">
                            <input type="radio" name="_link_type" value="none" class="d-none" checked>
                            <div class="type-card-inner" style="border:2px solid;border-radius:10px;padding:14px 8px;text-align:center;cursor:pointer;transition:all .2s">
                                <i class="fas fa-folder fa-2x mb-2 d-block"></i>
                                <div style="font-size:13px;font-weight:700">Dropdown</div>
                                <div style="font-size:11px;color:#94a3b8;margin-top:3px">Grup tanpa link</div>
                            </div>
                        </label>
                    </div>
                    {{-- Halaman Statis --}}
                    <div class="col-6 col-md-3">
                        <label class="link-type-card w-100" data-type="page">
                            <input type="radio" name="_link_type" value="page" class="d-none">
                            <div class="type-card-inner" style="border:2px solid;border-radius:10px;padding:14px 8px;text-align:center;cursor:pointer;transition:all .2s">
                                <i class="fas fa-file-alt fa-2x mb-2 d-block"></i>
                                <div style="font-size:13px;font-weight:700">Halaman</div>
                                <div style="font-size:11px;color:#94a3b8;margin-top:3px">Dari database</div>
                            </div>
                        </label>
                    </div>
                    {{-- URL Internal --}}
                    <div class="col-6 col-md-3">
                        <label class="link-type-card w-100" data-type="internal">
                            <input type="radio" name="_link_type" value="internal" class="d-none">
                            <div class="type-card-inner" style="border:2px solid;border-radius:10px;padding:14px 8px;text-align:center;cursor:pointer;transition:all .2s">
                                <i class="fas fa-link fa-2x mb-2 d-block"></i>
                                <div style="font-size:13px;font-weight:700">URL Internal</div>
                                <div style="font-size:11px;color:#94a3b8;margin-top:3px">Halaman di web ini</div>
                            </div>
                        </label>
                    </div>
                    {{-- URL Eksternal --}}
                    <div class="col-6 col-md-3">
                        <label class="link-type-card w-100" data-type="external">
                            <input type="radio" name="_link_type" value="external" class="d-none">
                            <div class="type-card-inner" style="border:2px solid;border-radius:10px;padding:14px 8px;text-align:center;cursor:pointer;transition:all .2s">
                                <i class="fas fa-external-link-alt fa-2x mb-2 d-block"></i>
                                <div style="font-size:13px;font-weight:700">URL Eksternal</div>
                                <div style="font-size:11px;color:#94a3b8;margin-top:3px">Website lain</div>
                            </div>
                        </label>
                    </div>
                </div>

                {{-- Panel: Pilih Halaman --}}
                <div id="panel-page" class="mt-4" style="display:none">
                    <label class="form-label fw-bold">Pilih Halaman</label>
                    @if($pages->count() > 0)
                    <div class="row g-2">
                        @foreach($pages as $p)
                        <div class="col-md-6">
                            <button type="button" class="btn btn-secondary w-100 text-start page-pick-btn"
                                    data-url="/halaman/{{ $p->slug }}" data-title="{{ $p->title }}"
                                    style="font-size:13px;justify-content:flex-start">
                                <i class="fas fa-file-alt me-2 text-primary"></i>
                                <span>{{ $p->title }}</span>
                                <small class="ms-auto text-muted">/halaman/{{ $p->slug }}</small>
                            </button>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="alert alert-warning py-2">
                        <i class="fas fa-info-circle me-1"></i>
                        Belum ada halaman statis. <a href="{{ route('admin.pages.index') }}">Buat halaman dulu</a>.
                    </div>
                    @endif
                </div>

                {{-- Panel: URL Internal --}}
                <div id="panel-internal" class="mt-4" style="display:none">
                    <label class="form-label fw-bold">Pintasan URL Umum</label>
                    <div class="row g-2 mb-3">
                        @php
                        $shortcuts = [
                            ['/', 'Beranda','fa-home'],
                            ['/profil/sejarah','Profil Kampus','fa-building'],
                            ['/akademik/program-studi','Program Studi','fa-graduation-cap'],
                            ['/pmb','Info PMB','fa-user-plus'],
                            ['/pmb/daftar','Daftar Sekarang','fa-pen'],
                            ['/penelitian','Penelitian','fa-flask'],
                            ['/berita','Berita','fa-newspaper'],
                            ['/media/galeri','Galeri','fa-images'],
                            ['/media/agenda','Agenda','fa-calendar'],
                            ['/kemahasiswaan/alumni','Alumni','fa-user-graduate'],
                            ['/kerjasama','Kerjasama','fa-handshake'],
                            ['/kontak','Kontak','fa-envelope'],
                        ];
                        @endphp
                        @foreach($shortcuts as [$url,$label,$icon])
                        <div class="col-6 col-md-4">
                            <button type="button" class="btn btn-secondary w-100 text-start shortcut-btn"
                                    data-url="{{ $url }}" data-title="{{ $label }}"
                                    style="font-size:12px;justify-content:flex-start;padding:7px 10px">
                                <i class="fas {{ $icon }} me-2 text-primary" style="width:14px"></i>{{ $label }}
                            </button>
                        </div>
                        @endforeach
                    </div>
                    <label class="form-label">Atau ketik URL manual</label>
                    <input type="text" id="internalUrlInput" class="form-control"
                           placeholder="/profil/sejarah" oninput="setUrl(this.value)">
                    <div class="form-hint">Dimulai dengan <code>/</code> — contoh: <code>/profil/sejarah</code></div>
                </div>

                {{-- Panel: URL Eksternal --}}
                <div id="panel-external" class="mt-4" style="display:none">
                    <label class="form-label fw-bold">URL Eksternal</label>
                    <input type="text" id="externalUrlInput" class="form-control"
                           placeholder="https://example.com" oninput="setUrl(this.value)">
                    <div class="form-hint">Mulai dengan <code>https://</code>. Otomatis dibuka di tab baru.</div>
                </div>
            </div>
        </div>

        {{-- ── STEP 2: Detail Menu ── --}}
        <div class="card mb-4">
            <div class="card-header">
                <h4><span style="background:var(--primary);color:#fff;border-radius:50%;width:24px;height:24px;display:inline-flex;align-items:center;justify-content:center;font-size:12px;margin-right:8px">2</span>Detail Menu</h4>
            </div>
            <div class="card-body">
                {{-- Hidden URL --}}
                <input type="hidden" name="url" id="menuUrl" value="{{ old('url') }}">

                <div class="form-group">
                    <label class="form-label fw-bold">Judul yang Ditampilkan <span class="text-danger">*</span></label>
                    <input type="text" name="title" id="menuTitle"
                           class="form-control form-control @error('title') is-invalid @enderror"
                           style="font-size:16px;font-weight:600"
                           value="{{ old('title') }}"
                           placeholder="Contoh: Beranda, Tentang Kami, Daftar..."
                           oninput="updatePreview()">
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <div class="form-hint">Nama menu yang akan terlihat oleh pengunjung.</div>
                </div>

                {{-- URL display (readonly) --}}
                <div class="form-group" id="urlDisplayGroup">
                    <label class="form-label">URL Terpilih</label>
                    <div class="input-group">
                        <span class="input-group-text" style="background:#f0fdf4;border-color:#86efac">
                            <i class="fas fa-check-circle text-success" id="urlStatusIcon"></i>
                        </span>
                        <input type="text" id="urlDisplay" class="form-control"
                               style="background:#f8fafc;color:#374151"
                               value="{{ old('url') ?: '(Tidak ada — menu dropdown)' }}" readonly>
                    </div>
                </div>

                {{-- Icon picker --}}
                <div class="form-group">
                    <label class="form-label fw-bold">Icon <span style="font-weight:400;color:#94a3b8;font-size:12px">(opsional)</span></label>
                    <div class="input-group mb-2">
                        <span class="input-group-text" id="iconPreviewBox" style="width:42px;justify-content:center;background:#eff6ff">
                            <i class="fas fa-tag text-primary" id="iconPreviewEl"></i>
                        </span>
                        <input type="text" name="icon" id="iconInput" class="form-control"
                               value="{{ old('icon') }}"
                               placeholder="fas fa-home"
                               oninput="updateIconPreview(this.value); updatePreview()">
                        <button type="button" class="btn btn-secondary" onclick="toggleIconPicker()" title="Pilih icon">
                            <i class="fas fa-th"></i>
                        </button>
                    </div>
                    {{-- Icon grid --}}
                    <div id="iconPickerGrid" style="display:none;border:1px solid var(--border);border-radius:10px;padding:12px;background:#f8fafc">
                        <div style="font-size:12px;color:#94a3b8;margin-bottom:8px">Klik icon untuk memilih:</div>
                        <div style="display:flex;flex-wrap:wrap;gap:6px">
                            @php
                            $icons = [
                                'fas fa-home','fas fa-building','fas fa-graduation-cap','fas fa-user-plus',
                                'fas fa-flask','fas fa-newspaper','fas fa-users','fas fa-handshake',
                                'fas fa-envelope','fas fa-phone','fas fa-map-marker-alt','fas fa-book',
                                'fas fa-calendar-alt','fas fa-images','fas fa-video','fas fa-photo-video',
                                'fas fa-award','fas fa-cross','fas fa-church','fas fa-file-alt',
                                'fas fa-chalkboard-teacher','fas fa-user-graduate','fas fa-briefcase',
                                'fas fa-globe','fas fa-star','fas fa-heart','fas fa-info-circle',
                                'fas fa-search','fas fa-bars','fas fa-cog','fas fa-shield-alt',
                            ];
                            @endphp
                            @foreach($icons as $ic)
                            <button type="button" class="icon-pick-btn"
                                    onclick="pickIcon('{{ $ic }}')"
                                    title="{{ $ic }}"
                                    style="width:38px;height:38px;border:1px solid var(--border);border-radius:7px;background:white;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all .15s;font-size:14px">
                                <i class="{{ $ic }}"></i>
                            </button>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-sm btn-secondary mt-2" onclick="pickIcon('')">
                            <i class="fas fa-times me-1"></i>Hapus Icon
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── STEP 3: Posisi & Pengaturan ── --}}
        <div class="card mb-4">
            <div class="card-header">
                <h4><span style="background:var(--primary);color:#fff;border-radius:50%;width:24px;height:24px;display:inline-flex;align-items:center;justify-content:center;font-size:12px;margin-right:8px">3</span>Posisi & Pengaturan</h4>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Tampilkan di</label>
                        <div class="d-flex gap-2">
                            <label style="flex:1;cursor:pointer">
                                <input type="radio" name="location" value="main" class="d-none"
                                       {{ old('location','main')=='main'?'checked':'' }}>
                                <div class="loc-card" data-val="main"
                                     style="border:2px solid;border-radius:8px;padding:10px;text-align:center;transition:all .2s">
                                    <i class="fas fa-bars d-block mb-1" style="font-size:18px"></i>
                                    <div style="font-size:12px;font-weight:600">Navbar</div>
                                </div>
                            </label>
                            <label style="flex:1;cursor:pointer">
                                <input type="radio" name="location" value="footer" class="d-none"
                                       {{ old('location')=='footer'?'checked':'' }}>
                                <div class="loc-card" data-val="footer"
                                     style="border:2px solid;border-radius:8px;padding:10px;text-align:center;transition:all .2s">
                                    <i class="fas fa-grip-lines d-block mb-1" style="font-size:18px"></i>
                                    <div style="font-size:12px;font-weight:600">Footer</div>
                                </div>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Urutan Tampil</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-sort-numeric-down"></i></span>
                            <input type="number" name="order" class="form-control"
                                   value="{{ old('order', 0) }}" min="0" placeholder="0">
                        </div>
                        <div class="form-hint">Angka lebih kecil = tampil lebih dulu</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Sub-menu dari</label>
                        <select name="parent_id" class="form-select" onchange="updatePreview()">
                            <option value="">— Tidak ada (menu utama) —</option>
                            @foreach($parents as $parent)
                            <option value="{{ $parent->id }}" {{ old('parent_id')==$parent->id?'selected':'' }}>
                                {{ $parent->title }}
                            </option>
                            @endforeach
                        </select>
                        <div class="form-hint">Pilih parent jika ini adalah sub-menu / dropdown item</div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Buka di</label>
                        <select name="target" class="form-select" id="targetSelect">
                            <option value="_self"  {{ old('target','_self')=='_self' ?'selected':'' }}>Tab sama</option>
                            <option value="_blank" {{ old('target')=='_blank'?'selected':'' }}>Tab baru</option>
                        </select>
                    </div>
                    <div class="col-md-3 d-flex align-items-end pb-1">
                        <div class="form-check form-switch" style="margin-bottom:0">
                            <input class="form-check-input" type="checkbox" name="is_active"
                                   id="is_active" value="1" {{ old('is_active',1)?'checked':'' }}
                                   style="width:42px;height:22px" onchange="updatePreview()">
                            <label class="form-check-label fw-bold" for="is_active" style="font-size:13px">
                                Menu Aktif
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>{{-- /col-lg-8 --}}

    {{-- ══════════ KOLOM KANAN (Preview) ══════════ --}}
    <div class="col-lg-4">
        <div style="position:sticky;top:80px">

            {{-- Live Preview --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h4><i class="fas fa-eye me-2" style="color:var(--primary)"></i>Live Preview</h4>
                </div>
                <div class="card-body p-0">
                    {{-- Navbar preview --}}
                    <div style="background:#1e3a8a;padding:10px 16px">
                        <div style="font-size:10px;color:rgba(255,255,255,0.4);margin-bottom:6px;letter-spacing:1px;text-transform:uppercase">Navbar</div>
                        <div id="previewNavItem"
                             style="display:inline-flex;align-items:center;gap:6px;color:rgba(255,255,255,0.8);font-size:13px;font-weight:500;padding:6px 10px;border-radius:6px;background:rgba(255,255,255,0.15)">
                            <i id="previewIcon" class="fas fa-tag" style="font-size:12px"></i>
                            <span id="previewTitle">Judul Menu</span>
                        </div>
                    </div>
                    {{-- URL preview --}}
                    <div style="padding:10px 16px;border-bottom:1px solid var(--border)">
                        <div style="font-size:10px;color:#94a3b8;margin-bottom:3px">URL</div>
                        <code id="previewUrl" style="font-size:12px;color:#374151;word-break:break-all">
                            (dropdown — tanpa link)
                        </code>
                    </div>
                    {{-- Status badge --}}
                    <div style="padding:10px 16px;display:flex;gap:8px;flex-wrap:wrap">
                        <span id="previewStatus" class="badge-status badge-success" style="font-size:11px">
                            <i class="fas fa-circle" style="font-size:7px"></i> Aktif
                        </span>
                        <span id="previewTarget" class="badge-status badge-secondary" style="font-size:11px">
                            <i class="fas fa-arrow-right" style="font-size:9px"></i> Tab sama
                        </span>
                        <span id="previewType" class="badge-status badge-info" style="font-size:11px">
                            <i class="fas fa-folder" style="font-size:9px"></i> Dropdown
                        </span>
                    </div>
                </div>
            </div>

            {{-- Panduan --}}
            <div class="card" style="border:1px solid #bfdbfe;background:#eff6ff">
                <div class="card-body" style="padding:16px">
                    <div style="font-size:13px;font-weight:700;color:var(--primary);margin-bottom:10px">
                        <i class="fas fa-lightbulb me-1"></i> Panduan Cepat
                    </div>
                    <ul style="font-size:12px;color:#374151;padding-left:16px;margin:0;line-height:1.8">
                        <li><strong>Dropdown</strong> = menu dengan sub-menu di bawahnya, tidak ada link</li>
                        <li><strong>Halaman</strong> = mengarah ke halaman statis yang dibuat di menu Pages</li>
                        <li><strong>URL Internal</strong> = mengarah ke halaman lain di website ini</li>
                        <li><strong>URL Eksternal</strong> = mengarah ke website lain (otomatis tab baru)</li>
                        <li><strong>Sub-menu dari</strong> = pilih parent jika ingin menjadi item dropdown</li>
                    </ul>
                </div>
            </div>

        </div>
    </div>

</div>

{{-- Sticky Save Bar --}}
<div style="position:sticky;bottom:0;background:white;padding:14px 0;border-top:1px solid var(--border);margin-top:8px;z-index:10">
    <div class="d-flex gap-2 align-items-center">
        <button type="submit" class="btn btn-primary btn-lg">
            <i class="fas fa-save me-2"></i>Simpan Menu
        </button>
        <a href="{{ route('admin.menus.index') }}" class="btn btn-secondary btn-lg">Batal</a>
        <span style="font-size:12px;color:#94a3b8;margin-left:8px">
            Perubahan akan langsung aktif setelah disimpan
        </span>
    </div>
</div>
</form>
@endsection

@push('styles')
<style>
.link-type-card input:checked + .type-card-inner,
.link-type-card.active .type-card-inner {
    border-color: var(--primary) !important;
    background: #eff6ff;
    color: var(--primary);
}
.link-type-card .type-card-inner { border-color: var(--border); color: #64748b; }
.link-type-card .type-card-inner:hover { border-color: #93c5fd; background: #f8fafc; }

.loc-card { border-color: var(--border) !important; color: #64748b; }
.loc-card.active, input[name="location"]:checked + .loc-card {
    border-color: var(--primary) !important;
    background: #eff6ff;
    color: var(--primary);
}
.icon-pick-btn:hover { border-color: var(--primary) !important; background: #eff6ff !important; color: var(--primary); }
.page-pick-btn.selected, .shortcut-btn.selected {
    border-color: var(--primary) !important;
    background: #eff6ff !important;
    color: var(--primary) !important;
}
</style>
@endpush

@push('scripts')
<script>
// ─── State ───────────────────────────────────────────────────
let currentLinkType = 'none';

// ─── Init ────────────────────────────────────────────────────
document.addEventListener('DOMContentLoaded', function() {
    const oldUrl  = document.getElementById('menuUrl').value;
    const oldType = '{{ old("_link_type", "none") }}';
    switchLinkType(oldType);
    if (oldUrl) setUrl(oldUrl, false);
    // Init location cards
    initLocationCards();
    updatePreview();
});

// ─── Link Type Switching ──────────────────────────────────────
document.querySelectorAll('.link-type-card').forEach(card => {
    card.addEventListener('click', function() {
        switchLinkType(this.dataset.type);
    });
});

function switchLinkType(type) {
    currentLinkType = type;
    // Update card visuals
    document.querySelectorAll('.link-type-card').forEach(c => {
        c.querySelector('input').checked = (c.dataset.type === type);
    });
    // Show/hide panels
    ['none','page','internal','external'].forEach(t => {
        const p = document.getElementById('panel-' + t);
        if (p) p.style.display = (t === type) ? '' : 'none';
    });
    // Auto-set target for external
    if (type === 'external') {
        document.getElementById('targetSelect').value = '_blank';
    }
    // Clear URL when switching to none
    if (type === 'none') setUrl('');
    updatePreview();
}

// ─── URL Helpers ─────────────────────────────────────────────
function setUrl(url, syncInput = true) {
    document.getElementById('menuUrl').value  = url;
    document.getElementById('urlDisplay').value = url || '(Tidak ada — menu dropdown)';
    const icon = document.getElementById('urlStatusIcon');
    icon.className = url ? 'fas fa-check-circle text-success' : 'fas fa-minus-circle text-muted';
    if (syncInput) {
        const ii = document.getElementById('internalUrlInput');
        const ei = document.getElementById('externalUrlInput');
        if (ii) ii.value = url;
        if (ei) ei.value = url;
    }
    updatePreview();
}

// Page picker buttons
document.querySelectorAll('.page-pick-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        setUrl(this.dataset.url);
        const titleField = document.getElementById('menuTitle');
        if (!titleField.value) { titleField.value = this.dataset.title; updatePreview(); }
        document.querySelectorAll('.page-pick-btn').forEach(b => b.classList.remove('selected'));
        this.classList.add('selected');
    });
});

// Shortcut buttons
document.querySelectorAll('.shortcut-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        setUrl(this.dataset.url);
        const titleField = document.getElementById('menuTitle');
        if (!titleField.value) { titleField.value = this.dataset.title; updatePreview(); }
        document.querySelectorAll('.shortcut-btn').forEach(b => b.classList.remove('selected'));
        this.classList.add('selected');
    });
});

// ─── Icon Picker ─────────────────────────────────────────────
function toggleIconPicker() {
    const g = document.getElementById('iconPickerGrid');
    g.style.display = g.style.display === 'none' ? '' : 'none';
}
function pickIcon(ic) {
    document.getElementById('iconInput').value = ic;
    updateIconPreview(ic);
    updatePreview();
    document.getElementById('iconPickerGrid').style.display = 'none';
}
function updateIconPreview(ic) {
    document.getElementById('iconPreviewEl').className = ic || 'fas fa-tag text-primary';
}

// ─── Location Cards ───────────────────────────────────────────
function initLocationCards() {
    document.querySelectorAll('input[name="location"]').forEach(radio => {
        const card = radio.parentElement.querySelector('.loc-card');
        if (radio.checked) card.classList.add('active');
        radio.addEventListener('change', function() {
            document.querySelectorAll('.loc-card').forEach(c => c.classList.remove('active'));
            card.classList.add('active');
        });
    });
}

// ─── Live Preview ─────────────────────────────────────────────
function updatePreview() {
    const title  = document.getElementById('menuTitle').value || 'Judul Menu';
    const url    = document.getElementById('menuUrl').value;
    const icon   = document.getElementById('iconInput').value;
    const active = document.getElementById('is_active').checked;
    const target = document.getElementById('targetSelect').value;

    document.getElementById('previewTitle').textContent = title;
    document.getElementById('previewUrl').textContent   = url || '(dropdown — tanpa link)';

    const piEl = document.getElementById('previewIcon');
    if (icon) { piEl.className = icon; piEl.style.display = ''; }
    else       { piEl.style.display = 'none'; }

    document.getElementById('previewStatus').innerHTML =
        active
        ? '<i class="fas fa-circle" style="font-size:7px"></i> Aktif'
        : '<i class="fas fa-circle" style="font-size:7px"></i> Nonaktif';
    document.getElementById('previewStatus').className =
        'badge-status ' + (active ? 'badge-success' : 'badge-secondary');

    document.getElementById('previewTarget').innerHTML =
        target === '_blank'
        ? '<i class="fas fa-external-link-alt" style="font-size:9px"></i> Tab baru'
        : '<i class="fas fa-arrow-right" style="font-size:9px"></i> Tab sama';

    const typeMap = {none:'Dropdown',page:'Halaman',internal:'URL Internal',external:'URL Eksternal'};
    const iconMap = {none:'fa-folder',page:'fa-file-alt',internal:'fa-link',external:'fa-external-link-alt'};
    document.getElementById('previewType').innerHTML =
        `<i class="fas ${iconMap[currentLinkType]||'fa-link'}" style="font-size:9px"></i> ${typeMap[currentLinkType]||''}`;
}
</script>
@endpush
