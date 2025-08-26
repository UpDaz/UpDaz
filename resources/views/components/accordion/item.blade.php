<div x-data='{ open: false }' class="relative flex flex-col">
    <div data-element="line-horizontal" class="absolute h-[1px] left-1/2 w-[125%] -translate-x-1/2 top-0"></div>
    <div data-element="line-horizontal" class="absolute h-[1px] left-1/2 w-[125%] -translate-x-1/2 bottom-0"></div>
    <div data-element="line-vertical" class="absolute w-[1px] top-1/2 h-[125%] -translate-y-1/2 left-0"></div>
    <div data-element="line-vertical" class="absolute w-[1px] top-1/2 h-[125%] -translate-y-1/2 right-0"></div>
    <div class="flex items-center justify-between gap-8 p-8 md:px-16 hover:bg-blue hover:cursor-pointer" @click="open = !open">
        <h3 class="md:text-lg">
            {!! $title !!}
        </h3>
        <div>
            <div class="w-8 *:max-w-full" :class="open ? '' : '-rotate-90'">
                @include('elements.icon.arrow-down-square')
            </div>
        </div>
    </div>
    <div class="relative overflow-hidden transition-all duration-500"
        :style="open ? 'height: ' + $el.scrollHeight + 'px;' : 'height: 0;'">
        <div class="p-8 [&>h3]:font-bold [&_a]:underline [&_p]:mb-4 [&_strong]:font-semibold">
            {!! $slot !!}
        </div>
    </div>
</div>
