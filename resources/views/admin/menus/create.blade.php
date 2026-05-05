@extends('layouts.admin')
@section('title', 'Tambah Menu')
@section('page-title', 'Tambah Menu')
@section('breadcrumb', 'Admin / Menu Dinamis / Tambah')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header">
                <h4><i class="fas fa-plus-circle me-2 text-primary"></i>Tambah Menu Baru</h4>
                <a href="{{ route('admin.menus.index') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.menus.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label class="form-label">Judul Menu <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                               value="{{ old('title') }}" placeholder="Contoh: Beranda, Profil, Akademik...">
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">URL / Link</label>
                        <input type="text" name="url" class="form-control @error('url') is-invalid @enderror"
                               value="{{ old('url') }}" placeholder="Contoh: /beranda atau https://example.com">
                        <div class="form-hint">Kosongkan jika menu hanya sebagai grup (dropdown tanpa link)</div>
                        @error('url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Icon (FontAwesome)</label>
                            <div class="input-group">
                                <span class="input-group-text" id="iconPreview"><i class="fas fa-link"></i></span>
                                <input type="text" name="icon" id="iconInput"
                                       class="form-control @error('icon') is-invalid @enderror"
                                       value="{{ old('icon') }}"
                                       placeholder="fas fa-home">
                            </div>
                            <div class="form-hint">Contoh: <code>fas fa-home</code>, <code>fas fa-graduation-cap</code></div>
                            @error('icon')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Urutan</label>
                            <input type="number" name="order" class="form-control" value="{{ old('order', 0) }}" min="0">
                            <div class="form-hint">Angka kecil tampil lebih dulu</div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Lokasi Menu</label>
                            <select name="location" class="form-select @error('location') is-invalid @enderror">
                                <option value="main" {{ old('location')=='main'?'selected':'' }}>Navbar Utama</option>
                                <option value="footer" {{ old('location')=='footer'?'selected':'' }}>Footer</option>
                            </select>
                            @error('location')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Parent Menu</label>
                            <select name="parent_id" class="form-select @error('parent_id') is-invalid @enderror">
                                <option value="">— Menu Utama (tidak ada parent) —</option>
                                @foreach($parents as $parent)
                                <option value="{{ $parent->id }}" {{ old('parent_id')==$parent->id?'selected':'' }}>
                                    {{ $parent->title }}
                                </option>
                                @endforeach
                            </select>
                            <div class="form-hint">Pilih parent jika ini adalah sub-menu</div>
                            @error('parent_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Buka di</label>
                            <select name="target" class="form-select">
                                <option value="_self" {{ old('target','_self')=='_self'?'selected':'' }}>Tab yang sama (_self)</option>
                                <option value="_blank" {{ old('target')=='_blank'?'selected':'' }}>Tab baru (_blank)</option>
                            </select>
                        </div>

                        <div class="form-group d-flex align-items-center gap-3" style="padding-top:30px">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_active"
                                       id="is_active" value="1" {{ old('is_active',1)?'checked':'' }}>
                                <label class="form-check-label" for="is_active">Menu Aktif</label>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-2 justify-content-end mt-3">
                        <a href="{{ route('admin.menus.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Simpan Menu
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Preview icon secara realtime
const iconInput = document.getElementById('iconInput');
const iconPreview = document.getElementById('iconPreview');
iconInput.addEventListener('input', function() {
    iconPreview.innerHTML = `<i class="${this.value || 'fas fa-link'}"></i>`;
});
</script>
@endpush
