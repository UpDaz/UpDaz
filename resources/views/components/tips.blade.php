<div class="relative text-left" x-data="{ visible: false }" x-intersect.once="visible = true">
    <div class="relative py-8 pl-16">
        <div class="flex items-center gap-16">
            <span class="*:w-16 *:h-auto">
                @include('elements.icon.light')
            </span>
            <div>
                {!! $content !!}
            </div>
        </div>
            <div data-element="line-horizontal" class="absolute h-[1px] left-1/2 w-[125%] -translate-x-1/2 top-0"></div>
    <div data-element="line-horizontal" class="absolute h-[1px] left-1/2 w-[125%] -translate-x-1/2 bottom-0"></div>
    <div data-element="line-vertical" class="absolute w-[1px] top-1/2 h-[125%] -translate-y-1/2 left-0"></div>
    <div data-element="line-vertical" class="absolute w-[1px] top-1/2 h-[125%] -translate-y-1/2 right-0"></div>
    </div>
</div>
