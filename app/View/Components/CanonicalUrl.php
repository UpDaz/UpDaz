<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\URL;
use Illuminate\View\Component;

class CanonicalUrl extends Component
{
    public function render(): View
    {
        return view('components.canonical-url', [
            'canonicalUrl' => $this->getCanonicalUrl(),
        ]);
    }

    private function getCanonicalUrl(): string
    {
        $currentUrl = URL::current();

        return str_replace(
            [
                'http://updaz',
                'https://updaz',
            ],
            [
                'https://www.updaz',
                'https://www.updaz',
            ],
            $currentUrl
        );
    }
}
