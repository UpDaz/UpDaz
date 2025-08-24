<div class="relative grid items-center justify-center h-full grid-cols-3 gap-8 p-8 rounded-lg sm:flex-row">
    <div class="relative w-12 col-span-1 justify-self-end">
        @isset ($icon)
            {{ $icon }}
            <div class="absolute w-[1px] top-0 h-[300%] -right-4 bg-gradient-to-b from-transparent via-gray to-transparent "></div>
        @endif
    </div>
    <div class="relative col-span-2">
        @isset ($title)
            {{ $title }}
            <div class="absolute h-[1px] right-0 w-[150%] -bottom-4 bg-gradient-to-r from-transparent via-gray"></div>
        @endif
    </div>
    <div class="flex-grow col-span-2 col-start-2">
        {{ $slot }}
    </div>
</div>
