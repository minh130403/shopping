<?php

namespace App\Livewire\Admin\Orders;

use App\Models\Order;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;


#[Title("Order Detail")]
#[Layout("components.layouts.admin")]
class Show extends Component
{
    public Order $order;

    public $items;

    public $state;

    public function mount(Order $order){
        $this->order = $order;
        $this->state = $order->state;
        $this->items = $order->items;
        // dd($this->order);
    }

    public function save(){
        $this->order->update([
            'state' => $this->state,
        ]);

        session()->flash('success', 'Đã cập nhật đơn hàng thành công!');
    }

    public function render()
    {
        return view('livewire.admin.orders.show',[
            'states' => [
                ['label' => 'Pending', 'value' => 'pending'],
                ['label' => 'Processing', 'value' => 'processing'],
                ['label' => 'Completed', 'value' => 'completed'],
                ['label' => 'Cancelled', 'value' => 'cancelled'],

            ]
        ]);
    }
}
