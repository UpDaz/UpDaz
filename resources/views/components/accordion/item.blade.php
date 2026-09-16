<div x-data='{ open: false }' class="relative flex flex-col">
    <div data-element="line-horizontal" class="absolute left-1/2 top-0 h-[1px] w-[125%] -translate-x-1/2"></div>
    <div data-element="line-horizontal" class="absolute bottom-0 left-1/2 h-[1px] w-[125%] -translate-x-1/2"></div>
    <div data-element="line-vertical" class="absolute left-0 top-1/2 h-[125%] w-[1px] -translate-y-1/2"></div>
    <div data-element="line-vertical" class="absolute right-0 top-1/2 h-[125%] w-[1px] -translate-y-1/2"></div>
    <div class="hover:bg-blue flex items-center justify-between gap-8 p-8 hover:cursor-pointer md:px-16" @click="open = !open">
        <h3 class="font-text font-normal md:text-lg">
            {!! $title !!}
        </h3>
        <div>
            <div class="w-8 h-8 *:w-full *:max-w-full" :class="open ? '' : '-rotate-90'">
                @include('elements.icon.arrow-down')
            </div>
        </div>
    </div>
    <div class="relative overflow-hidden transition-all duration-500" :style="open ? 'height: ' + $el.scrollHeight + 'px;' : 'height: 0;'">
        <span class="absolute left-1/2 top-0 -translate-x-1/2">
            @include('elements.icon.line')
        </span>
        <div class="p-8 [&>h3]:font-bold [&_a]:underline [&_p]:mb-4 [&_strong]:font-semibold">
            {!! $slot !!}
        </div>
    </div>
</div>
