<?php

declare(strict_types=1);

namespace App\Models\Traits;

use App\Models\Language;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasLanguage
{
    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }
}
