<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Product extends Model
{

    use HasFactory,  SoftDeletes;




    protected $table = "products";

    protected $primaryKey = "id";

    protected $keyType = "string";


    protected $guarded = [];

    public $incrementing = true;

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function avatar(){
        return $this->belongsTo(Photo::class, 'avatar_id');
    }

    public function gallery(){
        return $this->belongsToMany(Photo::class, 'product_images', 'product_id', 'photo_id');
    }

    public function comments(){
        return $this->morphMany(Comment::class, 'commentable');
    }

    public static function slugChecker($slug, $i = 0, $currentId = null)
    {
        $newSlug = $i === 0 ? $slug : $slug . '-' . $i;

        $isExist = Product::withTrashed()
            ->where('slug', $newSlug)
            ->when($currentId, function ($query) use ($currentId) {
                $query->where('id', '!=', $currentId); // Bỏ qua sản phẩm hiện tại
            })
            ->exists();

        if (!$isExist) {
            return Str::slug($newSlug);
        }

        return self::slugChecker($slug, $i + 1, $currentId);
    }


    public function productUsingAsItemOrder(){
        return $this->hasMany(OrderItem::class, 'product_id');
    }

    public function views(){
        return $this->morphMany(View::class, 'viewable');
    }
}
