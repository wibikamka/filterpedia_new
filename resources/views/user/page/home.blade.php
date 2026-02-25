@extends('layout.user')

@section('title', 'Home')

@section('content')

{{-- COMPOSITE BANNER SECTION --}}
<section class="mb-6 ">
    <div class="flex flex-col gap-3 sm:gap-4 lg:gap-6">
        
        {{-- ROW 1: BIG BANNER --}}
        <div class="w-full aspect-[14/5]">
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
                            alt="Main Banner {{ $i }}"
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
                                    alt="Square Banner {{ $j }}-{{ $i }}"
                                    loading="lazy">
                            @endfor
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>
</section>

<section class="category-bar py-6 px-4 sm:px-6 bg-white dark:bg-gray-900 shadow-sm mb-10 rounded-lg">
    <div class="container mx-auto">
        <h2 class="text-lg lg:text-2xl font-semibold mb-6 text-gray-900 dark:text-gray-100">
            Kategori
        </h2>
        <div class="grid
            grid-cols-3
            sm:grid-cols-4
            md:grid-cols-5
            lg:grid-cols-6
            gap-6">


            @foreach($categories as $category)
                <div class="flex flex-col items-center gap-3">
    {{-- Lingkaran icon --}}
    <a href="{{ route('product.category', $category->slug) }}"
       class="flex items-center justify-center w-20 h-20 lg:w-40 lg:h-40 rounded-full 
              border border-gray-200 dark:border-gray-700 hover:shadow-lg transition bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 overflow-hidden p-2"> {{-- Tambahkan padding agar gambar tidak terlalu mepet --}}
        
        @if($category->icon)
            <img src="{{ asset('storage/' . $category->icon) }}" 
                 alt="{{ $category->name }}" 
                 class="w-full h-full object-contain"> {{-- Gunakan w-full h-full --}}
        @endif
    </a>

    {{-- Nama kategori --}}
    <span class="mt-2 text-center text-xs md:text-base lg:text-lg font-medium 
                text-gray-800 dark:text-gray-200 truncate max-w-20 lg:max-w-40">
        {{ $category->name }}
    </span>
</div>
            @endforeach

        </div>
    </div>
</section>

{{-- BRAND & MARKETPLACE SECTION --}}
<section class="py-6  mb-10">
    <div class="container mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 lg:gap-6">

            {{-- BRAND SECTION --}}
            <div class="bg-white dark:bg-gray-900 shadow-sm rounded-lg p-6">
                <h2 class="text-lg lg:text-2xl font-semibold mb-6 text-gray-900 dark:text-gray-100">
                    Brand
                </h2>
                <div class="grid grid-cols-3 sm:grid-cols-4 gap-4">

                    @foreach([
                        ['img' => 'img/brand/veolia.png', 'name' => 'Brand 1'],
                        ['img' => 'img/brand/nuvonic.png', 'name' => 'Brand 2'],
                        ['img' => 'img/brand/suez.png', 'name' => 'Brand 3'],
                        ['img' => 'img/brand/cpure.png', 'name' => 'Brand 4'],
                        ['img' => 'img/brand/gemu.png', 'name' => 'Brand 5'],
                        ['img' => 'img/brand/aqua.png', 'name' => 'Brand 6'],
                        ['img' => 'brand/brand-7.png', 'name' => 'Brand 7'],
                        ['img' => 'brand/brand-8.png', 'name' => 'Brand 8'],
                    ] as $brand)
                        <div class="flex flex-col items-center gap-2">
                            <a href="#"
                               class="flex items-center justify-center w-20 h-20 sm:w-28 sm:h-28 lg:w-36 lg:h-36 rounded-full
                                      border border-gray-200 dark:border-gray-700 hover:shadow-lg transition
                                      bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700
                                      overflow-hidden p-2">
                                <img src="{{ asset('storage/' . $brand['img']) }}"
                                     alt="{{ $brand['name'] }}"
                                     class="w-full h-full object-contain">
                            </a>
                            <span class="text-center text-xs md:text-sm font-medium
                                         text-gray-800 dark:text-gray-200 truncate max-w-[64px] lg:max-w-[96px]">
                                {{ $brand['name'] }}
                            </span>
                        </div>
                    @endforeach

                </div>
            </div>

            {{-- MARKETPLACE SECTION --}}
            <div class="bg-white dark:bg-gray-900 shadow-sm rounded-lg p-6">
                <h2 class="text-lg lg:text-2xl font-semibold mb-6 text-gray-900 dark:text-gray-100">
                    Marketplace
                </h2>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">

                    @foreach([
                        ['img' => 'img/logo/Tokopedia_Logo 1.png',  'name' => 'Tokopedia',  'url' => 'https://tokopedia.com'],
                        ['img' => 'img/logo/tiktokshop.png',     'name' => 'Lazada',     'url' => 'https://lazada.co.id'],
                        ['img' => 'img/logo/shopee.png',     'name' => 'Shopee',     'url' => 'https://shopee.co.id'],
                        ['img' => 'img/logo/blibli.png',     'name' => 'Blibli',     'url' => 'https://blibli.com'],
                        ['img' => 'img/logo/tiktok.png',     'name' => 'TikTok Shop','url' => 'https://tiktok.com/shop'],
                        ['img' => 'img/logo/bukalapak.png',  'name' => 'Bukalapak',  'url' => 'https://bukalapak.com'],
                    ] as $mp)
                        <a href="{{ $mp['url'] }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="flex items-center justify-center rounded-lg aspect-[2/1]
                                  border border-gray-200 dark:border-gray-700 hover:shadow-lg transition
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
</section>


{{-- PRODUCT LIST SECTION --}}
<section id="produk-terbaru" class="pb-20">
    <div class="container mx-auto">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl sm:text-2xl font-semibold text-gray-900 dark:text-gray-100">
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