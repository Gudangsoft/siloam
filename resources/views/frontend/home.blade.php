@extends('layouts.frontend')
@section('title', 'Beranda | STT Siloam Medan')
@section('content')

{{-- Hero Slider Section --}}
<section class="relative">
    @if(isset($banners) && $banners->count() > 0)
    <div id="heroSlider" class="relative">
        @foreach($banners as $index => $banner)
        <div class="hero-slide {{ $index === 0 ? 'block' : 'hidden' }} relative w-full"
             style="height:calc(100vh - 100px);min-height:480px;background-image: url('{{ $banner->image_url }}'); background-size: cover; background-position: center;">
            @if($banner->show_text)
            <div class="absolute inset-0 bg-black bg-opacity-50"></div>
            <div class="relative z-10 container mx-auto px-4 h-full flex items-center">
                <div class="text-white max-w-2xl" data-aos="fade-right">
                    <h1 class="text-3xl md:text-5xl font-bold mb-4 leading-tight">{{ $banner->title }}</h1>
                    @if($banner->subtitle)
                    <p class="text-lg md:text-xl mb-6 text-gray-200">{{ $banner->subtitle }}</p>
                    @endif
                    @if($banner->button_link)
                    <a href="{{ $banner->button_link }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 px-8 rounded-full transition duration-300 inline-block">
                        {{ $banner->button_text ?: 'Selengkapnya' }}
                    </a>
                    @endif
                    @if($banner->button_link_2)
                    <a href="{{ $banner->button_link_2 }}" class="border-2 border-white text-white hover:bg-white hover:text-blue-900 font-bold py-3 px-8 rounded-full transition duration-300 inline-block ms-2">
                        {{ $banner->button_text_2 ?: 'Selengkapnya' }}
                    </a>
                    @endif
                </div>
            </div>
            @endif
        </div>
        @endforeach
        @if($banners->count() > 1)
        <button onclick="prevSlide()" class="absolute left-4 top-1/2 transform -translate-y-1/2 z-20 bg-white bg-opacity-30 hover:bg-opacity-50 text-white p-2 rounded-full">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </button>
        <button onclick="nextSlide()" class="absolute right-4 top-1/2 transform -translate-y-1/2 z-20 bg-white bg-opacity-30 hover:bg-opacity-50 text-white p-2 rounded-full">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button>
        @endif
    </div>
    @else
    <div class="relative w-full bg-gradient-to-r from-blue-900 via-blue-800 to-blue-700" style="height:calc(100vh - 100px);min-height:480px;">
        <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width=60 height=60 viewBox=0 0 60 60 xmlns=http://www.w3.org/2000/svg%3E%3Cg fill=none fill-rule=evenodd%3E%3Cg fill=%23ffffff fill-opacity=0.4%3E%3Cpath d=M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        <div class="relative z-10 container mx-auto px-4 h-full flex items-center">
            <div class="text-white max-w-2xl" data-aos="fade-right">
                <p class="text-yellow-400 font-semibold text-lg mb-2 uppercase tracking-wider">Sekolah Tinggi Teologi</p>
                <h1 class="text-4xl md:text-6xl font-bold mb-4 leading-tight">STT Siloam Medan</h1>
                <p class="text-xl mb-6 text-gray-200">Mencetak Pemimpin Gereja yang Berkualitas, Berdedikasi, dan Berdampak bagi Bangsa</p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('pmb.index') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 px-8 rounded-full transition duration-300">
                        Daftar Sekarang
                    </a>
                    <a href="{{ route('profil.sejarah') }}" class="border-2 border-white text-white hover:bg-white hover:text-blue-900 font-bold py-3 px-8 rounded-full transition duration-300">
                        Tentang Kami
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif
</section>


