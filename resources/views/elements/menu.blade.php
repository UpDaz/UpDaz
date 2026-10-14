<nav id="menu" x-data="menu" x-init="manageMenuDisplay();" class="sticky z-50 w-full py-4 transition-all md:py-6"
    :class="displayMenu ? (windowScrollY > 0 ? 'top-0 bg-blue-dark' : 'top-0') : 'md:-top-32 bg-blue'"
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
                if (this.openMobileMenu) {
                    this.closeMobileMenu();

                    return;
                }

                this.openMobileMenu = true;
                this.$nextTick(() => this.$refs.mobileMenuCloseButton.focus());
            },
            closeMobileMenu: function() {
                this.openMobileMenu = false;
                this.$nextTick(() => this.$refs.mobileMenuOpenButton.focus());
            },
            trapMobileMenuFocus: function(event) {
                const focusableElements = [...document.querySelectorAll('#mobile-menu a[href], #mobile-menu button')];
                const firstElement = focusableElements[0];
                const lastElement = focusableElements[focusableElements.length - 1];

                if (event.shiftKey && document.activeElement === firstElement) {
                    event.preventDefault();
                    lastElement.focus();

                    return;
                }

                if (! event.shiftKey && document.activeElement === lastElement) {
                    event.preventDefault();
                    firstElement.focus();
                }
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
