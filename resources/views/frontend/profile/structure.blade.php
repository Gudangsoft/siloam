@extends('layouts.frontend')
@section('title', 'Struktur Organisasi | STT Siloam Medan')

@push('styles')
<style>
/* ── Org Chart ──────────────────────────── */
.org-wrap { overflow-x: auto; padding: 10px 0 30px; }
.org-tree { display: flex; flex-direction: column; align-items: center; }
.org-stem-down { width: 2px; height: 32px; background: linear-gradient(to bottom,#1e40af,#93c5fd); margin: 0 auto; }
.org-branch-wrap { display: flex; flex-direction: column; align-items: center; }
.org-branch-row { display: flex; justify-content: center; align-items: flex-start; position: relative; }
.org-branch-row::before { content:''; position:absolute; top:0; left:60px; right:60px; height:2px; background:linear-gradient(to right,#93c5fd,#1e40af,#93c5fd); }
.org-col { display: flex; flex-direction: column; align-items: center; padding: 0 20px; }
.org-col-stem { width:2px; height:32px; background:linear-gradient(to bottom,#93c5fd,#1e40af); margin:0 auto; }
.org-box { display:flex; flex-direction:column; align-items:center; text-align:center; min-width:160px; max-width:200px; transition:transform .25s; cursor:default; }
.org-box:hover { transform: translateY(-4px); }
.org-photo { width:72px; height:72px; border-radius:50%; border:3px solid #fff; box-shadow:0 4px 12px rgba(0,0,0,.15); background:#dbeafe; display:flex; align-items:center; justify-content:center; overflow:hidden; flex-shrink:0; }
.org-photo img { width:100%; height:100%; object-fit:cover; }
.org-photo i { font-size:28px; color:#93c5fd; }
.org-card { margin-top:8px; background:white; border-radius:14px; padding:10px 14px; box-shadow:0 4px 16px rgba(30,64,175,.12); border:1.5px solid #e0e7ff; width:100%; }
.org-card.lv-top { background:linear-gradient(135deg,#1e3a8a,#1d4ed8); border-color:#1e40af; color:white; }
.org-card.lv-mid { background:linear-gradient(135deg,#1e40af,#2563eb); border-color:#3b82f6; color:white; }
.org-card.lv-bot { background:white; border-color:#bfdbfe; }
.org-card .pos { font-size:11px; opacity:.75; margin-bottom:3px; }
.org-card .name { font-weight:700; font-size:13px; line-height:1.3; }
.org-card.lv-bot .pos { color:#2563eb; }
.org-card.lv-bot .name { color:#1e3a8a; }
.org-box.is-top .org-photo { width:88px; height:88px; border-width:4px; }
.org-box.is-top .org-card { padding:14px 20px; min-width:200px; }
.org-box.is-top .name { font-size:15px; }
/* advisory */
.advisory-row { display:flex; gap:16px; justify-content:center; }
.advisory-box .org-card { background:#f8fafc; border:2px dashed #cbd5e1; color:#475569; min-width:140px; font-size:12px; }
.advisory-box .name { color:#334155; }
/* sub boxes */
.sub-branch-row { display:flex; justify-content:center; position:relative; }
.sub-branch-row.multi::before { content:''; position:absolute; top:0; left:30px; right:30px; height:2px; background:#bfdbfe; }
.sub-item { display:flex; flex-direction:column; align-items:center; padding:0 6px; }
.sub-stem { width:2px; height:24px; background:#bfdbfe; margin:0 auto; }
.sub-box { background:white; border:1.5px solid #bfdbfe; border-radius:10px; padding:8px 10px; min-width:120px; max-width:155px; text-align:center; box-shadow:0 2px 8px rgba(30,64,175,.07); transition:transform .2s,box-shadow .2s; }
.sub-box:hover { transform:translateY(-3px); box-shadow:0 6px 16px rgba(30,64,175,.12); }
.sub-box .pos { font-size:10px; color:#3b82f6; font-weight:600; text-transform:uppercase; letter-spacing:.5px; }
.sub-box .name { font-size:11px; color:#1e3a8a; font-weight:700; margin-top:2px; line-height:1.3; }
</style>
@endpush

@section('content')

{{-- Hero --}}
<div class="text-white py-16 relative overflow-hidden"
     style="background:linear-gradient(135deg,#0f172a 0%,#1e3a8a 60%,#1d4ed8 100%)">
    <div class="container mx-auto px-4 relative z-10">
        <div class="flex items-center gap-3 mb-3">
            <div class="w-10 h-10 rounded-lg bg-white bg-opacity-15 flex items-center justify-center">
                <i class="fas fa-sitemap text-yellow-400 text-lg"></i>
            </div>
            <nav class="text-sm text-blue-300">
                <a href="{{ route('home') }}" class="hover:text-white">Beranda</a>
                <span class="mx-2">›</span>
                <span class="text-white">Struktur Organisasi</span>
            </nav>
        </div>
        <h1 class="text-4xl font-bold mb-2">Struktur Organisasi</h1>
        <p class="text-blue-200 max-w-xl text-sm leading-relaxed">
            Susunan kepemimpinan dan tata kelola STT Siloam Medan yang mendukung penyelenggaraan pendidikan teologi berkualitas.
        </p>
    </div>
</div>

@php
/* Closures to build node data from staff collection */
$findStaff = function (string $keyword) use ($leaders) {
    foreach ($leaders as $key => $s) {
        if (str_contains($key, strtolower($keyword))) return $s;
    }
    return null;
};

$node = function (string $pos, string $fallbackName, string $level) use ($findStaff): array {
    $s = $findStaff($pos);
    return [
        'pos'   => $pos,
        'name'  => $s ? $s->name : $fallbackName,
        'photo' => $s ? $s->photo_url : '',
        'level' => $level,
    ];
};

$top    = $node('ketua',           'Nama Ketua',                'top');
$waket1 = $node('wakil ketua i',   'Wakil Ketua I (Akademik)',  'mid');
$waket2 = $node('wakil ketua ii',  'Wakil Ketua II (Adm&Keu)',  'mid');
$waket3 = $node('wakil ketua iii', 'Wakil Ketua III (Mahasiswa)','mid');

$wakets  = [$waket1, $waket2, $waket3];
$subKeys = ['Waket I', 'Waket II', 'Waket III'];

$subs = [
    'Waket I' => [
        $node('kaprodi teologi',     'Kaprodi Teologi',    'bot'),
        $node('kaprodi pak',         'Kaprodi PAK',        'bot'),
        $node('kepala lppm',         'Kepala LPPM',        'bot'),
        $node('kepala perpustakaan', 'Ka. Perpustakaan',   'bot'),
    ],
    'Waket II' => [
        $node('kepala baak',         'Kepala BAAK',        'bot'),
        $node('kepala keuangan',     'Kepala Keuangan',    'bot'),
        $node('kepala sdm',          'Ka. SDM & Umum',     'bot'),
    ],
    'Waket III' => [
        $node('kepala kemahasiswaan','Ka. Kemahasiswaan',  'bot'),
        $node('kepala alumni',       'Ka. Alumni',         'bot'),
        $node('kepala beasiswa',     'Ka. Beasiswa',       'bot'),
    ],
];
@endphp

{{-- ORG CHART ─────────────────────────────────── --}}
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <span class="text-blue-600 text-xs font-semibold uppercase tracking-widest">
                <i class="fas fa-sitemap mr-1"></i>Tata Kelola Kelembagaan
            </span>
            <h2 class="text-3xl font-bold text-blue-900 mt-2 mb-3">Bagan Struktur Organisasi</h2>
            <div class="flex justify-center items-center gap-2">
                <div class="w-16 h-1 bg-yellow-500 rounded"></div>
                <div class="w-3 h-1 bg-yellow-300 rounded"></div>
            </div>
        </div>

        <div class="org-wrap" data-aos="fade-up">
        <div class="org-tree">

            {{-- Advisory: Yayasan & Senat --}}
            <div class="advisory-row mb-2">
                @foreach([['Yayasan', 'fa-building'], ['Senat Akademik', 'fa-users']] as [$lab, $ic])
                <div class="advisory-box">
                    <div class="org-card" style="text-align:center">
                        <div class="pos"><i class="fas {{ $ic }} mr-1"></i></div>
                        <div class="name" style="color:#334155">{{ $lab }}</div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="org-stem-down mt-2"></div>

            {{-- TOP: Ketua --}}
            @php $nd = $top; @endphp
            <div class="org-box is-top">
                <div class="org-photo">
                    @if($nd['photo'])<img src="{{ $nd['photo'] }}" alt="{{ $nd['name'] }}">
                    @else<i class="fas fa-user"></i>@endif
                </div>
                <div class="org-card lv-top">
                    <div class="pos">{{ $nd['pos'] }}</div>
                    <div class="name">{{ $nd['name'] }}</div>
                </div>
            </div>
            <div class="org-stem-down"></div>

            {{-- LEVEL 2: 3 Wakil Ketua + sub-units --}}
            <div class="org-branch-wrap w-full">
                <div class="org-branch-row" style="max-width:1000px;width:100%">
                    @foreach($wakets as $idx => $wk)
                    @php $subKey = $subKeys[$idx]; @endphp
                    <div class="org-col">
                        <div class="org-col-stem"></div>
                        {{-- Waket box --}}
                        <div class="org-box">
                            <div class="org-photo">
                                @if($wk['photo'])<img src="{{ $wk['photo'] }}" alt="{{ $wk['name'] }}">
                                @else<i class="fas fa-user"></i>@endif
                            </div>
                            <div class="org-card lv-mid">
                                <div class="pos">{{ $wk['pos'] }}</div>
                                <div class="name">{{ $wk['name'] }}</div>
                            </div>
                        </div>
                        {{-- Sub units --}}
                        <div class="org-stem-down"></div>
                        <div class="sub-branch-row {{ count($subs[$subKey]) > 1 ? 'multi' : '' }}">
                            @foreach($subs[$subKey] as $sub)
                            <div class="sub-item">
                                <div class="sub-stem"></div>
                                <div class="sub-box">
                                    <div class="pos">{{ $sub['pos'] }}</div>
                                    <div class="name">{{ $sub['name'] }}</div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>{{-- /org-tree --}}
        </div>{{-- /org-wrap --}}

        {{-- Legend --}}
        <div class="flex flex-wrap justify-center gap-6 mt-10 text-xs text-gray-500">
            <div class="flex items-center gap-2">
                <div class="w-5 h-3 rounded" style="background:linear-gradient(135deg,#1e3a8a,#1d4ed8)"></div>
                <span>Pimpinan Tertinggi</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-5 h-3 rounded" style="background:linear-gradient(135deg,#1e40af,#2563eb)"></div>
                <span>Wakil Ketua</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-5 h-3 rounded bg-white border border-blue-200"></div>
                <span>Kepala Unit / Kaprodi</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-5 h-3 rounded border-2 border-dashed border-slate-300 bg-slate-50"></div>
                <span>Badan Eksternal</span>
            </div>
        </div>
    </div>
</section>

{{-- DIVIDER --}}
<div style="height:4px;background:linear-gradient(to right,#1e3a8a,#2563eb,#f59e0b,#2563eb,#1e3a8a)"></div>

{{-- TIM PIMPINAN CARDS ──────────────────────── --}}
<section class="py-16 bg-white" data-aos="fade-up">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <span class="text-yellow-500 text-xs font-semibold uppercase tracking-widest">
                <i class="fas fa-star mr-1"></i>Kepemimpinan
            </span>
            <h2 class="text-3xl font-bold text-blue-900 mt-2 mb-3">Tim Pimpinan</h2>
            <div class="flex justify-center items-center gap-2">
                <div class="w-16 h-1 bg-yellow-500 rounded"></div>
                <div class="w-3 h-1 bg-yellow-300 rounded"></div>
            </div>
        </div>

        @if($leaders->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 max-w-6xl mx-auto">
            @foreach($leaders as $person)
            <div class="group text-center" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                <div class="relative mx-auto mb-5" style="width:140px;height:140px">
                    <div class="absolute bg-yellow-400" style="inset:0;transform:translate(7px,7px);border-radius:18px"></div>
                    <div class="relative rounded-2xl overflow-hidden border-4 border-white shadow-xl w-full h-full"
                         style="background:linear-gradient(135deg,#1e40af,#2563eb)">
                        @if($person->photo)
                        <img src="{{ $person->photo_url }}" alt="{{ $person->name }}"
                             class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-500">
                        @else
                        <div class="w-full h-full flex items-center justify-center">
                            <i class="fas fa-user text-4xl text-white opacity-40"></i>
                        </div>
                        @endif
                    </div>
                </div>
                <h3 class="font-bold text-blue-900 text-base leading-snug mb-1">{{ $person->name }}</h3>
                <p class="text-blue-600 text-sm font-medium mb-1">{{ $person->position }}</p>
                @if($person->education)
                <p class="text-gray-400 text-xs">{{ $person->education }}</p>
                @endif
                @if($person->email)
                <div class="flex justify-center mt-3">
                    <a href="mailto:{{ $person->email }}"
                       class="w-8 h-8 rounded-full bg-blue-50 hover:bg-blue-100 flex items-center justify-center text-blue-600 transition">
                        <i class="fas fa-envelope text-xs"></i>
                    </a>
                </div>
                @endif
            </div>
            @endforeach
        </div>
        @else
        <div class="grid grid-cols-2 md:grid-cols-3 gap-6 max-w-3xl mx-auto">
            @foreach(['Ketua','Wakil Ketua I','Wakil Ketua II','Wakil Ketua III','Ka. LPPM','Ka. Kemahasiswaan'] as $pos)
            <div class="bg-gray-50 rounded-2xl p-6 text-center border border-gray-100 hover:border-blue-100 hover:shadow-md transition-all">
                <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-3 shadow"
                     style="background:linear-gradient(135deg,#1e40af,#2563eb)">
                    <i class="fas fa-user text-2xl text-white opacity-50"></i>
                </div>
                <p class="font-bold text-blue-900 text-sm">{{ $pos }}</p>
                <p class="text-gray-400 text-xs mt-1 italic">Belum diisi</p>
            </div>
            @endforeach
        </div>
        <p class="text-center text-gray-400 text-sm mt-6">
            <i class="fas fa-info-circle mr-1"></i>
            Isi data di <strong>Admin → Staff & SDM</strong> dengan kategori <code>pimpinan</code>.
        </p>
        @endif
    </div>
</section>

@if(isset($page) && $page?->content)
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4 max-w-4xl">
        <div class="bg-white rounded-2xl shadow-sm p-8 prose prose-lg max-w-none text-gray-700">
            {!! $page->content !!}
        </div>
    </div>
</section>
@endif

@endsection
