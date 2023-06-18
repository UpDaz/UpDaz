<?php

namespace App\View\Components;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Illuminate\View\Component;

class WelcomeScroller extends Component
{
    public $images = [];
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->images = File::glob(public_path('img') . '/welcome-scroller/*');
        foreach ($this->images as $key => $path) {
            $this->images[$key] = str_replace(public_path('img'), URL::asset('img'), $path);
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.welcome-scroller');
    }
}
