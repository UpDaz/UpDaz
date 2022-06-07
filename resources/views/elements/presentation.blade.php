<div id="presentation" x-data="presentation" class="w-full flex items-center justify-between px-8 lg:px-16 py-16 lg:py-24 relative overflow-hidden">
    <div class="container grid grid-cols-1 lg:grid-cols-5 gap-6 items-center relative">
        <div class="lg:col-span-2 text-center relative">
            <img src="{{ asset('img/illustrations/background-profile.svg')}}" class="hidden lg:block absolute y-center x-center z-0 max-w-none h-[calc(100%+10rem)] w-auto" width="240" height="240" alt="Background Profile" title="Arrière plan">
            <img class="hidden lg:block w-60 h-60 rounded-full mx-auto z-10 relative" src="{{ asset('img/profile.jpg') }}" alt="Photo profile" title="Matthieu DAZORD"/>
            <picture>
                <source type="image/webp" srcset="{{ asset('img/illustrations/background-profile.webp') }}">
                <img src="{{ asset('img/illustrations/background-profile.png') }}" class="block lg:hidden w-full" width="330" height="234" alt="Photo Matthieu Dazord avec background" title="Matthieu DAZORD" loading="lazy">
            </picture>
        </div>
        <div class="lg:col-span-3 z-10 relative">
            <p class="font-title bold text-3xl text-orange mb-6">Bienvenue !</p>
            <p class="text-gray-800">
                Je m'appelle <a href="https://fr.linkedin.com/in/matthieu-dazord" target="_blank" class="underline hover:text-orange" title="Linkedin"><b>Matthieu DAZORD</b></a>, je suis développeur full-stack depuis 8 ans sur la région bordelaise.<br/>
                J’ai eu la chance de concevoir de nombreuses plateformes web de part mon parcours : sites vitrines, boutiques en ligne, plateforme sur-mesure…<br/>
                Cette variété de projets m'a permis de développer un savoir-faire technique que je met aujourd'hui au service de <a href="#votre-projet" class="underline hover:text-orange" title="votre projet"><b>votre projet !</b></a>
            </p>
            <div class="mt-6 lg:flex items-center gap-4">
                <a href="#references" @click.prevent="scrollToTarget('#references')" class="block text-center bg-blue hover:bg-blue-dark text-white px-6 py-3 rounded shadow-md mb-4 lg:mb-0" title="Mes références">Mes références</a>
                <a href="#services" @click.prevent="scrollToTarget('#services')" class="block text-center bg-blue hover:bg-blue-dark text-white px-6 py-3 rounded shadow-md mb-4 lg:mb-0" title="Mes services">Mes services</a>
                <a href="#contact" @click.prevent="scrollToTarget('#contact')" class="block text-center bg-orange hover:bg-brown text-white px-6 py-3 rounded shadow-md" title="Me contacter">Me contacter</a>
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
