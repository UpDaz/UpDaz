<div class="hidden md:block">
    <ul
        class="flex flex-col justify-around mt-24 text-lg text-center md:mt-0 h-2/3 md:flex-row md:space-x-4 lg:space-x-8 md:text-sm md:font-medium md:text-left">
        <li>
            <a href="{{ route('home') }}#presentation" @click.prevent="scrollToTarget('#presentation')"
                title="Présentation"
                class="block py-4 pl-3 pr-4 text-white bg-blue-700 md:py-2 md:bg-transparent md:p-0 dark:text-white hover:underline"
                aria-current="page">
                Présentation
            </a>
        </li>
        <li>
            <a href="{{ route('home') }}#competences" @click.prevent="scrollToTarget('#competences')"
                title="Mes competences"
                class="block py-4 pl-3 pr-4 text-white bg-blue-700 md:py-2 md:bg-transparent md:p-0 dark:text-white hover:underline"
                aria-current="page">
                Compétences
            </a>
        </li>
        <li>
            <a href="{{ route('home') }}#references" @click.prevent="scrollToTarget('#references')"
                title="Mes Références"
                class="block py-4 pl-3 pr-4 text-white bg-blue-700 md:py-2 md:bg-transparent md:p-0 dark:text-white hover:underline"
                aria-current="page">
                Références
            </a>
        </li>
        <li class="relative">
            <a href="{{ route('home') }}#offres" @click.prevent="scrollToTarget('#offres')" title="Offres"
                class="block py-4 pl-3 pr-4 text-white md:py-2 md:bg-transparent md:p-0 hover:underline"
                aria-current="page">
                Offres
            </a>
        </li>
        <li class="relative" x-data="{ openSubmenu: false }">
            <a href="{{ route('articles') }}" title="Actualités"
                class="block py-4 pl-3 pr-4 text-white md:py-2 md:bg-transparent md:p-0 hover:underline"
                aria-current="page">
                Articles
            </a>
        </li>
        <li>
            <x-button.primary href="{{ route('home') }}#contact" :small="true" title="Me Contacter">
                Contact
            </x-button.primary>
        </li>
        <li class="hidden md:block">
            <a href="https://fr.linkedin.com/in/matthieu-dazord" target="_blank" title="Linkedin"
                class="block py-4 pl-3 pr-4 text-white bg-blue-700 md:py-2 md:bg-transparent md:p-0 dark:text-white hover:underline"
                aria-current="page">
                <img src="{{ asset('img/logos/white/linkedin.svg') }}" width="20" height="20" alt="Logo Linkedin"
                    title="Linkedin" class="mx-auto">
            </a>
        </li>
        <li class="hidden md:block">
            <a href="https://github.com/UpDaz" target="_blank" title="Github"
                class="block py-4 pl-3 pr-4 text-white bg-blue-700 md:py-2 md:bg-transparent md:p-0 dark:text-white hover:underline"
                aria-current="page">
                <img src="{{ asset('img/logos/white/github.svg') }}" width="20" height="20" alt="Logo Github"
                    title="Github" class="mx-auto">
            </a>
        </li>
    </ul>
</div>
