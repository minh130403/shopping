<div>
    <div class="mt-3 mb-3">
        <x-button label="Add page" icon="o-plus" class="bg-white" link="/admin/pages/create"/>
    </div>
    <div class="mb-3 bg-white px-2 py-1">
        @php
            $headers = [
                ['key' => 'id', 'label' => '#'],
                ['key' => 'title', 'label' => 'Title'],
                  # <-- nested attributes
            ];
        @endphp

        <x-table :headers="$headers" :rows="$all">
            @scope('actions', $page)
                <div class="flex gap-2">
                    <x-button icon="o-trash" wire:click="delete({{ $page->id }})" spinner class="btn-sm" />
                    <x-button icon="o-pencil" link="/admin/pages/{{ $page->id }}" spinner class="btn-sm" />
                </div>
            @endscope

        </x-table>
    </div>
</div>
