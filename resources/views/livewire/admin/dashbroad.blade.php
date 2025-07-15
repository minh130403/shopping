<div>
   <div class="flex gap-3 mb-3 border-b-1 border-gray-400">
        <div  class="grow">
            <div class="flex justify-between">
                <h3 class="text-lg font-semibold mb-3">Lượt xem </h3>

                    <select wire:model.live="filterChart" class="border border-gray-200 rounded-lg pl-2 ">
                        <option value="day">Hôm nay</option>
                        <option value="week">Tuần này</option>
                        <option value="month">Tháng này</option>
                    </select>

            </div>
            <x-chart wire:model="viewsChart" class="h-full"/>
        </div>
        <div class=" text-center w-[30%]">
            <h3 class="font-semibold italic text-blue-500">Top 10 sản phẩm bán chạy nhất</h3>

            @php
                $products = App\Models\Product::withCount('views')->orderBy('views_count', 'desc')
                                ->take(10)
                                ->get();

                // dd($products);

                $headers = [
                    // ['key' => 'id', 'label' => '#'],
                    ['key' => 'name', 'label' => 'Tên sản phẩm', 'class' => 'w-[200px]'],
                    ['key' => 'views_count', 'label' => 'Lượt xem'] # <---- nested attributes
                ];
            @endphp

            <x-table :headers="$headers" :rows="$products" striped>
                @scope('cell_name', $product)
                    <a href="/admin/products/{{ $product->id }}" class="truncate text-sky-500 underline block w-[200px]">{{ $product->name }}</a>
                @endscope
            </x-table>
        </div>
   </div>
   <div class="">
        <div>
           <h3 class="text-lg font-semibold mb-3">  Đơn hàng đang chờ</h3>
              @php
                $orders = App\Models\Order::where('state', 'pending')
                                ->paginate(10);

                // dd($products);

                $headers = [
                    // ['key' => 'id', 'label' => '#'],
                    ['key' => 'id', 'label' => '#', ],
                    ['key' => 'customer_name', 'label' => 'Tên khách hàng', ],
                    ['key' => 'phone', 'label' => 'SĐT', ],
                    ['key' => 'amount', 'label' => 'Số lượng', ],
                    ['key' => 'value', 'label' => 'Giá trị'] # <---- nested attributes
                ];
            @endphp

            <x-table :headers="$headers" :rows="$orders"  with-pagination>
                @scope('cell_id', $order)
                   <a href="/admin/orders/{{ $order->id }}" class="text-sky-500 underline"> {{ $order->id }} </a>
                @endscope

                @scope('cell_value', $order)
                   <span> {{ number_format($order->value,0 ) }}  VND</span>
                @endscope
            </x-table>

        </div>
   </div>
</div>
