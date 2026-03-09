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
        'url'   => null,
    ];
@endphp

<x-breadcrumb :links="$breadcrumbs" />

</div>
<section class="border-t-4 border-bluefilterpedia bg-white dark:bg-gray-800  p-6 md:p-8">
    <div class="mx-auto max-w-7xl">
        {{-- GRID LAYOUT DUA KOLOM --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
            
            {{-- KOLOM KIRI: GAMBAR --}}
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

                {{-- Gallery --}}
                @if ($product->images->count() > 1)
                    <div class="relative">
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

            {{-- KOLOM KANAN --}}
            <div>
                {{-- Product Name --}}
                <h1 class="mb-5 text-xl lg:text-3xl font-semibold text-gray-900 dark:text-gray-100 leading-snug">
                    {{ $product->name }}
                </h1>

                {{-- ===== INFO TABLE ===== --}}
                <div class="w-full border border-gray-200 dark:border-gray-600 rounded-xl overflow-hidden mb-8">
                    <table class="w-full text-sm">
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">

                            {{-- Harga --}}
                            <tr class="bg-white dark:bg-gray-800">
                                <td class="px-4 py-3 w-28 text-gray-500 dark:text-gray-400 font-medium align-middle whitespace-nowrap">
                                    Harga
                                </td>
                                <td class="px-4 py-3 align-middle">
                                    <span class="text-2xl lg:text-3xl font-bold text-bluefilterpedia">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </span>
                                </td>
                            </tr>

                            {{-- Stok --}}
                            <tr class="bg-gray-50 dark:bg-gray-700">
                                <td class="px-4 py-3 text-gray-500 dark:text-gray-400 font-medium align-middle whitespace-nowrap">
                                    Stok
                                </td>
                                <td class="px-4 py-3 align-middle">
                                    @if ($product->stock > 0)
                                        <span class="inline-flex items-center gap-1.5 rounded-md bg-green-100 dark:bg-green-900/30 px-2.5 py-1 text-xs font-semibold text-green-700 dark:text-green-400">
                                            <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                            </svg>
                                            Tersedia &mdash; {{ $product->stock }} unit
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 rounded-md bg-red-100 dark:bg-red-900/30 px-2.5 py-1 text-xs font-semibold text-red-700 dark:text-red-400">
                                            <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                            </svg>
                                            Stok Habis
                                        </span>
                                    @endif
                                </td>
                            </tr>

                            {{-- SKU --}}
                            <tr class="bg-white dark:bg-gray-800">
                                <td class="px-4 py-3 text-gray-500 dark:text-gray-400 font-medium align-middle whitespace-nowrap">
                                    SKU
                                </td>
                                <td class="px-4 py-3 align-middle">
                                    <span class="font-mono text-xs bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 px-2 py-1 rounded">
                                        {{ $product->sku }}
                                    </span>
                                </td>
                            </tr>

                            {{-- Kategori --}}
                            <tr class="bg-gray-50 dark:bg-gray-700">
                                <td class="px-4 py-3 text-gray-500 dark:text-gray-400 font-medium align-middle whitespace-nowrap">
                                    Kategori
                                </td>
                                <td class="px-4 py-3 align-middle">
                                    @if ($product->category)
                                        <a href="{{ route('product.category', $product->category) }}"
                                           class="inline-flex items-center gap-1 text-bluefilterpedia hover:underline font-medium text-sm">
                                            <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                            </svg>
                                            {{ $product->category->name }}
                                        </a>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>

                {{-- Divider --}}
                <hr class="my-6 border-gray-200 dark:border-gray-700">

                {{-- ===== ADD TO CART SECTION ===== --}}
                <form id="addToCartForm"
                      action="{{ route('cart.add', $product) }}"
                      method="POST">
                    @csrf

                    {{-- Quantity Selector --}}
                    <div class="mb-5">
                        <label class="block text-sm font-medium text-gray-600 dark:text-gray-400 mb-2">Jumlah</label>
                        <div class="inline-flex items-center border border-gray-300 dark:border-gray-600 rounded-lg overflow-hidden">
                            <button type="button"
                                id="minusBtn"
                                onclick="decreaseQty()"
                                class="w-10 h-10 flex items-center justify-center text-gray-600 dark:text-gray-300
                                       transition disabled:opacity-40 disabled:cursor-not-allowed text-lg font-bold select-none"
                                disabled>
                                &minus;
                            </button>
                            <input type="number"
                                id="quantity"
                                name="quantity"
                                value="1"
                                min="1"
                                max="{{ $product->stock }}"
                                oninput="onQtyInput()"
                                class="w-14 h-10 text-center border-0 border-x border-gray-300 dark:border-gray-600
                                       bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100
                                       focus:outline-none focus:ring-0 text-sm font-semibold">
                            <button type="button"
                                id="plusBtn"
                                onclick="increaseQty()"
                                class="w-10 h-10 flex items-center justify-center text-bluefilterpedia
                                       transition disabled:opacity-40 disabled:cursor-not-allowed text-lg font-bold select-none">
                                +
                            </button>
                        </div>

                        {{-- Stock Warning --}}
                        <p id="stockWarning"
                           class="hidden mt-2 text-xs font-medium text-amber-600 dark:text-amber-400 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            Jumlah melebihi stok tersedia ({{ $product->stock }} unit)
                        </p>
                    </div>

                    {{-- Primary Buttons: Add to Cart + Pesan via Chat --}}
                    @if ($product->stock > 0)
                        <div class="grid grid-cols-2 gap-3 mb-3">
                            {{-- Add to Cart --}}
                            <button type="submit"
                                id="addToCartBtn"
                                class="flex items-center justify-center gap-2
                                       bg-bluefilterpedia hover:bg-bluefilterpedia-sec active:bg-bluefilterpedia-sec 
                                       text-white font-semibold text-sm
                                       px-4 py-3 rounded-xl
                                       shadow-md hover:shadow-lg
                                       transition-all duration-200">
                                <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                Tambah ke Keranjang
                            </button>

                            {{-- Pesan via WhatsApp --}}
                            <a href="https://wa.me/6281110058788?text={{ urlencode('Halo, saya ingin memesan: ' . $product->name) }}"
                               target="_blank"
                               class="flex items-center justify-center gap-2
                                      border-2 border-bluefilterpedia text-bluefilterpedia
                                      hover:bg-bluefilterpedia hover:text-white
                                      font-semibold text-sm
                                      px-4 py-3 rounded-xl
                                      transition-all duration-200">
                                <img src="{{ asset('storage/img/logo/waicon1.png') }}"
                                     alt="WhatsApp"
                                     class="h-8 w-8 object-contain flex-shrink-0">
                                Pesan via WhatsApp
                            </a>
                        </div>
                    @else
                        <div class="grid grid-cols-2 gap-3 mb-3">
                            <button disabled
                                class="flex items-center justify-center gap-2
                                       bg-gray-300 dark:bg-gray-600 text-gray-500 dark:text-gray-400
                                       font-semibold text-sm px-4 py-3 rounded-xl cursor-not-allowed">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                Stok Habis
                            </button>
                            <button disabled
                                class="flex items-center justify-center gap-2
                                       border-2 border-gray-300 dark:border-gray-600 text-gray-400
                                       font-semibold text-sm px-4 py-3 rounded-xl cursor-not-allowed">
                                Pesan via Chat
                            </button>
                        </div>
                    @endif

                    {{-- Secondary: Tokopedia --}}
                    @if($product->tokopedia_link)
                        <div class="mt-1">
                            <a href="{{ $product->tokopedia_link }}"
                               target="_blank"
                               rel="nofollow noopener"
                               title="Beli {{ $product->name }} di Tokopedia"
                               class="flex items-center justify-center gap-2
                                      w-full border border-gray-300 dark:border-gray-600
                                      bg-white dark:bg-gray-800
                                      hover:bg-gray-50 dark:hover:bg-gray-700 hover:border-bluefilterpedia
                                      text-gray-600 dark:text-gray-300 font-medium text-sm
                                      px-4 py-2.5 rounded-xl
                                      transition-all duration-200">
                                <img src="{{ asset('storage/img/logo/Tokopedia_Mascot.png') }}"
                                     alt="Tokopedia"
                                     class="h-8 w-8 object-contain">
                                Beli di Tokopedia
                            </a>
                        </div>
                    @endif

                </form>

                {{-- Divider --}}
                <hr class="my-8 border-gray-200 dark:border-gray-700">

                {{-- Description dengan Show More --}}
                <div class="mb-8">
                    <h3 class="mb-4 text-xl font-semibold text-gray-900 dark:text-gray-100">
                        Deskripsi Produk
                    </h3>
                    <div class="prose max-w-none text-gray-700 dark:text-gray-300">
                        <div id="descriptionContent" class="line-clamp-6 text-base">
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
{{-- ===== SPESIFIKASI PRODUK (ACCORDION SEDERHANA) ===== --}}
<div class="mb-8 border-b border-gray-200 dark:border-gray-700 overflow-hidden">
    {{-- Header / Trigger --}}
    <button 
        id="specificationToggle"
        onclick="toggleSpecification()"
        class="w-full flex items-center justify-between py-4 text-left"
    >
        <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100">
            Spesifikasi Produk
        </h3>
        
        {{-- Icon panah --}}
        <svg id="specificationChevron" 
             class="w-5 h-5 text-gray-500 dark:text-gray-400 transition-transform duration-200" 
             fill="none" 
             stroke="currentColor" 
             viewBox="0 0 24 24"
        >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </button>
    
    {{-- Content (Hidden by default) --}}
    <div id="specificationContent" class="border-t border-gray-200 dark:border-gray-700">
        <div class="p-4 bg-white dark:bg-gray-800">
            @if($product->specifications && $product->specifications->count() > 0)
                <table class="w-full text-base">
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                        @foreach($product->specifications as $spec)
                            <tr>
                                <td class="py-2 pr-4 w-1/3 text-gray-600 dark:text-gray-400 font-medium">
                                    {{ $spec->spec_key }}
                                </td>
                                <td class="py-2 text-gray-900 dark:text-gray-100">
                                    {{ $spec->spec_value }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="text-center py-8">
                    <svg class="w-16 h-16 mx-auto text-gray-300 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <p class="text-gray-500 dark:text-gray-400 text-sm">
                        Belum ada spesifikasi untuk produk ini
                    </p>
                </div>
            @endif
        </div>
    </div>
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
// ===== QUANTITY CONTROLS =====
const stockMax = {{ $product->stock }};

function updateWarning() {
    const qty = parseInt(document.getElementById('quantity').value) || 1;
    const warning = document.getElementById('stockWarning');
    const addBtn = document.getElementById('addToCartBtn');

    if (qty > stockMax) {
        warning.classList.remove('hidden');
        if (addBtn) addBtn.disabled = true;
    } else {
        warning.classList.add('hidden');
        if (addBtn) addBtn.disabled = false;
    }
}

function updateButtons() {
    const input = document.getElementById('quantity');
    const minusBtn = document.getElementById('minusBtn');
    const plusBtn = document.getElementById('plusBtn');
    const qty = parseInt(input.value) || 1;

    minusBtn.disabled = qty <= 1;
    plusBtn.disabled = qty >= stockMax;
    updateWarning();
}

function increaseQty() {
    const input = document.getElementById('quantity');
    const current = parseInt(input.value) || 1;
    // Allow going above stock to show warning (don't cap here)
    input.value = current + 1;
    updateButtons();
}

function decreaseQty() {
    const input = document.getElementById('quantity');
    const current = parseInt(input.value) || 1;
    if (current > 1) input.value = current - 1;
    updateButtons();
}

function onQtyInput() {
    updateButtons();
}

// Init button states
updateButtons();

// ===== ADD TO CART FORM =====
document.getElementById('addToCartForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const qty = parseInt(document.getElementById('quantity').value);
    if (qty > stockMax) return; // Block if over stock

    fetch("{{ route('cart.add', $product->slug) }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Content-Type": "application/json",
            "Accept": "application/json"
        },
        body: JSON.stringify({ quantity: qty })
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
    })
    .catch(() => {
        alert("Terjadi kesalahan.");
    });
});

