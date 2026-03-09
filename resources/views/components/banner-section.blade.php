@props([
    'autoplaySpeed' => 4500,
    'showControls' => true,
    'showDots' => true,
    'images' => [], // Array gambar spesifik
    'bannerCount' => null, // Akan dihitung otomatis dari images
    'bannerPrefix' => 'banner_caa',
    'minHeight' => 'min-h-50 sm:min-h-75 md:min-h-80 lg:min-h-87.5 2xl:min-h-125'
])

@php
    // Jika images tidak kosong, gunakan images
    if(!empty($images)) {
        $bannerCount = count($images);
        $imageSource = 'custom';
    } else {
        // Jika images kosong, generate dari prefix
        $bannerCount = $bannerCount ?? 4;
        $imageSource = 'prefix';
    }
@endphp

<section {{ $attributes->merge(['class' => 'mb-6 -mx-4 sm:-mx-6 lg:-mx-16 2xl:-mx-64']) }}>
    <div class="flex flex-col gap-3 sm:gap-4 lg:gap-6">
        <h1 class="sr-only">
            {{ $slot->isEmpty() ? 'Supplier Cartridge Filter dan Water Treatment Industri di Indonesia' : $slot }}
        </h1>
        
        {{-- ROW 1: BIG BANNER FULL SCREEN --}}
        <div class="w-full">
            <div x-data="slider({{ $bannerCount }}, {{ $autoplaySpeed }})"
                 x-init="start()"
                 class="relative w-screen left-1/2 right-1/2 -ml-[50vw] -mr-[50vw] overflow-hidden"
                 style="width: 100vw; margin-left: -50vw; margin-right: -50vw;">
                
                {{-- Container untuk gambar --}}
                <div class="relative w-full {{ $minHeight }}">
                    @if($imageSource === 'custom')
                        {{-- Loop dari array images --}}
                        @foreach($images as $index => $image)
                            <img src="{{ asset($image) }}"
                                 class="absolute inset-0 w-full h-full object-cover transition-opacity duration-700"
                                 :class="active === {{ $index }} ? 'opacity-100' : 'opacity-0'"
                                 alt="Banner Image {{ $index + 1 }}"
                                 loading="eager">
                        @endforeach
                    @else
                        {{-- Loop dari prefix --}}
                        @for ($i = 1; $i <= $bannerCount; $i++)
                            <img src="{{ asset("storage/img/banner/{$bannerPrefix}-{$i}.webp") }}"
                                 class="absolute inset-0 w-full h-full object-cover transition-opacity duration-700"
                                 :class="active === {{ $i - 1 }} ? 'opacity-100' : 'opacity-0'"
                                 alt="Supplier Cartridge Filter Industri - Filterpedia {{ $i }}"
                                 loading="eager">
                        @endfor
                    @endif
                    
                    @if($showControls)
                        {{-- Navigation Buttons --}}
                        <button @click="prev()"
                                class="absolute left-4 sm:left-8 top-1/2 -translate-y-1/2 z-10
                                       bg-black/40 hover:bg-black/60 text-white
                                       w-10 h-10 sm:w-12 sm:h-12 rounded-full flex items-center justify-center
                                       transition-all duration-200 hover:scale-110"
                                aria-label="Previous slide">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                        </button>
                        
                        <button @click="next()"
                                class="absolute right-4 sm:right-8 top-1/2 -translate-y-1/2 z-10
                                       bg-black/40 hover:bg-black/60 text-white
                                       w-10 h-10 sm:w-12 sm:h-12 rounded-full flex items-center justify-center
                                       transition-all duration-200 hover:scale-110"
                                aria-label="Next slide">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                    @endif

                    @if($showDots)
                        {{-- Dots Indicator --}}
                        <div class="absolute bottom-4 sm:bottom-6 left-1/2 -translate-x-1/2 flex gap-2 sm:gap-3 z-10">
                            @for ($i = 0; $i < $bannerCount; $i++)
                                <button @click="active = {{ $i }}"
                                        class="w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full transition-all duration-300"
                                        :class="active === {{ $i }} ? 'bg-white w-8 sm:w-10' : 'bg-white/50'"
                                        aria-label="Go to slide {{ $i + 1 }}">
                                </button>
                            @endfor
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>