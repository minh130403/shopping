<div >
    @if ($selectedPost)
        <div class="mb-3">
            <x-button label="Add post" icon="o-plus" class="bg-white" link="/admin/posts/create"/>
        </div>
    @endif
    <div>
         @if (session()->has('success'))
            <div x-data="{ show: true }" x-show="show"
                class="p-3 mt-4 mb-4 text-green-800 bg-green-100 rounded-lg transition-opacity duration-500">
                {{ session('success') }}
            </div>
        @endif
    </div>
    <div>
        @php
            $config = [
                'maxHeight' => '150px'
            ];
        @endphp

        <x-form wire:submit="save" class="grid grid-cols-4 gap-2">

            {{-- Left --}}
            <div class="col-span-3">
                <x-input label="Title" wire:model="title" />
                <x-markdown wire:model="content" label="Content" />
                {{-- <x-input label="Price" wire:model="amount" prefix="VND" money hint="It submits an unmasked value" /> --}}
                <x-input label="Slug" wire:model="slug" />
            </div>


            {{-- Right --}}
            <div class="col">
                    {{-- <x-file wire:model="file" label="Receipt" hint="Only PDF" accept="application/pdf" class="mb-3"/> --}}
                    <x-modal wire:model="selectedPhotoModal" title="Photo" class="backdrop-blur" box-class="max-w-[1200px]" >
                        <x-tabs wire:model="selectedTab" selected="photos-tab">
                            <x-tab name="photos-tab" label="Photos" icon="o-photo">
                                <div class="grid grid-cols-6 gap-2" x-data="{ selected: null}">
                                    @foreach ($photos as $photo)
                                        <div>
                                            <img @click="selected = {{ $photo->id }}; $wire.avatarId = {{ $photo->id }}"
                                            :class="selected === {{ $photo->id }} ? 'border-3 border-blue-300' : 'border'"
                                            class="w-full h-full border rounded"  src="{{ Storage::url($photo->path) }}" alt="" loading="lazy" >
                                        </div>
                                    @endforeach
                                </div>
                            </x-tab>
                            {{-- <x-tab name="tricks-tab" label="Upload Photo" icon="o-sparkles">
                                <div>Upload</div>
                            </x-tab> --}}
                        </x-tabs>

                        <x-slot:actions>
                            <x-button label="Cancel" @click="$wire.selectedPhotoModal = false" />
                            <x-button label="Save" @click="$wire.selectedPhotoModal = false; $wire.loadPhoto()" class="bg-blue-500 text-white" />
                        </x-slot:actions>
                    </x-modal>

                    <x-select
                    label="Trạng thái sản phẩm"
                    wire:model="state"
                    :options="$states"
                    option-value="value"
                    option-label="label"
                    class="mb-3"/>

                    <div class="mb-3">Avatar:</div>

                    @if($selectedPhoto)
                        <div class="mb-3">
                            <img class="w-full rounded" src="{{ Storage::url($selectedPhoto->path) }}" alt="" @click="$wire.selectedPhotoModal = true">
                        </div>
                    @else
                        <x-button label="Open" @click="$wire.selectedPhotoModal = true" />
                    @endif
                {{-- <x-slot:actions class="block"> --}}

                {{-- </x-slot:actions> --}}
                    <div class="text-right">
                        <x-button label="Back" />
                        <x-button label="{{ $selectedPost ? 'Update' : 'Create' }}" class="btn-primary" type="submit" spinner="save" />
                    </div>
            </div>
        </x-form>
    </div>
</div>
