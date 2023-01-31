@extends('layouts.default')

@section('title')
{{ $article->meta_title }} - UpDaz
@endsection

@section('meta-description'){{ $article->meta_description }}@endsection

@section('content')
@include('elements.article.structured-data')
<div class="relative bg-blue text-white text-center py-16 md:py-20 md:pt-32 md:-mt-24 overflow-hidden min-h-[50vh] md:min-h-0">
    <div class="absolute h-80 bottom-0 lg:left-2/4 lg:-translate-x-1/2 opacity-10">
        @include('elements/illustrations/write-book')
    </div>
    <div class="container relative px-4 md:px-8 mx-auto ">
        <h1 class="font-title text-4xl lg:text-6xl font-bold">{{ $article->title }}</h1>
        <p class="container mx-auto text-center my-6">
            {{ $article->catch_phrase }}
        </p>
        <div class="container mx-auto text-center text-sm">
            <x-breadcrumb :links="[
                $article->category->name => route('category', ['slug' => $article->category->slug]),
                $article->title => route('article', ['categorySlug' => $article->category->slug, 'slug' => $article->slug])
            ]" />
        </div>
    </div>
</div>

<div class="container px-8 py-12 mx-auto md:px-36 md:py-24 text-justify">
    <div class="text-sm mb-6 italic text-right">
        Le {{ $article->published_at->format('d/m/Y') }}<br/>
        Par Matthieu
    </div>
    <div class="article-content">
        {!! $article->content !!}
    </div>
</div>

@endsection

@section('javascript')
@parent
<script src="{{ asset('js/article.js') }}" async defer></script>
@endsection
