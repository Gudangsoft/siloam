@extends('layouts.frontend')
@section('title', 'Kurikulum | STT Siloam Medan')
@section('content')
<div class="bg-blue-900 text-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold">Kurikulum</h1>
        <nav class="text-sm mt-2">
            <a href="{{ route('home') }}" class="text-blue-300 hover:text-white">Beranda</a>
            <span class="mx-2 text-blue-400">&#x203A;</span>
            <span class="text-white">Kurikulum</span>
        </nav>
    </div>
</div>
<div class="container mx-auto px-4 py-12">
    @if(isset($programs) && $programs->count() > 0)
    <div class="space-y-8">
        @foreach($programs as $program)
        <div class="bg-white rounded-xl shadow-md overflow-hidden" data-aos="fade-up">
            <div class="bg-blue-800 text-white p-4 flex items-center justify-between">
                <h2 class="text-xl font-bold">{{ $program->name }}</h2>
                @if($program->degree)<span class="bg-yellow-500 text-white text-xs font-bold px-3 py-1 rounded-full">{{ $program->degree }}</span>@endif
            </div>
            <div class="p-6">
                @if($program->curriculum)
                <div class="prose max-w-none">{!! $program->curriculum !!}</div>
                @else
                <p class="text-gray-500">Kurikulum program studi ini sedang dalam proses pembaruan.</p>
                @endif
                <a href="{{ route('akademik.program-detail', $program->slug) }}" class="mt-4 text-blue-700 hover:text-blue-900 font-semibold text-sm flex items-center gap-1 inline-flex">
                    Lihat Detail Program
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-12 text-gray-500">Informasi kurikulum akan segera tersedia.</div>
    @endif
</div>
@endsection
