@extends('layouts.admin')
@section('title', 'Galeri Foto')
@section('page-title', 'Galeri Foto')
@section('breadcrumb', 'Konten Website')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div></div>
    <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary"><i class="fas fa-plus me-1"></i> Upload Foto</a>
</div>
<div class="card">
    <div class="card-body">
        <div class="row g-3">
            @forelse($gallery as $item)
            <div class="col-md-3 col-6">
                <div class="card h-100" style="border-radius:12px;overflow:hidden">
                    <img src="{{ Storage::disk('public')->url($item->image) }}" style="height:160px;object-fit:cover;width:100%">
                    <div class="card-body p-2">
                        <div style="font-size:13px;font-weight:600">{{ Str::limit($item->title, 30) }}</div>
                        <div style="font-size:12px;color:#94a3b8">{{ $item->category }}</div>
                    </div>
                    <div class="card-footer p-1 d-flex gap-1">
                        <a href="{{ route('admin.gallery.edit', $item) }}" class="btn btn-sm btn-warning flex-fill"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.gallery.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus foto ini?')" class="flex-fill">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" style="width:100%"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5" style="color:#94a3b8">Belum ada foto di galeri</div>
            @endforelse
        </div>
        <div class="mt-3">{{ $gallery->links() }}</div>
    </div>
</div>
@endsection
