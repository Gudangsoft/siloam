@extends('layouts.admin')
@section('title', 'Pengaturan Website')
@section('page-title', 'Pengaturan Website')
@section('breadcrumb', 'Lainnya')
@section('content')
@if($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif
<form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-6">

            {{-- ── Identitas Institusi ── --}}
            <div class="card mb-4">
                <div class="card-header"><h4><i class="fas fa-university me-2" style="color:var(--primary)"></i>Identitas Institusi</h4></div>
                <div class="card-body">
                    <div class="form-group"><label class="form-label">Nama Institusi <span class="text-danger">*</span></label>
                        <input type="text" name="app_name" class="form-control" value="{{ $settings['app_name'] ?? '' }}" required placeholder="Contoh: STT Siloam Medan"></div>
                    <div class="form-group"><label class="form-label">Tagline</label>
                        <input type="text" name="tagline" class="form-control" value="{{ $settings['tagline'] ?? '' }}" placeholder="Tagline singkat kampus Anda..."></div>
                    <div class="form-group"><label class="form-label">Deskripsi Singkat <span style="color:#94a3b8;font-size:12px">(muncul di Google)</span></label>
                        <textarea name="meta_description" class="form-control" rows="2" placeholder="Deskripsi singkat kampus untuk mesin pencari, maks 160 karakter...">{{ $settings['meta_description'] ?? '' }}</textarea>
                        <div class="form-hint">Digunakan sebagai deskripsi website di hasil pencarian Google.</div></div>
                    <div class="form-group"><label class="form-label">Teks Footer</label>
                        <input type="text" name="footer_text" class="form-control" value="{{ $settings['footer_text'] ?? '' }}" placeholder="Contoh: &copy; 2025 Nama Kampus. Hak Cipta Dilindungi.">
                        <div class="form-hint">Kosongkan untuk menggunakan format default: © [tahun] [nama kampus].</div></div>
                    <div class="form-group"><label class="form-label">Subjudul Halaman Login Admin</label>
                        <input type="text" name="admin_panel_subtitle" class="form-control" value="{{ $settings['admin_panel_subtitle'] ?? '' }}" placeholder="Panel Administrasi Website Resmi"></div>
                    <div class="form-group"><label class="form-label">Sambutan Singkat</label>
                        <textarea name="welcome_message" class="form-control" rows="3">{{ $settings['welcome_message'] ?? '' }}</textarea></div>

                    {{-- Logo --}}
                    <div class="form-group">
                        <label class="form-label fw-bold">Logo Website</label>
                        <div class="d-flex align-items-start gap-3 mb-2">
                            @if(!empty($settings['logo']))
                                <div style="padding:10px;background:#f8fafc;border:1px solid var(--border);border-radius:8px">
                                    <img src="{{ Storage::disk('public')->url($settings['logo']) }}"
                                         id="logoPreview"
                                         style="height:70px;max-width:200px;object-fit:contain;display:block">
                                </div>
                            @else
                                <div id="logoPlaceholder" style="width:80px;height:80px;background:#eff6ff;border:2px dashed #bfdbfe;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-direction:column;gap:4px">
                                    <i class="fas fa-image" style="color:#93c5fd;font-size:24px"></i>
                                    <span style="font-size:10px;color:#94a3b8">Logo</span>
                                </div>
                                <img src="" id="logoPreview" style="height:70px;max-width:200px;object-fit:contain;display:none;border-radius:8px">
                            @endif
                            <div>
                                <input type="file" name="logo" id="logoInput" class="form-control" accept="image/*" onchange="previewImage(this,'logoPreview','logoPlaceholder')">
                                <div class="form-hint mt-1">Format: JPG, PNG, SVG, WebP. Maks 2MB.<br>Rekomendasi ukuran: 200×60px atau rasio 3:1</div>
                            </div>
                        </div>
                    </div>

                    {{-- Favicon --}}
                    <div class="form-group">
                        <label class="form-label fw-bold">Favicon Website</label>
                        <div class="d-flex align-items-start gap-3 mb-2">
                            @if(!empty($settings['favicon']))
                                <div style="padding:10px;background:#f8fafc;border:1px solid var(--border);border-radius:8px">
                                    <img src="{{ Storage::disk('public')->url($settings['favicon']) }}"
                                         id="faviconPreview"
                                         style="width:48px;height:48px;object-fit:contain;display:block">
                                </div>
                            @else
                                <div id="faviconPlaceholder" style="width:64px;height:64px;background:#fefce8;border:2px dashed #fde68a;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-direction:column;gap:4px">
                                    <i class="fas fa-star" style="color:#fbbf24;font-size:20px"></i>
                                    <span style="font-size:10px;color:#94a3b8">Favicon</span>
                                </div>
                                <img src="" id="faviconPreview" style="width:48px;height:48px;object-fit:contain;display:none;border-radius:4px">
                            @endif
                            <div>
                                <input type="file" name="favicon" id="faviconInput" class="form-control" accept=".ico,.png,.jpg,.jpeg,.svg" onchange="previewImage(this,'faviconPreview','faviconPlaceholder')">
                                <div class="form-hint mt-1">Format: ICO, PNG, SVG. Maks 512KB.<br>Rekomendasi: 32×32px atau 64×64px</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── Pimpinan ── --}}
            <div class="card mb-4">
                <div class="card-header"><h4><i class="fas fa-user-tie me-2" style="color:var(--success)"></i>Sambutan Pimpinan</h4></div>
                <div class="card-body">
                    <div class="form-group"><label class="form-label">Nama Pimpinan</label>
                        <input type="text" name="rector_name" class="form-control" value="{{ $settings['rector_name'] ?? '' }}"></div>
                    <div class="form-group"><label class="form-label">Jabatan / Gelar Pimpinan</label>
                        <input type="text" name="rector_title" class="form-control" value="{{ $settings['rector_title'] ?? '' }}" placeholder="Contoh: Ketua STT, Rektor, Direktur">
                        <div class="form-hint">Ditampilkan di bawah nama pimpinan di halaman beranda.</div></div>
                    <div class="form-group"><label class="form-label">Sambutan / Kata Pimpinan</label>
                        <textarea name="rector_message" class="form-control" rows="4">{{ $settings['rector_message'] ?? '' }}</textarea></div>

                    {{-- Foto Ketua --}}
                    <div class="form-group">
                        <label class="form-label fw-bold">Foto Pimpinan</label>
                        <div class="d-flex align-items-start gap-3 mb-2">
                            @if(!empty($settings['rector_photo']))
                                <div style="padding:6px;background:#f8fafc;border:1px solid var(--border);border-radius:8px">
                                    <img src="{{ Storage::disk('public')->url($settings['rector_photo']) }}"
                                         id="rectorPhotoPreview"
                                         style="width:80px;height:80px;object-fit:cover;border-radius:50%;display:block">
                                </div>
                            @else
                                <div id="rectorPhotoPlaceholder" style="width:80px;height:80px;background:#f0fdf4;border:2px dashed #86efac;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-direction:column;gap:4px;flex-shrink:0">
                                    <i class="fas fa-user" style="color:#4ade80;font-size:28px"></i>
                                </div>
                                <img src="" id="rectorPhotoPreview" style="width:80px;height:80px;object-fit:cover;border-radius:50%;display:none">
                            @endif
                            <div>
                                <input type="file" name="rector_photo" id="rectorPhotoInput" class="form-control" accept="image/*"
                                       onchange="previewImage(this,'rectorPhotoPreview','rectorPhotoPlaceholder')">
                                <div class="form-hint mt-1">Format: JPG, PNG. Maks 2MB.<br>Rekomendasi: foto wajah persegi, min 200×200px</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── Statistik ── --}}
            <div class="card mb-4">
                <div class="card-header"><h4><i class="fas fa-chart-bar me-2" style="color:var(--info)"></i>Statistik Kampus</h4></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4"><div class="form-group"><label class="form-label">Total Mahasiswa</label><input type="number" name="total_students" class="form-control" value="{{ $settings['total_students'] ?? 500 }}"></div></div>
                        <div class="col-md-4"><div class="form-group"><label class="form-label">Total Alumni</label><input type="number" name="total_alumni" class="form-control" value="{{ $settings['total_alumni'] ?? 1000 }}"></div></div>
                        <div class="col-md-4"><div class="form-group"><label class="form-label">Total Dosen</label><input type="number" name="total_lecturers" class="form-control" value="{{ $settings['total_lecturers'] ?? 30 }}"></div></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">

            {{-- ── Kontak ── --}}
            <div class="card mb-4">
                <div class="card-header"><h4><i class="fas fa-address-card me-2" style="color:var(--warning)"></i>Informasi Kontak</h4></div>
                <div class="card-body">
                    <div class="form-group"><label class="form-label">Alamat Lengkap</label><textarea name="address" class="form-control" rows="3">{{ $settings['address'] ?? '' }}</textarea></div>
                    <div class="form-group"><label class="form-label">Nomor Telepon</label><input type="text" name="phone" class="form-control" value="{{ $settings['phone'] ?? '' }}" placeholder="+62618765432"></div>
                    <div class="form-group"><label class="form-label">Email Resmi</label><input type="email" name="email" class="form-control" value="{{ $settings['email'] ?? '' }}" placeholder="info@kampus.ac.id"></div>
                    <div class="form-group">
                        <label class="form-label">WhatsApp</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fab fa-whatsapp text-success"></i></span>
                            <input type="text" name="whatsapp" class="form-control" value="{{ $settings['whatsapp'] ?? '' }}" placeholder="+62812345678">
                        </div>
                        <div class="form-hint">Format: +628xxxxxxxxx (digunakan untuk tombol WhatsApp di website)</div>
                    </div>
                    <div class="form-group"><label class="form-label">Google Maps Embed</label>
                        <textarea name="maps_embed" class="form-control" rows="3" placeholder="Paste iframe embed dari Google Maps...">{{ $settings['maps_embed'] ?? '' }}</textarea>
                        <div class="form-hint">Buka Google Maps → Share → Embed a map → Copy HTML</div>
                    </div>
                </div>
            </div>

            {{-- ── Media Sosial ── --}}
            <div class="card mb-4">
                <div class="card-header"><h4><i class="fas fa-share-alt me-2" style="color:#e1306c"></i>Media Sosial</h4></div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label"><i class="fab fa-facebook me-1" style="color:#1877f2"></i>Facebook URL</label>
                        <input type="url" name="facebook" class="form-control" value="{{ $settings['facebook'] ?? '' }}" placeholder="https://facebook.com/sttsiloammedan">
                    </div>
                    <div class="form-group">
                        <label class="form-label"><i class="fab fa-instagram me-1" style="color:#e1306c"></i>Instagram URL</label>
                        <input type="url" name="instagram" class="form-control" value="{{ $settings['instagram'] ?? '' }}" placeholder="https://instagram.com/sttsiloammedan">
                    </div>
                    <div class="form-group">
                        <label class="form-label"><i class="fab fa-youtube me-1" style="color:#ff0000"></i>YouTube URL</label>
                        <input type="url" name="youtube" class="form-control" value="{{ $settings['youtube'] ?? '' }}" placeholder="https://youtube.com/@sttsiloammedan">
                    </div>
                </div>
            </div>

            {{-- ── Preview Header ── --}}
            <div class="card mb-4">
                <div class="card-header"><h4><i class="fas fa-eye me-2" style="color:var(--primary)"></i>Preview Header Website</h4></div>
                <div class="card-body" style="padding:0">
                    <div style="background:#1e3a8a;padding:12px 20px">
                        <div style="display:flex;align-items:center;gap:12px">
                            @if(!empty($settings['logo']))
                                <img src="{{ Storage::disk('public')->url($settings['logo']) }}"
                                     id="headerLogoPreview"
                                     style="height:44px;max-width:150px;object-fit:contain">
                            @else
                                <div id="headerLogoPreview" style="width:44px;height:44px;background:rgba(255,255,255,0.2);border-radius:50%;display:flex;align-items:center;justify-content:center">
                                    <span style="color:white;font-weight:700;font-size:18px">S</span>
                                </div>
                            @endif
                            <div>
                                <div id="headerNamePreview" style="color:white;font-weight:700;font-size:15px">{{ $settings['app_name'] ?? 'STT Siloam Medan' }}</div>
                                <div id="headerTaglinePreview" style="color:rgba(255,255,255,0.7);font-size:11px">{{ $settings['tagline'] ?? 'Sekolah Tinggi Teologi' }}</div>
                            </div>
                        </div>
                    </div>
                    <div style="padding:8px 20px;background:#f8fafc;font-size:12px;color:#94a3b8;text-align:center">Preview tampilan header website</div>
                </div>
            </div>
        </div>
    </div>

    <div style="position:sticky;bottom:0;background:white;padding:16px 0;border-top:1px solid var(--border);margin-top:8px">
        <button type="submit" class="btn btn-primary btn-lg">
            <i class="fas fa-save me-2"></i>Simpan Semua Pengaturan
        </button>
        <span style="font-size:13px;color:#94a3b8;margin-left:12px">Perubahan akan langsung tampil di website</span>
    </div>
</form>
@endsection

@push('scripts')
<script>
function previewImage(input, previewId, placeholderId) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var preview = document.getElementById(previewId);
            var placeholder = document.getElementById(placeholderId);
            if (preview) { preview.src = e.target.result; preview.style.display = 'block'; }
            if (placeholder) placeholder.style.display = 'none';
            // update header preview for logo
            if (previewId === 'logoPreview') {
                var headerLogo = document.getElementById('headerLogoPreview');
                if (headerLogo && headerLogo.tagName === 'IMG') {
                    headerLogo.src = e.target.result;
                }
            }
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// Live preview: update header name & tagline
document.querySelector('[name="app_name"]').addEventListener('input', function() {
    var el = document.getElementById('headerNamePreview');
    if (el) el.textContent = this.value || 'STT Siloam Medan';
});
document.querySelector('[name="tagline"]').addEventListener('input', function() {
    var el = document.getElementById('headerTaglinePreview');
    if (el) el.textContent = this.value || 'Sekolah Tinggi Teologi';
});
</script>
@endpush
