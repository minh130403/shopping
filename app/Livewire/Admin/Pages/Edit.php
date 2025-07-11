<?php

namespace App\Livewire\Admin\Pages;

use App\Models\Page;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Support\Str;

#[Layout("components.layouts.admin")]
#[Title("Page Editor")]
class Edit extends Component
{
    public ?Page $selectedPage = null;


    #[Rule("required", message:"Vui lòng tạo tiêu đề cho trang")]
    public $title;

    public $content;

    public function mount($id){
          $this->selectedPage  = Page::find($id);

          if($this->selectedPage){
                $this->title = $this->selectedPage->title;
                $this->content = $this->selectedPage->content;
          }
    }

    public function save(){
        $page =  Page::updateOrCreate(
        ['id' => $this->selectedPage?->id ],
        [
            'title' => $this->title,
            'content' => $this->content,
            'slug' => Str::slug($this->title)
        ]);

         session()->flash('success', 'Đã cập nhật sản phẩm thành công!');

           return redirect("/admin/pages/" . $page->id);
    }

    public function render()
    {
        return view('livewire.admin.pages.edit');
    }
}
