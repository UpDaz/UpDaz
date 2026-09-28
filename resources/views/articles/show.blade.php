@extends('layouts.default')

@section('title')
    {{ $article->meta_title }} - Article UpDaz
@endsection

@section('meta-description')
    {{ $article->meta_description }}
@endsection

@section('content')
    @include('elements.article.structured-data')
    <div class="container flex flex-col max-w-screen-lg gap-8 mx-auto">
        <div class="relative mt-24 overflow-hidden text-white ">
            <div class="flex flex-col gap-8 items-start">
                <div class="flex flex-col md:flex-row gap-8 md:items-center">
                    <div class="*:w-12 *:h-auto">
                        @include('elements.icon.write-paper')
                    </div>
                    <h1>{{ $article->title }}</h1>
                </div>
                <p class="text-lg">{{ $article->catch_phrase }}</p>
                <div class="mb-2 text-sm italic text-right w-full">
                    Le {{ $article->published_at->format('d/m/Y') }}, par Matthieu
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-4">
            <div class="article-content">
                {!! $article->content !!}
            </div>
        </div>
    </div>
    <x-articles-with-same-category :article="$article" />
@endsection

@section('javascript')
    @parent
    <script src="{{ asset('js/article.js') }}" async defer></script>
@endsection
