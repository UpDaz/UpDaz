<div class="relative w-full">
    <div class="inline-flex items-center justify-center w-full px-6 py-3 *:w-full ">
        {{ $slot }}
    </div>
    <div class="absolute h-[1px] left-1/2 w-[150%] -translate-x-1/2 top-0 bg-gradient-to-r from-transparent via-gray to-transparent "></div>
    <div class="absolute h-[1px] left-1/2 w-[150%] -translate-x-1/2 bottom-0 bg-gradient-to-r from-transparent via-gray to-transparent "></div>
    <div class="absolute w-[1px] top-1/2 h-[150%] -translate-y-1/2 left-0 bg-gradient-to-b from-transparent via-gray to-transparent "></div>
    <div class="absolute w-[1px] top-1/2 h-[150%] -translate-y-1/2 right-0 bg-gradient-to-b from-transparent via-gray to-transparent "></div>
</div>
