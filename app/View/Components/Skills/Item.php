<?php

namespace App\View\Components\Skills;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Item extends Component
{
    public function __construct(
        public ?string $icon = null,
        public ?string $text = null
    ) {
    }

    public function render(): View|Closure|string
    {
        return view('components.skills.item');
    }
}
