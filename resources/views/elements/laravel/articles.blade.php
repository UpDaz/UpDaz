<section id="articles" class="pt-24 -mt-24">
    <div class="container flex flex-col gap-8 mx-auto md:gap-16">
        <div class="flex items-center justify-center gap-8">
            <div class="*:w-12 *:h-auto">
                @include('elements.icon.write')
            </div>
            <h2>Articles sur Laravel</h2>
        </div>
        <x-last-articles :categoryId="5"/>
        <div class="text-center *:!w-auto *:inline-block">
            <x-button.primary href="{{ route('category', ['slug' => 'laravel']) }}" :small="true">Voir tous les articles</x-button.primary>
        </div>
    </div>
</section>
