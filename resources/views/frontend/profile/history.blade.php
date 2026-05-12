@extends('layouts.frontend')
@section('title', 'Sejarah Kampus')

@section('content')

{{-- Hero Banner --}}
<div class="relative bg-gradient-to-br from-blue-950 via-blue-900 to-slate-800 text-white overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="dots" width="24" height="24" patternUnits="userSpaceOnUse">
                    <circle cx="3" cy="3" r="1.5" fill="white"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#dots)" />
        </svg>
    </div>
    <div class="absolute -bottom-1 left-0 right-0">
        <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 60L1440 60L1440 0C1200 50 240 50 0 0L0 60Z" fill="white"/>
        </svg>
    </div>
    <div class="relative container mx-auto px-4 py-16 pb-20">
        <div class="flex items-center gap-3 mb-3" data-aos="fade-right">
            <a href="{{ route('home') }}" class="text-blue-300 hover:text-white text-sm transition-colors">Beranda</a>
            <span class="text-blue-400 text-sm">›</span>
            <span class="text-blue-300 text-sm">Profil</span>
            <span class="text-blue-400 text-sm">›</span>
            <span class="text-white text-sm font-medium">Sejarah</span>
        </div>
        <div class="flex flex-col md:flex-row items-start md:items-end justify-between gap-6">
            <div>
                <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight leading-tight" data-aos="fade-up">
                    Sejarah Kampus
                </h1>
                <p class="mt-3 text-blue-200 text-lg max-w-xl" data-aos="fade-up" data-aos-delay="100">
                    Perjalanan panjang {{ $siteSettings->get('app_name') }} sejak berdiri hingga menjadi lembaga pendidikan teologi terpercaya
                </p>
            </div>
            <div class="flex items-center gap-3 bg-white/10 backdrop-blur-sm px-5 py-3 rounded-2xl border border-white/20" data-aos="fade-left">
                <i class="fas fa-university text-yellow-400 text-2xl"></i>
                <div>
                    <div class="text-white font-bold text-xl leading-none">{{ $siteSettings->get('app_name') }}</div>
                    <div class="text-blue-300 text-xs mt-0.5">Medan, Sumatera Utara</div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(isset($page) && $page?->content)
{{-- Konten dari Admin --}}
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            @if($page->image ?? null)
            <div class="mb-8 rounded-2xl overflow-hidden shadow-xl" data-aos="fade-up">
                <img loading="lazy" src="{{ $page->image_url }}" alt="Sejarah {{ $siteSettings->get('app_name') }}"
                     class="w-full max-h-96 object-cover">
            </div>
            @endif
            <div class="prose prose-lg prose-blue max-w-none text-gray-700 leading-relaxed" data-aos="fade-up">
                {!! $page->content !!}
            </div>
        </div>
    </div>
</section>

@else
{{-- Default: Tampilan statis keren --}}

{{-- Intro --}}
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <div class="flex flex-col md:flex-row gap-10 items-center" data-aos="fade-up">
                <div class="flex-shrink-0">
                    <div class="w-32 h-32 bg-gradient-to-br from-blue-900 to-blue-700 rounded-3xl flex items-center justify-center shadow-2xl rotate-3">
                        <i class="fas fa-church text-white text-5xl"></i>
                    </div>
                </div>
                <div>
                    <span class="inline-flex items-center gap-2 bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1.5 rounded-full mb-3">
                        <i class="fas fa-history"></i> Tentang Kami
                    </span>
                    <h2 class="text-2xl md:text-3xl font-extrabold text-blue-900 leading-tight mb-4">
                        Berdiri atas Panggilan Tuhan untuk Mendidik Hamba-Nya
                    </h2>
                    <p class="text-gray-600 leading-relaxed">
                        {{ $siteSettings->get('app_name') }} lahir dari kerinduan mendalam untuk menyediakan pendidikan teologi
                        yang berkualitas di Sumatera Utara. Sejak awal berdirinya, kampus ini berkomitmen
                        mencetak hamba Tuhan yang kompeten, berkarakter, dan berdampak bagi gereja serta masyarakat.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Timeline --}}
