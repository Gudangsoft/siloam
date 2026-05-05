@extends('layouts.admin')
@section('title', 'Edit Menu')
@section('page-title', 'Edit Menu')
@section('breadcrumb', 'Admin / Menu Dinamis / Edit')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header">
                <h4><i class="fas fa-edit me-2 text-warning"></i>Edit Menu: {{ $menu->title }}</h4>
                <a href="{{ route('admin.menus.index') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.menus.update', $menu) }}" method="POST">
                    @csrf @method('PUT')

                    <div class="form-group">
                        <label class="form-label">Judul Menu <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                               value="{{ old('title', $menu->title) }}" placeholder="Contoh: Beranda, Profil, Akademik...">
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">URL / Link</label>
                        <input type="text" name="url" class="form-control @error('url') is-invalid @enderror"
                               value="{{ old('url', $menu->url) }}" placeholder="Contoh: /beranda atau https://example.com">
                        <div class="form-hint">Kosongkan jika menu hanya sebagai grup (dropdown tanpa link)</div>
                        @error('url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Icon (FontAwesome)</label>
                            <div class="input-group">
                                <span class="input-group-text" id="iconPreview">
                                    <i class="{{ old('icon', $menu->icon) ?: 'fas fa-link' }}"></i>
                                </span>
                                <input type="text" name="icon" id="iconInput"
                                       class="form-control @error('icon') is-invalid @enderror"
                                       value="{{ old('icon', $menu->icon) }}"
                                       placeholder="fas fa-home">
                            </div>
                            <div class="form-hint">Contoh: <code>fas fa-home</code>, <code>fas fa-graduation-cap</code></div>
                            @error('icon')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Urutan</label>
                            <input type="number" name="order" class="form-control"
                                   value="{{ old('order', $menu->order) }}" min="0">
                            <div class="form-hint">Angka kecil tampil lebih dulu</div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Lokasi Menu</label>
                            <select name="location" class="form-select @error('location') is-invalid @enderror">
                                <option value="main"   {{ old('location', $menu->location)=='main'  ?'selected':'' }}>Navbar Utama</option>
                                <option value="footer" {{ old('location', $menu->location)=='footer'?'selected':'' }}>Footer</option>
                            </select>
                            @error('location')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Parent Menu</label>
                            <select name="parent_id" class="form-select @error('parent_id') is-invalid @enderror">
                                <option value="">— Menu Utama (tidak ada parent) —</option>
                                @foreach($parents as $parent)
                                <option value="{{ $parent->id }}"
                                    {{ old('parent_id', $menu->parent_id) == $parent->id ? 'selected' : '' }}>
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
                                <option value="_self"  {{ old('target', $menu->target)=='_self' ?'selected':'' }}>Tab yang sama (_self)</option>
                                <option value="_blank" {{ old('target', $menu->target)=='_blank'?'selected':'' }}>Tab baru (_blank)</option>
                            </select>
                        </div>

                        <div class="form-group d-flex align-items-center gap-3" style="padding-top:30px">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_active"
                                       id="is_active" value="1"
                                       {{ old('is_active', $menu->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">Menu Aktif</label>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-2 justify-content-end mt-3">
                        <a href="{{ route('admin.menus.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-save me-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Info sub-menu --}}
        @if($menu->childrenAll->count() > 0)
        <div class="card mt-4">
            <div class="card-header">
                <h4><i class="fas fa-sitemap me-2"></i>Sub-Menu ({{ $menu->childrenAll->count() }})</h4>
                <a href="{{ route('admin.menus.create') }}?parent={{ $menu->id }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Tambah Sub-Menu
                </a>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>URL</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($menu->childrenAll as $child)
                        <tr>
                            <td>{{ $child->title }}</td>
                            <td><small class="text-muted">{{ $child->url ?: '—' }}</small></td>
                            <td>
                                <span class="badge {{ $child->is_active ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $child->is_active ? 'Aktif' : 'Nonaktif' }}
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
    </div>
</div>
@endsection

@push('scripts')
<script>
const iconInput = document.getElementById('iconInput');
const iconPreview = document.getElementById('iconPreview');
iconInput.addEventListener('input', function() {
    iconPreview.innerHTML = `<i class="${this.value || 'fas fa-link'}"></i>`;
});
</script>
@endpush
