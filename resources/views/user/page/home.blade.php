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
    :minHeight="'min-h-[30vh] sm:min-h-[40vh] md:min-h-[50vh] lg:min-h-[60vh] 2xl:min-h-[65vh]'"
/>

<section class="category-bar relative bg-white dark:bg-gray-900 mb-10 rounded-lg">
    <div class="w-full pt-4">
        <div class="flex flex-wrap justify-center gap-3 pb-4 overflow-x-auto scrollbar-hide md:overflow-visible md:pb-0">

            @foreach($categories as $category)
                <div class="shrink-0 w-36 md:w-48 lg:w-52 xl:w-56 bg-linear-to-b from-white to-transparent dark:from-gray-800 dark:to-gray-700 rounded-lg hover:border-2 hover:border-bluefilterpedia shadow-md overflow-hidden border-2 border-gray-200 dark:border-gray-700 group">
            
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
                            <span
                               class="block font-semibold text-gray-800 dark:text-gray-200 text-sm md:text-base 2xl:text-xl mb-0.5 transition truncate" 
                               title="{{ $category->name }}">
                                {{ $category->name }}
                            </span>
                            
                            <p class="text-xs md:text-base text-gray-600 dark:text-gray-400 group-hover:text-gray-800 dark:group-hover:text-gray-200 transition line-clamp-3 md:line-clamp-4">
                                {{ $category->description ?? 'Lorem ipsum dolor sit amet Lorem ipsum dolor sit ametLorem ipsum dolor sit ametLorem ipsum dolor sit amet.' }}
                            </p>
                            
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

{{-- BLOG CATEGORY SECTION --}}
@if($blogCategories->count() > 0)
<section class="py-10  px-4 sm:px-6 lg:px-8"
         style="width: 100vw; 
                position: relative; 
                left: 50%; 
                right: 50%; 
                margin-left: -50vw; 
                margin-right: -50vw;
                background-image: url('{{ asset('storage/blog/blog-home-section.webp') }}');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;">

 <div class="absolute inset-0 bg-black/50 dark:bg-black/70"></div>
    <div class="container mx-auto z-10 relative">
        
        {{-- Gunakan JSON yang sudah di-escape --}}
        <div x-data="window.blogCategoryFilter({{ Js::from($blogCategories) }})" 
             class="flex flex-col lg:grid lg:grid-cols-4 gap-6 lg:gap-8">
            
            {{-- KOLOM 1: MENU KATEGORI - Horizontal scroll di mobile --}}
            <div class="lg:col-span-1">
                <div class=" lg:top-20">
                    <h1 class="text-lg font-bold text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-700 lg:block hidden">
                        Solusi Tepat Untuk Kebutuhan Filtrasi Anda
                    </h1>
                    <h1 class="text-lg font-bold text-white mb-3 lg:hidden block">
                        Solusi Tepat Untuk Kebutuhan Filtrasi Anda
                    </h1>
                    
                    {{-- Horizontal scroll menu di mobile --}}
                    <ul class="flex lg:flex-col gap-2 overflow-x-auto lg:overflow-x-visible pb-3 lg:pb-0 -mx-4 px-4 lg:mx-0 lg:px-0 scrollbar-hide">
                        <template x-for="category in categories" :key="category.id">
                            <li class="flex-shrink-0 lg:flex-shrink">
                                <button 
                                    @click="filterByCategory(category.id)"
                                    :class="{
                                        'bg-bluefilterpedia text-white': activeCategory === category.id,
                                        'text-gray-100 hover:bg-gray-100/40': activeCategory !== category.id
                                    }"
                                    class="whitespace-nowrap px-4 py-2 lg:py-3 rounded-lg transition-all duration-200 font-medium w-full lg:text-left text-center cursosr-pointer">
                                    <span x-text="category.name"></span>
                                </button>
                            </li>
                        </template>
                    </ul>
                </div>
            </div>

            {{-- KOLOM 2-4: CARD BLOG --}}
            <div class="lg:col-span-3">
                
                {{-- Loop kategori untuk rendering card --}}
                <template x-for="category in categories" :key="category.id">
                    <div x-show="activeCategory === category.id" 
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 transform translate-y-2"
                         x-transition:enter-end="opacity-100 transform translate-y-0">
                        
                        {{-- Mobile: Horizontal scroll cards --}}
                        <div class="flex lg:hidden gap-4 overflow-x-auto pb-4 -mx-4 px-4 scrollbar-hide">
                            <template x-for="post in category.posts" :key="post.id">
                                <div class="flex-shrink-0 w-72">
                                    <div class="bg-white dark:bg-gray-900 shadow-sm rounded-lg overflow-hidden hover:shadow-md transition h-full flex flex-col">
                                        
                                        {{-- Thumbnail --}}
                                        <a :href="'/blog/' + post.slug" class="block overflow-hidden flex-shrink-0" x-show="post.thumbnail_url">
                                            <img :src="post.thumbnail_url" 
                                                 :alt="post.title"
                                                 class="w-full h-40 object-cover hover:scale-105 transition-transform duration-300">
                                        </a>
                                        
                                        {{-- Placeholder --}}
                                        <div x-show="!post.thumbnail_url" class="w-full h-40 bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                        
                                        {{-- Content --}}
                                        <div class="p-4 flex-1 flex flex-col">
                                            <h3 class="text-base font-bold mb-2 line-clamp-2">
                                                <a :href="'/blog/' + post.slug" 
                                                   class="text-gray-900 dark:text-white hover:text-bluefilterpedia transition-colors">
                                                    <span x-text="post.title"></span>
                                                </a>
                                            </h3>
                                            <p class="text-gray-600 dark:text-gray-400 text-sm line-clamp-2" 
                                               x-text="post.excerpt || post.clean_content || 'Baca selengkapnya...'"></p>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                        
                        {{-- Desktop: Grid cards --}}
                        {{-- Desktop: Grid cards --}}
