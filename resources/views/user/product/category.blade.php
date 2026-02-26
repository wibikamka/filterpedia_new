@extends('layout.user')

@section('title', $category->name . ' - Produk Filter Industri | Filterpedia')
@section('meta_description', 'Temukan berbagai produk ' . $category->name . ' untuk kebutuhan filter industri dan water treatment Anda di Filterpedia, supplier terpercaya di Indonesia.')
@section('structured_data')
@php
$breadcrumbSchema = [
    "@context" => "https://schema.org",
    "@type" => "BreadcrumbList",
    "itemListElement" => [
        [
            "@type" => "ListItem",
            "position" => 1,
            "name" => "Home",
            "item" => route('home')
        ],
        [
            "@type" => "ListItem",
            "position" => 2,
            "name" => $category->name,
            "item" => route('product.category', $category)
        ]
    ]
];
@endphp

<script type="application/ld+json">
{!! json_encode($breadcrumbSchema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}
</script>
@endsection

@section('content')
<div class="mx-auto max-w-7xl px-4 py-4">
    <h1 class="text-2xl font-bold mb-4">{{ $category->name }}</h1>

    <x-breadcrumb :links="[
        ['title'=>'Home','url'=>route('home')],
        ['title'=>$category->name,'url'=>route('product.category', $category)]
    ]" />

    @if($category->description)
        <div class="my-4 text-gray-700 dark:text-gray-300 prose max-w-none">
            {!! nl2br(e($category->description)) !!}
        </div>
    @endif

    @if($products->count())
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($products as $product)
                <x-card :product="$product" />
            @endforeach
        </div>

        <div class="mt-6">
            {{ $products->links() }}
        </div>

        @if($products->hasPages())
            @if($products->currentPage() > 1)
                <link rel="prev" href="{{ $products->previousPageUrl() }}">
            @endif
            @if($products->hasMorePages())
                <link rel="next" href="{{ $products->nextPageUrl() }}">
            @endif
        @endif
    @else
        <p>Tidak ada produk untuk kategori ini.</p>
    @endif
</div>
@endsection

