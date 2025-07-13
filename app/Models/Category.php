<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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


    public static function slugChecker($slug, $i = 0, $currentId = null)
    {
        $newSlug = $i === 0 ? $slug : $slug . '-' . $i;

        $isExist = Category::withTrashed()
            ->where('slug', $newSlug)
            ->when($currentId, function ($query) use ($currentId) {
                $query->where('id', '!=', $currentId);
            })
            ->exists();

        if (!$isExist) {
            return Str::slug($newSlug);
        }

        return self::slugChecker($slug, $i + 1, $currentId);
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
