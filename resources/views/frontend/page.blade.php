@extends('layouts.frontend')
@section('title', $page->meta_title ?: $page->title)
@section('content')
<div class="bg-blue-900 text-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold">{{ $page->title }}</h1>
        <div class="text-blue-200 text-sm mt-2">
            <a href="{{ route('home') }}" class="hover:text-white">Beranda</a>
            <span class="mx-2">/</span>
            <span>{{ $page->title }}</span>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-12 max-w-4xl">
    <div class="bg-white rounded-2xl shadow-sm p-8 md:p-12">
        <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
            {!! $page->content !!}
        </div>
    </div>
</div>
@endsection
