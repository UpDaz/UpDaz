<div id="menu-top"></div>
<nav id="menu" 
  x-data="menu"
  x-init="manageMenuDisplay();"
  class="sticky z-50 w-full px-8 py-4 overflow-hidden transition-all lg:px-16 md:py-6"
  :class="displayMenu ? (windowScrollY > 0 ? 'top-0 bg-blue' : 'top-0') : 'md:-top-32 bg-blue'"
  @scroll.window="manageMenuDisplay();"
>
  <div class="container mx-auto">
    <div class="flex flex-wrap items-center justify-between">
      <a href="{{ route('home') }}" class="flex items-center" title="UpDaz">
          <img src="{{ asset('img/logo.svg') }}" class="w-auto h-6 md:h-8" width="100" height="32" alt="UpDaz Logo" title="UpDaz" />
      </a>
      <button @click.prevent="toggleMobileMenu()" aria-label="Ouvrir menu" type="button" class="inline-flex items-center p-2 ml-3 text-sm text-white rounded-lg md:hidden" aria-controls="mobile-menu" aria-expanded="false">
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
      </button>
      <div x-bind:class="openMobileMenu ? '!left-0' : 'left-full'" 
          class="fixed top-0 z-50 w-screen h-screen overflow-y-scroll transition-all md:static md:pt-0 md:overflow-visible md:h-auto md:block md:w-auto bg-gradient-to-br from-blue-dark to-blue md:bg-none left-full" 
          id="mobile-menu"
      >
      <button @click.prevent="toggleMobileMenu()" type="button" aria-label="Fermer menu" class="absolute text-sm text-white rounded-lg top-6 right-8 md:hidden" aria-controls="mobile-menu" aria-expanded="false">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
      </button>
        <ul class="flex flex-col justify-around mt-24 text-lg text-center md:mt-0 h-2/3 md:flex-row md:space-x-4 lg:space-x-8 md:text-sm md:font-medium md:text-left">
          <li class="relative" 
          x-data="{ openSubmenu:false }" 
          @mouseleave="openSubmenu = false" 
          @mouseover="openSubmenu = true">
            <a href="{{ route('home') }}#presentation" @click.prevent="scrollToTarget('#presentation')" title="Présentation" class="block py-4 pl-3 pr-4 font-bold text-white bg-blue-700 rounded md:py-2 md:bg-transparent md:p-0 dark:text-white hover:underline" aria-current="page">
              Présentation
            </a>
            <div class="hidden md:block">
              <ul class="overflow-hidden text-center md:hidden md:absolute md:bg-white md:left-1/2 md:-translate-x-2/4 md:w-60 md:shadow-md md:rounded" x-bind:class="openSubmenu? 'md:!block' : '' ">
                <li>
                    <a href="{{ route('laravel') }}" class="block pt-4 pb-2 text-base font-bold text-white md:py-4 md:text-sm md:text-blue hover:bg-blue-dark hover:text-white">
                      Laravel
                    </a>
                </li>
                <li>
                    <a href="{{ route('webflow') }}" class="block pt-4 pb-2 text-base font-bold text-white md:py-4 md:text-sm md:text-blue hover:bg-blue-dark hover:text-white">
                      Webflow
                    </a>
                </li>
                <li>
                  <a href="{{ route('prestashop') }}" class="block pt-4 pb-2 text-base font-bold text-white md:py-4 md:text-sm md:text-blue hover:bg-blue-dark hover:text-white">
                    Prestashop
                  </a>
              </li>
              </ul>
            </div>
          </li>
          <li>
            <a href="{{ route('home') }}#competences" @click.prevent="scrollToTarget('#competences')" title="Mes competences" class="block py-4 pl-3 pr-4 font-bold text-white bg-blue-700 rounded md:py-2 md:bg-transparent md:p-0 dark:text-white hover:underline" aria-current="page">
              competences
            </a>
          </li>
          <li>
            <a href="{{ route('home') }}#references" @click.prevent="scrollToTarget('#references')" title="Mes Références" class="block py-4 pl-3 pr-4 font-bold text-white bg-blue-700 rounded md:py-2 md:bg-transparent md:p-0 dark:text-white hover:underline" aria-current="page">
              Références
            </a>
          </li>
          <li>
            <a href="{{ route('home') }}#offres" 
                @click.prevent="scrollToTarget('#offres')" 
                title="Offres" 
                class="block py-4 pl-3 pr-4 font-bold text-white md:py-2 md:bg-transparent md:p-0 hover:underline" aria-current="page">
              Offres
            </a>
          </li>
          <li class="relative" 
              x-data="{ openSubmenu:false }" 
              @mouseleave="openSubmenu = false" 
              @mouseover="openSubmenu = true">
            <a href="{{ route('articles') }}" 
                title="Actualités" 
                class="block py-4 pl-3 pr-4 font-bold text-white md:py-2 md:bg-transparent md:p-0 hover:underline" aria-current="page">
              Articles
            </a>
          </li>
          <li>
            <a href="{{ route('home') }}#contact" @click.prevent="scrollToTarget('#contact')" title="Me Contacter" class="block py-4 pl-3 pr-4 font-bold text-white bg-blue-700 rounded md:py-2 md:bg-transparent md:p-0 dark:text-white hover:underline" aria-current="page">
              Contact
            </a>
          </li>
          <li class="hidden md:block">
            <a href="https://fr.linkedin.com/in/matthieu-dazord" target="_blank" title="Linkedin" class="block py-4 pl-3 pr-4 font-bold text-white bg-blue-700 rounded md:py-2 md:bg-transparent md:p-0 dark:text-white hover:underline" aria-current="page">
              <img src="{{ asset('img/logos/white/linkedin.svg') }}" width="20" height="20" alt="Logo Linkedin" title="Linkedin" class="mx-auto">
            </a>
          </li>
          <li class="hidden md:block">
            <a href="https://github.com/UpDaz" target="_blank" title="Github" class="block py-4 pl-3 pr-4 font-bold text-white bg-blue-700 rounded md:py-2 md:bg-transparent md:p-0 dark:text-white hover:underline" aria-current="page">
              <img src="{{ asset('img/logos/white/github.svg') }}" width="20" height="20" alt="Logo Github" title="Github" class="mx-auto">
            </a>
          </li>
          <li>
            <div class="flex justify-center gap-10 my-4 align-middle md:hidden">
              <a href="https://fr.linkedin.com/in/matthieu-dazord" target="_blank" title="Linkedin" class="block font-bold text-white bg-blue-700 rounded md:bg-transparent md:p-0 dark:text-white hover:underline" aria-current="page">
                <img src="{{ asset('img/logos/white/linkedin.svg') }}" width="30" height="30" alt="Logo Linkedin" title="Linkedin" class="mx-auto">
              </a>
              <a href="https://github.com/UpDaz" target="_blank" title="Github" class="block font-bold text-white bg-blue-700 rounded md:bg-transparent md:p-0 dark:text-white hover:underline" aria-current="page">
                <img src="{{ asset('img/logos/white/github.svg') }}" width="30" height="30" alt="Logo Github" title="GIthub" class="mx-auto">
              </a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="absolute h-[1px] left-1/2 w-[200%] -translate-x-1/2 bottom-0 bg-gray"></div>
</nav>

<script type="text/javascript">
    document.addEventListener('alpine:init', () => {
      Alpine.data('menu', () => ({
          openMobileMenu: false, 
          displayMenu : true,
          windowScrollY : 0,
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
            this.windowScrollY = window.scrollY;
            this.displayMenu = (this.windowScrollY  <= 0 || this.oldScroll > this.windowScrollY); 
            this.oldScroll = this.windowScrollY ;
          }
      }))
    });
</script>
