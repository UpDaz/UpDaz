<section id="presentation" class="px-8 py-4 md:px-16 md:py-0 md:pt-24">
    <div class="container flex flex-col mx-auto">
        <div class="mx-auto lg:w-4/6">
            <div class="flex flex-col mt-10 sm:flex-row">
                <div class="sm:w-1/3 sm:pr-8 sm:py-8">
                    <div class="sticky inline-flex items-center justify-center rounded-full w-100 top-32">
                        <img class="object-cover object-center rounded" alt="hero"
                            src="{{ asset('img/profile.jpg') }}" load="lazy">
                    </div>
                </div>
                <div
                    class="pt-4 mt-4 border-t border-gray-200 sm:w-2/3 sm:pl-8 sm:py-8 sm:border-l sm:border-t-0 sm:mt-0 sm:text-left">
                    <p class="mb-2 text-2xl text-black font-title bold md:text-3xl">Bienvenue chez UpDaz !</p>
                    <div class="w-20 h-1 rounded bg-blue"></div>
                    <p class="my-4 leading-relaxed text-md">
                        Je m'appelle <b>Matthieu</b>, je suis <b>développeur full-stack</b> depuis 8 ans sur la région
                        bordelaise.<br /><br />
                        J’ai eu la chance de concevoir de nombreuses plateformes web de par mon parcours : landing
                        pages, sites
                        vitrines, boutiques en ligne, plateformes sur-mesure…<br />
                        Après plusieurs années en agence de communication et en entreprises spécialisées, j'ai développé
                        un
                        <span class="font-bold">savoir-faire technique</span> et <b>une expertise</b> dans les
                        technologies du web.
                        <br /><br />
                        Face à la multitude de possibilités et d'options proposées pour la <b>conception d'un site
                            web</b>, je vous
                        accompagne dans votre projet afin de <b>trouver les meilleures solutions</b> à vos différentes
                        problématiques.
                        <br /><br />
                        <a href="#services" @click.prevent="scrollToTarget('#services')"
                            class="block px-6 py-3 mt-4 mb-4 font-medium text-center text-white rounded shadow-md md:mr-4 md: md:inline-block bg-gradient-to-br hover:bg-gradient-to-r from-blue-dark to-blue"
                            title="Mes services">
                            Mes services
                        </a>
                        <a href="#references" @click.prevent="scrollToTarget('#references')"
                            class="block px-6 py-3 mt-4 mb-4 font-medium text-center text-white rounded shadow-md md:mr-4 md:inline-block bg-gradient-to-br hover:bg-gradient-to-r from-blue-dark to-blue"
                            title="Les références UpDaz ?">
                            Mes Références
                        </a>
                        <a href="#contact" @click.prevent="scrollToTarget('#contact')"
                            class="block px-6 py-3 mt-4 font-medium text-center text-white rounded shadow-md md:inline-block bg-orange hover:bg-blue-dark"
                            title="Contact : on en discuter ?">
                            On en discute ?
                        </a>
                    </p>
                </div>
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
