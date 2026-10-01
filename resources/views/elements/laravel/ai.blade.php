<section id="integration-ia" class="-mt-24 pt-24">
    <div class="container mx-auto flex flex-col">
        <div class="flex flex-col items-center gap-8 sm:flex-row sm:items-start md:gap-16">
            <div class="border-gray border-t sm:border-r pt-8 sm:pr-8 sm:text-left md:pt-16 md:pr-16">
                <div class="flex items-center gap-8">
                    <div class="*:w-12 *:h-auto">
                        @include('elements.icon.light')
                    </div>
                    <h2>Intégrer l’<span class="text-yellow">intelligence artificielle</span> à votre application</h2>
                </div>
                <p class="text-md my-4 leading-relaxed">
                    Une application métier est le bon endroit pour mettre l’IA au travail : elle connaît vos
                    données, vos règles et vos utilisateurs. J’intègre des agents IA là où ils font gagner du
                    temps, en gardant un humain aux commandes :
                </p>
                <ul class="text-md my-4 flex list-disc flex-col gap-2 pl-6 leading-relaxed">
                    <li>
                        <b>Automatiser les tâches répétitives</b> : tri de demandes, saisie, rédaction de
                        brouillons, relances.
                    </li>
                    <li>
                        <b>Exploiter vos documents</b> : synthèse, extraction d’informations et recherche dans
                        vos contenus internes.
                    </li>
                    <li>
                        <b>Assister vos équipes</b> : un assistant intégré à votre outil, qui répond à partir de
                        vos propres données.
                    </li>
                    <li>
                        <b>Garder la main</b> : validation humaine avant toute action sensible, choix du
                        fournisseur de modèle et suivi des coûts à l’usage.
                    </li>
                </ul>
                <p class="text-md my-4 leading-relaxed">
                    Je l’applique d’abord à mon propre outil : le blog de ce site s’appuie sur des agents IA
                    développés avec Laravel, qui assurent la veille des sources, proposent des sujets et rédigent
                    des brouillons, que je valide avant publication. Retrouvez mes retours dans les
                    <a href="{{ route('category', ['slug' => 'intelligence-artificielle']) }}" class="underline">articles
                        sur l’intelligence artificielle</a>.
                </p>
                <p class="text-md my-4 leading-relaxed">
                    J’utilise aussi l’IA pour développer : elle accélère l’écriture du code et des tests, et
                    chaque ligne livrée reste relue, testée et assumée par un développeur expérimenté.
                </p>
            </div>
        </div>
    </div>
</section>
