<?php

namespace App\Services;

use App\Models\Product;


class Cart {

    protected $sessionKey = "cart";

    // Giở hàng
    public $totalPrice;
    public $items;
    public $totalAmount;

    public function __construct(protected $cart)
    {
       if ($cart) {
        $this->items = $cart['items'] ?? [];
        $this->totalPrice = $cart['totalPrice'] ?? 0;
        $this->totalAmount = $cart['totalAmount'] ?? 0;
        } else {
            // Khởi tạo mặc định
            $this->items = [];
            $this->totalPrice = 0;
            $this->totalAmount = 0;
        }
    }


    public function addToCart(Product $product){
        $found = false;

        foreach($this->items as $index => $item){
            if($item['id'] == $product->id){
                $this->items[$index]['amount'] ++;
                $found = true;
                break;
            }
        }

        if(!$found){
                $newItem = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'amount' => 1,
                    'price' => $product->price
                ];

                $this->items[] = $newItem;

        }

        $this->totalAmount ++;
        $this->totalPrice += $product->price ?? 0;
    }


    public function decrease($id){
        $decreaseItem = [];


        // ??
        foreach($this->items as $index => $item){
            if($item['id'] == $id){
                $decreaseItem = $this->items[$index];
                if($this->items[$index]['amount'] > 0){
                    $this->items[$index]['amount'] --;
                    if($this->items[$index]['amount'] == 0 ){
                        $this->removeFromCart($id);
                    }

                    $this->totalAmount --;
                    $this->totalPrice -= $decreaseItem['price'];

                }
                break;
            }
        }
    }


    public function removeFromCart($id){

        $removeItem = [];

        foreach($this->items as $index => $item){
            if($item['id'] == $id){
                $removeItem = $this->items[$index];
                 $this->totalAmount  -= $removeItem['amount'];
                 $this->totalPrice  -= $removeItem['price'] * $removeItem['amount'];
                unset( $this->items[$index]);
                break;
            }
        }
    }


    public function updateCart(Cart $cart){
        // Ghi đè giỏ hàng hiện tại bằng giỏ hàng mới
        $this->items = $cart->items;
        $this->totalAmount = $cart->totalAmount;
        $this->totalPrice = $cart->totalPrice;
    }

    public function toArray(): array
    {
        return [
            'totalPrice' => $this->totalPrice,
            'totalAmount' => $this->totalAmount,
            'items' => $this->items,
        ];
    }



}

