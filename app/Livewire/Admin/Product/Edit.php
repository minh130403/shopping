<?php

namespace App\Livewire\Admin\Product;

use App\Models\Category;
use App\Models\Photo;
use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Session;

#[Layout('components.layouts.admin')]
#[Title('Chỉnh Sửa Sản Phẩm')]
class Edit extends Component
{
    public ?Product $selectedProduct = null;

    #[Rule('required', message:"Vui lòng nhập tên sản phẩm")]
    public $name;

    public $description;

    public $shortDescription;

    public $slug;

    public $categoryId;

    public $avatarId;

    public ?Photo $selectedPhoto;

    public $gallery;


    public array $galleryPhotoId;

    #[Rule('nullable')]
    #[Rule('in:hidden,draft,published')]
    public $state;

    #[Rule('nullable')]
    #[Rule('in:new,old,out_of_stock,coming_soon')]
    public $status;

    public bool $selectedPhotoModal = false;
    public bool $selectedGalleryModal = false;

    public function mount($id){

        if($id == "create") {
             $this->selectedProduct  = null;
        } else {
             $this->selectedProduct  = Product::find($id);
        }


        if($this->selectedProduct) {
            $this->name = $this->selectedProduct->name;
            $this->description = $this->selectedProduct->description;
            $this->shortDescription = $this->selectedProduct->short_description;
            $this->slug = $this->selectedProduct->slug;
            $this->avatarId = $this->selectedProduct->avatar_id;
            $this->categoryId = $this->selectedProduct->category_id;
            $this->state = $this->selectedProduct->state;
            $this->status = $this->selectedProduct->status;
            $this->gallery = $this->selectedProduct->gallery;
        }

        if($this->avatarId){
            $this->loadPhoto();
        }

        if($this->gallery){
            $this->galleryPhotoId = $this->selectedProduct->gallery->pluck('id')->toArray();
        }
    }

    public function loadPhoto(){
        $this->selectedPhoto = Photo::find($this->avatarId);
    }

    public function loadGallery(){
        $this->gallery = Photo::whereIn('id', $this->galleryPhotoId)->get();
    }

    public function updatedGalleryPhotoId(){
        $this->loadGallery();
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


        $product =  Product::updateOrCreate(
        ['id' => $this->selectedProduct?->id ?? null],
        [
            'name' => $this->name,
            'description' => $this->description,
            'short_description' => $this->shortDescription,
            'slug' => Product::slugChecker($this->slug ?? $this->name,currentId: $this->selectedProduct?->id),
            'avatar_id' => $this->avatarId,
            'category_id' => $this->categoryId,
            'status' => $this->status ?? 'new',
            'state' => $this->state ?? 'published',
        ]
       );

       if($this->galleryPhotoId){
            $this->selectedProduct->gallery()->sync($this->galleryPhotoId);
       }

       session()->flash('success', 'Đã cập nhật sản phẩm thành công!');

       return redirect("/admin/products/" . $product->id);
    }


    public function render()
    {
        return view('livewire.admin.product.edit', [
            'photos' => Photo::all(),
            'categories' => Category::select('id', 'name')->whereNotNull("parent_category")->get(),
            'statuses' => [
                ['label' => 'Mới', 'value' => 'new'],
                ['label' => 'Cũ', 'value' => 'old'],
                ['label' => 'Hết hàng', 'value' => 'out_of_stock'],
                ['label' => 'Sắp mở bán', 'value' => 'coming_soon'],

            ],
            'states' => [
                ['label' => 'Xuất bản', 'value' => 'published'],
                ['label' => 'Nháp', 'value' => 'draft'],
                ['label' => 'Ẩn', 'value' => 'hidden'],
            ]
        ]);
    }
}
