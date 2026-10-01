<section id="etude-de-cas" class="-mt-24 pt-24">
    <div class="container mx-auto flex flex-col gap-8 md:gap-16">
        <div class="flex flex-col gap-4 text-center">
            <h2>Étude de cas :<br />la boutique en ligne <span class="text-yellow">PadelReference</span></h2>
            <p>
                <a href="https://www.padelreference.com/fr/" target="_blank" class="underline" title="PadelReference">PadelReference</a>,
                spécialiste de l’équipement de padel, vendait sur un Prestashop qui n’était plus maintenu ni mis à
                jour. Je les accompagne depuis plus de 4 ans.
            </p>
        </div>

        <dl class="grid grid-cols-1 gap-8 text-center sm:grid-cols-3 lg:grid-cols-5">
            <x-reference style="flex items-center">
                <div class="flex flex-col items-center justify-center gap-2">
                    <dd class="font-title text-yellow order-1 text-3xl font-bold">×6</dd>
                    <dt class="order-2">sur le nombre commandes par jour</dt>
                </div>
            </x-reference>
            <x-reference style="flex items-center">
                <div class="flex flex-col items-center justify-center gap-2">
                    <dd class="font-title text-yellow order-1 text-3xl font-bold">2024</dd>
                    <dt class="order-2">mise en ligne de la nouvelle boutique</dt>
                </div>
            </x-reference>
            <x-reference style="flex items-center">
                <div class="flex flex-col items-center justify-center gap-2">
                    <dd class="font-title text-yellow order-1 text-3xl font-bold">Monde</dd>
                    <dt class="order-2">boutique multilingue, avec expédition à l’international</dt>
                </div>
            </x-reference>
            @if($caseStudyReview)
                <div class="sm:col-span-3 lg:col-span-2">
                    <x-review :name="$caseStudyReview->name" :source="$caseStudyReview->platform->value" :date="$caseStudyReview->formattedDate()" :rating="$caseStudyReview->rating">
                        {!! nl2br(e($caseStudyReview->content)) !!}
                    </x-review>
                </div>
            @endif
        </dl>

        <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
            <div class="flex flex-col gap-4">
                <h3 class="text-lg text-yellow">Le besoin</h3>
                <div data-element="line-horizontal" class="-translate-x-1/12 bg-linear-to-r via-gray h-px w-[75%] from-transparent to-transparent"></div>
                <ul class="flex list-disc flex-col gap-2 pl-5">
                    <li>Remplacer un Prestashop resté sans évolution ni maintenance</li>
                    <li>Une plateforme capable de suivre l’évolution de l’activité</li>
                    <li>Augmenter le nombre de ventes</li>
                    <li>Un catalogue de plusieurs milliers de produits, en plusieurs langues</li>
                </ul>
            </div>
            <div class="flex flex-col gap-4">
                <h3 class="text-lg text-yellow">La solution</h3>
                <div data-element="line-horizontal" class="-translate-x-1/12 bg-linear-to-r via-gray h-px w-[75%] from-transparent to-transparent"></div>
                <ul class="flex list-disc flex-col gap-2 pl-5">
                    <li>Une boutique sur mesure avec Laravel et Lunar</li>
                    <li>Un parcours de commande dédié aux professionnels (B2B) et la gestion des clubs</li>
                    <li>La gestion de l’inventaire, des stocks et des commandes passées en magasin</li>
                    <li>Un système de choix du poids de la raquette au moment de l’achat</li>
                    <li>La connexion à la logistique, aux transporteurs et à l’emailing</li>
                </ul>
            </div>
            <div class="flex flex-col gap-4">
                <h3 class="text-lg text-yellow">Le suivi</h3>
                <div data-element="line-horizontal" class="-translate-x-1/12 bg-linear-to-r via-gray h-px w-[75%] from-transparent to-transparent"></div>
                <ul class="flex list-disc flex-col gap-2 pl-5">
                    <li>Suivi et maintenance applicative au quotidien</li>
                    <li>Hébergement et DevOps assurés par ZakaServices, dans l’agglomération bordelaise</li>
                    <li>Des évolutions livrées en continu, au rythme de l’activité</li>
                </ul>
            </div>
        </div>

        <div class="mx-auto flex w-full justify-center gap-8">
            <div class="flex justify-center">
                <x-button.primary href="#contact" title="Discuter de votre projet de site e-commerce sur mesure">
                    Un projet similaire&nbsp;?<br />Parlons-en
                </x-button.primary>
            </div>
        </div>
    </div>
</section>
