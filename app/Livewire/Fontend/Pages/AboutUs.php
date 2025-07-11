<?php

namespace App\Livewire\Fontend\Pages;

use App\Models\Page;
use Livewire\Component;

class AboutUs extends Component
{
    public ?Page $page = null;

    public function mount(){
        $this->page = Page::find(setting("site_about_us"));
    }

    public function render()
    {
        return view('livewire.fontend.pages.about-us');
    }
}
