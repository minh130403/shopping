<?php

namespace App\Http\Middleware;


use Closure;
use App\Services\Cart;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HasCart
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('cart')) {
            session()->put('cart', []);
        }

        // Gán binding đúng tên (cart)
        app()->instance('cart', new Cart(session('cart')));

        // dd(app('cart'));

        return $next($request);
    }
}
