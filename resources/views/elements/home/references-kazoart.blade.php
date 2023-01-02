<div class="md:w-1/2 bg-orange px-8 md:px-16 py-16 md:py-24">
    <div class="container md:container-none">
        <h2 class="text-white text-3xl mb-10">
            Mon travail dans l'équipe de 
            <span class="whitespace-nowrap">
                <a href="http://kazoart.com/" target="_blank" class="text-blue" title="KAZoART" loading="lazy">KAZOART</a>
            </span>
        </h2>
        <div class="grid grid-cols-2 lg:grid-cols-3 gap-12 items-center">

            <x-tooltip color="#FFFFFF" displayIcon="{{ false }}">
                <x-slot:message>
                    <h3 class="px-6 py-4 font-text text-base font-bold bg-blue-dark text-white text-center w-full">Blooming Ladies</h3>
                    
                    <div class="px-6 py-4 text-black leading-8">
                        <img src="{{ asset('img/illustrations/check.svg')}}" class="mr-1 inline-block align-middle" width="20" height="20" alt="Illustration picto check" title="Check"/> Sur-mesure
                        <br/>
                        <img src="{{ asset('img/illustrations/check.svg')}}" class="mr-1 inline-block align-middle" width="20" height="20" alt="Illustration picto check" title="Check"/> Laravel
                        <br/>
                        <img src="{{ asset('img/illustrations/check.svg')}}" class="mr-1 inline-block align-middle" width="20" height="20" alt="Illustration picto check" title="Check"/> Vitrine
                    </div>
                </x-slot>
                <x-slot:content>
                    <a href="https://www.bloomingladies.art/" target="_blank" title="Blooming Ladies">
                        <img src="{{ asset('img/references/blooming-ladies.svg') }}" class="w-full max-h-12 mx-auto" width="138" height="46" alt="Blooming Ladies" title="Blooming Ladies" loading="lazy"/>
                    </a>
                </x-slot>
            </x-tooltip>

            <x-tooltip color="#FFFFFF" displayIcon="{{ false }}">
                <x-slot:message>
                    <h3 class="px-6 py-4 font-text text-base font-bold bg-blue-dark text-white text-center w-full">KAZoART Pro</h3>
                    
                    <div class="px-6 py-4 text-black leading-8">
                        <img src="{{ asset('img/illustrations/check.svg')}}" class="mr-1 inline-block align-middle" width="20" height="20" alt="Illustration picto check" title="Check"/> Sur-mesure
                        <br/>
                        <img src="{{ asset('img/illustrations/check.svg')}}" class="mr-1 inline-block align-middle" width="20" height="20" alt="Illustration picto check" title="Check"/> Laravel
                        <br/>
                        <img src="{{ asset('img/illustrations/check.svg')}}" class="mr-1 inline-block align-middle" width="20" height="20" alt="Illustration picto check" title="Check"/> Vitrine
                    </div>
                </x-slot>
                <x-slot:content>
                    <a href="https://pro.kazoart.com/fr/" target="_blank" title="KAZoART Pro">
                        <img src="{{ asset('img/references/kazoart-pro.svg') }}" class="w-full max-h-12 mx-auto" width="138" height="18" alt="KAZoART Pro" title="KAZoART Pro" loading="lazy"/>
                    </a>
                </x-slot>
            </x-tooltip>
        </div>
    </div>
</div>