{{-- Program Studi Section --}}
@if(isset($programs) && $programs->count() > 0)
@php
$cardStyles = [
    ['grad'=>'linear-gradient(135deg,#1e3a8a 0%,#2563eb 100%)', 'icon'=>'fas fa-cross', 'accent'=>'#f59e0b'],
    ['grad'=>'linear-gradient(135deg,#4c1d95 0%,#7c3aed 100%)', 'icon'=>'fas fa-book-open', 'accent'=>'#a78bfa'],
    ['grad'=>'linear-gradient(135deg,#0f4c75 0%,#0ea5e9 100%)', 'icon'=>'fas fa-graduation-cap', 'accent'=>'#38bdf8'],
    ['grad'=>'linear-gradient(135deg,#7c2d12 0%,#ea580c 100%)', 'icon'=>'fas fa-users', 'accent'=>'#fb923c'],
];
@endphp
<section class="py-20 bg-white" data-aos="fade-up">
    <div class="container mx-auto px-4">
        {{-- Heading --}}
        <div class="text-center mb-14">
            <span class="text-yellow-500 font-semibold text-xs uppercase tracking-widest">
                <i class="fas fa-graduation-cap mr-1"></i>Akademik
            </span>
            <h2 class="text-3xl lg:text-4xl font-bold text-blue-900 mt-2 mb-3">Program Studi</h2>
            <p class="text-gray-500 max-w-lg mx-auto text-sm leading-relaxed">
                Pilih program studi yang sesuai dengan panggilan dan tujuan pelayanan Anda
            </p>
            <div class="flex justify-center items-center gap-2 mt-4">
                <div class="w-16 h-1 bg-yellow-500 rounded"></div>
                <div class="w-3 h-1 bg-yellow-300 rounded"></div>
            </div>
        </div>

        {{-- Cards Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto">
            @foreach($programs as $i => $program)
            @php $style = $cardStyles[$i % count($cardStyles)]; @endphp
            <div class="group bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 flex flex-col"
                 data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">

                {{-- Top Banner --}}
                <div class="relative h-52 flex items-center justify-center overflow-hidden"
                     style="background:{{ $style['grad'] }}">
                    {{-- Decorative circles --}}
                    <div class="absolute -top-10 -right-10 w-44 h-44 rounded-full"
                         style="background:rgba(255,255,255,0.07)"></div>
                    <div class="absolute -bottom-8 -left-8 w-36 h-36 rounded-full"
                         style="background:rgba(255,255,255,0.07)"></div>
                    <div class="absolute top-4 left-4 w-16 h-16 rounded-full"
                         style="background:rgba(255,255,255,0.05)"></div>

                    {{-- Image or Icon --}}
                    @if($program->image)
                    <img src="{{ $program->image_url }}" alt="{{ $program->name }}"
                         class="absolute inset-0 w-full h-full object-cover opacity-40 group-hover:opacity-50 transition-opacity duration-500">
                    @endif
                    <div class="relative z-10 text-center">
                        <div class="w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform duration-300"
                             style="background:rgba(255,255,255,0.15);backdrop-filter:blur(8px);border:2px solid rgba(255,255,255,0.25)">
                            <i class="{{ $style['icon'] }} text-white" style="font-size:32px"></i>
                        </div>
                        {{-- Degree badge --}}
                        @if($program->degree)
                        <span class="inline-block text-xs font-bold px-3 py-1 rounded-full text-blue-900"
                              style="background:{{ $style['accent'] }}">
                            {{ $program->degree }}
                        </span>
                        @endif
                    </div>
                </div>

                {{-- Content --}}
                <div class="flex flex-col flex-1 p-7">
                    {{-- Accreditation badge --}}
                    @if($program->accreditation)
                    <div class="flex items-center gap-1.5 mb-3">
                        <i class="fas fa-shield-alt text-green-500 text-xs"></i>
                        <span class="text-green-700 text-xs font-semibold">Akreditasi {{ $program->accreditation }}</span>
                    </div>
                    @endif

                    {{-- Name --}}
                    <h3 class="text-xl font-bold text-blue-900 mb-3 group-hover:text-blue-700 transition-colors leading-tight">
                        {{ $program->name }}
                    </h3>

                    {{-- Description --}}
                    <p class="text-gray-500 text-sm leading-relaxed flex-1 mb-6"
                       style="-webkit-line-clamp:3;display:-webkit-box;-webkit-box-orient:vertical;overflow:hidden">
                        {{ $program->description ?: 'Program unggulan yang dirancang untuk mempersiapkan lulusan yang kompeten dan berdampak.' }}
                    </p>

                    {{-- Highlights (career prospects, head name) --}}
                    <div class="flex flex-wrap gap-3 mb-6">
                        @if($program->head_name)
                        <div class="flex items-center gap-1.5 text-xs text-gray-500">
                            <i class="fas fa-user-tie text-blue-400"></i>
                            <span>{{ $program->head_name }}</span>
                        </div>
                        @endif
                        <div class="flex items-center gap-1.5 text-xs text-gray-500">
                            <i class="fas fa-clock text-blue-400"></i>
                            <span>8 Semester</span>
                        </div>
                        <div class="flex items-center gap-1.5 text-xs text-gray-500">
                            <i class="fas fa-map-marker-alt text-blue-400"></i>
                            <span>Kampus Medan</span>
                        </div>
                    </div>

                    {{-- Footer CTA --}}
                    <div class="flex items-center justify-between pt-5 border-t border-gray-100">
                        <a href="{{ route('akademik.program-detail', $program->slug) }}"
                           class="inline-flex items-center gap-2 font-semibold text-sm group-hover:gap-3 transition-all"
                           style="color:{{ $style['accent'] === '#f59e0b' ? '#1d4ed8' : substr($style['grad'], strpos($style['grad'],'#',20), 7) }}">
                            Lihat Program
                            <i class="fas fa-arrow-right text-xs"></i>
                        </a>
                        <a href="{{ route('pmb.daftar') }}"
                           class="inline-flex items-center gap-1.5 text-xs font-semibold px-4 py-2 rounded-full text-white transition-opacity hover:opacity-90"
                           style="background:{{ $style['grad'] }}">
                            <i class="fas fa-user-plus text-xs"></i>Daftar
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- CTA bawah --}}
        <div class="text-center mt-12">
            <a href="{{ route('akademik.program-studi') }}"
               class="inline-flex items-center gap-2 border-2 border-blue-900 text-blue-900 hover:bg-blue-900 hover:text-white font-semibold px-8 py-3 rounded-full transition-all duration-300">
                <i class="fas fa-th-large"></i>
                Lihat Semua Program Studi
            </a>
        </div>
    </div>
