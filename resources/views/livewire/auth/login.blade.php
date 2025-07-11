<div class="min-h-[50vh]">
   <div class="">
        <x-form wire:submit="authenticate" class="max-w-[400px] m-auto border border-gray-300 rounded-xl p-3">
            <h3 class="text-xl font-bold text-center">Login </h3>
            <x-input label="Email" wire:model="email" />
            <x-password label="Password" wire:model="password" right />

            <x-slot:actions>
                {{-- <x-button label="Cancel" /> --}}
                <x-button label="Login" class="btn-primary" type="submit" spinner="save" />
            </x-slot:actions>
        </x-form>
   </div>
</div>
