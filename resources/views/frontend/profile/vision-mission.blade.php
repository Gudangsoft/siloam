@extends('layouts.frontend')
@section('title', 'Visi & Misi | STT Siloam Medan')
@section('content')
<div class="bg-blue-900 text-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold">Visi & Misi</h1>
        <nav class="text-sm mt-2">
            <a href="{{ route('home') }}" class="text-blue-300 hover:text-white">Beranda</a>
            <span class="mx-2 text-blue-400">&#x203A;</span>
            <span class="text-blue-300">Profil</span>
            <span class="mx-2 text-blue-400">&#x203A;</span>
            <span class="text-white">Visi & Misi</span>
        </nav>
    </div>
</div>
<div class="container mx-auto px-4 py-12">
    <div class="max-w-4xl mx-auto">
        @if(isset($page))
        <div class="bg-white rounded-xl shadow-md p-8" data-aos="fade-up">
            <div class="prose prose-lg max-w-none">{!! $page->content !!}</div>
        </div>
        @else
        <div class="space-y-8">
            <div class="bg-gradient-to-br from-blue-800 to-blue-900 text-white rounded-xl p-8 text-center" data-aos="fade-up">
                <div class="w-16 h-16 bg-yellow-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                </div>
                <h2 class="text-2xl font-bold mb-4">Visi</h2>
                <p class="text-xl text-blue-100 leading-relaxed italic">Menjadi lembaga pendidikan teologi terkemuka yang menghasilkan pemimpin gereja yang berkarakter Kristus, berpengetahuan mendalam, dan berdampak bagi gereja, bangsa, dan dunia.</p>
            </div>
            <div class="bg-white rounded-xl shadow-md p-8" data-aos="fade-up">
                <div class="flex items-center gap-3 mb-6">
                    <div class="bg-blue-100 w-12 h-12 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    </div>
                    <h2 class="text-2xl font-bold text-blue-900">Misi</h2>
                </div>
                <ul class="space-y-4">
                    @foreach([
                        'Menyelenggarakan pendidikan teologi yang berkualitas dan relevan dengan kebutuhan gereja dan masyarakat',
                        'Membentuk karakter mahasiswa yang mencerminkan nilai-nilai Kristiani dalam kehidupan sehari-hari',
                        'Mendorong dan mendukung penelitian teologi yang berdampak bagi pengembangan iman Kristen',
                        'Membangun kemitraan strategis dengan gereja-gereja dan lembaga pelayanan untuk pengembangan pendidikan',
                        'Menyediakan lingkungan belajar yang kondusif dan berpusat pada Kristus',
                    ] as $mission)
                    <li class="flex gap-3">
                        <span class="text-yellow-500 text-xl font-bold flex-shrink-0">&#x2022;</span>
                        <span class="text-gray-700">{{ $mission }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="bg-white rounded-xl shadow-md p-8" data-aos="fade-up">
                <h2 class="text-2xl font-bold text-blue-900 mb-6">Nilai-Nilai Utama</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach(['Integritas', 'Keunggulan', 'Pelayanan', 'Komunitas'] as $val)
                    <div class="text-center p-4 bg-blue-50 rounded-lg">
                        <p class="font-bold text-blue-900">{{ $val }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
