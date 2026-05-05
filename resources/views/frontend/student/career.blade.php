@extends('layouts.frontend')
@section('title', 'Karir & Tracer Study | STT Siloam Medan')
@section('content')
<div class="bg-blue-900 text-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold">Karir & Tracer Study</h1>
        <nav class="text-sm mt-2">
            <a href="{{ route('home') }}" class="text-blue-300 hover:text-white">Beranda</a>
            <span class="mx-2 text-blue-400">&#x203A;</span>
            <span class="text-white">Karir & Tracer Study</span>
        </nav>
    </div>
</div>
<div class="container mx-auto px-4 py-12">
    <div class="max-w-4xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
            <div class="bg-white rounded-xl shadow-md p-6" data-aos="fade-up">
                <div class="bg-blue-100 w-14 h-14 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-7 h-7 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-blue-900 mb-2">Bursa Kerja</h3>
                <p class="text-gray-600 mb-4">Temukan berbagai lowongan pekerjaan dan pelayanan dari gereja-gereja dan lembaga mitra kami.</p>
                <a href="#" class="text-blue-700 hover:text-blue-900 font-semibold text-sm flex items-center gap-1">
                    Lihat Lowongan
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
            <div class="bg-white rounded-xl shadow-md p-6" data-aos="fade-up">
                <div class="bg-green-100 w-14 h-14 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-7 h-7 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-blue-900 mb-2">Tracer Study</h3>
                <p class="text-gray-600 mb-4">Bantu kami meningkatkan kualitas pendidikan dengan mengisi survei penelusuran alumni kami.</p>
                <a href="#" class="text-blue-700 hover:text-blue-900 font-semibold text-sm flex items-center gap-1">
                    Isi Tracer Study
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>
        <div class="bg-gradient-to-r from-blue-800 to-blue-900 rounded-xl p-8 text-white text-center" data-aos="fade-up">
            <h2 class="text-2xl font-bold mb-3">Prospek Karir Alumni STT Siloam Medan</h2>
            <p class="text-blue-200 mb-6">Alumni kami tersebar di berbagai bidang pelayanan dan profesi</p>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
                @foreach(['Pendeta/Gembala', 'Guru/Dosen', 'Misionaris', 'Konselor'] as $career_item)
                <div class="bg-blue-700 rounded-lg p-3">
                    <p class="font-semibold text-sm">{{ $career_item }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
