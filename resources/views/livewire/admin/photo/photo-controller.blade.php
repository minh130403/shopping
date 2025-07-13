<div class="relative">
    <div>
         @error('photo') <span class="error text-red-500">{{ $message }}</span> @enderror
    </div>
    <div class="mt-3 mb-3 h-[300px] border-2 rounded border-dashed flex justify-center items-center">
        <input type="file" name="file" id="file" class="hidden" wire:model="photo" >
        <label for="file" class="border rounded p-2 flex cursor-pointer">
           <span class="mr-1">Upload file </span>
           <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
            </svg>
        </label>
    </div>

    <x-modal wire:model="modal" title="Photo" subtitle="Edit photo" box-class="max-w-[1200px]">
        @if ($selectedPhoto)
            <div class="flex gap-4 mb-3">
                <div class="">
                    <img class="h-[320px] w-[320px]  border rounded object-contain" src="{{Storage::url($selectedPhoto->path )}}" alt="{{ $selectedPhoto->alt }}"  loading="lazy">
                </div>
                <div class="grow">
                    <form wire:submit="updatePhoto()">
                       <div class="input-field mb-3">
                            <label for="alt" class="mb-1 font-semibold">Alt:</label>
                            <input id="alt" type="text" class="w-full border rounded p-2" wire:model="alt">
                       </div>
                        <div class="input-field mb-3">
                            <label for="alt" class="mb-1 font-semibold">Path:</label>
                            <input id="alt" type="text" class="w-full border rounded p-2 bg-gray-250" disabled value="{{  url($selectedPhoto->path) }}" >
                       </div>
                       <div class="input-field mb-3">
                            <input type="submit" class="border px-2 py-1 rounded hover:bg-blue-500 hover:text-white cursor-pointer" value="Update">
                            <button type="button" class="border px-2 py-1 rounded hover:bg-red-500 hover:text-white cursor-pointer" wire:click="deletePhoto()">Delete</button>
                       </div>
                    </form>
                </div>
            </div>
        @endif
    </x-modal>

    <div class="mt-3">
        <ul class="grid grid-cols-8 gap-4">
            @foreach ($photos as $photo)
                <li class="flex-1/6 rounded border border-gray-500 h-[140px] cursor-pointer"
                    wire:click="openModalWithPhoto({{ $photo->id }})">
                    <img src="{{'https://i0.wp.com/thewordwarrior.com/wp-content/uploads/woocommerce-placeholder.png?fit=655,655&ssl=1' ?? Storage::url($photo->path) }}" alt="" class="h-full w-full object-cover">
                </li>
            @endforeach
        </ul>
    </div>



</div>
