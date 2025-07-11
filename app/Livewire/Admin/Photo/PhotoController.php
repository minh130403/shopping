<?php

namespace App\Livewire\Admin\Photo;

use App\Models\Photo;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Intervention\Image\ImageManager;


#[Layout("components.layouts.admin")]
#[Title("Photos")]
class PhotoController extends Component
{
    use WithFileUploads, WithPagination;

    #[Rule("image", message:"Vui lòng chọn file ảnh!")]
    #[Rule('max:2048', message:"Vui lòng chọn file ảnh có kích thước nhỏ hơn 1mb")]
    public $photo;

    public $modal = false;

    public $alt ;


    public $selectedPhoto;

    public function openModalWithPhoto($id)
    {
        $this->selectedPhoto = Photo::find($id);
        $this->alt = $this->selectedPhoto->alt ?? '';
        $this->modal = true;
    }

    public function updatePhoto(){
        $this->selectedPhoto->update([
            'alt' => $this->alt
        ]);

        $this->reset();
    }


    public function deletePhoto(){
        $this->selectedPhoto->delete();

        $this->reset();
    }






    public function updatedPhoto(){
        $this->validate();

        $filename = uniqid() . '.webp';

        // Convert
        $manager = new ImageManager( new Driver());
        $image = $manager->read($this->photo->getRealPath());


        // Lưu file đã xử lý
        Storage::disk('public')->put('photos/' . $filename, (string) $image->toWebp(quality: 100));
        // dd(Storage::path('public/photos/' . $filename));

        // Lưu đường dẫn vào DB
        Photo::create([
            'path' => 'photos/' . $filename,
        ]);

        session()->flash('success', 'Ảnh đã được xử lý và lưu!');
        $this->reset();
    }


    public function render()
    {
        return view('livewire.admin.photo.photo-controller', [
            'photos' => Photo::latest()
                        ->paginate(16)
        ]);
    }
}
