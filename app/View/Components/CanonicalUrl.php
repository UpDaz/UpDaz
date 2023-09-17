<?php

namespace App\View\Components;

use Illuminate\Support\Facades\URL;
use Illuminate\View\Component;

class CanonicalUrl extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.canonical-url', [
            'canonicalUrl' => $this->getCanonicalUrl(),
        ]);
    }

    private function getCanonicalUrl()
    {
        $currentUrl = URL::current();

        return str_replace(
            [
                'http://updaz',
                'https://updaz',
            ],
            [
                'https://www.updaz',
            ],
            $currentUrl
        );
    }
}
