<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Breadcrumb extends Component
{
    public function __construct(public array $links = [])
    {
    }

    public function render(): View
    {
        return view('components.breadcrumb');
    }
}
