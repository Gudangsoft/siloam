@extends('layouts.admin')
@section('title', 'Halaman Statis')
@section('page-title', 'Kelola Halaman Statis')
@section('breadcrumb', 'Konten Website')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <p class="text-muted mb-0" style="font-size:13px">
            Halaman statis dapat dihubungkan ke menu navigasi.
        </p>
    </div>
    <a href="{{ route('admin.pages.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i> Tambah Halaman
    </a>
</div>

@if(session('success'))
<div class="alert alert-success mb-4">
    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
</div>
@endif

<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th style="width:40px">#</th>
                    <th>Slug</th>
                    <th>Judul</th>
                    <th>URL Publik</th>
                    <th>Update Terakhir</th>
                    <th style="width:140px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pages as $p)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><code>{{ $p->slug }}</code></td>
                    <td>{{ $p->title }}</td>
                    <td>
                        <a href="{{ url('/halaman/' . $p->slug) }}" target="_blank" class="text-muted" style="font-size:12px">
                            <i class="fas fa-external-link-alt me-1"></i>/halaman/{{ $p->slug }}
                        </a>
                    </td>
                    <td>{{ $p->updated_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.pages.edit', $p) }}" class="btn btn-sm btn-warning" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.pages.destroy', $p) }}" method="POST"
                                  onsubmit="return confirm('Hapus halaman &quot;{{ $p->title }}&quot;? Tindakan ini tidak dapat dibatalkan.')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-5 text-muted">
                        <i class="fas fa-file-alt fa-2x mb-2 d-block text-muted opacity-50"></i>
                        Belum ada halaman statis.
                        <a href="{{ route('admin.pages.create') }}">Buat sekarang</a>.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
