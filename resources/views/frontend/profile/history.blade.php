@extends('layouts.frontend')
@section('title', 'Sejarah Kampus | STT Siloam Medan')
@section('content')
<div class="bg-blue-900 text-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold">Sejarah Kampus</h1>
        <nav class="text-sm mt-2">
            <a href="{{ route('home') }}" class="text-blue-300 hover:text-white">Beranda</a>
            <span class="mx-2 text-blue-400">&#x203A;</span>
            <span class="text-blue-300">Profil</span>
            <span class="mx-2 text-blue-400">&#x203A;</span>
            <span class="text-white">Sejarah</span>
        </nav>
    </div>
</div>
<div class="container mx-auto px-4 py-12">
    <div class="max-w-4xl mx-auto">
        @if(isset($page))
        <div class="bg-white rounded-xl shadow-md p-8" data-aos="fade-up">
            @if($page->image)
            <img loading="lazy" decoding="async" src="{{ $page->image_url }}" alt="Sejarah STT Siloam Medan" class="w-full max-h-80 object-cover rounded-lg mb-6">
            @endif
            <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                {!! clean($page->content) !!}
            </div>
        </div>
        @else
        <div class="bg-white rounded-xl shadow-md p-8" data-aos="fade-up">
            <h2 class="text-2xl font-bold text-blue-900 mb-4">Sejarah Berdirinya STT Siloam Medan</h2>
            <p class="text-gray-700 mb-4 leading-relaxed">STT Siloam Medan berdiri atas kerinduan untuk menyediakan lembaga pendidikan teologi yang berkualitas di Sumatera Utara. Sejak awal berdirinya, kampus ini berkomitmen untuk mencetak hamba Tuhan yang kompeten, berkarakter, dan berdampak bagi gereja dan masyarakat.</p>
            <p class="text-gray-700 mb-4 leading-relaxed">Perjalanan panjang STT Siloam Medan dimulai dari sebuah mimpi sederhana namun penuh keyakinan bahwa pendidikan teologi yang baik akan menghasilkan pemimpin gereja yang mampu membawa transformasi nyata di tengah-tengah masyarakat.</p>
            <p class="text-gray-700 leading-relaxed">Hingga kini, STT Siloam Medan terus berkembang dan telah menghasilkan ratusan alumni yang tersebar di berbagai penjuru Indonesia, melayani di gereja-gereja, lembaga pelayanan, dan bidang-bidang strategis lainnya.</p>
        </div>
        @endif
    </div>
</div>
@endsection
