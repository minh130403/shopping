<?php

namespace App\Livewire\Admin\Posts;

use App\Models\Photo;
use App\Models\Post;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;

#[Title("Chỉnh sửa bài viết")]
#[Layout("components.layouts.admin")]
class Edit extends Component
{
    public ?Post $selectedPost = null;

    #[Rule('required', message:"Vui lòng nhập tên sản phẩm")]
    public $title;

    public $content;

    public $slug;


    public $avatarId;

    public ?Photo $selectedPhoto;


    #[Rule('nullable')]
    #[Rule('in:hidden,draft,published')]
    public $state;


    public bool $selectedPhotoModal = false;

    public function mount($id){
        if($id){
            $this->selectedPost  = null;
        } else {
            $this->selectedPost  = Post::find($id);
        }



        if($this->selectedPost) {
            $this->title = $this->selectedPost->title;
            $this->content = $this->selectedPost->content;
            $this->slug = $this->selectedPost->slug;
            $this->avatarId = $this->selectedPost->avatar_id;
            $this->state = $this->selectedPost->state;

        }

        if($this->avatarId){
            $this->loadPhoto();
        }


    }

    public function loadPhoto(){
        $this->selectedPhoto = Photo::find($this->avatarId);
    }



    // public function removeGallery($id){
    //     $this->galleryPhotoId = array_filter(
    //         $this->galleryPhotoId,
    //         fn ($item) => $item != $id
    //     );
    //     $this->galleryPhotoId = array_values($this->galleryPhotoId); // reset ke
    // }


    public function save(){
        $this->validate();


        $post =  Post::updateOrCreate(
        ['id' => $this->selectedPost?->id ],
        [
            'title' => $this->title,
            'content' => $this->content,
            'slug' => Post::slugChecker($this->slug ?? $this->title,currentId: $this->selectedPost?->id),
            'avatar_id' => $this->avatarId,
            'state' => $this->state ?? 'published',
        ]
       );


       session()->flash('success', 'Đã cập nhật sản phẩm thành công!');

       return redirect("/admin/posts/" . $post->id);
    }

    public function render()
    {
        return view('livewire.admin.posts.edit',[
            'photos' => Photo::all(),
            'states' => [
                ['label' => 'Published', 'value' => 'published'],
                ['label' => 'Draft', 'value' => 'draft'],
                ['label' => 'Hidden', 'value' => 'hidden'],
            ]
        ]);
    }
}
