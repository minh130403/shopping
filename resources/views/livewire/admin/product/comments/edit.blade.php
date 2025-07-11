<div>
    <div>
         @if (session()->has('success'))
            <div x-data="{ show: true }" x-show="show"
                class="p-3 mt-4 mb-4 text-green-800 bg-green-100 rounded-lg transition-opacity duration-500">
                {{ session('success') }} <a class="text-blue-500" href="/check-out"></a>
            </div>
        @endif
    </div>
    <x-form wire:submit="save">
        <x-input label="Title" value="{{ $selectedComment->title }}" readonly />
        <x-input class="mb-3" label="Author" value="{{ $selectedComment->name }}" readonly />
        {{-- <x-input label="Author" value="{{ $selectedComment->content }}" readonly /> --}}
        <x-textarea  label="Content" rows="5" readonly>
            {{ $selectedComment->content }}
        </x-textarea>
        @php
            $options = [
                ['value' => 'published', 'label' => 'Published'],
                ['value' => 'hidden', 'label' => 'Hidden'],
            ]
        @endphp

        <x-select
            label="State"
            wire:model="state"
            :options="$options"
            option-value="value"
            option-label="label" />
        <x-slot:actions>
            <x-button label="Save" class="btn-primary" type="submit" spinner="save" />
        </x-slot:actions>
    </x-form>
</div>
