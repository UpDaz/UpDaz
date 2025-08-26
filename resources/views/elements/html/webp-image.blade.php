<picture>
    <source srcset="{{ str_replace(['.png', '.jpg', '.jpeg'], '.webp', $source) }}" type="image/webp">
    <img 
        src="{{ $source }}" 
        alt="{{ $alt ?? '' }}" 
        title="{{ $title ?? ($alt ?? '') }}"
        loading="{{ $loading ?? 'lazy' }}"
        width="{{ $width ?? 'auto'}}"
        height="{{ $height ?? 'auto' }}"
        class="{{ $class ?? '' }}" >
</picture>
