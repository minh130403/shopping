<div >
    @if ($selectedProduct)
        <div class="mb-3">
            <x-button label="Thêm sản phẩm" icon="o-plus" class="bg-white" link="/admin/products/create"/>
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
                <x-input label="Tên sản phẩm" wire:model="name" />
                <x-markdown wire:model="description" label="Mô tả" />
                <x-markdown wire:model="shortDescription" label="Mô tả ngắn" :config="$config" />
                {{-- <x-input label="Price" wire:model="amount" prefix="VND" money hint="It submits an unmasked value" /> --}}
                <x-input label="Đường dẫn" wire:model="slug" />
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
                                            class="w-full h-full border rounded"  src="{{ 'https://i0.wp.com/thewordwarrior.com/wp-content/uploads/woocommerce-placeholder.png?fit=655,655&ssl=1' ?? Storage::url($photo->path) }}" alt="" loading="lazy" >
                                        </div>
                                    @endforeach
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

                    <x-select
                    label="Danh mục sản phẩm"
                    wire:model="categoryId"
                    :options="$categories"
                    option-value="id"
                    placeholder="Chọn danh mục"
                    placeholder-value="0"
                    option-label="name"
                    class="mb-3"/>

                     <x-select
                    label="Tình trạng sản phẩm"
                    wire:model="status"
                    :options="$statuses"
                    option-value="value"
                    option-label="label"
                    class="mb-3"/>

                    <x-select
                    label="Trạng thái sản phẩm"
                    wire:model="state"
                    :options="$states"
                    option-value="value"
                    option-label="label"
                    class="mb-3"/>

                    <div class="mb-3">Ảnh đại diện:</div>

                    @if($selectedPhoto)
                        <div class="mb-3">
                            <img class="w-full rounded" src="{{ 'https://i0.wp.com/thewordwarrior.com/wp-content/uploads/woocommerce-placeholder.png?fit=655,655&ssl=1' ?? Storage::url($selectedPhoto->path) }}" alt="" @click="$wire.selectedPhotoModal = true">
                        </div>
                    @else
                        <x-button class="w-full h-64 mb-3" @click="$wire.selectedPhotoModal = true" icon="o-photo"/>
                    @endif
                {{-- <x-slot:actions class="block"> --}}

                {{-- </x-slot:actions> --}}
                    <div class="gallery">
                        <span class="block mb-3">Thư viện ảnh:</span>

                         {{-- <x-file wire:model="file" label="Receipt" hint="Only PDF" accept="application/pdf" class="mb-3"/> --}}
                        <x-modal wire:model="selectedGalleryModal" title="Photo" class="backdrop-blur" box-class="max-w-[1200px]" >
                            <x-tabs wire:model="selectedTab" selected="photos-tab">
                                <x-tab name="photos-tab" label="Photos" icon="o-photo">
                                   <div  class="grid grid-cols-6 gap-2"
                                        x-data="{
                                            selected: [],
                                            init() {

                                                Alpine.effect(() => {
                                                    if (!Array.isArray($wire.galleryPhotoId)) {
                                                        $wire.set('galleryPhotoId', []);
                                                    }
                                                    this.selected = $wire.galleryPhotoId || [];
                                                });
                                            },
                                            toggle(id) {
                                                if (this.selected.includes(id)) {
                                                    this.selected = this.selected.filter(i => i !== id);
                                                } else {
                                                    this.selected.push(id);
                                                }


                                                $wire.set('galleryPhotoId', this.selected);
                                            }
                                        }"
                                    >
                                        @foreach ($photos as $photo)
                                            <div>
                                                <img
                                                    @click="toggle({{ $photo->id }})"
                                                    :class="selected.includes({{ $photo->id }}) ? 'border-4 border-blue-400' : 'border'"
                                                    class="w-full h-full border rounded cursor-pointer"
                                                    src="{{ 'https://i0.wp.com/thewordwarrior.com/wp-content/uploads/woocommerce-placeholder.png?fit=655,655&ssl=1' ?? Storage::url($photo->path) }}"
                                                    loading="lazy"
                                                >
                                            </div>
                                        @endforeach
                                    </div>
                                </x-tab>
                                {{-- <x-tab name="tricks-tab" label="Upload Photo" icon="o-sparkles">
                                    <div>Upload</div>
                                </x-tab> --}}
                            </x-tabs>

                            <x-slot:actions>
                                <x-button label="Thoát" @click="$wire.selectedGalleryModal = false" />
                                <x-button label="Lưu" @click="$wire.selectedGalleryModal = false; $wire.loadGallery()" class="bg-blue-500 text-white" />
                            </x-slot:actions>
                        </x-modal>


                         @if($galleryPhotoId)
                            <div class="mb-3 grid grid-cols-3 gap-1">
                            @foreach ($gallery as $item)
                                    <div class="">
                                        <img class="w-32 rounded" src="{{ 'https://i0.wp.com/thewordwarrior.com/wp-content/uploads/woocommerce-placeholder.png?fit=655,655&ssl=1' ?? Storage::url($item->path) }}" alt="" @click="$wire.selectedGalleryModal = true">
                                    </div>
                            @endforeach

                            </div>
                        @else
                            <x-button class="w-full h-64 mb-3" @click="$wire.selectedGalleryModal = true"  icon="o-photo"/>
                        @endif
                    </div>
                    <div class="text-right">
                        {{-- <x-button label="Back" /> --}}
                        <x-button label="{{ $selectedProduct ? 'Cập nhật' : 'Thêm mới' }}" class="btn-primary" type="submit" spinner="save" />
                    </div>
            </div>
        </x-form>
    </div>
</div>
