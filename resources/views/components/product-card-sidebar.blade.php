@props(['product'])

@php
    $image = $product->primaryImage
        ? asset('storage/' . $product->primaryImage->path)
        : asset('storage/img/logo/filterpedialastfilterpedia.png');
    
    // Contoh deskripsi - sesuaikan dengan field di database Anda
    $description = $product->short_description ?? $product->description ?? 'Produk filter air berkualitas tinggi untuk kebutuhan rumah tangga dan industri.';
    
    // Batasi deskripsi maksimal 60 karakter
    $description = Str::limit($description, 60);
@endphp

<div class="group flex flex-col py-4 ">
    
    {{-- Gambar Produk - Square --}}
    <a href="{{ route('product.show', $product) }}" class="block mb-3">
        <div class="aspect-square w-full overflow-hidden rounded-lg bg-gray-100 dark:bg-gray-700">
            <img src="{{ $image }}" 
            alt="{{ $product->name }}"
            loading="lazy"
            class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
        </div>
    </a>
    
    {{-- Nama Produk --}}
    <a href="{{ route('product.show', $product) }}" class="block ">
        <h4 class="text-sm font-semibold text-gray-600 dark:text-white 
                   group-hover:text-bluefilterpedia transition-colors line-clamp-2">
            {{ $product->name }}
        </h4>
    </a>
    
    {{-- Deskripsi Singkat --}}
    <p class="text-xs text-gray-500 dark:text-gray-400 mb-3 line-clamp-4 leading-relaxed">
        {{ $description }}
    </p>
    
</div>