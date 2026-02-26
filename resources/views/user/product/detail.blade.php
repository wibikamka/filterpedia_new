{{-- resources/views/user/product/detail.blade.php --}}
@extends('layout.user')

@section('title', $product->name . ' - ' . ($product->category->name ?? '') . ' | Filterpedia')
@section('meta_description', 
Str::limit(strip_tags($product->description), 155))
@section('structured_data')
@php
$productSchema = [
    "@context" => "https://schema.org/",
    "@type" => "Product",
    "name" => $product->name,
    "image" => $product->primaryImage 
        ? asset('storage/'.$product->primaryImage->path) 
        : null,
    "description" => \Illuminate\Support\Str::limit(strip_tags($product->description), 200),
    "sku" => $product->sku,
    "brand" => [
        "@type" => "Brand",
        "name" => "Filterpedia",
    ],
    "offers" => [
        "@type" => "Offer",
        "priceCurrency" => "IDR",
        "price" => $product->price,
        "availability" => $product->stock > 0
            ? "https://schema.org/InStock"
            : "https://schema.org/OutOfStock",
    ],
];

$breadcrumbItems = [
    [
        "@type" => "ListItem",
        "position" => 1,
        "name" => "Home",
        "item" => route('home'),
    ],
];

if ($product->category) {
    $breadcrumbItems[] = [
        "@type" => "ListItem",
        "position" => 2,
        "name" => $product->category->name,
        "item" => route('product.category', $product->category),
    ];
}

$breadcrumbItems[] = [
    "@type" => "ListItem",
    "position" => $product->category ? 3 : 2,
    "name" => $product->name,
];

$breadcrumbSchema = [
    "@context" => "https://schema.org",
    "@type" => "BreadcrumbList",
    "itemListElement" => $breadcrumbItems,
];
@endphp

