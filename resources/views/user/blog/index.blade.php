@extends('layout.user')

@section('title', 'Blog - Artikel dan Informasi')

@section('content')
<!-- Hero Section -->
<section class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
       <h1 class="text-4xl md:text-5xl font-bold mb-4">
    <span class="text-gray-900 dark:text-white">filterpedia</span>
    <span class="text-bluefilterpedia">Blog</span>
</h1>
        <p class="text-xl max-w-2xl mx-auto opacity-90">
            Temukan artikel, tips, dan informasi terbaru seputar produk dan industri kami
        </p>
    </div>
</section>

<!-- Blog Posts Section -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Search and Filter Bar -->
    <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
<div class="flex items-center space-x-3">
    <span class="text-gray-700 dark:text-gray-300 font-medium text-sm">Filter:</span>
    <div class="flex flex-wrap gap-2">
        <a href="{{ route('blog.index') }}" 
           class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200
                  {{ !request('category') 
                      ? 'bg-bluefilterpedia text-white' 
                      : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 hover:border-bluefilterpedia hover:text-bluefilterpedia' }}">
            All
        </a>
        @foreach($categories as $key => $label)
            <a href="{{ route('blog.index', ['category' => $key]) }}" 
               class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200
                      {{ request('category') == $key 
                          ? 'bg-bluefilterpedia text-white' 
                          : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 hover:border-bluefilterpedia hover:text-bluefilterpedia' }}">
                {{ $label }}
            </a>
        @endforeach
    </div>
</div>
        
        <form method="GET" action="{{ route('blog.index') }}" class="flex">
            @if(request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
            @endif
            <input type="text" 
                   name="search" 
                   value="{{ request('search') }}"
                   placeholder="Search articles..."
                   class="border border-gray-300 rounded-l-md px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-bluefilterpedia flex-1">
            <button type="submit" 
                    class="bg-bluefilterpedia text-white px-4 py-2 rounded-r-md hover:bg-bluefilterpedia transition text-sm">
                Search
            </button>
        </form>
    </div>

    <!-- Posts Grid -->
    @if($posts->count() > 0)
<div class="columns-1 md:columns-2 lg:columns-3 gap-6 space-y-6">
    @foreach($posts as $post)
        <div class="break-inside-avoid">
            <x-blog-card :post="$post" />
        </div>
    @endforeach
</div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $posts->links() }}
        </div>
    @else
        <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15"></path>
            </svg>
            <p class="mt-4 text-gray-500 text-lg">No blog posts found.</p>
            <a href="{{ route('blog.index') }}" class="mt-4 inline-block text-bluefilterpedia hover:text-bluefilterpedia-sec">
                Clear filters
            </a>
        </div>
    @endif
</section>

<!-- Newsletter Section -->
<section class="bg-gray-100 py-12 mt-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-md p-8 md:p-12">
            <div class="max-w-2xl mx-auto text-center">
                <h2 class="text-2xl md:text-3xl font-bold mb-4">Jangan lewatkan artikel terbaru!</h2>
                <p class="text-gray-600 mb-6">
                    Dapatkan update artikel terbaru langsung di email Anda.
                </p>
                <form class="flex flex-col sm:flex-row gap-3">
                    <input type="email" 
                           placeholder="Alamat email Anda"
                           class="flex-1 border border-gray-300 rounded-md px-4 py-3 focus:outline-none focus:ring-2 focus:ring-bluefilterpedia">
                    <button type="submit" 
                            class="bg-bluefilterpedia text-white px-6 py-3 rounded-md hover:bg-bluefilterpedia-sec transition font-medium">
                        Dapatkan Update
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
function filterByCategory(category) {
    const url = new URL(window.location.href);
    if (category) {
        url.searchParams.set('category', category);
    } else {
        url.searchParams.delete('category');
    }
    // Preserve search query if exists
    const search = url.searchParams.get('search');
    if (search) {
        url.searchParams.set('search', search);
    }
    window.location.href = url.toString();
}

// Mobile menu toggle (if exists in layout)
document.addEventListener('DOMContentLoaded', function() {
    const menuButton = document.getElementById('mobile-menu-button');
    if (menuButton) {
        menuButton.addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            if (menu) {
                menu.classList.toggle('hidden');
            }
        });
    }
});
</script>
@endpush