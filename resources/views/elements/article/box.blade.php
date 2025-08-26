<div class="relative grid items-start justify-center grid-cols-3 gap-8 article sm:flex-row">
    <div class="relative col-span-1 justify-self-end">
        <span class="text-sm">
            {{ $article->published_at->format('M / Y') }}
        </span>
        <div data-element="line-vertical" class="absolute w-[1px] top-0 h-[500%] -right-4"></div>
    </div>
    <div class="relative col-span-2">
        <a class="mb-1 text-sm text-yellow" title="Lien page catégorie article {{ $article->category->name }}" href="{{ route('category', ['slug' => $article->category->slug]) }}">
            {{ $article->category->name }}
        </a>
        <div data-element="line-horizontal" class="absolute h-[1px] right-0 w-[150%] -bottom-4"></div>
    </div>
    <div class="flex flex-col self-start justify-start col-span-2 col-start-2 gap-4">
        <h3 class="text-xl text-white">
            {{ $article->title }}
        </h3>
        <p>
            {{ $article->catch_phrase }}
        </p>
        <div class=" *:!w-auto *:inline-block">
            <x-button.secondary :small="true"
                title="Lien page article {{ $article->title }}"
                href="{{ route('article', ['categorySlug' => $article->category->slug, 'slug' => $article->slug]) }}">
                Lire l'article
            </x-button.secondary>
        </div>
    </div>
</div>
