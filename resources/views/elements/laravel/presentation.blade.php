<section id="presentation" class="-mt-24 pt-24">
    <div class="container mx-auto flex flex-col">
        <div class="mt-10 flex flex-col items-center gap-8 sm:flex-row sm:items-start md:gap-16">
            <div class="border-gray border-b sm:mt-0 sm:border-l sm:pb-8 sm:pl-8 sm:text-left md:pb-16 md:pl-16">
                <div class="flex flex-row-reverse items-center gap-8 sm:flex-row">
                    <div class="w-24 sm:w-12">
                        @include('elements.icon.question-mark')
                    </div>
                    <h2>Pourquoi choisir <span class="text-yellow">Laravel</span> pour votre application métier ?</h2>
                </div>
                <p class="text-md my-4 leading-relaxed">
                    <a target="_blank" href="https://laravel.com/" class="underline">Laravel</a> est le framework PHP
                    le plus utilisé pour développer des applications web professionnelles. Pour vous, cela se traduit
                    par des bénéfices concrets :
                </p>
                <ul class="text-md my-4 flex list-disc flex-col gap-2 pl-6 leading-relaxed">
                    <li>
                        <b>Une application qui colle à votre métier</b> : pas de fonctionnalités imposées ni de
                        contournements, chaque écran et chaque règle de gestion est conçu pour vos processus.
                    </li>
                    <li>
                        <b>Un code qui vous appartient</b> : pas d’abonnement par utilisateur ni de dépendance à un
                        éditeur SaaS, vous restez propriétaire de votre outil.
                    </li>
                    <li>
                        <b>Une base fiable et sécurisée</b> : protections natives (CSRF, injections SQL, hachage des
                        mots de passe), tests automatisés et mises à jour régulières du framework.
                    </li>
                    <li>
                        <b>Un projet qui peut grandir</b> : files d’attente, tâches planifiées, cache et API
                        permettent d’ajouter des fonctionnalités et d’absorber la montée en charge sans tout réécrire.
                    </li>
                    <li>
                        <b>Un écosystème reconnu</b> : une large communauté de développeurs, ce qui facilite la
                        reprise ou le renfort de votre projet à long terme.
                    </li>
                </ul>
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
