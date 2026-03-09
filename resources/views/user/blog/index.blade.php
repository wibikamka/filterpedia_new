@extends('layout.user')

@section('title', 'Blog Filterpedia')

@section('content')

<section class="py-10">

<div class="container mx-auto">

<h1 class="text-2xl md:text-3xl font-semibold mb-6">
Blog Filterpedia
</h1>

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

@foreach($posts as $post)

@include('user.blog.card')

@endforeach

</div>

<div class="mt-10">
{{ $posts->links() }}
</div>

</div>

</section>

@endsection