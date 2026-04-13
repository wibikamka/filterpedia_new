@props(['post', 'simple' => false])

<div class="bg-white overflow-hidden h-full flex flex-col">
    
    {{-- Thumbnail - Hanya tampil jika ada --}}
    @if($post->thumbnail_url)
    <a href="{{ route('blog.show', $post->slug) }}" class="block overflow-hidden flex-shrink-0">
        <img src="{{ $post->thumbnail_url }}" 
             alt="{{ $post->title }}"
             class="w-full h-48 object-cover hover:scale-105 transition-transform duration-300">
    </a>
    @endif
    
    {{-- Content --}}
    <div class="p-5 flex-1 flex flex-col">
        
        {{-- Meta Info - Hanya tampil jika BUKAN simple mode --}}
        @unless($simple)
        <div class="flex items-center text-sm text-gray-500 mb-2">
            <span class="bg-blue-100 text-blue-600 px-2 py-1 rounded-full text-xs">
                {{ ucfirst(str_replace('-', ' ', $post->category)) }}
            </span>
            <span class="mx-2">•</span>
            <span>{{ $post->formatted_date }}</span>
        </div>
        @endunless
        
        {{-- Title --}}
        <h3 class="text-xl font-bold mb-2 line-clamp-2">
            <a href="{{ route('blog.show', $post->slug) }}" 
               class="text-gray-900 hover:text-bluefilterpedia hover:underline transition-colors">
                {{ $post->title }}
            </a>
        </h3>
        
        {{-- Excerpt --}}
        <p class="text-gray-600 {{ $simple ? 'line-clamp-4' : 'mb-4 line-clamp-3' }} text-sm {{ $simple ? '' : 'flex-1' }}">
            {{ $post->excerpt ?? Str::limit(strip_tags($post->content), 120) }}
        </p>
        
        {{-- Read More Button - Hanya tampil jika BUKAN simple mode --}}
        @unless($simple)
        <div class="flex items-center justify-between mt-auto">
            <a href="{{ route('blog.show', $post->slug) }}" 
               class="inline-flex items-center text-sm font-medium px-4 py-2 rounded-md
                      bg-bluefilterpedia text-white
                      border border-transparent
                      hover:bg-white hover:text-bluefilterpedia hover:border-bluefilterpedia
                      transition-all duration-300">
                Read More
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
            
            @if($post->tags && count($post->tags) > 0)
                <span class="text-xs text-gray-500">
                    {{ count($post->tags) }} tags
                </span>
            @endif
        </div>
        @endunless
        
    </div>
</div>