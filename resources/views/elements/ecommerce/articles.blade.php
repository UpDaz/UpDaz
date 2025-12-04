<section id="articles" class="pt-24 -mt-24">
    <div class="container flex flex-col gap-8 mx-auto md:gap-16">
        <div class="flex items-center justify-center gap-8">
            <h2 class="text-3xl text-center sm:text-4xl">Articles Lunar et E-commerce</h2>
            <div class="w-16">
                @include('elements.icon.write')
            </div>
        </div>
        <x-last-articles :categoryId="4"/>
        <div class="text-center *:!w-auto *:inline-block">
            <x-button.primary href="{{ route('category', ['slug' => 'e-commerce']) }}" :small="true">Voir tous les articles</x-button.primary>
        </div>
    </div>
</section>
