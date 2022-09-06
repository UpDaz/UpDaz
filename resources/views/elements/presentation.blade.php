<div id="presentation" x-data="presentation" class="w-full px-8 md:px-16 relative overflow-hidden">
    <div class="container mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-5 gap-6 items-center relative">
            <div class="md:col-span-2 text-center pt-16 pb-8 md:py-24">
                <div class="block absolute z-1 md:x-auto max-w-none h-[calc(100vh/2)] md:h-full w-[calc(100%+4rem)] md:w-1/2 -left-8 md:-left-16 top-0 rotate-90 md:rotate-0">
                    @include('elements/illustrations/background-profile')
                </div>
                <img class=" block w-60 h-60 rounded-full mx-auto z-10 relative" src="{{ asset('img/profile.jpg') }}" alt="Photo profile" title="Matthieu DAZORD" loading="lazy"/>
            </div>
            <div class="md:col-span-3 z-10 relative pb-16 md:py-24">
                <p class="font-title bold text-3xl text-orange mb-6">Bienvenue !</p>
                <p class="text-gray-800 italic">
                    Je m'appelle <a href="https://fr.linkedin.com/in/matthieu-dazord" target="_blank" class="underline hover:text-orange" title="Linkedin"><b>Matthieu</b></a>, je suis développeur full-stack depuis 8 ans sur la région bordelaise.<br/>
                    J’ai eu la chance de concevoir de nombreuses plateformes web de par mon parcours : landing pages, sites vitrines, boutiques en ligne, plateformes sur-mesure…<br/>
                    Après plusieurs années en agence de communication et en entreprises spécialisées, j'ai développé un <span class="font-bold">savoir-faire technique</span> et une expertise dans les technologies de l'internet.
                    <br/><br/>
                    Face à la multitude de possibilités et d'options proposées pour la conception d'un site, je vous accompagne dans votre démarche, qu'il s'agisse de la création ou de l'évolution de votre site internet dans une optique de communication, de vente ou de digitalisation de vos processus métier.
                    <br/><br/>
                    Au plaisir de se rencontrer,
                </p>
                <p class="text-gray-800 italic text-right mt-2">
                    M.
                </p>
                <div class="mt-6 md:flex items-center gap-4">
                    <a href="#references" @click.prevent="scrollToTarget('#references')" class="block text-center bg-blue hover:bg-blue-dark text-white px-6 py-3 rounded shadow-md mb-4 md:mb-0" title="Mes références">Mes références</a>
                    <a href="#services" @click.prevent="scrollToTarget('#offres')" class="block text-center bg-blue hover:bg-blue-dark text-white px-6 py-3 rounded shadow-md mb-4 md:mb-0" title="Mes offres">Mes offres</a>
                    <a href="#contact" @click.prevent="scrollToTarget('#contact')" class="block text-center bg-orange hover:bg-brown text-white px-6 py-3 rounded shadow-md" title="Me contacter">Me contacter</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    document.addEventListener('alpine:init', () => {
        Alpine.data('presentation', () => ({
            scrollToTarget : function(target)
            {
              window.scrollTo({
                top: document.querySelector(target).offsetTop,
                left: 0,
                behavior: 'smooth'
              });
            }
        }))
    })
</script>
