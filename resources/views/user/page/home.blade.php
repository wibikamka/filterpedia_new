@extends('layout.user')

@section('title', 'Supplier Cartridge Filter & Water Treatment Industri | Filterpedia')
@section('meta_description', 'Filterpedia adalah supplier cartridge filter, housing filter, dan solusi water treatment industri di Indonesia. Tersedia berbagai micron rating dan material untuk kebutuhan industri.')
@section('structured_data')
<script type="application/ld+json">
@verbatim
{
  "@context": "https://schema.org",
  "@type": "WebSite",
  "name": "Filterpedia",
  "url": "/"
}
@endverbatim
</script>
@endsection
@section('content')

{{-- COMPOSITE BANNER SECTION --}}
<section class="mb-6 ">
    <div class="flex flex-col gap-3 sm:gap-4 lg:gap-6">
        <h1 class="sr-only">
    Supplier Cartridge Filter dan Water Treatment Industri di Indonesia
</h1>
        {{-- ROW 1: BIG BANNER --}}
        <div class="w-full aspect-14/5">
            <div
                x-data="slider(3, 4500)"
                x-init="start()"
                class="relative w-full h-full overflow-hidden rounded-lg shadow-md">
                
                <div class="relative w-full h-full">
                    @for ($i = 1; $i <= 3; $i++)
                        <img
                            src="{{ asset("storage/img/banner/banner_caa-$i.png") }}"
                            class="absolute inset-0 w-full h-full object-cover transition-opacity duration-700"
                            :class="active === {{ $i - 1 }} ? 'opacity-100' : 'opacity-0'"
                            alt="Supplier Cartridge Filter Industri - Filterpedia {{ $i }}"
                            loading="lazy">
                    @endfor
                    
                    {{-- Navigation Buttons --}}
                    <button
                        @click="prev()"
                        class="absolute left-2 sm:left-4 top-1/2 -translate-y-1/2 z-10
                               bg-black/40 hover:bg-black/60 text-white
                               w-8 h-8 sm:w-10 sm:h-10 rounded-full flex items-center justify-center
                               transition-all duration-200 hover:scale-110"
                        aria-label="Previous slide">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </button>
                    
                    <button
                        @click="next()"
                        class="absolute right-2 sm:right-4 top-1/2 -translate-y-1/2 z-10
                               bg-black/40 hover:bg-black/60 text-white
                               w-8 h-8 sm:w-10 sm:h-10 rounded-full flex items-center justify-center
                               transition-all duration-200 hover:scale-110"
                        aria-label="Next slide">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>

                    {{-- Dots Indicator --}}
                    <div class="absolute bottom-2 sm:bottom-4 left-1/2 -translate-x-1/2 flex gap-1.5 sm:gap-2 z-10">
                        @for ($i = 0; $i < 3; $i++)
                            <button
                                @click="active = {{ $i }}"
                                class="w-2 h-2 sm:w-2.5 sm:h-2.5 rounded-full transition-all duration-300"
                                :class="active === {{ $i }} ? 'bg-white w-6 sm:w-8' : 'bg-white/50'"
                                aria-label="Go to slide {{ $i + 1 }}">
                            </button>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
        
        {{-- ROW 2: THREE SQUARE BANNERS --}}
        {{-- Tetap 1:1 (persegi) di semua device --}}
        <div class="grid grid-cols-3 gap-3 sm:gap-4 lg:gap-6">
            @for ($j = 1; $j <= 3; $j++)
                <div class="w-full aspect-square">
                    <div
                        x-data="slider(3, {{ 3000 + ($j * 500) }})"
                        x-init="start()"
                        class="relative w-full h-full overflow-hidden rounded-lg shadow-md">
                        
                        <div class="relative w-full h-full">
                            @for ($i = 1; $i <= 3; $i++)
                                <img
                                    src="{{ asset("storage/img/bannersquare/square-$i.png") }}"
                                    class="absolute inset-0 w-full h-full object-cover transition-opacity duration-700"
                                    :class="active === {{ $i - 1 }} ? 'opacity-100' : 'opacity-0'"
                                    alt="Cartridge Filter 5 Micron untuk Water Treatment {{ $j }}-{{ $i }}"
                                    loading="lazy">
                            @endfor
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>
</section>
<section class="relative py-6 md:py-12 md:px-0 overflow-hidden">

    <div class="absolute -top-10 left-1/4 w-96 h-96 bg-bluefilterpedia dark:bg-blue-600 opacity-15 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-10 right-1/4 w-96 h-96 bg-bluefilterpedia-sec dark:bg-cyan-600 opacity-15 rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative w-full
                bg-white/40 dark:bg-white/5
                backdrop-blur-xl
                border-y border-white/50 dark:border-white/10
                py-6 md:py-12 px-4 md:px-8">

        <div class="max-w-4xl mx-auto text-center">

            <h2 class="text-base md:text-2xl lg:text-3xl font-bold
                       text-gray-900 dark:text-white
                       mb-4 tracking-wide leading-snug">
                Solusi Filtrasi Industri & Water Treatment
            </h2>

            {{-- Chip tags - compact di mobile, hidden di md ke atas --}}
            <div class="flex flex-wrap justify-center gap-2 md:hidden">
                @foreach(['Cartridge Filter', 'Housing Filter', 'Water Treatment', 'Farmasi', 'Food & Beverage'] as $tag)
                    <span class="px-3 py-1 rounded-full text-xs font-medium
                                 bg-blue-50 dark:bg-blue-900/30
                                 text-bluefilterpedia dark:text-blue-300
                                 border border-blue-200 dark:border-blue-700">
                        {{ $tag }}
                    </span>
                @endforeach
            </div>

            {{-- Paragraf full - hanya di md ke atas --}}
            <p class="hidden md:block text-gray-700 dark:text-gray-300 leading-relaxed md:text-base lg:text-lg">
                Filterpedia menyediakan
                <span class="font-semibold text-bluefilterpedia dark:text-blue-400">cartridge filter</span>,
                <span class="font-semibold text-bluefilterpedia dark:text-blue-400">housing filter stainless steel</span>,
                dan berbagai komponen
                <span class="font-semibold text-bluefilterpedia dark:text-blue-400">water treatment</span>
                untuk industri
                <span class="italic">manufaktur, food & beverage, farmasi</span>,
                dan pengolahan air limbah.
            </p>

        </div>
    </div>
