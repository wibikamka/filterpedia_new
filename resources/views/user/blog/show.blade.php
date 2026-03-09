@extends('layout.user')

@section('title', $post->title)

@section('content')

<article class="max-w-4xl mx-auto py-12">

<h1 class="text-3xl font-bold mb-4">
{{ $post->title }}
</h1>

@if($post->thumbnail)
<img src="{{ asset('storage/'.$post->thumbnail) }}"
     class="w-full rounded-lg mb-6">
@endif

<div class="prose max-w-none">

{!! $post->content !!}

</div>

</article>

@endsection