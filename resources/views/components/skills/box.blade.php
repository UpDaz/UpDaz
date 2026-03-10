<div class="relative grid items-center justify-center h-full grid-cols-3 gap-y-8 md:gap-8 rounded-lg sm:flex-row">
    <div class="relative w-12 col-span-1 justify-self-center">
        @isset ($icon)
            {{ $icon }}
        @endif
    </div>
    <div class="relative flex items-center col-span-2 min-h-16">
        @isset ($title)
            {{ $title }}
            <div data-element="line-horizontal" class="absolute h-[1px] right-0 w-[150%] -bottom-4 bg-gradient-to-r"></div>
        @endif
    </div>
    <div class="flex-grow col-span-3 pl-12">
        {{ $slot }}
    </div>
</div>
