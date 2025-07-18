<?php

namespace App\Livewire\Admin\Pages;

use App\Models\Page;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Support\Str;

#[Layout("components.layouts.admin")]
#[Title("Chỉnh Sửa Trang")]
class Edit extends Component
{
    public ?Page $selectedPage = null;


    #[Rule("required", message:"Vui lòng tạo tiêu đề cho trang")]
    public $title;

    public $content;

    public function mount($id){

        if($id == "create"){
            $this->selectedPage  = null;
        } else {
             $this->selectedPage  = Page::find($id);
        }




          if($this->selectedPage){
                $this->title = $this->selectedPage->title;
                $this->content = $this->selectedPage->content;
          }
    }

    public function save(){

        if($this->selectedPage){
            $this->selectedPage->update([
                'title' => $this->title,
                'content' => $this->content,
                'slug' => Str::slug($this->title)
            ]);
        } else {
            $this->selectedPage = Page::create([
                  'title' => $this->title,
                'content' => $this->content,
                'slug' => Str::slug($this->title)
            ]);
        }


         session()->flash('success', 'Đã cập nhật sản phẩm thành công!');

           return redirect("/admin/pages/" . $this->selectedPage->id);
    }

    public function render()
    {
        return view('livewire.admin.pages.edit');
    }
}
