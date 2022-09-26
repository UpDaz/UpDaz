<div id="menu-top"></div>
<nav id="menu" 
  x-data="menu"
  class="sticky w-full bg-blue z-50 transition-all px-8 lg:px-16 py-4 md:py-6 "
  :class="displayMenu ? 'top-0' : '-top-24'"
  @scroll.window="manageMenuDisplay();"
>
  <div class="container mx-auto">
    <div class="flex flex-wrap justify-between items-center">
      <a href="{{ route('home') }}" class="flex items-center" title="UpDaz">
          <img src="{{ asset('img/logo.svg') }}" class="h-6 md:h-8 w-auto" width="100" height="32" alt="UpDaz Logo" title="UpDaz" />
      </a>
      <button @click.prevent="toggleMobileMenu()" aria-label="Ouvrir menu" type="button" class="inline-flex items-center p-2 ml-3 text-sm text-white rounded-lg md:hidden" aria-controls="mobile-menu" aria-expanded="false">
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
      </button>
      <div x-bind:class="openMobileMenu ? '!left-0' : 'left-full'" 
          class="w-screen fixed transition-all md:static top-0 pt-4 md:pt-0 h-screen md:h-auto md:block md:w-auto bg-blue-dark md:bg-blue z-50 left-full" 
          id="mobile-menu"
      >
      <button @click.prevent="toggleMobileMenu()" type="button" aria-label="Fermer menu" class="absolute top-6 right-8 text-sm text-white rounded-lg md:hidden" aria-controls="mobile-menu" aria-expanded="false">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
      </button>
        <ul class="flex flex-col md:flex-row md:space-x-4 lg:space-x-8 text-lg md:text-sm md:font-medium text-center md:text-left">
          <li>
            <a href="{{route('home') }}#presentation" @click.prevent="scrollToTarget('#presentation')" title="Présentation" class="block py-4 md:py-2 pr-4 pl-3 font-bold text-white bg-blue-700 rounded md:bg-transparent md:p-0 dark:text-white hover:underline" aria-current="page">
              Présentation
            </a>
          </li>
          <li>
            <a href="{{route('home') }}#references" @click.prevent="scrollToTarget('#references')" title="Mes Références" class="block py-4 md:py-2 pr-4 pl-3 font-bold text-white bg-blue-700 rounded md:bg-transparent md:p-0 dark:text-white hover:underline" aria-current="page">
              Références
            </a>
          </li>
          <li class="relative border-orange border-2 mx-4 md:border-none md:mx-0" 
              x-data="{ openSubmenu:false }" 
              @mouseleave="openSubmenu = false" 
              @mouseover="openSubmenu = true">
            <a href="{{route('home') }}#offres" 
                @click.prevent="scrollToTarget('#offres')" 
                title="Offres" 
                class="block py-4 md:py-2 pr-4 pl-3 font-bold text-white md:bg-transparent md:p-0 hover:underline" aria-current="page">
              Offres
            </a>
            <div class="w-1/3 bg-orange mx-auto h-[2px] md:hidden"></div>
            <ul class="block text-center md:hidden md:absolute md:bg-white md:left-1/2 md:-translate-x-2/4 md:w-60 md:shadow-md md:rounded" x-bind:class="openSubmenu? 'md:!block' : '' ">
              <li>
                <a href="{{ route('webflow') }}" class="block pt-4 pb-2 text-base font-bold text-white md:text-sm md:py-4 md:text-blue hover:bg-blue-dark hover:text-white">
                  Landing page & site vitrine
                </a>
              </li>
              <li>
                <a href="{{ route('laravel') }}" class="block pt-2 pb-4 text-base font-bold text-white md:py-4 md:text-sm md:text-blue hover:bg-blue-dark hover:text-white">
                  Application métier & sur-mesure
                </a>
              </li>
            </ul>
          </li>
          <li>
            <a href="{{route('home') }}#contact" @click.prevent="scrollToTarget('#contact')" title="Me Contacter" class="block py-4 md:py-2 pr-4 pl-3 font-bold text-white bg-blue-700 rounded md:bg-transparent md:p-0 dark:text-white hover:underline" aria-current="page">
              Contact
            </a>
          </li>
          <li class="hidden md:block">
            <a href="https://fr.linkedin.com/in/matthieu-dazord" target="_blank" title="Linkedin" class="block py-4 md:py-2 pr-4 pl-3 font-bold text-white bg-blue-700 rounded md:bg-transparent md:p-0 dark:text-white hover:underline" aria-current="page">
              <img src="{{ asset('img/logos/linkedin.svg') }}" width="20" height="20" alt="Logo Linkedin" title="Linkedin" class="mx-auto">
            </a>
          </li>
          <li class="hidden md:block">
            <a href="https://www.malt.fr/profile/matthieudazord" target="_blank" title="Malt" class="block py-4 md:py-2 pr-4 pl-3 font-bold text-white bg-blue-700 rounded md:bg-transparent md:p-0 dark:text-white hover:underline" aria-current="page">
              <img src="{{ asset('img/logos/malt.svg') }}" width="20" height="20" alt="Logo Malt" title="Malt" class="mx-auto">
            </a>
          </li>
          <li class="hidden md:block">
            <a href="https://plateforme.freelance.com/freelance/Matthieu-c34713cf-17ba-4a64-8b99-aa21e240582b" target="_blank" title="Freelance.com" class="block py-4 md:py-2 pr-4 pl-3 font-bold text-white bg-blue-700 rounded md:bg-transparent md:p-0 dark:text-white hover:underline" aria-current="page">
              <img src="{{ asset('img/logos/freelance.svg') }}" width="26" height="20" alt="Logo Frellance.com" title="Freelance.com" class="mx-auto">
            </a>
          </li>
          <li class="hidden md:block">
            <a href="https://github.com/UpDaz" target="_blank" title="Github" class="block py-4 md:py-2 pr-4 pl-3 font-bold text-white bg-blue-700 rounded md:bg-transparent md:p-0 dark:text-white hover:underline" aria-current="page">
              <img src="{{ asset('img/logos/github.svg') }}" width="20" height="20" alt="Logo Github" title="Github" class="mx-auto">
            </a>
          </li>
        </ul>
        <div class="flex align-middle justify-center md:hidden gap-10 my-4">
          <a href="https://fr.linkedin.com/in/matthieu-dazord" target="_blank" title="Linkedin" class="block font-bold text-white bg-blue-700 rounded md:bg-transparent md:p-0 dark:text-white hover:underline" aria-current="page">
            <img src="{{ asset('img/logos/linkedin.svg') }}" width="30" height="30" alt="Logo Linkedin" title="Linkedin" class="mx-auto">
          </a>
          <a href="https://www.malt.fr/profile/matthieudazord" target="_blank" title="Malt" class="block font-bold text-white bg-blue-700 rounded md:bg-transparent md:p-0 dark:text-white hover:underline" aria-current="page">
            <img src="{{ asset('img/logos/malt.svg') }}" width="30" height="30" alt="Logo Malt" title="Malt" class="mx-auto">
          </a>
          <a href="https://plateforme.freelance.com/freelance/Matthieu-c34713cf-17ba-4a64-8b99-aa21e240582b" target="_blank" title="Freelance.com" class="block font-bold text-white bg-blue-700 rounded md:bg-transparent md:p-0 dark:text-white hover:underline" aria-current="page">
            <img src="{{ asset('img/logos/freelance.svg') }}" width="36" height="30" alt="Logo Frellance.com" title="Freelance.com" class="mx-auto">
          </a>
          <a href="https://github.com/UpDaz" target="_blank" title="Freelance.com" class="block font-bold text-white bg-blue-700 rounded md:bg-transparent md:p-0 dark:text-white hover:underline" aria-current="page">
            <img src="{{ asset('img/logos/github.svg') }}" width="30" height="30" alt="Logo Github" title="GIthub" class="mx-auto">
          </a>
        </div>
        <div class="h-1/4 mx-auto md:hidden pt-12">
          @include('elements.illustrations.directions')
        </div>
      </div>
    </div>
  </div>
</nav>

<script type="text/javascript">
    document.addEventListener('alpine:init', () => {
        Alpine.data('menu', () => ({
            openMobileMenu: false, 
            displayMenu : true,
            oldScroll : 0,
            homeLink : '{{ route('home') }}',
            toggleMobileMenu : function()
            {
              this.openMobileMenu = ! this.openMobileMenu
            },
            scrollToTarget : function(target)
            {
              if (document.querySelector(target)) {
                window.scrollTo({
                  top: document.querySelector(target).offsetTop,
                  left: 0,
                  behavior: 'smooth'
                });
                this.openMobileMenu = false;
              } else {
                document.location.href = this.homeLink + target;
              }
            },
            manageMenuDisplay: function ()
            {
              this.displayMenu = (window.scrollY <= 0 || this.oldScroll > window.scrollY); 
              this.oldScroll = window.scrollY;
            }
        }))
    })
</script>
