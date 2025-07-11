<div>
    <div class="mt-3 mb-3">
        <x-button label="Add product" icon="o-plus" class="bg-white" link="/admin/products/create"/>
    </div>
    <div class="mb-3 bg-white px-2 py-1">
        @php
            $headers = [
                ['key' => 'id', 'label' => '#'],
                ['key' => 'name', 'label' => 'Author'],
                ['key' => 'product', 'label' => 'Product'],
                ['key' => 'state', 'label' => 'State',],
                  # <-- nested attributes
            ];
        @endphp

        <x-table :headers="$headers" :rows="$all" with-pagination  >
            @scope('cell_product', $comment)
                <a class="text-sky-500 underline truncate" href="/admin/products/{{ $comment->commentable->id }}">{{ $comment->commentable->name }}</a>
            @endscope
             @scope('actions', $comment)
                <div class="flex gap-2">
                    <x-button icon="o-trash" wire:click="delete('{{ $comment->id }}')" spinner class="btn-sm" />
                    <x-button icon="o-pencil" link="/admin/comments/{{ $comment->id }}" spinner class="btn-sm" />
                </div>
            @endscope

        </x-table>
    </div>
</div>
