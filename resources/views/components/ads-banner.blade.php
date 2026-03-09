{{-- resources/views/components/ads-banner.blade.php --}}
@props([
    'columns' => 3, // Jumlah slider (bukan kolom grid)
    'images' => [], // Array gambar kustom (opsional)
    'interval' => 3000, // Interval default
    'folder' => 'bannersquare', // Folder gambar
])

@php
    $defaultImages = [
        'square-1.webp',
        'square-2.webp',
        'square-3.webp',
    ];
    
    $imageList = !empty($images) ? $images : $defaultImages;
    $imageCount = count($imageList);
@endphp

{{-- INI PENTING: col-span-full untuk mengambil seluruh lebar grid parent --}}
<div {{ $attributes->merge(['class' => 'col-span-full my-3']) }}>
    {{-- Grid internal untuk slider --}}
    <div class="grid grid-cols-3 gap-3 sm:gap-4 lg:gap-6">
        @for ($sliderIndex = 1; $sliderIndex <= $columns; $sliderIndex++)
            <div class="w-full aspect-square">
                <div
                    x-data="slider({{ $imageCount }}, {{ $interval + ($sliderIndex * 500) }})"
                    x-init="start()"
                    class="relative w-full h-full overflow-hidden rounded-lg shadow-md">

                    <div class="relative w-full h-full">
                        @foreach($imageList as $index => $image)
                            <img
                                src="{{ asset("storage/img/{$folder}/{$image}") }}"
                                class="absolute inset-0 w-full h-full object-cover transition-opacity duration-700"
                                :class="active === {{ $index }} ? 'opacity-100' : 'opacity-0'"
                                alt="Banner Promosi {{ $sliderIndex }}-{{ $index + 1 }}"
                                loading="lazy">
                        @endforeach
                    </div>

                </div>
            </div>
        @endfor
    </div>
</div>