<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Photo;
use App\Models\Post;
use App\Models\Product;
use App\Models\User;
use App\Models\View;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{

    public static function createCategory($array,?Category $parent = null, $avatar = null){
        foreach ($array as $name) {
            Category::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'parent_category' => $parent?->id,
                'avatar_id' => $avatar->id
            ]);
        }
    }

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $photoCategory = Photo::create([
            'path' => '/photos/category.jpg'
        ]);

        $photoProduct = Photo::create([
            'path' => "/photos/sample_product.webp"
        ]);

        $arrParent = [
            'Thùng rác',
            'Thiết bị giao thông',
            'Thiết bị khách sạn',
            'Xe đẩy phục vụ',
            'Cột chắn inox',
            'Thiết bị nhà tắm',
            'Dụng cụ vệ sinh',
            'Máy đánh giầy',
            'Thiết bị ngoại cảnh',
            'Nhựa chống tĩnh điện',
            'Hàng thanh lý'
        ];

        DatabaseSeeder::createCategory(array: $arrParent, avatar: $photoCategory);

        $parentCategory = Category::all();


        foreach($parentCategory as $parent)
        {
            for($i = 1; $i< fake()->numberBetween(3,10); $i++){
                Category::factory()->create([
                    'parent_category' => $parent->id,
                    'avatar_id' => $photoCategory->id
                ]);
            }
        }


        $childCategories = Category::whereNotNull('parent_category')->get();

        foreach($childCategories as $category){
            for($i = 1; $i< fake()->numberBetween(8,15); $i++){
                Product::factory()->create([
                    'avatar_id' => $photoProduct->id,
                    'category_id' => $category->id,
                ]);
            }
        }

        foreach(Product::all() as $item){
            View::factory()->count(fake()->numberBetween(0, 360))->forViewable($item)->create(['created_at' => fake()->dateTimeThisMonth('now')]);
            Comment::factory()->count(fake()->numberBetween(0,10))->forCommentable($item)->create();
        }


        Post::factory()->count(36)->create();

        foreach(Post::all() as $item){
            View::factory()->count(fake()->numberBetween(0, 360))->forViewable($item)->create();
        }


        Order::factory()->count(36)->create();

        foreach(Order::all() as $order){
            $totalAmount = 0;
            $totalValue = 0;

            foreach(Product::inRandomOrder()->take(fake()->numberBetween(1,5))->get() as $item){
                $amount = fake()->numberBetween(1, 10);
                $value = $amount * $item->price;

                $totalAmount += $amount;
                $totalValue += $value;

                OrderItem::factory()->create([
                     'order_id' => $order->id,
                    'product_id' => $item->id,
                    'product_name' => $item->name,
                    'price' => $item->price,
                    'amount' => $amount,
                    'total_price' => $value
                ]);
            }

            $order->update([
                'amount' => $totalAmount,
                'value' => $totalValue
            ]);
        }
    }
}
