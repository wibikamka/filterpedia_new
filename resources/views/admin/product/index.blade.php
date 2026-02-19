@extends('layout.admin')

@section('content')
<div class="px-6 py-8">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Produk</h1>
            <p class="text-sm text-gray-500 mt-1">Kelola semua produk toko Anda</p>
        </div>
        <a href="{{ route('admin.product.create') }}"
           class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg shadow-sm transition">
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

    {{-- Table --}}
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left font-semibold text-gray-500 uppercase tracking-wide text-xs w-16">Foto</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-500 uppercase tracking-wide text-xs">SKU</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-500 uppercase tracking-wide text-xs">Nama Produk</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-500 uppercase tracking-wide text-xs">Harga</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-500 uppercase tracking-wide text-xs">Stok</th>
                    <th class="px-4 py-3 text-center font-semibold text-gray-500 uppercase tracking-wide text-xs">Status</th>
                    <th class="px-4 py-3 text-center font-semibold text-gray-500 uppercase tracking-wide text-xs">Tokopedia</th>
                    <th class="px-4 py-3 text-center font-semibold text-gray-500 uppercase tracking-wide text-xs">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($products as $product)
                @php
                    $primaryImage = $product->images->firstWhere('is_primary', true) ?? $product->images->first();
                @endphp
                <tr class="hover:bg-gray-50 transition">

                    {{-- Primary Image --}}
                    <td class="px-4 py-3">
                        @if($primaryImage)
                            <img src="{{ asset('storage/' . $primaryImage->path) }}"
                                 alt="{{ $product->name }}"
                                 class="w-12 h-12 object-cover rounded-lg border border-gray-200 shadow-sm">
                        @else
                            <div class="w-12 h-12 flex items-center justify-center bg-gray-100 rounded-lg border border-gray-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        @endif
                    </td>

                    {{-- SKU --}}
                    <td class="px-4 py-3 font-mono text-gray-500 text-xs">{{ $product->sku }}</td>

                    {{-- Name + Category --}}
                    <td class="px-4 py-3">
                        <div class="font-medium text-gray-800">{{ $product->name }}</div>
                        @if($product->category)
                            <div class="text-xs text-gray-400 mt-0.5">{{ $product->category->name }}</div>
                        @endif
                    </td>

                    {{-- Price --}}
                    <td class="px-4 py-3 text-gray-700 font-medium whitespace-nowrap">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </td>

                    {{-- Stock --}}
                    <td class="px-4 py-3 text-gray-700">
                        <span class="{{ $product->stock <= 5 ? 'text-red-500 font-semibold' : '' }}">
                            {{ $product->stock }}
                        </span>
                    </td>

                    {{-- Status --}}
                    <td class="px-4 py-3 text-center">
                        @if($product->is_active)
                            <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                Aktif
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-500">
                                <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>
                                Nonaktif
                            </span>
                        @endif
                    </td>

                    {{-- Tokopedia --}}
                    <td class="px-4 py-3 text-center">
                        @if($product->tokopedia_link)
                            <a href="{{ $product->tokopedia_link }}" target="_blank"
                               class="inline-flex items-center gap-1 text-green-600 hover:text-green-800 font-medium text-xs transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                </svg>
                                Lihat
                            </a>
                        @else
                            <span class="text-gray-300 text-xs">—</span>
                        @endif
                    </td>

                    {{-- Actions --}}
                    <td class="px-4 py-3">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.product.edit', $product->id) }}"
                               class="inline-flex items-center gap-1 px-3 py-1.5 rounded-md text-xs font-medium bg-yellow-50 text-yellow-700 border border-yellow-200 hover:bg-yellow-100 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Edit
                            </a>
                            <form action="{{ route('admin.product.destroy', $product->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        onclick="return confirm('Yakin ingin menghapus produk ini?')"
                                        class="inline-flex items-center gap-1 px-3 py-1.5 rounded-md text-xs font-medium bg-red-50 text-red-600 border border-red-200 hover:bg-red-100 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-4 py-16 text-center">
                        <div class="flex flex-col items-center gap-3 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                      d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                            </svg>
                            <p class="text-sm font-medium">Belum ada produk</p>
                            <a href="{{ route('admin.product.create') }}" class="text-blue-500 text-sm hover:underline">Tambah produk pertama</a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        @if($products->hasPages())
        <div class="px-4 py-3 border-t border-gray-100 bg-gray-50">
            {{ $products->links() }}
        </div>
        @endif
    </div>

    {{-- Table footer info --}}
    <p class="text-xs text-gray-400 mt-3">
        Menampilkan {{ $products->firstItem() }}–{{ $products->lastItem() }} dari {{ $products->total() }} produk
    </p>

</div>
@endsection