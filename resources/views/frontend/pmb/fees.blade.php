@extends('layouts.frontend')
@section('title', 'Biaya Pendidikan | STT Siloam Medan')
@section('content')
<div class="bg-blue-900 text-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold">Biaya Pendidikan</h1>
        <nav class="text-sm mt-2">
            <a href="{{ route('home') }}" class="text-blue-300 hover:text-white">Beranda</a>
            <span class="mx-2 text-blue-400">&#x203A;</span>
            <a href="{{ route('pmb.index') }}" class="text-blue-300 hover:text-white">PMB</a>
            <span class="mx-2 text-blue-400">&#x203A;</span>
            <span class="text-white">Biaya Pendidikan</span>
        </nav>
    </div>
</div>
<div class="container mx-auto px-4 py-12">
    <div class="max-w-4xl mx-auto">
        <div class="text-center mb-10">
            <p class="text-gray-600">Informasi biaya pendidikan di STT Siloam Medan untuk Tahun Akademik {{ date('Y') }}/{{ date('Y') + 1 }}</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8" data-aos="fade-up">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-blue-700 p-4 text-white text-center">
                    <h3 class="text-xl font-bold">Biaya Pendaftaran</h3>
                </div>
                <div class="p-6">
                    <table class="w-full text-sm">
                        <tbody>
                            <tr class="border-b"><td class="py-3 text-gray-600">Formulir Pendaftaran</td><td class="py-3 text-right font-semibold">Rp 150.000</td></tr>
                            <tr class="border-b"><td class="py-3 text-gray-600">Biaya Seleksi</td><td class="py-3 text-right font-semibold">Rp 200.000</td></tr>
                            <tr class="bg-blue-50"><td class="py-3 font-bold text-blue-900">Total</td><td class="py-3 text-right font-bold text-blue-900">Rp 350.000</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-yellow-500 p-4 text-white text-center">
                    <h3 class="text-xl font-bold">Biaya Masuk (Sekali Bayar)</h3>
                </div>
                <div class="p-6">
                    <table class="w-full text-sm">
                        <tbody>
                            <tr class="border-b"><td class="py-3 text-gray-600">Uang Gedung</td><td class="py-3 text-right font-semibold">Rp 2.000.000</td></tr>
                            <tr class="border-b"><td class="py-3 text-gray-600">Biaya Orientasi</td><td class="py-3 text-right font-semibold">Rp 500.000</td></tr>
                            <tr class="border-b"><td class="py-3 text-gray-600">Almamater & Atribut</td><td class="py-3 text-right font-semibold">Rp 300.000</td></tr>
                            <tr class="bg-yellow-50"><td class="py-3 font-bold text-yellow-900">Total</td><td class="py-3 text-right font-bold text-yellow-900">Rp 2.800.000</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8" data-aos="fade-up">
            <div class="bg-blue-900 p-4 text-white text-center">
                <h3 class="text-xl font-bold">Biaya Per Semester</h3>
            </div>
            <div class="p-6 overflow-x-auto">
                <table class="w-full text-sm">
                    <thead><tr class="bg-gray-50"><th class="text-left py-3 px-4">Jenis Biaya</th><th class="text-right py-3 px-4">Jumlah</th><th class="text-left py-3 px-4 text-gray-500">Keterangan</th></tr></thead>
                    <tbody>
                        <tr class="border-b"><td class="py-3 px-4">SPP (Sumbangan Pembinaan Pendidikan)</td><td class="py-3 px-4 text-right font-semibold">Rp 2.500.000</td><td class="py-3 px-4 text-gray-500">Per semester</td></tr>
                        <tr class="border-b"><td class="py-3 px-4">Biaya Kemahasiswaan</td><td class="py-3 px-4 text-right font-semibold">Rp 250.000</td><td class="py-3 px-4 text-gray-500">Per semester</td></tr>
                        <tr class="border-b"><td class="py-3 px-4">Biaya Perpustakaan</td><td class="py-3 px-4 text-right font-semibold">Rp 100.000</td><td class="py-3 px-4 text-gray-500">Per semester</td></tr>
                        <tr class="border-b"><td class="py-3 px-4">Biaya Teknologi</td><td class="py-3 px-4 text-right font-semibold">Rp 150.000</td><td class="py-3 px-4 text-gray-500">Per semester</td></tr>
                        <tr class="bg-blue-50 font-bold"><td class="py-3 px-4 text-blue-900">Total Per Semester</td><td class="py-3 px-4 text-right text-blue-900">Rp 3.000.000</td><td class="py-3 px-4 text-blue-700">Estimasi</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="bg-blue-50 rounded-xl p-6 text-sm text-gray-600 mb-8" data-aos="fade-up">
            <p class="font-bold text-blue-900 mb-2">Catatan:</p>
            <ul class="list-disc list-inside space-y-1">
                <li>Biaya dapat berubah sesuai kebijakan institusi</li>
                <li>Tersedia program cicilan untuk SPP</li>
                <li>Biaya asrama tidak termasuk dalam daftar di atas</li>
                <li>Untuk informasi lebih lanjut, hubungi bagian keuangan</li>
            </ul>
        </div>
        @if(isset($page) && $page?->content)
        <div class="bg-white rounded-xl shadow-md p-8 mt-6 prose prose-blue max-w-none text-gray-700" data-aos="fade-up">
            {!! clean($page->content) !!}
        </div>
        @endif
        <div class="text-center mt-6">
            <a href="{{ route('pmb.beasiswa') }}" class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-3 px-8 rounded-full transition mr-4 inline-block">Info Beasiswa</a>
            <a href="{{ route('kontak.index') }}" class="border-2 border-blue-700 text-blue-700 hover:bg-blue-700 hover:text-white font-bold py-3 px-8 rounded-full transition inline-block">Hubungi Kami</a>
        </div>
    </div>
</div>
@endsection
