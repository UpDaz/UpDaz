<div 
    class="relative flex flex-col items-center group"
>
    {!! $content !!}
    <div 
        class="absolute bottom-full hidden flex-col items-center mb-2 group-hover:flex w-[50vw] md:w-64 "
    >
        <div class="relative z-10 text-center text-sm leading-4 text-white whitespace-no-wrap bg-[{{ $color }}] shadow-lg">
            <span class="text-left">
                {!! $message !!}
            </span>
        </div>
        <div class="w-3 h-3 -mt-2 rotate-45 bg-[{{ $color }}]"></div>
    </div>
</div>
