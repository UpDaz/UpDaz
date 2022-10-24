@extends('layouts.default')

@section('title')
{{ $category->name }} - Actualités - UpDaz
@endsection

@section('meta-description')
{{ $category->catch_phrase }}
@endsection

@section('content')
<div class="relative bg-blue text-white text-center py-16 md:py-20 md:pt-32 md:-mt-24 overflow-hidden min-h-[50vh] md:min-h-0">
    <div class="absolute h-80 bottom-0 lg:left-2/4 lg:-translate-x-1/2 opacity-10">
        @include('elements/illustrations/write-book')
    </div>
    <div class="relative">
        <h1 class="font-title text-4xl lg:text-6xl font-bold">Actualités <span class="text-orange">{{ $category->name }}</span></h1>
        <p class="container mx-auto text-center my-6">
            {{ $category->catch_phrase }}
        </p>
        <div class="container mx-auto text-center text-sm">
            <x-breadcrumb :links="[
                $category->name => route('category', ['slug' => $category->slug])
            ]" />
        </div>
    </div>
</div>

<div class="container px-8 py-12 mx-auto md:px-16 md:py-24 text-justify">
    @if($category->has_articles)
        <div class="md:grid grid-cols-3">
            @foreach( $category->articles as $article)
                @include('elements.article.box')
            @endforeach
        </div>
    @else
        <p class="text-center font-bold">
            Aucune actualité pour le moment
        </p>
        <div class="w-full md:w-1/2 mx-auto">
            @include('elements/illustrations/no-content')
        </div>
    @endif
</div>

@endsection
