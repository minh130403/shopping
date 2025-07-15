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
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public static function createCategory($array, ?Category $parent = null, $avatar = null)
    {
        $categories = [];
        foreach ($array as $name) {
            $categories[] = [
                'name' => $name,
                'slug' => Category::slugChecker($name),
                'parent_category' => $parent?->id,
                'avatar_id' => $avatar->id,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        Category::insert($categories);
    }

    public function run(): void
    {
        $photoCategory = Photo::create(['path' => '/photos/category.jpg']);
        $photoProduct = Photo::create(['path' => '/photos/sample_product.webp']);

        $arrParent = [
            'Thiết bị giao thông',
            'Thiết bị khách sạn',
            'Xe đẩy phục vụ',
            'Cột chắn inox',
        ];

        self::createCategory($arrParent, null, $photoCategory);

        $parentCategory = Category::cursor();
        $subCategories = [];

        foreach ($parentCategory as $parent) {
            for ($i = 0;$i < 2; $i++) {
                $subCategories[] = Category::factory()->make([
                    'parent_category' => $parent->id,
                    'avatar_id' => $photoCategory->id,
                ])->toArray();
            }
        }
        Category::insert($subCategories);

        $childCategories = Category::whereNotNull('parent_category')->get();
        $allProducts = [];

        foreach ($childCategories as $category) {
            $products = Product::factory()->count(4)->make([
                'avatar_id' => $photoProduct->id,
                'category_id' => $category->id,
            ])->toArray();
            $allProducts = array_merge($allProducts, $products);
        }
        Product::insert($allProducts);

        // $views = [];
        $comments = [];

        foreach (Product::cursor() as $item) {
            // foreach (range(1, 3) as $i) {
            //     $views[] = View::factory()->make([
            //         'viewable_id' => $item->id,
            //         'viewable_type' => Product::class,
            //         'created_at' => fake()->dateTimeThisMonth('now'),
            //     ])->toArray();
            // }
            foreach (range(1, 3) as $i) {
                $comments[] = Comment::factory()->make([
                    'commentable_id' => $item->id,
                    'commentable_type' => Product::class,
                ])->toArray();
            }
        }
        // View::insert($views);
        Comment::insert($comments);

        Post::factory()->count(3)->create();

        // $postViews = [];
        // foreach (Post::cursor() as $post) {
        //     foreach (range(1, 3) as $i) {
        //         $postViews[] = View::factory()->make([
        //             'viewable_id' => $post->id,
        //             'viewable_type' => Post::class,
        //         ])->toArray();
        //     }
        // }
        // View::insert($postViews);

        Order::factory()->count(7)->create();

        $orderItems = [];
        foreach (Order::cursor() as $order) {
            $totalAmount = 0;
            $totalValue = 0;

            foreach (Product::inRandomOrder()->take(fake()->numberBetween(1, 2))->get() as $item) {
                $amount = fake()->numberBetween(1, 10);
                $value = $amount * $item->price;

                $totalAmount += $amount;
                $totalValue += $value;

                $orderItems[] = [
                    'order_id' => $order->id,
                    'product_id' => $item->id,
                    'product_name' => $item->name,
                    'price' => $item->price,
                    'amount' => $amount,
                    'total_price' => $value,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            $order->update([
                'amount' => $totalAmount,
                'value' => $totalValue,
            ]);
        }
        OrderItem::insert($orderItems);
    }
}
