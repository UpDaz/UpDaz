@extends('layouts.default')

@section('title')
    {{ $category->meta_title }} - UpDaz
@endsection

@section('meta-description')
    {{ $category->meta_description }}
@endsection

@section('content')

    <div class="container flex flex-col gap-16 mx-auto">
        <div class="relative mt-24 overflow-hidden text-center text-white ">
            <div class="flex flex-col gap-4 mx-auto">
                <h1 class="text-4xl font-bold font-title lg:text-5xl">Les articles <span
                        class="lowercase">{{ $category->name }}</span></h1>
                <p class="text-xl">{{ $category->catch_phrase }}</p>
            </div>
        </div>
        @if ($category->has_articles)
            <div class="grid gap-16 mb-16 md:grid-cols-2">
                @foreach ($category->articles->sortByDesc('published_at') as $article)
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
