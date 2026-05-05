@extends('layouts.frontend')
@section('title', 'Pendaftaran Berhasil | STT Siloam Medan')
@section('content')

<div class="bg-blue-900 text-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold">Pendaftaran Berhasil</h1>
        <nav class="text-sm mt-2">
            <a href="{{ route('home') }}" class="text-blue-300 hover:text-white">Beranda</a>
            <span class="mx-2 text-blue-400">&#x203A;</span>
            <a href="{{ route('pmb.index') }}" class="text-blue-300 hover:text-white">PMB</a>
            <span class="mx-2 text-blue-400">&#x203A;</span>
            <span class="text-white">Pendaftaran Berhasil</span>
        </nav>
    </div>
</div>

<div class="container mx-auto px-4 py-16">
    <div class="max-w-2xl mx-auto text-center">
        <div class="bg-green-100 rounded-full w-24 h-24 flex items-center justify-center mx-auto mb-6">
            <svg class="w-14 h-14 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <h2 class="text-3xl font-bold text-gray-900 mb-3">Pendaftaran Berhasil Dikirim!</h2>
        <p class="text-gray-600 mb-8">Terima kasih telah mendaftar di STT Siloam Medan. Data pendaftaran Anda telah kami terima.</p>

        @if(isset($registration))
        <div class="bg-white rounded-xl shadow-lg p-8 mb-8 text-left">
            <div class="text-center mb-6">
                <p class="text-gray-500 text-sm">Nomor Registrasi Anda</p>
                <p class="text-3xl font-bold text-blue-900 tracking-widest">{{ $registration->registration_number }}</p>
                <p class="text-gray-500 text-xs mt-1">Simpan nomor ini untuk keperluan selanjutnya</p>
            </div>
            <div class="border-t border-gray-200 pt-6 space-y-3">
                <div class="flex justify-between">
                    <span class="text-gray-500">Nama Pendaftar:</span>
                    <span class="font-semibold text-gray-900">{{ $registration->name }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Email:</span>
                    <span class="font-semibold text-gray-900">{{ $registration->email }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Program Studi:</span>
                    <span class="font-semibold text-gray-900">{{ $registration->program->name ?? '-' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Tanggal Daftar:</span>
                    <span class="font-semibold text-gray-900">{{ $registration->created_at->format('d F Y, H:i') }} WIB</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Status:</span>
                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-semibold">{{ ucfirst($registration->status ?? 'pending') }}</span>
                </div>
            </div>
        </div>
        @endif

        <div class="bg-blue-50 rounded-xl p-6 text-left mb-8">
            <h3 class="font-bold text-blue-900 mb-4">Langkah Selanjutnya:</h3>
            <ol class="space-y-3 text-gray-700">
                <li class="flex gap-3">
                    <span class="bg-blue-700 text-white w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0 mt-0.5">1</span>
                    <span>Pantau email Anda untuk konfirmasi pendaftaran dan informasi lebih lanjut.</span>
                </li>
                <li class="flex gap-3">
                    <span class="bg-blue-700 text-white w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0 mt-0.5">2</span>
                    <span>Tim panitia PMB akan menghubungi Anda melalui telepon/WhatsApp dalam 2x24 jam kerja.</span>
                </li>
                <li class="flex gap-3">
                    <span class="bg-blue-700 text-white w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0 mt-0.5">3</span>
                    <span>Siapkan dokumen asli untuk proses verifikasi pada saat wawancara.</span>
                </li>
                <li class="flex gap-3">
                    <span class="bg-blue-700 text-white w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0 mt-0.5">4</span>
                    <span>Simpan nomor registrasi Anda sebagai referensi selama proses pendaftaran.</span>
                </li>
            </ol>
        </div>

        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('home') }}" class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-3 px-8 rounded-full transition">
                Kembali ke Beranda
            </a>
            <a href="{{ route('kontak.index') }}" class="border-2 border-blue-700 text-blue-700 hover:bg-blue-700 hover:text-white font-bold py-3 px-8 rounded-full transition">
                Hubungi Kami
            </a>
        </div>
    </div>
</div>

@endsection
