<div class="mt-12 sm:mt-16 lg:mt-0 lg:col-span-6">
    <div class="w-full h-[20rem] sm:h-[42rem] rounded-lg overflow-hidden" style="perspective: 700px;">
        <div class="grid grid-cols-3 gap-12 w-[60rem] sm:w-[80rem] lg:w-[50rem] h-[55rem] md:h-[90rem] lg:h-[57rem] overflow-hidden origin-[50%_0%]"
            style="transform: translate3d(7%, -2%, 0px) scale3d(0.9, 0.8, 1) rotateX(15deg) rotateY(-9deg) rotateZ(32deg);">
            <div class="grid w-full gap-9 animation-sliding-img-up-1">
                @php
                    shuffle($images)
                @endphp
                @foreach($images as $image_path)
                @include('elements.html.webp-image', [
                    'source' => $image_path,
                    'alt' => 'Image Technologique UpDaz',
                    'width' => '100',
                    'height' => '100',
                    'class' => 'w-full object-cover shadow-lg p-2 bg-white border-2 rounded border-blue-dark dark:shadow-gray-900/[.75]',
                ])
                @endforeach
            </div>
            <div class="grid w-full gap-9 animation-sliding-img-down-1">
                @php
                    shuffle($images)
                @endphp
                @foreach($images as $image_path)
                @include('elements.html.webp-image', [
                    'source' => $image_path,
                    'alt' => 'Image Technologique UpDaz',
                    'width' => '100',
                    'height' => '100',
                    'class' => 'w-full object-cover shadow-lg p-2 bg-white border-2 rounded border-blue-dark dark:shadow-gray-900/[.75]',
                ])
                @endforeach
            </div>
            <div class="grid w-full gap-9 animation-sliding-img-up-2">
                @php
                    shuffle($images)
                @endphp
                @foreach($images as $image_path)
                @include('elements.html.webp-image', [
                    'source' => $image_path,
                    'alt' => 'Image Technologique UpDaz',
                    'width' => '100',
                    'height' => '100',
                    'class' => 'w-full object-cover shadow-lg p-2 bg-white border-2 rounded border-blue-dark dark:shadow-gray-900/[.75]',
                ])
                @endforeach
            </div>
        </div>
    </div>
</div>
