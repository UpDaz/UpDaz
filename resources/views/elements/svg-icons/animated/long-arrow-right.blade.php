<div
    x-data="{ visible:false }"
    x-intersect.full="visible = true"
>
    <span
        class="inline-block -translate-x-36 opacity-0 transition-all duration-500"
        :class="visible? '!translate-x-0 opacity-100' : ''" 
    >
        @include('elements.svg-icons.long-arrow-right')
    </span>
</div>
