<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

   //* hasMany
   //* BELONGS TO     



    function subcategories(){
        return $this->hasMany(SubCategory::class);
    }


}
