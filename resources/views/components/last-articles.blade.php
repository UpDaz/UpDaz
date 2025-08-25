<div class="grid items-start justify-start gap-16 pr-8 sm:gap-8 md:grid-cols-2 xl:grid-cols-3">
    @foreach($articles as $article)
        @include('elements.article.box')
    @endforeach
</div>
