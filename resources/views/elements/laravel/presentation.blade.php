<section id="presentation" class="pt-24 -mt-24">
    <div class="container flex flex-col mx-auto">
        <div class="flex flex-col items-center gap-8 mt-10 md:gap-16 sm:flex-row sm:items-start">
            <div class="border-b border-gray sm:pl-8 sm:pb-8 md:pl-16 md:pb-16 sm:border-l sm:mt-0 sm:text-left">
                <div class="flex flex-row-reverse items-center gap-8 sm:flex-row">
                    <p class="text-3xl font-bold font-title md:text-3xl"><span class="text-yellow">Laravel</span>
                        qu'est-ce que c'est ?</p>
                    <div class="w-12">
                        @include('elements.icon.question-mark')
                    </div>
                </div>
                <p class="my-4 leading-relaxed text-md">
                    <a target="_blank" href="https://laravel.com/" class="underline">Laravel</a> est un <i>Framework</i>, c'est à dire une boite à outils pour les développeurs, permettant
                    la conception techniques de sites et d’applications web.
                    <br /><br />
                    Basé sur le langage de programmation PHP, il met à la disposition des développeurs un ensemble de
                    composants
                    <b>facilement utilisables et évolutifs</b> afin de construire des <b>applications complexes et
                        autonomes</b>.
                </p>
                <p class="my-4 leading-relaxed text-md">
                    Reposant sur un modèle d’architecture <i>MVC</i> (Modèle-Vue-Controller : séparation logique entre
                    les données, le design et les processus métier), les projets conçus avec Laravel se caractérisent
                    par leur fiabilité, leur <i>scalabilité</i> (conçu pour évoluer facilement) et leur performance.
                <br/><br/>
                    Laravel propose tout un <b>écosystème d’outils et de services</b> facilitant le développement et le
                    fonctionnement de votre projet (on peut par exemple citer “Vapor” pour gérer la mise en ligne de
                    votre
                    projet,
                    “Nova” pour ajouter un tableau d’administration ou encore ”Cashier” pour ajouter un système de
                    facturation).
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
