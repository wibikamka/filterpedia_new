{{-- resources/views/errors/404.blade.php --}}
@extends('layout.user')
@section('title', '404 - Halaman Tidak Ditemukan | Filterpedia')
@section('content')
@endsection

@section('full-width-content')
@php
    $bannerDir = storage_path('app/public/img/banner');
    $bannerFiles = file_exists($bannerDir)
        ? array_values(array_filter(scandir($bannerDir), fn($f) =>
            !in_array($f, ['.','..']) && preg_match('/\.(jpg|jpeg|png|webp)$/i', $f)))
        : [];
    $bgImage = $bannerFiles[0] ?? null;
@endphp

{{-- GRADIENT FULL WIDTH --}}
<div class="relative min-h-screen bg-linear-to-b from-blue-50 via-white to-teal-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 overflow-hidden">
    
    {{-- EFEK CAHAYA SETENGAH LINGKARAN DARI BAWAH --}}
    <div class="absolute inset-0 pointer-events-none">
        {{-- Layer 1: Cahaya utama setengah lingkaran dari bawah (biru teal) --}}
        <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-150 h-75 
                    bg-linear-to-t from-teal-400/30 via-blue-400/20 to-transparent
                    rounded-[100%] blur-3xl"></div>
        
        {{-- Layer 2: Cahaya kedua lebih kecil (ungu) --}}
        <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-100 h-50 
                    bg-linear-to-t from-purple-400/25 via-indigo-400/15 to-transparent
                    rounded-[100%] blur-2xl"></div>
        
        {{-- Layer 3: Cahaya ketiga paling kecil (biru muda) --}}
        <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-62.5 h-37.5 
                    bg-linear-to-t from-blue-300/30 via-cyan-300/20 to-transparent
                    rounded-[100%] blur-xl"></div>
        
        {{-- Efek tambahan: kilauan di tengah --}}
        <div class="absolute bottom-[5%] left-1/2 -translate-x-1/2 w-37.5 h-20 
                    bg-white/20 rounded-[100%] blur-lg"></div>
    </div>

    {{-- KONTEN UTAMA --}}
    <div class="relative flex flex-col items-center justify-center min-h-screen px-4 py-16 z-10">
        
        {{-- TEXT SECTION --}}
        <div class="text-center mb-8 max-w-2xl">
            <p class="text-2xl md:text-4xl font-bold text-gray-900 dark:text-white tracking-tight mb-4">
                404
            </p>
            
            <p class="text-xl md:text-4xl font-medium text-gray-600 dark:text-gray-300 leading-relaxed">
                Halaman yang Anda cari tidak ada, mungkin beranda
                bisa jadi awal.
            </p>
            
            <div class="mt-8">
                <a href="{{ route('home') }}"
                   class="inline-flex items-center gap-2 border border-gray-300 dark:border-gray-600
                          text-gray-700 dark:text-gray-300 text-base font-medium
                          px-6 py-3 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 
                          hover:border-gray-400 transition-all duration-200
                          shadow-md hover:shadow-lg backdrop-blur-sm bg-white/30 dark:bg-gray-900/30">
                    ← Kembali ke Beranda
                </a>
            </div>
        </div>

        {{-- IMAGE CARD - FULL WIDTH DI MOBILE --}}
        <div class="w-full max-w-2xl relative mx-auto">
            {{-- Gambar --}}
            <div class="w-full overflow-hidden shadow-2xl ring-1 ring-white/20 backdrop-blur-sm
                        md:rounded-2xl {{-- rounded hanya di desktop --}}"
                 style="aspect-ratio: 16/9;">
                @if($bgImage)
                    <img src="{{ asset('storage/img/banner/watersystem.webp') }}"
                         alt="Filterpedia"
                         class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full bg-linear-to-br from-blue-600 to-teal-500"></div>
                @endif
                
                {{-- Gradient overlay --}}
                <div class="absolute inset-0 bg-linear-to-t from-black to-transparent"></div>
                
                {{-- Blog card content (di dalam gambar) --}}
                <div class="absolute inset-0 flex flex-col justify-end p-7 text-white">
                    <p class="text-xs italic underline underline-offset-2 text-white/75 mb-2">#blog</p>
                    <h2 class="text-lg md:text-xl font-bold leading-snug mb-2">
                        Solusi Filterasi Industri &amp; Water Treatment
                    </h2>
                    <p class="text-sm text-white/80 leading-relaxed mb-4 max-w-md">
                        Filterpedia menyediakan cartridge filter, membrane RO, dan berbagai komponen water treatment
                        untuk industri manufaktur, food &amp; beverage, farmasi, rumah tangga dan pengolahan air limbah.
                    </p>
                </div>
            </div>
            
            {{-- Tombol Lanjut membaca di LUAR gambar --}}
            <div class="mt-6 text-center md:text-left">
                <a href="{{ route('home') }}"
                   class="inline-flex items-center gap-1.5 border border-gray-300 dark:border-gray-600
                          text-gray-700 dark:text-gray-300 text-sm font-medium
                          px-5 py-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800
                          hover:border-gray-400 transition-all duration-200
                          shadow-md hover:shadow-lg bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm">
                    Lanjut membaca
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>

<style>
/* Efek tambahan untuk cold tone */
.cold-glow {
    filter: drop-shadow(0 0 20px rgba(0, 255, 255, 0.3));
}

/* Animasi subtle untuk efek cahaya */
@keyframes glowPulse {
    0%, 100% { opacity: 0.5; }
    50% { opacity: 0.8; }
}

.absolute.bottom-0 {
    animation: glowPulse 4s ease-in-out infinite;
}

/* Delay berbeda untuk setiap layer */
.absolute.bottom-0:nth-child(1) { animation-delay: 0s; }
.absolute.bottom-0:nth-child(2) { animation-delay: 1s; }
.absolute.bottom-0:nth-child(3) { animation-delay: 2s; }

/* Mobile: full width tanpa rounded */
@media (max-width: 768px) {
    .md\:rounded-2xl {
        border-radius: 0;
    }
    
    .w-full.max-w-2xl {
        max-width: 100%;
        width: 100vw;
        margin-left: -1rem;
        margin-right: -1rem;
    }
    
    .px-4 {
        padding-left: 0;
        padding-right: 0;
    }
}
</style>
@endsection