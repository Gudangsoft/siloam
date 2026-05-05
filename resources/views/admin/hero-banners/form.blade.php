@extends('layouts.admin')
@section('title', isset($banner) ? 'Edit Banner' : 'Tambah Banner')
@section('page-title', isset($banner) ? 'Edit Hero Banner' : 'Tambah Hero Banner')
@section('breadcrumb', 'Hero Banner')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div></div>
    <a href="{{ route('admin.hero-banners.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
</div>
<div class="card">
    <div class="card-body">
        <form action="{{ isset($banner) ? route('admin.hero-banners.update', $banner) : route('admin.hero-banners.store') }}" method="POST" enctype="multipart/form-data">
            @csrf @if(isset($banner)) @method('PUT') @endif
            @if($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif
            <div class="row">
                <div class="col-md-8">

                    {{-- Mode tampilan --}}
                    <div class="form-group">
                        <label class="form-label fw-bold">Mode Tampilan Banner</label>
                        <div class="d-flex gap-3">
                            <label style="flex:1;cursor:pointer">
                                <input type="radio" name="show_text" value="1"
                                       {{ old('show_text', ($banner->show_text ?? true) ? '1' : '0') != '0' ? 'checked' : '' }}
                                       onchange="toggleTextFields(true)" style="display:none">
                                <div class="mode-card" id="modeTextCard" style="border:2px solid;border-radius:10px;padding:14px;text-align:center;transition:all .2s">
                                    <i class="fas fa-align-left fa-2x mb-2"></i>
                                    <div class="fw-bold">Gambar + Teks</div>
                                    <div style="font-size:12px;color:#94a3b8">Tampilkan judul, subtitle & tombol di atas gambar</div>
                                </div>
                            </label>
                            <label style="flex:1;cursor:pointer">
                                <input type="radio" name="show_text" value="0"
                                       {{ old('show_text', ($banner->show_text ?? true) ? '1' : '0') == '0' ? 'checked' : '' }}
                                       onchange="toggleTextFields(false)" style="display:none">
                                <div class="mode-card" id="modeImageCard" style="border:2px solid;border-radius:10px;padding:14px;text-align:center;transition:all .2s">
                                    <i class="fas fa-image fa-2x mb-2"></i>
                                    <div class="fw-bold">Gambar Saja</div>
                                    <div style="font-size:12px;color:#94a3b8">Hanya tampilkan gambar tanpa teks overlay</div>
                                </div>
                            </label>
                        </div>
                    </div>

                    {{-- Text fields (hidden when image-only mode) --}}
                    <div id="textFields">
                        <div class="form-group"><label class="form-label">Judul <span class="text-danger">*</span></label><input type="text" name="title" class="form-control" value="{{ old('title', $banner->title ?? '') }}"></div>
                        <div class="form-group"><label class="form-label">Subtitle</label><input type="text" name="subtitle" class="form-control" value="{{ old('subtitle', $banner->subtitle ?? '') }}"></div>
                        <div class="form-group"><label class="form-label">Deskripsi</label><textarea name="description" class="form-control" rows="3">{{ old('description', $banner->description ?? '') }}</textarea></div>
                        <div class="row">
                            <div class="col-md-6"><div class="form-group"><label class="form-label">Teks Tombol 1</label><input type="text" name="button_text" class="form-control" value="{{ old('button_text', $banner->button_text ?? '') }}"></div></div>
                            <div class="col-md-6"><div class="form-group"><label class="form-label">Link Tombol 1</label><input type="text" name="button_link" class="form-control" value="{{ old('button_link', $banner->button_link ?? '') }}"></div></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6"><div class="form-group"><label class="form-label">Teks Tombol 2</label><input type="text" name="button_text_2" class="form-control" value="{{ old('button_text_2', $banner->button_text_2 ?? '') }}"></div></div>
                            <div class="col-md-6"><div class="form-group"><label class="form-label">Link Tombol 2</label><input type="text" name="button_link_2" class="form-control" value="{{ old('button_link_2', $banner->button_link_2 ?? '') }}"></div></div>
                        </div>
                    </div>
                    {{-- Hidden title when image-only --}}
                    <div id="titleHidden" style="display:none">
                        <input type="hidden" name="title" value="{{ old('title', $banner->title ?? 'Banner') }}">
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="form-group"><label class="form-label">Gambar Banner</label>
                        @if(isset($banner) && $banner->image)
                            <div class="mb-2"><img src="{{ Storage::disk('public')->url($banner->image) }}" style="max-width:100%;border-radius:6px" id="imgPreview"></div>
                        @else
                            <img src="" id="imgPreview" style="max-width:100%;border-radius:6px;display:none;margin-bottom:8px">
                        @endif
                        <input type="file" name="image" class="form-control" accept="image/*"
                               onchange="previewBanner(this)">
                        <div class="form-hint">Ukuran ideal: 1920×600px, Maks 4MB</div>
                    </div>
                    <div class="form-group"><label class="form-label">Urutan Tampil</label><input type="number" name="order" class="form-control" value="{{ old('order', $banner->order ?? 0) }}"></div>
                    <div class="form-check mb-3">
                        <input type="checkbox" name="is_active" value="1" id="isActive"
                               {{ old('is_active', $banner->is_active ?? true) ? 'checked' : '' }}>
                        <label for="isActive">Aktifkan Banner</label>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width:100%"><i class="fas fa-save me-1"></i> Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
const showText = {{ old('show_text', ($banner->show_text ?? true) ? '1' : '0') != '0' ? 'true' : 'false' }};

function toggleTextFields(hasText) {
    document.getElementById('textFields').style.display = hasText ? '' : 'none';
    document.getElementById('titleHidden').style.display = hasText ? 'none' : '';

    const textCard  = document.getElementById('modeTextCard');
    const imageCard = document.getElementById('modeImageCard');
    if (hasText) {
        textCard.style.borderColor  = 'var(--primary)';
        textCard.style.background   = '#eff6ff';
        textCard.style.color        = 'var(--primary)';
        imageCard.style.borderColor = 'var(--border)';
        imageCard.style.background  = '';
        imageCard.style.color       = '';
    } else {
        imageCard.style.borderColor = 'var(--primary)';
        imageCard.style.background  = '#eff6ff';
        imageCard.style.color       = 'var(--primary)';
        textCard.style.borderColor  = 'var(--border)';
        textCard.style.background   = '';
        textCard.style.color        = '';
    }
}

function previewBanner(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var img = document.getElementById('imgPreview');
            img.src = e.target.result;
            img.style.display = 'block';
            img.style.marginBottom = '8px';
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// Init on load
toggleTextFields(showText);
</script>
@endpush
