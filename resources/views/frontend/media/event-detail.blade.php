@extends('layouts.frontend')
@section('title', isset($event) ? $event->title : 'Event')
@section('content')
<div class="bg-blue-900 text-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold">{{ isset($event) ? Str::limit($event->title, 80) : 'Detail Event' }}</h1>
        <nav class="text-sm mt-2">
            <a href="{{ route('home') }}" class="text-blue-300 hover:text-white">Beranda</a>
            <span class="mx-2 text-blue-400">&#x203A;</span>
            <a href="{{ route('media.agenda') }}" class="text-blue-300 hover:text-white">Agenda</a>
            <span class="mx-2 text-blue-400">&#x203A;</span>
            <span class="text-white">Detail</span>
        </nav>
    </div>
</div>
<div class="container mx-auto px-4 py-12">
    <div class="max-w-4xl mx-auto">
        @if(isset($event))
        <div class="bg-white rounded-xl shadow-md overflow-hidden" data-aos="fade-up">
            @if($event->image)
            <img loading="lazy" decoding="async" src="{{ $event->image_url }}" alt="{{ $event->title }}" class="w-full max-h-80 object-cover">
            @endif
            <div class="p-8">
                <h1 class="text-2xl font-bold text-blue-900 mb-4">{{ $event->title }}</h1>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-6 text-sm">
                    @if($event->start_date)
                    <div class="flex gap-2 text-gray-600">
                        <svg class="w-5 h-5 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span>{{ \Carbon\Carbon::parse($event->start_date)->format('d F Y') }}</span>
                    </div>
                    @endif
                    @if($event->location)
                    <div class="flex gap-2 text-gray-600">
                        <svg class="w-5 h-5 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                        <span>{{ $event->location }}</span>
                    </div>
                    @endif
                </div>
                <div class="prose prose-lg max-w-none text-gray-700">
                    {!! clean($event->description) !!}
                </div>
            </div>
        </div>
        <div class="mt-6 text-center">
            <a href="{{ route('media.agenda') }}" class="border-2 border-blue-700 text-blue-700 hover:bg-blue-700 hover:text-white font-bold py-3 px-8 rounded-full transition inline-block">
                Kembali ke Agenda
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
