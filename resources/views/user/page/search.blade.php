@extends('layout.user')

@section('title', 'Pencarian Produk')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">

<x-breadcrumb :links="[
        ['title' => 'Home',  'url' => url('/')],
        ['title' => 'Search',  'url' => ''],
    ]" />

    <h1 class="text-xl font-semibold mb-4">
        @if($q)
            Hasil pencarian: <span class="text-bluefilterpedia">"{{ $q }}"</span>
        @else
            Cari Produk
        @endif
    </h1>

    {{-- SEARCH INPUT --}}
    <form action="{{ route('search.index') }}" method="GET" class="mb-6">
        <input
            type="text"
            id="search-input"
            name="q"
            value="{{ $q }}"
            placeholder="Cari produk..."
            class="w-full max-w-md rounded-lg border px-4 py-2 focus:outline-none focus:border-bluefilterpedia"
        >
    </form>

    <div id="search-autocomplete" class="mt-6 hidden">
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
    </div>
</div>
@if(!$q)
<div id="recommended-section">
    <h2 class="mb-4 text-lg font-semibold">
        Rekomendasi Produk Terbaru
    </h2>

    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
        @foreach($recommended as $product)
            <x-card :product="$product" />
        @endforeach
    </div>
</div>
@endif

@if($q && $products->count())
    <div id="search-result-server">
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($products as $product)
                <x-card :product="$product" />
            @endforeach
        </div>

        <div class="mt-6">
            {{ $products->links() }}
        </div>
    </div>
@elseif($q)
    <div class="text-gray-500">
        Produk tidak ditemukan.
    </div>
@endif


</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
const input = document.getElementById('search-input')
const autoBox = document.getElementById('search-autocomplete')
const autoGrid = autoBox.querySelector('.grid')
const recommended = document.getElementById('recommended-section')

let controller = null

input.addEventListener('input', async () => {
    const q = input.value.trim()

    // state: input kosong → rekomendasi tampil
    if (q.length === 0) {
        autoBox.classList.add('hidden')
        autoGrid.innerHTML = ''
        recommended?.classList.remove('hidden')
        return
    }

    // state: < 2 char → semua disembunyikan
    if (q.length < 2) {
        autoBox.classList.add('hidden')
        autoGrid.innerHTML = ''
        recommended?.classList.add('hidden')
        return
    }

    // state: >= 2 char → autocomplete
    recommended?.classList.add('hidden')

    if (controller) controller.abort()
    controller = new AbortController()

    try {
        const res = await fetch(`/search/products?q=${encodeURIComponent(q)}`, {
            signal: controller.signal
        })

        const data = await res.json()

        if (!data.length) {
            autoBox.classList.add('hidden')
            autoGrid.innerHTML = ''
            return
        }

        autoGrid.innerHTML = data.map(p => `
<div class="group flex flex-col w-full overflow-hidden rounded-xl border border-gray-200 bg-white dark:bg-gray-800 dark:border-gray-700
 shadow-sm transition-all duration-300 hover:border-bluefilterpedia hover:shadow-xl">
    <a href="${p.url}" class="relative aspect-square w-full overflow-hidden bg-gray-100 block">
        <img src="${p.image}" alt="${p.name}" loading="lazy" draggable="false" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110">
    </a>
    <div class="flex flex-col flex-1 p-4">
        <a href="${p.url}">
            <h3 class="mb-2 line-clamp-2 text-sm md:text-base lg:text-lg font-semibold text-gray-900 dark:text-gray-100 hover:text-bluefilterpedia transition-colors">
                ${p.name}
            </h3>
        </a>
        <div class="flex-1"></div>
        <div class="mt-auto space-y-2">
            <div class="text-base lg:text-xl font-bold text-bluefilterpedia">
                Rp ${p.price?.toLocaleString('id-ID') || '-'}
            </div>
            <div class="flex items-center gap-2">
                ${p.tokopedia_link ? `<a href="${p.tokopedia_link}" target="_blank" rel="noopener noreferrer" title="Beli ${p.name} di Tokopedia" class="inline-flex opacity-90 hover:opacity-100 transition-opacity duration-200">
                    <img src="/storage/img/logo/tokopedialogo.png" class="w-10 h-10 lg:w-12 lg:h-12 object-contain cursor-pointer hover:scale-110 transition-transform duration-200">
                </a>` : ''}
                <a href="https://wa.me/6281282388324?text=Halo, saya tertarik dengan produk ${encodeURIComponent(p.name)}" target="_blank" rel="noopener noreferrer" title="Chat WhatsApp" class="inline-flex">
                    <img src="/storage/img/logo/waicon1.png" class="w-10 h-10 lg:w-12 lg:h-12 object-contain cursor-pointer hover:scale-110 transition-transform duration-200">
                </a>
            </div>
        </div>
    </div>
</div>


        `).join('')

        autoBox.classList.remove('hidden')

    } catch (e) {
        if (e.name !== 'AbortError') {
            console.error(e)
        }
    }
})
    });
</script>

@endsection
