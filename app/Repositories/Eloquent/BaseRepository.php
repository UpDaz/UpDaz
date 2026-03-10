<?php

namespace App\Repositories\Eloquent;

use App\Repositories\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements EloquentRepositoryInterface
{
    public function __construct(protected Model $model)
    {
    }

    public function find(int|string $id): ?Model
    {
        return $this->model->find($id);
    }
}
