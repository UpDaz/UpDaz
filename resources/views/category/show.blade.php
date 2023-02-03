@extends('layouts.default')

@section('title')
{{ $category->meta_title }} - UpDaz
@endsection

@section('meta-description')
{{ $category->meta_description }}
@endsection

@section('content')
<div class="relative bg-blue text-white text-center py-16 md:py-20 md:pt-32 md:-mt-24 overflow-hidden min-h-[50vh] md:min-h-0">
    <div class="absolute h-80 bottom-0 lg:left-2/4 lg:-translate-x-1/2 opacity-10">
        @include('elements/illustrations/write-book')
    </div>
    <div class="relative">
        <h1 class="font-title text-4xl lg:text-6xl font-bold">Les articles <span class="text-orange">{{ $category->name }}</span></h1>
        <div class="container mx-auto text-center text-sm mt-6">
            <x-breadcrumb :links="[
                $category->name => route('category', ['slug' => $category->slug])
            ]" />
        </div>
    </div>
</div>

<div class="container mx-auto mt-6">
    <p class="text-center">
        {{ $category->catch_phrase }}
    </p>
</div>

<div class="container px-8 py-12 mx-auto md:px-16 md:py-24">
    @if($category->has_articles)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 align-top justify-center">
            @foreach( $category->articles->sortByDesc('published_at') as $article)
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
