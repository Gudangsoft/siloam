@extends('layouts.admin')
@section('title', 'Menu Dinamis')
@section('page-title', 'Menu Dinamis')
@section('breadcrumb', 'Admin / Menu Dinamis')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="mb-1 fw-bold">Kelola Menu Navigasi</h5>
        <small class="text-muted">Atur menu yang tampil di navbar dan footer website</small>
    </div>
    <a href="{{ route('admin.menus.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah Menu
    </a>
</div>

{{-- Tab Lokasi --}}
<ul class="nav nav-tabs mb-4" id="menuTab">
    <li class="nav-item">
        <a class="nav-link active" data-bs-toggle="tab" href="#tab-main">
            <i class="fas fa-bars me-1"></i> Navbar Utama
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#tab-footer">
            <i class="fas fa-grip-lines me-1"></i> Footer
        </a>
    </li>
</ul>

<div class="tab-content">
    {{-- MAIN NAV --}}
    <div class="tab-pane fade show active" id="tab-main">
        <div class="card">
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th style="width:40px">#</th>
                            <th>Judul Menu</th>
                            <th>URL</th>
                            <th>Icon</th>
                            <th>Sub-Menu</th>
                            <th>Status</th>
                            <th>Target</th>
                            <th style="width:120px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($menus->where('location','main') as $menu)
                        <tr>
                            <td><span class="text-muted">{{ $menu->order }}</span></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    @if($menu->icon)
                                    <i class="{{ $menu->icon }} text-primary"></i>
                                    @endif
                                    <strong>{{ $menu->title }}</strong>
                                </div>
                            </td>
                            <td><small class="text-muted">{{ $menu->url ?: '—' }}</small></td>
                            <td><small class="font-monospace text-muted">{{ $menu->icon ?: '—' }}</small></td>
                            <td>
                                @if($menu->childrenAll->count() > 0)
                                <span class="badge bg-info">{{ $menu->childrenAll->count() }} sub-menu</span>
                                @else
                                <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input toggle-status" type="checkbox"
                                           data-id="{{ $menu->id }}"
                                           {{ $menu->is_active ? 'checked' : '' }}>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-secondary">{{ $menu->target }}</span>
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('admin.menus.edit', $menu) }}" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST"
                                          onsubmit="return delConfirm(event, this, '{{ addslashes($menu->title) }}')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        {{-- Sub-menu --}}
                        @foreach($menu->childrenAll as $child)
                        <tr class="table-light">
                            <td><span class="text-muted">{{ $child->order }}</span></td>
                            <td>
                                <div class="d-flex align-items-center gap-2 ps-4">
                                    <i class="fas fa-level-up-alt fa-rotate-90 text-muted" style="font-size:10px"></i>
                                    @if($child->icon)<i class="{{ $child->icon }} text-secondary"></i>@endif
                                    <span>{{ $child->title }}</span>
                                </div>
                            </td>
                            <td><small class="text-muted">{{ $child->url ?: '—' }}</small></td>
                            <td><small class="font-monospace text-muted">{{ $child->icon ?: '—' }}</small></td>
                            <td>—</td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input toggle-status" type="checkbox"
                                           data-id="{{ $child->id }}"
                                           {{ $child->is_active ? 'checked' : '' }}>
                                </div>
                            </td>
                            <td><span class="badge bg-secondary">{{ $child->target }}</span></td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('admin.menus.edit', $child) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.menus.destroy', $child) }}" method="POST"
                                          onsubmit="return delConfirm(event, this, '{{ addslashes($child->title) }}')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @endforeach

                        @if($menus->where('location','main')->isEmpty())
                        <tr><td colspan="8" class="text-center text-muted py-4">Belum ada menu. <a href="{{ route('admin.menus.create') }}">Tambah sekarang</a>.</td></tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- FOOTER NAV --}}
    <div class="tab-pane fade" id="tab-footer">
        <div class="card">
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th style="width:40px">#</th>
                            <th>Judul Menu</th>
                            <th>URL</th>
                            <th>Status</th>
                            <th>Target</th>
                            <th style="width:120px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($menus->where('location','footer') as $menu)
                        <tr>
                            <td><span class="text-muted">{{ $menu->order }}</span></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    @if($menu->icon)<i class="{{ $menu->icon }} text-primary"></i>@endif
                                    <strong>{{ $menu->title }}</strong>
                                </div>
                            </td>
                            <td><small class="text-muted">{{ $menu->url ?: '—' }}</small></td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input toggle-status" type="checkbox"
                                           data-id="{{ $menu->id }}"
                                           {{ $menu->is_active ? 'checked' : '' }}>
                                </div>
                            </td>
                            <td><span class="badge bg-secondary">{{ $menu->target }}</span></td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('admin.menus.edit', $menu) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST"
                                          onsubmit="return delConfirm(event, this, '{{ addslashes($menu->title) }}')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @foreach($menu->childrenAll as $child)
                        <tr class="table-light">
                            <td><span class="text-muted">{{ $child->order }}</span></td>
                            <td>
                                <div class="d-flex align-items-center gap-2 ps-4">
                                    <i class="fas fa-level-up-alt fa-rotate-90 text-muted" style="font-size:10px"></i>
                                    {{ $child->title }}
                                </div>
                            </td>
                            <td><small class="text-muted">{{ $child->url ?: '—' }}</small></td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input toggle-status" type="checkbox"
                                           data-id="{{ $child->id }}"
                                           {{ $child->is_active ? 'checked' : '' }}>
                                </div>
                            </td>
                            <td><span class="badge bg-secondary">{{ $child->target }}</span></td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('admin.menus.edit', $child) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.menus.destroy', $child) }}" method="POST"
                                          onsubmit="return delConfirm(event, this, '{{ addslashes($child->title) }}')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @endforeach

                        @if($menus->where('location','footer')->isEmpty())
                        <tr><td colspan="6" class="text-center text-muted py-4">Belum ada menu footer.</td></tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.querySelectorAll('.toggle-status').forEach(function(el) {
    el.addEventListener('change', function() {
        const id = this.dataset.id;
        fetch(`/admin/menus/${id}/toggle`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
            }
        })
        .then(r => r.json())
        .then(data => {
            // update visual feedback
        });
    });
});
</script>
@endpush
