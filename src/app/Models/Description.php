<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Traits\HasLanguage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Description extends Model
{
    use HasFactory;
    use HasLanguage;

    protected $table = 'description';

    public $timestamps = false;

    protected $fillable = ['text'];

    public function pokemon(): BelongsTo
    {
        return $this->belongsTo(Pokemon::class);
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }
}
