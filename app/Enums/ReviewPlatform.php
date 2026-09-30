<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum ReviewPlatform: string implements HasColor, HasLabel
{
    case Google = 'google';
    case Malt = 'malt';

    public function getLabel(): string
    {
        return match ($this) {
            self::Google => 'Google',
            self::Malt => 'Malt',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::Google => 'info',
            self::Malt => 'danger',
        };
    }
}
