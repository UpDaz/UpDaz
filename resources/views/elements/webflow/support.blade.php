<section id="accompagnement" class="pt-24 -mt-24">
    <div class="container flex flex-col gap-8 mx-auto md:gap-16">
        <h2 class="text-3xl text-center sm:text-4xl">Mon accompagnement,<br/>de la conception à la mise en ligne</h2>
        <p class="text-center">Webflow rend la création de sites plus accessible, mais obtenir un résultat professionnel demande méthode et expertise.<br/>Chez UpDaz, je vous aide à :</p>
        <div class="grid grid-cols-1 gap-16 md:gap-x-8 md:gap-y-16 md:grid-cols-2">


            

            <x-skills.box>
                <x-slot:icon>
                    @include('elements.icon.view-dot-com')
                </x-slot:icon>
                <x-slot:title>
                    <h3 class="text-lg font-medium title-font">Définir une structure claire et cohérente</h3>
                </x-slot:title>
            </x-skills.box>

            <x-skills.box>
                <x-slot:icon>
                    @include('elements.icon.view-search')
                </x-slot:icon>
                <x-slot:title>
                    <h3 class="text-lg font-medium title-font">Optimiser le référencement (SEO) et les performances</h3>
                </x-slot:title>
            </x-skills.box>

            <x-skills.box>
                <x-slot:icon>
                    @include('elements.icon.pencil')
                </x-slot:icon>
                <x-slot:title>
                    <h3 class="text-lg font-medium title-font">Concevoir une interface fluide et engageante</h3>
                </x-slot:title>
            </x-skills.box>

            <x-skills.box>
                <x-slot:icon>
                    @include('elements.icon.hand-tag')
                </x-slot:icon>
                <x-slot:title>
                    <h3 class="text-lg font-medium title-font">Vous former à la prise en main du CMS</h3>
                </x-slot:title>
            </x-skills.box>
        </div>
    </div>
</section>
