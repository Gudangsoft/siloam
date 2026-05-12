@extends('layouts.frontend')
@section('title', 'Akreditasi | STT Siloam Medan')
@section('content')
<div class="bg-blue-900 text-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold">Akreditasi</h1>
        <nav class="text-sm mt-2">
            <a href="{{ route('home') }}" class="text-blue-300 hover:text-white">Beranda</a>
            <span class="mx-2 text-blue-400">&#x203A;</span>
            <span class="text-white">Akreditasi</span>
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
        <div class="bg-white rounded-xl shadow-md p-8 text-center" data-aos="fade-up">
            <div class="bg-yellow-100 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-12 h-12 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
            </div>
            <h2 class="text-2xl font-bold text-blue-900 mb-2">Status Akreditasi</h2>
            <p class="text-gray-600 mb-4">STT Siloam Medan telah mendapatkan akreditasi dari lembaga akreditasi nasional</p>
            <span class="bg-yellow-500 text-white font-bold px-6 py-2 rounded-full text-lg inline-block">Terakreditasi</span>
        </div>
        @endif
    </div>
</div>
@endsection
