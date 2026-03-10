<?php

namespace App\View\Components\Reference;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Item extends Component
{
    public function render(): View|Closure|string
    {
        return view('components.reference.item');
    }
}
