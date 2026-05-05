@extends('layouts.admin')
@section('title', 'Edit Menu: ' . $menu->title)
@section('page-title', 'Edit Menu')
@section('breadcrumb', 'Menu Dinamis')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <p class="text-muted mb-0" style="font-size:13px">
            Mengedit: <strong>{{ $menu->title }}</strong>
        </p>
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

@php
$currentUrl = old('url', $menu->url ?? '');
// Deteksi tipe link
if (!$currentUrl) $initType = 'none';
elseif (str_starts_with($currentUrl, '/halaman/')) $initType = 'page';
elseif (str_starts_with($currentUrl, 'http')) $initType = 'external';
else $initType = 'internal';
@endphp

<form action="{{ route('admin.menus.update', $menu) }}" method="POST" id="menuForm">
@csrf @method('PUT')
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
                    @foreach(['none'=>['Dropdown','fa-folder','Grup tanpa link'],'page'=>['Halaman','fa-file-alt','Dari database'],'internal'=>['URL Internal','fa-link','Halaman di web ini'],'external'=>['URL Eksternal','fa-external-link-alt','Website lain']] as $type=>[$label,$ic,$desc])
                    <div class="col-6 col-md-3">
                        <label class="link-type-card w-100" data-type="{{ $type }}">
                            <input type="radio" name="_link_type" value="{{ $type }}" class="d-none"
                                   {{ $initType===$type?'checked':'' }}>
                            <div class="type-card-inner" style="border:2px solid;border-radius:10px;padding:14px 8px;text-align:center;cursor:pointer;transition:all .2s">
                                <i class="fas {{ $ic }} fa-2x mb-2 d-block"></i>
                                <div style="font-size:13px;font-weight:700">{{ $label }}</div>
                                <div style="font-size:11px;color:#94a3b8;margin-top:3px">{{ $desc }}</div>
                            </div>
                        </label>
                    </div>
                    @endforeach
                </div>

                {{-- Panel: Pilih Halaman --}}
                <div id="panel-page" class="mt-4" style="display:none">
                    <label class="form-label fw-bold">Pilih Halaman</label>
                    @if($pages->count() > 0)
                    <div class="row g-2">
                        @foreach($pages as $p)
                        <div class="col-md-6">
                            <button type="button" class="btn btn-secondary w-100 text-start page-pick-btn
                                        {{ $currentUrl === '/halaman/'.$p->slug ? 'selected' : '' }}"
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
                            <button type="button" class="btn btn-secondary w-100 text-start shortcut-btn
                                        {{ $currentUrl===$url ? 'selected' : '' }}"
                                    data-url="{{ $url }}" data-title="{{ $label }}"
                                    style="font-size:12px;justify-content:flex-start;padding:7px 10px">
                                <i class="fas {{ $icon }} me-2 text-primary" style="width:14px"></i>{{ $label }}
                            </button>
                        </div>
                        @endforeach
                    </div>
                    <label class="form-label">Atau ketik URL manual</label>
                    <input type="text" id="internalUrlInput" class="form-control"
                           value="{{ $initType==='internal' ? $currentUrl : '' }}"
                           placeholder="/profil/sejarah" oninput="setUrl(this.value)">
                    <div class="form-hint">Dimulai dengan <code>/</code></div>
                </div>

                {{-- Panel: URL Eksternal --}}
                <div id="panel-external" class="mt-4" style="display:none">
                    <label class="form-label fw-bold">URL Eksternal</label>
                    <input type="text" id="externalUrlInput" class="form-control"
                           value="{{ $initType==='external' ? $currentUrl : '' }}"
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
                <input type="hidden" name="url" id="menuUrl" value="{{ $currentUrl }}">

                <div class="form-group">
                    <label class="form-label fw-bold">Judul yang Ditampilkan <span class="text-danger">*</span></label>
                    <input type="text" name="title" id="menuTitle"
                           class="form-control @error('title') is-invalid @enderror"
                           style="font-size:16px;font-weight:600"
                           value="{{ old('title', $menu->title) }}"
                           oninput="updatePreview()">
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label">URL Terpilih</label>
                    <div class="input-group">
                        <span class="input-group-text" style="background:#f0fdf4;border-color:#86efac">
                            <i class="{{ $currentUrl ? 'fas fa-check-circle text-success' : 'fas fa-minus-circle text-muted' }}" id="urlStatusIcon"></i>
                        </span>
                        <input type="text" id="urlDisplay" class="form-control"
                               style="background:#f8fafc;color:#374151"
                               value="{{ $currentUrl ?: '(Tidak ada — menu dropdown)' }}" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label fw-bold">Icon <span style="font-weight:400;color:#94a3b8;font-size:12px">(opsional)</span></label>
                    <div class="input-group mb-2">
                        <span class="input-group-text" id="iconPreviewBox" style="width:42px;justify-content:center;background:#eff6ff">
                            <i class="{{ old('icon',$menu->icon) ?: 'fas fa-tag text-primary' }}" id="iconPreviewEl"></i>
                        </span>
                        <input type="text" name="icon" id="iconInput" class="form-control"
                               value="{{ old('icon', $menu->icon) }}"
                               placeholder="fas fa-home"
                               oninput="updateIconPreview(this.value); updatePreview()">
                        <button type="button" class="btn btn-secondary" onclick="toggleIconPicker()">
                            <i class="fas fa-th"></i>
                        </button>
                    </div>
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
                            <button type="button" class="icon-pick-btn" onclick="pickIcon('{{ $ic }}')"
                                    title="{{ $ic }}"
                                    style="width:38px;height:38px;border:1px solid var(--border);border-radius:7px;background:{{ old('icon',$menu->icon)===$ic?'#eff6ff':'white' }};cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all .15s;font-size:14px">
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
                            @foreach(['main'=>['Navbar','fa-bars'],'footer'=>['Footer','fa-grip-lines']] as $val=>[$lbl,$ic])
                            <label style="flex:1;cursor:pointer">
                                <input type="radio" name="location" value="{{ $val }}" class="d-none"
                                       {{ old('location',$menu->location)===$val?'checked':'' }}>
                                <div class="loc-card {{ old('location',$menu->location)===$val?'active':'' }}" data-val="{{ $val }}"
                                     style="border:2px solid;border-radius:8px;padding:10px;text-align:center;transition:all .2s">
                                    <i class="fas {{ $ic }} d-block mb-1" style="font-size:18px"></i>
                                    <div style="font-size:12px;font-weight:600">{{ $lbl }}</div>
                                </div>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Urutan Tampil</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-sort-numeric-down"></i></span>
                            <input type="number" name="order" class="form-control"
                                   value="{{ old('order', $menu->order) }}" min="0">
                        </div>
                        <div class="form-hint">Angka lebih kecil = tampil lebih dulu</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Sub-menu dari</label>
                        <select name="parent_id" class="form-select" onchange="updatePreview()">
                            <option value="">— Tidak ada (menu utama) —</option>
                            @foreach($parents as $parent)
                            <option value="{{ $parent->id }}"
                                {{ old('parent_id',$menu->parent_id)==$parent->id?'selected':'' }}>
                                {{ $parent->title }}
                            </option>
                            @endforeach
                        </select>
                        <div class="form-hint">Pilih parent jika ini adalah sub-menu</div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Buka di</label>
                        <select name="target" class="form-select" id="targetSelect">
                            <option value="_self"  {{ old('target',$menu->target)==='_self' ?'selected':'' }}>Tab sama</option>
                            <option value="_blank" {{ old('target',$menu->target)==='_blank'?'selected':'' }}>Tab baru</option>
                        </select>
                    </div>
                    <div class="col-md-3 d-flex align-items-end pb-1">
                        <div class="form-check form-switch" style="margin-bottom:0">
                            <input class="form-check-input" type="checkbox" name="is_active"
                                   id="is_active" value="1"
                                   {{ old('is_active',$menu->is_active)?'checked':'' }}
                                   style="width:42px;height:22px" onchange="updatePreview()">
                            <label class="form-check-label fw-bold" for="is_active" style="font-size:13px">Menu Aktif</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sub-menu yang dimiliki (info) --}}
        @if($menu->childrenAll->count() > 0)
        <div class="card mb-4" style="border-color:#fde68a;background:#fffbeb">
            <div class="card-header" style="background:#fefce8;border-color:#fde68a">
                <h4 style="color:#92400e">
                    <i class="fas fa-sitemap me-2"></i>Sub-menu yang dimiliki ({{ $menu->childrenAll->count() }})
                </h4>
                <a href="{{ route('admin.menus.create') }}" class="btn btn-warning btn-sm">
                    <i class="fas fa-plus me-1"></i> Tambah Sub-menu
                </a>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0" style="font-size:13px">
                    <thead><tr><th>Judul</th><th>URL</th><th>Status</th><th style="width:80px">Aksi</th></tr></thead>
                    <tbody>
                        @foreach($menu->childrenAll as $child)
                        <tr>
                            <td>
                                @if($child->icon)<i class="{{ $child->icon }} me-1 text-muted"></i>@endif
                                {{ $child->title }}
                            </td>
                            <td><small class="text-muted">{{ $child->url ?: '—' }}</small></td>
                            <td>
                                <span class="badge-status {{ $child->is_active?'badge-success':'badge-secondary' }}" style="font-size:11px">
                                    {{ $child->is_active?'Aktif':'Nonaktif' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.menus.edit', $child) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif

    </div>{{-- /col-lg-8 --}}

    {{-- ══════════ KOLOM KANAN ══════════ --}}
    <div class="col-lg-4">
        <div style="position:sticky;top:80px">
            <div class="card mb-4">
                <div class="card-header">
                    <h4><i class="fas fa-eye me-2" style="color:var(--primary)"></i>Live Preview</h4>
                </div>
                <div class="card-body p-0">
                    <div style="background:#1e3a8a;padding:10px 16px">
                        <div style="font-size:10px;color:rgba(255,255,255,0.4);margin-bottom:6px;letter-spacing:1px;text-transform:uppercase">Navbar</div>
                        <div id="previewNavItem" style="display:inline-flex;align-items:center;gap:6px;color:rgba(255,255,255,0.8);font-size:13px;font-weight:500;padding:6px 10px;border-radius:6px;background:rgba(255,255,255,0.15)">
                            <i id="previewIcon" class="{{ $menu->icon ?: 'fas fa-tag' }}" style="font-size:12px;{{ $menu->icon?'':'display:none' }}"></i>
                            <span id="previewTitle">{{ $menu->title }}</span>
                        </div>
                    </div>
                    <div style="padding:10px 16px;border-bottom:1px solid var(--border)">
                        <div style="font-size:10px;color:#94a3b8;margin-bottom:3px">URL</div>
                        <code id="previewUrl" style="font-size:12px;color:#374151;word-break:break-all">
                            {{ $currentUrl ?: '(dropdown — tanpa link)' }}
                        </code>
                    </div>
                    <div style="padding:10px 16px;display:flex;gap:8px;flex-wrap:wrap">
                        <span id="previewStatus" class="badge-status {{ $menu->is_active?'badge-success':'badge-secondary' }}" style="font-size:11px">
                            <i class="fas fa-circle" style="font-size:7px"></i> {{ $menu->is_active?'Aktif':'Nonaktif' }}
                        </span>
                        <span id="previewTarget" class="badge-status badge-secondary" style="font-size:11px">
                            <i class="fas fa-arrow-right" style="font-size:9px"></i>
                            {{ $menu->target==='_blank'?'Tab baru':'Tab sama' }}
                        </span>
                        <span id="previewType" class="badge-status badge-info" style="font-size:11px">
                            <i class="fas fa-{{ $initType==='none'?'folder':($initType==='page'?'file-alt':'link') }}" style="font-size:9px"></i>
                            {{ ['none'=>'Dropdown','page'=>'Halaman','internal'=>'URL Internal','external'=>'URL Eksternal'][$initType] }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="card" style="border:1px solid #bfdbfe;background:#eff6ff">
                <div class="card-body" style="padding:16px">
                    <div style="font-size:13px;font-weight:700;color:var(--primary);margin-bottom:10px">
                        <i class="fas fa-lightbulb me-1"></i> Panduan Cepat
                    </div>
                    <ul style="font-size:12px;color:#374151;padding-left:16px;margin:0;line-height:1.8">
                        <li><strong>Dropdown</strong> = menu grup tanpa link langsung</li>
                        <li><strong>Halaman</strong> = mengarah ke halaman statis dari Pages</li>
                        <li><strong>URL Internal</strong> = halaman lain di website ini</li>
                        <li><strong>URL Eksternal</strong> = website lain (tab baru)</li>
                        <li><strong>Sub-menu dari</strong> = tentukan parent agar jadi dropdown item</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>

<div style="position:sticky;bottom:0;background:white;padding:14px 0;border-top:1px solid var(--border);margin-top:8px;z-index:10">
    <div class="d-flex gap-2 align-items-center">
        <button type="submit" class="btn btn-warning btn-lg">
            <i class="fas fa-save me-2"></i>Simpan Perubahan
        </button>
        <a href="{{ route('admin.menus.index') }}" class="btn btn-secondary btn-lg">Batal</a>
        <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST" class="ms-auto"
              onsubmit="return confirm('Hapus menu {{ $menu->title }}? Sub-menu di bawahnya juga akan dihapus.')">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-danger">
                <i class="fas fa-trash me-1"></i> Hapus Menu Ini
            </button>
        </form>
    </div>
</div>
</form>
@endsection

@push('styles')
<style>
.link-type-card input:checked + .type-card-inner { border-color: var(--primary) !important; background: #eff6ff; color: var(--primary); }
.link-type-card .type-card-inner { border-color: var(--border); color: #64748b; }
.link-type-card .type-card-inner:hover { border-color: #93c5fd; background: #f8fafc; }
.loc-card { border-color: var(--border) !important; color: #64748b; }
.loc-card.active { border-color: var(--primary) !important; background: #eff6ff; color: var(--primary); }
.icon-pick-btn:hover { border-color: var(--primary) !important; background: #eff6ff !important; color: var(--primary); }
.page-pick-btn.selected, .shortcut-btn.selected { border-color: var(--primary) !important; background: #eff6ff !important; color: var(--primary) !important; }
</style>
@endpush

@push('scripts')
<script>
let currentLinkType = '{{ $initType }}';

document.addEventListener('DOMContentLoaded', function() {
    showPanel(currentLinkType);
    initLocationCards();
    updatePreview();
});

document.querySelectorAll('.link-type-card').forEach(card => {
    card.addEventListener('click', function() {
        switchLinkType(this.dataset.type);
    });
});

function switchLinkType(type) {
    currentLinkType = type;
    document.querySelectorAll('.link-type-card').forEach(c => {
        c.querySelector('input').checked = (c.dataset.type === type);
    });
    showPanel(type);
    if (type === 'external') document.getElementById('targetSelect').value = '_blank';
    if (type === 'none') setUrl('');
    updatePreview();
}

function showPanel(type) {
    ['none','page','internal','external'].forEach(t => {
        const p = document.getElementById('panel-' + t);
        if (p) p.style.display = (t === type) ? '' : 'none';
    });
}

function setUrl(url, syncInput = true) {
    document.getElementById('menuUrl').value = url;
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

document.querySelectorAll('.page-pick-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        setUrl(this.dataset.url);
        document.querySelectorAll('.page-pick-btn').forEach(b => b.classList.remove('selected'));
        this.classList.add('selected');
    });
});

document.querySelectorAll('.shortcut-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        setUrl(this.dataset.url);
        document.querySelectorAll('.shortcut-btn').forEach(b => b.classList.remove('selected'));
        this.classList.add('selected');
    });
});

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

function initLocationCards() {
    document.querySelectorAll('input[name="location"]').forEach(radio => {
        const card = radio.parentElement.querySelector('.loc-card');
        radio.addEventListener('change', function() {
            document.querySelectorAll('.loc-card').forEach(c => c.classList.remove('active'));
            if (card) card.classList.add('active');
        });
    });
}

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
        `<i class="fas fa-circle" style="font-size:7px"></i> ${active?'Aktif':'Nonaktif'}`;
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
