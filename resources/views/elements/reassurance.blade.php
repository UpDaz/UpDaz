<div class="bg-blue-dark bottom-0 flex w-full justify-center py-8 lg:px-0 lg:py-4">
    <div class="container flex flex-row flex-wrap items-start md:justify-between gap-8 md:gap-4 lg:items-center">
        <div class="flex flex-col gap-2">
            <div class="flex items-center gap-2">
                <a href="#references" class="whitespace-nowrap text-sm">Notes et avis <span class="text-xs underline">(voir
                        plus)</span></a>
                <span class="text-yellow flex sm:hidden">
                    @for ($i = 1; $i <= 5; $i++)
                        @include('elements.icon.star')
                    @endfor
                </span>
            </div>
            <div class="flex w-full justify-between gap-4 sm:items-center md:justify-start md:gap-8">
                <a href="https://www.google.com/search?q=updaz" target="_blank" rel="nofollow noopener" class="flex flex-col justify-start gap-2 sm:flex-row sm:items-center">
                    <img src="{{ asset('img/logos/google.svg') }}" alt="Google" class="h-8 w-auto max-w-none self-start" width="95" height="32" />
                    <span class="text-yellow hidden sm:flex">
                        @for ($i = 1; $i <= 5; $i++)
                            @include('elements.icon.star')
                        @endfor
                    </span>
                </a>
                <a href="https://www.malt.fr/profile/matthieudazord" target="_blank" class="flex flex-col gap-2 sm:flex-row sm:items-center">
                    <img src="{{ asset('img/logos/malt.svg') }}" alt="Malt" class="h-8 w-auto max-w-none self-start" width="92" height="32" />
                    <span class="text-yellow hidden sm:flex">
                        @for ($i = 1; $i <= 5; $i++)
                            @include('elements.icon.star')
                        @endfor
                    </span>
                </a>
            </div>
        </div>
        <div class="text-blue hidden lg:block">
            @include('elements.icon.scribble')
        </div>
        <div class="flex flex-col gap-2 md:gap-1">
            <span class="whitespace-nowrap text-sm">Certification</span>
            <div class="flex w-full items-center gap-4 md:gap-8">
                <a href="https://directory.opquast.com/fr/certificat/PUGT87/" target="_blank" class="col-span-2 flex items-center gap-2">
                    <img src="{{ asset('img/logos/opquast.svg') }}" alt="Opquast certification qualité web" class="h-8 w-auto max-w-none" width="125" height="32" />
                </a>
            </div>
        </div>
        <div class="flex flex-col gap-2 md:gap-1">
            <span class="whitespace-nowrap text-sm">Partenaire de confiance</span>
            <div class="flex w-full items-center gap-4 md:gap-8">
                <a href="https://www.zaka-services.com/" target="_blank" class="col-span-2 flex items-center gap-2">
                    <img src="{{ asset('img/logos/zaka-services.webp') }}" alt="Zaka Services hebergement" class="h-8 w-auto max-w-none" width="125" height="32" />
                </a>
            </div>
        </div>
        <div class="flex flex-col gap-2 md:gap-1">
            <span class="whitespace-nowrap text-sm">Membre du collectif</span>
            <a href="https://collectif-cosme.coop/" target="_blank" class="col-span-2 flex items-center gap-2">
                <img src="{{ asset('img/logos/cosme.svg') }}" alt="Collectif Cosme Bordeaux" class="h-6 w-auto max-w-none" width="88" height="24" />
            </a>
        </div>
    </div>
</div>
