@extends('layout.user')

@section('title', $post->title . ' - Blog')

@section('content')
<!-- Blog Detail Section -->
<section class="py-8">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('blog.index') }}" class="text-blue-600 hover:text-blue-800 inline-flex items-center group">
            <svg class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Blog
        </a>
    </div>

    <!-- Two Column Layout -->
    <div class="flex flex-col lg:flex-row gap-8">
        
        <!-- Main Content - Left Column -->
        <div class="lg:w-3/4">
            <article class="bg-white dark:bg-gray-800 rounded-xl overflow-hidden">

                <!-- Content -->
                <div class="p-6 md:p-8">
                    <!-- Meta -->
                    <div class="flex items-center text-sm text-gray-500 dark:text-gray-400 mb-4">
                        <span>{{ $post->formatted_date }}</span>
                        <span class="mx-2">•</span>
                        <span>{{ $post->published_at->diffForHumans() }}</span>
                    </div>

                    <!-- Title -->
                    <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                        {{ $post->title }}
                    </h1>
                    
                    <!-- Tags -->
                    @if($post->tags && count($post->tags) > 0)
                    <div class="flex flex-wrap gap-2 mb-6">
                        @foreach($post->tags as $tag)
                        <span class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 px-3 py-1 rounded-full text-sm hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                            #{{ $tag }}
                        </span>
                        @endforeach
                    </div>
                    @endif
                    
                    <!-- Excerpt (if exists) -->
                    @if($post->excerpt)
                    <div class="text-lg text-gray-600 dark:text-gray-400 italic border-l-4 border-blue-500 pl-4 mb-6 bg-blue-50 dark:bg-blue-900/20 p-4 rounded-r">
                        {{ $post->excerpt }}
                    </div>
                    @endif
                    
                    <!-- Main Content -->
                    <div class="prose prose-lg dark:prose-invert max-w-none">
                        {!! $post->content !!}
                    </div>

                    <!-- Share Buttons -->
                    <div class="mt-8 pt-8 border-t dark:border-gray-700">
                        <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Share this article:</h3>
                        <div class="flex space-x-4">
                            <!-- Facebook Share -->
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" 
                               target="_blank"
                               class="text-gray-400 hover:text-blue-600 transition">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M18.77 7.46H14.5v-1.9c0-.9.6-1.1 1-1.1h3V.5h-4.33C10.24.5 9.5 3.44 9.5 5.32v2.15h-3v4h3v12h5v-12h3.85l.42-4z"/>
                                </svg>
                            </a>
                            <!-- Twitter Share -->
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($post->title) }}"
                               target="_blank"
                               class="text-gray-400 hover:text-blue-400 transition">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.44 4.83c-.8.37-1.5.38-2.22.02.93-.56.98-.96 1.32-2.02-.88.52-1.86.9-2.9 1.1-.82-.88-2-1.43-3.3-1.43-2.5 0-4.55 2.05-4.55 4.55 0 .36.03.7.1 1.04-3.8-.2-7.17-2-9.42-4.75-.4.7-.6 1.5-.6 2.36 0 1.6.8 3 2.03 3.8-.74-.02-1.44-.23-2.05-.57v.06c0 2.2 1.56 4.03 3.64 4.45-.38.1-.78.16-1.2.16-.3 0-.58-.03-.86-.08.58 1.82 2.27 3.15 4.28 3.2-1.57 1.23-3.55 1.96-5.7 1.96-.37 0-.74-.02-1.1-.06 2.03 1.3 4.45 2.06 7.05 2.06 8.46 0 13.1-7 13.1-13.1v-.6c.9-.67 1.68-1.5 2.3-2.44z"/>
                                </svg>
                            </a>
                            <!-- WhatsApp Share -->
                            <a href="https://wa.me/?text={{ urlencode($post->title . ' ' . request()->url()) }}"
                               target="_blank"
                               class="text-gray-400 hover:text-green-600 transition">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20.45 5.37c-.78.35-1.62.6-2.5.74.9-.54 1.6-1.4 1.92-2.42-.84.5-1.77.86-2.76 1.06-.8-.85-1.93-1.38-3.2-1.38-2.42 0-4.38 1.96-4.38 4.38 0 .34.04.68.1 1-3.64-.2-6.87-1.93-9.03-4.58-.38.66-.6 1.42-.6 2.24 0 1.52.77 2.86 1.95 3.64-.72-.02-1.4-.22-2-.55v.05c0 2.12 1.5 3.9 3.5 4.3-.37.1-.76.15-1.16.15-.28 0-.56-.03-.83-.08.56 1.75 2.2 3.02 4.13 3.05-1.52 1.2-3.43 1.9-5.5 1.9-.36 0-.7-.02-1.05-.07 1.93 1.24 4.23 1.96 6.7 1.96 8.04 0 12.44-6.66 12.44-12.44v-.56c.86-.6 1.6-1.36 2.2-2.22z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </article>

            <!-- Related Posts -->
            @if($relatedPosts && $relatedPosts->count() > 0)
                <div class="mt-12">
                    <h2 class="text-2xl font-bold mb-6 dark:text-white">Related Posts</h2>
<div class="columns-1 md:columns-2 space-y-6">
    @foreach($relatedPosts as $related)
        <div class="break-inside-avoid">
            <x-blog-card :post="$related" />
        </div>
    @endforeach
</div>
                </div>
            @endif
        </div>

        <!-- Sidebar - Right Column -->
        <div class="lg:w-1/4">
            <div class="sticky top-4">
                <!-- Featured Products Section -->
                <div class="bg-white dark:bg-gray-800 rounded-xl p-6">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4 pb-2 border-b dark:border-gray-700">
                        Produk Rekomendasi
                    </h3>
                    
                    <div class="space-y-4">
                        @forelse($featuredProducts ?? [] as $product)
                            <x-product-card-sidebar :product="$product" />
                        @empty
                            <!-- Sample products - replace with actual data -->
                            @php
                                $sampleProducts = [
                                    (object)[
                                        'id' => 1,
                                        'name' => 'Filter Air RO 5 Stage',
                                        'price' => 1250000,
                                        'primaryImage' => null
                                    ],
                                    (object)[
                                        'id' => 2,
                                        'name' => 'Cartridge Filter Sedimen 10"',
                                        'price' => 85000,
                                        'primaryImage' => null
                                    ],
                                    (object)[
                                        'id' => 3,
                                        'name' => 'Membran RO 100 GPD',
                                        'price' => 350000,
                                        'primaryImage' => null
                                    ],
                                ];
                            @endphp
                            
                            @foreach($sampleProducts as $product)
                                <x-product-card-sidebar :product="$product" />
                            @endforeach
                        @endforelse
                    </div>

                    <!-- CTA Button -->
                    <div class="mt-6 pt-4 border-t dark:border-gray-700">
                        <a href="{{ route('home') }}" 
                           class="block w-full text-center bg-bluefilterpedia hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                            Lihat Semua Produk
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection