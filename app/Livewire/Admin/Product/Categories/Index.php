<?php

namespace App\Livewire\Admin\Product\Categories;

use App\Models\Category;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout("components.layouts.admin")]
#[Title("Product Categories")]
class Index extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.admin.product.categories.index', [
            'all' => Category::paginate(10)
        ]);
    }
}
