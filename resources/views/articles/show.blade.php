@extends('layouts.default')

@section('title')
    {{ $article->meta_title }} - Article UpDaz
@endsection

@section('meta-description')
    {{ $article->meta_description }}
@endsection

@section('content')
    @include('elements.article.structured-data')
    <div class="container mx-auto flex max-w-screen-lg flex-col gap-8">
        <div class="relative mt-24 overflow-hidden text-white">
            <div class="flex flex-col items-start gap-8">
                <div class="flex flex-col gap-8 md:flex-row md:items-center">
                    <div class="*:h-auto *:w-12">
                        @include('elements.icon.write-paper')
                    </div>
                    <h1>{{ $article->title }}</h1>
                </div>
                <p class="text-lg">{{ $article->catch_phrase }}</p>
                <div class="font-title text-yellow relative col-span-2 mb-1 min-w-0 truncate">
                    @foreach ($article->categoriesWithMainFirst() as $articleCategory)
                        <a title="Lien page catégorie article {{ $articleCategory->name }}" href="{{ route('category', ['slug' => $articleCategory->slug]) }}">{{ $articleCategory->name }}</a>
                        @if (!$loop->last)
                            /
                        @endif
                    @endforeach
                </div>
                <div class="mb-2 w-full text-right text-sm italic">
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