// ===== GALLERY =====
function changeImage(imagePath) {
    document.getElementById('mainImage').src = imagePath;
}

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

    function updateGalleryBtns() {
        const isAtStart = galleryContainer.scrollLeft <= 0;
        const isAtEnd = galleryContainer.scrollLeft + galleryContainer.clientWidth >= galleryContainer.scrollWidth - 1;
        prevBtn.disabled = isAtStart;
        nextBtn.disabled = isAtEnd;
    }

    galleryContainer.addEventListener('scroll', updateGalleryBtns);
    window.addEventListener('load', updateGalleryBtns);
    window.addEventListener('resize', updateGalleryBtns);
}

// ===== SHOW MORE / LESS DESCRIPTION =====
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

window.addEventListener('load', function() {
    const content = document.getElementById('descriptionContent');
    const btn = document.getElementById('showMoreBtn');
    
    if (content && btn) {
        if (content.scrollHeight > content.clientHeight) {
            btn.classList.remove('hidden');
        }
    }
});

// ===== TAMBAHKAN: SPESIFIKASI ACCORDION =====
let isSpecificationOpen = false;

// ===== SPESIFIKASI ACCORDION SMOOTH =====
function toggleSpecification() {
    const content = document.getElementById('specificationContent');
    const chevron = document.getElementById('specificationChevron');
    
    if (!content || !chevron) return;
    
    if (content.style.maxHeight === '0px' || !content.style.maxHeight) {
        // Buka dropdown
        content.style.maxHeight = content.scrollHeight + 'px';
        content.style.opacity = '1';
        chevron.classList.add('rotate-180');
    } else {
        // Tutup dropdown
        content.style.maxHeight = '0px';
        content.style.opacity = '0';
        chevron.classList.remove('rotate-180');
    }
}

