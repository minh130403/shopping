<?php

namespace App\Livewire\Admin\Orders;

use App\Models\Order;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title("Quản Lý Đơn hàng")]
#[Layout("components.layouts.admin")]
class Index extends Component
{
    use WithPagination;


    public function delete(Order $order){
        $order->delete();

        $this->reset();
    }

    public function render()
    {
        return view('livewire.admin.orders.index',[
            'all' => Order::select('id', 'customer_name', 'phone', 'amount', 'value', 'created_at')
                ->orderBy("created_at")
                ->paginate(10)
        ]);
    }
}
