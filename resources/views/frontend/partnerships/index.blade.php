@extends('layouts.frontend')
@section('title', 'Kerjasama')
@section('content')
<div class="bg-blue-900 text-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold">Kerjasama & Kemitraan</h1>
        <nav class="text-sm mt-2">
            <a href="{{ route('home') }}" class="text-blue-300 hover:text-white">Beranda</a>
            <span class="mx-2 text-blue-400">&#x203A;</span>
            <span class="text-white">Kerjasama</span>
        </nav>
    </div>
</div>
<div class="container mx-auto px-4 py-12">
    {{-- Kerjasama Nasional --}}
    <div class="mb-12">
        <div class="flex items-center gap-3 mb-8">
            <h2 class="text-2xl font-bold text-blue-900">Kerjasama Nasional</h2>
            <div class="flex-1 h-px bg-gray-200"></div>
        </div>
        @if(isset($national) && $national->count() > 0)
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
            @foreach($national as $partner)
            <div class="bg-white rounded-xl shadow-md p-4 flex flex-col items-center text-center hover:shadow-xl transition" data-aos="fade-up">
                @if($partner->logo)
                <img loading="lazy" decoding="async" src="{{ $partner->logo_url }}" alt="{{ $partner->name }}" class="max-h-16 object-contain mb-2">
                @else
                <div class="w-14 h-14 rounded-full bg-blue-100 flex items-center justify-center mb-2">
                    <svg class="w-7 h-7 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                </div>
                @endif
                <p class="text-sm font-semibold text-gray-700 text-center">{{ $partner->name }}</p>
            </div>
            @endforeach
        </div>
        @else
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach(['Gereja Siloam Indonesia', 'PERSETIA', 'BAN-PT', 'Kemenag RI'] as $name)
            <div class="bg-white rounded-xl shadow-md p-4 flex flex-col items-center text-center" data-aos="fade-up">
                <div class="w-14 h-14 rounded-full bg-blue-100 flex items-center justify-center mb-2">
                    <svg class="w-7 h-7 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5"/></svg>
                </div>
                <p class="text-sm font-semibold text-gray-700">{{ $name }}</p>
            </div>
            @endforeach
        </div>
        @endif
    </div>
    {{-- Kerjasama Internasional --}}
    <div>
        <div class="flex items-center gap-3 mb-8">
            <h2 class="text-2xl font-bold text-blue-900">Kerjasama Internasional</h2>
            <div class="flex-1 h-px bg-gray-200"></div>
        </div>
        @if(isset($international) && $international->count() > 0)
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
            @foreach($international as $partner)
            <div class="bg-white rounded-xl shadow-md p-4 flex flex-col items-center text-center hover:shadow-xl transition" data-aos="fade-up">
                @if($partner->logo)
                <img loading="lazy" decoding="async" src="{{ $partner->logo_url }}" alt="{{ $partner->name }}" class="max-h-16 object-contain mb-2">
                @else
                <div class="w-14 h-14 rounded-full bg-yellow-100 flex items-center justify-center mb-2">
                    <svg class="w-7 h-7 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                @endif
                <p class="text-sm font-semibold text-gray-700 text-center">{{ $partner->name }}</p>
                @if($partner->country)<p class="text-xs text-gray-400">{{ $partner->country }}</p>@endif
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-8 bg-white rounded-xl shadow-md">
            <p class="text-gray-500">Informasi kerjasama internasional akan segera tersedia.</p>
        </div>
        @endif
    </div>
</div>
@endsection
