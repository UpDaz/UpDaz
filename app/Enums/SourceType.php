<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum SourceType: string implements HasColor, HasLabel
{
    case Rss = 'rss';
    case Scraper = 'scraper';

    public function getLabel(): string
    {
        return match ($this) {
            self::Rss => 'RSS',
            self::Scraper => 'Scraper',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::Rss => 'info',
            self::Scraper => 'warning',
        };
    }
}
