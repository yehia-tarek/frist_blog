<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class category extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function news(): BelongsToMany
    {
        return $this->belongsToMany(news::class,'news_categories', 'category_id', 'news_id');
    }

    public function childs()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function traverse($callback)
    {
        $callback($this);
        foreach ($this->children as $child) {
            $child->traverse($callback);
        }
    }

    public function delete_all_child ($category) {
        if(count($category->childs)){
            foreach($category->childs as $child){
                $category->delete_all_child($child) ;
                $child->delete();
            }
            $category->delete();
        }
    }


}
