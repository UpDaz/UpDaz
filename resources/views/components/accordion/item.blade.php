<div x-data='{ open: false }' x-id="['accordion-panel']" class="relative flex flex-col p-px">
    <div data-element="line-horizontal" class="absolute left-1/2 top-0 h-[1px] w-[125%] -translate-x-1/2"></div>
    <div data-element="line-horizontal" class="absolute bottom-0 left-1/2 h-[1px] w-[125%] -translate-x-1/2"></div>
    <div data-element="line-vertical" class="absolute left-0 top-1/2 h-[125%] w-[1px] -translate-y-1/2"></div>
    <div data-element="line-vertical" class="absolute right-0 top-1/2 h-[125%] w-[1px] -translate-y-1/2"></div>
    <h3 class="text-base md:text-lg">
        <button type="button" class="hover:bg-blue flex w-full items-center justify-between gap-8 p-8 text-left md:px-16"
            @click="open = !open" :aria-expanded="open.toString()" :aria-controls="$id('accordion-panel')">
            <span>{!! $title !!}</span>
            <span class="w-8 h-8 shrink-0 *:w-full *:max-w-full" :class="open ? '' : '-rotate-90'" aria-hidden="true">
                @include('elements.icon.arrow-down')
            </span>
        </button>
    </h3>
    <div :id="$id('accordion-panel')" class="relative overflow-hidden transition-all duration-500"
        :style="open ? 'height: ' + $el.scrollHeight + 'px;' : 'height: 0;'" :inert="!open">
        <span class="absolute left-1/2 top-0 -translate-x-1/2">
            @include('elements.icon.line')
        </span>
        <div class="p-8 [&>h3]:font-bold [&_a]:underline [&_p]:mb-4 [&_strong]:font-semibold">
            {!! $slot !!}
        </div>
    </div>
</div>
