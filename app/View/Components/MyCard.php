<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class MyCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public ?Model $item = null,
        public ?string $type = null
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.my-card');
    }
}
