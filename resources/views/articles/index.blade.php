@extends('layouts.default')

@section('title')
    Articles - UpDaz
@endsection

@section('meta-description')
    Découvrez plus d'informations sur l'univers du développement de site web et des technologie de l'internet.
@endsection

@section('content')
    <div
        class="relative bg-gradient-to-br from-blue-dark to-blue text-white text-center -mt-24 overflow-hidden min-h-[50vh] md:min-h-0">
        <div class="px-8 py-16 pt-32 pb-24 bg-pattern-1 md:px-16">
            <h1 class="text-4xl font-bold font-title lg:text-6xl">Les derniers articles UpDaz</h1>
            <div class="container mx-auto mt-6 text-sm text-center">
                <x-breadcrumb :links="[
                    'Articles' => route('articles'),
                ]" />
            </div>
        </div>
    </div>

    <div class="container px-8 py-12 mx-auto md:px-16 md:py-24">
        <div class="flex flex-wrap -mx-4">
            @foreach ($articles->sortByDesc('published_at') as $article)
                @include('elements.article.box')
            @endforeach
        </div>
    </div>
@endsection
