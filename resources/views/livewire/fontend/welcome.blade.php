<div>
   {{-- Carousel --}}

   {{-- @php
        $slides = [
            [
                'image' => 'http://localhost:8000/storage/' . setting('site_banner1', null),
            ],
            [
                'image' => 'http://localhost:8000/storage/' . setting('site_banner2', null),
            ],
        ];
    @endphp --}}

    @php
       dd(DB::select("SELECT tablename FROM pg_tables WHERE schemaname = 'public'")) ;
    @endphp

{{--
    <div class="!px-[240px]">
        <x-carousel :slides="$slides" class="!h-80 ">

        </x-carousel>
    </div> --}}

   {{-- Carousel end --}}


   {{-- Tabs --}}
    <div class="mt-3 px-[240px]">
        <x-tabs wire:model="selectedTab" selected="sale-tab">
            <x-tab name="sale-tab" label="Best saller" >
                <div class="grid grid-cols-4 gap-4">
                    @foreach ($bestSeller as $item)
                       <x-my-card :$item type="products" />
                    @endforeach
                </div>
            </x-tab>
            <x-tab name="view-tab" label="Most View" >
                <div class="grid grid-cols-4 gap-4">
                    @foreach ($mostViewedProducts as $item)
                       <x-my-card :$item type="products" />
                    @endforeach
                </div>
            </x-tab>
            <x-tab name="new-tab" label="Newest" >
                <div class="grid grid-cols-4 gap-4">
                    @foreach ($newProducts as $item)
                       <x-my-card :$item type="products" />
                    @endforeach
                </div>
            </x-tab>
        </x-tabs>
    </div>


    {{-- End Tabs --}}
</div>
