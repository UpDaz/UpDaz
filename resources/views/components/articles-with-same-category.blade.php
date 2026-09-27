<div>
    @if ($articles->count())
        <div class="container mx-auto">
            <hr />
            <div class="pb-16 mt-8">

                <div class="flex flex-col gap-8">
                    <div class="flex items-center gap-8">
                        <div class="*:w-12 *:h-auto">
                            @include('elements.icon.book')
                        </div>
                        <h2>Ces articles pourraient vous intéresser</h2>
                    </div>
                    <div class="grid gap-8 md:grid-cols-2 items-start">
                        @foreach ($articles->take(4) as $article)
                            @include('elements.article.box')
                        @endforeach
                    </div>
                    @if ($articles->count() > 1)
                    <div class="flex justify-center *:md:!w-auto">
                        <x-button.secondary 
                            title="Lien page catégorie article {{ $article->category->name }}"
                            href="{{ route('category', ['slug' => $article->category->slug]) }}">
                            Voir plus d'articles sur le thème {{ $articles->first()->category->name}}
                        </x-button.secondary>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    @endif
</div>
