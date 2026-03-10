<section id="articles" class="pt-24 -mt-24">
    <div class="container flex flex-col gap-8 mx-auto md:gap-16">
        <div class="flex flex-col items-center justify-center gap-8 sm:flex-row">
            <div class="w-18 md:w-12">
                @include('elements.icon.write')
            </div>
            <h2 class="text-3xl text-center sm:text-4xl">Articles</h2>
        </div>
        <x-last-articles />
        <div class="text-center *:!w-auto *:inline-block">
            <x-button.primary href="{{ route('articles') }}" :small="true">Voir tous les articles</x-button.primary>
        </div>
    </div>
</section>
