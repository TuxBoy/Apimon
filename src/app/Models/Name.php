<?php

namespace App\Models;

use App\Models\Traits\HasLanguage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Name extends Model
{
    use HasFactory;
    use HasLanguage;

    protected $table = 'name';

    public $timestamps = false;

    protected $fillable = ['text'];

    public function pokemon(): BelongsTo
    {
        return $this->belongsTo(Pokemon::class);
    }
}
