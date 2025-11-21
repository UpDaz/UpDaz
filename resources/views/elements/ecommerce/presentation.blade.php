<section id="presentation" class="pt-24 -mt-24">
    <div class="container flex flex-col mx-auto">
        <div class="flex flex-col items-center gap-8 mt-10 md:gap-16 sm:flex-row sm:items-start">
            <div class="border-b border-gray sm:pl-8 sm:pb-8 md:pl-16 md:pb-16 sm:border-l sm:mt-0 sm:text-left">
                <div class="flex flex-row-reverse items-center gap-8 sm:flex-row">
                    <p class="text-3xl font-bold font-title md:text-3xl"><span class="text-yellow">Lunar</span>
                        qu'est-ce que c'est ?</p>
                    <div class="self-end w-12">
                        @include('elements.icon.question-mark')
                    </div>
                </div>
                <p class="my-4 leading-relaxed text-md">
                    <a target="_blank" href="https://lunarphp.com/" class="underline">Lunar</a> est un moteur e-commerce conçu pour les développeurs, offrant une base technique robuste pour
                    créer des boutiques en ligne sur-mesure.
                    Construit pour s’intégrer nativement à <a class="underline" href="{{ route('laravel') }}">Laravel</a>, il fournit un ensemble de composants spécialisés
                    pour gérer produits, variations, stocks, tarifs, commandes et parcours d’achat.
                    <br /><br />
                    Organisé autour d’une architecture flexible, Lunar sépare clairement la logique métier, l’interface
                    et les données, ce qui permet de développer des plateformes fiables, performantes et adaptées aux
                    besoins spécifiques d’un projet.
                    La structure interne facilite l’ajout de fonctionnalités avancées, l’évolution progressive du
                    catalogue et l’intégration avec des outils tiers.
                    <br /><br />
                    L’écosystème de Lunar inclut un panneau d’administration complet, un moteur de pricing extensible,
                    un système de gestion des canaux de vente et des outils pour connecter des services externes
                    (paiements, ERP, CRM).
                    Le résultat est une base e-commerce maîtrisable de bout en bout, offrant une liberté totale dans la
                    conception, l’expérience utilisateur et la logique commerciale.
                </p>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    document.addEventListener('alpine:init', () => {
        Alpine.data('presentation', () => ({
            scrollToTarget: function(target) {
                window.scrollTo({
                    top: document.querySelector(target).offsetTop,
                    left: 0,
                    behavior: 'smooth'
                });
            }
        }))
    })
</script>
