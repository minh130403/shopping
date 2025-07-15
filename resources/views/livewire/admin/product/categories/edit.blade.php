<div >
    @if ($selectedCategory)
        <div class="mb-3">
            <x-button label="Thêm danh mục" icon="o-plus" class="bg-white" link="/admin/categories/products/create"/>
        </div>
    @endif
    <div>
         @if (session()->has('success'))
            <div x-data="{ show: true }" x-show="show"
                class="p-3 mt-4 mb-4 text-green-800 bg-green-100 rounded-lg transition-opacity duration-500">
                {{ session('success') }} <a class="text-blue-500" href="/check-out"></a>
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
                <x-input label="Tên danh mục" wire:model="name" />
                <x-markdown wire:model="description" label="Mô tả" />
                {{-- <x-input label="Price" wire:model="amount" prefix="VND" money hint="It submits an unmasked value" /> --}}
                <x-input label="Đường dẫn" wire:model="slug" />
                <x-select
                label="Danh mục cha"
                wire:model="parentCategory"
                :options="$categories"
                option-value="id"
                placeholder="Chọn danh mục cha"
                placeholder-value="0"
                option-label="name" />
            </div>


            {{-- Right --}}
            <div class="col">
                    {{-- <x-file wire:model="file" label="Receipt" hint="Only PDF" accept="application/pdf" class="mb-3"/> --}}
                    <x-modal wire:model="selectedPhotoModal" title="Danh mục ảnh" class="backdrop-blur" box-class="max-w-[1200px]" >
                        <x-tabs wire:model="selectedTab" selected="photos-tab">
                            <x-tab name="photos-tab" label="Ảnh" icon="o-photo">
                                <div class="grid grid-cols-6 gap-2" x-data="{ selected: null}">
                                    @if($photos)
                                        @foreach ($photos as $photo)
                                            <div>
                                                <img @click="selected = {{ $photo->id }}; $wire.avatarId = {{ $photo->id }}"
                                                :class="selected === {{ $photo->id }} ? 'border-3 border-blue-300' : 'border'"
                                                class="w-full h-full border rounded"  src="{{ Storage::url($photo->path) }}" alt="" loading="lazy" >
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </x-tab>
                            {{-- <x-tab name="tricks-tab" label="Upload Photo" icon="o-sparkles">
                                <div>Upload</div>
                            </x-tab> --}}
                        </x-tabs>

                        <x-slot:actions>
                            <x-button label="Thoát" @click="$wire.selectedPhotoModal = false" />
                            <x-button label="Lưu" @click="$wire.selectedPhotoModal = false; $wire.loadPhoto()" class="bg-blue-500 text-white" />
                        </x-slot:actions>
                    </x-modal>

                    <div class="mb-3">Ảnh đại diện:</div>

                    @if($selectedPhoto)
                        <div class="mb-3">
                            <img class="w-full rounded" src="{{ Storage::url($selectedPhoto->path) }}" alt="" @click="$wire.selectedPhotoModal = true">
                        </div>
                    @else
                        <x-button class="w-full h-64" @click="$wire.selectedPhotoModal = true" icon="o-photo" />
                    @endif
                {{-- <x-slot:actions class="block"> --}}
                    <div class="text-right">
                        {{-- <x-button label="Thoá" /> --}}
                        <x-button label="{{ $selectedCategory ? 'Cập nhật' : 'Tạo mới' }}" class="btn-primary" type="submit" spinner="save" />
                    </div>
                {{-- </x-slot:actions> --}}
            </div>
        </x-form>
    </div>
</div>