<div class="hidden lg:grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
    <template x-for="post in category.posts" :key="post.id">
        <div class="bg-white dark:bg-gray-900 shadow-sm rounded-lg overflow-hidden group-hover:shadow-md transition h-full flex flex-col group">
            
            {{-- Thumbnail --}}
            <a :href="'/blog/' + post.slug" class="block overflow-hidden flex-shrink-0" x-show="post.thumbnail_url">
                <img :src="post.thumbnail_url" 
                     :alt="post.title"
                     class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
            </a>
            
            {{-- Placeholder --}}
            <div x-show="!post.thumbnail_url" class="w-full h-48 bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
            
            {{-- Content --}}
            <div class="p-5 flex-1 flex flex-col">
                <h3 class="text-lg font-bold mb-2 line-clamp-2">
                    <a :href="'/blog/' + post.slug" 
                       class="text-gray-900 dark:text-white group-hover:text-bluefilterpedia transition-colors">
                        <span x-text="post.title"></span>
                    </a>
                </h3>
                <a :href="'/blog/' + post.slug" class="cursor-pointer">
    <p class="text-gray-600 dark:text-gray-400 text-sm line-clamp-3 group-hover:text-bluefilterpedia group-hover:underline transition-colors" 
       x-text="post.excerpt || post.clean_content || 'Baca selengkapnya...'"></p>
</a>
            </div>
        </div>
    </template>
</div>
                        
                    </div>
                </template>

            </div>

        </div>
    </div>
</section>
@endif

<section class="mb-10 bg-gray-100 dark:bg-gray-800 py-12 px-4 sm:px-6 lg:px-8 rounded-lg"          
    style="width: 100vw; 
        position: relative; 
        left: 50%; 
        right: 50%; 
        margin-left: -50vw; 
        margin-right: -50vw;">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl md:text-2xl lg:text-3xl font-semibold text-gray-900 dark:text-gray-100">
                Marketplace
            </h2>
        </div>
        {{-- MARKETPLACE SECTION (Single Column Full Width) --}}
        <div class="relative overflow-hidden ">


            {{-- Grid 4 kolom memanjang --}}
            <div class="py-2">
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">

                    @foreach([
                        ['img' => 'img/logo/Tokopedia_Logo 1.png',       'name' => 'Tokopedia',   'url' => 'https://www.tokopedia.com/filterpedia-co-id'],
                        ['img' => 'img/logo/tiktokshop.png',             'name' => 'TikTok Shop', 'url' => 'https://www.tiktok.com/@filterpedia.co.id'],
                        ['img' => 'img/logo/shopee.png',                 'name' => 'Shopee',      'url' => 'https://shopee.co.id/filterpedia.co.id'],
                        ['img' => 'img/logo/Digital_Inline_Green.png',   'name' => 'WhatsApp',    'url' => 'https://wa.me/6281110058788?text=Halo filterpedia'],
                    ] as $mp)
                        <a href="{{ $mp['url'] }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="flex items-center justify-center rounded-lg aspect-[2/1]
                                  border-2 border-bluefilterpedia-sec/50 dark:border-gray-700 hover:shadow-lg transition
                                hover:bg-bluefilterpedia/10 dark:hover:bg-gray-700 hover:border-2 hover:border-bluefilterpedia
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


