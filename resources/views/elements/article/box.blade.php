<div class="article bg-white border-8 border-orange px-6 py-8">
    <h3 class="">
        <a href="{{ route('article', ['categorySlug' => $article->category->slug, 'slug' => $article->slug]) }}" class="font-title bold text-2xl text-blue text-left">
            {{ $article->title }}
        </a>
    </h3>
    <div class="flex items-center justify-between my-4">
        <a href="{{ route('category', ['slug' => $article->category->slug]) }}" class="text-xs bg-orange py-1 px-2 text-white rounded shadow-md">
            {{ $article->category->name }}
        </a>
        <p class="text-right italic text-xs">
            le {{ $article->published_at->format('d/m/Y') }}
        </p>
    </div>
    <p class="text-left">
        {{ $article->catch_phrase }}
    </p>
    <div class="w-full text-center mt-8">
        <a href="{{ route('article', ['categorySlug' => $article->category->slug, 'slug' => $article->slug]) }}" class="inline-block bg-blue hover:bg-blue-dark text-white px-6 py-3 rounded shadow-md mb-4 md:mb-0">
            En savoir plus
        </a>
    </div>
</div>
