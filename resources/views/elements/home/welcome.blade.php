<section class="-mt-24 bg-gradient-to-br from-blue-dark to-blue">
    <div class="px-8 py-16 pt-32 pb-16 md:pb-24 bg-pattern-1 md:px-16">
        <div class="container flex flex-col items-center mx-auto md:flex-row">
            <div
                class="flex flex-col mb-12 lg:flex-grow md:w-1/2 lg:pr-24 md:pr-16 md:items-start md:text-left md:mb-0">
                <h1 class="text-3xl font-bold text-white font-title md:text-4xl txt-rotate">
                    Accompagnement, création et maintenance d'<span class="text-orange">application web
                        sur-mesure</span> & de <span class="text-orange">site CMS</span>
                </h1>
                <div class="w-20 h-1 my-12 bg-white rounded"></div>
                <a href="#presentation" @click.prevent="scrollToTarget('#contact')"
                    class="block px-6 py-3 mt-4 font-medium text-center text-white rounded shadow-md md:inline-block bg-orange hover:bg-blue-dark"
                    title="UpDaz : en savoir plus">
                    En savoir plus
                </a>
            </div>
            <div class="w-full md:w-1/2">
                <x-welcome-scroller />
            </div>
        </div>
    </div>
</section>
