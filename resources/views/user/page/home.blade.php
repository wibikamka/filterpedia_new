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
<x-banner-section 
    :showControls="true"
    :showDots="true"
    class="mb-10"
    :autoplaySpeed="4500"
    :minHeight="'min-h-50 sm:min-h-75 md:min-h-80 lg:min-h-87.5 2xl:min-h-125'"
/>

<section class="category-bar relative bg-white dark:bg-gray-900 mb-10 rounded-lg">
    
    {{-- Konten dengan padding top lebih besar agar tidak tertimpa badge --}}
    <div class=" w-full pt-4">
        {{-- Wrapper: Mobile: horizontal scroll, Desktop: grid layout --}}
        <div class="flex flex-nowrap gap-6 overflow-x-auto pb-4 scrollbar-hide md:grid md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 md:overflow-visible md:pb-0">

            @foreach($categories as $category)
                <div class="shrink-0 w-36 md:w-auto bg-linear-to-b from-white to-transparent dark:from-gray-800 dark:to-gray-700 rounded-lg hover:border-2 hover:border-bluefilterpedia shadow-md overflow-hidden border-2 border-gray-200 dark:border-gray-700 group">
            
                    <a href="{{ route('product.category', $category->slug) }}">
                    <div class="relative aspect-4/5 hover:bg-bluefilterpedia/10 transition cursor-pointer">
            
                        <div class="absolute top-3 left-3 w-12 xs:w-14 sm:w-14 md:w-16 lg:w-16 xl:w-18 2xl:w-20 h-12 xs:h-14 sm:h-14 md:h-16 lg:h-16 xl:h-18 2xl:h-20 z-10">
                            @if(isset($category->icon) && $category->icon)
                                <img src="{{ asset('storage/' . $category->icon) }}" 
                                     alt="{{ $category->name }}" 
                                     class="w-full h-full object-contain transition-all duration-300 group-hover:brightness-95 dark:group-hover:brightness-125">
                    
                            @endif
                        </div>

                        <div class="absolute inset-0 p-3 flex flex-col justify-end">
                            {{-- Nama kategori (dengan truncate untuk nama panjang) --}}
                            <span
                               class="block font-semibold text-gray-800 dark:text-gray-200 text-sm md:text-base 2xl:text-xl mb-0.5 transition truncate" 
                               title="{{ $category->name }}">
                                {{ $category->name }}
                            </span>
                            
                            {{-- Deskripsi kategori dengan line-clamp 2 --}}
                            <p class="text-xs md:text-base text-gray-600 dark:text-gray-400 group-hover:text-gray-800 dark:group-hover:text-gray-200 transition line-clamp-3 md:line-clamp-4">
                                {{ $category->description ?? 'Lorem ipsum dolor sit amet Lorem ipsum dolor sit ametLorem ipsum dolor sit ametLorem ipsum dolor sit amet.' }}
                            </p>
                            
                            {{-- Tombol atau link ke kategori --}}
                            <div class="mt-1">
                                <span class="text-[10px] sm:text-xs text-bluefilterpedia font-medium opacity-80 hover:opacity-100 transition">
                                    Lihat →
                                </span>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
            @endforeach

        </div>
    </div>
</section>

{{-- GANTI SECTION INI --}}
<section class="relative py-0 overflow-hidden mb-6" 
         style="width: 100vw; 
                position: relative; 
                left: 50%; 
                right: 50%; 
                margin-left: -50vw; 
                margin-right: -50vw;">
    
    {{-- Background image dengan tinggi tetap --}}
    <div class="relative w-full h-48 md:h-64 lg:h-80 overflow-hidden" {{-- PINDAHKAN overflow-hidden KE SINI --}}
         style="background-image: url('{{ asset('storage/img/banner/herov2.webp') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
        
        {{-- Gambar decorative di pojok kiri atas dengan rotasi -32 derajat --}}
        <div class="absolute -top-5 -left-10 w-24 h-24 md:w-48 md:h-48  
                    -rotate-324 pointer-events-none z-30"> {{-- Gunakan -rotate-32 --}}
            <img src="{{ asset('storage/img/logo/filterpedialastfilterpedia.png') }}" 
                 alt="" 
                 class="w-full h-full object-contain"
                 loading="lazy">
        </div>
        <div class="absolute -bottom-5 -right-5 w-24 h-24 md:w-48 md:h-48  
                    -rotate-161 pointer-events-none z-30"> {{-- Gunakan -rotate-32 --}}
            <img src="{{ asset('storage/img/logo/filterpedialastfilterpedia.png') }}" 
                 alt="" 
                 class="w-full h-full object-contain"
                 loading="lazy">
        </div>

        {{-- Overlay gelap --}}
        <div class="absolute inset-0 bg-black/40 dark:bg-black/60 z-0"></div>
        
        {{-- Blur effect elements --}}
        <div class="absolute -top-10 left-1/4 w-96 h-96 bg-bluefilterpedia dark:bg-blue-600 opacity-20 rounded-full blur-3xl pointer-events-none z-0"></div>
        <div class="absolute -bottom-10 right-1/4 w-96 h-96 bg-bluefilterpedia-sec dark:bg-cyan-600 opacity-20 rounded-full blur-3xl pointer-events-none z-0"></div>
        
        {{-- Konten dengan glassmorphism box --}}
        <div class="absolute inset-0 flex items-center z-10">
            {{-- Container untuk konten - sesuaikan dengan padding main --}}
            <div class="w-full mx-auto px-4 ">
                <div class="max-w-5xl mx-auto">
                    
                    {{-- Glassmorphism box --}}
                    <div class="backdrop-blur-xl bg-white/10 dark:bg-black/30 border border-white/30 dark:border-white/20 rounded-2xl shadow-2xl p-4 md:p-12 text-center">
                        
                        <h2 class="text-sm md:text-xl lg:text-4xl font-semibold text-white mb-2 md:mb-4 tracking-wide leading-snug">
                            Solusi Filtrasi Industri & Water Treatment
                        </h2>

                        {{-- Chip tags - compact di mobile --}}
                        <div class="flex flex-wrap justify-center gap-1 md:gap-2 md:hidden">
                            @foreach(['Cartridge Filter', 'Housing Filter', 'Water Treatment', 'Farmasi', 'Food & Beverage'] as $tag)
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-medium bg-white/30 text-white border border-white/40">
                                    {{ $tag }}
                                </span>
                            @endforeach
                        </div>

                        {{-- Paragraf full - hanya di md ke atas --}}
                        <p class="hidden md:block text-white/90 leading-relaxed text-sm lg:text-base max-w-3xl mx-auto">
                            Filterpedia menyediakan
                            <span class="font-semibold text-white">cartridge filter</span>,
                            <span class="font-semibold text-white">housing filter stainless steel</span>,
                            dan berbagai komponen
                            <span class="font-semibold text-white">water treatment</span>
                            untuk industri
                            <span class="italic">manufaktur, food & beverage, farmasi</span>,
                            dan pengolahan air limbah.
                        </p>
                    </div>

                </div>
            </div>
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
                            ['img' => 'img/logo/shopee.png',                 'name' => 'Shopee',      'url' => 'https://shopee.co.id'],
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

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3 sm:gap-4">

           @forelse ($products as $product)

<x-card :product="$product" />

@if ($loop->iteration == 10)

<x-ads-banner />

@endif

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
    </div>                <div class="mt-10 justify-center flex">
    {{ $products->fragment('produk-terbaru')->links() }}
</div>
</section>

@endsection