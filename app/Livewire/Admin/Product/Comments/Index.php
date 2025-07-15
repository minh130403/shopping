<?php

namespace App\Livewire\Admin\Product\Comments;

use App\Models\Comment;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
#[Title("Bình luận")]
class Index extends Component
{
    use WithPagination;

    public function delete(Comment $comment){
        $comment->delete();
    }

    public function render()
    {
        return view('livewire.admin.product.comments.index', [
            'all' => Comment::with("commentable")->select("id", "name", 'state', 'commentable_id', 'commentable_type')
                                ->whereIn('commentable_type', [\App\Models\Product::class])
                                ->paginate(10)
        ]);
    }
}
