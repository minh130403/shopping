<?php

namespace App\Traits;

use App\Services\Cart;

trait HasCart
{
    public function cart()
    {
        if (!app()->bound('cart')) {
            $cart = new Cart(session('cart', []));
            app()->instance('cart', $cart);
        }

        return app('cart');
    }

    public function updateCartSession()
    {
        $cart = $this->cart();
        session()->put('cart', $cart->toArray());
        session()->save();
        app()->instance('cart', $cart); // ⚠ Cập nhật lại instance luôn
    }
}
