<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Pokemon;
use Illuminate\Pagination\LengthAwarePaginator;

final class PokemonRepository implements PokemonRepositoryInterface
{
    public function list(int $offset, int $limit): LengthAwarePaginator
    {
        return Pokemon::query()
            ->paginate(perPage: $limit, page: $offset)
        ;
    }

    public function byId(int $id): Pokemon
    {
        return Pokemon::query()->findOrFail($id);
    }
}
