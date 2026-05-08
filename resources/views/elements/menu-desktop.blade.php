<div class="hidden lg:block">
    <ul
        class="flex flex-col justify-around mt-24 text-lg text-center md:mt-0 h-2/3 md:flex-row md:space-x-4 lg:space-x-8 md:text-sm md:font-medium md:text-left">
        <li>
            <a href="{{ route('home') }}#presentation"
                title="Présentation"
                class="block py-4 pl-3 pr-4 text-white bg-blue-700 md:py-2 md:bg-transparent md:p-0 dark:text-white hover:underline"
                aria-current="page">
                À propos
            </a>
        </li>
        <li>
            <a href="{{ route('home') }}#competences"
                title="Mes competences"
                class="block py-4 pl-3 pr-4 text-white bg-blue-700 md:py-2 md:bg-transparent md:p-0 dark:text-white hover:underline"
                aria-current="page">
                Savoir-faire
            </a>
        </li>
        <li class="relative">
            <a href="{{ route('laravel') }}" title="Sur-mesure"
                class="block py-4 pl-3 pr-4 text-white md:py-2 md:bg-transparent md:p-0 hover:underline"
                aria-current="page">
                Application web
            </a>
        </li>
        <li class="relative">
            <a href="{{ route('ecommerce') }}" title="E-commerce"
                class="block py-4 pl-3 pr-4 text-white md:py-2 md:bg-transparent md:p-0 hover:underline"
                aria-current="page">
                E-commerce
            </a>
        </li>
        <li class="relative">
            <a href="{{ route('webflow') }}" title="CMS"
                class="block py-4 pl-3 pr-4 text-white md:py-2 md:bg-transparent md:p-0 hover:underline"
                aria-current="page">
                CMS
            </a>
        </li>
        <li class="relative" x-data="{ openSubmenu: false }">
            <a href="{{ route('articles') }}" title="Actualités"
                class="block py-4 pl-3 pr-4 text-white md:py-2 md:bg-transparent md:p-0 hover:underline"
                aria-current="page">
                Blog
            </a>
        </li>
        <li>
            <x-button.primary href="{{ route('home') }}#contact" :small="true" title="Me Contacter">
                J'ai un projet
            </x-button.primary>
        </li>
    </ul>
</div>
