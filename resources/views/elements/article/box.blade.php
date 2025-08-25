<div class="relative grid items-start justify-center grid-cols-3 gap-8 sm:flex-row">
    <div class="relative col-span-1 justify-self-end">
        <span class="text-sm leading-none">
            {{ $article->published_at->format('M / Y') }}
        </span>
        <div class="absolute w-[1px] top-0 h-[300%] -right-4 bg-gradient-to-b from-transparent via-gray to-transparent ">
        </div>
    </div>
    <div class="relative col-span-2">
        <a class="mb-1 text-sm text-yellow" href="{{ route('category', ['slug' => $article->category->slug]) }}">
            {{ $article->category->name }}
        </a>
        <div class="absolute h-[1px] right-0 w-[150%] -bottom-4 bg-gradient-to-r from-transparent via-gray"></div>
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
                href="{{ route('article', ['categorySlug' => $article->category->slug, 'slug' => $article->slug]) }}">
                Lire l'article
            </x-button.secondary>
        </div>
    </div>
</div>
