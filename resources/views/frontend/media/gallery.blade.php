@extends('layouts.frontend')
@section('title', 'Galeri Foto | STT Siloam Medan')
@section('content')
<div class="bg-blue-900 text-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold">Galeri Foto</h1>
        <nav class="text-sm mt-2">
            <a href="{{ route('home') }}" class="text-blue-300 hover:text-white">Beranda</a>
            <span class="mx-2 text-blue-400">&#x203A;</span>
            <span class="text-white">Galeri</span>
        </nav>
    </div>
</div>
<div class="container mx-auto px-4 py-12">
    @if(isset($gallery) && $gallery->count() > 0)
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        @foreach($gallery as $item)
        <div class="overflow-hidden rounded-xl shadow-md cursor-pointer hover:shadow-xl transition transform hover:scale-105"
             onclick="openLightbox('{{ $item->image_url }}', '{{ addslashes($item->title ?? '') }}')">
            <img src="{{ $item->image_url }}" alt="{{ $item->title ?? 'Galeri' }}" class="w-full h-48 object-cover">
            @if($item->title)
            <div class="p-2 text-center text-sm text-gray-700 bg-white">{{ Str::limit($item->title, 40) }}</div>
            @endif
        </div>
        @endforeach
    </div>
    @if(method_exists($gallery, 'links'))
    <div class="mt-8">{{ $gallery->links() }}</div>
    @endif
    @else
    <div class="text-center py-16">
        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        <p class="text-gray-500">Belum ada foto di galeri.</p>
    </div>
    @endif
</div>

{{-- Lightbox --}}
<div id="lightbox" class="fixed inset-0 bg-black bg-opacity-90 z-50 hidden flex items-center justify-center" onclick="closeLightbox()">
    <button class="absolute top-4 right-4 text-white text-3xl font-bold z-10" onclick="closeLightbox()">&times;</button>
    <div class="max-w-4xl max-h-screen p-4" onclick="event.stopPropagation()">
        <img id="lightbox-img" src="" alt="" class="max-w-full max-h-screen rounded-lg shadow-2xl">
        <p id="lightbox-caption" class="text-white text-center mt-3 text-sm"></p>
    </div>
</div>

@endsection
@push('scripts')
<script>
function openLightbox(src, caption) {
    document.getElementById('lightbox-img').src = src;
    document.getElementById('lightbox-caption').textContent = caption;
    document.getElementById('lightbox').classList.remove('hidden');
    document.getElementById('lightbox').classList.add('flex');
}
function closeLightbox() {
    document.getElementById('lightbox').classList.add('hidden');
    document.getElementById('lightbox').classList.remove('flex');
}
</script>
@endpush
