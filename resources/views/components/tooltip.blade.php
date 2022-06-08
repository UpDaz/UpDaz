<div 
    class="relative flex flex-col items-center group"
>
    {!! $content !!}
    <div 
        class="absolute bottom-full hidden flex-col items-center mb-2 group-hover:flex w-[300%] md:w-64 "
    >
        <span class="relative z-10 px-6 py-4 text-center text-sm leading-4 text-white whitespace-no-wrap bg-[{{ $color }}] rounded shadow-lg">
            {!! $message !!}
        </span>
        <div class="w-3 h-3 -mt-2 rotate-45 bg-[{{ $color }}]"></div>
    </div>
</div>