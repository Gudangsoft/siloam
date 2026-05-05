@extends('layouts.frontend')
@section('title', 'Layanan Mahasiswa | STT Siloam Medan')
@section('content')
<div class="bg-blue-900 text-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold">Layanan Mahasiswa</h1>
        <nav class="text-sm mt-2">
            <a href="{{ route('home') }}" class="text-blue-300 hover:text-white">Beranda</a>
            <span class="mx-2 text-blue-400">&#x203A;</span>
            <span class="text-white">Layanan Mahasiswa</span>
        </nav>
    </div>
</div>
<div class="container mx-auto px-4 py-12">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach([
            ['icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z', 'title' => 'Administrasi Akademik', 'desc' => 'Pengurusan KRS, transkrip nilai, surat keterangan mahasiswa, dan dokumen akademik lainnya.', 'color' => 'blue'],
            ['icon' => 'M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z', 'title' => 'Keuangan & Beasiswa', 'desc' => 'Informasi dan proses pembayaran SPP, pendaftaran beasiswa, dan keringanan biaya.', 'color' => 'green'],
            ['icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z', 'title' => 'Kemahasiswaan', 'desc' => 'Informasi kegiatan mahasiswa, organisasi, dan pengembangan softskill mahasiswa.', 'color' => 'yellow'],
            ['icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z', 'title' => 'Konseling & Bimbingan', 'desc' => 'Layanan konseling akademik, spiritual, dan personal untuk mendukung kesejahteraan mahasiswa.', 'color' => 'red'],
            ['icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6', 'title' => 'Asrama', 'desc' => 'Informasi dan pendaftaran asrama putra/putri yang nyaman dan aman di lingkungan kampus.', 'color' => 'purple'],
            ['icon' => 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'title' => 'Karir & Alumni', 'desc' => 'Layanan bimbingan karir, job fair, dan jaringan alumni untuk mendukung penempatan kerja.', 'color' => 'indigo'],
        ] as $service)
        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-xl transition" data-aos="fade-up">
            <div class="bg-{{ $service['color'] }}-100 w-14 h-14 rounded-full flex items-center justify-center mb-4">
                <svg class="w-7 h-7 text-{{ $service['color'] }}-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $service['icon'] }}"/>
                </svg>
            </div>
            <h3 class="text-lg font-bold text-blue-900 mb-2">{{ $service['title'] }}</h3>
            <p class="text-gray-600 text-sm">{{ $service['desc'] }}</p>
        </div>
        @endforeach
    </div>
</div>
@endsection
