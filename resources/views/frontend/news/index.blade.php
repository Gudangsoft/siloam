@extends('layouts.frontend')
@section('title', 'Berita & Artikel | STT Siloam Medan')
@section('content')

{{-- Page Header --}}
<div class="bg-blue-900 text-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold">Berita & Artikel</h1>
        <nav class="text-sm mt-2">
            <a href="{{ route('home') }}" class="text-blue-300 hover:text-white">Beranda</a>
            <span class="mx-2 text-blue-400">&#x203A;</span>
            <span class="text-white">Berita & Artikel</span>
        </nav>
    </div>
</div>

<div class="container mx-auto px-4 py-12">
    <div class="flex flex-col lg:flex-row gap-8">

        {{-- Main Content --}}
        <div class="lg:w-2/3">
            {{-- Search & Filter --}}
            <div class="mb-8">
                <form method="GET" action="{{ route('berita.index') }}" class="flex gap-3 flex-wrap">
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Cari berita..."
                           class="flex-1 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 min-w-48">
                    <select name="category" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Kategori</option>
                        <option value="berita" {{ request('category') === 'berita' ? 'selected' : '' }}>Berita</option>
                        <option value="artikel" {{ request('category') === 'artikel' ? 'selected' : '' }}>Artikel</option>
                        <option value="pengumuman" {{ request('category') === 'pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                        <option value="agenda" {{ request('category') === 'agenda' ? 'selected' : '' }}>Agenda</option>
                    </select>
                    <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white px-6 py-2 rounded-lg font-semibold transition">
                        Cari
                    </button>
                    @if(request('search') || request('category'))
                    <a href="{{ route('berita.index') }}" class="border border-gray-300 text-gray-600 hover:bg-gray-100 px-4 py-2 rounded-lg transition">
                        Reset
                    </a>
                    @endif
                </form>
            </div>

            {{-- Category Pills --}}
            <div class="flex flex-wrap gap-3 mb-8">
                <a href="{{ route('berita.index') }}"
                   class="px-4 py-2 rounded-full text-sm font-semibold transition {{ !request('category') ? 'bg-blue-700 text-white' : 'bg-gray-100 text-gray-700 hover:bg-blue-100' }}">
                    Semua
                </a>
                @foreach(['berita' => 'Berita', 'artikel' => 'Artikel', 'pengumuman' => 'Pengumuman', 'agenda' => 'Agenda'] as $val => $label)
                <a href="{{ route('berita.index', ['category' => $val]) }}"
                   class="px-4 py-2 rounded-full text-sm font-semibold transition {{ request('category') === $val ? 'bg-blue-700 text-white' : 'bg-gray-100 text-gray-700 hover:bg-blue-100' }}">
                    {{ $label }}
                </a>
                @endforeach
            </div>

            {{-- News Grid --}}
            @if(isset($news) && $news->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($news as $item)
                <article class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300 flex flex-col">
                    <a href="{{ route('berita.show', $item->slug) }}">
                        @if($item->image)
                        <img loading="lazy" decoding="async" src="{{ $item->image_url }}" alt="{{ $item->title }}" class="w-full h-48 object-cover hover:opacity-90 transition">
                        @else
                        <div class="w-full h-48 bg-gradient-to-br from-blue-600 to-blue-800 flex items-center justify-center">
                            <svg class="w-12 h-12 text-white opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                        </div>
                        @endif
                    </a>
                    <div class="p-5 flex flex-col flex-1">
                        <div class="flex items-center gap-2 mb-2">
                            @if($item->category)
                            <span class="bg-blue-100 text-blue-700 text-xs font-semibold px-2 py-1 rounded-full">{{ ucfirst($item->category) }}</span>
                            @endif
                            <span class="text-gray-400 text-xs">{{ $item->published_at ? $item->published_at->format('d M Y') : $item->created_at->format('d M Y') }}</span>
                        </div>
                        <h2 class="font-bold text-gray-900 text-lg mb-2 leading-snug hover:text-blue-700 flex-1">
                            <a href="{{ route('berita.show', $item->slug) }}">{{ Str::limit($item->title, 70) }}</a>
                        </h2>
                        <p class="text-gray-500 text-sm mb-3">{{ Str::limit(strip_tags($item->content), 100) }}</p>
                        <a href="{{ route('berita.show', $item->slug) }}" class="text-blue-700 font-semibold hover:text-blue-900 text-sm flex items-center gap-1 mt-auto">
                            Baca Selengkapnya
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </article>
                @endforeach
            </div>
            {{-- Pagination --}}
            <div class="mt-8">
                {{ $news->links() }}
            </div>
            @else
            <div class="text-center py-16 bg-white rounded-xl shadow-md">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                <p class="text-gray-500 text-lg">Belum ada berita yang dipublikasikan</p>
            </div>
            @endif
        </div>

        {{-- Sidebar --}}
        <aside class="lg:w-1/3 space-y-8">
            {{-- Featured News --}}
            @if(isset($featured) && $featured->count() > 0)
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-lg font-bold text-blue-900 mb-4 border-b border-gray-200 pb-3">Berita Unggulan</h3>
                <div class="space-y-4">
                    @foreach($featured->take(5) as $item)
                    <div class="flex gap-3">
                        @if($item->image)
                        <img loading="lazy" decoding="async" src="{{ $item->image_url }}" alt="{{ $item->title }}" class="w-20 h-16 object-cover rounded-lg flex-shrink-0">
                        @else
                        <div class="w-20 h-16 bg-blue-100 rounded-lg flex-shrink-0 flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                        </div>
                        @endif
                        <div>
                            <a href="{{ route('berita.show', $item->slug) }}" class="text-sm font-semibold text-gray-800 hover:text-blue-700 leading-snug block">
                                {{ Str::limit($item->title, 60) }}
                            </a>
                            <span class="text-xs text-gray-400">{{ $item->published_at ? $item->published_at->format('d M Y') : $item->created_at->format('d M Y') }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Kategori --}}
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-lg font-bold text-blue-900 mb-4 border-b border-gray-200 pb-3">Kategori</h3>
                <ul class="space-y-2">
                    @foreach(['berita' => 'Berita', 'artikel' => 'Artikel', 'pengumuman' => 'Pengumuman', 'agenda' => 'Agenda'] as $val => $label)
                    <li>
                        <a href="{{ route('berita.index', ['category' => $val]) }}"
                           class="flex items-center justify-between text-gray-700 hover:text-blue-700 hover:bg-blue-50 px-3 py-2 rounded-lg transition">
                            <span>{{ $label }}</span>
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

            {{-- CTA PMB --}}
            <div class="bg-gradient-to-br from-blue-800 to-blue-900 rounded-xl p-6 text-white text-center">
                <h3 class="text-lg font-bold mb-2">Penerimaan Mahasiswa Baru</h3>
                <p class="text-blue-200 text-sm mb-4">Daftarkan diri Anda sekarang dan mulai perjalanan teologi Anda</p>
                <a href="{{ route('pmb.index') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-6 rounded-full transition block text-center">
                    Info PMB
                </a>
            </div>
        </aside>
    </div>
</div>

@endsection
