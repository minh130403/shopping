<?php

namespace App\Livewire\Fontend\Posts;

use App\Models\Category;
use App\Models\Post;
use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;



class Show extends Component
{


    public ?Post $selectedPost;

    public function mount($slug){
        $this->selectedPost = Post::with('avatar')->where('slug', $slug)->firstOrFail();

    }


    public function render()
    {
        return view('livewire.fontend.posts.show', [
             'categories' => Category::with("avatar")
                            ->select('id', 'avatar_id', 'name', 'slug')
                            ->inRandomOrder()
                            ->take(4)->get(),
              'products' => Product::with("avatar")
                            ->select('id', 'avatar_id', 'name', 'slug')
                            ->inRandomOrder()
                            ->take(5)->get()
        ])->title($this->selectedPost->title ?? '');
    }

//     public function render()
// {
//     return view('livewire.create-post')
//          ->title('Create Post');
// }
}
