@extends('layouts.admin')
@section('title', 'Galeri Foto')
@section('page-title', 'Galeri Foto')
@section('breadcrumb', 'Konten Website')
@section('content')

{{-- Stats + Actions bar --}}
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div class="d-flex gap-3 flex-wrap">
        <div class="stat-pill">
            <i class="fas fa-images text-primary me-1"></i>
            <strong>{{ $stats['total'] }}</strong> <span class="text-muted">Total</span>
        </div>
        <div class="stat-pill">
            <i class="fas fa-eye text-success me-1"></i>
            <strong>{{ $stats['published'] }}</strong> <span class="text-muted">Ditampilkan</span>
        </div>
        <div class="stat-pill">
            <i class="fas fa-eye-slash text-muted me-1"></i>
            <strong>{{ $stats['draft'] }}</strong> <span class="text-muted">Disembunyikan</span>
        </div>
    </div>
    <div class="d-flex gap-2">
        <button class="btn btn-success" onclick="document.getElementById('bulkDropZone').scrollIntoView({behavior:'smooth'})">
            <i class="fas fa-cloud-upload-alt me-1"></i> Upload Massal
        </button>
        <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Upload Satu Foto
        </a>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success mb-4"><i class="fas fa-check-circle me-2"></i>{{ session('success') }}</div>
@endif

{{-- ── BULK UPLOAD DROP ZONE ──────────────────────────────── --}}
<div class="card mb-4" id="bulkDropZone">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h4><i class="fas fa-cloud-upload-alt me-2" style="color:var(--primary)"></i>Upload Massal</h4>
        <button type="button" class="btn btn-sm btn-secondary" onclick="toggleBulk()">
            <i class="fas fa-chevron-down" id="bulkChevron"></i>
        </button>
    </div>
    <div id="bulkBody" style="display:none">
    <div class="card-body">
        <div class="row g-3 align-items-end mb-3">
            <div class="col-md-4">
                <label class="form-label fw-bold">Kategori untuk semua foto ini</label>
                <select id="bulkCategory" class="form-select">
                    <option value="umum">Umum</option>
                    <option value="kampus">Kampus</option>
                    <option value="kegiatan">Kegiatan</option>
                    <option value="wisuda">Wisuda</option>
                    <option value="ibadah">Ibadah</option>
                    <option value="prestasi">Prestasi</option>
                </select>
            </div>
            <div class="col-md-8 text-muted" style="font-size:12px">
                <i class="fas fa-info-circle me-1"></i>
                Judul akan otomatis diambil dari nama file. Bisa diedit setelah upload.
            </div>
        </div>

        {{-- Drop area --}}
        <div id="dropArea"
             style="border:2px dashed var(--border);border-radius:14px;padding:40px 20px;text-align:center;cursor:pointer;transition:all .2s;background:#fafafa"
             ondragover="event.preventDefault();this.style.borderColor='var(--primary)';this.style.background='#eff6ff'"
             ondragleave="this.style.borderColor='var(--border)';this.style.background='#fafafa'"
             ondrop="handleDrop(event)"
             onclick="document.getElementById('bulkFileInput').click()">
            <i class="fas fa-images fa-3x mb-3" style="color:#cbd5e1"></i>
            <div style="font-size:15px;font-weight:600;color:#64748b">Drag & drop foto ke sini</div>
            <div style="font-size:13px;color:#94a3b8;margin-top:4px">atau klik untuk memilih file</div>
            <div style="font-size:11px;color:#cbd5e1;margin-top:8px">JPG, PNG, WebP • Maks. 5MB per file • Bisa pilih banyak sekaligus</div>
        </div>
        <input type="file" id="bulkFileInput" multiple accept="image/*" style="display:none" onchange="handleFiles(this.files)">

        {{-- Preview grid --}}
        <div id="bulkPreviewGrid" class="row g-2 mt-3" style="display:none!important"></div>

        {{-- Progress --}}
        <div id="bulkProgress" class="mt-3" style="display:none">
            <div class="d-flex align-items-center gap-2 mb-2">
                <div class="spinner-border spinner-border-sm text-primary"></div>
                <span id="bulkProgressText" style="font-size:13px">Mengupload...</span>
            </div>
            <div class="progress" style="height:6px">
                <div class="progress-bar" id="bulkProgressBar" style="width:0%"></div>
            </div>
        </div>

        {{-- Upload button --}}
        <div id="bulkActions" class="mt-3" style="display:none">
            <button type="button" class="btn btn-primary" onclick="uploadBulk()">
                <i class="fas fa-upload me-1"></i> Upload <span id="bulkCount">0</span> Foto
            </button>
            <button type="button" class="btn btn-secondary ms-2" onclick="clearBulk()">
                <i class="fas fa-times me-1"></i> Batal
            </button>
        </div>
    </div>
    </div>
</div>

