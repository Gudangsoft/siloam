@extends('layouts.frontend')
@section('title', 'Program Studi')
@section('content')
<div class="bg-blue-900 text-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold">Program Studi</h1>
        <nav class="text-sm mt-2">
            <a href="{{ route('home') }}" class="text-blue-300 hover:text-white">Beranda</a>
            <span class="mx-2 text-blue-400">&#x203A;</span>
            <span class="text-white">Program Studi</span>
        </nav>
    </div>
</div>
<div class="container mx-auto px-4 py-12">
    @if(isset($programs) && $programs->count() > 0)
    <div class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 place-content-center justify-items-center">
        @foreach($programs as $program)
        <div class="w-full bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition" data-aos="fade-up">
            @if($program->image)
            <img loading="lazy" decoding="async" src="{{ $program->image_url }}" alt="{{ $program->name }}" class="w-full h-52 object-cover">
            @else
            <div class="w-full h-52 bg-gradient-to-br from-blue-700 to-blue-900 flex items-center justify-center">
                <svg class="w-20 h-20 text-white opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
            </div>
            @endif
            <div class="p-6">
                @if($program->degree)
                <span class="bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-full">{{ $program->degree }}</span>
                @endif
                <h3 class="text-xl font-bold text-blue-900 mt-3 mb-2">{{ $program->name }}</h3>
                <p class="text-gray-600 mb-4">{{ Str::limit($program->description, 150) }}</p>
                @if($program->accreditation)
                <div class="flex items-center gap-2 mb-4">
                    <span class="text-gray-500 text-sm">Akreditasi:</span>
                    <span class="bg-yellow-100 text-yellow-700 font-bold text-sm px-2 py-0.5 rounded">{{ $program->accreditation }}</span>
                </div>
                @endif
                <a href="{{ route('akademik.program-detail', $program->slug) }}" class="bg-blue-700 hover:bg-blue-800 text-white font-semibold py-2 px-6 rounded-full transition text-sm inline-block">
                    Lihat Detail
                </a>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <p class="text-gray-500 text-center py-12">Program studi belum tersedia.</p>
    @endif
</div>
@endsection
