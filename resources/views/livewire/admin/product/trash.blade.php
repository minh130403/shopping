<div>
    <div class="mt-3 mb-3">
        <x-button label="All products" icon="o-cube" class="bg-white" link="/admin/products/all"/>
    </div>
    <div class="mb-3 bg-white px-2 py-1">
        @php
            $headers = [
                ['key' => 'id', 'label' => '#'],
                ['key' => 'avatar', 'label' => 'Avatar'],
                ['key' => 'name', 'label' => 'Product Name'],
                ['key' => 'slug', 'label' => 'Slug'],
                  # <-- nested attributes
            ];
        @endphp

        <x-table :headers="$headers" :rows="$all">

            {{-- Notice `$product` is the current row item on loop --}}
            @scope('cell_id', $product)
                <strong>{{ $product->id }}</strong>
            @endscope

            @scope('cell_avatar', $product)
                <img class="w-12 rounded" src="{{ 'https://i0.wp.com/thewordwarrior.com/wp-content/uploads/woocommerce-placeholder.png?fit=655,655&ssl=1' ?? Storage::url($product->avatar->path ) }}" alt="">
            @endscope


            {{-- You can name the injected object as you wish  --}}
            @scope('cell_name', $stuff)
                <x-badge :value="$stuff->name" class="badge-soft" />
            @endscope

            {{-- Notice the `dot` notation for nested attribute cell's slot --}}
            @scope('cell_slug', $product)
                <i>{{ $product->slug }}</i>
            @endscope


            {{-- Special `actions` slot --}}
            @scope('actions', $product)
                <div class="flex gap-2">
                    <x-button icon="o-trash" wire:click="forceDelete('{{ $product->id }}')" spinner class="btn-sm" />
                    <x-button icon="o-arrow-path" wire:click="restore('{{ $product->id }}')" spinner class="btn-sm" />
                    <x-button icon="o-pencil" link="/admin/products/{{ $product->id }}" spinner class="btn-sm" />
                </div>
            @endscope

        </x-table>
    </div>
</div>
