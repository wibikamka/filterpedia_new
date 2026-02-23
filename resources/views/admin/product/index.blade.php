@extends('layout.admin')

@section('content')
<div class="px-4 sm:px-6 py-6 sm:py-8">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6">
        <div>
            <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Produk</h1>
            <p class="text-sm text-gray-500 mt-0.5">Kelola semua produk toko Anda</p>
        </div>
        <a href="{{ route('admin.product.create') }}"
           class="inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2.5 rounded-lg shadow-sm transition w-full sm:w-auto">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Produk
        </a>
    </div>

    {{-- Flash Message --}}
    @if(session('success'))
    <div class="mb-4 flex items-center gap-3 bg-green-50 border border-green-200 text-green-700 text-sm px-4 py-3 rounded-lg">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
        </svg>
        {{ session('success') }}
    </div>
    @endif

    {{-- Filter Panel --}}
    <form method="GET" action="{{ route('admin.product.index') }}"
          class="bg-white border border-gray-200 rounded-xl shadow-sm p-4 mb-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">

            {{-- Search Nama --}}
            <div>
                <label class="block text-xs font-medium text-gray-500 mb-1">Nama Produk</label>
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Cari nama produk..."
                           class="w-full pl-8 pr-3 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-2.5 top-2.5 w-3.5 h-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0"/>
                    </svg>
                </div>
            </div>

            {{-- Filter Kategori --}}
            <div>
                <label class="block text-xs font-medium text-gray-500 mb-1">Kategori</label>
                <select name="category"
                        class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Sort By --}}
            <div>
                <label class="block text-xs font-medium text-gray-500 mb-1">Urutkan Berdasarkan</label>
                <select name="sort_by"
                        class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                    <option value="updated_at" {{ request('sort_by', 'updated_at') == 'updated_at' ? 'selected' : '' }}>Tanggal Diubah</option>
                    <option value="created_at" {{ request('sort_by') == 'created_at'  ? 'selected' : '' }}>Tanggal Dibuat</option>
                    <option value="name"       {{ request('sort_by') == 'name'        ? 'selected' : '' }}>Nama</option>
                    <option value="price"      {{ request('sort_by') == 'price'       ? 'selected' : '' }}>Harga</option>
                    <option value="stock"      {{ request('sort_by') == 'stock'       ? 'selected' : '' }}>Stok</option>
                    <option value="sku"        {{ request('sort_by') == 'sku'         ? 'selected' : '' }}>SKU</option>
                </select>
            </div>

            {{-- Sort Direction + Submit --}}
            <div>
                <label class="block text-xs font-medium text-gray-500 mb-1">Arah</label>
                <div class="flex gap-2">
                    <select name="sort_dir"
                            class="flex-1 px-3 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                        <option value="desc" {{ request('sort_dir', 'desc') == 'desc' ? 'selected' : '' }}>↓ Terbesar / Terbaru</option>
                        <option value="asc"  {{ request('sort_dir') == 'asc'          ? 'selected' : '' }}>↑ Terkecil / Terlama</option>
                    </select>
                    <button type="submit"
                            class="px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded-lg transition flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z"/>
                        </svg>
                    </button>
                    @if(request()->hasAny(['search', 'category', 'sort_by', 'sort_dir']))
                        <a href="{{ route('admin.product.index') }}"
                           title="Reset Filter"
                           class="px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-500 text-sm rounded-lg transition flex-shrink-0 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </a>
                    @endif
                </div>
            </div>
        </div>

        {{-- Active Filter Badges --}}
        @if(request()->hasAny(['search', 'category']))
        <div class="flex flex-wrap gap-2 mt-3 pt-3 border-t border-gray-100">
            @if(request('search'))
                <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-blue-50 text-blue-700 text-xs rounded-full font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0"/></svg>
                    "{{ request('search') }}"
                </span>
            @endif
            @if(request('category'))
                <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-purple-50 text-purple-700 text-xs rounded-full font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                    {{ $categories->firstWhere('id', request('category'))?->name ?? 'Kategori' }}
                </span>
            @endif
        </div>
        @endif
    </form>

    {{-- ===================== DESKTOP TABLE ===================== --}}
    <div class="hidden md:block bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold text-gray-500 uppercase tracking-wide text-xs w-16">Foto</th>

                        {{-- Sortable: SKU --}}
                        @php
                            $sortBy  = request('sort_by', 'updated_at');
                            $sortDir = request('sort_dir', 'desc');
                            $icon = function($field) use ($sortBy, $sortDir) {
                                if ($sortBy === $field) {
                                    return $sortDir === 'asc'
                                        ? '<svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 15l7-7 7 7"/></svg>'
                                        : '<svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>';
                                }
                                return '<svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/></svg>';
                            };
                            $sortUrl = fn($field) => request()->fullUrlWithQuery([
                                'sort_by'  => $field,
                                'sort_dir' => ($sortBy === $field && $sortDir === 'asc') ? 'desc' : 'asc',
                            ]);
                        @endphp

                        <th class="px-4 py-3 text-left font-semibold text-gray-500 uppercase tracking-wide text-xs">
                            <a href="{{ $sortUrl('sku') }}" class="inline-flex items-center gap-1 hover:text-gray-700">
                                SKU {!! $icon('sku') !!}
                            </a>
                        </th>

                        <th class="px-4 py-3 text-left font-semibold text-gray-500 uppercase tracking-wide text-xs">
                            <a href="{{ $sortUrl('name') }}" class="inline-flex items-center gap-1 hover:text-gray-700">
                                Nama Produk {!! $icon('name') !!}
                            </a>
                        </th>

                        <th class="px-4 py-3 text-left font-semibold text-gray-500 uppercase tracking-wide text-xs">
                            <a href="{{ $sortUrl('price') }}" class="inline-flex items-center gap-1 hover:text-gray-700">
                                Harga {!! $icon('price') !!}
                            </a>
                        </th>

                        <th class="px-4 py-3 text-left font-semibold text-gray-500 uppercase tracking-wide text-xs">
                            <a href="{{ $sortUrl('stock') }}" class="inline-flex items-center gap-1 hover:text-gray-700">
                                Stok {!! $icon('stock') !!}
                            </a>
                        </th>

                        <th class="px-4 py-3 text-center font-semibold text-gray-500 uppercase tracking-wide text-xs">Status</th>
                        <th class="px-4 py-3 text-center font-semibold text-gray-500 uppercase tracking-wide text-xs">Tokopedia</th>

                        <th class="px-4 py-3 text-left font-semibold text-gray-500 uppercase tracking-wide text-xs">
                            <a href="{{ $sortUrl('updated_at') }}" class="inline-flex items-center gap-1 hover:text-gray-700">
                                Diubah {!! $icon('updated_at') !!}
                            </a>
                        </th>

                        <th class="px-4 py-3 text-center font-semibold text-gray-500 uppercase tracking-wide text-xs">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($products as $product)
                    @php $primaryImage = $product->images->firstWhere('is_primary', true) ?? $product->images->first(); @endphp
                    <tr class="hover:bg-gray-50 transition">

                        <td class="px-4 py-3">
                            @if($primaryImage)
                                <img src="{{ asset('storage/' . $primaryImage->path) }}" alt="{{ $product->name }}"
                                     class="w-12 h-12 object-cover rounded-lg border border-gray-200 shadow-sm">
                            @else
                                <div class="w-12 h-12 flex items-center justify-center bg-gray-100 rounded-lg border border-gray-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif
                        </td>

                        <td class="px-4 py-3 font-mono text-gray-500 text-xs">{{ $product->sku }}</td>

                        <td class="px-4 py-3">
                            <div class="font-medium text-gray-800">{{ $product->name }}</div>
                            @if($product->category)
                                <div class="text-xs text-gray-400 mt-0.5">{{ $product->category->name }}</div>
                            @endif
                        </td>

                        <td class="px-4 py-3 text-gray-700 font-medium whitespace-nowrap">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </td>

                        <td class="px-4 py-3">
                            <span class="{{ $product->stock <= 5 ? 'text-red-500 font-semibold' : 'text-gray-700' }}">
                                {{ $product->stock }}
                            </span>
                        </td>

                        <td class="px-4 py-3 text-center">
                            @if($product->is_active)
                                <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>Aktif
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-500">
                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>Nonaktif
                                </span>
                            @endif
                        </td>

                        <td class="px-4 py-3 text-center">
                            @if($product->tokopedia_link)
                                <a href="{{ $product->tokopedia_link }}" target="_blank"
                                   class="inline-flex items-center gap-1 text-green-600 hover:text-green-800 font-medium text-xs transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                    </svg>
                                    Lihat
                                </a>
                            @else
                                <span class="text-gray-300 text-xs">—</span>
                            @endif
                        </td>

                        <td class="px-4 py-3 text-xs text-gray-400 whitespace-nowrap">
                            {{ $product->updated_at->format('d M Y') }}<br>
                            <span class="text-gray-300">{{ $product->updated_at->format('H:i') }}</span>
                        </td>

                        <td class="px-4 py-3">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.product.edit', $product->id) }}"
                                   class="inline-flex items-center gap-1 px-3 py-1.5 rounded-md text-xs font-medium bg-yellow-50 text-yellow-700 border border-yellow-200 hover:bg-yellow-100 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Edit
                                </a>
                                <form action="{{ route('admin.product.destroy', $product->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin ingin menghapus produk ini?')"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 rounded-md text-xs font-medium bg-red-50 text-red-600 border border-red-200 hover:bg-red-100 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="px-4 py-16 text-center">
                            <div class="flex flex-col items-center gap-3 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                </svg>
                                <p class="text-sm font-medium">Belum ada produk</p>
                                <a href="{{ route('admin.product.create') }}" class="text-blue-500 text-sm hover:underline">Tambah produk pertama</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($products->hasPages())
        <div class="px-4 py-3 border-t border-gray-100 bg-gray-50">
            {{ $products->links() }}
        </div>
        @endif
    </div>

    {{-- ===================== MOBILE CARDS ===================== --}}
    <div class="md:hidden space-y-3">
        @forelse($products as $product)
        @php $primaryImage = $product->images->firstWhere('is_primary', true) ?? $product->images->first(); @endphp
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">

            {{-- Card Top --}}
            <div class="flex gap-3 p-3">

                {{-- Gambar --}}
                <div class="flex-shrink-0">
                    @if($primaryImage)
                        <img src="{{ asset('storage/' . $primaryImage->path) }}" alt="{{ $product->name }}"
                             class="w-16 h-16 object-cover rounded-lg border border-gray-200">
                    @else
                        <div class="w-16 h-16 flex items-center justify-center bg-gray-100 rounded-lg border border-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    @endif
                </div>

                {{-- Info --}}
                <div class="flex-1 min-w-0">
                    <div class="flex items-start justify-between gap-2">
                        <div class="min-w-0">
                            <p class="font-semibold text-gray-800 text-sm leading-tight line-clamp-1">{{ $product->name }}</p>
                            @if($product->category)
                                <p class="text-xs text-gray-400 mt-0.5">{{ $product->category->name }}</p>
                            @endif
                            <p class="font-mono text-gray-400 text-xs mt-0.5">{{ $product->sku }}</p>
                        </div>
                        @if($product->is_active)
                            <span class="flex-shrink-0 inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>Aktif
                            </span>
                        @else
                            <span class="flex-shrink-0 inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-500">
                                <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>Nonaktif
                            </span>
                        @endif
                    </div>

                    <div class="flex items-center gap-3 mt-2">
                        <span class="text-sm font-bold text-gray-800">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        <span class="text-xs {{ $product->stock <= 5 ? 'text-red-500 font-semibold' : 'text-gray-500' }}">
                            Stok: {{ $product->stock }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- Card Footer --}}
            <div class="flex flex-wrap items-center justify-between gap-2 px-3 py-2.5 bg-gray-50 border-t border-gray-100">
                <span class="text-xs text-gray-400">
                    {{ $product->updated_at->format('d M Y, H:i') }}
                </span>
                <div class="flex items-center gap-1.5 flex-wrap">
                    @if($product->tokopedia_link)
                        <a href="{{ $product->tokopedia_link }}" target="_blank"
                           class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-md text-xs font-medium bg-green-50 text-green-700 border border-green-200 hover:bg-green-100 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                            Tokopedia
                        </a>
                    @endif
                    <a href="{{ route('admin.product.edit', $product->id) }}"
                       class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-md text-xs font-medium bg-yellow-50 text-yellow-700 border border-yellow-200 hover:bg-yellow-100 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit
                    </a>
                    <form action="{{ route('admin.product.destroy', $product->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin ingin menghapus produk ini?')"
                                class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-md text-xs font-medium bg-red-50 text-red-600 border border-red-200 hover:bg-red-100 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="bg-white border border-gray-200 rounded-xl p-12 text-center">
            <div class="flex flex-col items-center gap-3 text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                </svg>
                <p class="text-sm font-medium">Belum ada produk</p>
                <a href="{{ route('admin.product.create') }}" class="text-blue-500 text-sm hover:underline">Tambah produk pertama</a>
            </div>
        </div>
        @endforelse

        @if($products->hasPages())
        <div class="bg-white border border-gray-200 rounded-xl p-3">
            {{ $products->links() }}
        </div>
        @endif
    </div>

    {{-- Info total --}}
    @if($products->total() > 0)
    <p class="text-xs text-gray-400 mt-3">
        Menampilkan {{ $products->firstItem() }}–{{ $products->lastItem() }} dari {{ $products->total() }} produk
    </p>
    @endif

</div>
@endsection