<?php

namespace App\Livewire\Admin\Product;

use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;


#[Layout('components.layouts.admin')]
#[Title("Product Trash")]

class Trash extends Component
{

    public function restore($id){
        $product = Product::onlyTrashed()->find($id);
        $product->restore();
    }

    public function forceDelete($id){
        $product = Product::onlyTrashed()->find($id);
        $product->forceDelete();
    }


    public function render()
    {
        return view('livewire.admin.product.trash', [
            'all' => Product::onlyTrashed()->paginate(10)
        ]);
    }
}
