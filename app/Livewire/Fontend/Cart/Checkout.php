<?php

namespace App\Livewire\Fontend\Cart;

use App\Models\Order;
use App\Models\Product;
use App\Services\Cart;
use App\Traits\HasCart;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;


#[Title("Giỏ hàng")]
class CheckOut extends Component
{
    use HasCart;


    protected Cart $cart;

    #[Rule('required', message:"Vui lòng nhập tên của bạn!")]
    public string $customerName;

    #[Rule('required', message:"Vui lòng nhập số điện thoại của bạn!")]
    #[Rule('regex:/^0[0-9]{9}$/', message:"Vui lòng nhập số điện thoại của bạn!")]
    public string $phoneNumber;

    public ?string $city = '';
    public ?string $note = '';
    public array $items = [];
    public array $quantities = [];
    public int $totalPrice = 0;
    public int $totalAmount = 0;

    public function mount(){
        // dd($this->cart);

        $this->cart = $this->cart();
        $this->items = $this->cart->items;
        foreach ($this->items as $item) {
            $this->quantities[$item['id']] = $item['amount'];

        }

        // dd($this->quantities, array_key_exists('SP7t9gef', $this->quantities));

        $this->totalAmount = $this->cart->totalAmount;
        $this->totalPrice = $this->cart->totalPrice;
    }

    public function createOrder(){

        $this->validate();

        $order = Order::create([
            'customer_name' => $this->customerName,
            'phone' => $this->phoneNumber,
            'address' => $this->city,
            'amount' => $this->totalAmount,
            'value' => $this->totalPrice,
            'note' => $this->note,
        ]);

        foreach($this->items as  $item){
            $order->items()->create([
                'product_id' => $item['id'],
                'product_name' => $item['name'],
                'amount' => $item['amount'],
                'price' => $item['price'],
                'total_price' => $item['amount'] * $item['price']
            ]);
        }


        session()->put('cart', []);
        $this->reset();

        session()->flash('success', 'Cảm ơn bạn đã đặt hàng! Chúng tôi sẽ liên hệ với bạn để xác nhận trong thời gian sớm nhất');
    }


    public function increase($id){

        $this->cart()->addToCart(Product::find($id));
        $this->updateCartSession();
        // dd($this->cart);
        $this->items = $this->cart()->items;
        foreach ($this->items as $item) {
            $this->quantities[$item['id']] = $item['amount'];
        }

        $this->totalAmount = $this->cart()->totalAmount;
        $this->totalPrice = $this->cart()->totalPrice;
    }

    public function decrease($id){

        $this->cart()->decrease($id);
        $this->updateCartSession();
        // dd($this->cart);
        $this->items = $this->cart()->items;
        foreach ($this->items as $item) {
            $this->quantities[$item['id']] = $item['amount'];
        }

        $this->totalAmount = $this->cart()->totalAmount;
        $this->totalPrice = $this->cart()->totalPrice;
    }

     public function remove($id){

        $this->cart()->removeFromCart($id);

        $this->updateCartSession();
        // dd($this->cart);
        $this->items = $this->cart()->items;
        foreach ($this->items as $item) {
            $this->quantities[$item['id']] = $item['amount'];
        }

        $this->totalAmount = $this->cart()->totalAmount;
        $this->totalPrice = $this->cart()->totalPrice;
    }


    public function render()
    {
        return view('livewire.fontend.cart.checkout');
    }
}
