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
          <img src="{{ asset('img/logo.svg') }}" class="mr-3 h-6 md:h-8 w-auto" width="100" height="32" alt="UpDaz Logo" title="UpDaz" />
      </a>
      <button @click.prevent="toggleMobileMenu()" aria-label="Ouvrir menu" type="button" class="inline-flex items-center p-2 ml-3 text-sm text-white rounded-lg md:hidden" aria-controls="mobile-menu" aria-expanded="false">
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
      </button>
      <div x-bind:class="openMobileMenu ? '!left-0' : 'left-full'" 
          class="w-screen fixed transition-all md:static top-0 pt-12 md:pt-0 h-screen md:h-auto md:block md:w-auto bg-blue-dark md:bg-blue z-50 left-full" 
          id="mobile-menu"
      >
      <button @click.prevent="toggleMobileMenu()" type="button" aria-label="Fermer menu" class="absolute top-6 right-8 text-sm text-white rounded-lg md:hidden" aria-controls="mobile-menu" aria-expanded="false">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
      </button>
        <ul class="flex flex-col md:flex-row md:space-x-8 text-lg text-lg md:text-sm md:font-medium text-center md:text-left">
          <li>
            <a href="{{route('home') }}#presentation" @click.prevent="scrollToTarget('#presentation')" title="Présentation" class="block py-4 md:py-2 pr-4 pl-3 font-bold text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white hover:underline" aria-current="page">
              Présentation
            </a>
          </li>
          <li>
            <a href="{{route('home') }}#references" @click.prevent="scrollToTarget('#references')" title="Mes Références" class="block py-4 md:py-2 pr-4 pl-3 font-bold text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white hover:underline" aria-current="page">
              Références
            </a>
          </li>
          <li>
            <a href="{{route('home') }}#votre-projet" @click.prevent="scrollToTarget('#votre-projet')" title="Votre projet" class="block py-4 md:py-2 pr-4 pl-3 font-bold text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white hover:underline" aria-current="page">
              Votre projet
            </a>
          </li>
          <li>
            <a href="{{route('home') }}#services" @click.prevent="scrollToTarget('#services')" title="Mes services" class="block py-4 md:py-2 pr-4 pl-3 font-bold text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white hover:underline" aria-current="page">
              Mes services
            </a>
          </li>
          <li>
            <a href="{{route('home') }}#contact" @click.prevent="scrollToTarget('#contact')" title="Me Contacter" class="block py-4 md:py-2 pr-4 pl-3 font-bold text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white hover:underline" aria-current="page">
              Contact
            </a>
          </li>
          <li>
            <a href="https://fr.linkedin.com/in/matthieu-dazord" target="_blank" title="Linkedin" class="block py-4 md:py-2 pr-4 pl-3 font-bold text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white hover:underline" aria-current="page">
              <img src="{{ asset('img/linkedin.svg') }}" width="20" height="20" alt="Logo Linkedin" title="Linkedin" class="mx-auto">
            </a>
          </li>
        </ul>
        <img src="{{ asset('img/illustrations/directions.svg') }}" class="h-1/4 absolute x-center bottom-12 md:hidden" alt="Illustration Navigation" title="Navigation"/>
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
