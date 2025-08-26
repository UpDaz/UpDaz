@extends('layouts.default')

@section('title')
    Articles - UpDaz
@endsection

@section('meta-description')
    Découvrez plus d'informations sur l'univers du développement de site web et des technologie de l'internet.
@endsection

@section('content')
    <div class="container flex flex-col gap-16 mx-auto">
        <div class="relative text-white text-center mt-24 overflow-hidden ">
            <div class="flex flex-col gap-4 mx-auto">
                <h1 class="text-4xl font-bold font-title lg:text-5xl">Articles</h1>
                <h2 class="text-xl ">Retrouvez toute l'actualité UpDaz</h2>
                <div class="flex flex-col gap-4 text-sm text-center">
                    <div data-element="line-horizontal" class="h-[1px] w-1/4 mx-auto"></div>
                    <x-breadcrumb :links="[
                        'Articles' => route('articles'),
                    ]" />
                </div>
            </div>
        </div>
        <div class="grid gap-16 mb-16 md:grid-cols-2">
            @foreach ($articles->sortByDesc('published_at') as $article)
                @include('elements.article.box')
            @endforeach
        </div>
    </div>
@endsection
