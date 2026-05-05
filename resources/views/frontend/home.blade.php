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

{{-- Stats Section --}}
@if(isset($stats))
<section class="bg-blue-900 text-white py-10" data-aos="fade-up">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
            <div class="p-4">
                <div class="text-4xl font-bold text-yellow-400">{{ $stats['students'] ?? '500' }}+</div>
                <div class="text-gray-300 mt-1">Mahasiswa Aktif</div>
            </div>
            <div class="p-4">
                <div class="text-4xl font-bold text-yellow-400">{{ $stats['alumni'] ?? '1000' }}+</div>
                <div class="text-gray-300 mt-1">Alumni</div>
            </div>
            <div class="p-4">
                <div class="text-4xl font-bold text-yellow-400">{{ $stats['lecturers'] ?? '30' }}+</div>
                <div class="text-gray-300 mt-1">Dosen</div>
            </div>
            <div class="p-4">
                <div class="text-4xl font-bold text-yellow-400">{{ $stats['programs'] ?? '4' }}</div>
                <div class="text-gray-300 mt-1">Program Studi</div>
            </div>
        </div>
    </div>
</section>
@endif

{{-- Program Studi Section --}}
@if(isset($programs) && $programs->count() > 0)
<section class="py-16 bg-gray-50" data-aos="fade-up">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-blue-900 mb-3">Program Studi</h2>
            <p class="text-gray-600 max-w-xl mx-auto">Pilih program studi yang sesuai dengan panggilan dan tujuan pelayanan Anda</p>
            <div class="w-20 h-1 bg-yellow-500 mx-auto mt-4"></div>
        </div>
        <div class="flex flex-wrap justify-center gap-8">
            @foreach($programs as $program)
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300 transform hover:-translate-y-1 w-full md:w-80" data-aos="fade-up">
                @if($program->image)
                <img src="{{ $program->image_url }}" alt="{{ $program->name }}" class="w-full h-48 object-cover">
                @else
                <div class="w-full h-48 bg-gradient-to-br from-blue-700 to-blue-900 flex items-center justify-center">
                    <svg class="w-16 h-16 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                    </svg>
                </div>
                @endif
                <div class="p-6">
                    @if($program->degree)
                    <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2 py-1 rounded-full">{{ $program->degree }}</span>
                    @endif
                    <h3 class="text-xl font-bold text-blue-900 mt-3 mb-2">{{ $program->name }}</h3>
                    <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ Str::limit($program->description, 120) }}</p>
                    <a href="{{ route('akademik.program-detail', $program->slug) }}" class="text-blue-700 font-semibold hover:text-blue-900 flex items-center gap-1 text-sm">
                        Lihat Detail
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Sambutan Ketua Section --}}
@if(isset($siteSettings))
<section class="py-16 bg-white" data-aos="fade-up">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row items-center gap-12">
            <div class="md:w-1/3 text-center">
                <div class="w-48 h-48 rounded-full overflow-hidden mx-auto border-4 border-yellow-500 shadow-xl">
                    @if($siteSettings->get('rector_photo'))
                    <img src="{{ Storage::disk('public')->url($siteSettings->get('rector_photo')) }}" alt="Ketua STT" class="w-full h-full object-cover">
                    @else
                    <div class="w-full h-full bg-blue-100 flex items-center justify-center">
                        <svg class="w-24 h-24 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    @endif
                </div>
                <h3 class="text-xl font-bold text-blue-900 mt-4">{{ $siteSettings->get('rector_name', 'Ketua STT Siloam Medan') }}</h3>
                <p class="text-gray-500 text-sm">Ketua STT Siloam Medan</p>
            </div>
            <div class="md:w-2/3">
                <div class="text-center md:text-left mb-6">
                    <h2 class="text-3xl font-bold text-blue-900 mb-3">Sambutan Ketua</h2>
                    <div class="w-20 h-1 bg-yellow-500 md:mx-0 mx-auto"></div>
                </div>
                <div class="text-gray-700 leading-relaxed italic text-lg">
                    <span class="text-5xl text-yellow-400 font-serif leading-none float-left mr-2">"</span>
                    {!! nl2br(e($siteSettings->get('rector_message', 'STT Siloam Medan hadir untuk mencetak pemimpin gereja yang berkarakter Kristus, berpengetahuan teologi yang mendalam, dan siap melayani di berbagai bidang kehidupan.'))) !!}
                    <span class="text-5xl text-yellow-400 font-serif leading-none">"</span>
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
