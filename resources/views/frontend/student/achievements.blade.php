@extends('layouts.frontend')
@section('title', 'Prestasi Mahasiswa')
@section('content')
<div class="bg-blue-900 text-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold">Prestasi Mahasiswa</h1>
        <nav class="text-sm mt-2">
            <a href="{{ route('home') }}" class="text-blue-300 hover:text-white">Beranda</a>
            <span class="mx-2 text-blue-400">&#x203A;</span>
            <span class="text-white">Prestasi</span>
        </nav>
    </div>
</div>
<div class="container mx-auto px-4 py-12">
    @if(isset($achievements) && $achievements->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($achievements as $item)
        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-xl transition" data-aos="fade-up">
            <div class="flex items-start gap-4">
                <div class="bg-yellow-100 w-12 h-12 rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                </div>
                <div>
                    <h3 class="font-bold text-gray-900 mb-1">{{ $item->title }}</h3>
                    @if($item->student_name)<p class="text-blue-700 text-sm font-semibold">{{ $item->student_name }}</p>@endif
                    @if($item->event)<p class="text-gray-500 text-sm">{{ $item->event }}</p>@endif
                    @if($item->year)<p class="text-gray-400 text-xs mt-1">{{ $item->year }}</p>@endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-16 bg-white rounded-xl shadow-md">
        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
        <p class="text-gray-500">Data prestasi akan segera tersedia.</p>
    </div>
    @endif
</div>
@endsection
