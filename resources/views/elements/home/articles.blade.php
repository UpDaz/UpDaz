<section id="articles">
    <div class="container flex flex-col gap-8 mx-auto md:gap-16">
        <div class="flex items-center justify-center gap-8">
            <h2 class="text-3xl text-center sm:text-4xl">Mon actualité</h2>
            <div class="w-16">
                @include('elements.icon.write')
            </div>
        </div>
        <x-last-articles />
        <div class="text-center *:!w-auto *:inline-block">
            <x-button.primary href="{{ route('articles') }}" :small="true">Voir tous les articles</x-button.primary>
        </div>
    </div>
</section>
