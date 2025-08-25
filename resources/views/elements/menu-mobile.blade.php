<div class="md:hidden">
    <button @click.prevent="toggleMobileMenu()" aria-label="Ouvrir menu" type="button"
        class="inline-flex items-center p-2 ml-3 text-sm text-white" aria-controls="mobile-menu"
        aria-expanded="false">
        <span class="*:w-full">
            @include('elements.icon.three-dots')
        </span>
    </button>
    <div x-bind:class="openMobileMenu ? '!left-0' : 'left-full'"
        class="fixed top-0 z-50 w-screen h-screen overflow-y-scroll transition-all bg-gradient-to-br from-blue-dark to-blue md:bg-none left-full"
        id="mobile-menu">
        <button @click.prevent="toggleMobileMenu()" type="button" aria-label="Fermer menu"
            class="absolute text-sm text-white top-6 right-8" aria-controls="mobile-menu"
            aria-expanded="false">
            @include('elements.icon.close')
        </button>
        <ul class="flex flex-col items-stretch gap-8 px-16 mt-24 text-lg text-center justify-stretch h-2/3">
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
                <x-button.secondary href="{{ route('home') }}#references" @click.prevent="scrollToTarget('#references')"
                    title="Mes Références">
                    Références
                </x-button.secondary>
            </li>
            <li>
                <x-button.secondary href="{{ route('home') }}#offres" @click.prevent="scrollToTarget('#offres')"
                    title="Offres">
                    Offres
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
                        class="block text-white bg-blue-700 md:bg-transparent md:p-0 dark:text-white hover:underline"
                        aria-current="page">
                        <img src="{{ asset('img/logos/white/linkedin.svg') }}" width="30" height="30"
                            alt="Logo Linkedin" title="Linkedin" class="mx-auto">
                    </a>
                    <a href="https://github.com/UpDaz" target="_blank" title="Github"
                        class="block text-white bg-blue-700 md:bg-transparent md:p-0 dark:text-white hover:underline"
                        aria-current="page">
                        <img src="{{ asset('img/logos/white/github.svg') }}" width="30" height="30"
                            alt="Logo Github" title="GIthub" class="mx-auto">
                    </a>
                </div>
            </li>
        </ul>
    </div>
</div>
