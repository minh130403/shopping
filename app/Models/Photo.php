<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Photo extends Model
{


    protected $table = "photos";

    protected $primaryKey = "id";

    protected $guarded = [];


    public function productsUsingAsAvatar(){
        return $this->hasMany(Product::class);
    }

    public function products(){
        return $this->belongsToMany(Product::class, 'product_images', 'photo_id', 'product_id');
    }

       public function categoriesUsingAsAvatar(){
        return $this->belongsTo(Category::class);
    }

    public function postsUsingAsAvatar(){
        return $this->hasMany(Post::class);
    }

}
