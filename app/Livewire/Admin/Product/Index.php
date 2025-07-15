<?php

namespace App\Livewire\Admin\Product;

use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;



#[Layout('components.layouts.admin')]
#[Title('Sản Phẩm')]
class Index extends Component
{
    use WithPagination;

    public $amountInTrash;
    public array $sortBy = ['column' => 'name', 'direction' => 'asc'];

    public function delete(Product $product){
        // $product = Product::find($id);
        $product->delete();
        $this->amountInTrash = Product::onlyTrashed()->count();
        // $this->reset();
    }

    public function mount(){
        $this->amountInTrash = Product::onlyTrashed()->count();
    }

    public function render()
    {
        return view('livewire.admin.product.index', [
            'all' => Product::with('avatar')
                            ->withCount('views')
                            ->selectRaw('id, name, slug, avatar_id, state') // không cần thêm views_count
                            ->orderBy(...array_values($this->sortBy))
                            ->paginate(8)
        ]);
    }
}
