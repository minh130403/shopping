<?php

namespace App\Livewire\Admin\Pages;

use App\Models\Page;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout("components.layouts.admin")]
#[Title("Quản Lý Trang")]
class Index extends Component
{
    use WithPagination;

    public function delete(Page $page){
        // $product = Product::find($id);
        $page->delete();
        // $this->reset();
    }

    public function render()
    {
        return view('livewire.admin.pages.index', [
            'all' =>  Page::select("id", "title")->get()
        ]);
    }
}
