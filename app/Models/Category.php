<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    use HasFactory;

    protected $table = "categories";

    protected $primaryKey = "id";

    protected $guarded = [];

    public function avatar(){
        return $this->belongsTo(Photo::class, 'avatar_id');
    }

    public function children(){
        return $this->hasMany(Category::class, 'parent_category');
    }

    public function parent(){
        return $this->belongsTo(Category::class, 'parent_category');
    }

    public function products(){
        return $this->hasMany(Product::class, 'category_id');
    }


    public function getAllCategoryIds(): array
    {
        $ids = [$this->id];

        foreach ($this->children as $child) {
            $ids = array_merge($ids, $child->getAllCategoryIds());
        }

        return $ids;
    }


}
