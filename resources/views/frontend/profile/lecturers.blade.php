@extends('layouts.frontend')
@section('title', 'Dosen & Tenaga Kependidikan | STT Siloam Medan')
@section('content')
<div class="bg-blue-900 text-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold">Dosen & Tenaga Kependidikan</h1>
        <nav class="text-sm mt-2">
            <a href="{{ route('home') }}" class="text-blue-300 hover:text-white">Beranda</a>
            <span class="mx-2 text-blue-400">&#x203A;</span>
            <span class="text-white">Dosen & Tendik</span>
        </nav>
    </div>
</div>
<div class="container mx-auto px-4 py-12">
    {{-- Dosen --}}
    <div class="mb-12">
        <div class="flex items-center gap-3 mb-8">
            <h2 class="text-2xl font-bold text-blue-900">Dosen Tetap</h2>
            <div class="flex-1 h-px bg-gray-200"></div>
        </div>
        @if(isset($lecturers) && $lecturers->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($lecturers as $lecturer)
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition text-center" data-aos="fade-up">
                <div class="bg-gradient-to-b from-blue-700 to-blue-900 pt-6 pb-3">
                    @if($lecturer->photo)
                    <img src="{{ $lecturer->photo_url }}" alt="{{ $lecturer->name }}" class="w-24 h-24 rounded-full object-cover mx-auto border-4 border-white shadow-md">
                    @else
                    <div class="w-24 h-24 rounded-full bg-blue-500 flex items-center justify-center mx-auto border-4 border-white shadow-md">
                        <svg class="w-12 h-12 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    @endif
                </div>
                <div class="p-4">
                    <h3 class="font-bold text-gray-900 text-sm mb-1">{{ $lecturer->name }}</h3>
                    @if($lecturer->degree)
                    <p class="text-blue-600 text-xs mb-1">{{ $lecturer->degree }}</p>
                    @endif
                    @if($lecturer->expertise)
                    <p class="text-gray-500 text-xs">{{ $lecturer->expertise }}</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @else
        <p class="text-gray-500 text-center py-6">Informasi dosen akan segera tersedia.</p>
        @endif
    </div>
    {{-- Tenaga Kependidikan --}}
    @if(isset($tendik) && $tendik->count() > 0)
    <div>
        <div class="flex items-center gap-3 mb-8">
            <h2 class="text-2xl font-bold text-blue-900">Tenaga Kependidikan</h2>
            <div class="flex-1 h-px bg-gray-200"></div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($tendik as $staff)
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition text-center" data-aos="fade-up">
                <div class="bg-gradient-to-b from-gray-600 to-gray-800 pt-6 pb-3">
                    @if($staff->photo)
                    <img src="{{ $staff->photo_url }}" alt="{{ $staff->name }}" class="w-24 h-24 rounded-full object-cover mx-auto border-4 border-white shadow-md">
                    @else
                    <div class="w-24 h-24 rounded-full bg-gray-500 flex items-center justify-center mx-auto border-4 border-white shadow-md">
                        <svg class="w-12 h-12 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    @endif
                </div>
                <div class="p-4">
                    <h3 class="font-bold text-gray-900 text-sm mb-1">{{ $staff->name }}</h3>
                    @if($staff->position)
                    <p class="text-gray-600 text-xs">{{ $staff->position }}</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
