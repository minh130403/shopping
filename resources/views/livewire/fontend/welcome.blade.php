<div>
   {{-- Carousel --}}

   @php
        $slides = [
            [
                'image' =>   'https://cdn.pixabay.com/photo/2017/05/09/03/46/bc-2297205_960_720.jpg' ??  setting('site_banner1', null),
            ],
            [
                'image' =>   'https://plus.unsplash.com/premium_photo-1673697239909-e11521d1ba94?fm=jpg&q=60&w=3000&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8ZXZlbmluZ3xlbnwwfHwwfHx8MA%3D%3D' ??  setting('site_banner2', null),
            ],
        ];
    @endphp




    <div class=" md:mx-48 px-2 !mb-5">
        <x-carousel :slides="$slides" class="!h-80 ">

        </x-carousel>
    </div>

   {{-- Carousel end --}}


   {{-- Tabs --}}
    <div class="mt-3  md:mx-48">
        <x-tabs wire:model="selectedTab" selected="sale-tab">
            <x-tab name="sale-tab" label="Sản phẩm bán chạy" >
                <div class="grid grid-cols-2  md:grid-cols-4 gap-4">
                    @foreach ($bestSeller as $item)
                       <x-my-card :$item type="products" />
                    @endforeach
                </div>
            </x-tab>
            <x-tab name="view-tab" label="Sản phẩm xem nhiều nhất" >
                <div class="grid grid-cols-2  md:grid-cols-4 gap-4">
                    @foreach ($mostViewedProducts as $item)
                       <x-my-card :$item type="products" />
                    @endforeach
                </div>
            </x-tab>
            <x-tab name="new-tab" label="Sản phẩm mới" >
                <div class="grid grid-cols-2  md:grid-cols-4 gap-4">
                    @foreach ($newProducts as $item)
                       <x-my-card :$item type="products" />
                    @endforeach
                </div>
            </x-tab>
        </x-tabs>
    </div>


    {{-- End Tabs --}}
</div>
