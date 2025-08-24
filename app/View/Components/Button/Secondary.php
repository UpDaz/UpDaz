<?php

namespace App\View\Components\Button;

use App\View\Components\Button;
use Illuminate\View\Component;

class Secondary extends Button
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.button.secondary');
    }
}
