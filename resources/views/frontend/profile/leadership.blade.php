@extends('layouts.frontend')
@section('title', 'Pimpinan')
@section('content')
<div class="bg-blue-900 text-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold">Pimpinan Kampus</h1>
        <nav class="text-sm mt-2">
            <a href="{{ route('home') }}" class="text-blue-300 hover:text-white">Beranda</a>
            <span class="mx-2 text-blue-400">&#x203A;</span>
            <span class="text-white">Pimpinan</span>
        </nav>
    </div>
</div>
<div class="container mx-auto px-4 py-12">
    @if(isset($leaders) && $leaders->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($leaders as $leader)
        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition text-center" data-aos="fade-up">
            <div class="bg-gradient-to-b from-blue-800 to-blue-900 pt-8 pb-4">
                @if($leader->photo)
                <img loading="lazy" decoding="async" src="{{ $leader->photo_url }}" alt="{{ $leader->name }}" class="w-32 h-32 rounded-full object-cover mx-auto border-4 border-white shadow-lg">
                @else
                <div class="w-32 h-32 rounded-full bg-blue-600 flex items-center justify-center mx-auto border-4 border-white shadow-lg">
                    <svg class="w-16 h-16 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </div>
                @endif
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-blue-900 mb-1">{{ $leader->name }}</h3>
                <p class="text-blue-600 font-semibold text-sm mb-3">{{ $leader->position }}</p>
                @if($leader->bio)
                <p class="text-gray-600 text-sm leading-relaxed">{{ Str::limit($leader->bio, 150) }}</p>
                @endif
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-12 text-gray-500">
        <p>Informasi pimpinan akan segera tersedia.</p>
    </div>
    @endif
</div>
@endsection
