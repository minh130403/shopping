<?php

namespace App\Livewire\Fontend\Products;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Photo;
use App\Models\Product;
use App\Traits\HasCart;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Attributes\Rule;
use Livewire\Component;



class Show extends Component
{
    use HasCart;

    public $product;

    public $productSame;

    public ?Photo $selectedPhoto;
    #[Rule("required", message: "Vui lòng điền đủ thôgn tin")]
    public $titleCmt;
    #[Rule("required", message: "Vui lòng điền đủ thôgn tin")]
    public $authorCmt;
    #[Rule("required", message: "Vui lòng điền đủ thôgn tin")]
    public $contentCmt;


    public function mount($slug){

        $this->product = Product::with('category')->where('slug', $slug)
                        ->where('state', 'published')
                        ->firstOrFail();
                                    // ->get();

        // dd($this->product);

        if ($this->product->category_id) {
            $this->productSame = $this->product->category
                                ->products()
                                ->where('id', '!=', $this->product->id)
                                ->where('state', 'published' )
                                ->take(4)
                                ->get();


        }

        //  dd($this->productSame);

        $this->selectedPhoto = $this->product->avatar;

        // dd($this->cart());
    }


    public function updateSelectedPhoto(Photo $photo){
        $this->selectedPhoto = $photo;
    }

    public function addToCart(){

        // dd(app()->bound('cart'));
        // dd(app('cart'));

        $this->cart()->addToCart($this->product);

        $this->updateCartSession();

        session()->flash('success', 'Đã thêm sản phẩm vào giỏ hàng thành công!');

        // dd($this->cart());
    }

    public function recordView(){
        $alreadlyViewed = $this->product->views()
            ->where('ip_address', request()->ip())
            ->where('created_at', '>=', now()->subHour())
            ->exists();

        if(!$alreadlyViewed){
            $this->product->views()->create([
                'ip_address' => request()->ip()
            ]);
        }
    }


    public function createCmt(){
        Comment::create([
            'title' => $this->titleCmt,
            'name' => $this->authorCmt,
            'content' => $this->contentCmt,
            'commentable_type' => Product::class,
            'commentable_id' => $this->product->id,
            'state' => 'hidden'
         ]);

        session()->flash('createdCmt', 'Thank you for respone!');
    }


    public function render()
    {
        return view('livewire.fontend.products.show', [
            'comments' => Comment::where("commentable_type", Product::class)
                                    ->where("commentable_id", $this->product->id)
                                    ->where("state", "published")
                                    ->orderByDesc("created_at")
                                    ->take(10)
                                    ->get(),
            'root' => Category::whereNull('parent_category')->inRandomOrder()->take(5)->get()
        ])->title($this->product->name . ' | Thực tập doanh nghiệp');
    }
}
