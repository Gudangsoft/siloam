@extends('layouts.frontend')
@section('title', 'Kalender Akademik | STT Siloam Medan')
@section('content')
<div class="bg-blue-900 text-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold">Kalender Akademik</h1>
        <nav class="text-sm mt-2">
            <a href="{{ route('home') }}" class="text-blue-300 hover:text-white">Beranda</a>
            <span class="mx-2 text-blue-400">&#x203A;</span>
            <span class="text-white">Kalender Akademik</span>
        </nav>
    </div>
</div>
<div class="container mx-auto px-4 py-12">
    <div class="max-w-4xl mx-auto">
        @if(isset($calendars) && $calendars->count() > 0)
        @foreach($calendars as $cal)
        <div class="bg-white rounded-xl shadow-md p-6 mb-6" data-aos="fade-up">
            <h2 class="text-xl font-bold text-blue-900 mb-4">{{ $cal->title ?? 'Kalender Akademik' }}</h2>
            @if($cal->content)
            <div class="prose max-w-none">{!! $cal->content !!}</div>
            @endif
        </div>
        @endforeach
        @else
        <div class="bg-white rounded-xl shadow-md p-8" data-aos="fade-up">
            <h2 class="text-2xl font-bold text-blue-900 mb-6">Kalender Akademik {{ date('Y') }}/{{ date('Y') + 1 }}</h2>
            <div class="space-y-4">
                @foreach([
                    ['period' => 'Agustus ' . date('Y'), 'event' => 'Awal Semester Ganjil', 'type' => 'blue'],
                    ['period' => 'Agustus - September ' . date('Y'), 'event' => 'Perkuliahan Minggu 1-4', 'type' => 'green'],
                    ['period' => 'Oktober ' . date('Y'), 'event' => 'Ujian Tengah Semester (UTS)', 'type' => 'yellow'],
                    ['period' => 'Oktober - November ' . date('Y'), 'event' => 'Perkuliahan Minggu 9-14', 'type' => 'green'],
                    ['period' => 'Desember ' . date('Y'), 'event' => 'Ujian Akhir Semester (UAS)', 'type' => 'red'],
                    ['period' => 'Januari ' . (date('Y') + 1), 'event' => 'Libur Semester & Input KRS', 'type' => 'gray'],
                    ['period' => 'Februari ' . (date('Y') + 1), 'event' => 'Awal Semester Genap', 'type' => 'blue'],
                ] as $item)
                <div class="flex gap-4 items-center p-4 rounded-lg bg-gray-50 hover:bg-gray-100 transition">
                    <div class="w-3 h-3 rounded-full bg-{{ $item['type'] }}-500 flex-shrink-0"></div>
                    <div class="flex-1">
                        <p class="font-semibold text-gray-900">{{ $item['event'] }}</p>
                    </div>
                    <div class="text-sm text-gray-500 flex-shrink-0">{{ $item['period'] }}</div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
