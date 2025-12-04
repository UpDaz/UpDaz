<section id="references" class="pt-24 -mt-24">
    <div class="container flex flex-col gap-16 mx-auto">
        <div class="flex flex-col-reverse items-center justify-center gap-4 sm:gap-8 sm:flex-row">
            <h2 class="text-3xl text-center sm:text-4xl">Mes références d'applications sur-mesure avec Laravel</h2>
            <div class="w-16">
                @include('elements.icon.users-check')
            </div>
        </div>
        <div class="grid items-center gap-8 sm:grid-cols-2 lg:grid-cols-3">
            <x-reference title="SOLART Etude">
                <a href="https://solart-etude.com/" target="_blank" title="SOLART Etude">
                    <img src="{{ asset('img/references/solart.svg') }}" width="138" height="30"
                        alt="B-Records logo" title="SOLART Etude logo" loading="lazy" class="w-auto h-16 mx-auto" />
                </a>
            </x-reference>
            <x-reference title="PadelReference">
                <a href="https://www.padelreference.com/fr/" target="_blank" title="PadelReference">
                    <img src="{{ asset('img/references/padelreference.svg') }}" width="138" height="30"
                        alt="PadelReference logo" title="PadelReference logo" loading="lazy"
                        class="w-auto h-16 mx-auto" />
                </a>
            </x-reference>

            <x-reference title="Mostiglass">
                <a href="https://www.mostiglass.fr/fr" target="_blank" title="Mostiglass"
                    class="flex items-center justify-center gap-2">
                    <img src="{{ asset('img/references/mostiglass.jpeg') }}" width="138" height="30"
                        alt="Mostiglass logo" title="Mostiglass" loading="lazy" class="w-auto h-16 bg-white" />
                    <span>Mostiglass<sup>®</sup></span>
                </a>
            </x-reference>
        </div>
    </div>
</section>
