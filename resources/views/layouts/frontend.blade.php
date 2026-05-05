<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield("title", $siteSettings->get("app_name","STT Siloam Medan"))</title>
    @if($siteSettings->get("favicon"))
    <link rel="icon" href="{{ Storage::disk('public')->url($siteSettings->get('favicon')) }}">
    @endif
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>body{font-family:"Inter",sans-serif;}.nav-link{color:#374151;font-weight:500;transition:color 0.2s;padding:0.5rem 0.75rem;border-radius:0.375rem;font-size:0.875rem;display:inline-block;}.nav-link:hover{color:#1e3a8a;}.dropdown-menu{position:absolute;top:100%;left:0;margin-top:4px;width:14rem;background:white;box-shadow:0 10px 25px rgba(0,0,0,0.15);border-radius:0.5rem;border:1px solid #f3f4f6;opacity:0;visibility:hidden;transition:all 0.2s;z-index:50;}.group:hover .dropdown-menu{opacity:1;visibility:visible;}</style>
    @stack("styles")
</head>
<body class="bg-gray-50">
<!-- Top Bar -->
<div class="bg-blue-900 text-white py-2 text-sm">
    <div class="container mx-auto px-4 flex flex-wrap justify-between items-center gap-2">
        <div class="flex items-center gap-4">
            <a href="mailto:{{ $siteSettings->get("email","info@sttsiloammedan.ac.id") }}" class="text-gray-200 hover:text-white flex items-center gap-1">
                <i class="fas fa-envelope text-xs"></i><span class="hidden sm:inline">{{ $siteSettings->get("email","info@sttsiloammedan.ac.id") }}</span>
            </a>
            <a href="tel:{{ $siteSettings->get("phone","+62618765432") }}" class="text-gray-200 hover:text-white flex items-center gap-1">
                <i class="fas fa-phone text-xs"></i><span>{{ $siteSettings->get("phone","+62618765432") }}</span>
            </a>
        </div>
        <div class="flex items-center gap-3">
            @if($siteSettings->get("facebook"))<a href="{{ $siteSettings->get("facebook") }}" target="_blank" class="text-gray-200 hover:text-white"><i class="fab fa-facebook"></i></a>@endif
            @if($siteSettings->get("instagram"))<a href="{{ $siteSettings->get("instagram") }}" target="_blank" class="text-gray-200 hover:text-white"><i class="fab fa-instagram"></i></a>@endif
            @if($siteSettings->get("youtube"))<a href="{{ $siteSettings->get("youtube") }}" target="_blank" class="text-gray-200 hover:text-white"><i class="fab fa-youtube"></i></a>@endif
        </div>
    </div>
</div>
<!-- Navbar -->
<nav class="bg-white shadow-md sticky top-0 z-50" x-data="{open:false}">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between h-16">
            <a href="{{ route("home") }}" class="flex items-center gap-3">
                @if($siteSettings->get("logo"))
                    <img src="{{ Storage::disk('public')->url($siteSettings->get('logo')) }}"
                         style="height:48px;max-width:160px;object-fit:contain;flex-shrink:0"
                         alt="{{ $siteSettings->get('app_name','STT Siloam Medan') }}">
                @else
                <div class="w-12 h-12 bg-blue-900 rounded-full flex items-center justify-center flex-shrink-0">
                    <span class="text-white font-bold text-lg">S</span>
                </div>
                @endif
                <div class="hidden sm:block">
                    <div class="font-bold text-blue-900 text-base leading-tight">{{ $siteSettings->get("app_name","STT Siloam Medan") }}</div>
                    <div class="text-xs text-gray-500">{{ $siteSettings->get("tagline","Sekolah Tinggi Teologi") }}</div>
                </div>
            </a>
            <div class="hidden lg:flex items-center">
                <a href="{{ route("home") }}" class="nav-link">Beranda</a>
                <div class="relative group"><button class="nav-link flex items-center gap-1">Profil <i class="fas fa-chevron-down text-xs"></i></button>
                    <div class="dropdown-menu"><div class="py-1">
                        <a href="{{ route("profil.sejarah") }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Sejarah Kampus</a>
                        <a href="{{ route("profil.visi-misi") }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Visi, Misi & Tujuan</a>
                        <a href="{{ route("profil.struktur") }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Struktur Organisasi</a>
                        <a href="{{ route("profil.pimpinan") }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Pimpinan</a>
                        <a href="{{ route("profil.dosen-staff") }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Dosen & Staff</a>
                        <a href="{{ route("profil.fasilitas") }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Fasilitas</a>
                        <a href="{{ route("profil.akreditasi") }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Akreditasi</a>
                        <a href="{{ route("profil.lokasi") }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Lokasi & Kontak</a>
                    </div></div>
                </div>
                <div class="relative group"><button class="nav-link flex items-center gap-1">Akademik <i class="fas fa-chevron-down text-xs"></i></button>
                    <div class="dropdown-menu"><div class="py-1">
                        <a href="{{ route("akademik.program-studi") }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Program Studi</a>
                        <a href="{{ route("akademik.kurikulum") }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Kurikulum</a>
                        <a href="{{ route("akademik.kalender") }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Kalender Akademik</a>
                        <a href="{{ route("akademik.elearning") }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">E-Learning</a>
                        <a href="{{ route("akademik.perpustakaan") }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Perpustakaan Digital</a>
                    </div></div>
                </div>
                <div class="relative group"><button class="nav-link flex items-center gap-1">PMB <i class="fas fa-chevron-down text-xs"></i></button>
                    <div class="dropdown-menu"><div class="py-1">
                        <a href="{{ route("pmb.index") }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Info PMB</a>
                        <a href="{{ route("pmb.syarat") }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Syarat & Ketentuan</a>
                        <a href="{{ route("pmb.biaya") }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Biaya Pendidikan</a>
                        <a href="{{ route("pmb.beasiswa") }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Beasiswa</a>
                        <a href="{{ route("pmb.jadwal") }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Jadwal PMB</a>
                        <div class="border-t my-1"></div>
                        <a href="{{ route("pmb.daftar") }}" class="block px-4 py-2 text-sm font-semibold text-blue-900 hover:bg-blue-50"><i class="fas fa-user-plus mr-1"></i>Daftar Sekarang</a>
                    </div></div>
                </div>
                <a href="{{ route("penelitian.index") }}" class="nav-link">Penelitian</a>
                <div class="relative group"><button class="nav-link flex items-center gap-1">Berita <i class="fas fa-chevron-down text-xs"></i></button>
                    <div class="dropdown-menu"><div class="py-1">
                        <a href="{{ route("berita.index") }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Berita & Artikel</a>
                        <a href="{{ route("media.agenda") }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Event & Agenda</a>
                        <a href="{{ route("media.galeri") }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Galeri Foto</a>
                        <a href="{{ route("media.video") }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Video</a>
                    </div></div>
                </div>
                <div class="relative group"><button class="nav-link flex items-center gap-1">Mahasiswa <i class="fas fa-chevron-down text-xs"></i></button>
                    <div class="dropdown-menu"><div class="py-1">
                        <a href="{{ route("kemahasiswaan.organisasi") }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Organisasi Mahasiswa</a>
                        <a href="{{ route("kemahasiswaan.prestasi") }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Prestasi</a>
                        <a href="{{ route("kemahasiswaan.alumni") }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Alumni</a>
                        <a href="{{ route("kemahasiswaan.layanan") }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Layanan Mahasiswa</a>
                        <a href="{{ route("kemahasiswaan.karir") }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Karir & Tracer Study</a>
                    </div></div>
                </div>
                <a href="{{ route("kerjasama.index") }}" class="nav-link">Kerjasama</a>
                <a href="{{ route("kontak.index") }}" class="nav-link">Kontak</a>
            </div>
            <div class="hidden lg:flex items-center">
                <a href="{{ route("pmb.daftar") }}" class="bg-blue-900 text-white px-4 py-2 rounded-lg font-semibold hover:bg-blue-800 text-sm"><i class="fas fa-user-plus mr-1"></i>Daftar Sekarang</a>
            </div>
            <button @click="open=!open" class="lg:hidden p-2 rounded-md text-gray-500 hover:bg-gray-100"><i class="fas fa-bars text-xl"></i></button>
        </div>
        <div x-show="open" class="lg:hidden border-t py-3">
            <div class="space-y-1">
                <a href="{{ route("home") }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md">Beranda</a>
                <a href="{{ route("profil.sejarah") }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md">Profil</a>
                <a href="{{ route("akademik.program-studi") }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md">Akademik</a>
                <a href="{{ route("pmb.index") }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md">PMB</a>
                <a href="{{ route("penelitian.index") }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md">Penelitian</a>
                <a href="{{ route("berita.index") }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md">Berita</a>
                <a href="{{ route("kemahasiswaan.organisasi") }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md">Kemahasiswaan</a>
                <a href="{{ route("kerjasama.index") }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md">Kerjasama</a>
                <a href="{{ route("kontak.index") }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md">Kontak</a>
                <div class="px-4 pt-2"><a href="{{ route("pmb.daftar") }}" class="block text-center bg-blue-900 text-white py-2 rounded-lg font-semibold text-sm">Daftar Sekarang</a></div>
            </div>
        </div>
    </div>
</nav>
@if(session("success"))<div class="container mx-auto px-4 mt-4"><div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg flex items-center gap-2"><i class="fas fa-check-circle"></i>{{ session("success") }}</div></div>@endif
@if(session("error"))<div class="container mx-auto px-4 mt-4"><div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg flex items-center gap-2"><i class="fas fa-exclamation-circle"></i>{{ session("error") }}</div></div>@endif
<main>@yield("content")</main>
<footer class="bg-gray-900 text-gray-300 mt-16">
    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div>
                <div class="flex items-center gap-3 mb-4">
                    @if($siteSettings->get("logo"))
                        <img src="{{ Storage::disk('public')->url($siteSettings->get('logo')) }}"
                             style="height:40px;max-width:120px;object-fit:contain;flex-shrink:0"
                             alt="{{ $siteSettings->get('app_name','STT Siloam Medan') }}">
                    @else
                        <div class="w-10 h-10 bg-blue-800 rounded-full flex items-center justify-center flex-shrink-0"><span class="text-white font-bold">S</span></div>
                    @endif
                    <div><div class="font-bold text-white">{{ $siteSettings->get("app_name","STT Siloam Medan") }}</div><div class="text-xs text-gray-400">{{ $siteSettings->get("tagline","Sekolah Tinggi Teologi") }}</div></div>
                </div>
                <p class="text-sm text-gray-400 mb-4">{{ $siteSettings->get("welcome_message","Membentuk pemimpin Kristen yang berkarakter dan berdampak bagi masyarakat.") }}</p>
                <div class="flex gap-2">
                    @if($siteSettings->get("facebook"))<a href="{{ $siteSettings->get("facebook") }}" class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center hover:opacity-80"><i class="fab fa-facebook-f text-white text-xs"></i></a>@endif
                    @if($siteSettings->get("instagram"))<a href="{{ $siteSettings->get("instagram") }}" class="w-8 h-8 bg-pink-600 rounded-full flex items-center justify-center hover:opacity-80"><i class="fab fa-instagram text-white text-xs"></i></a>@endif
                    @if($siteSettings->get("youtube"))<a href="{{ $siteSettings->get("youtube") }}" class="w-8 h-8 bg-red-600 rounded-full flex items-center justify-center hover:opacity-80"><i class="fab fa-youtube text-white text-xs"></i></a>@endif
                </div>
            </div>
            <div>
                <h3 class="font-bold text-white mb-4">Link Cepat</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route("profil.sejarah") }}" class="hover:text-white">Profil Kampus</a></li>
                    <li><a href="{{ route("akademik.program-studi") }}" class="hover:text-white">Program Studi</a></li>
                    <li><a href="{{ route("pmb.daftar") }}" class="hover:text-white">Pendaftaran Mahasiswa Baru</a></li>
                    <li><a href="{{ route("penelitian.index") }}" class="hover:text-white">Penelitian & Pengabdian</a></li>
                    <li><a href="{{ route("berita.index") }}" class="hover:text-white">Berita & Artikel</a></li>
                    <li><a href="{{ route("kemahasiswaan.alumni") }}" class="hover:text-white">Alumni</a></li>
                </ul>
            </div>
            <div>
                <h3 class="font-bold text-white mb-4">Akademik</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route("akademik.program-studi") }}" class="hover:text-white">Program Studi</a></li>
                    <li><a href="{{ route("akademik.kurikulum") }}" class="hover:text-white">Kurikulum</a></li>
                    <li><a href="{{ route("akademik.kalender") }}" class="hover:text-white">Kalender Akademik</a></li>
                    <li><a href="{{ route("akademik.elearning") }}" class="hover:text-white">E-Learning</a></li>
                    <li><a href="{{ route("akademik.perpustakaan") }}" class="hover:text-white">Perpustakaan Digital</a></li>
                    <li><a href="{{ route("pmb.beasiswa") }}" class="hover:text-white">Beasiswa</a></li>
                </ul>
            </div>
            <div>
                <h3 class="font-bold text-white mb-4">Kontak Kami</h3>
                <div class="space-y-3 text-sm">
                    <div class="flex items-start gap-3"><i class="fas fa-map-marker-alt text-amber-400 mt-0.5 flex-shrink-0"></i><span>{{ $siteSettings->get("address","Jl. Siloam No. 1, Medan, Sumatera Utara") }}</span></div>
                    <div class="flex items-center gap-3"><i class="fas fa-phone text-amber-400"></i><a href="tel:{{ $siteSettings->get("phone") }}" class="hover:text-white">{{ $siteSettings->get("phone","+62618765432") }}</a></div>
                    <div class="flex items-center gap-3"><i class="fas fa-envelope text-amber-400"></i><a href="mailto:{{ $siteSettings->get("email") }}" class="hover:text-white">{{ $siteSettings->get("email","info@sttsiloammedan.ac.id") }}</a></div>
                </div>
                <div class="mt-4"><a href="{{ route("pmb.daftar") }}" class="inline-flex items-center gap-2 bg-amber-500 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-amber-400"><i class="fas fa-user-plus"></i>Daftar Sekarang</a></div>
            </div>
        </div>
    </div>
    <div class="border-t border-gray-800">
        <div class="container mx-auto px-4 py-4 flex flex-col sm:flex-row justify-between items-center text-sm text-gray-500">
            <span>&copy; {{ date("Y") }} {{ $siteSettings->get("app_name","STT Siloam Medan") }}. All rights reserved.</span>
            <span>Powered by Laravel</span>
        </div>
    </div>
</footer>
@if($siteSettings->get("whatsapp"))
<a href="https://wa.me/{{ preg_replace("/[^0-9]/","",$siteSettings->get("whatsapp")) }}" target="_blank" class="fixed bottom-6 right-6 w-14 h-14 bg-green-500 rounded-full flex items-center justify-center shadow-lg hover:bg-green-600 z-50">
    <i class="fab fa-whatsapp text-white text-2xl"></i>
</a>
@endif
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init({duration:600,once:true});</script>
@stack("scripts")
</body>
</html>
