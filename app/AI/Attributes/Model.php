<?php

namespace App\AI\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class Model
{
    public function __construct(
        public readonly string $model,
    ) {
    }
}
