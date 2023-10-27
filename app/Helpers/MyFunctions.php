<?php

namespace App\Helpers;
use App\Models\category;
use PhpParser\Node\Stmt\Foreach_;


function sub_categories($id){
    $sub_category = category::all()->where('parent_id',$id) ;
    return $sub_category ;
}
function get_category_option ($categories = null){
    $categories = category::all()->where('parent_id', 0);
    foreach ($categories as $category) {
        echo "<option value='$category->id'>$category->name</option>";
        if (! empty(sub_categories($category->id))){
            
        }
    }
}


?>
