<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class Search extends Component
{


    public $keyword;

    public $results;

    public $object;

    // public function goToResultPage(){
    //     return redirect()->to('search/' . $this->keyword);
    // }

    public function updatedKeyword(){
           $keyword = trim($this->keyword);

            if (strlen($keyword) < 1) {
                $this->results = [];
                return;
            }

            $this->results = Product::with('avatar')->select('name', 'slug', 'id', 'avatar_id')
                ->where('name', 'like', '%' . $keyword . '%')
                ->orWhere('name', 'like', '%' . ucfirst($keyword) . '%')
                ->limit(100)
                ->get();

    }



    public function render()
    {
        return view('livewire.search');
    }
}
