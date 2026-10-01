<section id="accompagnement" class="pt-24 -mt-24">
    <div class="container flex flex-col gap-8 mx-auto md:gap-16">
        <h2 class="text-3xl text-center sm:text-4xl">Mon accompagnement,<br />pour votre site e-commerce</h2>
        <p class="text-center">Un seul interlocuteur, du premier échange à la maintenance de votre boutique.<br />Chez UpDaz, je vous aide à :</p>
        <div class="grid grid-cols-1 md:gap-x-8 md:gap-y-16 md:grid-cols-3">
            <x-skills.box>
                <x-slot:icon>
                    @include('elements.icon.view-search')
                </x-slot:icon>
                <x-slot:title>
                    <h3 class="text-base">Cadrer votre catalogue, vos tarifs et vos règles de vente</h3>
                </x-slot:title>
            </x-skills.box>

            <x-skills.box>
                <x-slot:icon>
                    @include('elements.icon.pencil')
                </x-slot:icon>
                <x-slot:title>
                    <h3 class="text-base">Concevoir un tunnel de commande qui convertit le visiteur en client</h3>
                </x-slot:title>
            </x-skills.box>

            <x-skills.box>
                <x-slot:icon>
                    @include('elements.icon.hand-tag')
                </x-slot:icon>
                <x-slot:title>
                    <h3 class="text-base">Installer le paiement et les modes de livraison adaptés</h3>
                </x-slot:title>
            </x-skills.box>

            <x-skills.box>
                <x-slot:icon>
                    @include('elements.icon.database')
                </x-slot:icon>
                <x-slot:title>
                    <h3 class="text-base">Connecter votre logistique, vos transporteurs et votre emailing</h3>
                </x-slot:title>
            </x-skills.box>

            <x-skills.box>
                <x-slot:icon>
                    @include('elements.icon.view-dot-com')
                </x-slot:icon>
                <x-slot:title>
                    <h3 class="text-base">Optimiser le référencement (SEO) et les performances de la boutique</h3>
                </x-slot:title>
            </x-skills.box>

            <x-skills.box>
                <x-slot:icon>
                    @include('elements.icon.calendar')
                </x-slot:icon>
                <x-slot:title>
                    <h3 class="text-base">Mettre en ligne, maintenir et faire évoluer votre boutique</h3>
                </x-slot:title>
            </x-skills.box>
        </div>
    </div>
</section>
