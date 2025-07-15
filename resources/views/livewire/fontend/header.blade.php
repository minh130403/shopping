<div>
   <div class="header">
    <div class="header_top ">
        <div class="flex flex-row items-center px-3 lg:px-0 lg:mx-48">
            <div class="logo flex flex-row gap-4 items-center grow ">
                <a href="/">
                    <img class="rounded-md w-[48px] h-[48px]"  src="https://99designs-blog.imgix.net/blog/wp-content/uploads/2022/06/Starbucks_Corporation_Logo_2011.svg-e1657703028844.png?auto=format&q=60&fit=max&w=930" alt="">
                </a>
                <h2 class="font-medium text-2xl hidden uppercase lg:block " >{{ setting("site_name") }}</h2>
             </div>
             <livewire:search></livewire:search>
             <x-button icon="o-shopping-cart" class="btn-square" link="/check-out"/>
        </div>
    </div>
    <div class="header_bot">
        <div class="flex flex-col items-center lg:mx-48 md:flex-row">
            <x-menu class=" flex-3/4 flex-row m-0 pl-0 my-0 ps-0">
                <x-dropdown label="Danh mục sản phẩm" class="bg-white border-0 hover:bg-gray-200  ">
                    @foreach ($root ?? [] as $item)
                        @if (!empty($item->children) && count($item->children) > 0)
                            <x-menu-sub title="{{ $item->name ?? '' }}">
                                @foreach ($item->children as $itemChild)
                                    <x-menu-item
                                        title="{{ $itemChild->name ?? '' }}"
                                        link="/categories/{{ $itemChild->slug ?? '' }}"
                                    />
                                @endforeach
                            </x-menu-sub>
                        @else
                            <x-menu-item
                                title="{{ $item->name ?? '' }}"
                                link="/categories/{{ $item->slug ?? '' }}"
                                class="!w-50"
                            />
                        @endif
                    @endforeach

                    {{-- @for ($i=0 ; $i < 4; $i ++)
                    <x-menu-sub title="{{ $item->name ?? 'category'}}"  >
                         <x-menu-item title="{{ $itemChild->name ?? 'category' }}" link="/categories/{{ $itemChild->slug ?? 'Category'}}"/>
                    </x-menu-sub>
                    @endfor --}}
                </x-dropdown>

                <x-menu-item class="font-semibold md:block" title="Trang chủ"  link="/" />
                <x-menu-item class="font-semibold md:block hidden" title="Giới thiệu" link="/about-us" />
                <x-menu-item class="font-semibold md:block hidden" title="Liên hệ" link="/contact" />
                <x-menu-item class="font-semibold md:block  " title="Tin tức" link="/posts/all" />
            </x-menu>
            <div class="contact grow text-right flex gap-2 flex-row-reverse">
                <a href="tel:{{ setting("site_phone1") }}" class="btn">Hotline: {{ setting("site_phone1") }}</a>
                <a href="tel:{{ setting("site_phone2") }}" class="btn">Zalo: {{ setting("site_phone2") }}</a>
            </div>
        </div>
    </div>
</div>
</div>
