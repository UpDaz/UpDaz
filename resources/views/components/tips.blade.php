<div class="relative ml-8 pl-16 pr-12 py-10 bg-slate-100" 
    x-data="{ visible:false }"
    x-intersect.once="visible = true"
>
    <div 
        class="w-24 max-h-full mx-auto absolute top-10 -left-36 opacity-0 transition-all duration-500"
        :class="visible? '!-left-12 opacity-100' : ''" 
    >
        @include('elements.illustrations.tips')
    </div>
    <div>
        {!! $content !!}
    </div>
</div>

