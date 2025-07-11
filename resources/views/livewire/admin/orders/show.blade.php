<div>
 @if (session()->has('success'))
                <div x-data="{ show: true }" x-show="show"
                    class="p-3 mt-4 mb-4 text-green-800 bg-green-100 rounded-lg transition-opacity duration-500">
                    {{ session('success') }}
                </div>
    @endif
    <div class="mt-3 grid grid-cols-3 gap-2">
        <div class="col-span-2">
                <div class="info bg-white rounded ">
                    <p class="mb-1 hover:bg-gray-200 block  px-4 py-2"> <span class="font-semibold">Customer name: </span> <span>{{ $order->customer_name }}</span> </p>
                    <p  class="mb-1 hover:bg-gray-200 block  px-4 py-2"> <span class="font-semibold">Address: </span> <span>{{ $order->address }}</span> </p>
                    <p  class="mb-1 hover:bg-gray-200 block  px-4 py-2"> <span class="font-semibold">Phone: </span> <span>{{ $order->phone }}</span> </p>
                    <p  class="mb-1 hover:bg-gray-200 block  px-4 py-2"> <span class="font-semibold">Note: </span> <span>{{ $order->note }}</span> </p>
                    <p  class="mb-1 hover:bg-gray-200 block  px-4 py-2"> <span class="font-semibold">Total Amount: </span> <span> {{ $order->amount }} unit</span> </p>
                    <p  class="mb-1 hover:bg-gray-200 block  px-4 py-2"> <span class="font-semibold">Total Price: </span> <span>{{ number_format($order->value) . ' VND' ?? 'Chưa xác định' }}</span> </p>

                </div>
                <div class="mt-3">
                    <h2 class="px-3">Danh sách sản phẩm: </h2>
                    @php
                        $headers = [
                            ['key' => 'id', 'label' => '#'],
                            ['key' => 'product_name', 'label' => 'Tên sản phẩm'],
                            ['key' => 'price', 'label' => 'Giá bán lẻ'],      # <-- nested attributes
                            ['key' => 'amount', 'label' => 'Số lượng'] # <-- this column does not exists
                        ];
                    @endphp

                    <x-table :headers="$headers" :rows="$items" class="bg-white p-2 mt-3">
                    @scope('cell_product_name', $item)
                            <a class="italic underline text-blue-500" href="/admin/products/{{ $item->product_id }}"> {{ $item->product_name }} </a>
                    @endscope
                    @scope('cell_price', $item)
                            <span> {{ $item->price ? $item->price . 'VND' : 'Liên hệ' }} </span>
                    @endscope
                    </x-table>
                </div>
            </div>

            <div class="bg-white rounded px-3 px-2">
                <x-form wire:submit="save">
                    <x-select
                    label="Trạng thái đơn hàng"
                    wire:model="state"
                    :options="$states"
                    option-value="value"
                    option-label="label" />

                    <x-input label="Ngày tạo" value="{{ $order->created_at }}" disabled />

                    <x-input label="Ngày cập nhật" value="{{ $order->updated_at }}" disabled />

                    <x-slot:actions>
                        {{-- <x-button label="Cancel" /> --}}
                        <x-button label="Update!" class="btn-primary" type="submit" spinner="save" />
                    </x-slot:actions>
                </x-form>
                <div>
                </div>
            </div>
    </div>

</div>
