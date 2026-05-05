@extends('layouts.frontend')
@section('title', isset($program) ? $program->name . ' | STT Siloam Medan' : 'Program Studi | STT Siloam Medan')
@section('content')
<div class="bg-blue-900 text-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold">{{ isset($program) ? $program->name : 'Program Studi' }}</h1>
        <nav class="text-sm mt-2">
            <a href="{{ route('home') }}" class="text-blue-300 hover:text-white">Beranda</a>
            <span class="mx-2 text-blue-400">&#x203A;</span>
            <a href="{{ route('akademik.program-studi') }}" class="text-blue-300 hover:text-white">Program Studi</a>
            <span class="mx-2 text-blue-400">&#x203A;</span>
            <span class="text-white">{{ isset($program) ? $program->name : 'Detail' }}</span>
        </nav>
    </div>
</div>
<div class="container mx-auto px-4 py-12">
    @if(isset($program))
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-md p-8 mb-6" data-aos="fade-up">
                <h2 class="text-2xl font-bold text-blue-900 mb-4">Tentang Program Studi</h2>
                <div class="prose prose-lg max-w-none text-gray-700">{!! $program->description !!}</div>
            </div>
            @if($program->curriculum)
            <div class="bg-white rounded-xl shadow-md p-8" data-aos="fade-up">
                <h2 class="text-2xl font-bold text-blue-900 mb-4">Kurikulum</h2>
                <div class="prose max-w-none text-gray-700">{!! $program->curriculum !!}</div>
            </div>
            @endif
        </div>
        <div class="space-y-6">
            <div class="bg-blue-900 text-white rounded-xl p-6" data-aos="fade-left">
                <h3 class="font-bold text-lg mb-4">Informasi Program</h3>
                <div class="space-y-3 text-sm">
                    @if($program->degree)
                    <div class="flex justify-between"><span class="text-blue-300">Jenjang:</span><span class="font-semibold">{{ $program->degree }}</span></div>
                    @endif
                    @if($program->duration)
                    <div class="flex justify-between"><span class="text-blue-300">Lama Studi:</span><span class="font-semibold">{{ $program->duration }}</span></div>
                    @endif
                    @if($program->accreditation)
                    <div class="flex justify-between"><span class="text-blue-300">Akreditasi:</span><span class="font-bold text-yellow-400">{{ $program->accreditation }}</span></div>
                    @endif
                    @if($program->degree_title)
                    <div class="flex justify-between"><span class="text-blue-300">Gelar:</span><span class="font-semibold">{{ $program->degree_title }}</span></div>
                    @endif
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-md p-6" data-aos="fade-left">
                <h3 class="font-bold text-blue-900 mb-4">Prospek Karir</h3>
                <ul class="text-gray-600 text-sm space-y-2">
                    <li class="flex gap-2">&#x2022; Pendeta / Gembala Gereja</li>
                    <li class="flex gap-2">&#x2022; Guru / Dosen Teologi</li>
                    <li class="flex gap-2">&#x2022; Misionaris</li>
                    <li class="flex gap-2">&#x2022; Konselor Kristiani</li>
                    <li class="flex gap-2">&#x2022; Pemimpin Organisasi Pelayanan</li>
                </ul>
            </div>
            <a href="{{ route('pmb.daftar') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 px-6 rounded-xl transition block text-center">
                Daftar Program Ini
            </a>
        </div>
    </div>
    @endif
</div>
@endsection
