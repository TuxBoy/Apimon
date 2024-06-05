<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Pokemon;
use Illuminate\Pagination\LengthAwarePaginator;

interface PokemonRepositoryInterface
{
    public function list(int $offset, int $limit): LengthAwarePaginator;

    public function byId(int $id): Pokemon;
}
