<div>
    <div class="mt-3 mb-3">
        <x-button label="Thêm danh mục" icon="o-plus" class="bg-white" link="/admin/categories/products/create"/>
    </div>
    <div class="mb-3 bg-white px-2 py-1">
        @php
            $headers = [
                ['key' => 'id', 'label' => '#'],
                ['key' => 'name', 'label' => 'Tên danh mục'],
                ['key' => 'slug', 'label' => 'Đường dẫn'],
                  # <-- nested attributes
            ];
        @endphp

        <x-table :headers="$headers" :rows="$all">

            {{-- Notice `$product` is the current row item on loop --}}
            @scope('cell_id', $category)
                <strong>{{ $category->id }}</strong>
            @endscope

            {{-- You can name the injected object as you wish  --}}
            @scope('cell_name', $stuff)
                <x-badge :value="$stuff->name" class="badge-soft" />
            @endscope

            {{-- Notice the `dot` notation for nested attribute cell's slot --}}
            @scope('cell_slug', $category)
                <i>{{ $category->slug }}</i>
            @endscope


            {{-- Special `actions` slot --}}
            @scope('actions', $category)
                <div class="flex gap-2">
                    <x-button icon="o-trash" wire:click="delete('{{ $category->id }}')" spinner class="btn-sm" />
                    <x-button icon="o-pencil" link="/admin/categories/products/{{ $category->id }}" spinner class="btn-sm" />
                </div>
            @endscope

        </x-table>

        <div> {{ $all->links() }} </div>
    </div>
</div>
