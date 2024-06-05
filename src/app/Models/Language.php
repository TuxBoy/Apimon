<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Traits\NoTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $table = 'language';

    public $timestamps = false;

    protected $fillable = ['locale'];
}
