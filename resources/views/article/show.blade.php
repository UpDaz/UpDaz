@extends('layouts.default')

@section('title')
{{ $article->meta_title }} - UpDaz
@endsection

@section('meta-description'){{ $article->meta_description }}@endsection

@section('content')
@include('elements.article.structured-data')
<div class="relative bg-gradient-to-br from-blue-dark to-blue text-white text-center -mt-24 overflow-hidden min-h-[50vh] md:min-h-0">
    <div class="px-8 py-16 pt-32 pb-24 bg-pattern-1 md:px-16">
        <h1 class="text-4xl font-bold font-title lg:text-6xl">{{ $article->title }}</h1>
        <p class="container mx-auto my-6 text-center">
            {{ $article->catch_phrase }}
        </p>
        <div class="container mx-auto text-sm text-center">
            <x-breadcrumb :links="[
                $article->category->name => route('category', ['slug' => $article->category->slug]),
                $article->title => route('article', ['categorySlug' => $article->category->slug, 'slug' => $article->slug])
            ]" />
        </div>
    </div>
</div>

<div class="container px-8 py-12 mx-auto text-justify md:px-36 md:py-24">
    <div class="mb-6 text-sm italic text-right">
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
