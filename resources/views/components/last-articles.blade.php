<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 align-top justify-center md:justify-between ">
    @foreach($articles as $article)
        @include('elements.article.box')
    @endforeach
</div>
