@extends('layouts.frontend')
@section('title', 'Jadwal PMB')
@section('content')
<div class="bg-blue-900 text-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold">Jadwal Penerimaan Mahasiswa Baru</h1>
        <nav class="text-sm mt-2">
            <a href="{{ route('home') }}" class="text-blue-300 hover:text-white">Beranda</a>
            <span class="mx-2 text-blue-400">&#x203A;</span>
            <a href="{{ route('pmb.index') }}" class="text-blue-300 hover:text-white">PMB</a>
            <span class="mx-2 text-blue-400">&#x203A;</span>
            <span class="text-white">Jadwal PMB</span>
        </nav>
    </div>
</div>
<div class="container mx-auto px-4 py-12">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-xl shadow-md p-8" data-aos="fade-up">
            <h2 class="text-2xl font-bold text-blue-900 mb-6">Jadwal PMB Tahun Akademik {{ date('Y') }}/{{ date('Y') + 1 }}</h2>
            <div class="space-y-0">
                @foreach([
                    ['date' => 'Januari - Maret ' . date('Y'), 'event' => 'Pembukaan Pendaftaran Gelombang 1', 'status' => 'open'],
                    ['date' => '15 Maret ' . date('Y'), 'event' => 'Batas Akhir Pendaftaran Gelombang 1', 'status' => 'close'],
                    ['date' => '20 Maret ' . date('Y'), 'event' => 'Pengumuman Hasil Seleksi Gelombang 1', 'status' => 'info'],
                    ['date' => 'April - Juni ' . date('Y'), 'event' => 'Pembukaan Pendaftaran Gelombang 2', 'status' => 'open'],
                    ['date' => '30 Juni ' . date('Y'), 'event' => 'Batas Akhir Pendaftaran Gelombang 2', 'status' => 'close'],
                    ['date' => '10 Juli ' . date('Y'), 'event' => 'Pengumuman Hasil Seleksi Gelombang 2', 'status' => 'info'],
                    ['date' => '1 - 15 Agustus ' . date('Y'), 'event' => 'Registrasi Ulang & Pembayaran', 'status' => 'info'],
                    ['date' => '20 Agustus ' . date('Y'), 'event' => 'Orientasi Mahasiswa Baru (OSMB)', 'status' => 'event'],
                    ['date' => '25 Agustus ' . date('Y'), 'event' => 'Awal Perkuliahan Semester Ganjil', 'status' => 'event'],
                ] as $schedule)
                <div class="flex gap-4 border-b border-gray-100 py-4 last:border-0">
                    <div class="flex flex-col items-center mr-2">
                        <div class="w-4 h-4 rounded-full {{ $schedule['status'] === 'open' ? 'bg-green-500' : ($schedule['status'] === 'close' ? 'bg-red-400' : ($schedule['status'] === 'event' ? 'bg-blue-600' : 'bg-yellow-500')) }} mt-1"></div>
                        <div class="w-0.5 bg-gray-200 flex-1 mt-1"></div>
                    </div>
                    <div class="flex-1 pb-2">
                        <p class="text-sm text-gray-500 mb-0.5">{{ $schedule['date'] }}</p>
                        <p class="font-semibold text-gray-900">{{ $schedule['event'] }}</p>
                    </div>
                    <div class="flex-shrink-0">
                        <span class="text-xs px-2 py-1 rounded-full {{ $schedule['status'] === 'open' ? 'bg-green-100 text-green-700' : ($schedule['status'] === 'close' ? 'bg-red-100 text-red-700' : ($schedule['status'] === 'event' ? 'bg-blue-100 text-blue-700' : 'bg-yellow-100 text-yellow-700')) }}">
                            {{ $schedule['status'] === 'open' ? 'Buka' : ($schedule['status'] === 'close' ? 'Tutup' : ($schedule['status'] === 'event' ? 'Kegiatan' : 'Info')) }}
                        </span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @if(isset($page) && $page?->content)
        <div class="bg-white rounded-xl shadow-md p-8 mt-6 prose prose-blue max-w-none text-gray-700" data-aos="fade-up">
            {!! $page->content !!}
        </div>
        @endif
        <div class="text-center mt-8">
            <a href="{{ route('pmb.daftar') }}" class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-3 px-10 rounded-full transition shadow-lg inline-block">Daftar Sekarang</a>
        </div>
    </div>
</div>
@endsection
