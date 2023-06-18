@extends('layouts.default')

@section('title')
{{ $category->meta_title }} - UpDaz
@endsection

@section('meta-description')
{{ $category->meta_description }}
@endsection

@section('content')
<div class="relative bg-gradient-to-br from-blue-dark to-blue text-white text-center -mt-24 overflow-hidden min-h-[50vh] md:min-h-0">
    <div class="px-8 py-16 pt-32 pb-24 bg-pattern-1 md:px-16">
        <h1 class="text-4xl font-bold font-title lg:text-6xl">Les articles <span class="lowercase">{{ $category->name }}</span></h1>
        <div class="container w-full mx-auto mt-6 md:w-2/3">
            <p class="text-center">
                {{ $category->catch_phrase }}
            </p>
        </div>
        <div class="container mx-auto mt-6 text-sm text-center">
            <x-breadcrumb :links="[
                $category->name => route('category', ['slug' => $category->slug])
            ]" />
        </div>
    </div>
</div>

<div class="container px-8 py-12 mx-auto md:px-16 md:py-24">
    @if($category->has_articles)
        <div class="flex flex-wrap -mx-4">
            @foreach( $category->articles->sortByDesc('published_at') as $article)
                @include('elements.article.box')
            @endforeach
        </div>
    @else
        <p class="font-medium text-center">
            Aucune actualité pour le moment
        </p>
    @endif
</div>

@endsection