<section class="relative py-0 overflow-hidden" 
         style="width: 100vw; 
                position: relative; 
                left: 50%; 
                right: 50%; 
                margin-left: -50vw; 
                margin-right: -50vw;">
    
    <div class="relative w-full h-48 md:h-64 lg:h-80 overflow-hidden" 
         style="background-image: url('{{ asset('storage/img/banner/herov2.webp') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
        
        <div class="absolute -top-5 -left-10 w-24 h-24 md:w-48 md:h-48  
                    -rotate-324 pointer-events-none z-30"> 
            <img src="{{ asset('storage/img/logo/filterpedialastfilterpedia.png') }}" 
                 alt="" 
                 class="w-full h-full object-contain"
                 loading="lazy">
        </div>
        <div class="absolute -bottom-5 -right-5 w-24 h-24 md:w-48 md:h-48  
                    -rotate-161 pointer-events-none z-30"> 
            <img src="{{ asset('storage/img/logo/filterpedialastfilterpedia.png') }}" 
                 alt="" 
                 class="w-full h-full object-contain"
                 loading="lazy">
        </div>

        <div class="absolute inset-0 bg-black/40 dark:bg-black/60 z-0"></div>
        
        <div class="absolute -top-10 left-1/4 w-96 h-96 bg-bluefilterpedia dark:bg-blue-600 opacity-20 rounded-full blur-3xl pointer-events-none z-0"></div>
        <div class="absolute -bottom-10 right-1/4 w-96 h-96 bg-bluefilterpedia-sec dark:bg-cyan-600 opacity-20 rounded-full blur-3xl pointer-events-none z-0"></div>
        
        <div class="absolute inset-0 flex items-center z-10">
            <div class="w-full mx-auto px-4 ">
                <div class="max-w-5xl mx-auto">
                    
                    <div class="backdrop-blur-xl bg-white/10 dark:bg-black/30 border border-white/30 dark:border-white/20 rounded-2xl shadow-2xl p-4 md:p-12 text-center">
                        
                        <h2 class="text-sm md:text-xl lg:text-4xl font-semibold text-white mb-2 md:mb-4 tracking-wide leading-snug">
                            Solusi Filtrasi Industri & Water Treatment
                        </h2>

                        <div class="flex flex-wrap justify-center gap-1 md:gap-2 md:hidden">
                            @foreach(['Cartridge Filter', 'Housing Filter', 'Water Treatment', 'Farmasi', 'Food & Beverage'] as $tag)
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-medium bg-white/30 text-white border border-white/40">
                                    {{ $tag }}
                                </span>
                            @endforeach
                        </div>

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

{{-- Latest Blog Section - Compact --}}
<section class="pb-12 bg-gray-100 dark:bg-gray-900 py-12"         
        style="width: 100vw; 
                position: relative; 
                left: 50%; 
                right: 50%; 
                margin-left: -50vw; 
                margin-right: -50vw;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 ">
        
        {{-- Section Header --}}
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl md:text-2xl font-bold text-gray-900 dark:text-white">
                Artikel <span class="text-bluefilterpedia">Terbaru</span>
            </h2>
            <a href="{{ route('blog.index') }}" 
               class="text-bluefilterpedia hover:text-blue-700 text-sm font-medium">
                Lihat Selengkapnya →
            </a>
        </div>

        {{-- Blog List - 2 Rows --}}
        <div class="space-y-4">
            @forelse($latestPosts->take(2) as $post)
                <article class=" dark:bg-gray-900 border-b-2 border-gray-400 dark:border-gray-600 hover:shadow-md 
                              transition-all duration-200 overflow-hidden group">
                    
                    <a href="{{ route('blog.show', $post->slug) }}" class="flex items-center gap-4 p-4">
                        
                        
                        {{-- Konten - Kanan --}}
                        <div class="flex-1 min-w-0">
                            
                            {{-- Category & Date --}}
                            <div class="flex items-center gap-2 mb-1">
                                <span class="text-xs text-bluefilterpedia font-medium">
                                    {{ ucfirst(str_replace('-', ' ', $post->category)) }}
                                </span>
                                <span class="text-xs text-gray-400">•</span>
                                <span class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ $post->published_at?->format('d M Y') }}
                                </span>
                            </div>
                            
                            {{-- Title --}}
                            <h3 class="text-sm md:text-base font-semibold text-gray-900 dark:text-white 
                                       group-hover:text-bluefilterpedia group-hover:underline transition-colors line-clamp-2">
                                {{ $post->title }}
                            </h3>
                            
                            {{-- Excerpt (Opsional - untuk desktop) --}}
                            <p class="hidden md:block text-xs text-gray-600 dark:text-gray-400 mt-1 line-clamp-3">
                                {{ $post->excerpt ?? Str::limit(strip_tags($post->content),400) }}
                            </p>
                        </div>
                    </a>
                </article>
                
            @empty
                <div class="text-center py-8">
                    <p class="text-sm text-gray-500 dark:text-gray-400">No articles yet.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
<script>
    // Definisikan function di window scope (HANYA SATU)
    window.blogCategoryFilter = function(categoriesData) {
        return {
            categories: categoriesData || [],
            activeCategory: null,
            
            init() {
                // Set kategori pertama sebagai default
                if (this.categories && this.categories.length > 0) {
                    this.activeCategory = this.categories[0].id;
                }
            },
            
            filterByCategory(categoryId) {
                this.activeCategory = categoryId;
            }
        }
    }
</script>
@endsection