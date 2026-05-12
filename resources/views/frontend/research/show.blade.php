@extends('layouts.frontend')
@section('title', isset($research) ? $research->title . ' | STT Siloam Medan' : 'Penelitian | STT Siloam Medan')
@section('content')
<div class="bg-blue-900 text-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold">{{ isset($research) ? Str::limit($research->title, 80) : 'Detail Penelitian' }}</h1>
        <nav class="text-sm mt-2">
            <a href="{{ route('home') }}" class="text-blue-300 hover:text-white">Beranda</a>
            <span class="mx-2 text-blue-400">&#x203A;</span>
            <a href="{{ route('penelitian.index') }}" class="text-blue-300 hover:text-white">Penelitian</a>
            <span class="mx-2 text-blue-400">&#x203A;</span>
            <span class="text-white">Detail</span>
        </nav>
    </div>
</div>
<div class="container mx-auto px-4 py-12">
    <div class="max-w-4xl mx-auto">
        @if(isset($research))
        <div class="bg-white rounded-xl shadow-md p-8" data-aos="fade-up">
            @if($research->image)
            <img loading="lazy" decoding="async" src="{{ $research->image_url }}" alt="{{ $research->title }}" class="w-full max-h-80 object-cover rounded-lg mb-6">
            @endif
            <div class="flex flex-wrap gap-3 mb-4">
                @if($research->type)
                <span class="bg-blue-100 text-blue-700 text-sm font-semibold px-3 py-1 rounded-full">{{ ucfirst($research->type) }}</span>
                @endif
                @if($research->year)
                <span class="bg-gray-100 text-gray-600 text-sm px-3 py-1 rounded-full">{{ $research->year }}</span>
                @endif
            </div>
            <h1 class="text-2xl font-bold text-blue-900 mb-4">{{ $research->title }}</h1>
            @if($research->researcher)
            <p class="text-gray-600 mb-2"><span class="font-semibold">Peneliti:</span> {{ $research->researcher }}</p>
            @endif
            @if($research->institution)
            <p class="text-gray-600 mb-4"><span class="font-semibold">Lembaga:</span> {{ $research->institution }}</p>
            @endif
            <div class="border-t border-gray-200 pt-6 prose prose-lg max-w-none text-gray-700">
                {!! clean($research->content ?? $research->abstract) !!}
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
