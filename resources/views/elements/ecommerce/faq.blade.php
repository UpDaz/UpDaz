@php
    $questions = [
        'Combien coûte un site e-commerce sur mesure ?' =>
            'Le budget dépend du catalogue, du parcours de commande et des intégrations attendues : chaque projet fait l’objet d’un devis. Une fois la boutique en ligne, les coûts se limitent à l’hébergement, à la maintenance et aux frais du prestataire de paiement choisi, sans abonnement à une plateforme ni commission sur les ventes.',
        'Pourquoi choisir le sur mesure plutôt que Shopify ou Prestashop ?' =>
            'Shopify est un service américain par abonnement dont le coût augmente avec les ventes : abonnement, commissions sur les transactions, applications payantes. Prestashop repose sur des modules tiers qu’il faut maintenir et faire cohabiter. Une boutique sur mesure vous appartient, son coût reste prévisible et elle s’adapte à votre fonctionnement.',
        'Le sur mesure convient-il à une petite boutique ?' =>
            'Oui. Lunar fournit le catalogue, les commandes, les stocks et l’administration : une petite boutique peut être mise en ligne sans développer tout de zéro, puis évoluer au rythme de l’activité.',
        'Qui est propriétaire du site et des données ?' =>
            'Vous. Le code de la boutique vous appartient, sans verrou propriétaire, et vos données clients et commandes restent sous votre contrôle. Vous pouvez changer de prestataire ou d’hébergeur à tout moment.',
        'Où est hébergée ma boutique en ligne ?' =>
            'Dans l’agglomération bordelaise, chez ZakaServices, qui assure l’hébergement et l’exploitation des serveurs. J’assure de mon côté la maintenance applicative de la boutique.',
        'Quels moyens de paiement peut-on proposer ?' =>
            'N’importe quel prestataire de paiement peut être installé. Vous choisissez celui dont les frais et les moyens de paiement conviennent le mieux à votre activité, et vous pouvez en changer.',
        'Peut-on migrer une boutique Prestashop ou Shopify existante ?' =>
            'Oui. La migration reprend le catalogue, les clients et l’historique de commandes, reconstruit le parcours d’achat et les intégrations, puis redirige les anciennes adresses pour préserver le référencement.',
        'Qu’est-ce que Lunar pour Laravel ?' =>
            'Lunar est un moteur e-commerce libre conçu pour s’intégrer à Laravel. Il fournit une base complète pour gérer produits, variantes, stocks, prix et commandes, tout en laissant une liberté totale sur le code et la logique métier.',
        'Peut-on connecter la boutique à un ERP, un CRM ou à la logistique ?' =>
            'Oui. Lunar repose sur les standards Laravel, ce qui facilite les connexions par API, les webhooks et les synchronisations programmées avec vos outils internes, vos transporteurs ou votre solution d’emailing.',
        'Comment se déroule un projet e-commerce sur mesure ?' =>
            'Le projet démarre par le cadrage du catalogue et des règles de vente, se poursuit par le développement du parcours d’achat et des intégrations, puis par les tests et la mise en ligne. La maintenance et les évolutions prennent ensuite le relais.',
    ];
@endphp

<section id="faq" class="pt-24 -mt-24">
    <div class="container mx-auto">
        <div class="flex flex-col w-full max-w-4xl gap-8 mx-auto mb-8 md:gap-16 md:mb-16">
            <div class="flex items-center justify-center gap-8">
                <div class="*:w-12 *:h-auto">
                    @include('elements.icon.question-mark')
                </div>
                <h2>Questions fréquentes sur le e-commerce sur mesure</h2>
            </div>
            <div>
                @foreach ($questions as $question => $answer)
                    <x-accordion.item :title="$question">
                        {{ $answer }}
                    </x-accordion.item>
                @endforeach
            </div>
        </div>
    </div>
</section>

@push('structured-data')
    @include('elements.schema.faq', ['questions' => $questions])
@endpush
