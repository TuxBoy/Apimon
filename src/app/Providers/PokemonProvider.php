<?php

declare(strict_types=1);

namespace App\Providers;

use App\Repository\PokemonRepository;
use App\Repository\PokemonRepositoryInterface;
use Illuminate\Support\ServiceProvider;

final class PokemonProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(PokemonRepositoryInterface::class, PokemonRepository::class);
    }
}
