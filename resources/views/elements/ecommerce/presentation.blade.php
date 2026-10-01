<section id="presentation" class="pt-24 -mt-24">
    <div class="container flex flex-col mx-auto">
        <div class="flex flex-col items-center gap-8 mt-10 md:gap-16 sm:flex-row sm:items-start">
            <div class="border-b border-gray sm:pl-8 sm:pb-8 md:pl-16 md:pb-16 sm:border-l sm:mt-0 sm:text-left">
                <div class="flex items-center gap-8">
                    <div class="*:w-12 *:h-auto">
                        @include('elements.icon.programming')
                    </div>
                    <h2>Une boutique construite avec Laravel et <span class="text-yellow">Lunar</span></h2>
                </div>
                <p class="my-4 leading-relaxed text-md">
                    <a target="_blank" href="https://lunarphp.com/" class="underline">Lunar</a> est un moteur
                    e-commerce libre qui s’intègre à <a class="underline" href="{{ route('laravel') }}">Laravel</a>.
                    Il apporte les briques dont toute boutique a besoin, et laisse le reste entièrement
                    personnalisable&nbsp;:
                </p>
                <ul class="text-md my-4 flex list-disc flex-col gap-2 pl-6 leading-relaxed">
                    <li><b>Catalogue</b> : gestion des produits, variantes, attributs personnalisés et plusieurs langues.</li>
                    <li><b>Prix</b> : tarifs par groupe de clients, promotions et règles de prix.</li>
                    <li><b>Commandes et stocks</b> : un panneau d’administration pour gérer les commandes et les
                        clients.</li>
                </ul>
                <p class="my-4 leading-relaxed text-md">
                    Une boutique Lunar est avant tout une application Laravel : elle repose sur la même
                    <a class="underline" href="{{ route('laravel') }}#stack">stack technique</a> et bénéficie du même
                    suivi que mes autres projets, de la mise en ligne à la
                    <a class="underline" href="{{ route('laravel') }}#reprise-maintenance">maintenance</a>.
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
