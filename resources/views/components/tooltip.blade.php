<span class="inline-block">
    <span class="relative flex flex-col items-center group">
        <span class="flex hover:cursor-pointer">
            {!! $content !!}
            @if ($displayIcon)
                <span class="*:h-4 *:w-auto inline-block items-center mx-1">
                    @include('elements.icon.question-mark')
                </span>
            @endif
        </span>
        <span class="absolute bottom-full hidden flex-col items-center mb-2 group-hover:flex w-[50vw] md:w-64 ">
            <span
                class="relative z-10 text-sm leading-4 text-center text-white whitespace-no-wrap rounded shadow-lg bg-blue">
                <span class="block leading-5 text-left">
                    {!! $message !!}
                </span>
                <span data-element="line-horizontal" class="absolute h-[1px] left-1/2 w-[125%] -translate-x-1/2 top-0">
                </span>
                <span data-element="line-horizontal" class="absolute h-[1px] left-1/2 w-[125%] -translate-x-1/2 bottom-0">
                </span>
                <span data-element="line-vertical" class="absolute w-[1px] top-1/2 h-[125%] -translate-y-1/2 left-0">
                </span>
                <span data-element="line-vertical" class="absolute w-[1px] top-1/2 h-[125%] -translate-y-1/2 right-0">
                </span>
            </span>
            <span class="w-3 h-3 -mt-2 rotate-45 bg-blue"></span>
        </span>
    </span>
</span>
