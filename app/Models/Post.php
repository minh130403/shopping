<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Post extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = "posts";

    protected $guarded = [ ];

    public function avatar(){
        return $this->belongsTo(Photo::class, 'avatar_id');
    }

    public function views(){
        return $this->morphMany(View::class, 'viewable');
    }

        public static function slugChecker($slug, $i = 0, $currentId = null)
    {
        $newSlug = $i === 0 ? $slug : $slug . '-' . $i;

        $isExist = Post::withTrashed()
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
}