</section>
@endif

{{-- Sambutan Ketua Section --}}
@if(isset($siteSettings))
<section class="py-16 bg-gray-50 overflow-hidden" data-aos="fade-up">
    <div class="container mx-auto px-4">
        <div class="rounded-3xl overflow-hidden shadow-2xl flex flex-col lg:flex-row min-h-[520px]">

            {{-- Panel Kiri: Foto --}}
            <div class="lg:w-2/5 bg-blue-900 relative flex flex-col items-center justify-center py-14 px-10"
                 style="background: linear-gradient(145deg, #1e3a8a 0%, #1e40af 60%, #1d4ed8 100%);">
                {{-- Dekorasi lingkaran latar --}}
                <div class="absolute top-0 right-0 w-64 h-64 rounded-full opacity-5"
                     style="background:#fff;transform:translate(30%,-30%)"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 rounded-full opacity-5"
                     style="background:#fff;transform:translate(-30%,30%)"></div>
                {{-- Foto persegi panjang dengan shadow offset kuning --}}
                <div class="relative z-10">
                    <div class="relative" style="width:240px;height:300px">
                        {{-- Yellow shadow offset --}}
                        <div class="absolute rounded-2xl bg-yellow-400"
                             style="inset:0;transform:translate(10px,10px)"></div>
                        {{-- Photo frame --}}
                        <div class="absolute inset-0 rounded-2xl overflow-hidden border-4 border-white shadow-2xl bg-blue-800">
                            @if($siteSettings->get('rector_photo'))
                            <img src="{{ Storage::disk('public')->url($siteSettings->get('rector_photo')) }}"
                                 alt="{{ $siteSettings->get('rector_name','Ketua STT') }}"
                                 class="w-full h-full object-cover object-top">
                            @else
                            <div class="w-full h-full flex items-center justify-center">
                                <i class="fas fa-user text-6xl text-blue-400"></i>
                            </div>
                            @endif
                        </div>
                    </div>
                    {{-- Name card --}}
                    <div class="text-center mt-8 relative z-10">
                        <div class="inline-block bg-white bg-opacity-10 backdrop-blur rounded-xl px-6 py-3 border border-white border-opacity-20">
                            <p class="text-white font-bold text-base tracking-wide">
                                {{ $siteSettings->get('rector_name', 'Ketua STT Siloam Medan') }}
                            </p>
                            <p class="text-yellow-300 text-sm mt-0.5">Ketua STT Siloam Medan</p>
                        </div>
                        <div class="flex justify-center gap-1 mt-4">
                            <div class="w-8 h-0.5 bg-yellow-400 rounded"></div>
                            <div class="w-2 h-0.5 bg-yellow-400 rounded"></div>
                            <div class="w-2 h-0.5 bg-yellow-400 rounded"></div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Panel Kanan: Teks --}}
            <div class="lg:w-3/5 bg-white flex flex-col justify-center px-10 lg:px-16 py-14">
                <span class="text-yellow-500 font-semibold text-xs uppercase tracking-widest mb-2">
                    <i class="fas fa-cross mr-1"></i>Pesan Pimpinan
                </span>
                <h2 class="text-3xl lg:text-4xl font-bold text-blue-900 mb-4 leading-tight">Sambutan Ketua</h2>
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-16 h-1 bg-yellow-500 rounded"></div>
                    <div class="w-3 h-1 bg-yellow-300 rounded"></div>
                </div>

                {{-- Kutipan --}}
                <div class="relative">
                    <i class="fas fa-quote-left absolute text-yellow-200"
                       style="font-size:72px;top:-20px;left:-16px;line-height:1;z-index:0"></i>
                    <div class="relative z-10 text-gray-700 leading-relaxed text-base lg:text-lg"
                         style="font-style:italic;padding-left:10px">
                        {!! nl2br(e($siteSettings->get('rector_message', 'STT Siloam Medan hadir untuk mencetak pemimpin gereja yang berkarakter Kristus, berpengetahuan teologi yang mendalam, dan siap melayani di berbagai bidang kehidupan.'))) !!}
                    </div>
                </div>

                {{-- Tanda tangan / penutup --}}
                <div class="mt-10 pt-6 border-t border-gray-100 flex items-center gap-4">
                    <div class="flex gap-1.5">
                        <div class="w-10 h-0.5 bg-yellow-500 rounded"></div>
                        <div class="w-3 h-0.5 bg-yellow-300 rounded"></div>
                    </div>
                    <div>
                        <p class="font-bold text-blue-900 text-sm">{{ $siteSettings->get('rector_name', 'Ketua STT Siloam Medan') }}</p>
                        <p class="text-gray-400 text-xs">Ketua STT Siloam Medan</p>
                    </div>
                    <div class="ml-auto">
                        <a href="{{ route('profil.pimpinan') }}"
                           class="inline-flex items-center gap-2 text-blue-700 hover:text-blue-900 font-semibold text-sm">
                            Profil Pimpinan
                            <i class="fas fa-arrow-right text-xs"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endif

