<?php

namespace App\Livewire\Admin\Product\Categories;

use App\Models\Category;
use App\Models\Photo;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Support\Str;

#[Layout("components.layouts.admin")]
#[Title("Edit Category")]
class Edit extends Component
{
    public ?Category $selectedCategory = null;

    #[Rule('required', message:"Vui lòng nhập tên sản phẩm")]
    public $name;

    public $description;

    public $slug;

    public $parentCategory;

    public $avatarId;

    public ?Photo $selectedPhoto;

    public bool $selectedPhotoModal = false;

    public function mount($id){
        $this->selectedCategory  = Category::find($id);

        if($this->selectedCategory) {
            $this->name = $this->selectedCategory->name;
            $this->description = $this->selectedCategory->description;
            $this->parentCategory = $this->selectedCategory->parent_category;
            $this->slug = $this->selectedCategory->slug;
            $this->avatarId = $this->selectedCategory->avatar_id;
        }

        if($this->avatarId){
            $this->loadPhoto();
        }
    }

    public function loadPhoto(){
        $this->selectedPhoto = Photo::find($this->avatarId);
    }


     public function save(){
        $this->validate();


        $category =  Category::updateOrCreate(
        [ 'id' => $this->selectedCategory?->id],
        [
            'name' => $this->name,
            'description' => $this->description,
            'slug' => $this->slug ? Str::slug($this->slug) : Str::slug($this->name),
            'parent_category' => $this->parentCategory,
            'avatar_id' => $this->avatarId
        ]
       );

       session()->flash('success', 'Đã cập nhật sản phẩm thành công!');

       return redirect("/admin/categories/products/" . $category->id);
    }





    public function render()
    {
        return view('livewire.admin.product.categories.edit',  [
            'photos' => Photo::all(),
            'categories' => Category::select('id', 'name')
                        ->orderBy('created_at')->get()
        ]);
    }
}
