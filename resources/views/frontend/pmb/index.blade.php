@extends('layouts.frontend')
@section('title', 'Penerimaan Mahasiswa Baru | STT Siloam Medan')
@section('content')

{{-- Hero Section --}}
<section class="relative bg-gradient-to-r from-blue-900 to-blue-700 text-white py-24">
    <div class="container mx-auto px-4 text-center">
        <p class="text-yellow-400 font-semibold text-lg uppercase tracking-wider mb-2">Tahun Akademik {{ date('Y') }}/{{ date('Y') + 1 }}</p>
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Penerimaan Mahasiswa Baru</h1>
        <p class="text-xl text-blue-200 max-w-2xl mx-auto mb-8">STT Siloam Medan membuka pendaftaran untuk calon mahasiswa baru. Wujudkan panggilan pelayanan Anda bersama kami.</p>
        <a href="{{ route('pmb.daftar') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-4 px-12 rounded-full text-lg transition duration-300 shadow-xl inline-block">
            Daftar Sekarang
        </a>
    </div>
</section>

{{-- Breadcrumb --}}
<div class="bg-gray-100 py-3">
    <div class="container mx-auto px-4">
        <nav class="text-sm">
            <a href="{{ route('home') }}" class="text-blue-700 hover:text-blue-900">Beranda</a>
            <span class="mx-2 text-gray-400">&#x203A;</span>
            <span class="text-gray-600">PMB</span>
        </nav>
    </div>
</div>

{{-- Jalur Pendaftaran --}}
<section class="py-16 bg-white" data-aos="fade-up">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-blue-900 mb-3">Jalur Pendaftaran</h2>
            <p class="text-gray-600">Pilih jalur pendaftaran yang sesuai dengan Anda</p>
            <div class="w-20 h-1 bg-yellow-500 mx-auto mt-4"></div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white rounded-xl shadow-lg p-8 text-center border-t-4 border-blue-600 hover:shadow-xl transition">
                <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-blue-900 mb-3">Jalur Reguler</h3>
                <p class="text-gray-600 text-sm mb-4">Pendaftaran melalui seleksi administrasi dan wawancara. Terbuka untuk semua calon mahasiswa.</p>
                <ul class="text-left text-sm text-gray-600 space-y-2 mb-6">
                    <li class="flex items-center gap-2"><span class="text-green-500">&#x2713;</span> Seleksi Administrasi</li>
                    <li class="flex items-center gap-2"><span class="text-green-500">&#x2713;</span> Tes Tertulis</li>
                    <li class="flex items-center gap-2"><span class="text-green-500">&#x2713;</span> Wawancara</li>
                </ul>
                <a href="{{ route('pmb.daftar') }}" class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-6 rounded-full transition w-full block">Daftar</a>
            </div>
            <div class="bg-blue-900 rounded-xl shadow-xl p-8 text-center text-white transform scale-105 border-t-4 border-yellow-500 hover:shadow-2xl transition">
                <div class="bg-yellow-500 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                </div>
                <div class="bg-yellow-500 text-white text-xs font-bold px-3 py-1 rounded-full inline-block mb-3">REKOMENDASI</div>
                <h3 class="text-xl font-bold mb-3">Jalur Beasiswa</h3>
                <p class="text-blue-200 text-sm mb-4">Tersedia beasiswa prestasi dan beasiswa pelayanan bagi calon mahasiswa berprestasi.</p>
                <ul class="text-left text-sm text-blue-200 space-y-2 mb-6">
                    <li class="flex items-center gap-2"><span class="text-yellow-400">&#x2713;</span> Beasiswa Penuh</li>
                    <li class="flex items-center gap-2"><span class="text-yellow-400">&#x2713;</span> Beasiswa Parsial</li>
                    <li class="flex items-center gap-2"><span class="text-yellow-400">&#x2713;</span> Beasiswa Pelayanan</li>
                </ul>
                <a href="{{ route('pmb.beasiswa') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-6 rounded-full transition w-full block">Info Beasiswa</a>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-8 text-center border-t-4 border-green-500 hover:shadow-xl transition">
                <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-blue-900 mb-3">Jalur Kerjasama</h3>
                <p class="text-gray-600 text-sm mb-4">Bagi calon mahasiswa yang diutus oleh gereja atau lembaga mitra STT Siloam Medan.</p>
                <ul class="text-left text-sm text-gray-600 space-y-2 mb-6">
                    <li class="flex items-center gap-2"><span class="text-green-500">&#x2713;</span> Rekomendasi Gereja</li>
                    <li class="flex items-center gap-2"><span class="text-green-500">&#x2713;</span> Dukungan Gereja</li>
                    <li class="flex items-center gap-2"><span class="text-green-500">&#x2713;</span> Wawancara Khusus</li>
                </ul>
                <a href="{{ route('kontak.index') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded-full transition w-full block">Hubungi Kami</a>
            </div>
        </div>
    </div>