</section>
<section class="category-bar relative bg-white dark:bg-gray-900 shadow-sm mb-10 rounded-lg overflow-hidden">
    
    {{-- Badge "Kategori" pojok kiri atas --}}
    <div class="absolute top-0 left-0 
                bg-bluefilterpedia text-white 
                px-5 py-2 pr-12 rounded-br-full
                text-lg lg:text-2xl font-semibold">
        Kategori
    </div>

    {{-- Konten dengan padding top lebih besar agar tidak tertimpa badge --}}
    <div class="container mx-auto px-4 sm:px-6 pt-14 pb-6">
        <div class="grid
            grid-cols-3
            sm:grid-cols-4
            md:grid-cols-5
            lg:grid-cols-6
            gap-6">

            @foreach($categories as $category)
                <div class="flex flex-col items-center gap-3">
                    <a href="{{ route('product.category', $category->slug) }}"
                       class="flex items-center justify-center w-full aspect-square rounded-full 
                              border border-bluefilterpedia hover:shadow-lg transition 
                              bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 
                              overflow-hidden p-2">
                        @if($category->icon)
                            <img src="{{ asset('storage/' . $category->icon) }}" 
                                 alt="{{ $category->name }}" 
                                 class="w-full h-full object-contain">
                        @endif
                    </a>
                    <span class="text-center text-xs md:text-base font-regular 
                                text-gray-800 dark:text-gray-200 truncate w-full">
                        {{ $category->name }}
                    </span>
                </div>
            @endforeach

        </div>
    </div>
</section>

