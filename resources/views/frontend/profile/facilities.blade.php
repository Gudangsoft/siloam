@extends('layouts.frontend')
@section('title', 'Fasilitas')
@section('content')
<div class="bg-blue-900 text-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold">Fasilitas Kampus</h1>
        <nav class="text-sm mt-2">
            <a href="{{ route('home') }}" class="text-blue-300 hover:text-white">Beranda</a>
            <span class="mx-2 text-blue-400">&#x203A;</span>
            <span class="text-white">Fasilitas</span>
        </nav>
    </div>
</div>
<div class="container mx-auto px-4 py-12">
    @if(isset($facilities) && $facilities->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($facilities as $facility)
        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition" data-aos="fade-up">
            @if($facility->image)
            <img loading="lazy" decoding="async" src="{{ $facility->image_url }}" alt="{{ $facility->name }}" class="w-full h-48 object-cover">
            @else
            <div class="w-full h-48 bg-gradient-to-br from-blue-600 to-blue-800 flex items-center justify-center">
                <svg class="w-16 h-16 text-white opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
            </div>
            @endif
            <div class="p-6">
                <h3 class="text-xl font-bold text-blue-900 mb-2">{{ $facility->name }}</h3>
                @if($facility->description)
                <p class="text-gray-600 text-sm">{{ $facility->description }}</p>
                @endif
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach(['Ruang Kuliah', 'Perpustakaan', 'Kapel', 'Laboratorium Komputer', 'Asrama Mahasiswa', 'Lapangan Olahraga'] as $fac)
        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition" data-aos="fade-up">
            <div class="w-full h-48 bg-gradient-to-br from-blue-600 to-blue-800 flex items-center justify-center">
                <svg class="w-16 h-16 text-white opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-blue-900 mb-2">{{ $fac }}</h3>
                <p class="text-gray-600 text-sm">Fasilitas {{ $fac }} yang modern dan nyaman untuk mendukung proses belajar mengajar.</p>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection
