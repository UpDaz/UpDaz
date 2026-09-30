<section id="etude-de-cas" class="-mt-24 pt-24">
    <div class="container mx-auto flex flex-col gap-8 md:gap-16">
        <div class="flex flex-col gap-4 text-center">
            <h2>Étude de cas :<br />maison de ventes aux enchères <span class="text-yellow">Solart</span></h2>
            <p>
                Une maison de ventes aux enchères bordelaise, dirigée par David, commissaire-priseur, nécessitait un site et une présence en ligne pour organiser sa première vente aux enchères.
            </p>
        </div>

        <dl class="grid grid-cols-1 gap-8 text-center sm:grid-cols-3 lg:grid-cols-5">
            <x-reference style="flex items-center">
                <div class="flex flex-col items-center justify-center gap-2">
                    <dd class="font-title text-yellow order-1 text-3xl font-bold">2 mois</dd>
                    <dt class="order-2">de la première réunion à la mise en ligne</dt>
                </div>
            </x-reference>
            <x-reference style="flex items-center">
                <div class="flex flex-col items-center justify-center gap-2">
                    <dd class="font-title text-yellow order-1 text-3xl font-bold">≈ 30</dd>
                    <dt class="order-2">enchérisseurs et acheteurs inscrits en ligne pour la vente</dt>
                </div>
            </x-reference>
            <x-reference style="flex items-center">
                <div class="flex flex-col items-center justify-center gap-2">
                    <dd class="font-title text-yellow order-1 text-3xl font-bold">12</dd>
                    <dt class="order-2">lots mis en avant sur le site avant la vente</dt>
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
                    <li>Être visible sur internet pour préparer la vente aux enchères</li>
                    <li>Un site capable d'évoluer avec l'activité</li>
                    <li>Une interface moderne et épurée, à l'image des biens proposés</li>
                    <li>Une administration simple, utilisable sans être développeur</li>
                </ul>
            </div>
            <div class="flex flex-col gap-4">
                <h3 class="text-lg text-yellow">La solution</h3>
                <div data-element="line-horizontal" class="-translate-x-1/12 bg-linear-to-r via-gray h-px w-[75%] from-transparent to-transparent"></div>
                <ul class="flex list-disc flex-col gap-2 pl-5">
                    <li>Un site sur mesure en stack TALL : Tailwind CSS, Alpine.js, Laravel et Livewire</li>
                    <li>La gestion des ventes aux enchères (lieu, horaires, informations pratiques) et des lots présentés</li>
                    <li>L'inscription en ligne des enchérisseurs et des acheteurs</li>
                    <li>Un back-office Filament limité à l'essentiel : pas d'usine à gaz, une prise en main immédiate</li>
                </ul>
            </div>
            <div class="flex flex-col gap-4">
                <h3 class="text-lg text-yellow">Le suivi</h3>
                <div data-element="line-horizontal" class="-translate-x-1/12 bg-linear-to-r via-gray h-px w-[75%] from-transparent to-transparent"></div>
                <ul class="flex list-disc flex-col gap-2 pl-5">
                    <li>Maintenance et hébergement assurés depuis la mise en ligne</li>
                    <li>Ajout du suivi interne des lots réellement vendus</li>
                    <li>Ajout de la vidéo de présentation de la vente aux enchères</li>
                </ul>
            </div>
        </div>

        <div class="mx-auto flex w-full justify-center gap-8">

            <div class="flex justify-center">
                <x-button.primary href="#contact" title="Discuter de votre projet d'application Laravel">
                    Un projet similaire&nbsp;?<br />Parlons-en
                </x-button.primary>
            </div>
        </div>
    </div>
</section>
