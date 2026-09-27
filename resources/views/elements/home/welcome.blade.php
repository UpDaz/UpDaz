<section class="-mb-18">
    <div class="relative flex items-center justify-center py-16 pb-8 lg:min-h-[80vh] lg:pt-8">
        <div class="container mx-auto flex flex-col items-center gap-20 lg:flex-row">
            <div class="flex flex-col gap-8 md:items-start md:text-left lg:grow xl:w-1/2">
                <h1 class="font-title text-4xl font-bold text-white">
                    Développeur Laravel et Webflow à Bordeaux
                </h1>
                <h2 class="font-text text-lg font-light"><b>UpDaz</b> développe et maintient votre <a href="{{ route('laravel') }}" class="text-yellow underline">application
                        web métier</a>, votre site <a href="{{ route('ecommerce') }}" class="text-yellow text-nowrap underline">e-commerce</a> et votre
                    <a href="{{ route('webflow') }}" class="text-yellow underline">site web CMS</a> à Bordeaux depuis plus de 10 ans.
                </h2>
                <div class="flex flex-col gap-2">
                    <x-skills.item text="Développement d'applications web avec Laravel" />
                    <x-skills.item text="Création de sites web avec Webflow" />
                    <x-skills.item text="Conseils, gestion de projet, développement web" />
                </div>
                <div class="grid items-start gap-4">
                    <x-button.primary href="#contact" title="UpDaz : formulaire de contact" @click.prevent="scrollToTarget('#contact')" classes="xl:col-span-2">
                        Je souhaite créer une application web
                        </x-button-primary>
                </div>
            </div>
            <div class="hidden w-full justify-center *:h-auto *:w-full md:w-1/2 lg:flex *:lg:h-[65vh] *:lg:w-auto">
                <img src="{{ asset('img/illustrations/home.svg') }}" alt="" width="263" height="213" loading="lazy" />
            </div>
        </div>
    </div>
    @include('elements.reassurance')
</section>