{{-- Berita Terbaru Section --}}
@if(isset($latest_news) && $latest_news->count() > 0)
<section class="py-16 bg-gray-50" data-aos="fade-up">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center mb-12">
            <div>
                <h2 class="text-3xl font-bold text-blue-900 mb-2">Berita Terbaru</h2>
                <div class="w-20 h-1 bg-yellow-500"></div>
            </div>
            <a href="{{ route('berita.index') }}" class="text-blue-700 hover:text-blue-900 font-semibold flex items-center gap-1">
                Lihat Semua
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($latest_news->take(6) as $news)
            <article class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300" data-aos="fade-up">
                <a href="{{ route('berita.show', $news->slug) }}">
                    @if($news->image)
                    <img src="{{ $news->image_url }}" alt="{{ $news->title }}" class="w-full h-48 object-cover hover:opacity-90 transition">
                    @else
                    <div class="w-full h-48 bg-gradient-to-br from-blue-600 to-blue-800 flex items-center justify-center">
                        <svg class="w-12 h-12 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    </div>
                    @endif
                </a>
                <div class="p-5">
                    @if($news->category)
                    <span class="bg-blue-100 text-blue-700 text-xs font-semibold px-2 py-1 rounded-full">{{ $news->category }}</span>
                    @endif
                    <h3 class="font-bold text-gray-900 mt-3 mb-2 text-lg leading-snug hover:text-blue-700">
                        <a href="{{ route('berita.show', $news->slug) }}">{{ Str::limit($news->title, 70) }}</a>
                    </h3>
                    <p class="text-gray-500 text-sm mb-3">{{ Str::limit(strip_tags($news->content), 100) }}</p>
                    <div class="flex items-center text-xs text-gray-400">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        {{ $news->published_at ? $news->published_at->format('d M Y') : $news->created_at->format('d M Y') }}
                    </div>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Events / Agenda Section --}}
