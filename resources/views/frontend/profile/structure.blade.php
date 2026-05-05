@extends('layouts.frontend')
@section('title', 'Struktur Organisasi | STT Siloam Medan')
@section('content')
<div class="bg-blue-900 text-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold">Struktur Organisasi</h1>
        <nav class="text-sm mt-2">
            <a href="{{ route('home') }}" class="text-blue-300 hover:text-white">Beranda</a>
            <span class="mx-2 text-blue-400">&#x203A;</span>
            <span class="text-white">Struktur Organisasi</span>
        </nav>
    </div>
</div>
<div class="container mx-auto px-4 py-12">
    <div class="max-w-4xl mx-auto">
        @if(isset($page))
        <div class="bg-white rounded-xl shadow-md p-8" data-aos="fade-up">
            <div class="prose max-w-none">{!! $page->content !!}</div>
        </div>
        @else
        <div class="bg-white rounded-xl shadow-md p-8" data-aos="fade-up">
            <p class="text-gray-600 text-center py-8">Informasi struktur organisasi akan segera tersedia.</p>
        </div>
        @endif
    </div>
</div>
@endsection
