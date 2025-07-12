<?php

namespace App\Livewire\Fontend;

use App\Models\Category;
use Livewire\Component;



class Header extends Component
{
    public $root ;


    public function mount(){
        $this->root = Category::select('id', 'slug', 'name', 'avatar_id')
                        ->with('avatar')
                        ->whereNull('parent_category')
                        ->get();
    }

    public function render()
    {
        return view('livewire.fontend.header');
    }
}
