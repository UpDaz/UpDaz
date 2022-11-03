<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Tooltip extends Component
{
    public $color;
    public $displayIcon;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($color = "#000000", $displayIcon = true)
    {
        $this->color = $color;
        $this->displayIcon = $displayIcon;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.tooltip');
    }
}
