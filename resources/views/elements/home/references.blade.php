<section id="references" class="pt-24 -mt-24">
    <div class="container flex flex-col gap-16 mx-auto">
        <div class="flex items-center justify-center gap-4 sm:gap-8">
            <div class="*:w-12 *:h-auto">
                @include('elements.icon.users-check')
            </div>
            <h2>Une confiance gagnante</h2>
        </div>
        <div class="flex flex-col gap-4">
            <h3 class="text-lg">Vos retours qui font plaisir</h3>
            <div class="flex gap-8 overflow-y-visible -ml-6 p-6 -mt-6 overflow-x-auto no-scrollbar *:w-90 lg:*:w-80 *:shrink-0">
                @foreach($reviews as $review)
                    <x-review :name="$review->name" :source="$review->platform->value" :date="$review->formattedDate()" :rating="$review->rating">
                        {!! nl2br(e($review->content)) !!}
                    </x-review>
                @endforeach
            </div>
        </div>
        <div class="flex flex-col gap-4">
            <h3 class="text-lg">Ils m'ont fait confiance</h3>
            <div class="grid grid-cols-2 items-center gap-8 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @include('elements.home.references-updaz')
            </div>
        </div>
    </div>
</section>
