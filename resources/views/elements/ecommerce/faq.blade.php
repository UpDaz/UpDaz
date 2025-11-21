<section id="articles" class="pt-24 -mt-24">
    <div class="container mx-auto">
        <div class="flex flex-col w-full max-w-xl gap-8 mx-auto mb-8 md:gap-16 md:mb-16">
            <div class="flex flex-col-reverse items-center justify-center gap-8 md:flex-row">
                <h2 class="text-3xl text-center sm:text-4xl">Questions fréquentes</h2>
                <div class="w-16">
                    @include('elements.icon.question-mark')
                </div>
            </div>
            <div>
                <x-accordion.item title="Qu’est-ce que Lunar pour Laravel ?">
                    Lunar est un moteur e-commerce conçu pour s’intégrer nativement à Laravel. Il fournit une base
                    technique complète pour gérer produits, commandes, stocks, variations et pricing, tout en laissant
                    une liberté totale dans la structure du code et la logique métier.
                </x-accordion.item>
                <x-accordion.item title="Pourquoi choisir Lunar plutôt que Prestashop ou Shopify ?">
                    Lunar évite les limites des plateformes préconstruites : aucune dépendance à des modules lourds, pas
                    de contraintes d’abonnement ou de commissions, et aucune structure figée. Il offre un environnement
                    totalement personnalisable, idéal pour les projets e-commerce nécessitant des fonctionnalités
                    spécifiques ou une logique avancée.
                </x-accordion.item>
                <x-accordion.item title="Lunar permet-il de créer des catalogues complexes ?">
                    Lunar gère nativement les variantes, les attributs personnalisés, les logiques de prix
                    conditionnelles et les catalogues multi-canaux. Il s’adapte aux bases produits atypiques et aux
                    structures complexes que les CMS classiques ont du mal à supporter.
                </x-accordion.item>
                <x-accordion.item title="Lunar est-il adapté aux fortes charges ?">
                    Grâce à l’écosystème Laravel, Lunar bénéficie d’un environnement optimisé pour la performance :
                    cache, files de traitement, optimisation serveur et séparation des processus. Cette architecture
                    permet d’absorber des volumes importants de trafic et de commandes.
                </x-accordion.item>
                <x-accordion.item title="Peut-on intégrer Lunar à un ERP, un CRM ou des services externes ?">
                    Lunar repose sur les standards Laravel, ce qui facilite les connexions API, webhooks,
                    synchronisations programmées et intégrations sur mesure. Il s’intègre efficacement à des outils
                    internes ou à des solutions tierces.
                </x-accordion.item>
                <x-accordion.item title="Lunar propose-t-il un tableau d’administration ?">
                    Lunar inclut une interface d’administration dédiée permettant de gérer le catalogue produits, les
                    stocks, les commandes, les clients et les paramètres du site. Cette interface simplifie la gestion
                    opérationnelle sans limiter les possibilités de développement.
                </x-accordion.item>
                <x-accordion.item title="Lunar gère-t-il les paiements et les taxes ?">
                    Lunar propose des intégrations natives avec Stripe et d’autres passerelles de paiement, ainsi qu’un
                    système flexible pour définir les règles fiscales et les logiques de pricing. Il s’adapte aux
                    configurations commerciales simples ou avancées.
                </x-accordion.item>
                <x-accordion.item title="Comment se déroule un projet e-commerce avec Lunar ?">
                    Un projet démarre par la définition du modèle de données et du catalogue, suivie du développement du
                    front-end, de l’intégration des services externes et de la configuration des workflows métier. Le
                    processus se termine par les tests et le déploiement.
                </x-accordion.item>
                <x-accordion.item title="Quels sont les coûts liés à l’utilisation de Lunar ?">
                    Lunar ne nécessite aucun abonnement propriétaire. Les coûts concernent uniquement le développement
                    sur mesure, l’hébergement et les services externes choisis pour le paiement ou la gestion des
                    données.
                </x-accordion.item>
                <x-accordion.item title="Peut-on migrer un site e-commerce existant vers Lunar ?">
                    La migration est possible en reprenant le catalogue, les clients et les commandes, puis en
                    reconstruisant les flux métier et les intégrations. Lunar permet de repartir sur une base technique
                    moderne tout en conservant les données essentielles.
                </x-accordion.item>
            </div>
        </div>
    </div>
</section>
