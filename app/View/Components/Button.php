<?php

namespace App\View\Components;

use Illuminate\View\Component;

abstract class Button extends Component
{
    public function __construct(
        public string $tag = 'a',
        public bool $small = false,
        public string $classes = ''
    ) {
    }
}
