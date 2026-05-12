@extends('layouts.frontend')
@section('title', 'Visi & Misi | STT Siloam Medan')

@section('content')

{{-- Hero Banner --}}
<div class="relative bg-gradient-to-br from-blue-950 via-blue-900 to-indigo-900 text-white overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
                    <path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="1"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#grid)" />
        </svg>
    </div>
    <div class="absolute -bottom-1 left-0 right-0">
        <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 60L1440 60L1440 0C1200 50 240 50 0 0L0 60Z" fill="#f8fafc"/>
        </svg>
    </div>
    <div class="relative container mx-auto px-4 py-16 pb-20">
        <div class="flex items-center gap-3 mb-3" data-aos="fade-right">
            <a href="{{ route('home') }}" class="text-blue-300 hover:text-white text-sm transition-colors">Beranda</a>
            <span class="text-blue-400 text-sm">›</span>
            <span class="text-blue-300 text-sm">Profil</span>
            <span class="text-blue-400 text-sm">›</span>
            <span class="text-white text-sm font-medium">Visi & Misi</span>
        </div>
        <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight leading-tight" data-aos="fade-up">
            Visi &amp; Misi
        </h1>
        <p class="mt-3 text-blue-200 text-lg max-w-xl" data-aos="fade-up" data-aos-delay="100">
            STT Siloam Medan — Mencetak hamba Tuhan yang handal, profesional, dan berdampak
        </p>
    </div>
</div>

{{-- Visi Section --}}
<section class="bg-slate-50 py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">

            <div class="relative bg-gradient-to-br from-blue-900 to-blue-800 text-white rounded-2xl shadow-2xl overflow-hidden" data-aos="zoom-in">
                {{-- decorative circle --}}
                <div class="absolute -top-16 -right-16 w-64 h-64 bg-yellow-400 rounded-full opacity-10"></div>
                <div class="absolute -bottom-10 -left-10 w-48 h-48 bg-white rounded-full opacity-5"></div>

                <div class="relative p-10 md:p-14 flex flex-col md:flex-row items-center gap-8">
                    {{-- icon --}}
                    <div class="flex-shrink-0">
                        <div class="w-24 h-24 bg-yellow-400 rounded-2xl flex items-center justify-center shadow-xl rotate-3">
                            <i class="fas fa-eye text-4xl text-blue-900"></i>
                        </div>
                    </div>
                    {{-- text --}}
                    <div>
                        <p class="text-yellow-400 text-sm font-bold uppercase tracking-widest mb-2">Visi Kami</p>
                        <h2 class="text-3xl md:text-4xl font-extrabold leading-tight mb-4">VISI</h2>
                        <p class="text-blue-100 text-lg md:text-xl leading-relaxed italic font-light">
                            "Menjadi Sekolah Tinggi Teologi yang handal dalam mendidik tenaga Guru Agama Kristen yang
                            profesional dan hamba Tuhan yang mampu menggembalakan jemaat."
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- Misi Section --}}
<section class="bg-white py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">

            <div class="text-center mb-12" data-aos="fade-up">
                <span class="inline-flex items-center gap-2 bg-blue-100 text-blue-800 text-sm font-semibold px-4 py-1.5 rounded-full mb-4">
                    <i class="fas fa-bullseye text-xs"></i> Misi Kami
                </span>
                <h2 class="text-3xl md:text-4xl font-extrabold text-blue-900">MISI</h2>
                <p class="text-gray-500 mt-2">Empat pilar misi yang menjadi landasan gerak STT Siloam Medan</p>
            </div>

            @php
            $misi = [
                [
                    'no'   => '01',
                    'icon' => 'fas fa-graduation-cap',
                    'color'=> 'blue',
                    'text' => 'Menyelenggarakan pendidikan dan pengajaran yang handal di bidang teologi dan pendidikan agama Kristen.',
                ],
                [
                    'no'   => '02',
                    'icon' => 'fas fa-flask',
                    'color'=> 'indigo',
                    'text' => 'Menyelenggarakan penelitian teologi dan pendidikan agama Kristen yang handal dalam konteks Pendidikan Agama Kristen dan penggembalaan jemaat.',
                ],
                [
                    'no'   => '03',
                    'icon' => 'fas fa-hands-helping',
                    'color'=> 'violet',
                    'text' => 'Menyelenggarakan pengabdian masyarakat yang handal dalam bidang pelayanan gereja dan sekolah.',
                ],
                [
                    'no'   => '04',
                    'icon' => 'fas fa-globe',
                    'color'=> 'purple',
                    'text' => 'Menyelenggarakan pendidikan agama Kristen dan penggembalaan jemaat dengan semangat oikumenis.',
                ],
            ];
            $palette = [
                'blue'   => ['bg' => 'bg-blue-600',   'light' => 'bg-blue-50',   'border' => 'border-blue-200',   'text' => 'text-blue-600'],
                'indigo' => ['bg' => 'bg-indigo-600', 'light' => 'bg-indigo-50', 'border' => 'border-indigo-200', 'text' => 'text-indigo-600'],
                'violet' => ['bg' => 'bg-violet-600', 'light' => 'bg-violet-50', 'border' => 'border-violet-200', 'text' => 'text-violet-600'],
                'purple' => ['bg' => 'bg-purple-600', 'light' => 'bg-purple-50', 'border' => 'border-purple-200', 'text' => 'text-purple-600'],
            ];
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($misi as $i => $item)
                @php $p = $palette[$item['color']]; @endphp
                <div class="group relative border {{ $p['border'] }} {{ $p['light'] }} rounded-2xl p-7 hover:shadow-lg transition-all duration-300 hover:-translate-y-1"
                     data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                    <div class="flex items-start gap-5">
                        <div class="flex-shrink-0 {{ $p['bg'] }} w-14 h-14 rounded-xl flex items-center justify-center shadow-md">
                            <i class="{{ $item['icon'] }} text-white text-xl"></i>
                        </div>
                        <div>
                            <span class="{{ $p['text'] }} text-xs font-black tracking-widest uppercase mb-1 block">Misi {{ $item['no'] }}</span>
                            <p class="text-gray-700 leading-relaxed">{{ $item['text'] }}</p>
                        </div>
                    </div>
                    <span class="absolute bottom-4 right-5 text-6xl font-black opacity-5 {{ $p['text'] }} leading-none select-none">{{ $item['no'] }}</span>
                </div>
                @endforeach
            </div>

        </div>
    </div>