<section class="py-16 bg-slate-50">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto">

            <div class="text-center mb-12" data-aos="fade-up">
                <span class="inline-flex items-center gap-2 bg-yellow-100 text-yellow-800 text-sm font-semibold px-4 py-1.5 rounded-full mb-4">
                    <i class="fas fa-clock text-xs"></i> Perjalanan Waktu
                </span>
                <h2 class="text-3xl font-extrabold text-blue-900">Tonggak Sejarah</h2>
                <p class="text-gray-500 mt-2">Jejak langkah {{ $siteSettings->get('app_name') }} dari tahun ke tahun</p>
            </div>

            @php
            $milestones = [
                ['year' => 'Awal', 'icon' => 'fas fa-seedling', 'color' => 'green',
                 'title' => 'Pendirian Kampus',
                 'desc'  => '{{ $siteSettings->get('app_name') }} didirikan atas kerinduan para pemimpin gereja untuk memiliki lembaga pendidikan teologi yang handal di Sumatera Utara.'],
                ['year' => 'Tumbuh', 'icon' => 'fas fa-users', 'color' => 'blue',
                 'title' => 'Perkembangan Program Studi',
                 'desc'  => 'Kampus mulai mengembangkan program studi di bidang Pendidikan Agama Kristen dan penggembalaan jemaat, menarik mahasiswa dari berbagai daerah.'],
                ['year' => 'Maju', 'icon' => 'fas fa-certificate', 'color' => 'indigo',
                 'title' => 'Akreditasi & Pengakuan',
                 'desc'  => '{{ $siteSettings->get('app_name') }} meraih akreditasi resmi sebagai bentuk pengakuan atas kualitas pendidikan yang diselenggarakan.'],
                ['year' => 'Kini',  'icon' => 'fas fa-graduation-cap', 'color' => 'purple',
                 'title' => 'Menghasilkan Hamba Tuhan',
                 'desc'  => 'Hingga kini {{ $siteSettings->get('app_name') }} telah meluluskan ratusan alumni yang tersebar melayani di berbagai gereja, sekolah, dan lembaga pelayanan di seluruh Indonesia.'],
            ];
            $tpalette = [
                'green'  => ['dot' => 'bg-green-500',  'icon_bg' => 'bg-green-100',  'icon_txt' => 'text-green-700',  'year_bg' => 'bg-green-500',  'border' => 'border-green-200'],
                'blue'   => ['dot' => 'bg-blue-600',   'icon_bg' => 'bg-blue-100',   'icon_txt' => 'text-blue-700',   'year_bg' => 'bg-blue-600',   'border' => 'border-blue-200'],
                'indigo' => ['dot' => 'bg-indigo-600', 'icon_bg' => 'bg-indigo-100', 'icon_txt' => 'text-indigo-700', 'year_bg' => 'bg-indigo-600', 'border' => 'border-indigo-200'],
                'purple' => ['dot' => 'bg-purple-600', 'icon_bg' => 'bg-purple-100', 'icon_txt' => 'text-purple-700', 'year_bg' => 'bg-purple-600', 'border' => 'border-purple-200'],
            ];
            @endphp

            <div class="relative">
                {{-- Vertical line --}}
                <div class="absolute left-8 top-0 bottom-0 w-0.5 bg-gradient-to-b from-green-400 via-blue-500 to-purple-500 hidden md:block"></div>

                <div class="space-y-8">
                    @foreach($milestones as $i => $ms)
                    @php $tp = $tpalette[$ms['color']]; @endphp
                    <div class="relative flex gap-6 items-start" data-aos="fade-left" data-aos-delay="{{ $i * 100 }}">
                        {{-- dot + icon --}}
                        <div class="flex-shrink-0 relative z-10">
                            <div class="{{ $tp['icon_bg'] }} w-16 h-16 rounded-2xl flex items-center justify-center shadow-md border-2 {{ $tp['border'] }}">
                                <i class="{{ $ms['icon'] }} {{ $tp['icon_txt'] }} text-xl"></i>
                            </div>
                        </div>
                        {{-- content card --}}
                        <div class="flex-1 bg-white rounded-2xl shadow-sm border border-slate-100 p-6 hover:shadow-md transition-shadow">
                            <div class="flex items-center gap-3 mb-2">
                                <span class="{{ $tp['year_bg'] }} text-white text-xs font-bold px-3 py-1 rounded-full">{{ $ms['year'] }}</span>
                                <h3 class="font-bold text-blue-900 text-base">{{ $ms['title'] }}</h3>
                            </div>
                            <p class="text-gray-600 text-sm leading-relaxed">{{ $ms['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>

{{-- Quote / Stat --}}
<section class="py-16 bg-white">
    <div class="container mx-auto px-4 max-w-4xl">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            @foreach([
                ['icon' => 'fas fa-user-graduate', 'color' => 'blue',   'value' => 'Ratusan', 'label' => 'Alumni Telah Diwisuda'],
                ['icon' => 'fas fa-church',         'color' => 'indigo', 'value' => 'Ratusan', 'label' => 'Gereja Dijangkau Alumni'],
                ['icon' => 'fas fa-map-marked-alt', 'color' => 'purple', 'value' => 'Seluruh', 'label' => 'Penjuru Indonesia'],
            ] as $i => $stat)
            @php
            $spal = ['blue'=>['bg'=>'bg-blue-100','txt'=>'text-blue-700','val'=>'text-blue-900'],
                     'indigo'=>['bg'=>'bg-indigo-100','txt'=>'text-indigo-700','val'=>'text-indigo-900'],
                     'purple'=>['bg'=>'bg-purple-100','txt'=>'text-purple-700','val'=>'text-purple-900']];
            $sp = $spal[$stat['color']];
            @endphp
            <div class="text-center p-8 rounded-2xl bg-slate-50 border border-slate-100 hover:shadow-md transition-shadow"
                 data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                <div class="{{ $sp['bg'] }} w-14 h-14 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="{{ $stat['icon'] }} {{ $sp['txt'] }} text-xl"></i>
                </div>
                <div class="{{ $sp['val'] }} text-2xl font-extrabold mb-1">{{ $stat['value'] }}</div>
                <div class="text-gray-500 text-sm">{{ $stat['label'] }}</div>
            </div>
            @endforeach
        </div>

        <blockquote class="relative bg-gradient-to-br from-blue-900 to-blue-800 text-white rounded-2xl p-10 text-center shadow-xl overflow-hidden"
                    data-aos="zoom-in">
            <div class="absolute top-4 left-6 text-8xl text-white/10 font-serif leading-none select-none">"</div>
            <p class="text-xl md:text-2xl font-light italic text-blue-100 leading-relaxed relative z-10 max-w-2xl mx-auto">
                Perjalanan panjang dimulai dari sebuah mimpi sederhana namun penuh keyakinan bahwa
                pendidikan teologi yang baik akan menghasilkan pemimpin gereja yang mampu membawa
                transformasi nyata di tengah-tengah masyarakat.
            </p>
            <div class="mt-6 text-yellow-400 font-semibold relative z-10">— {{ $siteSettings->get('app_name') }}</div>
        </blockquote>

    </div>
</section>

@endif

{{-- CTA --}}
<section class="bg-gradient-to-r from-blue-900 to-blue-800 text-white py-14 text-center" data-aos="fade-up">
    <div class="container mx-auto px-4">
        <h3 class="text-2xl md:text-3xl font-extrabold mb-3">Jadilah Bagian dari Sejarah Ini</h3>
        <p class="text-blue-200 mb-7 max-w-lg mx-auto">Daftarkan diri Anda dan ukir cerita pelayanan bersama {{ $siteSettings->get('app_name') }}.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('pmb.daftar') }}" class="inline-flex items-center gap-2 bg-yellow-400 hover:bg-yellow-300 text-blue-900 font-bold px-8 py-3 rounded-full shadow-lg transition-all duration-200 hover:-translate-y-0.5">
                <i class="fas fa-pen-to-square"></i> Daftar Sekarang
            </a>
            <a href="{{ route('profil.visi-misi') }}" class="inline-flex items-center gap-2 border-2 border-white hover:bg-white hover:text-blue-900 text-white font-semibold px-8 py-3 rounded-full transition-all duration-200 hover:-translate-y-0.5">
                <i class="fas fa-bullseye"></i> Visi &amp; Misi
            </a>
        </div>
    </div>
</section>

@endsection
