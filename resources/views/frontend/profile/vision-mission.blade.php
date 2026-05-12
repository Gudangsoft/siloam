@extends('layouts.frontend')
@section('title', 'Visi & Misi | STT Siloam Medan')

@push('styles')
<style>
    .vm-hero {
        background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 50%, #1e1b4b 100%);
        position: relative;
        overflow: hidden;
    }
    .vm-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image: radial-gradient(circle at 20% 50%, rgba(59,130,246,0.15) 0%, transparent 60%),
                          radial-gradient(circle at 80% 20%, rgba(99,102,241,0.15) 0%, transparent 50%);
    }
    .vm-orb {
        position: absolute;
        border-radius: 50%;
        filter: blur(80px);
        opacity: 0.2;
        animation: float 8s ease-in-out infinite;
    }
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50%       { transform: translateY(-20px); }
    }
    .visi-section {
        background: linear-gradient(180deg, #f8fafc 0%, #eff6ff 100%);
    }
    .visi-card {
        background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 40%, #2563eb 100%);
        position: relative;
        overflow: hidden;
    }
    .visi-card::before {
        content: '"';
        position: absolute;
        top: -20px;
        left: 20px;
        font-size: 200px;
        font-family: Georgia, serif;
        color: rgba(255,255,255,0.06);
        line-height: 1;
        pointer-events: none;
    }
    .misi-number {
        background: linear-gradient(135deg, #1e40af, #3b82f6);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .misi-line {
        background: linear-gradient(180deg, #3b82f6, #8b5cf6, #6366f1);
    }
    .value-card:hover .value-icon {
        transform: scale(1.15) rotate(-5deg);
        transition: transform 0.3s ease;
    }
    .value-icon {
        transition: transform 0.3s ease;
    }
    .gradient-text {
        background: linear-gradient(135deg, #1e40af, #7c3aed);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
</style>
@endpush

@section('content')

{{-- ===== HERO ===== --}}
<section class="vm-hero min-h-[420px] flex items-center text-white">
    {{-- Orbs --}}
    <div class="vm-orb w-96 h-96 bg-blue-500" style="top:-100px;right:-80px;animation-delay:0s"></div>
    <div class="vm-orb w-72 h-72 bg-purple-600" style="bottom:-80px;left:10%;animation-delay:3s"></div>
    <div class="vm-orb w-56 h-56 bg-indigo-400" style="top:30%;right:25%;animation-delay:1.5s"></div>

    {{-- Bottom wave --}}
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 80" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0 80V40C360 0 1080 80 1440 40V80H0Z" fill="#f8fafc"/>
        </svg>
    </div>

    <div class="relative container mx-auto px-4 py-20 pb-24">
        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-sm text-blue-300 mb-6" data-aos="fade-right">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a>
            <i class="fas fa-chevron-right text-xs text-blue-500"></i>
            <span>Profil</span>
            <i class="fas fa-chevron-right text-xs text-blue-500"></i>
            <span class="text-white font-medium">Visi &amp; Misi</span>
        </nav>

        <div class="max-w-3xl">
            <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/20 text-white text-xs font-semibold px-4 py-2 rounded-full mb-5" data-aos="fade-up">
                <i class="fas fa-bullseye text-yellow-400"></i>
                STT Siloam Medan
            </div>
            <h1 class="text-5xl md:text-6xl font-black leading-tight mb-4" data-aos="fade-up" data-aos-delay="50">
                Visi <span class="text-yellow-400">&amp;</span> Misi
            </h1>
            <p class="text-blue-200 text-lg md:text-xl leading-relaxed max-w-2xl" data-aos="fade-up" data-aos-delay="100">
                Pondasi yang mengarahkan setiap langkah STT Siloam Medan dalam mendidik
                hamba Tuhan yang profesional dan berdampak bagi gereja serta bangsa.
            </p>
        </div>
    </div>
</section>

{{-- ===== VISI ===== --}}
<section class="visi-section py-20">
    <div class="container mx-auto px-4">
        <div class="max-w-5xl mx-auto">

            <div class="text-center mb-10" data-aos="fade-up">
                <span class="inline-flex items-center gap-2 bg-blue-100 text-blue-700 text-xs font-bold px-4 py-2 rounded-full tracking-widest uppercase">
                    <i class="fas fa-eye"></i> Visi Kami
                </span>
            </div>

            <div class="visi-card rounded-3xl shadow-2xl text-white p-10 md:p-16" data-aos="zoom-in" data-aos-duration="800">
                {{-- decorative shapes --}}
                <div class="absolute top-0 right-0 w-72 h-72 bg-white rounded-full opacity-5 translate-x-1/3 -translate-y-1/3"></div>
                <div class="absolute bottom-0 left-0 w-56 h-56 bg-yellow-400 rounded-full opacity-10 -translate-x-1/4 translate-y-1/4"></div>

                <div class="relative flex flex-col md:flex-row items-center md:items-start gap-10">
                    {{-- Icon block --}}
                    <div class="flex-shrink-0 text-center" data-aos="fade-right" data-aos-delay="200">
                        <div class="w-28 h-28 bg-yellow-400 rounded-3xl flex items-center justify-center shadow-2xl mx-auto mb-3" style="transform:rotate(6deg)">
                            <i class="fas fa-eye text-blue-900 text-5xl"></i>
                        </div>
                        <span class="text-yellow-400 text-xs font-black tracking-[0.3em] uppercase">VISION</span>
                    </div>

                    {{-- Text --}}
                    <div class="flex-1" data-aos="fade-left" data-aos-delay="250">
                        <h2 class="text-yellow-400 text-xs font-black tracking-[0.3em] uppercase mb-4">Visi</h2>
                        <p class="text-2xl md:text-3xl font-bold leading-relaxed text-white mb-0">
                            "Menjadi Sekolah Tinggi Teologi yang handal dalam mendidik tenaga
                            <span class="text-yellow-300">Guru Agama Kristen yang profesional</span>
                            dan hamba Tuhan yang mampu
                            <span class="text-yellow-300">menggembalakan jemaat</span>."
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ===== MISI ===== --}}
<section class="bg-white py-20">
    <div class="container mx-auto px-4">
        <div class="max-w-5xl mx-auto">

            <div class="text-center mb-14" data-aos="fade-up">
                <span class="inline-flex items-center gap-2 bg-indigo-100 text-indigo-700 text-xs font-bold px-4 py-2 rounded-full tracking-widest uppercase mb-4">
                    <i class="fas fa-rocket"></i> Misi Kami
                </span>
                <h2 class="text-4xl md:text-5xl font-black gradient-text">Empat Pilar Misi</h2>
                <p class="text-gray-400 mt-3 text-base max-w-md mx-auto">Landasan gerak dan arah pelayanan STT Siloam Medan</p>
            </div>

            @php
            $misi = [
                [
                    'no'    => '01',
                    'title' => 'Pendidikan & Pengajaran',
                    'icon'  => 'fas fa-graduation-cap',
                    'color' => ['from' => '#1e40af', 'to' => '#3b82f6', 'light' => '#eff6ff', 'border' => '#bfdbfe', 'badge' => '#dbeafe', 'badge_text' => '#1e40af'],
                    'text'  => 'Menyelenggarakan pendidikan dan pengajaran yang handal di bidang teologi dan pendidikan agama Kristen.',
                ],
                [
                    'no'    => '02',
                    'title' => 'Penelitian Teologi',
                    'icon'  => 'fas fa-microscope',
                    'color' => ['from' => '#4338ca', 'to' => '#6366f1', 'light' => '#eef2ff', 'border' => '#c7d2fe', 'badge' => '#e0e7ff', 'badge_text' => '#4338ca'],
                    'text'  => 'Menyelenggarakan penelitian teologi dan pendidikan agama Kristen yang handal dalam konteks Pendidikan Agama Kristen dan penggembalaan jemaat.',
                ],
                [
                    'no'    => '03',
                    'title' => 'Pengabdian Masyarakat',
                    'icon'  => 'fas fa-hands-helping',
                    'color' => ['from' => '#6d28d9', 'to' => '#8b5cf6', 'light' => '#f5f3ff', 'border' => '#ddd6fe', 'badge' => '#ede9fe', 'badge_text' => '#6d28d9'],
                    'text'  => 'Menyelenggarakan pengabdian masyarakat yang handal dalam bidang pelayanan gereja dan sekolah.',
                ],
                [
                    'no'    => '04',
                    'title' => 'Semangat Oikumenis',
                    'icon'  => 'fas fa-globe-asia',
                    'color' => ['from' => '#7c3aed', 'to' => '#a855f7', 'light' => '#faf5ff', 'border' => '#e9d5ff', 'badge' => '#f3e8ff', 'badge_text' => '#7c3aed'],
                    'text'  => 'Menyelenggarakan pendidikan agama Kristen dan penggembalaan jemaat dengan semangat oikumenis.',
                ],
            ];
            @endphp

            <div class="relative">
                {{-- Vertical connector line (desktop) --}}
                <div class="hidden md:block absolute left-[calc(50%-1px)] top-8 bottom-8 w-0.5 bg-gradient-to-b from-blue-400 via-indigo-400 to-purple-400 opacity-20"></div>

                <div class="space-y-6">
                    @foreach($misi as $i => $m)
                    @php $even = ($i % 2 === 0); @endphp
                    <div class="flex flex-col md:flex-row items-center gap-0 md:gap-8 {{ $even ? '' : 'md:flex-row-reverse' }}"
                         data-aos="{{ $even ? 'fade-right' : 'fade-left' }}" data-aos-delay="{{ $i * 80 }}">

                        {{-- Card --}}
                        <div class="flex-1 w-full">
                            <div class="rounded-2xl p-7 border-2 hover:shadow-xl transition-all duration-300 hover:-translate-y-1 group"
                                 style="background:{{ $m['color']['light'] }};border-color:{{ $m['color']['border'] }}">
                                <div class="flex items-start gap-5">
                                    {{-- Icon --}}
                                    <div class="flex-shrink-0 w-14 h-14 rounded-2xl flex items-center justify-center shadow-lg"
                                         style="background:linear-gradient(135deg,{{ $m['color']['from'] }},{{ $m['color']['to'] }})">
                                        <i class="{{ $m['icon'] }} text-white text-xl"></i>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center gap-3 mb-2">
                                            <span class="text-xs font-black px-2.5 py-1 rounded-full"
                                                  style="background:{{ $m['color']['badge'] }};color:{{ $m['color']['badge_text'] }}">
                                                MISI {{ $m['no'] }}
                                            </span>
                                            <h3 class="font-bold text-base text-gray-800">{{ $m['title'] }}</h3>
                                        </div>
                                        <p class="text-gray-600 leading-relaxed text-sm md:text-base">{{ $m['text'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Center number (desktop) --}}
                        <div class="hidden md:flex flex-shrink-0 w-14 h-14 rounded-full items-center justify-center z-10 shadow-lg font-black text-xl text-white"
                             style="background:linear-gradient(135deg,{{ $m['color']['from'] }},{{ $m['color']['to'] }})">
                            {{ $i + 1 }}
                        </div>

                        {{-- Empty right side for alternating --}}
                        <div class="flex-1 hidden md:block"></div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ===== NILAI-NILAI UTAMA ===== --}}
<section class="py-20" style="background:linear-gradient(180deg,#f8fafc 0%,#eff6ff 100%)">
    <div class="container mx-auto px-4">
        <div class="max-w-5xl mx-auto">

            <div class="text-center mb-14" data-aos="fade-up">
                <span class="inline-flex items-center gap-2 bg-yellow-100 text-yellow-700 text-xs font-bold px-4 py-2 rounded-full tracking-widest uppercase mb-4">
                    <i class="fas fa-star"></i> Core Values
                </span>
                <h2 class="text-4xl font-black text-blue-900">Nilai-Nilai Utama</h2>
                <p class="text-gray-400 mt-3">Yang menjiwai seluruh kehidupan akademik dan pelayanan kampus</p>
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach([
                    ['icon'=>'fas fa-shield-alt','label'=>'Integritas',  'desc'=>'Jujur dan konsisten dalam setiap tindakan dan keputusan',    'from'=>'#1e40af','to'=>'#3b82f6','light'=>'#eff6ff','txt'=>'#1e40af'],
                    ['icon'=>'fas fa-crown',      'label'=>'Keunggulan', 'desc'=>'Standar tinggi dalam setiap aspek pendidikan dan pelayanan',  'from'=>'#b45309','to'=>'#f59e0b','light'=>'#fffbeb','txt'=>'#92400e'],
                    ['icon'=>'fas fa-heart',      'label'=>'Pelayanan',  'desc'=>'Hati yang tulus melayani Tuhan dan sesama tanpa pamrih',      'from'=>'#065f46','to'=>'#10b981','light'=>'#ecfdf5','txt'=>'#065f46'],
                    ['icon'=>'fas fa-users',      'label'=>'Komunitas',  'desc'=>'Membangun persekutuan yang solid dan saling menguatkan',      'from'=>'#6d28d9','to'=>'#8b5cf6','light'=>'#f5f3ff','txt'=>'#5b21b6'],
                ] as $i => $val)
                <div class="value-card bg-white rounded-3xl p-7 text-center shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-2 border border-slate-100"
                     data-aos="fade-up" data-aos-delay="{{ $i * 80 }}">
                    <div class="value-icon w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-5 shadow-lg"
                         style="background:linear-gradient(135deg,{{ $val['from'] }},{{ $val['to'] }})">
                        <i class="{{ $val['icon'] }} text-white text-2xl"></i>
                    </div>
                    <h3 class="font-black text-lg mb-2" style="color:{{ $val['from'] }}">{{ $val['label'] }}</h3>
                    <p class="text-gray-500 text-xs leading-relaxed">{{ $val['desc'] }}</p>
                </div>
                @endforeach
            </div>

        </div>
    </div>
</section>

{{-- ===== ADMIN CONTENT (jika ada) ===== --}}
@if(isset($page) && $page?->content)
<section class="bg-white py-14" data-aos="fade-up">
    <div class="container mx-auto px-4 max-w-4xl">
        <div class="bg-blue-50 border border-blue-100 rounded-3xl p-10 prose prose-blue max-w-none text-gray-700">
            {!! clean($page->content) !!}
        </div>
    </div>
</section>
@endif

{{-- ===== CTA ===== --}}
<section class="relative py-20 overflow-hidden" style="background:linear-gradient(135deg,#0f172a 0%,#1e3a8a 60%,#1e1b4b 100%)">
    <div class="absolute inset-0 opacity-10">
        <svg width="100%" height="100%"><defs><pattern id="ctag" width="32" height="32" patternUnits="userSpaceOnUse"><path d="M32 0L0 0 0 32" fill="none" stroke="white" stroke-width="0.8"/></pattern></defs><rect width="100%" height="100%" fill="url(#ctag)"/></svg>
    </div>
    <div class="absolute -top-20 -right-20 w-80 h-80 bg-blue-500 rounded-full opacity-10 blur-3xl"></div>
    <div class="absolute -bottom-16 -left-16 w-64 h-64 bg-purple-500 rounded-full opacity-10 blur-3xl"></div>

    <div class="relative container mx-auto px-4 text-center text-white">
        <div class="inline-flex items-center gap-2 bg-white/10 border border-white/20 text-white text-xs font-semibold px-4 py-2 rounded-full mb-6" data-aos="fade-up">
            <i class="fas fa-church text-yellow-400"></i> STT Siloam Medan
        </div>
        <h3 class="text-3xl md:text-4xl font-black mb-4 leading-tight" data-aos="fade-up" data-aos-delay="50">
            Bergabunglah Bersama Kami
        </h3>
        <p class="text-blue-200 text-lg mb-10 max-w-xl mx-auto leading-relaxed" data-aos="fade-up" data-aos-delay="100">
            Jadilah bagian dari keluarga besar yang berkomitmen membentuk
            hamba Tuhan yang handal dan berdampak bagi gereja dan bangsa.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center" data-aos="fade-up" data-aos-delay="150">
            <a href="{{ route('pmb.daftar') }}"
               class="inline-flex items-center justify-center gap-3 bg-yellow-400 hover:bg-yellow-300 text-blue-900 font-black px-10 py-4 rounded-full shadow-2xl transition-all duration-200 hover:-translate-y-1 hover:shadow-yellow-400/30 text-base">
                <i class="fas fa-pen-to-square"></i> Daftar Sekarang
            </a>
            <a href="{{ route('profil.sejarah') }}"
               class="inline-flex items-center justify-center gap-3 bg-white/10 hover:bg-white/20 border-2 border-white/30 hover:border-white/50 text-white font-semibold px-10 py-4 rounded-full transition-all duration-200 hover:-translate-y-1 text-base backdrop-blur-sm">
                <i class="fas fa-landmark"></i> Sejarah Kampus
            </a>
        </div>
    </div>
</section>

@endsection
