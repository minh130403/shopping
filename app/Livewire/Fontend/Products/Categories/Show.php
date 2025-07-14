<?php

namespace App\Livewire\Fontend\Products\Categories;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination;

    public Category $category;
    // public $products;


    public function mount($slug){
        $this->category = Category::where('slug', $slug)->firstOrFail();
        // dd($this->category->getAllCategoryIds());
    }

    public function render()
    {
        return view('livewire.fontend.products.categories.show', [
            'products' => Product::with('avatar')
                            ->select('id', 'slug', 'name', 'avatar_id', 'price')
                            ->whereIn('category_id', $this->category->getAllCategoryIds())
                            ->where('state', 'published')
                            ->paginate(8),
            'root' => Category::whereNull("parent_category")->get()
        ])->title($this->category->name);
    }
}
