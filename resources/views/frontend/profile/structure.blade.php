@extends('layouts.frontend')
@section('title', 'Struktur Organisasi')

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
/* sub boxes */
.sub-branch-row { display:flex; justify-content:center; position:relative; }
.sub-branch-row.multi::before { content:''; position:absolute; top:0; left:30px; right:30px; height:2px; background:#bfdbfe; }
.sub-item { display:flex; flex-direction:column; align-items:center; padding:0 6px; }
.sub-stem { width:2px; height:24px; background:#bfdbfe; margin:0 auto; }
.sub-box { background:white; border:1.5px solid #bfdbfe; border-radius:10px; padding:8px 10px; min-width:120px; max-width:155px; text-align:center; box-shadow:0 2px 8px rgba(30,64,175,.07); transition:transform .2s,box-shadow .2s; }
.sub-box:hover { transform:translateY(-3px); box-shadow:0 6px 16px rgba(30,64,175,.12); }
.sub-box .pos { font-size:10px; color:#3b82f6; font-weight:600; text-transform:uppercase; letter-spacing:.5px; }
.sub-box .name { font-size:11px; color:#1e3a8a; font-weight:700; margin-top:2px; line-height:1.3; }
/* yayasan panel */
.yayasan-panel { background:linear-gradient(135deg,#0f172a,#1e3a8a); border-radius:20px; padding:20px 28px; color:white; max-width:680px; margin:0 auto; box-shadow:0 8px 32px rgba(15,23,42,.35); }
.yayasan-panel .label { font-size:10px; letter-spacing:2px; text-transform:uppercase; color:#93c5fd; font-weight:600; margin-bottom:6px; }
.yayasan-panel h3 { font-size:15px; font-weight:700; color:white; margin-bottom:14px; }
.yayasan-members { display:flex; gap:0; border-top:1px solid rgba(255,255,255,.15); padding-top:14px; }
.yayasan-member { flex:1; text-align:center; padding:0 10px; }
.yayasan-member + .yayasan-member { border-left:1px solid rgba(255,255,255,.15); }
.yayasan-member .role { font-size:10px; color:#93c5fd; text-transform:uppercase; letter-spacing:.8px; margin-bottom:4px; }
.yayasan-member .mname { font-size:12px; font-weight:600; color:white; line-height:1.4; }
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
            Susunan kepemimpinan dan tata kelola {{ $siteSettings->get('app_name') }} yang mendukung penyelenggaraan pendidikan teologi berkualitas.
        </p>
    </div>
</div>

@php
/*
 * Robust position-based staff lookup.
 * Exact match first, then starts-with (with trailing space to avoid
 * "wakil ketua i" matching "wakil ketua ii ...").
 */
$findByPos = function(string $search) use ($leaders, $dosen, $tendik) {
    $pool = $leaders->concat($dosen)->concat($tendik);
    $q    = strtolower(trim($search));
    // 1. exact
    $hit = $pool->first(fn($s) => strtolower(trim($s->position)) === $q);
    if ($hit) return $hit;
    // 2. starts-with + word boundary (space after)
    return $pool->first(fn($s) => str_starts_with(strtolower(trim($s->position)), $q . ' '));
};

$staffNode = function(string $posKey, string $label) use ($findByPos): array {
    $s = $findByPos($posKey);
    return [
        'label' => $label,
        'name'  => $s ? $s->name : '—',
        'photo' => $s ? $s->photo_url : '',
        'found' => (bool) $s,
    ];
};

$ketua  = $staffNode('Ketua',              'Ketua');
$waket1 = $staffNode('Wakil Ketua I',      'Wakil Ketua I Bid. Akademik');
$waket2 = $staffNode('Wakil Ketua II',     'Wakil Ketua II Bid. Keuangan');
$waket3 = $staffNode('Wakil Ketua III',    'Wakil Ketua III Bid. Mahasiswa');

$subs = [
    0 => [ // under Waket I
        $staffNode('Kaprodi PAK',         'Kaprodi PAK'),
        $staffNode('Kepala Perpustakaan', 'Ka. Perpustakaan'),
    ],
    1 => [ // under Waket II
        $staffNode('Administrasi Keuangan', 'Adm. Keuangan'),
    ],
    2 => [], // Waket III — no sub-units listed
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

            {{-- ── Yayasan Pendidikan Siloam Indonesia ── --}}
            <div class="yayasan-panel mb-2">
                <div class="label"><i class="fas fa-university mr-1"></i>Badan Penyelenggara</div>
                <h3>Yayasan Pendidikan Siloam Indonesia</h3>
                <div class="yayasan-members">
                    <div class="yayasan-member">
                        <div class="role">Ketua Yayasan</div>
                        <div class="mname">Partogi Pasaribu, S.Th., M.Pd.K</div>
                    </div>
                    <div class="yayasan-member">
                        <div class="role">Sekretaris</div>
                        <div class="mname">Rahel Pasaribu</div>
                    </div>
                    <div class="yayasan-member">
                        <div class="role">Bendahara</div>
                        <div class="mname">Ivenny Pasaribu, BA</div>
                    </div>
                </div>
            </div>
            <div class="org-stem-down mt-2"></div>

            {{-- ── {{ $siteSettings->get('app_name') }} label ── --}}
            <div style="background:linear-gradient(135deg,#f59e0b,#d97706);color:white;border-radius:12px;padding:7px 24px;font-size:13px;font-weight:700;letter-spacing:.5px;box-shadow:0 4px 12px rgba(245,158,11,.35)">
                <i class="fas fa-school mr-2"></i>{{ $siteSettings->get('app_name') }}
            </div>
            <div class="org-stem-down"></div>

            {{-- TOP: Ketua --}}
            @php $nd = $ketua; @endphp
            <div class="org-box is-top">
                <div class="org-photo">
                    @if($nd['photo'])<img src="{{ $nd['photo'] }}" alt="{{ $nd['name'] }}">
                    @else<i class="fas fa-user"></i>@endif
                </div>
                <div class="org-card lv-top">
                    <div class="pos">{{ $nd['label'] }}</div>
                    <div class="name">{{ $nd['name'] }}</div>
                </div>
            </div>
            <div class="org-stem-down"></div>

            {{-- LEVEL 2: 3 Wakil Ketua --}}
            <div class="org-branch-wrap w-full">
                <div class="org-branch-row" style="max-width:900px;width:100%">
                    @foreach([$waket1, $waket2, $waket3] as $idx => $wk)
                    <div class="org-col">
                        <div class="org-col-stem"></div>
                        {{-- Waket box --}}
                        <div class="org-box">
                            <div class="org-photo">
                                @if($wk['photo'])<img src="{{ $wk['photo'] }}" alt="{{ $wk['name'] }}">
                                @else<i class="fas fa-user"></i>@endif
                            </div>
                            <div class="org-card lv-mid">
                                <div class="pos">{{ $wk['label'] }}</div>
                                <div class="name">{{ $wk['name'] }}</div>
                            </div>
                        </div>
                        {{-- Sub units --}}
                        @if(!empty($subs[$idx]))
                        <div class="org-stem-down"></div>
                        <div class="sub-branch-row {{ count($subs[$idx]) > 1 ? 'multi' : '' }}">
                            @foreach($subs[$idx] as $sub)
                            <div class="sub-item">
                                <div class="sub-stem"></div>
                                <div class="sub-box">
                                    <div class="pos">{{ $sub['label'] }}</div>
                                    <div class="name">{{ $sub['name'] }}</div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>

        </div>{{-- /org-tree --}}
        </div>{{-- /org-wrap --}}

        {{-- Legend --}}
        <div class="flex flex-wrap justify-center gap-6 mt-10 text-xs text-gray-500">
            <div class="flex items-center gap-2">
                <div class="w-5 h-3 rounded" style="background:linear-gradient(135deg,#0f172a,#1e3a8a)"></div>
                <span>Yayasan (Badan Penyelenggara)</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-5 h-3 rounded" style="background:linear-gradient(135deg,#1e3a8a,#1d4ed8)"></div>
                <span>Pimpinan Tertinggi STT</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-5 h-3 rounded" style="background:linear-gradient(135deg,#1e40af,#2563eb)"></div>
                <span>Wakil Ketua</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-5 h-3 rounded bg-white border border-blue-200"></div>
                <span>Kepala Unit / Kaprodi</span>
            </div>
        </div>
    </div>
</section>

<div style="height:4px;background:linear-gradient(to right,#1e3a8a,#2563eb,#f59e0b,#2563eb,#1e3a8a)"></div>

{{-- TIM PIMPINAN CARDS ──────────────────────── --}}
<section class="py-16 bg-white" data-aos="fade-up">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <span class="text-yellow-500 text-xs font-semibold uppercase tracking-widest">
                <i class="fas fa-star mr-1"></i>Fungsionaris {{ $siteSettings->get('app_name') }}
            </span>
            <h2 class="text-3xl font-bold text-blue-900 mt-2 mb-3">Tim Pimpinan</h2>
            <div class="flex justify-center items-center gap-2">
                <div class="w-16 h-1 bg-yellow-500 rounded"></div>
                <div class="w-3 h-1 bg-yellow-300 rounded"></div>
            </div>
        </div>

        @if($leaders->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 max-w-5xl mx-auto">
            @foreach($leaders as $person)
            <div class="group text-center" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                <div class="relative mx-auto mb-5" style="width:130px;height:130px">
                    <div class="absolute bg-yellow-400" style="inset:0;transform:translate(6px,6px);border-radius:16px"></div>
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
                <h3 class="font-bold text-blue-900 text-sm leading-snug mb-1 px-2">{{ $person->name }}</h3>
                <p class="text-blue-600 text-xs font-medium">{{ $person->position }}</p>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>

<div style="height:4px;background:linear-gradient(to right,#1e3a8a,#2563eb,#f59e0b,#2563eb,#1e3a8a)"></div>

{{-- DOSEN ──────────────────────────────────── --}}
<section class="py-16 bg-gray-50" data-aos="fade-up">
    <div class="container mx-auto px-4">
        <div class="text-center mb-10">
            <span class="text-blue-600 text-xs font-semibold uppercase tracking-widest">
                <i class="fas fa-chalkboard-teacher mr-1"></i>Tenaga Pengajar
            </span>
            <h2 class="text-3xl font-bold text-blue-900 mt-2 mb-3">Dosen</h2>
            <div class="flex justify-center items-center gap-2">
                <div class="w-16 h-1 bg-yellow-500 rounded"></div>
                <div class="w-3 h-1 bg-yellow-300 rounded"></div>
            </div>
        </div>

        @if($dosen->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 max-w-5xl mx-auto">
            @foreach($dosen as $d)
            <div class="bg-white rounded-xl border border-blue-100 p-5 flex items-center gap-4 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-200"
                 data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                {{-- Photo --}}
                <div class="flex-shrink-0 w-16 h-16 rounded-full overflow-hidden border-2 border-blue-100 shadow"
                     style="background:linear-gradient(135deg,#dbeafe,#bfdbfe)">
                    @if($d->photo)
                    <img src="{{ $d->photo_url }}" alt="{{ $d->name }}" class="w-full h-full object-cover object-top">
                    @else
                    <div class="w-full h-full flex items-center justify-center">
                        <i class="fas fa-user text-blue-300 text-xl"></i>
                    </div>
                    @endif
                </div>
                {{-- Info --}}
                <div class="min-w-0">
                    <p class="font-bold text-blue-900 text-sm leading-tight">{{ $d->name }}</p>
                    <p class="text-blue-600 text-xs mt-0.5">{{ $d->position }}</p>
                    @if($d->courses)
                    <p class="text-gray-400 text-xs mt-1 leading-tight truncate" title="{{ $d->courses }}">
                        <i class="fas fa-book-open mr-1 text-yellow-400"></i>{{ $d->courses }}
                    </p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>

{{-- TENAGA KEPENDIDIKAN ──────────────────────── --}}
@if($tendik->count() > 0)
<section class="py-12 bg-white" data-aos="fade-up">
    <div class="container mx-auto px-4">
        <div class="text-center mb-8">
            <span class="text-blue-600 text-xs font-semibold uppercase tracking-widest">
                <i class="fas fa-users-cog mr-1"></i>Staf
            </span>
            <h2 class="text-2xl font-bold text-blue-900 mt-2 mb-3">Tenaga Kependidikan</h2>
            <div class="flex justify-center items-center gap-2">
                <div class="w-16 h-1 bg-yellow-500 rounded"></div>
                <div class="w-3 h-1 bg-yellow-300 rounded"></div>
            </div>
        </div>
        <div class="flex flex-wrap justify-center gap-5">
            @foreach($tendik as $t)
            <div class="bg-gray-50 rounded-xl border border-gray-100 p-5 flex items-center gap-4 w-full sm:w-72 hover:shadow-md transition"
                 data-aos="fade-up" data-aos-delay="{{ $loop->index * 60 }}">
                <div class="flex-shrink-0 w-14 h-14 rounded-full overflow-hidden border-2 border-gray-200 shadow"
                     style="background:#f1f5f9">
                    @if($t->photo)
                    <img src="{{ $t->photo_url }}" alt="{{ $t->name }}" class="w-full h-full object-cover object-top">
                    @else
                    <div class="w-full h-full flex items-center justify-center">
                        <i class="fas fa-user text-gray-300 text-xl"></i>
                    </div>
                    @endif
                </div>
                <div>
                    <p class="font-bold text-gray-800 text-sm">{{ $t->name }}</p>
                    <p class="text-blue-600 text-xs mt-0.5">{{ $t->position }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

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