{{-- ── FILTER & SEARCH ─────────────────────────────────── --}}
<div class="card mb-4">
    <div class="card-body py-3">
        <form method="GET" class="d-flex flex-wrap gap-3 align-items-center">
            <div class="d-flex gap-1 flex-wrap">
                <a href="{{ route('admin.gallery.index') }}"
                   class="btn btn-sm {{ !$category ? 'btn-primary' : 'btn-secondary' }}">
                    Semua ({{ $stats['total'] }})
                </a>
                @foreach($categories as $cat)
                <a href="{{ route('admin.gallery.index', ['category' => $cat]) }}"
                   class="btn btn-sm {{ $category === $cat ? 'btn-primary' : 'btn-secondary' }}">
                    {{ ucfirst($cat) }}
                </a>
                @endforeach
            </div>
            <div class="ms-auto d-flex gap-2">
                <div class="input-group" style="width:220px">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                    <input type="text" name="q" class="form-control" placeholder="Cari judul..." value="{{ $q }}">
                </div>
                <button type="submit" class="btn btn-secondary">Cari</button>
            </div>
        </form>
    </div>
</div>

{{-- ── PHOTO GRID ──────────────────────────────────────── --}}
<div class="row g-3" id="galleryGrid">
    @forelse($gallery as $item)
    <div class="col-6 col-md-4 col-lg-3" id="card-{{ $item->id }}">
        <div class="gallery-card">
            {{-- Photo --}}
            <div class="gallery-img-wrap" onclick="openLightbox('{{ $item->image_url }}', '{{ addslashes($item->title) }}')">
                <img src="{{ $item->image_url }}" alt="{{ $item->title }}" loading="lazy">
                <div class="gallery-overlay">
                    <i class="fas fa-expand-alt"></i>
                </div>
            </div>

            {{-- Body --}}
            <div class="gallery-body">
                <div class="gallery-title" title="{{ $item->title }}">{{ Str::limit($item->title, 28) }}</div>
                <div class="d-flex align-items-center justify-content-between mt-1">
                    <span class="cat-badge">{{ $item->category }}</span>
                    <button type="button"
                            class="toggle-btn {{ $item->is_published ? 'active' : '' }}"
                            data-id="{{ $item->id }}"
                            title="{{ $item->is_published ? 'Klik untuk sembunyikan' : 'Klik untuk tampilkan' }}"
                            onclick="toggleItem(this, {{ $item->id }})">
                        <i class="fas {{ $item->is_published ? 'fa-eye' : 'fa-eye-slash' }}"></i>
                        {{ $item->is_published ? 'Aktif' : 'Draft' }}
                    </button>
                </div>
            </div>

            {{-- Actions --}}
            <div class="gallery-footer">
                <a href="{{ route('admin.gallery.edit', $item) }}" class="btn btn-sm btn-warning flex-fill">
                    <i class="fas fa-edit me-1"></i>Edit
                </a>
                <form action="{{ route('admin.gallery.destroy', $item) }}" method="POST"
                      onsubmit="return confirm('Hapus foto &quot;{{ $item->title }}&quot;?')"
                      class="flex-fill">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger w-100">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="text-center py-16" style="color:#94a3b8;padding:80px 0">
            <i class="fas fa-images fa-4x mb-4 d-block" style="opacity:.3"></i>
            <div style="font-size:16px;font-weight:600;margin-bottom:8px">Belum ada foto di galeri</div>
            <div style="font-size:13px">Upload foto menggunakan tombol di atas atau drag & drop ke area upload massal</div>
        </div>
    </div>
    @endforelse
</div>

{{-- Pagination --}}
<div class="mt-4">{{ $gallery->links() }}</div>

{{-- ── LIGHTBOX ───────────────────────────────────────── --}}
<div id="lightbox" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.92);z-index:9999;cursor:pointer;align-items:center;justify-content:center;flex-direction:column"
     onclick="closeLightbox()">
    <button style="position:absolute;top:20px;right:24px;background:none;border:none;color:white;font-size:28px;cursor:pointer" onclick="closeLightbox()">
        <i class="fas fa-times"></i>
    </button>
    <img id="lightboxImg" src="" alt="" style="max-width:90vw;max-height:80vh;border-radius:8px;box-shadow:0 20px 60px rgba(0,0,0,.5)">
    <p id="lightboxTitle" style="color:rgba(255,255,255,.8);margin-top:14px;font-size:14px"></p>
</div>

@endsection