</section>

{{-- Proses Pendaftaran --}}
<section class="py-16 bg-gray-50" data-aos="fade-up">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-blue-900 mb-3">Proses Pendaftaran</h2>
            <p class="text-gray-600">Langkah mudah untuk bergabung dengan STT Siloam Medan</p>
            <div class="w-20 h-1 bg-yellow-500 mx-auto mt-4"></div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach([
                ['step' => '01', 'title' => 'Isi Formulir', 'desc' => 'Lengkapi formulir pendaftaran online dengan data yang benar dan lengkap', 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
                ['step' => '02', 'title' => 'Upload Dokumen', 'desc' => 'Upload foto terbaru dan dokumen pendukung (ijazah, surat rekomendasi)', 'icon' => 'M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12'],
                ['step' => '03', 'title' => 'Seleksi & Wawancara', 'desc' => 'Ikuti proses seleksi administrasi dan wawancara dengan panitia', 'icon' => 'M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z'],
                ['step' => '04', 'title' => 'Registrasi & Orientasi', 'desc' => 'Lakukan pembayaran dan ikuti program orientasi mahasiswa baru', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
            ] as $step)
            <div class="bg-white rounded-xl shadow-md p-6 text-center relative" data-aos="fade-up">
                <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                    <span class="bg-blue-700 text-white text-lg font-bold w-10 h-10 rounded-full flex items-center justify-center">{{ $step['step'] }}</span>
                </div>
                <div class="pt-6">
                    <div class="bg-blue-50 w-14 h-14 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-7 h-7 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $step['icon'] }}"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-blue-900 mb-2">{{ $step['title'] }}</h3>
                    <p class="text-gray-600 text-sm">{{ $step['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Quick Links --}}
<section class="py-12 bg-white" data-aos="fade-up">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="{{ route('pmb.syarat') }}" class="bg-blue-50 hover:bg-blue-100 rounded-xl p-6 text-center transition group">
                <svg class="w-10 h-10 text-blue-700 mx-auto mb-3 group-hover:scale-110 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                <span class="font-semibold text-blue-900 text-sm">Persyaratan</span>
            </a>
            <a href="{{ route('pmb.biaya') }}" class="bg-green-50 hover:bg-green-100 rounded-xl p-6 text-center transition group">
                <svg class="w-10 h-10 text-green-700 mx-auto mb-3 group-hover:scale-110 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                <span class="font-semibold text-green-900 text-sm">Biaya Pendidikan</span>
            </a>
            <a href="{{ route('pmb.jadwal') }}" class="bg-yellow-50 hover:bg-yellow-100 rounded-xl p-6 text-center transition group">
                <svg class="w-10 h-10 text-yellow-700 mx-auto mb-3 group-hover:scale-110 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <span class="font-semibold text-yellow-900 text-sm">Jadwal PMB</span>
            </a>
            <a href="{{ route('pmb.beasiswa') }}" class="bg-purple-50 hover:bg-purple-100 rounded-xl p-6 text-center transition group">
                <svg class="w-10 h-10 text-purple-700 mx-auto mb-3 group-hover:scale-110 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 7l-9-5 9-5 9 5-9 5z"/></svg>
                <span class="font-semibold text-purple-900 text-sm">Beasiswa</span>
            </a>
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="py-16 bg-blue-900 text-white text-center" data-aos="fade-up">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold mb-4">Siap Mendaftar?</h2>
        <p class="text-blue-200 mb-8 max-w-xl mx-auto">Jangan lewatkan kesempatan untuk bergabung dengan STT Siloam Medan dan memulai perjalanan pelayanan Anda.</p>
        <a href="{{ route('pmb.daftar') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-4 px-12 rounded-full text-lg transition shadow-xl inline-block">
            Daftar Sekarang
        </a>
    </div>
</section>

@endsection
