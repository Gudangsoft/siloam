@extends('layouts.frontend')
@section('title', 'Organisasi Mahasiswa')
@section('content')
<div class="bg-blue-900 text-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold">Organisasi Mahasiswa</h1>
        <nav class="text-sm mt-2">
            <a href="{{ route('home') }}" class="text-blue-300 hover:text-white">Beranda</a>
            <span class="mx-2 text-blue-400">&#x203A;</span>
            <span class="text-white">Organisasi Mahasiswa</span>
        </nav>
    </div>
</div>
<div class="container mx-auto px-4 py-12">
    @if(isset($organizations) && $organizations->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($organizations as $org)
        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition" data-aos="fade-up">
            @if($org->logo)
            <div class="bg-blue-50 p-6 flex items-center justify-center h-40">
                <img loading="lazy" decoding="async" src="{{ $org->logo_url }}" alt="{{ $org->name }}" class="max-h-28 object-contain">
            </div>
            @else
            <div class="bg-gradient-to-br from-blue-700 to-blue-900 h-32 flex items-center justify-center">
                <svg class="w-16 h-16 text-white opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            </div>
            @endif
            <div class="p-6">
                <h3 class="text-xl font-bold text-blue-900 mb-2">{{ $org->name }}</h3>
                <p class="text-gray-500 text-xs font-semibold uppercase mb-2">{{ $org->acronym ?? '' }}</p>
                @if($org->description)
                <p class="text-gray-600 text-sm">{{ Str::limit($org->description, 120) }}</p>
                @endif
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach(['Badan Eksekutif Mahasiswa (BEM)', 'Persekutuan Mahasiswa Teologi (PMT)', 'Unit Kegiatan Mahasiswa Musik', 'Paduan Suara Mahasiswa'] as $orgname)
        <div class="bg-white rounded-xl shadow-md overflow-hidden" data-aos="fade-up">
            <div class="bg-gradient-to-br from-blue-700 to-blue-900 h-32 flex items-center justify-center">
                <svg class="w-16 h-16 text-white opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <div class="p-6">
                <h3 class="text-lg font-bold text-blue-900">{{ $orgname }}</h3>
                <p class="text-gray-600 text-sm mt-2">Organisasi kemahasiswaan yang aktif dalam kegiatan akademik dan pelayanan.</p>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection
