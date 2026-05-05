@extends('layouts.frontend')
@section('title', 'Lokasi Kampus | STT Siloam Medan')
@section('content')
<div class="bg-blue-900 text-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold">Lokasi Kampus</h1>
        <nav class="text-sm mt-2">
            <a href="{{ route('home') }}" class="text-blue-300 hover:text-white">Beranda</a>
            <span class="mx-2 text-blue-400">&#x203A;</span>
            <span class="text-white">Lokasi</span>
        </nav>
    </div>
</div>
<div class="container mx-auto px-4 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="space-y-6" data-aos="fade-right">
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold text-blue-900 mb-4">Alamat Kampus</h2>
                <div class="space-y-3 text-gray-700">
                    <p class="flex gap-3"><svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>{{ isset($siteSettings) ? $siteSettings->get('address', 'Jl. Bunga Raya No. 1, Medan, Sumatera Utara 20000') : 'Jl. Bunga Raya No. 1, Medan, Sumatera Utara 20000' }}</p>
                    <p class="flex gap-3"><svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>{{ isset($siteSettings) ? $siteSettings->get('phone', '(061) 8888-1234') : '(061) 8888-1234' }}</p>
                    <p class="flex gap-3"><svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>{{ isset($siteSettings) ? $siteSettings->get('email', 'info@sttsiloammedan.ac.id') : 'info@sttsiloammedan.ac.id' }}</p>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="font-bold text-blue-900 mb-3">Akses Transportasi</h3>
                <ul class="text-gray-600 text-sm space-y-2">
                    <li>&#x2022; 5 menit dari Bandara Kualanamu via tol</li>
                    <li>&#x2022; Tersedia angkutan kota jurusan kampus</li>
                    <li>&#x2022; Parkir luas tersedia di kampus</li>
                </ul>
            </div>
        </div>
        <div class="lg:col-span-2" data-aos="fade-left">
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                @if(isset($siteSettings) && $siteSettings->get('maps_embed'))
                <div class="aspect-video">{!! $siteSettings->get('maps_embed') !!}</div>
                @else
                <div class="aspect-video bg-gray-200 flex items-center justify-center">
                    <div class="text-center text-gray-500">
                        <svg class="w-16 h-16 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
                        <p>Peta belum dikonfigurasi</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
