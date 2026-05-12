@extends('layouts.frontend')
@section('title', 'Perpustakaan')
@section('content')
<div class="bg-blue-900 text-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold">Perpustakaan</h1>
        <nav class="text-sm mt-2">
            <a href="{{ route('home') }}" class="text-blue-300 hover:text-white">Beranda</a>
            <span class="mx-2 text-blue-400">&#x203A;</span>
            <span class="text-white">Perpustakaan</span>
        </nav>
    </div>
</div>
<div class="container mx-auto px-4 py-12">
    <div class="max-w-4xl mx-auto">
        @if(isset($page) && $page->content)
        <div class="bg-white rounded-xl shadow-md p-8" data-aos="fade-up">
            <div class="prose max-w-none">{!! $page->content !!}</div>
        </div>
        @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white rounded-xl shadow-md p-6" data-aos="fade-up">
                <div class="bg-yellow-100 w-14 h-14 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-7 h-7 text-yellow-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
                <h3 class="text-xl font-bold text-blue-900 mb-2">Koleksi Buku</h3>
                <p class="text-gray-600">Ribuan judul buku teologi, alkitab, dan referensi akademik tersedia untuk mahasiswa.</p>
            </div>
            <div class="bg-white rounded-xl shadow-md p-6" data-aos="fade-up">
                <div class="bg-blue-100 w-14 h-14 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-7 h-7 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-blue-900 mb-2">Digital Library</h3>
                <p class="text-gray-600">Akses jurnal ilmiah, e-book, dan sumber digital lainnya secara online kapanpun dan dimanapun.</p>
            </div>
            <div class="bg-white rounded-xl shadow-md p-6" data-aos="fade-up">
                <div class="bg-green-100 w-14 h-14 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-7 h-7 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-blue-900 mb-2">Jam Layanan</h3>
                <p class="text-gray-600">Senin - Jumat: 08.00 - 16.00 WIB<br>Sabtu: 08.00 - 12.00 WIB</p>
            </div>
            <div class="bg-white rounded-xl shadow-md p-6" data-aos="fade-up">
                <div class="bg-purple-100 w-14 h-14 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-7 h-7 text-purple-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-blue-900 mb-2">Ruang Baca</h3>
                <p class="text-gray-600">Ruang baca yang nyaman dan kondusif untuk mendukung kegiatan belajar mandiri mahasiswa.</p>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
