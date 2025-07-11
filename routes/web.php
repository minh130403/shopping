<?php

use App\Http\Controllers\Auth\LoginController;
use App\Livewire\Auth\Login;
use App\Livewire\Fontend\Cart\Checkout;
use App\Livewire\Fontend\Pages\AboutUs;
use App\Livewire\Fontend\Posts\Index as PostsIndex;
use App\Livewire\Fontend\Posts\Show as PostsShow;
use App\Livewire\Fontend\Products\Categories\Show as CategoryShow;
use App\Livewire\Fontend\Products\Show as FEProductShow;
use App\Livewire\Fontend\Welcome;
use Illuminate\Support\Facades\Route;


require __DIR__ . '/admin.php';



Route::get("/check-out", Checkout::class);

Route::get("/products/{slug}", FEProductShow::class);

Route::get("/categories/{slug}", CategoryShow::class);

Route::get("/posts/all", PostsIndex::class );

Route::get("/posts/{slug}", PostsShow::class );

Route::get("/about-us", AboutUs::class );

Route::get("", Welcome::class);

Route::get("login", Login::class)->name("login");






