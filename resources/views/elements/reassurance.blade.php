<div class="bg-blue-dark bottom-0 flex w-full justify-center py-8 lg:px-0 lg:py-4">
    <div class="container flex flex-row flex-wrap items-start gap-8 md:justify-between md:gap-4 lg:items-center">
        <div class="flex flex-col gap-2">
            <div class="flex items-center gap-2">
                <a href="#references" class="whitespace-nowrap text-sm">Notes et avis <span class="text-xs underline">(voir
                        plus)</span></a>
            </div>
            <div class="flex flex-col md:flex-row w-full justify-between gap-4 sm:items-center md:justify-start md:gap-8">
                @include('elements.reassurance.review-platform', [
                    'platform' => config('custom.reviews.google'),
                    'logo' => 'img/logos/google.svg',
                    'name' => 'Google',
                    'width' => 95,
                ])
                @include('elements.reassurance.review-platform', [
                    'platform' => config('custom.reviews.malt'),
                    'logo' => 'img/logos/malt.svg',
                    'name' => 'Malt',
                    'width' => 92,
                ])
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
