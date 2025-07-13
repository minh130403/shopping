<div>
    <div class="mt-3 mb-3">
        <x-button label="All post" icon="o-cube" class="bg-white" link="/admin/posts/all"/>
    </div>
    <div class="mb-3 bg-white px-2 py-1">
        @php
            $headers = [
                ['key' => 'id', 'label' => '#'],
                ['key' => 'avatar', 'label' => 'Avatar'],
                ['key' => 'title', 'label' => 'Title'],
                ['key' => 'slug', 'label' => 'Slug'],
                  # <-- nested attributes
            ];
        @endphp

        <x-table :headers="$headers" :rows="$all">

            {{-- Notice `$product` is the current row item on loop --}}
            @scope('cell_id', $post)
                <strong>{{ $post->id }}</strong>
            @endscope

            @scope('cell_avatar', $post)
                <img class="w-12 rounded" src="{{ 'https://i0.wp.com/thewordwarrior.com/wp-content/uploads/woocommerce-placeholder.png?fit=655,655&ssl=1' ?? Storage::url($post->avatar->path) }}" alt="">
            @endscope


            {{-- You can name the injected object as you wish  --}}
            @scope('cell_title', $stuff)
                <x-badge :value="$stuff->title" class="badge-soft" />
            @endscope

            {{-- Notice the `dot` notation for nested attribute cell's slot --}}
            @scope('cell_slug', $post)
                <i>{{ $post->slug }}</i>
            @endscope


            {{-- Special `actions` slot --}}
            @scope('actions', $post)
                <div class="flex gap-2">
                    <x-button icon="o-trash" wire:click="forceDelete('{{ $post->id }}')" spinner class="btn-sm" />
                    <x-button icon="o-arrow-path" wire:click="restore('{{ $post->id }}')" spinner class="btn-sm" />
                    <x-button icon="o-pencil" link="/admin/posts/{{ $post->id }}" spinner class="btn-sm" />
                </div>
            @endscope

        </x-table>
    </div>
</div>
