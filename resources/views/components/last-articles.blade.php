<div class="grid items-start justify-start gap-4 pr-8 md:gap-8 md:grid-cols-2 xl:grid-cols-3">
    @foreach($articles as $article)
        @include('elements.article.box')
    @endforeach
</div>
