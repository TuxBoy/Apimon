<?php

declare(strict_types=1);

namespace Tests\Feature\Api;

use App\Models\Pokemon;
use Tests\TestCase;

final class PokemonApiTest extends TestCase
{
    public function testGetPokemon(): void
    {
        Pokemon::factory()->create();

        $response = $this->get('/api/pokemons/1');

        $response->assertOk();
    }
}
