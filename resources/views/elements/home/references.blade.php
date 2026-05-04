<section id="references" class="pt-24 -mt-24">
    <div class="container flex flex-col gap-16 mx-auto">
        <div class="flex flex-col items-center justify-center gap-4 sm:gap-8 sm:flex-row">
            <div class="w-18 md:w-12">
                @include('elements.icon.users-check')
            </div>
            <h2 class="text-3xl text-center sm:text-4xl">Une confiance gagnante</h2>
        </div>
        <div class="flex flex-col gap-4">
            <h3 class="text-lg">Des retours qui parlent d'eux-mêmes</h3>
            <div class="flex gap-8 overflow-y-visible -ml-6 p-6 -mt-6 overflow-x-auto no-scrollbar *:w-90 lg:*:w-80 *:shrink-0">
              <x-review name="Linda R" source="google" date="nov. 2025" :rating="5">
                    Nous avons fait appel à Matthieu pour le développement web de notre activité, et nous sommes
                    pleinement satisfaits !<br />
                    Professionnel, réactif, à l'écoute, et toujours dans une belle synergie avec nos autres
                    prestataires.<br />
                    Un partenaire fiable et agréable avec qui nous continuerons à collaborer sans hésitation.<br />
                    Merci Matthieu !
                </x-review>
                <x-review name="Amélie D." source="google" date="sept. 2025" :rating="5">
                    J'ai fait confiance à la société Updaz pour la réalisation de mon site internet professionnel, je
                    suis très satisfaite autant pour l'accompagnement, la clarté et la rapidité des échanges que pour la
                    réalisation en elle-même. Merci pour la réactivité, le professionnalisme et la qualité du travail de
                    Matthieu !
                </x-review>
                <x-review name="David" source="google" date="sept. 2025" :rating="5">
                    Matthieu m'accompagné sur une réalisation d'un site web.<br />
                    Disponibilité, écoute et réactivité.<br />
                    Je recommande.
                </x-review>
                <x-review name="Remy G." source="google" date="juil. 2025" :rating="5">
                    Nous sommes ravis d'un super travail avec Matthieu, professionnel, disponible et compétent.<br/>
                    Merci !
                </x-review>
                <x-review name="Carla" source="malt" date="juin. 2023" :rating="5">
                    Mission réalisée efficacement pour un prix très abordable. Le travail a été fait très rapidement et j'ai pu faire de nombreux retours sur lesquels Mathieu a retravaillé. Je recommande
                </x-review>
            </div>
        </div>
        <div class="flex flex-col gap-4">
            <h3 class="text-lg">Projets travaillés par UpDaz</h3>
            <div class="grid grid-cols-2 items-center gap-8 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @include('elements.home.references-updaz')
            </div>
        </div>
    </div>
</section>
