<div>
    <div class="mt-3 mb-3">
        <x-button label="Add product" icon="o-plus" class="bg-white" link="/admin/products/create"/>
        <x-button label="{{ $amountInTrash }}" icon="o-trash" class="bg-white" link="/admin/products/trash"/>
    </div>
    <div class="mb-3 bg-white px-2 py-1">
        @php
            $headers = [
                ['key' => 'id', 'label' => '#'],
                ['key' => 'avatar', 'label' => 'Avatar', 'sortable' => false],
                ['key' => 'name', 'label' => 'Product Name'],
                ['key' => 'slug', 'label' => 'Slug', 'sortable' => false],
                ['key' => 'views_count', 'label' => 'Views Count'],
                ['key' => 'state', 'label' => 'State', 'sortable' => false],
                  # <-- nested attributes
            ];
        @endphp

        <x-table :headers="$headers" :rows="$all" with-pagination :sort-by="$sortBy">

            {{-- Notice `$product` is the current row item on loop --}}
            @scope('cell_id', $product)
                <strong>{{ $product->id }}</strong>
            @endscope

            @scope('cell_avatar', $product)
                <img class="w-12 rounded" src="{{ Storage::url($product->avatar->path ?? 'photos/sample_product.webp') }}" alt="">
            @endscope


            {{-- You can name the injected object as you wish  --}}
            @scope('cell_name', $stuff)
                <x-badge :value="$stuff->name" class="badge-soft truncate" />
            @endscope

            {{-- Notice the `dot` notation for nested attribute cell's slot --}}
            @scope('cell_slug', $product)
                <i>{{ $product->slug }}</i>
            @endscope

            {{-- @scope('cell_state', $product)
                <i>{{ $product->state }}</i>
            @endscope --}}

            {{-- Special `actions` slot --}}
            @scope('actions', $product)
                <div class="flex gap-2">
                    <x-button icon="o-trash" wire:click="delete('{{ $product->id }}')" spinner class="btn-sm" />
                    <x-button icon="o-pencil" link="/admin/products/{{ $product->id }}" spinner class="btn-sm" />
                </div>
            @endscope

        </x-table>
    </div>
</div>
