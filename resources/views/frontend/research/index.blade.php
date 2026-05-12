@extends('layouts.frontend')
@section('title', 'Penelitian & Pengabdian | STT Siloam Medan')
@section('content')
<div class="bg-blue-900 text-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold">Penelitian & Pengabdian Masyarakat</h1>
        <nav class="text-sm mt-2">
            <a href="{{ route('home') }}" class="text-blue-300 hover:text-white">Beranda</a>
            <span class="mx-2 text-blue-400">&#x203A;</span>
            <span class="text-white">Penelitian</span>
        </nav>
    </div>
</div>
<div class="container mx-auto px-4 py-12">
    {{-- Filter --}}
    <div class="flex gap-3 mb-8 flex-wrap">
        <a href="{{ route('penelitian.index') }}" class="px-4 py-2 rounded-full text-sm font-semibold transition {{ !request('type') ? 'bg-blue-700 text-white' : 'bg-gray-100 text-gray-700 hover:bg-blue-100' }}">Semua</a>
        <a href="{{ route('penelitian.index', ['type' => 'penelitian']) }}" class="px-4 py-2 rounded-full text-sm font-semibold transition {{ request('type') === 'penelitian' ? 'bg-blue-700 text-white' : 'bg-gray-100 text-gray-700 hover:bg-blue-100' }}">Penelitian</a>
        <a href="{{ route('penelitian.index', ['type' => 'pengabdian']) }}" class="px-4 py-2 rounded-full text-sm font-semibold transition {{ request('type') === 'pengabdian' ? 'bg-blue-700 text-white' : 'bg-gray-100 text-gray-700 hover:bg-blue-100' }}">Pengabdian Masyarakat</a>
        <a href="{{ route('penelitian.index', ['type' => 'jurnal']) }}" class="px-4 py-2 rounded-full text-sm font-semibold transition {{ request('type') === 'jurnal' ? 'bg-blue-700 text-white' : 'bg-gray-100 text-gray-700 hover:bg-blue-100' }}">Jurnal</a>
    </div>
    @if(isset($research) && $research->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($research as $item)
        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition" data-aos="fade-up">
            @if($item->image)
            <img loading="lazy" decoding="async" src="{{ $item->image_url }}" alt="{{ $item->title }}" class="w-full h-40 object-cover">
            @else
            <div class="w-full h-40 bg-gradient-to-br from-blue-700 to-blue-900 flex items-center justify-center">
                <svg class="w-12 h-12 text-white opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </div>
            @endif
            <div class="p-5">
                @if($item->type)
                <span class="bg-blue-100 text-blue-700 text-xs font-semibold px-2 py-1 rounded-full">{{ ucfirst($item->type) }}</span>
                @endif
                <h3 class="font-bold text-gray-900 mt-2 mb-2 leading-snug hover:text-blue-700">
                    <a href="{{ route('penelitian.show', $item->slug ?? $item->id) }}">{{ Str::limit($item->title, 70) }}</a>
                </h3>
                @if($item->researcher)
                <p class="text-gray-500 text-xs mb-2">Peneliti: {{ $item->researcher }}</p>
                @endif
                @if($item->year)
                <p class="text-gray-400 text-xs">Tahun: {{ $item->year }}</p>
                @endif
            </div>
        </div>
        @endforeach
    </div>
    @if(method_exists($research, 'links'))
    <div class="mt-8">{{ $research->links() }}</div>
    @endif
    @else
    <div class="text-center py-16 bg-white rounded-xl shadow-md">
        <p class="text-gray-500">Belum ada data penelitian.</p>
    </div>
    @endif
</div>
@endsection
