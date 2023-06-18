<div class="py-8 px-4 w-full lg:w-1/3">
    <div class="h-full bg-gray-100 rounded-lg px-4 py-6 flex items-start">
      <div class="w-12 flex-shrink-0 flex flex-col text-center leading-none">
        <span class="text-sm leading-none">{{ $article->published_at->format('M') }}</span>
        <span class="text-sm pt-2 mt-2 border-t-2 border-gray-200">{{ $article->published_at->format('Y') }}</span>
      </div>
      <div class="flex-grow pl-6">
        <h4 class="text-xs font-medium text-blue mb-1">
            <a href="{{ route('category', ['slug' => $article->category->slug]) }}">
                {{ $article->category->name }}
            </a>
        </h4>
        <h3 class="text-xl font-medium text-black mb-3">
            {{ $article->title }}
        </h3>
        <p class="mb-5">
            {{ $article->catch_phrase }}
        </p>
        <a  href="{{ route('article', ['categorySlug' => $article->category->slug, 'slug' => $article->slug]) }}"
            class="inline-block font-medium text-center bg-gradient-to-br hover:bg-gradient-to-r from-blue-dark to-blue hover:bg-orange text-white px-6 py-3 rounded shadow-md">
            Lire l'article
        </a>
      </div>
    </div>
  </div>
