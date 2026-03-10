<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Illuminate\View\Component;

class WelcomeScroller extends Component
{
    public mixed $images = [];

    public function __construct()
    {
        $this->images = File::glob(public_path('img') . '/welcome-scroller/*') ?: [];

        foreach ($this->images as $key => $path) {
            $fileInformation = getimagesize($path);
            $this->images[$key] = [
                'path' => str_replace(public_path('img'), URL::asset('img'), $path),
            ];
            if ($fileInformation !== false) {
                $this->images[$key] = array_merge($this->images[$key], [
                    'width' => $fileInformation[0],
                    'height' => $fileInformation[1],
                ]);
            }
        }
    }

    public function render(): View
    {
        return view('components.welcome-scroller');
    }
}