@if(isset($events) && $events->count() > 0)
<section class="py-16 bg-blue-900 text-white" data-aos="fade-up">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center mb-12">
            <div>
                <h2 class="text-3xl font-bold mb-2">Agenda Kampus</h2>
                <div class="w-20 h-1 bg-yellow-500"></div>
            </div>
            <a href="{{ route('media.agenda') }}" class="text-yellow-400 hover:text-yellow-300 font-semibold flex items-center gap-1">
                Lihat Semua
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($events->take(6) as $event)
            <div class="bg-blue-800 rounded-xl p-6 hover:bg-blue-700 transition duration-300" data-aos="fade-up">
                <div class="flex gap-4">
                    <div class="text-center bg-yellow-500 rounded-lg p-3 min-w-16">
                        <div class="text-2xl font-bold text-white">{{ $event->start_date ? \Carbon\Carbon::parse($event->start_date)->format('d') : '--' }}</div>
                        <div class="text-xs text-yellow-100 uppercase">{{ $event->start_date ? \Carbon\Carbon::parse($event->start_date)->format('M') : '' }}</div>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-bold text-white mb-1 leading-snug">{{ Str::limit($event->title, 60) }}</h3>
                        @if($event->location)
                        <p class="text-blue-300 text-sm flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                            {{ $event->location }}
                        </p>
                        @endif
                    </div>
                </div>
                @if($event->description)
                <p class="text-blue-300 text-sm mt-3">{{ Str::limit($event->description, 100) }}</p>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Gallery Section --}}
<section class="py-16 bg-white" data-aos="fade-up">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center mb-12">
            <div>
                <h2 class="text-3xl font-bold text-blue-900 mb-2">Galeri Kampus</h2>
                <div class="w-20 h-1 bg-yellow-500"></div>
            </div>
            <a href="{{ route('media.galeri') }}" class="text-blue-700 hover:text-blue-900 font-semibold flex items-center gap-1">
                Lihat Semua
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>
        @if(isset($gallery) && $gallery->count() > 0)
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($gallery->take(8) as $item)
            <div class="overflow-hidden rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:scale-105">
                <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="w-full h-48 object-cover">
            </div>
            @endforeach
        </div>
        @else
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @for($i = 1; $i <= 8; $i++)
            <div class="overflow-hidden rounded-lg shadow-md h-48 bg-gradient-to-br from-blue-{{ ($i % 3 === 0 ? '700' : ($i % 2 === 0 ? '600' : '800')) }} to-blue-900 flex items-center justify-center">
                <svg class="w-12 h-12 text-white opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
            @endfor
        </div>
        @endif
    </div>
</section>

{{-- CTA Section --}}
<section class="py-20 bg-gradient-to-r from-yellow-500 to-yellow-600 text-white" data-aos="fade-up">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">Siap Memulai Perjalanan Pelayanan Anda?</h2>
        <p class="text-lg mb-8 text-yellow-100 max-w-2xl mx-auto">Bergabunglah dengan ribuan alumni STT Siloam Medan yang telah berdampak bagi gereja dan bangsa Indonesia</p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('pmb.daftar') }}" class="bg-white text-yellow-600 hover:bg-gray-100 font-bold py-4 px-10 rounded-full text-lg transition duration-300 shadow-lg">
                Daftar Sekarang
            </a>
            <a href="{{ route('kontak.index') }}" class="border-2 border-white text-white hover:bg-white hover:text-yellow-600 font-bold py-4 px-10 rounded-full text-lg transition duration-300">
                Hubungi Kami
            </a>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
let currentSlide = 0;
const slides = document.querySelectorAll('.hero-slide');

function showSlide(n) {
    if (!slides.length) return;
    slides.forEach(s => s.classList.add('hidden'));
    slides[n].classList.remove('hidden');
}

function nextSlide() {
    currentSlide = (currentSlide + 1) % slides.length;
    showSlide(currentSlide);
}

function prevSlide() {
    currentSlide = (currentSlide - 1 + slides.length) % slides.length;
    showSlide(currentSlide);
}

if (slides.length > 1) {
    setInterval(nextSlide, 5000);
}
</script>
@endpush
