<?php

namespace App\Livewire\Admin\Posts;

use App\Models\Post;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;


#[Layout('components.layouts.admin')]
#[Title("Product Trash")]

class Trash extends Component
{
    public function restore($id){
        $post = Post::onlyTrashed()->find($id);
        $post->restore();
    }

    public function forceDelete($id){
        $post = Post::onlyTrashed()->find($id);
        $post->forceDelete();
    }


    public function render()
    {
        return view('livewire.admin.posts.trash', [
             'all' => Post::onlyTrashed()->paginate(10)
        ]);
    }
}
