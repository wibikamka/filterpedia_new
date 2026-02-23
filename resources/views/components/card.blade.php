@props(['product'])

@php
    $image = $product->primaryImage
        ? asset('storage/' . $product->primaryImage->path)
        : asset('storage/img/logo/filterpedialastfilterpedia.png');
@endphp

<div
    class="group flex flex-col w-full overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm
           transition-all duration-300 hover:border-bluefilterpedia hover:shadow-xl ">

    {{-- IMAGE (LINK KE DETAIL) --}}
    <a
        href="{{ route('product.show', $product) }}"
        class="relative aspect-square w-full overflow-hidden bg-gray-100
 block"
    >
        @if ($image)
            <img
                src="{{ $image }}"
                alt="{{ $product->name }}"
                loading="lazy"
                draggable="false"
                class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110"
            >
        @else
            <div class="flex h-full items-center justify-center text-gray-400 text-sm">
                No Image
            </div>
        @endif
    </a>

    {{-- CONTENT --}}
    <div class="flex flex-col flex-1 p-4">

        {{-- TITLE (LINK KE DETAIL) --}}
       <a href="{{ route('product.show', $product) }}">

            <h3
                class="mb-2 line-clamp-2 text-sm md:text-base  font-semibold
                       text-gray-900 hover:text-bluefilterpedia transition-colors"
            >
                {{ $product->name }}
            </h3>
        </a>

        <div class="flex-1"></div>

        {{-- BOTTOM --}}
        <div class="mt-auto space-y-2">

            {{-- PRICE --}}
            <div class="text-base lg:text-lg font-bold text-bluefilterpedia">
                {{ 'Rp ' . number_format($product->price, 0, ',', '.') }}
            </div>

            {{-- ACTION ICONS --}}
            <div class="flex items-center gap-2">

                {{-- Tokopedia --}}
                @if ($product->tokopedia_link)
                <a
                    href="{{ $product->tokopedia_link }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    title="Beli {{ $product->name }} di Tokopedia"
                    class="inline-flex opacity-90 hover:opacity-100 transition-opacity duration-200"
                >
                    <img
                        src="{{ asset('storage/img/logo/Tokopedia_Mascot.png') }}"
                        alt="Tokopedia"
                        draggable="false"
                        class="w-10 h-10 lg:w-12 lg:h-12
                               object-contain cursor-pointer
                               hover:scale-110 transition-transform duration-200"
                    >
                </a>
                @endif

                {{-- WhatsApp --}}
                <a
                    href="https://wa.me/6281282388324?text=Halo, saya tertarik dengan produk {{ urlencode($product->name) }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    title="Chat WhatsApp"
                    class="inline-flex"
                >
                    <img
                        src="{{ asset('storage/img/logo/waicon1.png') }}"
                        alt="WhatsApp"
                        draggable="false"
                        class="w-10 h-10 lg:w-12 lg:h-12
                               object-contain cursor-pointer
                               hover:scale-110 transition-transform duration-200"
                    >
                </a>

            </div>
        </div>
    </div>
</div>
