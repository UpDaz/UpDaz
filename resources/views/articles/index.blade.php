@extends('layouts.default')

@section('title')
    Articles - UpDaz
@endsection

@section('meta-description')
    Découvrez plus d'informations sur l'univers du développement de site web et des technologie de l'internet.
@endsection

@section('content')
    <div class="container flex flex-col gap-16 mx-auto">
        <div class="relative mt-24 overflow-hidden text-center text-white ">
            <div class="flex flex-col gap-8 mx-auto">
                <h1 class="text-4xl font-bold font-title lg:text-5xl">Articles</h1>
                <h2 class="text-lg font-text font-normal">Retrouvez l'actualité du développement, Laravel, intelligence artificiel, etc</h2>
                <div class="text-blue-dark hidden lg:block absolute bottom-1/3 right-0 *:w-full *:h-auto w-1/10">
                    @include('elements.icon.scribble')
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
