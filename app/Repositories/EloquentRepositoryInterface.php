<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * Interface EloquentRepositoryInterface
 */
interface EloquentRepositoryInterface
{
    public function find(int|string $id): ?Model;
}
