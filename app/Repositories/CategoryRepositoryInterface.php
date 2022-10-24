<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Support\Collection;

interface CategoryRepositoryInterface
{
   public function all(): Collection;

   public function actives(): Collection;

   public function getBySlug($slug): ?Category;
}
