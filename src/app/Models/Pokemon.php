<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Traits\HasLanguage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Pokemon extends Model
{
    use HasFactory;

    protected $table = 'pokemon';

    public $timestamps = false;

    protected $fillable = ['pokedex_number', 'name', 'height', 'weight'];

    public function descriptions(): HasMany
    {
        return $this->hasMany(Description::class);
    }

    public function names(): HasMany
    {
        return $this->hasMany(Name::class);
    }
}
