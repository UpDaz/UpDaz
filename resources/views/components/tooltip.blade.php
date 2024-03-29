<span class="inline-block">
    <span 
        class="relative flex flex-col items-center group"
    >
        <span class="flex hover:cursor-pointer">
            {!! $content !!}
            @if ($displayIcon)
                <x-heroicon-m-question-mark-circle/>
            @endif
        </span>
        <span 
            class="absolute bottom-full hidden flex-col items-center mb-2 group-hover:flex w-[50vw] md:w-64 "
        >
            <span class="relative z-10 text-center text-sm leading-4 text-white whitespace-no-wrap bg-[{{ $color }}] shadow-lg rounded">
                <span class="block leading-5 text-left">
                    {!! $message !!}
                </span>
            </span>
            <span class="w-3 h-3 -mt-2 rotate-45 bg-[{{ $color }}]"></span>
        </span>
    </span>
</span>
