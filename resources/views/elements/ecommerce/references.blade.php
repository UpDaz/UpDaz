<section id="references" class="pt-24 -mt-24">
    <div class="container flex flex-col gap-16 mx-auto">
        <div class="flex items-center justify-center gap-4 sm:gap-8">
            <div class="*:w-12 *:h-auto">
                @include('elements.icon.users-check')
            </div>
            <h2>Mes références d'applications e-commerce</h2>
        </div>
        <div class="grid items-center gap-8 sm:grid-cols-2 lg:grid-cols-3">
            <div class="lg:col-start-2">
            <x-reference title="PadelReference">
                <a href="https://www.padelreference.com/fr/" target="_blank" title="PadelReference">
                    <img src="{{ asset('img/references/padelreference.svg') }}" width="138" height="30"
                        alt="PadelReference logo" title="PadelReference logo" loading="lazy"
                        class="w-auto h-16 mx-auto" />
                </a>
            </x-reference>
            </div>
        </div>
    </div>
</section>
