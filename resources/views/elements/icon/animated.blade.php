<div
    x-data="{ visible:false }"
    x-intersect.full="visible = true"
>
    <span
        class="inline-block transition-all duration-500 opacity-0 -translate-x-36"
        :class="visible? '!translate-x-0 opacity-100' : ''" 
    >
        @svg('heroicon-' . $icon, $class ?? '')
    </span>
</div>
