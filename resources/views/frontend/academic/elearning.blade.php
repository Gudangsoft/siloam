@extends('layouts.frontend')
@section('title', 'E-Learning | STT Siloam Medan')
@section('content')
<div class="bg-blue-900 text-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold">E-Learning</h1>
        <nav class="text-sm mt-2">
            <a href="{{ route('home') }}" class="text-blue-300 hover:text-white">Beranda</a>
            <span class="mx-2 text-blue-400">&#x203A;</span>
            <span class="text-white">E-Learning</span>
        </nav>
    </div>
</div>
<div class="container mx-auto px-4 py-12">
    <div class="max-w-4xl mx-auto">
        @if(isset($page) && $page->content)
        <div class="bg-white rounded-xl shadow-md p-8" data-aos="fade-up">
            <div class="prose max-w-none">{!! clean($page->content) !!}</div>
        </div>
        @else
        <div class="text-center bg-white rounded-xl shadow-md p-12" data-aos="fade-up">
            <div class="bg-blue-100 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-12 h-12 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            </div>
            <h2 class="text-2xl font-bold text-blue-900 mb-3">Portal E-Learning STT Siloam Medan</h2>
            <p class="text-gray-600 mb-6">Akses materi kuliah, tugas, dan berbagai sumber belajar digital melalui portal e-learning kami.</p>
            <a href="#" class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-3 px-8 rounded-full transition inline-block">Akses E-Learning</a>
        </div>
        @endif
    </div>
</div>
@endsection