</section>

{{-- Nilai-Nilai Utama --}}
<section class="bg-slate-50 py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">

            <div class="text-center mb-10" data-aos="fade-up">
                <span class="inline-flex items-center gap-2 bg-yellow-100 text-yellow-800 text-sm font-semibold px-4 py-1.5 rounded-full mb-4">
                    <i class="fas fa-star text-xs"></i> Core Values
                </span>
                <h2 class="text-3xl font-extrabold text-blue-900">Nilai-Nilai Utama</h2>
            </div>

            @php
            $values = [
                ['icon' => 'fas fa-shield-alt',   'label' => 'Integritas',   'desc' => 'Jujur dan konsisten dalam setiap tindakan',        'color' => 'blue'],
                ['icon' => 'fas fa-star',          'label' => 'Keunggulan',   'desc' => 'Standar tinggi dalam pendidikan dan pelayanan',     'color' => 'yellow'],
                ['icon' => 'fas fa-hands',         'label' => 'Pelayanan',    'desc' => 'Hati yang melayani Tuhan dan sesama manusia',       'color' => 'green'],
                ['icon' => 'fas fa-users',         'label' => 'Komunitas',    'desc' => 'Membangun persekutuan yang kuat dan saling mendukung','color'=> 'purple'],
            ];
            $vpalette = [
                'blue'   => ['ring' => 'ring-blue-200',   'icon_bg' => 'bg-blue-100',   'icon_text' => 'text-blue-700',   'label_text' => 'text-blue-900'],
                'yellow' => ['ring' => 'ring-yellow-200', 'icon_bg' => 'bg-yellow-100', 'icon_text' => 'text-yellow-600', 'label_text' => 'text-yellow-900'],
                'green'  => ['ring' => 'ring-green-200',  'icon_bg' => 'bg-green-100',  'icon_text' => 'text-green-700',  'label_text' => 'text-green-900'],
                'purple' => ['ring' => 'ring-purple-200', 'icon_bg' => 'bg-purple-100', 'icon_text' => 'text-purple-700', 'label_text' => 'text-purple-900'],
            ];
            @endphp

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($values as $i => $val)
                @php $vp = $vpalette[$val['color']]; @endphp
                <div class="bg-white rounded-2xl p-6 text-center shadow-sm ring-1 {{ $vp['ring'] }} hover:shadow-md hover:-translate-y-1 transition-all duration-300"
                     data-aos="fade-up" data-aos-delay="{{ $i * 80 }}">
                    <div class="{{ $vp['icon_bg'] }} w-14 h-14 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="{{ $val['icon'] }} {{ $vp['icon_text'] }} text-xl"></i>
                    </div>
                    <h3 class="{{ $vp['label_text'] }} font-bold text-base mb-1">{{ $val['label'] }}</h3>
                    <p class="text-gray-500 text-xs leading-snug">{{ $val['desc'] }}</p>
                </div>
                @endforeach
            </div>

        </div>
    </div>
</section>

{{-- Admin tambahan content --}}
@if(isset($page) && $page?->content)
<section class="bg-white py-12" data-aos="fade-up">
    <div class="container mx-auto px-4 max-w-4xl">
        <div class="bg-blue-50 border border-blue-100 rounded-2xl p-8 prose prose-blue max-w-none text-gray-700">
            {!! clean($page->content) !!}
        </div>
    </div>
</section>
@endif

{{-- CTA --}}
<section class="bg-gradient-to-r from-blue-900 to-blue-800 text-white py-14 text-center" data-aos="fade-up">
    <div class="container mx-auto px-4">
        <h3 class="text-2xl md:text-3xl font-extrabold mb-3">Bergabunglah Bersama Kami</h3>
        <p class="text-blue-200 mb-7 max-w-lg mx-auto">Jadilah bagian dari komunitas yang berkomitmen membentuk hamba Tuhan yang handal dan berdampak.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('pmb.daftar') }}" class="inline-flex items-center gap-2 bg-yellow-400 hover:bg-yellow-300 text-blue-900 font-bold px-8 py-3 rounded-full shadow-lg transition-all duration-200 hover:-translate-y-0.5">
                <i class="fas fa-pen-to-square"></i> Daftar Sekarang
            </a>
            <a href="{{ route('profil.sejarah') }}" class="inline-flex items-center gap-2 border-2 border-white hover:bg-white hover:text-blue-900 text-white font-semibold px-8 py-3 rounded-full transition-all duration-200 hover:-translate-y-0.5">
                <i class="fas fa-landmark"></i> Sejarah Kampus
            </a>
        </div>
    </div>
</section>

@endsection
