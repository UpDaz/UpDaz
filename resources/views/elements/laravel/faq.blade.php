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
                <x-accordion.item title="Qu’est-ce qu’une application web sur-mesure développée avec Laravel ?">
                    Application conçue spécifiquement pour un besoin métier précis, construite avec le framework
                    Laravel. Architecture personnalisée, logique métier dédiée, performances et évolutivité maîtrisées.
                </x-accordion.item>
                <x-accordion.item title="Pourquoi choisir Laravel pour créer une application web professionnelle ?">
                    Framework structuré, sécurisé, maintenable. Outils intégrés pour les API, files d’attente, tests
                    automatisés, authentification, gestion des données. Standard industriel reconnu.
                </x-accordion.item>
                <x-accordion.item title="Quels types d’applications peut-on développer avec Laravel ?">
                    Portails métier, CRM, ERP légers, plateformes collaboratives, extranets, solutions internes, API,
                    back-office pour applications mobiles, systèmes de réservation, outils de gestion.
                </x-accordion.item>
                <x-accordion.item
                    title="Quels sont les avantages d’une application web sur-mesure par rapport à un outil SaaS ?">
                    Aucun verrou fonctionnel, pas de limite d’usage, propriété totale du code, intégrations libres,
                    absence d’abonnements cumulés, évolutions sans contraintes imposées par un tiers.
                </x-accordion.item>
                <x-accordion.item
                    title="Comment se déroule un projet de développement d’application web avec Laravel ?">
                    Analyse du besoin, définition de l’architecture, conception des interfaces, développement des
                    fonctionnalités, tests, déploiement, suivi post-lancement. Processus itératif contrôlé.
                </x-accordion.item>
                <x-accordion.item title="Laravel est-il adapté pour des projets complexes et évolutifs ?">
                    Oui.<br/>Son écosystème (queues, events, jobs, caching, modules) permet d’absorber la complexité,
                    d’étendre progressivement et de maintenir un code propre malgré la croissance du projet.
                </x-accordion.item>
                <x-accordion.item
                    title="Quels sont les coûts à prévoir pour développer une application web sur-mesure en Laravel ?">
                    Coût dépendant du périmètre fonctionnel, du volume d’écrans, des intégrations externes et des
                    contraintes de sécurité. Investissement initial puis éventuellement maintenance évolutive.
                </x-accordion.item>
                <x-accordion.item title="Comment assurer la sécurité d’une application web Laravel ?">
                    Utilisation native des protections CSRF, hashing, validation stricte des données, gestion robuste de
                    l’authentification, logs, permissions, surveillance serveur et mises à jour régulières.
                </x-accordion.item>
                <x-accordion.item title="Une application Laravel peut-elle s’intégrer à des services externes ?">
                    Oui.<br/>Intégration API REST, GraphQL, webhooks, passerelles de paiement, CRM, ERP, services tiers.
                    Laravel propose une structure adaptée aux échanges inter-systèmes.
                </x-accordion.item>
                <x-accordion.item
                    title="Combien de temps faut-il pour concevoir et déployer une application web sur-mesure avec Laravel ?">
                    Durée variant selon la complexité. Quelques semaines pour un outil simple, plusieurs mois pour une
                    plateforme complète. Le rythme dépend du périmètre et de la cadence décisionnelle.
                </x-accordion.item>
            </div>
        </div>
    </div>
</section>
