<div class="relative grid items-center h-full grid-cols-[auto_1fr] gap-x-4 gap-y-8 md:gap-8 rounded-lg">
    <div class="relative justify-self-center *:w-12 *:h-auto">
        @isset ($icon)
            {{ $icon }}
        @endif
    </div>
    <div class="relative flex items-center min-h-16">
        @isset ($title)
            {{ $title }}
            <div data-element="line-horizontal" class="absolute h-px left-0 -translate-x-1/6 w-full -bottom-4 bg-gradient-to-r"></div>
        @endif
    </div>
    <div class="grow col-span-2 pl-12">
        {{ $slot }}
    </div>
</div>
