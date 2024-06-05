<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PokemonResource;
use App\Repository\PokemonRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @OA\Info(title="Pokemon API", version="1")
 */
final class PokemonController extends Controller
{
    private const DEFAULT_LIMIT = 10;

    public function __construct(private readonly PokemonRepositoryInterface $pokemonRepository)
    {
    }

    /**
     * @OA\Get(
     *    tags={"pokemons"},
     *    path="/api/pokemons",
     *    summary="Get pokemons list",
     *    operationId="api.pokemons.list",
     *    @OA\Parameter(
     *        name="offset",
     *        required=false,
     *        @OA\Schema(
     *            type="integer",
     *            default=0
     *        ),
     *        in="query",
     *        description="Offset of the pagination",
     *    ),
     *    @OA\Parameter(
     *        name="limit",
     *        required=false,
     *        @OA\Schema(
     *            type="integer",
     *            default=10
     *        ),
     *        in="query",
     *        description="Limit of the pagination",
     *    ),
     *    @OA\Response(
     *        response=200,
     *        description="OK",
     *        @OA\JsonContent(
     *            example={
     *                "total": 1302,
     *                "prev": "http://127.0.0.1:8081/api/pokemons?offset=0&limit=5",
     *                "next": "http://127.0.0.1:8081/api/pokemons?offset=10&limit=5",
     *                "results": {
     *                    {
     *                        "id": 6,
     *                        "name": "Dracaufeu",
     *                        "sprites": {
     *                            {
     *                                "type": "back",
     *                                "url": "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/back/6.png"
     *                            },
     *                            {
     *                                "type": "back_shiny",
     *                                "url": "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/back/shiny/6.png"
     *                            },
     *                            {
     *                                "type": "front",
     *                                "url": "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/6.png"
     *                            },
     *                            {
     *                                "type": "front_shiny",
     *                                "url": "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/6.png"
     *                            }
     *                        }
     *                    },
     *                    {
     *                        "id": 7,
     *                        "name": "Carapuce",
     *                        "sprites": {
     *                            {
     *                                "type": "back",
     *                                "url": "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/back/7.png"
     *                            },
     *                            {
     *                                "type": "back_shiny",
     *                                "url": "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/back/shiny/7.png"
     *                            },
     *                            {
     *                                "type": "front",
     *                                "url": "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/7.png"
     *                            },
     *                            {
     *                                "type": "front_shiny",
     *                                "url": "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/7.png"
     *                            }
     *                        }
     *                    },
     *                    {
     *                        "id": 8,
     *                        "name": "Carabaffe",
     *                        "sprites": {
     *                            {
     *                                "type": "back",
     *                                "url": "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/back/8.png"
     *                            },
     *                            {
     *                                "type": "back_shiny",
     *                                "url": "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/back/shiny/8.png"
     *                            },
     *                            {
     *                                "type": "front",
     *                                "url": "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/8.png"
     *                            },
     *                            {
     *                                "type": "front_shiny",
     *                                "url": "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/8.png"
     *                            }
     *                        }
     *                    },
     *                    {
     *                        "id": 9,
     *                        "name": "Tortank",
     *                        "sprites": {
     *                            {
     *                                "type": "back",
     *                                "url": "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/back/9.png"
     *                            },
     *                            {
     *                                "type": "back_shiny",
     *                                "url": "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/back/shiny/9.png"
     *                            },
     *                            {
     *                                "type": "front",
     *                                "url": "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/9.png"
     *                            },
     *                            {
     *                                "type": "front_shiny",
     *                                "url": "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/9.png"
     *                            }
     *                        }
     *                    },
     *                    {
     *                        "id": 10,
     *                        "name": "Chenipan",
     *                        "sprites": {
     *                            {
     *                                "type": "back",
     *                                "url": "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/back/10.png"
     *                            },
     *                            {
     *                                "type": "back_shiny",
     *                                "url": "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/back/shiny/10.png"
     *                            },
     *                            {
     *                                "type": "front",
     *                                "url": "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/10.png"
     *                            },
     *                            {
     *                                "type": "front_shiny",
     *                                "url": "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/10.png"
     *                            }
     *                        }
     *                    }
     *                }
     *            }
     *        )
     *    )
     * )
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request): JsonResponse
    {
        $offset = (int) $request->get('offset', default: 0);
        $limit = (int) $request->get('limit', default: self::DEFAULT_LIMIT);
        $pokemons = $this->pokemonRepository->list(offset: $offset, limit: $limit);

        return new JsonResponse(data: [
            'total' => $pokemons->total(),
            'results' => $pokemons->items(),
            'prev' => $pokemons->previousPageUrl(),
            'next' => $pokemons->nextPageUrl(),
        ]);
    }

    /**
     * @OA\Get(
     *    tags={"pokemons"},
     *    path="/api/pokemons/{pokemonId}",
     *    summary="Get a pokemon information",
     *    operationId="api.pokemons.get",
     *    @OA\Parameter(
     *        name="pokemonId",
     *        required=true,
     *        @OA\Schema(
     *            type="integer"
     *        ),
     *        in="path",
     *        description="Id of the pokemon",
     *    ),
     *    @OA\Response(
     *        response=200,
     *        description="OK",
     *        @OA\JsonContent(
     *            example={
     *                "id": 1,
     *                "name": "Bulbizarre",
     *                "description": "Quand il est jeune,  il absorbe les nutriments conservés dans son dos pour grandir et se développer.",
     *                "types": {
     *                    {
     *                        "name": "Poison",
     *                        "url": "https://www.pokepedia.fr/images/4/45/Icône_Type_Poison_HOME.png",
     *                        "position": 2
     *                    },
     *                    {
     *                        "name": "Plante",
     *                        "url": "https://www.pokepedia.fr/images/0/0b/Icône_Type_Plante_HOME.png",
     *                        "position": 1
     *                    }
     *                },
     *                "sprites": {
     *                    {
     *                        "type": "back",
     *                        "url": "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/back/1.png"
     *                    },
     *                    {
     *                        "type": "back_shiny",
     *                        "url": "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/back/shiny/1.png"
     *                    },
     *                    {
     *                        "type": "front",
     *                        "url": "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/1.png"
     *                    },
     *                    {
     *                        "type": "front_shiny",
     *                        "url": "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/shiny/1.png"
     *                    }
     *                },
     *                "cries": {
     *                    {
     *                        "type": "latest",
     *                        "url": "https://raw.githubusercontent.com/PokeAPI/cries/main/cries/pokemon/latest/1.ogg"
     *                    },
     *                    {
     *                        "type": "legacy",
     *                        "url": "https://raw.githubusercontent.com/PokeAPI/cries/main/cries/pokemon/legacy/1.ogg"
     *                    }
     *                }
     *            }
     *        )
     *    )
     * )
     *
     * @param int $id
     * @return JsonResponse
     */
    public function get(int $id, Request $request): PokemonResource
    {
        $locale = $request->header('accept-language');
        $pokemon = $this->pokemonRepository->byId($id);

        return new PokemonResource($pokemon);
    }
}
