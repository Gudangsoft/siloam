@extends('layouts.frontend')
@section('title', 'Beasiswa | STT Siloam Medan')
@section('content')
<div class="bg-blue-900 text-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold">Program Beasiswa</h1>
        <nav class="text-sm mt-2">
            <a href="{{ route('home') }}" class="text-blue-300 hover:text-white">Beranda</a>
            <span class="mx-2 text-blue-400">&#x203A;</span>
            <a href="{{ route('pmb.index') }}" class="text-blue-300 hover:text-white">PMB</a>
            <span class="mx-2 text-blue-400">&#x203A;</span>
            <span class="text-white">Beasiswa</span>
        </nav>
    </div>
</div>
<div class="container mx-auto px-4 py-12">
    <div class="text-center mb-10">
        <p class="text-gray-600 max-w-xl mx-auto">STT Siloam Medan menyediakan berbagai program beasiswa untuk mendukung calon mahasiswa yang memiliki panggilan pelayanan namun memiliki keterbatasan biaya.</p>
    </div>
    @if(isset($scholarships) && $scholarships->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($scholarships as $scholarship)
        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition" data-aos="fade-up">
            <div class="bg-gradient-to-r from-blue-700 to-blue-900 p-6 text-white">
                <div class="flex items-center gap-3">
                    <svg class="w-8 h-8 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 7l-9-5 9-5 9 5-9 5z"/></svg>
                    <h3 class="text-xl font-bold">{{ $scholarship->name }}</h3>
                </div>
            </div>
            <div class="p-6">
                <p class="text-gray-600 mb-4">{{ $scholarship->description }}</p>
                @if($scholarship->requirements)
                <div class="mb-4">
                    <p class="font-semibold text-gray-800 mb-2">Persyaratan:</p>
                    <p class="text-gray-600 text-sm">{{ $scholarship->requirements }}</p>
                </div>
                @endif
                @if($scholarship->amount)
                <div class="bg-yellow-50 rounded-lg p-3 flex justify-between items-center">
                    <span class="text-gray-600 text-sm">Nilai Beasiswa:</span>
                    <span class="font-bold text-yellow-700">{{ $scholarship->amount }}</span>
                </div>
                @endif
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @foreach([
            ['name' => 'Beasiswa Prestasi Akademik', 'desc' => 'Diberikan kepada mahasiswa berprestasi dengan IPK tinggi dan aktif dalam kegiatan kampus.', 'amount' => '50% - 100% SPP', 'color' => 'blue'],
            ['name' => 'Beasiswa Pelayanan Gereja', 'desc' => 'Diberikan kepada calon mahasiswa yang diutus secara resmi oleh gereja untuk studi teologi.', 'amount' => '30% - 70% SPP', 'color' => 'green'],
            ['name' => 'Beasiswa Kebutuhan Ekonomi', 'desc' => 'Diberikan kepada mahasiswa yang memiliki keterbatasan ekonomi namun berprestasi dan berkomitmen dalam pelayanan.', 'amount' => 'Hingga 50% SPP', 'color' => 'yellow'],
        ] as $item)
        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition" data-aos="fade-up">
            <div class="bg-{{ $item['color'] }}-700 p-6 text-white">
                <svg class="w-8 h-8 text-{{ $item['color'] }}-200 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 7l-9-5 9-5 9 5-9 5z"/></svg>
                <h3 class="text-xl font-bold">{{ $item['name'] }}</h3>
            </div>
            <div class="p-6">
                <p class="text-gray-600 mb-4">{{ $item['desc'] }}</p>
                <div class="bg-gray-50 rounded-lg p-3 flex justify-between items-center">
                    <span class="text-gray-600 text-sm">Nilai Beasiswa:</span>
                    <span class="font-bold text-{{ $item['color'] }}-700">{{ $item['amount'] }}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
    @if(isset($page) && $page?->content)
    <div class="max-w-3xl mx-auto mt-8">
        <div class="bg-white rounded-xl shadow-md p-8 prose prose-blue max-w-none text-gray-700" data-aos="fade-up">
            {!! $page->content !!}
        </div>
    </div>
    @endif
    <div class="text-center mt-10">
        <a href="{{ route('pmb.daftar') }}" class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-3 px-10 rounded-full transition shadow-lg inline-block">Daftar & Lamar Beasiswa</a>
    </div>
</div>
@endsection
