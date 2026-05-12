@extends('layouts.frontend')
@section('title', 'Hubungi Kami')
@section('content')

{{-- Hero --}}
<div class="text-white py-16 relative overflow-hidden"
     style="background:linear-gradient(135deg,#0f172a 0%,#1e3a8a 60%,#1d4ed8 100%)">
    <div class="container mx-auto px-4 relative z-10">
        <div class="flex items-center gap-3 mb-3">
            <div class="w-10 h-10 rounded-lg bg-white bg-opacity-15 flex items-center justify-center">
                <i class="fas fa-envelope text-yellow-400 text-lg"></i>
            </div>
            <nav class="text-sm text-blue-300">
                <a href="{{ route('home') }}" class="hover:text-white">Beranda</a>
                <span class="mx-2">›</span>
                <span class="text-white">Hubungi Kami</span>
            </nav>
        </div>
        <h1 class="text-4xl font-bold mb-2">Hubungi Kami</h1>
        <p class="text-blue-200 text-sm max-w-xl">
            Ada pertanyaan? Kami siap membantu. Isi formulir di bawah atau hubungi kami langsung.
        </p>
    </div>
</div>

<div class="container mx-auto px-4 py-14">
    <div class="flex flex-col lg:flex-row gap-10">

        {{-- ── Info Kontak ───────────────────────── --}}
        <div class="lg:w-2/5 space-y-6" data-aos="fade-right">

            {{-- Card info --}}
            <div class="rounded-2xl overflow-hidden shadow-lg"
                 style="background:linear-gradient(145deg,#1e3a8a,#1d4ed8)">
                <div class="p-8">
                    <h2 class="text-xl font-bold text-white mb-6">Informasi Kontak</h2>
                    <div class="space-y-5">
                        @foreach([
                            ['fa-map-marker-alt', 'Alamat', $siteSettings->get('address') ?: '-'],
                            ['fa-phone', 'Telepon', $siteSettings->get('phone') ?: '-'],
                            ['fa-envelope', 'Email', $siteSettings->get('email') ?: '-'],
                            ['fa-clock', 'Jam Operasional', "Senin–Jumat: 08.00–17.00 WIB\nSabtu: 08.00–12.00 WIB"],
                        ] as [$icon, $label, $val])
                        <div class="flex gap-4">
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0"
                                 style="background:rgba(255,255,255,0.15)">
                                <i class="fas {{ $icon }} text-yellow-400 text-sm"></i>
                            </div>
                            <div>
                                <p class="text-blue-300 text-xs font-semibold uppercase tracking-wider">{{ $label }}</p>
                                <p class="text-white text-sm mt-0.5" style="white-space:pre-line">{{ $val }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Social media --}}
                <div class="px-8 pb-8 flex gap-3">
                    @if($siteSettings->get('facebook'))
                    <a href="{{ $siteSettings->get('facebook') }}" target="_blank" rel="noopener"
                       class="w-9 h-9 rounded-full flex items-center justify-center hover:opacity-80 transition text-white"
                       style="background:#1877f2"><i class="fab fa-facebook-f text-xs"></i></a>
                    @endif
                    @if($siteSettings->get('instagram'))
                    <a href="{{ $siteSettings->get('instagram') }}" target="_blank" rel="noopener"
                       class="w-9 h-9 rounded-full flex items-center justify-center hover:opacity-80 transition text-white"
                       style="background:#e1306c"><i class="fab fa-instagram text-xs"></i></a>
                    @endif
                    @if($siteSettings->get('youtube'))
                    <a href="{{ $siteSettings->get('youtube') }}" target="_blank" rel="noopener"
                       class="w-9 h-9 rounded-full flex items-center justify-center hover:opacity-80 transition text-white"
                       style="background:#ff0000"><i class="fab fa-youtube text-xs"></i></a>
                    @endif
                    @if($siteSettings->get('whatsapp'))
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/','',$siteSettings->get('whatsapp')) }}"
                       target="_blank" rel="noopener"
                       class="w-9 h-9 rounded-full flex items-center justify-center hover:opacity-80 transition text-white"
                       style="background:#25d366"><i class="fab fa-whatsapp text-xs"></i></a>
                    @endif
                </div>
            </div>

            {{-- Google Maps --}}
            @if($siteSettings->get('maps_embed'))
            <div class="rounded-2xl overflow-hidden shadow-lg" data-aos="fade-up">
                <div class="bg-gray-50 px-5 py-3 border-b border-gray-100">
                    <p class="font-bold text-blue-900 text-sm"><i class="fas fa-map-marker-alt mr-1 text-red-500"></i>Lokasi Kampus</p>
                </div>
                <div class="aspect-video">
                    {!! $siteSettings->get('maps_embed') !!}
                </div>
            </div>
            @endif
        </div>

        {{-- ── Formulir ──────────────────────────── --}}
        <div class="lg:w-3/5" data-aos="fade-left">
            <div class="bg-white rounded-2xl shadow-lg p-8 md:p-10">
                <h2 class="text-2xl font-bold text-blue-900 mb-1">Kirim Pesan</h2>
                <p class="text-gray-500 text-sm mb-7">Kami akan membalas dalam 1×24 jam kerja.</p>

                {{-- Success --}}
                @if(session('success'))
                <div class="flex items-start gap-3 bg-green-50 border border-green-200 text-green-800 px-5 py-4 rounded-xl mb-6">
                    <i class="fas fa-check-circle text-green-500 mt-0.5 flex-shrink-0"></i>
                    <div>
                        <p class="font-semibold">Pesan Terkirim!</p>
                        <p class="text-sm mt-0.5">{{ session('success') }}</p>
                    </div>
                </div>
                @endif

                {{-- Errors --}}
                @if($errors->any())
                <div class="flex items-start gap-3 bg-red-50 border border-red-200 text-red-700 px-5 py-4 rounded-xl mb-6">
                    <i class="fas fa-exclamation-triangle text-red-500 mt-0.5 flex-shrink-0"></i>
                    <ul class="text-sm space-y-0.5">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('kontak.store') }}" method="POST" class="space-y-5">
                    @csrf

                    {{-- Row 1: Nama + Email --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                   maxlength="255"
                                   class="w-full border rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition
                                          {{ $errors->has('name') ? 'border-red-400 bg-red-50' : 'border-gray-200' }}"
                                   placeholder="Nama lengkap Anda">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <input type="email" name="email" value="{{ old('email') }}" required
                                   maxlength="100"
                                   class="w-full border rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition
                                          {{ $errors->has('email') ? 'border-red-400 bg-red-50' : 'border-gray-200' }}"
                                   placeholder="email@domain.com">
                        </div>
                    </div>

                    {{-- Row 2: Telepon + Subjek --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nomor Telepon</label>
                            <input type="tel" name="phone" value="{{ old('phone') }}"
                                   maxlength="20"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                                   placeholder="08xxxxxxxxxx">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                                Subjek <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="subject" value="{{ old('subject') }}" required
                                   maxlength="255"
                                   class="w-full border rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition
                                          {{ $errors->has('subject') ? 'border-red-400 bg-red-50' : 'border-gray-200' }}"
                                   placeholder="Perihal pesan Anda">
                        </div>
                    </div>

                    {{-- Pesan --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                            Pesan <span class="text-red-500">*</span>
                        </label>
                        <textarea name="message" required rows="5" maxlength="3000"
                                  class="w-full border rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition resize-none
                                         {{ $errors->has('message') ? 'border-red-400 bg-red-50' : 'border-gray-200' }}"
                                  placeholder="Tulis pesan Anda di sini...">{{ old('message') }}</textarea>
                        <p class="text-xs text-gray-400 mt-1 text-right">Maks. 3000 karakter</p>
                    </div>

                    {{-- CAPTCHA --}}
                    <div class="rounded-xl border-2 border-dashed border-blue-100 bg-blue-50 px-5 py-4">
                        <p class="text-sm font-semibold text-blue-900 mb-3">
                            <i class="fas fa-shield-alt mr-1 text-blue-500"></i>
                            Verifikasi Keamanan
                        </p>
                        <div class="flex items-center gap-4 flex-wrap">
                            <div class="flex items-center gap-3">
                                <span class="text-2xl font-bold text-blue-900">{{ $a }}</span>
                                <span class="text-xl font-bold text-blue-400">+</span>
                                <span class="text-2xl font-bold text-blue-900">{{ $b }}</span>
                                <span class="text-xl font-bold text-blue-400">=</span>
                            </div>
                            <input type="number" name="captcha" required
                                   min="0" max="99"
                                   style="width:90px"
                                   class="border-2 rounded-xl px-4 py-2 text-center text-xl font-bold text-blue-900 focus:outline-none focus:border-blue-500 transition
                                          {{ $errors->has('captcha') ? 'border-red-400 bg-red-50' : 'border-blue-200 bg-white' }}"
                                   placeholder="?">
                        </div>
                        <p class="text-xs text-blue-500 mt-2">Isi jawaban dari perhitungan di atas untuk membuktikan Anda bukan robot.</p>
                        @error('captcha')
                        <p class="text-red-500 text-xs mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Submit --}}
                    <button type="submit"
                            class="w-full md:w-auto inline-flex items-center justify-center gap-2 text-white font-bold py-3 px-10 rounded-full transition shadow-md hover:shadow-lg hover:-translate-y-0.5 transform"
                            style="background:linear-gradient(135deg,#1e3a8a,#2563eb)">
                        <i class="fas fa-paper-plane"></i>
                        Kirim Pesan
                    </button>

                    <p class="text-xs text-gray-400">
                        <i class="fas fa-lock mr-1"></i>
                        Data Anda aman dan tidak akan disebarkan kepada pihak ketiga.
                    </p>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