// Inisialisasi awal
document.addEventListener('DOMContentLoaded', function() {
    const content = document.getElementById('specificationContent');
    if (content) {
        content.style.maxHeight = '0px';
        content.style.opacity = '0';
    }
    
    // Cek hash URL
    if (window.location.hash === '#spesifikasi') {
        setTimeout(() => {
            toggleSpecification();
        }, 300);
    }
});

// Update max-height jika window diresize (misal konten berubah)
window.addEventListener('resize', function() {
    const content = document.getElementById('specificationContent');
    if (content && content.style.maxHeight !== '0px' && content.style.maxHeight !== '') {
        content.style.maxHeight = content.scrollHeight + 'px';
    }
});
// ===== TAMBAHKAN: KEYBOARD ACCESSIBILITY =====
document.addEventListener('keydown', function(e) {
    // Buka/tutup spesifikasi dengan tombol Enter atau Spasi saat focus di toggle
    if (e.key === 'Enter' || e.key === ' ') {
        const toggle = document.getElementById('specificationToggle');
        if (toggle && document.activeElement === toggle) {
            e.preventDefault();
            toggleSpecification();
        }
    }
});

// ===== TAMBAHKAN: CLOSE SPECIFICATION DENGAN ESC (opsional) =====
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && isSpecificationOpen) {
        toggleSpecification();
    }
});
</script>

<style>
    .rotate-180 {
    transform: rotate(180deg);
}
#specificationContent {
    transition: max-height 0.5s ease-in-out, opacity 0.3s ease-in-out;
}
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

    /* Striped table rows for dark mode */
    .dark .bg-gray-750 {
        background-color: rgb(38 50 56 / 0.5);
    }
</style>

@endsection