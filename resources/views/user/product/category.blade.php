@extends('layout.user')

@section('title', $category->name)

@section('content')
<h1 class="text-2xl font-bold mb-4">{{ $category->name }}</h1>
<x-breadcrumb :links="[
    ['title'=>'Home','url'=>route('home')],
    ['title'=>$category->name,'url'=>route('product.category', $category)]
]" />

@if($products->count())
<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
    @foreach($products as $product)
        <x-card :product="$product" />
    @endforeach
</div>

<div class="mt-6">
    {{ $products->links() }}
</div>
@else
<p>Tidak ada produk untuk kategori ini.</p>
@endif
@endsection
