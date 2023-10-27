<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class news extends Model
{
    use HasFactory;

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(category::class,'news_categories', 'news_id', 'category_id');
    }

    // public function news_categories(): HasMany
    // {
    //     return $this->hasMany(news_category::class);
    // }
}
