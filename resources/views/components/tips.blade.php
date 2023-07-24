<div class="relative py-10 pl-16 pr-12 ml-8 text-left bg-slate-100" 
    x-data="{ visible:false }"
    x-intersect.once="visible = true"
>
    <div 
        class="absolute w-24 max-h-full mx-auto text-center transition-all duration-500 opacity-0 top-10 -left-36"
        :class="visible? '!-left-12 opacity-100' : ''" 
    >
        <x-heroicon-s-light-bulb class="sm:w-12 sm:h-12 text-orange"/>
    </div>
    <div>
        {!! $content !!}
    </div>
</div>

