<div class="lg:hidden" @keydown.escape.window="openMobileMenu && closeMobileMenu()">
    <button x-ref="mobileMenuOpenButton" @click.prevent="toggleMobileMenu()" aria-label="Ouvrir le menu" type="button"
        class="-m-2.5 inline-flex items-center p-2.5 text-sm text-white" aria-controls="mobile-menu" :aria-expanded="openMobileMenu.toString()">
        <span class="*:w-full">
            @include('elements.icon.plus')
        </span>
    </button>
    <div x-bind:class="openMobileMenu ? 'translate-x-0!' : ''"
        class="fixed top-0 left-0 z-50 w-screen h-screen overflow-y-scroll translate-x-full transition-transform duration-300 ease-out-expo motion-reduce:transition-none bg-linear-to-br from-blue to-blue-dark lg:bg-none"
        id="mobile-menu" @keydown.tab="trapMobileMenuFocus($event)" :inert="!openMobileMenu" role="dialog" aria-modal="true" aria-label="Menu">
        <div class="relative flex flex-col gap-8 h-full">
            <div class="container mx-auto border-b border-gray py-4 ">
                <div class="flex flex-wrap items-center justify-between">
                    <a href="{{ route('home') }}" class="flex items-center" title="UpDaz">
                        <img src="{{ asset('img/logo.svg') }}" class="w-auto h-8" width="100" height="32"
                            alt="UpDaz Logo" title="UpDaz" />
                    </a>
                    <button x-ref="mobileMenuCloseButton" @click.prevent="closeMobileMenu()" type="button" aria-label="Fermer le menu"
                        class="-m-2.5 p-2.5 text-sm text-white" aria-controls="mobile-menu">
                        @include('elements.icon.close')
                    </button>
                </div>
            </div>
            <ul class="flex flex-col items-stretch gap-8 px-16 text-lg text-center justify-stretch h-2/3">
                <li>
                    <x-button.secondary href="{{ route('home') }}#presentation"
                        @click.prevent="scrollToTarget('#presentation')" title="Présentation">
                        À propos
                    </x-button.secondary>
                </li>
                <li>
                    <x-button.secondary href="{{ route('home') }}#competences"
                        @click.prevent="scrollToTarget('#competences')" title="Mes competences">
                        Compétences
                    </x-button.secondary>
                </li>
                <li>
                    <x-button.secondary href="{{ route('home') }}#references" title="Mes Références">
                        Références
                    </x-button.secondary>
                </li>
                <li>
                    <x-button.secondary href="{{ route('laravel') }}" title="Développeur Laravel à Bordeaux">
                        Application Laravel
                    </x-button.secondary>
                </li>
                <li>
                    <x-button.secondary href="{{ route('ecommerce') }}" title="E-commerce">
                        E-commerce
                    </x-button.secondary>
                </li>
                <li>
                    <x-button.secondary href="{{ route('webflow') }}" title="CMS">
                        CMS
                    </x-button.secondary>
                </li>
                <li>
                    <x-button.secondary href="{{ route('articles') }}" title="Actualités / articles">
                        Blog
                    </x-button.secondary>
                </li>
                <li>
                    <x-button.primary href="{{ route('home') }}#contact" title="Me contacter">
                        J'ai un projet
                    </x-button.primary>
                </li>
                <li>
                    <div class="flex justify-center gap-10 my-4 align-middle md:hidden">
                        <a href="https://fr.linkedin.com/in/matthieu-dazord" target="_blank" title="Linkedin"
                            class="block text-white md:p-0 hover:underline">
                            <img src="{{ asset('img/logos/white/linkedin.svg') }}" width="30" height="30"
                                alt="Logo Linkedin" title="Linkedin" class="mx-auto">
                        </a>
                        <a href="https://github.com/UpDaz" target="_blank" title="Github"
                            class="block text-white md:p-0 hover:underline">
                            <img src="{{ asset('img/logos/white/github.svg') }}" width="30" height="30"
                                alt="Logo Github" title="GIthub" class="mx-auto">
                        </a>
                    </div>
                </li>
            </ul>
            <div class="absolute top-0 left-0 w-2 h-full md:w-4 background"></div>
            <div class="absolute top-0 right-0 w-2 h-full md:w-4 background"></div>
        </div>
    </div>
</div>
