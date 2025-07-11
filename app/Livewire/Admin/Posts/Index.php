<?php

namespace App\Livewire\Admin\Posts;

use App\Models\Post;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title("Posts")]
#[Layout("components.layouts.admin")]
class Index extends Component
{
    use WithPagination;

    public $amountInTrash;

    public function delete(Post $post){
        // $product = Product::find($id);
        $post->delete();
        $this->amountInTrash = Post::onlyTrashed()->count();
        // $this->reset();
    }

    public function mount(){
        $this->amountInTrash = Post::onlyTrashed()->count();
    }


    public function render()
    {
        return view('livewire.admin.posts.index', [
            'all' => Post::with(["avatar", "views"])
                        ->select("id", "title", "slug", "avatar_id")
                        ->orderBy('created_at', 'desc')
                        ->paginate(10)
        ]);
    }
}
