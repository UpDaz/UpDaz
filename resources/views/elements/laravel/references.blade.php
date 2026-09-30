<section id="references" class="-mt-24 pt-24">
    <div class="container mx-auto flex flex-col gap-16">
        <div class="flex items-center justify-center gap-4 sm:gap-8">
            <div class="*:h-auto *:w-12">
                @include('elements.icon.users-check')
            </div>
            <h2>Ils ont choisi Laravel</h2>
        </div>
        <div class="grid items-center gap-8 sm:grid-cols-2 lg:grid-cols-3">
            <x-reference title="VisaEntreprendre" style="bg-white">
                <a href="https://visaentreprendre.fr/" target="_blank" title="VisaEntreprendre CCI CMA Bordeaux">
                    <img src="{{ asset('img/references/visaentreprendre.svg') }}" width="138" height="30" alt="VisaEntreprendre logo" title="VisaEntreprendre logo" loading="lazy" class="mx-auto max-h-16 w-auto" />
                </a>
            </x-reference>
            <x-reference title="SOLART Etude">
                <a href="https://solart-etude.com/" target="_blank" title="SOLART Etude">
                    <img src="{{ asset('img/references/solart.svg') }}" width="138" height="30" alt="Solart logo" title="SOLART Etude logo" loading="lazy" class="mx-auto h-16 w-auto" />
                </a>
            </x-reference>
            <x-reference title="PadelReference">
                <a href="https://www.padelreference.com/fr/" target="_blank" title="PadelReference">
                    <img src="{{ asset('img/references/padelreference.svg') }}" width="138" height="30" alt="PadelReference logo" title="PadelReference logo" loading="lazy" class="mx-auto h-16 w-auto" />
                </a>
            </x-reference>

            <x-reference title="Mostiglass">
                <a href="https://www.mostiglass.fr/fr" target="_blank" title="Mostiglass" class="flex items-center justify-center gap-2">
                    <img src="{{ asset('img/references/mostiglass.jpeg') }}" width="138" height="30" alt="Mostiglass logo" title="Mostiglass" loading="lazy" class="h-16 w-auto bg-white" />
                    <span>Mostiglass<sup>®</sup></span>
                </a>
            </x-reference>
        </div>
    </div>
</section>
