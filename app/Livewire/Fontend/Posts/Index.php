<?php

namespace App\Livewire\Fontend\Posts;

use App\Models\Category;
use App\Models\Post;
use Livewire\Attributes\Title;
use Livewire\Component;


#[Title("Tin tức")]
class Index extends Component
{


    public function render()
    {
        return view('livewire.fontend.posts.index', [
            'all' => Post::paginate(12),
            'categories' => Category::with("avatar")
                            ->select('id', 'avatar_id', 'name', 'slug')
                            ->inRandomOrder()
                            ->take(4)->get()
        ]);
    }
}
