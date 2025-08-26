<div class="relative grid items-center justify-center h-full grid-cols-3 gap-8 rounded-lg sm:flex-row">
    <div class="relative w-16 col-span-1 sm:w-12 justify-self-end">
        @isset ($icon)
            {{ $icon }}
        @endif
    </div>
    <div class="relative flex items-center h-12 col-span-2">
        @isset ($title)
            {{ $title }}
            <div data-element="line-horizontal" class="absolute h-[1px] right-0 w-[150%] -bottom-4 bg-gradient-to-r"></div>
        @endif
    </div>
    <div class="flex-grow col-span-3 col-start-2">
        {{ $slot }}
    </div>
</div>
