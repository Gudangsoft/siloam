@extends('layouts.frontend')
@section('title', 'Persyaratan Pendaftaran')
@section('content')
<div class="bg-blue-900 text-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold">Persyaratan Pendaftaran</h1>
        <nav class="text-sm mt-2">
            <a href="{{ route('home') }}" class="text-blue-300 hover:text-white">Beranda</a>
            <span class="mx-2 text-blue-400">&#x203A;</span>
            <a href="{{ route('pmb.index') }}" class="text-blue-300 hover:text-white">PMB</a>
            <span class="mx-2 text-blue-400">&#x203A;</span>
            <span class="text-white">Persyaratan</span>
        </nav>
    </div>
</div>
<div class="container mx-auto px-4 py-12">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-xl shadow-md p-8 mb-6" data-aos="fade-up">
            <h2 class="text-2xl font-bold text-blue-900 mb-6">Persyaratan Umum</h2>
            <ul class="space-y-3 text-gray-700">
                <li class="flex items-start gap-3"><span class="text-blue-600 font-bold mt-0.5">&#x2713;</span><span>Warga Negara Indonesia (WNI)</span></li>
                <li class="flex items-start gap-3"><span class="text-blue-600 font-bold mt-0.5">&#x2713;</span><span>Beragama Kristen (Protestan/Katolik)</span></li>
                <li class="flex items-start gap-3"><span class="text-blue-600 font-bold mt-0.5">&#x2713;</span><span>Memiliki panggilan untuk melayani Tuhan</span></li>
                <li class="flex items-start gap-3"><span class="text-blue-600 font-bold mt-0.5">&#x2713;</span><span>Sehat jasmani dan rohani</span></li>
                <li class="flex items-start gap-3"><span class="text-blue-600 font-bold mt-0.5">&#x2713;</span><span>Berkelakuan baik dan tidak pernah terlibat tindak kriminal</span></li>
            </ul>
        </div>
        <div class="bg-white rounded-xl shadow-md p-8 mb-6" data-aos="fade-up">
            <h2 class="text-2xl font-bold text-blue-900 mb-6">Persyaratan Akademik</h2>
            <ul class="space-y-3 text-gray-700">
                <li class="flex items-start gap-3"><span class="text-green-600 font-bold mt-0.5">&#x2713;</span><span>Lulusan SMA/SMK/MA sederajat untuk program S1</span></li>
                <li class="flex items-start gap-3"><span class="text-green-600 font-bold mt-0.5">&#x2713;</span><span>Lulusan S1 untuk program S2 (Magister Teologi)</span></li>
                <li class="flex items-start gap-3"><span class="text-green-600 font-bold mt-0.5">&#x2713;</span><span>IPK minimal 2.50 untuk pendaftar jalur transfer</span></li>
                <li class="flex items-start gap-3"><span class="text-green-600 font-bold mt-0.5">&#x2713;</span><span>Nilai rata-rata rapor minimal 70 (untuk lulusan SMA)</span></li>
            </ul>
        </div>
        <div class="bg-white rounded-xl shadow-md p-8 mb-6" data-aos="fade-up">
            <h2 class="text-2xl font-bold text-blue-900 mb-6">Dokumen yang Diperlukan</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach([
                    'Fotokopi Ijazah SMA/SMK (dilegalisir)',
                    'Fotokopi Transkrip Nilai/SKHUN (dilegalisir)',
                    'Fotokopi KTP/Kartu Keluarga',
                    'Pas foto 3x4 (4 lembar, background merah)',
                    'Surat Keterangan Sehat dari dokter',
                    'Surat Rekomendasi dari Pendeta/Gembala',
                    'Surat Keterangan Baptis',
                    'Materai 10.000 (2 lembar)',
                ] as $doc)
                <div class="flex items-start gap-3 bg-gray-50 p-3 rounded-lg">
                    <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    <span class="text-gray-700 text-sm">{{ $doc }}</span>
                </div>
                @endforeach
            </div>
        </div>
        {{-- Konten tambahan dari admin --}}
        @if(isset($page) && $page?->content)
        <div class="bg-white rounded-xl shadow-md p-8 mb-6 prose prose-blue max-w-none text-gray-700" data-aos="fade-up">
            {!! $page->content !!}
        </div>
        @endif

        <div class="text-center mt-8">
            <a href="{{ route('pmb.daftar') }}" class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-3 px-10 rounded-full transition shadow-lg inline-block">
                Daftar Sekarang
            </a>
        </div>
    </div>
</div>
@endsection
