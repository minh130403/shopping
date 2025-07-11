<div>
    <div class="mt-3">
        <x-form wire:submit="save" class="grid grid-col grid-cols-4 gap-2">
            <div class="grow col-span-3">
                <x-input label="Site Name" wire:model="settings.site_name" />
                <x-input label="Address" wire:model="settings.site_address" />
                <x-input label="Phone 1" wire:model="settings.site_phone1" />
                <x-input label="Phone 2" wire:model="settings.site_phone2" />
                <x-select label="About us page" wire:model="settings.site_about_us" :options="$pages"     option-value="id"
                    option-label="title"/>
                <x-select
                    label="Contact page"
                    wire:model="settings.site_contact"
                    :options="$pages"
                    option-value="id"
                    option-label="title"
                />

                </div>




            <div class="w-fit">
                <div class="mb-3">
                    <span class="text-lg font-bold mt-3">Logo: </span>
                    @if($settings['site_logo'])
                        <div class="mb-3">
                            <img class="w-48 h-48 rounded" src="{{ Storage::url($settings['site_logo'] )}}" alt=""  wire:click="openModal('site_logo')">
                        </div>
                    @else
                        <x-button label="Open" wire:click="openModal('site_logo')" icon="o-plus" class="w-48 h-48"/>
                    @endif
                </div>
            </div>

            <div class="col-span-2">
                <span class="text-lg font-bold mt-3">Banner 1:</span>
                @if($settings['site_banner1'])
                    <div class="mb-3">
                        <img class="w-full h-[240px] rounded object-cover" src="{{ Storage::url($settings['site_banner1']) }}" alt=""  wire:click="openModal('site_banner1')">
                    </div>
                @else
                    <x-button  wire:click="openModal('site_banner1')" class="w-full h-[240px]" icon="o-plus"/>
                @endif
            </div>
            <div class="col-span-2">
                <span class="text-lg font-bold mt-3">Banner 2:</span>
                @if($settings['site_banner2'])
                    <div class="mb-3">
                        <img class="w-full h-[240px] rounded object-cover" src="{{ Storage::url($settings['site_banner2']) }}" alt=""  wire:click="openModal('site_banner2')">
                    </div>
                @else
                    <x-button wire:click="openModal('site_banner2')" class="w-full !w-h-[240px] h-[240px]" icon="o-plus"/>
                @endif
            </div>

            <x-slot:actions class="col-span-4">
                {{-- <x-button label="Cancel" /> --}}
                <x-button label="Save" class="btn-primary" type="submit" spinner="save" />
            </x-slot:actions>
        </x-form>
    </div>


    <x-modal wire:model="selectedPhotoModal" title="Photo" class="backdrop-blur" box-class="max-w-[1200px]" >
        <x-tabs wire:model="selectedTab" selected="photos-tab">
            <x-tab name="photos-tab" label="Photos" icon="o-photo">
                <div class="grid grid-cols-6 gap-2" x-data="{ selected: null}">
                    @foreach ($photos as $photo)
                        <div>
                            <img @click="selected = {{ $photo->id }}; $wire.selectedPhotoId = {{ $photo->id }}"
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
            <x-button label="Save" @click="$wire.selectedPhotoModal = false;" class="bg-blue-500 text-white" wire:click="closeModal()"/>
        </x-slot:actions>
    </x-modal>
</div>
