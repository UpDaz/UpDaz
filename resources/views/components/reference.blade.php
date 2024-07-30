<div x-data="{ open: false }" class="flex flex-col gap-4 p-6 rounded-lg bg-gradient-to-br from-blue-dark to-blue">
    <div class="flex flex-col items-start grid-cols-12 gap-4">
        <div class="col-span-4 [&_img]:ml-0 [&_img]:max-w-full [&_img]:h-16 md:[&_img]:h-12 [&_img]:w-full">
            {!! $logo !!}
        </div>
        <div class="w-10 h-1 bg-gray-100 rounded"></div>
        <div class="flex flex-col col-span-7 gap-4">
            <div class="flex flex-col items-start gap-3">
                <h3 class="m-0 text-xl text-white">{{ $title }}</h3>
                <button @click="open = !open" class="text-white underline" x-show="!open">
                    En savoir plus
                </button>
            </div>
            <div class="relative hidden overflow-hidden text-sm text-white transition-all duration-500 font-roboto"
                :class="!open || '!block'">
                {!! $content !!}
            </div>
        </div>
    </div>
</div>
