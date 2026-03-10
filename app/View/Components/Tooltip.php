<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Tooltip extends Component
{
    public function __construct(
        public string $color = '#000000',
        public bool $displayIcon = true,
    ) {
    }

    public function render(): View
    {
        return view('components.tooltip');
    }
}
