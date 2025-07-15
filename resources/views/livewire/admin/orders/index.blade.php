<div class="mt-3">
    <div class="mb-3 bg-white px-2 py-1">
        @php
            $headers = [
                ['key' => 'id', 'label' => '#'],
                ['key' => 'customer_name', 'label' => 'Tên khách hàng'],
                ['key' => 'phone', 'label' => 'Điện thoại'],
                ['key' => 'amount', 'label' => 'Số lượng sản phẩm'],
                ['key' => 'value', 'label' => 'Tổng giá trị'],
                ['key' => 'created_at', 'label' => 'Thời điểm đặt hàng']
                  # <-- nested attributes
            ];
        @endphp

        <x-table :headers="$headers" :rows="$all" with-pagination>

            {{-- Notice `$product` is the current row item on loop --}}
            @scope('cell_id', $item)
                <span>{{ $item->id }}</span>
            @endscope

            @scope('cell_customer_name', $item)
                 <strong>{{ $item->customer_name }}</strong>
            @endscope


            {{-- You can name the injected object as you wish  --}}
            @scope('cell_phone', $stuff)
                <x-badge :value="$stuff->phone" class="badge-soft" />
            @endscope


            @scope('cell_created_at', $stuff)
                <x-badge :value="$stuff->created_at" class="badge-soft" />
            @endscope

            {{-- Special `actions` slot --}}
            @scope('actions', $item)
                <div class="flex gap-2">
                    <x-button icon="o-trash" wire:click="delete({{ $item->id }})" spinner class="btn-sm" />
                    <x-button icon="o-pencil" link="/admin/orders/{{ $item->id }}" spinner class="btn-sm" />
                </div>
            @endscope

        </x-table>
    </div>
</div>