<script type="application/ld+json">
{!! json_encode($productSchema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}
</script>

<script type="application/ld+json">
{!! json_encode($breadcrumbSchema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}
</script>
@endsection
@section('content')
<div class="mx-auto py-4 px-4">
@php
    $breadcrumbs = [
        ['title' => 'Home', 'url' => route('home')],
    ];

    if ($product->category) {
        $breadcrumbs[] = [
            'title' => $product->category->name,
'url' => route('product.category', $product->category),
        ];
    }

    $breadcrumbs[] = [
        'title' => $product->name,
        'url'   => null, // halaman aktif
    ];
@endphp

<x-breadcrumb :links="$breadcrumbs" />

</div>
<section class="border-t-4 border-bluefilterpedia bg-white dark:bg-gray-800 shadow-xl rounded-xl p-6 md:p-8">
    <div class="mx-auto max-w-7xl">
        {{-- GRID LAYOUT DUA KOLOM --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
            
            {{-- KOLOM KIRI: GAMBAR --}}
            {{-- Mobile: normal, Desktop: sticky --}}
            <div class="lg:sticky lg:top-24 lg:h-fit">
                {{-- Gambar Utama --}}
                <div class="mb-6">
                    <div class="aspect-square w-full overflow-hidden rounded-xl bg-gray-100 dark:bg-gray-700 border border-gray-200 dark:border-gray-600">
                        @if ($product->primaryImage)
                            <img
                                id="mainImage"
                                src="{{ asset('storage/' . $product->primaryImage->path) }}"
                                alt="{{ $product->name }} - {{ $product->category->name ?? 'Filter Industri' }}"
                                class="w-full h-full object-cover"
                            >
                        @else
                            <div class="flex h-full items-center justify-center">
                                <svg class="h-32 w-32 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Gallery dengan Horizontal Scroll + Panah (Hidden di Mobile) --}}
                @if ($product->images->count() > 1)
                    <div class="relative">
                        {{-- Panah Kiri - Hidden di Mobile --}}
                        <button 
                            id="galleryPrev"
                            class="hidden lg:flex absolute left-0 top-1/2 -translate-y-1/2 -translate-x-1/2 z-10
                                   w-8 h-8 rounded-full bg-white 
                                   border border-gray-300
                                   shadow-lg items-center justify-center
                                   hover:bg-gray-50 transition
                                   disabled:opacity-50 disabled:cursor-not-allowed"
                            aria-label="Previous image">
                            <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                        </button>

                        {{-- Container Gallery --}}
                        <div 
                            id="galleryContainer"
                            class="flex space-x-3 overflow-x-auto scrollbar-hide lg:px-8 py-2"
                            style="scroll-behavior: smooth;">
                            
                            @foreach ($product->images as $image)
                                <button 
                                    onclick="changeImage('{{ asset('storage/' . $image->path) }}')"
                                    class="flex-shrink-0 w-20 h-20 md:w-24 md:h-24 rounded-lg overflow-hidden
                                           border-2 {{ optional($product->primaryImage)->id === $image->id ? 'border-bluefilterpedia' : 'border-gray-300' }}
                                           hover:border-bluefilterpedia transition">
                                    <img
                                        src="{{ asset('storage/' . $image->path) }}"
                                        alt="Thumbnail {{ $loop->iteration }}"
                                        class="w-full h-full object-cover"
                                    >
                                </button>
                            @endforeach
                        </div>

                        {{-- Panah Kanan - Hidden di Mobile --}}
                        <button 
                            id="galleryNext"
                            class="hidden lg:flex absolute right-0 top-1/2 -translate-y-1/2 translate-x-1/2 z-10
                                   w-8 h-8 rounded-full bg-white 
                                   border border-gray-300
                                   shadow-lg items-center justify-center
                                   hover:bg-gray-50 transition
                                   disabled:opacity-50 disabled:cursor-not-allowed"
                            aria-label="Next image">
                            <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                    </div>
                @endif
            </div>

            {{-- KOLOM KANAN: DESKRIPSI (Tanpa Scroll) --}}
            <div>
                {{-- Product Name --}}
                <h1 class="mb-3 text-xl lg:text-3xl font-semibold text-gray-900 dark:text-gray-100">
                    {{ $product->name }}
                </h1>

                {{-- Price --}}
                <div class="mb-6">
                    <span class="text-3xl lg:text-4xl font-bold text-bluefilterpedia">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </span>
                </div>

                {{-- Stock Info --}}
                <div class="mb-6">
                    @if ($product->stock > 0)
                        <span class="inline-flex items-center gap-2 rounded-lg bg-green-100 px-4 py-2 text-sm font-semibold text-green-700">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            Stok Tersedia ({{ $product->stock }} unit)
                        </span>
                    @else
                        <span class="inline-flex items-center gap-2 rounded-lg bg-red-100 px-4 py-2 text-sm font-semibold text-red-700">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                            Stok Habis
                        </span>
                    @endif
                </div>

                {{-- Meta Info --}}
                <div class="grid grid-cols-2 gap-4 mb-8">
                    <div class="space-y-2">
                        <p class="text-sm text-gray-600 dark:text-gray-400">SKU</p>
                        <p class="font-medium text-gray-900 dark:text-gray-100">{{ $product->sku }}</p>
                    </div>
                    <div class="space-y-2">
                        <p class="text-sm text-gray-600 dark:text-gray-400">Kategori</p>
                        <p class="font-medium text-gray-900 dark:text-gray-100"><a href="{{ route('product.category', $product->category) }}" class="hover:text-bluefilterpedia">{{ $product->category->name ?? '-' }}</a></p>
                    </div>
                </div>

                {{-- Divider --}}
                <hr class="my-8 border-gray-200">

                {{-- Description dengan Show More --}}
                <div class="mb-8">
                    <h3 class="mb-4 text-xl font-semibold text-gray-900 dark:text-gray-100">
                        Deskripsi Produk
                    </h3>
                    <div class="prose max-w-none text-gray-700 dark:text-gray-300">
                        <div id="descriptionContent" class="line-clamp-6">
                            {!! nl2br(e($product->description ?? 'Tidak ada deskripsi untuk produk ini.')) !!}
                        </div>
                        <button 
                            id="showMoreBtn"
                            onclick="toggleDescription()"
                            class="mt-3 text-bluefilterpedia hover:text-blue-700 font-semibold transition hidden">
                            Lihat Selengkapnya
                        </button>
                    </div>
                </div>

                {{-- Divider --}}
                <hr class="my-8 border-gray-200">

                {{-- Action Buttons --}}
                <div class="space-y-6 border-2 border-gray-200 p-6 rounded-xl bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                    {{-- Beli Sekarang (WhatsApp) --}}
                    @if ($product->stock > 0)
                        <a
                            href="https://wa.me/6281110058788?text={{ urlencode('Halo, saya tertarik dengan produk: ' . $product->name) }}"
                            target="_blank"
                            class="flex w-full items-center justify-center gap-3
                                   rounded-lg px-2 lg:px-6 py-2 lg:py-4
                                   text-lg lg:text-xl font-bold text-gray-900 dark:text-gray-100 border-2 border-bluefilterpedia shadow-lg
                                   transition-all duration-300
                                   hover:bg-bluefilterpedia hover:text-white  hover:shadow-xl">
                            <img
                                src="{{ asset('storage/img/logo/waicon1.png') }}"
                                alt="WhatsApp"
                                class="h-10 w-10 object-contain">
                            Beli Sekarang
                        </a>
                    @else
                        <button
                            disabled
                            class="w-full rounded-lg bg-gray-400 px-6 py-4
                                   text-center text-lg font-bold text-white cursor-not-allowed">
                            Stok Habis
                        </button>
                    @endif

                    {{-- Tokopedia --}}
                    @if($product->tokopedia_link)
                        <a
                            href="{{ $product->tokopedia_link }}"
                            target="_blank"
                            rel="nofollow noopener"
                            class="flex items-center justify-center gap-3
                                   rounded-lg border border-gray-300 dark:border-gray-600 px-6 py-3
                                   hover:bg-gray-100 dark:hover:bg-gray-600 transition"
                            title="Beli {{ $product->name }} di Tokopedia">
                            <img
                                src="{{ asset('storage/img/logo/Tokopedia_Mascot.png') }}"
                                alt="Tokopedia"
                                class="h-8 object-contain">
                            <span class="text-gray-700 dark:text-gray-300 font-medium">
                                Beli di Tokopedia
                            </span>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Related Products --}}
@if ($relatedProducts->count())
<section class="mt-12 pb-16">
    <h2 class="mb-6 text-2xl font-bold text-gray-900">
        Produk Terkait
    </h2>

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 lg:gap-6">
        @foreach ($relatedProducts as $item)
            <x-card :product="$item" />
        @endforeach
    </div>
</section>
@endif



<script>
   
     // Fungsi untuk mengubah gambar utama
    function changeImage(imagePath) {
        document.getElementById('mainImage').src = imagePath;
    }

    // Gallery Navigation (Desktop only)
    const galleryContainer = document.getElementById('galleryContainer');
    const prevBtn = document.getElementById('galleryPrev');
    const nextBtn = document.getElementById('galleryNext');

    if (galleryContainer && prevBtn && nextBtn) {
        prevBtn.addEventListener('click', () => {
            galleryContainer.scrollBy({ left: -200, behavior: 'smooth' });
        });

        nextBtn.addEventListener('click', () => {
            galleryContainer.scrollBy({ left: 200, behavior: 'smooth' });
        });

        // Update button states
        function updateButtonStates() {
            const isAtStart = galleryContainer.scrollLeft <= 0;
            const isAtEnd = galleryContainer.scrollLeft + galleryContainer.clientWidth >= galleryContainer.scrollWidth - 1;
            
            prevBtn.disabled = isAtStart;
            nextBtn.disabled = isAtEnd;
        }

        galleryContainer.addEventListener('scroll', updateButtonStates);
        window.addEventListener('load', updateButtonStates);
        window.addEventListener('resize', updateButtonStates);
    }

    // Show More / Show Less untuk Deskripsi
    let isExpanded = false;

    function toggleDescription() {
        const content = document.getElementById('descriptionContent');
        const btn = document.getElementById('showMoreBtn');
        
        if (isExpanded) {
            content.classList.add('line-clamp-6');
            btn.textContent = 'Lihat Selengkapnya';
        } else {
            content.classList.remove('line-clamp-6');
            btn.textContent = 'Lihat Lebih Sedikit';
        }
        
        isExpanded = !isExpanded;
    }

    // Cek apakah deskripsi lebih dari 6 baris
    window.addEventListener('load', function() {
        const content = document.getElementById('descriptionContent');
        const btn = document.getElementById('showMoreBtn');
        
        if (content && btn) {
            // Cek apakah konten ter-clamp
            if (content.scrollHeight > content.clientHeight) {
                btn.classList.remove('hidden');
            }
        }
    });
</script>
<style>
    .line-clamp-6 {
        display: -webkit-box;
        -webkit-line-clamp: 6;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
    
    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>

@endsection