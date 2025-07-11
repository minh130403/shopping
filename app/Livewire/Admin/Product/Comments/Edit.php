<?php

namespace App\Livewire\Admin\Product\Comments;

use App\Models\Comment;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;



#[Layout('components.layouts.admin')]
#[Title("Comment Editor")]
class Edit extends Component
{
    public ?Comment $selectedComment = null;

    public $state;

    public function mount(Comment $comment){
        $this->selectedComment = $comment;

        if($this->selectedComment){
            $this->state = $comment->state;
        }

    }

    public function save(){
        $this->selectedComment->save([
            'state' => $this->state
        ]);

        session()->flash('success', 'Đã cập nhật thành công!');

    }


    public function render()
    {
        return view('livewire.admin.product.comments.edit');
    }
}