@push('styles')
<style>
.stat-pill { background:var(--bg-card);border:1px solid var(--border);border-radius:20px;padding:6px 14px;font-size:13px;display:flex;align-items:center;gap:4px; }
.gallery-card { background:white;border-radius:12px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,.07);transition:box-shadow .2s,transform .2s;display:flex;flex-direction:column; }
.gallery-card:hover { box-shadow:0 8px 24px rgba(0,0,0,.12);transform:translateY(-2px); }
.gallery-img-wrap { position:relative;height:160px;overflow:hidden;cursor:pointer;background:#f1f5f9; }
.gallery-img-wrap img { width:100%;height:100%;object-fit:cover;transition:transform .4s; }
.gallery-card:hover .gallery-img-wrap img { transform:scale(1.06); }
.gallery-overlay { position:absolute;inset:0;background:rgba(0,0,0,.35);opacity:0;display:flex;align-items:center;justify-content:center;transition:opacity .2s; }
.gallery-overlay i { color:white;font-size:22px; }
.gallery-card:hover .gallery-overlay { opacity:1; }
.gallery-body { padding:10px 12px 6px; }
.gallery-title { font-size:13px;font-weight:600;color:#1e3a8a;line-height:1.3; }
.cat-badge { background:#eff6ff;color:#2563eb;border-radius:20px;padding:2px 8px;font-size:10px;font-weight:600;text-transform:uppercase;letter-spacing:.5px; }
.toggle-btn { border:none;border-radius:20px;padding:3px 9px;font-size:10px;font-weight:600;cursor:pointer;transition:all .2s;background:#f1f5f9;color:#64748b; }
.toggle-btn.active { background:#dcfce7;color:#16a34a; }
.toggle-btn:hover { opacity:.8; }
.gallery-footer { display:flex;gap:4px;padding:8px;border-top:1px solid #f1f5f9;margin-top:auto; }
</style>
@endpush

@push('scripts')
<script>
const CSRF = '{{ csrf_token() }}';
let bulkFiles = [];

/* ── Bulk Upload ─────────────────────────────────── */
function toggleBulk() {
    const b = document.getElementById('bulkBody');
    const ch = document.getElementById('bulkChevron');
    const open = b.style.display === 'none';
    b.style.display = open ? '' : 'none';
    ch.className = open ? 'fas fa-chevron-up' : 'fas fa-chevron-down';
}

function handleDrop(e) {
    e.preventDefault();
    document.getElementById('dropArea').style.borderColor = 'var(--border)';
    document.getElementById('dropArea').style.background = '#fafafa';
    handleFiles(e.dataTransfer.files);
}

function handleFiles(files) {
    bulkFiles = Array.from(files);
    if (!bulkFiles.length) return;
    const grid = document.getElementById('bulkPreviewGrid');
    grid.innerHTML = '';
    grid.style.display = 'flex';
    grid.style.flexWrap = 'wrap';

    bulkFiles.forEach((file, i) => {
        const reader = new FileReader();
        reader.onload = e => {
            const col = document.createElement('div');
            col.className = 'col-6 col-md-3 col-lg-2';
            col.innerHTML = `
                <div style="position:relative;border-radius:8px;overflow:hidden;height:90px;background:#f1f5f9">
                    <img src="${e.target.result}" style="width:100%;height:100%;object-fit:cover">
                    <div style="position:absolute;bottom:0;left:0;right:0;background:rgba(0,0,0,.55);color:white;font-size:9px;padding:3px 5px;overflow:hidden;white-space:nowrap;text-overflow:ellipsis">
                        ${file.name}
                    </div>
                </div>`;
            grid.appendChild(col);
        };
        reader.readAsDataURL(file);
    });

    document.getElementById('bulkCount').textContent = bulkFiles.length;
    document.getElementById('bulkActions').style.display = '';
}

async function uploadBulk() {
    if (!bulkFiles.length) return;
    const prog = document.getElementById('bulkProgress');
    const bar  = document.getElementById('bulkProgressBar');
    const txt  = document.getElementById('bulkProgressText');
    prog.style.display = '';
    document.getElementById('bulkActions').style.display = 'none';

    const form = new FormData();
    bulkFiles.forEach(f => form.append('images[]', f));
    form.append('category', document.getElementById('bulkCategory').value);
    form.append('_token', CSRF);

    try {
        const res  = await fetch('{{ route("admin.gallery.bulk-store") }}', { method:'POST', body:form });
        const data = await res.json();
        bar.style.width = '100%';
        txt.textContent = `Berhasil upload ${data.count} foto!`;
        setTimeout(() => location.reload(), 1200);
    } catch (e) {
        txt.textContent = 'Gagal upload. Coba lagi.';
        bar.classList.add('bg-danger');
    }
}

function clearBulk() {
    bulkFiles = [];
    document.getElementById('bulkPreviewGrid').innerHTML = '';
    document.getElementById('bulkPreviewGrid').style.display = 'none!important';
    document.getElementById('bulkActions').style.display = 'none';
    document.getElementById('bulkProgress').style.display = 'none';
}

/* ── Toggle Published ────────────────────────────── */
function toggleItem(btn, id) {
    fetch(`/admin/gallery/${id}/toggle`, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' }
    })
    .then(r => r.json())
    .then(data => {
        const active = data.is_published;
        btn.className = 'toggle-btn ' + (active ? 'active' : '');
        btn.innerHTML = `<i class="fas ${active ? 'fa-eye' : 'fa-eye-slash'}"></i> ${active ? 'Aktif' : 'Draft'}`;
        btn.title = active ? 'Klik untuk sembunyikan' : 'Klik untuk tampilkan';
    });
}

/* ── Lightbox ─────────────────────────────────────── */
function openLightbox(url, title) {
    document.getElementById('lightboxImg').src = url;
    document.getElementById('lightboxTitle').textContent = title;
    const lb = document.getElementById('lightbox');
    lb.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}
function closeLightbox() {
    document.getElementById('lightbox').style.display = 'none';
    document.body.style.overflow = '';
}
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeLightbox(); });
</script>
@endpush
