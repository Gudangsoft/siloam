@extends('layouts.frontend')
@section('title', 'Video | STT Siloam Medan')
@section('content')
<div class="bg-blue-900 text-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold">Video</h1>
        <nav class="text-sm mt-2">
            <a href="{{ route('home') }}" class="text-blue-300 hover:text-white">Beranda</a>
            <span class="mx-2 text-blue-400">&#x203A;</span>
            <span class="text-white">Video</span>
        </nav>
    </div>
</div>
<div class="container mx-auto px-4 py-12">
    @if(isset($videos) && $videos->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($videos as $video)
        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition" data-aos="fade-up">
            <div class="aspect-video bg-gray-900">
                @if($video->youtube_id)
                <iframe src="https://www.youtube.com/embed/{{ $video->youtube_id }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class="w-full h-full"></iframe>
                @elseif($video->embed_url)
                <iframe src="{{ $video->embed_url }}" frameborder="0" allowfullscreen class="w-full h-full"></iframe>
                @else
                <div class="w-full h-full flex items-center justify-center">
                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                @endif
            </div>
            <div class="p-4">
                <h3 class="font-bold text-gray-900 mb-1">{{ $video->title }}</h3>
                @if($video->description)
                <p class="text-gray-500 text-sm">{{ Str::limit($video->description, 100) }}</p>
                @endif
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-16">
        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <p class="text-gray-500">Belum ada video tersedia.</p>
    </div>
    @endif
</div>
@endsection
