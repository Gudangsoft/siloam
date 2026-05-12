@extends('layouts.frontend')
@section('title', 'Alumni')
@section('content')
<div class="bg-blue-900 text-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold">Alumni</h1>
        <nav class="text-sm mt-2">
            <a href="{{ route('home') }}" class="text-blue-300 hover:text-white">Beranda</a>
            <span class="mx-2 text-blue-400">&#x203A;</span>
            <span class="text-white">Alumni</span>
        </nav>
    </div>
</div>
<div class="container mx-auto px-4 py-12">
    @if(isset($alumni) && $alumni->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($alumni as $person)
        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-xl transition text-center" data-aos="fade-up">
            @if($person->photo)
            <img loading="lazy" decoding="async" src="{{ $person->photo_url }}" alt="{{ $person->name }}" class="w-20 h-20 rounded-full object-cover mx-auto mb-3 border-2 border-blue-200">
            @else
            <div class="w-20 h-20 rounded-full bg-blue-100 flex items-center justify-center mx-auto mb-3">
                <svg class="w-10 h-10 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            </div>
            @endif
            <h3 class="font-bold text-gray-900 mb-1">{{ $person->name }}</h3>
            @if($person->graduation_year)<p class="text-blue-600 text-sm mb-1">Angkatan {{ $person->graduation_year }}</p>@endif
            @if($person->current_position)<p class="text-gray-500 text-sm">{{ $person->current_position }}</p>@endif
        </div>
        @endforeach
    </div>
    @if(method_exists($alumni, 'links'))<div class="mt-8">{{ $alumni->links() }}</div>@endif
    @else
    <div class="text-center py-16 bg-white rounded-xl shadow-md">
        <p class="text-gray-500">Data alumni akan segera tersedia.</p>
    </div>
    @endif
</div>
@endsection
