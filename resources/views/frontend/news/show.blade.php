@extends('layouts.frontend')
@section('title', isset($news) ? $news->title : 'Berita')
@isset($news)
@section('meta_description', Str::limit(strip_tags($news->content), 160))
@section('og_type', 'article')
@if($news->image)
@section('og_image', Storage::disk('public')->url($news->image))
@endif
@push('jsonld')
@php
$_newsJsonLd = json_encode([
    '@context'      => 'https://schema.org',
    '@type'         => 'NewsArticle',
    'headline'      => $news->title,
    'datePublished' => $news->created_at->toIso8601String(),
    'dateModified'  => $news->updated_at->toIso8601String(),
    'description'   => Str::limit(strip_tags($news->content), 160),
    'publisher'     => ['@type' => 'Organization', 'name' => $siteSettings->get('app_name', 'Kampus')],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
@endphp
<script type="application/ld+json">{!! $_newsJsonLd !!}</script>
@endpush
@endisset
@section('content')

{{-- Page Header --}}
<div class="bg-blue-900 text-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold">{{ isset($news) ? Str::limit($news->title, 80) : 'Berita' }}</h1>
        <nav class="text-sm mt-2">
            <a href="{{ route('home') }}" class="text-blue-300 hover:text-white">Beranda</a>
            <span class="mx-2 text-blue-400">&#x203A;</span>
            <a href="{{ route('berita.index') }}" class="text-blue-300 hover:text-white">Berita</a>
            <span class="mx-2 text-blue-400">&#x203A;</span>
            <span class="text-white">Detail Berita</span>
        </nav>
    </div>
</div>

<div class="container mx-auto px-4 py-12">
    <div class="flex flex-col lg:flex-row gap-8">
        {{-- Main Content --}}
        <div class="lg:w-2/3">
            @if(isset($news))
            <article class="bg-white rounded-xl shadow-md overflow-hidden">
                @if($news->image)
                <img loading="lazy" decoding="async" src="{{ $news->image_url }}" alt="{{ $news->title }}" class="w-full max-h-96 object-cover">
                @endif
                <div class="p-6 md:p-8">
                    <div class="flex flex-wrap items-center gap-3 mb-4">
                        @if($news->category)
                        <span class="bg-blue-100 text-blue-700 text-sm font-semibold px-3 py-1 rounded-full">{{ ucfirst($news->category) }}</span>
                        @endif
                        <span class="text-gray-400 text-sm flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            {{ $news->published_at ? $news->published_at->format('d F Y') : $news->created_at->format('d F Y') }}
                        </span>
                        @if($news->author)
                        <span class="text-gray-400 text-sm flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            {{ $news->author }}
                        </span>
                        @endif
                    </div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-6 leading-tight">{{ $news->title }}</h1>
                    <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                        {!! clean($news->content) !!}
                    </div>

                    {{-- Share Buttons --}}
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <p class="text-gray-600 font-semibold mb-3">Bagikan:</p>
                        <div class="flex gap-3">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank"
                               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition flex items-center gap-2">
                                Facebook
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($news->title) }}" target="_blank"
                               class="bg-sky-500 hover:bg-sky-600 text-white px-4 py-2 rounded-lg text-sm font-semibold transition flex items-center gap-2">
                                Twitter
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($news->title . ' ' . request()->url()) }}" target="_blank"
                               class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-semibold transition flex items-center gap-2">
                                WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
            </article>

            {{-- Related News --}}
            @if(isset($related) && $related->count() > 0)
            <div class="mt-10">
                <h2 class="text-2xl font-bold text-blue-900 mb-6">Berita Terkait</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($related as $item)
                    <article class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300">
                        @if($item->image)
                        <img loading="lazy" decoding="async" src="{{ $item->image_url }}" alt="{{ $item->title }}" class="w-full h-40 object-cover">
                        @else
                        <div class="w-full h-40 bg-gradient-to-br from-blue-600 to-blue-800"></div>
                        @endif
                        <div class="p-4">
                            <h3 class="font-bold text-gray-900 mb-1 hover:text-blue-700">
                                <a href="{{ route('berita.show', $item->slug) }}">{{ Str::limit($item->title, 60) }}</a>
                            </h3>
                            <span class="text-xs text-gray-400">{{ $item->published_at ? $item->published_at->format('d M Y') : $item->created_at->format('d M Y') }}</span>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
            @endif
            @endif
        </div>

        {{-- Sidebar --}}
        <aside class="lg:w-1/3 space-y-8">
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
            <div class="bg-gradient-to-br from-blue-800 to-blue-900 rounded-xl p-6 text-white text-center">
                <h3 class="text-lg font-bold mb-2">Penerimaan Mahasiswa Baru</h3>
                <p class="text-blue-200 text-sm mb-4">Daftarkan diri Anda sekarang</p>
                <a href="{{ route('pmb.index') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-6 rounded-full transition block text-center">
                    Info PMB
                </a>
            </div>
        </aside>
    </div>
</div>

@endsection
