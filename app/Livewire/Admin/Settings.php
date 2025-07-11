<?php

namespace App\Livewire\Admin;

use App\Models\Page;
use App\Models\Photo;
use Illuminate\Log\Logger;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;


#[Title("Settings")]
#[Layout("components.layouts.admin")]
class Settings extends Component
{


    public array $settings;

    public $selectedPhotoModal;

    public $selectedPhotoId;

    public $keyPhoto;

    public function openModal($key){
        $this->selectedPhotoModal = true;

        $this->keyPhoto = $key;

        // Logger($this->settings);
    }

    public function closeModal(){
        $this->settings[$this->keyPhoto]  = Photo::find($this->selectedPhotoId)->path;

        // dd($this->settings);

        $this->selectedPhotoModal = false;


    }



    public function mount() {

            $this->settings = [
                'site_name' => setting("site_name", null),
                'site_logo' => setting("site_logo", null),
                'site_banner1' => setting("site_banner1", null),
                'site_banner2' => setting("site_banner2", null),
                'site_address' => setting("site_address", null),
                'site_phone1' => setting("site_phone1", null),
                'site_phone2' => setting("site_phone2", null),
            ];

    }


    public function save(){
        foreach($this->settings as $key => $value){
            setting_set($key, $value);
        }
    }

    public function render()
    {
        return view('livewire.admin.settings', [
            'photos' => Photo::all(),
            'pages' => Page::select("id", "title")->get()
        ]);
    }
}
