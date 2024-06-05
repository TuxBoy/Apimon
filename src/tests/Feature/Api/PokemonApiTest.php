<?php

declare(strict_types=1);

namespace Tests\Feature\Api;

use Tests\TestCase;

final class PokemonApiTest extends TestCase
{
    public function testGetPokemon(): void
    {
        $this
            ->withHeaders(['Accept-Language' => 'fr'])
            ->getJson('/api/pokemons/1')
            ->assertOk()
            ->assertExactJson([
                'data' => [
                    'pokedex_number' => 1,
                    'name' => 'Bulbizarre',
                    'height' => 7,
                    'weight' => 69,
                    'description' => 'Quand il est jeune,  il absorbe les nutriments conservés dans son dos pour grandir et se développer.',
                ]
            ])
        ;
    }

    public function testGetPokemonsCollection(): void
    {
        $this
            ->withHeaders(['Accept-Language' => 'fr'])
            ->getJson('/api/pokemons?offset=0&limit=10')
            ->assertOk()
            ->assertJsonCount(10, key: 'results')
            ->assertJson([
                'total' => 1303,
                'prev' => null,
                'next' => 'http://localhost/api/pokemons?page=2'
            ])
        ;

        $this
            ->withHeaders(['Accept-Language' => 'fr'])
            ->getJson('/api/pokemons?offset=3&limit=30')
            ->assertOk()
            ->assertJsonCount(30, key: 'results')
            ->assertJson([
                'total' => 1303,
                'prev' => 'http://localhost/api/pokemons?page=2',
                'next' => 'http://localhost/api/pokemons?page=4'
            ])
        ;
    }

    public function testGetPokemonFallback(): void
    {
        $this
            ->withHeaders(['Accept-Language' => 'fr'])
            ->getJson('/api/pokemons/1302')
            ->assertOk()
            ->assertExactJson([
                'data' => [
                    'description' => 'It’s thought that this Pokémon lived in ancient Paldea until it got caught in seismic shifts and went extinct.',
                    'pokedex_number' => 1024,
                    'name' => 'Terapagos',
                    'height' => 17,
                    'weight' => 770,
                ]
            ])
        ;
    }

    public function testThrowExceptionIfPokemonDoesNotExist(): void
    {
        $this
            ->getJson('/api/pokemons/0', headers: ['Accept-Language' => 'fr'])
            ->assertNotFound()
            ->assertJson(['message' => 'No query results for model [App\Models\Pokemon] 0'])
        ;
    }
}
