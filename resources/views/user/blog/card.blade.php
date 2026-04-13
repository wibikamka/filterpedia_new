<!-- <a href="{{ route('blog.show', $post->slug) }}" 
   class="block bg-white dark:bg-gray-900 rounded-lg shadow hover:shadow-lg transition overflow-hidden">

    @if($post->thumbnail)
        <img src="{{ asset('storage/'.$post->thumbnail) }}"
             alt="{{ $post->title }}"
             class="w-full aspect-[16/9] object-cover">
    @endif

    <div class="p-4">

        <h3 class="font-semibold text-lg mb-2 line-clamp-2">
            {{ $post->title }}
        </h3>

        <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-3">
            {{ $post->excerpt }}
        </p>

        <div class="mt-3 text-xs text-gray-500">
            {{ $post->published_at?->format('d M Y') }}
        </div>

    </div>
</a> -->