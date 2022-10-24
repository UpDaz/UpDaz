<ul class="text-center md:hidden md:absolute md:bg-white md:left-1/2 md:-translate-x-2/4 md:w-60 md:shadow-md md:rounded" x-bind:class="openSubmenu? 'md:!block' : '' ">
    @foreach($categories as $category)
        @if($category->has_articles)
            <li>
                <a href="{{ route('category', ['slug' => $category->slug]) }}" class="block pb-2 pt-4 text-base font-bold text-white md:py-4 md:text-sm md:text-blue hover:bg-blue-dark hover:text-white">
                {{ $category->name }}
                </a>
            </li>
        @endif
    @endforeach
</ul>
