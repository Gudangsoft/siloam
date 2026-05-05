@extends('layouts.frontend')
@section('title', 'Agenda & Event | STT Siloam Medan')
@section('content')
<div class="bg-blue-900 text-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold">Agenda & Event</h1>
        <nav class="text-sm mt-2">
            <a href="{{ route('home') }}" class="text-blue-300 hover:text-white">Beranda</a>
            <span class="mx-2 text-blue-400">&#x203A;</span>
            <span class="text-white">Agenda</span>
        </nav>
    </div>
</div>
<div class="container mx-auto px-4 py-12">
    @if(isset($events) && $events->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($events as $event)
        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition flex" data-aos="fade-up">
            <div class="bg-blue-900 text-white p-4 flex flex-col items-center justify-center min-w-20 text-center">
                <span class="text-3xl font-bold">{{ $event->start_date ? \Carbon\Carbon::parse($event->start_date)->format('d') : '--' }}</span>
                <span class="text-xs uppercase text-blue-300">{{ $event->start_date ? \Carbon\Carbon::parse($event->start_date)->format('M Y') : '' }}</span>
            </div>
            <div class="p-5 flex-1">
                <h3 class="font-bold text-gray-900 mb-2">
                    <a href="{{ route('media.agenda.show', $event->slug ?? $event->id) }}" class="hover:text-blue-700">{{ $event->title }}</a>
                </h3>
                @if($event->location)
                <p class="text-gray-500 text-sm flex items-center gap-1 mb-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                    {{ $event->location }}
                </p>
                @endif
                @if($event->description)
                <p class="text-gray-600 text-sm">{{ Str::limit($event->description, 100) }}</p>
                @endif
            </div>
        </div>
        @endforeach
    </div>
    @if(method_exists($events, 'links'))
    <div class="mt-8">{{ $events->links() }}</div>
    @endif
    @else
    <div class="text-center py-16">
        <p class="text-gray-500">Belum ada agenda tersedia.</p>
    </div>
    @endif
</div>
@endsection