<section class="py-6 mb-10">
    <div class="container mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 lg:gap-6">

            {{-- BRAND SECTION --}}
            <div class="relative bg-white dark:bg-gray-900 shadow-sm rounded-lg overflow-hidden">
                
                {{-- Badge pojok kiri atas --}}
                <div class="absolute top-0 left-0 
                            bg-bluefilterpedia text-white 
                            px-5 py-2 pr-12 rounded-br-full
                            text-lg lg:text-2xl font-semibold">
                    Brand
                </div>

                <div class="pt-14 p-6">
                    <div class="grid grid-cols-3 sm:grid-cols-4 gap-3">

                        @foreach([
                            ['img' => 'img/brand/veolia.png',   'name' => 'Veolia'],
                            ['img' => 'img/brand/nuvonic.png',  'name' => 'Nuvonic'],
                            ['img' => 'img/brand/suez.png',     'name' => 'Suez'],
                            ['img' => 'img/brand/cpure.png',    'name' => 'C-Pure'],
                            ['img' => 'img/brand/gemu.png',     'name' => 'Gemu'],
                            ['img' => 'img/brand/aqua.png',     'name' => 'Aquafine'],
                            ['img' => 'img/brand/PENTAIR.png',  'name' => 'Pentair'],
                            ['img' => 'img/brand/DUPONT.png',   'name' => 'Dupont'],
                        ] as $brand)
                            <div class="flex flex-col items-center gap-2">
                                <a href="#"
                                   class="flex items-center justify-center w-full aspect-square rounded-full
                                          border border-bluefilterpedia-sec/50 dark:border-bluefilterpedia/50 hover:shadow-lg transition
                                          bg-white overflow-hidden p-2">
                                    <img src="{{ asset('storage/' . $brand['img']) }}"
                                         alt="{{ $brand['name'] }}"
                                         class="w-full h-full object-contain">
                                </a>
                                <span class="text-center text-base font-regular
                                             text-gray-800 dark:text-gray-200 truncate w-full">
                                    {{ $brand['name'] }}
                                </span>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>

            {{-- MARKETPLACE SECTION --}}
            <div class="relative bg-white dark:bg-gray-900 shadow-sm rounded-lg overflow-hidden">

                {{-- Badge pojok kiri atas --}}
                <div class="absolute top-0 left-0 
                            bg-bluefilterpedia text-white 
                            px-5 py-2 pr-12 rounded-br-full
                            text-lg lg:text-2xl font-semibold">
                    Marketplace
                </div>

                <div class="pt-14 p-6">
                    <div class="grid grid-cols-2 gap-4">

                        @foreach([
                            ['img' => 'img/logo/Tokopedia_Logo 1.png',       'name' => 'Tokopedia',   'url' => 'https://www.tokopedia.com/filterpedia-co-id'],
                            ['img' => 'img/logo/tiktokshop.png',             'name' => 'TikTok Shop', 'url' => 'https://www.tiktok.com/@filterpedia.co.id'],
                       
                            ['img' => 'img/logo/Digital_Inline_Green.png',   'name' => 'WhatsApp',    'url' => 'https://wa.me/6281110058788?text=Halo filterpedia'],
                        ] as $mp)
                            <a href="{{ $mp['url'] }}"
                               target="_blank"
                               rel="noopener noreferrer"
                               class="flex items-center justify-center rounded-lg aspect-2/1
                                      border border-bluefilterpedia-sec/50 dark:border-gray-700 hover:shadow-lg transition
                                      bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700
                                      overflow-hidden p-3">
                                <img src="{{ asset('storage/' . $mp['img']) }}"
                                     alt="{{ $mp['name'] }}"
                                     class="w-full h-full object-contain">
                            </a>
                        @endforeach

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- PRODUCT LIST SECTION --}}
<section id="produk-terbaru" class="pb-20">
    <div class="container mx-auto">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl md:text-2xl lg:text-3xl font-semibold text-gray-900 dark:text-gray-100">
                Produk Terbaru
            </h2>
        </div>

        <div class="
  grid
  grid-cols-2
  sm:grid-cols-3
  md:grid-cols-4
  lg:grid-cols-5

  gap-3
  sm:gap-4
">

            @forelse ($products as $product)
<x-card :product="$product" />


            @empty
                <div class="col-span-full text-center py-12 text-gray-500">
                    <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                    </svg>
                    <p class="text-base font-medium">Belum ada produk tersedia</p>
                    <p class="text-sm mt-1">Produk akan segera ditambahkan</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

@endsection