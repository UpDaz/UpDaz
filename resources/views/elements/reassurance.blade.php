<div class="bg-blue-dark flex justify-center bottom-0 w-full lg:py-4 py-8 lg:px-0">
    <div class="container lg:!px-0 flex flex-col gap-4 flex-wrap md:flex-row items-start justify-between lg:items-center">
        <div class="flex flex-col gap-1">
            <a href="#references" class="whitespace-nowrap text-sm">Notes et avis <span class="underline text-xs">(voir plus)</span></a>
            <div class="flex *:w-full gap-4 md:gap-8 items-center">
                <a href="https://www.google.com/search?sca_esv=c615aacbb620d3c2&q=updaz&si=AL3DRZEsmMGCryMMFSHJ3StBhOdZ2-6yYkXd_doETEE1OR-qOd8Zdi8KcL1I_n53ekY2Jk7ehhj2kbcj5IMZ8DoJOxfaSNucXUbjLAk5tNEfUSyAcfpkRew%3D&uds=ALYpb_k0Bh0O5_BGI7GnVPXtbDn98JgG5R9oJZCdLYDRRytz5XwICe9DwpHsqOzORY8bDEDVeEMJROab--dE9Rj1cyBfOb1FcJhW0-n8Mu1dtiSdDT9Nn5k&sa=X&ved=2ahUKEwjViLqi1Z-UAxVxTKQEHdyaGr0Q3PALegQIGBAE&biw=1512&bih=827&dpr=2"
                    target="_blank" class="flex gap-2 items-center">
                    <img src="{{ asset('img/logos/google.svg') }}" alt="Google" class="h-8 w-auto max-w-none" />
                    <span class="flex text-yellow">
                        @for ($i = 1; $i <= 5; $i++)
                            @include('elements.icon.star')
                        @endfor
                    </span>
                </a>
                <a href="https://www.malt.fr/profile/matthieudazord" target="_blank" class="flex gap-2 items-center">
                    <img src="{{ asset('img/logos/malt.svg') }}" alt="Malt" class="h-8 w-auto max-w-none" />
                    <span class="flex text-yellow">
                        @for ($i = 1; $i <= 5; $i++)
                            @include('elements.icon.star')
                        @endfor
                    </span>
                </a>
            </div>
        </div>
        {{-- <div class="flex flex-col gap-4 w-full lg:w-auto md:flex-row items-start justify-between lg:items-center"> --}}
            <div class="flex md:flex-col gap-4 md:gap-1 items-center">
                <span class="whitespace-nowrap text-sm">Partenaires de confiance</span>
                <div class="flex w-full gap-4 md:gap-8 items-center">
                    <a href="https://www.zaka-services.com/" target="_blank" class="flex gap-2 items-center col-span-2">
                        <img src="{{ asset('img/logos/zaka-services.png') }}" alt="Zaka Services hebergement"
                            class="h-8 w-auto max-w-none" />
                    </a>
                    <a href="https://www.remibailly.com/" target="_blank" class="flex gap-2 items-center col-span-2">
                        <img src="{{ asset('img/logos/remi-bailly.png') }}" alt="Remi Bailly référencement"
                            class="h-8 w-auto max-w-none" />
                    </a>
                </div>
            </div>
            <div class="flex md:flex-col items-center md:items-start gap-4 md:gap-1 lg:items-end">
                <span class="whitespace-nowrap text-sm">Membre du collectif</span>
                <a href="https://collectif-cosme.coop/" target="_blank" class="flex gap-2 items-center col-span-2">
                    <img src="{{ asset('img/logos/cosme.svg') }}" alt="Collectif Cosme Bordeaux"
                        class="h-6 w-auto max-w-none" />
                </a>
            </div>
        {{-- </div> --}}
    </div>
</div>
