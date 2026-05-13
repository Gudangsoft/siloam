@extends('layouts.frontend')
@section('title', $q ? 'Hasil Pencarian: ' . $q : 'Pencarian')
@section('content')

{{-- Hero --}}
<div class="text-white py-14 relative overflow-hidden"
     style="background:linear-gradient(135deg,#0f172a 0%,#1e3a8a 60%,#1d4ed8 100%)">
    <div class="container mx-auto px-4 relative z-10">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 rounded-lg bg-white bg-opacity-15 flex items-center justify-center">
                <i class="fas fa-search text-yellow-400 text-lg"></i>
            </div>
            <nav class="text-sm text-blue-300">
                <a href="{{ route('home') }}" class="hover:text-white">Beranda</a>
                <span class="mx-2">›</span>
                <span class="text-white">Pencarian</span>
            </nav>
        </div>
        <h1 class="text-3xl font-bold mb-5">Pencarian</h1>

        {{-- Search Form --}}
        <form action="{{ route('cari') }}" method="GET" class="flex gap-3 max-w-2xl">
            <div class="flex-1 relative">
                <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <input type="text" name="q" value="{{ $q }}" autofocus
                       placeholder="Cari berita, dosen, program studi..."
                       class="w-full pl-11 pr-4 py-3 rounded-xl text-gray-900 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-yellow-400"
                       maxlength="100">
            </div>
            <button type="submit"
                    class="px-6 py-3 rounded-xl font-bold text-sm transition"
                    style="background:#f59e0b;color:#1e293b">
                Cari
            </button>
        </form>

        @if($q && !$tooShort)
        <p class="text-blue-300 text-sm mt-3">
            Ditemukan <strong class="text-white">{{ $total }}</strong> hasil untuk
            "<strong class="text-yellow-300">{{ $q }}</strong>"
        </p>
        @endif
    </div>
</div>

<div class="container mx-auto px-4 py-12">

    @if($tooShort && $q)
    <div class="max-w-2xl mx-auto text-center py-12">
        <div class="w-16 h-16 rounded-2xl bg-yellow-50 flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-keyboard text-yellow-400 text-2xl"></i>
        </div>
        <h2 class="text-xl font-bold text-gray-800 mb-2">Kata kunci terlalu pendek</h2>
        <p class="text-gray-500">Ketik minimal 2 karakter untuk mulai mencari.</p>
    </div>

    @elseif(!$q)
    <div class="max-w-2xl mx-auto text-center py-12">
        <div class="w-16 h-16 rounded-2xl bg-blue-50 flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-search text-blue-400 text-2xl"></i>
        </div>
        <h2 class="text-xl font-bold text-gray-800 mb-2">Apa yang Anda cari?</h2>
        <p class="text-gray-500">Ketik kata kunci di kotak di atas untuk mencari berita, dosen, program studi, dan lainnya.</p>
    </div>

    @elseif($total === 0)
    <div class="max-w-2xl mx-auto text-center py-12">
        <div class="w-16 h-16 rounded-2xl bg-gray-50 flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-search text-gray-300 text-2xl"></i>
        </div>
        <h2 class="text-xl font-bold text-gray-800 mb-2">Tidak ada hasil ditemukan</h2>
        <p class="text-gray-500 mb-6">Tidak ada konten yang cocok dengan "<strong>{{ $q }}</strong>".</p>
        <div class="text-sm text-gray-400">
            <p class="mb-1">Saran:</p>
            <ul class="space-y-1">
                <li>• Periksa ejaan kata kunci</li>
                <li>• Coba kata kunci yang lebih umum</li>
                <li>• Gunakan kata kunci yang berbeda</li>
            </ul>
        </div>
    </div>

    @else
    <div class="max-w-3xl mx-auto space-y-4" data-aos="fade-up">
        @foreach($results as $item)
        <a href="{{ $item['url'] }}"
           class="block bg-white rounded-2xl shadow-sm border border-gray-100 p-5 hover:shadow-md hover:-translate-y-0.5 transform transition-all group">
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0"
                     style="background:{{ $item['color'] }}18">
                    <i class="fas {{ $item['icon'] }} text-sm" style="color:{{ $item['color'] }}"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2 mb-1 flex-wrap">
                        <span class="text-xs font-semibold px-2 py-0.5 rounded-full"
                              style="background:{{ $item['color'] }}18;color:{{ $item['color'] }}">
                            {{ $item['type'] }}
                        </span>
                        @if($item['badge'])
                        <span class="text-xs text-gray-400 bg-gray-50 px-2 py-0.5 rounded-full">{{ $item['badge'] }}</span>
                        @endif
                        @if($item['date'])
                        <span class="text-xs text-gray-400">{{ $item['date'] }}</span>
                        @endif
                    </div>
                    <h3 class="font-bold text-gray-800 group-hover:text-blue-700 transition line-clamp-2 mb-1">
                        {{ $item['title'] }}
                    </h3>
                    @if($item['excerpt'])
                    <p class="text-gray-500 text-sm line-clamp-2">{{ $item['excerpt'] }}</p>
                    @endif
                </div>
                <i class="fas fa-arrow-right text-gray-300 group-hover:text-blue-500 transition flex-shrink-0 mt-1"></i>
            </div>
        </a>
        @endforeach
    </div>
    @endif

</div>
@endsection
