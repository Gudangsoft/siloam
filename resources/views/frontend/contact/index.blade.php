@extends('layouts.frontend')
@section('title', 'Hubungi Kami | STT Siloam Medan')
@section('content')

<div class="bg-blue-900 text-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold">Hubungi Kami</h1>
        <nav class="text-sm mt-2">
            <a href="{{ route('home') }}" class="text-blue-300 hover:text-white">Beranda</a>
            <span class="mx-2 text-blue-400">&#x203A;</span>
            <span class="text-white">Kontak</span>
        </nav>
    </div>
</div>

<div class="container mx-auto px-4 py-12">
    <div class="flex flex-col lg:flex-row gap-10">

        {{-- Contact Info --}}
        <div class="lg:w-1/3 space-y-6" data-aos="fade-right">
            <div class="bg-blue-900 text-white rounded-xl p-6">
                <h2 class="text-xl font-bold mb-6">Informasi Kontak</h2>
                <div class="space-y-5">
                    <div class="flex gap-4">
                        <div class="bg-blue-700 w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                        </div>
                        <div>
                            <p class="font-semibold text-blue-200 text-sm">Alamat</p>
                            <p class="text-white text-sm">{{ isset($siteSettings) ? $siteSettings->get('address', 'Jl. Bunga Raya No. 1, Medan, Sumatera Utara') : 'Jl. Bunga Raya No. 1, Medan, Sumatera Utara' }}</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="bg-blue-700 w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </div>
                        <div>
                            <p class="font-semibold text-blue-200 text-sm">Telepon</p>
                            <p class="text-white text-sm">{{ isset($siteSettings) ? $siteSettings->get('phone', '(061) 8888-1234') : '(061) 8888-1234' }}</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="bg-blue-700 w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <div>
                            <p class="font-semibold text-blue-200 text-sm">Email</p>
                            <p class="text-white text-sm">{{ isset($siteSettings) ? $siteSettings->get('email', 'info@sttsiloammedan.ac.id') : 'info@sttsiloammedan.ac.id' }}</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="bg-blue-700 w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <p class="font-semibold text-blue-200 text-sm">Jam Operasional</p>
                            <p class="text-white text-sm">Senin - Jumat: 08.00 - 17.00 WIB</p>
                            <p class="text-white text-sm">Sabtu: 08.00 - 12.00 WIB</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Social Media --}}
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="font-bold text-blue-900 mb-4">Ikuti Kami</h3>
                <div class="flex gap-3">
                    @if(isset($siteSettings) && $siteSettings->get('facebook'))
                    <a href="{{ $siteSettings->get('facebook') }}" target="_blank" class="bg-blue-600 hover:bg-blue-700 text-white w-10 h-10 rounded-full flex items-center justify-center transition">f</a>
                    @endif
                    @if(isset($siteSettings) && $siteSettings->get('instagram'))
                    <a href="{{ $siteSettings->get('instagram') }}" target="_blank" class="bg-pink-500 hover:bg-pink-600 text-white w-10 h-10 rounded-full flex items-center justify-center transition">ig</a>
                    @endif
                    @if(isset($siteSettings) && $siteSettings->get('youtube'))
                    <a href="{{ $siteSettings->get('youtube') }}" target="_blank" class="bg-red-600 hover:bg-red-700 text-white w-10 h-10 rounded-full flex items-center justify-center transition">yt</a>
                    @endif
                    <a href="#" class="bg-green-500 hover:bg-green-600 text-white w-10 h-10 rounded-full flex items-center justify-center transition text-xs font-bold">WA</a>
                </div>
            </div>
        </div>

        {{-- Contact Form + Map --}}
        <div class="lg:w-2/3 space-y-8">
            {{-- Contact Form --}}
            <div class="bg-white rounded-xl shadow-md p-8" data-aos="fade-left">
                <h2 class="text-2xl font-bold text-blue-900 mb-6">Kirim Pesan</h2>

                @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
                    {{ session('success') }}
                </div>
                @endif

                @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('kontak.store') }}" method="POST" class="space-y-5">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                   class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                                   placeholder="Nama Anda">
                            @error('name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Email <span class="text-red-500">*</span></label>
                            <input type="email" name="email" value="{{ old('email') }}" required
                                   class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror"
                                   placeholder="email@domain.com">
                            @error('email')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Nomor Telepon</label>
                            <input type="text" name="phone" value="{{ old('phone') }}"
                                   class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="08xxxxxxxxxx">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Subjek <span class="text-red-500">*</span></label>
                            <input type="text" name="subject" value="{{ old('subject') }}" required
                                   class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('subject') border-red-500 @enderror"
                                   placeholder="Perihal pesan Anda">
                            @error('subject')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Pesan <span class="text-red-500">*</span></label>
                        <textarea name="message" required rows="6"
                                  class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('message') border-red-500 @enderror"
                                  placeholder="Tulis pesan Anda di sini...">{{ old('message') }}</textarea>
                        @error('message')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                    <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-3 px-8 rounded-full transition shadow-md w-full md:w-auto">
                        Kirim Pesan
                    </button>
                </form>
            </div>

            {{-- Google Maps --}}
            <div class="bg-white rounded-xl shadow-md overflow-hidden" data-aos="fade-up">
                <div class="p-4 bg-gray-50 border-b">
                    <h3 class="font-bold text-blue-900">Lokasi Kampus</h3>
                </div>
                @if(isset($siteSettings) && $siteSettings->get('maps_embed'))
                <div class="aspect-video">
                    {!! $siteSettings->get('maps_embed') !!}
                </div>
                @else
                <div class="aspect-video bg-gray-200 flex items-center justify-center">
                    <div class="text-center text-gray-500">
                        <svg class="w-16 h-16 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
                        <p>Peta belum dikonfigurasi</p>
                        <a href="{{ route('profil.lokasi') }}" class="text-blue-600 text-sm hover:underline mt-1 block">Lihat Lokasi</a>
                    </div>
                </div>
                @endif
            </div>
        </div>

    </div>
</div>

@endsection
