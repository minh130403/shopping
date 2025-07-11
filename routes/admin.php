<?php

use App\Livewire\Admin\Dashbroad;
use App\Livewire\Admin\Orders\Index as OrderIndexController;
use App\Livewire\Admin\Orders\Show as OrderShowController;
use App\Livewire\Admin\Pages\Edit as PageEditController;
use App\Livewire\Admin\Pages\Index as PageIndexController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Photo\PhotoController;
use App\Livewire\Admin\Posts\Edit as PostEditController;
use App\Livewire\Admin\Posts\Index as PostIndexController;
use App\Livewire\Admin\Posts\Trash as PostTrashController;
use App\Livewire\Admin\Product\Categories\Edit as CategoryEditController;
use App\Livewire\Admin\Product\Categories\Index as CategoryIndexController;
use App\Livewire\Admin\Product\Comments\Index as CommentIndexController;
use App\Livewire\Admin\Product\Comments\Edit as CommentEditControlelr;
use App\Livewire\Admin\Product\Edit as ProductEditController;
use App\Livewire\Admin\Product\Index as ProductIndexController;
use App\Livewire\Admin\Product\Trash as ProductTrashController;
use App\Livewire\Admin\Settings;
use App\Models\Page;

Route::prefix("admin")->middleware(['auth'])->group(function(){

    Route::prefix("photos")->group(function () {
        Route::get("", PhotoController::class);
    });

    Route::prefix("categories")->group(function (){

      Route::prefix("products")->group(function (){

            Route::get("{id}", CategoryEditController::class);

            Route::get("", CategoryIndexController::class);
      });

    });

    Route::prefix("products")->group(function (){

        Route::get("all", ProductIndexController::class);

        Route::get("trash", ProductTrashController::class);

        Route::get("{id}", ProductEditController::class);
    });

    Route::prefix("comments")->group(function (){

        Route::get("all", CommentIndexController::class);

        // Route::get("trash", ProductTrashController::class);

        Route::get("{comment}", CommentEditControlelr::class);
    });

    Route::prefix("orders")->group(function (){

        Route::get("/{order}", OrderShowController::class);

        Route::get("", OrderIndexController::class);

        // Route::get("trash", ProductTrashController::class);

        // Route::get("{id}", ProductEditController::class);
    });


    Route::prefix("pages")->group(function (){

        Route::get("all", PageIndexController::class);

        Route::get("{id}", PageEditController::class);


    });


    Route::prefix("posts")->group(function (){

        Route::get("all", PostIndexController::class);

        Route::get("trash", PostTrashController::class);

        Route::get("{id}", PostEditController::class);
    });

    Route::get("settings", Settings::class);

    Route::get("dashbroad", Dashbroad::class);

    // Route::get("media", BEMedia::class);
});


