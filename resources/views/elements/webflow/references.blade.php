<section id="references" class="pt-24 -mt-24">
    <div class="container flex flex-col gap-16 mx-auto">
        <div class="flex flex-col-reverse items-center justify-center gap-4 sm:gap-8 sm:flex-row">
            <h2 class="text-3xl text-center sm:text-4xl">Mes références utilisant Webflow</h2>
            <div class="w-16">
                @include('elements.icon.users-check')
            </div>
        </div>
        <div class="grid items-center gap-8 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            <x-reference title="B.Records">
                <a href="https://www.b-records.fr/" target="_blank" title="B.Records">
                    <img src="{{ asset('img/references/b-records.png') }}" width="138" height="30"
                        alt="B-Records logo" title="B.Records logo" loading="lazy" class="w-auto h-16 mx-auto" />
                </a>
            </x-reference>
            <x-reference title="F.ABM">
                <a href="https://www.fabm-menuiseries.fr/" target="_blank" title="F.ABM">
                    <img src="{{ asset('img/references/fabm.png') }}" width="138" height="30" alt="F.ABM logo"
                        title="F.ABM logo" loading="lazy" class="w-auto h-16 mx-auto" />
                </a>
            </x-reference>
            <x-reference title="Asphodèle Créations">
                <a href="https://www.asphodele-creations.fr/" target="_blank" title="Asphodèle Créations">
                    <img src="{{ asset('img/references/asphodele-creations.svg') }}" width="138" height="30"
                        alt="Asphodèle Créations logo" title="Asphodèle Créations" loading="lazy"
                        class="w-auto h-16 mx-auto" />
                </a>
            </x-reference>
            <x-reference title="Le Petit Paumé">
                <a href="https://www.petitpaume.com/" target="_blank" title="Le Petit Paumé">
                    <img src="{{ asset('img/references/le-petit-paume.webp') }}" width="138" height="30"
                        alt="Le petit paumé logo" title="Le Petit Paumé" loading="lazy" class="w-auto h-16 mx-auto" />
                </a>
            </x-reference>
        </div>
    </div>
</section>
