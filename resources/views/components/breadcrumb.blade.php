<nav
    class="text-xs sm:text-sm md:text-base lg:text-lg mb-4"
    aria-label="Breadcrumb"
>
    <ol class="inline-flex items-center space-x-1 md:space-x-3">
        @foreach($links as $link)
            <li class="inline-flex items-center">
                @if(!empty($link['url']))
                    <a
                        href="{{ $link['url'] }}"
                        class="text-gray-500 hover:text-bluefilterpedia transition"
                    >
                        {{ $link['title'] }}
                    </a>
                    <span class="mx-2 text-gray-400">/</span>
                @else
                    <span
                        class="text-gray-900 font-semibold"
                        aria-current="page"
                    >
                        {{ $link['title'] }}
                    </span>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
