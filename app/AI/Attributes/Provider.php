<?php

namespace App\AI\Attributes;

use App\AI\Lab;
use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class Provider
{
    public function __construct(
        public readonly Lab $lab,
    ) {
    }
}
