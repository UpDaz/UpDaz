<div class="w-full px-4 py-8 lg:w-1/3">
    <div class="flex items-start h-full px-4 py-6 bg-gray-100 rounded-lg">
      <div class="flex flex-col flex-shrink-0 w-12 leading-none text-center">
        <span class="text-sm leading-none">{{ $article->published_at->format('M') }}</span>
        <span class="pt-2 mt-2 text-sm border-t-2 border-gray-200">{{ $article->published_at->format('Y') }}</span>
      </div>
      <div class="flex-grow pl-6">
        <h3 class="mb-1 text-xs font-medium text-blue">
            <a href="{{ route('category', ['slug' => $article->category->slug]) }}">
                {{ $article->category->name }}
            </a>
        </h3>
        <h4 class="mb-3 text-xl font-medium text-black">
            {{ $article->title }}
        </h4>
        <p class="mb-5">
            {{ $article->catch_phrase }}
        </p>
        <a  href="{{ route('article', ['categorySlug' => $article->category->slug, 'slug' => $article->slug]) }}"
            class="inline-block px-6 py-3 font-medium text-center text-white rounded shadow-md bg-gradient-to-br hover:bg-gradient-to-r from-blue-dark to-blue hover:bg-orange">
            Lire l'article
        </a>
      </div>
    </div>
  </div>
