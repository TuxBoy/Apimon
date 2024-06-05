<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class PokemonResource extends JsonResource
{
    private const DEFAULT_LANGUAGE = 'en';
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'pokedex_number' => $this->pokedex_number,
            'name' => $this->getTextNameOfPokemon($request),
            'height' => $this->height,
            'weight' => $this->weight,
            'description' => $this->getTextDescriptionOfPokemon($request),
        ];
    }

    private function getTextDescriptionOfPokemon(Request $request): ?string
    {
        $locale = $request->header('accept-language');
        $description = $this->descriptions->where('language.locale', $locale)->first();
        if (null === $description) {
            $description = $this->descriptions->where('language.locale', self::DEFAULT_LANGUAGE)->first();
        }

        return $description->text ?? null;
    }

    private function getTextNameOfPokemon(Request $request): ?string
    {
        $locale = $this->getLocale($request);
        $name = $this->names->where('language.locale', $locale)->first();
        if (null === $name) {
            $name = $this->names->where('language.locale', self::DEFAULT_LANGUAGE)->first();
        }

        return $name->text ?? null;
    }

    private function getLocale(Request $request): string
    {
        return $request->header('accept-language');
    }
}
