<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class news_category extends Model
{
    use HasFactory;

    // public function news(): BelongsTo
    // {
    //     return $this->belongsTo(news::class);
    // }
}
