<?php

namespace App\Livewire\Fontend;

use App\Models\Product;
use App\Traits\HasCart;
use Livewire\Attributes\Title;
use Livewire\Component;


#[Title("Trang chủ")]
class Welcome extends Component
{
    use HasCart;

    public function mount(){
        // dd($this->cart());
    }


    public function render()
    {
        return view('livewire.fontend.welcome', [
            'bestSeller' => Product::with("avatar")
                            ->select('id', 'name', 'avatar_id', 'state', 'slug')
                            ->where('state', 'published')
                            ->take(8)->get(),
            'mostViewedProducts' =>  Product::with("avatar")
                            ->select('id', 'name', 'avatar_id', 'state', 'slug')
                            ->where('state', 'published')
                            ->take(8)->get(),
            'newProducts' =>  Product::with("avatar")
                            ->select('id', 'name', 'avatar_id', 'state', 'slug')
                            ->where('state', 'published')
                            ->take(8)->get(),
        ]);
    }
}
