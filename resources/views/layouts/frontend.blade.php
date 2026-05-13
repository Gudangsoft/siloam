<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @php
    $siteName   = $siteSettings->get('app_name', 'Kampus');
    $_defDesc   = $siteSettings->get('meta_description', 'Website resmi kampus — informasi akademik, berita, dan penerimaan mahasiswa baru.');
    $_defOgImg  = $siteSettings->get('og_image')
                    ? Storage::disk('public')->url($siteSettings->get('og_image'))
                    : asset('images/og-default.jpg');
    $_rawTitle  = trim(strip_tags($__env->yieldContent('title', '')));
    $metaTitle  = $_rawTitle ? $_rawTitle . ' | ' . $siteName : $siteName;
    $metaDesc   = trim(strip_tags($__env->yieldContent('meta_description', $_defDesc)));
    $ogImage    = trim($__env->yieldContent('og_image', $_defOgImg));
    $ogType     = trim($__env->yieldContent('og_type', 'website'));
    @endphp

    <title>{!! $metaTitle !!}</title>
    <meta name="description" content="{{ $metaDesc }}">
    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="sitemap" type="application/xml" title="Sitemap" href="{{ route('sitemap') }}">

    {{-- Open Graph --}}
    <meta property="og:type"        content="{{ $ogType }}">
    <meta property="og:url"         content="{{ url()->current() }}">
    <meta property="og:title"       content="{{ $metaTitle }}">
    <meta property="og:description" content="{{ $metaDesc }}">
    <meta property="og:image"       content="{{ $ogImage }}">
    <meta property="og:image:width"  content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name"   content="{{ $siteName }}">
    <meta property="og:locale"      content="id_ID">

    {{-- Twitter Card --}}
    <meta name="twitter:card"        content="summary_large_image">
    <meta name="twitter:title"       content="{{ $metaTitle }}">
    <meta name="twitter:description" content="{{ $metaDesc }}">
    <meta name="twitter:image"       content="{{ $ogImage }}">

    {{-- Security --}}
    <meta name="referrer" content="strict-origin-when-cross-origin">
    <meta http-equiv="X-Content-Type-Options" content="nosniff">

    @if($siteSettings->get("favicon"))
    <link rel="icon" href="{{ Storage::disk('public')->url($siteSettings->get('favicon')) }}">
    @endif

    {{-- Preconnect hints --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>body{font-family:"Inter",sans-serif;}.nav-link{color:#374151;font-weight:500;transition:color 0.2s;padding:0.5rem 0.75rem;border-radius:0.375rem;font-size:0.875rem;display:inline-block;}.nav-link:hover{color:#1e3a8a;}.dropdown-menu{position:absolute;top:100%;left:0;margin-top:4px;width:14rem;background:white;box-shadow:0 10px 25px rgba(0,0,0,0.15);border-radius:0.5rem;border:1px solid #f3f4f6;opacity:0;visibility:hidden;transition:all 0.2s;z-index:50;}.group:hover .dropdown-menu{opacity:1;visibility:visible;}</style>
    {{-- JSON-LD structured data (Organization default) --}}
    @php
    $_jsonLd = json_encode([
        '@context'    => 'https://schema.org',
        '@type'       => 'CollegeOrUniversity',
        'name'        => $siteName,
        'url'         => config('app.url'),
        'logo'        => $siteSettings->get('logo') ? Storage::disk('public')->url($siteSettings->get('logo')) : asset('images/logo.png'),
        'description' => $metaDesc,
        'telephone'   => $siteSettings->get('phone', ''),
        'email'       => $siteSettings->get('email', ''),
        'address'     => [
            '@type'           => 'PostalAddress',
            'addressLocality' => 'Medan',
            'addressRegion'   => 'Sumatera Utara',
            'addressCountry'  => 'ID',
        ],
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    @endphp
    <script type="application/ld+json">{!! $_jsonLd !!}</script>
    @stack('jsonld')
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
            {{-- DESKTOP NAV: Menu Dinamis --}}
            <div class="hidden lg:flex items-center">
                @foreach($navMenus as $menu)
                    @if($menu->children->count() > 0)
                    {{-- Dropdown --}}
                    <div class="relative group">
                        <button class="nav-link flex items-center gap-1">
                            @if($menu->icon)<i class="{{ $menu->icon }} text-xs mr-1"></i>@endif
                            {{ $menu->title }}
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>
                        <div class="dropdown-menu">
                            <div class="py-1">
                                @foreach($menu->children as $child)
                                <a href="{{ $child->url ?: '#' }}"
                                   target="{{ $child->target }}"
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">
                                    @if($child->icon)<i class="{{ $child->icon }} mr-1 text-blue-400"></i>@endif
                                    {{ $child->title }}
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @else
                    {{-- Single link --}}
                    <a href="{{ $menu->url ?: '#' }}"
                       target="{{ $menu->target }}"
                       class="nav-link">
                        @if($menu->icon)<i class="{{ $menu->icon }} text-xs mr-1"></i>@endif
                        {{ $menu->title }}
                    </a>
                    @endif
                @endforeach
            </div>
            <div class="hidden lg:flex items-center gap-2">
                {{-- Search toggle --}}
                <div class="relative" x-data="{searchOpen:false}">
                    <button @click="searchOpen=!searchOpen;$nextTick(()=>{if(searchOpen)$refs.searchInput.focus()})"
                            class="w-9 h-9 rounded-lg flex items-center justify-center text-gray-500 hover:bg-gray-100 transition">
                        <i class="fas fa-search text-sm"></i>
                    </button>
                    <div x-show="searchOpen" @click.outside="searchOpen=false"
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         class="absolute right-0 top-11 bg-white rounded-xl shadow-xl border border-gray-100 p-3"
                         style="width:280px;z-index:60">
                        <form action="{{ route('cari') }}" method="GET" class="flex gap-2">
                            <input x-ref="searchInput" type="text" name="q"
                                   value="{{ request('q') }}"
                                   placeholder="Cari di website..."
                                   class="flex-1 border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   maxlength="100">
                            <button type="submit"
                                    class="px-3 py-2 bg-blue-900 text-white rounded-lg text-sm hover:bg-blue-800 transition">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <a href="{{ route('pmb.daftar') }}" class="bg-blue-900 text-white px-4 py-2 rounded-lg font-semibold hover:bg-blue-800 text-sm">
                    <i class="fas fa-user-plus mr-1"></i>Daftar Sekarang
                </a>
            </div>
            <button @click="open=!open" class="lg:hidden p-2 rounded-md text-gray-500 hover:bg-gray-100">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>

        {{-- MOBILE NAV: Menu Dinamis --}}
        <div x-show="open" class="lg:hidden border-t py-3">
            <div class="space-y-1">
                @foreach($navMenus as $menu)
                <a href="{{ $menu->url ?: '#' }}"
                   target="{{ $menu->target }}"
                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md">
                    @if($menu->icon)<i class="{{ $menu->icon }} mr-1 text-blue-400"></i>@endif
                    {{ $menu->title }}
                </a>
                @foreach($menu->children as $child)
                <a href="{{ $child->url ?: '#' }}"
                   target="{{ $child->target }}"
                   class="block px-4 py-2 text-sm text-gray-500 hover:bg-gray-100 rounded-md pl-8">
                    — {{ $child->title }}
                </a>
                @endforeach
                @endforeach
                <div class="px-4 pt-2 space-y-2">
                    <form action="{{ route('cari') }}" method="GET" class="flex gap-2">
                        <input type="text" name="q" placeholder="Cari di website..."
                               class="flex-1 border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                               maxlength="100">
                        <button type="submit" class="px-3 py-2 bg-gray-100 text-gray-600 rounded-lg text-sm">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                    <a href="{{ route('pmb.daftar') }}" class="block text-center bg-blue-900 text-white py-2 rounded-lg font-semibold text-sm">
                        Daftar Sekarang
                    </a>
                </div>
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
                    @foreach($footerMenus as $menu)
                    <li>
                        <a href="{{ $menu->url ?: '#' }}" target="{{ $menu->target }}" class="hover:text-white">
                            @if($menu->icon)<i class="{{ $menu->icon }} mr-1 text-xs"></i>@endif
                            {{ $menu->title }}
                        </a>
                    </li>
                    @endforeach
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
                    <div class="flex items-start gap-3"><i class="fas fa-map-marker-alt text-amber-400 mt-0.5 flex-shrink-0"></i><span>{{ $siteSettings->get("address") ?: '-' }}</span></div>
                    <div class="flex items-center gap-3"><i class="fas fa-phone text-amber-400"></i><a href="tel:{{ $siteSettings->get("phone") }}" class="hover:text-white">{{ $siteSettings->get("phone") ?: '-' }}</a></div>
                    <div class="flex items-center gap-3"><i class="fas fa-envelope text-amber-400"></i><a href="mailto:{{ $siteSettings->get("email") }}" class="hover:text-white">{{ $siteSettings->get("email") ?: '-' }}</a></div>
                </div>
                <div class="mt-4"><a href="{{ route("pmb.daftar") }}" class="inline-flex items-center gap-2 bg-amber-500 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-amber-400"><i class="fas fa-user-plus"></i>Daftar Sekarang</a></div>
            </div>
        </div>
    </div>
    <div class="border-t border-gray-800">
        <div class="container mx-auto px-4 py-4 flex flex-col sm:flex-row justify-between items-center text-sm text-gray-500">
            <span>{!! $siteSettings->get('footer_text', '&copy; ' . date('Y') . ' ' . $siteSettings->get('app_name', 'Kampus') . '. Hak Cipta Dilindungi.') !!}</span>
            <span>Powered by Laravel</span>
        </div>
    </div>
</footer>
@if($siteSettings->get("whatsapp"))
<a href="https://wa.me/{{ preg_replace("/[^0-9]/","",$siteSettings->get("whatsapp")) }}" target="_blank" class="fixed bottom-6 right-6 w-14 h-14 bg-green-500 rounded-full flex items-center justify-center shadow-lg hover:bg-green-600 z-50">
    <i class="fab fa-whatsapp text-white text-2xl"></i>
</a>
@endif
{{-- Scroll to Top Button --}}
<button id="scrollTopBtn" onclick="window.scrollTo({top:0,behavior:'smooth'})"
    class="fixed z-50 w-12 h-12 bg-blue-900 hover:bg-blue-700 text-white rounded-full shadow-lg flex items-center justify-center transition-all duration-300 opacity-0 pointer-events-none"
    style="bottom:{{ $siteSettings->get('whatsapp') ? '5.5rem' : '1.5rem' }};right:1.5rem"
    aria-label="Kembali ke atas">
    <i class="fas fa-chevron-up text-sm"></i>
</button>
<script>
(function(){
    var btn = document.getElementById('scrollTopBtn');
    window.addEventListener('scroll', function(){
        if (window.scrollY > 300) {
            btn.classList.remove('opacity-0','pointer-events-none');
            btn.classList.add('opacity-100');
        } else {
            btn.classList.add('opacity-0','pointer-events-none');
            btn.classList.remove('opacity-100');
        }
    }, {passive:true});
})();
</script>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init({duration:600,once:true});</script>
@stack("scripts")
</body>
</html>
