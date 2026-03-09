@extends('layout.user')

@section('title', 'Tentang Kami')

@section('content')

{{-- HERO SECTION --}}
<section class="relative overflow-hidden py-24 px-6">

    {{-- Background blur orbs --}}
    <div class="absolute -top-20 -left-20 w-96 h-96 bg-indigo-300/20 dark:bg-indigo-600/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-20 -right-20 w-96 h-96 bg-purple-300/20 dark:bg-purple-600/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative max-w-3xl mx-auto text-center">
        <span class="inline-block text-xs font-semibold tracking-widest uppercase text-indigo-500 dark:text-indigo-400 mb-4">
            Tentang Kami
        </span>
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white leading-tight mb-6">
            Kami hadir untuk <span class="text-indigo-500">memudahkan</span> hidup Anda
        </h1>
        <p class="text-lg text-gray-500 dark:text-gray-400 leading-relaxed">
            Sejak berdiri, kami berkomitmen menghadirkan solusi terbaik yang relevan,
            terpercaya, dan berdampak nyata bagi setiap pengguna kami.
        </p>
    </div>
</section>

{{-- VISI & MISI --}}
<section class="py-20 px-6 bg-gray-50 dark:bg-gray-900/50">
    <div class="max-w-5xl mx-auto grid md:grid-cols-2 gap-8">

        {{-- Visi --}}
        <div class="relative p-8 rounded-2xl bg-white dark:bg-gray-800 shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
            <div class="absolute top-0 left-0 w-1 h-full bg-gradient-to-b from-indigo-500 via-purple-500 to-transparent rounded-l-2xl"></div>
            <div class="mb-4">
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-indigo-50 dark:bg-indigo-900/50">
                    <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </span>
            </div>
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Visi</h2>
            <p class="text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                Menjadi platform terdepan yang menghubungkan kebutuhan masyarakat dengan
                solusi digital yang inovatif, inklusif, dan berkelanjutan.
            </p>
        </div>

        {{-- Misi --}}
        <div class="relative p-8 rounded-2xl bg-white dark:bg-gray-800 shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
            <div class="absolute top-0 left-0 w-1 h-full bg-gradient-to-b from-purple-500 via-pink-500 to-transparent rounded-l-2xl"></div>
            <div class="mb-4">
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-purple-50 dark:bg-purple-900/50">
                    <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </span>
            </div>
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Misi</h2>
            <ul class="space-y-2 text-gray-500 dark:text-gray-400 text-sm">
                <li class="flex items-start gap-2">
                    <span class="mt-1 w-1.5 h-1.5 rounded-full bg-purple-400 shrink-0"></span>
                    Menghadirkan layanan yang mudah diakses oleh semua kalangan.
                </li>
                <li class="flex items-start gap-2">
                    <span class="mt-1 w-1.5 h-1.5 rounded-full bg-purple-400 shrink-0"></span>
                    Membangun ekosistem digital yang aman dan terpercaya.
                </li>
                <li class="flex items-start gap-2">
                    <span class="mt-1 w-1.5 h-1.5 rounded-full bg-purple-400 shrink-0"></span>
                    Terus berinovasi demi pengalaman pengguna terbaik.
                </li>
            </ul>
        </div>

    </div>
</section>

{{-- CTA --}}
<section class="py-24 px-6">
    <div class="max-w-2xl mx-auto text-center">
        <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">
            Ada pertanyaan untuk kami?
        </h2>
        <p class="text-gray-500 dark:text-gray-400 mb-8">
            Tim kami siap membantu Anda. Jangan ragu untuk menghubungi kami kapan saja.
        </p>
        
           
            class="inline-flex items-center gap-2 px-8 py-3.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm transition-colors duration-200 shadow-lg shadow-indigo-500/30"
        >
            Hubungi Kami
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>
    </div>
</section>

@endsection
