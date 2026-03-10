<div class="lg:hidden">
    <button @click.prevent="toggleMobileMenu()" aria-label="Ouvrir menu" type="button"
        class="inline-flex items-center text-sm text-white" aria-controls="mobile-menu" aria-expanded="false">
        <span class="*:w-full font-title  text-lg font-bold uppercase hover:text-yellow">
            Menu
        </span>
    </button>
    <div x-bind:class="openMobileMenu ? 'left-0!' : 'left-full'"
        class="fixed top-0 z-50 w-screen h-screen overflow-y-scroll transition-all bg-linear-to-br from-blue to-blue-dark lg:bg-none left-full"
        id="mobile-menu">
        <div class="relative flex flex-col gap-8">
            <div class="container mx-auto border-b border-gray py-4 ">
                <div class="flex flex-wrap items-center justify-between">
                    <a href="{{ route('home') }}" class="flex items-center" title="UpDaz">
                        <img src="{{ asset('img/logo.svg') }}" class="w-auto h-8" width="100" height="32"
                            alt="UpDaz Logo" title="UpDaz" />
                    </a>
                    <button @click.prevent="toggleMobileMenu()" type="button" aria-label="Fermer menu"
                        class="text-sm text-white" aria-controls="mobile-menu" aria-expanded="false">
                        @include('elements.icon.close')
                    </button>
                </div>
            </div>
            <ul class="flex flex-col items-stretch gap-8 px-16 text-lg text-center justify-stretch h-2/3">
                <li>
                    <x-button.secondary href="{{ route('home') }}#presentation"
                        @click.prevent="scrollToTarget('#presentation')" title="Présentation">
                        Présentation
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
                    <x-button.secondary href="{{ route('laravel') }}" title="Sur-mesure">
                        Sur-mesure
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
                        Articles
                    </x-button.secondary>
                </li>
                <li>
                    <x-button.primary href="{{ route('home') }}#contact" title="Me contacter">
                        Contact
                    </x-button.primary>
                </li>
                <li>
                    <div class="flex justify-center gap-10 my-4 align-middle md:hidden">
                        <a href="https://fr.linkedin.com/in/matthieu-dazord" target="_blank" title="Linkedin"
                            class="block text-white md:p-0 hover:underline" aria-current="page">
                            <img src="{{ asset('img/logos/white/linkedin.svg') }}" width="30" height="30"
                                alt="Logo Linkedin" title="Linkedin" class="mx-auto">
                        </a>
                        <a href="https://github.com/UpDaz" target="_blank" title="Github"
                            class="block text-white md:p-0 hover:underline" aria-current="page">
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
