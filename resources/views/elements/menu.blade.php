<div id="menu-top"></div>
<nav id="menu" x-data="menu" x-init="manageMenuDisplay();" class="sticky z-50 w-full py-4 transition-all md:py-6"
    :class="displayMenu ? (windowScrollY > 0 ? 'top-0 bg-blue-dark' : 'top-0') : 'md:-top-32 bg-blue-dark'"
    @scroll.window="manageMenuDisplay();">
    <div class="container mx-auto">
        <div class="flex flex-wrap items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center" title="UpDaz">
                <img src="{{ asset('img/logo.svg') }}" class="w-auto h-8" width="100" height="32"
                    alt="UpDaz Logo" title="UpDaz" />
            </a>
            @include('elements.menu-mobile')
            @include('elements.menu-desktop')
        </div>
    </div>
    <div class="absolute h-[1px] left-1/2 w-[100%] -translate-x-1/2 bottom-0 bg-gray"></div>
</nav>

<script type="text/javascript">
    document.addEventListener('alpine:init', () => {
        Alpine.data('menu', () => ({
            openMobileMenu: false,
            displayMenu: true,
            windowScrollY: 0,
            oldScroll: 0,
            homeLink: '{{ route('home') }}',
            toggleMobileMenu: function() {
                this.openMobileMenu = !this.openMobileMenu
            },
            scrollToTarget: function(target) {
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
            manageMenuDisplay: function() {
                this.windowScrollY = window.scrollY;
                this.displayMenu = (this.windowScrollY <= 0 || this.oldScroll > this
                    .windowScrollY);
                this.oldScroll = this.windowScrollY;
            }
        }))
    });
</script>
