<div >
    @if ($selectedPage)
        <div class="mb-3">
            <x-button label="Thêm trang" icon="o-plus" class="bg-white" link="/admin/pages/create"/>
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
        <x-form wire:submit="save" class="">

            <x-input label="Tiêu đề" wire:model="title" />

            <label class="text-md font-semibold" for=""></label>
            <x-code
                label="Nội dung"
                height="400px"
                wire:model="content"
                dark-theme="cobalt"
                light-theme="dreamweaver"
                language="php_laravel_blade"
            />

            <x-slot:actions>
                <x-button label="Lưu " class="btn-primary" type="submit" spinner="save" />
            </x-slot:actions>
        </x-form>
    </div>
</div>
