<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Reference extends Component
{
    public function __construct(
        public ?string $style,
    ) {
    }

    public function render(): View
    {
        return view('components.reference');
    }
}
