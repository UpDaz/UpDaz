<div class="container md:container-none">
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-12 items-center ">
        <x-tooltip color="#FFFFFF" displayIcon="{{ false }}">
            <x-slot:message>
                <h3 class="px-6 py-4 font-text text-base font-bold bg-blue text-white text-center w-full">C&C Graphic</h3>
                <div class="px-6 py-4 text-black leading-6">
                    <img src="{{ asset('img/illustrations/check.svg')}}" class="mr-1 inline-block align-middle" width="20" height="20" alt="Illustration picto check" title="Check"/> Accompagnement dans la création technique de sites web
                </div>
            </x-slot>
            <x-slot:content>
                <a href="https://candc-graphic.com/" target="_blank" title="CAndC Agence de communication visuelle Paris">
                    <img src="{{ asset('img/references/candc.svg') }}" class="w-full max-h-12 mx-auto" width="138" height="30" alt="C" title="CAndC Agence de communication visuelle Paris" loading="lazy"/>
                </a>
            </x-slot>
        </x-tooltip>
        <x-tooltip color="#FFFFFF" displayIcon="{{ false }}">
            <x-slot:message>
                <h3 class="px-6 py-4 font-text text-base font-bold bg-blue text-white text-center w-full">Le5eme</h3>
                <div class="px-6 py-4 text-black leading-8">
                    <img src="{{ asset('img/illustrations/check.svg')}}" class="mr-1 inline-block align-middle" width="20" height="20" alt="Illustration picto check" title="Check"/> Webflow
                    <br/>
                    <img src="{{ asset('img/illustrations/check.svg')}}" class="mr-1 inline-block align-middle" width="20" height="20" alt="Illustration picto check" title="Check"/> Site vitre
                    <br/>
                    <img src="{{ asset('img/illustrations/check.svg')}}" class="mr-1 inline-block align-middle" width="20" height="20" alt="Illustration picto check" title="Check"/> Visibilité
                </div>
            </x-slot>
            <x-slot:content>
                <a href="https://www.le5eme.com/fr" target="_blank" title="Le5eme">
                    <img src="{{ asset('img/references/le5eme.svg') }}" class="w-full max-h-16 mx-auto" width="138" height="50" alt="Le5eme" title="Le5eme.com" loading="lazy"/>
                </a>
            </x-slot>
        </x-tooltip>
        <x-tooltip color="#FFFFFF" displayIcon="{{ false }}">
            <x-slot:message>
                <h3 class="px-6 py-4 font-text text-base font-bold bg-blue text-white text-center w-full">Mediaffiliation</h3>
                <div class="px-6 py-4 text-black leading-6">
                    <img src="{{ asset('img/illustrations/check.svg')}}" class="mr-1 inline-block align-middle" width="20" height="20" alt="Illustration picto check" title="Check"/> Accompagnement pour des évolutions techniques
                </div>
            </x-slot>
            <x-slot:content>
                <a href="https://www.mediaffiliation.fr/" target="_blank" title="Mediaffiliation">
                    <img src="{{ asset('img/references/mediaffiliation.png') }}" class="w-full max-h-12 mx-auto" width="138" height="30" alt="C" title="Mediaffiliation" loading="lazy"/>
                </a>
            </x-slot>
        </x-tooltip>
        <x-tooltip color="#FFFFFF" displayIcon="{{ false }}">
            <x-slot:message>
                <h3 class="px-6 py-4 font-text text-base font-bold bg-blue text-white text-center w-full">GPBL Consulting</h3>
                <div class="px-6 py-4 text-black leading-6">
                    <img src="{{ asset('img/illustrations/check.svg')}}" class="mr-1 inline-block align-middle" width="20" height="20" alt="Illustration picto check" title="Check"/> Évolutions techniques
                    <br/>
                    <img src="{{ asset('img/illustrations/check.svg')}}" class="mr-1 inline-block align-middle" width="20" height="20" alt="Illustration picto check" title="Check"/> Plateforme PHP native
                </div>
            </x-slot>
            <x-slot:content>
                <img src="{{ asset('img/references/gpbl.png') }}" class="w-full max-h-12 mx-auto" width="138" height="30" alt="C" title="Mediaffiliation" loading="lazy"/>
            </x-slot>
        </x-tooltip>
    </div>     
</div>
